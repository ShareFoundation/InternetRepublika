<?php if(is_object($content)) { 
	$content = sfOutputEscaper::unescape($content->getText());
	if(!empty($swap)){
		foreach($swap as $key=>$val){
			$content = str_replace('%%' . $key . '%%', $val, $content); 
		}
	}
	echo $content;
}else{ 
} ?>		