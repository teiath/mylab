<?php
header("Content-Type: text/html; charset=utf-8");

class Reports {
    
    public static function Statistics($method, $keplinet , $filters  ) { 
    
  //  require_once('../../api/system/config.php');
    global $Options; 
    
    $params = array_merge($keplinet,$filters);
    
    //make the http request to mmsch with cURL 
    $curl = curl_init($Options['Server_MyLab'].$method);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $Options['Server_MyLab_username'] . ":" . $Options['Server_MyLab_password']);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $params ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = json_decode( curl_exec($curl), true );

    return $data['total'];
    
    }
}

?>
