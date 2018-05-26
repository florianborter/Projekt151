<?php
/**
 * Login-Formular
 * Das Formular wird mithilfe des Formulargenerators erstellt.
 */
require_once("../controller/GalleryController.php");

$gallerycontroller = new GalleryController();
foreach($gallerycontroller ->getGalleries() as $gallery){
    if ($gallery['UID'] == $_SESSION['uid']){
        ?>
        <div class="gallery">
            <?php echo "<a href=".$GLOBALS['appurl']."/Gallery/showGalleryDetail?galleryId=".$gallery['GID'].">";?>
                <h1><?php echo $gallery['galleryname']; ?></h1>
                <p><?php echo $gallery["decription"];?></p>
            </>
        </div>
        <?php
    }
}
?>
