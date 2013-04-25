<?/*	
	<?//author.php:?>
	<ul class="articleblock">
		<? foreach($popular as $article): ?>
			<li class="smalltile fullwidth">
				<a href="<?=base_url()?>article/<?=$article->id?>">
					<h3><?=$article->title?></h3>
				</a>
			</li>
		<? endforeach; ?>
	</ul>
	
	<?//author.php:?>
	<ul class="articleblock">
		<? foreach($longreads as $article): ?>
			<li class="smalltile fullwidth">
				<a href="<?=base_url()?>article/<?=$article->id?>">
					<h3><?=$article->title?></h3>
				</a>
			</li>
		<? endforeach; ?>
	</ul>
	
	<?//author.php:?>
	<ul class="articleblock">
		<? foreach($collaborators as $collaborator): ?>
			<li class="smalltile fullwidth">
				<a href="<?=base_url()?>author/<?=$collaborator->author_id?>" title="<?=$collaborator->collab_count?> collaboration<?= ($collaborator->collab_count > 1 ? 's, including' : ':') ?> '<?=$collaborator->title?>' ">
					<h3><?=$collaborator->name?></h3>
				</a>
				<!-- $collaborator->article_id -->
			</li>
	<? endforeach; ?>
	</ul>
	
	<?//author.php:?>		
	<ul class="articleblock">
		<? foreach($series as $serie): ?>
			<li class="smalltile fullwidth">
				<a href="<?=base_url()?>series/<?=$serie->series?>">
					<h3><?=$serie->name?></h3>
				</a>
			</li>
		<? endforeach; ?>
	</ul>

	<?//series.php:?>			
	<ul class="articleblock">
		<? foreach($contributors as $contributor): ?>
			<li class="smalltile autoheight">
				<a href="<?=base_url()?>author/<?=$contributor->author_id?>" title="<?=$contributor->contrib_count?> contribution<?= ($contributor->contrib_count > 1 ? 's' : '') ?>">
					<h3><?=$contributor->name?></h3>
				</a>
			</li>
		<? endforeach; ?>
	</ul>
*/?>