<?php 
	include 'Task.php';
	if(isset($_SESSION['username'])){
		$log=$_SESSION['username'];
		
	}
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
    	}
	}else{
		
		$str='<?xml version="1.0" encoding="UTF-8"?><tasks></tasks>';
		$myfile = fopen("db/tasks-".$log.'.xml', "w") or die("Unable to open file!");
		fwrite($myfile, $str);
		fclose($myfile);	



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
			<h3 id="myModalLabel"><?php echo gettext("Add_new_task");?></h3>
		</div>
		<form action="save.php" class='new-task-form form-horizontal form-bordered' method="get">
			<div class="modal-body nopadding">
				<div class="control-group">
					<label for="tasktitel" class="control-label"><?php echo gettext("Icon");?></label>
					<div class="controls">
						<select name="icons" id="icons" class='select2-me input-xlarge'>
							<option value="icon-adjust">icon-adjust</option>
							<option value="icon-asterisk">icon-asterisk</option>
							<option value="icon-ban-circle">icon-ban-circle</option>
							<option value="icon-bar-chart">icon-bar-chart</option>
							<option value="icon-barcode">icon-barcode</option>
							<option value="icon-beaker">icon-beaker</option>
							<option value="icon-beer">icon-beer</option>
							<option value="icon-bell">icon-bell</option>
							<option value="icon-bell-alt">icon-bell-alt</option>
							<option value="icon-bolt">icon-bolt</option>
							<option value="icon-book">icon-book</option>
							<option value="icon-bookmark">icon-bookmark</option>
							<option value="icon-bookmark-empty">icon-bookmark-empty</option>
							<option value="icon-briefcase">icon-briefcase</option>
							<option value="icon-bullhorn">icon-bullhorn</option>
							<option value="icon-calendar">icon-calendar</option>
							<option value="icon-camera">icon-camera</option>
							<option value="icon-camera-retro">icon-camera-retro</option>
							<option value="icon-certificate">icon-certificate</option>
							<option value="icon-check">icon-check</option>
							<option value="icon-check-empty">icon-check-empty</option>
							<option value="icon-circle">icon-circle</option>
							<option value="icon-circle-blank">icon-circle-blank</option>
							<option value="icon-cloud">icon-cloud</option>
							<option value="icon-cloud-download">icon-cloud-download</option>
							<option value="icon-cloud-upload">icon-cloud-upload</option>
							<option value="icon-coffee">icon-coffee</option>
							<option value="icon-cog">icon-cog</option>
							<option value="icon-cogs">icon-cogs</option>
							<option value="icon-comment">icon-comment</option>
							<option value="icon-comment-alt">icon-comment-alt</option>
							<option value="icon-comments">icon-comments</option>
							<option value="icon-comments-alt">icon-comments-alt</option>
							<option value="icon-credit-card">icon-credit-card</option>
							<option value="icon-dashboard">icon-dashboard</option>
							<option value="icon-desktop">icon-desktop</option>
							<option value="icon-download">icon-download</option>
							<option value="icon-download-alt">icon-download-alt</option>
							<option value="icon-edit">icon-edit</option>
							<option value="icon-envelope">icon-envelope</option>
							<option value="icon-envelope-alt">icon-envelope-alt</option>
							<option value="icon-exchange">icon-exchange</option>
							<option value="icon-exclamation-sign">icon-exclamation-sign</option>
							<option value="icon-external-link">icon-external-link</option>
							<option value="icon-eye-close">icon-eye-close</option>
							<option value="icon-eye-open">icon-eye-open</option>
							<option value="icon-facetime-video">icon-facetime-video</option>
							<option value="icon-fighter-jet">icon-fighter-jet</option>
							<option value="icon-film">icon-film</option>
							<option value="icon-filter">icon-filter</option>
							<option value="icon-fire">icon-fire</option>
							<option value="icon-flag">icon-flag</option>
							<option value="icon-folder-close">icon-folder-close</option>
							<option value="icon-folder-open">icon-folder-open</option>
							<option value="icon-folder-close-alt">icon-folder-close-alt</option>
							<option value="icon-folder-open-alt">icon-folder-open-alt</option>
							<option value="icon-food">icon-food</option>
							<option value="icon-gift">icon-gift</option>
							<option value="icon-glass">icon-glass</option>
							<option value="icon-globe">icon-globe</option>
							<option value="icon-group">icon-group</option>
							<option value="icon-hdd">icon-hdd</option>
							<option value="icon-headphones">icon-headphones</option>
							<option value="icon-heart">icon-heart</option>
							<option value="icon-heart-empty">icon-heart-empty</option>
							<option value="icon-home">icon-home</option>
							<option value="icon-inbox">icon-inbox</option>
							<option value="icon-info-sign">icon-info-sign</option>
							<option value="icon-key">icon-key</option>
							<option value="icon-leaf">icon-leaf</option>
							<option value="icon-laptop">icon-laptop</option>
							<option value="icon-legal">icon-legal</option>
							<option value="icon-lemon">icon-lemon</option>
							<option value="icon-lightbulb">icon-lightbulb</option>
							<option value="icon-lock">icon-lock</option>
							<option value="icon-unlock">icon-unlock</option>
							<option value="icon-magic">icon-magic</option>
							<option value="icon-magnet">icon-magnet</option>
							<option value="icon-map-marker">icon-map-marker</option>
							<option value="icon-minus">icon-minus</option>
							<option value="icon-minus-sign">icon-minus-sign</option>
							<option value="icon-mobile-phone">icon-mobile-phone</option>
							<option value="icon-money">icon-money</option>
							<option value="icon-move">icon-move</option>
							<option value="icon-music">icon-music</option>
							<option value="icon-off">icon-off</option>
							<option value="icon-ok">icon-ok</option>
							<option value="icon-ok-circle">icon-ok-circle</option>
							<option value="icon-ok-sign">icon-ok-sign</option>
							<option value="icon-pencil">icon-pencil</option>
							<option value="icon-picture">icon-picture</option>
							<option value="icon-plane">icon-plane</option>
							<option value="icon-plus">icon-plus</option>
							<option value="icon-plus-sign">icon-plus-sign</option>
							<option value="icon-print">icon-print</option>
							<option value="icon-pushpin">icon-pushpin</option>
							<option value="icon-qrcode">icon-qrcode</option>
							<option value="icon-question-sign">icon-question-sign</option>
							<option value="icon-quote-left">icon-quote-left</option>
							<option value="icon-quote-right">icon-quote-right</option>
							<option value="icon-random">icon-random</option>
							<option value="icon-refresh">icon-refresh</option>
							<option value="icon-remove">icon-remove</option>
							<option value="icon-remove-circle">icon-remove-circle</option>
							<option value="icon-remove-sign">icon-remove-sign</option>
							<option value="icon-reorder">icon-reorder</option>
							<option value="icon-reply">icon-reply</option>
							<option value="icon-resize-horizontal">icon-resize-horizontal</option>
							<option value="icon-resize-vertical">icon-resize-vertical</option>
							<option value="icon-retweet">icon-retweet</option>
							<option value="icon-road">icon-road</option>
							<option value="icon-rss">icon-rss</option>
							<option value="icon-screenshot">icon-screenshot</option>
							<option value="icon-search">icon-search</option>
							<option value="icon-share">icon-share</option>
							<option value="icon-share-alt">icon-share-alt</option>
							<option value="icon-shopping-cart">icon-shopping-cart</option>
							<option value="icon-signal">icon-signal</option>
							<option value="icon-signin">icon-signin</option>
							<option value="icon-signout">icon-signout</option>
							<option value="icon-sitemap">icon-sitemap</option>
							<option value="icon-sort">icon-sort</option>
							<option value="icon-sort-down">icon-sort-down</option>
							<option value="icon-sort-up">icon-sort-up</option>
							<option value="icon-spinner">icon-spinner</option>
							<option value="icon-star">icon-star</option>
							<option value="icon-star-empty">icon-star-empty</option>
							<option value="icon-star-half">icon-star-half</option>
							<option value="icon-tablet">icon-tablet</option>
							<option value="icon-tag">icon-tag</option>
							<option value="icon-tags">icon-tags</option>
							<option value="icon-tasks">icon-tasks</option>
							<option value="icon-thumbs-down">icon-thumbs-down</option>
							<option value="icon-thumbs-up">icon-thumbs-up</option>
							<option value="icon-time">icon-time</option>
							<option value="icon-tint">icon-tint</option>
							<option value="icon-trash">icon-trash</option>
							<option value="icon-trophy">icon-trophy</option>
							<option value="icon-truck">icon-truck</option>
							<option value="icon-umbrella">icon-umbrella</option>
							<option value="icon-upload">icon-upload</option>
							<option value="icon-upload-alt">icon-upload-alt</option>
							<option value="icon-user">icon-user</option>
							<option value="icon-user-md">icon-user-md</option>
							<option value="icon-volume-off">icon-volume-off</option>
							<option value="icon-volume-down">icon-volume-down</option>
							<option value="icon-volume-up">icon-volume-up</option>
							<option value="icon-warning-sign">icon-warning-sign</option>
							<option value="icon-wrench">icon-wrench</option>
							<option value="icon-zoom-in">icon-zoom-in</option>
							<option value="icon-zoom-out">icon-zoom-out</option>
							<option value="icon-file">icon-file</option>
							<option value="icon-file-alt">icon-file-alt</option>
							<option value="icon-cut">icon-cut</option>
							<option value="icon-copy">icon-copy</option>
							<option value="icon-paste">icon-paste</option>
							<option value="icon-save">icon-save</option>
							<option value="icon-undo">icon-undo</option>
							<option value="icon-repeat">icon-repeat</option>
							<option value="icon-text-height">icon-text-height</option>
							<option value="icon-text-width">icon-text-width</option>
							<option value="icon-align-left">icon-align-left</option>
							<option value="icon-align-center">icon-align-center</option>
							<option value="icon-align-right">icon-align-right</option>
							<option value="icon-align-justify">icon-align-justify</option>
							<option value="icon-indent-left">icon-indent-left</option>
							<option value="icon-indent-right">icon-indent-right</option>
							<option value="icon-font">icon-font</option>
							<option value="icon-bold">icon-bold</option>
							<option value="icon-italic">icon-italic</option>
							<option value="icon-strikethrough">icon-strikethrough</option>
							<option value="icon-underline">icon-underline</option>
							<option value="icon-link">icon-link</option>
							<option value="icon-paper-clip">icon-paper-clip</option>
							<option value="icon-columns">icon-columns</option>
							<option value="icon-table">icon-table</option>
							<option value="icon-th-large">icon-th-large</option>
							<option value="icon-th">icon-th</option>
							<option value="icon-th-list">icon-th-list</option>
							<option value="icon-list">icon-list</option>
							<option value="icon-list-ol">icon-list-ol</option>
							<option value="icon-list-ul">icon-list-ul</option>
							<option value="icon-list-alt">icon-list-alt</option>
							<option value="icon-angle-left">icon-angle-left</option>
							<option value="icon-angle-right">icon-angle-right</option>
							<option value="icon-angle-up">icon-angle-up</option>
							<option value="icon-angle-down">icon-angle-down</option>
							<option value="icon-arrow-down">icon-arrow-down</option>
							<option value="icon-arrow-left">icon-arrow-left</option>
							<option value="icon-arrow-right">icon-arrow-right</option>
							<option value="icon-arrow-up">icon-arrow-up</option>
							<option value="icon-caret-down">icon-caret-down</option>
							<option value="icon-caret-left">icon-caret-left</option>
							<option value="icon-caret-right">icon-caret-right</option>
							<option value="icon-caret-up">icon-caret-up</option>
							<option value="icon-chevron-down">icon-chevron-down</option>
							<option value="icon-chevron-left">icon-chevron-left</option>
							<option value="icon-chevron-right">icon-chevron-right</option>
							<option value="icon-chevron-up">icon-chevron-up</option>
							<option value="icon-circle-arrow-down">icon-circle-arrow-down</option>
							<option value="icon-circle-arrow-left">icon-circle-arrow-left</option>
							<option value="icon-circle-arrow-right">icon-circle-arrow-right</option>
							<option value="icon-circle-arrow-up">icon-circle-arrow-up</option>
							<option value="icon-double-angle-left">icon-double-angle-left</option>
							<option value="icon-double-angle-right">icon-double-angle-right</option>
							<option value="icon-double-angle-up">icon-double-angle-up</option>
							<option value="icon-double-angle-down">icon-double-angle-down</option>
							<option value="icon-hand-down">icon-hand-down</option>
							<option value="icon-hand-left">icon-hand-left</option>
							<option value="icon-hand-right">icon-hand-right</option>
							<option value="icon-hand-up">icon-hand-up</option>
							<option value="icon-circle">icon-circle</option>
							<option value="icon-circle-blank">icon-circle-blank</option>
							<option value="icon-play-circle">icon-play-circle</option>
							<option value="icon-play">icon-play</option>
							<option value="icon-pause">icon-pause</option>
							<option value="icon-stop">icon-stop</option>
							<option value="icon-step-backward">icon-step-backward</option>
							<option value="icon-fast-backward">icon-fast-backward</option>
							<option value="icon-backward">icon-backward</option>
							<option value="icon-forward">icon-forward</option>
							<option value="icon-fast-forward">icon-fast-forward</option>
							<option value="icon-step-forward">icon-step-forward</option>
							<option value="icon-eject">icon-eject</option>
							<option value="icon-fullscreen">icon-fullscreen</option>
							<option value="icon-resize-full">icon-resize-full</option>
							<option value="icon-resize-small">icon-resize-small</option>
							<option value="icon-phone">icon-phone</option>
							<option value="icon-phone-sign">icon-phone-sign</option>
							<option value="icon-facebook">icon-facebook</option>
							<option value="icon-facebook-sign">icon-facebook-sign</option>
							<option value="icon-twitter">icon-twitter</option>
							<option value="icon-twitter-sign">icon-twitter-sign</option>
							<option value="icon-github">icon-github</option>
							<option value="icon-github-alt">icon-github-alt</option>
							<option value="icon-github-sign">icon-github-sign</option>
							<option value="icon-linkedin">icon-linkedin</option>
							<option value="icon-linkedin-sign">icon-linkedin-sign</option>
							<option value="icon-pinterest">icon-pinterest</option>
							<option value="icon-pinterest-sign">icon-pinterest-sign</option>
							<option value="icon-google-plus">icon-google-plus</option>
							<option value="icon-google-plus-sign">icon-google-plus-sign</option>
							<option value="icon-sign-blank">icon-sign-blank</option>
							<option value="icon-ambulance">icon-ambulance</option>
							<option value="icon-beaker">icon-beaker</option>
							<option value="icon-h-sign">icon-h-sign</option>
							<option value="icon-hospital">icon-hospital</option>
							<option value="icon-medkit">icon-medkit</option>
							<option value="icon-plus-sign-alt">icon-plus-sign-alt</option>
							<option value="icon-stethoscope">icon-stethoscope</option>
							<option value="icon-user-md">icon-user-md</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label for="task-name" class="control-label"><?php echo gettext("Task");?></label>
					<div class="controls">
						<input type="text" name="task-name">
					</div>
				</div>
				<div class="control-group">
					<label for="tasktitel" class="control-label"></label>
					<div class="controls">
						<label class="checkbox"><input type="checkbox" name="task-bookmarked" value="yep"> <?php echo gettext("Mark_as_in_progress");?> </label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" value="<?php echo gettext("Add_Task");?>" >
			</div>
		</form>

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
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><img src="img/demo/flags/globe.png" alt="" ><span>Language</span></a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="homeAdmin.php?lang=en_US"><img src="img/demo/flags/us.gif" alt=""><span>USA</span></a>
							</li>
							<li>
								<a href="homeAdmin.php?lang=de_DE"><img src="img/demo/flags/de.gif" alt=""><span>Deutschland</span></a>
							</li>
							<li>
								<a href="homeAdmin.php?lang=fr_FR"><img src="img/demo/flags/fr.gif" alt=""><span>France</span></a>
							</li>
						</ul>
					</li>
				</ul>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><span><?php echo $log?></span><img src="img/demo/flags/users.png" /></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="homeAdmin.php"><?php echo gettext("Task Manager");?></a>
						</li>
						<li>
							<a href="users.php"><?php echo gettext("Users Settings");?></a>
						</li>
					
						<li>
							<a href=<?php echo '"disconnect.php?username='.$log.'"' ?>><?php echo gettext("Sign_out");?></a>
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
						<h1><?php echo _("Task_Manager");?></h1>
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
								<h3><i class="icon-ok"></i> <?php echo _("Tasks");?></h3>
								<div class="actions">
									<a href="#new-task" data-toggle="modal" class='btn'><i class="icon-plus-sign"></i> <?php echo _('Add_Task');?></a>
								</div>
							</div>
							<div class="box-content nopadding">
								
								
								<ul class="tasklist" >
								<?php if(isset($t)) for ($j=0;$j<count($t);$j++){?>
									<li <?php if(strcmp($t[$j]->getDone(),'true')==0) echo "class='done'";
									           else if(strcmp($t[$j]->getBookmark(),'true')==0) echo "class='bookmarked'";?>>																									
										<div class="check" title="<?php echo _("Mark_as_done"); ?>">
										<a href=<?php echo '"done.php?name='.$t[$j]->getDescription().'"';?>>	<input onclick="submit();" type="checkbox" class="icheck-me"  data-skin="square" data-color="blue" <?php if(strcmp($t[$j]->getDone(),'true')==0) echo "checked='checked'";?>></a>
										
										</div>
										<span class="task"><i class="<?php echo $t[$j]->getIcon();?>"></i><span><?php  echo $t[$j]->getDescription(); ?></span></span>
										<span class="task-actions">
											<a href=<?php echo '"remove.php?name='.$t[$j]->getDescription().'"';?> class='task-delete' rel="tooltip" title="<?php echo _("Delete_this_task");?>" ><i class="icon-remove"></i></a>
											<a href=<?php echo '"update.php?name='.$t[$j]->getDescription().'"';?> class="task-bookmark" rel="tooltip" title="<?php echo _("Mark_as_in_progress");?>"  ><i class="icon-bookmark-empty"></i></a>
										</span>
									</li>
									<?php }?>
									</ul>
									
								
							</div>
						</div>
					</div>
				</div>
				
		</div></div>
		
	</body>

	</html>

