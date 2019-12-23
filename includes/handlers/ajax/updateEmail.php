<?php 
include("../../config.php");


if(!isset($_POST['username'])) {
    echo "BŁĄD: Nie można ustawić nazwy użytkownika";
    exit();
}


if(isset($_POST['email']) && $_POST['email'] != "" ) {

    $username = $_POST['username'];
    $email = $_POST['email'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email jest niepoprawny";
        exit();
    }

    $emailCheck = mysqli_query($con, "SELECT email FROM users WHERE email='$email' AND username != '$username'");
    if(mysqli_num_rows($emailCheck) > 0) {
        echo "Email jest aktualnie używany";
        exit();
    }

    $updateQuery = mysqli_query($con, "UPDATE users SET email = '$email' WHERE username='$username'");
    echo "Poprawnie zaktualizowano adres email";

}
else {
    echo "BŁĄD: Wprowadź pożądany adres email";
}

?>

