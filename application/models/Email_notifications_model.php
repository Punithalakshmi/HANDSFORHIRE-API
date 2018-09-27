<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Email_notifications_model extends App_model
{
	function __construct()
  {
    parent::__construct();
    $this->_table = 'email_notifications';
  }
	function listing()
  {  
    $this->_fields = "id,subject,message,REPLACE(employees, '#', ',') as employees_email,created_date";

    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'subject':
          $this->db->like($key, $value);
        break;
      }
    }
    return parent::listing();
  }
	public function insert($data,$table=NULL)
  {
    $q =  $this->db->insert($table,$data);
    return $this->db->insert_id();
  }
}