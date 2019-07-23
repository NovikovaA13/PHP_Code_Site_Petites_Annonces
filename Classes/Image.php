<?php
class Image{
	protected $image;
	protected $errors = [];
	protected $permitedExtensions = ['.jpg', '.JPG', '.jpeg', '.JPEG', '.png', '.PNG', '.gif', 'GIF'];
	
	public function __construct($image){
		$this->image = $image;
	}
	public function upload(){
			if ($_FILES['fileToUpload']['error'] == 0){
			
			$target_file = IMAGES .'/'. basename($_FILES['fileToUpload']['name']);			
			$fileName = $_FILES['fileToUpload']['name'];
			$fileTmpName = $_FILES['fileToUpload']['tmp_name'];
			$fileSize = $_FILES['fileToUpload']['size'];
			$fileExtension = strrchr($fileName, '.');			
			
			if (!in_array($fileExtension, $this->permitedExtensions))
				$this->error = ['Allowed are only .jpg, .JPG, .jpeg, .JPEG, .png, .PNG, .gif, GIF'];
			if ($fileSize > 2097152)
				$this->errors = ['Max size allowed is 2 Mb'];
			if (!$this->errors) {
				$ok = move_uploaded_file($fileTmpName, $target_file);
				
				if($ok){
					
					return $target_file;
				}
				else {
					return -1;
				}
			}
			else{
				return -2;
			}
		}
		else {
			return -3;
		}
	}
}