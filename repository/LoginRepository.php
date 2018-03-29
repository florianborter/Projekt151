<?php
require_once '../lib/Repository.php';
/**
 * Datenbankschnittstelle für die Benutzer
 */
  class LoginRepository extends Repository
  {
        protected $tableName = "userig";

        public function addUser($nickname, $email, $passphrase){
            $query = "INSERT INTO {$this->tableName} (nickname, email, passphrase) 
                      VALUES (?, ?, ?);";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param("sss", $nickname, $email, $passphrase);
            $statement->execute();
        }
  }
?>