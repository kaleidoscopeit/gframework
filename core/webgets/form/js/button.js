$_.js.reg['0250'] = {
	a:['field','field_format','eval_field','eval_field_command'],
	f:['define','flush'],
  b:function(n) {
		n.refresh=function(){
			fs = $$._getFormattedFields(n.eval_field,n.eval_field_command);
			if(fs !== false) eval(fs);
			fs = $$._getFormattedFields(n.field,n.field_format);
			if(fs !== false) n.value=fs;
		};
//console.log(n.define);
		n.dispatchEvent(n.define);
  },
  fs:function(n) {
	  n.dispatchEvent(n.flush);
  }
};
