$_.js.reg['0311']={
	a:['eval_field','eval_field_command','show_if'],
	f:['ready'],
	b:function(n){with(n){
		n.refresh=function(){
			fs = $$._getFormattedFields(n.eval_field,n.eval_field_command);
			if(fs !== false) eval(fs);
		};
	}},
	fs:function(n){
	  n.dispatchEvent(n.ready);
  }
};
