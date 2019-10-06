
<?php

// sanitizeFormUsername
function sanitizeFormUsername($inputText) {
	$inputText = strip_tags($inputText);
		// replace whitespaces  
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}

// sanitizeFormString
function sanitizeFormString($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	// lowercase every character and then upercase first letter
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}

// sanitizePassword
function sanitizePassword($inputText) {
	$inputText = strip_tags($inputText);
	return $inputText;
}

function validateUsername($un) {
};

function validateFirstname($fn) {
};

function validateLastname($ln) {
};

function validateEmails($em, $em2) {
};

function validatePasswords($pw, $pw2) {
};
	


if(isset($_POST['registerButton'])) {
	// Register button was pressed
	$username = sanitizeFormUsername($_POST['username']);
	$firstName = sanitizeFormString($_POST['firstName']);
	$lastName = sanitizeFormString($_POST['lastName']);
	$email = sanitizeFormString($_POST['email']);
	$email2 = sanitizeFormString($_POST['email2']);
	$password = sanitizePassword($_POST['password']);
	$password2 = sanitizePassword($_POST['password2']);

	validateUsername($username);
	validatefirstName($firstName);
	validatelastName($lastName);
	validateEmails($email, $email2);
	validatePasswords($password, $password2);
	
}

?>