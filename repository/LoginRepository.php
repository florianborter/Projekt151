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
            $passphrase = md5($passphrase);

            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param("sss", $nickname, $email, $passphrase);
            $statement->execute();
        }

        public function getEmails(){
            $query = "SELECT email FROM {$this->tableName}";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->execute();
            $result = $statement->get_result();

            if (!$result) {
                throw new Exception($statement->error);
            }

            return $result;
        }

        public function getIdEmailAndPassphrase(){
            $query = "SELECT uid,email,passphrase FROM {$this->tableName}";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->execute();
            $result = $statement->get_result();

            if (!$result) {
                throw new Exception($statement->error);
            }

            return $result;
        }
  }
?>