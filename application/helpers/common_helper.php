<?php

function error_found()
{
   header("Location:dashboard");
}

function is_logged_in()
{
  $CI = get_instance();    
  $user_data = get_user_data();    
  if( is_array($user_data) && $user_data )
      return TRUE;
  
  return FALSE;
}

function get_current_user_id()
{
  $CI = & get_instance();
  
  $current_user = get_user_data();
  
  if(!empty($current_user)) {
    return $current_user['id'];
  }
}
function get_user_data()
{
  $CI = get_instance();
  if($CI->session->userdata('user_data'))
  {
    return $CI->session->userdata('user_data');
  }
  else
  {
    return FALSE;
  }
}


function get_user_profile()
{
  $CI= & get_instance();  
  $CI->load->model('profile_model');
  $userdata = $CI->session->userdata('user_data');
  $row = $CI->profile_model->select(array('id' => $userdata['id']),"admin_users");
  if(!$row)
  {
    $row = $CI->profile_model->select(array('id' => $userdata['id']),"employers");
  }
  return $row;
}

function get_user_role( $user_id='')
{
  $CI= & get_instance();  
  if(!$user_id) 
  {
    $user_data = get_user_data();
    return $user_data['role_id'];
  }   
  $CI->load->model('user_model');
  $row = $CI->user_model->get_where(array('id' => $user_id));
  if( !$row )
    return FALSE;

  return $row['role_id'];
}

function get_role_access($id)
{
  $CI= & get_instance();
  $CI->load->model('role_model');
  $row = $CI->role_model->select(array('role' => $id),"role");
  return $row;
}


function format_address($address = array(), $address_tag = TRUE)
{
  if(!count($address))
    return FALSE;

  $address_format = ($address_tag)?"<address>":"<p>";
  $address_format .= "<strong>{$address['first_name']} {$address['last_name']}</strong> <br />";
  if(strcmp(trim($address['company']),'') !== 0)
    $address_format .= "{$address['company']}<br />";
  $address_format .= "{$address['address1']} <br />";
  if(strcmp($address['address2'],'') !== 0)
    $address_format .= "{$address['address2']} <br />";
  $address_format .= "{$address['city']} {$address['state']} {$address['zip']} <br />";
  $address_format .= "{$address['country']} <br />";
  if(strcmp($address['phone'],'') !== 0)
    $address_format .= "<abbr title='Phone'>P:</abbr> {$address['phone']}";
  $address_format .= ($address_tag)?"</address>":"</p>";

  return $address_format;

}


function display_flashmsg($flash)
{

  if(!$flash)
    return FALSE;

  $status = $msg = '';

  if(isset($flash['success_msg']))
  {
    $status = 'success';
    $msg = $flash['success_msg'];
  }

  if(isset($flash['error_msg']))
  {
    $status = 'danger';
    $msg = $flash['error_msg'];
  }

    if($status && $msg)
    {
      $str = '<div id="div_service_message" class="alert alert-'.$status.' alert-dismissible">';
      $str.= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
      
      if($status == 'danger')
          $status = 'error';
      $str.='<strong>'.ucfirst($status).':&nbsp;</strong> '. strip_tags($msg) .' </div>';

      echo $str;
    }

}


function displayData($data = null, $type = 'string', $row = array(), $wrap_tag_open = '', $wrap_tag_close = '')
{
    $CI = & get_instance();     
    if(is_null($data) || is_array($data) || (strcmp($data, '') === 0 && !count($row)) )
      return $data;
    
    switch ($type)
    {
        case 'string':
            break;
        case 'humanize':
          $CI->load->helper("inflector");
          $data = humanize($data);
          break;
        case 'string_info':
          $str = explode("###",$data);
          $str2 = "";
          if($str[1]=="1" || $str[1]==1)
            $str2 = "<label class='label label-success'>DEFAULT</label>";
          $data = $str[0].' '.$str2;
          break;
        case 'exp_date':
          $str = explode("###",$data);
          $data = $str[0].'/'.$str[1];
          break;
        case 'date':
            $data = str2USDT($data);
            break;
        case 'datetime':
            $data = str2USDate($data);
            break;
        case 'money':
            $data = '$'.number_format((float)$data, 2);
            break;
        case 'mailto':
            $data = '<a href="mailto:'.$data.'">'.$data.'</a>';
            break;
        case 'formated_number':
            $data = number_format((float)$data, 2);
            break;
        case 'link':
            $data = '<a href="'.$data.'">'.$data.'</a>';
            break;
        case 'colorize':
          $data = "<h2 style='font-size:14px;' class='label label-danger'>".$data."</h2>"; 
        break;
        case 'status':
           $labels_array = array('Active' => 'label-success','Not Active' => 'label-danger');
           $data = "<span class='label {$labels_array[$data]}'>{$data}</span>";
          break;
        case 'product_name_link':
         // $data = '<a href="'.site_url('inventory/add/').$row['id'].'">'.$data.'</a>'; 
         $data = $data;
        break;  
    }    
    return $wrap_tag_open.$data.$wrap_tag_close;
}

function check_is_working_day($date)
{
  $day = date('l',strtotime($date));
  $CI = & get_instance();
  $CI->db->where('status',1);
  $result = $CI->db->get('working_days')->result_array();
  foreach ($result as $row) 
  {
    if(strtolower($row['name']) == strtolower($day))
      return TRUE;
  }
  return FALSE;
}

function str2USDate($str)
{
  $intTime = strtotime($str);
  if ($intTime === false)
    return NULL;
  return date("m/d/Y H:i:s", $intTime);
}

function str2USDT($str)
{
  $intTime = strtotime($str);
  if ($intTime === false)
    return NULL;
   return date("m/d/Y", strtotime($str));
}

    // no logic for server time to local time.
function str2DBDT($str=null)
{
  $intTime = (!empty($str))?strtotime($str):time();
  if ($intTime === false)
    return NULL;
  return date("Y-m-d H:i:s", $intTime);
}

function str2DBDate($str)
{
  $intTime = strtotime($str);
  if ($intTime === false)
    return NULL;
  return date("Y-m-d",$intTime);
}

function addDayswithdate($date,$days)
{
  $date = strtotime("+".$days." days", strtotime($date));
  return  date("m/d/Y", $date);
}

function day_to_text($date)
{
  $day_no = date("N",strtotime($date));
  $day_array = array(1 => "Monday" , 2 => "Tuesday" , 3 => "Wednesday" , 4 => "Thursday" , 5 => "Friday" , 6 => "Saturday" , 7 => "Sunday"  );
  return $day_array[$day_no];
}

function date_ranges($case = '')
{
  $dt = date('Y-m-d');
  if(empty($case))
  {
    return false;
  }
  switch($case)
  {
    case 'today':
      $highdateval = $dt;
      $lowdateval = $dt;
    break;
    case 'thisweek':
        $highdateval = date('Y-m-d', strtotime('saturday this week'));
            $lowdateval  = date('Y-m-d', strtotime('sunday last week'));
        break;
        case 'thisweektodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('sunday last week'));
        break;
        case 'thismonth':
            $highdateval = date('Y-m-d', strtotime('last day of this month'));
            $lowdateval  = date('Y-m-d', strtotime('first day of this month'));
        break;
        case 'thismonthtodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('first day of this month'));
        break;
        case 'thisyear':
            $highdateval = date('Y-m-d', strtotime('1/1 next year -1 day'));
            $lowdateval  = date('Y-m-d ', strtotime('1/1 this year'));
        break;
        case 'thisyeartodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('1/1 this year'));
        break;
        case 'thisquarter':
        $quarters = array();
        $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
        $quarters[01] = $quarters[02] = $quarters[03] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
        $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
        $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('10/1 this year - 1 day')));
        $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('10/1 this year')),'end_date' =>  date('Y-m-d', strtotime('1/1 next year -1 day')));
        $cur_month = (int) date("m",strtotime($dt));
       
        
        $date_range = $quarters[$cur_month];
        $highdateval = $date_range['end_date'];
        $lowdateval  = $date_range['start_date'];
        break;
        case 'yesterday':
            $highdateval = date('Y-m-d', strtotime('yesterday'));
            $lowdateval  = date('Y-m-d', strtotime('yesterday'));
        break;
        case 'recent':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-4,date("Y")));
        break;
        case 'lastweek':
            $highdateval = date('Y-m-d', strtotime('saturday last week'));
            $lowdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
        break;
        case 'lastweektodate':
            if(date('l')=="Sunday")
            {
                $highdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
            }
            else
            {
                //$lastweek = date('l').' last week';
                $highdateval = date('Y-m-d');
            }
            
            $lowdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
        break;
        case 'lastmonth':
            $lowdateval  = date('Y-m-d', strtotime('first day of last month'));
            $highdateval = date('Y-m-d', strtotime('last day of last month'));
        break;
        case 'lastmonthtodate';
            $lowdateval  = date('Y-m-d', strtotime('first day of last month'));
            $highdateval = date('Y-m-d', strtotime('last month'));
        break;
        case 'lastquater':
            $quarters = array();
            $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
            $quarters[01] = $quarters[02] = $quarters[03] =  array('start_date' => date('Y-m-d', strtotime('10/1 last year')),'end_date' =>  date('Y-m-d', strtotime('1/1 this year -1 day')));
            $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
            $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
            
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
            break;
        case 'lastquatertodate':
            $quarters = array();
            $todaydate = date('d',strtotime($dt));
            $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
            $quarters[01] = $quarters[02] = $quarters[03] =  array('start_date' => date('Y-m-d', strtotime('10/1 last year')),'end_date' =>  date('Y-m-d', strtotime('10/'.$todaydate.' last year')));
            $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('1/'.$todaydate.' this year')));
            $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('4/'.$todaydate.' this year')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('7/'.$todaydate.' this year')));
            
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
        break;
        case 'lastyear':
            $lowdateval  = date('Y-m-d', strtotime('1/1 last year'));
            $highdateval = date('Y-m-d', strtotime('1/1 this year -1 day'));
        break;
        case 'lastyeartodate':
            $lowdateval  = date('Y-m-d', strtotime('1/1 last year'));
            $highdateval = date('Y-m-d');
        break;
        case 'since30days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-31,date("Y")));
        break;
        case 'since60days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-61,date("Y")));
        break;
        case 'since90days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-91,date("Y")));
        break;
        case 'since350days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-351,date("Y")));
        break;
        case 'nextweek':
            $lowdateval  = date('Y-m-d', strtotime('this sunday'));
            $highdateval = date('Y-m-d', strtotime('next week saturday'));
        break;
        case 'nextfourweeks':
            $lowdateval  = date('Y-m-d', strtotime('this sunday'));
            $highdateval = date('Y-m-d', strtotime('+4 weeks Saturday'));
        break;
        case 'nextmonth':
            $lowdateval  = date('Y-m-d', strtotime('first day of next month'));
            $highdateval = date('Y-m-d', strtotime('last day of next month'));
        break;
        case 'nextquater':
            $quarters = array();
            $first_day_year = date('Y-m-d', strtotime('1/1 next year'));
            //$quarters[01] = $quarters[02] = $quarters[03] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
             $quarters[01] = $quarters[02] = $quarters[03]= array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
             $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('10/1 this year - 1 day')));
            $quarters[07] = $quarters[08] = $quarters[09]  = array('start_date' => date('Y-m-d', strtotime('10/1 this year')),'end_date' =>  date('Y-m-d', strtotime('1/1 next year -1 day')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 next year - 1 day')));
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
        break;
        case 'nextyear':
            $lowdateval  = date('Y-m-d', strtotime('1/1 next year'));
            $highdateval = date('Y-m-d', strtotime('12/31 next year'));
        break;
        }

        return array('highdateval' => $highdateval, 'lowdateval' => $lowdateval);
   }
   
   
function update_usermeta($key = '',$value = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
    
    $data = $return_data = array();
    $data['meta_value'] = $value;
    $data['updated_id'] = getAdminUserId();
    $data['updated_time'] = date('Y-m-d', local_to_gmt());
    
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
        $return_data['prev_value'] = $meta_row_data['meta_value'];
        $CI->user_model->update(array('umeta_id' => $meta_row_data['umeta_id']),$data,'usermeta');
        $return_data['id'] = $meta_row_data['umeta_id'];
        $return_data['status'] =  "update";
        
    }
    else
    {
        $data['meta_key'] = $key;
        $data['user_id'] = $user_id;
        $data['created_id'] = getAdminUserId();
        $data['created_time'] = date('Y-m-d', local_to_gmt());
        $umeta_id = $CI->user_model->insert($data,'usermeta');
        $return_data['id'] = $umeta_id;
        $return_data['status'] =  "add";
    }
    
    return $return_data;
    
}


function get_usermeta($key = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
      
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
    
        return $meta_row_data['meta_value'];
    }
    else
    {
        return false;
    }
}



function xml_obj_to_array($xml_obj) {
        
            $json = json_encode($xml_obj,TRUE);
            $arr = json_decode($json,TRUE);
        
        return $arr;                     
}



function get_job_category()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from job_category where status='Active'")->result_array();
  return $q;
}

function get_current_user_dt($user_id)
{
  $CI = get_instance();
  $q = $CI->db->query("select * from user where id='$user_id'")->row_array();
  return $q;
}
function get_users($role='')
{
  $CI = get_instance();
  $q = $CI->db->query("select * from employers where role='".$role."'")->result_array();
  return $q;
}

function get_dashboard_count($table,$where='',$emp_id='')
{
  $where1 = "";
  if($emp_id!='')
    $where1 = ($where!='')?"and ".$emp_id."":"where ".$emp_id."";
  if($where!='')
    $where = "where ".$where;
   $CI = get_instance();
  $q = $CI->db->query("select count(id) as counts from $table $where $where1")->row_array();
  return $q['counts'];
}

//increment notification count
function update_notification_count($user_id,$message,$type,$notify_id,$user_type){
    $CI = get_instance();
    $CI->load->model('jobs_model');
    $notificaton_data                      = array();
    $notificaton_data['message']           = $message;
    $notificaton_data['user_id']           = $user_id;
    $notificaton_data['is_view']           = 0;
    $notificaton_data['date_created']      = date("Y-m-d H:i:s");
    $notificaton_data['type']              = $type;
    $notificaton_data['notify_id']         = $notify_id;
    $notificaton_data['user_type']         = $user_type; 
    $notification_insert                   = $CI->jobs_model->insert($notificaton_data,"notifications");
    return true;
}

function get_notification_count($user_id='',$job_id,$type)
{
    $CI = get_instance();
    $wh = '';
    if(!empty($user_id)){
        $wh = "user_id='".$user_id."' and ";
    }
    $ct = $CI->db->query("select count(*) as cnt from notifications where $wh notify_id='".$job_id."' and type='".$type."'")->row_array();
    return $ct['cnt'];
}

function get_average_rating_by_userId($user_id,$type){

   
   $CI     = get_instance();
   $CI->load->model('user_model');

   $rating = $CI->db->query("select rating from rating where user_id='".$user_id."' and type = '".$type."'")->result_array();

       $rt = '';

       array_push($rating,array("rating" => 5.0));

     if(count($rating)>0){
        foreach($rating as $rkey => $rvalue){
            $rt += $rvalue['rating'];
        }    
      } 
     // print_r($rating);
   //  echo count($rating);
      // $ratio = (!empty($rating) && count($rating)>0)?round($rt/count($rating)):5.0;
      $ratio = (count($rating)>0)?$rt/count($rating):5.0;

      return number_format($ratio,1,'.','');
}

//get average rating
function get_average_rating($user_id,$type,$login_user_id='',$job_id='')
{

   
   $CI     = get_instance();
   $CI->load->model('user_model');
  // $where = ($job_id!='')?' and job_id="'.$job_id.'"':"";
    $where = '';
    
     $ratingData = array();
     $rating     = $CI->db->query("select rating,comments from rating where user_id='".$user_id."' and login_user_id='".$login_user_id."' and type = '".$type."' and job_id='".$job_id."'")->result_array(); 
     
    if($login_user_id!='') {
      $empdata  =   $CI->user_model->check_unique(array('id' => $login_user_id));
      
      foreach($rating as $rkey => $rvalue){
         $ratingData[$rkey]['username']     = $empdata['firstname'];
         $ratingData[$rkey]['profile_name'] = $empdata['profile_name'];
         $ratingData[$rkey]['profile_image']= (!empty($empdata['profile_image']))?site_url()."assets/images/uploads/profile/".$empdata['profile_image']:"";
         $ratingData[$rkey]['rating']       = $rvalue['rating'];
         
      }
      return $ratingData;
    }    
   //  else
   //  {

   //    if(count($rating)>0){
   //      foreach($rating as $rkey => $rvalue){
   //          $rt += $rvalue['rating'];
   //      }    
   //    } 
   //    else
   //    {
   //      $rt    = 5.0; 
   //    }  

   //    // $ratio = (!empty($rating) && count($rating)>0)?round($rt/count($rating)):5.0;
   //    $ratio = (count($rating)>0)?$rt/count($rating):5.0;

   //    return number_format($ratio,1,'.','');
   // } 
}

 function sendNotification($deviceToken,$message,$params,$apple_identifier,$notification_type)
 { 

   //echo $apple_identifier; exit;
    //Setup stream (connect to Apple Push Server).

  //  $deviceToken = "442F528726E2D59EEFE51197763E0242D1519E764DE0C3E0D8E74F18954A85FF";
    $ctx = stream_context_create();
    stream_context_set_option($ctx, 'ssl', 'passphrase', '');
    stream_context_set_option($ctx, 'ssl', 'local_cert', 'pushcert.pem');
    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
   
    stream_set_blocking($fp, 0); 
   
    // Create the payload body
      $body['aps'] = array(
                             'alert'     => array('body' => $message),
                             'sound'     => 'default',
                             'badge'     => $params,
                             'notificationType' => $notification_type
                        );
    
       // Keep push alive (waiting for delivery) for 1 days
        $apple_expiry = time() + (1 * 24 * 60 * 60); 
        $payload      = json_encode($body);      
        // Enhanced Notification
        $msg = pack("C", 1) . pack("N", $apple_identifier) . pack("N", $apple_expiry) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload; 
                    
        // SEND PUSH
        $res = fwrite($fp, $msg);
        
      //  echo $fp;
        usleep(500000);
        checkAppleErrorResponse($fp); 
        json_encode(array("status" => "success"));
        socket_close($fp);  
        fclose($fp); 
    }
    
 
    function checkAppleErrorResponse($fp) 
    {

        $apple_error_response = fread($fp, 6);
        
        if ($apple_error_response) {
        
        // unpack the error response (first byte 'command" should always be 8)
        $error_response = unpack('Ccommand/Cstatus_code/Nidentifier', $apple_error_response); 
        
        if ($error_response['status_code'] == '0') {
        $error_response['status_code'] = '0-No errors encountered';
        
        } else if ($error_response['status_code'] == '1') {
        $error_response['status_code'] = '1-Processing error';
        
        } else if ($error_response['status_code'] == '2') {
        $error_response['status_code'] = '2-Missing device token';
        
        } else if ($error_response['status_code'] == '3') {
        $error_response['status_code'] = '3-Missing topic';
        
        } else if ($error_response['status_code'] == '4') {
        $error_response['status_code'] = '4-Missing payload';
        
        } else if ($error_response['status_code'] == '5') {
        $error_response['status_code'] = '5-Invalid token size';
        
        } else if ($error_response['status_code'] == '6') {
        $error_response['status_code'] = '6-Invalid topic size';
        
        } else if ($error_response['status_code'] == '7') {
        $error_response['status_code'] = '7-Invalid payload size';
        
        } else if ($error_response['status_code'] == '8') {
        $error_response['status_code'] = '8-Invalid token';
        
        } else if ($error_response['status_code'] == '255') {
        $error_response['status_code'] = '255-None (unknown)';
        
        } else {
        $error_response['status_code'] = $error_response['status_code'].'-Not listed';
        
        }
     
        return true;
        }
               
        return false;


    } 


    function send_android_notification($device_token, $notification_data)
    {

       //echo $device_token; exit;
        $CI     = get_instance();
        $CI->load->library('fcm');
       
        $res = $CI->fcm->send_notification($device_token, $notification_data);

        
    }


?>