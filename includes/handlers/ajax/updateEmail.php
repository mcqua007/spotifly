<?php
include("../../config.php");
  if(!isset($_POST['username'])){
    echo "ERROR: Could not set username!";
    exit();
  }
  if(isset($_POST['email']) && $_POST['email'] != ""){
      $usernmae  = $_POST['username'];
      $email = $_POST['email'];

      if(!filter_var($email, FILTER_VALIDATE_EMAIL{
      echo "Email is invalid!";
       exit();


      $emailCheck = mysqli_query($con, "SELECT email FROM users WHERE email='$email' AND username != '$username'");//check s if email has in use by everyone but the current user

      if(mysqli_num_rows($emailCheck > 0)){
        echo "Email is already in user";
        exit();
      }

      $updateQuery = mysqli_wuery($con, "UPDATE users SET EMAIL '$email' WHERE username = '$username'");
      echo "Update Succesful!";
  }
  else{
    echo "You must provide a email!";
  }

?>
