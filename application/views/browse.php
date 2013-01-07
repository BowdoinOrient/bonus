<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>The Bowdoin Orient</title>
	<link rel="shortcut icon" href="<?=base_url()?>images/o-32-transparent.png">
	
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/orient2012.css?v=4">
	
	<meta name="description" content="The Bowdoin Orient is a student-run publication dedicated to providing news and media relevant to the Bowdoin College community." />
	
	<!-- Facebook Open Graph tags -->
	<meta property="og:title" content="The Bowdoin Orient" />
	<meta property="og:description" content="The Bowdoin Orient is a student-run publication dedicated to providing news and media relevant to the Bowdoin College community." />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?=base_url()?>images/o-200.png" />
	<meta property="og:url" content="http://bowdoinorient.com/" />
	<meta property="og:site_name" content="The Bowdoin Orient" />
	<meta property="fb:admins" content="1233600119" />
	<meta property="fb:app_id" content="342498109177441" />
	<!--<meta property="fb:page_id" content="113269185373845" />-->
	
	<!-- for mobile -->
	<link rel="apple-touch-icon" href="<?=base_url()?>images/o-114.png"/>
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
	
	<!-- initiate jQuery and the LocalScroll plugin -->
    <script>
 
    // When the document is loaded...
    $(document).ready(function()
    {
        // Set up localScroll smooth scroller to scroll the whole document
        $('#mainnav').localScroll({
           target:'body',
           duration: '1000' //uh, not sure this is working!
        });
 		
    });
    
    </script>
	
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

<? $this->load->view('bodyheader', $headerdata); ?>

<div id="content">
	
	<section id="abovethefold" class="">
		
		<!-- carousel -->
		<div id="carousel">
			<div id="swipeview_wrapper"></div>
			<div id="swipeview_relative_nav">
				<span id="prev" onclick="carousel.prev();hasInteracted=true">&laquo;</span>
				<span id="next" onclick="carousel.next();hasInteracted=true">&raquo;</span>
			</div>
			<ul id="swipeview_nav">
				<? foreach($featured as $key => $article): ?>
				<li <? if($key==0): ?>class="selected"<? endif; ?> onclick="carousel.goToPage(<?=$key?>);hasInteracted=true"></li>
				<? endforeach; ?>
			</ul>			
		</div>
		
		<!-- tweets -->
		<div id="twitter-widget" class="hidetablet">
			<h2><a href="https://twitter.com/bowdoinorient">Twitter ↦</a></h2>
			<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script>
			new TWTR.Widget({
			  version: 2,
			  type: 'profile',
			  rpp: 10,
			  interval: 5000,
			  width: 'auto',
			  height: 390,
			  theme: {
				shell: {
				  background: 'transparent',
				  color: '#000000'
				},
				tweets: {
				  background: 'transparent',
				  color: '#555',
				  links: '#00008B'
				}
			  },
			  features: {
				scrollbar: true,
				loop: false,
				live: true,
				behavior: 'default'
			  }
			}).render().setUser('bowdoinorient').start();
			</script>
		</div>
		
		<!-- popular articles -->
		<div id="popular">
			<h2>Popular</h2>
			<ul class="articleblock">
				<? foreach($popular as $article): ?>
				<li class="smalltile">
					<a href="<?=site_url()?>article/<?=$article->id?>">
					<div class="dateified"><?=dateify($article->date, $date)?></div>
					<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
					<?=$article->title?></h3>
					<? if($article->subhead): ?><h4><?= $article->subhead ?></h4><? endif; ?>
					<p><?=$article->pullquote?></p>
				</a></li>
				<? endforeach; ?>
			</ul>
		</div>
		
	</section>
	
	<!-- Below-the-fold sidebar -->
	<div id="sidebar" class="hidetablet">
			
		<!-- Begin MailChimp Signup Form -->
		<div id="mc_embed_signup">
			<form action="http://bowdoinorient.us4.list-manage.com/subscribe/post?u=eab94f63abe221b2ef4a4baec&amp;id=739fef0bb9" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<h2 style="margin-top:0">Weekly newsletter</h2>
			<div class="mc-field-group">
				<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email address">
				<input type="submit" value="Subscribe, free" name="subscribe" id="mc-embedded-subscribe" class="button">
			</div>
		</div>
		<!-- end MailChimp -->
		
		<!-- Scribd issue download -->
		<? if($scribd_thumb_url): ?>
		<h2>Download issue</h2>
		<div class="scribd_block">
			<a href="http://www.scribd.com/doc/<?=$issue->scribd?>" target="new">
			<img src="<?=$scribd_thumb_url?>" class="issue_thumb">
			Volume <?=$issue->volume;?><br/>
			Number <?=$issue->issue_number;?><br/>
			<?=date("F j, Y",strtotime($issue->issue_date))?>
			</a>
		</div>
		<? endif; ?>
		<!-- end Scribd -->
		
		<!-- Disqus recent comments -->
		<div id="recentcomments" class="dsq-widget">
			<h2 class="dsq-widget-title">Recent Comments</h2>
			<script type="text/javascript" src="http://disqus.com/forums/bowdoinorient/recent_comments_widget.js?num_items=8&hide_avatars=1&avatar_size=24&excerpt_length=140"></script>
		</div>
		<!-- End Disqus -->
		
		<!-- Plancast events -->
		<script type="text/javascript" src="http://plancast.com/goodies/widgets/sidebar/1/43729"></script>
				
	</div>
	
	<? foreach($sections as $section): ?>
		
		<? if(!empty($articles[$section->name])): ?>
		
		<section id="<?=$section->name?>" class="issuesection">
			<h2><?=$section->name?></h2>
			
			<ul class="articleblock">
				<? foreach($articles[$section->name] as $article): ?>
				<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?><? if(strtotime($date)-strtotime($article->date) > (7*24*60*60)): ?> old<? endif; ?>"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$article->id?>">
					<div class="dateified"><?=dateify($article->date, $date)?></div>
					<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
					<?=$article->title?></h3>
					<? if($article->subhead): ?><h4><?= $article->subhead ?></h4><? endif; ?>
					<p><?=$article->pullquote?></p>
				</a></li>
				<? endforeach; ?>
				<? if(bonus()): ?>
				<li class=""><a href="<?=site_url()?>article/add/<?=$issue->volume?>/<?=$issue->issue_number?>/<?=$section->id?>"><h3 class="addarticle">+ Add article</h3></a></li>
				<? endif; ?>
			</ul>
			
		</section>
		
		<? endif; ?>
	
	<? endforeach; ?>
	
	
	
</div>

<? $this->load->view('bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

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
		<? foreach($featured as $key => $article): ?>
			<? if($key > 0): ?>,<? endif; ?>
			'<div class="carouseltile <? if(!$article->published): ?>draft<?endif;?>">'+
				<? if($article->series): ?>'<div class="series"><?=$article->series?></div>'+<? endif; ?>
				'<a href="<?=site_url()?>article/<?=$article->id?>"><h3><?= addslashes(trim($article->title)) ?></h3></a>'+
				<? if($article->subhead): ?>'<h4 class="articlesubtitle"><?= addslashes(trim($article->subhead)) ?></h4>'+<? endif; ?>
				<? if(!empty($article->filename_small)): ?>'<img src="<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>">'+<? endif; ?>
				<? if(!empty($article->author)): ?>'<div class="authortile hidemobile"><p class="articleauthor"><?=addslashes($article->author)?></p></div>'+<? endif; ?>
				'<p class="articledate hidemobile"><time pubdate datetime="<?=$article->date?>"><?=date("F j, Y",strtotime($article->date))?></time></p>'+
				'<p><?= addslashes(trim(str_replace(array("\r\n", "\n", "\r"),"<br/>",$article->pullquote))); ?></p>'+
			'</div>'
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

</body>

</html>