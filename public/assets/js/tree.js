var keyboardTimer;
var XHR = null;
var colors = ['','#F5DEDE','#FFFFCC','#D0DFFA','#FFDCB2','#D9FFB2'];
var resizeKeyboard = null;
var isWebPreview =false;
function novalue(text){
	return ($.trim(text)=="");
}
function setFontSize(value,move){
	value = (parseInt(value) ? Math.min(18,Math.max(8,parseInt(value))) : 12);
	var map = {8: 36,9: 32,10: 29,11: 26,12: 24,13: 22,14: 20,15: 19,16: 18,17: 17,18: 16};
	$('#fontSizeSlider a').html(value);
	$('#fontSizeSlider input:hidden').val(value);
	$('.pigeonPedigreeWrapper .pigeonItem textarea.down').css({
		'font-size': value + 'px',
		'line-height': (value + 2) + 'px',
		'width': Math.ceil((value / 2) * map[value]) + 'px'
	});
	if(move){
		var max = $('#fontSizeSlider').outerWidth() - $('#fontSizeSlider a').outerWidth() - 2;
		$('#fontSizeSlider a').css('left',((max / 10) * (value - 8)) + 1);
	}
}

function setOpacity(value,move){
	value = (parseInt(value) ? Math.min(100,Math.max(0,parseInt(value))) : 0);
	$('#opacitySlider a').html(value);
	$('#opacitySlider input:hidden').val(value);
	if(move){
		var max = $('#opacitySlider').outerWidth() - $('#opacitySlider a').outerWidth() - 2;
		$('#opacitySlider a').css('left',((max / 100) * value) + 1);
	}
}

function enableChangeSex(){
	$('.sexRadioWrapper').removeClass('readOnlySex');
	$('.sexRadioWrapper').removeClass('hidden');
}

function disableChangeSex(){
	$('.sexRadioWrapper').each(function(){
		if($(this).find('input:radio').is(':checked'))
			$(this).addClass('readOnlySex');
		else
			$(this).addClass('hidden');
	});
}

function populate(key,pigeon){
	var pigeonItem = $('.pigeonItem[rel="'+key+'"]');
	if(pigeonItem.length==0)
		return false;
	$('.tabBasicBtn a').click();

	if(key=='pigeon'){
		$('.pedigreeTypeSelect').val(pigeon['pedigree_type']);
		$('.pedigreeTypeSelect').change();
		if(pigeon['sex']){
			$('.sexRadioBtn[value='+pigeon['sex']+']').click();
			(pigeon['allow_change_sex']) ? enableChangeSex() : disableChangeSex();
		}
		if(pigeon['nest_box']){
			$('.nestBoxInput').val(pigeon['nest_box']);
		}
		if(pigeon['compartment']){
			$('.compartmentSelect').val(pigeon['compartment']);
			$('.compartmentSelect').change();
		}
		if(pigeon['status']){
			$('.statusSelect').val($('.statusSelect').find('option[value="' + pigeon['status'] + '"]').length ? pigeon['status'] : 0);
			$('.statusSelect').change();						
		}
		setOpacity(pigeon['opacity'],true);
		setFontSize(pigeon['font_size'],true);
		if(pigeon['id']){			
			$('.colorInput').val(pigeon['color_pigeon']);
			$('.colorEyesInput').val(pigeon['color_eyes']);
			$('.nameInput').val(pigeon['name']);
			$('.statusExplicationInput').val(pigeon['status_explication']);		
			/*OTHER*/
			$('.hatchingDateInput').val(pigeon['hatching_date']);
			$('.prevMatesInput').val(pigeon['prev_mates']);
			$('.observationsInput').val(pigeon['observations']);
			/*PHOTO*/
			if(!novalue(pigeon['photo'])){
				$('.photoInputWrapper').addClass('hidden');
				$('.photoInput').val('');
				$('.photoWrapper img').attr('src',base_url+pigeon['thumb']+'?v='+Date.now());
				$('.photoWrapper img').attr('rel',pigeon['photo']);
				$('.photoWrapper').removeClass('hidden');
				$('.photoHidden').val(pigeon['photo']);
				$('.removePhotoInput').val("");
			} 
			/*BACKGROUND*/
			 if(!novalue(pigeon['background'])){
				$('.backgroundInputWrapper').addClass('hidden');
				$('.backgroundInput').val('');
				$('.backgroundWrapper img').attr('src',base_url+pigeon['thumb_bg']+'?v='+Date.now());
				$('.backgroundWrapper img').attr('rel',pigeon['background']);
				$('.backgroundWrapper').removeClass('hidden');
				$('.backgroundHidden').val(pigeon['background']);
				$('.removeBackgroundInput').val("");
			}
		}
	}
	pigeonItem.find('input:text').val(pigeon['series']);
	pigeonItem.find('textarea').val(pigeon['extra']);
	if(pigeon['id']){
		pigeonItem.find('.idHidden').val(pigeon['id']);
		pigeonItem.find('.colorHidden').val(pigeon['color']);
		pigeonItem.css('background-color',pigeon['color']);
		pigeonItem.data('foreign',pigeon['foreign'] ? true : false);
	}

	if(isWebPreview){
		var color = (pigeon['color'] ? pigeon['color'].replace('#','') : 'White');
		if($(pigeonItem).hasClass('pigeonBigBox') && $(pigeonItem).hasClass('importantBox') && pigeon['pedigree_type'] == 2){
			$(pigeonItem).find('.pigeonBackground').remove();
			$(pigeonItem).prepend('<div class="pigeonBackground"><img src="' + base_url + 'assets/img/' + color + '_pixel.png"/></div>');
		}
		else if($(pigeonItem).hasClass('pigeonBigBox')){
			$(pigeonItem).find('.pigeonBackground').remove();
			$(pigeonItem).prepend('<div class="pigeonBackground"><img src="' + base_url + 'assets/img/' + color + '_pixel.png"/></div>');
		}		
		else if($(pigeonItem).hasClass('pigeonSmallBox')){
			$(pigeonItem).find('.pigeonBackground').remove();
			$(pigeonItem).prepend('<div class="pigeonBackground"><img src="' + base_url + 'assets/img/' + color + '_pixel.png"/></div>');
		}			
		else if($(pigeonItem).hasClass('pigeonVerySmallBox')){
			$(pigeonItem).parent().find('.pigeonBackground').remove();
			$(pigeonItem).parent().prepend('<div class="pigeonBackground"><img src="' + base_url + 'assets/img/' + color + '_pixel.png"/></div>');	
		}
		if(key=='pigeon'){
			if(pigeon['background']){
				$('.pigeonPedigreeWrapper').addClass('withCover');
				$('.background img').attr('src',base_url+pigeon['thumb_bg']+'?v='+Date.now());
				$('.background').css('display','block');
			}
			if(pigeon['photo']){
				$('.info-photo img').attr('src',base_url+pigeon['thumb']+'?v='+Date.now());
				$('.info-photo').css('display','block');
			}
		}
	}

	if(typeof(pigeon['father'])=="object")
		populate(key+'_father',pigeon['father']);
	if(typeof(pigeon['mother'])=="object")
		populate(key+'_mother',pigeon['mother']);
}

function dePopulate(key){
	var pigeonItem = $('.pigeonItem[rel='+key+']'); 
	if(pigeonItem.length==0)
		return false;
	$('.tabBasicBtn a').click();
	if(pigeonItem.find('.idHidden').val() != 0 || pigeonItem.data('foreign')){
		if(key=='pigeon'){
			$('.pedigreeTypeSelect').val(1);
			$('.pedigreeTypeSelect').change();
			setFontSize(12,true);
			setOpacity(25,true);
			$('.sexRadioBtn').removeAttr('checked','checked');
			enableChangeSex();
			$('.nestBoxInput').val('');
			$('.colorInput').val('');
			$('.colorEyesInput').val('');
			$('.nameInput').val('');
			$('.compartmentSelect').val(0);
			$('.compartmentSelect').change();
			$('.statusSelect').val(0);
			$('.statusSelect').change();			
			/*OTHER*/
			$('.hatchingDateInput').val('');
			$('.prevMatesInput').val('');
			$('.observationsInput').val('');
			/*PHOTO*/
			$('.photoWrapper').addClass('hidden');
			$('.photoWrapper img').attr('src','');
			$('.photoWrapper img').attr('rel','');
			$('.photoInput').val('');
			$('.photoInputWrapper').removeClass('hidden');
			$('.photoHidden').val("");
			$('.removePhotoInput').val("");
			/*BACKGROUND*/
			$('.backgroundWrapper').addClass('hidden');
			$('.backgroundWrapper img').attr('src','');
			$('.backgroundWrapper img').attr('rel','');
			$('.backgroundInput').val('');
			$('.backgroundInputWrapper').removeClass('hidden');
			$('.backgroundHidden').val("");
			$('.removeBackgroundInput').val("");
		}			
		pigeonItem.find('.idHidden').val(0);
		pigeonItem.find('input:text').val("");
		pigeonItem.find('textarea').val("");
		pigeonItem.find('.colorHidden').val("");
		pigeonItem.css('background-color',"");
		pigeonItem.data('foreign', false);
	}
	dePopulate(key+'_father');
	dePopulate(key+'_mother');
}

$(document).ready(function(){
	/* $('.doSubmit').click(function(){
		var ajaxData = $('form.pigeonForm').serializeArray();
		$('.doSubmit').addClass('disabled');
		$.ajax({
			type: 'POST',
			url: base_url+'ajax/validate_pigeon_form',
			data: ajaxData,
			dataType:'json'
		}).done(function(result){
			$('.errorsWrapper').html('');
			if(!result.success){
				$('.errorsWrapper').html('<div class="alert alert-danger">'+result['message']+'</div>');
				$('html,body').animate({scrollTop: $('.errorsWrapper').offset().top - 60},250);
				$('.doSubmit').removeClass('disabled');
			}
			else{
				$('form.pigeonForm').submit();
			}
		}).fail(function(jqXHR,textStatus,errorThrown){
			$('.errorsWrapper').html('<div class="alert alert-danger">' + (errorThrown ? errorThrown : 'Server error: ' + textStatus) + '</div>');
			$('html,body').animate({scrollTop: $('.errorsWrapper').offset().top - 60},250);
			$('.doSubmit').removeClass('disabled');
		});
		return false;
	}); */
	
	$('.statusSelect').change(function(){
		if(novalue($(this).val())){
			$('.forOtherStatus').removeClass('hidden');
		}
		else{
			$('.forOtherStatus').addClass('hidden');
			$('.otherStatusInput').val('');
		}

		if($(this).val()!="0" && $(this).val()!="1"){
			$('.forStatusExplication').removeClass('hidden');
		}
		else{
			$('.forStatusExplication').addClass('hidden');
			$('.statusExplicationInput').val('');
		}

		$('.pigeonPedigreeWrapper').css('min-height', $('.pigeonInfoWrapper').height() + 100);
	});

	$('.compartmentSelect').change(function(){
		if(novalue($(this).val())){
			$('.forOtherCompartment').removeClass('hidden');
		}
		else{
			$('.forOtherCompartment').addClass('hidden');
			$('.otherCompartmentInput').val('');
		}
		$('.pigeonPedigreeWrapper').css('min-height', $('.pigeonInfoWrapper').height() + 100);
	});

	$('.pedigreeTypeSelect').change(function(){
		if ($(this).val() == 1) {
			$('.pigeonPedigreeWrapper').removeClass('layout3');
			$('.pigeonPedigreeWrapper').removeClass('layout2');
			$('.pigeonPedigreeWrapper').removeClass('layout4');
			$('.pigeonPedigreeWrapper .level.l-5 input,.pigeonPedigreeWrapper .level.l-5 textarea').removeAttr('disabled');
		}

		else if ($(this).val() == 3) {
			$('.pigeonPedigreeWrapper').removeClass('layout2');
			$('.pigeonPedigreeWrapper').removeClass('layout4');
			$('.pigeonPedigreeWrapper').removeClass('layout1');
			$('.pigeonPedigreeWrapper .level.l-5 input,.pigeonPedigreeWrapper .level.l-5 textarea').removeAttr('disabled');
		}

		else if ($(this).val() == 2) {
			$('.pigeonPedigreeWrapper').removeClass('layout1');
			$('.pigeonPedigreeWrapper').removeClass('layout3');
			$('.pigeonPedigreeWrapper').removeClass('layout4');
			$('.pigeonPedigreeWrapper .level.l-5 input,.pigeonPedigreeWrapper .level.l-5 textarea').attr('disabled','disabled');
		}

		else if ($(this).val() == 4) {
			$('.pigeonPedigreeWrapper').removeClass('layout1');
			$('.pigeonPedigreeWrapper').removeClass('layout3');
			$('.pigeonPedigreeWrapper').removeClass('layout2');
			$('.pigeonPedigreeWrapper .level.l-5 input,.pigeonPedigreeWrapper .level.l-5 textarea').attr('disabled','disabled');
		}

		$('.pigeonPedigreeWrapper').addClass('layout'+$(this).val());
	});
	
	
	$('.pigeonItem input:text').on('paste',function(e){
		var element = this;
		setTimeout(function(){
			$(element).keyup();
		},50);
	});
	

	$('.pigeonItem input:text').keydown(function(e){
		if(e.keyCode == 9){
			var pigeonItem = $(this).parents('.pigeonItem:first');
			pigeonItem.find('.popup-wrapper').remove();
			pigeonItem.find('input:text').unbind('blur.myevent');
		}
	});
	
	$('.pigeonItem').hover(function() {
		var pigeonItem = $(this);
		pigeonItem.find('.colorPickerWrapper').removeClass('hidden');
	},function(){
		var pigeonItem = $(this);
		pigeonItem.find('.colorPickerWrapper').addClass('hidden');
	});	
	
	$('.pigeonPedigreeWrapper').on('click','.colorPickerWrapper a.color',function(){
		var pigeonItem = $(this).parents('.pigeonItem:first');
		var color = $(this).attr('rel');
		pigeonItem.css('background-color',color);
		pigeonItem.find('.colorHidden').val(color);
		/*SEARCH FOR MATCH PIGEONS*/
		var pigeon_id = pigeonItem.find('.idHidden').val();
		var series = $.trim(pigeonItem.find('input:text').val());
		$('.pigeonItem').each(function(){
			if(pigeonItem.attr('rel')!=$(this).attr('rel'))
				if((pigeon_id!=0 && $(this).find('.idHidden').val()==pigeon_id) || (pigeon_id==0 && $(this).find('.idHidden').val()==0 && !novalue(series) && $.trim($(this).find('input:text').val())==series)){
					$(this).css('background-color',color);
					$(this).find('.colorHidden').val(color);
				}
		});
		return false;
	});	
	
	$('a.removePhotoBtn').click(function(){
		var file = $('.photoWrapper img').attr('rel');
		$('.removePhotoInput').val(file);
		$('.photoWrapper').addClass('hidden');
		$('.photoWrapper img').attr('src','').attr('rel','');
		$('.photoInputWrapper').removeClass('hidden');
		$('.photoHidden').val("");
		$('.pigeonPedigreeWrapper').css('min-height', $('.pigeonInfoWrapper').height() + 100);
		return false;
	});

	$('a.removeBackgroundBtn').click(function(){
		var file = $('.backgroundWrapper img').attr('rel');
		$('.removeBackgroundInput').val(file);
		$('.backgroundWrapper').addClass('hidden');
		$('.backgroundWrapper img').attr('src','').attr('rel','');
		$('.backgroundInputWrapper').removeClass('hidden');
		$('.backgroundHidden').val("");
		$('.pigeonPedigreeWrapper').css('min-height', $('.pigeonInfoWrapper').height() + 100);
		return false;
	});
	
	$('.tabBasicBtn a').click(function(){
		$('.tabOtherBtn').removeClass('active');
		$(this).parent().addClass('active');
		$('.tabOther').addClass('hidden');
		$('.tabBasic').removeClass('hidden');
		return false;
	});
	
	$('.tabOtherBtn a').click(function(){
		$('.tabBasicBtn').removeClass('active');
		$(this).parent().addClass('active');
		$('.tabBasic').addClass('hidden');
		$('.tabOther').removeClass('hidden');
		return false;
	});
	
	$(document).on("keydown", function (e) {
		if (e.keyCode === 8 && !$(e.target).is("input:text, textarea")) {
			e.preventDefault();
		}
	});

	$('.sliderWrapper a').bind('mousedown',function(e){
		var el = this;
		var max = $(el).parent().outerWidth() - $(el).outerWidth() - 2;
		var x = e.pageX;
		var el_left = $(el).offset().left;
		var parent_left = $(el).parent().offset().left;
		$('body').addClass('no-select');
		$(window).bind('mousemove.sliderEvent',function(e){
			var value = (e.pageX - parent_left) - (x - el_left);
			if(value < 0)
				value = 0;
			if(value > max)
				value = max;
			$(el).css('left',value + 1);
			var p = Math.round((value / max) * 100);
			$(el).trigger('change', [p]);
		});
		$(window).bind('mouseup.sliderEvent',function(e){
			$('body').removeClass('no-select');
			$(window).unbind('.sliderEvent');
		});		
	});

	$('.sliderWrapper a').bind('touchstart',function(e){
		if(e.originalEvent.touches.length != 1) 
			return;
		var el = this;
		var max = $(el).parent().outerWidth() - $(el).outerWidth() - 2;
		var x = e.originalEvent.touches[0].pageX;
		var el_left = $(el).offset().left;
		var parent_left = $(el).parent().offset().left;
		$('body').addClass('no-select');
		$(el).bind('touchmove.sliderEvent',function(e){
			e.preventDefault();
			var value = (e.originalEvent.touches[0].pageX - parent_left) - (x - el_left);
			if(value < 0)
				value = 0;
			if(value > max)
				value = max;
			$(el).css('left',value + 1);
			var p = Math.round((value / max) * 100);
			$(el).trigger('change', [p]);
		});	
		$(el).bind('touchend.sliderEvent',function(e){
			$('body').removeClass('no-select');
			$(el).unbind('.sliderEvent');
		});		
	});

	$('#fontSizeSlider').bind('change', function(e, p){
		setFontSize(Math.round((p / 100) * 10) + 8);
	});

	$('#opacitySlider').bind('change', function(e, p){
		setOpacity(Math.round(p));
	});

	$('.toggleView').click(function(){
		$('.pigeonWrapper').toggleClass('closed');
		return false;
	});

	$('#header a.js-print-button').click(function(){
		if(confirm(l('For better results please use Google Chrome and set Margins to None.','#492')))
			print();
		return false;
	});

	$('body').on('mousedown','.pigeonWrapper.closed .pigeonInfoWrapper',function(){
		$('.toggleView').click();
	});

	$('#fontCaseBtn').click(function(){
		var value = (typeof($(this).data('case')) != 'undefined' ? $(this).data('case') : false);
		$(this).data('case', !value);
		$('textarea.down').each(function(){
			var text = $(this).val();
			if(value){
				$(this).val(text.toUpperCase());
			}
			else{
				$(this).val(text.toLowerCase());
			}
		});
		return false;
	});

	$(window).resize(function(){
		clearTimeout(resizeKeyboard);
		resizeKeyboard = setTimeout(function(){
		
			var opacity = parseInt($('#opacitySlider input:hidden').val());
			setOpacity(opacity,true);
		},100);
	});


	 if(isWebPreview == false){
		$('.pigeonItem').each(function(index){
			var parentIndex,nameAttr,relAttr;
			index = index + 1;
			if(index==1){
				relAttr = 'pigeon';
				nameAttr = 'pigeon';
				$(this).attr('rel',relAttr);
			//	$(this).find('input:text').attr('placeholder',l('Series','#97'));
			//	$(this).find('textarea').attr('placeholder',l('Extra informations','#100'));
				$(this).find('input:text').attr('name',nameAttr+'[series]');
				$(this).find('textarea').attr('name',nameAttr+'[extra]');
				$(this).append('<input type="hidden" name="'+nameAttr+'[id]" value="0" class="idHidden"/>');
				$(this).append('<input type="hidden" name="'+nameAttr+'[color]" value="" class="colorHidden"/>');
			/* 	$(this).append('<div class="colorPickerWrapper hidden"></div>');
				for(var i=0;i<=6;i++)
					$(this).find('.colorPickerWrapper').append('<a href="#" rel="'+colors[i]+'" class="color cl-'+i+'"></a>');
 */			}
			else{
				parentIndex = Math.floor(index / 2);
				relAttr = $('.pigeonItem').eq(parentIndex-1).attr('rel').split('_');
				nameAttr = $('.pigeonItem').eq(parentIndex-1).find('.idHidden').attr('name');
				nameAttr = nameAttr.replace('[id]','');
				if(index%2==0){
					relAttr.push('father');
					nameAttr = nameAttr + '[father]';
				//	$(this).find('input:text').attr('placeholder',l('Series (Male)','#98'));
				}
				else{
					relAttr.push('mother');
					nameAttr = nameAttr + '[mother]';
			//		$(this).find('input:text').attr('placeholder',l('Series (Female)','#99'));
				}
			//	$(this).find('textarea').attr('placeholder',l('Extra informations','#100'));
				$(this).attr('rel',relAttr.join('_'));
				$(this).find('input:text').attr('name',nameAttr+'[series]');
				$(this).find('textarea').attr('name',nameAttr+'[extra]');
				$(this).append('<input type="hidden" name="'+nameAttr+'[id]" value="0" class="idHidden"/>');
				$(this).append('<input type="hidden" name="'+nameAttr+'[color]" value="" class="colorHidden"/>');
		/* 		$(this).append('<div class="colorPickerWrapper hidden"></div>');
				for(var i=0;i<=6;i++)
					$(this).find('.colorPickerWrapper').append('<a href="#" rel="'+colors[i]+'" class="color cl-'+i+'"></a>');
		 */	}
		});
	}
	else{
		$('.pigeonItem').each(function(index){
			var parentIndex,nameAttr,relAttr;
			index = index + 1;
			if(index==1){
				relAttr = 'pigeon';
				$(this).attr('rel',relAttr);
				$(this).find('input:text').attr('readonly','readonly');
				$(this).find('textarea').attr('readonly','readonly');
			}
			else{
				parentIndex = Math.floor(index / 2);
				relAttr = $('.pigeonItem').eq(parentIndex-1).attr('rel').split('_');
				(index%2==0) ? relAttr.push('father') : relAttr.push('mother');
				$(this).attr('rel',relAttr.join('_'));
				$(this).find('input:text').attr('readonly','readonly');
				$(this).find('textarea').attr('readonly','readonly');
			}

			if($(this).hasClass('pigeonBigBox') && $(this).hasClass('importantBox') && pigeon['pedigree_type'] == 2){
				$(this).prepend('<div class="pigeonBackground"><img src="' +White_pixel + '"/></div>');
				$(this).parent().prepend('<div class="pigeonVeryBigBoxShadow"><img src="' + base_url + 'assets/img/Black_pixel.png"/></div>');
			}
			else if($(this).hasClass('pigeonBigBox')){
				$(this).prepend('<div class="pigeonBackground"><img src="' +White_pixel + '"/></div>');
				$(this).parent().prepend('<div class="pigeonBigBoxShadow"><img src="' + base_url + 'assets/img/Black_pixel.png"/></div>');
			}
			else if($(this).hasClass('pigeonSmallBox')){
				$(this).prepend('<div class="pigeonBackground"><img src="' +White_pixel + '"/></div>');
				$(this).parent().prepend('<div class="pigeonSmallBoxShadow"><img src="' + base_url + 'assets/img/Black_pixel.png"/></div>');
			}
			else if($(this).hasClass('pigeonVerySmallBox')){
				$(this).parent().prepend('<div class="pigeonBackground"><img src="' +White_pixel + '"/></div>');
				$(this).parent().parent().prepend('<div class="pigeonSmallBoxShadow"><img src="' + base_url + 'assets/img/Black_pixel.png"/></div>');
			} 

		});		
	} 

	if(typeof(pigeon)!="undefined"){
		populate('pigeon',pigeon);
	}

	if(autofocus){
		$('.pigeonItem[rel="pigeon"] input.up').focus();
	}
	
});
	
