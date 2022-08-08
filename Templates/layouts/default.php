<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <!-- <meta http-equiv="Content-Security-Policy" content="Content-Security-Policy: default-src 'self'; script-src 'self' 'nonce-jD9cn17SAd3wc3Sasdfn939hc3x'"> -->

  <title><?= $this->meta->title; ?></title>
  <meta name="description" content="<?= $this->meta->description; ?>">
  <meta name="keywords" content="<?= $this->meta->keywords; ?>">
  <meta name="author" content="<?= $this->meta->author; ?>">

  <link rel="shortcut icon" href="/img/static/favicon.png" type="image/png">


  <link rel="stylesheet" href="/css/reset.css">
  <link rel="stylesheet" href="/css/root.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/footer.css">


  <?= $this->displayCss(); ?>

  <script src="/js/handlers.js" defer></script>
  <script src="/js/navbar.js" defer></script>

  <script src="/js/lazyLoads.js" defer></script>
  <script src="/js/progressBar.js" defer></script>
  <script src="/js/preloader.js" defer></script>

  <?= $this->displayFonts(); ?>
  <?= $this->displayJs(); ?>
</head>

<body>

  <nav class="nav menu">
    <a href="#title" class="button-scroll-up">^</a>
    <a href="/" class="nav-logo">
      <span>indy_ground</span>
    </a>

    <div class="nav-mobile">
      <div id="nav-toggle">
        <span></span>
      </div>
    </div>

    <ul class="nav-list">

      <li class="nav-item">
        <a href="#!" class="y-dropdown-toggle">Создать</a>
        <ul class="nav-dropdown y-dropdown-menu">
          <li class="nav-dropdown-item"><a href="/createPost">Статьи</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="#!" class="y-dropdown-toggle">Статьи</a>
        <ul class="nav-dropdown y-dropdown-menu">
          <!-- <li class="nav-dropdown-item"><a href="/last">Последнее</a></li> -->
          <li class="nav-dropdown-item"><a href="/index">Все</a></li>
          <li class="nav-dropdown-item"><a href="/index/?category=1">Код</a></li>
          <li class="nav-dropdown-item"><a href="/index/?category=2">Графика</a></li>
          <li class="nav-dropdown-item"><a href="/index/?category=3">Текст</a></li>
          <li class="nav-dropdown-item"><a href="/index/?category=4">Музыка</a></li>
          <li class="nav-dropdown-item"><a href="/index/?category=5">Прочее</a></li>
          <!-- <li class="nav-dropdown-item"><a href="/books">Картинки</a></li> -->
        </ul>
      </li>

      <li class="nav-item">

        <? if ($this->is_user) : ?>
          <a href="#!" class="y-dropdown-toggle">
            <?= $this->user['name'] ?>
          </a>
          <ul class="nav-dropdown y-dropdown-menu">
            <li class="nav-dropdown-item">
              <a href="/profile">
                Профиль <?= $this->user['name']; ?>
              </a>
            </li>
            <!-- <li class="nav-dropdown-item"><a href="/messages">Личные сообщения</a></li> -->
            <!-- <li class="nav-dropdown-item"><a href="/friends">Друзья</a></li> -->
            <!-- <li class="nav-dropdown-item"><a href="/comments">Комментарии</a></li> -->
            <li class="nav-dropdown-item"><a href="/index/?bookmarks=1">Закладки</a></li>
            <!-- <li class="nav-dropdown-item"><a href="/index/?bookmarks=1">Закладки (2)</a></li> -->
            <li class="nav-dropdown-item"><a href="/index/?likes=1">Любимое</a></li>
            <!-- <li class="nav-dropdown-item"><a href="/index/?likes=1">Любимое (2)</a></li> -->
            <li class="nav-dropdown-item"><a href="settings">Настройки</a></li>
            <li class="nav-dropdown-item"><a href="/logout">Выйти</a></li>
          </ul>

        <? else : ?>
          <a href="/login" class="y-dropdown-toggle">Войти</a>
        <? endif; ?>

      </li>

      <? if ($this->is_admin) : ?>
        <li class="nav-item">
          <a href="#!" class="y-dropdown-toggle">
            Админ
          </a>
          <ul class="nav-dropdown y-dropdown-menu">
            <li class="nav-dropdown-item"><a href="/lists/?user">Список пользователей</a></li>
            <li class="nav-dropdown-item"><a href="/lists/?articles">Список статей</a></li>
            <li class="nav-dropdown-item"><a href="/lists/?images">Список картинок</a></li>
            <li class="nav-dropdown-item"><a href="/lists/?comments">Список комментариев</a></li>
          </ul>
        </li>
      <? endif; ?>

      <li><a href="#!">О нас</a></li>
    </ul>
  </nav>

  <div class="progress-container">
    <div class="progress-bar" id="myBar" style="width: 0%;"> </div>
  </div>

  <div class="center">
    <div class="preloader"></div>
  </div>

  <section class="content">
    <?= $this->content; ?>
  </section>

  <footer>
    <div class="container clearfix">
      <ul>
        <li><span>Категории<span></span></span></li>
        <li class="nav-dropdown-item"><a href="/index/?category=1">Код</a></li>
        <li class="nav-dropdown-item"><a href="/index/?category=2">Графика</a></li>
        <li class="nav-dropdown-item"><a href="/index/?category=3">Текст</a></li>
        <li class="nav-dropdown-item"><a href="/index/?category=4">Музыка</a></li>
        <li class="nav-dropdown-item"><a href="/index/?category=5">Прочее</a></li>

      </ul>
      <ul>
        <li><span>Создать<span></span></span></li>
        <li><a href="#0">Статью</a></li>
      </ul>
      <ul>
        <li><span>Мой профиль<span></span></span></li>
        <li class="nav-dropdown-item"><a href="/index/?bookmarks=1">Закладки</a></li>
        <li class="nav-dropdown-item"><a href="/index/?likes=1">Любимое</a></li>
        <li class="nav-dropdown-item"><a href="settings">Настройки</a></li>
        <li class="nav-dropdown-item"><a href="/logout">Выйти</a></li>
      </ul>
    </div>
    <div class="footer__newsletter_copy">© Дизайн и создание <a href="https://twitter.com">@testname</a> 2022</div>
  </footer>

</body>

</html>