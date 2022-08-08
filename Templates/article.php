<div class="container-u article">

  <picture class="article-item article-picture">
    <source type="image/webp" srcset="/img/static/post_template.wepb" data-src="/img/load/<?= $this->article->image; ?>.webp">
    <img src="/img/static/post_template.png" data-src="/img/load/<?= $this->article->image . "." . $this->article->image_type ?>" alt="<?= $this->article->image ?>">
  </picture>
  
  <div class="article-item article-info">


    <ul class="breadcrumbs">
			<li><a href="asd" class="details">Статьи / </a></li>
			<li><a href="/index/?category=<?=$this->article->category ?>" class="details"><?=$this->article->category_name ?></a></li>
		</ul>

    <h1 id="title">
      <?=$this->article->title ?>
    </h1>

    <a href="/profile/?id=<?=$this->article->username ?>" class="article-author">
        <picture>
          <img 
            src="/img/static/post_template.png"
            data-src="/img/static/ava.png"
            alt="<?=$this->article->username?>">
        </picture>
        <?=$this->article->username?>
    </a>
    
    <div class="article-info-meta">
      
      <time datetime="<?=$this->article->datetime ?>" class="article-date">
      <?=$this->article->datetime ?>
      </time>

      <ul class="article-tags" aria-label="Tags">
        <? foreach (array_filter( explode(",",$this->article->tags) ) as $tag) : ?>
        <li>
          <a href="/index/?tag=<?=$tag ?>" class="article-tag" aria-label="<?=$tag ?>">#<?=$tag ?></a>
        </li>
        <? endforeach ?>
      </ul>
    </div>
  </div>

</div>

<div class="container">
  
  <div class="info-action">
  <div class="info-action-wrapper">
    <div class="icon action <?=($this->article->like!=1)?'noactive':''; ?>" onclick="add(this, <?=$this->article->id ?>, 'articles')">
      <p> <?=$this->article->sum_likes; ?> </p>
      <i class="material-icons"> favorite </i>
    </div>  
		
    <a href="article.php?id=2#comments" class="icon noactive" onclick="">
      <p> 0 </p>
      <i class="material-icons"> comment </i>
    </a>  
		
    <div class="icon action <?=($this->article->bookmark!=1)?'noactive':''; ?>" onclick="add(this, <?=$this->article->id ?>, 'articles', 'bookmarks')">
      <p> <?=$this->article->sum_bookmarks; ?> </p>
      <i class="material-icons"> bookmark </i>
    </div>  
		
		<div class="nav-item menu">
			<a class="icon action noactive y-dropdown-toggle">
				<i class="material-icons"> menu </i>
			</a>
			<ul class="nav-dropdown y-dropdown-menu" style="display: none;">
				<li><a href="index.php?complain=1&amp;id=2">Пожаловаться</a></li>
			</ul>
	    </div>
	</div>
	</div>


  <div class="description container-plus">
    <p><?=$this->article->description ?></p>
    <div class="dop-info">
      <cite><?=$this->article->datetime ?></cite>
      <cite>время чтения: 4 мин.</cite>
    </div>
  </div>
  
  <article>
    <? foreach ($this->contents as $content) : ?>
      <? if  ($content->tag == 'img') : ?>
      <figure>
        <img src="<?=$content->src ?>" alt="<?=$content->alt ?>">
        <figcaption><?=$content->alt ?></figcaption>
      </figure>
        
        <? else : ?>

      <<?=$content->tag?>>
      <?=$content->html?>
      </<?=$content->tag?>>
      
      <? endif ?>
    <? endforeach ?>

    <hr>
    <p style="text-align: center;">* * *</p>
  </article>
</div>


<section id="comment-form">
  <section class="section container">
    <h2 class="section-title">Добавить комментарий</h2>
    <cite class="section-left"></cite>
    <div>
      <label for="text" class="">Текст<span class="red">*</span>:</label>
      <textarea type="text" name="textComment" id="textComment" rows="3" placeholder="Текст" class=" " autocomplete="off" required=""></textarea>
      <button id="createComment" class="btn btn-bgc" onclick="create_comment(<?=$this->article->id ?>)">Отправить</button>
    </div>
  </section>
</section>
    