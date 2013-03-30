<? $this->load->view('template/head'); ?>

<body>

<? $this->load->view('template/bodyheader', $headerdata); ?>

<div id="content">
	
	<article id="mainstory">
		
		<header>
			<hgroup>
				<h2 id="articletitle" class="articletitle">Something's wrong :(</h2>
				<h3 id="articlesubtitle" class="articlesubtitle">It might be time to update your fucking browser</h3>
			</hgroup>			
		</header>
		
		<div id="articlebody" class="articlebody">

			<p>The Bowdoin Orient is a student-run weekly publication dedicated to providing news and information relevant to the College community. Editorially independent of the College and its administrators, the Orient pursues such content freely and thoroughly, following professional journalistic standards in writing and reporting. The Orient is committed to serving as an open forum for thoughtful and diverse discussion and debate on issues of interest to the College community.</p>

			<p>The paper has an on-campus distribution of over 2,000, and is mailed off-campus to several hundred subscribers. It is distributed free-of-charge at various locations on campus, including the student union, several classroom buildings, the admissions office, the dining halls, and the libraries. Published on Fridays, 24 times a year, the Orient is read by students and their families, faculty, staff, alumni, off-campus subscribers, prospective students, and campus visitors.</p>
			
		</div>
	  
	</article>

</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>