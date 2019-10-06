<?php

  class Account {

    public function __construct() {

	}

	public function register($us, $fn, $ln, $em, $em2, $pw, $pw2) {	
		$this->validateUsername($us);
		$this->validatefirstName($fn);
		$this->validatelastName($ln);
		$this->validateEmails($em, $em2);
		$this->validatePasswords($pw, $pw2);
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