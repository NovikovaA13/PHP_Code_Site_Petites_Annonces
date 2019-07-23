<?php
require_once("biblioPOO.php");
$content = '';
if ((!empty($_POST['login'])) && (!empty($_POST['password']))) {
	
	$user = new User($_POST['login']);
	if($user->login($_POST['login'], $_POST['password'])){
		$_SESSION['auth'] = true;
		$_SESSION['userId'] = $user->getId();
		$_SESSION['status'] = $user->getStatus();
		$_SESSION['login'] =  $user->getLogin();
		$_SESSION['message'] = [
			'text' => 'Your login succesfully with hash!', 
			'status' => 'succes'
			];
		header('Location: personalArea.php'); die();
	} else {
		$content = 'Wrong login or password';
	}
	
	
	$login = $_POST['login'];
	$password = $_POST['password'];
}
else {

	$login = '';
	$password = '';
	}
	
$paging = '';	
$title = 'Log In User';
ob_start();
include('assets/elems/formLogin.php');
$content .= ob_get_clean();
include('assets/elems/layout.php');

