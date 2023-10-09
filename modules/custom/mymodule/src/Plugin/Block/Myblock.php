<?php
namespace Drupal\mymodule\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block with the current time in different timezones.
 *
 * @Block(
 *   id = "current_time_block",
 *   admin_label = @Translation("Current Time Blocks"),
 *   category = @Translation("Examples")
 * )
 */
class MyBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $output = [];

    date_default_timezone_set('Asia/Kolkata'); // Indian Standard Time
    $output[] = [
      '#markup' => '<p>Indian Standard Time: ' . date('Y-m-d H:i:s') . '</p>',
    ];

    date_default_timezone_set('America/New_York'); // Eastern Standard Time
    $output[] = [
      '#markup' => '<p>Eastern Standard Time: ' . date('Y-m-d H:i:s') . '</p>',
    ];

    date_default_timezone_set('America/Chicago'); // Central Standard Time
    $output[] = [
      '#markup' => '<p>Central Standard Time: ' . date('Y-m-d H:i:s') . '</p>',
    ];

    return $output;
  }

}
