<?php
include("../../config.php");
  if(isset($_POST['albumId']) &&  isset($_POST['token'])){
  if($_POST['token'] == "54219872kJL9Z&*KI9O@"){

     $albumId = $_POST['albumId'];

     $query = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumId'");

     $resultArray = mysqli_fetch_array($query);

     $resultArrayJSON = json_encode($resultArray);

     echo $resultArrayJSON;
   }
   else {
     echo "Not Authorized to make AJAX call!";
   }
  }
?>
