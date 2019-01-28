<?php
//Like Section
function displayTracks($con, $userLoggedIn, $songIdArray, $displayLimit = 0){

$likedUserId = $userLoggedIn->getUserId();
$likedQuery = mysqli_query($con, "SELECT * FROM userLikedSongs WHERE userId = '$likedUserId'");

$likedArray = array();

while($row = mysqli_fetch_array($likedQuery)) {
	array_push($likedArray, $row['songId']);
}

?>
<div class="tracklistContainer">
	<ul class="tracklist">

		<?php

		$i = 1;
		foreach($songIdArray as $songId) {
			//if display limit is not set execute the following code
			if($displayLimit != 0){
				if( $i > $displayLimit){
					break;
				}
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
					<div class='trackHeart'>";
					if (in_array($albumSong->getId(), $likedArray) == true){
					 echo "<div class='normalHeart likedHeart' role='link' data-liked='true' onclick='likeSong(this," . $albumSong->getId() .")'>
							   <i class='fa fa-heart'></i>
						    </div>";
					}
          else{
						echo "<div class='normalHeart' role='link' data-liked='false' onclick='likeSong(this," . $albumSong->getId() .")'>
							  <i class='fa fa-heart'></i>
					   	</div>";
						}
					echo "
					</div>
					<div class='totalLikes'>
						<div class='total-like-text-". $albumSong->getId() . "'>
						". $albumSong->getNumberOfLikes() . "
						</div>
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
<?php } ?>
