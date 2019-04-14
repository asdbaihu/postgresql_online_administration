<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
//Get member
require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$permission = $api->selectUserTablePermissions($_POST["user"], $_POST["schema"], $_POST["table"]);
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
    <h1>Manage <?php echo $_POST["user"]." permissions for ".$_POST["schema"].".".$_POST["table"] ?></h1>

    <form class="form-request" id="schemaPermissions" action="../library/requestProcessing.php" method="POST">
        <div class="checkbox">
            <input type="checkbox" name="select" value="select" <?php if ($permission->select == true) echo 'checked'; ?>> Select
        </div>
        <div class="checkbox">
            <input type="checkbox" name="insert" value="insert" <?php if ($permission->insert == true) echo 'checked'; ?>> Insert
        </div>
        <div class="checkbox">
            <input type="checkbox" name="update" value="update" <?php if ($permission->update == true) echo 'checked'; ?>> Update
        </div>
        <div class="checkbox">
            <input type="checkbox" name="delete" value="delete" <?php if ($permission->delete == true) echo 'checked'; ?>> Delete
        </div>
        <input type="hidden" name="user" id="user" value="<?php echo $_POST['user'] ?>" />
        <input type="hidden" name="table_schema_manage" id="table_schema_manage" value="<?php echo $_POST['schema'] ?>" />
        <input type="hidden" name="table_manage" id="table_manage" value="<?php echo $_POST['table'] ?>" />

        <button type="submit">Update</button>
    </form>
</body>

</html>