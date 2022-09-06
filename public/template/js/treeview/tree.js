$(document).ready(function(){
	$('#jstree').on('click', 'i', function(){
		let li1 = $(this).closest('li'), ul = li1.children('ul');
		
		/*Boton de expandir y contraer*/
		if($(this).hasClass('colap')){ remAdd($(this),'collapsible exp'); if(ul.length > 0){ li1.find('ul').hide(); remAdd(li1.find('.collapsible'),'collapsible exp'); } }
		else if($(this).hasClass('exp')){ if(ul.length > 0){ ul.show(); remAdd($(this),'collapsible colap');}else remAdd($(this),'loading'); }
		
		/*Botones de check*/
		else if($(this).hasClass('unchecked') || $(this).hasClass('mid-checked')){
			remAdd($(this),'checkbox checked');
			$(this).parents('ul').each(function(){
				ul = $(this); let checks = ul.find('.unchecked'), checkPad = ul.prev();
				if(ul.attr('class') !== 'root'){
					if(checks.length > 0){ if(checkPad.hasClass('unchecked')) remAdd(checkPad,'checkbox mid-checked'); }
					else if(checks.length === 0) remAdd(checkPad,'checkbox checked');
				}
			});
			if(li1.children('ul').length > 0) remAdd(li1.find('.checkbox.unchecked'),'checkbox checked');
			if($(this).parents('.dep').find('.unchecked').length == 0) remAdd($(this).parents('.dep').find('.checkbox'),'checkbox checked');
		
		}else if($(this).hasClass('checked')){
			remAdd($(this),'checkbox unchecked');
			$(this).parents('ul').each(function(){
				ul = $(this); let checks = ul.find('.checked'), checkPad = ul.prev();
				if(ul.attr('class') !== 'root'){
					if(checks.length > 0){ if(checkPad.hasClass('checked')) remAdd(checkPad,'checkbox mid-checked'); }
					else if(checks.length === 0) remAdd(checkPad,'checkbox unchecked');
				}
			}); 
			if(li1.children('ul').length > 0) remAdd(li1.find('.checkbox.checked'),'checkbox unchecked');
			if($(this).parents('.dep').find('.checked').length == 0) remAdd($(this).parents('.dep').find('.checkbox'),'checkbox unchecked');
		}
	});
});

function remAdd(el,clase){ el.prop('class',clase); }