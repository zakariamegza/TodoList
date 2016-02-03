<?php

class User{

	private $username;
	private $password;
	private $type;
	
	
	function User($username,$password,$type){
		$this->username=$username;
		$this->password=$password;
		$this->type=$type;
		
	}


	function getUsername(){
		return $this->username;
	}

	function getPassword(){
		return $this->password;
	}
	function Type(){
		return $this->type;
	}

	function toString(){
	 return $this->username.":".$this->password;
	
	}
}