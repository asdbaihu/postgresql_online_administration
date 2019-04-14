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