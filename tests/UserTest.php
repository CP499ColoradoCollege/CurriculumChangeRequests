<?php

class UserTest extends PHPunit_Framework_Testcase{
	
	public function testFetchUserFromEmail(){
		$user = new User($dbc);
		$user = $user->fetchUserFromEmail('test@email.com');
		$result = $user->username;
		$this->assertEquals('Test_username', $result);
	}
	
	public function testFetchUserFromUsername(){
		$user = new User($dbc);
		$user = $user->fetchUserFromUsername('Test_username');
		$result = $user->email;
		$this->assertEquals('test@email.com', $result);
	}
	
	public function testFetchUserFromID(){
		$user = new User($dbc);
		$user = $user->fetchUserFromID('999');
		$result = $user->email;
		$this->assertEquals('test@email.com', $result);
	}
	
	
}



?>