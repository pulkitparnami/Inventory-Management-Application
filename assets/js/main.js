$(document).ready(function(){

//Document root
var doc_root = window.location.pathname.split('/').slice(0,3).join('/')+'/website/';

var tatti = {"a":"1","b":"2","c":{"aba":{"lol":"123"},"2":{"lol":"123"},"3":{"lol":"123"}}};


//Add new Location
$('span.add-loc').click(function(){
	var loc_html = $('.add-loc-cont').html();
	$('.product-location').append(loc_html);
})

$('.changelog-dp-form').on('submit',function(e){
	var dp_start = $('.dp-start').val();
	var dp_end 	 = $('.dp-end').val();
	e.preventDefault();
	$.ajax({
		url: doc_root+'/admin/config/changelog-config.php',
		method: 'POST',
		data: {dp_start: dp_start,
			   dp_end: dp_end,
			   dp_submit: 'submit'
			},
		success: function(response){
			$('.changelog-content').html(response);
		}
	})
})

$('.order-list-form').on('submit',function(e){
	e.preventDefault();
	var dp_start = $('.dp-start').val();
	var dp_end 	 = $('.dp-end').val();
	$.ajax({
		url: doc_root+'/admin/config/order-list-config.php',
		method: 'POST',
		data: {dp_start: dp_start,
			   dp_end: dp_end,
			   dp_submit: 'submit'
			},
		success: function(response){
			$('.orderlist-content').html(response);
		}
	})
})


$('.order-list-form , .changelog-dp-form').trigger('submit');





///*Form Validation**/

//First & last name validation.
function r_name_validation(input_el,error_el_value){
	var error_el = $('.'+error_el_value);
	error_el.addClass('rie-active');
	var value = $('#'+input_el).val();
	if(value.length < 3){
		error_el.html('Minimum 3 characters.');
	}
	else if(!(/^[A-Za-z]+$/.test(value))){
		error_el.html('Only alphabets are allowed.');
	}
	else if(value.length > 20){
		error_el.html('Maximum limit 20 characters.');
	}
	else{
		error_el.removeClass('rie-active');
	}
}

$('#r-fname').blur(function(){
	r_name_validation('r-fname','r-fname-error');
}).focus(function(){
	$('.r-fname-error').html('');
})

$('#r-lname').blur(function(){
	r_name_validation('r-lname','r-lname-error');
}
).focus(function(){
	$('.r-lname-error').html('');
})

//Email Id Validation
function r_email_validation(){
	var error_el = $('.r-email-error');
	var value = $('#r-email').val();
	error_el.addClass('rie-active');
	var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(value.length < 6){
		error_el.html('Minimum 6 characters.');
	}
	else if(!regex.test(value)){
		error_el.html('Invalid Email Id');
	}
	else{
		error_el.removeClass('rie-active');
	}
}

$('#r-email').blur(r_email_validation
	).focus(function(){
	$('.r-email-error').html('');
})

//Mobile no Validation
function r_mobile_validation(){
	var error_el = $('.r-mobile-error');
	var value = $('#r-mobileno').val();
	error_el.addClass('rie-active');
	var regex = /^[0-9]+$/;
	if(value.length != 10 || !regex.test(value)){
		error_el.html('Invalid Mobile number');
	}
	
}
	

$('#r-mobileno').blur(function(){
	r_mobile_validation();
	if($(this).val().length === 10){
		$.ajax({
			url: doc_root+'config/checkuser-config.php',
			method: 'POST',
			data: {mobile_no: $(this).val() , token: $(this).parent().siblings('input[name=token]').val()},
			success: function(response){
				console.log(response);
				if(response == 'true'){
					$('.r-mobile-error').html('Number already registered.').addClass('rie-active');
				}
				else{
					$('.r-mobile-error').removeClass('rie-active');
				}
			}
		})
	}
}
).focus(function(){
	$('.r-mobile-error').html('');
})

//Password Validation
function r_password_validation (){
	var error_el = $('.r-pass-error');
	error_el.addClass('rie-actove');
	var value = $('#r-password').val();
	if(value.length < 7){
		error_el.html('Minimum 7 characters.')
	}
	else{
		error_el.removeClass('rie-active');
	}
}

$('#r-password').blur(r_password_validation).focus(function(){
	$('.r-pass-error').html('');
})

//Form Submit
$('.register_submit').click(function(e){
	function has_class(input){
		return $('.'+input).hasClass('rie-active');
	}
	has_class('r-fname-error')    ? r_name_validation('r-fname','r-fname-error') : false;
	has_class('r-lname-error')    ? r_name_validation('r-lname','r-lname-error') : false;
	has_class('r-email-error')    ? r_email_validation() : false;
	has_class('r-mobile-error')   ? r_mobile_validation(): false;
	has_class('r-pass-error')     ? r_password_validation(): false;
	var has_error = $('.register-form').find('.rie-active').length;
	if(has_error != 0 ){
		e.preventDefault();
	}
	
})



//Generate password
$('.btn-gpass').click(function(){
	var first_name = $('#r-fname').val().toLowerCase();
	var random = Math.floor(Math.random() * (9999 - 1001 + 1)) + 1001;
	$('#r-password').val(first_name+random);
	$('.r-pass-error').html(''); //Clearing password validation error
})

//Hide/view password
$('.btn-spass').mousedown(function(){
	$('#r-password').attr('type','text');
})
$('.btn-spass').mouseup(function(){
	$('#r-password').attr('type','password');
})

//Search Delay function

var search_delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

function search(object,keyword_type){
	$(object).on('input click',function(e){
		$('.src-results').hide();
		e.stopPropagation();
		var _this = $(this);
		var keyword = _this.val();
		var result_box = _this.siblings('.src-results');
		var data = {};
		data[keyword_type] = keyword;
		result_box.show();
		if(!keyword){return false;}
		var search_ajax = function(){
			$.ajax({
				url: doc_root+'/admin/config/search-config.php',
				method: 'POST',
				data: data,
				success: function(response){
					result_box.html(response);
				},
				complete: function(){
					result_box.find('span.src-this').each(function(){
						var replc_txt = $(this).html().replace(keyword,'<hlt>'+keyword+'</hlt>');
						$(this).html(replc_txt);
					})
				}
			})
		}
		search_delay(search_ajax,300);
	})
}

//Search 
search('.src-product','product_kw'); //product
search('#src-user','user_kw'); // Customer


$('.ord-sprod').on('click','.src-plist li',function(){
	var _this = $(this);
	var data = _this.find('.src-pinfo').data('spi');
	var prod_qty = data.quantity;
	var prod_code = data.prod_code;
	var locations = data.locations;
	var order_form = _this.parents('.ord-sprod');

	order_form.find('#e-pc_code , .src-product').val(prod_code);
	if(prod_qty == 0){
		order_form.find('span.e-prodsel').html(prod_code+' is out of stock.').css('color','red');
		return;
	}
	else{
		order_form.find('span.e-prodsel').css('color','green');
	}

	order_form.find('span.e-prodsel').html('Product Selected: <b>'+prod_code+'</b>').show();
	var html = $('.ord-stk-content').prop('outerHTML');
	$('.ord-stk-content').remove();
	$.each(locations,function(key,value){
		$('.ord-stk').append(html);
		var loc_row = $('.ord-stk .ord-stk-content:last');
		loc_row.find('.e-location').val(key);
		loc_row.find('.e-quantity').val("");
		loc_row.find('span.e-qty-avail').html('In Stock: '+value);
	})
})

//Hide search result container
$(document).on('click',function(){
	if($('.src-results').is(':visible')){
		$('.src-results').hide().html();
	}
})

//Hide assemble and printing option
$('#e-toassemble').on('change',function(){
	if($('#e-toassemble').prop('checked')){
		$('select#e-status option[value="7"]').show();
	}
	else{
		$('select#e-status option[value="7"]').hide();
	}
})

$('#e-toprint').on('change',function(){
	if($('#e-toprint').prop('checked')){
		$('select#e-status option[value="3"] , select#e-status option[value="5"]').show();
	}
	else{
		$('select#e-status option[value="3"] , select#e-status option[value="5"]').hide();
	}
})
$('#e-toassemble ,#e-toprint').trigger('change');


})