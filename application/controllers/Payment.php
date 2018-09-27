<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Payment extends Admin_controller
{
	protected $_card_validation_rules = array (
			           array('field' => 'name', 'label' => 'Card Holder Name', 'rules' => 'trim|required'),
			           array('field' => 'card_number', 'label' => 'Card Number', 'rules' => 'trim|required|integer|min_length[16]|max_length[16]'),
			           array('field' => 'exp_month', 'label' => 'Expiry Month', 'rules' => 'trim|required'),
                 array('field' => 'exp_year', 'label' => 'Expiry Year', 'rules' => 'trim|required'),
                 array('field' => 'cvv', 'label' => 'CVV', 'rules' => 'trim|required|integer|max_length[5]|min_length[3]'),
                 array('field' => 'card_type', 'label' => 'Card Type', 'rules' => 'trim|required'));
  protected $_account_validation_rules = array (
                 array('field' => 'name', 'label' => 'Name on Account', 'rules' => 'trim|required'),
                 array('field' => 'routing_number', 'label' => 'Routing Number', 'rules' => 'trim|required|integer'),
                 array('field' => 'acc_number', 'label' => 'Accouting Number', 'rules' => 'trim|required|integer'),
                 array('field' => 're_acc_number', 'label' => 'Re-type Accounting Number', 'rules' => 'trim|required|integer|matches[acc_number]'),
                 array('field' => 'driver_license', 'label' => 'Driver License Number', 'rules' => 'trim|required'),
                 array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'));
   protected $_paypal_validation_rules = array (
                 array('field' => 'email', 'label' => 'Paypal Email-ID', 'rules' => 'trim|required|valid_email'),
                 array('field' => 'api_key', 'label' => 'API Key', 'rules' => 'trim|required'),
                 array('field' => 'api_signature', 'label' => 'API Signature', 'rules' => 'trim|required'));
	function __construct()
  {
    parent::__construct();
    $this->load->model('payment_model');
    if(!is_logged_in())
      redirect('login/logout');
  }

  public function index()
  {
    redirect('payment/payment_methods');
  }

  public function credit_card()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('name' => 'Name','card_number'=>'Card Number','card_type'=>'Card Type');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="javascript:void(0);" style="font-size:11px;" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn green" onclick="make_card_default(\'payment/make_card_default/{id}/credit_card\',this);">Make Default</a><a href="'.site_url('payment/add_card/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'payment/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('payment_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['btn'] = "<a href=".site_url('payment/add_card')." class='btn green'>Add Card <i class='fa fa-plus'></i></a>";
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
    $this->layout->view('frontend/payment/credit_card');
  }
  public function checking_account()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('name' => 'Name','card_number'=>'Card Number','card_type'=>'Card Type');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="javascript:void(0);" style="font-size:11px;" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn green" onclick="make_card_default(\'payment/make_card_default/{id}/checking_account\',this);">Make Default</a><a href="'.site_url('payment/add_account/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'payment/delete_account/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('payment_model', 'account_listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['btn'] = "<a href=".site_url('payment/add_account')." class='btn green'>Add Account <i class='fa fa-plus'></i></a>";
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
    $this->layout->view('frontend/payment/checking_account');
  }

  public function paypal($id='')
  {
    $this->form_validation->set_rules($this->_paypal_validation_rules);
    if($this->session->userdata('user_data')['role']=="6")
      $this->data['edit'] = $this->payment_model->select(array("employer_id"=>$this->session->userdata('user_data')['id']),"paypal");
    else
      $this->data['edit'] = $this->payment_model->select(array("id"=>$id),"paypal");
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $ins['id'] = $form['edit_id'];
      $ins['email_id'] = $form['email'];
      $ins['api_key'] = $form['api_key'];
      if($this->session->userdata('user_data')['role']=="6")
        $ins['employer_id'] = $this->session->userdata('user_data')['id'];
      else
        $ins['employer_id'] = $form['employer_id'];
      $ins['api_signature'] = $form['api_signature'];
      if($form['edit_id'])
      {
        $ins['updated_date'] = date("Y-m-d H:i:s");
        $this->session->set_flashdata('success_msg',"Paypal Info updated successfully.",TRUE);
        $update = $this->payment_model->update(array("id"=>$form['edit_id']),$ins,"paypal");
      }
      else
      {
        $this->session->set_flashdata('success_msg',"Paypal Info created successfully.",TRUE);
        $ins_id = $this->payment_model->insert($ins,"paypal");
      }
      if($this->session->userdata('user_data')['role']=="6")
        redirect("payment/paypal");
      else
        redirect("payment/paypal_listing");
    }
    $this->layout->view('frontend/payment/paypal');
  }

  public function add_card($edit_id='')
  {
    $this->form_validation->set_rules($this->_card_validation_rules);
    if($edit_id)
    {
      $this->data['edit'] = $this->payment_model->select(array("id"=>$edit_id),"credit_card");
    }
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $ins['name'] = $form['name'];
      $ins['card_number'] = $form['card_number'];
      $ins['exp_month'] = $form['exp_month'];
      $ins['exp_year'] = $form['exp_year'];
      $ins['cvv'] = $form['cvv'];
      if($this->session->userdata('user_data')['role']=="6")
        $ins['employer_id'] = $this->session->userdata('user_data')['id'];
      else
        $ins['employer_id'] = $form['employer_id'];
      $ins['default_card'] = isset($form['default_card']) ? "1" : "0";
      if(isset($form['default_card']))
      {
        $up['default_card'] = 0;
        $update = $this->payment_model->update(array("employer_id"=>$ins['employer_id']),$up,"credit_card");
      }
      if($edit_id)
      {
        $this->session->set_flashdata('success_msg',"Card updated successfully.",TRUE);
        $update = $this->payment_model->update(array("id"=>$edit_id),$ins,"credit_card");        
      }
      else
      {
        $this->session->set_flashdata('success_msg',"Card added successfully.",TRUE);
        $ins_id = $this->payment_model->insert($ins,"credit_card");        
      }
      redirect('payment/credit_card');
    }
    $this->layout->view("frontend/payment/add_card");
  }

  public function add_account($edit_id='')
  {
    $this->form_validation->set_rules($this->_account_validation_rules);
    if($edit_id)
    {
      $this->data['edit'] = $this->payment_model->select(array("id"=>$edit_id),"checking_account");
    }
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $ins['name'] = $form['name'];
      $ins['routing_number'] = $form['routing_number'];
      $ins['account_number'] = $form['acc_number'];
      $ins['license_number'] = $form['driver_license'];
      if($this->session->userdata('user_data')['role']=="6")
        $ins['employer_id'] = $this->session->userdata('user_data')['id'];
      else
        $ins['employer_id'] = $form['employer_id'];
      $ins['state'] = $form['state'];
      if($edit_id)
      {
        $ins['updated_date'] = date("Y-m-d H:i:s");
        $this->session->set_flashdata('success_msg',"Checking Account updated successfully.",TRUE);
        $update = $this->payment_model->update(array("id"=>$edit_id),$ins,"checking_account");
      }
      else
      {
        $this->session->set_flashdata('success_msg',"Checking Account added successfully.",TRUE);
        $ins_id = $this->payment_model->insert($ins,"checking_account");
      }
      redirect('payment/checking_account');
    }
    $this->layout->view('frontend/payment/add_account');
  }

  public function payment_history()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('b.firstname' => 'Employer','a.amount' => 'Amount','a.tnx_id'=>'Transaction ID','a.status'=>'Status','a.created_date'=>'Payment Date');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '&nbsp;';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('payment_model', 'payment_history','no');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
    $this->layout->view('frontend/payment/payment_history');
  }
  
  public function delete($del_id)
  {
    $output['message'] ="Record deleted successfuly.";
    $output['status']  = "success";
    $this->payment_model->delete(array("id"=>$del_id),"credit_card");
    $this->_ajax_output($output, TRUE);
  }

  public function delete_paypal($del_id)
  {
    $output['message'] ="Record deleted successfuly.";
    $output['status']  = "success";
    $this->payment_model->delete(array("id"=>$del_id),"paypal");
    $this->_ajax_output($output, TRUE);
  }
   public function delete_account($del_id)
  {
    $output['message'] ="Record deleted successfuly.";
    $output['status']  = "success";
    $this->payment_model->delete(array("id"=>$del_id),"checking_account");
    $this->_ajax_output($output, TRUE);
  }
  public function make_card_default($card_id,$table)
  {
    $output['table'] = $table;
    $output['message'] ="Card updated successfuly.";
    $output['status']  = "success";
    $get = $this->payment_model->select(array("id"=>$card_id),$table);
    $employer_id = $get['employer_id'];
    if($table=="credit_card")
    {
      $up['default_card'] = "1";
      $up1['default_card'] = 0;
    }
    else if($table=="checking_account")
    {
      $up['default_account'] = "1";
      $up1['default_account'] = 0;
    }
   $this->payment_model->update(array("employer_id"=>$employer_id),$up1,$table);
   $this->payment_model->update(array("id"=>$card_id),$up,$table);
    $this->_ajax_output($output, TRUE);
  }

  public  function paypal_listing()
  {
     if($this->session->userdata('user_data')['role']=="6")
      redirect('payment/paypal');
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('b.firstname'=>"Employer",'a.email_id' => 'Email','a.api_key'=>'API Key','a.api_signature'=>'API Signature');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="'.site_url('payment/paypal/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'payment/delete_paypal/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('payment_model', 'paypal_listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['btn'] = "<a href=".site_url('payment/paypal')." class='btn green'>Add Account <i class='fa fa-plus'></i></a>";
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
    $this->layout->view('frontend/payment/paypal_listing');
  } 
}
?>
