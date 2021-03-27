<?php
$shortcounter= $_COOKIE['ShortTimeCount'] + 1;
$longcounter = $_COOKIE['LongTimeCount'] + 1;
$cookieContent = "Edvin";
if (!isset($_COOKIE["ctransient"])){
    echo "There is no cookie named ctransient <br>";
    setcookie("ctransient", $cookieContent);
} else{
    echo "Cookie 'ctransient' = ", $cookieContent, "<br>";
}
if (!isset($_COOKIE["ShortTimeCount"])){
    $_COOKIE['ShortTimeCount'] = 0;
}
if (!isset($_COOKIE["LongTimeCount"])){
    $_COOKIE['ShortTimeCount'] = 0;
}
echo "ShortTimeCount = ", $shortcounter, "<br>";
setcookie("ShortTimeCount", $shortcounter, time()+120);
echo "LongTimeCount = ", $longcounter;
setcookie("LongTimeCount", $longcounter, time()+3600);
?>
