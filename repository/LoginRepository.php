<?php
require_once '../lib/Repository.php';
/**
 * Datenbankschnittstelle für die Benutzer
 */
  class LoginRepository extends Repository
  {
        protected $tableName = 'userig';

        public function addUser($nickname, $email, $passphrase){
            $query = "INSERT INTO {$this->tableName} ('nickname', 'email', 'passphrase') 
                      VALUES ($nickname, $email, $passphrase)";

            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->execute();

            $result = $statement->get_result();
            if(!result){
                throw new Exception($statement->error);
            }
        }
  }
?>