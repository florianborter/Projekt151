<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.05.2018
 * Time: 10:06
 */

class sharedGalleriesController
{

    /**
     * sharedGalleriesController constructor.
     */
    public function __construct()
    {
        $_SESSION['registrationInfo'] = "";
        $_SESSION['loginInfo'] = "";
        $_SESSION['createGalleryInfo'] = "";
        $_SESSION['editGalleryInfo'] = "";
        $_SESSION['addPictureInfo'] = "";
        $_SESSION['editUserInfo'] = "";
    }

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
        /*if (isset($_GET['galleryId'])){
            $_SESSION['sharedgid'] = $_GET['galleryId'];
            header("Location: ".$GLOBALS['appurl']."/sharedGalleries/showSharedGalleryDetail");
        }*/
        if (isset($_GET['galleryId'])){
            $galleryRepo = new GalleryRepository();
            $result = $galleryRepo->getGallery($_GET['galleryId']);
            $array = json_decode(json_encode($result), true);
            if($array['shared'] == 1){
                $_SESSION['sharedgid'] = $_GET['galleryId'];
                header("Location: ".$GLOBALS['appurl']."/sharedGalleries/showSharedGalleryDetail");
            } else{
                session_destroy();
                header("Location: ".$GLOBALS['appurl']."/Default");
            }
        }
    }
}