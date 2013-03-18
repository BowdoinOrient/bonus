<figure id="attachment<?=$attachment->id?>" class="articlemedia singlephoto <?= ($bigphoto ? 'bigphoto' : '') ?>">

	<? if(bonus()): ?>
		<div id="deleteAttachment<?=$attachment->id?>" class="delete">&times;</div>
		<div class="bigphotoEnable <?= ($bigphoto ? 'hide' : '') ?>">&#8689;</div>
		<div class="bigphotoDisable <?= ($bigphoto ? '' : 'hide') ?>">&#8690;</div>
	<? endif; ?>
	
	<? if($attachment->type == 'youtube'): ?>
		<iframe width="500" height="281" src="http://www.youtube.com/embed/<?=$attachment->content1?>" frameborder="0" allowfullscreen></iframe>
	<? elseif($attachment->type == 'vimeo'): ?>
		<iframe src="http://player.vimeo.com/video/<?=$attachment->content1?>?portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<? endif; ?>
	
	<figcaption>
		<? if(!empty($attachment->author_id)): ?>
			<?if(bonus()):?>
				<p id="photocredit<?=$attachment->id?>" class="photocredit" contenteditable="true" title="Photographer"><?= $attachment->author_name; ?></p>
			<?else:?>
				<p id="photocredit<?=$attachment->id?>" class="photocredit">
					<?= anchor('author/'.$attachment->author_id, $attachment->author_id) ?>
				</p>
			<?endif;?>
		<? elseif(bonus()): ?>
			<p id="photocredit<?=$attachment->id?>" class="photocredit" contenteditable="true" title="Photographer"></p>
		<? endif; ?>
		<p id="photocaption<?=$attachment->id?>" class="photocaption" <?if(bonus()):?>contenteditable="true" title="Caption"<?endif;?>><?=$attachment->content2?></p>
	</figcaption>
	
</figure>
