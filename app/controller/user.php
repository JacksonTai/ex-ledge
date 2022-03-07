<?php

namespace Controller;

include '../../helper/autoloader.php';

class User extends \Model\User
{
     public function __construct($userId = null)
     {
          parent::__construct($userId);
     }

     public function read()
     {
          return $this->getUser();
     }
}
