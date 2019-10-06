<?php

  class Account {

	// Array of errors
	private $errorArray;

    public function __construct() {
		$this->errorArray = array();
	}

	public function register($us, $fn, $ln, $em, $em2, $pw, $pw2) {	
		$this->validateUsername($us);
		$this->validateFirstName($fn);
		$this->validateLastName($ln);
		$this->validateEmails($em, $em2);
		$this->validatePasswords($pw, $pw2);

		if(empty($this->errorArray)) {
			// Insert into db
			return true;
		} else {
			return false;
		}
	}

	// ERROR HANDLER
	// if error we passed in is in the array of errors
	public function getError($error) {
		if(!in_array($error, $this->errorArray)) {
			$error = "";
		}
		return "<span class='errorMessage'>$error</span>";
	}
	  
	// USERNAME VALIDATE HANDLER  
	private function validateUsername($un) {
		// username has to be between 5 and 25 chars
		if(strlen($un) > 25 || strlen($un) < 5) {
			array_push($this->errorArray, Constants::$usernameCharacters);
			return;
		}

		//TODO: check if username exists
	}
	
	// FIRSTNAME VALIDATE HANDLER
	private function validateFirstName($fn) {
		if(strlen($fn) > 25 || strlen($fn) < 2) {
			array_push($this->errorArray, Constants::$firstNameCharacters);
			return;
		}
	}	
	
	// LASTNAME VALIDATE HANDLER
	private function validateLastName($ln) {
		if(strlen($ln) > 25 || strlen($ln) < 2) {
			array_push($this->errorArray, Constants::$lastNameCharacters);
			return;
		}
	}
	
	// EMAILS VALIDATE HANDLER
	private function validateEmails($em, $em2) {
		if($em != $em2) {
			array_push($this->errorArray, Constants::$emailsDoNotMatch);
			return;
		}
		if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
			array_push($this->errorArray, Constants::$emailInvalid);
			return;
		}

		//TODO: Check that username hasn't already been used.
	}
	
	// PASSWORDS VALIDATE HANDLER
	private function validatePasswords($pw, $pw2) {
		if($pw != $pw2) {
		array_push($this->errorArray, Constants::$passwordsDoNotMatch);
		return;
		}

		if(preg_match('/[^A-Za-z0-9]/', $pw)) {
			array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
			return;
		}

		if(strlen($pw) > 30 || strlen($pw) < 6) {
			array_push($this->errorArray, Constants::$passwordsCharacters);
			return;
		}

  } 
}
?>