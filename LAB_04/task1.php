<?php
function getKey($testKey, &$arr){
	$counter = 0;
	for($i = 0; $i<sizeof($arr); $i++){
		if ($arr[$i] === $testKey){
			$counter++;
			if ($counter > 1){
				$arr[$i] .= chr(63 + $counter);
			}
		}
	}
	return $testKey;
}
error_reporting(E_ALL);
const KM_TO_MILES = 1.60934;
$numOfDistances = rand (5, 20);
$arrDistances = array();
for ($i = 0; $i<$numOfDistances; $i++){
    array_push($arrDistances, rand(1, 100));
}
print_r($arrDistances);
sort($arrDistances);
print_r($arrDistances);
foreach($arrDistances as $value){
    getKey($value, $arrDistances);
}
print_r($arrDistances);
$arrMiles = array();
for ($i = 0; $i < sizeof($arrDistances); $i++){
    $arrMiles[getKey($arrDistances[$i], $arrDistances)] = $arrDistances[$i] / KM_TO_MILES;
}
print_r($arrMiles);
printf("KM\tMILES\n\r");
foreach ($arrMiles as $index => $value) {
    printf("%d\t%0.3f\n\r", $index, $value);
}
?>
