<?php
    session_name("Edvin");
    session_start();
    session_unset();
    session_destroy();
    echo "Logged out!<br>";
    echo "<a href= './form.php'>Back to log in form</a>"
?>