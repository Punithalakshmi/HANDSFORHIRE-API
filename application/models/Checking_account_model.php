<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checking_account_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'checking_account';
    }
   
    public function insert($data)
	{
		$q =  $this->db->insert($this->_table ,$data);
		return $this->db->insert_id();
	}
   	
    public function update($where,$data)
   {
    $this->db->where($where);
    $this->db->update($this->_table ,$data);
    return $this->db->affected_rows();
   }

  public function delete($where)
  {
    $this->db->where($where);
    $this->db->delete($this->_table );
  }
  
    function check_unique($where)
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where($where);
        return $this->db->get()->row_array();
    }
    
    function get_checking_account_data($where)
    {
        $this->db->select("c.*,u.firstname,u.lastname,u.usertype");
        $this->db->join("user u","u.id=c.employer_id");
        $this->db->from("checking_account c");
        $this->db->where($where);
        return $this->db->get()->result_array(); 
    }
}
?>
