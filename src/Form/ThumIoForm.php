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
      'thum_io.adminsettings',
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
    $config = $this->config('thum_io.adminsettings');

    $form['key_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Thum.io Key ID'),
      '#description' => $this->t('Key ID from your account'),
      '#default_value' => $config->get('key_id'),
    ];

    $form['secret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Thum.io Secret'),
      '#description' => $this->t('Secret from your account'),
      '#default_value' => $config->get('secret'),
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

    $this->config('thum_io.adminsettings')
      ->set('key_id', $form_state->getValue('key_id'))
      ->set('secret', $form_state->getValue('secret'))
      ->save();
  }

}
