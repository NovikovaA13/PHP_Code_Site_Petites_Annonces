<?php 
class Manager{
	protected $numberOfLines;
	protected $page;
	protected $nameTable;
	protected $limit;
	protected $content;
	protected $paging;
	protected $categoryId;
	protected $categoryTitle;
	
	
	public function __construct($numberOfLines, $page, $nameTable, $categoryId = null, $categoryTitle = null){
		
		$this->numberOfLines = $numberOfLines;
		$this->page = $page;
		$this->nameTable = $nameTable;
		$this->limit = ($this->page - 1) * $this->numberOfLines;
		
		if (isset($categoryId)){
			
			$this->categoryId = $categoryId;
			$this->categoryTitle = $categoryTitle;
		}
	}
	public function showPage(){
		
		$this->content = '';
		$sql = new SQL();
		if (isset($this->categoryId)){
			
			$data = $sql->selectWithLimitAndCond($this->nameTable, "{$this->limit}, {$this->numberOfLines}", ['categoryId' => $this->categoryId], 'dateRegistration DESC');

		}
		else{
			
			$data = $sql->selectAllWithLimit($this->nameTable, "{$this->limit}, {$this->numberOfLines}", 'dateRegistration DESC');

		}
		
		foreach ($data as $el) {
			$dateNow = date ('d.m.Y', strtotime($el['dateRegistration']));
			$contentPage = '<div class="card">';
			if ($el['descr']){
			$contentPage .= "<div class=\"card-header\">{$el['descr']}</div>";
			}
			
				$contentPage .=	"<div class=\"card-body\">
												<p class=\"card-text\">{$el['text']}</p>
												<div class=\"float-left\"><img src=\"assets/glyph-iconset-master/svg/si-glyph-calendar-1.svg\" class=\"glyphicon\"/>Writed at  $dateNow</div>";
												if ($el['phone'] != 0){
													$contentPage .= "<div class=\"float-right\"><img src=\"assets/glyph-iconset-master/svg/si-glyph-phone-number.svg\" class=\"glyphicon\"/>{$el['phone']}</div>";	
												}
			$contentPage .= '</div>';
			if ($el['descr'] == 0){
				$contentPage .= '</div>';		
			}				
			 $contentPage .= '</div>';
			
			 $divOpen = substr_count($contentPage, '<div');
			 $divClose =substr_count($contentPage, '</div>');
			 if ($divClose > $divOpen){
				 $dif = $divClose - $divOpen;
				  $this->content .=  str_repeat('<div>', $dif); 
			 }
				$this->content .= "$contentPage<hr>";

		}
		return $this->content;
	}
	
	public function showPaging(){
		
		$this->paging = '';		
		$countSQL = new SQL();
		
		if (isset($this->categoryId)){
			
			$allRows = $countSQL->countLinesWithCond('adverts', ['categoryId' => $this->categoryId]);
			
		}
		else{
			$allRows = $countSQL->countLines('adverts');
		}
		$allPages = ceil($allRows / $this->numberOfLines);

		if ($this->page > 1) {
			
			$previous = $this->page - 1;
			$classDisabled = '';
			
		}
		else {
			
			$previous = 1;
			$classDisabled = ' disabled';
		}
			
			$start = $this->page - 5;
			if ($start < 1){
				
				$start = 1;
				
			}
			else{
				
				$this->paging .= "<li class=\" page-item\"><a href=\"?page=1\" tabindex=\"-1\" class=\"page-link\" aria-label=\"Fisrt\">
					<span aria-hidden=\"true\">Fisrt</span>
				</a></li>";
			}
			
			$this->paging .= "<li class=\" page-item $classDisabled\"><a href=\"?page=$previous\" tabindex=\"-1\" class=\"page-link\" aria-label=\"Previous\">
					<span aria-hidden=\"true\">&laquo;</span>
				</a></li>";
				
			$finish = $this->page + 5;
			if ($finish > $allPages){
				
				$finish = $allPages;
				$strLast = '';
				
			}
			else {
				$strLast = "<li class=\" page-item\"><a href=\"?page=$allPages\" tabindex=\"-1\" class=\"page-link\" aria-label=\"Last\">
					<span aria-hidden=\"true\">Last</span>
				</a></li>";
			}
			
			for ($i = $start; $i <= $finish; $i++){
				
				if ($i == $this->page){
					
					$class =' active';
				}
				else {
					
					$class = '';
				}
				if ($this->categoryId == 0){
					
					$line = $this->categoryTitle = 'index.php?';
					
				}
				else {
					$line = "$this->categoryTitle&cid=$this->categoryId";
				}
				$line .= "&page=$i";
				$line = str_replace("?&", "?", $line);
				$this->paging .= "<li class=\"page-item $class\"><a class=\"page-link\" href=\"$line\">$i</a></li>";
			}
			
			if ($this->page < $allPages) {
				
			$next = $this->page + 1;
			$classDisabled = '';
			
			}
			else {
				$next = $this->page;
				$classDisabled = 'disabled';
			}
			
			
			$this->paging .= "<li class =\"page-item $classDisabled\"><a href=\"?page=$next\" class=\"page-link\" aria-label=\"Next\>
					<span aria-hidden=\"true\">&raquo;</span>
				</li></a>										
			</li>";
						
			$this->paging .= $strLast;
			
		return $this->paging;
	}
	
	public function showAdminPage($idUser){
		$sql = new SQL();
		$result = $sql->selectWithCondition('adverts', "userId = $idUser", 'dateRegistration DESC');
		
		
		if ($result){
			$this->content .= '<table class=\"table-striped padding\"><thead padding>
			<th padding>Id</th>
			<th padding>Date:</th>
			<th padding>Text</th>
			<th padding>To top </th>
			<th padding>Delete</th>
			</thead>';
			foreach ($result as $data){
			
				$text = mb_substr(trim($data['text']), 0, 300)."...";
				$this->content .= "<tr class=\"padding\">
				<td class=\"padding\">$data[id]</td>
				<td class=\"padding\">$data[dateRegistration]</td>
				<td class=\"padding\">$text</td>
				<td class=\"padding\"><a href=\"?topId=$data[id]\">Top up annonce X</a></td>
				<td class=\"padding\"><a href=\"?deleteId=$data[id]\">Delete X</a></td>
				
				</tr>";
		}

		$this->content .= '</table>';
		}
		else {
			$this->content .= 'You don\'t have adverts';
		}
		return $this->content;
	}
}