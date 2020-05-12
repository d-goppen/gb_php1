<?php
//error_reporting(0);
require_once('../config/main.php'); // Константы основных настроек
require_once('../config/sql.php'); // Константы для подключения к MySQL
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php PAGE_CAPTION ?></title>
    <link rel="shortcut icon" href="img/common/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header><a class="headerMain" href="<?php echo BASE_URL ?>">The strange gallery</a>
        <div class="pictureInfo"></div>
    </header>
    <?php
    // Conneting to MySQL
    $link = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS);

    if (!$link) {
        $sql_err['message'] = 'Ошибка при подключении к серверу MySQL';
        $sql_err['code'] = mysqli_connect_errno();
        $sql_err['error'] = mysqli_connect_error();
        require(VIEWS_DIR . 'sql_error.php');
        exit;
    }

    // Create, if not present, our database and neccesary table
    if (!(mysqli_query($link, 'CREATE DATABASE IF NOT EXISTS `gb_php1` CHARACTER SET utf8 COLLATE utf8_unicode_ci;') &&
        mysqli_query($link, 'USE `gb_php1`') &&
        mysqli_query($link, 'CREATE TABLE IF NOT EXISTS `gallery` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT, ' .
            '`name_big` varchar(255) NOT NULL, `name_small` varchar(255) NOT NULL, ' .
            '`full_width` int(10) unsigned NOT NULL, `full_height` int(10) unsigned NOT NULL, ' .
            '`view_count` int(10) unsigned NOT NULL DEFAULT 0, ' .
            '`last_view` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, ' .
            'PRIMARY KEY (`id`), KEY `name_big_key` (`name_big`), KEY `name_small_key` (`name_small`), ' .
            'KEY `view_count_key` (`view_count`), key `last_view_key` (`last_view`))'))) {
        $sql_err['message'] = 'Ошибка при создании структуры базы данных';
        $sql_err['code'] = mysqli_errno($link);
        $sql_err['error'] = mysqli_error($link);
        require(VIEWS_DIR . 'sql_error.php');
        exit;
    }

    // Loading picture, if got POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['picture'])) {
            if (!file_exists(UPLOADS_DIR)) {
                mkdir(UPLOADS_DIR);
            }

            echo "<script>document.querySelector('.pictureInfo').innerText = {$_FILES['picture']['name']}</script>";

            $fileName = $_FILES['picture']['name'];
            $fileNameShort = 's_' . $fileName;
            move_uploaded_file($_FILES['picture']['tmp_name'], UPLOADS_DIR . $fileName);            

            $image = new Imagick(UPLOADS_DIR . $fileName);
            $fullWidth = $image->getImageWidth();
            $fullHeight = $image->getImageHeight();
            // При уменьшении картинки в некоторых случаях возможен поворот вертикального изображения
            // на 90 градусов. Исправление этой ситуации требует более глубокого анализа EXIF изображения.
            // Причина скорее всего в том, что некоторые камеры вместо записи изображения в нужной ориентации
            // просто пишут его горизонтальным и добавляют информацию о положении камеры при съёмке.
            if ($fullWidth > $fullHeight) {
                $image->thumbnailimage(100, 0);
            } else {
                $image->thumbnailimage(0, 100);
            };
            $image->writeImage(UPLOADS_DIR . $fileNameShort);
            rename(UPLOADS_DIR . $fileName, PICTURES_BIG . $fileName);
            rename(UPLOADS_DIR . $fileNameShort, PICTURES_SMALL . $fileNameShort);

            $sql_res = mysqli_query($link, "INSERT INTO `gallery` (`name_big`, `name_small`, `full_width`, `full_height`) " .
                                           " VALUES ('{$fileName}', '{$fileNameShort}', {$fullWidth}, {$fullHeight})");
        }
    };

    if (($_SERVER['REQUEST_METHOD'] == 'GET') && (isset($_GET['id'])) && !empty($_GET['id'])) {
        // Got id of image to show
        $sql_res = mysqli_query($link, "SELECT * FROM `gallery` WHERE `id` = '{$_GET['id']}'");
        if ($sql_res && (mysqli_num_rows($sql_res) === 1)) {
            require(VIEWS_DIR . 'show_image.php');
        } else {
            $sql_err['message'] = 'Ошибка получения информации об изображении ' . $_GET['id'];
            $sql_err['code'] = mysqli_errno($link);
            $sql_err['error'] = mysqli_error($link);
            require(VIEWS_DIR . 'sql_error.php');
            exit;
        };
    } else {
        // No image id. Show all gallery sorted by views and filename.
        // Upload form is part of image gallery
        // Draw images
        $sql_res = mysqli_query($link, "SELECT * FROM `gallery` ORDER BY `view_count` desc, `last_view` desc");
        if ($sql_res) {
            require(VIEWS_DIR . 'gallery.php');
        } else {
            $sql_err['message'] = 'Ошибка получения списка изображений';
            $sql_err['code'] = mysqli_errno($link);
            $sql_err['error'] = mysqli_error($link);
            require(VIEWS_DIR . 'sql_error.php');
            exit;
        };
    };

    mysqli_close($link);
    ?>
</body>

</html>