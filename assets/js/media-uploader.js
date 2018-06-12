$(document).ready(function(){
	
	var doc_root = window.location.pathname.split('/').slice(0,3).join('/')+'/website';

	$('#upload-now').click(function(){
		$('.media-tab-2').trigger('click');
		upload_file();
	})

	function _(id){
	return document.getElementById(id);
	}

	var mgl_i = 0;
	function upload_file(){
		var files_array = _('media-upload').files.length;
		

		var media_resize = JSON.stringify($('#media-size').data('media-upl')) || 0;
		var li_elements = parseInt($('ul.media-uploading li').length);

		
		if(mgl_i  < files_array){
			if(li_elements === 0){
				new_i = mgl_i;
			}
			else{
				new_i = mgl_i+li_elements
			}
			var media = _('media-upload').files[mgl_i];
			var media_exten = media.name.substring(media.name.lastIndexOf('.')+1).toLowerCase();
			var media_size = media.size
			var media_exten_allowed = ['jpeg','jpg','png'];

			//Image Validation
			if(media_exten_allowed.indexOf(media_exten) === -1){
				alert('Files with extension jpeg ,jpg & png are allowed only.');
			}
			else if(media_size > 2000000){
				alert('Max image size 2MB');
			}
			else{	
				$('.media-uploading').prepend(
					'<li class="media-gallery-li tmp-'+new_i+'">'+
					//'<span class="media-name">'+media.name+'</span>'+
					'<img src="" alt=""/>'+
					'<progress value="0" max="100" id="media-progress-'+new_i+'"></progress>'+
					'</li>'
					);
				
				var formdata = new FormData();
				formdata.append('media-upload',media);
				formdata.append('media-resize',media_resize);
				var ajax = new XMLHttpRequest();
				ajax.upload.addEventListener('progress',progressHandler(new_i),false);
				ajax.addEventListener('load',completeHandler(new_i),false);
				ajax.open('POST',doc_root+'/admin/config/media-upload-config.php?');
				ajax.send(formdata);
			}	
		}
		else{
			mgl_i = 0;
		}
		
	}

	function progressHandler(new_i){
		return function progressHandler_return(event){
			var percent = (event.loaded / event.total) * 100;
			$('#media-progress-'+new_i).val(Math.round(percent));
		}
	}

	function completeHandler(new_i){
		return function completeHandler_return(event){
			$('.tmp-'+new_i+' img').attr('src',doc_root+'/uploads/110X110/'+event.target.responseText.trim());
			$('.media-gallery-li').removeClass('mg-active');
			$('.tmp-'+new_i).addClass('mg-active').removeClass('tmp-'+new_i);
			$('#media-progress-'+new_i).remove();
			mgl_i++;
			upload_file();
		}

	}


	//media container open
$('.open-media').click(function(e){
	e.preventDefault();
	$('.media-container').slideDown();
	$('.media-opac').show();
})

//media container close
$('.close-media').click(function(){
	$('.media-container').slideUp();
	$('.media-opac').fadeOut('slow');
})

//Media gallery tab switch
$('ul.media-tabs li').click(function(){
	var tab_class = $(this).attr('class');
	$('ul.media-tabs li').removeClass('media-tab-active');
	$(this).addClass('media-tab-active');
	if(tab_class == 'media-tab-1'){
		$('.media-upload').show();
		$('.media-gallery').hide();
	}
	else if(tab_class == 'media-tab-2'){
		$('.media-upload').hide();
		$('.media-gallery').show();
	}
})

$('.media-gallery').on('click','li.media-gallery-li',function(){
	$('li.media-gallery-li').removeClass('mg-active');
	$(this).addClass('mg-active');
})

//Set image in image holder
$('.insert-media').on('click',function(e){
	e.preventDefault();
	var is_selected = $('ul.media-uploading .mg-active').length;
	if(!is_selected){
		alert('Select image');
	}
	else{
		var img_url  = $('ul.media-uploading .mg-active img').attr('src');
		var img_name = img_url.replace(/^.*[\\\/]/, '');
		$('.img-holder img').attr('src',doc_root+'/uploads/'+img_name);
		$('#p-image').val(img_name);
		$('.close-media').trigger('click');

	}
})


//Delete Image
$('.delete-media').click(function(e){
	e.preventDefault();
	var img_url  = $('ul.media-uploading .mg-active img').attr('src');
	var img_name = img_url.replace(/^.*[\\\/]/, '');
	$.ajax({
		url: doc_root+'/admin/config/media-upload-config.php',
		method: 'POST',
		data: {media_delete: img_name},
		success: function(response){
			$('ul.media-uploading .mg-active').fadeOut('slow').remove();
			console.log(response);
		}
	})
})


})
