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
    <title>Select</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <?php require "navbar.php"; ?>
    <h1 class="login">Select <?php echo $_POST["selectTable"] ?></h1>
    <p style="color:#fff;margin:auto">
    <?php  
        require "../library/API/DatabaseAPI.php";
        $api = new DatabaseAPI();
        $result = $api->select($_POST["selectTable"]);
        
        function afficher_tableau($tableau) {
            foreach ($tableau as $cle=>$valeur) {
                if( is_array($valeur) || is_object($valeur) ) {
                    afficher_tableau($valeur);
                    echo '<br>';
                } else {
                    echo $cle.' = '.$valeur.' <br>';
                }
            }
        }
        if ($result) afficher_tableau($result);
    ?>
    </p>
</body>

</html>