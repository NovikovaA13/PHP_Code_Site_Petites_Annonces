<?php
include('biblioPOO.php');
if(isset($_SESSION['auth'])) {

	$userId = $_SESSION['userId'];
	$selectCategory = new Menu('Category');
	$select = $selectCategory->showSelect();
	

	if (!empty($_POST['submit'])) {
		if (!empty($_POST['text'])){
		$textAdvert = $_POST['text'];
		if (isset($_FILES["fileToUpload"])){
			$image = new Image($_FILES['fileToUpload']);
			$imgSrc = $image->upload();
			if (strlen($imgSrc) > 2){
				$textAdvert .= "<div class=\"row images-all\">
				<div class=\"images-thumb\">
				<a class=\"thumbnail preview\" href=\"$imgSrc\">
				<img  data-cfsrc=\"$imgSrc.jpg\" ><img  src=\"$imgSrc\"></a>
				</div>
				</div>";
				var_dump($textAdvert);
				
			}
			elseif ($imgSrc == -1){
				
				$_SESSION['message'] = [
											'text' => 'Image isn\'t moved corretly!', 
											'status' => 'warning'
											];
			}
						
			elseif ($imgSrc == -2){
					$_SESSION['message'] = [
														'text' => $error[0], 
														'status' =>'warning'
														];
			}
					
			elseif ($imgSrc == -3){
				$_SESSION['message'] = [
															'text' => 'Image of product isn\'t uploaded correctly', 
															'status' => 'warning'
															];
			}
		}
		$advertAdder = new AdvertAdder($_POST['category'], $textAdvert, $_POST['phone'], $userId);
		$result = $advertAdder->save();
		$text = $_POST['text'];
		$phone = $_POST['phone'];
			if($result){
				$_SESSION['message'] = [
										'text' => 'Annonce is created succesfully', 
										'status' => 'succes'
										];
			}

		}
		
	} else {
		
		$text = '';
		$phone = '';
		$Category = '';
		
	}
	
	$title = 'Create new Advert';
	$paging = '';
	ob_start();
	include('assets/elems/formNewAdvert.php');	
	$content = ob_get_clean();
	include('assets/elems/layout.php');
	}
else{
	header('Location: login.php'); die();
}
?>