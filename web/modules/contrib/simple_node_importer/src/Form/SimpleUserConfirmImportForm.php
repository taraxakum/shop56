<?php

namespace Drupal\simple_node_importer\Form;

use Drupal\Core\Session\AccountInterface;
use Drupal\Core\TempStore\PrivateTempStoreFactory;
use Drupal\Core\Session\SessionManagerInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\NodeInterface;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\simple_node_importer\Services\GetServices;
use Drupal\Component\Render\FormattableMarkup;

/**
 * Defines a confirmation form to confirm deletion of something by id.
 */
class SimpleUserConfirmImportForm extends ConfirmFormBase {

  protected $services;
  protected $sessionVariable;
  protected $sessionManager;
  protected $currentUser;
  protected $entityTypeManager;

  /**
   * Confirmation form for the start User import.
   *
   * @param Drupal\simple_node_importer\Services\GetServices $getServices
   *   Constructs a Drupal\simple_node_importer\Services object.
   * @param Drupal\Core\TempStore\PrivateTempStoreFactory $sessionVariable
   *   Constructs a Drupal\Core\TempStore\PrivateTempStoreFactory object.
   * @param Drupal\Core\Session\SessionManagerInterface $session_manager
   *   Constructs a Drupal\Core\Session\SessionManagerInterface object.
   * @param Drupal\Core\Session\AccountInterface $current_user
   *   Constructs a Drupal\Core\Session\AccountInterface object.
   * @param Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   Constructs a Drupal\Core\Entity\EntityTypeManagerInterface object.
   */
  public function __construct(GetServices $getServices, PrivateTempStoreFactory $sessionVariable, SessionManagerInterface $session_manager, AccountInterface $current_user, EntityTypeManagerInterface $entity_type_manager) {
    $this->services = $getServices;
    $this->sessionVariable = $sessionVariable->get('simple_node_importer');
    $this->sessionManager = $session_manager;
    $this->currentUser = $current_user;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $option = NULL, NodeInterface $node = NULL) {
    $this->node = $node;
    $form['snp_nid'] = [
      '#type' => 'hidden',
      '#value' => $node->id(),
    ];
    $parameters = ['option' => $option, 'node' => $node->id()];
    return parent::buildForm($form, $form_state, $parameters);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Remove unnecessary values.
    $form_state->cleanValues();

    $node_storage = $this->entityTypeManager->getStorage('node');
    $file_storage = $this->entityTypeManager->getStorage('file');

    $snp_nid = $form_state->getValue('snp_nid');

    $node = $node_storage->load($snp_nid);

    $map_values = $this->sessionVariable->get('mapvalues');
    $fid = $node->get('field_upload_csv')->getValue()[0]['target_id'];
    $file = $file_storage->load($fid);
    $csv_uri = $file->getFileUri();
    $handle = fopen($csv_uri, 'r');
    $columns = [];
    $columns = array_values($this->services->simpleNodeImporterGetAllColumnHeaders($csv_uri));
    $record = [];
    $map_fields = array_keys($map_values);
    $i = 1;
    $records = [];
    while ($row = fgetcsv($handle)) {
      if ($i == 1) {
        $i++;
        continue;
      }

      foreach ($row as $k => $field) {
        $column1 = str_replace(' ', '_', strtolower($columns[$k]));
        foreach ($map_fields as $field_name) {
          if ($map_values[$field_name] == $column1) {
            $record[$field_name] = trim($field);
          }
          else {
            if (is_array($map_values[$field_name])) {
              $multiple_fields = array_keys($map_values[$field_name]);
              foreach ($multiple_fields as $j => $m_fields) {
                if ($m_fields == $column1) {
                  if ($m_fields == 'roles') {
                    $field = str_replace(' ', '_', strtolower($field));
                  }
                  if (!empty($field)) {
                    $record[$field_name][$j] = trim($field);
                  }
                  else {
                    $record[$field_name][$j] = NULL;
                  }
                }
              }
            }
          }
        }
      }
      $record['nid'] = $node->id();
      $record['type'] = 'user';
      $records[] = $record;
    }
    // Preapring batch parmeters to be execute.
    $batch = [
      'title' => t('Importing User'),
      'operations' => [
          [
            '\Drupal\simple_node_importer\Controller\UserImportController::userImport',
            [$records],
          ],
      ],
      'finished' => '\Drupal\simple_node_importer\Controller\UserImportController::userImportBatchFinished',
      'init_message' => t('Initialializing User importing.'),
      'progress_message' => t('Processed @current out of @total.'),
      'error_message' => t('User creation has encountered an error.'),
    ];
    // Set the batch operation.
    batch_set($batch);
    fclose($handle);
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() : string {
    return "simple_user_confirm_importing_form";
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    $parameters = $this->sessionVariable->get('parameters');
    return new Url('simple_node_importer.user_mapping_form', $parameters);
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {

    $critical_info = new FormattableMarkup('<p class="@class"></p><p>Do you want to continue?</p>', ["@class" => "confirmation-info"]);

    return $this->t("@critical_info", ["@critical_info" => $critical_info]);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
     $container->get('snp.get_services'),
     $container->get('user.private_tempstore'),
     $container->get('session_manager'),
     $container->get('current_user'),
     $container->get('entity_type.manager')
     );
  }

}
