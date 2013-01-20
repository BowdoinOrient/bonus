<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/New_York');
		$this->load->model('attachments_model', '', TRUE);
	}
	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function error()
	{
		$this->load->view('error');
	}
	
	public function about()
	{
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('about', $data);
	}
	
	public function ethics()
	{
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('ethics', $data);
	}
	
	public function nonremoval()
	{
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('nonremoval', $data);
	}
	
	public function contact()
	{
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('contact', $data);
	}
	
	public function subscribe()
	{
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('subscribe', $data);
	}
	
	public function advertise()
	{
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('advertise', $data);
	}
	
	public function search()
	{
		$data->query = $this->input->get("q");
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('search', $data);
	}
	
	public function advsearch()
	{
		if($this->input->get())
		{
			$data->searchdata = $this->input->get();
			$data->articles = $this->article_model->advsearch($this->input->get());
		}
		
		$this->load->helper('form');
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('advsearch', $data);
	}
	
	public function phpinfo()
	{
		if(!bonus()) 
		{
			$this->load->view('error');
		}
		else
		{
			exit(phpinfo());
		}
	}
	
	public function survey()
	{
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('survey', $data);
	}
	
	public function archives()
	{
		$data->footerdata->quote = $this->attachments_model->get_random_quote();
		$data->headerdata->date = date("Y-m-d");
		$this->load->view('archives', $data);
	}
	
	public function isMobile()
	{
		echo (isMobile() ? "Yes, we think you're browsing on a mobile device." : "No, we don't think you're browsing on a mobile device.");
		exit(" If this is incorrect, email tophtucker@gmail.com, including information on what browser and operating system you're using.");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */