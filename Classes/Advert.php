<?php 
class Advert {
	protected $producttId;
	protected $categoryId;
	protected $dateRegistration;
	protected $text;
	protected $phone;
	
	public function __construct($id){
		$select = new SQL();
		$this->advertId = $id;
		$data = $select->selectOneLine('adverts', ['id' => $this->advertId]);
		$this->categoryId = $data['categoryId'];
		$this->text = $data['text'];
		$this->phone = $data['phone'];
		$this->dateRegistration = $data['dateRegistration'];
		$this->userIdCreateur = $data['userId'];
	
	}
	public function deleteAdvert(){
		$sqlDelete = new SQL();
		$result = $sqlDelete->deleteDromTable('adverts', "id={$this->advertId}");
		return $result;
	}
	public function moveToTop(){
		$sqlToTop = new SQL();
		$res = $sqlToTop->selectOneLine('adverts', ['id' => $this->advertId], "TO_DAYS(NOW()) - TO_DAYS(dateRegistration) as diff");
		
		if($res["diff"] > 1){ 
		
			$updateAdvert = new SQL();
			$result = $updateAdvert->updateTime('adverts', "dateRegistration = NOW()", "id = {$this->advertId}");
		
		if($result){
			return 1;
		}
		
		else{
			return -1;
		}			
		
		}
		else {
			return -2;
		}
		
	}
	
}
?>