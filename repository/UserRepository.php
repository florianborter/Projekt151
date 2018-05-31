<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.05.2018
 * Time: 16:16
 */

require_once '../lib/Repository.php';

class UserRepository extends Repository
{
    protected $tableName = "userig";

    public function getUser($uid){
        $query ="SELECT * FROM {$this->tableName} WHERE UID = $uid;";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->get_result();

        if (!$result) {
            throw new Exception($statement->error);
        }

        $row = array();
        $row = $result->fetch_object();
        return $row;
    }

    public function editPassphrase($passphrase, $uid){
        $query = "UPDATE {$this->tableName} set passphrase='$passphrase'
                      WHERE UID = $uid;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
    }

    public function editUserNicknameAndEmail($nickname, $email, $uid){
        $query = "UPDATE {$this->tableName} set nickname='$nickname', email='$email'
                      WHERE UID = $uid;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
    }

    public function deleteUser($uid){
        $query = "Delete from {$this->tableName} WHERE UID = $uid;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
    }
}