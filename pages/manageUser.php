<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
//Get member
require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$user = $api->selectUser($_POST["manage_user"]);
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manage user permissions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
    <!--<script src="main.js"></script>-->
    </head>

<body>
    <?php require "navbar.php"; ?>
    <h1>Manage <?php echo $_POST["manage_user"] ?> permissions</h1>

    <form class="form-request" id="createUser" action="../library/requestProcessing.php" method="POST">
        <div class="checkbox">
            <input type="checkbox" name="usecreatedb" value="usecreatedb" <?php if ($user->usecreatedb == true) echo 'checked'; ?>> User can create databases
        </div>
        <div class="checkbox">
            <input type="checkbox" name="usesuper" value="usesuper" <?php if ($user->usesuper == true) echo 'checked'; ?>> User is a superuser
        </div>
        <div class="checkbox">
            <input type="checkbox" name="userepl" value="userepl" <?php if ($user->userepl == true) echo 'checked'; ?>> User can put the system in and out of backup mode.
        </div>
        <div class="checkbox">
            <input type="checkbox" name="usebypassrls" value="usebypassrls" <?php if ($user->usebypassrls == true) echo 'checked'; ?>> User bypasses every row level security policy
        </div>
        <input type="hidden" name="manage_user" id="manage_user" value="<?php echo $_POST['manage_user'] ?>" />

        <button type="submit">Update</button>
    </form>
</body>

</html>