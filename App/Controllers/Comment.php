<?php

namespace App\Controllers;

use App\Controller;
use App\Errors;

class Comment extends Controller
{

  protected function handle()
  {
    $this->view->display('comments');
  }

  

}