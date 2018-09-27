<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'address';
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
   }

  public function delete($where)
  {
    $this->db->where($where);
    $this->db->delete($this->_table );
  }


  function check_unique($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        return $this->db->get("address")->row_array();
    }
}
?>
