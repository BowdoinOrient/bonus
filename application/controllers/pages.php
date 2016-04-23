<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/New_York');
        $this->load->model('attachments_model', '', TRUE);
        $this->load->model('pages_model', '', TRUE);
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function error()
    {
        // meta
        $data = new stdClass();

        $data->page_title = 'Page not found — The Bowdoin Orient';
        $data->page_description = '';
        $data->page_type = '';

        $this->load->view('error');
    }

    public function view($page)
    {
        // check if requested page exists, load if it does
        if (@file_exists(APPPATH."views/pages/{$page}.php"))
        {
            $data = new stdClass();
            $data->footerdata = new stdClass();
            $data->headerdata = new stdClass();

            $data->page_title = 'The Bowdoin Orient';
            $page_title = array(
                'about'            => 'About',
                'advertise'        => 'Advertise',
                'browser'        => 'Browser Warning',
                'contact'        => 'Contact',
                'ethics'         => 'Ethics',
                'nonremoval'    => 'Web Non-Removal Policy',
                'subscribe'        => 'Subscribe',
                'survey'        => 'Survey',
                'comments'        => 'Comment Policy',
                'quiz'        => 'College House Quiz',
                'apply'        => 'Bowdoin Orient Application'
                );
            if(isset($page_title[$page])) $data->page_title = $page_title[$page].' — The Bowdoin Orient';

            $data->page = $page;

            // Basically using content as a catch all for anything I want to
            // pass to a specific page
            $data->content = $this->pages_model->get_content($page);

            $data->footerdata->quote = $this->attachments_model->get_random_quote();
            $data->headerdata->date = date("Y-m-d");
            $this->load->view('pages/'.$page, $data);
        }
        else
        {
            $this->error();
        }
    }

    public function search()
    {
        $data = new stdClass();
        $data->footerdata = new stdClass();
        $data->headerdata = new stdClass();

        $data->query = $this->input->get("q");
        $data->footerdata->quote = $this->attachments_model->get_random_quote();
        $data->headerdata->date = date("Y-m-d");

        // meta
        if($data->query) { $data->page_title = 'Search results for "'.$data->query.'" — The Bowdoin Orient'; }
        else { $data->page_title = 'Search — The Bowdoin Orient'; }
        $data->page_description = '';
        $data->page_type = '';

        $this->load->view('search', $data);
    }

    public function advsearch()
    {
        $data = new stdClass();

        if($this->input->get())
        {
            $searchdata = $this->input->get();

            foreach ($searchdata as &$d) {
                $d = htmlspecialchars(htmlspecialchars($d));
            }

            $data->searchdata = $searchdata;
            $data->articles = $this->article_model->advsearch($this->input->get());
        }

        $this->load->helper('form');
        $data->footerdata = new stdClass();
        $data->headerdata = new stdClass();
        $data->footerdata->quote = $this->attachments_model->get_random_quote();
        $data->headerdata->date = date("Y-m-d");

        // meta
        $data->page_title = 'Advanced search — The Bowdoin Orient';
        $data->page_description = '';
        $data->page_type = '';

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

    public function isMobile()
    {
        echo (isMobile() ? "Yes, we think you're browsing on a mobile device." : "No, we don't think you're browsing on a mobile device.");
        exit(" If this is incorrect, email andrew.daniels714@gmail.com, including information on what browser and operating system you're using.");
    }

    public function isitivies()
    {
        if(time() < strtotime("2016-04-25 00:00:00")) $message = "No";
        else if(time() < strtotime("2016-04-27 00:00:00")) $message = "Basically";
        else if(time() < strtotime("2016-05-01 00:00:00")) $message = "Yes";
        else if(time() < strtotime("2016-05-02 00:00:00")) $message = "Not really";
        else if(time() < strtotime("2016-05-03 00:00:00")) $message = "You wish";
        else $message = "No";

        $data = new stdClass();

        $data->message = $message;
        $this->load->view('isitivies',$data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
