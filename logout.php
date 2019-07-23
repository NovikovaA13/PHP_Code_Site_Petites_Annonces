<?php
include('biblioPOO.php');
session_destroy();

$_SESSION['message'] = [
					'text'=>"Your are anonymus!", 
					'status'=>"succes"
					];
header("Location: index.php");
