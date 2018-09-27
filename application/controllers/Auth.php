<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Auth extends Admin_controller
{
	
    protected $_forgot_validation_rules = array (array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required'),
                                                 array('field' => 'confrim_password', 'label' => 'Confrim Password', 'rules' => 'trim|required'));                       
                       
	function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    
  }

  public function index()
  {
  	redirect('user/employers');
  }
  
 function changepassword()
  {
     $this->form_validation->set_rules($this->_forgot_validation_rules);
     
     if($this->form_validation->run()){
        $form = $this->input->post();
        $new_password  = $form['new_password'];
        $conf_password = $form['confrim_password'];
        $id            = $form['id']; 
        
        $ins_data['password'] = md5($new_password);
        $this->db->query("update user set password='".md5($new_password)."' where id='".$id."'");
        //$this->user_model->update(array("id" => $id),$ins_data,"user");
       // echo $this->db->last_query();
        echo "Password changed successfully";
        die;
     }
     else
     {
        $this->layout->view("frontend/user/app_change_password");
     }
         
  }
  
   function notifications()
  {
    sendNotification('05EF4CA236B5A620C1E63677CAB0E6A981BE681B59F79EB2A1DA856E3FE9DBBF','test',2,5);
  }
  
}
?>
