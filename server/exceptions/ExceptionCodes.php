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
        const UserNoRoleAccess = 500;
        const UserAccesDenied = 500;
        const UserAccesFrontDenied = 500;
        const UserAccesEmptyDenied = 500;
        const UserNoRolePermissions = 500;
        //const InvalidPageNumber = 500;
        //const InvalidPageType = 500;
        //const InvalidPageSizeNumber = 500;
        //const InvalidPageSizeType = 500;
        const InvalidSortModeType = 500;
        const InvalidSortFieldType = 500;
        const InvalidExport =500;
        const MethodNotFound = 500;
        const DeleteError = 500;
        const DeleteNotFoundAquisitionSources = 500;
        const DeleteNotFoundEquipmentTypes = 500;
        const DeleteNotFoundLabWorkers = 500;
        const DeleteNotFoundLabRelations = 500;
        const DeleteNotFoundLabTransitions = 500;
        
        const InsertMoreVariablesAquisitionSources = 500;
        const InsertMoreVariablesSchoolUnits = 500;
        const InsertMoreVariablesEquipmentTypes = 500;
        const InsertErrorFormatEquipmentTypes = 500;
        const InsertErrorFormatAquisitionSources = 500;
        const InsertErrorFormatRelationServedOnline =500;
        const InsertDuplicateAquisitionSources = 500;
        const InsertDuplicateEquipmentTypes = 500;
        const InsertDuplicateSchoolUnits =500;
 
        const Unauthorized = 500;
    // dictionary messages (not found)=====================================================================================================================
    

        const UnknownLabIdValue =500;
        const UnknownLabTypeValue =500;
        const UnknownLabSourceValue =500;
        const UnknownLabStateValue =500;
        const UnknownWorkerPositionValue =500;
        const UnknownLabWorkerIdValue = 500;
        const UnknownSchoolUnitValue = 500;
        const UnknownRelationTypeValue = 500;
        const UnknownCircuitIdValue = 500;
        const UnknownLabRelationIdValue = 500;
        const UnknownLabAquisitionSourceIdValue = 500;
        const UnknownLabTransitionIdValue = 500;
        const UnknownOperationalRatingValue = 500;
        const UnknownTechnologicalRatingValue = 500;
        const UnknowneEduAdminCodeValue = 500;
      
        const InvalidLabIdValue = 500;
        const InvalidMmIdValue = 500;
        const InvalidNameValue= 500;
        const InvalidCreationDateValue = 500;
        const InvalidCircuitPhoneNumberValue = 500;
        const InvalidSpecializationCodeValue = 500;
        const InvalidEmploymentRelationshipValue = 500;
        const InvalidNewAquisitionSourceValue = 500;
        const InvalidNewEquipmentTypeValue = 500;
        
        const NotFoundLabWorkerIDValue=500;
        const NotFoundLabRelationIDValue = 500;
        const NotFoundLabAquisitionSourceIdValue = 500;
        const NotFoundLabTransitionIDValue = 500;

    //missing values (POST/PUT)==================================================================================================================================
    
        const MissingNameValue = 500;
        const MissingInfoNameValue = 500;
        const InvalidSpecialNameValue = 500;
        const MissingCodeValue = 500;
        const InvalidCodeType = 500;
        const InvalidNumberType = 500;
        const MissingRegistryNumberValue = 500;
        const InvalidRegistryNumberValue = 500;
        const InvalidPhoneNumberValue = 500;
        const InvalidLastNameValue = 500;
        const MissingFirstNameValue = 500;
        const MissingLastNameValue = 500;
        const MissingFathernameValue  = 500;
        const MissingSexValue = 500;
        const InvalidSexValue = 500;
        const MissingStreetAddressValue = 500;
        const InvalidPostalCodeValue = 500;
        const MissingPostalCodeValue = 500;
        const MissingItemValue = 500;
        const InvalidItemValue = 500;
        const InvalidAquisitionYearValue = 500;
        const InvalidAquisitionYearValidValue = 500;
        const InvalidWorkerStartServiceValue  = 500;
        const InvalidWorkerStartServiceValidValue  = 500;
        const InvalidTransitionSourceValue = 500;
        const MissingTransitionDateValue =500;
        const MissingTransitionSourceValue = 500;
        const MissingTransitionJustificationValue = 500;
        const InvalidTransitionDateValue = 500;
        const InvalidTransitionDateValidValue = 500;
        const InvalidPositioningValue = 500;
        const InvalidCommentsValue = 500;
        const InvalidTransitionJustificationValue =500;
        const InvalidRelationServedServiceValue = 500;
        const InvalidRelationServedOnlineValue = 500;
        const InvalidAquisitionSourceInputValue = 500; 
        const InvalidEquipmentTypeInputValue = 500;
        const InvalidWorkerInputValue = 500;
        const MissingLabWorkerIdValue = 500;
        const InvalidLabWorkerIdValue = 500;
        const InvalidWorkerStatusValue = 500;
        const MissingAquisitionYearValue = 500;
        const InvalidUpdateWorkerStatusValue = 500;
        const MissingLabRelationIdValue  = 500;
        const InvalidLabRelationIdValue  = 500;
        const MissingLabAquisitionSourceIdValue = 500;
        const InvalidLabAquisitionSourceIdValue  = 500;
        const MissingLabStateValue = 500;
        const MissingLabTransitionIdValue  = 500;
        const InvalidLabTransitionIdValue  = 500; 
        const MissingOperationalRatingValue  =500;
        const InvalidOperationalRatingValue  =500;
        const MissingTechnologicalRatingValue  = 500;
        const InvalidTechnologicalRatingValue  = 500;
         
        const MissingWorkerStartServiceParam  = 500;
        const MissingWorkerStatusParam  = 500;
        const MissingEquipmentTypesParam = 500;
        const MissingItemsParam =500;
        const MissingAquisitionYearParam = 500;
        const MissingLabStateParam = 500;
        const MissingTransitionDateParam  = 500;
        const MissingTransitionSourceParam  =500;
        const MissingTransitionJustificationParam  =500;
        const MissingOperationalRatingParam  = 500;
        const MissingTechnologicalRatingParam  = 500;

        const InvalidLabTypeIdValue = 500;
        const MissingSpecializationCodeIdValue = 500;
        const InvalidSpecializationCodeIdValue = 500;
        const MissingEmploymentRelationshipIdValue = 500;
        const InvalidEmploymentRelationshipIdValue = 500;
        const InvalidAquisitionSourceIdValue = 500;
        const MissingNewAquisitionSourceIdValue = 500;
        const InvalidEquipmentTypeIdValue = 500;
        const MissingNewEquipmentTypeIdValue =500;
        const InvalidEquipmentCategoryIdValue = 500;
        const MissingLabResponsibleIdValue = 500;
        const InvalidLabResponsibleIdValue = 500;
        const MissingWorkerStartServiceValue = 500; 

        const InvalidSchoolUnitIdValue  = 500;
        const InvalidEducationLevelIdValue  = 500;
        const InvalidSchoolUnitTypeIdValue  =500;
        const InvalidRegionEduAdminIdValue  = 500;
        const InvalidEduAdminIdValue  = 500;
        const InvalidTransferAreaIdValue  = 500;
        const InvalidMunicipalityIdValue  = 500;
        const InvalidPrefectureIdValue  = 500;
        const InvalidFromDiscontinuedToStateIdValue = 500;
        const InvalidSameFromToStateValue = 500;
        const InvalidRelationTypeIdValue = 500;
        const InvalidCircuitIdValue = 500;
        const InvalidCircuitIdPhoneNumberValue =500;
        
    //not found values for create/update rows(PUT)================================================================================================================= 
   
        const UpdateLabIdValue = 500;
        const UpdateLabTypeIdValue = 500;
        const UpdateLabResponsibleIdValue =500;
        const UpdateSpecializationCodeIdValue = 500;
        const UpdateEmploymentRelationshipIdValue  = 500;
        const UpdateAquisitionSourceIdValue = 500;
        const UpdateEquipmentTypeIdValue = 500;
        const UpdateEquipmentCategoryIdValue = 500;
        const UpdateLabHasAquisitionSourceIdValue = 500;
        const UpdateLabHasEquipmentTypeIdValue = 500;
        const UpdateLabsIdValue = 500;
        const UpdateLabAquisitionSourcesValue = 500;
        const UpdateLabEquipmentTypesValue = 500;
        
        const UpdateSchoolUnitIdValue = 500;
        const UpdateSchoolUnitTypeIdValue = 500;
        const UpdateEducationLevelIdValue = 500;
        const UpdateRegionEduAdminIdValue = 500;
        const UpdatePrefectureIdValue = 500;
        const UpdateEduAdminIdValue = 500;
        const UpdateTransferAreaIdValue = 500;
        const UpdateMunicipalityIdValue = 500;
        
    //required fields(foreign keys) for create a new field (POST)==============================================================================================================
        
        const CreateLabTypeIdValue = 500;
        const CreateLabResponsibleIdValue = 500;
        const CreateSpecializationCodeIdValue = 500;
        const CreateEmploymentRelationshipIdValue = 500;
        const CreateAquisitionSourceIdValue = 500;   
        const CreateEquipmentTypeIdValue = 500;
        const CreateEquipmentCategoryIdValue = 500;
        const CreateStateIDValue = 500;
        const CreateToStateValue = 500;
        const CreateLabSourceIdValue = 500;
        
        const CreateSchoolUnitIdValue = 500;
        const CreateSchoolUnitTypeIdValue= 500;
        const CreateEducationLevelIdValue = 500;
        const CreateRegionEduAdminIdValue = 500;
        const CreateEduAdminIdValue = 500;
        const CreateTransferAreaIdValue = 500;
        const CreatePrefectureIdValue = 500;
        const CreateMunicipalityIdValue = 500;
       
    //warning about duplicate vocabulary values when create or update a field values(POST/PUT)=============================================================================================================================
        
        const DuplicateRegistryNumberValue = 500;
        const DuplicateLabWorkerValue = 500;
        const DuplicateLabTypeValue = 500;
        const DuplicateInfoLabTypeValue = 500;
        const DuplicateSpecializationCodeValue = 500;
        const DuplicateEmploymentRelationshipValue = 500;
        const DuplicateAquisitionSourceValue = 500;
        const DuplicateEquipmentTypeValue = 500;
        const DuplicateEquipmentCategoryValue = 500;
        const DuplicateLabHasAquisitionSourceValue = 500;
        const DuplicateLabHasEquipmentTypeValue = 500;
        const DuplicateRelationServedServiceValue =500;
        const DuplicateLabValue = 500;
        const DuplicateRelationServedOnlineValue =500;
        const DuplicateLabTransitionsValue =500;
        const DuplicateLabsValue = 500;
        const DuplicateUpdateLabWorkerValue = 500;
        const DuplicateLabAquisitionSourceValue = 500;
        const DuplicateLabEquipmentTypeValue = 500;
        const DuplicateLabRelationValue = 500;
        const DuplicateLabRelationServerOnlineValue = 500;
        const DuplicateLabTransitionValue = 500;
        
        const DuplicateSchoolUnitValue = 500;
        const DuplicateSchoolUnitTypeValue = 500;
        const DuplicateEducationLevelValue = 500;
        const DuplicateRegionEduAdminValue = 500;
        const DuplicateEduAdminValue = 500;
        const DuplicateTransferAreaValue = 500;
        const DuplicateMunicipalityValue = 500;
        const DuplicatePrefectureValue = 500;
    
    //found duplicated values into a vocabulary table. This is a very critical error.( POST/PUT)==========================================================================================================================
    
        const DuplicateLabsIdValue = 500;
        const DuplicateLabTypeIdValue = 500;
        const DuplicateWorkerIdValue = 500;
        const DuplicateSpecializationCodeIdValue= 500;
        const DuplicateEmploymentRelationshipIdValue = 500;
        const DuplicateAquisitionSourceIdValue = 500;
        const DuplicateEquipmentTypeIdValue = 500;
        const DuplicateEquipmentCategoryIdValue = 500;
        const DuplicateLabHasAquisitionSourceIdValue = 500;
        const DuplicateLabHasEquipmentTypeIdValue = 500;
        const DuplicateStateIdValue = 500;  
        const DuplicateLabSourceIdValue = 500;  
        const DuplicateWorkerPositionIdValue = 500;
        const DuplicateLabWorkerIdValue = 500;
        const DuplicateLabRelationIdValue = 500;
        const DuplicateLabAquisitionSourceIdValue = 500;
        const DuplicateLabTransitionIdValue = 500;

        const DuplicateSchoolUnitIdValue = 500;
        const DuplicateSchoolUnitTypeIdValue = 500;
        const DuplicateEducationLevelIdValue = 500;
        const DuplicateRegionEduAdminIdValue = 500;
        const DuplicateEduAdminIdValue = 500;
        const DuplicateTransferAreaIdValue = 500;
        const DuplicateMunicipalityIdValue = 500;
        const DuplicatePrefectureIdValue = 500;
        const DuplicateCircuitPhoneNumberValue = 500;
        const DuplicateRelationTypeIdValue = 500;
        const DuplicateCircuitValue = 500;
        
    //not found vocabulary value for delete rows(PUT)================================================================================================================= 
        
        const DeleteNotFoundLabNameValue = 500;
        const DeleteNotFoundLabTypeNameValue = 500;
        const DeleteNotFoundLabResponsibleRegistryNumberValue = 500;
        const DeleteNotFoundSpecializationCodeNameValue = 500;
        const DeleteNotFoundEmploymentRelationshipNameValue = 500;
        const DeleteNotFoundAquisitionSourceNameValue = 500;
        const DeleteNotFoundNewAquisitionSourceNameValue = 500;
        const DeleteNotFoundEquipmentTypeNameValue = 500;
        const DeleteNotFoundNewEquipmentTypeNameValue = 500;
        const DeleteNotFoundEquipmentCategoryNameValue = 500;
        const DeleteNotFoundLabHasAquisitionSourceLabIdValue = 500;
        const DeleteNotFoundLabHasEquipmentTypeLabIdValue = 500;
        const DeleteNotFoundLabHasAquisitionSourceValue = 500;
        const DeleteNotFoundLabHasEquipmentTypeValue = 500;
        
        
        const DeleteNotFoundSchoolUnitNameValue = 500;
        const DeleteNotFoundSchoolUnitTypeNameValue = 500;
        const DeleteNotFoundEducationLevelNameValue = 500;
        const DeleteNotFoundRegionEduAdminNameValue = 500;
        const DeleteNotFoundEduAdminNameValue = 500;
        const DeleteNotFoundTransferAreaNameValue = 500;
        const DeleteNotFoundPrefectureNameValue = 500;
        const DeleteNotFoundMunicipalityNameValue = 500;
        
    //required fields for delete fields==========================================================================================================================================
        const DeleteLabNameValue = 500;
        const DeleteLabResponsibleRegistryNumberValue = 500;
        const DeleteAquisitionNameValue = 500;
        const DeleteEmploymentRelationshipNameValue = 500;
        const DeleteSpecializationCodeValue = 500;
        const DeleteLabTypeNameValue = 500;
        const DeleteEquipmentTypeNameValue = 500;
        const DeleteEquipmentCategoryNameValue = 500;
        const DeleteLabHasAquisitionSourceLabIdValue = 500;
        const DeleteLabHasEquipmentTypeLabIdValue = 500;
        const DeleteLabWorkerIdValue = 500;
        
        const DeleteSchoolUnitNameValue = 500;
        const DeleteSchoolUnitTypeNameValue = 500;
        const DeleteEducationLevelNameValue =500;
        const DeleteRegionEduAdminNameValue = 500;
        const DeleteEduAdminNameValue = 500;
        const DeleteTransferAreaNameValue = 500;
        const DeletePrefectureNameValue = 500;
        const DeleteMunicipalityNameValue = 500;

    //restricted deletion of duplicate values=========================================================================================================================================

        const DuplicateDelLabNameValue = 500;
        const DuplicateDelLabResponsibleRegistryNumberValue = 500;
        const DuplicateDelAquisitionNameValue = 500;
        const DuplicateDelEmploymentRelationshipNameValue = 500;
        const DuplicateDelSpecializationCodeValue = 500;
        const DuplicateDelLabTypeNameValue = 500;
        const DuplicateDelEquipmentTypeNameValue = 500;
        const DuplicateDelEquipmentCategoryNameValue = 500;
        
        const DuplicateDelSchoolUnitNameValue = 500;
        const DuplicateDelSchoolUnitTypeNameValue = 500;
        const DuplicateDelEducationLevelNameValue = 500;
        const DuplicateDelRegionEduAdminNameValue = 500;
        const DuplicateDelEduAdminNameValue = 500;
        const DuplicateDelTransferAreaNameValue = 500;
        const DuplicateDelPrefectureNameValue = 500;
        const DuplicateDelMunicipalityNameValue = 500;
    
    //restricted deletion of references values on other tables==========================================================================================================================

        const ReferencesAquisitionSources = 500;
        const ReferencesEmploymentRelationships = 500;
        const ReferencesSpecializationCodes = 500;
        const ReferencesLabTypes = 500;
        const ReferencesEquipmentTypes = 500;
        const ReferencesEquipmentCategories = 500;
        const ReferencesLabAquisitionSources = 500;
        const ReferencesLabEquipmentTypes = 500;
        const ReferencesLabs = 500; 
        const ReferencesLabResponsibles =500;
        const ReferencesLabWorkers = 500;
        const ReferencesLabRelations = 500;
        const ReferencesLabTransitions = 500;
        
        const ReferencesSchoolUnitTypes = 500;
        const ReferencesEducationLevels = 500;
        const ReferencesRegionEduAdmins = 500;
        const ReferencesEduAdmins = 500;
        const ReferencesTransferAreas = 500;
        const ReferencesPrefectures = 500;
        const ReferencesMunicipalities= 500;
        const ReferencesSchoolUnits = 500;

        //postEquipmentTypes
        const NotAllowedLabEquipmentTypes = 500;
        const NotAllowedLabAquisitionSources = 500;
        const NotAllowedLabWorkerStartService = 500;
        const NotAllowedLabTransitionService = 500;
        const ConflictLabTransitionWithLabsValue = 500;
        
        //update
        const ErrorUpdateLabWorkerStatus = 500;
        const ErrorUpdateLabTransitionStatus = 500;
        const ErrorUpdateLabRelationStatus = 500;
        
        //lab_relations
        const ErrorInputCircuitIdParam  = 500;
        const ErrorInputLabTransitionsValues = 500;
        
         //delete lab_transitions
        const ReferencesLabTransitionsValue = 500;
        
        //post labs
        const NotAllowedLabNameValue = 500;
        
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
    
    /** {@see ExceptionMessages::DuplicatedSchoolUnitValue} */
    const DuplicatedSchoolUnitValue = 500;
    /** {@see ExceptionMessages::DuplicatedSchoolUnitNameValue} */
    const DuplicatedSchoolUnitNameValue = 500;
     
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
    /** {@see ExceptionMessages::UsedWorkerBySchoolUnitLabs} */
    const UsedWorkerBySchoolUnitLabs = 500;
   
    /** {@see ExceptionMessages::MissingWorkerRegistryNoParam} */
    const MissingWorkerRegistryNoParam = 500;
    /** {@see ExceptionMessages::MissingWorkerRegistryNoValue} */
    const MissingWorkerRegistryNoValue = 500;
    /** {@see ExceptionMessages::InvalidWorkerRegistryNoType} */
    const InvalidWorkerRegistryNoType = 500;
    /** {@see ExceptionMessages::InvalidWorkerRegistryNoArray} */
    const InvalidWorkerRegistryNoArray = 500;
    
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
    
    /** {@see ExceptionMessages::InvalidWorkerTaxNumberType} */
    const InvalidWorkerTaxNumberType = 500;
    /** {@see ExceptionMessages::InvalidWorkerFatherNameType} */
    const InvalidWorkerFatherNameType = 500;
    /** {@see ExceptionMessages::InvalidWorkerSexType} */
    const InvalidWorkerSexType = 500;

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
    
    /** {@see ExceptionMessages::DuplicatedLabWorkerValue} */
    const DuplicatedLabWorkerValue = 500;
    /** {@see ExceptionMessages::UsedLabWorkerByLabs} */
    const UsedLabWorkerByLabs = 500;
    
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
    
    /** {@see ExceptionMessages::InvalidLabWorkerEmailType} */
    const InvalidLabWorkerEmailType = 500;
   
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
    
    /** {@see ExceptionMessages::DuplicatedLabValue} */
    const DuplicatedLabValue = 500;
    /** {@see ExceptionMessages::DuplicatedLabNameValue} */
    const DuplicatedLabNameValue = 500;
     
    /** {@see ExceptionMessages::MissingLabNameParam} */
    const MissingLabNameParam = 500;
    /** {@see ExceptionMessages::MissingLabNameValue} */
    const MissingLabNameValue = 500;
    /** {@see ExceptionMessages::InvalidLabNameType} */
    const InvalidLabNameType = 500;
    /** {@see ExceptionMessages::InvalidLabNameArray} */
    const InvalidLabNameArray = 500;
    
    /** {@see ExceptionMessages::InvalidLabSpecialNameType} */
    const InvalidLabSpecialNameType = 500;
    /** {@see ExceptionMessages::InvalidLabCreationDateType} */
    const InvalidLabCreationDateType = 500;
    /** {@see ExceptionMessages::InvalidLabCreatedByType} */
    const InvalidLabCreatedByType = 500;
    /** {@see ExceptionMessages::InvalidLabLastUpdatedType} */
    const InvalidLabLastUpdatedType = 500;
    /** {@see ExceptionMessages::InvalidLabUpdatedByType} */
    const InvalidLabUpdatedByType = 500;
    /** {@see ExceptionMessages::InvalidLabPositioningType} */
    const InvalidLabPositioningType = 500;
    /** {@see ExceptionMessages::InvalidLabCommentsType} */
    const InvalidLabCommentsType = 500;
    /** {@see ExceptionMessages::InvalidLabOperationalRatingType} */
    const InvalidLabOperationalRatingType = 500;
    /** {@see ExceptionMessages::InvalidLabTechnologicalRatingType} */
    const InvalidLabTechnologicalRatingType = 500;
   
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
    
    /** {@see ExceptionMessages::DuplicatedLabEquipmentTypeValue} */
    const DuplicatedLabEquipmentTypeValue = 500;
    /** {@see ExceptionMessages::UsedLabEquipmentTypeByLabs} */
    const UsedLabEquipmentTypeByLabs = 500;
    
    /** {@see ExceptionMessages::MissingLabEquipmentTypeItemsParam} */ 
    const MissingLabEquipmentTypeItemsParam = 500;
    /** {@see ExceptionMessages::MissingLabEquipmentTypeItemsValue} */
    const MissingLabEquipmentTypeItemsValue = 500;
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeItemsType} */
    const InvalidLabEquipmentTypeItemsType = 500;
    /** {@see ExceptionMessages::InvalidLabEquipmentTypeItemsArray} */
    const InvalidLabEquipmentTypeItemsArray = 500;
   
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
    
    /** {@see ExceptionMessages::DuplicatedLabAquisitionSourceValue} */
    const DuplicatedLabAquisitionSourceValue = 500;
    /** {@see ExceptionMessages::UsedLabAquisitionSourceByLabs} */
    const UsedLabAquisitionSourceByLabs = 500;
     
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceYearType} */
    const InvalidLabAquisitionSourceYearType = 500;
    /** {@see ExceptionMessages::InvalidLabAquisitionSourceCommentsType} */
    const InvalidLabAquisitionSourceCommentsType = 500;
    
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
    
        /** {@see ExceptionMessages::DuplicatedLabTransitionValue} */
    const DuplicatedLabTransitionValue = 500;
        /** {@see ExceptionMessages::UsedLabTransitionByLabs} */
    const UsedLabTransitionByLabs = 500;
    
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
    
    /** {@see ExceptionMessages::DuplicatedRegionEduAdminValue} */
    const DuplicatedRegionEduAdminValue = 500;
    /** {@see ExceptionMessages::UsedRegionEduAdminBySchoolUnits} */
    const UsedRegionEduAdminBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedRegionEduAdminByEduAdmins} */   
    const UsedRegionEduAdminByEduAdmins = 500;
    
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
     
    /** {@see ExceptionMessages::DuplicatedEduAdminValue} */   
    const DuplicatedEduAdminValue = 500;
    /** {@see ExceptionMessages::UsedEduAdminBySchoolUnits} */   
    const UsedEduAdminBySchoolUnits =500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const UsedEduAdminByTransferAreas = 500;
  
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
    
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const DuplicatedTransferAreaValue = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const UsedTransferAreaBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedEduAdminByTransferAreas} */   
    const UsedTransferAreaByMunicipalities = 500;

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
   
    /** {@see ExceptionMessages::DuplicatedMunicipalityValue} */   
    const DuplicatedMunicipalityValue = 500;
    /** {@see ExceptionMessages::UsedMunicipalityBySchoolUnits} */   
    const UsedMunicipalityBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedMunicipalityByPrefectures} */   
    const UsedMunicipalityByPrefectures = 500;
    
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
    
    /** {@see ExceptionMessages::DuplicatedPrefectureValue} */   
    const DuplicatedPrefectureValue = 500;
    /** {@see ExceptionMessages::UsedPrefectureBySchoolUnits} */   
    const UsedPrefectureBySchoolUnits = 500;

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
    
    /** {@see ExceptionMessages::DuplicatedEducationLevelValue} */   
    const DuplicatedEducationLevelValue = 500;
    /** {@see ExceptionMessages::UsedEducationLevelBySchoolUnits} */   
    const UsedEducationLevelBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedEducationLevelBySchoolUnitTYpes} */   
    const UsedEducationLevelBySchoolUnitTYpes = 500;
    
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
    
    /** {@see ExceptionMessages::DuplicatedStateValue} */   
    const DuplicatedStateValue = 500;
    /** {@see ExceptionMessages::UsedStateBySchoolUnits} */   
    const UsedStateBySchoolUnits = 500;
    /** {@see ExceptionMessages::UsedStateBySchoolUnitTYpes} */   
    const UsedStateBySchoolUnitTYpes = 500;
    
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
    
    /** {@see ExceptionMessages::DuplicatedCircuitTypeValue} */  
    const DuplicatedCircuitTypeValue = 500;
    /** {@see ExceptionMessages::UsedCircuitTypeByCircuits} */  
    const UsedCircuitTypeByCircuits = 500;

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
    
      /** {@see ExceptionMessages::DuplicatedRelationTypeValue} */  
    const DuplicatedRelationTypeValue = 500;
      /** {@see ExceptionMessages::UsedRelationTypeByLabRelations} */  
    const UsedRelationTypeByLabRelations = 500;
  
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
    
      /** {@see ExceptionMessages::DuplicatedWorkerPositionValue} */  
    const DuplicatedWorkerPositionValue = 500;
      /** {@see ExceptionMessages::UsedWorkerPositionBySchoolUnitWorkers} */  
    const UsedWorkerPositionBySchoolUnitWorkers = 500;
      /** {@see ExceptionMessages::UsedWorkerPositionByLabWorkers} */  
    const UsedWorkerPositionByLabWorkers = 500;
    
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
    
    /** {@see ExceptionMessages::DuplicatedWorkerSpecializationValue} */  
    const DuplicatedWorkerSpecializationValue = 500;
    /** {@see ExceptionMessages::UsedWorkerSpecializationBySchoolUnitWorkers} */  
    const UsedWorkerSpecializationBySchoolUnitWorkers = 500;
    /** {@see ExceptionMessages::UsedWorkerSpecializationByLabWorkers} */  
    const UsedWorkerSpecializationByLabWorkers = 500;
    
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
        /** {@see ExceptionMessages::UsedLabTypeByLabs} */  
    const UsedLabTypeByLabs = 500;

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
    
    /** {@see ExceptionMessages::DuplicatedLabSourceValue} */  
    const DuplicatedLabSourceValue = 500;
    /** {@see ExceptionMessages::UsedLabSourceByLabs} */  
    const UsedLabSourceByLabs = 500;
 
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
    
    /** {@see ExceptionMessages::DuplicatedEquipmentCategoryValue} */  
    const DuplicatedEquipmentCategoryValue = 500;
    /** {@see ExceptionMessages::UsedEquipmentCategoryByEquipmentTypes} */  
    const UsedEquipmentCategoryByEquipmentTypes = 500;
    
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
    
    /** {@see ExceptionMessages::DuplicatedEquipmentTypeValue} */  
    const DuplicatedEquipmentTypeValue = 500;
    /** {@see ExceptionMessages::UsedEquipmentTypeByLabEquipmentTypes} */  
    const UsedEquipmentTypeByLabEquipmentTypes = 500;
    
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
    const NoPermissionsError = 500;
    
    /** {@see ExceptionMessages::NotFoundUserPermissions} */      
    const NotFoundUserPermissions = 500;
    /** {@see ExceptionMessages::NotFoundFullSchoolUnitDnsName} */  
    const NotFoundFullSchoolUnitDnsName = 500;
    /** {@see ExceptionMessages::DuplicateFullSchoolUnitDnsName} */  
    const DuplicateFullSchoolUnitDnsName = 500;
    /** {@see ExceptionMessages::MissingLdapLattribute} */  
    const MissingLdapLAttribute = 500;
    /** {@see ExceptionMessages::MissingLdapEmployeeNumberAttribute} */   
    const MissingLdapEmployeeNumberAttribute = 500;
    
    /** {@see ExceptionMessages::NoPermissionToPost} */   
    const NoPermissionToPostLab = 500;
    /** {@see ExceptionMessages::NoPermissionToPut} */   
    const NoPermissionToPutLab = 500;
    /** {@see ExceptionMessages::NoPermissionToDelete} */   
    const NoPermissionToDeleteLab = 500;
    /** {@see ExceptionMessages::NoPermissionToGet} */   
    const NoPermissionToGetLab = 500;
   
     //reports  
    /** {@see ExceptionMessages::ErrorEduAdminReportKeplhnet} */ 
    const ErrorEduAdminReportKeplhnet = 500;
    
}

?>