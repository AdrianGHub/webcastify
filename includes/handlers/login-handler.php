<?php

if(isset($_POST['loginButton'])) {
	// Login button was pressed
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPassword'];

	
	// check if login was successful
	$result = $account->login($username, $password);

	// if successful
	if($result) {
		// Redirect to index page
		header("Location: index.php");
	}
}

?>