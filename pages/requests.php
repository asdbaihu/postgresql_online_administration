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
    <title>Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <h1 class="login">Connected</h1>
<div class="rect-button">
    <?php if ($_SESSION["username"] == "postgres"): ?>
        <a class="button2" href="selectAll.php"><button>Select All</button></a>
    <?php elseif ($_SESSION["username"] == "All"): ?>
        <a class="balise-a" href="all.php"><button class="button2">Insert</button></a>
        <a class="balise-a" href="selectAll.php"><button class="button2">Select All</button></a>
    <?php else: ?>
        <p>Cet Utilisateur n'a aucune Permission</p>
    <?php endif; ?>

</div>
</body>

</html>