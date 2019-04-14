<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create schema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
    <!--<script src="main.js"></script>-->
    </head>

<body>
    <?php require "navbar.php"; ?>
    <h1>Create schema</h1>

    <form class="form-request" id="createSchema" action="../library/requestProcessing.php" method="POST">
        <input class="input" type="text" name="schema_name" id="schema_name" placeholder="name" required>
        <button type="submit">Create</button>
    </form>
</body>

</html>