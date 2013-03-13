<? $this->load->view('template/head'); ?>

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
			
			<p>Web inquiries: <a href="mailto:tophtucker@gmail.com">tophtucker@gmail.com</a>.</p>
			
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