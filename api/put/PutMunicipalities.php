<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $municipality_id
 * @param type $name
 * @param type $transfer_area
 * @param type $prefecture
 * @return string
 * @throws Exception
 */

function PutMunicipalities($municipality_id,$name,$transfer_area,$prefecture) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();
    $values = array();
    $update_values = array();
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    try {
       
        //$name==========================================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter[] = new DFC(MunicipalitiesExt::FIELD_NAME, $name, DFC::EXACT);   
    
       //$transfer_area============================================================          
        if (! $transfer_area)
            throw new Exception(ExceptionMessages::CreateTransferAreaIdValue." : ".$transfer_area, ExceptionCodes::CreateTransferAreaIdValue);
        else {
              $oTranferAreas= new TransferAreasExt($db);

              if (is_numeric($transfer_area)) {
                  $filter[] = new DFC(TransferAreasExt::FIELD_TRANSFER_AREA_ID, $transfer_area, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(TransferAreasExt::FIELD_NAME, $transfer_area, DFC::EXACT);                
              }         
         }

        $arrayTranferAreas = $oTranferAreas->findByFilter($db, $filter, true);
        
        if ( count( $arrayTranferAreas ) === 1 ) { 
            $fTranferArea = $arrayTranferAreas[0]->getTransferAreaId();
        } else if ( count( $arrayTranferAreas ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateTransferAreaIdValue." : ".$transfer_area, ExceptionCodes::DuplicateTransferAreaIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidTransferAreaValue." : ".$transfer_area, ExceptionCodes::InvalidTransferAreaValue);
        }  

        //$prefecture============================================================          
        if (! $prefecture)
            throw new Exception(ExceptionMessages::CreatePrefectureIdValue." : ".$prefecture, ExceptionCodes::CreatePrefectureIdValue);
        else {
              $oPrefectures= new PrefecturesExt($db);

              if (is_numeric($prefecture)) {
                  $filter[] = new DFC(PrefecturesExt::FIELD_PREFECTURE_ID, $prefecture, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(PrefecturesExt::FIELD_NAME, $prefecture, DFC::EXACT);                
              }         
         }

        $arrayPrefectures = $oPrefectures->findByFilter($db, $filter, true);
        
        if ( count( $arrayPrefectures ) === 1 ) { 
            $fPrefecture = $arrayPrefectures[0]->getPrefectureId();
        } else if ( count( $arrayPrefectures ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicatePrefectureIdValue." : ".$prefecture, ExceptionCodes::DuplicatePrefectureIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidPrefectureValue." : ".$prefecture, ExceptionCodes::InvalidPrefectureValue);
        }  

        //$municipality_id===========================================================================
        if (! trim($municipality_id) )
            throw new Exception(ExceptionMessages::MissingMunicipalityIdValue." : ".$municipality_id, ExceptionCodes::MissingMunicipalityIdValue);
        else if (!is_numeric($municipality_id) || ( $municipality_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidMunicipalityIdValue." : ".$municipality_id, ExceptionCodes::InvalidMunicipalityIdValue);
        else 
            $uMunicipalities = MunicipalitiesExt::findById($db, $municipality_id);

        //=================================================================================================
        $result["total_found"]=count($uMunicipalities);
                                                                                                            
        if ($result["total_found"]==1){
            
            $values["municipality_id"] = $uMunicipalities->getMunicipalityId();
            $values["name"] = $uMunicipalities->getName();        
            $values["transfer_area"] = $uMunicipalities->getTransferAreaId();
            $values["prefecture"] = $uMunicipalities->getPrefectureId();
            $result["values"] = $values;
            
            //check if $name is same as old name of same entry
            $oMunicipalities = new MunicipalitiesExt($db);
            $arrayMunicipalities = $oMunicipalities->findByFilter($db, $filter, true);

                if (( count( $arrayMunicipalities ) > 0 ) && ($values["name"]!=$name)) { 
                     throw new Exception(ExceptionMessages::DuplicateMunicipalityValue." : ".$name, ExceptionCodes::DuplicateMunicipalityValue);
                }  
            
            $update_values["municipality_id"] = $municipality_id;
            $update_values["name"] = $name;
            $update_values["transfer_area"] = $fTranferArea;
            $update_values["prefecture"] = $fPrefecture;
            $result["updated_values"] = $update_values;
            
            $uMunicipalities->setName($name);
            $uMunicipalities->setTransferAreaId($fTranferArea);
            $uMunicipalities->setPrefectureId($fPrefecture);
            $uMunicipalities->updateToDatabase($db);

            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateMunicipalityIdValue." : ".$municipality_id, ExceptionCodes::UpdateMunicipalityIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateMunicipalityIdValue." : ".$municipality_id, ExceptionCodes::DuplicateMunicipalityIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>