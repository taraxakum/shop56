<?php

namespace Drupal\jsonapi_extras\ResourceType;

use Drupal\Component\Plugin\Exception\PluginException;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\jsonapi\ResourceType\ResourceTypeRepository;
use Drupal\jsonapi_extras\Entity\JsonapiResourceConfig;
use Drupal\jsonapi_extras\Plugin\ResourceFieldEnhancerManager;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Provides a repository of JSON:API configurable resource types.
 */
class ConfigurableResourceTypeRepository extends ResourceTypeRepository {

  /**
   * The entity repository.
   *
   * @var \Drupal\Core\Entity\EntityRepositoryInterface
   */
  protected $entityRepository;

  /**
   * Plugin manager for enhancers.
   *
   * @var \Drupal\jsonapi_extras\Plugin\ResourceFieldEnhancerManager
   */
  protected $enhancerManager;

  /**
   * The configuration factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * A list of all resource types.
   *
   * @var \Drupal\jsonapi_extras\ResourceType\ConfigurableResourceType[]
   */
  protected $resourceTypes;

  /**
   * A list of only enabled resource types.
   *
   * @var \Drupal\jsonapi_extras\ResourceType\ConfigurableResourceType[]
   */
  protected $enabledResourceTypes;

  /**
   * A list of all resource configuration entities.
   *
   * @var \Drupal\jsonapi_extras\Entity\JsonapiResourceConfig[]
   */
  protected $resourceConfigs;

  /**
   * {@inheritdoc}
   */
  protected $cacheTags = [
    'jsonapi_resource_types',
    'config:jsonapi_extras.settings',
    'config:jsonapi_resource_config_list',
  ];

  /**
   * Builds the resource config ID from the entity type ID and bundle.
   *
   * @param string $entity_type_id
   *   The entity type ID.
   * @param string $bundle
   *   The entity bundle.
   *
   * @return string
   *   The ID of the associated ResourceConfig entity.
   */
  protected static function buildResourceConfigId($entity_type_id, $bundle) {
    return sprintf(
      '%s--%s',
      $entity_type_id,
      $bundle
    );
  }

  /**
   * Injects the entity repository.
   *
   * @param \Drupal\Core\Entity\EntityRepositoryInterface $entity_repository
   *   The entity repository.
   */
  public function setEntityRepository(EntityRepositoryInterface $entity_repository) {
    $this->entityRepository = $entity_repository;
  }

  /**
   * Injects the resource enhancer manager.
   *
   * @param \Drupal\jsonapi_extras\Plugin\ResourceFieldEnhancerManager $enhancer_manager
   *   The resource enhancer manager.
   */
  public function setEnhancerManager(ResourceFieldEnhancerManager $enhancer_manager) {
    $this->enhancerManager = $enhancer_manager;
  }

  /**
   * Injects the configuration factory.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory.
   */
  public function setConfigFactory(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   *
   * Mostly the same as the parent implementation, with three key differences:
   * 1. Different resource type class.
   * 2. Every resource type is assumed to be mutable.
   * 2. Field mapping not based on logic, but on configuration.
   */
  protected function createResourceType(EntityTypeInterface $entity_type, $bundle) {
    $resource_config_id = static::buildResourceConfigId(
      $entity_type->id(),
      $bundle
    );
    $resource_config = $this->getResourceConfig($resource_config_id);

    // Create subclassed ResourceType object with the same parameters as the
    // parent implementation.
    $resource_type = new ConfigurableResourceType(
      $entity_type->id(),
      $bundle,
      $entity_type->getClass(),
      $entity_type->isInternal() || (bool) $resource_config->get('disabled'),
      static::isLocatableResourceType($entity_type, $bundle),
      TRUE,
      static::isVersionableResourceType($entity_type),
      $this->overrideFieldMapping($resource_config)
    );

    // Inject additional services through setters. By using setter injection
    // rather that constructor injection, we prevent most future BC breaks.
    $resource_type->setJsonapiResourceConfig($resource_config);
    $resource_type->setEnhancerManager($this->enhancerManager);
    $resource_type->setConfigFactory($this->configFactory);

    return $resource_type;
  }

  /**
   * Get a single resource configuration entity by its ID.
   *
   * @param string $resource_config_id
   *   The configuration entity ID.
   *
   * @return \Drupal\jsonapi_extras\Entity\JsonapiResourceConfig
   *   The configuration entity for the resource type.
   */
  protected function getResourceConfig($resource_config_id) {
    $null_resource = new NullJsonapiResourceConfig(
      ['id' => $resource_config_id],
      'jsonapi_resource_config'
    );
    try {
      $resource_configs = $this->getResourceConfigs();
      return isset($resource_configs[$resource_config_id]) ?
        $resource_configs[$resource_config_id] :
        $null_resource;
    }
    catch (PluginException $e) {
      return $null_resource;
    }
  }

  /**
   * Load all resource configuration entities.
   *
   * @return \Drupal\jsonapi_extras\Entity\JsonapiResourceConfig[]
   *   The resource config entities.
   *
   * @throws \Drupal\Component\Plugin\Exception\PluginException
   */
  public function getResourceConfigs() {
    if (!$this->resourceConfigs) {
      $resource_config_ids = [];
      foreach ($this->getEntityTypeBundleTuples() as $tuple) {
        list($entity_type_id, $bundle) = $tuple;
        $resource_config_ids[] = static::buildResourceConfigId(
          $entity_type_id,
          $bundle
        );
      }
      $this->resourceConfigs = $this->entityTypeManager
        ->getStorage('jsonapi_resource_config')
        ->loadMultiple($resource_config_ids);
    }
    return $this->resourceConfigs;
  }

  /**
   * Entity type ID and bundle iterator.
   *
   * @return array
   *   A list of entity type ID and bundle tuples.
   */
  protected function getEntityTypeBundleTuples() {
    $entity_type_ids = array_keys($this->entityTypeManager->getDefinitions());
    // For each entity type return as many tuples as bundles.
    return array_reduce($entity_type_ids, function ($carry, $entity_type_id) {
      $bundles = array_keys($this->entityTypeBundleInfo->getBundleInfo($entity_type_id));
      // Get all the tuples for the current entity type.
      $tuples = array_map(function ($bundle) use ($entity_type_id) {
        return [$entity_type_id, $bundle];
      }, $bundles);
      // Append the tuples to the aggregated list.
      return array_merge($carry, $tuples);
    }, []);
  }

  /**
   * Resets the internal caches for resource types and resource configs.
   */
  public function reset() {
    $this->all = [];
    $this->resourceConfigs = [];
  }

  /**
   * Gets the field mapping for the given field names and entity type + bundle.
   *
   * @param \Drupal\jsonapi_extras\Entity\JsonapiResourceConfig $resource_config
   *   The associated resource config.
   *
   * @return array
   *   An array with:
   *   - keys are (real/internal) field names
   *   - values are either FALSE (indicating the field is not exposed despite
   *     not being internal), TRUE (indicating the field should be exposed under
   *     its internal name) or a string (indicating the field should not be
   *     exposed using its internal name, but the name specified in the string)
   *
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  protected function overrideFieldMapping(JsonapiResourceConfig $resource_config) {
    // This is not ideal, but we cannot load the resource type to get the entity
    // type object. That is because this is used during the creation of the
    // ResourceType.
    list($entity_type_id, $bundle) = explode('--', $resource_config->getOriginalId());
    $entity_type = $this->entityTypeManager->getDefinition($entity_type_id);
    $field_names = $this->getAllFieldNames($entity_type, $bundle);
    // Use the base class to fetch the non-configurable field mappings.
    $mappings = $resource_config->getFieldMapping();
    // Ignore all the fields that don't have aliases.
    $mappings = array_filter($mappings, function ($field_info) {
      return $field_info !== TRUE;
    });
    // Make sure to respect the overrides coming from JSON:API if there is no
    // input in JSON:API Extras.
    return array_merge(
      static::getFieldMapping($field_names, $entity_type, $bundle),
      $mappings
    );
  }

}
