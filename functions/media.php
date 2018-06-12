<?php

//Image Upload Validation

function add_media($file, $w = null, $h = null, $folder=null){
	if(!empty($_FILES[$file]['name'])){
		if($_FILES[$file]['error'] === 0){

			$img 			= $_FILES[$file];
			$img_name		= escape(basename($img['name']));
			$allowed 		= array('jpeg','jpg','png');
			$img_tmp_name 	= $img['tmp_name'];
			$img_size		= $img['size'];
			$img_error 		= $img['error'];
			$img_type 		= pathinfo($img_name,PATHINFO_EXTENSION);

			if(!in_array($img_type,$allowed)){
				echo 'Invalid file';
			}
			elseif($img_size > 2000000){
				echo 'Max size exceed';
			}
			elseif(!getimagesize($img_tmp_name)){
				echo 'Invalid file';
			}
			else{
				$destination_abs = ROOT.'/uploads/'.$img_name;
				$upload_success = move_uploaded_file($img_tmp_name,$destination_abs);

				//Resize Image
				if($upload_success){
					function resize_image($w,$h,$folder){
						global $img_name;
						echo $img_name;
						die();
						list($org_w,$org_h) =  getimagesize($destination_abs);
						$img = imagecreatefromjpeg($destination_abs);
						$newcopy = ROOT.'/uploads/'.$folder.'/'.$img_name;
						$true_color = imagecreatetruecolor($w, $h);
						imagecopyresampled($true_color, $img, 0, 0, 0, 0, $w, $h, $org_w, $org_h);
						imagejpeg($true_color,$newcopy,80);
					}

					//Media gallery thumbnails
					resize_image(110,110,'media-gallery');
					if($w && $h && $folder){
						resize_image($w,$h,$folder);
					}
					
				}
			}			

		}
	}
	else{
		return false;
	}
}



?>