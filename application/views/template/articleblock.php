//this is what it looks like inside a section on the browse page

				<li class="<? if(!empty($article->filename_small)): ?> backgrounded<? endif; ?><? if(!$article->published): ?> draft<? endif; ?><? if(strtotime($date)-strtotime($article->date) > (7*24*60*60)): ?> old<? endif; ?>"<? if(!empty($article->filename_small)): ?> style="background:url('<?=base_url().'images/'.$article->date.'/'.$article->filename_small?>')"<? endif; ?>>
					<a href="<?=site_url()?>article/<?=$article->id?>">
					<div class="dateified"><?=dateify($article->date, $date)?></div>
					<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
					<?=$article->title?></h3>
					<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
					<div class="excerpt"><?=$article->excerpt?></div>
				</a></li>

//and here in the "latest articles" section on the browse page

				<li class="smalltile">
					<a href="<?=site_url()?>article/<?=$article->id?>">
					<div class="dateified"><?=dateify($article->date, $date)?></div>
					<h3><? if($article->series): ?><span class="series"><?=$article->series?>:</span> <? endif; ?>
					<?=$article->title?></h3>
					<? if($article->subtitle): ?><h4><?= $article->subtitle ?></h4><? endif; ?>
					<div class="excerpt"><?=$article->excerpt?></div>
				</a></li>

//the previous story on the article page
<li class="<? if(!empty($s_prev->filename_small)): ?> backgrounded<? endif; ?><? if(!$s_prev->published): ?> draft<? endif; ?>"<? if(!empty($s_prev->filename_small)): ?> style="background:url('<?=base_url().'images/'.$s_prev->date.'/'.$s_prev->filename_small?>')"<? endif; ?>>
		<a href="<?=site_url()?>article/<?=$s_prev->id?>">
		  <!--<div class="dateified"><?=dateify($s_prev->date)?></div>-->
		  <h3><? if($s_prev->series): ?><span class="series"><?=$s_prev->series?>:</span> <? endif; ?>
		    <?=$s_prev->title?></h3>
		  <? if($s_prev->subtitle): ?><h4><?= $s_prev->subtitle ?></h4><? endif; ?>
		  <div class="excerpt"><?=$s_prev->excerpt?></div>
		</a></li>

//and the next story

	      <li class="<? if(!empty($s_next->filename_small)): ?> backgrounded<? endif; ?><? if(!$s_next->published): ?> draft<? endif; ?>"<? if(!empty($s_next->filename_small)): ?> style="background:url('<?=base_url().'images/'.$s_next->date.'/'.$s_next->filename_small?>')"<? endif; ?>>
		<a href="<?=site_url()?>article/<?=$s_next->id?>">
		  <!--<div class="dateified"><?=dateify($s_next->date)?></div>-->
		  <h3><? if($s_next->series): ?><span class="series"><?=$s_next->series?>:</span> <? endif; ?>
		    <?=$s_next->title?></h3>
		  <? if($s_next->subtitle): ?><h4><?= $s_next->subtitle ?></h4><? endif; ?>
		  <div class="excerpt"><?=$s_next->excerpt?></div>
		</a></li>