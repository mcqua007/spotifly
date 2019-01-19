<?php
include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/User.php");
include("includes/classes/Playlist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");

//session_destroy(); LOGOUT

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
	$username = $userLoggedIn->getUsername();
	echo "<script> userLoggedIn = '$username';</script>";
}
else {
	header("Location: register.php");
}

?>

<html>
<head>
	<title>Welcome to Spotifly!</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>

	<div id="mainContainer">

		<div id="topContainer">

			<?php include("includes/navBarContainer.php"); ?>

			<div id="mainViewContainer">

				<div id="mainContent">
