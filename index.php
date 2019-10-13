<?php
include("includes/config.php");

//session_destroy(); LOGOUT

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
}


?>

<html>
<head>
	<title>Welcome to Webcstify!</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>


	<body>
		

		<div id="mainContainer">
		
			<div id="topContainer">

				<?php include("includes/navBarContainer.php"); ?>

			</div>


			<div id="nowPlayingBarContainer">

				<?php include("includes/nowPlayingBarContainer.php"); ?>

			</div>

		</div>


	</body>

</html>