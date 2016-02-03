<?php
	session_start();
	if(isset($_SESSION["username"])){
		$log=$_SESSION["username"];
		if (file_exists('users.xml')) {
			$xml = simplexml_load_file('users.xml');
			$i=0;
			while(isset($xml->user[$i])){
				$desc=(string)$xml->user[$i]->login;
				if(strcmp($desc,$_GET['name'])==0) {
					$dom=dom_import_simplexml($xml->user[$i]);
					$dom->parentNode->removeChild($dom);
					 
					break;
				}
				$i++;
			}
			$xml->asXML('users.xml');}}

$log=$_SESSION['username'];
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'users.php';
$_SESSION['username'] = $log;
header("Location: http://$host$uri/$extra");
				
