<?php
    include("../../config.php");

    if(isset($_POST['podcastId'])) {
        $podcastId = $_POST['podcastId'];

        $query = mysqli_query($con, "UPDATE podcasts SET plays = plays + 1  WHERE id='$podcastId'");

        $resultArray = mysqli_fetch_array($query);
    }
?>