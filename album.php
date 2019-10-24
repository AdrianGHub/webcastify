<?php include("includes/header.php"); 

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
} 
else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);


$artist = $album->getArtist();

?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="">
    </div>

    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfPodcasts(); ?> podcasts</p>
    </div>
</div>

    <div class="tracklistContainer">
        <ul class="tracklist">
            
            <?php 
            $podcastIdArray = $album->getPodcastIds(); 

            $i = 1;
            foreach($podcastIdArray as $podcastId) {
                

                $albumPodcast = new Podcast($con, $podcastId);

                echo $albumPodcast->getTitle() . "<br>";
                $albumArtist = $albumPodcast->getArtist(); 

                echo "<li class='tracklistRow'>
                        <div class='trackCount'>
                        <img class='play' src='assets/images/icons/play-white.png'>
                            <span class='trackNumber'>$i</span>
                        </div>

                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumPodcast->getTitle() . "</span>    
                        <span class='artistName'>" . $albumArtist->getName() . "</  span>
                    </div>
                    
                    <div class='trackOptions'>
                        <img class='optionsButton' src='assets/images/icons/more.png'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>" . $albumPodcast->getDuration() . "</span>
                    </div>


                    </li>";

                    $i++;

            }
            
            ?>


        </ul>

</div>






<?php include("includes/footer.php"); ?>