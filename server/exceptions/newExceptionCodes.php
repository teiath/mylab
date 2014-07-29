<?php

/**
 *
 * @version 1.0
 * @author  ΤΕΙ Αθήνας
 * @package Exceptions
 */

header("Content-Type: text/html; charset=utf-8");

/** 
 * Κωδικοί Σφαλμάτων
 * 
 * Παρακάτω εμφανίζονται οι Κωδικοί Σφαλμάτων που διαχειρίζετε η <a href="class-CustomException.html">CustomException</a>
 * 
 */

class ExceptionCodes
{ 
    
//page,pagesize,searchtype,ordertype,orderby MESSAGES===========================

    
    
//FILTER MESSAGES=============================================================== 

//= AquisitionSources
    
    /** {@see ExceptionMessages::MissingAquisitionSourceIDParam} */  
    const MissingAquisitionSourceIDParam = 500;
    /** {@see ExceptionMessages::MissingAquisitionSourceIDValue} */  
    const MissingAquisitionSourceIDValue = 500;
    /** {@see ExceptionMessages::InvalidAquisitionSourceIDType} */  
    const InvalidAquisitionSourceIDType = 500;
    /** {@see ExceptionMessages::InvalidAquisitionSourceIDArray} */  
    const InvalidAquisitionSourceIDArray = 500;
    
    /** {@see ExceptionMessages::MissingAquisitionSourceParam} */  
    const MissingAquisitionSourceParam = 500;
    /** {@see ExceptionMessages::MissingAquisitionSourceValue} */  
    const MissingAquisitionSourceValue = 500;
    /** {@see ExceptionMessages::InvalidAquisitionSourceValue} */  
    const InvalidAquisitionSourceValue = 500;
    /** {@see ExceptionMessages::InvalidAquisitionSourceType} */  
    const InvalidAquisitionSourceType = 500;
    /** {@see ExceptionMessages::InvalidAquisitionSourceArray} */  
    const InvalidAquisitionSourceArray = 500;
    
    /** {@see ExceptionMessages::MissingAquisitionSourceNameParam} */ 
    const MissingAquisitionSourceNameParam = 500;
    /** {@see ExceptionMessages::MissingAquisitionSourceNameValue} */ 
    const MissingAquisitionSourceNameValue = 500;
     /** {@see ExceptionMessages::InvalidAquisitionSourceNameType} */ 
    const InvalidAquisitionSourceNameType = 500;
     /** {@see ExceptionMessages::InvalidAquisitionSourceNameArray} */ 
    const InvalidAquisitionSourceNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedAquisitionSourceValue} */  
    const DuplicatedAquisitionSourceValue = 500;
    /** {@see ExceptionMessages::UsedAquisitionSourceSourceByLabAquisitionSources} */  
    const UsedAquisitionSourceByLabAquisitionSources = 500;    
    
    
    
    
    
    
    
    
}

?>
