<?php

namespace Drupal\pacifica_data_upload\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Data Upload Block.
 *
 * @Block(
 *   id = "data_upload",
 *   admin_label = @Translation("Data Upload Block"),
 *   category = @Translation("Pacifica Data Upload"),
 * )
 */
class DataUploadBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();
    $form['data_upload_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Data Upload API Url'),
      '#default_value' => (isset($config['data_upload_url']) ? $config['data_upload_url'] : ''),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('data_upload_url', $form_state->getValue('data_upload_url'));
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    return [
      '#theme' => 'data_upload',
      '#data_upload_url' => $config['data_upload_url'],
    ];
  }

}