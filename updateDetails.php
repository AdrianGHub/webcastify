<?php
include("includes/includedFiles.php");
?>

<div class="userDetails">

    <div class="container borderBottom">

    <h2>EMAIL</h2>
    <input type="text" class="email" name="email" placeholder="Adres email..." value="<?php echo $userLoggedIn->getEmail(); ?>">
    <span class="message"></span>
    <button class="settingsButton" onclick="updateEmail('email')">ZAPISZ</button>

    </div>

    <div class="container">

    <h2>PASSWORD</h2>
    <input type="password" class="oldPassword" name="oldPassword" placeholder="Aktualne hasło...">
    <input type="password" class="newPassword1" name="newPassword1" placeholder="Nowe hasło...">
    <input type="password" class="newPassword2" name="newPassword2" placeholder="Potwierdź hasło...">
    <span class="message"></span>
    <button class="settingsButton" onclick="updatePassword('oldPassword', 'newPassword1', 'newPassword2')">ZAPISZ</button>
    
    </div>

</div>