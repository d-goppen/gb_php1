<?php
$title = 'GeekBrains PHP basics. lesson 2';
$header = 'Задача ';
$taskNum = 1;
echo "
<!DOCTYPE html>
<html lang=\"ru\">
<head>
    <meta charset=\"UTF-8\">
    <title>{$title}</title>
</head>
<body>";
// Задача 1
echo "<h2>{$header}" . $taskNum++ . "</h2>";
$a = mt_rand(-10000, 10000);
$b = mt_rand(-10000, 10000);
echo "<p>\$a = {$a}; \$b = {$b}</p><p>Результат: ";
if (($a > 0) && ($b > 0)) {
    echo "\$a - \$b = " . ($a - $b) . "</p>";
} elseif (($a < 0) && ($b < 0)) {
    echo "\$a * \$b = " . ($a * $b) . "</p>";
} else {
    echo "\$a + \$b = " . ($a + $b) . "</p>";
};

// Задача 2
echo "<h2>{$header}" . $taskNum++ . "</h2>";
$a = mt_rand(0, 15);
echo "<p>\$a = {$a}</p><p>Результат: ";
switch ($a) {
    case  0: echo  '0, ';
    case  1: echo  '1, ';
    case  2: echo  '2, ';
    case  3: echo  '3, ';
    case  4: echo  '4, ';
    case  5: echo  '5, ';
    case  6: echo  '6, ';
    case  7: echo  '7, ';
    case  8: echo  '8, ';
    case  9: echo  '9, ';
    case 10: echo '10, ';
    case 11: echo '11, ';
    case 12: echo '12, ';
    case 13: echo '13, ';
    case 14: echo '14, ';
    case 15: echo '15<p>';
};

// Задача 3
// Проверка типов аргументов не проводилась сознательно.
// Имена переменных в таких коротких функциях не обязаны быть "говорящими".
echo "<h2>{$header}" . $taskNum++ . "</h2>";
echo '<div style="display: flex; font-family: monospace;">';
echo '<div style="padding: .5em;">function <b>sum</b>($op1, $op2)<br>{<br>&nbsp;&nbsp;return $op1 + $op2;<br>};</div>';
echo '<div style="padding: .5em; border-left: solid grey 1pt;">function <b>sub</b>($op1, $op2)<br>{<br>&nbsp;&nbsp;return $op1 - $op2;<br>};</div>';
echo '<div style="padding: .5em; border-left: solid grey 1pt;">function <b>mul</b>($op1, $op2)<br>{<br>&nbsp;&nbsp;return $op1 * $op2;<br>};</div>';
echo '<div style="padding: .5em; border-left: solid grey 1pt;">function <b>div</b>($op1, $op2)<br>{<br>&nbsp;&nbsp;return $op1 / $op2;<br>};</div>';
echo '</div>';
function sum($op1, $op2) { return $op1 + $op2; };
function sub($op1, $op2) { return $op1 - $op2; };
function mul($op1, $op2) { return $op1 * $op2; };
function div($op1, $op2) { return $op1 / $op2; };

// Задача 4
echo "<h2>{$header}" . $taskNum++ . "</h2>";
// Возвращает результат выполнения над $arg1 и $arg2 функции, указанной в $operation.
// Если $operation не содержит корректного названия, возвращаем сумму аргументов.
echo '<div style="display: flex; font-family: monospace;">';
echo '<div style="padding: .5em;">
      function <b>mathOperation</b>($arg1, $arg2, $operation)<br>{<br>
      &nbsp;&nbsp;switch ($operation) {<br>
      &nbsp;&nbsp;&nbsp;&nbsp;case \'sub\': return sub($arg1, $arg2);<br>
      &nbsp;&nbsp;&nbsp;&nbsp;case \'mul\': return mul($arg1, $arg2);<br>
      &nbsp;&nbsp;&nbsp;&nbsp;case \'div\': return div($arg1, $arg2);<br>
      &nbsp;&nbsp;&nbsp;&nbsp;default: return sum($arg1, $arg2);<br>
      &nbsp;&nbsp;};<br>}</div></div>';
function mathOperation($arg1, $arg2, $operation) {
  switch ($operation) {
    case 'sub': return sub($arg1, $arg2);
    case 'mul': return mul($arg1, $arg2);
    case 'div': return div($arg1, $arg2);
    default: return sum($arg1, $arg2);
  };
};

// Задача 5
echo "<h2>{$header}" . $taskNum++ . "</h2>";
echo '<p>Результат работы функции <b>localtime()</b> см в подвале страницы.</p>';
$theFooter = '<footer style="padding: .3em; border-top: solid black 2pt;">' . (localtime()[5] + 1900) . ' год</footer>';

// Задача 6
echo "<h2>{$header}" . $taskNum++ . "</h2>";
$a = mt_rand(2, 20); // Диапазон ограничен специально
$b = mt_rand(2, 10); // Диапазон ограничен специально
echo "<p>\$a = {$a}; \$b = {$b}</p><p>Результат: {$a}<sup>{$b}</sup> = " . power($a, $b) . "</p>";
echo '<div style="display: flex; font-family: monospace;">';
echo '<div style="padding: .5em;">
      function <b>power</b>($arg, $index)<br>{<br>&nbsp;&nbsp;if ($index === 1) {<br>
      &nbsp;&nbsp;&nbsp;&nbsp;return $arg;<br>&nbsp;&nbsp;} else {<br>
      &nbsp;&nbsp;&nbsp;&nbsp;return $arg * power($arg, --$index);<br>&nbsp;&nbsp;};<br>}</div></div>';
function power($arg, $index) {
  if ($index === 1) {
    return $arg;
  } else {
    return $arg * power($arg, --$index);
  };
};
  
// Задача 7
echo "<h2>{$header}" . $taskNum++ . "</h2>";
echo '<p>Текущее время: ' . sayCurrentTime() . '</p>';
echo '<div style="display: flex; font-family: monospace;">';
echo '<div style="padding: .5em;">
      function <b>sayCurrentTime</b>()<br>{<br>&nbsp;&nbsp;$timeString = \'\';<br>
      &nbsp;&nbsp;$t = localtime();<br><br>&nbsp;&nbsp;if ($t[2] < 10) { $timeString .= \'0\'; };<br>
      &nbsp;&nbsp;$timeString .= $t[2];<br>&nbsp;&nbsp;if (($t[2] > 4) && ($t[2] < 21)) {<br>
      &nbsp;&nbsp;&nbsp;&nbsp;$timeString .= \' часов \';<br>
      &nbsp;&nbsp;} elseif (($t[2] % 10) === 1) {<br>
      &nbsp;&nbsp;&nbsp;&nbsp;$timeString .= \' час \';<br>&nbsp;&nbsp;} else {<br>
      &nbsp;&nbsp;&nbsp;&nbsp;$timeString .= \' часа \';<br>&nbsp;&nbsp;};<br><br>
      &nbsp;&nbsp;if ($t[1] < 10) { $timeString .= \'0\'; };<br>
      &nbsp;&nbsp;$timeString .= $t[1];<br>
      &nbsp;&nbsp;if (($t[1] % 10 === 0) ||<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(($t[1] % 10 >= 5) && ($t[1] % 10 <= 9)) ||<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(($t[1] >10) && ($t[1] <= 20))) {<br>
      &nbsp;&nbsp;&nbsp;&nbsp;$timeString .= \' минут\';<br>
      &nbsp;&nbsp;} elseif (($t[1] % 10) === 1) {<br>
      &nbsp;&nbsp;&nbsp;&nbsp;$timeString .= \' минута\';<br>&nbsp;&nbsp;} else {<br>
      &nbsp;&nbsp;&nbsp;&nbsp;$timeString .= \' минуты\';<br>&nbsp;&nbsp;};<br><br>
      &nbsp;&nbsp;return $timeString;<br>};</div></div>';
  
function sayCurrentTime() {
  $timeString = '';
  $t = localtime();
  if ($t[2] < 10) { $timeString .= '0'; };
  $timeString .= $t[2];
  if (($t[2] > 4) && ($t[2] < 21)) {
    $timeString .= ' часов ';
  } elseif (($t[2] % 10) === 1) {
    $timeString .= ' час ';
  } else {
    $timeString .= ' часа ';
  };
  if ($t[1] < 10) { $timeString .= '0'; };
  $timeString .= $t[1];
  if (($t[1] % 10 === 0) ||
      (($t[1] % 10 >= 5) && ($t[1] % 10 <= 9)) ||
      (($t[1] >10) && ($t[1] <= 20))) {
    $timeString .= ' минут';
  } elseif (($t[1] % 10) === 1) {
    $timeString .= ' минута';
  } else {
    $timeString .= ' минуты';
  };
  return $timeString;
};
echo "{$theFooter}
</body>
</html>";
?>