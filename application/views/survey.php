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
			
			<iframe src="https://docs.google.com/forms/d/1NIrUCmUytV9z5OfDqKym3Yb-knHZp3wEqXDXBZsHG_4/viewform?embedded=true" width="760" height="4000" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
					
		</div>
	  
	</article>

</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>