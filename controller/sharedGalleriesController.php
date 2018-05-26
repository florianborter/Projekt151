<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.05.2018
 * Time: 10:06
 */

class sharedGalleriesController
{

    public function showSharedGalleries(){
        $view = new View('sharedGalleries');
        $view->title = 'Bilder-DB';
        $view->heading = 'Freigegebene Galerien';
        $view->display();
    }

    public function showSharedGalleryDetail(){
        $view = new View('sharedGalleryDetail');
        $view->title = 'Bilder-DB';
        $view->heading = 'Freigegebene Galerie';
        $view->display();
        if (isset($_GET['galleryId'])){
            $_SESSION['sharedgid'] = $_GET['galleryId'];
            header("Location: ".$GLOBALS['appurl']."/sharedGalleries/showSharedGalleryDetail");
        }
    }
}