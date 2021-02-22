<?php

$user_filepath = __DIR__.'/../../html/classes/Course.php';
require $user_filepath;

class CourseTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $dbc;
    public $course;
    
    protected function _before()
    {
        $this->dbc = mysqli_connect('localhost', 'root', '', 'testproposaltoolDB') OR die('Error: '.mysqli_connect_error());
        $this->course = new Course($this->dbc);
    }

    protected function _after()
    {
        
    }

    public function testFetchCourseFromCourseID()
    {
        $course_fetched = $this->course->fetchCourseFromCourseID('CP122') ? true : false;
        $this->assertTrue($course_fetched);
    }

    public function testFetchCourseFromTitle()
    {
        $course_fetched = $this->course->fetchCourseFromTitle("Computer Organization") ? true : false;
        $this->assertTrue($course_fetched);
    }
}