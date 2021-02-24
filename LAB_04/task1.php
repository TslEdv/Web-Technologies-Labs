<?php
error_reporting(E_ALL);
const KM_TO_MILES = 1.60934;
$numOfDistances = rand (5, 20);
$arrDistances = array();
for ($i = 0; $i<$numOfDistances; $i++){
    array_push($arrDistances, rand(1, 100));
}
print_r($arrDistances);
?>