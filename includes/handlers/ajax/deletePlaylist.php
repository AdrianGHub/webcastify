<?php 

include("../../config.php");

if(isset($_POST['playlistId'])) {
    $playlistId = $_POST['playlistId'];

    $playlistQuery = mysqli_query($con, "DELETE FROM playlists WHERE id='$playlistId' ");
    $playlistQuery = mysqli_query($con, "DELETE FROM playlistPodcasts WHERE playlistId='$playlistId' ");
}
else {
    echo "Parametr playlistId nie został przekazana do pliku deletePlaylist.php ";
}

?>