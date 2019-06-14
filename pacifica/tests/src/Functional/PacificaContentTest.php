<?php

namespace Drupal\Tests\pacifica\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests behavior for saving the pacifica field elements.
 *
 * @group pacifica
 */
class PacificaContentTest extends BrowserTestBase {
  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['pacifica', 'node', 'taxonomy'];

  /**
   * Content types test array.
   *
   * @var array
   */
  public static $test_objs = array(
    array(
      'type' => 'organization',
      'title' => 'My Organization'
    ),array(
      'type' => 'project',
      'title' => 'My Project'
    )
  );
  /**
    * Basic test setup.
    */
  public function testPacificaContentTypes() {
    $storage = \Drupal::entityTypeManager()->getStorage('node');
    foreach(self::$test_objs as $index => $obj) {
      $node = $storage->create([
        'type' => $obj['type'],
        'title' => $obj['title'],
        'uid' => '1',
        'status' => 1
      ]);
      $node->save();
      $node = $storage->load(1);
      $this->assert($node != null);
      $this->assert($node->getOwnerId() == 1, "Node id should be $index.");
    }
  }

  /**
    * Basic test setup.
    */
  public function testPacificaVocabTerms() {
    $storage = \Drupal::entityTypeManager()->getStorage('taxonomy_term');
    foreach(self::$test_objs as $index => $obj) {
      $index += 1;
      $obj = [
        'tid' => $index,
        'name' => 'term',
        'vid' => $obj['type']
      ];
      $term = $storage->create($obj);
      $term->save();
      $term = $storage->load($index);
      $this->assert($term->id() == $index, "Term id should be $index.");
    }
  }
}
