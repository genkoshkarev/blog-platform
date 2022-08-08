<?php

namespace App\Controllers;

use App\Controller;
use App\Errors;

class Messages extends Controller
{

  protected function handle()
  {
    $this->view->display('messages');
  }

}