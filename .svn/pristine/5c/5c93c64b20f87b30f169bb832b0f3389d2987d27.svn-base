<?php



	/********************************************************************************
	 * 分页方法 
	 * $url	      		链接前缀
	 * $total	  		总条数
	 * $page	  		当前页
	 * $limit	  		每页条数
	 * manage_pages()   后台管理分页
	 ********************************************************************************/



if( ! function_exists('manage_pages'))
{
	
	function manage_pages($url=NULL,$total=0,$page=1,$limit=20)
	{
		$pages = NULL;
		if($limit<1) $limit = 20;
		$max_page = ceil( $total/$limit);
		
		$pages .= '<div class="fl">';
		if($page>1){
			$pages .= '<input type="button" value="首页" onclick="location.href='."'".$url.'/1/'.$limit."'".'"></input> ';
			$pages .= '<input type="button" value="上一页" onclick="location.href='."'".$url.'/'.($page-1).'/'.$limit."'".'"></input> ';
		}else{
			$pages .= '<input type="button" value="首页" disabled="disabled"></input> ';
			$pages .= '<input type="button" value="上一页" disabled="disabled"></input> ';
		}
		
		if($total>0){
			$pages .= '<select class="select" onchange="location.href='."'".$url.'/'."'+this.value+'".'/'.$limit."'".'">';
			for($i=1; $i<=$max_page; $i++){
				if($page==$i){
					$pages .= '<option value="'.$i.'" selected="selected">'.$i.'/'.$max_page.'</option>';	
				}else{
					$pages .= '<option value="'.$i.'">'.$i.'/'.$max_page.'</option>';	
				}
			}
			$pages .= '</select> ';
		}else{
			$pages .= '<select class="select" disabled="disabled"><option>0/0</option></select> ';
		}
		
		if($page < $max_page){
			$pages .= '<input type="button" value="下一页" onclick="location.href='."'".$url.'/'.($page+1).'/'.$limit."'".'"></input> ';
			$pages .= '<input type="button" value="尾页" onclick="location.href='."'".$url.'/'.$max_page.'/'.$limit."'".'"></input> ';
		}else{
			$pages .= '<input type="button" value="下一页" disabled="disabled"></input> ';
			$pages .= '<input type="button" value="尾页" disabled="disabled"></input> ';
		}
		$pages .= '</div>';
		$pages .= '<div class="fr">共'.$total.'条 '.$limit.'条/页</div>';
		
		return $pages;
	}
	
}