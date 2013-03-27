class ReadWidget extends Controller {
    function ReadWidget(){
	parent::Controller();

	$data = array(
	    'readability' => FALSE,
	    'instapaper' => FALSE,
	    'kindle' => FALSE,
	    'pocket' => FALSE
	    );
	$this->load->view('export', $data);
    }
}