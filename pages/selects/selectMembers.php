<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

require "../navbar.php";

//Get all members and facilities for foreign keys constraints
require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$membersList = $api->selectAllMembers();
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select Members</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../style.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <table style="width:100%">
        <tr>
            <th>Member ID</th>
            <th>Surname</th>
            <th>First Name</th>
            <th>Address</th>
            <th>Zip Code</th>
            <th>Telephone</th>
        </tr>
    
    <?php foreach ($membersList as $member) { ?>
        <tr>
            <td><?= $member->memid ?></td>
            <td><?= $member->surname ?></td>
            <td><?= $member->firstname ?></td>
            <td><?= $member->address ?></td>
            <td><?= $member->zipcode ?></td>
            <td><?= $member->telephone ?></td>
        </tr>
    <?php } ?>
    </table> 
</body>

</html>