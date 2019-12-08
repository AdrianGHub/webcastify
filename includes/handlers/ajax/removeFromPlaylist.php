<?php 
include("../../config.php");

if(isset($_POST['playlistId']) && isset($_POST['podcastId'])) {
    $playlistId = $_POST['playlistId'];
    $podcastId = $_POST['podcastId'];

    $query = mysqli_query($con, "DELETE FROM playlistPodcasts WHERE playlistId='$playlistId' AND podcastId='$podcastId' ");
}
else {
    echo "Parametr playlistId lub podcastId nie został przekazany do pliku removeFromPlaylist.php";
}

?>