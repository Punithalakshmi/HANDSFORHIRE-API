<?php
/*
 * view - the path to the listing view that you want to display the data in
 * 
 * base_url - the url on which that pagination occurs. This may have to be modified in the 
 * 			controller if the url is like /product/edit/12
 * 
 * per_page - results per page
 * 
 * order_fields - These are the fields by which you want to allow sorting on. They must match
 * 				the field names in the table exactly. Can prefix with table name if needed
 * 				(EX: products.id)
 * 
 * OPTIONAL
 * 
 * default_order - One of the order fields above
 * 
 * uri_segment - this will have to be increased if you are paginating on a page like 
 * 				/product/edit/12
 * 				otherwise the pagingation will start on page 12 in this case 
 * 
 * 
 */
 

$config['user_employers'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/user/filter',
	"base_url"	=> 	'/user/employers/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'firstname'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'lastname'=>array('name'=>'Last Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						'username'=>array('name'=>'Username', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['user_employees'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/user/filter',
	"base_url"	=> 	'/user/employees/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'firstname'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'lastname'=>array('name'=>'Last Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						'username'=>array('name'=>'Username', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['jobs_category'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/jobs/category',
	"base_url"	=> 	'/jobs/category/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'status'=>array('name'=>'Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['jobs_job_list'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/jobs/job_list',
	"base_url"	=> 	'/jobs/job_list/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'job_name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'job_category'=>array('name'=>'Category', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'job_date'=>array('name'=>'Job Date', 'data_type' => 'date', 'sortable' => FALSE, 'default_view'=>1),
						'amount'=>array('name'=>'Amount', 'data_type' => 'money', 'sortable' => FALSE, 'default_view'=>1),
						'address'=>array('name'=>'Address', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);



$config['jobs_posted_jobs'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/jobs/posted_jobs',
	"base_url"	=> 	'/jobs/posted_jobs/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'employer'=>array('name'=>'Employer', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'employee'=>array('name'=>'Employee', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'job_name'=>array('name'=>'Job Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'job_posted_on'=>array('name'=>'Jobs Posted On', 'data_type' => 'datetime', 'sortable' => FALSE, 'default_view'=>1),
						),
	"default_order"	=> "a.id",
	"default_direction" => "DESC",
);


$config['payment_credit_card'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/payment/credit_card',
	"base_url"	=> 	'/payment/credit_card/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'card_name'=>array('name'=>'Card Holder Name', 'data_type' => 'string_info', 'sortable' => FALSE, 'default_view'=>1),
						'card_number'=>array('name'=>'Card Number', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						'exp_date'=>array('name'=>'Expiry Date', 'data_type' => 'exp_date', 'sortable' => FALSE, 'default_view'=>1),
						'card_type'=>array('name'=>'Card Type', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						),
	"default_order"	=> "id",
	"default_direction" => "DESC",
);



$config['payment_checking_account'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/payment/checking_account',
	"base_url"	=> 	'/payment/checking_account/',
	"per_page"	=>	"20",
	"fields"	=> array(   
			'account_name'=>array('name'=>'Account Name', 'data_type' => 'string_info', 'sortable' => FALSE, 'default_view'=>1),
			'routing_number'=>array('name'=>'Routing Number', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'account_number'=>array('name'=>'Account Number', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'license_number'=>array('name'=>'License Number', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'state'=>array('name'=>'State', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),),
	"default_order"	=> "id",
	"default_direction" => "DESC",
);

$config['email_notifications_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/email_notifications/index',
	"base_url"	=> 	'/email_notifications/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
			'subject'=>array('name'=>'Subject', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'employees_email'=>array('name'=>'Employees', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'created_date'=>array('name'=>'Created Date', 'data_type' => 'datetime', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC",
);


$config['roles_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/roles/index',
	"base_url"	=> 	'/roles/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
			'role'=>array('name'=>'Role Name', 'data_type' => 'string_info', 'sortable' => FALSE, 'default_view'=>1),
			'status'=>array('name'=>'Status', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC",
);


$config['payment_payment_history'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/payment/payment_history',
	"base_url"	=> 	'/payment/payment_history',
	"per_page"	=>	"20",
	"fields"	=> array(
			'emp_name'=>array('name'=>'Employer', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'amount'=>array('name'=>'Amount', 'data_type' => 'money', 'sortable' => FALSE, 'default_view'=>1),
			'tnx_id'=>array('name'=>'Transaction ID', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'status'=>array('name'=>'Status', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1),
			'created_date'=>array('name'=>'Payment Date', 'data_type' => 'datetime', 'sortable' => FALSE, 'default_view'=>1),),
	"default_order"	=> "a.id",
	"default_direction" => "DESC",
);

$config['payment_paypal_listing'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/payment/paypal_listing',
	"base_url"	=> 	'/payment/paypal_listing',
	"per_page"	=>	"20",
	"fields"	=> array(
			'emp_name'=>array('name'=>'Employer', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'email_id'=>array('name'=>'Email ID', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'api_key'=>array('name'=>'API Key', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'api_signature'=>array('name'=>'API Signature', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			'created_date'=>array('name'=>'Created Date', 'data_type' => 'datetime', 'sortable' => FALSE, 'default_view'=>1),),
	"default_order"	=> "a.id",
	"default_direction" => "DESC",
);