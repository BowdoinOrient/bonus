<? $this->load->view('template/head'); ?>

<body>

<? $this->load->view('template/bodyheader', $headerdata); ?>

<div id="content">
	
	<article id="mainstory">
		
		<header>
			<hgroup>
				<h3 id="articlesubtitle" class="articlesubtitle">It might be time for an update.</h3>
			</hgroup>			
		</header>
		
		<div id="articlebody" class="articlebody">

		<p>In order to cater to a wide variety of sceens and devices, The Bowdoin Orient's website implements a number of modern web technologies. Unfortunately, we've detected that some of these technologies don't work in the browser you're using. </p>
	
		<p>You appear to be using <span id="browsername">a version of Internet Explorer</span> which is several years out of date. To learn more about browsers, and to download a browser that supports all the features of <a href="http://bowdoinorient.com">bowdoinorient.com</a>, please visit <a href="http://whatbrowser.org">WhatBrowser.org</a>.</p>
		
		<script type="text/javascript">
			var sayswho = (function(){
  				var N= navigator.appName, ua= navigator.userAgent, tem;
  				var M= ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
  				if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
  				M= M? [M[1], M[2]]: [N,navigator.appVersion,'-?'];
  				return M;
  			})();
  			alert(sayswho);
			$('#browsername').replaceWith(sayswho);
		</script>
		
		<a href="http://whatbrowser.org"><img style="width:100%" src="<?=base_url()?>/img/whatbrowser.png"/></a>

		</div>
	  
	</article>

</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>