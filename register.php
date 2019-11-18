<?php 

include('includes/config.php');
include('includes/classes/Account.php');
include('includes/classes/Constants.php');

// creates new object instance of the class Account
$account = new Account($con);

include('includes/handlers/register-handler.php' );
include('includes/handlers/login-handler.php' );

function getInputValue($name) {
	if(isset($_POST[$name])) {
		echo $_POST[$name];
	}
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Kurtuazyjne Brzmienie - dobry nastrój w każdej chwili!</title>
  <link rel="stylesheet" type="text/css" href="assets/css/register.css">
</head>
<body>
  
<div id="backgroud">
	<div id="loginContainer">
		<div id="inputContainer">
			<form id="loginForm" action="register.php" method="POST">
				<h2>Zaloguj się na swoje konto</h2>
					<p>
					<?php echo $account->getError(Constants::$loginFailed);  ?>
						<label for="loginUsername">Nazwa użytkownika</label>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('loginUsername'); ?>" required>  
					</p>
					<p>
						<label for="loginPassword">Hasło</label>
						<input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
					</p>
					
					<button type="submit" name="loginButton">ZALOGUJ SIĘ</button>

					<div class="hasAccountText">
						<span class="hideLogin">Nie masz jeszcze konta? Zarejestruj się tutej.</span>
					</div>

			</form>
			


			<form id="registerForm" action="register.php" method="POST">
				<h2>Załóż konto</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters);  ?>	
						<?php echo $account->getError(Constants::$usernameTaken);  ?>	
						<label for="username">Nazwa użytkownika</label>
						<input id="username" name="username" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('username'); ?>"required>  
					</p>
					<p>
					<?php echo $account->getError(Constants::$firstNameCharacters)  ?>	
						<label for="firstName">Imię</label>
						<input id="firstName" name="firstName" type="text" placeholder="e.g. Bart" value="<?php getInputValue('firstName'); ?>" required>  
					</p>
					<p>
					<?php echo $account->getError(Constants::$lastNameCharacters);  ?>	
						<label for="lastName">Nazwisko</label>
						<input id="lastName" name="lastName" type="text" placeholder="e.g. Simpson" value="<?php getInputValue('lastName'); ?>" required>  
					</p>

					<p>
					<?php echo $account->getError(Constants::$emailsDoNotMatch);  ?>	
					<?php echo $account->getError(Constants::$emailInvalid);  ?>	
					<?php echo $account->getError(Constants::$emailTaken);  ?>	
						<label for="email">Email</label>
						<input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com"value=" <?php getInputValue('email'); ?>" required>  
					</p>

					
					<p>
						<label for="email2">Potwierdź email</label>
						<input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" value=" <?php getInputValue('email2'); ?>" required>  
					</p>


					<p>
					<?php echo $account->getError(Constants::$passwordsDoNotMatch);  ?>	
					<?php echo $account->getError(Constants::$passwordNotAlphanumeric);  ?>	
					<?php echo $account->getError(Constants::$passwordsCharacters);  ?>	
						<label for="password">Hasło</label>
						<input id="password" name="password" type="password" placeholder="Your password" required>
					</p>


					<p>
						<label for="password2">Potwierdź hasło</label>
						<input id="password2" name="password2" type="password" placeholder="Your password" required>
					</p>
					
					<button type="submit" name="registerButton">ZAREJESTRUJ SIĘ</button>

					
					<div class="hasAccountText">
						<span class="hideRegister">Masz już konto? Zaloguj się tutej.</span>
					</div>

			</form>
		  </div>
		  
	<div id="loginText">
		<h1>Gdziekolwiek zmierzasz, ulubione utwory na wyciągnięcie ręki</h1>
		<h2>Słuchaj setek tysięcy kompozycji za darmo</h2>
		<ul>
			<li>Zanurz się w muzycznym akompaniamencie, który pokochasz</li>
			<li>Stwórz swoją autorską playlistę</li>
			<li>Śledź losy artystów i bądź zawsze na bieżąco</li>
		</ul>
	</div>		

  	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="assets/js/register.js"></script>
<?php
// if the register button was pressed
if(isset($_POST['registerButton'])) {
	echo '<script>
			$(document).ready(function() {
			$("#loginForm").hide();
			$("#registerForm").show();
			});
		</script>';
} else {
	echo '<script>
			$(document).ready(function() {
			$("#loginForm").show();
			$("#registerForm").hide();
			});
		</script>';
}


?>
</body>
</html>					