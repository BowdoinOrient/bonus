

<? $this->load->view('template/head'); ?>

<body>

  <? $this->load->view('template/bodyheader', $headerdata); ?>

  <!-- Only do this if browser is IE <= 8 -->
  <? $this->load->view('browser'); ?>

  <div id="content">
    
    <article id="mainstory" data-article-id="<?=$article->id?>">
      
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
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= current_url() ?>" data-via="bowdoinorient" data-lang="en">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<br/>

		<div class="fb-like" data-href="<?= current_url() ?>" data-send="false" data-layout="button_count" data-width="115" data-show-faces="false" data-action="recommend"></div>
		<br/>

		<!-- load in the export subtoolbox-->
		<div id="addtoreader">
			<span style="vertical-align:top;">Read Later:</span>
			<img class="readericon" id="readability" src="<?=base_url()?>/img/readability.png"/>
			<img class="readericon" id="instapaper" src="<?=base_url()?>/img/instapaper.png"/>
			<img class="readericon" id="pocket" src="<?=base_url()?>/img/pocket1.png"/>
			<img class="readericon" id="kindle" src="<?=base_url()?>/img/kindle.png"/>
			<script type="text/javascript">
				$('.readericon').click(function(){
					var clickedid = $(this).attr("id");
					switch(clickedid){
	          			case "readability": //READABILITY WORKS
		          			$('#addtoreader').fadeOut("fast", function(){
		          				$('#addtoreader').replaceWith('<div id="readability" class="rdbWrapper readerEmbed" data-show-read-now="0" data-show-read-later="1" data-show-send-to-kindle="0" data-show-print="0" data-show-email="0" data-orientation="0" data-version="1" data-bg-color="#ffffff"></div><script type="text/javascript">(function() {var s = document.getElementsByTagName("script")[0],rdb = document.createElement("script"); rdb.type = "text/javascript"; rdb.async = true; rdb.src = document.location.protocol + "//www.readability.com/embed.js"; s.parentNode.insertBefore(rdb, s); })();</scr'+'ipt>').hide();
		          				$('#addtoreader').fadeIn("fast");
		          			});
	          				break;
	          			case "instapaper": //INSTAPAPER WORKS
		          			$('#addtoreader').fadeOut("fast", function(){
		          				$('#addtoreader').replaceWith('<div id="instapaper" class="readerEmbed"><div style="display:inline-block;padding:3px;cursor:pointer;font-size:11px;font-family:Tahoma;white-space:nowrap;line-height:1;border-radius:3px;border:#ccc thin solid;color:black;background:transparent url('+'https://d1xnn692s7u6t6.cloudfront.net/button-gradient.png'+') repeat-x;background-size:contain;"><img style="vertical-align:middle;margin:0;padding:0;border:none;height:15px;" src="<?=base_url()?>/img/instapaper.png"/><a href="javascript:function iprl5(){var d=document,z=d.createElement('+"'"+'scr'+"'"+'+'+"'"+'ipt'+"'"+'),b=d.body,l=d.location;try{if(!b)throw(0);d.title='+"'"+'(Saving...) '+"'"+'+d.title;z.setAttribute('+"'"+'src'+"'"+',l.protocol+'+"'"+'//www.instapaper.com/j/3Kf0O6XBwYB0?u='+"'"+'+encodeURIComponent(l.href)+'+"'"+'&t='+"'"+'+(new Date().getTime()));b.appendChild(z);}catch(e){alert('+"'"+'Please wait until the page has loaded.'+"'"+');}}iprl5();void(0)" class="bookmarklet" onclick="return explain_bookmarklet();" title="Read Later" style="color:black;text-decoration:none;vertical-align:middle;margin-left:6px">Add to Instapaper</a></div></div>').hide();
		          				$('#addtoreader').fadeIn("fast");
		          			});
		          			break;
	          			case "pocket": //POCKET IS WORKING
		          			$('#addtoreader').fadeOut("fast", function(){
		          				$('#addtoreader').replaceWith('<div id="pocket" class="readerEmbed"> <a data-pocket-label="pocket" data-pocket-count="none" class="pocket-btn" data-lang="en"></a></div><script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</scr'+'ipt>').hide();
		          				$('#addtoreader').fadeIn("fast");
		          			});
		          			break;
	          			case "kindle": //KINDLE IS WORKING (AFAICT)
		          			$('#addtoreader').fadeOut("fast", function(){
		          				$('#addtoreader').replaceWith('<div id="kindle" class="readerEmbed"><div class="kindleWidget" style="display:inline-block;padding:3px;cursor:pointer;font-size:11px;font-family:Tahoma;white-space:nowrap;line-height:1;border-radius:3px;border:#ccc thin solid;color:black;background:transparent url('+'https://d1xnn692s7u6t6.cloudfront.net/button-gradient.png'+') repeat-x;background-size:contain;"><img style="vertical-align:middle;margin:0;padding:0;border:none;" src="https://d1xnn692s7u6t6.cloudfront.net/white-15.png"/><span style="vertical-align:middle;margin-left:3px;">Send to Kindle</span></div></div><script type="text/javascript" src="https://d1xnn692s7u6t6.cloudfront.net/widget.js"></scr'+'ipt><script type="text/javascript">(function k(){window.$SendToKindle&&window.$SendToKindle.Widget?$SendToKindle.Widget.init({"content":"#articlebody","title":".articletitle","author":".articleauthor","published":".articledate"}):setTimeout(k,500);})();</scr'+'ipt>').hide();
		          				$('#addtoreader').fadeIn("fast");
		          			});
							break;
						default: ;
					}
				});
		</script>
	</div>

	  <? if(bonus()): // only show views to logged-in staff, mostly bc display is too ugly to be public ?>
					Views: <?=$article->views?> (<?=$article->views_bowdoin?>)<br/>
	  <? endif; ?>
	  
	</div>
	
      </header>                
      
      <!-- catcher is used to trigger sticky sidebar, currently disabled (see below) -->
      <div id="article-sidebar-catcher"></div>
      <!-- sidebar contains photos, videos, and other attachments -->
      <div id="article-sidebar">
	<div id="article-attachments">
	  <? if($photos): ?>
	  <? if(count($photos) == 1 || bonus()): ?>
	  <? foreach($photos as $key => $photo): ?>
	  <? $photo_view_data = array('article' => $article, 'photo' => $photo); ?>
	  <? $this->load->view('template/attachment-photo', $photo_view_data); ?>
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
	  <? if($attachments): //looks through the attachments and sees what's there ?>
	  <? 
	     $hasYoutube = false;
	  $youtubePlaylist = array();
	  
	  $hasVimeo = false;
	  $vimeos = array();
	  
	  $hasHTML = false;
	  $HTMLs = array();
	  
	  // looks through each attachment
						foreach($attachments as $key => $attachment) {
						  
						  // spots youtube. holds onto the first, sticks the rest in a playlist
							if($attachment->type == 'youtube') {
							  if(!$hasYoutube) {
							    // hold onto the attachment
									$youtube = $attachment;
		$hasYoutube = true;
							  } else {
							    // if it's not first youtube video, push to playlist
									$youtubePlaylist[] = $attachment->content1;
							  }
							}
						        
							// spots and handles vimeos
							if($attachment->type == 'vimeo') {
							  $hasVimeo = true;
	      $vimeos[] = $attachment;
							}
						        
							// spots and handles raw html
							// note that there's currently no way to create an html attachment in bonus
							// but you can do it straight through the database if you want
							if($attachment->type == 'html') {
							  $hasHTML = true;
	      $HTMLs[] = $attachment;
							}
						}
					        
						// if there's at least one youtube video, load the first and put the rest in the playlist
						if($hasYoutube) { 
						  // serializes the playlist (so you have comma-separated IDs: 124234,43t346,3i4ngiu...)
							$youtube->playlist = join($youtubePlaylist,',');
	    // load the actual embedded player
							$this->load->view('template/attachment-video', $youtube); 
						}
						if($hasVimeo) { foreach($vimeos as $vimeo) { $this->load->view('template/attachment-video', $vimeo); } }
						if($hasHTML) { foreach($HTMLs as $html) { $this->load->view('template/attachment-html', $html); } }
					?>
	  <? endif; ?>
	</div>
	<div id="bonus-attachments">
	  <? if(bonus()): ?>
	  
	  <!-- image upload -->
	  <figure class="articlemedia mini">
	    <div id="dnd-holder" class="bonus-attachment">
	      <!-- imageupload input has opacity set to zero, width and height set to 100%, so you can click anywhere to upload -->
	      <input id="imageupload" class="imageupload" type=file accept="image/gif,image/jpeg,image/png">
	      <div id="dnd-instructions">
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
	      <form>
		<br/><input type="text" style="width:160px" name="video-url" placeholder="YouTube or Vimeo URL"></input>
		<br/><button type="submit" id="attach-video">Attach</button>
	      </form>
	    </div>
	  </figure>
	  
	  <? endif; ?>
	</div>		
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
  <![endif] -->

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
    // surely there's a better way to handle this
    // if only i really knew javascript
    // #dry :(

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
      if(confirm("Is this article ready for the world?")) {
	window.publish = true;
	window.published = true;
	$("#savearticle").click();
      }
    });
    
    $("#unpublish").click(function() {
      if(confirm("Are you sure you want to unpublish this article? Unless you, like, JUST published it, that's probs not kosher.")) {
	window.unpublish = true;
	window.published = false;
	$("#savearticle").click();
      }
    });
    
    $("#savearticle").click(function() {
      
      $("#savenotify").html("Saving...");
      
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
			   },
			   error: function(XMLHttpRequest, textStatus, errorThrown){
			     $("#savenotify").html("There was an unknown error. The site could not be reached. "+errorThrown+" "+textStatus);
			   }
	}));
      }
      
      // save photo credit/caption edits 
      var photoEdits = {};
      $('.articlemedia.photo-wrapper').each( function(index, photo) {
	var photoId = $("#"+photo.id).data("photo-id");
	var thisPhotoEdits = {};
	thisPhotoEdits["credit"] = $("#photocredit"+photoId).html();
	thisPhotoEdits["caption"] = $("#photocaption"+photoId).html(); 
	photoEdits[photoId] = thisPhotoEdits;
      });
      if(photoEdits.length===0) {
	// if array is empty, i.e. no attachments were found...
			     var photoEditsJSON = false;
      }
      else {
	// else serialize array for ajaxing
				var photoEditsJSON = JSON.stringify(photoEdits);
      }
      
      // save attachment credit/caption edits
      var attachmentEdits = {};
      $('.articlemedia.video-wrapper').each( function(index, attachment) {
	// gets attachment id from data-attachment-id attribute of figure
				// note that this.data-attachment-id doesn't work, so i do this roundabout jquery select thing
				var attachmentId = $("#"+attachment.id).data("attachment-id");
	var thisAttachmentEdits = {};
	thisAttachmentEdits["credit"]  = $("#attachmentcredit"+attachmentId).html();
	thisAttachmentEdits["caption"] = $("#attachmentcaption"+attachmentId).html(); 
	attachmentEdits[attachmentId] = thisAttachmentEdits;
      });
      if(attachmentEdits.length===0) {
	// if array is empty, i.e. no attachments were found...
				  var attachmentEditsJSON = false;
      }
      else {
	// else serialize array for ajaxing
				var attachmentEditsJSON = JSON.stringify(attachmentEdits);
      }
      
      var ajaxrequest = {
	title: 			urlencode($("#articletitle").html()),
			 subtitle:		urlencode($("#articlesubtitle").html()),
			 series:			urlencode($("#series").html()),
			 author:			urlencode($("#addauthor").html()),
			 authorjob:		urlencode($("#addauthorjob").html()),
			 volume:			urlencode($('input[name=volume]').val()),
			 issue_number:	urlencode($('input[name=issue_number]').val()),
			 section_id:		urlencode($('input[name=section_id]').val()),
			 priority:		urlencode($('input[name=priority]').val()),
			 published:		window.published,
			 featured:		$('input[name=featured]').prop('checked'),
			 opinion:		$('input[name=opinion]').prop('checked')
      };
      if(photoEditsJSON)		{ ajaxrequest.photoEdits = 		urlencode(photoEditsJSON); }
      if(attachmentEditsJSON)	{ ajaxrequest.attachmentEdits =	urlencode(attachmentEditsJSON); }
      if(bodyedited) 			{ ajaxrequest.body = 			urlencode($("#articlebody").html()); }
      
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
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $("#savenotify").html("There was an unknown error. The site could not be reached. "+errorThrown+" "+textStatus);
	}
      }));
      
      $.when.apply($, calls).then(function() {
	$("#savenotify").html(statusMessage);
	if(window.publish) {
	  window.location = "<?=site_url()?>"; 
	}
	if(refresh) { 
	  window.location.reload(); 
	}
      });
      
    } );
    
    $("#deletearticle").click(function(event) {
      event.preventDefault()
      
      if(confirm("Are you sure you want to delete this article? (If this article has already been published, it's probs not kosher to delete it.)")) {
	$.ajax({
	  type: "POST",
	  url: "<?=site_url()?>article/ajax_delete_article/<?=$article->id?>",
	  data: "remove=true",
	  success: function(result){
	    if(result=="Article deleted.") {
	      //return home
							window.location = "<?=site_url()?>";
	    }
	    //show alert
						$("#savenotify").html(result);
	  },
	  error: function(XMLHttpRequest, textStatus, errorThrown){
	    $("#savenotify").html("There was an unknown error. The site could not be reached. "+errorThrown+" "+textStatus);
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
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $("#savenotify").html("There was an unknown error. The site could not be reached. "+errorThrown+" "+textStatus);
	}
      });
      
    });
    
    $(".articlemedia .deletePhoto").click(function(event) {
      
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
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $("#savenotify").html("There was an unknown error. The site could not be reached. "+errorThrown+" "+textStatus);
	}
      });
      
    });
    
    $(".articlemedia .bigPhotoToggle").click(function(event) {
      
      var photoId = $("#"+event.target.id).data("photo-id");
      var toggle = $("#"+event.target.id).data("toggle");
      
      $.ajax({
	type: "POST",
	url: "<?=site_url()?>article/ajax_bigphoto/"+<?=$article->id?>,
	data: "bigphoto="+toggle,
	success: function(result){
	  if(result=="Bigphoto enabled.") {
	    $(".photo-wrapper").addClass("bigphoto");
	    $("#bigPhotoEnable"+photoId).hide();
	    $("#bigPhotoDisable"+photoId).show();
	  }
	  else if(result=="Bigphoto disabled.") {
	    $(".photo-wrapper").removeClass("bigphoto");
	    $("#bigPhotoEnable"+photoId).show();
	    $("#bigPhotoDisable"+photoId).hide();
	  }
	  //show alert
					$("#savenotify").html(result);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $("#savenotify").html("There was an unknown error. The site could not be reached. "+errorThrown+" "+textStatus);
	}
      });
      
    });
    
    $("#attach-video").click(function(event) {
      event.preventDefault();
      $.ajax({
	type: "POST",
	url: "<?=site_url()?>article/ajax_add_attachment/<?=$article->id?>",
	data: {
	  type: 		"video",
	  content1: 	urlencode($('input[name=video-url]').val())
	},
	dataType: 'json',
	success: function(result){
	  console.log(result);
	  if(result.success)
	  {
	    $("#savenotify").html(result.status);
	    
	    //if it's a youtube video and there's an existing youtube video on the page...
				  if(result.type == 'youtube' && $('.articlemedia.video-wrapper.youtube').length>0) {
				    console.log("Appending to YouTube playlist.");
	      //just add this new video to the playlist
							$('.articlemedia.video-wrapper.youtube iframe').attr('src', $('.articlemedia.video-wrapper.youtube iframe').attr('src')+result.content1+',');
	      $('.articlemedia.video-wrapper.youtube iframe').addClass('playlist');
				  }
				  else {
				    $("#article-attachments").append(result.view);
				  }
				  // clear the video URL input from the attachment form
						$('input[name=video-url]').val('');
	  }
	  else
					{
					  $("#savenotify").html(result.status);
					}
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $("#savenotify").html("There was an unknown error. The site could not be reached. "+errorThrown+" "+textStatus);
	}
      });
    });
    
    $(".articlemedia .deleteAttachment").live("click", function(event) {
      
      var attachmentId = event.target.id.replace("deleteAttachment","");
      
      ajaxrequest = {
	remove: true,
	article_id: $("#mainstory").data('article-id')
      };
      if($("#attachment"+attachmentId).data('playlist').length > 0) ajaxrequest.playlist = true;
      
      $.ajax({
	type: "POST",
	url: "<?=site_url()?>article/ajax_delete_attachment/"+attachmentId,
	data: ajaxrequest,
	dataType: 'json',
	success: function(result){
	  //show alert
					$("#savenotify").html(result.status);
	  if(result.success) {
	    $("#attachment"+attachmentId).hide("fast");
	  }
	},
	error: function(XMLHttpRequest, textStatus, errorThrown){
	  $("#savenotify").html("There was an unknown error. The site could not be reached. "+errorThrown+" "+textStatus);
	}
      });
      
    });
    
    $(".articlemedia .bigAttachmentToggle").live("click", function(event) {
      
      var attachmentId = $("#"+event.target.id).data("attachment-id");
      var toggle = $("#"+event.target.id).data("toggle");
      
      $.ajax({
	type: "POST",
	url: "<?=site_url()?>article/ajax_attachment_big/"+attachmentId,
	data: "big="+toggle,
	success: function(result){
	  if(result=="Big enabled.") {
	    $("#attachment"+attachmentId).addClass("bigphoto");
	    $("#bigEnable"+attachmentId).hide();
	    $("#bigDisable"+attachmentId).show();
	  }
	  else if(result=="Big disabled.") {
	    $("#attachment"+attachmentId).removeClass("bigphoto");
	    $("#bigEnable"+attachmentId).show();
	    $("#bigDisable"+attachmentId).hide();
	  }
	  //show alert
					$("#savenotify").html(result);
	}
      });
      
    });
    
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
  
  <? if(!empty($attachments)): ?>
  <? foreach($attachments as $attachment): ?>
  $(function() {
    $( "#attachmentcredit<?=$attachment->id?>" ).autocomplete({
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
    // make the table of contents
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
    // when a table of contents link is clicked
    $('#toc_container').localScroll({
      target:'body',
      duration: '1000' //not duration timing is working
    });
    
    // not actually sure i want this to happen...
    // should the url change as ppl navigate the article? i guess so, right?
    // add section anchor to url
    $("#toc_container a").click(function () {
      location.hash = $(this).attr('href');
    });

    // thanks hartbro! 
    // http://blog.hartleybrody.com/creating-sticky-sidebar-widgets-that-scrolls-with-you/
    // function used to detect whether you've scrolled to an element
    function isScrolledTo(elem) {
      var docViewTop = $(window).scrollTop(); //num of pixels hidden above current screen
      var docViewBottom = docViewTop + $(window).height();
      var elemTop = $(elem).offset().top - 100; //num of pixels above the elem
      var elemBottom = elemTop + $(elem).height();
      return ((elemTop <= docViewTop));
    }
    
    // set up the table of contents navigation stickiness
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
      
      // #todo: highlight active TOC section
      // a la bootstrap scrollspy
    });
    
    // make article attachments fixed and mini after you scroll past,
    // settling them in the sidebar.
    // not sure we want to do this, so it's disabled for now.
    /*
    var catcher2 = $('#article-sidebar-catcher');
    var sticky2 = $('#article-sidebar');
    $(window).scroll(function() {
    if(isScrolledTo(sticky2)) {
    $('#article-sidebar figure').addClass('mini');
    $('#article-sidebar').css('opacity','.3');
    sticky2.css('position','fixed');
    sticky2.css('top','60px');
    var bodyLeftOffset = $("#articlebodycontainer").offset().left + $("#articlebodycontainer").width()-225;
    sticky2.css('left',bodyLeftOffset+'px');
  }
    var stopHeight = catcher2.offset().top;
    if (catcher2.offset().top > sticky.offset().top-200) {
    $('#article-sidebar figure').removeClass('mini');
    $('#article-sidebar').css('opacity','1');
    sticky2.css('position','inherit');
    sticky2.css('top','auto');
    sticky2.css('left','auto');
    //sticky2.css('top','0');
    //sticky2.css('left','-200px');
  }
  }); 
    */
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