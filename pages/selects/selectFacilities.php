<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

require "../navbar.php";

//Get all members and facilities for foreign keys constraints
require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$facilitiesList = $api->selectAllFacilities();
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select Facilities</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../style.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <table style="width:100%">
        <tr>
            <th>Facility ID</th>
            <th>Name</th>
            <th>Member Cost</th>
            <th>Guest Cost</th>
            <th>Initial Outlay</th>
        </tr>
    
    <?php foreach ($facilitiesList as $facility) { ?>
        <tr>
            <td><?= $facility->facid ?></td>
            <td><?= $facility->name ?></td>
            <td><?= $facility->membercost ?></td>
            <td><?= $facility->guestcost ?></td>
            <td><?= $facility->initialoutlay ?></td>
        </tr>
    <?php } ?>
    </table> 
</body>

</html>