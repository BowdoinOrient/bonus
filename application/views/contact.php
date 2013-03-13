<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Contact us - The Bowdoin Orient</title>
	<link rel="shortcut icon" href="<?=base_url()?>img/favicon-o.png">
	
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/orient.css?v=2">
	
	<!-- jQuery -->
	<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script> -->
	<script type="text/javascript" src="<?=base_url()?>js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery.scrollTo-min.js"></script>
	
	<!-- for mobile -->
	<link rel="apple-touch-icon" href="<?=base_url()?>img/webappicon.png"/>
	<meta name = "viewport" content = "initial-scale = 1.0, user-scalable = no">
		
	<script type="text/javascript" src="http://use.typekit.com/rmt0nbm.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<!-- Google Analytics -->
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-18441903-3']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	<!-- End Google Analytics -->

</head>

<body>

<? $this->load->view('template/bodyheader', $headerdata); ?>

<div id="content">
	
	<article id="mainstory">
		
		<header>
			<hgroup>
				<h2 id="articletitle" class="articletitle">Contact us</h2>
			</hgroup>			
		</header>
		
		<img src="<?=base_url()?>img/connect-please.jpg" align="right" title="Katie Fitch, The Bowdoin Orient" id="connect-please" class="hidemobile">
		
		<div id="articlebody" class="articlebody">
			
			<p>The Bowdoin Orient<br/>
			6200 College Station<br/>
			Brunswick, ME 04011-8462</p>
			
			<p>Phone: (207) 725-3300<br/>
			Business Phone: (207) 725-3053</p>
			
			<p>General inquiries and subscriptions: <a href="mailto:orient@bowdoin.edu">orient@bowdoin.edu</a>.</p>
			
			<p>Business or advertising inquiries: <a href="mailto:orientads@bowdoin.edu">orientads@bowdoin.edu</a>.</p>
			
			<p>Web inquiries: <a href="mailto:ctucker@bowdoin.edu">ctucker@bowdoin.edu</a>.</p>
			
			<h3 id="ltte">Submit a letter to the editor</h3>
			<ol>
				<li>Letters should be recieved by 7 p.m. on the Wednesday of the week of publication.</li>
				<li>Letters must be signed. We will not publish unsigned letters.</li>
				<li>Letters should not exceed 200 words.</li>
			</ol>
			<p>Email <a href="mailto:orientopinion@bowdoin.edu">orientopinion@bowdoin.edu</a>.</p>
					
		</div>
	  
	</article>

</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>