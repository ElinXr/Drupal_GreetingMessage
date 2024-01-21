<?php

namespace Drupal\nm_greeting_message\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form to provide a greeting message.
 */
class GreetingMessageForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'greeting_message_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    // Greeting message settings.
    $config = $this->config('nm_greeting_message.settings');

    // Greeting message field.
    $form['message_text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Greeting message:'),
      '#default_value' => $config->get('message_text'),
      '#description' => $this->t('This message will appear in the Greeting Message block attached to a specific region.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('nm_greeting_message.settings');
    $config->set('message_text', $form_state->getValue('message_text'));
    $config->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [
      'nm_greeting_message.settings',
    ];
  }

}
