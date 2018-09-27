<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/App_controller.php");

class Admin_Controller extends App_Controller
{
	
	
	public $namespace;
	public $_search_conditions 			= array("search_type", "search_text");
	public $_narrow_search_conditions 	= array();
	public $_session_namespace;
	public $_session_narrow_namespace;
	public $previous_url				= '';

    protected $_logged_in_only         =    false;
    public $error_message              =    '';
    public $data                       =    array();
    public $role                       =    '';
    public $load_css                   =    array();
    public $load_js                    =    array();
    public $ins_data                   =    array();
    
    protected $_login_validation_rules =    array (
                                                    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
                                                    array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|xss_clean|min_length[4]|max_length[20]|alpha_dash')
                                                  );
   protected $useradd_validation_rules =    array();  
   protected $role_validation_rules    =    array();
   public $init_scripts = array();
    
    public function __construct()
    {
        parent::__construct(); 


        //set name-spaces for session-storage of each controller-method pair.
        $this->namespace = strtolower($this->uri->segment(1, 'admin').'_'.$this->uri->segment(2, 'index'));
        
        //echo '<pre>';print_r($this->session->all_userdata());
        //get all session keys
        $sess_keys = array_keys($this->session->all_userdata());
        
        /*
        if(!is_logged_in())            
            redirect('login');
        */
        
       
        $this->data = array();
        //$this->role = get_user_role();
        
        $this->load->library("form_validation");
        
    }
    
    
    public function _ajax_output($data, $json_format = FALSE)
    {
    	if(is_array($data) && $json_format)
        	echo json_encode($data);
    	else 
    		echo $data;
    	
        exit();
    }



    function get_advance_filter_form( $namespace = '' )
    {
        //load pagination config
        $this->load->config("listing", TRUE);
         
        //get current grid's config by using namespace.
        $pagination = $this->config->item($namespace, 'listing');
         
        //To populate the form, get the previous data if available in session.
        $this->data = $this->session->userdata($namespace.'_search_narrow_conditions');
        //print_r($this->data);die;
        //now get the form
        $form = $this->load->view($pagination['advance_search_view'], $this->data, TRUE);
         
        if($this->input->is_ajax_request())
        $this->_ajax_output(array('advance_filter_form' => $form), TRUE);
         
        return $form;
    }

    /**
     * This function sets the number of records per page for grid.
     *@param string namespace <p>
     * It is the namespace of current grid-view page.
     * </p>
     * @return void.
     */
    function set_records_per_page( $namespace = '' )
    {
        $per_page = ((int)$this->input->post('per_page'))?$this->input->post('per_page'):20;
        
        $this->session->set_userdata($namespace.'_per_page', $per_page);
        
        if($this->input->is_ajax_request())
            $this->_ajax_output(array('status' => 'success'), TRUE);
         
        return TRUE;
    }
    
    
  
}

?>
