<?php

namespace App\Controllers;

use App\Controller;
use App\Errors;

class Create extends Controller
{

  protected function handle()
  {
    // if (!empty($_POST)) {
    //   $this->creatArticle();
    //   die;
    // }


    $this->setMeta();
    $this->view->setCss('image');
    $this->view->setCss('badges');
    $this->view->setJs('badges');
    $this->view->setJs('image');
    $this->view->display('create');
  }

  protected function creatArticle(){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tags = $_POST['tags'];
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
    return "Создать статью в Indyground";
  }

  protected function description()
  {
    return "Создать статью в Indyground - сайт о создателях игр, музыки, графики и всего осталнього творчества";
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