<?php 
session_start();
require_once 'API/DatabaseAPI.php';

if (isset($_POST["user_name"])) {
    $create = new DatabaseAPI();
    $create->createUser($_POST["user_name"], $_POST["user_password"]);
    header('Location: ../pages/requests.php');
}

elseif (isset($_POST["schema_name"])) {
    $create = new DatabaseAPI();
    $create->createSchema($_POST["schema_name"]);
    header('Location: ../pages/requests.php');
}

elseif (isset($_POST["table_name"])) {
    $create = new DatabaseAPI();
    $create->createTable($_POST["schema"], $_POST["table_name"]);
    header('Location: ../pages/requests.php');
}

elseif (isset($_POST["manage_user"])) {
    $manage = new DatabaseAPI();
    $manage->manageUser(isset($_POST["usecreatedb"]) + 0, isset($_POST["usesuper"]) + 0, isset($_POST["userepl"]) + 0, isset($_POST["usebypassrls"]) + 0, $_POST["manage_user"]);
    header('Location: ../pages/requests.php');
}

elseif (isset($_POST["schema_manage"])) {
    $manage = new DatabaseAPI();
    $manage->manageUserSchema($_POST["schema_manage"], $_POST["user"], isset($_POST["use"]) + 0, isset($_POST["create"]) + 0);
    header('Location: ../pages/requests.php');
}
?>