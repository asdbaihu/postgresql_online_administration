<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$schemaList = $api->selectSchemaList();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
</head>

<body>
    <?php require "navbar.php"; ?>
    <h1><?php echo "User : ".$_SESSION["username"] ?></h1>
    <?php $superUser = $api->checkSuperUser();
    if ($superUser): ?>
    <div class="button-container">
        <h2>Database administration</h2>
        <a class="button-element" href="createUser.php"><button>Create User</button></a>
        <a class="button-element" href="createSchema.php"><button>Create Schema</button></a>
        <a class="button-element" href="selectUser.php"><button>Manage Permissions</button></a>
    </div>
    <?php endif;

    foreach ($schemaList as &$schema) {
        $permission = $api->selectUserPermissions($schema->nspname); ?>
        <div class="button-container">
        <h2><?php echo "Schema : ".$schema->nspname; ?></h2>
        <?php if ($permission->create): ?>
            <form style="margin:0 16px" action="createTable.php" method="POST">
                <input type="hidden" name="createTable" id="createTable" value="<?php echo $schema->nspname ?>" />
                <button type="submit">Create table</button>
            </form>
            <form style="margin:0 16px" action="selectUserSchema.php" method="POST">
                <input type="hidden" name="manageSchema" id="manageSchema" value="<?php echo $schema->nspname ?>" />
                <button type="submit">Manage Permissions</button>
            </form>
        <?php endif;
        $tableList = $api->selectTableList($schema->nspname);
        if ($tableList) {
            foreach ($tableList as &$table) { ?>
                <h3><?php echo "Table : ".$schema->nspname.".".$table->table_name; ?></h3><?php
                if ($permission->use): ?>
                    <form style="margin:0 16px" action="select.php" method="POST">
                        <input type="hidden" name="selectTable" id="selectTable" value="<?php echo $schema->nspname.".".$table->table_name ?>" />
                        <button type="submit">Select</button>
                    </form>
                <?php endif; if ($permission->create): ?>
                    <form style="margin:0 16px" action="selectUserTable.php" method="POST">
                        <input type="hidden" name="schema" id="schema" value="<?php echo $schema->nspname ?>" />
                        <input type="hidden" name="table" id="table" value="<?php echo $table->table_name ?>" />
                        <button type="submit">Manage Permissions</button>
                    </form>
                <?php endif;
            }
        } ?>

        </div><?php
    } ?>
</body>

</html>