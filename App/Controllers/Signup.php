<?php

namespace App\Controllers;

use App\Controller;
use App\Errors;
use App\Db;

use App\Models\User;

class Signup extends Controller
{

  protected function handle()
  {
    if (!empty($_POST)) {
      $this->signupAction();
      die;
    }

    $this->view->countSql = Db::$countSql;

    $this->setMeta();
    $this->view->display('signup');
  }


  public function signupAction()
  {
    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['name'])) {
      $user = new User();
      $data = $_POST;
      $user->load($data);

      if (!$user->validate($data) || !$user->checkUnique()) {
        $user->getErrorsValidate();
        $_SESSION['form_data'] = $data;
        redirect();
      }

      $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
      $id = $user->save();
      if ($id) {
        $_SESSION['success'] = 'Вы успешно зарегистрированыю Войдите на сайт';
        redirect('/login');
      } else {
        $_SESSION['error'] = 'Ошибка! Попробуте позже';
      }

      redirect();
    }
  }

  protected function setMeta()
  {
    $this->meta->title = $this->title();
    $this->meta->description = $this->description();
    $this->meta->keywords = $this->keywords();
    $this->meta->author = $this->author();
    $this->view->meta = $this->meta;
  }

  protected function title()
  {
    return "Зарегистрироваться в Indyground";
  }

  protected function description()
  {
    return "Зарегистрироваться в Indyground - сайте о создателях игр, музыки, графики и всего осталнього творчества";
  }

  protected function keywords()
  {
    return "Indyground, инди, RPG maker";
  }

  protected function author()
  {
    return "Yuryol";
  }
}
