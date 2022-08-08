<header class="author-page__header">
  <div class="container-lg">
    <h2>Автор</h2>
    <div class="article-author">
      <picture>
        <img src="/img/static/ava.png" data-src="/img/static/ava.png" alt="qwe">
      </picture>
      <h1><?= $this->user_profile->name; ?></h1>
    </div>
    <p>Веб-разработчик из Сахалина. Играю в jrpg, создаю jrpg, пишу статьи и уроки. Для связи пишите в личные сообщения или на почту asd@mail.ru</p>

    <ul class="author-page__menu">
      <li><a href="/" class="active">Инфо</a></li>
      <li><a href="/">Статьи</a></li>
      <li><a href="/">Плагины</a></li>
      <li><a href="/">Статьи</a></li>
      <li><a href="/">Текст</a></li>
      <li><a href="/">Картинки</a></li>

    </ul>
  </div>

</header>

<div class="container-lg">
  <h1>Последние посты автора <?= $this->user_profile->name; ?> <?= $this->h1; ?></h1>
  <div class="articles">

    <? foreach ($this->articles as $article) : ?>

      <article class="article">
        <a href="/article/?id=<?= $article->id; ?>" class="article-item article-picture">
          <picture>
            <source type="image/webp" srcset="/img/static/post_template.wepb" data-src="/img/load/min/<?= $article->image; ?>.webp">
            <img src="/img/static/post_template.png" data-src="/img/load/<?= $article->image . "." . $article->filetype; ?>" alt="<?= $article->image ?>">
          </picture>
        </a>

        <div class="article-item article-info">

          <div class="article-info-meta">

            <time datetime="<?= $article->datetime ?>" class="article-date">
              <?= $article->datetime ?>
            </time>

            <ul class="article-tags" aria-label="Tags">
              <? foreach (array_filter(explode(",", $article->tags)) as $tag) : ?>
                <li>
                  <a href="/profile/?tag=<?= $tag; ?>&username=<?= $this->username ?>" class="article-tag" aria-label="<?= $tag; ?>">#<?= $tag ?></a>
                </li>
              <? endforeach ?>

            </ul>

          </div>

          <h2>
            <a href="/article/?id=<?= $article->id ?>"><?= $article->title ?></a>
          </h2>


          <a href="/profile/?username=<?= $article->username ?>" class="article-author">
            <picture>
              <img src="/img/static/post_template.png" data-src="/img/static/ava.png" alt="<?= $article->username ?>">
            </picture>
            <?= $article->username ?>
          </a>


          <p><?= $article->description ?></p>

        </div>

      </article>

    <? endforeach ?>

  </div>

</div>