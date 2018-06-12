<?php
class Gallery{
	private $_db;

	public	$image_name,
			$org_img_location,
			$image_exten,
			$json = array();


	public function __construct(){
		$this->_db = Db::get_instance()->db;
	}

	public function image_upload($file){
		if(!empty($_FILES[$file]['name'])){
			if($_FILES[$file]['error'] === 0){

				$img 			= $_FILES[$file];
				$img_name		= str_replace(' ', '_', basename($img['name']));
				$allowed 		= array('jpeg','jpg','png');
				$img_tmp_name 	= $img['tmp_name'];
				$img_size		= (int) $img['size'];
				$img_error 		= $img['error'];
				$img_type 		= strtolower(pathinfo($img_name,PATHINFO_EXTENSION));

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
					if(file_exists($destination_abs)){
						$rawBaseName = pathinfo($img_name, PATHINFO_FILENAME );
						$counter  = 0;
						while (file_exists( ROOT.'/uploads/'.$img_name)) {
							$counter++;
							$img_name = $rawBaseName.$counter.'.'.$img_type;
						}

					$destination_abs = ROOT.'/uploads/'.$img_name;
					}
					$upload_success = move_uploaded_file($img_tmp_name,$destination_abs);
					$last_modified 	= date('jS F Y',filemtime($destination_abs));
					list($width, $height) = getimagesize($destination_abs);
					$this->image_name = $img_name;
					$this->image_exten = $img_type;
					$this->org_img_location = $destination_abs;
					
					$this->json = array('name'  	   => $img_name,
										'title' 	   => '',
										'alt'		   => '',
										'lastModified' => $last_modified,
										'dimensions'	   => array(
								            'main' => Array
								                (
								                    'link'  => REL.'/uploads/'.$img_name,
								                    'width' => escape($width),
								                    'height'=> escape($height),
								                    'size' 	=> round($img_size/1000)
							                    )
							                )
										);
					$this->image_resize(array(
												'width'  => 110,
												'height' => 110,
												'folder' => '110X110'
											));
					return $this;
				}
			}
		}
		else{
			return false;
		}
	}

	public function image_resize($media_size = array()){
		
		$res_width  	= escape($media_size['width']);
		$res_height 	= escape($media_size['height']);
		$folder 		= escape($media_size['folder']);

		if(count($media_size) > 3){
			$img_name_param = escape($media_size['img_name']);
		}
		

		if(!($this->image_name)){
			$this->image_name  		= $img_name_param;
			$this->image_exten 		= strtolower(pathinfo($img_name_param,PATHINFO_EXTENSION));
			$this->org_img_location = ROOT.'/uploads/'.$img_name_param;
		}

		list($org_w,$org_h) = getimagesize($this->org_img_location);

		if($this->image_exten == 'jpeg' ||$this->image_exten == 'jpg' ){
			$img 				= imagecreatefromjpeg($this->org_img_location);
		}
		elseif ($this->image_exten == 'png') {
			$img 				= imagecreatefrompng($this->org_img_location);
		}
		
		if(!is_dir(ROOT.'/uploads/'.$folder)){
			mkdir(ROOT.'/uploads/'.$folder);
		}
		$newcopy 			= ROOT.'/uploads/'.$folder.'/'.$this->image_name ;
		$true_color 		= imagecreatetruecolor($res_width, $res_height);
		imagecopyresampled($true_color, $img, 0, 0, 0, 0, $res_width, $res_height, $org_w, $org_h);
		imagejpeg($true_color,$newcopy,80);

		$this->json['dimensions'][$folder] = Array
						                	(
							                    'link'  => REL.'/uploads/'.$folder.'/'.$this->image_name,
							                    'width' => $res_width,
							                    'height'=> $res_height,
							                    'size' 	=> round(filesize($newcopy)/1000)
						                    );
			    
	}

	public function insert_image($code = null){
		$sql = "INSERT INTO admin_attachments(dealer_code,details) VALUES(?,?)";
		$query = $this->_db->prepare($sql);
		$values = array($code,$this->get_image_details_json());
		$query->execute($values);
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}

	}

	public function get_image_name(){
		return escape($this->image_name);
	}

	public function get_image_details_json(){
		return json_encode($this->json);
	}

	public function get_image_details_array(){
		return $this->json;
	}

	public function delete_image($del_img_name){

		$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ROOT.'/uploads'));
		$files = array(); 
		foreach ($rii as $file) {
		    if ($file->isDir()){ 
		        continue;
		    }

		    if($file->getFilename() == $del_img_name) {
				unlink($file->getPathname()); 
			} 
		}		
	}

}

?>



