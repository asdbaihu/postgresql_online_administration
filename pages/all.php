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
    <title>Insert</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <h1 class="login">Insert</h1>
<div class="rect-button">
    <a class="balise-a" href="inserts/insertMember.php"><button class="button3">New Member</button></a>
    <a class="balise-a" href="inserts/insertFacility.php"><button class="button3">New Facility</button></a>
    <a class="balise-a" href="inserts/insertBooking.php"><button class="button3">New Booking</button></a>
</div>
</body>

</html>