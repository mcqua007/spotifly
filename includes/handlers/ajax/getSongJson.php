<?php
include("../../config.php");
  if(isset($_POST['songId']) &&  isset($_POST['token'])){
  if($_POST['token'] == "54219872kJL9Z&*KI9O@"){
    
     $songId = $_POST['songId'];

     $query = mysqli_query($con, "SELECT * FROM songs WHERE id='$songId'");

     $resultArray = mysqli_fetch_array($query);

     $resultArrayJSON = json_encode($resultArray);

     echo $resultArrayJSON;
   }
   else {
     echo "not correct token!";
   }
  }
?>