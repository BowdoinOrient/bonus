<?php
class Article extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/New_York');
		$this->load->model('issue_model', '', TRUE);
		$this->load->model('article_model', '', TRUE);
		$this->load->model('attachments_model', '', TRUE);
		$this->load->model('tools_model', '', TRUE);
	}
	
	public function index($id = '')
	{
		if(!$id) 
		{
			$this->error();
		}
		else
		{
			$this->view($id);
		}
	}
	
	public function error($message = '')
	{
		$data->message = $message;
		$this->load->view('error', $data);
	}
		
	public function view($id)
	{		
		$article = $this->article_model->get_article($id);
		
		if(!$article) 
		{
			$this->error("No such article exists.");
		}
		else
		{
			// add one to article views if not logged in
			if(!bonus()) $this->article_model->increment_article_views($id);
			
			$body = $this->article_model->get_body($id);
			$type = $this->article_model->get_article_type($article->type);
			$series = $this->article_model->get_article_series($article->series);
			$authors = $this->article_model->get_article_authors($id);
			$photos = $this->attachments_model->get_photos($id);
			$attachments = $this->attachments_model->get_attachments($id);
			
			// get random quote
			$data->footerdata->quote = $this->attachments_model->get_random_quote();
			
			// adjacent articles
			if($series->name) 
			{
				$data->series_previous = $this->article_model->get_articles_by_date($article->date, false, false, '1', false, false, $series->id, $id);
				$data->series_next = $this->article_model->get_articles_by_date(false, $article->date, false, '1', false, false, $series->id, $id, 'asc');
			}
			
			// featured articles for footer
			$data->featured = $this->article_model->get_articles_by_date($article->date, false, false, '5', true);
			
			$data->headerdata->date = $article->date;
			$data->headerdata->volume = $article->volume;
			$data->headerdata->issue_number = $article->issue_number;
			$data->headerdata->section_id = $article->section_id;
			$data->headerdata->alerts = $this->tools_model->get_alerts();
						
			$data->article = $article;
			$data->body = $body;
			$data->type = $type;
			$data->series = $series;
			$data->authors = $authors;
			$data->photos = $photos;
			$data->attachments = $attachments;
			
			// meta
			$data->page_title = $article->title." — The Bowdoin Orient";
			$data->page_description = htmlspecialchars(strip_tags($article->excerpt));
			$data->page_type = 'article';
			if($photos) $data->page_image = base_url().'images/'.$article->date.'/'.$photos[0]->filename_large;
			
			$this->load->view('article', $data);
		}
	}
	
	public function add($volume, $issue_number, $section)
	{
		if(!bonus())
		{
			exit("Not logged in!");
		}
		$article_id = $this->article_model->add_blank_article($volume, $issue_number, $section);
		redirect('/article/'.$article_id, 'refresh');
	}
		
	public function edit($id)
	{
		if(!bonus())
		{
			exit("Not logged in!");
		}
		
		$statusMessage = '';
		
		// strip tags where appropriate,
		// but we want to allow them in title, subtitle, & body.
		// also strip out stupid non-breaking spaces (&nbsp;)
		// preg_replace('/\&nbsp\;/', ' ', $contentFromPost); 
		// and no, i don't know why i process the incoming post data in two places
		// (here and inline in the array definition).
		
		$title 		= trim(preg_replace('/\&nbsp\;/', ' ',strip_tags(urldecode($this->input->post("title")), '<b><i><u><strong><em>')));
		$subtitle 	= trim(preg_replace('/\&nbsp\;/', ' ',strip_tags(urldecode($this->input->post("subtitle")), '<b><i><u><strong><em>')));
		$series 	= trim(preg_replace('/\&nbsp\;/', ' ',strip_tags(urldecode($this->input->post("series")))));
		$author 	= trim(preg_replace('/\&nbsp\;/', ' ',strip_tags(urldecode($this->input->post("author")))));
		$authorjob 	= trim(preg_replace('/\&nbsp\;/', ' ',strip_tags(urldecode($this->input->post("authorjob")))));
		$body 		= trim(urldecode($this->input->post("body")));
		$photoEditsJSON = urldecode($this->input->post("photoEdits"));
		
		
		$photoEditSuccess = true;
		if($photoEditsJSON) 
		{
			$photoEdits = json_decode($photoEditsJSON);
			foreach($photoEdits as $key => $photoEdit)
			{
				$photo_id = $key;
				$credit = substr(trim(preg_replace('/\&nbsp\;/', ' ',strip_tags(urldecode($photoEdit->credit), '<b><i><u><strong><em>'))),0,100); //limited to 100 due to db
				$caption = trim(preg_replace('/\&nbsp\;/', ' ',strip_tags(urldecode($photoEdit->caption), '<b><i><u><strong><em><a>')));
				$photoEditSuccess = ($photoEditSuccess && $this->attachments_model->edit_photo($photo_id, $credit, $caption));
			}
		}
		
		
		$published = ($this->input->post("published") == 'true' ? '1' : '0');
		$featured = ($this->input->post("featured") == 'true' ? '1' : '0');
		$opinion = ($this->input->post("opinion") == 'true' ? '1' : '0');
				
		$data = array(
			'title' 		=> $title,
			'subtitle' 		=> $subtitle,
			'volume' 		=> trim(urldecode($this->input->post("volume"))),
			'issue_number' 	=> trim(urldecode($this->input->post("issue_number"))),
			'section_id'	=> trim(urldecode($this->input->post("section_id"))),
			'priority'		=> trim(urldecode($this->input->post("priority"))),
			'published'		=> $published,
			'featured'		=> $featured,
			'opinion'		=> $opinion,
			'active'		=> '1'
			);
		
		// If body was updated, set excerpt to first three paragraphs.
		// Yes, this is sloppy is so many ways. FML.
		if($body) 
		{
			$thirdgraf = strnposr($body, "</p>", 3) + 4;
			$data['excerpt'] = strip_tags(substr($body, 0, $thirdgraf),"<p>");
		}
		
		// if the article is just now being published, set publication
		if(!$this->article_model->is_published($id) && $published) $data['date_published'] = date("Y-m-d H:i:s");
		
		$articlesuccess = $this->article_model->edit_article($id, $data);
		
		if($body) 
		{
			$bodysuccess = $this->article_model->add_articlebody_version($id, $body, userid());
			if($bodysuccess) $statusMessage .= "Body updated. ";
		}
		
		$seriessuccess = true;
		if(empty($series))
		{
			$seriessuccess = $this->article_model->remove_article_series($id);
		}
		elseif(strlen($series) > 1)
		{
			$seriessuccess = $this->article_model->add_article_series($id, $series);
		}
		
		$authorsuccess = true;
		if(strlen($author) > 1 && strlen($authorjob) > 1)
		{
			$authorsuccess = $this->article_model->add_article_author($id, $author, $authorjob);
			if($authorsuccess)
			{
				exit("Refreshing...");
			}
		}
		
		if($articlesuccess && $authorsuccess && $seriessuccess) 
		{
			exit("Article updated. ".$statusMessage);
		}
		else 
		{
			exit("Article failed to update. ".$statusMessage);
		}
	}
	
	// for forwarding from old site, which doesn't have article_ids
	public function triplet($date, $section_id, $priority)
	{
		$article_id = $this->article_model->get_id_by_triplet($date, $section_id, $priority);
		redirect('/article/'.$article_id, 'refresh');
	}
	
	public function ajax_remove_article_author($article_author_id)
	{
		if(!bonus()) exit("Permission denied. Try refreshing and logging in again.");
		$this->article_model->remove_article_author($article_author_id);
		exit("Author removed.");
	}
	
	/**
	  * Supports jpg, png, and gif (including animated - use wisely).
	  **/
	public function ajax_add_photo($article_date, $article_id)
	{
		if(!bonus()) exit("Permission denied. Try refreshing and logging in again.");
		
		$this->load->helper('file');
		
		$css_offset = 4;
		$css_offset_tail = 1;
		$png_offset = 22;
		$jpg_offset = 23;
		$gif_offset = 22;
		
		$offset = $css_offset;
		$extension = "";
		
		if(strpos(substr($this->input->post("img"), $css_offset, 15),"image/jpeg"))
		{
			$offset += $jpg_offset;
			$extension = ".jpg";
		}
		elseif(strpos(substr($this->input->post("img"), $css_offset, 15),"image/png"))
		{
			$offset += $png_offset;
			$extension = ".png";
		}
		elseif(strpos(substr($this->input->post("img"), $css_offset, 15),"image/gif"))
		{
			$offset += $gif_offset;
			$extension = ".gif";
		}
		else
		{
			exit("Only JPG, PNG, and GIF images are supported.");
		}
		
		$offset_tail = $css_offset_tail;
		$strlen_offset = $offset + $offset_tail;
		
		$img = substr($this->input->post("img"), $offset, strlen($this->input->post("img"))-($strlen_offset));
		$credit = substr(trim(strip_tags(urldecode($this->input->post("credit")), '<b><i><u><strong><em>')),0,100); //limited to 100 due to db
		$caption = trim(strip_tags(urldecode($this->input->post("caption")), '<b><i><u><strong><em><a>'));
		
		// bug: "When Base64 gets POSTed, all pluses are interpreted as spaces."
		// this corrects for it.
		$img_fixed = str_replace(' ','+',$img);
		
		// create directory for relevant date if necessary
		if(!is_dir('images/'.$article_date))
		{
			mkdir('images/'.$article_date);
		}
		
		// so that you can upload multiple photos to an article and the filenames won't collide,
		// we write it $articleid."_1" for the first photo attached to an article, $articleid."_2", etc.
		$article_photo_number = $this->attachments_model->count_article_photos($article_id) + 1;
		
		// write full-size image
		$filename_root = $article_id.'_'.$article_photo_number;
		$filename_original = $filename_root.$extension;
		$write_result = write_file('images/'.$article_date.'/'.$filename_original, base64_decode($img_fixed));
		
		// resize to small 
		// (breaks animation on animated gifs)
		$filename_small = $filename_root.'_small'.$extension; //width: 400px
		$img_config['image_library']	= 'gd2';
		$img_config['source_image']		= 'images/'.$article_date.'/'.$filename_original;
		$img_config['new_image'] 		= $filename_small;
		$img_config['maintain_ratio']	= TRUE;
		$img_config['width'] 			= 400;
		$img_config['height']			= 400;
		$this->load->library('image_lib', $img_config);
		$this->image_lib->resize();
		
		if($extension != ".gif") {
			// resize to large
			$filename_large = $filename_root.'_large'.$extension; //width: 1000px				
			$img_config2['image_library']	= 'gd2';
			$img_config2['source_image']	= 'images/'.$article_date.'/'.$filename_original;
			$img_config2['new_image'] 		= $filename_large;
			$img_config2['maintain_ratio']	= TRUE;
			$img_config2['width'] 			= 1000;
			$img_config2['height']			= 1000;
			$this->image_lib->clear(); // gotta clear the library config in-between operations
			$this->image_lib->initialize($img_config2);
			$this->image_lib->resize();		
		}
		else {
			// resizing breaks animation on animated gifs, which is the only reason to use gifs. 
			// so we leave the large version untouched. but we DO make a small unanimated version above, for home page and such,
			// because gifs can get big and leaving them big could really slow down homepage (if we ever got around to using gifs)
			// that said, it could be really cool having animated gifs on the home page. think about it. #todo
			// could detect only animated gifs, but probs not worth it: http://it.php.net/manual/en/function.imagecreatefromgif.php#59787
			$filename_large = $filename_original;
		}
		
		// add photo to database
		$this->attachments_model->add_photo($filename_small, $filename_large, $filename_original, $credit, $caption, $article_id, $article_photo_number);
		exit("Photo added.");
	}
	
	public function ajax_delete_photo($photo_id)
	{
		if(!bonus()) exit("Permission denied. Try refreshing and logging in again.");
		$this->attachments_model->delete_photo($photo_id);
		exit("Photo deleted.");
	}
	
	public function ajax_remove_photos($article_id)
	{
		if(!bonus()) exit("Permission denied. Try refreshing and logging in again.");
		exit($this->attachments_model->remove_article_photos($article_id));
	}
	
	public function ajax_bigphoto($article_id)
	{
		if(!bonus()) exit("Permission denied. Try refreshing and logging in again.");
		
		if($this->input->post("bigphoto") == 'true')
		{
			$this->article_model->set_bigphoto($article_id, true);
			exit("Bigphoto enabled.");
		}
		if($this->input->post("bigphoto") == 'false')
		{
			$this->article_model->set_bigphoto($article_id, false);
			exit("Bigphoto disabled.");
		}
	}
	
	public function ajax_add_attachment($article_id)
	{
		if(!bonus()) exit("Permission denied. Try refreshing and logging in again.");
				
		$type = trim(urldecode($this->input->post("type")));
		$content1 = trim(urldecode($this->input->post("content1")));
		$content2 = trim(urldecode($this->input->post("content2")));
		
		if($type == 'video') {
			$yt_id = youtube_id_from_url($content1);
			$vimeo_id = vimeo_id_from_url($content1);
			if($yt_id) {
				$type = 'youtube';
				$content1 = $yt_id;
			}
			elseif($vimeo_id) {
				$type = 'vimeo';
				$content1 = $vimeo_id;
			}
			else {
				exit("Error: unsupported video URL");
			}
			// #todo: youtube playlists
			// #todo: twitter widgets
			// #todo: soundcloud
			// #todo: flickr slideshows
			// #todo: raw html
			// #todo: rich text sidebars
		}
		else {
			exit("Error: unsupported attachment type, ".$type);
		}
		
		$db_data = array(
			'article_id'	=> $article_id,
			'type'			=> $type,
			'content1'		=> $content1,
			'content2'		=> $content2
			);
		$attachment_id = $this->attachments_model->add_attachment($db_data);
		$attachment = $this->attachments_model->get_attachment($attachment_id);
		exit($this->load->view('template/attachment-video', $attachment, true));
	}
	
	public function ajax_delete_article($article_id)
	{
		if(!bonus()) exit("Permission denied. Try refreshing and logging in again.");
		exit($this->article_model->delete_article($article_id));
	}
	
	public function ajax_suggest($table, $field)
	{
		if(!bonus()) exit("Permission denied. Try refreshing and logging in again.");

		// this general-purpose function is potentially wildly insecure.
		if(!($table == 'author' || $table == 'job' || $table == 'series')) exit("Disallowed.");
		
		$term = $this->input->get('term', true);
		$suggestions = $this->article_model->get_suggestions($table, $field, $term);
		exit(json_encode($suggestions));
	}
}
?>