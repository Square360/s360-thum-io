<?php

namespace Drupal\s360_thum_io\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ThumbIoForm class.
 */
class ThumIoForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'thum_io.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'thum_io_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('thum_io.settings');

    $form['key_information'] = [
      '#type' => 'fieldset',
      '#title' => t('Thum.io Key information'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    ];

    $form['text'] = [
      '#type' => 'html_tag',
      '#tag' => 'div',
      '#value' => t('Find your key information here: <a href=":thum_io" target="_blank">Thum.io</a>', [':thum_io' => 'https://www.thum.io/admin/keys']),
      '#weight' => -1,
    ];

    $form['key_information']['id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Id'),
      '#default_value' => $config->get('id'),
    ];

    $form['key_information']['secret_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Secret Key'),
      '#default_value' => $config->get('secret_key'),
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('thum_io.settings')
      ->set('id', $form_state->getValue('id'))
      ->set('secret_key', $form_state->getValue('secret_key'))
      ->save();
  }

}
