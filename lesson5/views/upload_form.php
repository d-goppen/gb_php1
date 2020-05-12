<form action="<?= BASE_URL ?>" enctype="multipart/form-data" method="post" style="display: none;">
    <input id="uploadFileName" type="file" name="picture" accept="image/*">
    // В атрибуте accept ограничиваем загружаемые файлы только картинками.
    <input id="uploadSubmit" type="submit">
</form>

<a id="getNewPicture" class="pictureLink" href="javascript:void(0)">
    <div class="pictureThumbContainer">
        <img class="pictureThumb" style="width: 50%; height: 50%;" src="/img/common/clip.svg" alt="Load new image">
    </div>
    <div class="viewCount">Upload new...</div>
</a>

<script>
    "use strict";
    document.getElementById('getNewPicture').addEventListener("click", () => {
        document.getElementById('uploadFileName').click()
    });
    document.getElementById('uploadFileName').addEventListener("change",
        () => {
            if (document.getElementById('uploadFileName').files.length > 0) {
                document.getElementById('uploadSubmit').click();
            }
        });
</script>