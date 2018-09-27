<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Role_model extends App_model
{
  function __construct()
  {
    parent::__construct();
  }

  function listing()
  {  
    $this->_table = 'role';
    $this->_fields = "*";

    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'role':
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

  public function update($where,$data,$table)
  {
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