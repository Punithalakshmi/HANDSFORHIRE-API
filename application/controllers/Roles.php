<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Roles extends Admin_controller
{
	protected $_roles_validation_rules = array (
			           array('field' => 'name', 'label' => 'Role Name', 'rules' => 'trim|required'),
			           array('field' => 'menu[]', 'label' => 'Menu', 'rules' => 'trim|required'),
			           array('field' => 'access[]', 'label' => 'Access Level', 'rules' => 'trim|required'));
	function __construct()
  {
    parent::__construct();
    $this->load->model('role_model');
    if(!is_logged_in())
      redirect('login/logout');
  }

  public function index()
  {
  	$this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('role' => 'Name');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="'.site_url('roles/add_role/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'roles/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('role_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['btn'] = "<a href=".site_url('roles/add_role')." class='btn green'>Add Role <i class='fa fa-plus'></i></a>";
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
  	$this->layout->view('frontend/roles/index');
  }

  public function add_role($edit_id='')
  {
  	$this->form_validation->set_rules($this->_roles_validation_rules);
  	if($edit_id)
  	{
  		$this->data['edit'] = $this->role_model->select(array("id"=>$edit_id),"role");
  	}
  	if($this->form_validation->run())
  	{
  		$form = $this->input->post();
  		$ins['role'] = $form['name'];
  		$ins['menu_id'] = json_encode($form['menu']);
  		$ins['action_id'] = json_encode($form['access']);
  		$ins['status'] = isset($form['active']) ? $form['active'] : "Inactive";
  		if($edit_id)
  		{
  			$ins['updated_date'] = date("Y-m-d H:i:s");
  			$ins_id = $this->role_model->update(array("id"=>$edit_id),$ins,"role");
  		}
  		else
  		{
  			$ins_id = $this->role_model->insert($ins,"role");
  			$this->session->set_flashdata('success_msg',"Role created successfully.",TRUE);
  		}
  		redirect('roles');
  	}
  	$this->layout->view('frontend/roles/add_role');
  }
  public function delete($del_id)
	{
  	$output['message'] ="Record deleted successfuly.";
  	$output['status']  = "success";
  	$this->role_model->delete(array("id"=>$del_id),"role");
  	$this->_ajax_output($output, TRUE);
	}
}
?>