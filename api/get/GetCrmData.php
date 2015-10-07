<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package GET
 */
 
header("Content-Type: text/html; charset=utf-8");

function GetCrmData( $school_unit_id )
{
    
    //temporary close connection with crm.sch.gr
    //return;
    
    global $crmOptions;
    $result = array();
    $result["data"] = array();
    $result["method"] = __FUNCTION__;
    $params = loadParameters();

    try {

//$mm_id========================================================================

        if ( Validator::Exists('school_unit_id', $params) ) {
            $school_unit_id = Validator::toArray($school_unit_id);
        } else {
            throw new Exception(ExceptionMessages::MissingSchoolUnitIDParam." : ".$school_unit_id, ExceptionCodes::MissingSchoolUnitIDParam);
        }

//execution crm api web service=================================================
        $curl = curl_init( $crmOptions['crmHOST'].$school_unit_id[0]);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $crmOptions['crmUSER'] . ":" . $crmOptions['crmPASS']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3); 
	$data = curl_exec($curl);
        $data = json_decode( $data, true );
        
//result_messages===============================================================     
        $result["data"] = $data["circuits"];
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = ExceptionMessages::NoErrors;
    }
    catch (Exception $e)
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".__FUNCTION__."]:".$e->getMessage();
    }

    return $result;
}

?>