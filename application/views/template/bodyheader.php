<!-- Facebook JavaScript SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=115180665171978";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- end FB JS SDK -->

<script>
$(function() {
	$( "#datepicker" ).datepicker({
		prevText: '&laquo;',
		nextText: '&raquo;',
		dateFormat: "yy-mm-dd",
		onSelect: function(dateText, inst) { 
			window.location.href = '<?=base_url()?>browse/'+dateText; 
		}
	});
});
</script>

<?if(!chromeless()):?>
	<header id="mainhead">
		<div id="head-content">
			<h1 id="wordmark"><a href="<?=site_url()?>"><span class="super">The</span> Bowdoin Orient</a></h1>
			
			<a href="https://twitter.com/bowdoinorient" class="twitter-follow-button" data-show-count="false">Follow @bowdoinorient</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			
			<div class="fb-like" data-href="https://www.facebook.com/bowdoinorient" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
					
			<nav id="mainnav">
				<ul>
					<? if($this->uri->segment(1) == "" || $this->uri->segment(1) == "browse"): ?>
						<li><a href="#News">News</a></li>
						<li><a href="#Opinion">Opinion</a></li>
						<li><a href="#Features">Features</a></li>
						<li><a href="#Arts & Entertainment">A&E</a></li>
						<li><a href="#Sports">Sports</a></li>
						<li><a href="#Featured">★</a></li>
					<? endif; ?>
					<? if($this->uri->segment(1) == "article" && !empty($section_id)): ?>
						<li class="<?= ($section_id == "1" ? "active" : "inactive"); ?>"><a href="<?=site_url()."browse/".$date?>#News">News</a></li>
						<li class="<?= ($section_id == "2" ? "active" : "inactive"); ?>"><a href="<?=site_url()."browse/".$date?>#Opinion">Opinion</a></li>
						<li class="<?= ($section_id == "3" ? "active" : "inactive"); ?>"><a href="<?=site_url()."browse/".$date?>#Features">Features</a></li>
						<li class="<?= ($section_id == "4" ? "active" : "inactive"); ?>"><a href="<?=site_url()."browse/".$date?>#Arts & Entertainment">A&E</a></li>
						<li class="<?= ($section_id == "5" ? "active" : "inactive"); ?>"><a href="<?=site_url()."browse/".$date?>#Sports">Sports</a></li>
						<li class="inactive"><a href="#Featured">★</a></li>
					<? endif; ?>
					<li>
						<form action="<?=site_url()?>search" id="cse-search-box" method="get">
							<input class="filterinput" type="text" placeholder="Search" name="q">
						</form>
					</li>
					<!--<li><a href="http://bowdoinorientexpress.com" style="font-family:helvetica;font-style:italic;" class="oebug"><img src="<?=base_url().'img/oe-compass-35.png'?>"></a></li>-->
					<li style="border-left:1px solid lightgray" class="hidetablet"><a href="http://bowdoinorientexpress.com">Blog</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<div id="subnavbar">
		<?if(isset($date)):?>
			<span id="lastupdated"><?=date("F j, Y",strtotime($date))?></span>
			<div id="datepicker"></div> &middot; 
		<?endif;?>
		<span class="hidemobile">
		<?if(isset($volume) && isset($issue_number)):?>
			<? if(!empty($previssue)):?><a href="<?=site_url()?>browse/<?=$previssue->issue_date?>" class="issue-nav-arrow">&#x25C4;</a> <?endif;?>
			<? if(isset($issue) && !empty($issue->scribd)): ?><a href="http://www.scribd.com/doc/<?=$issue->scribd?>" class="scribd-link" target="new"><? endif; ?>Vol. <?=$volume?>, No. <?=$issue_number?><? if(isset($issue) && !empty($issue->scribd)): ?></a><? endif; ?> 
			<? if(!empty($nextissue)):?><a href="<?=site_url()?>browse/<?=$nextissue->issue_date?>" class="issue-nav-arrow">&#x25BA;</a> <?endif;?>&middot;
		<?endif;?>
		</span>
		<a href="<?=base_url()?>random">Random <img src="<?=base_url()?>img/icon-shuffle.svg" type="image/svg+xml" class="" height="15" width="15" style="margin-bottom: -3px;" title="Dmitry Baranovskiy, from The Noun Project"></a>
		<span class="onlymobile">&middot; <?=anchor('search', 'Search'); ?></span>
		<span id="pages" class="hidemobile">
			<?=anchor('about', 'About'); ?> &middot; 
			<?=anchor('subscribe', 'Subscribe'); ?> &middot; 
			<?=anchor('advertise', 'Advertise'); ?> &middot; 
			<?=anchor('contact', 'Contact'); ?> &middot; 
			<span id="submittip">Submit a tip</span>
		</span>
	</div>

	<div id="submittipform">
		<span class="closebutton">&times;</span>
		<!--<span id="tipprompt" style="font-weight: bold;">Submit an anonymous tip.</span>-->Submissions are anonymous. Leave contact information if willing, or email <a href="mailto:orient@bowdoin.edu">orient@bowdoin.edu</a>.<br/>
		<textarea name="tip"></textarea>
		<button id="tipsubmit">Submit</button> <button id="cancel">Cancel</button> <span id="tipnotice"></span>
	</div>

<? endif; ?> 

<? if(isset($alerts)): ?>
	<div id="alertbar">
		<? foreach($alerts as $alert): ?>
			<div class="alert<?if($alert->urgent == '1'):?> urgent<?endif;?>">
				&#9758; <?=$alert->message ?>
			</div>
		<? endforeach; ?>
	</div>
<? endif; ?>

<!--[if lt IE 9]>
	<div id="alertbar">
		<div class='alert urgent'>Your browser is out-of-date, and parts of the Orient site may not work properly. <a href="http://whatbrowser.org/">Upgrade your browser</a>. If you can't install a new browser, <a href='http://www.google.com/chromeframe/?redirect=true'>try Chrome Frame</a>.</div>
	</div>
<![endif]--> 

<script>

if(Math.random() > 0.5) 
{
	$('#submittip').html("Request an investigation");
	//$('#tipprompt').html("Request an investigation anonymously."); //i cut this bit of copy entirely
}

$("#lastupdated").click(function () {
	$("#datepicker").toggle();
});

$("#submittip").click(function () {
	$("#submittipform").toggle();
});

$("#submittipform .closebutton").click(function () {
	$("#submittipform").hide();
});

$("#submittipform #cancel").click(function () {
	$("#submittipform").hide();
});

$(document).ready(function() {
     
    //if submit button is clicked
    $('#tipsubmit').click(function () {        
         
        var tip = $('textarea[name=tip]').val();
        var user_location = window.location.href;
        var user_referer = "<? if(isset($_SERVER['HTTP_REFERER'])) { echo $_SERVER['HTTP_REFERER']; }?>";
        var user_ip = "<? if(isset($_SERVER['REMOTE_ADDR'])) { echo $_SERVER['REMOTE_ADDR']; }?>";
        var user_host = "<? if(isset($_SERVER['REMOTE_HOST'])) { echo $_SERVER['REMOTE_HOST']; }?>";
        var user_agent = "<? if(isset($_SERVER['HTTP_USER_AGENT'])) { echo $_SERVER['HTTP_USER_AGENT']; }?>";
        var prompt = $('#submittip').html();
         
        //start the ajax request
        $.ajax({
            url: "<?=site_url()?>tools/ajax_submittip",
            type: "POST",
            data: 'tip=' + encodeURIComponent(tip)
            		+ '&user_location=' + encodeURIComponent(user_location)
            		+ '&user_referer=' + encodeURIComponent(user_referer)
            		+ '&user_ip=' + encodeURIComponent(user_ip)
            		+ '&user_host=' + encodeURIComponent(user_host)
            		+ '&user_agent=' + encodeURIComponent(user_agent)
            		+ '&prompt=' + encodeURIComponent(prompt),
            cache: false,
            success: function (result) {
                //if ajax_submittip returned 1/true (submit success)
                if (result=='true') {
                    $("textarea[name=tip]").val(''); //empty form so it's ready for another tip
                    $('#submittipform #tipnotice').html('Submitted.'); //success notice
                    $('#submittipform').fadeOut("slow"); //hide the form
                //if process.php returned 0/false (submit tip failed)
                } else $('#submittipform #tipnotice').html('You can\’t submit an empty tip.');
            }       
        });
         
        //cancel the submit button default behaviours
        return false;
    }); 
}); 

</script>