<?php
require_once 'vendor/autoload.php';


class CourseTest extends PHPunit_Framework_Testcase{
	
	public function testFetchCourseFromCourseID($dbc){
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseID('TE000');
		$result = $course->course_title;
		$this->assertEquals('Test Course Title', $result);
	}
	
	public function testFetchCourseFromCourseTitle($dbc){
		$course = new Course($dbc);
		$course = $course->fetchCourseFromCourseTitle('Test Course Title');
		$result = $course->subj_code.$course->course_num;
		$this->assertEquals('TE000', $result);
	}
	
}

?>