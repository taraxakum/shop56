<?php

namespace Drupal\Tests\commerce_pos\Functional;

use Drupal\commerce_pos\Entity\Register;
use Drupal\Tests\commerce\Functional\CommerceBrowserTestBase;

/**
 * Ensure the Register Entity is works correctly.
 *
 * @group commerce_pos
 */
class RegisterTest extends CommerceBrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'system',
    'block',
    'field',
    'commerce',
    'commerce_price',
    'commerce_store',
    'commerce_pos',
  ];

  /**
   * {@inheritdoc}
   */
  protected $adminUser;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->adminUser = $this->drupalCreateUser($this->getAdministratorPermissions());
    $this->drupalLogin($this->adminUser);

  }

  /**
   * {@inheritdoc}
   */
  protected function getAdministratorPermissions() {
    return [
      'view the administration theme',
      'access administration pages',
      'access commerce administration pages',
      'administer commerce_currency',
      'administer commerce_store',
      'administer commerce_store_type',
      'access commerce pos administration pages',
    ];
  }

  /**
   * Tests that proper messaging shows if a register can't be created.
   */
  public function testNoStore() {
    // We need to delete the pre-setup store so we can trigger the error state.
    $this->store->delete();

    $this->drupalGet('admin/commerce/config/pos/register/add');
    $this->assertSession()->pageTextContains(t("Registers can not be created until a store has been added"));
  }

  /**
   * Tests for creating register programmatically and through the form.
   */
  public function testCreateRegister() {
    $title = strtolower($this->randomMachineName(8));

    // Create Register programmatically. Note that createEntity() performs
    // assertions.
    $this->createEntity('commerce_pos_register', [
      'name' => $title,
      'cash' => 100,
      'store_id' => $this->store->id(),
    ]);

    // Create Register through the form.
    $edit = [
      'name[0][value]' => 'foo',
      'default_float[0][number]' => 100,
    ];
    $this->drupalPostForm("admin/commerce/config/pos/register/add", $edit, 'Save');
    $this->assertSession()->responseContains('Successfully saved register foo.');
    $this->assertSession()->addressEquals('admin/commerce/config/pos/registers');
  }

  /**
   * Tests for update through the form.
   */
  public function testUpdateRegister() {
    // Create a new Register.
    $register_new = $this->createEntity('commerce_pos_register', [
      'name' => 'foo',
      'default_float' => 100,
    ]);

    $this->drupalGet('admin/commerce/config/pos/register/' . $register_new->id() . '/edit');
    // Only name is updated.
    $edit = [
      'name[0][value]' => $this->randomMachineName(8),
      'default_float[0][number]' => 100,
    ];
    $this->submitForm($edit, 'Save');
    \Drupal::entityTypeManager()->getStorage('commerce_pos_register')->resetCache([$register_new->id()]);
    $register_updated = Register::load($register_new->id());
    $this->assertEquals($edit['name[0][value]'], $register_updated->getName(), 'The name of the Register has been updated.');
  }

  /**
   * Tests for delete through the form.
   */
  public function testDeleteRegister() {
    // Create a new register.
    $register = $this->createEntity('commerce_pos_register', [
      'name' => 'foo',
      'default_float' => 100,
    ]);

    $this->drupalGet('admin/commerce/config/pos/register/' . $register->id() . '/delete');
    $this->assertSession()->pageTextContains(t('Are you sure you want to delete the register @name?', ['@name' => $register->getName()]));
    $this->assertSession()->pageTextContains('This action cannot be undone.');
    $this->submitForm([], 'Delete');
    \Drupal::entityTypeManager()->getStorage('commerce_pos_register')->resetCache([$register->id()]);
    $register_exists = (bool) Register::load($register->id());
    $this->assertFalse($register_exists, 'The new register has been deleted from the database.');
  }

}
