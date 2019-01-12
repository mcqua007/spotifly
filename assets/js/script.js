var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var mute = false;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;

function openPage(url){

	if(timer != null) {
		clearTimeout(timer);
	}
	if(url.indexOf("?") == -1){
		url = url + "?";
		var encodedUrl = encodeURI(url + "userLoggedIn=" + userLoggedIn);
	}
	else{
		var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
	}
	console.log(encodedUrl);
	$("#mainContent").load(encodedUrl);
	$("body").scrollTop(0);

	history.pushState(null, null, url); //puts the url in the adress bar so it appears the user is changing pages
}

function createPlaylist(){
	var popup = prompt("Please enter the name of your playlist");

	if(popup != null){
		$.post("includes/handlers/ajax/createPlaylist.php", {name: popup, username: userLoggedIn}).done(
			function(error){

				if(error != ""){
					alert(error);
					return;
				}
				//do something when ajax returns
				openPage("yourMusic.php");
			})
	}
}

function formatTime(seconds) {
	var time = Math.round(seconds);
	var minutes = Math.floor(time / 60); //Rounds down
	var seconds = time - (minutes * 60);

	var extraZero = (seconds < 10) ? "0" : "";

	return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio) {
	$(".progressTime.current").text(formatTime(audio.currentTime));
	$(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

	var progress = audio.currentTime / audio.duration * 100;
	$(".playbackBar .progress").css("width", progress + "%");
}

function updateVolumeProgressBar(audio) {

	var volume = audio.volume * 100;
	$(".volumeBar .progress").css("width", volume + "%");
}

function playFirstSongs(){
	setTrack(tempPlaylist[0], tempPlaylist, true);
}

function topAlert(){
	alert("test");
}
function Audio() {

	this.currentlyPlaying;
	this.audio = document.createElement('audio');

	this.audio.addEventListener("canplay", function() {
		//'this' refers to the object that the event was called on
		var duration = formatTime(this.duration);
		$(".progressTime.remaining").text(duration);
	});

	this.audio.addEventListener("timeupdate", function(){
		if(this.duration) {
			updateTimeProgressBar(this);
		}
	});

	this.audio.addEventListener("volumechange", function(){
			updateVolumeProgressBar(this);
	});

	this.setTheTrack = function(track) {
		this.currentlyPlaying = track;
		this.audio.src = track.path;
	}

	this.play = function() {
		this.audio.play();
	}

	this.pause = function() {
		this.audio.pause();
	}
	this.setTime = function(seconds){
		this.audio.currentTime = seconds;
	}
	this.repeat = function(){
		this.audio.loop;
	}

}
