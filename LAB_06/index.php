<?php
class Course {
    public $code;
    public $name;
    public $ects;
    public $term;
}
class CourseActions{
    function filter($id){
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
            for ($i = 0; $i < count($filcourses); $i++){
                usort($filcourses, fn($a, $b) => intval($b->ects) <=> intval($a->ects));
            }
            return $filcourses;
        }
    }
    function filterbysemester($semester, $list){
        $semester = strtolower($semester);
        if(!in_array($semester, array("0", "1", "2"))){
            exit("Semester does not exist! Recheck your input: 0 = autumn || 1 = spring || 2 = autumn-spring");
        } else{
            $filcourses = array();
            if ($semester == "0"){
                foreach($list as $course){
                    if ($course->term == "autumn "){
                            array_push($filcourses, $course);
                    }
                }
                for ($i = 0; $i < count($filcourses); $i++){
                    usort($filcourses, fn($a, $b) => intval($b->ects) <=> intval($a->ects));
                }
            } else if ($semester == "1"){
                foreach($list as $course){
                    if ($course->term == "spring "){
                            array_push($filcourses, $course);
                    }
                }
                for ($i = 0; $i < count($filcourses); $i++){
                    usort($filcourses, fn($a, $b) => intval($b->ects) <=> intval($a->ects));
                }
            } else{
                foreach($list as $course){
                    if ($course->term == "autumn - spring "){
                            array_push($filcourses, $course);
                    }
                }
                for ($i = 0; $i < count($filcourses); $i++){
                    usort($filcourses, fn($a, $b) => intval($b->ects) <=> intval($a->ects));
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
        if (isset($_GET["semester"])){
            $filtered = $action -> filterbysemester($_GET["semester"], $filtered);
        }
        return $filtered;
    } else if ((!isset($_GET["query"])) && (isset($_GET["semester"]))){
        $array = generateCourses();
        $action = new CourseActions;
        $filtered = $action -> filterbysemester($_GET["semester"], $array);
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