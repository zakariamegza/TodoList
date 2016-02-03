<?php

class Task{

	private $descriton;
	private $icon;
	private $done;
	private $bookmark;
	
	function Task($description,$icon,$done,$bookmark){
		$this->descriton=$description;
		$this->icon=$icon;
		$this->done=$done;
		$this->bookmark=$bookmark;
	}


	function getDescription(){
		return $this->descriton;
	}

	function getIcon(){
		return $this->icon;
	}
	function getDone(){
		return $this->done;
	}

	function getBookmark(){return $this->bookmark;}
}