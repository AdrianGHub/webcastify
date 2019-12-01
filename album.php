<?php include("includes/includedFiles.php");

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
        <p role="link" tabindex="0" onclick="openPage('artist.php?id=$artistId')">By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfPodcasts(); ?> muzyczek</p>
    </div>
</div>

    <div class="tracklistContainer">
        <ul class="tracklist">
            
            <?php 
            $podcastIdArray = $album->getPodcastIds(); 

            $i = 1;
            foreach($podcastIdArray as $podcastId) {
                

                $albumPodcast = new Podcast($con, $podcastId);

                $albumArtist = $albumPodcast->getArtist(); 

                echo "<li class='tracklistRow'>
                        <div class='trackCount'>
                        <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumPodcast->getId() . "\", tempPlaylist, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>

                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumPodcast->getTitle() . "</span>    
                        <span class='artistName'>" . $albumArtist->getName() . "</  span>
                    </div>
                    
                    <div class='trackOptions'>
                        <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>" . $albumPodcast->getDuration() . "</span>
                    </div>


                    </li>";

                    $i++;

            }
            
            ?>

            <script>
            
            var tempPodcastIds = '<?php echo json_encode($podcastIdArray); ?>';
            tempPlaylist = JSON.parse(tempPodcastIds); 
            
            </script>


        </ul>

</div>

<nav class="optionsMenu">
    <input type="hidden" class="podcastId">
    <?php echo Playlist::getPlaylistDropdown($con, $userLoggedIn->getUsername()); ?>
    <div class="item">Item 2</div>
    <div class="item">Item 3</div>
</nav>