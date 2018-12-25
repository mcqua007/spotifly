<?php
include("../../config.php");
  if(isset($_POST['songId']) &&  isset($_POST['token'])){
  if($_POST['token'] == "54219872kJL9Z&*KI9O@"){

     $songId = $_POST['songId'];

     $query = mysqli_query($con, "UPDATE songs SET plays = plays + 1 WHERE id='$songId'");

   }
   else {
     echo "Not Authorized to make AJAX call!";
   }
  }
?>
