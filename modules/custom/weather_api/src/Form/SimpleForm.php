<?php

namespace Drupal\weather_api\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

class SimpleForm extends FormBase {

    protected $countryManager;
    protected $messenger;

    public function __construct($country_manager, $messenger)
    {
        $this->countryManager = $country_manager;
        $this->messenger = $messenger;
    }

    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('country_manager'),
            $container->get('messenger')
        );
    }

    public function getFormId() {
        return 'mysimpleform';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        if (!$form_state->has('storelocations')) {
            $form_state->set('storelocations', 1);
        }
        $formValues = $form_state->get('storelocations');


        $form['country'] = [
            '#type' => 'select',
            '#title' => $this->t('Select your country'),
            '#default_value' => 'india',
            '#options' => $this->getCountryList(),
        ];

        $form['locations-wrapper'] = [
            '#prefix' => '<div id="locations-wrapper">',
            '#suffix' => '</div>',
        ];

        $locations = &$form['locations-wrapper'];
        $locations['#type'] = 'fieldset';
        $locations['#title'] = $this->t('Locations');
        $locations['#tree'] = true;

        if ($formValues) {
            for ($i = 0; $i < $formValues; $i++) {
                $locations[$i]['state'] = [
                    '#type' => 'textfield',
                    '#title' => $this->t('State'),
                    '#element_validate' => ['::validateAlphabet'],
                ];

                $locations[$i]['city'] = [
                    '#type' => 'textfield',
                    '#title' => $this->t('City'),
                    '#element_validate' => ['::validateAlphabet'],
                ];
            }
        }



        $form['add_another_location'] = [
            '#type' => 'submit',
            '#value' => t('Add A Location'),
            '#submit' => ['::addOne'],
            '#href' => '',
            '#ajax' => [
              'callback' => '::customAjaxAddLocation',
              'wrapper' => 'locations',
            ],
          ];

        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];
//  dump($formValues);
        return $form;
    }

    public function customAjaxAddLocation(array &$form, FormStateInterface $form_state) {
        $response = new AjaxResponse();
       $response->addCommand(new HtmlCommand('#locations-wrapper', $form['locations-wrapper']));
       return $response;
      }

      public function addOne(array &$form, FormStateInterface $form_state) {
        $formValues = $form_state->get('storelocations');
        $add_button = $formValues + 1;
        $form_state->set('storelocations', $add_button);
        $form_state->setRebuild();
      }


    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $country = $form_state->getValue('country');
        $this->messenger->addStatus($this->t('Selected country: @country', ['@country' => $country]));

        $locations = $form_state->getValue('locations');
        $this->messenger->addStatus('Below are the locations you have entered:');
         foreach ($form_state->getValue('locations') as $value) {
      for ($i = 0; $i < count($value); $i++) {
        // var_dump($value);
        $this->messenger->addMessage($value['state'] . "," . $value['city']);
      }
    }
    }


    protected function getCountryList()
    {
        $list = $this->countryManager->getList();
        $countries = [];
        foreach ($list as $key => $value) {
            $countries[$key] = $value->__toString();
        }
        // dump($list);
        return $countries;
    }

    public function validateAlphabet($element, FormStateInterface $form_state)
    {
        $value = $form_state->getValue($element['#parents']);
        if (!empty($value) && !ctype_alpha($value)) {
            $form_state->setError($element, $this->t('Please enter only alphabets.'));
        }
    }
}
