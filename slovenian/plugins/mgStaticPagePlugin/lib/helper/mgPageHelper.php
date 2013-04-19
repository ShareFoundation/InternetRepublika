<?php
function insertContent($content, $swap = array())
{
  $content = ContentPeer::retrieveByContent($content);
	return include_partial('mg_page/content', array('content' => $content, 'swap' => $swap));
}

function url_for_static_page($pageName)
{
	if(empty($pageName)){
		return false;
	}
	$c = new Criteria();
	$c->add(PagePeer::LABEL, $pageName, Criteria::EQUAL);
	$page = PagePeer::doSelectOne($c);

	if(!empty($page)){
		return url_for('@' . $page->getLabel(), true);
	}else{
		return false;
	}
}