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
            $galleryRepo->createGallery($_POST["namegallery"], $_POST["description"],$_SESSION["uid"]);
            $_SESSION['createGalleryInfo'] = "";
            header("Location: ".$GLOBALS['appurl']."/Gallery/showGallery");
        } else{
            $_SESSION['createGalleryInfo'] = "Fülle bitte alle Felder aus";
        }
    }

    public function pictureAdd(){
        $galleryRepo = new GalleryRepository();
        if(isset($_POST['fileToUpload'])){
            $imagename=addslashes($_FILES["fileToUpload"]["name"]);
            $imageTemp=addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
            $imageType=addslashes($_FILES["fileToUpload"]["type"]);
            $gid = $_SESSION['gid'];

            if(substr($imageType,0,5) =="image"){
                $galleryRepo->addPicture($imagename,$imageTemp,$gid);
                $_SESSION['addPictureInfo'] = "";
            }
            else {
                echo "Nur Bilder sind erlaubt";
            }
        } else{
            $_SESSION['addPictureInfo'] = "Kein Bild ausgewählt";
        }
    }

    public function getPictures(){
        $galleryRepo = new GalleryRepository();
        $pictures = $galleryRepo->getPicturesData();
        return $pictures;
    }





    public function getGalleries(){
        $galleryRepo = new GalleryRepository();
        $datas = $galleryRepo->getGalleryData();
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
                $this->updateGallery($_SESSION['gid'], $_POST['galleryname'], $_POST['decription'], $isChecked);
                $this->showGalleryDetail();
            }
            if($functionToExecute == "deleteGallery"){
                $this->deleteGallery($_SESSION['gid']);
                $this->showGallery();
            }
        }
    }
    public function showGalleryDetail(){
        $view = new View('galleryDetail');
        $view->title = 'Bilder-DB';
        $view->heading = 'Gallerie bearbeiten';
        $view->display();
        if (isset($_GET['galleryId'])){
            $_SESSION['gid'] = $_GET['galleryId'];
            header("Location: ".$GLOBALS['appurl']."/Gallery/showGalleryDetail");
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