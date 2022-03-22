<?php

namespace Model;

class Message extends \config\DbConn
{
     private $data = [];

     protected function __construct($data)
     {
          $this->data = $data;
     }


}