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
    protected $tablePicture = "picture";
    public function createGallery($nameGallery, $description, $uid){
        $query = "INSERT INTO {$this->tableName} (galleryname, decription, UID) 
                      VALUES (?, ?, ?);";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param("ssi",$nameGallery, $description, $uid);
        $statement->execute();
    }

    public  function getGalleryData(){
        $query ="SELECT GID, galleryname, decription, UID, shared FROM {$this->tableName}";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        return $result;
    }

    public  function getGalleryFromUser($uid){
        $query ="SELECT GID, galleryname, decription, UID, shared FROM {$this->tableName} where UID=$uid";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        return $result;
    }

    public function addPicture($path, $imagename, $gid, $thumbPath){
        $empty = "keine";
        $query = "INSERT INTO {$this->tablePicture} (path, picturename, picturedescription, GID, thumbpath)
                          VALUES(?,?,?,?,?);";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param("sssis",$path, $imagename, $empty, $gid, $thumbPath);
        $statement->execute();
    }

    public function getGallery($galleryId){
        $query ="SELECT * FROM {$this->tableName} WHERE GID = $galleryId;";
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

    public function updateGallery($gid, $galleryname, $decription, $shared){
        $query = "UPDATE {$this->tableName} set galleryname='$galleryname', decription='$decription', shared='$shared'
                      WHERE GID = $gid;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
    }

    public function updatePicture($PID, $description){
        $query = "UPDATE {$this->tablePicture} set picturedescription='$description'
                      WHERE PID = $PID;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
    }

    public function getPictureById($PID){
        $query ="SELECT * FROM {$this->tablePicture} WHERE PID = $PID;";
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

    public function deleteGallery($gid){
        $query = "Delete from {$this->tableName} WHERE GID = $gid;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
    }

    public function getPicturesData(){
        $query ="SELECT * FROM {$this->tablePicture}";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        return $result;
    }

    public function getPicturesFromGallery($gid){
        $query ="SELECT * FROM {$this->tablePicture} where GID=$gid";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        return $result;
    }

    public function deletePicture($pid){
        $query = "Delete from {$this->tablePicture} WHERE PID = $pid;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
    }
}