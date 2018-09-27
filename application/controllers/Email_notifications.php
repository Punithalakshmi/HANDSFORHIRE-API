<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Email_notifications extends Admin_controller
{
  protected $_email_validation_rules = array (
                 array('field' => 'employees[]', 'label' => 'Employees', 'rules' => 'trim|required'),
                 array('field' => 'subject', 'label' => 'Subject', 'rules' => 'trim|required'),
                 array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required'));
  function __construct()
  {
    parent::__construct();
    $this->load->model('email_notifications_model');
    $this->load->library('email');
    if(!is_logged_in())
      redirect('login/logout');
  }
	public function index()
	{
		$this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('subject' => 'Subject');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="'.site_url('email_notifications/add/{id}').'" class="btn btn-padding btn yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn red btn-padding" onclick="delete_record(\'email_notifications/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('email_notifications_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['btn'] = "<a href=".site_url('email_notifications/add')." class='btn green'>Add Email Notification <i class='fa fa-plus'></i></a>";
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
		$this->layout->view('frontend/email/index');
	}
	public function add($edit_id='')
	{
    $this->form_validation->set_rules($this->_email_validation_rules);
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $ins['employees'] = implode("#",$form['employees']);
      $ins['subject'] = $form['subject'];
      $ins['message'] = $form['message'];
      $ins['updated_date'] = date("Y-m-d H:i:s");
      $attachment = "";
      if(!empty($_FILES))
      {
        $attachment = $this->upload_files($_FILES['attachment']);
        $ins['attachment'] = $attachment;
      }
      // $this->send_email($form,$attachment);
      $ins_id = $this->email_notifications_model->insert($ins,"email_notifications");
      redirect('email_notifications/index');
    }
		$this->layout->view('frontend/email/email_notifications');
	}

  public function send_email($form,$attachment='')
  {
    $employees = $form['employees'];
    $subject = $form['subject'];
    $message = $form['message'];
    $from = get_user_data()['email'];
    $name = get_user_data()['firstname'];
    $this->email->from($from, $name);
    if($attachment!='')
    {
      $att = explode("###", $attachment);
      foreach ($att as $value)
      {
        $this->email->attach(base_url().$value);
      }
    }
    $this->email->to(implode(",",$employees));
    $this->email->subject($subject);
    $this->email->message($message);
    $this->email->send();
  }

  private function upload_files($files)
    {
      if(!file_exists("assets/attachment"))
      {
        mkdir("assets/attachment/", 0777);
      }
      $config = array(
          'upload_path'   => "assets/attachment/",
          'allowed_types' => 'jpg|gif|png',
          'overwrite'     => 1,                       
      );

      $this->load->library('upload', $config);

      $images = array();
      $i = 0;
      $data = "";$error="";
      foreach ($files as $key => $image)
      {
        $_FILES['attachment']['name']= $files['name'][$i];
        $_FILES['attachment']['type']= $files['type'][$i];
        $_FILES['attachment']['tmp_name']= $files['tmp_name'][$i];
        $_FILES['attachment']['error']= $files['error'][$i];
        $_FILES['attachment']['size']= $files['size'][$i];
        $this->upload->initialize($config);
        if ($this->upload->do_upload('attachment'))
        {
          $this->upload->data();
          $data .= "assets/attachment/".$files['name'][$i]."###";
        }
        else
        {
          $error[] = $this->upload->display_errors();
        }
        $i++;
      }
      return $data;
  }

}
?>