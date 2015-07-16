<?php
class wman_dialog
{
  public $req_attribs = array(
    'style',
    'class'
  );

  function __define(&$_)
  {
  }

  function __flush(&$_)
  {
    /* builds syles */
    $style  = (isset($this->style) ? $this->style : '');
    $boxing = (isset($this->boxing) ? $this->boxing : '');

    $css_style = 'class="w0510 '
               . $_->ROOT->boxing($boxing)
               . $_->ROOT->style_registry_add($style)
               . $this->class
               . '" ';

    /* builds code */
    $_->buffer[] = '<div wid="0510" '
                 . $css_style
                 . $_->ROOT->format_html_attributes($this)
                 . '> ';

    gfwk_flush_children($this);

    $_->buffer[] = '</div>';
  }

}
?>
