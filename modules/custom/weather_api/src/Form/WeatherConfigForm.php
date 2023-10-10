<?php

namespace Drupal\weather_api\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a configuration form for the Weather Settings.
 */
class WeatherConfigForm extends ConfigFormBase {

 protected function getEditableConfigNames() {
   return ['weather_settings.settings'];
 }

 public function getFormId() {
   return 'weather_settings_form';
 }

 public function buildForm(array $form, FormStateInterface $form_state) {
   $config = $this->config('weather_settings.settings');

   $form['api_key'] = [
     '#type' => 'textfield',
     '#title' => $this->t('API Key'),
     '#default_value' => $config->get('api_key'),
   ];

   $form['country'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Country'),
     '#default_value' => $config->get('country'),
   ];

   $form['city'] = [
     '#type' => 'textfield',
     '#title' => $this->t('City'),
     '#default_value' => $config->get('city'),
   ];

   $form['api_endpoint'] = [
     '#type' => 'textfield',
     '#title' => $this->t('endpoint'),
     '#default_value' => $config->get('api_endpoint'),

   ];

   // Add more form fields for other API-related settings here.

   return parent::buildForm($form, $form_state);
 }

 public function submitForm(array &$form, FormStateInterface $form_state) {
   $config = $this->configFactory->getEditable('weather_settings.settings');
   $config->set('api_key', $form_state->getValue('api_key'));
   $config->set('country', $form_state->getValue('country'));
   $config->set('city', $form_state->getValue('city'));
   $config->set('api_endpoint', $form_state->getValue('api_endpoint'));
   // Add more settings to be saved here.

   $config->save();
   parent::submitForm($form, $form_state);
 }
}
