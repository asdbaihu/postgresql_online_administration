<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
//Get member
require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$permission = $api->selectSpeUserPermissions($_POST["user"], $_POST["schema"]);
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
    <h1>Manage <?php echo $_POST["user"]." permissions for ".$_POST["schema"] ?></h1>

    <form class="form-request" id="schemaPermissions" action="../library/requestProcessing.php" method="POST">
        <div class="checkbox">
            <input type="checkbox" name="use" value="use" <?php if ($permission->use == true) echo 'checked'; ?>> User can use schema
        </div>
        <div class="checkbox">
            <input type="checkbox" name="create" value="create" <?php if ($permission->create == true) echo 'checked'; ?>> User can create in schema
        </div>
        <input type="hidden" name="user" id="user" value="<?php echo $_POST['user'] ?>" />
        <input type="hidden" name="schema_manage" id="schema_manage" value="<?php echo $_POST['schema'] ?>" />

        <button type="submit">Update</button>
    </form>
</body>

</html>