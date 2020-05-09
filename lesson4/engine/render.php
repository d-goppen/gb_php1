<?php
function renderThumb(string $picturePath): string
{
    $result = "<div class=\"pictureThumbContainer\">";
    $result .= "<img class=\"pictureThumb\" src=\"$picturePath\" alt=\"Picture not found\">";
    $result .= "</div>";
    return $result;
}

function renderButtonThumb(string $picturePath, string $caption = 'Button'): string
{
    $result = "<div class=\"pictureThumbButton\" style=\"display: flex; flex-direction: column; align-items: center;\">";
    $result .= "<img id=\"picture\" class=\"pictureThumb\" style=\"width: 40%; height: 40%;\" src=\"{$picturePath}\" alt=\"{$caption}\">";
    $result .= "<div style=\"text-align: center; overflow: hidden; user-select: none;\">{$caption}</div>";
    $result .= "</div>";
    return $result;
}

function renderModalWindow():string
{
    $result = '<div id="pictureModal" class="modal-picture">
                   <img class="fullPicture" src="" alt="Picture not found">
               </div>';
    return $result;
}