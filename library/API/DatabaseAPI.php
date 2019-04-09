<?php 
    require_once 'ConnectionAPI.php';

    class DatabaseAPI extends ConnectionAPI{

        public function checkSuperUser() {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT user FROM pg_user WHERE usename ='".$_SESSION["username"]."' AND usesuper = TRUE";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
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

        //Usage of pg_ functions
        public function insertMember($m_id, $m_surname, $m_firstname, $m_address, $m_zipcode, $m_phone) {
            
            $username = $_SESSION["username"];
            $password = $_SESSION["password"];
            
            //Initialize connection
            $connect = pg_connect("host=localhost port=5432 dbname=test user=$username password=$password");        

            // prepare sql and bind parameters
            $stmt = pg_prepare($connect, "query", "INSERT INTO exos.members (memid, surname, firstname, address, zipcode, telephone,joindate) 
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8)");

            //Format date
            $m_joindate = date('Y-m-d H:i:s');

            //Execute sql query
            $stmt = pg_execute($connect, "query", array($m_id, $m_surname, $m_firstname, $m_address, $m_zipcode, $m_phone, $m_joindate));

            //Close connection
            pg_close($connect);
        }

        //Usage of PDO
        public function insertFacility($f_facid, $f_name, $f_membercost, $f_guestcost, $f_initialoutlay, $f_monthlymaintenance){
            
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);  
                  

            // prepare sql and bind parameters
            $stmt = $this->connection->prepare("INSERT INTO exos.facilities (facid, name, membercost, guestcost,initialoutlay, monthlymaintenance) 
            VALUES (:f_facid, :f_name, :f_membercost, :f_guestcost,:f_initialoutlay, :f_monthlymaintenance)");
            $stmt->bindParam(':f_facid', $f_facid);
            $stmt->bindParam(':f_name', $f_name);
            $stmt->bindParam(':f_membercost', $f_membercost);
            $stmt->bindParam(':f_guestcost', $f_guestcost);
            $stmt->bindParam(':f_initialoutlay', $f_initialoutlay);
            $stmt->bindParam(':f_monthlymaintenance', $f_monthlymaintenance);


            $stmt->execute();

            $this->disconnectDB();
        }

        public function insertBooking($b_bookid, $b_facid, $b_memid, $b_starttime, $b_slots){
            
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);         
            

                // prepare sql and bind parameters
            $stmt = $this->connection->prepare("INSERT INTO exos.bookings (bookid, facid, memid, starttime, slots) 
            VALUES (:b_bookid, :b_facid, :b_memid, :b_starttime, :b_slots)");
            $stmt->bindParam(':b_bookid', $b_bookid);
            $stmt->bindParam(':b_facid', $b_facid);
            $stmt->bindParam(':b_memid', $b_memid);
            $stmt->bindParam(':b_starttime', $b_starttime);
            $stmt->bindParam(':b_slots', $b_slots);

            $b_starttime = date('Y-m-d H:i:s', strtotime($b_starttime));

            $stmt->execute();

            $this->disconnectDB();
        }

        public function selectAllMembers() {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT * FROM exos.members";

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

        public function selectAllFacilities() {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT * FROM exos.facilities";

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

        public function selectAllBookings() {
            $this->connectDB("All", "all");
       
            $sql="SELECT 
                        b.bookid,
                        b.facid,
                        f.name,
                        b.memid,
                        m.surname,
                        m.firstname
                    FROM
                        exos.bookings b
                    INNER JOIN exos.facilities f ON (b.facid = f.facid)
                    INNER JOIN exos.members m ON (b.memid = m.memid) ";

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