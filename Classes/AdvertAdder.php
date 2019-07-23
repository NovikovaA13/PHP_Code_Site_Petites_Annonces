<?php 
class AdvertAdder{
	
	protected $userCreateurId;
	protected $categoryId;
	protected $dateRegistration;
	protected $text;
	protected $phone;
	
	public function __construct ($categoryId, $text, $phone, $userId){
		$this->categoryId = $categoryId;
		$this->text = $text;
		$this->dateRegistration = date('Y-m-d H:i:s');
		$this->phone = $phone;
		$this->userCreateurId = $userId;
	}
	public function save(){
		$insert = new SQL();
		$result = $insert->insert('adverts', 
						['text' => $this->text,
						'categoryId' => $this->categoryId,
						'dateRegistration' => $this->dateRegistration,
						'phone' => $this->phone,
						'userId' => $this->userCreateurId
						]);
		return $result;
		
	}
}