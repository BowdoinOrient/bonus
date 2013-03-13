<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
	<link rel="shortcut icon" href="<?=base_url()?>img/o-32-transparent.png">
	
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/orient.css?v=4">
	<script type="text/javascript" src="<?=base_url()?>js/orient.js"></script>
	
	<meta name="description" content="<?= $description ?>" />
	
	<!-- Facebook Open Graph tags -->
	<meta property="og:title" content="<?= $title ?>" />
	<meta property="og:description" content="<?= $description ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?=base_url()?>img/o-200.png" />
	<meta property="og:url" content="http://bowdoinorient.com/" />
	<meta property="og:site_name" content="The Bowdoin Orient" />
	<meta property="fb:admins" content="1233600119" />
	<meta property="fb:app_id" content="342498109177441" />
	<!--<meta property="fb:page_id" content="113269185373845" />-->
	
	<!-- for mobile -->
	<link rel="apple-touch-icon" href="<?=base_url()?>img/o-114.png"/>
	<meta name = "viewport" content = "initial-scale = 1.0, user-scalable = no">
	
	<!-- rss -->
	<link rel="alternate" type="application/rss+xml" title="The Bowdoin Orient" href="<?=base_url()?>rss/latest" />
	<? foreach($sections as $section): ?>
	<link rel="alternate" type="application/rss+xml" title="The Bowdoin Orient - <?=$section->name?>" href="<?=base_url()?>rss/section/<?=$section->id?>" />
	<? endforeach; ?>
	
	<script type="text/javascript" src="http://use.typekit.com/rmt0nbm.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	<!-- jQuery -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url()?>js/jquery-1.8.0.min.js"></script> -->
	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>
	
	<!-- SwipeView (for carousel) -->
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/swipeview.css?v=1">

    <!-- for smooth scrolling -->
    <script type="text/javascript" src="<?=base_url()?>js/jquery.scrollTo-min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery.localscroll-1.2.7-min.js"></script>
	
	<!-- Google Analytics -->
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-18441903-3']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	<!-- End Google Analytics -->
	
</head>