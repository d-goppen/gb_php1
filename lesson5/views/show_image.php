<!-- Shows full-size image -->
<div class="galleryPane" style="flex-direction: column;">
    <?php
    $picture = mysqli_fetch_assoc($sql_res);
    $view_count_new = (int) $picture['view_count'] + 1;
    ?>
    <img class="fullSizePicture" src="<?php echo PICTURES_BIG . $picture['name_big'] ?>" alt="Picture not found">
</div>

<script>
    <?php
    $pictureInfo = "'{$picture['name_big']}, {$picture['full_width']} x {$picture['full_height']}, {$view_count_new} views'";
    echo "document.querySelector('.pictureInfo').innerText = {$pictureInfo};";
    ?>
</script>

<?php
// Updating view count.
mysqli_query($link, "UPDATE `gallery` SET `view_count` = {$view_count_new} WHERE `id` = {$picture['id']}");
?>