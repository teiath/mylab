<?php

class SYNCUtils {
 
    public static function apiRequest($server, $username, $password, $function, $method, $params){
        
        //make the http request to mmsch with cURL 
        $curl = curl_init($server.$function);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $params ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = json_decode( curl_exec($curl), true );

        return $data;
    }
    
}
?>