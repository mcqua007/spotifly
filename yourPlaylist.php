<?php
include("includes/includedFiles.php");
?>

<div class="playlistsContainer ">

	<div class="gridViewContainer borderbottom">
		<h2>PLAYLISTS </h2>

		<div class="buttonItems">
			<button class="button green" onclick="createPlaylist()">NEW PLAYLIST</button>
		</div>

		<?php
			$username = $userLoggedIn->getUsername();
			$playlistQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner = '$username'");

			if(mysqli_num_rows($playlistQuery) == 0) {
				echo "<span class='noResults'>You don't have any playlists yet !</span>";
			}

			while($row = mysqli_fetch_array($playlistQuery)) {

				$playlist = new Playlist($con, $row);

				echo "<div class='gridViewItem' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>
				<div class='playlistImage'>
					<img src='assets/images/icons/playlist.png'  />
				</div>
						<div class='gridViewInfo'>"
							. $playlist->getName() .
						"</div>
					</div>";
			}
		?>

	</div>

	<?php
	//Like Section

	$likedUserId = $userLoggedIn->getUserId();
	$likedQuery = mysqli_query($con, "SELECT * FROM userLikedSongs WHERE userId = '$likedUserId'");

	$likedArray = array();

	while($row = mysqli_fetch_array($likedQuery)) {
		array_push($likedArray, $row['songId']);
	}

	?>

	<div class="gridViewContainer borderbottom">
		<h2>LIKED SONGS </h2>
		<?php
		displayTracks($con, $userLoggedIn, $likedArray);
		?>
</div>
<nav class="optionsMenu">
	 <div class="add-playlist-row">
		<i class="fa fa-plus" style="width:5%; padding-left:5px; color:rgba(147, 147, 147, 0.8);"></i>
		 <input type="hidden" class="songId">
		<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
	 </div>
	  <div class="item"> Item 2	</div>
		<div class="item"> Item 3 </div>
</nav>


</div>
