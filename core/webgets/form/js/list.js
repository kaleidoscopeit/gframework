$_.js.reg['02B0']={
  a:['optclass'],
  f:[],
  b:function(n){
    n=n.firstChild;

    with(n){
      
    $_.ade(n,'change', function(){
      var opt=this.copy(),i;
      this.selected=[];
      for(i in opt) this.selected.push(opt[i].value)
    }, false),
    
    n.copy = function(){
      var out=[],opt=this.options,i;
      for(i in opt) {
        if(opt[i].selected) out.push(opt[i]);}
      try{oncopy()} catch(e){};
      return out;
    },

    n._refresh = function(obj){
      this.values=[];
      this.captions=[];
      $_.each(this.options,function(o){
        p=o.parentNode;
        p.values.push(o.value);
        p.captions.push(o.text);       
      })
    },
    
    n.cut = function(){
      var out=[],opt=this.copy(),i;
      while(opt[0]) {
        this.options[opt[0].index] = null;
        out.push(opt.shift())
      }
      this._refresh();
      try{oncut()} catch(e){};
      return out;
    },

    n.paste = function(o){
      while(o[0]) this.add(o.shift());
      this._refresh();
      try{onpaste()} catch(e){};
    },

    n.clear = function(){
      while(this.length!=0)this.remove(0);
    },

    n.populate = function(v){
      if(v.length==null & $_.count(v) == 0)return false;
      n.clear();
      $_.tmp.n=n;
      $_.each(v,function(v,i){
        $_.tmp.n.item_push(v[0],(v[1]?v[1]:v[0]))
      })
      return true;
    },

    n.item_push = function(v,l){
      var no=$_.cre('option');
      no.className=n.parentNode.optclass;
      n.appendChild(no);
      no.value=v;
      no.text=(l?l:v);
    },
 
    n.sort = function(){
      var out=[],i,opt=this.options;
      for(i=0;i<opt.length;i++) out.push(opt[i]);
      out.sort(function(x,y) {
        var a=x.text,b=y.text,z=0;
        if (a>b) z=1;
        if (a<b) z=-1;
        return z;
      });
      this.clear();
      this.paste(out);       
    }
  }},
  
  fs:function(n){
  }
};