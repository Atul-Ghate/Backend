<?php

namespace Drupal\mymodule;


/**
 * Class CustomService
 * @package Drupal\mymodule\Services
 */
class CustomService {

  /**
   * Get the greeting message based on the time of day.
   *
   * @return string
   *   The greeting message.
   */
  // public function getGreeting() {
  //   $current_time = \Drupal::time()->getCurrentTime();
  //   $hour = date('G', $current_time);

  //   if ($hour >= 6 && $hour < 12) {
  //     return 'Good Morning';
  //   } elseif ($hour >= 12 && $hour < 16) {
  //     return 'Good Afternoon';
  //   } elseif ($hour >= 17 && $hour < 21) {
  //     return 'Good Evening';
  //   } else {
  //     return 'Good Night';
  //   }

  // }

  public function getGreeting() {
    $config = \Drupal::config('mymodule.settings');
    $greeting_message_morning = $config->get('greeting_message_morning');
    $greeting_message_noon = $config->get('greeting_message_noon');
    $greeting_message_evening = $config->get('greeting_message_evening');
    $greeting_message_night = $config->get('greeting_message_night');
    // $time_of_day = $config->get('time_of_day');


    $current_time = \Drupal::time()->getCurrentTime();
    $hour = date('G', $current_time);

    if ($hour >= 6 && $hour < 12) {
      return $greeting_message_morning;
    } elseif ($hour >= 12 && $hour < 16) {
      return $greeting_message_noon;
    } elseif ($hour >= 17 && $hour < 21) {
      return $greeting_message_evening;
    } else {
      return $greeting_message_night;
    }
    // Determine the greeting message based on the time setting.
    // if ($time_of_day === 'morning') {
    //   return 'Good Morning, ' . $greeting_message_morning;
    // } elseif ($time_of_day === 'afternoon') {
    //   return 'Good Afternoon, ' . $greeting_message_noon;
    // } elseif ($time_of_day === 'evening') {
    //   return 'Good Evening, ' . $greeting_message_;
    // } elseif ($time_of_day === 'night') {
    //   return 'Good Night, ' . $greeting_message;
    // } else {
    //   return 'Unknown Time of Day, ' . $greeting_message;
    // }
  }

}


//6 am to 12 am = morning
//12 pm to 4 pm = noon
// 4 pm to 9 pm = eveining