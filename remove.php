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
					$dom=dom_import_simplexml($xml->task[$i]);
					$dom->parentNode->removeChild($dom);
					 
					break;
				}
				$i++;
			}echo 'lll';
			$xml->asXML('db/tasks-'.$log.'.xml');	
		}
	
	}
	

	

	
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$xml = simplexml_load_file('users.xml');
    $i=0;
	while(isset($xml->user[$i])){
		$desc=(string)$xml->user[$i]->login;
		$type=(string)$xml->user[$i]->type;
		if(strcmp($desc,$_SESSION['username'])==0) {
			if(strcmp($type,'admin')==0)$extra = 'homeAdmin.php';
		}
		$i++;
		 

	}
			if(strcmp($extra, 'homeAdmin.php')!=0) $extra ='home.php' ;
	
				header("Location: http://$host$uri/$extra");
	
