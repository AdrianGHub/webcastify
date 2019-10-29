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


function Audio() {

        this.currentlyPlaying;
        this.audio = document.createElement('audio');
    
    
        this.setTrack = function(src) {
            this.audio.src = src;
    }

    this.play = function() {
        this.audio.play();
    }

    this.pause = function() {
        this.audio.pause();
    }

}