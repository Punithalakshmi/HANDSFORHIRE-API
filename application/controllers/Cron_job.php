<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



require_once(APPPATH."libraries/Admin_controller.php");



class Cron_job extends Admin_controller

{

	             

	function __construct()

  {

    parent::__construct();



    $this->load->model('jobs_model');

    

  }


  function test(){
    echo "Hello Ram";
    $id= time();
    $this->db->query("insert into cron_logs set job_ids='$id'");
  }

  public function job_expire()

  {
    
     $expire_job_lists = $this->jobs_model->check_expire_jobs();

     //print_r($expire_job_lists);

     $applied_jobs     = array();

     foreach($expire_job_lists as $ekey => $evalue) {

        if(!isset($applied_jobs[$evalue['job_id']])) {
         
               

            $applied_jobs[$evalue['job_id']] = array(
                                                    "employer_devicetoken" => $evalue['employer_devicetoken'],
                                                    "job_name" => $evalue['job_name'],
                                                    "status" => $evalue['status'],
                                                    "employer_id" => $evalue['employer_id'],
                                                    "employee_id" => $evalue['emp_id'],
						    "expire" => $evalue['job_expire_date_time']	

                                                  );
            

        }

     }
     
//echo "<pre>";
//print_r($applied_jobs);

      $job_ids = '';

    //echo date("Y-m-d H:i A");   exit;  
     $current_time = strtotime(date("Y-m-d H:i"));

      foreach($applied_jobs as $akey => $avalue) {
 
//echo "<br />";
         $date1 = strtotime($avalue['expire']);

         $expire_time =  strtotime(date("Y-m-d H:i",$date1));
// exit;
         if($current_time == $expire_time){
//echo "test";
  //	exit;
         if(!empty($avalue['employer_devicetoken'] && ($avalue['status'] == 'Hold'|| $avalue['status'] == '')) ){

          $job_name= ucfirst($avalue['job_name']);

          $message = 'You have not hired anyone for the '.$job_name.' job yet. If you do not hire someone or update the job time, this job will be moved to archived posted jobs folder 24 hours after the set start time.'; 

          $params  = $this->db->query("select * from notifications where user_id='".$avalue['employer_id']."'")->result_array();

          sendNotification($avalue['employer_devicetoken'],$message,count($params),$avalue['employer_id'],'expirejob');

          update_notification_count($avalue['employer_id'],$message,'expirejob',$akey,"employer");
          
          $job_ids .= (empty($job_ids))?$akey:$akey.",";

	        $startDate      = time();
            
          $jb_expire_time = date('Y-m-d H:i', strtotime('+1 day', $startDate));

            //update job expire time

            $this->db->query("update jobs set is_expire_notification_send='yes',expire_time='".$jb_expire_time."' where id='".$akey."'");
	         

        }


        $employeeData = $this->db->query("select * from user u where u.id='".$avalue['employee_id']."'")->row_array();

        if(!empty($employeeData['employee_devicetoken'] && ($avalue['status'] == 'Hold')) ){

          $job_name= ucfirst($avalue['job_name']);

          $message = 'You Are Refused For The '.ucfirst($job_name); 

          $params  = $this->db->query("select * from notifications where user_id='".$avalue['employee_id']."'")->result_array();

          sendNotification($employeeData['employee_devicetoken'],$message,count($params),$avalue['employee_id'],'expirejob');

          update_notification_count($avalue['employee_id'],$message,'expirejob',$akey,"employee");

       	  }
	}	
     }

     if(!empty($job_ids)){
      
      $this->db->query("insert into cron_logs set job_ids='".$job_ids."'");
     }

  }


  public function delete_expire_jobs()
  {
     $jobs = $this->jobs_model->delete_expire_jobs();
//    print_r($jobs); 
     $current_time = strtotime(date("Y-m-d H:i"));

     foreach($jobs as $jkey => $jvalue){
       
      $date = strtotime($jvalue['expire_time']);

      $expire_time = strtotime(date("Y-m-d H:i", $date));
      
      if($expire_time == $current_time){

       $this->db->query("update jobs set is_achieved='yes' where id='".$jvalue['id']."'");
       
	$this->db->query("insert into cron_logs set job_ids='".$jvalue['id']."'");
      }

     }
  }

  
  public function send_notification()
  {
    
    sendNotification("442F528726E2D59EEFE51197763E0242D1519E764DE0C3E0D8E74F18954A85FF","test",1,1,'testnotification');

  }


}

?>
