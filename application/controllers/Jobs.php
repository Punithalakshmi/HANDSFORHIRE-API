<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Jobs extends Admin_controller
{

	protected $_category_validation_rules = array (
			           array('field' => 'name', 'label' => 'Category Name', 'rules' => 'trim|required'));
	protected $_job_validation_rules = array (
			           array('field' => 'job_name', 'label' => 'Job Name', 'rules' => 'trim|required'),
			           array('field' => 'category', 'label' => 'Category Name', 'rules' => 'trim|required'),
			           array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'),
			           array('field' => 'job_date', 'label' => 'Job Date', 'rules' => 'trim|required'),
			           array('field' => 'start_time', 'label' => 'Start Time', 'rules' => 'trim|required'),
			           array('field' => 'end_time', 'label' => 'End Time', 'rules' => 'trim|required'),
			           array('field' => 'amount', 'label' => 'Amount', 'rules' => 'trim|required|integer'),
			           array('field' => 'recurring', 'label' => 'Payment Type', 'rules' => 'trim|required'),
			           array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
			           array('field' => 'address_include', 'label' => 'Include Post', 'rules' => 'trim|required'),
			           array('field' => 'logo', 'label' => 'Logo', 'rules' => 'trim|required'),);

	function __construct()
  {
    parent::__construct();
    $this->load->model('jobs_model');
    if(!is_logged_in())
      redirect('login/logout');
  }
  public function index()
  {
  	redirect('jobs/job_list');
  }
  public function job_list()
  {
  	$this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('a.job_name' => 'Job Name','b.name'=>'Category','a.job_date'=>'Job Date','a.address'=>'Address');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="'.site_url('jobs/add_job/{id}').'" class="btn btn btn-padding yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'jobs/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('jobs_model', 'job_listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['btn'] = "<a href=".site_url('jobs/add_job')." class='btn green'>Add New Job <i class='fa fa-plus'></i></a>";
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
  	$this->layout->view('frontend/jobs/jobs_list');
  }

  public function add_job($edit_id='')
  {
  	$this->form_validation->set_rules($this->_job_validation_rules);
  	if($edit_id)
  	{
  		$this->data['edit'] = $this->jobs_model->select(array("id"=>$edit_id),"jobs");
  	}
  	if($this->form_validation->run())
    {
  		$form = $this->input->post();
  		$ins['job_name'] = $form['job_name'];
  		$ins['job_category'] = $form['category'];
  		$ins['description'] = $form['description'];
  		$ins['job_date'] = $form['job_date'];
  		$ins['start_time'] = $form['start_time'];
  		$ins['end_time'] = $form['end_time'];
  		$ins['amount'] = $form['amount'];
  		$ins['recurring'] = $form['recurring'];
  		$ins['address'] = $form['address'];
  		$ins['logo'] = $form[''];
  		$ins['address_include'] = $form['address_include'];
  		$ins['status'] = 1;
  		$ins['logo'] = '';
  		$ins['updated_date'] = date("Y-m-d H:i:s");
  		if(!$edit_id)
  		{
  			$ins['created_date'] = date("Y-m-d H:i:s");
  			$this->session->set_flashdata('success_msg',"Job created successfully.",TRUE);
  			$ins_id = $this->jobs_model->insert($ins,"jobs");
  		}
  		else
  		{
  			$this->session->set_flashdata('success_msg',"Job updated successfully.",TRUE);
  			$up = $this->jobs_model->update(array("id"=>$edit_id),$ins,"jobs");
  		}
  		redirect("jobs/job_list");
  	}
  	$this->layout->view('frontend/jobs/add_job');	
  }

  public function posted_jobs()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('b.employer_id' => 'Employer','b.firstname'=>'Employee','a.job_posted_on'=>'Job Posted On','c.job_name'=>'Job Name');
    $listing = $this->listing->get_listings('jobs_model', 'posted_jobs','no');
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
  	$this->layout->view('frontend/jobs/posted_jobs');
  }

  public function category()
  {
  	$this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('name' => 'Name');
    // $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="'.site_url('jobs/add_category/{id}').'" class="btn btn-padding btn yellow table-action"><i class="fa fa-edit edit"></i></a><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn red btn-padding" onclick="delete_record(\'jobs/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('jobs_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['btn'] = "<a href=".site_url('jobs/add_category')." class='btn green'>Add New Category <i class='fa fa-plus'></i></a>";
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
  	$this->layout->view('frontend/jobs/category');
  }



  public function add_category($edit_id='')
  {
  	$this->form_validation->set_rules($this->_category_validation_rules);
  	$this->data['edit'] = "";
  	if($edit_id)
  	{  		
  		$this->data['edit'] = $this->jobs_model->select(array("id"=>$edit_id),"job_category");
  	}
    if($this->form_validation->run())
    {
    	$form = $this->input->post();
    	$ins['name'] = $form['name'];
    	$ins['status'] = ($form['active'])?"Active":"Not Active";
    	$ins['updated_date'] = date("Y-m-d H:i:s");
    	if($edit_id)
    	{
    		$this->session->set_flashdata('success_msg',"Category updated successfully.",TRUE);
    		$up = $this->jobs_model->update(array("id"=>$edit_id),$ins,"job_category");
    	}
    	else
    	{
    		$ins_id = $this->jobs_model->insert($ins,"job_category");
    		$this->session->set_flashdata('success_msg',"Category created successfully.",TRUE);
    	}
    	redirect('jobs/category');
    }
  	$this->layout->view('frontend/jobs/add_category');
  }

  public function delete($del_id)
	{
  	$output['message'] ="Record deleted successfuly.";
  	$output['status']  = "success";
  	$this->jobs_model->delete(array("id"=>$del_id),"jobs");
  	$this->_ajax_output($output, TRUE);
	}
}
?>