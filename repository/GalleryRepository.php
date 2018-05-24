<?php
require_once '../lib/Repository.php';
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 17.05.2018
 * Time: 09:12
 */


class GalleryRepository extends Repository
{
    protected $tableName = "gallery";

    public function createGallery($nameGallery, $description, $uid){
        $query = "INSERT INTO {$this->tableName} (galleryname, decription, UID) 
                      VALUES (?, ?, ?);";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param("ssi",$nameGallery, $description, $uid);
        $statement->execute();
    }

    public  function getGalleryData(){
        $query ="SELECT galleryname, decription, UID FROM {$this->tableName}";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->get_result();

        if (!$result) {
            throw new Exception($statement->error);
        }

        return $result;
    }
}