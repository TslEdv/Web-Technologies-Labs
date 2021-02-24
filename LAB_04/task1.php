<?php
error_reporting(E_ALL);
const KM_TO_MILES = 1.60934;
$numOfDistances = rand (5, 20);
$arrDistances = array();
for ($i = 0; $i<$numOfDistances; $i++){
    array_push($arrDistances, rand(1, 100));
}
echo "<pre>".print_r($arrDistances, true)."</pre>";
sort($arrDistances);
echo "<pre>".print_r($arrDistances, true)."</pre>";
$arrMiles = array();
for ($i = 0; $i < sizeof($arrDistances); $i++){
    array_push($arrMiles[$arrDistances[$i]], $arrDistances);
    $result = $arrDistances[$i] * KM_TO_MILES;
    $arrMiles[$arrDistances[$i]] = $result;
}
echo "<pre>".print_r($arrMiles, true)."</pre>";