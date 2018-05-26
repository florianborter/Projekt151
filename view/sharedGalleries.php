<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.05.2018
 * Time: 10:04
 */

require_once("../controller/GalleryController.php");
$gallerycontroller = new GalleryController();
?>

<div class="container">
    <div class="col-md-12">
        <?php
        foreach($gallerycontroller ->getGalleries() as $gallery){
            if ($gallery['shared'] == 1){
                ?>
                <div class="gallery">
                    <?php echo "<a href=".$GLOBALS['appurl']."/sharedGalleries/showSharedGalleryDetail?galleryId=".$gallery['GID'].">";?>
                    <h1><?php echo $gallery['galleryname']; ?></h1>
                    <p><?php echo $gallery["decription"];?></p>
                </a>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>