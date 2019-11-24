<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    include("includes/config.php");
    include("includes/classes/User.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Podcast.php");
    include("includes/classes/Playlist.php");
    
    if(isset($_GET['userLoggedIn'])) {
        $userLoggedIn = new User($con, $_GET['userLoggedIn']);
    }
    else {
        echo "Nazwa użytkownika nie została przekazana na stronie. Sprawdź funcje w JS ---> openPage()";
        exit();
    }
}
else {
    include("includes/header.php");
    include("includes/footer.php");

    $url = $_SERVER['REQUEST_URI'];
    echo "<script>openPage('$url')</script>";
    exit();
}


?>