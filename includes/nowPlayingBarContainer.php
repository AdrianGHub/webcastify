<?php 

$podcastQuery = mysqli_query($con, "SELECT id FROM podcasts ORDER BY RAND() LIMIT 10");

$resultArray = array();

while($row = mysqli_fetch_array($podcastQuery)) {
	array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);

?>

<script>

$(document).ready(function() {
	var newPlaylist = <?php echo $jsonArray; ?>;
	audioElement = new Audio(); 
	setTrack(newPlaylist[0], newPlaylist, false);
	updateVolumeProgressBar(audioElement.audio);

	$("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
		e.preventDefault();
	})

	$(".playbackBar .progressBar").mousedown(function() {
		mouseDown = true;
	})

	
	$(".playbackBar .progressBar").mousemove(function(e) {
		if(mouseDown == true) {
			// Set time of song, depending on poition of mouse
			timeFromOffset(e, this);
		}
	})

	
	$(".playbackBar .progressBar").mouseup(function(e) {
		timeFromOffset(e, this);
	})

	$(".volumeBar .progressBar").mousedown(function() {
		mouseDown = true;
	})

	
	$(".volumeBar .progressBar").mousemove(function(e) {
		if(mouseDown == true) {

			var percentage = e.offsetX / $(this).width();

			if(percentage >= 0 && percentage <= 1) {
				audioElement.audio.volume = percentage;
			}
		}
	})

	
	$(".volumeBar .progressBar").mouseup(function(e) {
		
		var percentage = e.offsetX / $(this).width();

		if(percentage >= 0 && percentage <= 1) {
			audioElement.audio.volume = percentage;
		}
	})

	$(document).mouseup(function(){
		mouseDown = false;
	})
});


function timeFromOffset(mouse, progressBar) {
	var percentage = mouse.offsetX / $(progressBar).width() * 100;
	var seconds = audioElement.audio.duration * (percentage / 100);
	audioElement.setTime(seconds);
}

function prevPodcast() {
	if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
		audioElement.setTime(0);
	} else {
		currentIndex = currentIndex - 1;
		setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
	}
}

function nextPodcast() {

	if(repeat == true) {
		audioElement.setTime(0);
		playPodcast();
		return;
	}

	if(currentIndex == currentPlaylist.length - 1) {
		currentIndex = 0;
	} 
	else {
		currentIndex++;
	}

	var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
	setTrack(trackToPlay, currentPlaylist, true);
}

function setRepeat() {
	repeat = !repeat;
	var imageName = repeat ? "repeat-active.png" : "repeat.png";
	$(".controlButton.repeat img").attr("src", `assets/images/icons/${imageName}`);
}

function setMute() {
	audioElement.audio.muted = !audioElement.audio.muted;
	var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
	$(".controlButton.volume img").attr("src", `assets/images/icons/${imageName}`);
}

function setShuffle() {
	shuffle = !shuffle;
	var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
	$(".controlButton.shuffle img").attr("src", `assets/images/icons/${imageName}`);

	if(shuffle) {
		// Randomize playlist
		shuffleArray(shufflePlaylist);
		currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
	} 
	else {
		// Shuffle has been deactivated
		// Go back to regular playlist
		currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
}

function shuffleArray(array) {
    for (var i = array.length; i; i--) {
        var j = Math.floor(Math.random() * 1);
        var temp = array[i - 1];
        array[i - 1] = array[j];
        array[j] = temp;
    }
}

function setTrack(trackId, newPlaylist, play) {

	if(newPlaylist != currentPlaylist) {
		currentPlaylist = newPlaylist;
		shufflePlaylist = currentPlaylist.slice();
		shuffleArray(shufflePlaylist);
	}

	if(shuffle) {
		currentIndex = shufflePlaylist.indexOf(trackId);	
	} else {
		currentIndex = currentPlaylist.indexOf(trackId);
	}
	pausePodcast();
		

	$.post("includes/handlers/ajax/getPodcastJson.php", { podcastId: trackId }, function(data) {

		var track = JSON.parse(data);

		$(".trackName span").text(track.title);

		$.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
			var artist = JSON.parse(data);

			$(".artistName span").text(artist.name);
			
		});
		
		$.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
			var album = JSON.parse(data);

			$(".albumLink img").attr("src", album.artworkPath);
			
		});

		audioElement.setTrack(track);

		if(play) {
		playPodcast();
	}

	});

}

function playPodcast() {

	if(audioElement.audio.currentTime == 0) {
		$.post("includes/handlers/ajax/updatePlays.php", { podcastId:  audioElement.currentlyPlaying.id });
	}

	$(".controlButton.play").hide();
	$(".controlButton.pause").show();
	audioElement.play();
}

function pausePodcast() {
	$(".controlButton.play").show();
	$(".controlButton.pause").hide();
	audioElement.pause();
}

</script>


<div id="nowPlayingBarContainer">

	<div id="nowPlayingBar">

		<div id="nowPlayingLeft">
			<div class="content">
				<span class="albumLink">
					<img src="" class="albumArtwork">
				</span>

				<div class="trackInfo">

					<span class="trackName">
						<span></span>
					</span>

					<span class="artistName">
						<span></span>
					</span>

				</div>



			</div>
		</div>

		<div id="nowPlayingCenter">

			<div class="content playerControls">

				<div class="buttons">

					<button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle()">
						<img src="assets/images/icons/shuffle.png" alt="Shuffle">
					</button>

					<button class="controlButton previous" title="Previous button" onclick="prevPodcast()">
						<img src="assets/images/icons/previous.png" alt="Previous">
					</button>

					<button class="controlButton play" title="Play button" onclick="playPodcast()">
						<img src="assets/images/icons/play.png" alt="Play">
					</button>

					<button class="controlButton pause" title="Pause button" onclick="pausePodcast()" style="display: none;">
						<img src="assets/images/icons/pause.png" alt="Pause">
					</button>

					<button class="controlButton next" title="Next button" onclick="nextPodcast()">
						<img src="assets/images/icons/next.png" alt="Next">
					</button>

					<button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
						<img src="assets/images/icons/repeat.png" alt="Repeat">
					</button>

				</div>


				<div class="playbackBar">

					<span class="progressTime current">0.00</span>

					<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>
					</div>

					<span class="progressTime remaining">0.00</span>


				</div>


			</div>


		</div>

		<div id="nowPlayingRight">
			<div class="volumeBar">

				<button class="controlButton volume" title="Volume button" onclick="setMute()">
					<img src="assets/images/icons/volume.png" alt="Volume">
				</button>

				<div class="progressBar">
					<div class="progressBarBg">
						<div class="progress"></div>
					</div>
				</div>

			</div>
		</div>




	</div>

</div>