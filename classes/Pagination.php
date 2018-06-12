<?php
class Pagination{
	public static function get_pagination($limit = 'all',$total_rows){
		if($limit == 'all'){
			return;
		}
		$page  = isset($_GET['page'])? $_GET['page'] : 1;
		$total_pages = $total_rows/$limit;
		$html = '<ul class="pagination">';
		
		for ($i=1; $i <$total_pages+1; $i++) {
			if($i == $page){
				$active = 'active';
			}
			else{
				$active = '';
			}
			$html .= '<li class="pg-no '.$active.'"><a href="?page='.$i.'">'.$i.'</a></li>';
		}
		$html .= '</ul>';
		echo $html;
	}
}
?>