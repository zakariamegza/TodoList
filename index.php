<?php 
		
		if(isset($_GET['username'])){
			
			$username=$_GET['username'];
		}?>
<!DOCTYPE html>
<html>
<head>
<title>ISIMA</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="css/images/favicon.png">
<link href="css/style1.css" rel='stylesheet' type='text/css' />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfonts-->
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,700,800' rel='stylesheet' type='text/css'>
<!--//webfonts-->

<script type = "text/javascript" >
function changeHashOnLoad() {
     window.location.href += "#";
     setTimeout("changeHashAgain()", "50"); 
}

function changeHashAgain() {
  window.location.href += "1";
}

var storedHash = window.location.hash;
window.setInterval(function () {
    if (window.location.hash != storedHash) {
         window.location.hash = storedHash;
    }
}, 50);


</script>

</head>
<body onload="changeHashOnLoad(); " style="background-image: url('img/fond.jpg');background-repeat: no-repeat;">
	
 <!--start-main-->
 	<div class="login-05">
		<div class="fifth-login">
			<h2>Welcome</h2>
			<form class="five" action="login.php" method="get">
				<ul>
				<li>
					<input type="text" id="log" name="log" required="required"  class="text" placeholder="Login" value="<?php if (isset($username)) echo $username?>"  /><a href="#" class="icon5 user2"></a>
				</li>
				<li class="blue">
					<input type="password" id="pass" name="pass" required="required" placeholder="Password"  /><a href="#" class="icon5 lock2"></a>
				</li>
				</ul>
				<div class="submit-five">
					<input type="submit" id="btn" value="LOG IN" /> 
				</div>
				
			</form>
			<?php if (isset($_GET['fail'])){
					$fail='true';
				} else {$fail='false';}
				 
				if(strcmp($fail,'true')==0) 
					echo "<span>incorrect username or password</span>";
				?>
		</div>
		
		
	</div>

	<!--//End-login-form-->
	<!--start-copyright-->
   		<div class="copy-right">
   			<div class="wrap">
				<p style="color: grey">Copyright ISIMA 2015  All rights  Reserved </p>
		</div>
	</div>
	<!--//end-copyright-->
		 		
</body>
</html>
