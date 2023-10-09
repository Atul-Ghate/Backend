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

  }

}
