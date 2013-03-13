<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>BONUS</title>
	<link rel="shortcut icon" href="<?=base_url()?>img/o-32-invert.png">
	<link rel="stylesheet" media="screen" href="<?=base_url()?>/css/bonus.css?v=1">
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://use.typekit.com/rmt0nbm.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<script type="text/javascript">
	var color = new String();
	var shadow = new String();
	var x=1;
	function blink()
	{
	 if(x%2) 
	 {
	  color = "rgb(255,0,0)";
	  shadow = "0 0 5px red";
	 }else{
	  color = "rgb(20,20,20)";
	  shadow = "none";
	 }

	 formerror.style.color = color;
	 formerror.style.textShadow = shadow;
	 x++;
	 if(x>2){x=1};
	 setTimeout("blink()",800);
	}
	</script>

</head>

<body onload="blink()">

<div id="container">

<header>
	<h1>/BONUS</h1>
</header>

<div id="content">
	
	<?= validation_errors('<div id="formerror" class="error">', '</div>'); ?>
	<?= form_open('bonus/verifylogin/',array('class' => 'loginform', 'id' => 'loginform')); ?>
		<input type="text" size="20" id="username" name="username" placeholder="Username" autofocus/><br/>
		<input type="password" size="20" id="passowrd" name="password" placeholder="Password"/><br/>
		<input type="hidden" name="referrer" value="<?=$referrer?>" />
		<button type="submit">Go</button>
	</form>

</div>
	
<footer>
	<p class="bonusquote">&ldquo;<?=$quote->quote?>&rdquo;</p>
	<p class="bonusquoteattribution">&mdash; <?=$quote->attribution?></p>
	<p class="sunbug"><a href="<?=base_url()?>">&#x2600;</a></p>
	<p class="about">Bowdoin Orient Network Update System 2.0</p>
</footer>

</div>

</body>

</html>