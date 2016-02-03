<?php 

	session_destroy();
	
if (file_exists('users.xml')) {
    $xml = simplexml_load_file('users.xml');
    $i=0;
    $find=false;
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
 				
 				session_start();
 				$_SESSION['username']=$log;
 				$find=true;
				header("Location: http://$host$uri/$extra");
    			break;
    		}
    	}
    	$i++;
    	
    }
    
    if($find==false) {
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'index.php?fail=true';
 				header("Location: http://$host$uri/$extra");
		}
  
    
}



?>

