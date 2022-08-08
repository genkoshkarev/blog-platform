<?

namespace App;

class View implements \Countable, \ArrayAccess
{
  protected $data = [];
  protected $css = [];
  protected $js = [];
  protected $fonts = [];

  public function __set($name, $value): void
  {
    $this->data[$name] = $value;
  }

  public function __get($name)
  {
    return $this->data[$name] ?? null;
  }

  public function __isset($name)
  {
    return isset($this->data[$name]);
  }

  public function render($template)
  {
    ob_start();
    include $template;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
  }

  public function display($template, $layout = 'default')
  {
    $template = __DIR__ . "/../Templates/$template.php";
    $layout = __DIR__ . "/../Templates/layouts/$layout.php";
    $this->content = $this->render($template);
    echo $this->render($layout);
  }

  public function setCss($css): void
  {
    $this->css[] = $css;
  }

  public function displayCss(): string
  {
    $styles = "";
    foreach ($this->css as $value) {
      $styles .= "<link rel='stylesheet' href='/css/$value.css'>\n";
    }
    return $styles;
  }

  public function setFonts($fonts): void
  {
    $this->fonts[] = $fonts;
  }

  public function displayFonts(): string
  {
    $fonts = "";
    foreach ($this->fonts as $value) {
      $fonts .= "<link href='https://fonts.googleapis.com/icon?family=$value;display=block' rel='stylesheet'>\n";
    }
    return $fonts;
  }

  public function setJs($js, $is_defer = true): void
  {
    $this->js[] = [
      'file' => $js,
      'is_defer' => $is_defer,
    ];
  }

  public function displayJs(): string
  {
    $scripts = "";
    foreach ($this->js as $value) {
      $file = $value['file'];
      $defer = ($value['is_defer'] === true) ? 'defer' : '';
      $scripts .= "<script src='/js/$file.js' nonce='jD9cn17SAd3wc3Sasdfn939hc3x' $defer></script>\n";
    }
    return $scripts;
  }

  public function count(): int
  {
    return count($this->data);
  }

  public function offsetSet($offset, $value): void
  {
    $this->data[$offset] = $value;
  }

  public function offsetExists($offset): bool
  {
    return isset($this->data[$offset]);
  }

  public function offsetUnset($offset): void
  {
    unset($this->data[$offset]);
  }

  public function offsetGet($offset)
  {
    return  $this->data[$offset] = $value ?? null;
  }
}
