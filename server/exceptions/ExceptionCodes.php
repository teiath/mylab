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
    //general messages 
    
        const NoErrors = 200;
        const UserNoRoleAccess = 601;
        const UserAccesDenied = 602;
        const UserAccesFrontDenied = 603;
        const UserAccesEmptyDenied = 604;
        const UserNoRolePermissions = 605;
        const MethodNotFound = 500;
        const FunctionNotFound = 500;

        const Unauthorized = 600;
        
        /** {@see ExceptionMessages::MissingXAxisParam} */
        const MissingXAxisParam = 500;
        /** {@see ExceptionMessages::MissingXAxisValue} */
        const MissingXAxisValue = 500;
        /** {@see ExceptionMessages::InvalidXAxisType} */
        const InvalidXAxisType = 500;
        /** {@see ExceptionMessages::InvalidXAxisArray} */
        const InvalidXAxisArray = 500;
        /** {@see ExceptionMessages::InvalidXAxis} */
        const InvalidXAxis = 500;

        /** {@see ExceptionMessages::MissingYAxisParam} */
        const MissingYAxisParam = 500;
        /** {@see ExceptionMessages::MissingYAxisValue} */
        const MissingYAxisValue = 500;
        /** {@see ExceptionMessages::InvalidYAxisType} */
        const InvalidYAxisType = 500;
        /** {@see ExceptionMessages::InvalidYAxisArray} */
        const InvalidYAxisArray = 500;
        /** {@see ExceptionMessages::InvalidYAxis} */
        const InvalidYAxis = 500;
 
        /** {@see ExceptionMessages::DuplicateXYAxisParam} */
        const DuplicateXYAxisParam = 500;

        /** {@see ExceptionMessages::SyncExceptionCodePreMessage} */
        const SyncExceptionCodePreMessage = 555;
        
    //########################################
    //Search Functions
    //######################################## 
        
    //======================================================================================================================
    // =Search 
    //======================================================================================================================
  
//School Units
        
    /** {@see ExceptionMessages::MissingSchoolUnitIDParam} */
    const MissingSchoolUnitIDParam = 500;
    /** {@see ExceptionMessages::MissingSchoolUnitIDValue} */
    const MissingSchoolUnitIDValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitIDType} */
    const InvalidSchoolUnitIDType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitIDArray} */
    const InvalidSchoolUnitIDArray = 500; 
    
    /** {@see ExceptionMessages::MissingSchoolUnitParam} */    
    const MissingSchoolUnitParam = 500;   
    /** {@see ExceptionMessages::MissingSchoolUnitValue} */
    const MissingSchoolUnitValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitValue} */
    const InvalidSchoolUnitValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitType} */
    const InvalidSchoolUnitType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitArray} */
    const InvalidSchoolUnitArray = 500;
     
    /** {@see ExceptionMessages::MissingSchoolUnitNameParam} */
    const MissingSchoolUnitNameParam = 500;
    /** {@see ExceptionMessages::MissingSchoolUnitNameValue} */
    const MissingSchoolUnitNameValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitNameType} */
    const InvalidSchoolUnitNameType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitNameArray} */
    const InvalidSchoolUnitNameArray = 500;
 
    /** {@see ExceptionMessages::InvalidSchoolUnitSpecialNameType} */    
    const InvalidSchoolUnitSpecialNameType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitLastUpdateType} */
    const InvalidSchoolUnitLastUpdateType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitFaxNumberType} */
    const InvalidSchoolUnitFaxNumberType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitPhoneNumberType} */
    const InvalidSchoolUnitPhoneNumberType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitEmailType} */
    const InvalidSchoolUnitEmailType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitStreetAddressType} */
    const InvalidSchoolUnitStreetAddressType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitPostalCodeType} */
    const InvalidSchoolUnitPostalCodeType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitUnitDnsType} */  
    const InvalidSchoolUnitUnitDnsType = 500;
    
    /** {@see ExceptionMessages::DuplicatedSchoolUnitValue} */
    const DuplicatedSchoolUnitValue = 500;
    /** {@see ExceptionMessages::DuplicatedSchoolUnitNameValue} */
    const DuplicatedSchoolUnitNameValue = 500;
 
        //sync
        const DuplicateSchoolUnitUniqueValue = 500;
        const GarbageRowSchoolUnitNameValue = 500;
        const SuccessSyncSchoolUnitsRecord = 500;
        const SuccessSyncUpdateSchoolUnitsRecord = 500;
        const FailureSyncSchoolUnitsRecord = 500;
        const IgnoreSyncSchoolUnitsRecord = 500;
        const GarbageSyncSchoolUnitsRecord = 500;
    
//= Circuits
    
    /** {@see ExceptionMessages::MissingCircuitIDParam} */
    const MissingCircuitIDParam = 500;
    /** {@see ExceptionMessages::MissingCircuitIDValue} */
    const MissingCircuitIDValue = 500;
    /** {@see ExceptionMessages::InvalidCircuitIDType} */
    const InvalidCircuitIDType = 500;
    /** {@see ExceptionMessages::InvalidCircuitIDArray} */
    const InvalidCircuitIDArray = 500;
    /** {@see ExceptionMessages::MissingCircuitValue} */

    /** {@see ExceptionMessages::MissingCircuitParam} */
    const MissingCircuitParam = 500;
    /** {@see ExceptionMessages::MissingCircuitValue} */
    const MissingCircuitValue = 500;
    /** {@see ExceptionMessages::InvalidCircuitValue} */
    const InvalidCircuitValue = 500;
    /** {@see ExceptionMessages::InvalidCircuitType} */
    const InvalidCircuitType = 500;
    /** {@see ExceptionMessages::InvalidCircuitArray} */
    const InvalidCircuitArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedCircuitValue} */
    const DuplicatedCircuitValue = 500;
    /** {@see ExceptionMessages::DuplicatedCircuitPhoneNumberValue} */
    const DuplicatedCircuitPhoneNumberValue = 500;
    /** {@see ExceptionMessages::UsedCircuitBySchoolUnits} */
    const UsedCircuitBySchoolUnits = 500;

    /** {@see ExceptionMessages::MissingCircuitPhoneNumberParam} */
    const MissingCircuitPhoneNumberParam = 500;
    /** {@see ExceptionMessages::MissingCircuitPhoneNumberDValue} */
    const MissingCircuitPhoneNumberValue = 500;
    /** {@see ExceptionMessages::InvalidCircuitPhoneNumberType} */
    const InvalidCircuitPhoneNumberType = 500;
    /** {@see ExceptionMessages::InvalidCircuitPhoneNumberArray} */
    const InvalidCircuitPhoneNumberArray = 500;

    /** {@see ExceptionMessages::MissingCircuitStatusParam} */
    const MissingCircuitStatusParam = 500;
    /** {@see ExceptionMessages::MissingCircuitStatusValue} */
    const MissingCircuitStatusValue = 500;
    /** {@see ExceptionMessages::InvalidCircuitStatusType} */
    const InvalidCircuitStatusType = 500;
    /** {@see ExceptionMessages::InvalidCircuitStatusArray} */
    const InvalidCircuitStatusArray = 500;
     
    /** {@see ExceptionMessages::MissingCircuitUpdatedDateParam} */
    const MissingCircuitUpdatedDateParam = 500;
    /** {@see ExceptionMessages::MissingCircuitUpdatedDateValue} */
    const MissingCircuitUpdatedDateValue = 500;
    /** {@see ExceptionMessages::InvalidCircuitUpdatedDateType} */
    const InvalidCircuitUpdatedDateType = 500;
    /** {@see ExceptionMessages::InvalidCircuitUpdatedDateArray} */
    const InvalidCircuitUpdatedDateArray = 500;
  
        //sync
        const DuplicateCircuitUniqueValue = 500;
        const InvalidSyncCircuitPhoneNumberValue  = 500;
        const UnknownSyncCircuitPhoneNumberType  = 500;
        const DuplicateSyncCircuitsPhoneValue = 500;
        const SuccessSyncCircuitsRecord = 500;
        const SuccessSyncUpdateCircuitsRecord = 500;
        const FailureSyncCircuitsRecord = 500;
    
//= SchoolUnitWorkers
    
    /** {@see ExceptionMessages::MissingSchoolUnitWorkerIDParam} */
    const MissingSchoolUnitWorkerIDParam = 500;
    /** {@see ExceptionMessages::MissingSchoolUnitWorkerIDValue} */
    const MissingSchoolUnitWorkerIDValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitWorkerIDType} */
    const InvalidSchoolUnitWorkerIDType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitWorkerIDArray} */
    const InvalidSchoolUnitWorkerIDArray = 500;
    
    /** {@see ExceptionMessages::MissingSchoolUnitWorkerParam} */
    const MissingSchoolUnitWorkerParam = 500;
    /** {@see ExceptionMessages::MissingSchoolUnitWorkerValue} */
    const MissingSchoolUnitWorkerValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitWorkerValue} */
    const InvalidSchoolUnitWorkerValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitWorkerType} */
    const InvalidSchoolUnitWorkerType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitWorkerArray} */
    const InvalidSchoolUnitWorkerArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedSchoolUnitWorkerValue} */
    const DuplicatedSchoolUnitWorkerValue = 500;
    /** {@see ExceptionMessages::UsedSchoolUnitWorkerBySchoolUnits} */
    const UsedSchoolUnitWorkerBySchoolUnits = 500;

        //sync
        const DuplicateSchoolWorkerUniqueValue = 500;
        const DuplicateSyncSchoolUnitWorkerValue = 500;
        const SuccessSyncSchoolUnitWorkersRecord = 500;
        const SuccessSyncUpdateSchoolUnitWorkersRecord = 500;
        const FailureSyncSchoolUnitWorkersRecord = 500;
    
    
//= Workers

    /** {@see ExceptionMessages::MissingWorkerIDParam} */
    const MissingWorkerIDParam = 500;
    /** {@see ExceptionMessages::MissingWorkerIDValue} */
    const MissingWorkerIDValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerIDType} */
    const InvalidWorkerIDType = 500;
    /** {@see ExceptionMessages::InvalidWorkerIDArray} */
    const InvalidWorkerIDArray = 500;
   
    /** {@see ExceptionMessages::MissingWorkerParam} */
    const MissingWorkerParam = 500;
    /** {@see ExceptionMessages::MissingWorkerValue} */
    const MissingWorkerValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerValue} */
    const InvalidWorkerValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerType} */
    const InvalidWorkerType = 500;
    /** {@see ExceptionMessages::InvalidWorkerArray} */
    const InvalidWorkerArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedWorkerValue} */
    const DuplicatedWorkerValue = 500;
    /** {@see ExceptionMessages::DuplicatedWorkerRegistryNoValue} */
    const DuplicatedWorkerRegistryNoValue = 500;
    /** {@see ExceptionMessages::DuplicatedWorkerTaxNumberValue} */
    const DuplicatedWorkerTaxNumberValue = 500;
    /** {@see ExceptionMessages::UsedWorkerBySchoolUnitWorkers} */
    const UsedWorkerBySchoolUnitWorkers = 500;
   
    /** {@see ExceptionMessages::MissingWorkerRegistryNoParam} */
    const MissingWorkerRegistryNoParam = 500;
    /** {@see ExceptionMessages::MissingWorkerRegistryNoValue} */
    const MissingWorkerRegistryNoValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerRegistryNoType} */
    const InvalidWorkerRegistryNoType = 500;
    /** {@see ExceptionMessages::InvalidWorkerRegistryNoArray} */
    const InvalidWorkerRegistryNoArray = 500;
    
    /** {@see ExceptionMessages::MissingWorkerTaxNumberParam} */
    const MissingWorkerTaxNumberParam = 500;
    /** {@see ExceptionMessages::MissingWorkerTaxNumberValue} */
    const MissingWorkerTaxNumberValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerTaxNumberType} */
    const InvalidWorkerTaxNumberType = 500;
    /** {@see ExceptionMessages::InvalidWorkerTaxNumberArray} */
    const InvalidWorkerTaxNumberArray = 500;
        
    /** {@see ExceptionMessages::MissingWorkerLastnameParam} */
    const MissingWorkerLastnameParam = 500;
    /** {@see ExceptionMessages::MissingWorkerLastnameValue} */
    const MissingWorkerLastnameValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerLastnameType} */
    const InvalidWorkerLastnameType = 500;
    /** {@see ExceptionMessages::InvalidWorkerLastnameArray} */
    const InvalidWorkerLastnameArray = 500;

    /** {@see ExceptionMessages::MissingWorkerFirstnameParam} */
    const MissingWorkerFirstnameParam = 500;
    /** {@see ExceptionMessages::MissingWorkerFirstnameValue} */
    const MissingWorkerFirstnameValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerFirstnameType} */
    const InvalidWorkerFirstnameType = 500;
    /** {@see ExceptionMessages::InvalidWorkerFirstnameArray} */
    const InvalidWorkerFirstnameArray = 500;
    
    /** {@see ExceptionMessages::MissingWorkerFatherNameParam} */
    const MissingWorkerFatherNameParam = 500;
    /** {@see ExceptionMessages::MissingWorkerFatherNameValue} */
    const MissingWorkerFatherNameValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerFatherNameType} */
    const InvalidWorkerFatherNameType = 500;
    /** {@see ExceptionMessages::InvalidWorkerFatherNameArray} */
    const InvalidWorkerFatherNameArray = 500;
    
    /** {@see ExceptionMessages::MissingWorkerSexTypeParam} */
    const MissingWorkerSexTypeParam = 500;
    /** {@see ExceptionMessages::MissingWorkerSexTypeValue} */    
    const MissingWorkerSexTypeValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerSexTypeType} */    
    const InvalidWorkerSexTypeType = 500;
        /** {@see ExceptionMessages::InvalidWorkerSexTypeArray} */
    const InvalidWorkerSexTypeArray = 500;

        //sync
        const DuplicateWorkerUniqueValue = 500;
        const DuplicateSyncWorkerValue = 500;
        const SuccessSyncWorkersRecord = 500;
        const SuccessSyncUpdateWorkersRecord = 500;
        const FailureSyncWorkersRecord = 500;
    
//= LabWorkers
    
    /** {@see ExceptionMessages::MissingLabWorkerIDParam} */
    const MissingLabWorkerIDParam = 500;
    /** {@see ExceptionMessages::MissingLabWorkerIDValue} */
    const MissingLabWorkerIDValue = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerIDType} */
    const InvalidLabWorkerIDType = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerIDArray} */
    const InvalidLabWorkerIDArray = 500;
    
    /** {@see ExceptionMessages::MissingLabWorkerParam} */
    const MissingLabWorkerParam = 500;
    /** {@see ExceptionMessages::MissingLabWorkerValue} */
    const MissingLabWorkerValue = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerValue} */
    const InvalidLabWorkerValue = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerType} */
    const InvalidLabWorkerType = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerArray} */
    const InvalidLabWorkerArray = 500;
    
    /** {@see ExceptionMessages::MissingLabWorkerStatusParam} */
    const MissingLabWorkerStatusParam = 500;
    /** {@see ExceptionMessages::MissingLabWorkerStatusValue} */
    const MissingLabWorkerStatusValue = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerStatusType} */
    const InvalidLabWorkerStatusType = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerStatusArray} */
    const InvalidLabWorkerStatusArray = 500;

    /** {@see ExceptionMessages::MissingLabWorkerStartServiceParam} */
    const MissingLabWorkerStartServiceParam = 500;
    /** {@see ExceptionMessages::MissingLabWorkerStartServiceValue} */
    const MissingLabWorkerStartServiceValue = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerStartServiceType} */
    const InvalidLabWorkerStartServiceType = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerStartServiceArray} */
    const InvalidLabWorkerStartServiceArray = 500;
    
    /** {@see ExceptionMessages::MissingLabWorkerEmailParam} */
    const MissingLabWorkerEmailParam = 500;
    /** {@see ExceptionMessages::MissingLabWorkerEmailValue} */
    const MissingLabWorkerEmailValue = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerEmailType} */
    const InvalidLabWorkerEmailType = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerEmailArray} */
    const InvalidLabWorkerEmailArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedLabWorkerValue} */
    const DuplicatedLabWorkerValue = 500;
    /** {@see ExceptionMessages::UsedLabWorkerByLabs} */
    const UsedLabWorkerByLabs = 500;
    /** {@see ExceptionMessages::DuplicateLabWorkerUniqueValue} */
    const DuplicateLabWorkerUniqueValue = 500;
    /** {@see ExceptionMessages::NotAllowedLabWorkerStartService} */
    const NotAllowedLabWorkerStartService = 500;
    
    //extra
    /** {@see ExceptionMessages::InvalidLabWorkerStartServiceValidType} */    
    const InvalidLabWorkerStartServiceValidType = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerActiveStatus} */    
    const InvalidLabWorkerActiveStatus = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerNewWorkerStatus} */  
    const InvalidLabWorkerNewWorkerStatus = 500;
    /** {@see ExceptionMessages::InvalidLabWorkerSetStatus} */  
    const InvalidLabWorkerSetStatus = 500;  
    
    //delete
    /** {@see ExceptionMessages::DuplicateDelLabWorkerValue} */
    const DuplicateDelLabWorkerValue = 500;
    /** {@see ExceptionMessages::NotFoundDelLabWorkerValue} */    
    const NotFoundDelLabWorkerValue = 500;
     /** {@see ExceptionMessages::NoPermissionDelLabWorkerValue} */    
    const NoPermissionDelLabWorkerValue = 500;
    
    //= MylabWorkers

    /** {@see ExceptionMessages::MissingMylabWorkerIDParam} */
    const MissingMylabWorkerIDParam = 500;
    /** {@see ExceptionMessages::MissingMylabWorkerIDValue} */
    const MissingMylabWorkerIDValue = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerIDType} */
    const InvalidMylabWorkerIDType = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerIDArray} */
    const InvalidMylabWorkerIDArray = 500;
   
    /** {@see ExceptionMessages::MissingMylabWorkerParam} */
    const MissingMylabWorkerParam = 500;
    /** {@see ExceptionMessages::MissingMylabWorkerValue} */
    const MissingMylabWorkerValue = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerValue} */
    const InvalidMylabWorkerValue = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerType} */
    const InvalidMylabWorkerType = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerArray} */
    const InvalidMylabWorkerArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedMylabWorkerValue} */
    const DuplicatedMylabWorkerValue = 500;
    /** {@see ExceptionMessages::DuplicatedMylabWorkerRegistryNoValue} */
    const DuplicatedMylabWorkerRegistryNoValue = 500;
    /** {@see ExceptionMessages::DuplicatedMylabWorkerUidValue} */
    const DuplicatedMylabWorkerUidValue = 500;
    /** {@see ExceptionMessages::UsedMylabWorkerBySchoolUnitLabs} */
    const UsedMylabWorkerBySchoolUnitLabs = 500;
   
    /** {@see ExceptionMessages::MissingMylabWorkerRegistryNoParam} */
    const MissingMylabWorkerRegistryNoParam = 500;
    /** {@see ExceptionMessages::MissingMylabWorkerRegistryNoValue} */
    const MissingMylabWorkerRegistryNoValue = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerRegistryNoType} */
    const InvalidMylabWorkerRegistryNoType = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerRegistryNoArray} */
    const InvalidMylabWorkerRegistryNoArray = 500;
    
    /** {@see ExceptionMessages::MissingMylabWorkerUidParam} */
    const MissingMylabWorkerUidParam = 500;
    /** {@see ExceptionMessages::MissingMylabWorkerUidValue} */
    const MissingMylabWorkerUidValue = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerUidType} */
    const InvalidMylabWorkerUidType = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerUidArray} */
    const InvalidMylabWorkerUidArray = 500;
    
    /** {@see ExceptionMessages::MissingMylabWorkerLastnameParam} */
    const MissingMylabWorkerLastnameParam = 500;
    /** {@see ExceptionMessages::MissingMylabWorkerLastnameValue} */
    const MissingMylabWorkerLastnameValue = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerLastnameType} */
    const InvalidMylabWorkerLastnameType = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerLastnameArray} */
    const InvalidMylabWorkerLastnameArray = 500;

    /** {@see ExceptionMessages::MissingMylabWorkerFirstnameParam} */
    const MissingMylabWorkerFirstnameParam = 500;
    /** {@see ExceptionMessages::MissingMylabWorkerFirstnameValue} */
    const MissingMylabWorkerFirstnameValue = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerFirstnameType} */
    const InvalidMylabWorkerFirstnameType = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerFirstnameArray} */
    const InvalidMylabWorkerFirstnameArray = 500;
    
    /** {@see ExceptionMessages::MissingMylabWorkerFathernameParam} */
    const MissingMylabWorkerFathernameParam = 500;
    /** {@see ExceptionMessages::MissingMylabWorkerFathernameValue} */
    const MissingMylabWorkerFathernameValue = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerFathernameType} */
    const InvalidMylabWorkerFathernameType = 500;
    /** {@see ExceptionMessages::InvalidMylabWorkerFathernameArray} */
    const InvalidMylabWorkerFathernameArray = 500;

       //delete
        const DuplicateDelMyLabWorkerValue = 500;
        const NotFoundDelMyLabWorkerValue = 500;

        //references
        const ReferencesMyLabWorkerLabWorkers = 500;
 
//= LdapWorkers

    const MissingLdapWorkerUidParam = 500;
    const MissingLdapWorkerUidValue = 500;
    const InvalidLdapWorkerUidValue = 500;
    const InvalidLdapWorkerUidType = 500;
    const InvalidLdapWorkerUidArray = 500;
    
    const MultipleLdapWorkerUidValue = 500;
    const NotAcceptedLdapWorkerPosition = 500;
    
//Labs
        
    /** {@see ExceptionMessages::MissingLabIDParam} */
    const MissingLabIDParam = 500;
    /** {@see ExceptionMessages::MissingLabIDValue} */
    const MissingLabIDValue = 500;
    /** {@see ExceptionMessages::InvalidLabIDType} */
    const InvalidLabIDType = 500;
    /** {@see ExceptionMessages::InvalidLabIDArray} */
    const InvalidLabIDArray = 500;
    
    /** {@see ExceptionMessages::MissingLabParam} */
    const MissingLabParam = 500; 
    /** {@see ExceptionMessages::MissingLabValue} */
    const MissingLabValue = 500;
    /** {@see ExceptionMessages::InvalidLabValue} */
    const InvalidLabValue = 500;
    /** {@see ExceptionMessages::InvalidLabType} */
    const InvalidLabType = 500;
    /** {@see ExceptionMessages::InvalidLabArray} */
    const InvalidLabArray = 500;
     
    /** {@see ExceptionMessages::MissingLabNameParam} */
    const MissingLabNameParam = 500;
    /** {@see ExceptionMessages::MissingLabNameValue} */
    const MissingLabNameValue = 500;
    /** {@see ExceptionMessages::InvalidLabNameType} */
    const InvalidLabNameType = 500;
    /** {@see ExceptionMessages::InvalidLabNameArray} */
    const InvalidLabNameArray = 500;

    /** {@see ExceptionMessages::MissingLabOperationalRatingParam} */
    const MissingLabOperationalRatingParam = 500;
    /** {@see ExceptionMessages::MissingLabOperationalRatingValue} */
    const MissingLabOperationalRatingValue = 500;
    /** {@see ExceptionMessages::InvalidLabOperationalRatingType} */
    const InvalidLabOperationalRatingType = 500;
    /** {@see ExceptionMessages::InvalidLabOperationalRatingArray} */
    const InvalidLabOperationalRatingArray = 500;
    
    /** {@see ExceptionMessages::MissingLabTechnologicalRatingParam} */
    const MissingLabTechnologicalRatingParam = 500;
    /** {@see ExceptionMessages::MissingLabTechnologicalRatingValue} */
    const MissingLabTechnologicalRatingValue = 500;
    /** {@see ExceptionMessages::InvalidLabTechnologicalRatingType} */
    const InvalidLabTechnologicalRatingType = 500;
    /** {@see ExceptionMessages::InvalidLabTechnologicalRatingArray} */
    const InvalidLabTechnologicalRatingArray = 500;
  
    /** {@see ExceptionMessages::MissingLabEllakParam} */
    const MissingLabEllakParam = 500;
    /** {@see ExceptionMessages::MissingLabEllakValue} */
    const MissingLabEllakValue = 500;
    /** {@see ExceptionMessages::InvalidLabEllakType} */
    const InvalidLabEllakType = 500;
    /** {@see ExceptionMessages::InvalidLabEllakArray} */
    const InvalidLabEllakArray = 500;
  
    /** {@see ExceptionMessages::MissingLabSubmittedParam} */
    const MissingLabSubmittedParam = 500;
    /** {@see ExceptionMessages::MissingLabSubmittedValue} */
    const MissingLabSubmittedValue = 500;
    /** {@see ExceptionMessages::InvalidLabSubmittedType} */
    const InvalidLabSubmittedType = 500;
    /** {@see ExceptionMessages::InvalidLabSubmittedArray} */
    const InvalidLabSubmittedArray = 500;
   
    /** {@see ExceptionMessages::MissingLabSpecialNameParam} */  
    const MissingLabSpecialNameParam = 500;
    /** {@see ExceptionMessages::MissingLabSpecialNameValue} */  
    const MissingLabSpecialNameValue = 500;
    /** {@see ExceptionMessages::InvalidLabSpecialNameType} */  
    const InvalidLabSpecialNameType = 500;
    /** {@see ExceptionMessages::InvalidLabSpecialNameArray} */  
    const InvalidLabSpecialNameArray = 500;
    
    /** {@see ExceptionMessages::MissingLabPositioningParam} */  
    const MissingLabPositioningParam = 500;
    /** {@see ExceptionMessages::MissingLabPositioningValue} */  
    const MissingLabPositioningValue = 500;
    /** {@see ExceptionMessages::InvalidLabPositioningType} */  
    const InvalidLabPositioningType = 500;
    /** {@see ExceptionMessages::InvalidLabPositioningArray} */  
    const InvalidLabPositioningArray = 500;
    
    /** {@see ExceptionMessages::MissingLabCommentsParam} */  
    const MissingLabCommentsParam = 500;
    /** {@see ExceptionMessages::MissingLabCommentsValue} */  
    const MissingLabCommentsValue = 500;
    /** {@see ExceptionMessages::InvalidLabCommentsType} */  
    const InvalidLabCommentsType = 500;
    /** {@see ExceptionMessages::InvalidLabCommentsArray} */  
    const InvalidLabCommentsArray = 500;    

    /** {@see ExceptionMessages::DuplicatedLabValue} */
    const DuplicatedLabValue = 500;
    /** {@see ExceptionMessages::DuplicatedLabNameValue} */
    const DuplicatedLabNameValue = 500;
    /** {@see ExceptionMessages::DuplicateLabUniqueValue} */
    const DuplicateLabUniqueValue = 500;
    /** {@see ExceptionMessages::NotAllowedLabNameValue} */
    const NotAllowedLabNameValue = 500;
    /** {@see ExceptionMessages::NotAllowedEllakValue} */   
    const NotAllowedEllakValue = 500;
      
    //extra
    /** {@see ExceptionMessages::InvalidLabCreationDateType} */
    const InvalidLabCreationDateType = 500;
    /** {@see ExceptionMessages::InvalidLabCreatedByType} */
    const InvalidLabCreatedByType = 500;
    /** {@see ExceptionMessages::InvalidLabLastUpdatedType} */
    const InvalidLabLastUpdatedType = 500;
    /** {@see ExceptionMessages::InvalidLabUpdatedByType} */
    const InvalidLabUpdatedByType = 500;
    /** {@see ExceptionMessages::AlreadyLabSubmittedActiveValue} */  
    const AlreadyLabSubmittedActiveValue = 500;
    /** {@see ExceptionMessages::AlreadyLabSubmittedInitialValue} */  
    const AlreadyLabSubmittedInitialValue = 500;
     
    //delete
    /** {@see ExceptionMessages::DuplicateDelLabValue} */  
    const DuplicateDelLabValue = 500;
    /** {@see ExceptionMessages::NotFoundDelLabValue} */  
    const NotFoundDelLabValue = 500;
    /** {@see ExceptionMessages::NoDemoDelLabValue} */ 
    const NoDemoDelLabValue = 500;
      
    //references
    /** {@see ExceptionMessages::ReferencesLabAquisitionSources} */ 
    const ReferencesLabAquisitionSources = 500;
    /** {@see ExceptionMessages::ReferencesLabEquipmentTypes} */ 
    const ReferencesLabEquipmentTypes = 500;
    /** {@see ExceptionMessages::ReferencesLabWorkers} */ 
    const ReferencesLabWorkers = 500;
    /** {@see ExceptionMessages::ReferencesLabRelations} */ 
    const ReferencesLabRelations = 500;
    /** {@see ExceptionMessages::ReferencesLabTransitions} */ 
    const ReferencesLabTransitions = 500;
    
//LabEquipmentTypes
        
    /** {@see ExceptionMessages::MissingLabEquipmentTypeIDParam} */
    const MissingLabEquipmentTypeIDParam = 500;
    /** {@see ExceptionMessages::MissingLabEquipmentTypeIDValue} */
    const MissingLabEquipmentTypeIDValue = 500;
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeIDType} */
    const InvalidLabEquipmentTypeIDType = 500;
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeIDArray} */
    const InvalidLabEquipmentTypeIDArray = 500;

    /** {@see ExceptionMessages::MissingLabEquipmentTypeParam} */
    const MissingLabEquipmentTypeParam = 500;
    /** {@see ExceptionMessages::MissingLabEquipmentTypeValue} */
    const MissingLabEquipmentTypeValue = 500;
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeValue} */
    const InvalidLabEquipmentTypeValue = 500;
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeType} */
    const InvalidLabEquipmentTypeType = 500;
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeArray} */
    const InvalidLabEquipmentTypeArray = 500;
    
    /** {@see ExceptionMessages::MissingLabEquipmentTypeItemsParam} */ 
    const MissingLabEquipmentTypeItemsParam = 500;
    /** {@see ExceptionMessages::MissingLabEquipmentTypeItemsValue} */
    const MissingLabEquipmentTypeItemsValue = 500;
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeItemsType} */
    const InvalidLabEquipmentTypeItemsType = 500;
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeItemsArray} */
    const InvalidLabEquipmentTypeItemsArray = 500;
   
    /** {@see ExceptionMessages::DuplicatedLabEquipmentTypeValue} */
    const DuplicatedLabEquipmentTypeValue = 500;
    /** {@see ExceptionMessages::UsedLabEquipmentTypeByLabs} */
    const UsedLabEquipmentTypeByLabs = 500;
    /** {@see ExceptionMessages::DuplicateLabEquipmentTypeUniqueValue} */
    const DuplicateLabEquipmentTypeUniqueValue = 500;
    
    //extra
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeItemsValidType} */
    const InvalidLabEquipmentTypeItemsValidType = 500;
    
    //delete
    /** {@see ExceptionMessages::DuplicateDelLabEquipmentTypeValue} */
    const DuplicateDelLabEquipmentTypeValue = 500;
    /** {@see ExceptionMessages::NotFoundDelLabEquipmentTypeValue} */
    const NotFoundDelLabEquipmentTypeValue = 500;
    
//LabAquisitionSources
        
    /** {@see ExceptionMessages::MissingLabAquisitionSourceIDParam} */
    const MissingLabAquisitionSourceIDParam = 500;
    /** {@see ExceptionMessages::MissingLabAquisitionSourceIDValue} */
    const MissingLabAquisitionSourceIDValue = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceIDType} */
    const InvalidLabAquisitionSourceIDType = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceIDArray} */
    const InvalidLabAquisitionSourceIDArray = 500;

    /** {@see ExceptionMessages::MissingLabAquisitionSourceParam} */
    const MissingLabAquisitionSourceParam = 500;   
    /** {@see ExceptionMessages::MissingLabAquisitionSourceValue} */
    const MissingLabAquisitionSourceValue = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceValue} */
    const InvalidLabAquisitionSourceValue = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceType} */
    const InvalidLabAquisitionSourceType = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceArray} */
    const InvalidLabAquisitionSourceArray = 500;
  
    /** {@see ExceptionMessages::MissingLabAquisitionSourceYearParam} */
    const MissingLabAquisitionSourceYearParam = 500;
    /** {@see ExceptionMessages::MissingLabAquisitionSourceYearValue} */
    const MissingLabAquisitionSourceYearValue = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceYearType} */
    const InvalidLabAquisitionSourceYearType = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceYearArray} */
    const InvalidLabAquisitionSourceYearArray = 500;

    /** {@see ExceptionMessages::MissingLabAquisitionSourceCommentsParam} */
    const MissingLabAquisitionSourceCommentsParam = 500;
    /** {@see ExceptionMessages::MissingLabAquisitionSourceCommentsValue} */
    const MissingLabAquisitionSourceCommentsValue = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceCommentsType} */
    const InvalidLabAquisitionSourceCommentsType = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceCommentsArray} */
    const InvalidLabAquisitionSourceCommentsArray = 500; 
     
    /** {@see ExceptionMessages::DuplicatedLabAquisitionSourceValue} */
    const DuplicatedLabAquisitionSourceValue = 500;
    /** {@see ExceptionMessages::UsedLabAquisitionSourceByLabs} */
    const UsedLabAquisitionSourceByLabs = 500;
    /** {@see ExceptionMessages::DuplicateLabAquisitionSourceUniqueValue} */
    const DuplicateLabAquisitionSourceUniqueValue = 500;
    
    //extra
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceYearValidType} */
    const InvalidLabAquisitionSourceYearValidType = 500;

    //delete
    /** {@see ExceptionMessages::DuplicateDelLabAquisitionSourceValue} */
    const DuplicateDelLabAquisitionSourceValue = 500; 
    /** {@see ExceptionMessages::NotFoundDelLabAquisitionSourceValue} */
    const NotFoundDelLabAquisitionSourceValue = 500;
    
//LabTransitions
        
    /** {@see ExceptionMessages::MissingLabTransitionIDParam} */
    const MissingLabTransitionIDParam = 500;
    /** {@see ExceptionMessages::MissingLabTransitionIDValue} */
    const MissingLabTransitionIDValue = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionIDType} */
    const InvalidLabTransitionIDType = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionIDArray} */
    const InvalidLabTransitionIDArray = 500; 

    /** {@see ExceptionMessages::MissingLabTransitionParam} */
    const MissingLabTransitionParam = 500;   
    /** {@see ExceptionMessages::MissingLabTransitionValue} */
    const MissingLabTransitionValue = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionValue} */
    const InvalidLabTransitionValue = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionType} */
    const InvalidLabTransitionType = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionArray} */
    const InvalidLabTransitionArray = 500;
    
    /** {@see ExceptionMessages::MissingLabTransitionJustificationParam} */
    const MissingLabTransitionJustificationParam = 500;
    /** {@see ExceptionMessages::MissingLabTransitionJustificationValue} */
    const MissingLabTransitionJustificationValue = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionJustificationType} */
    const InvalidLabTransitionJustificationType = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionJustificationArray} */
    const InvalidLabTransitionJustificationArray = 500;
    
    /** {@see ExceptionMessages::MissingLabTransitionDateParam} */
    const MissingLabTransitionDateParam = 500;
    /** {@see ExceptionMessages::MissingLabTransitionDateValue} */
    const MissingLabTransitionDateValue = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionDateType} */
    const InvalidLabTransitionDateType = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionDateArray} */
    const InvalidLabTransitionDateArray = 500; 
    
    /** {@see ExceptionMessages::MissingLabTransitionSourceParam} */
    const MissingLabTransitionSourceParam = 500;
    /** {@see ExceptionMessages::MissingLabTransitionSourceValue} */
    const MissingLabTransitionSourceValue = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionSourceType} */
    const InvalidLabTransitionSourceType = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionSourceArray} */
    const InvalidLabTransitionSourceArray = 500; 
    
    /** {@see ExceptionMessages::DuplicatedLabTransitionValue} */
    const DuplicatedLabTransitionValue = 500;
    /** {@see ExceptionMessages::UsedLabTransitionByLabs} */
    const UsedLabTransitionByLabs = 500;
    /** {@see ExceptionMessages::InvalidDiscontinuedStateValue} */
    const InvalidDiscontinuedStateValue = 500;
    /** {@see ExceptionMessages::InvalidSameStateValue} */
    const InvalidSameStateValue = 500;
    /** {@see ExceptionMessages::NotAllowedLabTransitionDate} */  
    const NotAllowedLabTransitionDate = 500;
    /** {@see ExceptionMessages::SeriousProblemLabTransitionState} */ 
    const SeriousProblemLabTransitionState = 500;


    //extra
    /** {@see ExceptionMessages::InvalidLabTransitionValidType} */
    const InvalidLabTransitionValidType = 500;
    /** {@see ExceptionMessages::InvalidLabTransitionDemoValue} */
    const InvalidLabTransitionDemoValue = 500;
     
    //delete
    /** {@see ExceptionMessages::DuplicateDelLabTransitionValue} */
    const DuplicateDelLabTransitionValue = 500; 
    /** {@see ExceptionMessages::NotFoundDelLabTransitionValue} */
    const NotFoundDelLabTransitionValue = 500;
    
//LabRelations
    
    /** {@see ExceptionMessages::MissingLabRelationIDParam} */    
    const MissingLabRelationIDParam = 500;
    /** {@see ExceptionMessages::MissingLabRelationIDValue} */
    const MissingLabRelationIDValue = 500;
    /** {@see ExceptionMessages::InvalidLabRelationIDType} */
    const InvalidLabRelationIDType = 500;
    /** {@see ExceptionMessages::InvalidLabRelationIDArray} */
    const InvalidLabRelationIDArray = 500; 

    /** {@see ExceptionMessages::MissingLabRelationParam} */
    const MissingLabRelationParam = 500;  
    /** {@see ExceptionMessages::MissingLabRelationValue} */
    const MissingLabRelationValue = 500;
    /** {@see ExceptionMessages::InvalidLabRelationValue} */
    const InvalidLabRelationValue = 500;
    /** {@see ExceptionMessages::InvalidLabRelationType} */
    const InvalidLabRelationType = 500;
    /** {@see ExceptionMessages::InvalidLabRelationArray} */
    const InvalidLabRelationArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedLabRelationValue} */
    const DuplicatedLabRelationValue = 500;
    /** {@see ExceptionMessages::UsedLabRelationByLabs} */
    const UsedLabRelationByLabs = 500;
    /** {@see ExceptionMessages::UsedLabRelationServerOnline} */   
    const UsedLabRelationServerOnline = 500;
    
    //extra
    /** {@see ExceptionMessages::ErrorInputCircuitIdParam} */       
    const ErrorInputCircuitIdParam = 500;
    
    //delete
    /** {@see ExceptionMessages::DuplicateDelLabRelationValue} */  
    const DuplicateDelLabRelationValue = 500;
    /** {@see ExceptionMessages::NotFoundDelLabRelationValue} */  
    const NotFoundDelLabRelationValue = 500;    
        
    //########################################
    //Vocabularies Functions
    //######################################## 
    
//= RegionEduAdmins
    
    /** {@see ExceptionMessages::MissingRegionEduAdminIDParam} */
    const MissingRegionEduAdminIDParam = 500;
    /** {@see ExceptionMessages::MissingRegionEduAdminIDValue} */
    const MissingRegionEduAdminIDValue = 500;
    /** {@see ExceptionMessages::InvalidRegionEduAdminIDType} */
    const InvalidRegionEduAdminIDType = 500;
    /** {@see ExceptionMessages::InvalidRegionEduAdminIDArray} */
    const InvalidRegionEduAdminIDArray = 500;
    
    /** {@see ExceptionMessages::MissingRegionEduAdminParam} */
    const MissingRegionEduAdminParam = 500;
    /** {@see ExceptionMessages::MissingRegionEduAdminValue} */
    const MissingRegionEduAdminValue = 500;
    /** {@see ExceptionMessages::InvalidRegionEduAdminValue} */
    const InvalidRegionEduAdminValue = 500;
    /** {@see ExceptionMessages::InvalidRegionEduAdminType} */
    const InvalidRegionEduAdminType = 500;
    /** {@see ExceptionMessages::InvalidRegionEduAdminArray} */
    const InvalidRegionEduAdminArray = 500;
 
    /** {@see ExceptionMessages::MissingRegionEduAdminNameParam} */
    const MissingRegionEduAdminNameParam = 500;
    /** {@see ExceptionMessages::MissingRegionEduAdminNameValue} */
    const MissingRegionEduAdminNameValue = 500;
    /** {@see ExceptionMessages::InvalidRegionEduAdminNameType} */
    const InvalidRegionEduAdminNameType = 500;
    /** {@see ExceptionMessages::InvalidRegionEduAdminNameArray} */
    const InvalidRegionEduAdminNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedRegionEduAdminValue} */
    const DuplicatedRegionEduAdminValue = 500;
    /** {@see ExceptionMessages::UsedRegionEduAdminBySchoolUnits} */
    const UsedRegionEduAdminBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedRegionEduAdminByEduAdmins} */   
    const UsedRegionEduAdminByEduAdmins = 500;
    
        //sync
        const DuplicateRegionEduAdminUniqueValue = 500;
        const DuplicateSyncRegionEduAdminNameValue = 500;
        const SuccessSyncRegionEduAdminsRecord = 500;
        const SuccessSyncUpdateRegionEduAdminsRecord = 500;
        const FailureSyncRegionEduAdminsRecord = 500;
    
//= EduAdmins
    
    /** {@see ExceptionMessages::MissingEduAdminIDParam} */   
    const MissingEduAdminIDParam = 500;
    /** {@see ExceptionMessages::MissingEduAdminIDValue} */   
    const MissingEduAdminIDValue = 500;
    /** {@see ExceptionMessages::InvalidEduAdminIDType} */   
    const InvalidEduAdminIDType = 500;
    /** {@see ExceptionMessages::InvalidEduAdminIDArray} */   
    const InvalidEduAdminIDArray = 500;
    
    /** {@see ExceptionMessages::MissingEduAdminParam} */   
    const MissingEduAdminParam = 500;
    /** {@see ExceptionMessages::MissingEduAdminValue} */   
    const MissingEduAdminValue = 500;
    /** {@see ExceptionMessages::InvalidEduAdminValue} */   
    const InvalidEduAdminValue = 500;
    /** {@see ExceptionMessages::InvalidEduAdminType} */   
    const InvalidEduAdminType = 500;
    /** {@see ExceptionMessages::InvalidEduAdminArray} */   
    const InvalidEduAdminArray = 500;

    /** {@see ExceptionMessages::MissingEduAdminCodeParam} */   
    const MissingEduAdminCodeParam = 500;
    /** {@see ExceptionMessages::MissingEduAdminCodeValue} */   
    const MissingEduAdminCodeValue = 500;
    /** {@see ExceptionMessages::InvalidEduAdminCodeType} */   
    const InvalidEduAdminCodeType = 500;
    /** {@see ExceptionMessages::InvalidEduAdminCodeArray} */   
    const InvalidEduAdminCodeArray = 500;
    
    /** {@see ExceptionMessages::MissingEduAdminNameParam} */ 
    const MissingEduAdminNameParam = 500;
    /** {@see ExceptionMessages::MissingEduAdminNameValue} */ 
    const MissingEduAdminNameValue = 500;
    /** {@see ExceptionMessages::InvalidEduAdminNameType} */ 
    const InvalidEduAdminNameType = 500;
    /** {@see ExceptionMessages::InvalidEduAdminNameArray} */ 
    const InvalidEduAdminNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedEduAdminValue} */   
    const DuplicatedEduAdminValue = 500;
    /** {@see ExceptionMessages::UsedEduAdminBySchoolUnits} */   
    const UsedEduAdminBySchoolUnits =500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const UsedEduAdminByTransferAreas = 500;
  
        //sync
        const DuplicateEduAdminUniqueValue = 500;
        const DuplicateSyncEduAdminNameValue = 500;
        const DuplicateSyncEduAdminCodeValue = 500;
        const SuccessSyncEduAdminsRecord = 500;
        const SuccessSyncUpdateEduAdminsRecord = 500;
        const FailureSyncEduAdminsRecord = 500;
    
//= TransferAreas

    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const MissingTransferAreaIDParam = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const MissingTransferAreaIDValue = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const InvalidTransferAreaIDType = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const InvalidTransferAreaIDArray = 500;
    
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const MissingTransferAreaParam = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const MissingTransferAreaValue = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const InvalidTransferAreaValue = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const InvalidTransferAreaType = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const InvalidTransferAreaArray = 500;
   
    /** {@see ExceptionMessages::MissingTransferAreaNameParam} */  
    const MissingTransferAreaNameParam = 500;
    /** {@see ExceptionMessages::MissingTransferAreaNameValue} */  
    const MissingTransferAreaNameValue = 500;
    /** {@see ExceptionMessages::InvalidTransferAreaNameType} */  
    const InvalidTransferAreaNameType = 500;
    /** {@see ExceptionMessages::InvalidTransferAreaNameArray} */  
    const InvalidTransferAreaNameArray = 500;
    
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const DuplicatedTransferAreaValue = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const UsedTransferAreaBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const UsedTransferAreaByMunicipalities = 500;

        //sync
        const DuplicateTransferAreaUniqueValue = 500;
        const DuplicateSyncTransferAreaNameValue = 500;
        const SuccessSyncTransferAreasRecord = 500;
        const SuccessSyncUpdateTransferAreasRecord = 500;
        const FailureSyncTransferAreasRecord = 500;
        
//= Municipalities

    /** {@see ExceptionMessages::MissingMunicipalityIDParam} */   
    const MissingMunicipalityIDParam = 500;
    /** {@see ExceptionMessages::MissingMunicipalityIDValue} */   
    const MissingMunicipalityIDValue = 500;
    /** {@see ExceptionMessages::InvalidMunicipalityIDType} */   
    const InvalidMunicipalityIDType = 500;
    /** {@see ExceptionMessages::InvalidMunicipalityIDArray} */   
    const InvalidMunicipalityIDArray = 500;
    
    /** {@see ExceptionMessages::MissingMunicipalityParam} */   
    const MissingMunicipalityParam = 500;
    /** {@see ExceptionMessages::MissingMunicipalityValue} */   
    const MissingMunicipalityValue = 500;
    /** {@see ExceptionMessages::InvalidMunicipalityValue} */   
    const InvalidMunicipalityValue = 500;
    /** {@see ExceptionMessages::InvalidMunicipalityType} */   
    const InvalidMunicipalityType = 500;
    /** {@see ExceptionMessages::InvalidMunicipalityArray} */   
    const InvalidMunicipalityArray = 500;
  
    /** {@see ExceptionMessages::MissingMunicipalityNameParam} */   
    const MissingMunicipalityNameParam = 500;
    /** {@see ExceptionMessages::MissingMunicipalityNameValue} */   
    const MissingMunicipalityNameValue = 500;
    /** {@see ExceptionMessages::InvalidMunicipalityNameType} */   
    const InvalidMunicipalityNameType = 500;
    /** {@see ExceptionMessages::InvalidMunicipalityNameArray} */   
    const InvalidMunicipalityNameArray = 500;  

    /** {@see ExceptionMessages::DuplicatedMunicipalityValue} */   
    const DuplicatedMunicipalityValue = 500;
    /** {@see ExceptionMessages::UsedMunicipalityBySchoolUnits} */   
    const UsedMunicipalityBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedMunicipalityByPrefectures} */   
    const UsedMunicipalityByPrefectures = 500;
    
        //sync
        const DuplicateMunicipalityUniqueValue = 500;
        const DuplicateSyncMunicipalitiesNameValue = 500;
        const SuccessSyncMunicipalitiesRecord = 500;
        const SuccessSyncUpdateMunicipalitiesRecord = 500;
        const FailureSyncMunicipalitiesRecord = 500;
    
//= Prefectures
    
    /** {@see ExceptionMessages::MissingPrefectureIDParam} */   
    const MissingPrefectureIDParam = 500;
    /** {@see ExceptionMessages::MissingPrefectureIDValue} */   
    const MissingPrefectureIDValue = 500;
    /** {@see ExceptionMessages::InvalidPrefectureIDType} */   
    const InvalidPrefectureIDType = 500;
    /** {@see ExceptionMessages::InvalidPrefectureIDArray} */   
    const InvalidPrefectureIDArray = 500;
    
    /** {@see ExceptionMessages::MissingPrefectureParam} */   
    const MissingPrefectureParam = 500;
    /** {@see ExceptionMessages::MissingPrefectureValue} */   
    const MissingPrefectureValue = 500;
    /** {@see ExceptionMessages::InvalidPrefectureValue} */   
    const InvalidPrefectureValue = 500;
    /** {@see ExceptionMessages::InvalidPrefectureType} */   
    const InvalidPrefectureType = 500;
    /** {@see ExceptionMessages::InvalidPrefectureArray} */   
    const InvalidPrefectureArray = 500;
  
    /** {@see ExceptionMessages::MissingPrefectureNameParam} */  
    const MissingPrefectureNameParam = 500;
    /** {@see ExceptionMessages::MissingPrefectureNameValue} */  
    const MissingPrefectureNameValue = 500;
    /** {@see ExceptionMessages::InvalidPrefectureNameType} */  
    const InvalidPrefectureNameType = 500;
    /** {@see ExceptionMessages::InvalidPrefectureNameArray} */  
    const InvalidPrefectureNameArray = 500;  

    /** {@see ExceptionMessages::DuplicatedPrefectureValue} */   
    const DuplicatedPrefectureValue = 500;
    /** {@see ExceptionMessages::UsedPrefectureBySchoolUnits} */   
    const UsedPrefectureBySchoolUnits = 500;

        //sync
        const DuplicatePrefectureUniqueValue = 500;
        const DuplicateSyncPrefecturesNameValue = 500;
        const SuccessSyncPrefecturesRecord = 500;
        const SuccessSyncUpdatePrefecturesRecord = 500;
        const FailureSyncPrefecturesRecord = 500;
    
//= EducationLevels
    
    /** {@see ExceptionMessages::MissingEducationLevelIDParam} */   
    const MissingEducationLevelIDParam = 500;
    /** {@see ExceptionMessages::MissingEducationLevelIDValue} */   
    const MissingEducationLevelIDValue = 500;
    /** {@see ExceptionMessages::InvalidEducationLevelIDType} */   
    const InvalidEducationLevelIDType = 500;
    /** {@see ExceptionMessages::InvalidEducationLevelIDArray} */   
    const InvalidEducationLevelIDArray = 500;
    
    /** {@see ExceptionMessages::MissingEducationLevelParam} */    
    const MissingEducationLevelParam = 500;
    /** {@see ExceptionMessages::MissingEducationLevelValue} */   
    const MissingEducationLevelValue = 500;
    /** {@see ExceptionMessages::InvalidEducationLevelValue} */   
    const InvalidEducationLevelValue = 500;
    /** {@see ExceptionMessages::InvalidEducationLevelType} */   
    const InvalidEducationLevelType = 500;
    /** {@see ExceptionMessages::InvalidEducationLevelArray} */   
    const InvalidEducationLevelArray = 500;
    
    /** {@see ExceptionMessages::MissingEducationLevelNameParam} */   
    const MissingEducationLevelNameParam = 500;
    /** {@see ExceptionMessages::MissingEducationLevelNameValue} */   
    const MissingEducationLevelNameValue = 500;
    /** {@see ExceptionMessages::InvalidEducationLevelNameType} */   
    const InvalidEducationLevelNameType = 500;
    /** {@see ExceptionMessages::InvalidEducationLevelNameArray} */   
    const InvalidEducationLevelNameArray = 500;  
    
    /** {@see ExceptionMessages::DuplicatedEducationLevelValue} */   
    const DuplicatedEducationLevelValue = 500;
    /** {@see ExceptionMessages::UsedEducationLevelBySchoolUnits} */   
    const UsedEducationLevelBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedEducationLevelBySchoolUnitTYpes} */   
    const UsedEducationLevelBySchoolUnitTYpes = 500;
    
        //sync
        const DuplicateEducationLevelUniqueValue = 500;
        const DuplicateSyncEducationLevelsNameValue = 500;
        const SuccessSyncEducationLevelsRecord = 500;
        const SuccessSyncUpdateEducationLevelsRecord = 500;
        const FailureSyncEducationLevelsRecord = 500;
    
//= SchoolUnitTypes
    
    /** {@see ExceptionMessages::MissingSchoolUnitTypeIDParam} */   
    const MissingSchoolUnitTypeIDParam = 500;
    /** {@see ExceptionMessages::MissingSchoolUnitTypeIDValue} */   
    const MissingSchoolUnitTypeIDValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitTypeIDType} */   
    const InvalidSchoolUnitTypeIDType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitTypeIDArray} */   
    const InvalidSchoolUnitTypeIDArray = 500;
    
    /** {@see ExceptionMessages::MissingSchoolUnitTypeParam} */   
    const MissingSchoolUnitTypeParam = 500;
    /** {@see ExceptionMessages::MissingSchoolUnitTypeValue} */   
    const MissingSchoolUnitTypeValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitTypeValue} */   
    const InvalidSchoolUnitTypeValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitTypeType */   
    const InvalidSchoolUnitTypeType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitTypeArray} */   
    const InvalidSchoolUnitTypeArray = 500; 
    
    /** {@see ExceptionMessages::MissingSchoolUnitTypeNameParam} */   
    const MissingSchoolUnitTypeNameParam = 500;
    /** {@see ExceptionMessages::MissingSchoolUnitTypeNameValue} */   
    const MissingSchoolUnitTypeNameValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitTypeNameType} */   
    const InvalidSchoolUnitTypeNameType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitTypeNameArray} */   
    const InvalidSchoolUnitTypeNameArray = 500;
    
    /** {@see ExceptionMessages::MissingSchoolUnitTypeInitialParam} */   
    const MissingSchoolUnitTypeInitialParam = 500;
    /** {@see ExceptionMessages::MissingSchoolUnitTypeInitialValue} */   
    const MissingSchoolUnitTypeInitialValue = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitTypeInitialType} */   
    const InvalidSchoolUnitTypeInitialType = 500;
    /** {@see ExceptionMessages::InvalidSchoolUnitTypeInitialArray} */   
    const InvalidSchoolUnitTypeInitialArray = 500;
  
    /** {@see ExceptionMessages::DuplicatedSchoolUnitTypeValue} */   
    const DuplicatedSchoolUnitTypeValue = 500;
    /** {@see ExceptionMessages::DuplicatedSchoolUnitTypeNameValue} */   
    const DuplicatedSchoolUnitTypeNameValue = 500;
    /** {@see ExceptionMessages::DuplicatedSchoolUnitTypeInitialValue} */   
    const DuplicatedSchoolUnitTypeInitialValue = 500;
    /** {@see ExceptionMessages::UsedSchoolUnitTypeBySchoolUnits} */   
    const UsedSchoolUnitTypeBySchoolUnits = 500;

        //sync
        const DuplicateSchoolUnitTypeUniqueValue = 500;
        const DuplicateSyncSchoolUnitTypesNameValue = 500;
        const DuplicateSyncSchoolUnitTypesInitialsValue = 500;
        const SuccessSyncSchoolUnitTypesRecord = 500;
        const SuccessSyncUpdateSchoolUnitTypesRecord = 500;
        const FailureSyncSchoolUnitTypesRecord = 500;
    
//= States
    
    /** {@see ExceptionMessages::MissingStateIDParam} */   
    const MissingStateIDParam = 500;
    /** {@see ExceptionMessages::MissingStateIDValue} */   
    const MissingStateIDValue = 500;
    /** {@see ExceptionMessages::InvalidStateIDType} */   
    const InvalidStateIDType = 500;
    /** {@see ExceptionMessages::InvalidStateIDArray} */   
    const InvalidStateIDArray = 500;
    
    /** {@see ExceptionMessages::MissingStateParam} */   
    const MissingStateParam = 500;
    /** {@see ExceptionMessages::MissingStateValue} */   
    const MissingStateValue = 500;
    /** {@see ExceptionMessages::InvalidStateValue} */   
    const InvalidStateValue = 500;
    /** {@see ExceptionMessages::InvalidStateType} */   
    const InvalidStateType = 500;
    /** {@see ExceptionMessages::InvalidStateArray} */   
    const InvalidStateArray = 500;
    
    /** {@see ExceptionMessages::MissingStateNameParam} */   
    const MissingStateNameParam = 500;
    /** {@see ExceptionMessages::MissingStateNameValue} */ 
    const MissingStateNameValue = 500;
    /** {@see ExceptionMessages::InvalidStateNameType} */ 
    const InvalidStateNameType = 500;
    /** {@see ExceptionMessages::InvalidStateNameArray} */ 
    const InvalidStateNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedStateValue} */   
    const DuplicatedStateValue = 500;
    /** {@see ExceptionMessages::UsedStateBySchoolUnits} */   
    const UsedStateBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedStateBySchoolUnitTYpes} */   
    const UsedStateBySchoolUnitTYpes = 500;
    
        //sync
        const DuplicateStateUniqueValue = 500;   
        const DuplicateSyncStatesNameValue = 500;
        const SuccessSyncStatesRecord = 500;
        const SuccessSyncUpdateStatesRecord = 500;
        const FailureSyncStatesRecord = 500;
    
//= CircuitTypes
    
    /** {@see ExceptionMessages::MissingCircuitTypeIDParam} */  
    const MissingCircuitTypeIDParam = 500;
    /** {@see ExceptionMessages::MissingCircuitTypeIDValue} */  
    const MissingCircuitTypeIDValue = 500; 
    /** {@see ExceptionMessages::InvalidCircuitTypeIDType} */  
    const InvalidCircuitTypeIDType = 500;
    /** {@see ExceptionMessages::InvalidCircuitTypeIDArray} */  
    const InvalidCircuitTypeIDArray = 500;
    
    /** {@see ExceptionMessages::MissingCircuitTypeParam} */
    const MissingCircuitTypeParam = 500;
    /** {@see ExceptionMessages::MissingCircuitTypeValue} */  
    const MissingCircuitTypeValue = 500;
    /** {@see ExceptionMessages::InvalidCircuitTypeValue} */  
    const InvalidCircuitTypeValue = 500;
    /** {@see ExceptionMessages::InvalidCircuitTypeType} */  
    const InvalidCircuitTypeType = 500;
    /** {@see ExceptionMessages::InvalidCircuitTypeArray} */  
    const InvalidCircuitTypeArray = 500; 
  
    /** {@see ExceptionMessages::MissingCircuitTypeNameParam} */  
    const MissingCircuitTypeNameParam = 500; 
    /** {@see ExceptionMessages::MissingCircuitTypeNameValue} */  
    const MissingCircuitTypeNameValue = 500; 
    /** {@see ExceptionMessages::InvalidCircuitTypeNameType} */  
    const InvalidCircuitTypeNameType = 500; 
    /** {@see ExceptionMessages::InvalidCircuitTypeNameArray} */  
    const InvalidCircuitTypeNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedCircuitTypeValue} */  
    const DuplicatedCircuitTypeValue = 500;
    /** {@see ExceptionMessages::UsedCircuitTypeByCircuits} */  
    const UsedCircuitTypeByCircuits = 500;
    
        //sync
        const DuplicateCircuitTypeUniqueValue = 500;
        const DuplicateSyncCircuitTypesNameValue = 500;
        const SuccessSyncCircuitTypesRecord = 500;
        const SuccessSyncUpdateCircuitTypesRecord = 500;
        const FailureSyncCircuitTypesRecord = 500;
    
//= RelationTypes
    
    /** {@see ExceptionMessages::MissingRelationTypeIDParam} */  
    const MissingRelationTypeIDParam = 500;
    /** {@see ExceptionMessages::MissingRelationTypeIDValue} */  
    const MissingRelationTypeIDValue = 500;
    /** {@see ExceptionMessages::InvalidRelationTypeIDType} */  
    const InvalidRelationTypeIDType = 500;
    /** {@see ExceptionMessages::InvalidRelationTypeIDArray} */  
    const InvalidRelationTypeIDArray = 500;
    
    /** {@see ExceptionMessages::MissingRelationTypeParam} */  
    const MissingRelationTypeParam = 500;
    /** {@see ExceptionMessages::MissingRelationTypeValue} */  
    const MissingRelationTypeValue = 500;
    /** {@see ExceptionMessages::InvalidRelationTypeValue} */  
    const InvalidRelationTypeValue = 500;
    /** {@see ExceptionMessages::InvalidRelationTypeType} */  
    const InvalidRelationTypeType = 500;
    /** {@see ExceptionMessages::InvalidRelationTypeArray} */  
    const InvalidRelationTypeArray = 500;
  
    /** {@see ExceptionMessages::MissingRelationTypeNameParam} */  
    const MissingRelationTypeNameParam = 500;
    /** {@see ExceptionMessages::MissingRelationTypeNameValue} */  
    const MissingRelationTypeNameValue = 500;
    /** {@see ExceptionMessages::InvalidRelationTypeNameType} */  
    const InvalidRelationTypeNameType = 500;
    /** {@see ExceptionMessages::InvalidRelationTypeNameArray} */  
    const InvalidRelationTypeNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedRelationTypeValue} */  
    const DuplicatedRelationTypeValue = 500;
    /** {@see ExceptionMessages::DuplicateRelationTypeUniqueValue} */     
    const DuplicateRelationTypeUniqueValue = 500;
    /** {@see ExceptionMessages::UsedRelationTypeByLabRelations} */  
    const UsedRelationTypeByLabRelations = 500;
    
       //delete
        const DuplicateDelRelationTypeValue = 500;
        const NotFoundDelRelationTypeValue = 500;

        //references
        const ReferencesRelationTypeLabRelationTypes = 500;
     
//= WorkerPositions
    
    /** {@see ExceptionMessages::MissingWorkerPositionIDParam} */  
    const MissingWorkerPositionIDParam = 500;
    /** {@see ExceptionMessages::MissingWorkerPositionIDValue} */  
    const MissingWorkerPositionIDValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerPositionIDType} */  
    const InvalidWorkerPositionIDType = 500;
    /** {@see ExceptionMessages::InvalidWorkerPositionIDArray} */  
    const InvalidWorkerPositionIDArray = 500;
    
    /** {@see ExceptionMessages::MissingWorkerPositionParam} */  
    const MissingWorkerPositionParam = 500;
    /** {@see ExceptionMessages::MissingWorkerPositionValue} */  
    const MissingWorkerPositionValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerPositionValue} */  
    const InvalidWorkerPositionValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerPositionType} */  
    const InvalidWorkerPositionType = 500;
    /** {@see ExceptionMessages::InvalidWorkerPositionArray} */  
    const InvalidWorkerPositionArray = 500;
    
    /** {@see ExceptionMessages::MissingWorkerPositionNameParam} */  
    const MissingWorkerPositionNameParam = 500;
    /** {@see ExceptionMessages::MissingWorkerPositionNameValue} */  
    const MissingWorkerPositionNameValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerPositionNameType} */  
    const InvalidWorkerPositionNameType = 500;
    /** {@see ExceptionMessages::InvalidWorkerPositionNameArray} */  
    const InvalidWorkerPositionNameArray = 500; 

    /** {@see ExceptionMessages::DuplicatedWorkerPositionValue} */  
    const DuplicatedWorkerPositionValue = 500;
    /** {@see ExceptionMessages::UsedWorkerPositionBySchoolUnitWorkers} */  
    const UsedWorkerPositionBySchoolUnitWorkers = 500;
    /** {@see ExceptionMessages::UsedWorkerPositionByLabWorkers} */  
    const UsedWorkerPositionByLabWorkers = 500;
    
        //sync
        const DuplicateWorkerPositionUniqueValue = 500;
        const DuplicateSyncWorkerPositionsNameValue = 500;
        const SuccessSyncWorkerPositionsRecord = 500;
        const SuccessSyncUpdateWorkerPositionsRecord = 500;
        const FailureSyncWorkerPositionsRecord = 500;
    
//= WorkerSpecializations
    
    /** {@see ExceptionMessages::MissingWorkerSpecializationIDParam} */  
    const MissingWorkerSpecializationIDParam = 500;
    /** {@see ExceptionMessages::MissingWorkerSpecializationIDValue} */  
    const MissingWorkerSpecializationIDValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerSpecializationIDType} */  
    const InvalidWorkerSpecializationIDType = 500;
    /** {@see ExceptionMessages::InvalidWorkerSpecializationIDArray} */  
    const InvalidWorkerSpecializationIDArray = 500;
    
    /** {@see ExceptionMessages::MissingWorkerSpecializationParam} */  
    const MissingWorkerSpecializationParam = 500;
    /** {@see ExceptionMessages::MissingWorkerSpecializationValue} */  
    const MissingWorkerSpecializationValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerSpecializationValue} */  
    const InvalidWorkerSpecializationValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerSpecializationType} */  
    const InvalidWorkerSpecializationType = 500;
    /** {@see ExceptionMessages::InvalidWorkerSpecializationArray} */  
    const InvalidWorkerSpecializationArray = 500;
 
    /** {@see ExceptionMessages::MissingWorkerSpecializationNameParam} */  
    const MissingWorkerSpecializationNameParam = 500;
    /** {@see ExceptionMessages::MissingWorkerSpecializationNameValue} */  
    const MissingWorkerSpecializationNameValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerSpecializationNameType} */  
    const InvalidWorkerSpecializationNameType = 500;
    /** {@see ExceptionMessages::InvalidWorkerSpecializationNameArray} */  
    const InvalidWorkerSpecializationNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedWorkerSpecializationValue} */  
    const DuplicatedWorkerSpecializationValue = 500;
    /** {@see ExceptionMessages::UsedWorkerSpecializationBySchoolUnitWorkers} */  
    const UsedWorkerSpecializationBySchoolUnitWorkers = 500;
    /** {@see ExceptionMessages::UsedWorkerSpecializationByLabWorkers} */  
    const UsedWorkerSpecializationByLabWorkers = 500;
    
        //sync
        const DuplicateWorkerSpecializationUniqueValue = 500;
        const DuplicateSyncWorkerSpecializationsNameValue = 500;
        const SuccessSyncWorkerSpecializationsRecord = 500;
        const SuccessSyncUpdateWorkerSpecializationsRecord = 500;
        const FailureSyncWorkerSpecializationsRecord = 500;
    
    //Sources

    /** {@see ExceptionMessages::MissingSourceIDParam} */  
    const MissingSourceIDParam = 500;
    /** {@see ExceptionMessages::MissingSourceIDValue} */  
    const MissingSourceIDValue = 500;
    /** {@see ExceptionMessages::InvalidSourceIDType} */  
    const InvalidSourceIDType = 500;
    /** {@see ExceptionMessages::InvalidSourceIDArray} */  
    const InvalidSourceIDArray = 500;
    
    /** {@see ExceptionMessages::MissingSourceParam} */  
    const MissingSourceParam = 500;
    /** {@see ExceptionMessages::MissingSourceValue} */  
    const MissingSourceValue = 500;
    /** {@see ExceptionMessages::InvalidSourceValue} */  
    const InvalidSourceValue = 500;
    /** {@see ExceptionMessages::InvalidSourceType} */  
    const InvalidSourceType = 500;
    /** {@see ExceptionMessages::InvalidSourceArray} */  
    const InvalidSourceArray = 500;

    /** {@see ExceptionMessages::MissingSourceNameParam} */  
    const MissingSourceNameParam = 500;
    /** {@see ExceptionMessages::MissingSourceNameValue} */  
    const MissingSourceNameValue = 500;
    /** {@see ExceptionMessages::InvalidSourceNameType} */  
    const InvalidSourceNameType = 500;
    /** {@see ExceptionMessages::InvalidSourceNameArray} */  
    const InvalidSourceNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedSourceValue} */  
    const DuplicatedSourceValue = 500;
    /** {@see ExceptionMessages::UsedSourceByWorkers} */  
    const UsedSourceByWorkers = 500;
    
        //sync
        const DuplicateSourceUniqueValue = 500;
        const DuplicateSyncSourcesNameValue = 500;
        const SuccessSyncSourcesRecord = 500;
        const SuccessSyncUpdateSourcesRecord = 500;
        const FailureSyncSourcesRecord = 500;   
    
//= LabTypes

    /** {@see ExceptionMessages::MissingLabTypeIDParam} */  
    const MissingLabTypeIDParam = 500;
    /** {@see ExceptionMessages::MissingLabTypeIDValue} */  
    const MissingLabTypeIDValue = 500;
    /** {@see ExceptionMessages::InvalidLabTypeIDType} */  
    const InvalidLabTypeIDType = 500;
    /** {@see ExceptionMessages::InvalidLabTypeIDArray} */  
    const InvalidLabTypeIDArray = 500;
    
    /** {@see ExceptionMessages::MissingLabTypeParam} */  
    const MissingLabTypeParam = 500;
    /** {@see ExceptionMessages::MissingLabTypeValue} */  
    const MissingLabTypeValue = 500;
    /** {@see ExceptionMessages::InvalidLabTypeValue} */  
    const InvalidLabTypeValue = 500;
    /** {@see ExceptionMessages::InvalidLabTypeType} */  
    const InvalidLabTypeType = 500;
    /** {@see ExceptionMessages::InvalidLabTypeArray} */  
    const InvalidLabTypeArray = 500;
    
    /** {@see ExceptionMessages::MissingLabTypeNameParam} */  
    const MissingLabTypeNameParam = 500;
    /** {@see ExceptionMessages::MissingLabTypeNameValue} */  
    const MissingLabTypeNameValue = 500;
    /** {@see ExceptionMessages::InvalidLabTypeNameType} */  
    const InvalidLabTypeNameType = 500;
    /** {@see ExceptionMessages::InvalidLabTypeNameArray} */  
    const InvalidLabTypeNameArray = 500;
    
    /** {@see ExceptionMessages::MissingLabTypeFullNameParam} */  
    const MissingLabTypeFullNameParam = 500;
    /** {@see ExceptionMessages::MissingLabTypeFullNameValue} */  
    const MissingLabTypeFullNameValue = 500;
    /** {@see ExceptionMessages::InvalidLabTypeFullNameType} */  
    const InvalidLabTypeFullNameType = 500;
    /** {@see ExceptionMessages::InvalidLabTypeFullNameArray} */  
    const InvalidLabTypeFullNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedLabTypeValue} */  
    const DuplicatedLabTypeValue = 500;
    /** {@see ExceptionMessages::DuplicateLabTypeUniqueValue} */  
    const DuplicateLabTypeUniqueValue = 500;
    /** {@see ExceptionMessages::UsedLabTypeByLabs} */  
    const UsedLabTypeByLabs = 500;

        //delete
        const DuplicateDelLabTypeValue = 500;
        const NotFoundDelLabTypeValue = 500;

        //references
        const ReferencesLabTypeLabs = 500;
 
    
//= LabSources

    /** {@see ExceptionMessages::MissingLabSourceIDParam} */  
    const MissingLabSourceIDParam = 500;
    /** {@see ExceptionMessages::MissingLabSourceIDValue} */  
    const MissingLabSourceIDValue = 500;
    /** {@see ExceptionMessages::InvalidLabSourceIDType} */  
    const InvalidLabSourceIDType = 500;
    /** {@see ExceptionMessages::InvalidLabSourceIDArray} */  
    const InvalidLabSourceIDArray = 500;
    
    /** {@see ExceptionMessages::MissingLabSourceParam} */  
    const MissingLabSourceParam = 500;
    /** {@see ExceptionMessages::MissingLabSourceValue} */  
    const MissingLabSourceValue = 500;
    /** {@see ExceptionMessages::InvalidLabSourceValue} */  
    const InvalidLabSourceValue = 500;
    /** {@see ExceptionMessages::InvalidLabSourceType} */  
    const InvalidLabSourceType = 500;
    /** {@see ExceptionMessages::InvalidLabSourceArray} */  
    const InvalidLabSourceArray = 500;

    /** {@see ExceptionMessages::MissingLabSourceNameParam} */  
    const MissingLabSourceNameParam = 500;
    /** {@see ExceptionMessages::MissingLabSourceNameValue} */  
    const MissingLabSourceNameValue = 500;
    /** {@see ExceptionMessages::InvalidLabSourceNameType} */  
    const InvalidLabSourceNameType = 500;
    /** {@see ExceptionMessages::InvalidLabSourceNameArray} */  
    const InvalidLabSourceNameArray = 500;
    
    /** {@see ExceptionMessages::MissingLabSourceInfosParam} */  
    const MissingLabSourceInfosParam = 500;
    /** {@see ExceptionMessages::MissingLabSourceInfosValue} */  
    const MissingLabSourceInfosValue = 500;
    /** {@see ExceptionMessages::InvalidLabSourceInfosType} */  
    const InvalidLabSourceInfosType = 500;
    /** {@see ExceptionMessages::InvalidLabSourceInfosArray} */  
    const InvalidLabSourceInfosArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedLabSourceValue} */  
    const DuplicatedLabSourceValue = 500;
    /** {@see ExceptionMessages::DuplicateLabSourceUniqueValue} */  
    const DuplicateLabSourceUniqueValue = 500;
    /** {@see ExceptionMessages::UsedLabSourceByLabs} */  
    const UsedLabSourceByLabs = 500;
 
        //delete
        const DuplicateDelLabSourceValue = 500; 
        const NotFoundDelLabSourceValue = 500;

        //references
        const ReferencesLabSourceLabs = 500;
        const ReferencesLabSourceMyLabWorkers = 500;
        
//= EquipmentCategories
    
    /** {@see ExceptionMessages::MissingEquipmentCategoryIDParam} */  
    const MissingEquipmentCategoryIDParam = 500;
    /** {@see ExceptionMessages::MissingEquipmentCategoryIDValue} */  
    const MissingEquipmentCategoryIDValue = 500;
    /** {@see ExceptionMessages::InvalidEquipmentCategoryIDType} */  
    const InvalidEquipmentCategoryIDType = 500;
    /** {@see ExceptionMessages::InvalidEquipmentCategoryIDArray} */  
    const InvalidEquipmentCategoryIDArray = 500;
    
    /** {@see ExceptionMessages::MissingEquipmentCategoryParam} */  
    const MissingEquipmentCategoryParam = 500;
    /** {@see ExceptionMessages::MissingEquipmentCategoryValue} */  
    const MissingEquipmentCategoryValue = 500;
    /** {@see ExceptionMessages::InvalidEquipmentCategoryValue} */  
    const InvalidEquipmentCategoryValue = 500;
    /** {@see ExceptionMessages::InvalidEquipmentCategoryType} */  
    const InvalidEquipmentCategoryType = 500;
    /** {@see ExceptionMessages::InvalidEquipmentCategoryArray} */  
    const InvalidEquipmentCategoryArray = 500;
    
    /** {@see ExceptionMessages::MissingEquipmentCategoryNameParam} */  
    const MissingEquipmentCategoryNameParam = 500;
    /** {@see ExceptionMessages::MissingEquipmentCategoryNameValue} */  
    const MissingEquipmentCategoryNameValue = 500;
    /** {@see ExceptionMessages::InvalidEquipmentCategoryNameType} */  
    const InvalidEquipmentCategoryNameType = 500;
    /** {@see ExceptionMessages::InvalidEquipmentCategoryNameArray} */  
    const InvalidEquipmentCategoryNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedEquipmentCategoryValue} */  
    const DuplicatedEquipmentCategoryValue = 500;
    /** {@see ExceptionMessages::DuplicateEquipmentCategoryUniqueValue} */  
    const DuplicateEquipmentCategoryUniqueValue = 500;
    /** {@see ExceptionMessages::UsedEquipmentCategoryByEquipmentTypes} */  
    const UsedEquipmentCategoryByEquipmentTypes = 500;
    
        //delete
        const DuplicateDelEquipmentCategoryValue = 500;
        const NotFoundDelEquipmentCategoryValue = 500;

        //references
        const ReferencesEquipmentCategoryEquipmentTypes = 500;
    
    
//= EquipmentTypes
    
    /** {@see ExceptionMessages::MissingEquipmentTypeIDParam} */  
    const MissingEquipmentTypeIDParam = 500;
    /** {@see ExceptionMessages::MissingEquipmentTypeIDValue} */  
    const MissingEquipmentTypeIDValue = 500;
    /** {@see ExceptionMessages::InvalidEquipmentTypeIDType} */  
    const InvalidEquipmentTypeIDType = 500;
    /** {@see ExceptionMessages::InvalidEquipmentTypeIDArray} */  
    const InvalidEquipmentTypeIDArray = 500;

    /** {@see ExceptionMessages::MissingEquipmentTypeParam} */  
    const MissingEquipmentTypeParam = 500;
    /** {@see ExceptionMessages::MissingEquipmentTypeValue} */  
    const MissingEquipmentTypeValue = 500;
    /** {@see ExceptionMessages::InvalidEquipmentTypeValue} */  
    const InvalidEquipmentTypeValue = 500;
    /** {@see ExceptionMessages::InvalidEquipmentTypeType} */  
    const InvalidEquipmentTypeType = 500;
    /** {@see ExceptionMessages::InvalidEquipmentTypeArray} */  
    const InvalidEquipmentTypeArray = 500;
 
    /** {@see ExceptionMessages::MissingEquipmentTypeNameParam} */  
    const MissingEquipmentTypeNameParam = 500;
    /** {@see ExceptionMessages::MissingEquipmentTypeNameValue} */  
    const MissingEquipmentTypeNameValue = 500;
    /** {@see ExceptionMessages::InvalidEquipmentTypeNameType} */  
    const InvalidEquipmentTypeNameType = 500;
    /** {@see ExceptionMessages::InvalidEquipmentTypeNameArray} */  
    const InvalidEquipmentTypeNameArray = 500;
    
    /** {@see ExceptionMessages::DuplicatedEquipmentTypeValue} */  
    const DuplicatedEquipmentTypeValue = 500;
    /** {@see ExceptionMessages::DuplicateEquipmentTypeUniqueValue} */  
    const DuplicateEquipmentTypeUniqueValue = 500;
    /** {@see ExceptionMessages::UsedEquipmentTypeByLabEquipmentTypes} */  
    const UsedEquipmentTypeByLabEquipmentTypes = 500;
    
        //delete
        const DuplicateDelEquipmentTypeValue = 500;
        const NotFoundDelEquipmentTypeValue = 500;

        //references
        const ReferencesEquipmentTypeLabEquipmentTypes = 500;
    
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
    /** {@see ExceptionMessages::DuplicateAquisitionSourceUniqueValue} */  
    const DuplicateAquisitionSourceUniqueValue = 500;
    /** {@see ExceptionMessages::UsedAquisitionSourceSourceByLabAquisitionSources} */  
    const UsedAquisitionSourceByLabAquisitionSources = 500;
    
        //delete
        const DuplicateDelAquisitionSourceValue = 500; 
        const NotFoundDelAquisitionSourceValue = 500;

        //references
        const ReferencesAquisitionSourceLabAquisitionSources = 500;
    
    //page,pagesize,orderby,ordertype,searchtype
    
    /** {@see ExceptionMessages::MissingPageValue} */  
    const MissingPageValue = 500;
    /** {@see ExceptionMessages::InvalidPageNumber} */  
    const InvalidPageNumber = 500;
    /** {@see ExceptionMess/**ages::InvalidPageType} */  
    const InvalidPageType = 500;
    /** {@see ExceptionMessages::InvalidPageArray} */  
    const InvalidPageArray = 500;
   
    /** {@see ExceptionMessages::InvalidMaxPageNumber} */  
    const InvalidMaxPageNumber = 500;
    
    /** {@see ExceptionMessages::MissingPageSizeValue} */   
    const MissingPageSizeValue = 500;
    /** {@see ExceptionMessages::MissingPageSizeValue} */ 
    const MissingPageSizeNegativeValue = 500;
    /** {@see ExceptionMessages::InvalidPageSizeNumber} */ 
    const InvalidPageSizeNumber = 500;
    /** {@see ExceptionMessages::InvalidPageSizeType} */ 
    const InvalidPageSizeType = 500;
    /** {@see ExceptionMessages::InvalidPageSizeArray} */ 
    const InvalidPageSizeArray = 500;
    
    /** {@see ExceptionMessages::InvalidPageSizeArray} */ 
    const InvalidSearchType = 500;
    /** {@see ExceptionMessages::InvalidPageSizeArray} */ 
    const InvalidOrderType = 500;
    /** {@see ExceptionMessages::InvalidPageSizeArray} */ 
    const InvalidOrderBy = 500;
    
    
    
     //authentication roles 
    /** {@see ExceptionMessages::NoPermissionsError} */  
    const NoPermissionsError = 606;
    
    /** {@see ExceptionMessages::NotFoundUserPermissions} */      
    const NotFoundUserPermissions = 607;
    /** {@see ExceptionMessages::NotFoundFullSchoolUnitDnsName} */  
    const NotFoundFullSchoolUnitDnsName = 608;
    /** {@see ExceptionMessages::DuplicateFullSchoolUnitDnsName} */ 
    const DuplicateFullSchoolUnitDnsName = 609;
    /** {@see ExceptionMessages::MissingLdapLattribute} */  
    const MissingLdapLAttribute = 610;
    /** {@see ExceptionMessages::MissingLdapEmployeeNumberAttribute} */   
    const MissingLdapEmployeeNumberAttribute = 611;
    
    /** {@see ExceptionMessages::NoPermissionToPost} */   
    const NoPermissionToPostLab = 612;
    /** {@see ExceptionMessages::NoPermissionToPut} */   
    const NoPermissionToPutLab = 613;
    /** {@see ExceptionMessages::NoPermissionToDelete} */   
    const NoPermissionToDeleteLab = 614;
    /** {@see ExceptionMessages::NoPermissionToGet} */   
    const NoPermissionToGetLab = 615;
   
     //reports  
    /** {@see ExceptionMessages::ErrorEduAdminReportKeplhnet} */ 
    const ErrorEduAdminReportKeplhnet = 500;
    
}

?>