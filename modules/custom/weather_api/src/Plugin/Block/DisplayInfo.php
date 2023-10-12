<?php

namespace Drupal\weather_api\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Temperature' Block.
 *
 * @Block(
 *   id = "weather_info_block",
 *   admin_label = @Translation("Weather block"),
 * )
 */
class DisplayInfo extends BlockBase
{

  public function build()
  {
    $config = \Drupal::config('weather_settings.settings');

    $country = $config->get('country');
    $city = $config->get('city');
    $apikey = $config->get('api_key');
    $apiendpoint = $config->get('api_endpoint');

    $service_url = "https://" . $apiendpoint . '?q=' . $city . ',' . $country . '&appid=' . $apikey;
    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $curl_response = curl_exec($curl);
    curl_close($curl);
    // dump($curl_response);
    // exit;
    $output = json_decode($curl_response);


    // Access the temperature from the 'main' object.
    $temperature = $output->main->temp;

    // Convert the temperature from Kelvin to Celsius (or Fahrenheit, if needed).
    $temperatureCelsius = $temperature - 273.15; // Convert from Kelvin to Celsius

    // Round the temperature to two decimal places.
    $temperatureCelsius = round($temperatureCelsius, 2);

    // Output the temperature in a readable format.
    // echo "The temperature in Kolkata is " . $temperatureCelsius . "°C";
    return [
      '#markup' => $this->t('The temperature of the @city is : @number °C', ['@city'=>$city,'@number' => $temperatureCelsius]),
      '#cache' => ['max-age' => 0],
    ];

  }

}
