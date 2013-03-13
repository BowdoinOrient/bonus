<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?=$series->name?> &mdash; The Bowdoin Orient</title>
	<link rel="shortcut icon" href="<?=base_url()?>img/o-32-transparent.png">
	
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/orient.css?v=2">
	
	<meta name="description" content="<?=htmlspecialchars($series->description)?>" />
	
	<!-- Facebook Open Graph tags -->
	<meta property="og:title" content="<?=htmlspecialchars($series->name)?>" />
	<meta property="og:description" content="<?=htmlspecialchars($series->description)?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?=base_url()?>img/o-200.png" /> <!-- #todo -->
	<meta property="og:url" content="http://bowdoinorient.com/series/<?=$series->id?>" />
	<meta property="og:site_name" content="The Bowdoin Orient" />
	<meta property="fb:admins" content="1233600119" />
	<meta property="fb:app_id" content="342498109177441" />
	
	<!-- for mobile -->
	<link rel="apple-touch-icon" href="<?=base_url()?>img/o-114.png"/>
	<meta name = "viewport" content = "initial-scale = 1.0, user-scalable = no">
	
	<!-- rss -->
	<link rel="alternate" type="application/rss+xml" title="<?=$series->name?> - The Bowdoin Orient" href="<?=base_url()?>rss/series/<?=$series->id?>" />
	
	<script type="text/javascript" src="http://use.typekit.com/rmt0nbm.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	<!-- jQuery -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url()?>js/jquery-1.8.0.min.js"></script> -->
	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>
	
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

<body>

<? $this->load->view('template/bodyheader', $headerdata); ?>

<div id="content">
			
	<header class="authorheader">
				
		<? if(!empty($series->photo)): ?>
			<figure class="authorpic"><img src="<?=base_url().'images/series/'.$series->photo?>"></figure>
		<? endif; ?>
		
			<!-- MARGIN-BOTTOM HERE IS TEMPORARY UNTIL HEADER GETS FLESHED OUT -->
		<div class="authorstats" style="margin-bottom:0!important;">
			<h2 class="authorname"><?=$series->name?></h2>
			
			<? if(!empty($series->description)): ?><?= $series->description ?><? endif; ?>
		</div>
				
	</header>
	
	<section id="articles" class="seriessection">
		
		<?php
		// calculated widths of divs depending on how many columns we'll have
		$columns = 0;
		$colwidth = 100;
		if(!empty($contributors)) $columns++;
		if($columns) $colwidth=(1/$columns)*100;
		?>
		<style>
		/* FOR NON-TABLETS */
			@media all and (min-width: 961px) {
			.statblock {
				width: <?=$colwidth?>%;
			}
		}
		</style>
		
		<? if(!empty($contributors)): ?>
		<div class="statblock">
			<h2>Contributors</h2>
			<ul class="articleblock">
			<? foreach($contributors as $contributor): ?>
				<li class="smalltile autoheight"><a href="<?=base_url()?>author/<?=$contributor->author_id?>" title="<?=$contributor->contrib_count?> contribution<?= ($contributor->contrib_count > 1 ? 's' : '') ?>">
					<h3><?=$contributor->name?></h3>
				</a></li>
			<? endforeach; ?>
			</ul>
		</div>
		<? endif; ?>
		
		<h2>All articles</h2>
		<ul class="articleblock twotier">
			<? foreach($articles as $article): ?>
			<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?>"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
				<a href="<?=site_url()?>article/<?=$article->id?>">
				<h3><?=$article->title?></h3>
				<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
				<div class="excerpt"><?=$article->excerpt?></div>
			</a></li>
			<? endforeach; ?>
		</ul>
		
	</section>
	
</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>