<?php
include("../../config.php");

  if(isset($_POST['songId']) &&  isset($_POST['userId'])){
    $songId = $_POST['songId'];
    $userId =  $_POST['userId'];
    $addQuery = mysqli_query($con, "INSERT INTO userSongs VALUES('', '$userId', '$songId')");

    echo "The song has been added to your library";
  }
  else {
    echo "Error: Something went wrong please try again later";
  }

?>
