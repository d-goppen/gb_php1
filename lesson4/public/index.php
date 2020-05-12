<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeekBrains PHP basics. lesson 4</title>
    <link rel="shortcut icon" href="img/common/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<?php
//error_reporting(E_ALL);
require_once __DIR__ . '/../config/main.php';
require_once ENGINE_DIR . 'render.php';
require_once ENGINE_DIR . 'funcImgResize.php';

// Loading picture, if got POST request
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_FILES['picture'])) {
        if(!file_exists(UPLOADS_DIR)) {
            mkdir(UPLOADS_DIR);
        }

        // Считаем что загружены могут быть только файлы jpg, png и gif
        $fileName = $_FILES['picture']['name'];       
        $fileExt = mb_substr($fileName, -3, 3);
        $fileName = mb_substr($fileName, 0, strlen($fileName) - 4);
        if (strtolower($fileExt) === 'jpg' || strtolower($fileExt) === 'png' || strtolower($fileExt) === 'gif') {
            move_uploaded_file($_FILES['picture']['tmp_name'], UPLOADS_DIR . $fileName . '_b.' . $fileExt);
            img_resize(UPLOADS_DIR . $fileName . '_b.' . $fileExt,
                       UPLOADS_DIR . $fileName . '_s.' . $fileExt,
                       100, 100, 0x2F4F4F, 80
                       );
            rename(UPLOADS_DIR . $fileName . '_b.' . $fileExt, 
                   PICTURES . $fileName . '_b.' . $fileExt);
            rename(UPLOADS_DIR . $fileName . '_s.' . $fileExt, 
                   PICTURES . $fileName . '_s.' . $fileExt);
        };
    }
}

// Put container for load form
print '<div class="mainPane">';
// Draw load form
$form_title = "Загрузка файлов";
include VIEWS_DIR . "upload_form.php";
print '</div>';

// Generate pictures gallery
echo '<div class="galleryPane">';
$gallery = scandir(PICTURES);
//echo renderButtonThumb('img/common/clip.svg', 'Загрузить картинку...');
foreach ($gallery as $picture) {
    if ((mb_substr($picture, 0, 1) !== '.') &&
        (mb_substr($picture, -6, 2) !== '_b')) {
        echo renderThumb(PICTURES . $picture);
        };
}
echo '</div>';
echo renderModalWindow();
?>
<script src="js/main.js"></script>
</body>
</html>