<?php 
 include("../../config.php");



    if(isset($_POST['playlistId']) && isset($_POST['podcastId']) ) {
        $playlistId = $_POST['playlistId'];
        $podcastId = $_POST['podcastId'];

        $orderIdQuery = mysqli_query($con, "SELECT IFNULL(MAX(playlistOrder) + 1, 1) as playlistOrder FROM playlistPodcasts WHERE playlistId='$playlistId'");
        $row = mysqli_fetch_array($orderIdQuery);
        $order = $row['playlistOrder'];

        $query = mysqli_query($con, "INSERT INTO playlistPodcasts VALUES('', '$podcastId', '$playlistId', '$order')");
    }
    else {
        echo "Playlist lub podcastId nie został przekazany do pliku addToPlaylist.php";
    }






?>

