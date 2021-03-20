<?php
class Course {
    public $code;
    public $name;
    public $ects;
    public $term;
}
class CourseActions{
    function filter($id){ // add decending order as well
        if (strlen($id) > 3){
            exit("ID TOO LONG");
        } else{
            $id = strtoupper($id);
            $filcourses = array();
            $courses = generateCourses();
            foreach($courses as $course){
                if (substr($course->code, 0, 3) == $id){
                    array_push($filcourses, $course);
                }
            }
            return $filcourses;
        }
    }
}
function generateCourses(){
    $courses = array();
    $csvline = explode(PHP_EOL, file_get_contents("data/courses.csv")); 
    foreach ($csvline as $line) {
        $course = new Course;
        $parameters = explode(";", $line);
        $course->code = $parameters[0];
        $course->name = $parameters[1];
        $course->ects = $parameters[2];
        $course->term = $parameters[3];
        array_push($courses, $course);
    }
    return $courses;
}
function getCourseTable(){
    if (isset($_GET["query"])){
        $action = new CourseActions;
        $filtered = $action -> filter($_GET["query"]);
        return $filtered;
    } else{
        $array = generateCourses();
        return $array;
    }
}
require_once('lib/tpl.class.php');
const TEMPLATE_PATH = "templates";
$t = new Template(TEMPLATE_PATH."/index_tpl.php");
$tableHead = ["Code", "Name", "Points", "Semester"];
$t -> assign("title", "Courses");
$t -> assignTable("table", getCourseTable(), $tableHead);
echo $t -> render();
?>