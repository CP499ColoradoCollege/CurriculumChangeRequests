<?php

use function PHPUnit\Framework\assertTrue;

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
        $course_fetched = $this->course->fetchCourseFromCourseID(2);
        assertTrue($course_fetched);
    }

    public function testFetchCourseFromTitle()
    {
        $course_fetched = $this->course->fetchCourseFromTitle("History of Architecture");
        assertTrue($course_fetched);
    }
}