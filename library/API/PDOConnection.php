<?php
    class PDOConnection{

        private static $instance = null;
        
        const DNS = 'pgsql:host=localhost;dbname=test';

        public static function connectDB($user, $password){
            try{
                self::$instance = new PDO(self::DNS, $user, $password, array( PDO::ATTR_TIMEOUT => 100, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$instance;
            
            }catch (PDOException $e){
                die($e->getMessage());
                echo $e;
                return null;
            }
        }

        public static function disconnectDB(){
            self::$instance = null;
        }
    }
?>