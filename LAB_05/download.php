<?php
echo "<a href='lab5.php'>Form</a>\t<a href='download.php'>Download</a><br>";
$file = file_get_contents("data.csv");
$lines = substr_count($file, PHP_EOL);
echo "Number of Registrations: " . $lines . "<br>";
echo "You can download the list here <a href='data.csv'> Bookings </a>";
?>