<?php
namespace Drupal\custom_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;


/**
 * Defines GetData class.
 */

 class GetData extends ControllerBase {

  public function getData(){

    // dump('atul');
    // exit;
    // return [
    //     '#type' => 'markup',
    //     '#markup' => $this->t('Hello, World!'),
    //   ];

      $client = \Drupal::httpClient();

      $response = $client->get('https://catfact.ninja/fact');

      $result = $response->getBody()->getContents();

    //   dump(get_class_methods($response));

      return [
            '#type' => 'markup',
            '#markup' => $result,
          ];
    //   dump($result);
    //   exit;
    //   return $response;
  }


  public function Demo() {

    $service = \Drupal::service('custom_api.test');
    $data = $service->get_number();
  dump($data);
  exit;
    return new Response($data);


  }

 }