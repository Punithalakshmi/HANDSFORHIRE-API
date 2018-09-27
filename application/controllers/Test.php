<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Test extends CI_Controller

{

    function __construct()

    {

        parent::__construct();

        //$this->load->library("braintree_lib");

    }

    public function index(){

        echo "<pre>";
        
        $json =  '{
              "applinks": {
                "apps": [],
                "details": [
                {
                  "appID": ”SQ4Y6955WF.com.handzforhire.handzforhire”,
                  "paths": ["*"]
                }
                ]
              }
            }';

            echo $json;
    }



	private function printJSON($var){

			echo json_encode($var);

	}



    public function get_token()

    {

        $token = $this->braintree_lib->create_client_token();

        $this->printJSON($token);

    }

   

    public function transaction()

    {

           // Get the credit card details submitted by the form

            $paymentMethodNonce =  $_POST['payment_method_nonce'];

            $amount             = $_POST['amount'];

            

            $result = $this->braintree_lib->transaction(array('amount' => $amount,

                                                              'paymentMethodNonce' => $paymentMethodNonce,

                                                              'options' => array(

                                                                'submitForSettlement' => True

                                                              )));   

    }

}

?>

