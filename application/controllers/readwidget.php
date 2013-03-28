<?
class ReadWidget extends CI_Controller {
   public function __construct(object $clickedid) {
       parent::__construct();
       ReadWidget($clickedid);
   }
    public function ReadWidget(object $clickedid){
	parent::Controller();
	echo "haaaaay";
	print "hey there";
	$data = array(
	    'readability' => FALSE,
	    'instapaper' => FALSE,
	    'kindle' => FALSE,
	    'pocket' => FALSE
	    );
	print $this->load->view('export', $data);
    }
}
?>