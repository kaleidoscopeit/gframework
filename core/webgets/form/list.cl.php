<?php
class form_list
{
  public $req_attribs = array(
    'style',
    'class',
    'field',
    'field_format',
    'values',
    'labels',
    'default',
    'wstyle',
    'wclass',
    'item_style',
    'item_class'
  );

  function __define(&$_)
  {
    if(isset($this->attributes['id']))
      $this->attributes['name'] = $this->attributes['id'];
  }

  function __flush(&$_)
  {
    /* Import static values from the view */
    if (isset($this->values)) {
      $this->items['values'] = explode('|', $this->values);
      $this->items['labels'] = explode('|', $this->labels);

      if (count($this->items['labels']) != count($this->items['values']))
          $this->items['labels'] = $this->items['values'];
    }

    /* builds syles */
    $style       = (isset($this->style) ? $this->style : '');
    $wstyle      = (isset($this->wstyle) ? $this->wstyle : '');
    $boxing      = (isset($this->boxing) ? $this->boxing : '');
    $item_style  = (isset($this->item_style) ? $this->item_style : '');

    $w_class  = 'class="w02B0 '
              . $_->ROOT->boxing($boxing)
              . $_->ROOT->style_registry_add($wstyle)
              . (isset($this->wclass) ? $this->wclass : '')
              . '" ';

    /* -- */
    $css_style  = $_->ROOT->style_registry_add($style)
                . (isset($this->class) ? $this->class : '');

    if($css_style!="") $css_style = 'class="' . $css_style . '" ';


    /* -- */
    $item_style = $_->ROOT->style_registry_add($item_style)
                . $this->item_class;

    if($item_style != '') $item_style = 'class="' . $item_style . '" ';

    /* builds special webget attributes list to be passed at the 'div' which
     * acts as envelope */
/*    $envelope_attriubtes->attributes = array(
      'define'        => $this->attributes['ondefine'],
      'contentchange' => $this->attributes['oncontentchange'],
      'ready'         => $this->attributes['ready'],
    );

    unset($this->attributes['ondefine']);
    unset($this->attributes['oncontentchange']);
    unset($this->attributes['ready']);*/

    /* builds code */
    $_->buffer[] = '<div  ' . $w_class . '>'
                 . '<select wid="02B0" opt' . $item_style
                 . $_->ROOT->format_html_attributes($this) . ' '
                 . 'multiple ' . $css_style . '>';



    if(isset($this->items['values'])) {
      foreach ($this->items['values'] as $key => $value) {
        $_->buffer[] = '<option value="' . $value . '" ' . $item_style
                     . ($this->default == $value ? 'selected' : '') . '>';
        $_->buffer[] = $this->items['labels'][$key];
        $_->buffer[] = '</option>';
      }
    }

    $_->buffer[] = '</select>';
    $_->buffer[] = '</div>';
  }



  function items_insert($value, $label = -1, $index = null)
  {
    $index = $index === null ? count($this->items['values']) : $index;
    $index = intval($index);

    $this->items['values'] = array_merge(
      ($this->items['values'] ?
        array_slice($this->items['values'], 0, $index) : array()),
      array("$value"),
      ($this->items['values'] ?
        array_slice($this->items['values'], $index) : array()));

    $this->items['labels'] = array_merge(
      ($this->items['labels'] ?
        array_slice($this->items['labels'], 0, $index) : array()),
      array(($label != -1 ? $label : $value)),
      ($this->items['labels'] ?
        array_slice($this->items['labels'], $index) : array()));
  }

  /* delete item by value or by index */
  function items_remove($item)
  {
    if (count($this->items['values']) == 0) return false;

    if (is_int($item) && $this->items['values'][$item]) {
      unset($this->items['values'][$item]);
      unset($this->items['labels'][$item]);
      return true;
    }

    if (is_string($item)) {
      foreach ($this->items['values'] as $key => $value) {
        if ($value === $item) {
          unset($this->items['values'][$key]);
          unset( $this->items['labels'][$key]);
          return true;
        }
      }
    }

    return false;
  }
}
?>
