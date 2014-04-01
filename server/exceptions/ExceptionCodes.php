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
        const InvalidPageNumber = 500;
        const InvalidMaxPageNumber = 500;
        const InvalidPageType = 500;
        const InvalidPageSizeNumber = 500;
        const InvalidPageSizeType = 500;
        const InvalidSortModeType = 500;
        const InvalidSortFieldType = 500;
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
    
        //const InvalidLabValue = 500;
        const InvalidLabIdValue = 500;
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
         
        const InvalidLabTypeValue = 500;
        const InvalidWorkerValue = 500;
        const InvalidSpecializationCodeValue = 500;
        const InvalidEmploymentRelationshipValue = 500;
        const InvalidAquisitionSourceValue = 500;
        const InvalidNewAquisitionSourceValue = 500;
        const InvalidEquipmentTypeValue = 500;
        const InvalidNewEquipmentTypeValue = 500;
        const InvalidEquipmentCategoryValue = 500;
        const InvalidStateValue = 500;
        const InvalidLabSourceValue = 500;
        const NotFoundLabWorkerIDValue=500;
        const NotFoundLabRelationIDValue = 500;
        const NotFoundLabAquisitionSourceIdValue = 500;
        const NotFoundLabTransitionIDValue = 500;

        const InvalidSchoolUnitValue = 500;
        const InvalidSchoolUnitTypeValue =500;
        const InvalidEducationLevelValue = 500;
        const InvalidRegionEduAdminValue = 500;
        const InvalidEduAdminValue = 500;
        const InvalidTransferAreaValue = 500;
        const InvalidMunicipalityValue = 500;
        const InvalidPrefectureValue = 500;
        const InvalidCircuitPhoneNumberValue = 500;
        const InvalidRelationTypeValue = 500;
        const InvalidCircuitValue = 500;
        
        const InvalidMmIdValue = 500;
        const InvalidNameValue= 500;
        const InvalidCreationDateValue = 500;


    //missing values (POST/PUT)==================================================================================================================================
    
        const MissingNameValue = 500;
        const MissingInfoNameValue = 500;
        const InvalidSpecialNameValue = 500;
        const MissingCodeValue = 500;
        const InvalidCodeType = 500;
        const InvalidNumberType = 500;
        const MissingLabValue = 500;
        const InvalidLabValue = 500;
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
        const MissingWorkerPositionValue= 500;
        const MissingLabWorkerIdValue = 500;
        const InvalidLabWorkerIdValue = 500;
        const InvalidWorkerStatusValue = 500;
        const MissingAquisitionYearValue = 500;
        const InvalidUpdateWorkerStatusValue = 500;
        const MissingLabRelationIdValue  = 500;
        const InvalidLabRelationIdValue  = 500;
        const MissingLabAquisitionSourceIdValue = 500;
        const InvalidLabAquisitionSourceIdValue  = 500;
        const MissingLabTypeValue = 500;
        const MissingLabSourceValue = 500;
        const MissingLabStateValue = 500;
        const MissingLabTransitionIdValue  = 500;
        const InvalidLabTransitionIdValue  = 500; 
        const MissingOperationalRatingValue  =500;
        const InvalidOperationalRatingValue  =500;
        const MissingTechnologicalRatingValue  = 500;
        const InvalidTechnologicalRatingValue  = 500;
         
        const MissingLabParam = 500;
        const MissingWorkerIdParam=500;
        const MissingWorkerStartServiceParam  = 500;
        const MissingWorkerPositionParam  = 500;
        const MissingWorkerStatusParam  = 500;
        const MissingEquipmentTypesParam = 500;
        const MissingItemsParam =500;
        const MissingEquipmentTypeParam = 500;
        const MissingLabEquipmentTypeParam = 500;
        const MissingLabAquisitionSourceParam  = 500;
        const MissingAquisitionYearParam = 500;
        const MissingSchoolUnitParam = 500;
        const MissingRelationTypeParam = 500;       
        const MissingCircuitIdParam = 500;
        const MissingLabRelationIdParam = 500;
        const MissingLabAquisitionSourceIdParam = 500;
        const MissingLabTypeParam = 500;
        const MissingLabSourceParam = 500;  
        const MissingLabStateParam = 500;
        const MissingLabTransitionIdParam = 500;
        const MissingTransitionDateParam  = 500;
        const MissingTransitionSourceParam  =500;
        const MissingTransitionJustificationParam  =500;
        const MissingCircuitPhoneNumberParam = 500;
        const MissingOperationalRatingParam  = 500;
        const MissingTechnologicalRatingParam  = 500;

        const MissingLabTypeIdValue = 500;
        const InvalidLabTypeIdValue = 500;
        const MissingSpecializationCodeIdValue = 500;
        const InvalidSpecializationCodeIdValue = 500;
        const MissingEmploymentRelationshipIdValue = 500;
        const InvalidEmploymentRelationshipIdValue = 500;
        const MissingAquisitionSourceIdValue = 500;
        const InvalidAquisitionSourceIdValue = 500;
        const MissingNewAquisitionSourceIdValue = 500;
        const MissingEquipmentTypeIdValue = 500; 
        const InvalidEquipmentTypeIdValue = 500;
        const MissingNewEquipmentTypeIdValue =500;
        const MissingEquipmentCategoryIdValue = 500;
        const InvalidEquipmentCategoryIdValue = 500;
        const MissingLabResponsibleIdValue = 500;
        const InvalidLabResponsibleIdValue = 500;
        const MissingLabWorkerValue = 500; 
        const MissingWorkerStartServiceValue = 500; 
        const MissingWorkerValue = 500; 
        const MissingEquipmentTypeValue = 500;
        const MissingAquisitionSourceValue = 500;
        
        const MissingSchoolUnitIdValue = 500; 
        const InvalidSchoolUnitIdValue  = 500;
        const MissingEducationLevelIdValue = 500;
        const InvalidEducationLevelIdValue  = 500;
        const MissingSchoolUnitTypeIdValue = 500;
        const InvalidSchoolUnitTypeIdValue  =500;
        const MissingRegionEduAdminIdValue = 500;
        const InvalidRegionEduAdminIdValue  = 500;
        const MissingEduAdminIdValue = 500; 
        const InvalidEduAdminIdValue  = 500;
        const MissingTranferAreaIdValue = 500; 
        const InvalidTranferAreaIdValue  = 500;
        const MissingMunicipalityIdValue = 500; 
        const InvalidMunicipalityIdValue  = 500;
        const MissingPrefectureIdValue = 500; 
        const InvalidPrefectureIdValue  = 500;
        const InvalidFromDiscontinuedToStateIdValue = 500;
        const InvalidSameFromToStateValue = 500;
        const MissingRelationTypeValue = 500;
        const InvalidRelationTypeIdValue = 500;
        const MissingCircuitIdValue = 500;
        const InvalidCircuitIdValue = 500;
        const MissingCircuitPhoneNumberValue =500;
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
}

?>