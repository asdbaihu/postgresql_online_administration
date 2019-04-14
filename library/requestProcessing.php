<?php 
session_start();
require_once 'API/DatabaseAPI.php';

if (isset($_POST["m_id"])) {
    $insert = new DatabaseAPI();
    $insert->insertMember($_POST['m_id'], $_POST['m_surname'], $_POST['m_firstname'], $_POST['m_address'], $_POST['m_zipcode'], $_POST['m_phone']);
    header('Location: ../pages/requests.php');
}

elseif (isset($_POST["f_id"])) {
    $insert = new DatabaseAPI();
    $insert->insertFacility($_POST['f_id'], $_POST['f_name'], $_POST['f_membercost'], $_POST['f_guestcost'], $_POST['f_initialoutlay'], $_POST['f_monthlymaintenance']);
    header('Location: ../pages/requests.php');
}

elseif (isset($_POST["b_id"])) {
    $insert = new DatabaseAPI();
    $insert->insertBooking($_POST['b_id'], $_POST['b_facid'], $_POST['b_memid'], $_POST['b_starttime'], $_POST['b_slots']);
    header('Location: ../pages/requests.php');
}

elseif (isset($_POST["user_name"])) {
    $create = new DatabaseAPI();
    $create->createUser($_POST["user_name"], $_POST["user_password"]);
    header('Location: ../pages/requests.php');
}

elseif (isset($_POST["schema_name"])) {
    $create = new DatabaseAPI();
    $create->createSchema($_POST["schema_name"]);
    header('Location: ../pages/requests.php');
}

elseif (isset($_POST["manage_user"])) {
    $manage = new DatabaseAPI();
    $manage->manageUser(isset($_POST["usecreatedb"]) + 0, isset($_POST["usesuper"]) + 0, isset($_POST["userepl"]) + 0, isset($_POST["usebypassrls"]) + 0, $_POST["manage_user"]);
    header('Location: ../pages/requests.php');
}
?>