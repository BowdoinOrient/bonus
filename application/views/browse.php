<? $this->load->view('template/head'); ?>

<body>

<? $this->load->view('template/bodyheader', $headerdata); ?>

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
				<? foreach($popular as $key => $article): ?>
				<li <? if($key==0): ?>class="selected"<? endif; ?> onclick="carousel.goToPage(<?=$key?>);hasInteracted=true"></li>
				<? endforeach; ?>
			</ul>			
		</div>
		
		<!-- tweets -->
		<div id="twitter-widget" class="hidetablet">
			<a class="twitter-timeline" href="https://twitter.com/bowdoinorient" data-widget-id="265861494951002113">Tweets by @bowdoinorient</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		
		<!-- latest articles -->
		<div id="latest">
			<h2>Latest</h2>
			<?$blocktype = array("type"=>"browselatest");
			$this->load->view('template/articleblock', $blocktype);?>
		</div>
		
	</section>
	
	<!-- Below-the-fold sidebar -->
	<div id="sidebar" class="hidetablet">
			
		<!-- Begin MailChimp Signup Form -->
		<div id="mc_embed_signup">
			<form action="http://bowdoinorient.us4.list-manage.com/subscribe/post?u=eab94f63abe221b2ef4a4baec&amp;id=739fef0bb9" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<h2 style="margin-top:0;margin-bottom:5px;">Weekly newsletter</h2>
			<div class="mc-field-group">
				<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email address">
				<input type="submit" value="Subscribe, free" name="subscribe" id="mc-embedded-subscribe" class="button">
			</div>
			</form>
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
	
	<!-- SECTIONS -->
	<? foreach($sections as $section): ?>
		<? if(!empty($articles[$section->name])): ?>
		<section id="<?=$section->name?>" class="issuesection">
			<h2><?=$section->name?><? if(bonus()): ?><a href="<?=site_url()?>article/add/<?=$issue->volume?>/<?=$issue->issue_number?>/<?=$section->id?>"><button class="bonusbutton" id="addarticlebutton">Add article</button></a><? endif; ?></h2>
			<?$blocktype = array("type"=>"browsesection","sectionname"=>$section->name);?>
			<?$this->load->view('template/articleblock', $blocktype);?>
		</section>
		<? endif; ?>
	<? endforeach; ?>
		
</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

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
		<? foreach($popular as $key => $article): ?>
			<? if($key > 0): ?>,<? endif; ?>
			'<div class="carouseltile <? if(!$article->published): ?>draft<?endif;?>">'
				+'<div class="articletitle-group">'
				<? if($article->series): ?>+'<div class="series"><?=anchor('series/'.$article->series_id,$article->series); ?></div>'<? endif; ?>
				+'<a href="<?=site_url()?>article/<?=$article->id?>"><h3><?= addslashes(trim(str_replace(array("\r\n", "\n", "\r")," ",$article->title))); ?></h3></a>'
				<? if($article->subtitle): ?>+'<h4 class="articlesubtitle"><?= addslashes(trim(str_replace(array("\r\n", "\n", "\r")," ",$article->subtitle))); ?></h4>'<? endif; ?>
				+'</div>'
				<? if(!empty($article->filename_small)): ?>+'<img src="<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>">'<? endif; ?>
				+'<div class="article-author-date">'
				<? if(!empty($article->author)): ?>+'<a href="<?=base_url()?>author/<?=$article->author_id?>"><div class="authortile hidemobile"><p class="articleauthor"><?=addslashes($article->author)?></p></div></a>'<? endif; ?>
				+'<p class="articledate hidemobile"><time pubdate datetime="<?=$article->date?>"><?=date("F j, Y",strtotime($article->date))?></time></p>'
				+'</div>'
				+'<div class="excerpt"><?= addslashes(trim(str_replace(array("\r\n", "\n", "\r"),"<br/>",$article->excerpt))); ?></div>'
			+'</div>'
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

<script type="text/javascript">
  var _sf_async_config = { uid: 45947, domain: 'bowdoinorient.com' };
  (function() {
    function loadChartbeat() {
      window._sf_endpt = (new Date()).getTime();
      var e = document.createElement('script');
      e.setAttribute('language', 'javascript');
      e.setAttribute('type', 'text/javascript');
      e.setAttribute('src',
        (("https:" == document.location.protocol) ? "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" : "http://static.chartbeat.com/") +
        "js/chartbeat.js");
      document.body.appendChild(e);
    };
    var oldonload = window.onload;
    window.onload = (typeof window.onload != 'function') ?
      loadChartbeat : function() { oldonload(); loadChartbeat(); };
  })();
</script>

</body>

</html>