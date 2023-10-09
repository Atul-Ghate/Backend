<?php
namespace  Drupal\custom_service;

/**
* @file providing the service that generate random number between 1000 to 9999.
*
*/

class HelloServices {

 public function get_number()
 {
 	return rand(1000,9999);
 }

}