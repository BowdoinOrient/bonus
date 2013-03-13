<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?=$author->name?> &mdash; The Bowdoin Orient</title>
	<link rel="shortcut icon" href="<?=base_url()?>img/o-32-transparent.png">
	
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/orient.css?v=3">
	
	<meta name="description" content="<?=htmlspecialchars($author->bio)?>" />
	
	<!-- Facebook Open Graph tags -->
	<meta property="og:title" content="<?=htmlspecialchars($author->name)?>" />
	<meta property="og:description" content="<?=htmlspecialchars($author->bio)?>" />
	<meta property="og:type" content="profile" />
	<meta property="og:image" content="<?=base_url()?>img/o-200.png" /> <!-- #TODO -->
	<meta property="og:url" content="http://bowdoinorient.com/author/<?=$author->id?>" />
	<meta property="og:site_name" content="The Bowdoin Orient" />
	<meta property="fb:admins" content="1233600119" />
	<meta property="fb:app_id" content="342498109177441" />
	
	<!-- for mobile -->
	<link rel="apple-touch-icon" href="<?=base_url()?>img/o-114.png"/>
	<meta name = "viewport" content = "initial-scale = 1.0, user-scalable = no">
	
	<!-- rss -->
	<link rel="alternate" type="application/rss+xml" title="<?=$author->name?> - The Bowdoin Orient" href="<?=base_url()?>rss/author/<?=$author->id?>" />
	
	<script type="text/javascript" src="http://use.typekit.com/rmt0nbm.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	<!-- jQuery -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url()?>js/jquery-1.8.0.min.js"></script> -->
	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>
	
	<!-- SwipeView (for slideshows) -->
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/swipeview.css?v=1">
	
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
				
		<? if(!empty($author->photo)): ?>
			<figure class="authorpic"><img src="<?=base_url().'images/authors/'.$author->photo?>"></figure>
		<? endif; ?>
				
		<div class="authorstats">
			<h2 class="authorname"><?=$author->name?></h2>
			
			<? if($stats['article_count']): ?><strong>Number of articles:</strong> <?= $stats['article_count'] ?><br/><? endif; ?>
			<? if($stats['photo_count']): ?><strong>Number of photos:</strong> <?= $stats['photo_count'] ?><br/><? endif; ?>
			<? if($stats['first_article']): ?><strong>First article:</strong> <?= date("F j, Y",strtotime($stats['first_article'])) ?><br/><? endif; ?>
			<? if($stats['latest_article']): ?><strong>Latest article:</strong> <?= date("F j, Y",strtotime($stats['latest_article'])) ?><br/><? endif; ?>
			<? if($stats['first_photo']): ?><strong>First image:</strong> <?= date("F j, Y",strtotime($stats['first_photo'])) ?><br/><? endif; ?>
			<? if($stats['latest_photo']): ?><strong>Latest image:</strong> <?= date("F j, Y",strtotime($stats['latest_photo'])) ?><br/><? endif; ?>
			<br/>
			<? if(!empty($author->bio)): ?><?= $author->bio ?><? endif; ?>
		</div>
		
		<? if(count($photos) > 1): ?>
			<figure class="articlemedia">
				<div id="swipeview_wrapper" class="author-swipeview"></div>
				<div id="swipeview_relative_nav">
					<span id="prev" onclick="carousel.prev();hasInteracted=true">&laquo;</span>
					<span id="next" onclick="carousel.next();hasInteracted=true">&raquo;</span>
				</div>
				<ul id="swipeview_nav">
					<? foreach($photos as $key => $photo): ?>
					<li <? if($key==0): ?>class="selected"<? endif; ?> onclick="carousel.goToPage(<?=$key; ?>);hasInteracted=true"></li>
					<? endforeach; ?>
				</ul>
			</figure>
		<? endif; ?>
		
	</header>
		
	<section id="articles" class="authorsection">

		<?php
		// calculated widths of divs depending on how many columns we'll have
		$columns = 0;
		$colwidth = 100;
		if(!empty($popular)) $columns++;
		if(!empty($longreads)) $columns++;
		if(!empty($collaborators)) $columns++;
		if(!empty($series)) $columns++;
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

		<? if(!empty($popular)): ?>
		<div class="statblock">
			<h2>Popular</h2>
			<ul class="articleblock">
			<? foreach($popular as $article): ?>
				<li class="smalltile fullwidth"><a href="<?=base_url()?>article/<?=$article->id?>"><h3><?=$article->title?></h3></a></li>
			<? endforeach; ?>
			</ul>
		</div>
		<? endif; ?>
		
		<? if(!empty($longreads)): ?>
		<div class="statblock">
			<h2>Longreads</h2>
			<ul class="articleblock">
			<? foreach($longreads as $article): ?>
				<li class="smalltile fullwidth"><a href="<?=base_url()?>article/<?=$article->id?>"><h3><?=$article->title?></h3></a></li>
			<? endforeach; ?>
			</ul>
		</div>
		<? endif; ?>
		
		<? if(!empty($collaborators)): ?>
		<div class="statblock">
			<h2>Collaborators</h2>
			<ul class="articleblock">
			<? foreach($collaborators as $collaborator): ?>
				<li class="smalltile fullwidth"><a href="<?=base_url()?>author/<?=$collaborator->author_id?>" title="<?=$collaborator->collab_count?> collaboration<?= ($collaborator->collab_count > 1 ? 's, including' : ':') ?> '<?=$collaborator->title?>' "><h3><?=$collaborator->name?></h3></a><!-- $collaborator->article_id --></li>
			<? endforeach; ?>
			</ul>
		</div>
		<? endif; ?>
		
		<? if(!empty($series)): ?>
		<div class="statblock">
			<h2>Columns</h2>
			<ul class="articleblock">
			<? foreach($series as $serie): ?>
				<li class="smalltile fullwidth"><a href="<?=base_url()?>series/<?=$serie->series?>"><h3><?=$serie->name?></h3></a></li>
			<? endforeach; ?>
			</ul>
		</div>
		<? endif; ?>
		
		<div class="clear"></div>
		
		<? if(!empty($articles)): ?>
		<h2>All articles</h2>
		<ul class="articleblock twotier">
			<? foreach($articles as $article): ?>
			<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?>"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
				<a href="<?=site_url()?>article/<?=$article->id?>">
				<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
				<?=$article->title?></h3>
				<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
				<div class="excerpt"><?=$article->excerpt?></div>
			</a></li>
			<? endforeach; ?>
		</ul>
		<? endif; ?>
		
	</section>
	
</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

<? if(count($photos) > 1): ?>
	<!-- SwipeView. Only needed for slideshows. -->
	<script type="text/javascript" src="<?= base_url() ?>js/swipeview-mwidmann.js"></script>
	<script type="text/javascript">
	var	carousel,
		el,
		i,
		page,
		hasInteracted = false,
		dots = document.querySelectorAll('#swipeview_nav li'),
		slides = [
			<? foreach($photos as $key => $photo): ?>
				<? if($key > 0): ?>,<? endif; ?>
				'<div class="swipeview-image" style="background:url(<?= base_url() ?>images/<?= $photo->date ?>/<?= $photo->filename_large ?>)"></div>'
					+'<figcaption>'
					+ '<p class="photocaption"><?= addslashes(trim(str_replace(array("\r\n", "\n", "\r"),"<br/>",$photo->caption))); ?> <?= anchor("article/".$photo->article_id, addslashes(trim($photo->title))) ?></p>'
					+'</figcaption>'
			<? endforeach; ?>
		];
	
	carousel = new SwipeView('#swipeview_wrapper', {
		numberOfPages: slides.length,
		hastyPageFlip: true
	});
	
	// Load initial data
	for (i=0; i<3; i++) {
		page = i==0 ? slides.length-1 : i-1;
	
		el = document.createElement('span');
		el.innerHTML = slides[page];
		carousel.masterPages[i].appendChild(el)
	}
	
	carousel.onFlip(function () {
		var el,
			upcoming,
			i;
	
		for (i=0; i<3; i++) {
			upcoming = carousel.masterPages[i].dataset.upcomingPageIndex;
	
			if (upcoming != carousel.masterPages[i].dataset.pageIndex) {
				el = carousel.masterPages[i].querySelector('span');
				el.innerHTML = slides[upcoming];
			}
		}
		
		document.querySelector('#swipeview_nav .selected').className = '';
		dots[carousel.pageIndex].className = 'selected';
	});
	
	
	// timer for carousel autoplay
	function loaded() {
		var interval = setInterval(function () { 
				if(!hasInteracted) carousel.next(); 
			}, 5000); 
		
	}
	document.addEventListener('DOMContentLoaded', loaded, false);
	
	</script>
<? endif; ?>

</body>

</html>