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
                <?php
                /**
                 * Created by PhpStorm.
                 * User: vmadmin
                 * Date: 26.04.2018
                 * Time: 09:12
                 */

                require_once("../controller/GalleryController.php");
                $galleryController = new GalleryController();

                foreach ($galleryController->getPicturesFromGallery($_SESSION['sharedgid']) as $picture) {
                    $image_name=$picture["picturename"];
                    $image_path=$picture["path"];
                    $src = $image_path;
                    $src .= $image_name;
                    ?>
                    <div class="thumbnail">
                        <img src="<?=$src?>" alt="<?=$src?>">
                        <h6>TODO: Tags</h6>
                    </div>
                    <?php
                }

                ?>
            </div>
        </div>
    </div>
    <?php
}
?>