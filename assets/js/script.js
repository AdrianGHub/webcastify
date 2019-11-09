var currentPlaylist = [];
var audioElement;     


// class Audio {

//     constructor(currentPlaying, audio) {
//         this.currentlyPlaying = currentPlaying;
//         this.audio = audio;
//         audio = document.createElement('audio');
//     }
//     setTrack(src) {
//         return this.audio.src = src;
//     }

// }

function formatTime(seconds) {
    var time = Math.round(seconds);
    var minutes = Math.floor(time / 60); // Rounds down
    var seconds = time - (minutes * 60);

    var extraZero = (seconds < 10) ? "0" : "";

    return `${minutes}:${extraZero}${seconds}`;
}

function Audio() {

        this.currentlyPlaying;
        this.audio = document.createElement('audio');

        this.audio.addEventListener("canplay", function() {
            var duration = formatTime(this.duration);
            $(".progressTime.remaining").text(duration);
        });
    
    
        this.setTrack = function(track) {
            this.currentPlaying = track;
            this.audio.src = track.path;
    }

    this.play = function() {
        this.audio.play();
    }

    this.pause = function() {
        this.audio.pause();
    }

}