<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class User extends Admin_controller
{
	protected $_employer_validation_rules = array (
			           array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'),
			           array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
			           array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
			           array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim|required|valid_email'),
			           array('field' => 'address_1', 'label' => 'Address 1', 'rules' => 'trim|required'),
			           array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
			           array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'),
			           array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|integer'),
			           array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'));
   
    protected $_forgot_validation_rules = array (array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required'),
                                                 array('field' => 'confrim_password', 'label' => 'Confrim Password', 'rules' => 'trim|required'));                       
                       
	function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    if(!is_logged_in())
      redirect('login');
  }

  public function index()
  {
  	redirect('user/employers');
  }

  public function employers()
  {
  	$this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('firstname' => 'Firstname','lsatname'=>"Lastname",'email'=>'Email');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="'.site_url('user/add_employer/{id}').'" class="btn btn-padding btn yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'user/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('user_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['btn'] = "<a href=".site_url('user/add_employer')." class='btn green'>Add New Employer <i class='fa fa-plus'></i></a>";
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
  	$this->layout->view('frontend/user/employers');
  }

  public function employees()
  {
  	$this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('firstname' => 'Firstname','lsatname'=>"Lastname",'email'=>'Email');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="'.site_url('user/add_employee/{id}').'" class="btn yellow btn-padding table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn red btn-padding" onclick="delete_record(\'user/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('user_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['btn'] = "<a href=".site_url('user/add_employee')." class='btn green'>Add New Employee <i class='fa fa-plus'></i></a>";
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
  	$this->layout->view('frontend/user/employees');
  }

  public function add_employer($edit_id='')
  {
  	$this->form_validation->set_rules($this->_employer_validation_rules);
  	$this->data['edit'] = "";
  	if($edit_id)
  	{
  		$this->data['edit'] = $this->user_model->select(array("id"=>$edit_id,"usertype"=>"employer"),"user");
  	}
  	else
  	{
  		$this->form_validation->set_rules('email','Email','callback_email_check');
      $this->form_validation->set_rules('password','Password','required');
  		$this->form_validation->set_rules('username','Username','callback_username_check');
  	}
    if($this->form_validation->run())
    {
    	$form = $this->input->post();
    	$ins['firstname'] = $form['firstname'];
    	$ins['lastname'] = $form['lastname'];
    	$ins['email'] = $form['email'];
    	$ins['username'] = $form['username'];
    	$ins['address'] = $form['address_1']." ".$form['address_2'];
    	$ins['state'] = $form['state'];
    	$ins['city'] = $form['city'];
    	$ins['zipcode'] = $form['zipcode'];
    	// $ins['is_active'] = 1;
    	$ins['usertype'] = (isset($form['usertype']) && $form['usertype']!='')?$form['usertype']:"employee";
    	// $ins['updated_date'] = date("Y-m-d H:i:s");
    	if($edit_id)
      {
        if($form['password']!='')
          $ins['password'] = md5($form['password']);
    		$up = $this->user_model->update(array("id"=>$edit_id),$ins,"user");
        $this->session->set_flashdata('success_msg',"Employer updated successfully.",TRUE);
      }
    	else
    	{
        $ins['password'] = md5($form['password']);
    		$ins_id = $this->user_model->insert($ins,"user");
    		$this->session->set_flashdata('success_msg',"Employer created successfully.",TRUE);
    	}
    	redirect('user/employers');
    }
  	$this->layout->view('frontend/user/add_employer');
  }

  public function add_employee($edit_id='')
  {
  	$this->form_validation->set_rules($this->_employer_validation_rules);
  	$this->data['edit'] = "";
  	if($edit_id)
  	{
  		
  		$this->data['edit'] = $this->user_model->select(array("id"=>$edit_id),"user");
  	}
  	else
  	{
  		$this->form_validation->set_rules('email','Email','callback_email_check');
      $this->form_validation->set_rules('password','Password','required');
  		$this->form_validation->set_rules('username','Username','callback_username_check');
  	}
    if($this->form_validation->run())
    {
    	$form = $this->input->post();
    	$ins['firstname'] = $form['firstname'];
    	$ins['lastname'] = $form['lastname'];
    	$ins['email'] = $form['email'];
    	$ins['username'] = $form['username'];
    	$ins['address'] = $form['address_1']." ".$form['address_2'];
    	$ins['state'] = $form['state'];
    	$ins['city'] = $form['city'];
    	$ins['zipcode'] = $form['zipcode'];
    	// $ins['is_active'] = 1;
    	$ins['usertype'] = (isset($form['usertype']) && $form['usertype']!='')?$form['usertype']:"employee";
    	// $ins['updated_date'] = date("Y-m-d H:i:s");
    	if($edit_id)
      {
        if($form['password']!='')
          $ins['password'] = md5($form['password']);
    		$up = $this->user_model->update(array("id"=>$edit_id),$ins,"user");
        $this->session->set_flashdata('success_msg',"Employee updated successfully.",TRUE);
      }
    	else
    	{
        $ins['password'] = md5($form['password']);
    		$ins_id = $this->user_model->insert($ins,"user");
    		$this->session->set_flashdata('success_msg',"Employee created successfully.",TRUE);
    	}
    	redirect('user/employees');
    }
  	$this->layout->view('frontend/user/add_employee');
  }


  public function email_check($str)
  {
  	$chk_email = $this->user_model->callback_check(array("email"=>$str));
  	if($chk_email)
  	{
  		$this->form_validation->set_message('email_check', 'This Email-ID already exists.');
			return FALSE;
		}
		else
			return true;
  }

  public function username_check($str)
  {
  	$chk_username = $this->user_model->callback_check(array("username"=>$str));
  	if($chk_username){
  		$this->form_validation->set_message('username_check', 'This Username already exists.');
		return FALSE;
     }
     else
        return true;
  }

  public function delete($del_id)
  {
      	$output['message'] ="Record deleted successfuly.";
      	$output['status']  = "success";
      	$this->user_model->delete(array("id"=>$del_id),"user");
      	$this->_ajax_output($output, TRUE);
  }
  
  function changepassword()
  {
     $this->form_validation->set_rules($this->_forgot_validation_rules);
     
     if($this->form_validation->run()){
        $form = $this->input->post();
        $new_password  = $form['new_password'];
        $conf_password = $form['confrim_password'];
        $id            = $_GET['id'];
        
        $ins_data['password'] = md5($new_password);
        $this->user_model->delete("user",$ins_data,array("id" => $id));
     }    
  }
  
 
  
//  function sendNotification($deviceToken,$message,$params,$apple_identifier)
// {
//        
//        //Setup stream (connect to Apple Push Server)
//        $ctx = stream_context_create();
//        stream_context_set_option($ctx, 'ssl', 'passphrase', 'test');
//        stream_context_set_option($ctx, 'ssl', 'local_cert', 'hfhprod.pem');
//        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
//       
//        stream_set_blocking($fp, 0); 
//       
//       
//        // Create the payload body
//        $body['aps'] = array(
//                             'alert'     => array('body' => $message),
//                             'sound'     => 'default',
//                             'badge'     => 1
//		                   );
//			
//           // Keep push alive (waiting for delivery) for 90 days
//            $apple_expiry = time() + (1 * 24 * 60 * 60); 
//            
//            $payload = json_encode($body);
//                        
//            // Enhanced Notification
//            $msg = pack("C", 1) . pack("N", $apple_identifier) . pack("N", $apple_expiry) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload; 
//                        
//            // SEND PUSH
//            fwrite($fp, $msg);
//            
//            usleep(500000);
//            
//            checkAppleErrorResponse($fp);
//            
//            echo "success";
//            
//            fclose($fp);   
//    }
//    
//    function checkAppleErrorResponse($fp) 
//    {
//
//        $apple_error_response = fread($fp, 6);
//        
//        if ($apple_error_response) {
//        
//        // unpack the error response (first byte 'command" should always be 8)
//        $error_response = unpack('Ccommand/Cstatus_code/Nidentifier', $apple_error_response); 
//        
//        if ($error_response['status_code'] == '0') {
//        $error_response['status_code'] = '0-No errors encountered';
//        
//        } else if ($error_response['status_code'] == '1') {
//        $error_response['status_code'] = '1-Processing error';
//        
//        } else if ($error_response['status_code'] == '2') {
//        $error_response['status_code'] = '2-Missing device token';
//        
//        } else if ($error_response['status_code'] == '3') {
//        $error_response['status_code'] = '3-Missing topic';
//        
//        } else if ($error_response['status_code'] == '4') {
//        $error_response['status_code'] = '4-Missing payload';
//        
//        } else if ($error_response['status_code'] == '5') {
//        $error_response['status_code'] = '5-Invalid token size';
//        
//        } else if ($error_response['status_code'] == '6') {
//        $error_response['status_code'] = '6-Invalid topic size';
//        
//        } else if ($error_response['status_code'] == '7') {
//        $error_response['status_code'] = '7-Invalid payload size';
//        
//        } else if ($error_response['status_code'] == '8') {
//        $error_response['status_code'] = '8-Invalid token';
//        
//        } else if ($error_response['status_code'] == '255') {
//        $error_response['status_code'] = '255-None (unknown)';
//        
//        } else {
//        $error_response['status_code'] = $error_response['status_code'].'-Not listed';
//        
//        }
//     
//        return true;
//        }
//               
//        return false;
//}
}
?>