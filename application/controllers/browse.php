<?php
class Browse extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/New_York');
		$this->load->model('issue_model', '', TRUE);
		$this->load->model('article_model', '', TRUE);
		$this->load->model('attachments_model', '', TRUE);
		$this->load->model('tools_model', '', TRUE);
	}
	
	public function index()
	{
		$this->date();
	}
	
	public function error($message = '')
	{
		$data->message = $message;
		$this->load->view('error', $data);
	}
	
	public function date($date = '')
	{
		// just for testing
		//$this->output->enable_profiler(TRUE);
		
		// if no date specified, use current date
		if(!$date) $date = date("Y-m-d");
		$date_week_ago = date("Y-m-d", time()-(7*24*60*60));
		
		// get last updated date, PRIOR TO $date requested.
		$last_updated = $this->article_model->get_last_updated($date);
		$last_updated_week_ago = date("Y-m-d", strtotime($last_updated)-(7*24*60*60));
		$last_updated_fivemonths_ago = date("Y-m-d", strtotime($last_updated)-(5*4*7*24*60*60));
				
		// get latest issue <= date specified
		$issue = $this->issue_model->get_latest_issue($date);
				
		if(!$issue)
		{
			$this->error();
		}
		else
		{
			$volume = $issue->volume;
			$issue_number = $issue->issue_number;
			
			// get adjacent issues (for next/prev buttons)
			$nextissue = $this->issue_model->get_adjacent_issue($volume, $issue_number, 1);
			$previssue = $this->issue_model->get_adjacent_issue($volume, $issue_number, -1);
			
			// scribd
			$scribd_thumb_url = false;
			if($issue->scribd) {
				$ch = curl_init();	
				curl_setopt($ch, CURLOPT_URL, "http://api.scribd.com/api?method=thumbnail.get&api_key=34m5pzwzt3fqi0fod70cc&doc_id=".$issue->scribd);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$scribd_thumb_response = curl_exec($ch);
				curl_close($ch);

				if(!empty($scribd_thumb_response)){
					$scribd_thumb = new SimpleXMLElement($scribd_thumb_response);
					$scribd_thumb_url = $scribd_thumb->thumbnail_url;
				}
			}
						
			// latest articles
			$latest = $this->article_model->get_articles_by_date($date, false, false, '10');
			
			// featured articles for footer
			$featured = $this->article_model->get_articles_by_date($date, false, false, '5', true);
			
			// popular articles for carousel
			$popular = $this->article_model->get_popular_articles_by_date($last_updated, $last_updated_week_ago, '10');
			// elasticity: zoom out to most popular of past five months if we've gone stale
			if(count($popular) < 10) {
				$popular = $this->article_model->get_popular_articles_by_date($last_updated, $last_updated_fivemonths_ago, '10');
			}
			
			// get random quote
			$data->footerdata->quote = $this->attachments_model->get_random_quote();
			
			// get sections
			$sections = $this->issue_model->get_sections();
			
			foreach($sections as $section)
			{
				// get section articles
				$articles[$section->name] = $this->article_model->get_articles_by_date($date, $date_week_ago, $section->id);
				if(count($articles[$section->name]) < 10) 
				{
					$articles[$section->name] = $this->article_model->get_articles_by_date($date, false, $section->id, 10);
				}
			}
			
			// load data, view
			
			$data->headerdata->date = $date;
			$data->headerdata->volume = $volume;
			$data->headerdata->issue_number = $issue_number;
			$data->headerdata->issue = $issue;
			$data->headerdata->alerts = $this->tools_model->get_alerts();
			
			$data->date = $date;
			$data->issue = $issue;
			$data->scribd_thumb_url = $scribd_thumb_url;
			$data->nextissue = $nextissue;
			$data->previssue = $previssue;
			$data->latest = $latest;
			$data->featured = $featured;
			$data->popular = $popular;
			$data->sections = $sections;
			$data->articles = $articles;
			
			// meta
			$data->page_title = '';
			$data->page_description = '';
			$data->page_type = '';
			
			$this->load->view('browse', $data);
		}
	}
	
	public function issue($volume,$issue_number)
	{
		// get issue
		$issue = $this->issue_model->get_issue($volume, $issue_number);
		
		if(!$issue)
		{
			$this->error();
		}
		else
		{
			redirect('browse/'.$issue->issue_date, 'refresh');
			
			/*
			// get adjacent issues (for next/prev buttons)
			$nextissue = $this->issue_model->get_adjacent_issue($volume, $issue_number, 1);
			$previssue = $this->issue_model->get_adjacent_issue($volume, $issue_number, -1);
			
			// popular articles
			$popular = $this->article_model->get_popular_articles($volume, $issue_number, '10'); 
			
			// get random quote
			$data->footerdata->quote = $this->attachments_model->get_random_quote();
			
			// get sections
			$sections = $this->issue_model->get_sections();
			
			foreach($sections as $section)
			{
				// get articles
				$articles[$section->name] = $this->article_model->get_articles($volume, $issue_number, $section->id);
			}
			
			// load data, view
			$data->issue = $issue;
			$data->nextissue = $nextissue;
			$data->previssue = $previssue;
			$data->popular = $popular;
			$data->sections = $sections;
			$data->articles = $articles;	
			$this->load->view('browse', $data);
			*/
		}
	}
}
?>