<?php
include('biblioPOO.php');

if (isset($_GET['id'])){
	
	$categoryId = $_GET['id'];
}
else {
	header ('Location: index.php');
}


if (!isset($_GET['page'])) {
	$page = 1;
}
else {
	$page = $_GET['page'];
}
$numberOfLines = 21;

//listing
$Category = new Category($categoryId, 'category');
$title = $Category->getName();
$listing = new Manager ($numberOfLines, $page, 'adverts', $categoryId, $title);
$content = $listing->showPage();
$paging = $listing->showPaging(); 



include('assets/elems/layout.php');
