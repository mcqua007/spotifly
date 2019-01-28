<?php
include("../../config.php");

  if(isset($_POST['albumId']) &&  isset($_POST['userId'])){
    $albumId = $_POST['albumId'];
    $userId =  $_POST['userId'];
    $addQuery = mysqli_query($con, "INSERT INTO userAlbums VALUES('', '$userId', '$albumId')");

    echo "The album has been added to your library";
  }
  else {
    echo "Error: Something went wrong please try again later";
  }

?>
