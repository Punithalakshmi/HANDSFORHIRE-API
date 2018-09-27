<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Profile_model extends App_model
{
  function __construct()
  {
    parent::__construct();
  }

  public function select($where,$table)
  {
  	$this->db->where($where);
  	$q = $this->db->get($table);
  	return $q->row_array();
  }
}