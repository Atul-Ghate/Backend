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

    public function __construct()
    {
        $this->data = \Drupal::service('mymodule.custom_services')->getGreeting();
    }

    public function Demo()
    {
        return new Response($this->data);
    }


    public function showViewCount()
    {

        $node = \Drupal\node\Entity\Node::load(1);
        $view_count = \Drupal::state()->get('custom_node_views_count_' . $node->id(), 0);
        $output = [
            '#markup' => $this->t('This node has been viewed @count times.', ['@count' => $view_count]),
        ];

        return $output;
    }

    public function getName()
    {
        $result = 'Hello World!';
        return [
            '#type' => 'markup',
            '#markup' => $result . ' ' . $this->data,
        ];
    }

    public function getDisplayName($name)
    {
        return [
            '#type' => 'markup',
            '#markup' => 'Welcome ' . $name . ' ' . $this->data,
        ];
    }
}
