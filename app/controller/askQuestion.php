<?php

namespace Controller;

include '../../helper/autoloader.php';

class AskQuestion extends \Model\AskQuestion
{
     public function __construct($postData)
     {
        parent::__construct($postData);
     }


}
