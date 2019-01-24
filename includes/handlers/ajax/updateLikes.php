<?php
include("../../config.php");

  if(isset($_POST['songId']) &&  isset($_POST['username']) && isset($_POST['like'])){



     $songId = $_POST['songId'];
     $username = $_POST['username'];
     $like = $_POST['like'];

     $userQuery = mysqli_query($con, "SELECT id  FROM users WHERE username='$username'");
     $row = mysqli_fetch_array($userQuery);
     $userId = $row['id'];

     if ($like == "true"){

            $query = mysqli_query($con, "UPDATE songs SET numberOfLikes = numberOfLikes + 1 WHERE id='$songId'");
            $userLikesquery = mysqli_query($con, "INSERT INTO userLikedSongs VALUES('', '$userId', '$songId')");

            echo "liked";
     }
     else {
        $query = mysqli_query($con, "UPDATE songs SET plays = plays + 1 WHERE id='$songId'");
        $userLikesquery = mysqli_query($con, "DELETE FROM userLikedSongs WHERE userId = '$userId' AND songId = '$songId'");
        $query = mysqli_query($con, "UPDATE songs SET numberOfLikes = numberOfLikes - 1 WHERE id='$songId'");

        echo "deleted";
     }


   }
   else {
     echo "Something went wrong, please try again later!";
   }


?>
