<?php

namespace Drupal\Tests\pacifica_search\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests behavior for saving the pacifica search field elements.
 *
 * @group pacifica_search
 */
class PacificaSearchTest extends BrowserTestBase {
  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['pacifica_search', 'node'];

  /**
    * Basic test setup.
    */
  public function testPacificaSearchSave() {
    $storage = \Drupal::entityTypeManager()->getStorage('node');
    // Save a node programatically.
    $node = $storage->create([
      'type' => 'article',
      'title' => 'Test node',
      'uid' => '1',
      'status' => 1,
    ]);
    $node->save();
    // Load the node.
    $node = $storage->load(1);
    $this->assert($node->getOwnerId() == 1, 'Node id should be 1.');
  }
}
