<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body> 
    <h1 class="login">Log In to Database</h1>
    <form action="library/checkLogin.php" method="POST">
        <input class="input" type="text" id="username" name="username" placeholder="username" required>
        <input class="input" type="password" id="password" name="password" placeholder="password" required>
        <input class="button" type="submit" value="Send">
    </form>
    
    <?php if(isset($_GET['error'])) { ?>
        <?php if($_GET['error'] == 1) : ?>
            <p>Login or Password incorrect</p>
        <?php elseif($_GET['error'] == 2) : ?>
            <p>Session expired, please reconnect</p>
        <?php else : ?>
            
        <?php endif; ?>
    <?php } ?>
    
    
</body>

</html>