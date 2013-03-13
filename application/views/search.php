<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Search results - The Bowdoin Orient</title>
	<link rel="shortcut icon" href="<?=base_url()?>img/favicon-o.png">
	
	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/orient.css?v=2">
	
	<!-- jQuery -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
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
				<h2 id="articletitle" class="articletitle searchtitle">Search</h2>
				<!--<h3 id="articlesubtitle" class="articlesubtitle"></h3>-->
			</hgroup>			
		</header>
		
		<div id="bigsearch">
			<form action="<?=site_url()?>search" id="cse-search-box" method="get">
				<input class="filterinput" type="text" value="<?=$query?>" name="q" autofocus>
			</form>
		</div>
		
		<div id="articlebody" class="articlebody">
		
			<div id="cse" style="width: 100%;"></div>
			<script src="http://www.google.com/jsapi" type="text/javascript"></script>
			<script type="text/javascript"> 
			  google.load('search', '1', {language : 'en', style : google.loader.themes.V2_DEFAULT});
			  google.setOnLoadCallback(function() {
				var customSearchOptions = {};  var customSearchControl = new google.search.CustomSearchControl(
				  '013877420925418038085:0ibijs0mmig', customSearchOptions);
				customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
				var options = new google.search.DrawOptions();
				options.enableSearchResultsOnly(); 
				customSearchControl.draw('cse', options);
				function parseParamsFromUrl() {
				  var params = {};
				  var parts = window.location.search.substr(1).split('\x26');
				  for (var i = 0; i < parts.length; i++) {
					var keyValuePair = parts[i].split('=');
					var key = decodeURIComponent(keyValuePair[0]);
					params[key] = keyValuePair[1] ?
						decodeURIComponent(keyValuePair[1].replace(/\+/g, ' ')) :
						keyValuePair[1];
				  }
				  return params;
				}
			
				var urlParams = parseParamsFromUrl();
				var queryParamName = "q";
				if (urlParams[queryParamName]) {
				  customSearchControl.execute(urlParams[queryParamName]);
				}
			  }, true);
			</script>
			
			<p><?=anchor('advsearch','Advanced search')?></p>
			 
		</div>
	  
	</article>

</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>