<?php 
include("../../config.php");


if(!isset($_POST['username'])) {
    echo "BŁĄD: Nie można ustawić nazwy użytkownika";
    exit();
}


if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword2'])) {
    echo "Wypełnij wszystkie pola ze wskazaniem hasła";
    exit();
}

if($_POST['oldPassword'] = "" || $_POST['newPassword1'] == "" || $_POST['newPassword2'] == "") {
    echo "Wypełnij wszystkie pola ze wskazaniem hasła";
    exit();
}

$username = $_POST['username'];
$oldPassword = $_POST['oldPassword'];
$newPassword1 = $_POST['newPassword1'];
$newPassword2 = $_POST['newPassword2'];

$oldMd5 = md5($oldPassword);

echo $oldMd5;

$passwordCheck = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND pass='$oldMd5'");
if(mysqli_num_rows($passwordCheck) != 1) {
    echo "Hasło jest niepoprawne";
    exit();
}

if($newPassword1 != $newPassword2) {
    echo "Podane hasła różnią się od siebie";
    exit();
}

if(preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
    echo "Twoje hasło może zawierać tylko litery oraz/lub cyfry";
    exit();
}

if(strlen($newPassword1) > 30 || strlen($newPassword1) < 5) {
    echo "Twoje hasło musi zawierać od 5 do 30 znaków";
    exit();
}

$newMd5 = md5($newPassword1);

$query = mysqli_query($con, "UPDATE users SET pass='$newMd5' WHERE username='$username'");
echo "Poprawnie zaktualizowano hasło";

?>

