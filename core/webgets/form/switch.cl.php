<?php
class form_switch {
  
	function __construct(&$_, $attrs)
	{
    /* imports properties */
		foreach ($attrs as $key=>$value) $this->$key=$value;
		
    /* flow control server event */
    eval($this->ondefine);
 	}
	
	function __flush (&$_)
	{
    /* flow control server event */
    eval($this->onflush);

    /* no paint switch */    
    if ($this->nopaint) return;

		$css_style = $_->ROOT->boxing($this->boxing).$_->ROOT->style_registry_add($style).$this->class;
		if($css_style!="") $css_style = 'class="'.$css_style.'" ';
	
	
		$_->buffer .=	'<div id="'.$this->id.'" wid="0290" '.
							($this->disabled ? 'disabled="disabled" ' : '').
							$css_style.
							'>'.
								'<input name="'.$this->id.'" type="text" value=""></input>'.
								'<span>'.
									'<span>ON</span>'.
									'<span>OFF</span>'.
								'</span>'.
								'<div>'.
									'<button type="button" disabled></button>'.
								'</div>'.
								'<div '.
								$_->ROOT->format_html_events($this, array('mouse')).
								($this->tip ? 'title="'.$this->tip.'" ' : '').
								'></div>'.
							'</div>';
	}	
}
?>


