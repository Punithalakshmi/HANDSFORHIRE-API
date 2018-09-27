<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Profile extends Admin_controller
{
	protected $_profile_validation_rules = array (
			           array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
			           array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
			           array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'));
	function __construct()
  {
    parent::__construct();
    $this->load->model('profile_model');
    if(!is_logged_in())
      redirect('login/logout');
  }

  public function index()
  {
  	$this->form_validation->set_rules($this->_profile_validation_rules);
  	if($this->form_validation->run())
    {
    }
  	$this->layout->view('frontend/profile');
  }
}
?>