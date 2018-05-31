<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.05.2018
 * Time: 09:05
 */

require_once("../controller/GalleryController.php");
$galleryController = new GalleryController();
if(!isset($_GET['galleryId'])) {
    $gallery = $galleryController->getGallery($_SESSION['sharedgid']);

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                TODO: hier Bilder der Galerie einfügen. Die freigegebene Galerie ist in der Variable $gallery gespeichert. Die ID davon in der Session mit dem Namen sharedgid -> $_SESSION['sharedgid']
            </div>
        </div>
    </div>
    <?php
}
?>