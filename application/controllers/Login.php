<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Login extends Admin_controller 
{
   protected $_login_validation_rules =array (
                          array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required'),
                          array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'));
    function __construct()
    {
      parent::__construct();
      $this->load->model('login_model');
    }  
    public function index()
    {
        if(is_logged_in())
          redirect('dashboard');
        $this->layout->view('frontend/login');
    }
    public function login()
    {
      $this->form_validation->set_rules($this->_login_validation_rules);
      if($this->form_validation->run())
      {
        $form = $this->input->post();
        $chk = $this->login_model->login($form['email'],$form['password']);
        if($chk)
        {
          if($form['remember']=='1')
            setcookie("login",json_encode($form),time() + (86400 * 30), "/");
          $this->session->set_userdata('user_data',$chk);
          redirect('dashboard');
        }
        else
        {
        	$chk1 = $this->login_model->login_user($form['email'],$form['password']);
        	if($chk1)
        	{
          	if($form['remember']=='1')
            	setcookie("login",json_encode($form),time() + (86400 * 30), "/");
	          $this->session->set_userdata('user_data',$chk1);
	          redirect('dashboard');
          }
          else
          {
          	$this->session->set_flashdata("log_fail","Email or Password is Incorrect.",TRUE);
          	redirect('login');
          }
        }
      }
      else
        $this->layout->view('frontend/login');
    }
    public function logout()
    {
      // $form = $this->input->post();
      $this->session->sess_destroy('user_data');
      redirect('login');
    }
}
?>