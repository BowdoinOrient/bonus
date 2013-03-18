<figure id="attachment<?=$id?>" class="articlemedia singlephoto <?= ($big ? 'bigphoto' : '') ?>">

	<? if(bonus()): ?>
		<div id="deleteAttachment<?=$id?>" class="delete">&times;</div>
		<div class="bigphotoEnable <?= ($big ? 'hide' : '') ?>">&#8689;</div>
		<div class="bigphotoDisable <?= ($big ? '' : 'hide') ?>">&#8690;</div>
	<? endif; ?>
	
	<? if($type == 'youtube'): ?>
		<iframe width="500" height="281" src="http://www.youtube.com/embed/<?=$content1?>?modestbranding=1&rel=0&showinfo=0&theme=light" frameborder="0" allowfullscreen></iframe>
	<? elseif($type == 'vimeo'): ?>
		<iframe src="http://player.vimeo.com/video/<?=$content1?>?portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<? endif; ?>
	
	<figcaption>
		<? if(!empty($author_id)): ?>
			<?if(bonus()):?>
				<p id="photocredit<?=$id?>" class="photocredit" contenteditable="true" title="Photographer"><?= $author_name; ?></p>
			<?else:?>
				<p id="photocredit<?=$id?>" class="photocredit">
					<?= anchor('author/'.$author_id, $author_id) ?>
				</p>
			<?endif;?>
		<? elseif(bonus()): ?>
			<p id="photocredit<?=$id?>" class="photocredit" contenteditable="true" title="Photographer"></p>
		<? endif; ?>
		<p id="photocaption<?=$id?>" class="photocaption" <?if(bonus()):?>contenteditable="true" title="Caption"<?endif;?>><?=$content2?></p>
	</figcaption>
	
</figure>
