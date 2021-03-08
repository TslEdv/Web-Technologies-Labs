
<html>
<head>
</head>
<body>
<link rel="stylesheet" href="style.css">
    <header>
            <nav>
                <a href="lab5.php">Form</a>
                <a href="download.php">Download</a>
            </nav>
    </header>
<form action="lab5.php" method="POST" id="formdata">
    <label for="fname">First name:</label>
    <input type="text" id="fname" name="fname" placeholder="First Name" pattern="[A-Za-z-.]+" required><br>
    <label for="mname">Middle name:</label>
    <input type="text" id="mname" name="mname" placeholder="Middle Name" pattern="[A-Za-z-.]+"><br>
    <label for="lname">Last name:</label>
    <input type="text" id="lname" name="lname" placeholder="Last Name" pattern="[A-Za-z-.]+" required><br>
    <label for="salutation">Select your Salutation:</label>
    <select name="salutation" id="salutation">
        <option value="">--Please choose a salutation--</option>
        <option value="mr">Mr</option>
        <option value="ms">Ms</option>
        <option value="mrs">Mrs</option>
        <option value="sir">Sir</option>
        <option value="prof">Prof</option>
        <option value="dr">Dr</option>
    </select><br>
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" min=18 pattern="[0-9]+" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required><br>
    <label for="phone">Enter a phone number:</label>
    <input type="tel" id="phone" name="phone" placeholder="Phone number"><br>
    <label for="arrival">Arrival date:</label>
    <input type="date" id="arrival" name="arrival" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" max="2021-06-06" required><br>
    <input type="submit" value="Submit" name="submit">
</form>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    foreach($_REQUEST as $var){
        if(strpos($var, ",") !== false){
            exit("Invalid input!");
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['age']) && isset($_POST['email']) && isset($_POST['arrival'])){
            $email_pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
            $date_pattern = '/^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24\:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?$/';
            if (!preg_match("/^[a-zA-z-.]*$/", $_POST['fname']) || !preg_match("/^[a-zA-z-.]*$/", $_POST['lname']) || !preg_match ($email_pattern, $_POST['email']) || !preg_match($date_pattern, $_POST['arrival'])){
                echo "Wrong input!";
            }
            else if ($_POST['age'] < 18){
                echo "Incorrect age";
            }
            else if ($_POST['arrival'] < date("Y-m-d")){
               echo "Error in date";
            }
            else{
                $file = 'data.csv';
                $text = $_POST['salutation'] . "," . $_POST['fname'] . "," . $_POST['mname'] .  "," . $_POST['lname'] . "," . $_POST['age']. "," . $_POST['email'] . "," . $_POST['phone']. "," . $_POST["arrival"]. PHP_EOL;
                file_put_contents("data.csv", $text, FILE_APPEND);
                echo "Registery Successful!";
            }
    }
    }
}
?>