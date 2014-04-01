<?php

    //$circuit_id===========================================================================
               if (Validator::isMissing('circuit_id'))
                    $error_messages["errors"][] = Exception(ExceptionMessages::MissingCircuitIdParam." : ".$circuit_id, ExceptionCodes::MissingCircuitIdParam);
               else if (Validator::IsNull($circuit_id))
                    $error_messages["errors"][] = Exception(ExceptionMessages::MissingCircuitIdValue." : ".$circuit_id, ExceptionCodes::MissingCircuitIdValue);
               else if (!Validator::IsNumeric($circuit_id) || Validator::IsNegative($circuit_id))
                    $error_messages["errors"][] = Exception(ExceptionMessages::InvalidCircuitIdValue." : ".$circuit_id, ExceptionCodes::InvalidCircuitIdValue);    
               else if (Validator::IsID($circuit_id)) 
                   $filter = array (new DFC(CircuitsExt::FIELD_CIRCUIT_ID, Validator::ToID($circuit_id), DFC::EXACT));     
               else 
                    $error_messages["errors"][] = Exception(ExceptionMessages::UnknownCircuitIdValue." : ".$circuit_id, ExceptionCodes::UnknownCircuitIdValue);    

               $oCircuits = new CircuitsExt($db);
               $arrayCircuits = $oCircuits->findByFilter($db, $filter, true);

               if ( count( $arrayCircuits ) === 1 ) { 
                    $fCircuitId = $arrayCircuits[0]->getCircuitId();
               } else if ( count( $arrayCircuits ) > 1 ) { 
                    $error_messages["errors"][] = Exception(ExceptionMessages::DuplicateCircuitValue." : ". " circuit_id = " . $circuit_id . " school_unit_id =  " .$fSchoolUnitId , ExceptionCodes::DuplicateCircuitPhoneNumberValue);
               } else {
                    $error_messages["errors"][] = Exception(ExceptionMessages::InvalidCircuit." : ". " circuit_id = " . $circuit_id . " school_unit_id =  " .$fSchoolUnitId, ExceptionCodes::InvalidCircuitPhoneNumberValue);
               }
 
                //= $phone_number ==================================================
               if (Validator::isMissing('phone_number'))
                    $error_messages["errors"][] = Exception(ExceptionMessages::MissingCircuitPhoneNumberParam." : ".$phone_number, ExceptionCodes::MissingCircuitPhoneNumberParam);
               else if (Validator::IsNull($phone_number))
                    $error_messages["errors"][] = Exception(ExceptionMessages::MissingCircuitPhoneNumberValue." : ".$phone_number, ExceptionCodes::MissingCircuitPhoneNumberValue);
               else if (!Validator::IsNumeric($phone_number) || Validator::IsNegative($phone_number))
                    $error_messages["errors"][] = Exception(ExceptionMessages::InvalidCircuitIdPhoneNumberValue." : ".$phone_number, ExceptionCodes::InvalidCircuitIdPhoneNumberValue);    
               else if (Validator::IsID($phone_number)) 
                   $filter = array (new DFC(CircuitsExt::FIELD_PHONE_NUMBER, Validator::ToValue($phone_number), DFC::EXACT));     
               else 
                    $error_messages["errors"][] = Exception(ExceptionMessages::UnknownCircuitIdValue." : ".$phone_number, ExceptionCodes::UnknownCircuitIdValue);    


               $oPhoneNumbers = new CircuitsExt($db);
               $arrayPhoneNumbers = $oPhoneNumbers->findByFilter($db, $filter, true);


               if ( count( $arrayPhoneNumbers ) === 1 ) { 
                    $fPhoneNumber = $arrayPhoneNumbers[0]->getPhoneNumber();
               } else if ( count( $arrayPhoneNumbers ) > 1 ) { 
                    $error_messages["errors"][] = Exception(ExceptionMessages::DuplicateCircuitPhoneNumberValue." : ". " circuit_id = " . $phone_number . " school_unit_id =  " .$fSchoolUnitId , ExceptionCodes::DuplicateCircuitPhoneNumberValue);
               } else {
                    $error_messages["errors"][] = Exception(ExceptionMessages::InvalidCircuitPhoneNumberValue." : ". " circuit_id = " . $phone_number . " school_unit_id =  " .$fSchoolUnitId, ExceptionCodes::InvalidCircuitValue);
               }
?>