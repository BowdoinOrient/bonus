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
</head>

<body>

<div id="container">

<header>
	<h1>/BONUS</h1>
</header>

<div id="content">
	
	<h2>Dashboard</h2>
	
	<nav>
	<ul>
	<li><?=anchor('bonus/dashboard','Dashboard')?></li>
	<li><?=anchor('bonus/authors','Authors')?></li>
	<li><?=anchor('bonus/alerts','Alerts')?></li>
	</ul>
	</nav>	
		
	<h3>Tips</h3>
	
	<table>
		<tr>
			<th>Tip</th>
			<th>From</th>
		</tr>
		<? if(!empty($tips)): ?>
			<? foreach($tips as $tip): ?>
				<tr>
					<td><strong><?= $tip->prompt ?>: </strong><?= $tip->tip ?></td>
					<td><small>
						<?= date("F j, Y h:i:s a",strtotime($tip->submitted)) ?>
						<? if(!empty($tip->user_location)): ?><br/><strong>From:</strong> <?= anchor($tip->user_location,$tip->user_location) ?><? endif; ?>
						<? if(!empty($tip->user_referer)): ?><br/><strong>Via:</strong> <?= anchor($tip->user_referer,$tip->user_referer) ?><? endif; ?>
						<? if(!empty($tip->user_ip)): ?><br/><strong>IP address:</strong> <?= $tip->user_ip ?><? endif; ?>
						<? if(!empty($tip->user_host)): ?><br/><strong>IP host:</strong> <?= $tip->user_host ?><? endif; ?>
						<? if(!empty($tip->user_agent)): ?><br/><strong>System info:</strong> <?= $tip->user_agent ?><? endif; ?>
					</small></td>
				</tr>
			<? endforeach; ?>
		<? endif; ?>
	</table>

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