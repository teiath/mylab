<?php
header("Content-Type: text/html; charset=utf-8");

require_once('system/config.php');
//$server = $Options["ServerURL"]."/lab_aquisition_sources";
//$server = $Options["ServerURL"]."/lab_equipment_types";
//$server = $Options["ServerURL"]."/lab_workers";
//$server = $Options["ServerURL"]."/lab_transitions";
//$server = $Options["ServerURL"]."/lab_relations";
$server = $Options["ServerURL"]."/labs";
$params = array(
    
//    
// "lab_id" => "3413",
//    "lab_aquisition_source_id" => "4851",
//    "aquisition_year" => "2011",
//    "aquisition_source" => "2"
// 
//     "lab_id" => "3414",
//     "items"=>33,
//    "equipment_type" => "1",
//  "equipment_type_name" => "ΟΘΟΝΗ"
    
//    "lab_id" => "3413",
//    "worker_id" => "67",
//    "worker_position" => "2",
//    "worker_status"=>"1",
//    "worker_start_service"=>"2014-6-15",
    
//        "lab_id" => "3413",        
//        "state" => "ΕΝΕΡΓΗ",
//        "transition_date" => "2014-08-04",
//        "transition_justification" => "cxss",
//        "transition_source" => "mylab"

//    "lab_id" => "3410",
//    "lab_relation_id" => "251",
//    "school_unit_id" => "1000023",
//    "relation_type" =>"2",
//    "circuit_id" =>"1"
//  
//    "lab_id" => "341332",
    "special_name" => "test",
    "comments" => "dsdsds",
    "lab_type" => "2",
    "school_unit_id" => "1012888",
    "state" => "1",
    "lab_source" => "1",
    "transition_date" => "2014-08-01",
    "transition_justification" => "tesdt",
    "transition_source" => "mylab"
  
    
    
);


$curl = curl_init($server);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//curl_setopt($curl, CURLOPT_USERPWD, $Options["Server_MyLab_username"] . ":" . $Options["Server_MyLab_password"]);
curl_setopt($curl, CURLOPT_USERPWD, ":" );
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


##testing
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
##testing

$data = curl_exec($curl);
//$data = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $data);
//$data = json_decode( $data );

//error messages 
//$err     = curl_errno($curl);
//$errmsg  = curl_error($curl) ;
//echo "Error # $err : Error message $errmsg";
//$info = curl_getinfo($curl);
//echo '<pre>';
//print_r($info);
//echo '</pre>';

//echo "<pre>";
var_dump( trim($data));
////echo "<br><br>";
var_dump( json_decode(trim($data)) );
//var_dump(json_last_error());
//echo "</pre>";

//echo "done";
//echo "<pre>".var_dump( $data)."</pre>";

//echo $data;

?>
