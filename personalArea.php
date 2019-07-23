<?php
include('biblioPOO.php');
if(isset($_SESSION['auth'])) {

		$content  = '';
		//delete
		if (isset($_GET['deleteId'])){
			
			$advertForDelete = new Advert($_GET['deleteId']);
			$result = $advertForDelete->deleteAdvert();			
			if($result){
				$_SESSION['message'] = [
								'text' => 'Annonce is deleted succesfully', 
								'status' => 'succes'
								];
			}
		}
		if (isset($_GET['topId'])){
			
			$advertToTop = new Advert($_GET['topId']);
			$result = $advertToTop->moveToTop();

				switch ($result){
					case 1 :
					$_SESSION['message'] = [
									'text' => 'Annonce is topped succesfully', 
									'status' => 'succes'
									];
					break;
				
					case -1 :
					$_SESSION['message'] = [
									'text' => 'Anything is wrong', 
									'status' => 'error'
									];
					break;
					case -2 :
					$_SESSION['message'] = [
									'text' => 'Only 1 time by day it\'s possible to take your advert to top', 
									'status' => 'error'
									];
					break;
				}
			
		
		}

			
		$userId = $_SESSION['userId'];
		$manager = new Manager(-1, -1, 'adverts');
		$content = $manager->showAdminPage($userId);
		

	$paging = '';

	$title = 'Admin';
	
	include('assets/elems/layout.php');
}
else{
	header('Location: login.php'); die();
}