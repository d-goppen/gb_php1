<!-- Generates pictures gallery -->
<div class="galleryPane">
    <?php
    require_once(VIEWS_DIR . 'upload_form.php');
    foreach ($sql_res as $picture) {
    ?>
        <a class="pictureLink" href="<?php echo BASE_URL . "/?id={$picture['id']}" ?>">
            <div class="pictureThumbContainer">
                <img class="pictureThumb" src="<?php echo PICTURES_SMALL . $picture['name_small'] ?>" alt="Picture not found">
            </div>
            <div class="viewCount"><?php echo $picture['view_count'] ?> views</div>
        </a>
    <?php
    } // foreach
    ?>
</div>