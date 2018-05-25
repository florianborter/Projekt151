<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 24.05.2018
 * Time: 09:05
 */

    $galleryController = new GalleryController();
    //wenn yves gepusht hat kann die gid von der Session genommen werden.
    //$gallery = $galleryController->getGallery($_SESSION['gid']);
    $gallery = $galleryController->getGallery(1);
    var_dump($gallery);

?>
<div class="container">
    <div class="row">
        <div class="col-md-9">

        </div>
        <!--Edit bereich-->
        <div class="col-md-3">
            <div class="container">
                <div class="row">
                    <p>Name der Galerie:</p>
                    <p><?=$gallery['galleryname']?></p>
                </div>
            </div>
        </div>
    </div>
</div>
