<?php 
class UserAdder {
	use Country;
	public function __construct(){
	}
	public function createNewUser($login, $name, $surname, $password, $dateBirthday, $mail, $dateRegistration, $adresse, $town, $country){
		$sql = new SQL();
		$result = $sql->insert('users', ['login' => $login,
											  'name' => $name,
											  'surname' => $surname,
											  'password' => $password,
											  'dateBirthday' => $dateBirthday,
											  'mail' => $mail,
											  'dateRegistration' => $dateRegistration,
											  'adresse' => $adresse,
											  'town' => $town,
											  'country' => $country]);
		return $result;
	}
											
	public function verifyLoginExisted ($login){
		$sql = new SQL();
		$result = $sql->selectOneLine('users', ['login' => $login]);
		return $result;
	}
}