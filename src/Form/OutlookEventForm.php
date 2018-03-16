<?php

namespace Drupal\outlook_events\Form;

use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class OutlookEventForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'outlook_events_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'outlook_events.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('outlook_events.settings');

    $form['username'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Outlook Account Id'),
      '#default_value' => $config->get('username'),
    );

    $form['password'] = array(
      '#type' => 'password',
      '#title' => $this->t('Outlook Password'),
      '#default_value' => $config->get('password'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      // Retrieve the configuration
       $this->configFactory->getEditable('outlook_events.settings')
      // Set the submitted configuration setting
      ->set('username', $form_state->getValue('username'))
      // You can set multiple configurations at once by making
      // multiple calls to set()
      ->set('password', $form_state->getValue('password'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}