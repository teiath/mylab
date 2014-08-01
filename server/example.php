<?php
header("Content-Type: text/html; charset=utf-8");

require_once('system/config.php');
$server = $Options["ServerURL"]."/lab_aquisition_sources";

$params = array(
    
    
  // "lab_id" => "TEST",

);


$curl = curl_init($server);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $Options["Server_MyLab_username"] . ":" . $Options["Server_MyLab_password"]);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


##testing
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
##testing

$data = curl_exec($curl);
//$data = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $data);
//$data = json_decode( $data );GE

//error messages 
//$err     = curl_errno($curl);
//$errmsg  = curl_error($curl) ;
//echo "Error # $err : Error message $errmsg";
//$info = curl_getinfo($curl);
//echo '<pre>';
//print_r($info);
//echo '</pre>';

echo "<pre>";
echo $data;
echo "<br><br>";
var_dump( json_decode($data) );
echo "</pre>";

//echo "done";
//echo "<pre>".var_dump( $data)."</pre>";

//echo $data;

?>
