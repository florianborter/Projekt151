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

    }

    public function createGallery()
    {
        $view = new View('createGallery');
        $view->title = 'Bilder-DB';
        $view->heading = 'Erstelle eine neue Galerie';
        $view->display();

    }

    public function create(){
        $galleryRepo = new GalleryRepository();
        //$imagename=$_FILES[$_POST["fileToUpload"]]['name'];

        $imagename=addslashes($_FILES["fileToUpload"]["name"]);
        $imageTemp=addslashes(file_get_contents(["fileToUpload"]['tmp_name']));
        $imageType=addslashes($_FILES["fileToUpload"]["type"]);

        $galleryRepo->createGallery($_POST["namegallery"], $_POST["description"],$_SESSION["uid"]);

        if(substr($imageType,0,5) =="image"){
            $galleryRepo->addPicture($imagename,$imageTemp);
        }
        else{
            echo "Nur Bilder sind erlaubt";
        }

    }

    public function getGalleries(){
        $galleryRepo = new GalleryRepository();
        $datas = $galleryRepo->getGalleryData();

        return $datas;
    }

    public function showGalleryDetail(){
        $view = new View('galleryDetail');
        $view->title = 'Bilder-DB';
        $view->heading = 'Gallerie bearbeiten';
        $view->display();
    }
}
?>