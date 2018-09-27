<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Payment_model extends App_model
{
  function __construct()
  {
    parent::__construct();
  }

  function listing()
  {  
    $this->_table = 'credit_card';
    $this->_fields = "id,card_number,concat(name,'###',default_card) as card_name,concat(exp_month,'###',exp_year) exp_date,card_type";
    if($this->session->userdata('user_data')['usertype']=="employer" || $this->session->userdata('user_data')['usertype']=="employee")
      $this->db->where('employer_id',$this->session->userdata('user_data')['id']);
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'name':
          $this->db->like($key, $value);
        break;
        case 'card_number':
          $this->db->like($key, $value);
        break;
        case 'card_type':
          $this->db->like($key, $value);
        break;
      }
    }
    return parent::listing();
  }

  function payment_history()
  {  
    $this->_table = 'payment_history';
    $this->_fields = "a.*,b.firstname as emp_name";
    $this->db->from("payment_history a");
    $this->db->join("employers b","a.user_id=b.id");
    $this->db->group_by("a.id");
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'a.amount':
          $this->db->like($key, $value);
        break;
        case 'a.tnx_id':
          $this->db->like($key, $value);
        break;
        case 'a.status':
          $this->db->like($key, $value);
        break;
        case 'b.firstname':
          $this->db->like($key, $value);
        break;
        case 'a.created_date':
          $this->db->like($key, date('Y-m-d',strtotime($value)));
        break;
      }
    }
    return parent::listing();
  }

  function paypal_listing()
  {  
    $this->_table = 'paypal';
    $this->_fields = "a.*,b.firstname as emp_name";
    $this->db->from("paypal a");
    $this->db->join("user b","a.employer_id=b.id");
    $this->db->group_by("a.id");
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'a.email_id':
          $this->db->like($key, $value);
        break;
        case 'a.api_key':
          $this->db->like($key, $value);
        break;
        case 'a.api_signature':
          $this->db->like($key, $value);
        break;
        case 'b.firstname':
          $this->db->like($key, $value);
        break;
      }
    }
    return parent::listing();
  }


  function account_listing()
  {  
    $this->_table = 'checking_account';
    $this->_fields = "id,account_number,routing_number,concat(name,'###',default_account) as account_name,license_number,state";
    if($this->session->userdata('user_data')['usertype']=="employer" || $this->session->userdata('user_data')['usertype']=="employee")
      $this->db->where('employer_id',$this->session->userdata('user_data')['id']);
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'name':
          $this->db->like($key, $value);
        break;
        case 'card_number':
          $this->db->like($key, $value);
        break;
        case 'card_type':
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
  
  public function select_multiple($where,$table)
  {
    if($where)
      $this->db->where($where);
    $q = $this->db->get($table);
    return $q->result_array();
  }

  public function select($where,$table)
  {
    if($where)
      $this->db->where($where);
    $q = $this->db->get($table);
    return $q->row_array();
  }

  public function update($where='',$data,$table)
  {
    if($where)
      $this->db->where($where);
    $this->db->update($table,$data);
  }

  public function delete($where,$table)
  {
    $this->db->where($where);
    $this->db->delete($table);
  }
 }
?>