<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;
use App\Models\User;
use App\Errors;

class Profile extends Controller
{

  public function access(): bool
  {
    // return isset($_GET['role']) && 'admin' == $_GET['role'];
    return true;
  }

  protected function handle()
  {
    $article = new Article;
    $User_profile = new User;
    $username = $_GET['username'] ?: $_SESSION['user']["name"];
    $this->view->user_profile = $User_profile->findAllBy("name = '$username'")[0];

    if ($this->view->user_profile === NULL) {
      redirect('/NotFound');
    };

    $this->setMeta();
    $tag = $_GET["tag"];
    $this->view->articles = $article->findAll_Author_Tags();

    if ($tag) {
      $this->view->h1 = "с тегом #$tag";
    }
    $this->setMeta();
    $this->setCss('index');
    $this->setCss('profile');
    $this->view->display('profile');
  }


  protected function setMeta()
  {
    $this->meta->title = $this->view->article->title;
    $this->meta->description = $this->view->article->description;
    $this->meta->keywords = $this->view->article->keywords;
    $this->meta->author = $this->view->article->author;
    $this->view->meta = $this->meta;
  }

  protected function title()
  {
    return "Indyground";
  }

  protected function description()
  {
    return "Indyground - сайт о создателях игр, музыки, графики и всего осталнього творчества";
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
