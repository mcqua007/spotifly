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
		<img src="<?php echo $album->getArtworkPath(); ?>">
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p role="link" tabindex="0" onclick="openPage('artist.php>id=$artistId')">By <?php echo $artist->getName(); ?></p>
		<p><?php echo $album->getNumberOfSongs(); ?> songs</p>
		<button class="add-album button" onclick="addAlbum(<?php echo $albumId;?>, <?php echo $userLoggedIn->getUserId(); ?> )">
			Add  Album
		</button>
		<span class="flash-message"></span>

	</div>

</div>
<!-- tracklist section -->
<?php
displayTracks($con, $userLoggedIn, $album->getSongIds());
?>
<nav class="optionsMenu">
	 <div class="add-playlist-row">
		<i class="fa fa-plus" style="width:5%; padding-left:5px; color:rgba(147, 147, 147, 0.8);"></i>
		 <input type="hidden" class="songId">
		<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
	 </div>
	 <!-- Not Right FIX -->
	 <input type="hidden" class="songId">
	 <div class="item" role="link" onclick="addSong(this,<?php echo $userLoggedIn->getUserId(); ?> )">
		  Add to Library
	 </div>
		<div class="item"> Item 3 </div>
</nav>
