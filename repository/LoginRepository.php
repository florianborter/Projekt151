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

        public function getEmails(){
            $query = "SELECT email FROM {$this->tableName}";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->execute();
            $result = $statement->get_result();

            if (!$result) {
                throw new Exception($statement->error);
            }

            // Datensätze aus dem Resultat holen und in das Array $rows speichern
            $rows = array();
            while ($row = $result->fetch_object()) {
                $rows[] = $row;
            }
            return $rows;
        }

        public function getEmailAndPassphrase(){
            $query = "SELECT email,passphrase FROM {$this->tableName}";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->execute();
            $result = $statement->get_result();

            if (!$result) {
                throw new Exception($statement->error);
            }

            // Datensätze aus dem Resultat holen und in das Array $rows speichern
            $rows = array();
            while ($row = $result->fetch_object()) {
                $rows[] = $row;
            }
            return $rows;
        }
  }
?>