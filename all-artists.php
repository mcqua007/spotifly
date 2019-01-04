<!--broswe and index page are the same currently -->
<?php include("includes/includedFiles.php"); ?>

<h1 class="pageHeadingBig">Artists</h1>

<div class="gridViewContainer">

	<?php
		$artistQuery = mysqli_query($con, "SELECT * FROM artists ORDER BY name ASC");

		while($row = mysqli_fetch_array($artistQuery)) {




			echo "<div class='gridViewItem'>
					<span role='link' class='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $row['id'] . "\")'>
						<img src='" . $row['artistImagePath'] . "'>

						<div class='gridViewInfo'>"
							. $row['name'] .
						"</div>
					</span>

				</div>";



		}
	?>

</div>
