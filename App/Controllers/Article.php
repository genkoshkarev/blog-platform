<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Like;
use App\Models\Bookmark;
use App\Models\Comment;

// use App\Controllers\Article as ControllersArticle;

class Article extends Controller
{

  public function access(): bool
  {
    if (isset($_POST['createComment'])) {
      $this->createComment($_GET['id']);
      die;
    } else if (!empty($_POST)) {
      $this->add();
      die;
    }
    // return isset($_GET['role']) && 'admin' == $_GET['role'];
    return true;
  }

  protected function handle()
  {
    $article = new \App\Models\Article();
    $Content = new \App\Models\Content();

    $this->view->article = $article->findById($_GET['id']);

    if ($this->view->article === null) {
      redirect('/NotFound');
    };

    $this->view->contents = $Content->getContent($_GET['id']);
    // $content_array = $Content->getContent($_GET['id']);    
    // $this->view->content = $this->getContent($content_array);

    $this->setMeta();
    $this->view->setJS('add');
    $this->view->setCss('icon');
    $this->view->setCss('article');
    $this->view->setCss('highlighting');
    $this->view->display('article');
  }

  protected function createComment($id)
  {
    $comment = new Comment();
    $data = $_POST;
    $comment->load($data);

    if (!$comment->validate($data)) {
      $errors = [];
      $errors[] = "error";
      $errors[] = $comment->getErrorsValidate();
      echo json_encode($errors, JSON_UNESCAPED_UNICODE);
      die;
    }

    $comment->attributes['author'] = $_SESSION['user']["id"];
    $comment->attributes['article_id'] = $_GET['id'];
    $id = $comment->save();
    $comments = $comment->findAllBy("article_id=" . $_GET['id']);
    $comments = json_encode($comments, JSON_UNESCAPED_UNICODE);

    if ($id) {
      $message = [];
      $message[] = "success";
      $message[] = "Создан комментарий" . $id;
      $message[] = $comments;
      echo json_encode($message, JSON_UNESCAPED_UNICODE);
    } else {
      $errors = [];
      $errors[] = "error";
      $errors[] = 'Ошибка! Попробуйте позже';
      echo json_encode($errors, JSON_UNESCAPED_UNICODE);
    }
  }


  protected function add()
  {
    $data = $_POST;
    $like = ($data['action'] == 'likes') ? new Like() : new Bookmark();
    $like->load($data);
    $like->attributes['user'] = $_SESSION['user']["id"];

    if ($like->attributes['user'] == '') {
      $_SESSION['message'] = "Зарегистрируйтесь, чтобы добавлять в 'избранное' и 'закладки'!";
      echo json_encode(array(
        'user' => 0
      ));
      die;
    }


    $id = $like->add();

    if ($id) {
      $likes = $like->getCount();
      $sum = $likes[0]->sum;
      $isLike = $likes[0]->is_state;
      echo json_encode(array(
        0 => 'success',
        'state' => $isLike,
        'count' => $sum
      ), JSON_UNESCAPED_UNICODE);
    } else {
      $errors = [];
      $errors[] = "error";
      $errors[] = 'Ошибка! Попробуте позже';
      echo json_encode($errors, JSON_UNESCAPED_UNICODE);
    }
  }
  // protected function getContent($contents)
  // {
  //   $html = '';
  //   foreach ($contents as $content) {
  //     $tag = $content->html;
  //     $tag = $content->tag;
  //     // $div = "<p>html</p>";
  //     $div = "<$tag>$html</$tag>";
  //     $html .= $div;
  //   }
  //   return $html;
  // }

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
