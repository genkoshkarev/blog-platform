<div class="container">
  <h1>Редактор</h1>
  <div id="editor"></div>

</div>
<script>
  let editor = new Editor("editor");
</script>


<div class="popup popup-article-info">
  <div class="popup-article-info-box popup-box">
    <div class="input__wrapper">
      <label class="label">Заголовок</label>
      <input id="popup-article-info-title" class="input" type="text" placeholder="Введите название статьи" value="" />
    </div>

    <div id="popup-article-info-preview">
      <img id="popup-article-info-img" class="big dark flat">
      <button id="popup-article-info-input" class="button">Добавить превью</button>
      <button id="popup-article-info-delete" class="button">Удалить превью</button>
    </div>

    <div class="input__wrapper">
      <label class="label">Описание</label>
      <textarea id="popup-article-info-description" class="textarea" type="text" placeholder="Расскажите, о чем статья" class="no-enter"></textarea>
    </div>

    <div class="input__wrapper">
      <label class="label">Категория</label>
      <select id="popup-article-info-category" class="select" type="text" placeholder="Placeholder">
        <option value="1">Код</option>
        <option value="2">Графика</option>
        <option value="3">Текст</option>
        <option value="4">Музыка</option>
        <option value="5">Прочее</option>
      </select>
    </div>

    <div class="input__wrapper">
      <label class="label">Теги</label>
      <input id="popup-article-info-tags" class="input" type="text" name="example" list="exampleList" placeholder="Введите тег, нажмите 'Enter'" />
      <datalist id="exampleList">
        <option value="js"></option>
        <option value="go"></option>
      </datalist>

      <section id="popup-article-info-badges" class="badges"></section>
    </div>

    <div class="alert"></div>

    <div id="" class="buttons">
      <button id="popup-article-info-save" class="button medium maxwidth dark">
        Опубликовать
      </button>
      <button class="button maxwidth medium accent3 cancel">Отмена</button>
    </div>
  </div>
</div>