<?php

//Function that loads users and check if the logging and the password are exact then it redirect
//the client to the right page in depndance of his type (administrator or not )
function load(){
	session_start();
if (file_exists('users.xml')) {
    $xml = simplexml_load_file('users.xml');
    $i=0;
    
    while(isset($xml->user[$i])){
    	$log=(string)$xml->user[$i]->login;
    	$pass=(string)$xml->user[$i]->password;
    	if(strcmp($_GET['log'],$log)==0){
   		if(strcmp($_GET['pass'],$pass)==0){
    			$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$type=(string)$xml->user[$i]->type;
				if(strcmp($type,'admin')==0)
				$extra = 'homeAdmin.php';
				else 
				$extra = 'home.php';
 				$_SESSION['username'] = $log;
				header("Location: http://$host$uri/$extra");
    			break;
    		}
    	}
    	$i++;
    	
    }
  
    return count($t);
}}

//this function remeove a task from the xml file
function removeTask(){

	if(isset($_SESSION["username"])){
		$log=$_SESSION["username"];
		if (file_exists('db/tasks-'.$log.'.xml')) {
			$xml = simplexml_load_file('db/tasks-'.$log.'.xml');
			$i=0;
			while(isset($xml->task[$i])){
				$desc=(string)$xml->task[$i]->description;
				if(strcmp($desc,$_GET['name'])==0) {
					$dom=dom_import_simplexml($xml->task[$i]);
					$dom->parentNode->removeChild($dom);

					return 'true';
				}
				$i++;
			}
			$xml->asXML('db/tasks-'.$log.'.xml');
		}

	}
}


//this function declare a task as done or not
function isDone(){

	$log=$_SESSION['username'];
	if (file_exists('db/tasks-'.$log.'.xml')) {
		$xml = simplexml_load_file('db/tasks-'.$log.'.xml');
		$i=0;
		while(isset($xml->task[$i])){
			$desc=(string)$xml->task[$i]->description;
			if(strcmp($desc,$_GET['name'])==0) {
				if(strcmp($xml->task[$i]->done[0],'true')==0) $xml->task[$i]->done[0]='false';
				else $xml->task[$i]->done[0]='true';
				$xml->task[$i]->bookmark[0]="false";
				return 'true';
			}
			$i++;
		}
		$xml->asXML('db/tasks-'.$log.'.xml');
	}
}

//this function update the situation of a task to in progress
function updateTask(){
	session_start();
	if(isset($_SESSION["username"])){
		$log=$_SESSION["username"];
		if (file_exists('db/tasks-'.$log.'.xml')) {
			$xml = simplexml_load_file('db/tasks-'.$log.'.xml');
			$i=0;
			while(isset($xml->task[$i])){
				$desc=(string)$xml->task[$i]->description;
				if(strcmp($desc,$_GET['name'])==0) {
					if(strcmp($xml->task[$i]->bookmark[0],'true')==0) $xml->task[$i]->bookmark[0]='false';
					else $xml->task[$i]->bookmark[0]='true';

					return true;
				}
				$i++;
			}

			$xml->asXML('db/tasks-'.$log.'.xml');}
	}
}
//this function load tasks of a user , from its file name db/tasks-username.xml and if this file 
//dosn't exit an empty file will be created wrotten on it xml version and <tasks></tasks> (the root node)
function loadTasks(){
	session_start();
	if(isset($_SESSION['username'])){
		$log=$_SESSION['username'];


		if (file_exists('db/tasks-'.$log.'.xml')) {
			$xml = simplexml_load_file('db/tasks-'.$log.'.xml');
			$i=0;
			while(isset($xml->task[$i])){
				$description=(string)$xml->task[$i]->description;
				$icon=(string)$xml->task[$i]->icon;
				$done=(string)$xml->task[$i]->done;
				$bookmark=(string)$xml->task[$i]->bookmark;
				$t[$i]=new Task($description, $icon, $done,$bookmark);
				$i++;
				 
			}return $t;
		}else{

			$str='<?xml version="1.0" encoding="UTF-8"?><tasks></tasks>';
			$myfile = fopen("db/tasks-".$log.'.xml', "w") or die("Unable to open file!");
			fwrite($myfile, $str);
			fclose($myfile);



		}}}
		
		
		//there is other functions used and declared in the php files
		//this file contains the main functions and the more useless 
		//Megouaz Zakariae
		