<?php
include "incl/phonics.php";
$text = 'data/text.txt';
$handle = fopen($text, "r");
function phonicsCount(){
    $restOfContents = fread($handle, filesize($text));


    $phonicsarray = array(
        "A" => ""
        "E" => ""
        "I" => ""
        "O" => ""
        "U" => ""
    )
}
?>