<?php
class Bonus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bonus_model', '', TRUE);
		$this->load->model('attachments_model', '', TRUE);
		$this->load->model('tools_model', '', TRUE);
		$this->load->library('user_agent');
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			//If logged in, show dashboard
			$this->dashboard();
		}
		else
		{
			//If no session, show login
			$this->login();
		}
	}
	
	public function error($message = '')
	{
		$data->message = $message;
		$this->load->view('error', $data);
	}
	
	public function login()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect('browse', 'refresh');
		}
		$this->load->helper(array('form'));
		$data->quote = $this->attachments_model->get_random_quote();
		
		if($this->agent->is_referral()) 
		{ 
			$data->referrer = $this->agent->referrer();
		}
		else
		{
			$data->referrer = '';
		}
		$this->load->view('bonus/login', $data);
	}
	
	function dashboard()
	{
		if($this->session->userdata('logged_in'))
		{
			$data->quote = $this->attachments_model->get_random_quote(false);
			$data->tips = $this->tools_model->get_tips();
			$this->load->view('bonus/dashboard', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('bonus/login', 'refresh');
		}
	}
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('browse', 'refresh');
	}
	
	
	/**
	 * http://www.codefactorycr.com/login-with-codeigniter-php.html
	 **/
	function verifylogin()
	{
		//This method will have the credentials validation
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		
		if($this->form_validation->run() == FALSE)
		{
			//Field validation failed.  User redirected to login page
			$this->login();
		}
		else
		{
			//Go to private area			
			if($this->input->post('referrer'))
			{
				redirect($this->input->post('referrer'), 'refresh');
			}
			else
			{
				redirect('browse', 'refresh');
			}
		}	
	}
	
	/**
	 * http://www.codefactorycr.com/login-with-codeigniter-php.html
	 **/
	function check_database($password)
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');
		
		//query the database
		$result = $this->bonus_model->login($username, $password);
		
		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'DENIED');
			return false;
		}
	}
	
}
?>