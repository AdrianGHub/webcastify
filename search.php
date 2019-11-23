<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}
else {
	$term = "";
}
?>

<div class="searchContainer">

	<h4>Wyszukaj artysty, albumu lub muzyczki</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Wprowadź pożądaną frazę..." onfocus="this.value = this.value">

</div>

<script>

$(".searchInput").focus();

$(function() {

	$(".searchInput").keyup(function() {
		clearTimeout(timer);

		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("search.php?term=" + val);
		}, 2000);

	})


})

</script>

<?php if($term == "") exit(); ?>


<div class="tracklistContainer borderBottom">
	<h2>MUZYCZKI</h2>
	<ul class="tracklist">
		
		<?php
		$podcastsQuery = mysqli_query($con, "SELECT id FROM podcasts WHERE title LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($podcastsQuery) == 0) {
			echo "<span class='noResults'>Nie znaleziono pasującej frazy " . $term . "</span>";
		}



		$podcastIdArray = array();

		$i = 1;
		while($row = mysqli_fetch_array($podcastsQuery)) {

			if($i > 15) {
				break;
			}

			array_push($podcastIdArray, $row['id']);

			$albumPodcast = new Podcast($con, $row['id']);
			$albumArtist = $albumPodcast->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumPodcast->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $albumPodcast->getTitle() . "</span>
						<span class='artistName'>" . $albumArtist->getName() . "</span>
					</div>

					<div class='trackOptions'>
						<img class='optionsButton' src='assets/images/icons/more.png'>
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumPodcast->getDuration() . "</span>
					</div>


				</li>";

			$i = $i + 1;
		}

		?>

		<script>
			var $temPodcastIds = '<?php echo json_encode($podcastIdArray); ?>';
			tempPlaylist = JSON.parse($temPodcastIds);
		</script>

	</ul>
</div>

<div class="artistContainer borderBottom">

    <h2>ARTYŚCI</h2>

    <?php 
    
        $artistsQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");

        if(mysqli_num_rows($artistsQuery) == 0) {
			echo "<span class='noResults'>Nie znaleziono pasującej frazy " . $term . "</span>";
        }
        
        while($row = mysqli_fetch_array($artistsQuery)) {
            $artistFound = new Artist($con, $row['id']);

            echo "<div class='searchResultRow'>
                    <div class='artistName'>
                        <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() ."\")'>
                        "
                        . $artistFound->getName() .
                        "
                        </span>
                    </div> 
                </div>";
        }


    ?>

</div>

<div class="gridViewContainer">
            <h2>ALBUMY</h2>
<?php  
    $albumQuery = mysqli_query($con, "SELECT * FROM album WHERE title LIKE '$term%' LIMIT 10");

    if(mysqli_num_rows($albumQuery) == 0) {
        echo "<span class='noResults'>Nie znaleziono pasującej frazy " . $term . "</span>";
    }

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








