<?php 
    require_once 'ConnectionAPI.php';

    class DatabaseAPI extends ConnectionAPI{

        public function createUser() {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
            $sql="CREATE USER ".$_POST["user_name"]." WITH ENCRYPTED PASSWORD '".$_POST["user_password"]."';";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            pg_close($connect);
        }

        public function createSchema() {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
            $sql="CREATE SCHEMA IF NOT EXISTS ".$_POST["schema_name"].";";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            pg_close($connect);
        }

        public function createTable($schema, $table) {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
            $sql="CREATE TABLE IF NOT EXISTS ".$schema.".".$table." (id SERIAL PRIMARY KEY);";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            pg_close($connect);
        }

        public function checkSuperUser() {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT user FROM pg_user WHERE usename ='".$_SESSION["username"]."' AND usesuper = TRUE";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function manageUser($usecreatedb, $usesuper, $userepl, $usebypassrls, $user) {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);

            if ($usecreatedb == 1) {
                $sql = "ALTER ROLE ".$user." CREATEROLE CREATEDB;";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "ALTER ROLE ".$user." CREATEROLE NOCREATEDB;";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            if ($usesuper == 1) {
                $sql = "ALTER ROLE ".$user." WITH SUPERUSER;";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "ALTER ROLE ".$user." WITH NOSUPERUSER;";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            if ($userepl == 1) {
                $sql = "ALTER ROLE ".$user." WITH REPLICATION;";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "ALTER ROLE ".$user." WITH NOREPLICATION;";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            if ($usebypassrls == 1) {
                $sql = "ALTER ROLE ".$user." WITH BYPASSRLS;";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "ALTER ROLE ".$user." WITH NOBYPASSRLS;";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
        }

        public function manageUserSchema($schema, $user, $use, $create) {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);

            if ($use == 1) {
                $sql = "GRANT USAGE ON SCHEMA ".$schema." TO ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "REVOKE USAGE ON SCHEMA ".$schema." FROM ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            if ($create == 1) {
                $sql = "GRANT CREATE ON SCHEMA ".$schema." TO ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "REVOKE CREATE ON SCHEMA ".$schema." FROM ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
        }

        public function manageUserTable($schema, $table, $user, $select, $insert, $update, $delete) {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);

            if ($select == 1) {
                $sql = "GRANT SELECT ON ".$schema.".".$table." TO ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "REVOKE SELECT ON ".$schema.".".$table." FROM ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            if ($insert == 1) {
                $sql = "GRANT INSERT ON ".$schema.".".$table." TO ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "REVOKE INSERT ON ".$schema.".".$table." FROM ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            if ($update == 1) {
                $sql = "GRANT UPDATE ON ".$schema.".".$table." TO ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "REVOKE UPDATE ON ".$schema.".".$table." FROM ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            if ($delete == 1) {
                $sql = "GRANT DELETE ON ".$schema.".".$table." TO ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            else {
                $sql = "REVOKE DELETE ON ".$schema.".".$table." FROM ".$user.";";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
        }

        public function selectUser($user) {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT * FROM pg_user WHERE usename ='".$user."'";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function selectUsers() {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT * FROM pg_user";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $tab=[];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $tab[] = $result;
            }         
            $this->disconnectDB();
            
            $tab = count($tab) > 0 ? $tab : null; 
            return $tab;
        }

        public function selectTableList($schema) {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT * FROM information_schema.tables WHERE table_schema = '".$schema."'";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $tab=[];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $tab[] = $result;
            }         
            $this->disconnectDB();
            
            $tab = count($tab) > 0 ? $tab : null; 
            return $tab;
        }

        public function selectSchemaList() {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT nspname FROM pg_catalog.pg_namespace WHERE nspname !~ '^pg_' AND nspname <> 'information_schema' ";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $tab=[];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $tab[] = $result;
            }         
            $this->disconnectDB();
            
            $tab = count($tab) > 0 ? $tab : null; 
            return $tab;
        }

        public function selectUserPermissions($schema) {
            
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT
                pg_catalog.has_schema_privilege('".$schema."', 'USAGE') AS use,
                pg_catalog.has_schema_privilege('".$schema."', 'CREATE') AS create";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function selectSpeUserPermissions($user, $schema) {
            
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT
                pg_catalog.has_schema_privilege('".$user."','".$schema."', 'USAGE') AS use,
                pg_catalog.has_schema_privilege('".$user."','".$schema."', 'CREATE') AS create";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function selectUserTablePermissions($user, $schema, $table) {
            
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT
                pg_catalog.has_table_privilege('".$user."','".$schema.".".$table."', 'SELECT') AS select,
                pg_catalog.has_table_privilege('".$user."','".$schema.".".$table."', 'INSERT') AS insert,
                pg_catalog.has_table_privilege('".$user."','".$schema.".".$table."', 'UPDATE') AS update,
                pg_catalog.has_table_privilege('".$user."','".$schema.".".$table."', 'DELETE') AS delete";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function select($table) {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT * FROM ".$table;

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $tab=[];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $tab[] = $result;
            }         
            $this->disconnectDB();
            
            $tab = count($tab) > 0 ? $tab : null; 
            return $tab;
        }
    }
    
?>