<div class="media-opac"></div>
<div class="media-container">
	<div class="close-media">X</div>
	<ul class="media-tabs">
		<li class="media-tab-1 media-tab-active">Upload</li>
		<li class="media-tab-2">Gallery</li>
	</ul>

	<div class="media-upload">
		<form method = "POST" action = "" enctype="multipart/form-data" id="media-form">
			<div class="form-group">
				<input type="file" name="media-upload" id="media-upload" multiple ="multiple" accept=".jpeg,.jpg,.png">
				<?php
					if(isset($media_size)){
						echo '<input type="hidden" name="media-size" id = "media-size" data-media-upl='.json_encode($media_size).'>';
					}
				?>
			</div>
			<input type="button" value="upload" id="upload-now">
		</form>
		<ul id="uploaded-area"></ul>
	</div>
	<div class="media-gallery">
		<?php

		$gallery_array = scandir(ROOT.'/uploads/110X110');
	
		$sort_gallery = array();
		foreach ($gallery_array as $value) {
			$extension = strtolower(end(explode('.',$value)));
			$extensions = array('jpg','jpeg','png');
			if(in_array($extension,$extensions )){
				$last_modified = (int) filemtime(ROOT.'/uploads/110X110/'.$value);
				while(array_key_exists($last_modified, $sort_gallery)){$last_modified++;}
				$sort_gallery[$last_modified] = $value;
			}
		}
		krsort($sort_gallery);
		$html = '<ul class="media-uploading">';
		foreach ($sort_gallery as $item) {
			$html .= '<li class="media-gallery-li"><img src="'.REL.'/uploads/110X110/'.escape($item).'" /></li>';
		}
		$html .= '</ul>';
		echo $html;

		
		
		?>
		<div class="media-info">
			<button class="btn btn-danger delete-media">Delete Image</button>
		</div>
		<button class="btn btn-primary insert-media">Insert Image</button>
	</div>
</div>
