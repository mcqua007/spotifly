<?php
include("../../config.php");

if(!isset($_POST['username'])) {
	echo "ERROR: Could not set username";
	exit();
}

if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1'])  || !isset($_POST['newPassword2'])) {
	echo "Not all passwords have been set";
	exit();
}

if($_POST['oldPassword'] == "" || $_POST['newPassword1'] == ""  || $_POST['newPassword2'] == "") {
	echo "Please fill in all fields";
	exit();
}

$username = $_POST['username'];
$oldPassword = $_POST['oldPassword'];
$newPassword1 = $_POST['newPassword1'];
$newPassword2 = $_POST['newPassword2'];

$oldMd5 = md5($oldPassword);

$passwordCheck = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password = '$oldMd5'");

if(mysqli_num_rows($passwordCheck) != 1){
  //didn't find a single row, thus didn't find correct passwords
  echo "Password is incorrect!";
  exit();
}

if($newPassword1 != $newPassword2){
  echo "The new passwords do not match!";
  exit();
}

//checking if valid emailClass

$pattern = '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,15}$/';
//doesn't have at least 1 uppercase and 1 symbol
if(!preg_match($pattern, $newPassword1)){
  echo"Password needs at least one uppercase character and 1 symbol and be between 8-15 caharacters in length!";
  exit();
}
  $newMd5 = md5($newPassword1);

  $query = mysqli_query($con, "UPDATE users SET password='$newMd5' WHERE username='$username'");
  echo "Password changed successfully!";
  exit();

?>
