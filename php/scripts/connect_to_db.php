<?php
// Script permettant de se connecter à une base de donnée MySQL

   // class Database {
   //    private $_conn = null;
   //    public function getConnection() {
   //       if (!is_null($this->_conn)) {
   //          return $this->_conn;
   //       }
   //       $this->_conn = false;
   //       try {
   //          $this->_conn = new PDO('mysql:host=db5006521622.hosting-data.io;dbname=dbs5411583;charset=utf8', 'dbu909014', 'Numerica2022');
   //       } catch(PDOException $e) { }
   //       return $this->_conn;
   //    }
   // }

    class Database {
        private $_conn = null;
        public function getConnection() {
            if (!is_null($this->_conn)) {
                return $this->_conn;
            }
            $this->_conn = false;
            try {
                $this->_conn = new PDO('mysql:host=localhost;dbname=gcn;charset=utf8', 'root', 'root');
            } catch(PDOException $e) { }
            return $this->_conn;
        }
    }
?>