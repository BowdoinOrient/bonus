<? $this->load->view('template/head'); ?>

<body>

<? $this->load->view('template/bodyheader', $headerdata); ?>

<div id="content">
	
	<article id="mainstory">
		
		<header>
			<hgroup>
				<h2 id="articletitle" class="articletitle">Advanced Search <span style="font-variant:small-caps;color:gray;">beta</span></h2>
				<!--<h3 id="articlesubtitle" class="articlesubtitle"></h3>-->
			</hgroup>			
		</header>
		
		<div id="articlebody" class="articlebody">
		
			<form action="<?=site_url()?>advsearch" id="adv-search" method="get">
			
				<input class="" type="text" placeholder="Title" name="title" autofocus <? if(!empty($searchdata['title'])):?>value="<?= $searchdata['title'] ?>"<?endif;?>>
				
				<br/><input class="" type="text" placeholder="Author" name="author" <? if(!empty($searchdata['author'])):?>value="<?= $searchdata['author'] ?>"<?endif;?>>
				<input class="" type="text" placeholder="Series" name="series" <? if(!empty($searchdata['series'])):?>value="<?= $searchdata['series'] ?>"<?endif;?>>
				
				<br/><input class="" type="date" placeholder="Since date" name="since" <? if(!empty($searchdata['since'])):?>value="<?= $searchdata['since'] ?>"<?endif;?>>
				– <input class="" type="date" placeholder="Until date" name="until" <? if(!empty($searchdata['until'])):?>value="<?= $searchdata['until'] ?>"<?endif;?>>
				
				<br/>Featured: <?= form_checkbox('featured', 'featured', (!empty($searchdata['featured']))); ?>
				
				<br/><button id="submit" type="submit">Search</button>
				
			</form>			
 
		</div>
	  
	  	<? if(!empty($articles)): ?>
		<section id="results" class="">
			<h2>Results</h2>	
			<?/*
			<ul class="articleblock twotier">
				<? foreach($articles as $article): ?>
				<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?>"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$article->id?>">
					<div class="dateified"><?=date("F j, Y",strtotime($article->date))?></div>
					<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
					<?=$article->title?></h3>
					<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
					<div class="excerpt"><?=$article->excerpt?></div>
				</a></li>
				<? endforeach; ?>
			</ul> 
			*/?>
			<?$blocktype = array("type"=>1);?>
			<?$this->load->view('template/articleblock', $blocktype);?>

		</section>
		<? elseif(!empty($searchdata)): ?>
		<p>No results.</p>
		<? endif; ?>
	  
	  
	</article>

</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>