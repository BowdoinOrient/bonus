<?php
class Bonus extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/New_York');
        $this->load->model('bonus_model', '', TRUE);
        $this->load->model('attachments_model', '', TRUE);
        $this->load->model('author_model', '', TRUE);
        $this->load->model('tools_model', '', TRUE);
        $this->load->model('ad_model', '', TRUE);
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
        $data = new stdClass();
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
            $data = new stdClass;

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
    
    function alerts()
    {
        if($this->session->userdata('logged_in'))
        {
            if (!empty($_POST))
            {
                $insertdata = array(
                    'message'         => $this->input->post("message"),
                    'start_date'         => $this->input->post("start_date"),
                    'end_date'         => $this->input->post("end_date"),
                    'urgent'        => ($this->input->post("urgent") == '1' ? '1' : '0')
                );
                $this->tools_model->add_alert($insertdata);
            }
            
            $this->load->helper(array('form'));
            
            $data = new stdClass();

            $data->quote = $this->attachments_model->get_random_quote(false);
            $data->alerts = $this->tools_model->get_alerts(true);
            $this->load->view('bonus/alerts', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('bonus/login', 'refresh');
        }
    }
    

    function ads() {
        if($this->session->userdata('logged_in'))
        {
            if (!empty($_POST))
            {
                $insertdata = array(
                    'sponsor'         => $this->input->post("sponsor"),
                    'start_date'     => $this->input->post("start_date"),
                    'end_date'         => $this->input->post("end_date"),
                    'link'            => $this->input->post("link"),
                );

                $extension = $this->input->post("extension");

                $config['upload_path']         = 'ads/';
                $config['allowed_types']     = 'jpeg|jpg|png';
                $config['max_size']            = '1000';
                $config['max_width']          = '1280';
                $config['max_height']          = '1280';
                $config['file_name']        = "ad".($this->ad_model->count_ads()+1);

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('filename')){
                    exit(var_dump($this->upload->display_errors()));
                } else {
                    $uploaddata = $this->upload->data();
                    $insertdata['filename'] = "ad".($this->ad_model->count_ads()+1).$uploaddata['file_ext'];
                    $this->ad_model->create_ad($insertdata);
                }
            }

            $this->load->helper(array('form'));

            $data = new stdClass;

            $data->quote = $this->attachments_model->get_random_quote(false);
            $data->ads = $this->ad_model->get_ads();

            $this->load->view('bonus/ads', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('bonus/login', 'refresh');
        }
    }

    function ajax_delete_ad($ad_id){
        if(!bonus()) exit("Permission denied. Try refreshing and logging in again.");
        if($this->input->post('remove')=='true') {
            $this->ad_model->delete_ad($ad_id);
            exit("Ad deleted.");
        }
        else {
            exit("Delete request wasn't sent properly.");
        }
    }

    function issues()
    {
        if($this->session->userdata('logged_in'))
        {
            
            if (!empty($_POST))
            {
                $insertdata = array(
                    'volume'         => $this->input->post("volume"),
                    'issue_number'         => $this->input->post("number"),
                    'issue_date'         => $this->input->post("publish_date"),
                    'scribd'        => $this->input->post("id"),
                    'ready'            => "1",
                );

                $issue_exists = $this->tools_model->get_issue($insertdata['volume'], $insertdata['issue_number']);

                if (!$issue_exists){
                    $this->tools_model->add_issue($insertdata);
                } else {
                    $this->tools_model->add_scribd($insertdata['volume'], $insertdata['issue_number'], $insertdata['scribd']);
                }
            }

            $this->load->helper(array('form'));
            $data = new stdClass();
            $data->quote = $this->attachments_model->get_random_quote(false);
            $data->issues = $this->tools_model->get_issues();

            foreach ($data->issues as $issue) {
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
                        $issue->preview = $scribd_thumb->thumbnail_url;
                    }
                }
            }

            $this->load->view('bonus/issues', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('bonus/login', 'refresh');
        }
    }

    function deletealert($id)
    {
        if($this->session->userdata('logged_in'))
        {
            $this->tools_model->delete_alert($id);
            redirect('bonus/alerts');
        }
        else
        {
            //If no session, redirect to login page
            redirect('bonus/login', 'refresh');
        }
    }
    
    function authors()
    {
        if($this->session->userdata('logged_in'))
        {
            if (!empty($_POST))
            {
                if($this->input->post("form_name")=='merge_authors')
                {
                    $this->author_model->merge_authors($this->input->post("merge_from"),$this->input->post("merge_into"));
                }
            }
            
            $this->load->helper(array('form'));
            
            $data = new stdClass();
            $data->authors = $this->author_model->get_authors();
            $data->authors_array = $this->author_model->get_authors_array();
            $data->quote = $this->attachments_model->get_random_quote(false);
            $this->load->view('bonus/authors', $data);
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
    
    function ajax_logout()
    {
        if($this->input->post('logout') == 'true') {        
            $this->session->unset_userdata('logged_in');
            $this->session->sess_destroy();
            $response['success'] = true;
            $response['status'] = "Logging out...";
            exit(json_encode($response));
        }
        else
        {
            $response['success'] = false;
            $response['status'] = "Logout failed";
            exit(json_encode($response));
        }
    }
    
    /**
     * http://www.codefactorycr.com/login-with-codeigniter-php.html
     **/
    function verifylogin()
    {
        //This method will have the credentials validation
        $this->load->library('form_validation');
        
        // note: not running xss_clean because it was corrupting the input for certain usernames/passwords
        // this is potentially dangerous, i guess? i dunno dude.

        /* 
         * brian's note: no, it's not really dangerous. Input should be checked for SQL injection. 
         * Output should be checked for XSS. Codeigniter doesn't get this, and their xss_clean() function is shit anyways.
         * see http://stackoverflow.com/a/10926392/2178152 and other related discussions
         * also http://ponderwell.net/2010/08/codeigniter-xss-protection-is-good-but-not-enough-by-itself/
         * we do SQL injection already, and the only place on the website there's output displayed not from the database
         * is on the adanced search page. So I added some XSS protection there. Check over there if you want to implement it in more places.
         */ 

        
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
        
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
    
    function ajax_verifylogin()
    {
        header('Access-Control-Allow-Origin: http://bowdoinorient.com');
        header('Access-Control-Allow-Origin: http://www.bowdoinorient.com');

        if($this->check_database($this->input->post('password'))) {
            $response['success'] = true;
            $response['status'] = "Logging in...";
            exit(json_encode($response));
        }
        else
        {
            $response['success'] = false;
            $response['status'] = "Denied";
            exit(json_encode($response));
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