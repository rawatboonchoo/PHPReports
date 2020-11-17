<?php
    class DBController {
        private $hostname       =       "localhost";
        private $username       =       "root";
        private $password       =       "administrator";
        private $db             =       "report";
        private $dbcharset      =       "utf8";

        // ----------- [ Creating connection ] ---------------

        public function connect() {
            $conn               =       new mysqli($this->hostname, $this->username, $this->password, $this->db)or die("Database connection error." . $conn->connect_error);
               
            //set_charset utf8 
            $conn->set_charset($this->dbcharset);
            return $conn;           
        }

        // ---------- [ Closing connection ] -----------------

        public function close($conn) {
            $conn->close();
        }
    }
?>