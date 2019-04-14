<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
//Get all members
require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$userList = $api->selectUsers();
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select user</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
    <!--<script src="main.js"></script>-->
    </head>

<body>
    <?php require "navbar.php"; ?>
    <h1>Select user</h1>

    <form class="form-request" id="createUser" action="manageUserSchema.php" method="POST">
        <select class="input" name="user" id="user">
            <?php foreach ($userList as $user) { ?>
                <option value="<?= $user->usename ?>"><?= $user->usename ?></option>
            <?php } ?>
        </select>
        <input type="hidden" name="schema" id="schema" value="<?php echo $_POST["manageSchema"] ?>" />
        <button type="submit">Select</button>
    </form>
</body>

</html>