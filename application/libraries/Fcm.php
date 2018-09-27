<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fcm {
    
    // constructor
    function __construct() 
    {
        define( 'API_ACCESS_KEY', 'AIzaSyDUTS8hI1RZew_N6gytri_Ovg1w_Ijm9lg' );
    }

    /**
     * Sending Push Notification
     */
    public function doProcess($registatoin_ids = array(), $message = '', $title = '', $data = array()) {

      
        $msg = array (
            'body'  => $message,
            'title' => $title,
            'sound' => 'default' 
        );

        $fields = array (
                'to'        => $registatoin_ids,
                'notification'  => $msg,
                'data' => $data
            );

        $headers = array(
            'Authorization: key='.API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        //curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ,JSON_UNESCAPED_SLASHES ) );
        $result = curl_exec($ch );
     
        return $result;
     
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close( $ch );
    }


    function send_notification( $registatoin_ids = array(), $data = array() )
    {
         
        $message    = $data['message'];
        $title      = "Handzforhire";

        $this->doProcess($registatoin_ids, $message, $title, $data);
    }

}
