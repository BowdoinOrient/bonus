<?switch($type) {
	case "searchresult":?>
		<?//from advsearch.php: ?>
		<ul class="articleblock twotier">
			<? foreach($articles as $article): ?>
				<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?>"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$article->id?>">
						<div class="dateified"><?=date("F j, Y",strtotime($article->date))?></div>
						<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
						<?=$article->title?></h3>
						<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
						<div class="excerpt"><?=$article->excerpt?></div>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
		<?break;?>

	<?case "rightmargin":?>
		<?//from article.php:?>
		<ul class="articleblock rightmargin">
			<? foreach($series_next as $s_next): ?>
				<li class="<? if(!empty($s_next->filename_small)): ?> backgrounded<? endif; ?><? if(!$s_next->published): ?> draft<? endif; ?>"<? if(!empty($s_next->filename_small)): ?> style="background:url('<?=base_url().'images/'.$s_next->date.'/'.$s_next->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$s_next->id?>">
						<h3><? if($s_next->series): ?><span class="series"><?=$s_next->series?>:</span> <? endif; ?>
						<?=$s_next->title?></h3>
						<? if($s_next->subtitle): ?><h4><?= $s_next->subtitle ?></h4><? endif; ?>
						<div class="excerpt"><?=$s_next->excerpt?></div>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
		<?break;?>

	<?case "leftmargin":?>
		<?//from article.php: ?>
		<ul class="articleblock leftmargin">
			<? foreach($series_previous as $s_prev): ?>
				<li class="<? if(!empty($s_prev->filename_small)): ?> backgrounded<? endif; ?><? if(!$s_prev->published): ?> draft<? endif; ?>"<? if(!empty($s_prev->filename_small)): ?> style="background:url('<?=base_url().'images/'.$s_prev->date.'/'.$s_prev->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$s_prev->id?>">
						<h3><? if($s_prev->series): ?><span class="series"><?=$s_prev->series?>:</span> <? endif; ?>
						<?=$s_prev->title?></h3>
						<? if($s_prev->subtitle): ?><h4><?= $s_prev->subtitle ?></h4><? endif; ?>
						<div class="excerpt"><?=$s_prev->excerpt?></div>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
	<?break;?>

	<?case "authorpage":?>
		<?//author.php:?>
		<ul class="articleblock twotier">
			<? foreach($articles as $article): ?>
				<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?>"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$article->id?>">
						<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
						<?=$article->title?></h3>
						<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
						<div class="excerpt"><?=$article->excerpt?></div>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
		<?break;?>

	<?case "browselatest":?>
		<?//from browse.php - the "latest" blocks above the fold:?>
		<ul class="articleblock">
			<? foreach($latest as $article): ?>
				<li class="smalltile">
					<a href="<?=site_url()?>article/<?=$article->id?>">
						<div class="dateified"><?=dateify($article->date, $date)?></div>
						<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
						<?=$article->title?></h3>
						<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
						<div class="excerpt"><?=$article->excerpt?></div>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
		<?break;?>

	<?case "browsesection":?>
		<?//from browse.php - the real deal homepage article blocks:?>			
		<ul class="articleblock twotier">
			<? foreach($articles[$section->name] as $article): ?>
				<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?><? if(strtotime($date)-strtotime($article->date) > (7*24*60*60)): ?> old<? endif; ?>"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$article->id?>">
						<div class="dateified"><?=dateify($article->date, $date)?></div>
						<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
						<?=$article->title?></h3>
						<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
						<div class="excerpt"><?=$article->excerpt?></div>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
		<?break;?>

<?}?>

<?/*	



	

	

//series.php:				
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
//template/bodyfooter.php:	
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

//Five of these things are not like the others: They're not really full-fledged $('.articleblock')s, so I'm going to leave them out of this overhaul
//Future refactor: make a view template for $('.smalltile')?
//author.php:
	<ul class="articleblock">
		<? foreach($popular as $article): ?>
		<li class="smalltile fullwidth"><a href="<?=base_url()?>article/<?=$article->id?>"><h3><?=$article->title?></h3></a></li>
	<? endforeach; ?>
	</ul>
//author.php:
	<ul class="articleblock">
		<? foreach($longreads as $article): ?>
		<li class="smalltile fullwidth"><a href="<?=base_url()?>article/<?=$article->id?>"><h3><?=$article->title?></h3></a></li>
	<? endforeach; ?>
	</ul>
//author.php:
	<ul class="articleblock">
		<? foreach($collaborators as $collaborator): ?>
		<li class="smalltile fullwidth"><a href="<?=base_url()?>author/<?=$collaborator->author_id?>" title="<?=$collaborator->collab_count?> collaboration<?= ($collaborator->collab_count > 1 ? 's, including' : ':') ?> '<?=$collaborator->title?>' "><h3><?=$collaborator->name?></h3></a><!-- $collaborator->article_id --></li>
	<? endforeach; ?>
	</ul>
//author.php:				
	<ul class="articleblock">
		<? foreach($series as $serie): ?>
		<li class="smalltile fullwidth"><a href="<?=base_url()?>series/<?=$serie->series?>"><h3><?=$serie->name?></h3></a></li>
	<? endforeach; ?>
	</ul>
//series.php:				
	<ul class="articleblock">
		<? foreach($contributors as $contributor): ?>
		<li class="smalltile autoheight"><a href="<?=base_url()?>author/<?=$contributor->author_id?>" title="<?=$contributor->contrib_count?> contribution<?= ($contributor->contrib_count > 1 ? 's' : '') ?>">
			<h3><?=$contributor->name?></h3>
		</a></li>
	<? endforeach; ?>
	</ul>

*/?>
