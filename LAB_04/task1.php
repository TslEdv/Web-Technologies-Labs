<?php
error_reporting(E_ALL);
const KM_TO_MILES = 1.60934;
$numOfDistances = rand (5, 20);
$arrDistances = array();
for ($i = 0; $i<$numOfDistances; $i++){
    array_push($arrDistances, rand(1, 100));
}
echo print_r($arrDistances, true);
sort($arrDistances);
echo print_r($arrDistances, true);
$arrMiles = array();
for ($i = 0; $i < sizeof($arrDistances); $i++){
    if($arrDistances[$i-1] == $arrDistances[$i]){
        $result = $arrDistances[$i] * KM_TO_MILES;
        array_push($arrMiles[$arrDistances[$i+100]], $arrDistances[$i]);
        $arrMiles[$arrDistances[$i+100]] = $result;
    }
    else{
    array_push($arrMiles[$arrDistances[$i]], $arrDistances[$i]);
    $result = $arrDistances[$i] * KM_TO_MILES;
    $arrMiles[$arrDistances[$i]] = $result;
    }
}
echo print_r($arrMiles, true);
$counter = 0;
foreach ($arrMiles as $index => $value) {
    $result = $value/KM_TO_MILES;
    if ($counter==0){
        printf("KM\tMILES\n");
        printf("%d\t%0.3f\n", $result, $value);
        $counter++;
    }
    else{
        printf("%d\t%0.3f\n", $result, $value);
    }
}
?>
