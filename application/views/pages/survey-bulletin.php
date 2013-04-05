<? $this->load->view('template/head'); ?>

<body>

<? $this->load->view('template/bodyheader', $headerdata); ?>

<div id="content">
	
	<article id="mainstory">
		
		<!--<header>
			<hgroup>
				<h2 id="articletitle" class="articletitle">Survey</h2>
			</hgroup>			
		</header>-->
		
		<div id="articlebody" class="articlebody">
			
			<iframe src="https://docs.google.com/forms/d/19stp4I1WQi-pclj9-SK1Pv1oU4Fc7KM--yPKIOiwKzE/viewform?embedded=true" width="760" height="800" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
					
		</div>
	  
	</article>

</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>