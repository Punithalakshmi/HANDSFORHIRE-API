<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Rating_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'rating';
  }
  
  function listing()
  {  
    $this->_fields = "*";
    if($this->router->fetch_method()=="employers")
    {
      $this->db->where('usertype','employer');
      $this->db->or_where('usertype','both');
    }
    else if($this->router->fetch_method()=="employees")
    {
      $this->db->where('usertype','employee');
      $this->db->or_where('usertype','both');

    }
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'firstname':
          $this->db->like($key, $value);
        break;
         case 'lastname':
          $this->db->like($key, $value);
        break;
         case 'email':
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
  
  public function update($where,$data,$table)
  {
    $this->db->where($where);
    $this->db->update($table,$data);
    // echo $this->db->last_query();exit;
    return $this->db->affected_rows();
  }

  public function delete($where,$table)
  {
    $this->db->where($where);
    $this->db->delete($table);
  }
  
   function check_unique($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        return $this->db->get("rating")->row_array();
    }
    
    function rating_lists($user_id, $type)
  {
     $this->db->select("j.*,j.id as job_id,jc.name as job_category,u.profile_image,r.user_id,r.login_user_id,r.comments");
     $this->db->from("rating r");
     $this->db->join("jobs j","j.id=r.job_id");
     $this->db->join('job_category jc',"jc.id=j.job_category");
     $this->db->join('user u','u.id=r.user_id');
     $this->db->where(array("r.user_id" => $user_id));
     $this->db->where(array("j.active_job" => "yes"));
     return $this->db->get()->result_array();
  }
}
?>