<?php

/**
 *
 * @version 1.0
 * @author  ΤΕΙ Αθήνας
 * @package Exceptions
 */

header("Content-Type: text/html; charset=utf-8");

/** 
 * Κωδικοί Σφαλμάτων Συγχρονισμού
 * 
 * Παρακάτω εμφανίζονται οι Κωδικοί Σφαλμάτων Συγχρονισμού που διαχειρίζετε η <a href="class-CustomException.html">CustomException</a>
 * 
 */

class SyncExceptionCodes
{  
   
    //general vocabularies
    const MissingSyncRegionEduAdminIdValue = '701'; 
    const InvalidSyncRegionEduAdminIdValue  = '702';
    const MissingSyncRegionEduAdminNameValue = '703';
   
    const MissingSyncEduAdminIdValue = '711'; 
    const InvalidSyncEduAdminIdValue  = '712';
    const MissingSyncEduAdminNameValue = '713';
    
    const MissingSyncTransferAreaIdValue = '714'; 
    const InvalidSyncTransferAreaIdValue  = '715';
    const MissingSyncTransferAreaNameValue = '716';
    
    const MissingSyncPrefectureIdValue = '717'; 
    const InvalidSyncPrefectureIdValue  = '718';
    const MissingSyncPrefectureNameValue = '719';
    
    const MissingSyncMunicipalityIdValue = '720'; 
    const InvalidSyncMunicipalityIdValue  = '721';
    const MissingSyncMunicipalityNameValue = '722';
    
    const MissingSyncSchoolUnitTypeIdValue = '723'; 
    const InvalidSyncSchoolUnitTypeIdValue  = '724';
    const MissingSyncSchoolUnitTypeNameValue = '725';
    
    const MissingSyncEducationLevelIdValue = '726'; 
    const InvalidSyncEducationLevelIdValue  = '727';
    const MissingSyncEducationLevelValue = '728';
    
    const MissingSyncStateIdValue = '729'; 
    const InvalidSyncStateIdValue  = '730';
    const MissingSyncStateNameValue = '731';
    
//    const MissingSyncStateIdValue = '732'; 
//    const InvalidSyncStateIdValue  = '733';
//    const MissingSyncStateNameValue = '734';
    
    const MissingSyncSchoolUnitIdValue = '735'; 
    const InvalidSyncSchoolUnitIdValue  = '736';
    const UnknownSyncSchoolUnitIdType  = '736';
    const MissingSyncSchoolUnitNameValue = '737';

    const MissingSyncCircuitIdValue = '738'; 
    const InvalidSyncCircuitIdValue  = '739';
    const UnknownSyncCircuitIdType  = '740';
    const MissingSyncCircuitPhoneNumberValue = '741'; 
    const InvalidSyncCircuitPhoneNumberValue  = '742';
    const UnknownSyncCircuitPhoneNumberType  = '743';
    const MissingSyncCircuitStatusValue = '744'; 
    const InvalidSyncCircuitStatusValue  = '745';
    
    const MissingSyncCircuitTypeIdValue = '746'; 
    const InvalidSyncCircuitTypeIdValue  = '747';
    const MissingSyncCircuitTypeNameValue = '748';
    
    const MissingSyncWorkerPositionIdValue = '749'; 
    const InvalidSyncWorkerPositionIdValue  = '750';
    const UnknownSyncWorkerPositionIdType = '750';
    const MissingSyncWorkerPositionNameValue = '751';
    
    const MissingSyncWorkerSpecializationIdValue = '752'; 
    const InvalidSyncWorkerSpecializationIdValue  = '753';
    const UnknownSyncWorkerSpecializationIdType  = '5551';
    const MissingSyncWorkerSpecializationNameValue = '754';
    
    const MissingSyncWorkerIdValue = '755'; 
    const InvalidSyncWorkerIdValue  = '756';
    const UnknownSyncWorkerIdType  = '756';
    const MissingSyncWorkerRegistryNoValue = '757'; 
    const InvalidSyncWorkeRegistryNoValue  = '758';
    const UnknownSyncWorkerRegistryNoType  = '759';
    const MissingSyncWorkerTaxNumberValue = '759'; 
    const InvalidSyncWorkerTaxNumberValue  = '760';
    const UnknownSyncWorkerTaxNumberType  = '760';
    const UnknownSyncWorkerLastNameType  = '777';
    const UnknownSyncWorkerFirstNameType  = '777';
    const UnknownSyncWorkerFatherNameType  = '777';
    const UnknownSyncWorkerSexType  = '777';
    
    const MissingSyncSchoolUnitWorkerIdValue = '761'; 
    const InvalidSyncSchoolUnitWorkerIdValue  = '762';
    const UnknownSyncSchoolUnitWorkerIdType  = '763';
    
    //sync region_edu_admins table
    const SyncRegionEduAdmins = '800';
    const SuccessSyncRegionEduAdminsRecord = '801';
    const FailureSyncRegionEduAdminsRecord = '802';
    const CommitSyncRegionEduAdmins = '803';
    const RollBackSyncRegionEduAdmins = '804';
    
    const IdenticalSyncRegionEduAdminNameValue = '805';
    const DuplicateSyncRegionEduAdminNameValue = '806';
    const DuplicateSyncRegionEduAdminNameIdValue = '807';
    
    //sync edu_admins table
    const SyncEduAdmins = '820';
    const SuccessSyncEduAdminsRecord = '821';
    const FailureSyncEduAdminsRecord = '822';
    const CommitSyncEduAdmins = '823';
    const RollBackSyncEduAdmins = '824';
  
    const IdenticalSyncEduAdminNameValue = '825';
    const DuplicateSyncEduAdminNameValue = '826';
    const DuplicateSyncEduAdminNameIdValue = '827';   
    
    const DuplicateVocabularySyncRegionEduAdminIdValue = '828';
    const NotFoundVocabularySyncRegionEduAdminValue = '829';
    
    //sync transfer_areas table
    const SyncTransferAreas = '840';
    const SuccessSyncTransferAreasRecord = '841';
    const FailureSyncTransferAreasRecord = '842';
    const CommitSyncTransferAreas = '843';
    const RollBackSyncTransferAreas = '844';
    
    const IdenticalSyncTransferAreaNameValue = '845';
    const DuplicateSyncTransferAreaNameValue = '846';
    const DuplicateSyncTransferAreaNameIdValue = '847';   
    
    const DuplicateVocabularySyncEduAdminIdValue = '848';
    const NotFoundVocabularySyncEduAdminValue = '849';    
    
    //sync prefectures table
    const SyncPrefectures = '860';
    const SuccessSyncPrefecturesRecord = '861';
    const FailureSyncPrefecturesRecord = '862';
    const CommitSyncPrefectures = '863';
    const RollBackSyncPrefectures = '864';
    
    const IdenticalSyncPrefecturesNameValue = '865';
    const DuplicateSyncPrefecturesNameValue = '866';
    const DuplicateSyncPrefecturesNameIdValue = '867';
    
    //sync municipalities table
    const SyncMunicipalities = '880';
    const SuccessSyncMunicipalitiesRecord = '881';
    const FailureSyncMunicipalitiesRecord = '882';
    const CommitSyncMunicipalities = '883';
    const RollBackSyncMunicipalities = '884';
    
    const IdenticalSyncMunicipalitiesNameValue = '885';
    const DuplicateSyncMunicipalitiesNameValue = '886';
    const DuplicateSyncMunicipalitiesNameIdValue = '887';
    
    const DuplicateVocabularySyncTransferAreaIdValue = '888';
    const NotFoundVocabularySyncTransferAreaValue = '889';
    const DuplicateVocabularySyncPrefectureIdValue = '890';
    const NotFoundVocabularySyncPrefectureValue = '891'; 
    
    //sync school_units table
    const SyncSchoolUnits = '900';
    const SuccessSyncSchoolUnitsRecord = '901';
    const FailureSyncSchoolUnitsRecord = '902';
    const CommitSyncSchoolUnits = '903';
    const RollBackSyncSchoolUnits = '904';
    
    const IdenticalSyncSchoolUnitsNameValue = '905';
    const DuplicateSyncSchoolUnitsNameValue = '906';
    const DuplicateSyncSchoolUnitsNameIdValue = '907';
    
    const DuplicateVocabularySyncMunicipalityIdValue = '908';
    const NotFoundVocabularySyncMunicipalityValue = '909';
    const DuplicateVocabularySyncSchoolUnitTypeIdValue = '910';
    const NotFoundVocabularySyncSchoolUnitTypeValue = '911';
    const DuplicateVocabularySyncStateIdValue = '912';
    const NotFoundVocabularySyncStateValue = '913';
    const DuplicateVocabularySyncPrincipalIdValue = '914';
    const NotFoundVocabularySyncPrincipalValue = '915';
 
    const IgnoreSyncSchoolUnitsRecord = '920';
    const SuccessSyncInsertSchoolUnitsRecord = '921';
    const SuccessSyncUpdateSchoolUnitsRecord ='922';
    
    //sync school_unit_types table
    const SyncSchoolUnitTypes = '940';
    const SuccessSyncSchoolUnitTypesRecord = '941';
    const FailureSyncSchoolUnitTypesRecord = '942';
    const CommitSyncSchoolUnitTypesUnits = '943';
    const RollBackSyncSchoolUnitTypesUnits = '944';
    
    const IdenticalSyncSchoolUnitTypesNameValue = '945';
    const DuplicateSyncSchoolUnitTypesNameValue = '946';
    const DuplicateSyncSchoolUnitTypesNameIdValue = '947';
    
    const DuplicateVocabularySyncEducationLevelIdValue = '948';
    const NotFoundVocabularySyncEducationLevelValue = '949';
    
    //sync education_levels table
    const SyncEducationLevels = '960';
    const SuccessSyncEducationLevelsRecord = '961';
    const FailureSyncEducationLevelsRecord = '962';
    const CommitSyncEducationLevels = '963';
    const RollBackSyncEducationLevels = '964';
    
    const IdenticalSyncEducationLevelsNameValue = '965';
    const DuplicateSyncEducationLevelsNameValue = '966';
    const DuplicateSyncEducationLevelsNameIdValue = '967';
    
    //sync states table
    const SyncStates = '980';
    const SuccessSyncStatesRecord = '981';
    const FailureSyncStatesRecord = '982';
    const CommitSyncStates = '983';
    const RollBackSyncStates = '984';
    
    const IdenticalSyncStatesNameValue = '985';
    const DuplicateSyncStatesNameValue = '986';
    const DuplicateSyncStatesNameIdValue = '987';

    //sync circuits table
    const SyncCircuits = '1000';
    const SuccessSyncCircuitsRecord = '1001';
    const FailureSyncCircuitsRecord = '1002';
    const CommitSyncCircuits= '1003';
    const RollBackSyncCircuits = '1004';
    
    const IdenticalSyncCircuitsPhoneValue = '1004';
    const DuplicateSyncCircuitsPhoneValue = '1005';
    const DuplicateSyncCircuitIdValue = '1006';
    
    const DuplicateVocabularySyncCircuitTypeIdValue = '1007';
    const NotFoundVocabularySyncCircuitTypeIdValue = '1008';
    //const DuplicateVocabularySyncSchoolUnitIdValue = '1009';
    //const NotFoundVocabularySyncSchoolUnitIdValue = '1010';
    const DuplicateVocabularySyncCircuitIdValue = '1011';
    const NotFoundVocabularySyncCircuitIdValue = '1012';
    const DuplicateVocabularySyncCircuitPhoneNumberValue = '1013';
    const NotFoundVocabularySyncCircuitPhoneNumberValue = '1014';
    
    const IgnoreSyncCircuitsRecord = '1015';
    const SuccessSyncInsertCircuitsRecord = '1016';
    const SuccessSyncUpdateCircuitsRecord = '1017';
    
//sync school_unit_worker table
    const SyncSchoolUnitWorkers = '1018';
    const SuccessSyncSchoolUnitWorkersRecord = '1019';
    const FailureSyncSchoolUnitWorkersRecord = '1020';
    const CommitSyncSchoolUnitWorkers = '1021';
    const RollBackSyncSchoolUnitWorkers = '1022';
    
    const IdenticalSyncSchoolUnitWorkerValue = '1023';
    const DuplicateSyncSchoolUnitWorkerValue = '1024';
    const DuplicateSyncSchoolUnitWorkerIdValue = '1025';
    
    const DuplicateVocabularySyncSchoolUnitWorkerIdValue = '1026';
    const NotFoundVocabularySyncSchoolUnitWorkerIdValue = '1027'; 
    const DuplicateVocabularySyncSchoolUnitIdValue = '1028';
    const NotFoundVocabularySyncSchoolUnitIdValue = '1029'; 
//    const DuplicateVocabularySyncWorkerIdValue = '1030';
//    const NotFoundVocabularySyncWorkerIdValue = '1031'; 
    const DuplicateVocabularySyncWorkerPositionIdValue = '1032';
    const NotFoundVocabularySyncWorkerPositionIdValue = '1033'; 
    
   const GarbageRowSchoolUnitNameValue = '5555'; 
    
    const IgnoreSyncSchoolUnitWorkersRecord = '5060';
    const SuccessSyncInsertSchoolUnitWorkersRecord = '5060';
    const SuccessSyncUpdateSchoolUnitWorkersRecord = '5060';
   
    //sync circuit_type table
    const SyncCircuitTypes = '1034';
    const SuccessSyncCircuitTypesRecord = '1034';
    const SuccessSyncUpdateCircuitTypesRecord = '1034';
    const FailureSyncCircuitTypesRecord = '1034';
    const CommitSyncCircuitTypes = '1034';
    const RollBackSyncCircuitTypes = '1034';
    
    const IdenticalSyncCircuitTypesNameValue = '1034';
    const DuplicateSyncCircuitTypesNameValue = '1034';
    const DuplicateSyncCircuitTypesNameIdValue = '1034';
    
    //sync worker_position table
    const SyncWorkerPositions = '1034';
    const SuccessSyncWorkerPositionsRecord = '1034';
    const FailureSyncWorkerPositionsRecord = '1034';
    const CommitSyncWorkerPositions = '1034';
    const RollBackSyncWorkerPositions = '1034';
    
    const IdenticalSyncWorkerPositionsNameValue = '1034';
    const DuplicateSyncWorkerPositionsNameValue = '1034';
    const DuplicateSyncWorkerPositionsNameIdValue = '1034';
    
    //sync worker_specialization table
    const SyncWorkerSpecializations = '1034';
    const SuccessSyncWorkerSpecializationsRecord = '1034';
    const FailureSyncWorkerSpecializationsRecord = '1034';
    const CommitSyncWorkerSpecializations = '1034';
    const RollBackSyncWorkerSpecializations = '1034';
    
    const IdenticalSyncWorkerSpecializationsNameValue = '1034';
    const DuplicateSyncWorkerSpecializationsNameValue = '1034';
    const DuplicateSyncWorkerSpecializationsNameIdValue = '1034';
   
        //sync workers table
    const SyncWorkers = '1035';
    const SuccessSyncWorkersRecord = '1035';
    const FailureSyncWorkersRecord = '1035';
    const CommitSyncWorkers = '1035';
    const RollBackSyncWorkers = '1035';
    
    const IdenticalSyncWorkerValue = '1035';
    const DuplicateSyncWorkerValue = '1035';
    const DuplicateSyncWorkerIdValue = '1035';
    
    const DuplicateVocabularySyncWorkerIdValue = '1035';
    const NotFoundVocabularySyncWorkerIdValue = '1035'; 
    const DuplicateVocabularySyncWorkerSpecializationIdValue = '1035';
    const NotFoundVocabularySyncWorkerSpecializationIdValue = '1035';
    const DuplicateVocabularySyncWorkerRegistryNoValue = '1055';
    const NotFoundVocabularySyncWorkerRegistryNoValue = '1055'; 
    const DuplicateVocabularySyncWorkerTaxNumberValue = '1055';
    const NotFoundVocabularySyncWorkerTaxNumberValue = '1055'; 
   
    const IgnoreSyncWorkersRecord = '1060';
    const SuccessSyncInsertWorkersRecord = '1060';
    const SuccessSyncUpdateWorkersRecord = '1060';
    
}
?>