<? $this->load->view('template/head'); ?>

<body>

<? $this->load->view('template/bodyheader', $headerdata); ?>

<div id="content">
	
	<article id="mainstory">
		
		<header>
			<hgroup class="articletitle-group">
				
				<!-- NEXT / PREV -->
				<div class="article_header_nav hidetablet hidemobile">
					<? if(!empty($series_previous)): ?>
					<ul class="articleblock leftmargin">
						<? foreach($series_previous as $s_prev): ?>
						<li class="<? if(!empty($s_prev->filename_small)): ?> backgrounded<? endif; ?><? if(!$s_prev->published): ?> draft<? endif; ?>"<? if(!empty($s_prev->filename_small)): ?> style="background:url('<?=base_url().'images/'.$s_prev->date.'/'.$s_prev->filename_small?>')"<? endif; ?>>
							<a href="<?=site_url()?>article/<?=$s_prev->id?>">
							<!--<div class="dateified"><?=dateify($s_prev->date)?></div>-->
							<h3><? if($s_prev->series): ?><span class="series"><?=$s_prev->series?>:</span> <? endif; ?>
							<?=$s_prev->title?></h3>
							<? if($s_prev->subtitle): ?><h4><?= $s_prev->subtitle ?></h4><? endif; ?>
							<div class="excerpt"><?=$s_prev->excerpt?></div>
						</a></li>
						<? endforeach; ?>
					</ul>
					<? endif;?> 
					<? if(!empty($series_next)): ?>
					<ul class="articleblock rightmargin">
						<? foreach($series_next as $s_next): ?>
						<li class="<? if(!empty($s_next->filename_small)): ?> backgrounded<? endif; ?><? if(!$s_next->published): ?> draft<? endif; ?>"<? if(!empty($s_next->filename_small)): ?> style="background:url('<?=base_url().'images/'.$s_next->date.'/'.$s_next->filename_small?>')"<? endif; ?>>
							<a href="<?=site_url()?>article/<?=$s_next->id?>">
							<!--<div class="dateified"><?=dateify($s_next->date)?></div>-->
							<h3><? if($s_next->series): ?><span class="series"><?=$s_next->series?>:</span> <? endif; ?>
							<?=$s_next->title?></h3>
							<? if($s_next->subtitle): ?><h4><?= $s_next->subtitle ?></h4><? endif; ?>
							<div class="excerpt"><?=$s_next->excerpt?></div>
						</a></li>
						<? endforeach; ?>
					</ul>
					<? endif; ?>
				</div>
				
				<? if($article->series || bonus()): ?>
					<h3 id="series" class="series"<?if(bonus()):?> contenteditable="true" title="Series"<?endif;?>>
						<? if(!bonus()): ?><a href="<?=site_url()?>series/<?=$series->id?>"><? endif; ?>
						<?=$series->name?>
						<? if(!bonus()): ?></a><? endif; ?>
					</h3>
				<? endif; ?>
				
				<h2 id="articletitle" class="articletitle <?= ($article->published ? '' : 'draft'); ?>"<?if(bonus()):?> contenteditable="true" title="Title"<?endif;?>><?=$article->title?></h2>
				<h3 id="articlesubtitle" class="articlesubtitle"<?if(bonus()):?> contenteditable="true" title="Subtitle"<?endif;?>><? if(isset($article->subtitle)): ?><?=$article->subtitle?><? endif; ?></h3>
				
			</hgroup>

			<div id="authorblock">
				<? if(bonus() && $series->name != "Editorial"): ?>
					<div class="opinion-notice"><input type="checkbox" name="opinion" value="opinion" <? if($article->opinion): ?>checked="checked"<? endif; ?> /> Does this piece represent the opinion of the author?</div>
				<? endif; ?>
				<? if($series->name == "Editorial"): ?>
					<object data="<?=base_url()?>img/icon-opinion.svg" type="image/svg+xml" class="opinion-icon" height="20" width="20" title="Plinio Fernandes, from The Noun Project"></object>
					<div class="opinion-notice">This piece represents the opinion of <span style="font-style:normal;">The Bowdoin Orient</span> editorial board.</div>
				<? endif; ?>
				<? if($authors): ?>
					<? if($article->opinion == '1' && !bonus()): ?>
						<object data="<?=base_url()?>img/icon-opinion.svg" type="image/svg+xml" class="opinion-icon" height="20" width="20" title="Plinio Fernandes, from The Noun Project"></object>
						<div class="opinion-notice">This piece represents the opinion of the author<?if(count($authors)>1):?>s<?endif;?>:</div>
					<? endif; ?>
					<? foreach($authors as $key => $author): ?>
						<a href="<?=site_url()?>author/<?=$author->authorid?>">
						<div id="author<?=$author->articleauthorid?>" class="authortile<? if(bonus()):?> bonus<? endif; ?> <?if($article->opinion == '1'):?>opinion<? endif; ?>">
							<? if(bonus()): ?><div id="deleteAuthor<?=$author->articleauthorid?>" class="delete">&times;</div><? endif; ?>
							<? if(!empty($author->photo) && $article->opinion): ?><img src="<?=base_url().'images/authors/'.$author->photo?>" class="authorpic"><? endif; ?>
							<div class="authortext">
								<div class="articleauthor"><?=$author->authorname?></div>
								<div class="articleauthorjob"><?=$author->jobname?></div>
							</div>
						</div>
						</a>
					<? endforeach; ?>
				<? endif; ?>
				<? if(bonus()): ?>
					<div class="authortile bonus <?if($article->opinion == '1'):?>opinion<? endif; ?>">
						<div class="articleauthor" id="addauthor" contenteditable="true" title="Author"></div>
						<div class="articleauthorjob" id="addauthorjob" contenteditable="true" title="Author job"></div>
					</div>
				<? endif; ?>
				
			</div>
			
			<p class="articledate"><time pubdate datetime="<?=$article->date?>"><?=date("F j, Y",strtotime($article->date))?></time></p>
			
			<div class="toolbox">
				
				<div class="rdbWrapper" data-show-read-now="1" data-show-read-later="1" data-show-send-to-kindle="0" data-show-print="0" data-show-email="0" data-orientation="0" data-version="1" data-bg-color="#ffffff"></div><script type="text/javascript">(function() {var s = document.getElementsByTagName("script")[0],rdb = document.createElement("script"); rdb.type = "text/javascript"; rdb.async = true; rdb.src = document.location.protocol + "//www.readability.com/embed.js"; s.parentNode.insertBefore(rdb, s); })();</script>
				
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= current_url() ?>" data-via="bowdoinorient" data-lang="en">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<br/>
				
				<div class="fb-like" data-href="<?= current_url() ?>" data-send="false" data-layout="button_count" data-width="115" data-show-faces="false" data-action="recommend"></div>
				<br/>
				
				<? if(bonus()): // only show views to logged-in staff, mostly bc display is too ugly to be public ?>
					Views: <?=$article->views?> (<?=$article->views_bowdoin?>)<br/>
				<? endif; ?>
				
			</div>
			
		</header>                
		
		<div id="article-sidebar">
			<? if($photos): ?>
				<? if(count($photos) == 1 || bonus()): ?>
					<? foreach($photos as $key => $photo): ?>
						<figure id="photo<?=$photo->photo_id?>" class="articlemedia singlephoto <?= ($article->bigphoto ? 'bigphoto' : '') ?>">
							<? if(bonus()): ?>
								<div id="deletePhoto<?=$photo->photo_id?>" class="delete">&times;</div>
								<div class="bigphotoEnable <?= ($article->bigphoto ? 'hide' : '') ?>">&#8689;</div>
								<div class="bigphotoDisable <?= ($article->bigphoto ? '' : 'hide') ?>">&#8690;</div>
							<? endif; ?>
							<img src="<?=base_url()?>images/<?=$article->date?>/<?=$photo->filename_large?>" class="singlephoto">
							<figcaption>
								<? if(!empty($photo->photographer_id)): ?>
									<?if(bonus()):?>
										<p id="photocredit<?=$photo->photo_id?>" class="photocredit" contenteditable="true" title="Photographer"><?= $photo->photographer_name; ?></p>
									<?else:?>
										<p id="photocredit<?=$photo->photo_id?>" class="photocredit">
											<?= anchor('author/'.$photo->photographer_id, $photo->photographer_name) ?>
										</p>
									<?endif;?>
								<? elseif(empty($photo->credit) && bonus()): ?>
									<p id="photocredit<?=$photo->photo_id?>" class="photocredit" contenteditable="true" title="Photographer"></p>
								<? else: ?>
									<p id="photocredit<?=$photo->photo_id?>" class="photocredit">
										<?= $photo->credit ?>
									</p>
								<? endif; ?>
								<p id="photocaption<?=$photo->photo_id?>" class="photocaption" <?if(bonus()):?>contenteditable="true" title="Caption"<?endif;?>><?=$photo->caption?></p>
							</figcaption>
						</figure>
					<? endforeach; ?>
				<? else: ?>
					<figure class="articlemedia <?= ($article->bigphoto ? 'bigphoto' : '') ?>">
						<div id="swipeview_wrapper"></div>
						<div id="swipeview_relative_nav">
							<span id="prev" onclick="carousel.prev();hasInteracted=true">&laquo;</span>
							<span id="next" onclick="carousel.next();hasInteracted=true">&raquo;</span>
						</div>
						<ul id="swipeview_nav">
							<? foreach($photos as $key => $photo): ?>
							<li <? if($key==0): ?>class="selected"<? endif; ?> onclick="carousel.goToPage(<?=$key; ?>);hasInteracted=true"></li>
							<? endforeach; ?>
						</ul>
					</figure>
				<? endif; ?>
			<? endif; ?>
			<? if(bonus()): ?>
		
				<!-- image upload -->
				<figure class="articlemedia mini">
					<div id="dnd-holder">
						<input id="imageupload" class="imageupload" type=file accept="image/gif,image/jpeg,image/png">
						<div id="dnd-instructions" class="bonus-attachment">
							<img src="<?=base_url()?>img/icon-uploadphoto.png" type="image/svg+xml" height="50" width="50" title=""></object>
							<br/>Click or drag
							<br/>JPG, PNG or GIF
						</div>
					</div>
					<figcaption class="bonus">
						<p id="photocreditbonus" class="photocredit" contenteditable="true" title="Photographer"></p>
						<p id="photocaptionbonus" class="photocaption" contenteditable="true" title="Caption"></p>
					</figcaption>
				</figure>
			
				<!-- video attachment -->
				<figure class="articlemedia mini">
					<div id="video-attach" class="bonus-attachment">
						<img src="<?=base_url()?>img/icon-video.png" width="45" title="Thomas Le Bas, from The Noun Project"></object>
						<br/>YouTube or Vimeo URL
						<br/><input type="text" style="width:160px" name="video-url"></input>
						<br/><button id="attach-video">Attach</button>
					</div>
				</figure>
			
			<? endif; ?>
		
		</div>
		
		<div id="articlebodycontainer">
		
			<!-- placeholder for table of contents, to be injected by js -->
			<div id="toc_container_catcher"></div>
			<div id="toc_container"></div>		
		
			<div id="articlebody" class="articlebody"<?if(bonus()):?> contenteditable="true" title="Article body"<?endif;?>>
				<? if(!empty($body)): ?>
					<?=$body->body;?>
				<? endif; ?>
			</div>
		
		</div>
		
		<div id="articlefooter">
			
			<? if(!bonus()): ?>
			
				<!-- Disqus -->
				<div id="disqus_thread"></div>
				<script type="text/javascript">
					/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
					var disqus_shortname = 'bowdoinorient'; // required: replace example with your forum shortname
					var disqus_title = '<?=addslashes($article->title)?>';
					
					//disqus_identifier isn't necessary, because it can use the URL. it's preferable, though, because of different URL schemes.
					//problem is, we used a different scheme (date&section&priority, e.g. 2012-05-04&2&1) on the old site.
					//on newer articles (>7308), we just use the new unique article id.
					<? if($article->id <= 7308): ?>
						var disqus_identifier = '<?=$article->date."?".$article->section_id."?".$article->priority?>';
					<? else: ?>
						var disqus_identifier = '<?=$article->id?>';
					<? endif; ?>
					
					/* * * DON'T EDIT BELOW THIS LINE * * */
					(function() {
						var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
						dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
						(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
					})();
				</script>
				<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
			
			<? endif; ?>
			
		</div>
	  
	</article>

</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>

<? $this->load->view('bonus/bonusbar', TRUE); ?>

<? if(bonus()): ?>

	<script>

	var titleedited=false;
	var subtitleedited=false;
	var bodyedited=false;
	var photoadded=false;
	var hasphoto=false;
	var photocreditedited=false;
	var photocaptionedited=false;

	// thanks Mark Seecof!
	// http://www.php.net/manual/en/function.urlencode.php#85903
	function urlencode(s) {
		s = encodeURIComponent(s);
		return s.replace(/~/g,'%7E').replace(/%20/g,'+');
	}

	$(document).ready(function()
	{
		// SET TOOLTIPS
		$("#series, #articletitle, #articlesubtitle, #addauthor, #addauthorjob, #photocreditbonus, #photocaptionbonus, #articlebody").each(function() {
			if($("#"+$(this).attr("id")).html().trim() == "" || $("#"+$(this).attr("id")).html().trim() == "<br>" || $("#"+$(this).attr("id")).html().trim() == "<p></p>") {
				$("#"+$(this).attr("id")).addClass("tooltip");
			}
			$("#"+$(this).attr("id")).focus(function() {
				$(this).removeClass("tooltip");
			});
			$("#"+$(this).attr("id")).blur(function() {
				if($(this).html().trim() == "" || $(this).html().trim() == "<br>" || $(this).html().trim() == "<p></p>") {
					$(this).addClass("tooltip");
				}
			});
		});
	
		// SET PUBLISHED
		window.published = <?= $article->published ? 'true' : 'false' ?>;
	
		// DETECT CHANGES AND SUCH

		$('#articletitle').keydown(function() {
			titleedited=true;
			$('#articletitle').css("color", "darkred");
		});
		$('#articletitle').keyup(function() {
			document.title = $('#articletitle').html() + " — The Bowdoin Orient";
		});
		$("#articletitle").bind('paste', function() {
			titleedited=true;
			$('#articletitle').css("color", "darkred");
		});
	
		$('#articlesubtitle').keydown(function() {
			subtitleedited=true;
			$('#articlesubtitle').css("color", "darkred");
		});
		$('#articlesubtitle').bind('paste', function() {
			subtitleedited=true;
			$('#articlesubtitle').css("color", "darkred");
		});
	
		$('#articlebody').keydown(function() {
			bodyedited=true;
			window.onbeforeunload = "You have unsaved changes.";
			window.onbeforeunload = function(e) {
				return "You have unsaved changes.";
			};
			$('#articlebody').css("color", "darkred");
		});
		$('#articlebody').bind('paste', function() {
			bodyedited=true;
			window.onbeforeunload = "You have unsaved changes.";
			window.onbeforeunload = function(e) {
				return "You have unsaved changes.";
			};
			$('#articlebody').css("color", "darkred");
		});
	
		$('#photocreditbonus').keydown(function() {
			photocreditedited=true;
			$('#photocreditbonus').css("color", "darkred");
		});
		$('#photocreditbonus').bind('paste', function() {
			photocreditedited=true;
			$('#photocreditbonus').css("color", "darkred");
		});
	
		$('#photocaptionbonus').keydown(function() {
			photocaptionedited=true;
			$('#photocaptionbonus').css("color", "darkred");
		});
		$('#photocaptionbonus').bind('paste', function() {
			photocaptionedited=true;
			$('#photocaptionbonus').css("color", "darkred");
		});
	
		$("#publisharticle").click(function() {
			window.publish = true;
			window.published = true;
			$("#savearticle").click();
		});
	
		$("#unpublish").click(function() {
			if(confirm("Are you sure you want to unpublish this article? Unless you, like, JUST published it, that's probs not kosher.")) {
				window.unpublish = true;
				window.published = false;
				$("#savearticle").click();
			}
		});
	
		$("#savearticle").click(function() {
		
			var statusMessage = '';
			var refresh = false;
			var calls = [];
		
			// if an image was added, save it.
			// $('#dnd-holder').length != 0 && $('#dnd-holder').attr('class') == 'backgrounded'
			if(photoadded) {
				calls.push($.ajax({
					type: "POST",
					url: "<?=site_url()?>article/ajax_add_photo/<?=$article->date?>/<?=$article->id?>",
					data: 
						"img=" + $('#dnd-holder').css('background-image') + 
						"&credit=" + urlencode($("#photocreditbonus").html()) +
						"&caption=" + urlencode($("#photocaptionbonus").html()),
					success: function(result){
						if(result=="Photo added.") {
							refresh = true;
						}
						statusMessage += result;
						// set hasphoto to true; set photoadded to false? ugh.
					}
				}));
			}
		
			<? if(!empty($photos)): ?>
				var photoEdits = {};
				<? foreach($photos as $photo): ?>			
					var thisPhotoEdits = {};
					thisPhotoEdits["credit"] = $("#photocredit<?=$photo->photo_id?>").html();
					thisPhotoEdits["caption"] = $("#photocaption<?=$photo->photo_id?>").html(); 
					photoEdits["<?=$photo->photo_id?>"] = thisPhotoEdits;
				<? endforeach; ?>
				var photoEditsJSON = JSON.stringify(photoEdits);
			<? else: ?>
				var photoEditsJSON = false;
			<? endif; ?>
		
			var ajaxrequest = 
					"title=" + urlencode($("#articletitle").html()) + 
					"&subtitle=" + urlencode($("#articlesubtitle").html()) +
					"&series=" + urlencode($("#series").html()) +
					"&author=" + urlencode($("#addauthor").html()) +
					"&authorjob=" + urlencode($("#addauthorjob").html()) +
					"&volume=" + urlencode($('input[name=volume]').val()) +
					"&issue_number=" + urlencode($('input[name=issue_number]').val()) +
					"&section_id=" + urlencode($('input[name=section_id]').val()) +
					"&priority=" + urlencode($('input[name=priority]').val()) +
					"&published=" + window.published +
					"&featured=" + $('input[name=featured]').prop('checked') +
					"&opinion=" + $('input[name=opinion]').prop('checked');
			if(photoEditsJSON)	{ ajaxrequest += "&photoEdits=" + urlencode(photoEditsJSON); }
			if(bodyedited) 		{ ajaxrequest += "&body=" + urlencode($("#articlebody").html()); }
		
			// write title, subtitle, author, authorjob, bonus-meta stuff
			// (regardless of whether they've been edited. sloppy.)
			// and body, only if it's been edited
			calls.push($.ajax({
				type: "POST",
				url: "<?=site_url()?>article/edit/<?=$article->id?>",
				data: ajaxrequest,
				success: function(result){
					if(result=="Refreshing...") { refresh = true; }
				
					statusMessage += result;
				
					$("#savenotify").html(result);
					$("#savenotify").show();
					$("#savenotify").fadeOut(4000);
				
					if(window.published)
					{
						$("#articletitle").removeClass("draft");
						$("#publisharticle").hide();
						$("#unpublish").show();
					}
					else
					{
						$("#articletitle").addClass("draft");
						$("#publisharticle").show();
						$("#unpublish").hide();
					}
				
					titleedited=false;
					subtitleedited=false;
					bodyedited=false;
					photocreditedited=false;
					photocaptionedited=false;
					window.onbeforeunload = null; // remove message blocking navigation away from page
					$('#articletitle, #articlesubtitle, #articlebody, #photocreditbonus, #photocaptionbonus').css("color", "inherit");
				}
			}));
		
			$.when.apply($, calls).then(function() {
				$("#savenotify").html(statusMessage);
				$("#savenotify").show();
				if(window.publish) {
					window.location = "<?=site_url()?>"; 
				}
				if(refresh) { 
					window.location.reload(); 
				}
				else {
					$("#savenotify").fadeOut(4000);
				}
			});
								
		} );
	
		$("#removephotos").click(function(event) {
			event.preventDefault()
			//note: "data:" is totally unused, but what'd happen if it weren't there??? (well, test!)
			$.ajax({
				type: "POST",
				url: "<?=site_url()?>article/ajax_remove_photos/<?=$article->id?>",
				data: "remove=true",
				success: function(result){
					if(result=="Photos removed.") {
						//hide photos
						$('.singlephoto').hide();
					}
					//show alert
					$("#savenotify").html(result);
					$("#savenotify").show();
					$("#savenotify").fadeOut(4000);
				}
			});
		} );
	
		$("#deletearticle").click(function(event) {
			event.preventDefault()
		
			if(confirm("Are you sure you want to delete this article? (If this article has already been published, it's probs not kosher to delete it.)")) {
				//note: "data:" is totally unused, but what'd happen if it weren't there??? (well, test!)
				$.ajax({
					type: "POST",
					url: "<?=site_url()?>article/ajax_delete_article/<?=$article->id?>",
					data: "remove=true",
					success: function(result){
						if(result=="1") {
							//return home
							window.location = "<?=site_url()?>";
						}
						//show alert
						$("#savenotify").html(result);
						$("#savenotify").show();
						$("#savenotify").fadeOut(4000);
					}
				});
			}
		
		} );
	
		$(".authortile .delete").click(function(event) {
		
			event.preventDefault();
			var articleAuthorId = event.target.id.replace("deleteAuthor","");
		
			$.ajax({
				type: "POST",
				url: "<?=site_url()?>article/ajax_remove_article_author/"+articleAuthorId,
				data: "remove=true",
				success: function(result){
					if(result=="Author removed.") {
						$("#author"+articleAuthorId).hide("fast");
					}
					//show alert
					$("#savenotify").html(result);
					$("#savenotify").show();
					$("#savenotify").fadeOut(4000);
				}
			});
		
		});
	
		$(".articlemedia .delete").click(function(event) {
		
			var photoId = event.target.id.replace("deletePhoto","");
		
			$.ajax({
				type: "POST",
				url: "<?=site_url()?>article/ajax_delete_photo/"+photoId,
				data: "remove=true",
				success: function(result){
					if(result=="Photo deleted.") {
						$("#photo"+photoId).hide("fast");
					}
					//show alert
					$("#savenotify").html(result);
					$("#savenotify").show();
					$("#savenotify").fadeOut(4000);
				}
			});
		
		});
	
		$(".articlemedia .bigphotoEnable").click(function(event) {
		
			$.ajax({
				type: "POST",
				url: "<?=site_url()?>article/ajax_bigphoto/"+<?=$article->id?>,
				data: "bigphoto=true",
				success: function(result){
					if(result=="Bigphoto enabled.") {
						$(".singlephoto").addClass("bigphoto");
						$(".bigphotoEnable").hide();
						$(".bigphotoDisable").show();
					}
					//show alert
					$("#savenotify").html(result);
					$("#savenotify").show();
					$("#savenotify").fadeOut(4000);
				}
			});
		
		});
	
		$(".articlemedia .bigphotoDisable").click(function(event) {
		
			$.ajax({
				type: "POST",
				url: "<?=site_url()?>article/ajax_bigphoto/"+<?=$article->id?>,
				data: "bigphoto=false",
				success: function(result){
					if(result=="Bigphoto disabled.") {
						$(".singlephoto").removeClass("bigphoto");
						$(".bigphotoDisable").hide();
						$(".bigphotoEnable").show();
					}
					//show alert
					$("#savenotify").html(result);
					$("#savenotify").show();
					$("#savenotify").fadeOut(4000);
				}
			});
		
		});
		
		$("#attach-video").click(function(event) {
			event.preventDefault()
			//note: "data:" is totally unused, but what'd happen if it weren't there??? (well, test!)
			$.ajax({
				type: "POST",
				url: "<?=site_url()?>article/ajax_add_attachment/<?=$article->id?>",
				data: "type=video&content1="+urlencode($('input[name=video-url]').val()),
				success: function(result){
					$("#article-sidebar").prepend(result);
				}
			});
		} );
	
	});

	// ugh, i forget what this is even for.
	// i think to help autocomplete work on contenteditable?
	(function ($) {
		var original = $.fn.val;
		$.fn.val = function() {
			if ($(this).is('*[contenteditable=true]')) {
				return $.fn.html.apply(this, arguments);
			};
			return original.apply(this, arguments);
		};
	})(jQuery);

	$(function() {
		$( "#addauthor" ).autocomplete({
			source: "<?=site_url()?>article/ajax_suggest/author/name"
		});
	});

	$(function() {
		$( "#addauthorjob" ).autocomplete({
			source: "<?=site_url()?>article/ajax_suggest/job/name"
		});
	});


	$(function() {
		$( "#photocreditbonus" ).autocomplete({
			source: "<?=site_url()?>article/ajax_suggest/author/name"
		});
	});

	<? if(!empty($photos)): ?>
		<? foreach($photos as $photo): ?>
		$(function() {
			$( "#photocredit<?=$photo->photo_id?>" ).autocomplete({
				source: "<?=site_url()?>article/ajax_suggest/author/name"
			});
		});	
		<? endforeach; ?>
	<? endif; ?>
	
	$(function() {
		$( "#series" ).autocomplete({
			source: "<?=site_url()?>article/ajax_suggest/series/name"
		});
	});

	</script>

	<!-- CK Editor -->
	<script>

		CKEDITOR.on( 'instanceCreated', function( event ) {
				var editor = event.editor,
					element = editor.element;

				// Customize editors for headers and tag list.
				// These editors don't need features like smileys, templates, iframes etc.
				if ( element.is( 'div' ) || element.getAttribute( 'id' ) == 'taglist' ) {
					// Customize the editor configurations on "configLoaded" event,
					// which is fired after the configuration file loading and
					// execution. This makes it possible to change the
					// configurations before the editor initialization takes place.
					editor.on( 'configLoaded', function() {

						// Remove unnecessary plugins to make the editor simpler.
						editor.config.removePlugins = 'colorbutton,find,flash,font,' +
							'forms,iframe,image,newpage,scayt,' +
							'smiley,specialchar,stylescombo,templates,wsc,contextmenu,liststyle,tabletools';

						// Rearrange the layout of the toolbar.
						editor.config.toolbarGroups = [
							{ name: 'editing',		groups: [ 'basicstyles', 'links' ], items: ['Format', 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight'] },
							{ name: 'undo' },
							{ name: 'clipboard',	groups: [ 'clipboard' ], items: ['RemoveFormat'] },
							{ name: 'showblocks', items: ['ShowBlocks']}
						];
					});
				}
			});

	
		// We need to turn off the automatic editor creation first.
		CKEDITOR.disableAutoInline = true;
		var editor = CKEDITOR.inline( 'articlebody' );
	
		editor.on('paste', function(evt) {
			// Update the text
			// evt.editor.setData(evt.editor.getData() + ' your additional comments.');
			bodyedited=true;
			window.onbeforeunload = "You have unsaved changes.";
			window.onbeforeunload = function(e) {
				return "You have unsaved changes.";
			};
			$('#articlebody').css("color", "darkred");

		}, editor.element.$);
	
	</script>

	<!-- image upload, drag-and-drop or file upload input -->
	<!-- from @rem's http://html5demos.com/file-api-simple -->
	<!--  and @rem's http://html5demos.com/file-api -->
	<script>
		var upload = document.getElementById('imageupload'),
			holder = document.getElementById('dnd-holder');

		upload.onchange = function (e) {
		  e.preventDefault();

		  var file = upload.files[0],
			  reader = new FileReader();
		  reader.onload = function (event) {
		      imageLoad(event);
		  };
		  reader.readAsDataURL(file);

		  return false;
		};
		
		// drag-and-drop image
		if(holder) {
			holder.ondragover = function () { this.className = 'hover'; return false; };
			holder.ondragend = function () { this.className = ''; return false; };
			holder.ondrop = function (e) {
				this.className = '';
				e.preventDefault();
			
				var file = e.dataTransfer.files[0],
					reader = new FileReader();
				reader.onload = function (event) {
				    imageLoad(event);
				};
				reader.readAsDataURL(file);
			
				return false;
			};
		};
		
		// for when a photo is added
		function imageLoad(event) {
			photoadded=true;
			window.onbeforeunload = "You have unsaved changes.";
			window.onbeforeunload = function(e) {
				return "You have unsaved changes.";
			};
			holder.style.background = 'url(' + event.target.result + ')';
			holder.style.borderColor = 'darkred';
			holder.className += "backgrounded";
			$('#dnd-instructions').remove();
			$('#imageupload').remove();
			$('figcaption.bonus').show();
			$('figure').removeClass('mini');
		}
	</script>
	
<? endif; ?>

<? if(!bonus()): // doesn't work with ckeditor, i think bc of the injection of IDs ?>
	<!-- Table of Contents -->
	<script>
	$(document).ready(function(){
	   $('#articlebody').jqTOC({
			tocWidth: 100,
			tocTitle: 'Content',
			tocStart: 1,
			tocEnd  : 4,
			tocContainer : 'toc_container',
			tocAutoClose : false,
			tocShowOnClick : false,
			tocTopLink   : ''
	   });
	
		// Set up localScroll smooth scroller to scroll the whole document
		$('#toc_container').localScroll({
		   target:'body',
		   duration: '1000' //uh, not sure this is working!
		});
	
		// not actually sure i want this to happen...
		// should the url change as ppl navigate the article? i guess so, right?
		$("#toc_container a").click(function () {
			location.hash = $(this).attr('href');
		});

		// thanks hartbro! 
		// http://blog.hartleybrody.com/creating-sticky-sidebar-widgets-that-scrolls-with-you/
		function isScrolledTo(elem) {
			var docViewTop = $(window).scrollTop(); //num of pixels hidden above current screen
			var docViewBottom = docViewTop + $(window).height();
			var elemTop = $(elem).offset().top - 100; //num of pixels above the elem
			var elemBottom = elemTop + $(elem).height();
			return ((elemTop <= docViewTop));
		}
		var catcher = $('#toc_container_catcher');
		var sticky = $('#toc_container');
		$(window).scroll(function() {
			if(isScrolledTo(sticky)) {
				sticky.css('position','fixed');
				sticky.css('top','100px');
				var bodyLeftOffset = $("#articlebodycontainer").offset().left - 200;
				sticky.css('left',bodyLeftOffset+'px');
			}
			var stopHeight = catcher.offset().top + catcher.height() - 200;
			if ( stopHeight > sticky.offset().top) {
				sticky.css('position','absolute');
				sticky.css('top','0');
				sticky.css('left','-200px');
			}
		
			// highlight active TOC section
		
		});
   
	});
	</script>
<? endif; ?>

<? if(count($photos) > 1 && !bonus()): ?>
	<!-- SwipeView. Only needed for slideshows. -->
	<script type="text/javascript" src="<?= base_url() ?>js/swipeview-mwidmann.js"></script>
	<script type="text/javascript">
	var	carousel,
		el,
		i,
		page,
		hasInteracted = false,
		dots = document.querySelectorAll('#swipeview_nav li'),
		slides = [
			<? foreach($photos as $key => $photo): ?>
				<? if($key > 0): ?>,<? endif; ?>
				'<div class="swipeview-image" style="background:url(<?= base_url() ?>images/<?= $article->date ?>/<?= $photo->filename_large ?>)"></div>'
					+'<figcaption>'
					+ '<p class="photocredit"><? if(!empty($photo->photographer_id)): ?><?= anchor('author/'.$photo->photographer_id, addslashes(trim(str_replace(array("\r\n", "\n", "\r"),"<br/>",$photo->photographer_name)))); ?><? else: ?><?= addslashes(trim(str_replace(array("\r\n", "\n", "\r"),"<br/>",$photo->credit))); ?><? endif; ?></p>'
					+ '<p class="photocaption"><?= addslashes(trim(str_replace(array("\r\n", "\n", "\r"),"<br/>",$photo->caption))); ?></p>'
					+'</figcaption>'
			<? endforeach; ?>
		];
	
	carousel = new SwipeView('#swipeview_wrapper', {
		numberOfPages: slides.length,
		hastyPageFlip: true
	});
	
	// Load initial data
	for (i=0; i<3; i++) {
		page = i==0 ? slides.length-1 : i-1;
	
		el = document.createElement('span');
		el.innerHTML = slides[page];
		carousel.masterPages[i].appendChild(el)
	}
	
	carousel.onFlip(function () {
		var el,
			upcoming,
			i;
	
		for (i=0; i<3; i++) {
			upcoming = carousel.masterPages[i].dataset.upcomingPageIndex;
	
			if (upcoming != carousel.masterPages[i].dataset.pageIndex) {
				el = carousel.masterPages[i].querySelector('span');
				el.innerHTML = slides[upcoming];
			}
		}
		
		document.querySelector('#swipeview_nav .selected').className = '';
		dots[carousel.pageIndex].className = 'selected';
	});
	
	
	// timer for carousel autoplay
	function loaded() {
		var interval = setInterval(function () { 
				if(!hasInteracted) carousel.next(); 
			}, 5000); 
		
	}
	document.addEventListener('DOMContentLoaded', loaded, false);
	
	</script>
<? endif; ?>

<script type="text/javascript">
  var _sf_async_config = { uid: 45947, domain: 'bowdoinorient.com' };
  (function() {
    function loadChartbeat() {
      window._sf_endpt = (new Date()).getTime();
      var e = document.createElement('script');
      e.setAttribute('language', 'javascript');
      e.setAttribute('type', 'text/javascript');
      e.setAttribute('src',
        (("https:" == document.location.protocol) ? "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" : "http://static.chartbeat.com/") +
        "js/chartbeat.js");
      document.body.appendChild(e);
    };
    var oldonload = window.onload;
    window.onload = (typeof window.onload != 'function') ?
      loadChartbeat : function() { oldonload(); loadChartbeat(); };
  })();
</script>

</body>

</html>