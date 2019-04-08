<?php
require_once(__DIR__ . '/Manager.php');

class Login extends Manager 
{
	public function extractAdmin()
	{
		$db= $this->dbConnect();
		$sql = 'SELECT * FROM login';
		$req = $db->query($sql);
		$dates = $req->fetch();

		return $dates;
	}
}



