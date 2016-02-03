<?php if (file_exists('users.xml')) {
    $xml = simplexml_load_file('users.xml');
    $i=0;
    $find='false';
    
    while(isset($xml->user[$i])){
    	$log=(string)$xml->user[$i]->login;
    	if(strcmp($_GET['username'],$log)==0){
  
  			echo 'true';
  			$find=true;
  			break;  		
    	}
    	$i++;
    }

if(isset($_GET['username']) && isset($_GET['password']) && strcmp($find,'false')==0){
		
		$name=$_GET['username'];
		$pass=$_GET['password'];
		$type="normal";
		$gallery = $xml->addChild('user');
		$gallery->addChild('login', $name);
		$gallery->addChild('password', $pass);
		$gallery->addChild('type', $type);
		$xml->asXML('users.xml');
		$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra="users.php";
				header("Location: http://$host$uri/$extra");
		
	}
  


}
