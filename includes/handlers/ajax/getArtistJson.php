<?php
include("../../config.php");
  if(isset($_POST['artistId']) &&  isset($_POST['token'])){
  if($_POST['token'] == "54219872kJL9Z&*KI9O@"){

     $artistId = $_POST['artistId'];

     $query = mysqli_query($con, "SELECT * FROM artists WHERE id='$artistId'");

     $resultArray = mysqli_fetch_array($query);

     $resultArrayJSON = json_encode($resultArray);

     echo $resultArrayJSON;
   }
   else {
     echo "Not Authorized to make AJAX call!";
   }
  }
?>
