<? $this->load->view('template/head'); ?>

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
		<?$blocktype = array("type"=>"seriespage");
		$this->load->view('template/articleblock', $blocktype);?>	
		<?/*$blockparams = array(
			"type"=>"new",
			"twotier"=>TRUE,
			"rightmargin"=>FALSE,
			"dateified"=>FALSE);
		$this->load->view('template/articleblock', $blockparams);*/?>	
	</section>
	
</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>