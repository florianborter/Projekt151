<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.04.2018
 * Time: 09:12
 */

require_once("../controller/GalleryController.php");
$galleryController = new GalleryController();
foreach ($galleryController->getGalleryFromUser($_SESSION['uid']) as $gallery){
    foreach ($galleryController->getPicturesFromGallery($gallery['GID']) as $picture) {
        $image_name=$picture["picturename"];
        $image_path=$picture["path"];
        $src = $image_path;
        $src .= $image_name;
        ?>
        <div class="row">
            <div class="thumbnailCustom">
                <a href="<?=$src?>" target="_blank">
                    <img src="<?=$src?>" alt="<?=$src?>">
                </a>
                <h6>Titel des Bildes</h6>
            </div>
        </div>
        <?php
    }
}
?>