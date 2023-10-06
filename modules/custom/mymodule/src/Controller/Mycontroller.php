<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;


/**
 * Defines GetData class.
 */

class Mycontroller extends ControllerBase
{

    protected $data;

    public function __construct() {
        $this->data = \Drupal::service('mymodule.custom_services')->getGreeting();
    }

    public function Demo() {
        return new Response($this->data);
    }

    public function getName() {
        $result = 'Hello World!';
        return [
            '#type' => 'markup',
            '#markup' => $result . ' ' . $this->data,
        ];
    }

    public function getDisplayName($name) {
        return [
            '#type' => 'markup',
            '#markup' => 'Welcome ' . $name . ' ' . $this->data,
        ];
    }
}
