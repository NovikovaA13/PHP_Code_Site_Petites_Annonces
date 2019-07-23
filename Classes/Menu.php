<?php 
class Menu{
	protected $nav;
	protected $category;
	
	public function __construct($category){
		$this->nav = '';	
		$this->category = $category;	
		return $this;
	}

	public function createLink($id, $title) {
		
		$requestUri = $_SERVER['REQUEST_URI'];
		$class = '';
		$pos = strpos($requestUri, 'cid');
		
		if($pos !== false){
			preg_match_all("#cid=(\d*)#su", $requestUri, $matchCategory);
			
			$idlink = $matchCategory[1][0];
			if ($idlink == $id){
				$class = ' active ';
			}
			
		}
		
		$categoryTitle = urldecode($title);
		$this->nav .= "<li class=\"nav-item $class\">
        <a class=\"nav-link\" href=\"$categoryTitle&cid=$id\">$title</a>
      </li>";
	 
	}
	public function showMenu(){
		
		$sql = new SQL ();
		$result = $sql->selectAll('category');

		foreach($result as $elem){
				$this->createLink($elem['id'], $elem['title']);
		}

		 return $this->nav;
	}
	public function showSelect(){
		
		$sql = new SQL ();
		$result = $sql->selectAll('category');
		if (!empty($result)) {
			$this->nav .= '<select name="category">';	
				foreach ($result as $data){
					
						$this->nav .= "<option value=\"$data[id]\" name=\"$data[title]\"> $data[title]</option>";
					
				}
			
			$this->nav .= '</select>';
		}
		return $this->nav;
	}
}