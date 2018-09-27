<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Jobs_model extends App_model
{
  function __construct()
  {
    parent::__construct();
  }
  
  function listing()
  {  
    $this->_table = 'job_category';
    $this->_fields = "*";

    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'name':
          $this->db->like($key, $value);
        break;
      }
    }
    return parent::listing();
  }

  function job_listing()
  {  
    $this->_fields = "a.*,b.name as job_category";
    $this->db->from('jobs a');
    $this->db->join("job_category b","b.id=a.job_category");
    $this->db->group_by('a.id');
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'a.job_name':
          $this->db->like($key, $value);
        break;
        case 'b.name':
          $this->db->like($key, $value);
        break;
        case 'a.job_date':
          $this->db->like($key, $value);
        break;
        case 'a.amount':
          $this->db->like($key, $value);
        break;
        case 'a.address':
          $this->db->like($key, $value);
        break;
      }
    }
    return parent::listing();
  }

  function posted_jobs()
  {  
    $this->_fields = "a.comments,a.job_posted_on,b.firstname as employer,c.job_name,d.firstname as employee";
    $this->db->from('posted_jobs a');
    $this->db->join("employers b","a.job_creator_id=b.id");
    $this->db->join("jobs c","a.job_id=c.id");
    $this->db->join("employers d","a.employee_id=d.id");
    $this->db->group_by('a.id');
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'a.employer_id':
          $this->db->like('b.firstname', $value);
        break;
        case 'a.job_creator_id':
          $this->db->like($key, $value);
        break;
         case 'c.job_name':
          $this->db->like($key, $value);
        break;
        case 'b.firstname':
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
    return $this->db->affected_rows();
  }

  public function delete($where,$table)
  {
    $this->db->where($where);
    $this->db->delete($table);
  }
  
  function job_lists($employer_id)
  {
    $this->db->select("j.*,j.id as job_id,jc.name as job_category,u.profile_image,u.id as uid");
    $this->db->from("jobs j");
    //$this->db->join("applied_jobs a",'a.job_id=j.id');
    $this->db->join('job_category jc',"jc.id=j.job_category");
    $this->db->join('user u','u.id=j.employer_id');
    if(!empty($employer_id)){
        $this->db->where(array("j.employer_id" => $employer_id));
        //$this->db->where(array("a.employee_id!=" => $employer_id));
    }
    $this->db->where(array("j.address!=" => "","is_achieved"=>"no"));
    //$this->db->where(array("j.delist" => "yes"));
    //print_r($this->db->last_query());exit;
    $this->db->order_by("j.id","desc");
    return $this->db->get()->result_array();
  }  
  
  function applied_job_lists($employee_id)
  {
     $this->db->select("j.*,j.id as job_id,jc.name as job_category,u.profile_image,a.status as job_status,u.id as uid");
    $this->db->from("applied_jobs a");
    $this->db->join("jobs j","j.id=a.job_id");
    $this->db->join('job_category jc',"jc.id=j.job_category");
    $this->db->join('user u','u.id=j.employer_id');
    if(!empty($employee_id)){
        $this->db->where(array("a.employee_id" => $employee_id));
    }
    $this->db->where(array("a.status!=" => "Hired","j.is_achieved" => "no"));
    //$this->db->where(array("j.delist" => "no"));
    $this->db->order_by("a.id","desc");
    return $this->db->get()->result_array();
  }

 
  function job_search($category,$zipcode,$employee_id)
  {
    // $this->db->select("j.*,jc.name as job_category,u.profile_image,u.id as uid");
    // $this->db->from("jobs j");
    // $this->db->join('job_category jc',"jc.id=j.job_category");
    // $this->db->join('user u','u.id=j.employer_id');
    $where = '';

    if(!empty($category)){
      $where  .= " and j.job_category ='".$category."'";
      //$this->db->where(array("j.job_category" => $category));
    }
    if(!empty($zipcode)){
      $where  .= " and j.zipcode ='".$zipcode."'";
     // $this->db->where(array("j.zipcode" => $zipcode));
    }
    $where .= " and j.delist='yes' and j.is_achieved='no'";
    //$this->db->where(" not exists (select a.job_id from applied_jobs a where a.job_id=j.id)");

    return $this->db->query("select j.*,jc.id as job_category, u.profile_image,u.id as uid 
                      from jobs j 
                      inner join job_category jc on jc.id=j.job_category 
                      inner join user u on u.id=j.employer_id where 1=1  
                      $where and not exists( select a.job_id from applied_jobs a where a.job_id=j.id and a.employee_id = '$employee_id')")->result_array();

    //return $this->db->get()->result_array();
  }
  
  function get_location_jobs($lat,$lon,$category,$zipcode,$miles,$employee_id)
  {
    
    $where = '';
    if(!empty($category)){
        $where .= "and j.job_category='".$category."' ";
    }
    
    if(!empty($zipcode)){
        $where .= "and j.zipcode='".$zipcode."' ";
    }

     $where .= "and j.delist='yes' and j.is_achieved='no'";

    return $this->db->query("select j.*,jc.id as job_category,u.profile_image,u.id as uid from jobs j 
                              inner join job_category jc on jc.id=j.job_category 
                              inner join user u on u.id=j.employer_id where 1=1 $where and
                              not exists (select a.job_id from applied_jobs a where a.job_id=j.id and a.employee_id = '$employee_id') and
                              GetDistance(j.lat,j.lon,'".$lat."','".$lon."') <= $miles 
                              order by j.id desc")->result_array();
    
  }
  
  function active_job_lists($user_id,$type)
  {

      $this->db->select("j.*,j.id as job_id,jc.name as job_category,u.profile_image,h.employee_id,u.username,u.profile_name");
      $this->db->from("hire_jobs h");
      $this->db->join("jobs j","j.id=h.job_id");
      $this->db->join('job_category jc',"jc.id=j.job_category");
      $this->db->join('user u','u.id=h.employer_id');
     
     if(!empty($type) && ($type == 'employee')){
        // $this->db->from("applied_jobs h");
        // $this->db->join("jobs j","j.id=h.job_id");
        // $this->db->join('job_category jc',"jc.id=j.job_category");
        // $this->db->join('user u','u.id=h.employee_id');
        $this->db->where(array("h.employee_id" => $user_id));
      //  $this->db->where(array("h.active_job" => "yes"));
     }
     if(!empty($type) && ($type == 'employer')){
        
        $this->db->where(array("h.employer_id" => $user_id));
      //  
     }

     $this->db->where(array("j.active_job" => "yes"));

     $this->db->order_by("h.id","desc");
     return $this->db->get()->result_array();

  }
  
  function job_history_lists($user_id, $type)
  {
     $this->db->select("j.*,j.id as job_id,jc.name as job_category,u.profile_image,h.employee_id,h.employer_id,u.username,u.profile_name,h.transaction_date,h.job_status,h.payment_amount");
     $this->db->from("jobs_history h");
     $this->db->join("jobs j","j.id=h.job_id");
     $this->db->join('job_category jc',"jc.id=j.job_category");
     
     if(!empty($type) && ($type =='employee')){
        $this->db->join('user u','u.id=h.employee_id');
        $this->db->where(array("h.employee_id" => $user_id));
     }
     if(!empty($type) && ($type =='employer')){
        $this->db->join('user u','u.id=h.employer_id');
        $this->db->where(array("h.employer_id" => $user_id));
     }
     
     $this->db->where(array("j.active_job" => "yes"));
     $this->db->order_by("h.id","desc");
     return $this->db->get()->result_array();
  }
  
   function check_unique($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        return $this->db->get("jobs")->row_array();
    }

    function check_expire_jobs()
    {
      //  $sql = " SELECT u.devicetoken as employer_devicetoken,j.id as job_id,j.job_name,j.employer_id,a.status,a.employer_id,a.employee_id as emp_id,au.devicetoken as employee_devicetoken,count(a.status) as status_count
      //            FROM jobs j 
      //             JOIN user u ON u.id=j.employer_id 
      //              LEFT JOIN applied_jobs a ON a.job_id=j.id
      //              LEFT JOIN user au ON au.id=a.employee_id 
      //               WHERE j.job_date <= CURDATE()
      //                ";

       $sql = " SELECT u.devicetoken as employer_devicetoken,j.id as job_id,j.job_name,j.employer_id,a.status,a.employee_id as emp_id,j.job_expire_date_time
                   FROM jobs j 
                    JOIN user u ON u.id=j.employer_id 
                     LEFT JOIN applied_jobs a ON a.job_id=j.id
                      WHERE j.job_date = CURDATE()
                     ";

        return $this->db->query($sql)->result_array();
    }
      
    function delete_expire_jobs()
    {
       $sql = " SELECT * FROM jobs
                  WHERE is_expire_notification_send='yes'
                ";
                    
       return $this->db->query($sql)->result_array();
    }


}
?>
