<?php


$resultArray = array();

if(isset($_GET['id'])){
	$albumId = $_GET['id'];
	$songQuery = mysqli_query($con, "SELECT id FROM songs WHERE album = $albumId");

	while($row = mysqli_fetch_array($songQuery)) {
		array_push($resultArray, $row['id']);
	}

}
else {
	$songQuery2 = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");

	while($row = mysqli_fetch_array($songQuery2)) {
		array_push($resultArray, $row['id']);
	}

}



$jsonArray = json_encode($resultArray);
?>

<script>

$(document).ready(function() {
	var newPlaylist = <?php echo $jsonArray; ?>;
	audioElement = new Audio();
	setTrack(newPlaylist[0], newPlaylist, false);
	updateVolumeProgressBar(audioElement.audio);

	$("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function (e) {
		e.preventDefault(); //prevents defualt behavior on that even i.e. click soemthing would not actually click it
	});

	$(".playbackBar .progressBar").mousedown(function(){
		mouseDown = true;
	});

	$(".playbackBar .progressBar").mousemove(function(e){
		if(mouseDown == true){
			//set time of song, depending on position of mouse
			timeFromOffset(e, this);
		}
	});

	$(".playbackBar .progressBar").mouseup(function(e){
			timeFromOffset(e, this);
	});

	$(".volumeBar .progressBar").mousedown(function(){
		mouseDown = true;
	});

	$(".volumeBar .progressBar").mousemove(function(e){
		if(mouseDown == true){
			var percentage = e.offsetX / $(this).width();

			if(percentage >= 0 && percentage <= 1){
						audioElement.audio.volume = percentage;
			}
		}
	});

	$(".volumeBar .progressBar").mouseup(function(e){
		var percentage = e.offsetX / $(this).width();

		if(percentage >= 0 && percentage <= 1){
					audioElement.audio.volume = percentage;
		}
	});

	$(document).mouseup(function(){
		mouseDown = false;
	});

	songEnded();

});



function timeFromOffset(mouse, progressBar){
	var percentage = mouse.offsetX / $(progressBar).width() * 100;
	var seconds = audioElement.audio.duration * (percentage/100);
	audioElement.setTime(seconds);
}

function nextSong(){

	if(currentIndex == currentPlaylist.length - 1){
		currentIndex = 0;
	}
	else {
		currentIndex++;
	}

	var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];

		if(audioElement.audio.paused){
				setTrack(trackToPlay, currentPlaylist, false);
		}
		else{
				setTrack(trackToPlay, currentPlaylist, true);
		}
}

function previousSong(){
	if(audioElement.audio.currentTime >= 5){
		audioElement.setTime(0);
	}
 else {
	 if(currentIndex == 0){
	 currentIndex =	currentPlaylist.length - 1;
	 }
	 else {
		 currentIndex--;
	 }

	 var trackToPlay = currentPlaylist[currentIndex];

		 if(audioElement.audio.paused){
				 setTrack(trackToPlay, currentPlaylist, false);
		 }
		 else{
				 setTrack(trackToPlay, currentPlaylist, true);
		 }
 }
}

function songEnded(){
	var aud = audioElement.audio.onended = function(){
		console.log("The audio has ended");
	 playSong();
	 nextSong();
	}
}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
}

function shuffleToggle(){
	shuffle = !shuffle;
	var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
	$(".controlButton.shuffle img").attr("src", "assets/images/icons/" + imageName);

	if(shuffle == true){
		shuffleArray(shufflePlaylist);
		currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
	else{
		currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
}
function muteToggle() {
	mute = !mute;
	if(mute == true){
	 	audioElement.audio.muted = true;
		$("#volume").hide();
		$("#volume-mute").show();
	}
	else{
			audioElement.audio.muted = false;
			$("#volume-mute").hide();
			$("#volume").show();
	}
}


function repeatToggle(){
	if(audioElement.audio.loop == false){
	 	audioElement.audio.loop = true;
		$("#repeat-icon").hide();
		$("#repeat-active-icon").show();
	}
	else{
			audioElement.audio.loop = false;
			$("#repeat-active-icon").hide();
			$("#repeat-icon").show();
	}
}


function setTrack(trackId, newPlaylist, play) {
	var tokenPassword = "54219872kJL9Z&*KI9O@";

	if(newPlaylist != currentPlaylist){
		currentPlaylist = newPlaylist;
		shufflePlaylist = currentPlaylist.slice();
		shuffleArray(shufflePlaylist);
	}

	if(shuffle == true){
		currentIndex = shufflePlaylist.indexOf(trackId);
	}
	else{
		currentIndex = currentPlaylist.indexOf(trackId);
	}


	   	$.post("includes/handlers/ajax/getSongJson.php", {songId: trackId, token: tokenPassword}, function(data){

				  var track = JSON.parse(data);
				 $(".trackName span").text(track.title);

				 $.post("includes/handlers/ajax/getArtistJson.php", {artistId: track.artist, token: tokenPassword}, function(data){
					 var artist = JSON.parse(data);
					 $(".artistName span").text(artist.name);
				 });

				 $.post("includes/handlers/ajax/getAlbumJson.php", {albumId: track.album, token: tokenPassword}, function(data){
					var album = JSON.parse(data);
					$(".albumLink img").attr("src", album.artworkPath);
				});
						audioElement.setTheTrack(track);
						if(play == true) {
						playSong();
					 }
	  	});

}

	function playSong(){
	var tokenPass = "54219872kJL9Z&*KI9O@";
	  if(audioElement.audio.currentTime == 0){
	   	$.post("includes/handlers/ajax/updatePlays.php", {songId: audioElement.currentlyPlaying.id, token: tokenPass});
	   }

		$(".controlButton.play").hide();
		$(".controlButton.pause").show();
		audioElement.play();
	}

	function pauseSong() {
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

					<button class="controlButton shuffle" title="Shuffle button" onclick="shuffleToggle()">
						<img id="shuffle" src="assets/images/icons/shuffle.png" alt="Shuffle">
					</button>

					<button class="controlButton previous" title="Previous button" onclick="previousSong()">
						<img src="assets/images/icons/previous.png" alt="Previous">
					</button>

					<button class="controlButton play" title="Play button" onclick="playSong()">
						<img src="assets/images/icons/play.png" alt="Play">
					</button>

					<button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
						<img src="assets/images/icons/pause.png" alt="Pause">
					</button>

					<button class="controlButton next" title="Next button" onclick="nextSong()">
						<img src="assets/images/icons/next.png" alt="Next">
					</button>

					<button class="controlButton repeat" title="Repeat button" onclick="repeatToggle()">
						<img id="repeat-icon" src="assets/images/icons/repeat.png" alt="Repeat">
						<img id="repeat-active-icon" src="assets/images/icons/repeat-active.png" style="display: none;"  alt="Repeat Active">
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

				<button class="controlButton volume" title="Volume button" onclick="muteToggle()">
					<img id="volume" src="assets/images/icons/volume.png" alt="Volume">
					<img id="volume-mute" src="assets/images/icons/volume-mute.png" alt="Volume Mute" style="display:none;">
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
