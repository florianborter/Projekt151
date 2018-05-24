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
    public function create(){
        $galleryRepo = new GalleryRepository();
        $galleryRepo->createGallery($_POST["namegallery"], $_POST["description"],$_SESSION["uid"]);
    }

    public function getGalleries(){
        $galleryRepo = new GalleryRepository();
        $datas = $galleryRepo->getGalleryData();

        return $datas;
    }
}
?>