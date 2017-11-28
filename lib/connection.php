<?php
	class DBConnection {
        const HOST = "mysql2-co.conexcol.net";
        const USER = "anuarioc1_admin";
        const PASS = "AnuDB2468";
        const BD   = "anuarioc1_nuevo";

        public static $handle;

        public function __construct(){
            try {
                self::$handle = new mysqli(self::HOST, self::USER, self::PASS, self::BD);
            }
            catch(Exception $e){
                throw new Exception('Could not connect: ' . $e->getMessage());
            }
        }
            
        public static function query($sql){
            return self::$handle->query($sql);
        }
    }

    $con = new DBConnection();
