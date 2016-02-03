<?php

				
				if (isset($_GET['username'])){
					
					$username=$_GET['username'];
				}
				session_destroy();
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'index.php?username='.$username;
				header("Location: http://$host$uri/$extra");
				
?>