<?php
    class DBConnection {
        const HOST = "mysql2-co.conexcol.net";
        const USER = "anuarioc1_admin";
        const PASS = "AnuDB2468";
        const BD   = "anuarioc1_nuevo";

        public static $handle;

        public function __construct(){
            try {
                self::$handle = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::BD . ';charset=utf8', self::USER, self::PASS,
                    array(
                        PDO::MYSQL_ATTR_MAX_BUFFER_SIZE => 100,
                    )
                );
            }
            catch(Exception $e){
                return 'Could not connect: ' . $e->getMessage() . PHP_EOL;
            }
        }

        public static function query($sql){
            if(!$response = self::$handle->query($sql)->fetchAll()){
                return "Error no: " . self::$handle->errno . PHP_EOL .
                "Error: " . self::$handle->error . PHP_EOL;
            }

            return $response;
        }

        public static function prepared_query($sql, $params){
            try {
                $stmt = DBConnection::$handle->prepare($sql);
                $stmt->execute($params);

                /*
                echo "<pre>";
                print_r($stmt->debugDumpParams());
                echo "</pre>";
                */

                $result = $stmt->fetchAll();
                if(!is_array($result) || empty($result)){
                    return "No records found" . PHP_EOL;
                }

                return $result;
            }
            catch(Exception $e){
                return "Query error: " . $e->getMessage() . PHP_EOL;
            }
        }

    }
