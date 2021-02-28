<?php
function phonicsCount($text, $vowels){
    $textarr = str_split($text);
    $newarray = array();
    foreach($vowels as $key){
        $newarray[$key] = 0;
    }
    foreach($textarr as $char){
        foreach($vowels as $vowel){
            if($vowel == $char){
                $newarray[$vowel]++;
            }
        }
    }
    return $newarray;
}
function charCount($text){
    $textarr = str_split($text);
    $counter = 0;
    foreach($textarr as $char){
        if(!ctype_space($char) && !ctype_cntrl($char)){
            $counter++;
        }
    }
    return $counter;
}
function lineCount($text){
    if (!empty($text)){
        $count = substr_count($text, "\n");
        $count++; 
        return $count;
    }
    else{
        return 0;
    }
}
include "incl/phonics.php";
$text = file_get_contents("data/text.txt");
$text = strtoupper($text);
$vowelcount = phonicsCount($text, $vowels);
$charcount = charCount($text);
$linecount = lineCount($text);
print_r($vowelcount);
printf("%d\n", $charcount);
printf("%d\n", $linecount);
?>