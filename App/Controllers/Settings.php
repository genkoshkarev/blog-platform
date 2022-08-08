<?php

namespace App\Controllers;

use App\Controller;
use App\Errors;

class Settings extends Controller
{

  protected function handle()
  {
    $this->view->display('settings');
  }

}