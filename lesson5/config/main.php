<?php
define("BASE_URL", 
       ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http') . '://' . $_SERVER['SERVER_NAME']);
define("DOCUMENT_ROOT", __DIR__ . "/../");
define("ENGINE_DIR", DOCUMENT_ROOT . "engine/");
define("VIEWS_DIR", DOCUMENT_ROOT . "views/");
define("UPLOADS_DIR", DOCUMENT_ROOT . "uploads/");
define("PICTURES_BIG", "img/gallery_big/");
define("PICTURES_SMALL", "img/gallery_small/");

define("PAGE_CAPTION", 'GeekBrains PHP basics. lesson 5');