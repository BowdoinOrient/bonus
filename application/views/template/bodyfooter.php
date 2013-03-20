	<? if(!empty($featured)): ?>
	<!-- FEATURED ARTICLES -->
	<section id="Featured" class="featured">
		<h2>★ Featured 
			<? if(substr(uri_string(),0,8)=="article/" && bonus()): ?> <input type="checkbox" name="featured" value="featured" <? if($article->featured): ?>checked="checked"<? endif; ?> /><?endif;?>
		</h2>
		<ul class="articleblock">
			<? foreach($featured as $article): ?>
			<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?> medtile"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
				<a href="<?=site_url()?>article/<?=$article->id?>">
				<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
				<?=$article->title?></h3>
				<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
				<div class="excerpt"><?=$article->excerpt?></div>
			</a></li>
			<? endforeach; ?>
		</ul>
	</section>
	<? endif; ?>

	<footer id="bodyfooter">
		
		<div id="vcard" class="vcard">
			<a class="fn org url" href="http://orient.bowdoin.edu" title="The Bowdoin Orient"><span class="organization-name">The Bowdoin Orient</span></a><br>
			<span class="adr">
				<span class="email"><a href="mailto:orient@bowdoin.edu">orient@bowdoin.edu</a></span><br>
				<span class="tel"><span class="value">(207) 725-3300</span></span><br>
				<span class="street-address">6200 College Station</span><br>
				<span class="locality">Brunswick</span>, <span class="region">Maine</span> <span class="postal-code">04011</span><br>
			</span>
			<div id="copyright"><small>&copy; <?=date("Y")?>, The Bowdoin Orient</a>. &ndash;30&ndash;</small></div>
		</div>
		
		<div id="footerlinks">
			<ul>
				<li><a href="<?=site_url()?>search">Search</a><span class="hidemobile"> <a href="<?=site_url()?>advsearch">(Adv)</a></span></li>
				<li><a href="<?=site_url()?>about">About</a></li>
				<!--<li><a href="<?=site_url()?>archives">Archives</a></li>-->
				<li><a href="<?=site_url()?>subscribe">Subscribe</a></li>
				<li><a href="<?=site_url()?>advertise">Advertise</a></li>
				<li><a href="<?=site_url()?>contact">Contact</a></li>
			</ul>
		</div>
		
		<div id="bonusquoteblock">
			<div class="bonusquote">&ldquo;<?=$quote->quote?>&rdquo;</div>
			<? if(!empty($quote->attribution)): ?><div class="bonusquoteattribution">&mdash; <?=$quote->attribution?><? if(!empty($quote->source)): ?> <a href="<?=$quote->source?>">↬</a><? endif; ?></div><? endif; ?>
		</div>
		
	</footer>
