<?php

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MyModuleConfigForm extends ConfigFormBase
{

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['mymodule.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'mymodule_config_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('mymodule.settings');

        $form['greeting_message_morning'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Set Message for Morning( 6 am to 12 am)'),
            '#default_value' => $config->get('greeting_message_morning'),
        ];


        $form['greeting_message_noon'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Set Message for Afternoon( 12 pm to 5 pm )'),
            '#default_value' => $config->get('greeting_message_noon'),
        ];

        $form['greeting_message_evening'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Set Message for evening( 5pm to 9 pm)'),
            '#default_value' => $config->get('greeting_message_evening'),
        ];


        $form['greeting_message_night'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Set Message for night( 9pm to 6 am)'),
            '#default_value' => $config->get('greeting_message_night'),
        ];


        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $config = $this->configFactory->getEditable('mymodule.settings');
        $config->set('greeting_message_morning', $form_state->getValue('greeting_message_morning'));
        $config->set('greeting_message_evening', $form_state->getValue('greeting_message_evening'));
        $config->set('greeting_message_noon', $form_state->getValue('greeting_message_noon'));
        $config->set('greeting_message_night', $form_state->getValue('greeting_message_night'));
        $config->save();

        parent::submitForm($form, $form_state);
    }
}
