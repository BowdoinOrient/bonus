<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>BONUS - Authors</title>
	<link rel="shortcut icon" href="<?=base_url()?>img/o-32-invert.png">
	<link rel="stylesheet" media="screen" href="<?=base_url()?>/css/bonus.css?v=1">
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://use.typekit.com/rmt0nbm.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>

<body>

<div id="container">

<header>
	<h1>/BONUS</h1>
</header>

<div id="content">
		
	<h2>Authors</h2>
	
	<nav>
	<ul>
	<li><?=anchor('bonus/dashboard','Dashboard')?></li>
	<li><?=anchor('bonus/authors','Authors')?></li>
	<li><?=anchor('bonus/alerts','Alerts')?></li>
	</ul>
	</nav>	

	<h3>Merge Authors</h3>
	
	<p>When adding an article or photo, BONUS users type a name and BONUS attempts to match the name to an existing author in the database. New authors are created in the background if a database entry does not exist.</p>

	<p>Because users enter names in different ways, we end up with duplicates in the database, which means fractured and incomplete author pages.</p>

	<p>Use this tool to merge two database entries that represent the same person.</p>

	<ul>
	<li>Names should not end in ", The Bowdoin Orient".</li>
	<li>Names of outside entities conventionally begin with "Courtesy of". This is awkward but OK.</li>
	<li>Names should use proper mixed-case: "Toph Tucker", not "TOPH TUCKER".</li>
	</ul>
	
	<script>
	function validateMergeForm()
	{
		var merge_from_value=document.forms["merge_authors"]["merge_from"].value;
		var merge_into_value=document.forms["merge_authors"]["merge_into"].value;
		if (merge_from_value==merge_into_value)
		{
			alert("You can't merge a name into itself, idiot!");
			return false;
		}
		return confirm('Are you sure you want to merge the first author into the second author? The first will be deleted. This cannot be undone!');
	}
	</script>
	<? 
		$attributes = array(
			'name' => 'merge_authors',
			'class' => 'merge_authors', 
			'id' => 'merge_authors',
			'onsubmit'	=> "return validateMergeForm()"
			);
		$hidden = array(
			'form_name'	=> 'merge_authors',
			);
		echo form_open('bonus/authors',$attributes,$hidden);
	?>
	Merge this name: <?=form_dropdown('merge_from', $authors_array, '')?> (which will be deleted)
	<br/>Into this name: <?=form_dropdown('merge_into', $authors_array, '')?>
	<?= form_submit('submit',"Merge authors") ?>
	<?= form_close() ?>

</div>
	
<footer>
	<p class="bonusquote">&ldquo;<?=$quote->quote?>&rdquo;</p>
	<p class="bonusquoteattribution">&mdash; <?=$quote->attribution?></p>
	<p class="sunbug"><a href="<?=base_url()?>">&#x2600;</a></p>
	<p class="about">Bowdoin Orient Network Update System 2.0</p>
</footer>

</div>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>