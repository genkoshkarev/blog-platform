<?php

namespace App\Controllers;

use App\Controller;
use App\Errors;

class Friends extends Controller
{

  protected function handle()
  {
    $this->view->display('friends');
  }

}