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
// if click out of options menu it will disappear
$(document).click(function(click){
	var target = $(click.target);

	if (!target.hasClass("item") && ! target.hasClass("optionsButton")){
		hideOptionsMenu();
	}
});
//if scroll after oipening options menu hide it
$(window).scroll(function(){
	hideOptionsMenu();

});

//on change of the song options menu get songId nd ajx post to save in playlistSongs
$(document).on("change", "select.playlist", function() {
	var select = $(this);
	var playlistId = select.val();
	var songId = select.prev(".songId").val();

	$.post("includes/handlers/ajax/addToPlaylist.php", {playlistId: playlistId, songId: songId}).done(function(error){
		//shows error if there is any
		if(error != ""){
			alert(error);
			return;
		}
			hideOptionsMenu();
			//change the select to default, "add to playlist"
			select.val(""); //since the add to playlsit options value is set to an empty string, this sets it back to that option
	});
});

function addSong(songId, userId){
	console.log(songId);
	//$.post("includes/handlers/ajax/addSong.php", {albumId : songId, userId: userId}).done(function(data){
	//  alert(data);
	//});
}


function addAlbum(albumId, userId){
	$.post("includes/handlers/ajax/addAlbum.php", {albumId : albumId, userId: userId}).done(function(data){
	  alert(data);
	});
}

function likeSong(heartIcon, id){
  var data = $(heartIcon).attr("data-liked");
	var nextState;

	console.log("data-liked: "+ data);
	if(data == "true"){
		nextState = "false";
	}
	else if(data == "false"){
		nextState = "true";
	}



	$.post("includes/handlers/ajax/updateLikes.php", {songId : id, username: userLoggedIn, like: nextState }).done(function(response){
	  if(nextState == "false"){
			$(heartIcon).attr("data-liked", "false");
			$(heartIcon).removeClass("likedHeart");
		}
		else if(nextState =="true"){
			$(heartIcon).attr("data-liked", "true");
 			$(heartIcon).addClass("likedHeart");
		}
		else{
			alert(response);
		}

		var totalClass = ".total-like-text-" + id;
		$(totalClass).text(response);
	});
}

function updateEmail(emailClass){
	var emailValue = $("." + emailClass).val();

	$.post("includes/handlers/ajax/updateEmail.php", {email : emailValue, username: userLoggedIn}).done(function(response){
		$("." + emailClass).nextAll(".message").text(response);
	});
}

function updatePassword(oldPasswordClass, newPasswordClass1, newPasswordClass2) {
	var oldPassword = $("." + oldPasswordClass).val();
	var newPassword1 = $("." + newPasswordClass1).val();
	var newPassword2 = $("." + newPasswordClass2).val();

	$.post("includes/handlers/ajax/updatePassword.php",
		{ oldPassword: oldPassword,
			newPassword1: newPassword1,
			newPassword2: newPassword2,
			username: userLoggedIn})

	.done(function(response) {
		$("." + oldPasswordClass).nextAll(".message").text(response);
	})
}

function logout(){
	$.post("includes/handlers/ajax/logout.php", function(){
			location.reload(); //force reloads current page
	});
}
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

function removeFromPlaylist(button, playlistId) {
	var songId = $("#options-songId").val();
 console.log(songId);
 console.log(playlistId);
	$.post("includes/handlers/ajax/removeFromPlaylist.php", { playlistId: playlistId, songId: songId })
	.done(function(error) {

		if(error != "") {
			alert(error);
			return;
		}

		//do something when ajax returns
		openPage("playlist.php?id=" + playlistId);
	});
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
				openPage("yourPlaylist.php");
			})
	}
}
function deletePlaylist(playlistId) {
	var prompt = confirm("Are you sure you want to delete this playlsit ?");

	if (prompt == true){
		$.post("includes/handlers/ajax/deletePlaylist.php", {playlistId: playlistId}).done(
			function(error){

				if(error != ""){
					alert(error);
					return;
				}
				//do something when ajax returns
				openPage("yourPlaylist.php");
			})
	}
}

function hideOptionsMenu(){
	var menu = $(".optionsMenu");
	if(menu.css("display") != "none"){
		menu.css("display", "none");
	}
}
function showOptionsMenu(button) {
	var songId = $(button).prevAll(".songId").val();
	var menu = $(".optionsMenu");
	var menuWidth = menu.width();
	menu.find(".songId").val(songId);

	var scrollTop = $(window).scrollTop(); //Distance from top of window to top of document
	var elementOffset = $(button).offset().top; //Distance from top of document

	var top = elementOffset - scrollTop;
	var left = $(button).position().left;

	menu.css({ "top": top + "px", "left": left - menuWidth + "px", "display": "inline" });

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
