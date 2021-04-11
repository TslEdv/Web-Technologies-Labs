<?php
function sanitizeInputVar($link, $var)
{
    $var = stripslashes($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    $var = mysqli_real_escape_string($link, $var);
    return $var;
}
function listCourses($link, $semester, $search, $column, $order, $reset)
{
    $semester = intval(sanitizeInputVar($link, $semester));
    $search = sanitizeInputVar($link, $search);
    $column = sanitizeInputVar($link, $column);
    $order = sanitizeInputVar($link, $order);
    if (!empty($reset)){
        setcookie("search", null, -1);
        $query = "SELECT C.course_code, C.course_name, C.ects_credits, S.semester_name 
        FROM courses_201739 C LEFT JOIN semesters_201739 S ON C.Semesters_ID=S.ID ORDER BY course_code ASC";
    }
    else if (!empty($search)) {
        setcookie("search", $search, '/~edvess/');
        $query = "SELECT C.course_code, C.course_name, C.ects_credits, S.semester_name 
        FROM courses_201739 C LEFT JOIN semesters_201739 S ON C.Semesters_ID=S.ID
        WHERE (C.course_code LIKE '%" . $search . "%' OR C.course_name LIKE '%" . $search . "%')";
    }
    else if (!empty($semester)) {
        if (isset($_COOKIE['search'])) {
            $search = $_COOKIE['search'];
            $query = "SELECT C.course_code, C.course_name, C.ects_credits, S.semester_name
            FROM courses_201739 C LEFT JOIN semesters_201739 S ON C.Semesters_ID=S.ID 
            WHERE C.Semesters_ID='$semester' 
            AND (C.course_code LIKE '%" . $search . "%' OR C.course_name LIKE '%" . $search . "%')";
        } else {
            $query = "SELECT C.course_code, C.course_name, C.ects_credits, S.semester_name 
            FROM courses_201739 C LEFT JOIN semesters_201739 S ON C.Semesters_ID=S.ID 
            WHERE C.Semesters_ID='$semester'";
        }
    } else {
            if (!empty($column)) {
                $query = "SELECT C.course_code, C.course_name, C.ects_credits, S.semester_name 
                FROM courses_201739 C LEFT JOIN semesters_201739 S ON C.Semesters_ID=S.ID ORDER BY " . $column . " " . $order;
            } else {
                $query = "SELECT C.course_code, C.course_name, C.ects_credits, S.semester_name 
                FROM courses_201739 C LEFT JOIN semesters_201739 S ON C.Semesters_ID=S.ID ORDER BY course_code ASC";
            }
    }
    $query = $link->prepare($query);
    $query->execute();
    $query->bind_result($course_code, $course_name, $ects_credits, $semester_name);
    echo "<table>";
    echo "<tr>
    <th><a href=index.php?column=course_code&order=ASC>Course Code</a></th>
    <th><a href=index.php?column=course_name&order=ASC>Course Name</a></th>
    <th><a href=index.php?column=ects_credits&order=ASC>Credits</a></th>
    <th><a href=index.php?column=semester_name&order=ASC>Semester</a></th>
    </tr>";
    while ($query->fetch()) {
        printf("<tr>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        </tr>", $course_code, $course_name, $ects_credits, $semester_name);
    }
    echo "</table>";
    $query->close();
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
    ?>
    <form action="index.php" method="POST">
        <label for="searchfield">Search by code or name</label>
        <input type="search" id="searchfield" name="searchfield">
        <input type="submit" value="Search">
        <input type="submit" value="Reset" name="Reset">
    </form>
    <?php
    listCourses($link, $_GET['semester'], $_POST['searchfield'], $_GET['column'], $_GET['order'], $_POST['Reset']);
    ?>
</body>