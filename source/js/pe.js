// Переход к следующему полю формы по клавише Enter.
//VVSite
//Aug 08 2012

function po_enter(xxx){

var mas_t=new Array();
var inp=xxx.elements;
for (i=0; i<inp.length; i++){
	if ((inp[i].tagName=='INPUT' && (inp[i].getAttribute('type')=='text' || inp[i].getAttribute('type')=='password') || inp[i].getAttribute('type')=='email') || inp[i].tagName == 'SELECT'){
		mas_t[mas_t.length]=inp[i];
	}
}
        
for (j=0; j<mas_t.length; j++){
	mas_t[j].onkeypress=function(e){
		try{
			var kk = (window.Event) ? e.which : e.keyCode;
			if (kk == 13) { 

			for (i=0; i<mas_t.length; i++){
				if (mas_t[i].name==this.name){
				try{ mas_t[i+1].focus(); } catch(e) {mas_t[0].focus();}
				}
			}
				return false; 
			} else { return true;}
		} catch (e) {
			var kk =  event.keyCode;
			if (kk == 13) { 
			for (i=0; i<mas_t.length; i++){
				if (mas_t[i].name==this.name){
				try{ mas_t[i+1].focus(); } catch(e) {mas_t[0].focus();}
				}
			}

				return false; 
			} else { return true;}
		}
	};

};

}

