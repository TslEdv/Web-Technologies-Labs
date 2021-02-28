<?php
function getKey($testKey, &$arr){
	$keyCount = 0;
	for($i = 0; $i<sizeof($arr); $i++){
		if ($arr[$i] === $testKey){
			$keyCount++;
			if ($keyCount > 1){
				$arr[$i] .= chr(63 + $keyCount);
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
$arrMiles = array();
for ($i = 0; $i < sizeof($arrDistances); $i++){
    $arrMiles[getKey($arrDistances[$i], $arrDistances)] = intval($arrDistances[$i], 10) / KM_TO_MILES;
}
print_r($arrMiles);
printf("%10s%10s\n\r", "KM", "MILES");
foreach ($arrMiles as $index => $value) {
    printf("%10d%10.3f\n\r", $index, $value);
}
?>
