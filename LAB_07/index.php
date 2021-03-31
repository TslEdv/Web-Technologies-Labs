<?php
$shortcounter= $_COOKIE['ShortTimeCount'] + 1;
$longcounter = $_COOKIE['LongTimeCount'] + 1;
$cookieContent = "Edvin";
if (!isset($_COOKIE["ctransient"])){
    echo "There is no cookie named ctransient <br>";
    setcookie("ctransient", $cookieContent, '/~edvess/');
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
setcookie("ShortTimeCount", $shortcounter, time()+120, '/~edvess/');
echo "LongTimeCount = ", $longcounter;
setcookie("LongTimeCount", $longcounter, time()+3600, '/~edvess/');
?>
<!DOCTYPE html>

<head>
</head>

<body>
    <?php
    if(isset($_COOKIE["Edvin"])){
        session_name("Edvin");
        session_start();
        echo "<br>Session ID = ", $_SESSION['id'], "<br>";
        echo "Welcome ", $_SESSION['name'], "! <br>";
        echo "Your age: ", $_SESSION['age'], "<br>";
        echo "Your location: ", $_SESSION['location'], "<br>";
        if (session_status() == PHP_SESSION_ACTIVE) {
            if (isset($_SESSION['counter'])) {
                $_SESSION['counter'] += 1;
            } else {
                $_SESSION['counter'] = 1;
            }
        }
        echo "Site refreshed = ", $_SESSION['counter'];
        echo "<form action='logout.php' method='POST' id='data'>";
        echo "<input type='submit' value='Log out' name='logout'>";
        echo "</form>";
        echo "<p>Reset Button: <a href='./exists.php'>check</a></p>";
    } else{
        echo "<form action='login.php' method='POST' id='formdata'>";
        echo "<label for='fname'>First Name:</label>";
        echo "<input type='text' id='fname' name='fname' placeholder='First Name' pattern='[A-Za-z-.]+' required><br>";
        echo "<input type='submit' value='Log In' name='login'>";
        echo "<p>Reset Button: <a href='./exists.php'>check</a></p>";
        echo "</form>";
    }
    ?>
</body>

</html>