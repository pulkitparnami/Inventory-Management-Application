<?php
include_once('../../core/init.php');

$upload = new Gallery();

if(isset($_POST['media-resize'])){
	$upload->image_upload('media-upload');

	if(!empty($_POST['media-resize'])){
		$media_resize_array = json_decode($_POST['media-resize'],true);
		foreach($media_resize_array as $media_resize){
			$upload->image_resize($media_resize);
		}
		$upload->insert_image();
		echo $upload->get_image_name();
	}

}
elseif (isset($_POST['media_delete'])) {
	$upload->delete_image(escape($_POST['media_delete']));
}


?>