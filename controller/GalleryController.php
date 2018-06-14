<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 17.05.2018
 * Time: 08:59
 */
require_once("../repository/GalleryRepository.php");
class GalleryController
{
    public function showGallery()
    {
        $view = new View('showGallery');
        $view->title = 'Bilder-DB';
        $view->heading = 'Deine Galerien';
        $view->display();
        $_SESSION['createGalleryInfo'] = "";
        $_SESSION['editUserInfo'] = "";
    }
    public function createGallery()
    {
        $view = new View('createGallery');
        $view->title = 'Bilder-DB';
        $view->heading = 'Erstelle eine neue Galerie';
        $view->display();
        $_SESSION['editGalleryInfo'] = "";
        $_SESSION['addPictureInfo'] = "";
        $_SESSION['editUserInfo'] = "";
    }

    public function create(){
        $galleryRepo = new GalleryRepository();
        if($_POST["namegallery"] != "" && $_POST["description"] != ""){
            $galleryName=$_POST["namegallery"];
            $galleryName = htmlspecialchars($galleryName);
            $decription = htmlspecialchars($_POST["description"]);
            $galleryRepo->createGallery($galleryName, $decription,$_SESSION["uid"]);
            $_SESSION['createGalleryInfo'] = "";
            header("Location: ".$GLOBALS['appurl']."/Gallery/showGallery");
        } else{
            $_SESSION['createGalleryInfo'] = "Fülle bitte alle Felder aus";
        }
    }

    public function pictureAdd(){
        $galleryRepo = new GalleryRepository();
        if ($_FILES['fileToUpload']['name'] != ""){
            $imagename=$_FILES["fileToUpload"]["name"];
            $uid = $_SESSION['uid'];
            $path = "./../img/$uid/";
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "$path".$_FILES["fileToUpload"]["name"]);
            $gid = $_SESSION['gid'];

            $galleryRepo->addPicture($path,$imagename,$gid);
            $_SESSION['addPictureInfo'] = "";
        } else{
            $_SESSION['addPictureInfo'] = "Kein Bild ausgewählt";
        }
    }

    public function getPicturesFromGallery($gid){
        $galleryRepo = new GalleryRepository();
        $pictures = $galleryRepo->getPicturesFromGallery($gid);
        return $pictures;
    }

    public function getGalleries(){
        $galleryRepo = new GalleryRepository();
        $datas = $galleryRepo->getGalleryData();
        return $datas;
    }

    public function getGalleryFromUser($uid){
        $galleryRepo = new GalleryRepository();
        $datas = $galleryRepo->getGalleryFromUser($uid);
        return $datas;
    }

    public function getGallery($galleryId){
        $galleryRepo = new GalleryRepository();
        $result = $galleryRepo->getGallery($galleryId);
        $array = json_decode(json_encode($result), true);
        return $array;
    }

    public function executeFunction(){
        if (isset($_POST) && isset($_POST['functionGalleryDetail'])){
            $functionToExecute = $_POST['functionGalleryDetail'];
            if($functionToExecute == "addPicture"){
                $this->pictureAdd();
                $this->showGalleryDetail();
            }
            if($functionToExecute == "updateGallery"){
                if(isset($_POST['shared']) && $_POST['shared'] == 'checked'){
                    $isChecked = 1;
                } else{
                    $isChecked = 0;
                }
                $this->updateGallery($_SESSION['gid'], htmlspecialchars($_POST['galleryname']), htmlspecialchars($_POST['decription']), $isChecked);
                $this->showGalleryDetail();
            }
            if($functionToExecute == "deleteGallery"){
                $this->deleteGallery($_SESSION['gid']);
                $this->showGallery();
            }
            if(strpos($functionToExecute, "deleteImage")!== false){
                if(isset($_POST['update'])){
                    $galleryrepo = new GalleryRepository();
                    $galleryrepo->updatePicture(substr($functionToExecute, -1), $_POST['updateText']);
                    $this->showGalleryDetail();
                }else{
                    $this->deleteImage(substr($functionToExecute, -1));
                    $this->showGalleryDetail();
                }
            }
        }
    }

    public function deleteImage($pid){
        $galleryrepo = new GalleryRepository();
        $picture = $galleryrepo->getPictureById($pid);
        $array = json_decode(json_encode($picture), true);
        $image_name=$array["picturename"];
        $image_path=$array["path"];
        $src = $image_path;
        $src .= $image_name;
        unlink($src);
        $galleryrepo->deletePicture($pid);
    }

    public function showGalleryDetail(){
        $view = new View('galleryDetail');
        $view->title = 'Bilder-DB';
        $view->heading = 'Gallerie bearbeiten';
        $view->display();
        $galleryRepo = new GalleryRepository();
        if (isset($_GET['galleryId'])){
            $result = $galleryRepo->getGallery($_GET['galleryId']);
            $array = json_decode(json_encode($result), true);
            if($array['UID'] == $_SESSION['uid']){
                $_SESSION['gid'] = $_GET['galleryId'];
                header("Location: ".$GLOBALS['appurl']."/Gallery/showGalleryDetail");
            } else{
                session_destroy();
                header("Location: ".$GLOBALS['appurl']."/Default");
            }
        }
    }

    public function updateGallery($gid, $galleryname, $decription, $shared){
        $galleryRepo = new GalleryRepository();
        if($galleryname!="" && $decription!=""){
            $galleryRepo->updateGallery($gid, $galleryname, $decription, $shared);
            $_SESSION['editGalleryInfo'] = "";
        } else{
            $_SESSION['editGalleryInfo'] = "Bitte füllen sie alle Felder aus";
        }
        $_SESSION['addPictureInfo'] = "";
    }

    public function deleteGallery($gid){
        $galleryRepo = new GalleryRepository();
        $galleryRepo->deleteGallery($gid);
    }
}
?>