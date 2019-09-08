<?php

namespace Drupal\Tests\feeds\Kernel;

use Drupal\feeds\Plugin\Type\Processor\ProcessorInterface;

/**
 * Tests for the feeds_item field.
 *
 * @group feeds
 */
class FeedsItemTest extends FeedsKernelTestBase {

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->setUpBodyField();
  }

  /**
   * Tests if an import succeeds when mapping to feeds_item.
   */
  public function testUpdateItemWithFeedsItem() {
    $feed_type = $this->createFeedType([
      'fetcher' => 'directory',
      'fetcher_configuration' => [
        'allowed_extensions' => 'csv',
      ],
      'parser' => 'csv',
      'processor_configuration' => [
        'update_existing' => ProcessorInterface::UPDATE_EXISTING,
        'authorize' => FALSE,
        'values' => [
          'type' => 'article',
        ],
      ],
      'custom_sources' => [
        'guid' => [
          'label' => 'guid',
          'value' => 'guid',
          'machine_name' => 'guid',
        ],
        'title' => [
          'label' => 'title',
          'value' => 'title',
          'machine_name' => 'title',
        ],
        'body' => [
          'label' => 'body',
          'value' => 'body',
          'machine_name' => 'body',
        ],
      ],
      'mappings' => array_merge($this->getDefaultMappings(), [
        [
          'target' => 'body',
          'map' => ['value' => 'body', 'summary' => ''],
          'settings' => ['format' => 'plain_text'],
        ],
      ]),
    ]);

    // Import first feed.
    $feed = $this->createFeed($feed_type->id(), [
      'source' => $this->resourcesPath() . '/csv/content.csv',
    ]);
    $feed->import();

    // Assert two created nodes.
    $this->assertNodeCount(2);

    // Now import updated feed.
    $feed->setSource($this->resourcesPath() . '/csv/content_updated.csv');
    $feed->save();
    $feed->import();

    // Assert that two nodes have been updated.
    $node = node_load(1);
    $this->assertEquals('Lorem ipsum dolor sit amet.', $node->body->value);
    $node = node_load(2);
    $this->assertEquals('Ut wisi enim ad minim veniam.', $node->body->value);
  }

  /**
   * Tests if an import succeeds when *not* mapping to feeds_item.
   */
  public function testUpdateItemsWithoutFeedsItem() {
    $feed_type = $this->createFeedType([
      'fetcher' => 'directory',
      'fetcher_configuration' => [
        'allowed_extensions' => 'csv',
      ],
      'parser' => 'csv',
      'processor_configuration' => [
        'update_existing' => ProcessorInterface::UPDATE_EXISTING,
        'authorize' => FALSE,
        'values' => [
          'type' => 'article',
        ],
      ],
      'custom_sources' => [
        'title' => [
          'label' => 'title',
          'value' => 'title',
          'machine_name' => 'title',
        ],
        'body' => [
          'label' => 'body',
          'value' => 'body',
          'machine_name' => 'body',
        ],
      ],
      'mappings' => [
        [
          'target' => 'title',
          'map' => ['value' => 'title'],
          'unique' => ['value' => TRUE],
        ],
        [
          'target' => 'body',
          'map' => ['value' => 'body', 'summary' => ''],
          'settings' => ['format' => 'plain_text'],
        ],
      ],
    ]);

    // Import first feed.
    $feed = $this->createFeed($feed_type->id(), [
      'source' => $this->resourcesPath() . '/csv/content.csv',
    ]);
    $feed->import();

    // Assert two created nodes.
    $this->assertNodeCount(2);

    // Now import updated feed.
    $feed->setSource($this->resourcesPath() . '/csv/content_updated.csv');
    $feed->save();
    $feed->import();

    // Assert that two nodes have been updated.
    $node = node_load(1);
    $this->assertEquals('Lorem ipsum dolor sit amet.', $node->body->value);
    $node = node_load(2);
    $this->assertEquals('Ut wisi enim ad minim veniam.', $node->body->value);
  }

}
