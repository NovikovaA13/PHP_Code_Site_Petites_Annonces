<?php
include('biblioPOO.php');

	if (isset($_GET['page']))
		$page = $_GET['page'];
	else $page = '/';




if (!isset($_GET['page'])) { 
	$page = 1;
}
else {
	$page = $_GET['page'];
}
$numberOfLines = 21;

$index = new Manager ($numberOfLines, $page, 'adverts');
$content = $index->showPage();
$paging = $index->showPaging();




	$title = 'All adverts';

include('assets/elems/layout.php');
