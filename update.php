<?php


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
					 
					break;
				}
				$i++;
			}

			$xml->asXML('db/tasks-'.$log.'.xml');}
	}


	$xml = simplexml_load_file('users.xml');
    $i=0;
	$log=$_SESSION['username'];
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	while(isset($xml->user[$i])){
		$desc=(string)$xml->user[$i]->login;
		$type=(string)$xml->user[$i]->type;
		if(strcmp($desc,$_SESSION['username'])==0) {
			if(strcmp($type,'admin')==0)$extra = 'homeAdmin.php';
			
		}
		$i++;

		 
	}
		if(strcmp($extra, 'homeAdmin.php')!=0) $extra ='home.php' ;
	
	$_SESSION['username'] = $log;
	header("Location: http://$host$uri/$extra");
