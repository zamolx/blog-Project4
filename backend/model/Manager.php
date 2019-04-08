<?php

class Manager 
{
	var $host_name = '';
	var $database = '';
	var $user_name = '';
	var $password = '';
	protected function dbConnect()
    {
        $db = new PDO("mysql:host=$this->host_name; dbname=$this->database;", $this->user_name, $this->password);
        return $db;
    }
}
