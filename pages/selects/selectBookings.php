<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

require "../navbar.php";

//Get all members and facilities for foreign keys constraints
require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$bookingsList = $api->selectAllBookings();
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../style.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <table style="width:100%">
        <tr>
            <th>Booking ID</th>
            <th>Facility ID</th>
            <th>Facility Name</th>
            <th>Member ID</th>
            <th>Member Surname</th>
            <th>Member Firstname</th>
        </tr>
    
    <?php foreach ($bookingsList as $booking) { ?>
        <tr>
            <td><?= $booking->bookid ?></td>
            <td><?= $booking->facid ?></td>
            <td><?= $booking->name ?></td>
            <td><?= $booking->memid ?></td>
            <td><?= $booking->surname ?></td>
            <td><?= $booking->firstname ?></td>
        </tr>
    <?php } ?>
    </table> 
</body>

</html>