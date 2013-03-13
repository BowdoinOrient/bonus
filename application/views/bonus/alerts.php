<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>BONUS - Alerts</title>
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
		
	<h2>Alerts</h2>
	
	<nav>
	<ul>
	<li><?=anchor('bonus/dashboard','Dashboard')?></li>
	<li><?=anchor('bonus/authors','Authors')?></li>
	<li><?=anchor('bonus/alerts','Alerts')?></li>
	</ul>
	</nav>	

	<h3>Add Alert</h3>
	
	<?= form_open() ?>
	Message (HTML): 
	<br/><textarea width="30" height="2" name="message"></textarea>
	<br/>Start date: <input type="datetime" name="start_date" value="<?=date("Y-m-d H:i:s",time())?>">
	<br/>End date: <input type="datetime" name="end_date">
	<br/>Urgent: <input type="checkbox" name="urgent" value="1"/>
	<?= form_submit('submit',"Add alert") ?>
	<?= form_close() ?>
	
	
	<h3>Existing alerts</h3>
	
	<? if(!empty($alerts)): ?>
	<table>
	<tr>
		<th>Message</th>
		<th>Urgent?</th>
		<th>Start date</th>
		<th>End date</th>
		<th>Delete?</th>
	</tr>
	<? foreach($alerts as $alert): ?>
	<tr>
		<td><?=$alert->message; ?></td>
		<td><?=$alert->urgent; ?></td>
		<td><?=$alert->start_date; ?></td>
		<td><?=$alert->end_date; ?></td>
		<td><?=anchor('bonus/deletealert/'.$alert->id,'&times;',array('class'=>'delete','onClick'=>"return confirm('Are you sure you want to delete this alert?');"))?></td>
	<tr>
	<? endforeach; ?>
	</table>
	<? endif; ?>

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