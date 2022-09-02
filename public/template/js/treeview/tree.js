function jtree(){
	$('.checkbox, .collapsible').on('click',function(){
		let li1 = $(this).parent(), ul = null;
		
		/*Boton de expandir y contraer*/
		if($(this).hasClass('colap')){
			remAdd($(this),'collapsible exp'); if(ul = li1.find('ul')){ ul.hide(); remAdd($(this).parent().find('.collapsible'),'collapsible exp'); }				
		
		}else if($(this).hasClass('exp')){ remAdd($(this),'loading'); if(ul = li1.children('ul')){ ul.show();setTimeout(()=>{remAdd($(this),'collapsible colap');},700); } }
		
		if($(this).hasClass('unchecked') || $(this).hasClass('mid-checked')){
			remAdd($(this),'checkbox checked');
			//console.log(ulp[0].previousElementSibling);
			$(this).parents('ul').each(function(){
				ul = $(this); let checks = ul.find('.unchecked'), checkPad = ul.prev();
				if(ul.attr('class') !== 'root'){
					if(checks.length > 0){ if(checkPad.hasClass('unchecked')) remAdd(checkPad,'checkbox mid-checked'); }
					else if(checks.length === 0) remAdd(checkPad,'checkbox checked');
				}
			}); if(li1.children('ul').length > 0) remAdd(li1.find('.checkbox.unchecked'),'checkbox checked');
		
		}else if($(this).hasClass('checked')){
			remAdd($(this),'checkbox unchecked');
			$(this).parents('ul').each(function(){
				ul = $(this); let checks = ul.find('.checked'), checkPad = ul.prev();
				if(ul.attr('class') !== 'root'){
					if(checks.length > 0){ if(checkPad.hasClass('checked')) remAdd(checkPad,'checkbox mid-checked'); }
					else if(checks.length === 0) remAdd(checkPad,'checkbox unchecked');
				}
			}); if(li1.children('ul').length > 0) remAdd(li1.find('.checkbox.checked'),'checkbox unchecked');
			
			if($('.root').find('.checked').length === 0) remAdd($('.root').find('.checkbox'),'checkbox unchecked');
		}
	});
	
	function remAdd(el,clase){ el.prop('class',clase); }
}