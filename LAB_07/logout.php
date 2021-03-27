<?php
if(isset($_POST['logout'])){
    session_name("Edvin");
    session_start();
    session_unset();
    session_destroy();
    unset($_COOKIE['Edvin']); 
    setcookie('Edvin', null, -1, '/'); 
    echo "Logged out!<br>";
    echo "<a href= './index.php'>Back to log in form</a>";
}
?>