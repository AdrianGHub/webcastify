<?php 
include("includes/includedFiles.php");

if(isset($_GET['id'])) {
    $artistId = $_GET['id'];
} 
else {
    header("Location: index.php");
}

$artist = new Artist($con, $artistId);
?>

<div class="entityInfo borderBottom">

    <div class="centerSection">

        <div class="artistInfo">
            <h1 class="artistName"><?php echo $artist->getName() ?></h1>
            <div class="headerButtons">
                <button class="artistButton green" onclick="playFirstPodcast()">ODTWÓRZ</button>
            </div>
        </div>

    </div>

</div>

<div class="tracklistContainer borderBottom">
    <h2>MUZYCZKA</h2>
        <ul class="tracklist">
            
            <?php 
            $podcastIdArray = $artist->getPodcastIds(); 

            $i = 1;
            foreach($podcastIdArray as $podcastId) {

                if($i > 5) {
                break;
                }
                

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
                        <input type='hidden' class='podcastId' value='" . $albumPodcast->getId() . "'>
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

<div class="gridViewContainer">
            <h2>ALBUMY</h2>
<?php  
    $albumQuery = mysqli_query($con, "SELECT * FROM album WHERE artist='$artistId'");

    while($row = mysqli_fetch_array($albumQuery)) {
        
        
        echo "<div class='gridViewItem'>
                <span role='link' tabindex=
                '0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
                    <img src='" . $row['artworkPath'] . "'>

                    <div class='gridViewInfo'>"
                        . $row['title'] .
                    "</div>
                </span>
            </div>";
    }

?> 



</div>

<nav class="optionsMenu">
    <input type="hidden" class="podcastId">
    <?php echo Playlist::getPlaylistDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>