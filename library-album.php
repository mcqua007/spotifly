<?php
include("includes/includedFiles.php");
$userId = $userLoggedIn->getUserId();
?>


<div class="entityInfo">
  <div class="centerSection">
    <div class="artistInfo">
      <h1 class="artistName"> <?php //echo $artist->getName(); ?> </h1>
      <div class="headerButtons">
        <button class="button" onclick="playFirstSongs()"> PLAY </button>
      </div>
    </div>
  </div>
</div>
<div class="gridViewContainer borderbottom">
<h2> Albums </h2>
	<?php
		$userAlbumQuery = mysqli_query($con, "SELECT * FROM userAlbums WHERE userId = '$userId'");
    $userRow = mysqli_fetch_array($userAlbumQuery);
    $userRow['albumId'];

    $albumIdArray = array();

  while($userRow= mysqli_fetch_array($userAlbumQuery)) {

          $albumId = $userRow['albumId'];

  }



//fix below
            while($row = $albumIdArray) {





              echo "<div class='gridViewItem'>
                  <span role='link' class='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
                    <img src='" . $row['artworkPath'] . "'>

                    <div class='gridViewInfo'>"
                      . $row['title'] .
                    "</div>
                  </span>

                </div>";



            }
// fix above
	?>

</div>
<div class="tracklistContainer borderbottom">
  <h2> Top Songs </h2>
  <?php
  // displayTracks($con, $userLoggedIn, $artist->getTopSongs(), 20);
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
