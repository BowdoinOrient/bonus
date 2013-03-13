<!DOCTYPE html>
<html lang="en">

<head>
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
	<meta charset="utf-8" />
	<title><? if(!empty($page_title)): echo $page_title." &mdash; "; endif;?>The Bowdoin Orient</title>
	<link rel="shortcut icon" href="<?=base_url()?>img/o-32-transparent.png">
	
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
	
	<!-- for non-articles -->
	<? if($this->uri->segment(1) != "article"): ?>

		<!-- metadata -->
		<meta name="description" content="The Bowdoin Orient is a student-run publication dedicated to providing news and media relevant to the Bowdoin College community." />	
		<!-- Facebook Open Graph tags -->
		<meta property="og:title" content="<? if(!empty($page_title)): echo $page_title." - "; endif;?>The Bowdoin Orient" />
		<meta property="og:description" content="The Bowdoin Orient is a student-run publication dedicated to providing news and media relevant to the Bowdoin College community." />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="<?=base_url()?>img/o-200.png" />
		<meta property="og:url" content="http://bowdoinorient.com/" />
		<meta property="og:site_name" content="The Bowdoin Orient" />
		<meta property="fb:admins" content="1233600119" />
		<meta property="fb:app_id" content="342498109177441" />	

	<? endif; ?>
	
	<!-- for articles -->
	<? if($this->uri->segment(1) == "article"): ?>

		<!-- metadata -->
		<meta name="description" content="<?=htmlspecialchars(strip_tags($article->excerpt))?>" />	
		<!-- Facebook Open Graph tags -->
		<meta property="og:title" content="<?=htmlspecialchars($article->title)?>" />
		<meta property="og:description" content="<?=htmlspecialchars(strip_tags($article->excerpt))?>" />
		<meta property="og:type" content="article" />
		<? if($photos): ?>
			<meta property="og:image" content="<?=base_url()?>images/<?=$article->date?>/<?=$photos[0]->filename_large?>" />
		<? else: ?>
			<meta property="og:image" content="<?=base_url()?>img/o-200.png" />
		<? endif; ?>
		<meta property="og:url" content="http://bowdoinorient.com/article/<?=$article->id?>" />
		<meta property="og:site_name" content="The Bowdoin Orient" />
		<meta property="fb:admins" content="1233600119" />
		<meta property="fb:app_id" content="342498109177441" />
	
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