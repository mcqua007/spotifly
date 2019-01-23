<?php
include("../../config.php");

  if(isset($_POST['songId']) &&  isset($_POST['username'])){



     $songId = $_POST['songId'];
     $username = $_POST['username'];


     $query = mysqli_query($con, "UPDATE songs SET numberOfLikes = numberOfLikes + 1 WHERE id='$songId'");

     $userQuery = mysqli_query($con, "SELECT id  FROM users WHERE username='$username'");
     $row = mysqli_fetch_array($userQuery);
     $userId = $row['id'];



     $userLikesquery = mysqli_query($con, "INSERT INTO userLikedSongs VALUES('', '$userId', '$songId')");

     echo "Success! - User ID:" . $userId;

   }
   else {
     echo "Not Authorized to make AJAX call!";
   }
?>
