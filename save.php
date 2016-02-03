<?php
session_start();
if(isset($_SESSION["username"])){
$log=$_SESSION["username"];
if (file_exists('db/tasks-'.$log.'.xml')) {
    $xml = simplexml_load_file('db/tasks-'.$log.'.xml');
if(isset($_GET['task-name']) && isset($_GET['icons'])){
		
		$name=$_GET['task-name'];
		$icon=$_GET['icons'];
		$check=(string)$_GET['task-bookmarked'];
		if(strcmp($check, 'yep')==0) $check='true';
		else $check='false';
		$gallery = $xml->addChild('task');
		$gallery->addChild('description', $name);
		$gallery->addChild('icon', $icon);
		$gallery->addChild('bookmark', $check);
		$xml->asXML('db/tasks-'.$log.'.xml');
}
		if (file_exists('users.xml')) {
    $xml = simplexml_load_file('users.xml');
    $i=0;
      while(isset($xml->user[$i])){
      	$desc=(string)$xml->user[$i]->login;
      	$type=(string)$xml->user[$i]->type;
    if(strcmp($desc,$_SESSION['username'])==0) {
    	 if(strcmp($type,'admin')==0)$extra = 'homeAdmin.php';
    	 else $extra = 'home.php';
    }
    $i++;
    	
      
      }
		$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				
				header("Location: http://$host$uri/$extra");

	}}}