<?php
require_once('lib/tpl.class.php');
require_once('functions.php');
const TEMPLATE_PATH = "templates";
$t = new Template(TEMPLATE_PATH."/index_tpl.php");
$tableHead = ["Code", "Name", "Points", "Semester"];
$t -> assign("title", "Courses");
$t -> assignTable("table", getCourseTable(), $tableHead);
echo $t -> render();
?>