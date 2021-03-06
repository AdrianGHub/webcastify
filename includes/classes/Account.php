<?php

  class Account {

	private $con;
	// Array of errors
	private $errorArray;

    public function __construct($con) {
		$this->con = $con;
		$this->errorArray = array();
	}

	public function login($un, $pw) {
		// encrypt password
		$pw = md5($pw);
		
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND pass='$pw'");
		
		if(mysqli_num_rows($query) == 1) {
			return true;
		} else {
			array_push($this->errorArray, Constants::$loginFailed);
			return false;
		}
	}

	public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {	
		$this->validateUsername($un);
		$this->validateFirstName($fn);
		$this->validateLastName($ln);
		$this->validateEmails($em, $em2);
		$this->validatePasswords($pw, $pw2);

		if(empty($this->errorArray)) {
			// Insert into db
			return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
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

	private function insertUserDetails($un, $fn, $ln, $em, $pw) {
		// method to encrypt password into 32 chars
		$encryptedPw = md5($pw);
		$profilePic = "assets/images/profile-pics/head_emarald.png";
		$date = date("Y-m-d");

		// returns true or false
		$result = mysqli_query($this->con, "INSERT INTO users VALUES (NULL, '$un', '$fn', '$ln', '$em', '$encryptedPw','$date','$profilePic')");

		return $result;
	}
	  
	// USERNAME VALIDATE HANDLER  
	private function validateUsername($un) {
		// username has to be between 5 and 25 chars
		if(strlen($un) > 25 || strlen($un) < 5) {
			array_push($this->errorArray, Constants::$usernameCharacters);
			return;
		}

		//TODO: check if username exists // DONE!
		$checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
		if(mysqli_num_rows($checkUsernameQuery) != 0) {
			array_push($this->errorArray, Constants::$usernameTaken);
			return;
		}
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

		//TODO: Check that email hasn't already been used. // DONE!
		$checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
		if(mysqli_num_rows($checkEmailQuery) != 0) {
			array_push($this->errorArray, Constants::$emailTaken);
			return;
		}
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

		if(strlen($pw) > 30 || strlen($pw) < 5) {
			array_push($this->errorArray, Constants::$passwordsCharacters);
			return;
		}

  } 
}
?>