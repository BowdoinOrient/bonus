<?php
class API extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/New_York');
		$this->load->model('issue_model', '', TRUE);
		$this->load->model('article_model', '', TRUE);
		$this->load->model('attachments_model', '', TRUE);
		$this->load->model('series_model', '', TRUE);
		$this->load->model('author_model', '', TRUE);
		$this->load->model('tools_model', '', TRUE);
		$this->load->model('api_model', '', TRUE);
	}
	
	public function index()
	{
		exit("No go!");
	}
	
	public function article_iphone($date, $section_id, $priority)
	{
		$article_id = $this->article_model->get_id_by_triplet($date, $section_id, $priority);		
		redirect('/article/'.$article_id, 'location');
	}
	
	/***************
	***** XML ******
	***************/

	public function xml_articlelist($issue_date, $section_id)
	{		
		/*
		header("Content-Type: application/xml; charset=UTF-8");
		echo '<?xml version="1.0" encoding="UTF-8" ?>
		<issue>
			<date>2012-12-07</date>
			<date_formatted>Dec 7, 2012</date_formatted>
			<issue_number>12</issue_number>
			<volume_numeral>142</volume_numeral>
			<section>1</section>
			<article id="7814">
				<title>Mills says College will not divest from fossil fuels</title>
				<author>Marisa McGarry</author>
				<thumb>http://bowdoinorient.com/images/2012-12-07/7814_1_small.jpg</thumb>
				<summary>President Mills said the College would not agree to divest the endowment of fossil fuels in the immediate future on Tuesday, just one day before Middlebury College announced plans to investigate the feasibility of divesting its own endowment.
					“At this point, we’re not prepared to commit to divest from fossil fuels, but I would never say never,” said President Mills on Tuesday afternoon, shortly after meeting with a group of students, led by Matthew Goodrich ’15, who petitioned for divestment.
		 			“We expressed to him that this is an issue that the student body cares very deeply about and that we really want to move forward with this,” Goodrich said.</summary>
			</article>
		</issue>';
		exit();
		*/
		
		$data = $this->api_model->articlelist($issue_date, $section_id);
		header("Content-Type: application/xml; charset=UTF-8");
		$this->load->view('api/xml_articlelist', $data);
	}
	
	public function xml_issuelist($volume)
	{
		$data->volume_arabic = $volume;
		
		$issue_query = $this->db->query("
			select
				date_format(issue.issue_date, '%b %e, %Y') as date,
				issue.issue_number,
				volume.arabic
			from issue
			inner join volume on issue.volume = volume.arabic
			where volume.roman = '".$data->volume_arabic."'
		");
		$data->issues = $issue_query->result();
		
		header("Content-Type: application/xml; charset=UTF-8");
		$this->load->view('api/xml_issuelist', $data);
	}
	
	public function xml_volumelist()
	{
		$volumes_query = $this->db->query("
			select `id`, `roman` from volume
		");
		$data->volumes = $volumes_query->result();
		
		header("Content-Type: application/xml; charset=UTF-8");
		$this->load->view('api/xml_volumelist', $data);
	}


	/********************
	******* JSON ********
	********************/

	public function json_articlelist ($issue_date, $section_id)
	{
		$data = $this->api_model->articlelist($issue_date, $section_id);
		header('Content-type: application/json');
		$this->load->view('api/json_articlelist', $data);
	}

	public function json_issuelist($volume)
	{
		$data->volume_arabic = $volume;
		$issue_query = $this->db->query("
			select
				date_format(issue.issue_date, '%b %e, %Y') as date,
				issue.issue_number,
				volume.arabic
			from issue
			inner join volume on issue.volume = volume.arabic
			where volume.roman = '".$data->volume_arabic."'
		");
		$data->issues = $issue_query->result();
		
		header('Content-type: application/json');
		$this->load->view('api/json_issuelist', $data);
	}

	public function json_volumelist()
	{
		$volumes_query = $this->db->query("
			select `id`, `roman` from volume
		");
		$data->volumes = $volumes_query->result();

		header('Content-type: application/json');
		$this->load->view('api/json_volumelist', $data);
	}
	
}
?>