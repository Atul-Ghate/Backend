<?php
namespace Drupal\custom_service\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\custom_service\Services\GetTimeService;
use Drupal\Component\Datetime\TimeInterface;
use Drupal\custom_service;
// use Drupal\custom_service\Services\GetTimeService;

class DisplayName extends ControllerBase {

 public function getName(){



    // $timeService = \Drupal::service('custom_service.test');
    // $greeting = $timeService->getGreeting();

    // dump($greeting);
    // exit;

     $result = 'HELLO WORD';

    return [
        '#type' => 'markup',
        '#markup' => $result,
      ];

 }

public function getDisplayName($name){

    return [
        '#type' => 'markup',
        '#markup' => 'Wellcome '. $name,
      ];

}


public function demo(){

    $service = \Drupal::service('custom_api.test');
    echo $test = $service->get_number();

    // $test = 11;
    // dump($test);
    // exit;
}


// public function getTimeBasedGreeting($name) {
//     $current_time = \Drupal::time()->getCurrentTime();
//     $hour = date('G', $current_time);

//     if ($hour >= 6 && $hour < 12) {
//      return new Response('Hello Good Morning ' . $name);
//     } elseif ($hour >= 12 && $hour < 16) {
//      return new Response('Hello Good afternoon ' . $name);
//     } elseif ($hour >= 17 && $hour < 21) {
//       return new Response('Hello Good evining ' . $name);
//     } else {
//     return new Response('Hello Good night ' . $name);
//     }
//   }




//    public $timeService;

//     public function __construct(GetTimeService $timeService) {
//         $this->timeService = $timeService;
//       }

      public function someMethod() {
        // Use $this->timeService to access the GetTimeService.
        $service = \Drupal::service('custom_service.test');
        $greeting = $service->getGreeting();

        dump($greeting);
        exit;

      }

}