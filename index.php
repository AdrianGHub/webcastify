<?php 

include("includes/config.php");

//session_destroy(); --> manual logout


// check if user is logged in
if(isset($_SESSION['userLoggedIn'])) {
  $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
  header("Location: register.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome to Webcastify</title>
</head>
<body>
  <h1>Webcastify</h1>
</body>
</html>