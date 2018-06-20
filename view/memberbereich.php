<div class="row">
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

        $image_name=$picture["picturename"];
        $image_path=$picture["thumbpath"];
        $thumbsrc = $image_path;
        $thumbsrc .= $image_name;
        ?>
            <div class="thumbnailCustom">
                <a href="<?=$src?>" target="_blank" data-lightbox="bild-1" data-title="Bildunterschrift">
                    <img src="<?=$thumbsrc?>" alt="<?=$thumbsrc?>">
                </a>
                <h6><?=$picture['picturedescription']?></h6>
            </div>
        <?php
    }
}
?>
</div>