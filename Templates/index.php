<div class="container-lg">

  <h1 id="title">Последние посты <?=$this->h1; ?></h1>
  <p>

  </p>

  <div class="articles">

    <? if (count($this->articles) === 0) : ?>
    <article class="article">Пока статей нет</article>

    <? endif ?>

    <? foreach ($this->articles as $article) : ?>
      
      <article class="article">
        <a href="/article/?id=<?=$article->id; ?>" class="article-item article-picture">
          <picture>
            <source type="image/webp"
              srcset="/img/static/post_template.wepb"
              data-src="/img/load/min/<?=$article->image;?>.webp">
            <img
              src="/img/static/post_template.png"
              data-src="/img/load/<?=$article->image.".".$article->image_type; ?>"
              alt="<?=$article->image ?>"
            >  
          </picture>
        </a>

        <div class="article-item article-info">

          <div class="article-info-meta">
            
            <time datetime="<?=$article->datetime ?>" class="article-date">
            <?=$article->datetime ?>
            </time>
  
            <ul class="article-tags" aria-label="Tags">
              <? foreach (array_filter( explode(",",$article->tags) ) as $tag) : ?>
              <li>
                <a href="/index/?tag=<?=$tag; ?>" class="article-tag" aria-label="<?=$tag; ?>">#<?=$tag ?></a>
              </li>
              <? endforeach ?>

            </ul>

          </div>

          <h2>
            <a href="/article/?id=<?=$article->id ?>"><?=$article->title ?></a>
          </h2>
          

          <a href="/profile/?username=<?=$article->username ?>" class="article-author">
              <picture>
                <img 
                  src="/img/static/post_template.png"
                  data-src="/img/static/ava.png"
                  alt="<?=$article->username?>">
              </picture>
              <?=$article->username?>
          </a>


          <p><?=$article->description ?></p>

        </div>
    
      </article>
    
    <? endforeach ?>
    
  </div>

</div>
