<?php
sendNotification('FFC69D74769858104A6ED3C2579A30B7CCB28C8805C48EA90C4C876CE887D842','test',2,5);
function sendNotification($deviceToken,$message,$params,$apple_identifier)
 {
        
       
        //Setup stream (connect to Apple Push Server)
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'passphrase', 'test');
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'hfhprod.pem');
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
       
        //print_r($fp); exit;
        stream_set_blocking($fp, 0); 
       
       
        // Create the payload body
        $body['aps'] = array(
                             'alert'     => array('body' => $message),
                             'sound'     => 'default',
                             'badge'     => 1
		                   );
			
           // Keep push alive (waiting for delivery) for 90 days
            $apple_expiry = time() + (1 * 24 * 60 * 60); 
            
            $payload = json_encode($body);
                        
            // Enhanced Notification
            $msg = pack("C", 1) . pack("N", $apple_identifier) . pack("N", $apple_expiry) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload; 
                        
            // SEND PUSH
            fwrite($fp, $msg);
            
            usleep(500000);
            
            checkAppleErrorResponse($fp);
            
            echo "success";
            
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


?>