<?php

namespace Controller;

include '../helper/autoloader.php';

class Signin extends \Model\Signin
{
     public function __construct($postData)
     {
     }
}

$user = new \Controller\Signin($_POST);
