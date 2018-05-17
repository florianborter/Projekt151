<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.04.2018
 * Time: 09:12
 */

    $memberbereichController = new MemberbereichController();

    $dir = glob('../img/{*.jpg,*.png}',GLOB_BRACE);
    foreach ($dir as $value){
    ?>
    <div class="thumbnail">
        <img src="<?php echo $value ?>" alt="<?php echo $value;?>">
        <h6>Titel des Bildes</h6>
    </div>

    <?php
}

?>