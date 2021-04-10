<?php
function sanitizeInputVar($link, $var)
{
    $var = stripslashes($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    $var = mysqli_real_escape_string($link, $var);
    return $var;
}
function listCourses($link, $semester)
{
    $semester = intval(sanitizeInputVar($link,$semester));
    if(!empty($semester)){
        $query = "SELECT C.course_code, C.course_name, C.ects_credits, S.semester_name FROM courses_201739 C LEFT JOIN semesters_201739 S ON C.Semesters_ID=S.ID WHERE C.Semesters_ID='$semester'";
        $query = $link->prepare($query);
        $query->execute();
        $query->bind_result($course_code, $course_name, $ects_credits, $semester_name);
        echo "<table>";
        echo"<tr><th>Course Code</th><th>Course Name</th><th>Credits</th><th>Semester</th></tr>";
        while ($query->fetch()) {
            printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $course_code, $course_name, $ects_credits, $semester_name);
        }
        echo "</table>";
        $query->close();
    } else{
        $query = "SELECT course_code, course_name, ects_credits FROM courses_201739";
        $query = $link->prepare($query);
        $query->execute();
        $query->bind_result($course_code, $course_name, $ects_credits);
        echo "<table>";
        echo"<tr><th>Course Code</th><th>Course Name</th><th>Credits</th></tr>";
        while ($query->fetch()) {
            printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $course_code, $course_name, $ects_credits);
        }
        echo "</table>";
        $query->close();
    }
}
function semesters($link)
{
    $query = "SELECT * FROM semesters_201739";
    $query = $link->prepare($query);
    $query->bind_param("i", $_GET["semester"]);
    $query->execute();
    $query->bind_result($semesterID, $semester_name);
    echo "<ul>";
    while ($query->fetch()) {
        echo "<li><a href='index.php?semester=", $semesterID, "'>" . $semester_name . "</a></li>";
    }
    echo "</ul>";
    $query->close();
}
?>
<!DOCTYPE html>

<head>
</head>

<body>
    <?php
    include_once "connect.db.php";
    $link = new mysqli($server, $user, $password, $database);
    semesters($link);
    listCourses($link, $_GET['semester']);
    ?>
</body>