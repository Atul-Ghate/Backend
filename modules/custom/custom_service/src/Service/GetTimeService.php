<?php
namespace Drupal\custom_service\Service\GetTimeService;

/**
 * Service to determine the time of day and provide greetings.
 */
class GetTimeService {

  /**
   * Get the greeting message based on the time of day.
   *
   * @return string
   *   The greeting message.
   */
  public function getGreeting() {
    $current_time = \Drupal::time()->getCurrentTime();
    $hour = date('G', $current_time);

    if ($hour >= 6 && $hour < 12) {
      return 'Good Morning';
    } elseif ($hour >= 12 && $hour < 16) {
      return 'Good Afternoon';
    } elseif ($hour >= 17 && $hour < 21) {
      return 'Good Evening';
    } else {
      return 'Good Night';
    }
  }
}
