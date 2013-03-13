<!DOCTYPE html>
<html lang="en">

<? // set defaults
if(empty($page_title)) $page_title="The Bowdoin Orient";
if(empty($page_description)) $page_description="The Bowdoin Orient is a student-run publication dedicated to providing news and media relevant to the Bowdoin College community.";
if(empty($page_type)) $page_type="website";
if(empty($page_image)) $page_image=base_url()."img/o-200.png";
?>

<head>
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
	<meta charset="utf-8" />
	<title><?=$page_title?></title>
	
	<!-- favicon -->
	<link rel="shortcut icon" href="<?=base_url()?>img/o-32-transparent.png">
	
	<!-- metadata -->
	<meta name="description" 		content="<?=$page_description?>" />	
	<!-- Facebook Open Graph tags -->
	<meta property="og:title" 		content="<?=$page_title?>" />
	<meta property="og:description"	content="<?=$page_description?>" />
	<meta property="og:type" 		content="<?=$page_type?>" />
	<meta property="og:image" 		content="<?=$page_image?>" />
	<meta property="og:site_name" 	content="The Bowdoin Orient" />
	<meta property="fb:admins" 		content="1233600119" />
	<meta property="fb:app_id" 		content="342498109177441" />
	
	<!-- CSS -->
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/orient.css?v=4">
	
	<!-- for mobile -->
	<link rel="apple-touch-icon" href="<?=base_url()?>img/o-114.png"/>
	<meta name = "viewport" content = "initial-scale = 1.0, user-scalable = no">
		
	<!-- jQuery -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>
	<!-- for smooth scrolling -->
    <script type="text/javascript" src="<?=base_url()?>js/jquery.scrollTo-min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery.localscroll-1.2.7-min.js"></script>
	
	<!-- template js -->
	<script type="text/javascript" src="<?=base_url()?>js/orient.js"></script>
	
	<!-- TypeKit -->
	<script type="text/javascript" src="http://use.typekit.com/rmt0nbm.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	<!-- SwipeView -->
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/swipeview.css?v=1">
	
	<!-- for homepage -->
	<? if($this->uri->segment(1) == "" || $this->uri->segment(1) == "browse"): ?>
		<!-- rss -->
		<link rel="alternate" type="application/rss+xml" title="The Bowdoin Orient" href="<?=base_url()?>rss/latest" />
		<? foreach($sections as $section): ?>
			<link rel="alternate" type="application/rss+xml" title="The Bowdoin Orient - <?=$section->name?>" href="<?=base_url()?>rss/section/<?=$section->id?>" />
		<? endforeach; ?>
	<? endif; ?>
	
	<!-- for author pages -->
	<? if($this->uri->segment(1) == "author"): ?>
		<!-- rss -->
		<link rel="alternate" type="application/rss+xml" title="<?=$author->name?> - The Bowdoin Orient" href="<?=base_url()?>rss/author/<?=$author->id?>" />
	<? endif; ?>
	
	<!-- for series pages -->
	<? if($this->uri->segment(1) == "series"): ?>
		<!-- rss -->
		<link rel="alternate" type="application/rss+xml" title="<?=$series->name?> - The Bowdoin Orient" href="<?=base_url()?>rss/series/<?=$series->id?>" />
	<? endif; ?>
	
	<!-- for articles -->
	<? if($this->uri->segment(1) == "article"): ?>
	
		<!-- for table of contents -->
		<script type="text/javascript" src="<?=base_url()?>js/jquery.jqTOC.js"></script>
	
		<? if(bonus()): ?>	
			<!-- CK Editor -->
			<script type="text/javascript" src="<?=base_url()?>js/ckeditor/ckeditor.js"></script>
		<? endif; ?>
	
	<? endif; ?>
	
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