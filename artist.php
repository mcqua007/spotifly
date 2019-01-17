<?php
include("includes/includedFiles.php");



if(isset($_GET['id'])){
  $artistId = $_GET['id'];
}
else {
  header("Location: index.php");
}
  $artist = new Artist($con, $artistId);
?>


<div class="entityInfo">
  <div class="centerSection">
    <div class="artistInfo">
      <h1 class="artistName"> <?php echo $artist->getName(); ?> </h1>
      <div class="headerButtons">
        <button class="button" onclick="playFirstSongs()"> PLAY </button>
      </div>
    </div>
  </div>
</div>
<div class="gridViewContainer borderbottom">
<h2> Albums </h2>
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist = '$artistId'");

		while($row = mysqli_fetch_array($albumQuery)) {




			echo "<div class='gridViewItem'>
					<span role='link' class='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
						<img src='" . $row['artworkPath'] . "'>

						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
					</span>

				</div>";



		}
	?>

</div>
<div class="tracklistContainer borderbottom">
  <h2> Top Songs </h2>
	<ul class="tracklist">

		<?php
		$songIdArray = $artist->getTopSongs();

		$i = 1;
		foreach($songIdArray as $songId) {
      if( $i > 20 ){
        break;
      }

			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $albumSong->getTitle() . "</span>
						<span class='artistName'>" . $albumArtist->getName() . "</span>
					</div>

          <div class='trackOptions'>
          <input type='hidden' class='songId' value='" . $albumSong->getId() . "' />
            <img class='optionsButton' src='assets/images/icons/more.png' role='link' onclick='showOptionsMenu(this)'>
          </div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumSong->getDuration() . "</span>
					</div>


				</li>";

			$i = $i + 1;



		}

		?>

		<script>
		var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
		tempPlaylist = JSON.parse(tempSongIds);


		</script>

	</ul>
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
