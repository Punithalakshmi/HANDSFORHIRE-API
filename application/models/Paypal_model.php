<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Paypal_model extends App_model
{
  function __construct()
  {
    parent::__construct();
  }
  
  public function insert($data,$table=NULL)
  {
    $q =  $this->db->insert($table,$data);
    return $this->db->insert_id();
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
  
  function check_unique($where)
  {
    $this->db->select("*");
    $this->db->from("paypal");
    $this->db->where($where);
    return $this->db->get()->row_array();
  }
    function get_paypal_user_info($where)
    {
        $this->db->select("p.*,u.firstname,u.lastname");
        $this->db->join("user u","u.id=p.user_id");
        $this->db->from("paypal_user_info p"); 
        $this->db->where($where);
        return $this->db->get()->result_array(); 
    }
      
 }
?>