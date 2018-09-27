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
            
            $this->load->model(array("user_model","login_model","address_model","credit_card_model","checking_account_model","paypal_model"));
            
        }
        
         //register
         function user_register_post() {
            
            if(!$this->post('email')){
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => "1"), 404);
    		}
             
            $username       = $this->post('username');
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
            
             if(!empty($username)) {
                  //username check if already exists or not
                  $user_res = $this->user_model->check_unique(array("username" => $username));
                  if(count($user_res)>0) {
                    return $this->response(array('status' => "error",'msg' => 'Username already in use.','error_code' => "2"), 404);
                  }
             } 
             
             //if(!empty($email)) {
//                  //Email check if already exists or not
//                  $email_res = $this->user_model->check_unique(array("email" => $email));
//                  if(count($email_res)>0) {
//                    return $this->response(array('status' => "error",'msg' => 'Email already exists.','error_code' => 2), 404);
//                  }
//             }
             
            
            $ins_data = array();
            $ins_data['username']       = $username;
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
                
            $user_id = $this->user_model->insert($ins_data,"user");   
            if(!empty($user_id)){
                $res = $email_res = $this->user_model->check_unique(array('id' => $user_id));
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
                    return $this->response(array('status' => "error",'msg' => 'Email already exists.','error_code' => "2"), 404);
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
                    return $this->response(array('status' => "error",'msg' => 'Email already exist.','error_code' => "2"), 404);
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
                return $this->response(array('status' =>'success','request_type' => 'user_login','user_data' => $result), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'user_login', 'msg' => 'Invalid credentials', 'error_code' => "4"), 404);
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
                  $user_res = $this->user_model->check_unique(array("username" => $username, 'id!=' => $user_id));
                  if(count($user_res)>0) {
                    return $this->response(array('status' => "error",'msg' => 'Username already exist.','error_code' => "2"), 404);
                  }
             }
            
            if(count($res)>0){
                $up = array();
                $up['username'] = $username;
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
                return $this->response(array('status' =>'error','request_type' => 'user_address_create', 'msg' => "Address doesn't create!" ,'error_code' => "5"), 404);
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
                return $this->response(array('status' =>'success','request_type' => 'get_username','username' => $res['username']), 200);
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
            
             if(!empty($card_number)) {
                  //Card number check if already exists or not
                  $card_res = $this->credit_card_model->check_unique(array("card_number" => $card_number));
                  if(count($card_res)>0) {
                    return $this->response(array('status' => "error",'msg' => 'Card number already exists.','error_code' => "2"), 404);
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
            $card_id                 = $this->credit_card_model->insert($ins_data);
            if(!empty($card_id)){
                return $this->response(array('status' =>'success','request_type' => 'add_credit_card','card_id' => $card_id), 200);
            }    
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'add_credit_card', 'msg' => "Card details doesn't create!" ,'error_code' => "5"), 404);
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
           
            $card_res = $this->credit_card_model->check_unique(array('id' => $card_id));
          
            if(count($card_res)==0){
                return $this->response(array('status' =>'error','request_type' => 'update_credit_card_details', 'msg' => "Credit Cart doesn't exists", 'error_code' => "3"), 404);
            } 
            
             if(!empty($card_number)) {
                  //Card number check if already exists or not
                  $card_res = $this->credit_card_model->check_unique(array("card_number" => $card_number, 'id!=' => $card_id));
                  if(count($card_res)>0) {
                    return $this->response(array('status' => "error",'msg' => 'Card number already exist.','error_code' => "2"), 404);
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
            
            if((count($card_res)>0) || (count($check_res)>0)){
                 return $this->response(array('status' =>'success','request_type' => 'employer_card_lists', 'card_data' => $card_res, 'checking_account_data' => $check_res), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'employer_card_lists', 'msg' => "No Cards Found!" ,'error_code' => "7"), 404);
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
                return $this->response(array('status' =>'error','request_type' => 'update_profile_section', 'msg' => "Profile image doesn't update" ,'error_code' => "7"), 404);
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
            
             if(!empty($account_number)) {
                  //Account number check if already exists or not
                  $account_res = $this->checking_account_model->check_unique(array("account_number" => $account_number));
                  if(count($account_res)>0) {
                    return $this->response(array('status' => "error",'msg' => 'Account number already exists.','error_code' => "2"), 404);
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
            
            $checking_account_id        = $this->checking_account_model->insert($ins_data);
            if(!empty($checking_account_id)){
                return $this->response(array('status' =>'success','request_type' => 'add_checking_account','checking_account_id' => $checking_account_id), 200);
            }    
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'add_checking_account', 'msg' => "Checking Account details doesn't create!" ,'error_code' => "5"), 404);
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
                
                
           
             if(!empty($account_number)) {
                  //Account number check if already exists or not
                  $acc_res = $this->checking_account_model->check_unique(array("account_number" => $account_number, 'id!=' => $check_accot_id));
                  if(count($acc_res)>0) {
                    return $this->response(array('status' => "error",'msg' => 'Account number already exist.','error_code' => "2"), 404);
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
                return $this->response(array('status' =>'error','request_type' => 'update_credit_card_details', 'msg' => "Account doesn't updated", 'error_code' => "3"), 404);
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
            $res           = $this->user_model->check_unique(array('id' => $user_id));
            
            if(count($res)>0){
                 $profile_image = (!empty($res['profile_image']))?site_url()."assets/images/uploads/profile/".$res['profile_image']:"";
                 return $this->response(array('status' =>'success','request_type' => 'get_profile_image_and_name', "profile_name" => $res['profile_name'], "profile_image" => $profile_image ), 200);
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
            
            $ins_data             = array();
            $ins_data['employer_id']= $user_id;
            $ins_data['email_id']   = $this->post('email');
            $ins_data['password']   = $this->post('password');
            $res                    = $this->paypal_model->insert($ins_data,'paypal');
            
            if(count($res)>0){
                 return $this->response(array('status' =>'success','request_type' => 'save_paypal_info' ), 200);
            }
            else
            {
                return $this->response(array('status' =>'error','request_type' => 'save_paypal_info', 'msg' => "Doesn't save paypal info!" ,'error_code' => "8"), 404);
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
            $paypal         = $this->paypal_model->check_unique(array('employer_id' => $user_id));
            
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
            
        }
}
?>
