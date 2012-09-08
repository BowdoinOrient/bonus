<?php
class Series extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/New_York');
		$this->load->model('series_model','',TRUE);
		$this->load->model('article_model', '', TRUE);
		$this->load->model('attachments_model', '', TRUE);
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
		$series = $this->series_model->get_series($id);
		
		if(!$series) 
		{
			$this->error("No such series exists.");
		}
		else
		{
			$data->footerdata->quote = $this->attachments_model->get_random_quote();
			$data->headerdata->date = date("Y-m-d");
			$data->series = $series;
			$data->articles = $this->article_model->get_articles_by_date(date("Y-m-d"), false, false, false, false, false, $id);
						
			$this->load->view('series', $data);
		}
	}
	
}
?>