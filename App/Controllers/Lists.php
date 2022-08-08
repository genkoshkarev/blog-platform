<?php

namespace App\Controllers;

use App\Controller;
use App\Errors;

class Lists extends Controller
{

  protected function handle()
  {
    $this->view->display('lists');
  }

}