<?php


namespace {
    use ../html/classes/User.php as User
}

class ExampleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $user = new User()
        $email = "admin@proposals.com"
        $username = "c_kennedy"
    }

  

    public function testFetchUserFromEmail()
	{
        $user_correctly_constructed = $user.testFetchUserFromEmail($email) #false if something goes wrong, otherwise correctly populates user object
        assertTrue($user == $user_correctly_constructed) 
	}

	public function testFetchUserFromUsername()
	{
        $user_correctly_constructed = $user.testFetchUserFrom($username) #false if something goes wrong, otherwise correctly populates user object
        assertTrue($user == $user_correctly_constructed)

	}	

    protected function _after()
    {
    }

}

?>