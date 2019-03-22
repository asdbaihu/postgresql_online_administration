<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
require "navbar.php";
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select All</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <h1 class="login">Select</h1>
    <div class="rect-button">
        <a class="balise-a" href="selects/selectMembers.php"><button class="button3">All Members</button></a>
        <a class="balise-a" href="selects/selectFacilities.php"><button class="button3">All Facilities</button></a>
        <a class="balise-a" href="selects/selectBookings.php"><button class="button3">All Bookings</button></a>
    <div class="rect-button">
</body>

</html>