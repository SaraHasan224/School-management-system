<?php
// $curl = strlen($_SERVER['QUERY_STRING']) ? basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'] : basename($_SERVER['PHP_SELF']);
$curl = $this->uri->segment(1);
/*
|--------------------------------------------------------------------------
| Meta TAGs 
|--------------------------------------------------------------------------
*/
// define('BASE_URL', "http://" . $_SERVER['HTTP_HOST'].'/farukh/teachers-virtual-lounge/php/admin/');
define('BASE_URL', "http://" . $_SERVER['HTTP_HOST'].'/rzbsms');

define('PROJECT_NAME', 'RZBSMS');

defined('SEO_TITLE') OR define('SEO_TITLE', 'SEO');
defined('META_DIS') OR define('META_DIS', 'Provide You Description');
defined('META_KEYW') OR define('META_KEYW', 'Provide, You, keyword');

function pageTitle ($title = NULL, $domain = NULL){
	$page = strlen($_SERVER['QUERY_STRING']) ? basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'] : basename($_SERVER['PHP_SELF']);
	
	$ptitle = ucwords(str_replace(".php", "", $page));
	if ($ptitle == "" || strtolower($ptitle) == "index"){	 
	  echo "Welcome to ".PROJECT_NAME;
	}else{
	  echo $ptitle.' - '.PROJECT_NAME;
	}
}