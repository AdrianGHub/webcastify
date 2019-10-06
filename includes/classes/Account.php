<?php

  class Account {

    public function __construct() {

	}

	public function register() {	
		$this->validateUsername($username);
		$this->validatefirstName($firstName);
		$this->validatelastName($lastName);
		$this->validateEmails($email, $email2);
		$this->validatePasswords($password, $password2);
	}
	  
	  
	private function validateUsername($un) {
		echo "function was called";
	}
	
	private function validateFirstname($fn) {

	}
	
	private function validateLastname($ln) {

	}
	
	private function validateEmails($em, $em2) {

	}
	
	private function validatePasswords($pw, $pw2) {

	}


  }
?>