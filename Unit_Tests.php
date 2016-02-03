<?php
include 'Business.php';

class Test extends PHPUnit_Framework_TestCase {
	public function setUp(){}

	
	public function loadUsers(){
		echo "test loadUsers is running \n";
		$res=load();
		$this->assertEquals(4,$res);
	}
	public function removeUser(){
		echo "test removeUser is running \n";
		$res=removeUser();
		$this->assertEquals('true',$res);
	}
	public function loadTasks(){
		echo "test loadTasks is running \n";
		$res=loadTasks();
		$this->assertEquals(3,$res);
	}
	
	public function removeTask(){
		echo "test removeTask is running \n";
		$res=remove();
		$this->assertEquals('true',$res);
	}
	public function updateTask(){
		echo "test updateTask is running \n";
		$res=updateTask();
		$this->assertEquals('true',$res);
	}
	
	public function isDone(){
		echo "test isDone is running \n";
		$res=isDone();
		$this->assertEquals('true',$res);
	}
	

	
	
}