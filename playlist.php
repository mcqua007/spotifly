<?php include("includes/includedFiles.php");

if(isset($_GET['id'])) {
	$playlistId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$playlist = new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());
?>


<div class="entityInfo">

	<div class="leftSection">
    <div class="playlistimage">
      <img src="assets/images/icons/playlist.png">
    </div>
	</div>

	<div class="rightSection">
		<h2><?php echo $playlist->getName(); ?></h2>
		<p>By <?php echo $playlist->getOwner(); ?></p>
		<p><?php echo $playlist->getNumberOfSongs(); ?> songs</p>
		<button class="button" onclick="deletePlaylist(' <?php echo $playlistId; ?>')">DELETE PLAYLIST</button>

	</div>

</div>
<!-- Display the tracklist for this PlayList -->
<?php
displayTracks($con, $userLoggedIn, $playlist->getSongIds());
?>
<nav class="optionsMenu">
	 <div class="add-playlist-row">
		<i class="fa fa-plus" style="width:5%; padding-left:5px; color:rgba(147, 147, 147, 0.8);"></i>
		 <input type="hidden" class="songId" id="options-songId">
		<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
	 </div>
	 <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove from Playlist</div>
		<div class="item"> Item 3 </div>
</nav>
