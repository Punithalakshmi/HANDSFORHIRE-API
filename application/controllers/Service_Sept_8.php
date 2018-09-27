<?php

require APPPATH.'/libraries/REST_Controller.php';



/**

 * Service

 * 

 * @package FTP

 * @author Punitha

 * @copyright 2017

 * @version 1

 * @access public

 */

class Service extends REST_Controller

{

       protected $profile_url = '';

        function __construct()

        {

            // Construct our parent class

            parent::__construct();

            

            $key  = $this->get('X-APP-KEY');

            $this->load->library('email');
            $config['protocol']  = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = "html";
            
            $this->email->initialize($config);

            $this->load->model(array("user_model","login_model","address_model","credit_card_model","checking_account_model","paypal_model","jobs_model","rating_model"));
        }

        

         //register

         function user_register_post() {

            

            if(!$this->post('email') || !$this->post('merchantID') ){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

             

           // $username       = $this->post('username');

            $password       = $this->post('password');

            $email          = $this->post('email');

            $firstname      = $this->post('firstname');

            $lastname       = $this->post('lastname');

            $address        = $this->post('address');

            $city           = $this->post('city');

            $state          = $this->post('state');

            $zipcode        = $this->post('zipcode');

            $usertype       = $this->post('usertype');

            $devicetoken    = $this->post('devicetoken');
            $merchantID     = $this->post('merchantID');

            

             // if(!empty($username)) {

             //      //username check if already exists or not

             //      $user_res = $this->user_model->check_unique(array("username" => $username));

             //      if(count($user_res)>0) {

             //        return $this->response(array('status' => "error",'msg' => 'Username Is Already In Use','error_code' => "2"), 404);

             //      }

             // } 

             

             //if(!empty($email)) {

//                  //Email check if already exists or not

//                  $email_res = $this->user_model->check_unique(array("email" => $email));

//                  if(count($email_res)>0) {

//                    return $this->response(array('status' => "error",'msg' => 'Email already exists.','error_code' => 2), 404);

//                  }

//             }

             

            

            $ins_data = array();

           // $ins_data['username']       = $username;

            $ins_data['password']       = md5($password);

            $ins_data['email']          = $email;

            $ins_data['firstname']      = $firstname;

            $ins_data['lastname']       = $lastname;

            $ins_data['address']        = $address;

            $ins_data['city']           = $city;

            $ins_data['state']          = $state;

            $ins_data['zipcode']        = $zipcode;

            $ins_data['usertype']       = $usertype;

            $ins_data['devicetoken']    = $devicetoken;
            $ins_data['merchant_id']    = $merchantID;

                

            $user_id = $this->user_model->insert($ins_data,"user");   

            if(!empty($user_id)){

                $res = $email_res = $this->user_model->check_unique(array('id' => $user_id));
                 
                 //$address
                $address_data = array();
                $address_data['address1'] = $address;
                $address_data['address2'] = '';
                $address_data['city']     = $city;
                $address_data['state']    = $state;
                $address_data['zipcode']  = $zipcode;
                $address_data['user_id']  = $user_id;
                $address = $this->address_model->insert($address_data);

                return $this->response(array('status' =>'success','request_type' => 'create_account','user_data' => $res), 200);

            }    

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'create_account', 'msg' => "User doesn't create!" ,'error_code' => "5"), 404);

            }

        }

        

        //check if email id already exists or not

        function user_email_check_post(){

            if(!$this->post('email')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            $email = $this->post('email');

            

            if(!empty($email)) {

                  //Email check if already exists or not

                  $email_res = $this->user_model->check_unique(array("email" => $email));

                  if(count($email_res)>0) {

                    return $this->response(array('status' => "error",'msg' => 'This Email Already Exists','error_code' => "2"), 404);

                  }

             }

             

            return $this->response(array('status' => "success"), 200);

        }

        

        //user email update

        function user_email_update_post() {

            

            if(!$this->post('user_id') && !$this->post('email')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

             

            $email          = $this->post('email');

            $user_id        = $this->post('user_id');

            $res            = $this->user_model->check_unique(array('id' => $user_id));

            

             if(!empty($email)) {

                  //Email check if already exists or not

                  $email_res = $this->user_model->check_unique(array("email" => $email, 'id!=' => $user_id));

                  if(count($email_res)>0) {

                    return $this->response(array('status' => "error",'msg' => 'This Email Already Exists','error_code' => "2"), 404);

                  }

             } 

            

            

            if(count($res)>0){   

                $ins_data           = array();

                $ins_data['email']  = $email;  

                $affected           = $this->user_model->update(array("id" => $user_id),$ins_data,"user");

                $res = $this->user_model->check_unique(array('id' => $user_id));

                return $this->response(array('status' =>'success','request_type' => 'update_email','user_data' => $res), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'update_email', 'msg' => 'Email not updated', 'error_code' => "3"), 404);

            } 

        }

        

        //login

        function login_post()

        {

            if(!$this->post('username') & !$this->post('password') & !$this->post('devicetoken')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

      

            $username       = $this->post('username'); 

            $password       = $this->post('password');

            $devicetoken    = $this->post('devicetoken');

            $type           = $this->post("type");

            

            $result = $this->login_model->app_login($username,$password,$type);

           //print_r($result);exit;

            if(!empty($result)){

                //update user device token

                $device_token_update = $this->user_model->update(array("id" => $result['id']),array("devicetoken" => $devicetoken),"user");

                $result['devicetoken'] = $devicetoken;
                
                return $this->response(array('status' =>'success','request_type' => 'user_login','user_data' => $result), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'user_login', 'msg' => 'Invalid Username and/or Password', 'error_code' => "4"), 404);

            }

        }

        

        //user authentication update (username/password)

        function user_authentication_update_post()

        {

            if(!$this->post('user_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $username  = $this->post('username');

            $password  = $this->post('password');

            $user_id   = $this->post('user_id');

            

            $res       = $this->user_model->check_unique(array('id' => $user_id));

            $username  = (!empty($username))?$username:$res['username'];

            $password  = (!empty($password))?md5($password):$res['password'];

            

            if(!empty($username)) {

                  //Username check if already exists or not

                  $user_res = $this->user_model->check_unique(array("email" => $username, 'id!=' => $user_id));

                  if(count($user_res)>0) {

                    return $this->response(array('status' => "error",'msg' => 'Email Is Already In Use','error_code' => "2"), 404);

                  }

             }

            

            if(count($res)>0){

                $up = array();
                $up['email']   = $username;
                $up['password'] = $password;

                $update = $this->user_model->update(array("id" => $res['id']),$up,"user");

                return $this->response(array('status' =>'success','request_type' => 'user_authenticate_update','user_data' => get_current_user_dt($user_id)), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'user_authenticate_update', 'msg' => 'Invalid User!', 'error_code' => "6"), 404);

            }

        }

        

        //add user address

        function user_address_post()

        {

            if(!$this->post('user_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            } 

            

            $address1       = $this->post('address1');
            $address2       = $this->post('address2');
            $city           = $this->post('city');
            $state          = $this->post('state');
            $zipcode        = $this->post('zipcode');
            $user_id        = $this->post('user_id');

            

            $ins_data = array();

            $ins_data['user_id']  = $user_id;

            $ins_data['address1'] = $address1;

            $ins_data['address2'] = $address2;

            $ins_data['city']     = $city;

            $ins_data['state']    = $state;

            $ins_data['zipcode']  = $zipcode;

            $address_id           = $this->address_model->insert($ins_data);

            if(!empty($address_id)){
                return $this->response(array('status' =>'success','request_type' => 'user_address_create','address_id' => $address_id), 200);
            }    
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'user_address_create', 'msg' => "Invalid Address - Please Fill In The Missing Information" ,'error_code' => "5"), 404);
            }

        } 

        

        //get user update email

        function get_user_email_post()

        {

            if(!$this->post('user_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $user_id   = $this->post('user_id');

            $res       = $this->user_model->check_unique(array('id' => $user_id));

            

            if(count($res)>0){

                return $this->response(array('status' =>'success','request_type' => 'get_user_email','email' => $res['email']), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'get_user_email', 'msg' => "User doesn't exists!" ,'error_code' => "6"), 404);

            }

        }

        

        //get user update username

        function get_username_post()

        {

            if(!$this->post('user_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $user_id   = $this->post('user_id');

            $res       = $this->user_model->check_unique(array('id' => $user_id));

            

            if(count($res)>0){

                return $this->response(array('status' =>'success','request_type' => 'get_username','username' => $res['firstname']), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'get_username', 'msg' => "User doesn't exists!" ,'error_code' => "6"), 404);

            }

        }

        

        //add credit card

        function add_credit_card_post()

        {

            if(!$this->post('name')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            } 

            

            $name           = $this->post('name');

            $card_number    = $this->post('card_number');

            $card_type      = $this->post('card_type');

            $exp_month      = $this->post('exp_month');

            $exp_year       = $this->post('exp_year');

            $cvv            = $this->post('cvv');

            $employer_id    = $this->post('employer_id');

            $address_card   = $this->post('address_card');

            $state          = $this->post('state');

            $city           = $this->post('city');

            $zipcode        = $this->post('zipcode');

            $default_card   = $this->post('default_card');

            $usertype       = $this->post('usertype');

            

             if(!empty($card_number)) {

                  //Card number check if already exists or not

                  $card_res = $this->credit_card_model->check_unique(array("card_number" => $card_number));

                  if(count($card_res)>0) {

                    return $this->response(array('status' => "error",'msg' => 'This Card Number Already Exists','error_code' => "2"), 404);

                  }

             }

            

            $ins_data = array();

            $ins_data['name']        = $name;

            $ins_data['card_number'] = $card_number;

            $ins_data['card_type']   = $card_type;

            $ins_data['exp_month']   = $exp_month;

            $ins_data['exp_year']    = $exp_year;

            $ins_data['cvv']         = $cvv;

            $ins_data['address_card']= $address_card;

            $ins_data['state']       = $state;

            $ins_data['city']        = $city;

            $ins_data['zipcode']     = $zipcode;

            $ins_data['employer_id'] = $employer_id;

            $ins_data['default_card']= $default_card;

            $ins_data['created_date']= date("Y-m-d H:i:s");

            $ins_data['usertype']    = $usertype;

            $card_id                 = $this->credit_card_model->insert($ins_data);

            if(!empty($card_id)){

                return $this->response(array('status' =>'success','request_type' => 'add_credit_card','card_id' => $card_id), 200);

            }    

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'add_credit_card', 'msg' => "Invalid Card Information - Please Check The Details Of Your Card And Try Again" ,'error_code' => "5"), 404);

            }

        }

        

        //user credit card update

        function credit_card_update_post() {

            

            if(!$this->post('card_id') && !$this->post('card_number')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

             

                $name           = $this->post('name');

                $card_number    = $this->post('card_number');

                $card_type      = $this->post('card_type');

                $exp_month      = $this->post('exp_month');

                $exp_year       = $this->post('exp_year');

                $cvv            = $this->post('cvv');

                $employer_id    = $this->post('employer_id');

                $address_card   = $this->post('address_card');

                $state          = $this->post('state');

                $city           = $this->post('city');

                $zipcode        = $this->post('zipcode');

                $card_id        = $this->post('card_id');

                $default_card   = $this->post('default_card');

                $usertype       = $this->post('usertype');

                

                //get card details

                $cd_res = $this->credit_card_model->check_unique(array('id' => $card_id));

                

                $ins_data = array();

                $ins_data['name']        = (!empty($name))?$name:$cd_res['name'];

                $ins_data['card_number'] = (!empty($card_number))?$card_number:$cd_res['card_number'];

                $ins_data['card_type']   = (!empty($card_type))?$card_type:$cd_res['card_type'];

                $ins_data['exp_month']   = (!empty($exp_month))?$exp_month:$cd_res['exp_month'];

                $ins_data['exp_year']    = (!empty($exp_year))?$exp_year:$cd_res['exp_year'];

                $ins_data['cvv']         = (!empty($cvv))?$cvv:$cd_res['cvv'];

                $ins_data['address_card']= (!empty($address_card))?$address_card:$cd_res['address_card'];

                $ins_data['state']       = (!empty($state))?$state:$cd_res['state'];

                $ins_data['city']        = (!empty($city))?$city:$cd_res['city'];

                $ins_data['zipcode']     = (!empty($zipcode))?$zipcode:$cd_res['zipcode'];

                $ins_data['employer_id'] = (!empty($employer_id))?$employer_id:$cd_res['employer_id'];

                $ins_data['default_card']= (!empty($default_card))?$default_card:$cd_res['default_card'];

                $ins_data['usertype']    = $usertype;

           

            $card_res = $this->credit_card_model->check_unique(array('id' => $card_id));

          

            if(count($card_res)==0){

                return $this->response(array('status' =>'error','request_type' => 'update_credit_card_details', 'msg' => "Credit Cart doesn't exists", 'error_code' => "3"), 404);

            } 

            

             if(!empty($card_number)) {

                  //Card number check if already exists or not

                  $card_res = $this->credit_card_model->check_unique(array("card_number" => $card_number, 'id!=' => $card_id));

                  if(count($card_res)>0) {

                    return $this->response(array('status' => "error",'msg' => 'This Card Number Already Exists','error_code' => "2"), 404);

                  }

             } 

              

            $ins_data['updated_date'] = date("Y-m-d H:i:s");

            $affected                 = $this->credit_card_model->update(array("id" => $card_id),$ins_data);

            

            if(!empty($affected)){   

                $res = $this->credit_card_model->check_unique(array('id' => $card_id));

                return $this->response(array('status' =>'success','request_type' => 'update_credit_card_details','user_data' => $res), 200);

            }

            

        }

        

         //view credit card details

        function view_credit_card_post()

        {

            if(!$this->post('card_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $card_id   = $this->post('card_id');

            

            //Card number check if already exists or not

            $card_res  = $this->credit_card_model->check_unique(array('id' => $card_id));

            

            if(count($card_res)>0){

                 return $this->response(array('status' =>'success','request_type' => 'view_credit_card_details', 'card_data' => $card_res), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'view_credit_card_details', 'msg' => "Card doesn't exists!" ,'error_code' => "6"), 404);

            }

        } 

        

       

       //Delete credit card details

        function delete_credit_card_post()

        {

            if(!$this->post('card_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $card_id   = $this->post('card_id');

            $res       = $this->credit_card_model->delete(array('id' => $card_id));

            

            return $this->response(array('status' =>'success','request_type' => 'delete_credit_card', 'card_id' => $card_id), 200);

        } 

        

        //lists the employer cards

        function lists_employer_cards_post()

        {

            if(!$this->post('employer_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $employer_id= $this->post('employer_id');

            $card_res   = array();

            $card_res   = $this->credit_card_model->get_employer_cards(array('c.employer_id' => $employer_id));

            $check_res  = $this->checking_account_model->get_checking_account_data(array('c.employer_id' => $employer_id));

            $paypal_res = $this->paypal_model->get_paypal_user_info(array('p.user_id' => $employer_id));

            

            if((count($card_res)>0) || (count($check_res)>0) || (count($paypal_res)>0)){

                 return $this->response(array('status' =>'success','request_type' => 'employer_card_lists', 'card_data' => $card_res, 'checking_account_data' => $check_res, 'paypal_info' => $paypal_res), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'employer_card_lists', 'msg' => "No Card Available" ,'error_code' => "7"), 404);

            }

        }

        

       //update profile image & profile name  

        function update_profile_image_post()

        {

            if(!$this->post('user_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $profile_image = $this->post('profile_image');

            $profile_name  = $this->post('profile_name');

            $user_id       = $this->post("user_id"); 

            $res           = $this->user_model->check_unique(array('id' => $user_id));

            

            if(count($res)>0){

                 $ins_data   = array();

                 $ins_data['profile_image'] = (!empty($profile_image))?$profile_image:$res['profile_image'];

                 $ins_data['profile_name']  = (!empty($profile_name))?$profile_name:$res['profile_name']; 

                 $update = $this->user_model->update(array("id" => $res['id']),$ins_data,"user");

                 return $this->response(array('status' =>'success','request_type' => 'update_profile_section'), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'update_profile_section', 'msg' => "Your Profile Image Could Not Be Updated" ,'error_code' => "7"), 404);

            }

        }

        

        //add checking account data

        function add_checking_account_post()

        {

            if(!$this->post('name')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            } 

            

            $name           = $this->post('name');

            $routing_number = $this->post('routing_number');

            $account_number = $this->post('account_number');

            $license_number = $this->post('license_number');

            $employer_id    = $this->post('employer_id');

            $default_account= $this->post('default_account');

            $state          = $this->post('state');

            //$check_accot_id = $this->post('checking_account_id');

            $status         = $this->post('status');

            $usertype       = $this->post('usertype');

            

             if(!empty($account_number)) {

                  //Account number check if already exists or not

                  $account_res = $this->checking_account_model->check_unique(array("account_number" => $account_number));

                  if(count($account_res)>0) {

                    return $this->response(array('status' => "error",'msg' => 'This Account Number Already Exists','error_code' => "2"), 404);

                  }

             }

            

            $ins_data = array();

            $ins_data['name']           = $name;

            $ins_data['routing_number'] = $routing_number;

            $ins_data['account_number'] = $account_number;

            $ins_data['license_number'] = $license_number;

            $ins_data['state']          = $state;

            $ins_data['status']         = $status;

            $ins_data['employer_id']    = $employer_id;

            $ins_data['default_account']= $default_account;

            $ins_data['created_date']   = date("Y-m-d H:i:s");

            $ins_data['usertype']       = $usertype;

            

            $checking_account_id        = $this->checking_account_model->insert($ins_data);

            if(!empty($checking_account_id)){

                return $this->response(array('status' =>'success','request_type' => 'add_checking_account','checking_account_id' => $checking_account_id), 200);

            }    

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'add_checking_account', 'msg' => "Invalid Checking Account Information - Please Check The Details Of Your Card And Try Again" ,'error_code' => "5"), 404);

            }

        }

        

        //user checking account update

        function checking_account_update_post() {

            

                if(!$this->post('checking_account_id') && !$this->post('account_number')){

                    return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

                }

                 

                $name           = $this->post('name');

                $routing_number = $this->post('routing_number');

                $account_number = $this->post('account_number');

                $license_number = $this->post('license_number');

                $default_account= $this->post('default_account');

                $employer_id    = $this->post('employer_id');

                $state          = $this->post('state');

                $status         = $this->post('status');

                $check_accot_id = $this->post('checking_account_id');

                $usertype       = $this->post('usertype');

                

                //get account details

                $cd_res = $this->checking_account_model->check_unique(array('id' => $check_accot_id));

                

                $ins_data = array();

                $ins_data['name']           = (!empty($name))?$name:$cd_res['name'];

                $ins_data['routing_number'] = (!empty($routing_number))?$routing_number:$cd_res['routing_number'];

                $ins_data['account_number'] = (!empty($account_number))?$account_number:$cd_res['account_number'];

                $ins_data['license_number'] = (!empty($license_number))?$license_number:$cd_res['license_number'];

                $ins_data['state']          = (!empty($state))?$state:$cd_res['state'];

                $ins_data['status']         = (!empty($status))?$status:$cd_res['status'];

                $ins_data['employer_id']    = (!empty($employer_id))?$employer_id:$cd_res['employer_id'];

                $ins_data['default_account']= (!empty($default_account))?$default_account:$cd_res['default_account'];

                $ins_data['usertype']       = $usertype;

                

                

           

             if(!empty($account_number)) {

                  //Account number check if already exists or not

                  $acc_res = $this->checking_account_model->check_unique(array("account_number" => $account_number, 'id!=' => $check_accot_id));

                  if(count($acc_res)>0) {

                    return $this->response(array('status' => "error",'msg' => 'This Account Number Already Exists','error_code' => "2"), 404);

                  }

             } 

            $ins_data['updated_date']   = date("Y-m-d H:i:s");

            $affected  = $this->checking_account_model->update(array("id" => $check_accot_id),$ins_data);

            

            if(!empty($affected)){   

                $res = $this->checking_account_model->check_unique(array('id' => $check_accot_id));

                return $this->response(array('status' =>'success','request_type' => 'update_credit_card_details','account_data' => $res), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'update_credit_card_details', 'msg' => "Invalid Checking Account Information - Please Check The Details Of Your Card And Try Again", 'error_code' => "3"), 404);

            } 

        }

        

         //view checking account by through checking account id

        function view_checking_account_post()

        {

            if(!$this->post('checking_account_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            $checking_account_id   = $this->post('checking_account_id');

            

            //Get checking account data

            $check_res  = $this->checking_account_model->check_unique(array('id' => $checking_account_id));

            

            if(count($check_res)>0){

                 return $this->response(array('status' =>'success','request_type' => 'view_checking_account', 'checking_data' => $check_res), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'view_checking_account', 'msg' => "Checking Account doesn't exists!" ,'error_code' => "6"), 404);

            }

        } 

        

        //Delete Checking Account details

        function delete_checking_account_post()

        {

            if(!$this->post('checking_account_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $checking_account_id   = $this->post('checking_account_id');

            $res                   = $this->checking_account_model->delete(array('id' => $checking_account_id));

            return $this->response(array('status' =>'success','request_type' => 'delete_checking_account', 'card_id' => $checking_account_id), 200);

        } 

        
        //get profile image & profile name  
        function get_profile_image_post()
        {

            if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }

            $user_id       = $this->post("user_id"); 
            $type          = $this->post("type");
            $res           = $this->user_model->check_unique(array('id' => $user_id));
            //$employee_rating['cnt'] = '';
          //  $employer_rating['cnt'] = '';
            
            if(count($res)>0){
                 $profile_image      = (!empty($res['profile_image']))?site_url()."assets/images/uploads/profile/".$res['profile_image']:"";
                 $pending   = $this->db->query("select count(*) as cnt from notifications where user_id='".$user_id."' and type='notificationCountPending'")->row_array();
                 $posted    = $this->db->query("select count(*) as cnt from notifications where user_id='".$user_id."' and type='notificationCountPosted'")->row_array();
                 $active    = $this->db->query("select count(*) as cnt from notifications where user_id='".$user_id."' and type='notificationCountActive'")->row_array();
                 $history   = $this->db->query("select count(*) as cnt from notifications where user_id='".$user_id."' and type='notificationCountJobHistory'")->row_array();
                 
                 $pending    = (isset($pending['cnt']))?$pending['cnt']:"";
                 $posted     =  (isset($posted['cnt']))?$posted['cnt']:"";
                 $active     = (isset($active['cnt']))?$active['cnt']:"";
                 $history    = (isset($history['cnt']))?$history['cnt']:"";
                 
               //  if($type == 'employee'){
                    //$employee_rating = $this->db->query("select count(*) as cnt from rating where employee_id='".$user_id."'")->row_array();  
                    $employee_rating = get_average_rating_by_userId($user_id,'employee');
             //   }  
              //  else
              //  {
                   // $employer_rating = $this->db->query("select count(*) as cnt from rating where employer_id='".$user_id."'")->row_array();
                   $employer_rating = get_average_rating_by_userId($user_id,'employer');
              //  }
                
                 return $this->response(array('status' =>'success','request_type' => 'get_profile_image_and_name', "profile_name" => $res['profile_name'], "profile_image" => $profile_image, "username" => $res['firstname'],"notificationCountPending" => $pending, "notificationCountPosted" => $posted, "notificationCountActive" => $active, "notificationCountJobHistory" => $history, 'employee_rating' => $employee_rating, 'employer_rating' => $employer_rating  ), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'get_profile_image_and_name', 'msg' => "Doesn't found user!" ,'error_code' => "7"), 404);
            }

        }
 

        //save payment information

        function save_payment_information_post()

        {

            if(!$this->post('user_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $user_id       = $this->post("user_id"); 

            $ins_data               = array();
            $ins_data['employer_id']= $user_id;
            $ins_data['email_id']   = $this->post('email');
            $ins_data['password']   = $this->post('password');
            $res                    = $this->paypal_model->insert($ins_data,'paypal');

            
            if(count($res)>0){

                 return $this->response(array('status' =>'success','request_type' => 'save_paypal_info' ), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'save_paypal_info', 'msg' => "We Could Not Save Your PayPal Information - Please Try Again" ,'error_code' => "8"), 404);

            }

        }

        

        //get payment information

        function check_if_payment_mode_post()

        {

            if(!$this->post('user_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $user_id        = $this->post("user_id"); 

            $check_account  = $this->checking_account_model->check_unique(array('employer_id' => $user_id));

            $credit_account = $this->credit_card_model->check_unique(array('employer_id' => $user_id));

            $paypal         = $this->db->query("select * from paypal_user_info where user_id='".$user_id."'")->result_array();

            

            if((count($check_account)>0) || (count($credit_account)>0) || (count($paypal)>0)){

                 return $this->response(array('status' =>'success','request_type' => 'save_paypal_info', "payment" => 'yes' ), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'save_paypal_info', "payment" => "no" ,'error_code' => "9"), 404);

            }

        }

        

        //create job

        function create_job_post()

        {

            if(!$this->post('user_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $employer_id            = $this->post('user_id');

            $job_name               = $this->post('job_name');

            $job_category           = $this->post('job_category');

            $job_description        = $this->post('job_description');

            $job_date               = $this->post('job_date');

            $job_start_date         = $this->post('job_start_date');

            $job_end_date           = $this->post('job_end_date');

            $job_payment_amount     = $this->post('job_payment_amount');

            $job_payment_type       = $this->post('job_payment_type');

            $address                = $this->post('address');

            $city                   = $this->post('city');

            $state                  = $this->post('state');

            $zipcode                = $this->post('zipcode');

            $post_address           = $this->post('post_address');

            $start_time             = $this->post('start_time');

            $end_time               = $this->post('end_time');

            $lat                    = $this->post('lat');

            $lon                    = $this->post('lon');
            $currentlocation        = $this->post('currentlocation');
            $user_type              = $this->post('user_type');
            $job_date_time_flexible = $this->post('job_date_time_flexible');
            $job_estimated_payment  = $this->post('job_estimated_payment');
            $employee_id            = $this->post('employee_id');
            $out_of_pocket_expense  = $this->post('out_of_pocket_expense');
            $jobPayout              = $this->post('jobPayout');
            $paypalFee              = $this->post('paypalFee');
            $fee_details            = $this->post('fee_details');
            $job_expire             = $this->post('job_expire');
            $sub_category           = $this->post('sub_category');
            $job_category_color     = $this->post('job_category_color');
            $delist                 = $this->post('delist');
            $is_achieved            = $this->post('is_achieved');


            

            $ins_data = array();

            $ins_data['employer_id']       = $employer_id;
           
            $ins_data['job_name']          = $job_name;

            $ins_data['job_category']      = $job_category;

            $ins_data['description']       = $job_description;

            $ins_data['job_date']          = $job_date;

            $ins_data['job_start_date']    = $job_start_date;

            $ins_data['job_end_date']      = $job_end_date;

            $ins_data['job_payment_amount']= $job_payment_amount;

            $ins_data['job_payment_type']  = $job_payment_type;

            $ins_data['address']           = $address;

            $ins_data['city']              = $city;

            $ins_data['state']             = $state;

            $ins_data['zipcode']           = $zipcode;

            $ins_data['post_address']      = $post_address;

            $ins_data['start_time']        = $start_time;

            $ins_data['end_time']          = $end_time;

            $ins_data['lat']               = $lat;

            $ins_data['lon']               = $lon;
            $ins_data['currentlocation']   = $currentlocation;
            $ins_data['job_date_time_flexible']= $job_date_time_flexible;
            $ins_data['job_estimated_payment'] = $job_estimated_payment;
            $ins_data['out_of_pocket_expense'] = $out_of_pocket_expense;
            $ins_data['delist']                = $delist;
            $ins_data['job_payout']            = $jobPayout;
            $ins_data['paypalfee']             = $paypalFee;
            $ins_data['fee_details']           = $fee_details;
            $ins_data['job_expire_date_time']  = $job_expire;
            $ins_data['sub_category']          = $sub_category;
            $ins_data['job_category_color']    = $job_category_color;
            $ins_data['delist']                = $delist;
            $ins_data['is_achieved']           = (!empty($is_achieved))?$is_achieved:'no';

            $res                               =  $this->jobs_model->insert($ins_data,'jobs');

           // $notification = array();
//            $notification['message']  = '';
//            $notification['user_id']  = $employer_id;
//            $notification['is_view']  = 0;
//            $notification['type']     = 'notificationCountPosted';
//            $notification             =  $this->jobs_model->insert($notification,'notifications');
            if(empty($employee_id)){
               update_notification_count($employer_id,'','notificationCountPosted',$res,$user_type);
            }
            
            if($res!=''){

                if(!empty($employee_id)){
                    $this->hire_job_get($res,$job_name,$employer_id,$employee_id,'');
                }
                
                 return $this->response(array('status' =>'success','request_type' => 'create_job', 'job_id' => $res), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'create_job', 'msg' => "We Could Not Create Your Job - Please Check The Job Details For Missing Information",'error_code' => "8"), 404);

            }

        }

        

        //edit job

        function edit_job_post()

        {

            if(!$this->post('job_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $id                     = $this->post('job_id');
            $employer_id            = $this->post('user_id');
            $job_name               = $this->post('job_name');
            $job_category           = $this->post('job_category');
            $job_description        = $this->post('job_description');
            $job_date               = $this->post('job_date');
            $job_start_date         = $this->post('job_start_date');
            $job_end_date           = $this->post('job_end_date');
            $job_payment_amount     = $this->post('job_payment_amount');
            $job_payment_type       = $this->post('job_payment_type');
            $address                = $this->post('address');
            $city                   = $this->post('city');
            $state                  = $this->post('state');
            $zipcode                = $this->post('zipcode');
            $post_address           = $this->post('post_address');
            $start_time             = $this->post('start_time');
            $end_time               = $this->post('end_time');
            $lat                    = $this->post('lat');
            $lon                    = $this->post('lon');
            $currentlocation        = $this->post('currentlocation');
            $job_date_time_flexible = $this->post('job_date_time_flexible');
            $job_estimated_payment  = $this->post('job_estimated_payment');
            $out_of_pocket_expense  = $this->post('out_of_pocket_expense');
            $jobPayout              = $this->post('jobPayout');
            $paypalFee              = $this->post('paypalFee');
            $fee_details            = $this->post('fee_details');
            $job_expire             = $this->post('job_expire');
            $sub_category           = $this->post('sub_category');
            $job_category_color     = $this->post('job_category_color');
            $delist                 = $this->post('delist');
            $is_achieved            = $this->post('is_achieved');
            
            

            $ins_data = array();
            $ins_data['employer_id']       = $employer_id;
            $ins_data['job_name']          = $job_name;
            $ins_data['job_category']      = $job_category;
            $ins_data['description']       = $job_description;
            $ins_data['job_date']          = $job_date;
            $ins_data['job_start_date']    = $job_start_date;
            $ins_data['job_end_date']      = $job_end_date;
            $ins_data['job_payment_amount']= $job_payment_amount;
            $ins_data['job_payment_type']  = $job_payment_type;
            $ins_data['address']           = $address;
            $ins_data['city']              = $city;
            $ins_data['state']             = $state;
            $ins_data['zipcode']           = $zipcode;
            $ins_data['start_time']        = $start_time;
            $ins_data['end_time']          = $end_time;
            $ins_data['lat']               = $lat;
            $ins_data['lon']               = $lon;
            $ins_data['currentlocation']   = $currentlocation;
            $ins_data['job_date_time_flexible']= $job_date_time_flexible;
            $ins_data['job_estimated_payment'] = $job_estimated_payment;
            $ins_data['out_of_pocket_expense'] = $out_of_pocket_expense;
            //$ins_data['delist']                = 'no';
            $ins_data['job_payout']            = $jobPayout;
            $ins_data['paypalfee']             = $paypalFee;
            $ins_data['fee_details']           = $fee_details;
            $ins_data['job_expire_date_time']  = $job_expire;
            $ins_data['sub_category']          = $sub_category;
            $ins_data['job_category_color']    = $job_category_color;
            $ins_data['delist']                = $delist;
            $ins_data['is_achieved']           = (!empty($is_achieved))?$is_achieved:'no';

            $res                               = $this->jobs_model->update(array("id" => $id),$ins_data,'jobs');

            

            if($res){
                 return $this->response(array('status' =>'success','request_type' => 'update_job', 'job_id' => $id, 'query' => $this->db->last_query()), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'update_job', 'msg' => "Doesn't edit job!" ,'error_code' => "8"), 404);
            }

        }


        //display jobs

        function job_lists_post()
        {

            //if(!$this->post('user_id')){

//              return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
//          }
            $employer_id = $this->post('user_id');
            $type        = $this->post('type');
            
            if($type == 'posted'){
              $job_lists   = $this->jobs_model->job_lists($employer_id);
            } 

            if($type == 'applied')
            {
              $job_lists   = $this->jobs_model->applied_job_lists($employer_id);  
            }
            
            if($type == 'employee')
            {
                $where     = (!empty($employer_id))?" and a.employee_id='".$employer_id."'":"";
                $job_lists = $this->db->query("select j.* from jobs j 
                                                not exists (select a.job_id from applied_jobs a where a.job_id=j.id and a.employee_id = '$employee_id') order by j.id desc")->result_array();
            } 
            
            $jobs_data   = array();

            foreach($job_lists as $jkey => $jvalue){
                $no_of_applicants_applied                     = $this->db->query("select count(*) as cnt from applied_jobs where job_id='".$jvalue['job_id']."' and status='Hold'")->row_array();
                $job_lists[$jkey]['no_of_applicants_applied'] = $no_of_applicants_applied['cnt'];
                $job_lists[$jkey]['profile_image']            = (!empty($jvalue['profile_image']))?site_url()."assets/images/uploads/profile/".$jvalue['profile_image']:"";
                $job_lists[$jkey]['average_rating']           = get_average_rating_by_userId($jvalue['uid'],'employer');
            }

            if(count($job_lists)>0){
                 return $this->response(array('status' =>'success','request_type' => 'job_lists', 'job_lists' => $job_lists), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'job_lists', 'msg' => "No Jobs Found" ,'error_code' => "8"), 404);
            }

        }

        

        //update usertype

        function update_usertype_post()

        {

            if(!$this->post('user_id') && !$this->post('usertype')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $employer_id = $this->post('user_id');

            $usertype    = $this->post('usertype');

            $res         = $this->user_model->check_unique(array('id' => $employer_id));

            

            if(count($res)>0){

                 $ins_data = array();

                 $ins_data['usertype'] = $usertype;

                 $update   = $this->user_model->update(array("id" => $employer_id),$ins_data,"user");

                 return $this->response(array('status' =>'success','request_type' => 'usertype_update'), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'usertype_update', 'msg' => "Doesn't update usertype!" ,'error_code' => "8"), 404);

            }

        }

        

        //job category lists

        function job_category_lists_post()

        {

            

            $job_category_lists = $this->db->query("select * from job_category where 1=1 order by name asc")->result_array();

            

            if(count($job_category_lists)>0){

                 return $this->response(array('status' =>'success','request_type' => 'job_category_lists', 'categories' => $job_category_lists), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'job_category_lists', 'msg' => "Doesn't found categories!" ,'error_code' => "8"), 404);

            }

        }

        

         //job detail view

        function job_detail_view_post()

        {

            if(!$this->post('job_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $job_id = $this->post('job_id');

            $job    = $this->db->query("select j.*,u.*,j.id as job_id,j.address as job_address,j.state as job_state,j.city as job_city,j.zipcode as job_zipcode from jobs j inner join user u on u.id=j.employer_id where j.id='".$job_id."'")->row_array();

            $job['profile_image']    = (!empty($job['profile_image']))?site_url()."assets/images/uploads/profile/".$job['profile_image']:""; 

            

            if(count($job)>0){

                 return $this->response(array('status' =>'success','request_type' => 'job_detail', 'job_data' => $job), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'job_detail', 'msg' => "Doesn't found job!" ,'error_code' => "8"), 404);

            }

        }

        

        //forgot password 

        function forget_password_post()

        {

            if(!$this->post('email')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            

            $email = $this->post('email');

            $res   = $this->user_model->check_unique(array("email" => $email));

            

            if(count($res)>0){

                 $user_id = $res['id'];

                 $username= $res['firstname'];

                 
                 $current_time = strtotime(date("Y-m-d H:i:s"));

                 $fpwd_url = site_url()."auth/changepassword?id=$user_id";

                 $message  = "<html>";

                 $message .= "<body>";

                 $message .= "<p>Hi $username,</p><br/>";

                 $message .= "<p>Please click below link to reset your password.</p><br/>";

                 $message .= "<p><a href='".$fpwd_url."' title='Reset Your Password'>Click Here</a></p><br/><br/>";

                 $message .= "<p>Thanks,<p>";

                 $message .= "<p>HandzforHire</p>"; 

                 $message .= "</body></html>";

    

                 $this->email->from('support@handzforhire.com','Support');

                 $this->email->to($email);

                 $this->email->subject('Forgot Password');

                 $this->email->message($message);

                 $this->email->send();

                 return $this->response(array('status' =>'success','request_type' => 'forget_password'), 200);

           }

           else

           {

              return $this->response(array('status' =>'error','request_type' => 'forget_password', 'msg' => "User not found. Try a different username!" ,'error_code' => "8"), 404);

           }         

        }

        

        //job search
        function job_search_post()
        {
            if(!$this->post('search_type')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }

            $search_type  = $this->post('search_type');
            $category     = $this->post('category');
            $zipcode      = $this->post('zipcode');
            $miles        = $this->post('miles');
            $employee_id  = $this->post('employee_id');
            $all_jobs     = ($search_type == 'display_all')?"yes":"no";
            $miles        = (!empty($miles))?$miles:'10'; 
             
            if($search_type == 'location'){
                $lat        = $this->post('lat');
                $lon        = $this->post('lon');
                $job_lists  = $this->jobs_model->get_location_jobs($lat,$lon,$category,$zipcode,$miles,$employee_id);
               // $query      = $this->db->last_query();
            }
            else
            {
                $job_lists  = $this->jobs_model->job_search($category,$zipcode,$employee_id);
                //$query      = $this->db->last_query();
            }
            
            foreach($job_lists as $jkey => $jvalue){
                $job_lists[$jkey]['profile_image'] = (!empty($jvalue['profile_image']))?site_url()."assets/images/uploads/profile/".$jvalue['profile_image']:"";
                $job_lists[$jkey]['average_rating']=  $ratio = get_average_rating_by_userId($jvalue['uid'],'employer');    
            }

            if(count($job_lists)>0){
                 return $this->response(array('status' =>'success','request_type' => 'job_lists', 'job_lists' => $job_lists,"all_jobs" => $all_jobs), 200);
            }
            else
            {
                 return $this->response(array('status' =>'error','request_type' => 'job_lists', 'msg' => "No Jobs Found" ,'error_code' => "8"), 404);
            }
        }

        

        //apply job

        function apply_jobs_post()

        {

            if(!$this->post('employer_id') && !$this->post('employee_id') && !$this->post('job_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            $employer_id  = $this->post('employer_id');
            $employee_id  = $this->post('employee_id');
            $job_id       = $this->post('job_id');            
            $comments     = $this->post('comments');
            $user_type    = $this->post('user_type');
           

            if($employer_id == $employee_id){
                return $this->response(array('status' => 'error','msg' => 'You are not allowed to apply for the job','error_code' => "12"), 404);
            }

            //get employee data
            $employee_data= $this->user_model->check_unique(array("id" => $employee_id));

            //get job data
            $job_data     = $this->jobs_model->check_unique(array("id" => $job_id));

            $device_token = $this->user_model->check_unique(array("id" => $employer_id));

            $ins_data = array();

            $ins_data['employer_id'] = $employer_id;

            $ins_data['employee_id'] = $employee_id;

            $ins_data['job_id']      = $job_id;

            $ins_data['comments']    = $comments;
            $ins_data['status']      = 'Hold';
            $ins_data['employer_name'] = $device_token['firstname'];
            $ins_data['employee_name'] = $employee_data['firstname'];
            $ins_data['job_name']      = $job_data['job_name'];

            $apply_job    = $this->jobs_model->insert($ins_data,"applied_jobs");

            update_notification_count($employee_id,'','notificationCountPending',$apply_job,$user_type);
            update_notification_count($employer_id,'','notificationCountPosted',$apply_job,$user_type);
            
            $channel_id = $employer_id.$employee_id;
            if(!empty($apply_job)){

                if(!empty($device_token['devicetoken'])){

                  $message = 'You have received a new job application'; 
                  $params  = $this->db->query("select * from notifications where user_id='".$employer_id."' and is_view='0'")->result_array();
                  $notification_count = count($params) + 1;
                  sendNotification($device_token['devicetoken'],$message,$notification_count,$employer_id,'applyjob');
                  update_notification_count($employer_id,$message,'applyjob',$job_id,$user_type);
                }
                return $this->response(array('status' => 'success','request_type' => 'apply_job'), 200);
            }
            else
            {
                 return $this->response(array('status' =>'error','request_type' => 'apply_job', 'msg' => "Doesn't apply job" ,'error_code' => "8"), 404);
            }

        }

        

        //view applied job

        function applied_job_detailed_view_post()
        {
            if(!$this->post('job_id') && !$this->post('employer_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }

            $job_id      = $this->post('job_id');
            $employer_id = $this->post('employer_id');
            $employees   = $this->db->query("select u.*,u.id as uid,a.* from applied_jobs a inner join user u on u.id=a.employee_id where a.job_id='".$job_id."' and a.employer_id='".$employer_id."' and a.status='Hold'")->result_array();

            
            foreach($employees as $ekey => $evalue){
                $employees[$ekey]['profile_image']  = (!empty($evalue['profile_image']))?site_url()."assets/images/uploads/profile/".$evalue['profile_image']:"";
                $employees[$ekey]['average_rating'] = get_average_rating_by_userId($evalue['uid'],'employee');
            }  

            if(count($employees)>0){
                 return $this->response(array('status' =>'success','request_type' => 'employee_detail', 'emp_data' => $employees), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'employee_detail', 'msg' => "Doesn't found applicant!" ,'error_code' => "8"), 404);
            }

        }

        

        //paypal user info add

        function paypal_user_info_add_post()
        {

            if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }

            

            $user_id                = $this->post('user_id');

            $usertype               = $this->post('usertype');

            $address                = $this->post('address');

            $email                  = $this->post('email');

            $phonenumber            = $this->post('phonenumber');

            $email_verified         = $this->post('email_verified');

            $user_verified          = $this->post('user_verified');

            

            $ins_data = array();

            $ins_data['user_id']           = $user_id;

            $ins_data['usertype']          = $usertype;

            $ins_data['address']           = $address;

            $ins_data['email']             = $email;

            $ins_data['phonenumber']       = $phonenumber;

            $ins_data['email_verified']    = $email_verified;

            $ins_data['user_verified']     = $user_verified;

            $res                           =  $this->jobs_model->insert($ins_data,'paypal_user_info');

            

            if($res!=''){

                return $this->response(array('status' =>'success','request_type' => 'paypal_user_info', 'paypal_user_info_id' => $res), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'paypal_user_info', 'msg' => "Doesn't create user info!" ,'error_code' => "8"), 404);

            }

        }

        

        //Delete Checking Account details

        function delete_paypal_user_post()
        {
            if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }

            $user_id   = $this->post('user_id');
            $res       = $this->jobs_model->delete(array('id' => $user_id),"paypal_user_info");
            return $this->response(array('status' =>'success','request_type' => 'delete_paypal_account', 'user_id' => $user_id), 200);
        }

        
       function logout_post()
       {
           if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $user_id   = $this->post('user_id');
            
            $ins_data                = array();
            $ins_data['devicetoken'] = '';
            
            $affected  = $this->user_model->update(array("id" => $user_id),$ins_data,"user");
            return $this->response(array('status' =>'success','request_type' => 'logout_user', 'user_id' => $user_id), 200);
       }
     
      function hire_job_get($job_id='',$job_name='',$employer_id='',$employee_id='', $user_type = '')
      {
            // if(!$this->get('job_id') && !$this->get('job_name') && !$this->get('employer_id') && !$this->get('employee_id')){
            //     return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            // }
            
            $job_id      = (!empty($this->get('job_id')))?$this->get('job_id'):$job_id;
            $job_name    = (!empty($this->get('job_name')))?$this->get('job_name'):$job_name;
            $employer_id = (!empty($this->get('employer_id')))?$this->get('employer_id'):$employer_id;
            $employee_id = (!empty($this->get('employee_id')))?$this->get('employee_id'):$employee_id;
            $user_type   = (!empty($this->get('user_type')))?$this->get('user_type'):$user_type;
            
            //check if employee already hired or not
            $ch_emp_hired = $this->db->query("select * from hire_jobs where job_id='".$job_id."' and employee_id='".$employee_id."'")->result_array();
            
            if(count($ch_emp_hired)>0)
              return $this->response(array('status' => 'error','msg' => 'This employee is already hired for this job','error_code' => "2"), 404);
              
             $ins_data = array();
             $ins_data['job_id']      = $job_id;
             $ins_data['job_name']    = $job_name;
             $ins_data['employer_id'] = $employer_id;
             $ins_data['employee_id'] = $employee_id;
             $res                     = $this->jobs_model->insert($ins_data,'hire_jobs');
            
            $this->db->query("update applied_jobs set status='Hired' where job_id='".$job_id."' and employer_id='".$employer_id."' and employee_id='".$employee_id."'");
         
            //send notification to employee
            $employee   = $this->user_model->check_unique(array("id" => $employee_id));
           
            $params     = $this->db->query("select * from notifications where user_id='".$employee_id."' and is_view='0'")->result_array();

            $message    = 'Congratulations! You have been hired for the '.ucfirst($job_name).' job';

            $channel_id = $employer_id.$employee_id;

            if(count($employee)){

               $notification_count = count($params) + 2;

               sendNotification($employee['devicetoken'],$message,$notification_count,$employee_id,'hirejob');
            }    


            update_notification_count($employee_id,$message,'hirejob',$job_id,$user_type);
            
            //job move to active job
            $this->db->query("update jobs set active_job='yes' where id='".$job_id."'");
            
            update_notification_count($employer_id,$message,'notificationCountActive',$job_id,$user_type);
            update_notification_count($employee_id,$message,'notificationCountActive',$job_id,$user_type);
                
           return $this->response(array('status' =>'success','request_type' => 'hire_jobs'), 200);     
      }   
      
        //display active jobs
        function active_job_lists_post()
        {
            $user_id = $this->post('user_id');
            $type    = $this->post('type');
            
            $job_lists   = $this->jobs_model->active_job_lists($user_id, $type);  
            $jobs_data   = array();

            foreach($job_lists as $jkey => $jvalue){
                $job_lists[$jkey]['channel']        = $jvalue['employer_id'].$jvalue['employee_id'];
                $job_lists[$jkey]['firstname']      = $jvalue['employer_id'].$jvalue['firstname'];
                $job_lists[$jkey]['profile_image']  = (!empty($jvalue['profile_image']))?site_url()."assets/images/uploads/profile/".$jvalue['profile_image']:"";
                
                if($type == 'employee'){
                  $udata =   $this->user_model->check_unique(array('id' => $jvalue['employer_id'] ));
                  $job_lists[$jkey]['username'] = $udata['firstname'];
                  $job_lists[$jkey]['profile_name'] = $udata['profile_name'];
                  $job_lists[$jkey]['merchant_id']  = $udata['merchant_id'];
                  $job_lists[$jkey]['profile_image']= (!empty($udata['profile_image']))?site_url()."assets/images/uploads/profile/".$udata['profile_image']:"";
                }
                if($type == 'employer'){
                   $udata =   $this->user_model->check_unique(array('id' => $jvalue['employee_id'] ));
                   $job_lists[$jkey]['username']     = $udata['firstname'];
                   $job_lists[$jkey]['profile_name'] = $udata['profile_name']; 
                   $job_lists[$jkey]['merchant_id']  = $udata['merchant_id'];
                   $job_lists[$jkey]['profile_image']= (!empty($udata['profile_image']))?site_url()."assets/images/uploads/profile/".$udata['profile_image']:"";;
                }  
                $job_lists[$jkey]['notificationCountMessage']     = get_notification_count($user_id,$jvalue['id'],'notificationCountMessage');
                $job_lists[$jkey]['notificationCountMakePayment'] = get_notification_count($user_id,$jvalue['id'],'notificationCountMakePayment');
               // $job_lists[$jkey]['notificationCountMsgActive']   = get_notification_count($user_id,$jvalue['id'],'notificationCountMsgActive');   
            }
                  
            if(count($job_lists)>0){
                 return $this->response(array('status' =>'success','request_type' => 'active_job_lists', 'job_lists' => $job_lists), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'active_job_lists', 'msg' => "No Jobs Found" ,'error_code' => "8"), 404);
            }
        }
        
       //refuse active jobs
        function refuse_jobs_post()
        {
             if(!$this->post('job_id') && !$this->post('employer_id') && !$this->post('employee_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $job_id      = $this->post('job_id');
            $employer_id = $this->post('employer_id');
            $employee_id = $this->post('employee_id');
            $user_type   = $this->post('user_type');
            
            $this->db->query("update applied_jobs set status='Refused' where job_id='".$job_id."' and employer_id='".$employer_id."' and employee_id='".$employee_id."'");
            
           // $this->db->query("delete from applied_jobs where job_id='".$job_id."' and employer_id='".$employer_id."' and  employee_id='".$employee_id."'");
            //send notification to employee
            $employee = $this->user_model->check_unique(array("id" => $employee_id));
            $employer = $this->user_model->check_unique(array("id" => $employer_id));
            $job      = $this->jobs_model->check_unique(array("id" => $job_id));

            $params   = $this->db->query("select * from notifications where user_id='".$employee_id."' and is_view='0'")->result_array();
            $message  = "You Have Received A Message From ".ucfirst($employer['firstname'])." About The ".ucfirst($job['job_name']).".";
            $channel_id = $employer_id.$employee_id;

            if(count($employee)) {

                $notification_count = count($params) + 2;

                sendNotification($employee['devicetoken'],$message,$notification_count,$employee_id,'refusejob');
            }    
             update_notification_count($employee_id,$message,'refusejob',$job_id,$user_type);
             update_notification_count($employee_id,"",'notificationCountPending',$job_id,$user_type);
             
            return $this->response(array('status' =>'success','request_type' => 'refuse_jobs'), 200);      
        }
        
           //payment_service
        function payment_service_post()
        {
            if(!$this->post('job_id') && !$this->post('employer_id') && !$this->post('employee_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $job_id           = $this->post('job_id');
            $employer_id      = $this->post('employer_id');
            $employee_id      = $this->post('employee_id');
            $tip              = $this->post('tip');
            $pay_method       = $this->post('payment_method');
            $job_name         = $this->post('job_name');
            $payment_amount   = $this->post('payment_amount');
            $total_payment    = $this->post('total_payment');
            $transaction_date = $this->post('transaction_date');
            $user_type        = $this->post('user_type');
            $status           = $this->post('status');
            $order_id         = $this->post('order_id');
            $payment_id       = $this->post('payment_id');
            $payee_email      = $this->post('payee_email');
            $payer_email      = $this->post('payer_email');
            $payer_id         = $this->post('payer_id');
            $reference_id     = $this->post('reference_id');
            $order_status     = $this->post('order_status');
            $paypal_fee       = $this->post('paypal_fee');
           
            
            $this->db->query("delete from hire_jobs where job_id='".$job_id."' and employer_id='".$employer_id."' and  employee_id='".$employee_id."'");
            
            $ins_data = array();
            $ins_data['job_id']          = $job_id;
            $ins_data['job_name']        = $job_name;
            $ins_data['employer_id']     = $employer_id;
            $ins_data['employee_id']     = $employee_id;
            $ins_data['tip']             = $tip;
            $ins_data['payment_method']  = $pay_method;
            $ins_data['payment_amount']  = $payment_amount;
            $ins_data['total_payment']   = $total_payment;
            $ins_data['transaction_date']= date("Y-m-d H:i:s",strtotime($transaction_date));
            $ins_data['job_status ']     = $status;   
            $ins_data['order_id ']       = $order_id;
            $ins_data['payment_id ']     = $payment_id;
            $ins_data['payee_email ']    = $payee_email;
            $ins_data['payer_email ']    = $payer_email;
            $ins_data['payer_id ']       = $payer_id;
            $ins_data['reference_id ']   = $reference_id;
            $ins_data['order_status ']   = $order_status;
            $ins_data['paypal_fee ']     = $paypal_fee;
            $res                         = $this->jobs_model->insert($ins_data,'jobs_history');
            
            //send notification to employee
            $employee = $this->user_model->check_unique(array("id" => $employee_id));
            $employer = $this->user_model->check_unique(array("id" => $employer_id));
            $employee_params   = $this->db->query("select * from notifications where user_id='".$employee_id."' and is_view='0'")->result_array();
            $employer_params   = $this->db->query("select * from notifications where user_id='".$employer_id."' and is_view='0'")->result_array();

           // $message  = "Payment is made for ".rtrim(ucfirst($job_name),"").", provide star ratings";
            $channel_id = $employer_id.$employee_id;

            if(count($employee)){
             //   sendNotification($employee['devicetoken'],$message,count($params),$employee_id,'paymentcompleted');
             //   sendNotification($employer['devicetoken'],$message,count($params),$employer_id,'paymentcompleted');

                $employee_msg = ucfirst($job_name).' Job Has Been Completed. Fill Out A Star Rating Of Your Employer Under Job History. ';
                $employer_msg = ucfirst($job_name).' Job Has Been Completed. Fill Out A Star Rating Of Your Employee Under Job History. ';

                $employee_notification_count = count($employee_params) + 3;
                sendNotification($employee['devicetoken'],$employee_msg,$employee_notification_count,$employee_id,'notificationCountJobHistory');

                $employer_notification_count = count($employer_params) + 3;
                sendNotification($employer['devicetoken'],$employer_msg,$employer_notification_count,$employer_id,'notificationCountJobHistory');

            }   

           update_notification_count($employee_id,$employee_msg,'paymentcompleted',$job_id,$user_type);
           update_notification_count($employer_id,$employer_msg,'paymentcompleted',$job_id,$user_type); 
           update_notification_count($employer_id,$employer_msg,'notificationCountStarRating',$job_id,$user_type);
           update_notification_count($employee_id,$employee_msg,'notificationCountStarRating',$job_id,$user_type);
           update_notification_count($employer_id,$employer_msg,'notificationCountJobHistory',$job_id,$user_type);
           update_notification_count($employee_id,$employee_msg,'notificationCountJobHistory',$job_id,$user_type);
           //update_notification_count($employer_id,$employer_msg,'notificationCountMsgActive',$job_id,$user_type);
               

            $this->db->query("delete from notifications where notify_id='".$job_id."' and user_id='".$employer_id."' and type='notificationCountActive'");
            $this->db->query("delete from notifications where notify_id='".$job_id."' and user_id='".$employee_id."' and type='notificationCountActive'");

               
           return $this->response(array('status' =>'success', 'request_type' => 'payment_service' ), 200);      
        }
        
         //job history listing service
        function job_history_listing_post()
        {
            if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $user_id = $this->post('user_id');
            $type    = $this->post('type');
            
            $job_lists   = $this->jobs_model->job_history_lists($user_id, $type);  
            $jobs_data   = array();

            foreach($job_lists as $jkey => $jvalue){
                
                $job_lists[$jkey]['transaction_date'] = date("F j, Y", strtotime($jvalue['transaction_date']));
                $job_lists[$jkey]['job_status']       = $jvalue['job_status'];
                $job_lists[$jkey]['channel']          = $jvalue['employer_id'].$jvalue['employee_id']; 
                $job_lists[$jkey]['profile_image']    = (!empty($jvalue['profile_image']))?site_url()."assets/images/uploads/profile/".$jvalue['profile_image']:"";
                
                if($type == 'employee'){
                  $udata =   $this->user_model->check_unique(array('id' => $jvalue['employer_id'] ));
                  $ratio =  get_average_rating_by_userId($jvalue['employer_id'],"employer");
                  $job_lists[$jkey]['username']     = $udata['firstname'];
                  $job_lists[$jkey]['profile_name'] = $udata['profile_name'];
                  $job_lists[$jkey]['profile_image'] = (!empty($udata['profile_image']))?site_url()."assets/images/uploads/profile/".$udata['profile_image']:"";
                  $job_lists[$jkey]['average_rating'] = $ratio;
                  $job_lists[$jkey]['rating'] = $this->rating_model->check_unique(array('job_id' => $jvalue['job_id'], "employer_id" => $jvalue['employer_id'], "employee_id" => $jvalue['employee_id'],"type"=> "employer"));
                  $job_lists[$jkey]['employee_notificationCountMsgJobhistory'] = get_notification_count($user_id,$jvalue['id'],'notificationCountMsgJobhistory');
                  $job_lists[$jkey]['employee_notificationCountStarRating']    = get_notification_count($user_id,$jvalue['id'],'notificationCountStarRating');
                }
                if($type == 'employer'){
                   $udata =   $this->user_model->check_unique(array('id' => $jvalue['employee_id'] ));
                    $ratio    =  get_average_rating_by_userId($jvalue['employee_id'],"employee");
                   $job_lists[$jkey]['average_rating'] = $ratio;
                   $job_lists[$jkey]['rating'] = $this->rating_model->check_unique(array('job_id' => $jvalue['job_id'], "employer_id" => $jvalue['employer_id'], "employee_id" => $jvalue['employee_id'],"type" => "employee" ));
                   $job_lists[$jkey]['username']      = $udata['firstname'];
                   $job_lists[$jkey]['profile_name']  =  $udata['profile_name'];
                   $job_lists[$jkey]['profile_image'] = (!empty($udata['profile_image']))?site_url()."assets/images/uploads/profile/".$udata['profile_image']:"";
                   $job_lists[$jkey]['employer_notificationCountMsgJobhistory'] = get_notification_count($user_id,$jvalue['id'],'notificationCountMsgJobhistory');
                   $job_lists[$jkey]['employer_notificationCountStarRating']    = get_notification_count($user_id,$jvalue['id'],'notificationCountStarRating');
                }
                  
            }

            if(count($job_lists)>0){
                 return $this->response(array('status' =>'success','request_type' => 'job_history_lists', 'job_lists' => $job_lists), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'job_history_lists', 'msg' => "No Jobs Found" ,'error_code' => "8"), 404);
            }
              
        }
        
       //rating section
        function add_rating_post()
        {
            if(!$this->post('job_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $job_id      = $this->post('job_id');
            $user_id     = $this->post('user_id');
            $login_user_id= $this->post('login_user_id');
            $employee_id = $this->post('employee_id');
            $employer_id = $this->post('employer_id');
            $rating      = $this->post('rating');
            $comments    = $this->post('comments');
            $type        = $this->post('type');
            $category1   = $this->post('category1');
            $category2   = $this->post('category2');
            $category3   = $this->post('category3');
            $category4   = $this->post('category4');
            $category5   = $this->post('category5');
            $rating_id   = $this->post('rating_id');
            //$date        = $this->post('date');
            
            $ins_data = array();
            $ins_data['job_id']        = $job_id;
            $ins_data['user_id']       = $user_id;
            $ins_data['login_user_id'] = $login_user_id;
            $ins_data['rating']        = $rating;
            $ins_data['comments']      = $comments;
            $ins_data['type']          = $type;
            $ins_data['category1']     = $category1;
            $ins_data['category2']     = $category2;
            $ins_data['category3']     = $category3;
            $ins_data['category4']     = $category4;
            $ins_data['category5']     = $category5; 
            $ins_data['employee_id']   = $employee_id;    
            $ins_data['employer_id']   = $employer_id;    

            //check if job having rating or not
            $job_rating  = $this->rating_model->check_unique(array(
                "user_id" => $user_id, "job_id" => $job_id));

            if((count($job_rating)==0) && empty($rating_id)){
                $rating_id         =  $this->jobs_model->insert($ins_data,'rating');
            }
            else
            {
                $update_rating     =  $this->jobs_model->update(array("id" => $rating_id),$ins_data,'rating');
            }

           
            
            if(!empty($rating_id)){

             
            $userdata       = $this->user_model->check_unique(array("id" => $user_id));
            $login_userdata = $this->user_model->check_unique(array("id" => $login_user_id));
           // $employer = $this->user_model->check_unique(array("id" => $employer_id));

            $job      = $this->jobs_model->check_unique(array("id" => $job_id));

            // if($type == 'employer'){
            //     $employee_msg = ucfirst($login_userdata['firstname'])." Has Left You A Star Rating For The ".ucfirst($job['job_name'])." Job.";
            //     $params   = $this->db->query("select * from notifications where user_id='".$login_user_id."'")->result_array();
            //     sendNotification($login_userdata['devicetoken'],$employee_msg,count($params),$login_user_id,'starNotification');
            //     update_notification_count($login_user_id,$employee_msg,'notificationCountJobHistory',$job_id,$type);
            // }
            // else
            // {
                $employer_msg = ucfirst($login_userdata['firstname'])." Has Left You A Star Rating For The ".ucfirst($job['job_name'])." Job.";

                $params   = $this->db->query("select * from notifications where user_id='".$user_id."' and is_view='0'")->result_array();

                $notification_count = count($params) + 1;

                sendNotification($userdata['devicetoken'],$employer_msg,$notification_count,$user_id,'starNotification');

                update_notification_count($user_id,$employer_msg,'notificationCountJobHistory',$job_id,$type); 
           // }
           
                
              return $this->response(array('status' =>'success','request_type' => 'add_rating_service','rating_id' =>  $rating_id), 200);
            }
            else
            {
               return $this->response(array('status' =>'error','request_type' => 'add_rating_service', 'msg' => "Network Error!" ,'error_code' => "8"), 404); 
            }      
        }
        
       function review_rating_post()
        {

            if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $user_id = $this->post('user_id');
            $type    = $this->post('type');
            
            $job_lists= $this->rating_model->rating_lists($user_id, $type);  
            $jobs_data= array();
            
            $ratio    =  get_average_rating_by_userId($user_id,$type);

            $linked_in_data = $this->user_model->get_where(array("user_id" => $user_id),"*","linked_in_info")->row_array();

            foreach($job_lists as $jkey => $jvalue){
                $job_lists[$jkey]['profile_image']   = (!empty($jvalue['profile_image']))?site_url()."assets/images/uploads/profile/".$jvalue['profile_image']:"";
                $job_lists[$jkey]['employee_rating'] = 0;
                $job_lists[$jkey]['employer_rating'] = 0;
                $job_lists[$jkey]['date']            = $jvalue['created_date'];
                $job_lists[$jkey]['comments']        = $jvalue['comments'];
                $job_lists[$jkey]['average_rating']  = $ratio;

                if($type == 'employer'){
                    $employeeData = get_average_rating($user_id,"employer",$jvalue['login_user_id'],$jvalue['job_id']);
                    $job_lists[$jkey]['employee'] = $employeeData;
                  //  $empdata  =   $this->user_model->check_unique(array('id' => $jvalue['login_user_id'] ));
                  //  $job_lists[$jkey]['employee']['username']     = $empdata['username'];
                  //  $job_lists[$jkey]['employee']['profile_name'] = $empdata['profile_name'];
                  //  $job_lists[$jkey]['employee']['profile_image']= (!empty($empdata['profile_image']))?site_url()."assets/images/uploads/profile/".$empdata['profile_image']:"";
                  //  $job_lists[$jkey]['employee']['average_rating'] = get_average_rating($jvalue['login_user_id'],"employee");
                 // $job_lists[$jkey]['employee']['average_rating'] = get_average_rating($user_id,"employee", $jvalue['login_user_id']);

                }
                else
                {
                    $employerData = get_average_rating($user_id,"employee",$jvalue['login_user_id'],$jvalue['job_id']);
                    $job_lists[$jkey]['employer']      = $employerData;
                    $job_lists[$jkey]['linkedin_data'] = $linked_in_data;
                    //$emludata  =   $this->user_model->check_unique(array('id' => $jvalue['login_user_id'] ));
                   // $job_lists[$jkey]['employer']['username']     = $emludata['username'];
                   // $job_lists[$jkey]['employer']['profile_name'] = $emludata['profile_name'];
                   // $job_lists[$jkey]['employer']['profile_image']= (!empty($emludata['profile_image']))?site_url()."assets/images/uploads/profile/".$emludata['profile_image']:"";
                    //$job_lists[$jkey]['employer']['average_rating'] = get_average_rating($user_id,"employee",$jvalue['login_user_id']);
                }
            }


            if(count($job_lists)>0){
                 return $this->response(array('status' =>'success','request_type' => 'review_rating_lists', 'rating_lists' => $job_lists), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'review_rating_lists', 'msg' => "This User Currently Does Not Have Any Ratings",'linked_in_data' => $linked_in_data ,'error_code' => "8"), 404);
            }  

        }
        
        function help_post()
        {
            if(!$this->post('email') && !$this->post('user_id') && !$this->post('query')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $email       = $this->post('email');
            $user_id     = $this->post('user_id');
            $query       = $this->post('query');
            
             //userdata
             $userdata = $this->user_model->check_unique(array("id" => $user_id));
             $message  = "<html>";
             $message .= "<body>";
             $message .= "<p>Hi ".$userdata['firstname'].",</p><br/>";
             $message .= $query;
             $message .= "<p>Thanks,<p>";
             $message .= "<p>HandzforHire</p>"; 
             $message .= "</body></html>";
    
             $this->email->from('support@handzforhire.com','Support');
             $this->email->to($email);
             $this->email->subject('Help');
             $this->email->message($message);
             $this->email->send();
             
             return $this->response(array('status' =>'success','request_type' => 'add_rating_service'), 200);
                 
        }
        
        function notification_count_post()
        {
            if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $user_id     = $this->post('user_id');
            $notification_count = $this->db->query("select count(*) as cnt from notifications where user_id='".$user_id."'")->row_array();
            
            if(count($notification_count)){
                return $this->response(array('status' =>'success','request_type' => 'notification_count',"notification_count" => $notification_count['cnt']), 200);
            }
            else
            {
                return $this->response(array('status' => 'error', "msg" => "No notification count" ), 404);
            }
        }
        
        function send_message_post()
        {
            if(!$this->post('sender_id') && !$this->post('message') && !$this->post('receiver_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $user_id    = $this->post('receiver_id');
            $sender_id  = $this->post('sender_id');
            $job_id     = $this->post('job_id');
            $message    = $this->post('message');
            $user_type  = $this->post('user_type');
            $message_type= $this->post('message_type');

            $userdata   = $this->user_model->check_unique(array("id" => $user_id));
            $senderdata = $this->user_model->check_unique(array("id" => $sender_id));

            
            $params     = $this->db->query("select * from notifications where user_id='".$user_id."' and is_view='0'")->result_array();
            //$message    = ucfirst($senderdaa['firstname']).$message;
                   
            $message    = 'You have received a message from '.ucfirst($senderdata['firstname']);     

            $channel_id = ($user_type == 'employer')?$sender_id.$user_id:$user_id.$sender_id;

            if(count($userdata)) {
               $ct = ($message_type == 'job_history')?2:1;
               $notification_count = count($params) + $ct;

               sendNotification($userdata['devicetoken'],$message,$notification_count,$user_id,'notificationCountMessage');

            }  
              
            update_notification_count($user_id,$message,'notificationCountMessage',$job_id,$user_type);

            if($message_type == 'job_history') {
                update_notification_count($user_id,$message,'notificationCountMsgJobHistory',$job_id,$user_type);
                update_notification_count($user_id,$message,'notificationCountJobHistory',$job_id,$user_type);
            }            

            if($message_type == 'active_job') {
               // update_notification_count($user_id,$message,'notificationCountMsgActive',$job_id,$user_type);
                update_notification_count($user_id,$message,'notificationCountActive',$job_id,$user_type);
            }

            return $this->response(array('status' =>'success','request_type' => 'send_message'), 200);   
        }
        
        function employee_accept_post()
        {
            if(!$this->post('job_id') && !$this->post('employer_id') && !$this->post('employee_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $job_id      = $this->post('job_id');
            $employer_id = $this->post('employer_id');
            $employee_id = $this->post('employee_id');
            $user_type   = $this->post('user_type');
            
            //job move to active job
            $this->db->query("update applied_jobs set active_job='yes' where job_id='".$job_id."' and employee_id='".$employee_id."'");
            
            $userdata   = $this->user_model->check_unique(array("id" => $employer_id));
            $employee   = $this->user_model->check_unique(array("id" => $employee_id));

            $params     = $this->db->query("select * from notifications where user_id='".$employer_id."' and is_view='0'")->result_array();
            $message    = "Great News! ".ucfirst($employee['firstname'])." Received Your Job Acceptance And Now The Two Of You Can Chat In Message Under Active Jobs.";
            

            if(count($userdata)){
                $notification_count = count($params) + 1;
                sendNotification($userdata['devicetoken'],$message,$notification_count,$employer_id,'notificationCountActive');
            }   
            
            update_notification_count($employer_id,'','notificationCountActive',$job_id,$user_type);
            update_notification_count($employee_id,'','notificationCountActive',$job_id,$user_type);

            return $this->response(array('status' =>'success','request_type' => 'employee_accept'), 200); 
        }
        
        function employee_reject_post()
        {
            if(!$this->post('job_id') && !$this->post('employer_id') && !$this->post('employee_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $job_id      = $this->post('job_id');
            $employer_id = $this->post('employer_id');
            $employee_id = $this->post('employee_id');
            
            $this->db->query("delete from applied_jobs where job_id='".$job_id."' and employer_id='".$employer_id."' and  employee_id='".$employee_id."'");
            return $this->response(array('status' =>'success','request_type' => 'employee_reject'), 200);
        }
        
        function request_payment_notification_post()
        {
            if(!$this->post('employer_id') && !$this->post('job_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $employer_id = $this->post('employer_id');
            $employee_id = $this->post('employee_id');
            $job_id      = $this->post('job_id');

            $user_type   = $this->post('user_type');
            
            $userdata    = $this->user_model->check_unique(array("id" => $employer_id));
            $job         = $this->jobs_model->check_unique(array("id" => $job_id));
            $params      = $this->db->query("select * from notifications where user_id='".$employer_id."' and is_view='0'")->result_array();
            $message     = 'Just a reminder that payment has not been completed on this job '.$job['job_name'];
            $channel_id = $employer_id.$employee_id;

            if(count($userdata)){
                $notification_count = count($params) + 1;
                sendNotification($userdata['devicetoken'],$message,$notification_count,$employer_id,'notificationCountMakePayment');
            }   
            
            update_notification_count($employer_id,'','notificationCountMakePayment',$job_id,$user_type);

           // update_notification_count($employer_id,'','notificationCountMsgActive',$job_id,$user_type);

            $channel_id = $employer_id.$employee_id;

            return $this->response(array('status' =>'success','request_type' => 'request_payment', 'channel_id' =>  $channel_id,
                            'job_id' => $job_id,
                ), 200); 
        }
        
        function view_count_post()
        {
             if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
             }
            
            $user_id = $this->post('user_id');
            $job_id  = $this->post('job_id');
            $type    = $this->post('type');
            $usertype= $this->post('userType');
            //$notification_type = $this->post('notification_type');

         //   if($notification_type == 'update'){
              $this->db->query("update notifications set is_view='1' where user_id='".$user_id."'");
           // }

            if($usertype == 'employer' || $usertype == 'employee'){
                $this->db->query("delete from notifications where user_type='".$usertype."'");
            }
            
            if($type == 'notificationCountPending' || $type == 'notificationCountPosted' || $type == 'notificationCountJobHistory' || $type == 'notificationCountActive'){
                $this->db->query("delete from notifications where type='".$type."'");
            }
            else
            {
              $this->db->query("delete from notifications where user_id='".$user_id."' and notify_id='".$job_id."' and type='".$type."'");
            }
            
            //$notification_ct = get_notification_count($user_id,$job_id,$type);
            //  if($type == 'notificationCountMsgActive' || $type == 'notificationCountMsgJobHistory'){
                $notification_ct = get_notification_count($user_id,$job_id,$type);
            //}
            return $this->response(array('status' =>'success','request_type' => 'view_count', 'count' => $notification_ct), 200);
        }
           

        function job_canceled_post()
        {
            if(!$this->post('job_id') && !$this->post('employer_id') && !$this->post('employee_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $job_id      = $this->post('job_id');
            $employer_id = $this->post('employer_id');
            $employee_id = $this->post('employee_id');
	$transaction_date = $this->post('transaction_date');
            $user_type   = $this->post('user_type');
            $status      = $this->post('status');

            $this->db->query("delete from hire_jobs where job_id='".$job_id."' and employer_id='".$employer_id."' and  employee_id='".$employee_id."'");
            
            
            $ins_data = array();
            $ins_data['job_id']          = $job_id;
            $ins_data['job_name']        = '';
            $ins_data['employer_id']     = $employer_id;
            $ins_data['employee_id']     = $employee_id;
            $ins_data['tip']             = '';
            $ins_data['payment_method']  = '';
            $ins_data['payment_amount']  = '';
            $ins_data['total_payment']   = '';
            $ins_data['transaction_date']= date("Y-m-d H:i:s",strtotime($transaction_date));
            $ins_data['job_status']      = $status;
            $res                         =  $this->jobs_model->insert($ins_data,'jobs_history');
            
            $employerdata= $this->user_model->check_unique(array("id" => $employer_id));
            $employeedata= $this->user_model->check_unique(array("id" => $employee_id));
            $job         = $this->jobs_model->check_unique(array("id" => $job_id));
            
            $employer_params = $this->db->query("select * from notifications where user_id='".$employer_id."' and is_view='0'")->result_array();

            $employee_params = $this->db->query("select * from notifications where user_id='".$employee_id."' and is_view='0'")->result_array();

            $message     = 'Comment Notification for '.$job['job_name'];
            
            $channel_id  = $employer_id.$employee_id;

             if(count($employerdata) && count($employeedata)){


                $employer_notification_count = count($employer_params) + 3;
                $employee_notification_count = count($employee_params) + 3;

               sendNotification($employerdata['devicetoken'],$message,$employer_notification_count,$employer_id,'jobcanceled');
               sendNotification($employeedata['devicetoken'],$message,$employee_notification_count,$employee_id,'jobcanceled');

                $employee_msg = ucfirst($job['job_name']).'  Job Was Canceled. Please Provide Feedback (If Applicable) ';
                $employer_msg = ucfirst($job['job_name']).'  Job Was Canceled. Please Provide Feedback (If Applicable) ';

                sendNotification($employee['devicetoken'],$employee_msg,$employee_notification_count,$employee_id,'notificationCountJobHistory');
                sendNotification($employer['devicetoken'],$employer_msg,$employer_notification_count,$employer_id,'notificationCountJobHistory');

               update_notification_count($employer_id,$message,'jobcanceled',$job_id,$user_type);
               update_notification_count($employee_id,$message,'jobcanceled',$job_id,$user_type);
               update_notification_count($employee_id,$message,'notificationCountStarRating',$job_id,$user_type); 
               update_notification_count($employer_id,$message,'notificationCountStarRating',$job_id,$user_type);

               update_notification_count($employer_id,$employer_msg,'notificationCountJobHistory',$job_id,$user_type);
               update_notification_count($employee_id,$employee_msg,'notificationCountJobHistory',$job_id,$user_type);

               $this->db->query("delete from notifications where notify_id='".$job_id."' and user_id='".$employer_id."' and type='notificationCountActive'");
               $this->db->query("delete from notifications where notify_id='".$job_id."' and user_id='".$employee_id."' and type='notificationCountActive'");
            }
            
            return $this->response(array('status' =>'success','request_type' => 'job_canceled'), 200);
        }
        
        function get_average_rating_post($user_id='', $type='')
        {
            if(!$this->post('user_id') && !$this->post('type')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $type    = (empty($type))?$this->post('type'):$type;
            $user_id = (empty($user_id))?$this->post('user_id'):$user_id;
            
           /* $rating = $this->db->query("select * from rating where login_user_id='".$user_id."' and type = '".$type."'")->result_array(); 
            
            $rt = '';            
            foreach($rating as $rkey => $rvalue){
                $rt += $rvalue['rating'];
            } */    

            $ratio = get_average_rating_by_userId($user_id,$type);
            return $this->response(array('status' =>'success','request_type' => 'get_average_rating','average_rating' => $ratio), 200);    
        }

        function braintree_pay_post()
        {
            if(!$this->post('payment_method_nonce') && !$this->post('amount')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }
            
            $this->load->library("braintree_lib");
            
            $paymentMethodNonce = $this->post('payment_method_nonce');
            $amount             = $this->post('amount');
            
            $result = $this->braintree_lib->transaction(array('amount' => $amount,
                                                              'paymentMethodNonce' => $paymentMethodNonce,
                                                              'options' => array(
                                                                'submitForSettlement' => True
                                                              ))); 
            return $this->response(array('status' =>'success','request_type' => 'braintree_pay','pay' => $result), 200);                                                              
        } 

      


       function update_user_address_post()
        {

            if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }

            

            $address1       = $this->post('address1');

            $address2       = $this->post('address2');

            $city           = $this->post('city');

            $state          = $this->post('state');

            $zipcode        = $this->post('zipcode');

            $user_id        = $this->post('user_id');

            $res            = $this->address_model->check_unique(array('user_id' => $user_id ));

            

            if(count($res)>0){

                 $up_data = array();

                $up_data['user_id']  = $user_id;

                $up_data['address1'] = $address1;

                $up_data['address2'] = $address2;

                $up_data['city']     = $city;

                $up_data['state']    = $state;

                $up_data['zipcode']  = $zipcode;

                 $update   = $this->address_model->update(array("user_id" => $user_id),$up_data);

                 return $this->response(array('status' =>'success','request_type' => 'useraddress_update'), 200);

            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'useraddress_update', 'msg' => "Doesn't update Address!" ,'error_code' => "8"), 404);

            }

        }





        function get_user_address_post()
        {

            if(!$this->post('user_id')){

                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);

            }

            $user_id = $this->post('user_id');

            $select_address = $this->db->query("select * from address where user_id ='".$user_id."'")->row_array();

            $address1 = $select_address["address1"];
            $address2 = $select_address["address2"];
            $city     = $select_address["city"];
            $state    = $select_address["state"];
            $zipcode  = $select_address["zipcode"];


            if(count($select_address)>0){

                 return $this->response(array('status' =>'success','request_type' => 'address_lists', 'address1' => $address1, 'address2' => $address2, 'city' => $city, 'state' => $state, 'zipcode' => $zipcode), 200);
            }

            else

            {

                return $this->response(array('status' =>'error','request_type' => 'user_address', 'msg' => "Doesn't found User id!" ,'error_code' => "8"), 404);

            }

        }

        function remove_job_get()
        {
            if(!$this->get('job_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
             }
            
            $job_id  = $this->get('job_id');
            $delist  = $this->get('delist');

            $this->jobs_model->update(array("id" => $job_id),array("delist" => $delist),"jobs");
            
            //$this->db->query("delete from jobs where id='".$job_id."'");
            //$this->db->query("delete from applied_jobs where job_id='".$job_id."'");
            //$this->db->query("delete from hire_jobs where job_id='".$job_id."'");

            return $this->response(array('status' =>'success','request_type' => 'remove_job'), 200);
        }


        function user_merchant_id_update_get()
        {
            if(!$this->get('merchant_id') && !$this->get('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
             }
            
            $merchant_id   = $this->get('merchant_id');
            $user_id       = $this->get('user_id');
            
            $this->jobs_model->update(array("id" => $user_id),array("merchant_id" => $merchant_id),"user");
            
            //$this->db->query("delete from jobs where id='".$job_id."'");
            //$this->db->query("delete from applied_jobs where job_id='".$job_id."'");
            //$this->db->query("delete from hire_jobs where job_id='".$job_id."'");

            return $this->response(array('status' =>'success','request_type' => 'update_merchant_id'), 200);
        }

        function linked_in_post()
         {

            if(!$this->post('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }

            

            $first_name     = $this->post('first_name');
            $last_name      = $this->post('last_name');
            $email          = $this->post('email');
            $profile_url    = $this->post('profile_url');
            $picture_url    = $this->post('picture_url');
            $user_id        = $this->post('user_id');
            $res            = $this->user_model->get_where(array('user_id' => $user_id ),"*","linked_in_info")->result_array();

            $ins_data = array();
            $ins_data['user_id']      = $user_id;
            $ins_data['first_name']   = $first_name;
            $ins_data['last_name']    = $last_name;
            $ins_data['email']        = $email;
            $ins_data['profile_url']  = $profile_url;
            $ins_data['picture_url']  = $picture_url;

            if(count($res)>0){
                 $update   = $this->user_model->update(array("user_id" => $user_id),$ins_data,"linked_in_info");
            }
            else
            {
                $insert_id = $this->user_model->insert($ins_data,"linked_in_info");
            }

            return $this->response(array('status' =>'success','request_type' => 'linked_in_info'), 200);
        }
         
          function archieve_jobs_get()
        {
            if(!$this->get('user_id')){
                return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
            }

            $user_id = $this->get("user_id");

            $jobs = $this->jobs_model->get_where(array("employer_id" => $user_id,"is_achieved" => "yes"),"*","jobs")->result_array();

            if(count($jobs) > 0){
                return $this->response(array('status' =>'success','request_type' => 'archieve_jobs', 'jobs' => $jobs), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'archieve_jobs', 'msg' => "No Jobs Found" ,'error_code' => "8"), 404);
            }
       }
	

}


?>

