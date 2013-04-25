<?switch($type) {
	case "rightmargin":?>
		<?//from article.php:?>
		<ul class="articleblock rightmargin">
			<? foreach($series_next as $s_next): ?>
				<li class="<? if(!empty($s_next->filename_small)): ?> backgrounded<? endif; ?><? if(!$s_next->published): ?> draft<? endif; ?>"<? if(!empty($s_next->filename_small)): ?> style="background:url('<?=base_url().'images/'.$s_next->date.'/'.$s_next->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$s_next->id?>">
						<h3><? if($s_next->series): ?><span class="series"><?=$s_next->series?>:</span> <? endif; ?>
						<?=$s_next->title?></h3>
						<? if($s_next->subtitle): ?>
							<h4><?= $s_next->subtitle ?></h4><? endif; ?>
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
						<? if($s_prev->subtitle): ?>
							<h4><?= $s_prev->subtitle ?></h4><? endif; ?>
						<div class="excerpt"><?=$s_prev->excerpt?></div>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
	<?break;?>

	<?case "browsesection":?>
		<?//from browse.php - the real deal homepage article blocks:?>			
		<ul class="articleblock twotier">
			<? foreach($articles[$sectionname] as $article): ?>
				<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?><? if(strtotime($date)-strtotime($article->date) > (7*24*60*60)): ?> old<? endif; ?>"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$article->id?>">
						<div class="dateified"><?=dateify($article->date, $date)?></div>
						<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
						<?=$article->title?></h3>
						<? if($article->subtitle): ?>
							<h4><?= $article->subtitle ?></h4><? endif; ?>
						<div class="excerpt"><?=$article->excerpt?></div>
					</a>
				</li>
			<? endforeach; ?>
		</ul>
		<?break;?>


	<!-- 
	PARAMS:
	twotier: is it big
	blocks: list of articles to block out
	sectionname: the homepage function needs this
	rightmargin: for next series articles
	leftmargin: for previous series articles
	dateified: does it show a date
	medtile: is it medium-sized (body footer only, right now)
	dateoverlay: the "1 day ago" red overlay text
	 -->

	<?default:?>
		<ul class="articleblock <?if(isset($twotier)):?>twotier<?endif;?> <?if(isset($leftmargin)&&$leftmargin):?>leftmargin<?endif;?> <?if(isset($rightmargin)&&$rightmargin):?>rightmargin<?endif;?>">
			<?foreach($blocks as $block):?>
				<li class="<? if(!empty($block->filename_small)): ?> backgrounded<? endif; ?><? if(!$block->published): ?> draft<? endif; ?><? if(strtotime($date)-strtotime($block->date) > (7*24*60*60)): ?> old<? endif; ?><?if(isset($medtile)):?>medtile<?endif;?>"<? if(!empty($block->filename_small)): ?> style="background:url('<?=base_url().'images/'.$block->date.'/'.$block->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$block->id?>">
						<?if(isset($dateified)):?>
							<div class="dateified"><?=dateify($block->date, $date)?></div>
						<?endif;?>
						<h3><? if($block->series): ?><span class="series"><?=$block->series?>:</span> <? endif; ?><?=$block->title?></h3>
						<? if($block->subtitle): ?>
							<h4><?= $block->subtitle ?></h4><? endif; ?>
						<div class="excerpt"><?=$block->excerpt?></div>
					</a>
				</li>
			<?endforeach;?>
		</ul>
		<? break; ?>

<?}?>

