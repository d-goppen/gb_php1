<?php
$title = 'GeekBrains PHP basics. lesson 1';
$header1 = 'Here is the first page';
$phrase1 = 'Page was generated usig PHP ';
$phrase2 = 'first time at all.';
echo "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>{$title}</title>
</head>
<body>
<h1>{$header1}</h1>
<br>
<br>
<br>
<br>
<br>
<br>
<p>{$phrase1} {$phrase2}</p>
</body>
</html>";
?>