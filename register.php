
<?php

function sanitizeFormUsername($inputText) {
	$inputText = strip_tags($inputText);
		// replace whitespaces  
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;

}

function sanitizeFormString($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	// lowercase every character and then upercase first letter
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;

}

if(isset($_POST['loginButton'])) {
	// Login button was pressed
}

if(isset($_POST['registerButton'])) {
	// Register button was pressed
	$username = sanitizeFormUsername($_POST['username']);

	$firstName = sanitizeFormString($_POST['firstName']);

	$lastName = sanitizeFormString($_POST['lastName']);

	$email = sanitizeFormString($_POST['email']);

	$email2 = sanitizeFormString($_POST['email2']);

	$password = sanitizeFormString($_POST['password']);

	$password2 = sanitizeFormString($_POST['password2']);
	
}

?>









<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Webcastify</title>
</head>
<body>
  
  <div id="inputContainer">
	<form id="loginForm" action="register.php" method="POST">
    	<h2>Login to your account</h2>
    		<p>
				<label for="loginUsername">Username</label>
    			<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" required>  
    		</p>
    		<p>
				<label for="passwordUsername">Password</label>
    			<input id="passwordUsername" name="passwordUsername" type="password" placeholder="Your password" required>
			</p>
			
			<button type="submit" name="loginButton">LOG IN</button>
	</form>
	


	<form id="registerForm" action="register.php" method="POST">
    	<h2>Create your account</h2>
    		<p>
				<label for="username">Username</label>
    			<input id="username" name="username" type="text" placeholder="e.g. bartSimpson" required>  
			</p>
			<p>
				<label for="firstName">First name</label>
    			<input id="firstName" name="firstName" type="text" placeholder="e.g. Bart" required>  
			</p>
			<p>
				<label for="lastName">Last name</label>
    			<input id="lastName" name="lastName" type="text" placeholder="e.g. Simpson" required>  
			</p>

			<p>
				<label for="email">Email</label>
    			<input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com" required>  
			</p>

			
			<p>
				<label for="email2">Confirm email</label>
    			<input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" required>  
			</p>


			<p>
				<label for="password">Password</label>
    			<input id="password" name="password" type="password" placeholder="Your password" required>
			</p>


    		<p>
				<label for="password2">Confirm password</label>
    			<input id="password2" name="password2" type="password" placeholder="Your password" required>
			</p>
			
			<button type="submit" name="registerButton">SIGN IN</button>
    </form>
  </div>

</body>
</html>					