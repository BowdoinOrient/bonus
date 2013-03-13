<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>About - The Bowdoin Orient</title>
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
				<h2 id="articletitle" class="articletitle">About</h2>
				<h3 id="articlesubtitle" class="articlesubtitle">The nation&rsquo;s oldest continuously published college weekly</h3>
			</hgroup>			
		</header>
		
		<div id="contactbox">
			<div id="vcard" class="vcard">
				<a class="fn org url" href="http://bowdoinorient.com" title="The Bowdoin Orient"><div class="organization-name">The Bowdoin Orient</div></a>
				<div class="email"><a href="mailto:orient@bowdoin.edu">orient@bowdoin.edu</a></div>
				<div class="tel"><span class="hidetablet">Telephone: </span><span class="value">(207) 725-3300</span></div>
				<div class="tel"><span class="hidetablet">Business phone: </span><span class="value">(207) 725-3053</span></div>
				<div class="adr">
					<div class="street-address">6200 College Station</div>
					<div class="locality">Brunswick</span>, <span class="region">Maine</span> <span class="postal-code">04011</div>
				</div>
				<!--<div class="staff"><span class="position">Editor in Chief:</span> <br>Linda Kinstler</div>-->
			</div>
		</div>
		
		<figure id="contents">
			<h3>Related links</h3>
			<ul>
				<li><?=anchor('pages/ethics','Ethical Practices Policy')?></li>
				<li><?=anchor('pages/nonremoval', 'Web Non-Removal Policy')?></li>
			</ul>
		</figure>
		
		<div id="articlebody" class="articlebody">

			<p>The Bowdoin Orient is a student-run weekly publication dedicated to providing news and information relevant to the College community. Editorially independent of the College and its administrators, the Orient pursues such content freely and thoroughly, following professional journalistic standards in writing and reporting. The Orient is committed to serving as an open forum for thoughtful and diverse discussion and debate on issues of interest to the College community.</p>

			<p>The paper has an on-campus distribution of over 2,000, and is mailed off-campus to several hundred subscribers. It is distributed free-of-charge at various locations on campus, including the student union, several classroom buildings, the admissions office, the dining halls, and the libraries. Published on Fridays, 24 times a year, the Orient is read by students and their families, faculty, staff, alumni, off-campus subscribers, prospective students, and campus visitors.</p>
						
			<h3>Staff</h3>
			<div id="stafftable">

				<div id="topstaff">
					<!--<div id="eic">
						<div style="width:100%"><p><span class="bigshot">Linda Kinstler,</span> <span class="bigshot-title">Editor in Chief</span></p></div>
					</div> -->
					<div id="topeditors">
						<div style="width:50%"><p><span class="bigshot">Linda Kinstler,</span><br/> <span class="bigshot-title">Editor in Chief</span></p></div>
						<div style="width:50%"><p><span class="bigshot">Sam Weyrauch,</span><br/> <span class="bigshot-title">Executive Editor</span></p></div>
						<div style="width:50%"><p><span class="bigshot">Nora Biette-Timmons,</span><br/> <span class="bigshot-title">Managing Editor</span></p></div>
						<div style="width:50%"><p><span class="bigshot">Garrett Casey,</span><br/> <span class="bigshot-title">Managing Editor</span></p></div>
					</div>
				</div>
				<hr style="width:50%; margin: 0 auto;">
				<div id="lowerstaff">
					<div class="column">
						<p class="stafftitle">News Editor</p>
						<p>Marisa McGarry</p>
						
						<p class="stafftitle">Features Editor</p>
						<p>Natalie Clark</p>
						
						<p class="stafftitle">A&amp;E Editor</p>
						<p>Maggie Bryan</p>
						
						<p class="stafftitle">Sports Editor</p>
						<p>Ron Cervantes</p>
						
						<p class="stafftitle">Opinion Editor</p>
						<p>Natalie Kass-Kaufman</p>
						
						<p class="stafftitle">Calendar Editor</p>
						<p>Carolyn Veilleux</p>
						
						<p class="stafftitle">Beats Editor</p>
						<p>Sophia Cheng</p>
						
					</div>
					<div class="column">
						<p class="stafftitle">Associate Editors</p>
						<p>Sam Miller</p>
						<p>Kate Witteman</p>
						<p>Diana Lee</p>
						
						<p class="stafftitle">Senior Reporters</p>
						<p>Peter Davis</p>
						<p>Sam Miller</p>
						<p>Maeve O'Leary</p>
						
						<p class="stafftitle">Information Architect</p>
						<p>Toph Tucker</p>
						
						<p class="stafftitle">Business Managers</p>
						<p>Maya Lloyd</p>
						<p>Madison Whitley</p>
						
					</div>
					<div class="column">
						<p class="stafftitle">Layout Editor</p>
						<p>Ted Clark</p>
						
						<p class="stafftitle">Graphic Designer</p>
						<p>Leo Shaw</p>
						
						<p class="stafftitle">Photo Editor</p>
						<p>Kate Featherston</p>
						
						<p class="stafftitle">Asst. Photo Editor</p>
						<p>Hy Khong</p>
						
						<p class="stafftitle">Editors-at-Large</p>
						<p>Claire Aasen</p>
						<p>Erica Berry</p>
						<p>Dylan Hammer</p>
						<p>Eliza Novick-Smith</p>

						<p class="stafftitle">Web Editor</p>
						<p>Matthew Gutschenritter</p>
						
					</div>
				</div>
				
			</div>
			
			<div style="clear:both;"></div>
			
			<h3>History</h3>
			<p>The Bowdoin Orient was established in 1871 as Bowdoin College's newspaper and literary magazine. Originally issued bi-weekly, it has been a weekly since April, 1899. It is considered to be the oldest continuously-published college weekly in the U.S., which means that it has been in publication every academic year that Bowdoin has been in session since it began publishing weekly (while other college weeklies stopped printing during certain war years).</p>
			<p>In the beginning, the Orient was laid out in a smaller magazine format, and included literary material such as poems and fiction alongside its news. In 1897, the literary society formed its own publication, The Quill, and the Orient has since primarily focused on reporting news. In 1921, the Orient moved from the magazine format to a larger broadsheet layout and has changed between broadsheet and tabloid sizes frequently.</p>
			<p>In 1912, The Bowdoin Publishing Company was established as the formal publisher of the Orient, and remained independent of the College for many years while using college facilities and working with faculty-member advisers. The Bowdoin Publishing Company was a legal, non-profit corporation in the State of Maine for many years (at least from 1968 to 1989), though it was most likely an independent corporation since its inception. In recent years, the Orient has printed with the presses of the <a href="http://www.timesrecord.com/">Brunswick Times Record</a>.</p>
			<p>The Orient building has its own archives, with issues dating back to 1873, but it is missing several periods of time. The Hawthorne-Longfellow Library has a nearly complete archive of past Orient issues, both in print and on microform. Virtually all print issues are available from 1871 to the present in Special Collections and Archives. Bound copies from 1871 to 1921 can be found in the periodicals section of the library. Microform is available for issues 1921 to the present, and can be accessed at any time.</p>
		
			<h3>Website</h3>
			<p>The new bowdoinorient.com has been rebuilt from scratch for a clean, modern experience across all devices, and to support an increasingly digital-first operation. The CMS is custom-built in the CodeIgniter PHP framework. With this redesign, it has moved from its longtime orient.bowdoin.edu address to bowdoinorient.com.</p>
			<p>The website went online around 2000. It was previously redesigned in 2001, 2004 (becoming database-driven), and 2009 (with a complete visual overhaul).</p>
			<p>In September 2010, the Orient launched the <a href="http://bowdoinorientexpress.com/">Orient Express</a>, a companion Tumblr blog featuring content beyond the scope, reach, and technical capabilities of the printed Friday paper.</p>
			<p>Webmasters have included Vic Kotecha &rsquo;05, James Baumberger &rsquo;06, Mark Hendrickson &rsquo;07, Seth Glickman &rsquo;10, and Toph Tucker &rsquo;12. If you aspire to have your name on this prestigious list, <a href="mailto:tophtucker@gmail.com">email Toph</a>.</p>
			<p>Bowdoinorient.com requires a modern browser. If things look wrong, <a href="http://www.whatbrowser.org/en/browser/">it's time to upgrade</a>. (We recommended a WebKit-based browser like <a href="http://www.google.com/intl/en/chrome/">Chrome</a> or <a href="http://apple.com/safari">Safari</a>.)
			<!-- Other browser ballots include WordPress's http://browsehappy.com/ and Microsoft's http://browserchoice.eu/ -->
			
		</div>
	  
	</article>

</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>

</html>