<?php 
	include 'Task.php';
	include 'User.php';
	
	if(isset($_SESSION['username'])){
		$log=$_SESSION['username'];
		
	}
	if (file_exists('users.xml')) {
    $xml = simplexml_load_file('users.xml');
    $i=0;
    $j=0;
    $t=Array();
   	while(isset($xml->user[$i])){
    	$description=(string)$xml->user[$i]->login;
		$icon=(string)$xml->user[$i]->password;
		$done=(string)$xml->user[$i]->type;
		if(strcmp($done, 'admin')!=0){
    	$t[$j]=new User($description, $icon, $done);
    	$j++;
		}
		$i++;
    	}
	}
		
	if (isset($_GET['lang']))
	{
		$language = $_GET['lang'];
		
	}else{
		$language = "en_US";
	}
	putenv("LANG=".$language);
	setlocale(LC_ALL, $language);
	$domain = "messages";
	bindtextdomain($domain, "Locale");
	textdomain($domain);		
?>


<!doctype html>
<html>
<head>
<script type="text/javascript">
	
	function validateForm() {
	    var x = document.forms["MyForm"]["password"].value;
	    var y = document.forms["MyForm"]["password1"].value;
	    if (x!=y ) {
			alert('passwords must be the same');	 
	       return false;
	    }
	    else if (x.length < 6){
	    	alert('length of password is less than 6 characters');	 
		       return false;

		    }
	  		var str=document.getElementById('textfield').value;
	        var xmlhttp = new XMLHttpRequest();
	        xmlhttp.onreadystatechange = function() {
	            if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && xmlhttp.responseText=="true") {
	                alert("Existing username,the user was not added");
	                
	              
	            }
	        };
	        xmlhttp.open("GET", "checkUser.php?username=" + str+"&password="+x, true);
	        xmlhttp.send();
	    
	}
	</script>


	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>ISIMA - Task Manager </title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="css/plugins/chosen/chosen.css">
	<!-- select2 -->
	<link rel="stylesheet" href="css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	
	
	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<!-- Touch enable for jquery UI -->
	<script src="js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<!-- slimScroll -->
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- vmap -->
	<script src="js/plugins/vmap/jquery.vmap.min.js"></script>
	<script src="js/plugins/vmap/jquery.vmap.world.js"></script>
	<script src="js/plugins/vmap/jquery.vmap.sampledata.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Flot -->
	<script src="js/plugins/flot/jquery.flot.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.bar.order.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.resize.min.js"></script>
	<!-- imagesLoaded -->
	<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- PageGuide -->
	<script src="js/plugins/pageguide/jquery.pageguide.js"></script>
	<!-- FullCalendar -->
	<script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>
	<!-- Chosen -->
	<script src="js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- select2 -->
	<script src="js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>

	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>
	
	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->

	<!-- Favicon -->

	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body>
	<div id="new-task" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Add new user</h3>
		</div>
			<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Create your account</h3>
							</div>
							<div class="box-content">
								<form action="#" method="POST" class='form-horizontal' id="MyForm" onsubmit="return validateForm()">
									<div class="control-group">
										<label for="textfield" class="control-label">Username :</label>
										<div class="controls">
											<input type="text" name="textfield" id="textfield" class="input-xlarge" required>
											<span id="sp11"></span>
										</div>
									</div>
									<div class="control-group">
										<label for="password" class="control-label">Password :</label>
										<div class="controls">
											<input type="text" name="password" id="password"  class="input-xlarge" required>
										</div>
									</div>
									<div class="control-group">
										<label for="password1" class="control-label">Retype password :</label>
										<div class="controls">
											<input type="text" name="password1" id="password1"  class="input-xlarge" required />
											
										</div>
									</div>
									
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<button type="reset" class="btn">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
		
	</div>

		


	
	<div id="navigation">
		<div class="container-fluid">		
			<div class="user">
				<ul class="icon-nav">
					
					<li class='dropdown colo'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
						<ul class="dropdown-menu pull-right theme-colors">
							<li class="subtitle">
								Predefined colors
							</li>
							<li>
								<span class='red'></span>
								<span class='orange'></span>
								<span class='green'></span>
								<span class="brown"></span>
								<span class="blue"></span>
								<span class='lime'></span>
								<span class="teal"></span>
								<span class="purple"></span>
								<span class="pink"></span>
								<span class="magenta"></span>
								<span class="grey"></span>
								<span class="darkblue"></span>
								<span class="lightred"></span>
								<span class="lightgrey"></span>
								<span class="satblue"></span>
								<span class="satgreen"></span>
							</li>
						</ul>
					</li>
					<li class='dropdown language-select'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><img src="img/demo/flags/globe.png" alt="" ><span><?php echo gettext('Language') ?></span></a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="users.php?lang=en_US"><img src="img/demo/flags/us.gif" alt=""><span>US</span></a>
							</li>
							<li>
								<a href="users.php?lang=de_DE"><img src="img/demo/flags/de.gif" alt=""><span>Deutschland</span></a>
							</li>
							<li>
								<a href="users.php?lang=fr_FR"><img src="img/demo/flags/fr.gif" alt=""><span>France</span></a>
							</li>
						</ul>
					</li>
				</ul>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><span><?php echo $log?></span><img src="img/demo/flags/users.png" /></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="homeAdmin.php"><?php echo gettext("Task_Manager")?></a>
						</li>
						<li>
							<a href="users.php"><?php echo gettext("Users_Settings")?></a>
						</li>
						<li>
							<a href=<?php echo '"disconnect.php?username='.$log.'"' ?>>Sign out</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
		
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Users Manager</h1>
					</div>
					<div class="pull-right">
					
						<ul class="stats">
						
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big"></span>
									<span></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered lightgrey">
							<div class="box-title">
								<h3><i class="icon-ok"></i>Users</h3>
								<div class="actions">
									<a href="#new-task" data-toggle="modal" class='btn'><i class="icon-plus-sign"></i> Add User</a>
								</div>
							</div>
							<div class="box-content nopadding">
								
								
								
								<?php for ($j=0;$j<count($t);$j++){?>
									<ul class="tasklist" >
									<li >																									
										
										<span class="task"><span><?php echo $t[$j]->toString();?></span></span>
										<span class="task-actions">
											<a href=<?php echo '"removeUser.php?name='.$t[$j]->getUsername().'"';?> class='task-delete' rel="tooltip"  ><i class="icon-remove"></i></a>
											<span class="task-bookmark" style="visibility: hidden;"><i class="icon-bookmark-empty"></i></span>
										</span>
									</li>
									</ul>
									<?php }?>
									
									
								
							</div>
						</div>
					</div>
				</div>
				
		</div></div>
		
	</body>

	</html>

