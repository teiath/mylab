<?php

/**
 *
 * @version 1.0
 * @author  ΤΕΙ Αθήνας
 * @package Exceptions
 */

header("Content-Type: text/html; charset=utf-8");

/** 
 * Μηνύματα Σφαλμάτων Συγχρονισμού
 * 
 * Παρακάτω εμφανίζονται τα Μηνύματα Σφαλμάτων Συγχρονισμού που διαχειρίζετε η {@see CustomException}
 * 
 */
class SyncExceptionMessages
{    
    //general
    const SyncExceptionCodePreMessage = ' [Sync Exception Code] : ';
    
    //general vocabularies
    const MissingSyncRegionEduAdminIdValue = 'Η παράμετρος $region_edu_admin_id πρέπει να έχει τιμή. Τιμή $region_edu_admin_id = '; 
    const InvalidSyncRegionEduAdminIdValue  = 'Η παράμετρος $region_edu_admin_id πρέπει να είναι αριθμητική και >0. Τιμή $region_edu_admin_id = ';
    const MissingSyncRegionEduAdminNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncEduAdminIdValue = 'Η παράμετρος $edu_admin_id πρέπει να έχει τιμή. Τιμή $edu_admin_id = '; 
    const InvalidSyncEduAdminIdValue  = 'Η παράμετρος $edu_admin_id πρέπει να είναι αριθμητική και >0. Τιμή $edu_admin_id = ';
    const MissingSyncEduAdminNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncTransferAreaIdValue = 'Η παράμετρος $transfer_area_id πρέπει να έχει τιμή. Τιμή $transfer_area_id = '; 
    const InvalidSyncTransferAreaIdValue  = 'Η παράμετρος $transfer_area_id πρέπει να είναι αριθμητική και >0. Τιμή $transfer_area_id = ';
    const MissingSyncTransferAreaNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncPrefectureIdValue = 'Η παράμετρος $prefecture_id πρέπει να έχει τιμή. Τιμή $prefecture_id = '; 
    const InvalidSyncPrefectureIdValue  = 'Η παράμετρος $prefecture_id πρέπει να είναι αριθμητική και >0. Τιμή $prefecture_id = ';
    const MissingSyncPrefectureNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncMunicipalityIdValue = 'Η παράμετρος $municipality_id πρέπει να έχει τιμή. Τιμή $municipality_id = '; 
    const InvalidSyncMunicipalityIdValue  = 'Η παράμετρος $municipality_id πρέπει να είναι αριθμητική και >0. Τιμή $municipality_id = ';
    const MissingSyncMunicipalityNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';

    const MissingSyncSchoolUnitTypeIdValue = 'Η παράμετρος $school_unit__type_id πρέπει να έχει τιμή. Τιμή $school_unit__type_id = '; 
    const InvalidSyncSchoolUnitTypeIdValue  = 'Η παράμετρος $school_unit__type_id πρέπει να είναι αριθμητική και >0. Τιμή $school_unit__type_id = ';
    const MissingSyncSchoolUnitTypeNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncEducationLevelIdValue = 'Η παράμετρος $education_level_id πρέπει να έχει τιμή. Τιμή $education_level_id = '; 
    const InvalidSyncEducationLevelIdValue  = 'Η παράμετρος $education_level_id πρέπει να είναι αριθμητική και >0. Τιμή $education_level_id = ';
    const MissingSyncEducationLevelValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncStateIdValue = 'Η παράμετρος $state_id πρέπει να έχει τιμή. Τιμή $state_id = '; 
    const InvalidSyncStateIdValue  = 'Η παράμετρος $state_id πρέπει να είναι αριθμητική και >0. Τιμή $state_id = ';
    const MissingSyncStateNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
//    const MissingSyncStateIdValue = 'Η παράμετρος $state_id πρέπει να έχει τιμή. Τιμή $state_id = '; 
//    const InvalidSyncStateIdValue  = 'Η παράμετρος $state_id πρέπει να είναι αριθμητική και >0. Τιμή $state_id = ';
//    const MissingSyncStateNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncSchoolUnitIdValue = 'Η παράμετρος $school_unit_id πρέπει να έχει τιμή. Τιμή $school_unit_id = '; 
    const InvalidSyncSchoolUnitIdValue  = 'Η παράμετρος $school_unit_id πρέπει να είναι αριθμητική και >0. Τιμή $school_unit_id = ';
    const UnknownSyncSchoolUnitIdType  = 'Άγνωστος τύπος παραμέτρου $school_unit_id ';
    const MissingSyncSchoolUnitNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';

    const MissingSyncCircuitIdValue = 'Η παράμετρος $circuit_id πρέπει να έχει τιμή. Τιμή $circuit_id = '; 
    const InvalidSyncCircuitIdValue  = 'Η παράμετρος $circuit_id πρέπει να είναι αριθμητική και >0. Τιμή $circuit_id = ';
    const UnknownSyncCircuitIdType  = 'Άγνωστος τύπος παραμέτρου $circuit_id ';
    const MissingSyncCircuitPhoneNumberValue = 'Η παράμετρος $phone_number πρέπει να έχει τιμή. Τιμή $phone_number = '; 
    const InvalidSyncCircuitPhoneNumberValue  = 'Η παράμετρος $phone_number πρέπει να είναι αριθμητική και >0. Τιμή $phone_number = ';
    const UnknownSyncCircuitPhoneNumberType  = 'Άγνωστος τύπος παραμέτρου $phone_number ';
    const MissingSyncCircuitStatusValue = 'Η παράμετρος $status πρέπει να έχει τιμή. Τιμή $status = '; 
    const InvalidSyncCircuitStatusValue  = 'Η παράμετρος $status πρέπει να είναι αριθμητική και 0 ή 1. Τιμή $status = ';
    
    const MissingSyncCircuitTypeIdValue = 'Η παράμετρος $circuit_type_id πρέπει να έχει τιμή. Τιμή $circuit_type_id = '; 
    const InvalidSyncCircuitTypeIdValue  = 'Η παράμετρος $circuit_type_id πρέπει να είναι αριθμητική και >0. Τιμή $circuit_type_id = ';
    const MissingSyncCircuitTypeNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncWorkerPositionIdValue = 'Η παράμετρος $worker_position_id πρέπει να έχει τιμή. Τιμή $worker_position_id = '; 
    const InvalidSyncWorkerPositionIdValue  = 'Η παράμετρος $worker_position_id πρέπει να είναι αριθμητική και >0. Τιμή $worker_position_id = ';
    const UnknownSyncWorkerPositionIdType  = 'Άγνωστος τύπος παραμέτρου $worker_position_id ';
    const MissingSyncWorkerPositionNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncWorkerSpecializationIdValue = 'Η παράμετρος $worker_specialization_id πρέπει να έχει τιμή. Τιμή $worker_specialization_id = '; 
    const InvalidSyncWorkerSpecializationIdValue  = 'Η παράμετρος $worker_specialization_id πρέπει να είναι αριθμητική και >0. Τιμή $worker_specialization_id = ';
    const UnknownSyncWorkerSpecializationIdType  = 'Άγνωστος τύπος παραμέτρου $worker_specialization_id ';
    const MissingSyncWorkerSpecializationNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή. Τιμή $name = ';
    
    const MissingSyncWorkerIdValue = 'Η παράμετρος $worker_id πρέπει να έχει τιμή. Τιμή $worker_id = '; 
    const InvalidSyncWorkerIdValue  = 'Η παράμετρος $worker_id πρέπει να είναι αριθμητική και >0. Τιμή $worker_id = ';
    const UnknownSyncWorkerIdType  = 'Άγνωστος τύπος παραμέτρου $worker_id ';
    const MissingSyncWorkerRegistryNoValue = 'Η παράμετρος $registry_no πρέπει να έχει τιμή. Τιμή $registry_no = '; 
    const InvalidSyncWorkeRegistryNoValue  = 'Η παράμετρος $registry_no πρέπει να είναι αριθμητική και >0. Τιμή $registry_no = ';
    const UnknownSyncWorkerRegistryNoType  = 'Άγνωστος τύπος παραμέτρου $registry_no ';
    const MissingSyncWorkerTaxNumberValue = 'Η παράμετρος $tax_number πρέπει να έχει τιμή. Τιμή $tax_number = '; 
    const InvalidSyncWorkerTaxNumberValue  = 'Η παράμετρος $tax_number πρέπει να είναι αριθμητική και >0. Τιμή $tax_number = ';
    const UnknownSyncWorkerTaxNumberType  = 'Άγνωστος τύπος παραμέτρου $tax_number ';
    const UnknownSyncWorkerLastNameType  = 'Άγνωστος τύπος παραμέτρου $worker_id ';
    const UnknownSyncWorkerFirstNameType  = 'Άγνωστος τύπος παραμέτρου $worker_id ';
    const UnknownSyncWorkerFatherNameType  = 'Άγνωστος τύπος παραμέτρου $worker_id ';
    const UnknownSyncWorkerSexType  = 'Άγνωστος τύπος παραμέτρου $worker_id ';
    
    const MissingSyncSchoolUnitWorkerIdValue = 'Η παράμετρος $school_unit_worker_id πρέπει να έχει τιμή. Τιμή $school_unit_worker_id = '; 
    const InvalidSyncSchoolUnitWorkerIdValue  = 'Η παράμετρος $school_unit_worker_id πρέπει να είναι αριθμητική και >0. Τιμή $school_unit_worker_id = ';
    const UnknownSyncSchoolUnitWorkerIdType  = 'Άγνωστος τύπος παραμέτρου $school_unit_worker_id ';
    
    //sync region_edu_admins table
    const SyncRegionEduAdmins = 'Συγχρονισμός με τον πίνακα Region_Edu_Admins';
    const SuccessSyncRegionEduAdminsRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού Region_Edu_Admins ';
    const SuccessSyncUpdateRegionEduAdminsRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού Region_Edu_Admins ';
    const FailureSyncRegionEduAdminsRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού Region_Edu_Admins ';
    const CommitSyncRegionEduAdmins = 'Ο συγχρονισμός του λεξικού Region_Edu_Admins και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncRegionEduAdmins = 'Ο συγχρονισμός του λεξικού Region_Edu_Admins και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncRegionEduAdminNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό Region_Edu_Admin υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncRegionEduAdminNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Region_Edu_Admin υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncRegionEduAdminNameIdValue = ' To id της υπάρχουσας εγγραφής είναι region_edu_admin_id = ';
    
    //sync edu_admins table
    const SyncEduAdmins = 'Συγχρονισμός με τον πίνακα Edu_Admins';
    const SuccessSyncEduAdminsRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού Edu_Admins ';
    const SuccessSyncUpdateEduAdminsRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού Edu_Admins ';
    const FailureSyncEduAdminsRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού Edu_Admins ';
    const CommitSyncEduAdmins = 'Ο συγχρονισμός του λεξικού Edu_Admins και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncEduAdmins = 'Ο συγχρονισμός του λεξικού Edu_Admins και η ενημέρωση της βάσης απέτυχαν. ';
  
    const IdenticalSyncEduAdminNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό Edu_Admin υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncEduAdminNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Edu_Admin υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncEduAdminCodeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Edu_Admin υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $edu_admin_code σε διαφορετικό ID . Τιμή $edu_admin_code =  ';
    const DuplicateSyncEduAdminNameIdValue = ' To id της υπάρχουσας εγγραφής είναι edu_admin_id = ';   
    
    const DuplicateVocabularySyncRegionEduAdminIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Region_Edu_Admins με τιμή $region_edu_admin_id = ';
    const NotFoundVocabularySyncRegionEduAdminValue = 'Η τιμή της παραμέτρου $region_edu_admin_id δεν υπάρχει στο λεξικό. Τιμή $region_edu_admin_id = ';

    //sync transfer_areas table
    const SyncTransferAreas = 'Συγχρονισμός με τον πίνακα TransferAreas';
    const SuccessSyncTransferAreasRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού TransferAreas ';
    const SuccessSyncUpdateTransferAreasRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού TransferAreas ';
    const FailureSyncTransferAreasRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού TransferAreas ';
    const CommitSyncTransferAreas = 'Ο συγχρονισμός του λεξικού TransferAreas και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncTransferAreas = 'Ο συγχρονισμός του λεξικού TransferAreas και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncTransferAreaNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό TransferAreas υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncTransferAreaNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό TransferAreas υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncTransferAreaNameIdValue = ' To id της υπάρχουσας εγγραφής είναι transfer_area_id = ';   
    
    const DuplicateVocabularySyncEduAdminIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Edu_Admins με τιμή $edu_admin_id = ';
    const NotFoundVocabularySyncEduAdminValue = 'Η τιμή της παραμέτρου $edu_admin_id δεν υπάρχει στο λεξικό. Τιμή $edu_admin_id = ';    
    
    //sync prefectures table
    const SyncPrefectures = 'Συγχρονισμός με τον πίνακα Prefectures';
    const SuccessSyncPrefecturesRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού Prefectures ';
    const SuccessSyncUpdatePrefecturesRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού Prefectures ';
    const FailureSyncPrefecturesRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού Prefectures ';
    const CommitSyncPrefectures = 'Ο συγχρονισμός του λεξικού Prefectures και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncPrefectures = 'Ο συγχρονισμός του λεξικού Prefectures και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncPrefecturesNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό Prefectures υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncPrefecturesNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Prefectures υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncPrefecturesNameIdValue = ' To id της υπάρχουσας εγγραφής είναι prefecture_id = ';
    
    //sync municipalities table
    const SyncMunicipalities = 'Συγχρονισμός με τον πίνακα Municipality';
    const SuccessSyncMunicipalitiesRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού Municipality ';
    const SuccessSyncUpdateMunicipalitiesRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού Municipality ';
    const FailureSyncMunicipalitiesRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού Municipality ';
    const CommitSyncMunicipalities = 'Ο συγχρονισμός του λεξικού Municipality και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncMunicipalities = 'Ο συγχρονισμός του λεξικού Municipality και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncMunicipalitiesNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό Municipality υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncMunicipalitiesNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Municipality υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncMunicipalitiesNameIdValue = ' To id της υπάρχουσας εγγραφής είναι municipality_id = ';
    
    const DuplicateVocabularySyncTransferAreaIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Transfer_Areas με τιμή $transfer_area_id = ';
    const NotFoundVocabularySyncTransferAreaValue = 'Η τιμή της παραμέτρου $transfer_area_id δεν υπάρχει στο λεξικό. Τιμή $transfer_area_id = ';
    const DuplicateVocabularySyncPrefectureIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Prefecture με τιμή $prefecture_id = ';
    const NotFoundVocabularySyncPrefectureValue = 'Η τιμή της παραμέτρου $prefecture_id δεν υπάρχει στο λεξικό. Τιμή $prefecture_id = '; 

    //sync school_units table
    const SyncSchoolUnits = 'Συγχρονισμός με τον πίνακα SchoolUnits';
    const SuccessSyncSchoolUnitsRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού SchoolUnits ';
    const FailureSyncSchoolUnitsRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού SchoolUnits ';
    const CommitSyncSchoolUnits = 'Ο συγχρονισμός του λεξικού SchoolUnits και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncSchoolUnits = 'Ο συγχρονισμός του λεξικού SchoolUnits και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncSchoolUnitsNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό SchoolUnits υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncSchoolUnitsNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό SchoolUnits υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncSchoolUnitsNameIdValue = ' To id της υπάρχουσας εγγραφής είναι school_unit_id = ';
    
    const DuplicateVocabularySyncMunicipalityIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Municipality με τιμή $municipality_id = ';
    const NotFoundVocabularySyncMunicipalityValue = 'Η τιμή της παραμέτρου $municipality_id δεν υπάρχει στο λεξικό. Τιμή $municipality_id = '; 
    const DuplicateVocabularySyncSchoolUnitTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό SchoolUnitTypes με τιμή $school_unit_types = ';
    const NotFoundVocabularySyncSchoolUnitTypeValue = 'Η τιμή της παραμέτρου $school_unit_types δεν υπάρχει στο λεξικό. Τιμή $school_unit_types = ';
    const DuplicateVocabularySyncStateIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό States με τιμή $state_id = ';
    const NotFoundVocabularySyncStateValue = 'Η τιμή της παραμέτρου $state_id δεν υπάρχει στο λεξικό. Τιμή $state_id = ';
    const DuplicateVocabularySyncPrincipalIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Principal με τιμή $principal_id = ';
    const NotFoundVocabularySyncPrincipalValue = 'Η τιμή της παραμέτρου $principal_id δεν υπάρχει στο λεξικό. Τιμή $principal_id = ';
 
    const IgnoreSyncSchoolUnitsRecord = 'Η εγγραφή αγνοήθηκε, λόγω υπάρχουσας ενημερωμένης έκδοσης';
    const SuccessSyncInsertSchoolUnitsRecord = 'Επιτυχής εισαγωγή εγγραφής στο λεξικού SchoolUnits';
    const SuccessSyncUpdateSchoolUnitsRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού SchoolUnits';
    
    //sync school_unit_types table
    const SyncSchoolUnitTypes = 'Συγχρονισμός με τον πίνακα SchoolUnitTypes';
    const SuccessSyncSchoolUnitTypesRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού SchoolUnitTypes ';
    const SuccessSyncUpdateSchoolUnitTypesRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού SchoolUnitTypes ';
    const FailureSyncSchoolUnitTypesRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού SchoolUnitTypes ';
    const CommitSyncSchoolUnitTypesUnits = 'Ο συγχρονισμός του λεξικού SchoolUnitTypes και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncSchoolUnitTypesUnits = 'Ο συγχρονισμός του λεξικού SchoolUnitTypes και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncSchoolUnitTypesNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό SchoolUnitTypes υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncSchoolUnitTypesNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό SchoolUnitTypes υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncSchoolUnitTypesInitialsValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό SchoolUnitTypes υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $initials σε διαφορετικό ID . Τιμή $initials =  ';
    const DuplicateSyncSchoolUnitTypesNameIdValue = ' To id της υπάρχουσας εγγραφής είναι school_unit_types_id = ';
    
    const DuplicateVocabularySyncEducationLevelIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό EducationLevel με τιμή $education_level_id = ';
    const NotFoundVocabularySyncEducationLevelValue = 'Η τιμή της παραμέτρου $education_level_id δεν υπάρχει στο λεξικό. Τιμή $education_level_id = '; 
    
    //sync education_levels table
    const SyncEducationLevels = 'Συγχρονισμός με τον πίνακα EducationLevels';
    const SuccessSyncEducationLevelsRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού EducationLevels ';
    const SuccessSyncUpdateEducationLevelsRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού EducationLevels ';
    const FailureSyncEducationLevelsRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού EducationLevels ';
    const CommitSyncEducationLevels = 'Ο συγχρονισμός του λεξικού EducationLevels και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncEducationLevels = 'Ο συγχρονισμός του λεξικού EducationLevels και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncEducationLevelsNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό EducationLevels υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncEducationLevelsNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό EducationLevels υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncEducationLevelsNameIdValue = ' To id της υπάρχουσας εγγραφής είναι education_level_id = ';
    
    //sync states table
    const SyncStates = 'Συγχρονισμός με τον πίνακα States';
    const SuccessSyncStatesRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού States ';
    const SuccessSyncUpdateStatesRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού States ';
    const FailureSyncStatesRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού States ';
    const CommitSyncStates = 'Ο συγχρονισμός του λεξικού States και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncStates = 'Ο συγχρονισμός του λεξικού States και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncStatesNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό States υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncStatesNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό States υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncStatesNameIdValue = ' To id της υπάρχουσας εγγραφής είναι state_id = ';
    
    //sync sources table
    const SyncSources = 'Συγχρονισμός με τον πίνακα Sources';
    const SuccessSyncSourcesRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού Sources ';
    const SuccessSyncUpdateSourcesRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού Sources ';
    const FailureSyncSourcesRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού Sources ';
    const CommitSyncSources = 'Ο συγχρονισμός του λεξικού Sources και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncSources = 'Ο συγχρονισμός του λεξικού Sources και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncSourcesNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό Sources υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncSourcesNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Sources υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncSourcesNameIdValue = ' To id της υπάρχουσας εγγραφής είναι source_id = ';
    
    //sync circuits table
    const SyncCircuits = 'Συγχρονισμός με τον πίνακα Circuits';
    const SuccessSyncCircuitsRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού Circuits ';
    const FailureSyncCircuitsRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού Circuits ';
    const CommitSyncCircuits= 'Ο συγχρονισμός του λεξικού Circuits και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncCircuits = 'Ο συγχρονισμός του λεξικού Circuits και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncCircuitsPhoneValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό Circuits υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $phone  . Τιμή $phone =  ';
    const DuplicateSyncCircuitsPhoneValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Circuits υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $phone_number σε διαφορετικό ID . Τιμή $phone =  ';
    const DuplicateSyncCircuitIdValue = ' To id της υπάρχουσας εγγραφής είναι circuit_id = ';
    
    const DuplicateVocabularySyncCircuitTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό CircuitType με τιμή $circuit_type_id = ';
    const NotFoundVocabularySyncCircuitTypeIdValue = 'Η τιμή της παραμέτρου $circuit_type_id δεν υπάρχει στο λεξικό. Τιμή $circuit_type_id = '; 
    //const DuplicateVocabularySyncSchoolUnitIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό SchoolUnit με τιμή $school_unit_id = ';
    //const NotFoundVocabularySyncSchoolUnitIdValue = 'Η τιμή της παραμέτρου $school_unit_id δεν υπάρχει στο λεξικό. Τιμή $school_unit_id = '; 
    const DuplicateVocabularySyncCircuitIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Circuit με τιμή $circuit_id = ';
    const NotFoundVocabularySyncCircuitIdValue = 'Η τιμή της παραμέτρου $circuit_id δεν υπάρχει στο λεξικό. Τιμή $circuit_id = '; 
    const DuplicateVocabularySyncCircuitPhoneNumberValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Circuit με τιμή $phone_number = ';
    const NotFoundVocabularySyncCircuitPhoneNumberValue = 'Η τιμή της παραμέτρου $phone_number δεν υπάρχει στο λεξικό. Τιμή $phone_number = '; 
    
    const IgnoreSyncCircuitsRecord = 'Η εγγραφή αγνοήθηκε, λόγω υπάρχουσας ενημερωμένης έκδοσης';
    const SuccessSyncInsertCircuitsRecord = 'Επιτυχής εισαγωγή εγγραφής στο λεξικού Circuits';
    const SuccessSyncUpdateCircuitsRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού Circuits';
    
    //sync school_unit_worker table
    const SyncSchoolUnitWorkers = 'Συγχρονισμός με τον πίνακα School_Unit_Workers';
    const SuccessSyncSchoolUnitWorkersRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού School_Unit_Workers ';
    const FailureSyncSchoolUnitWorkersRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού School_Unit_Workers ';
    const CommitSyncSchoolUnitWorkers = 'Ο συγχρονισμός του λεξικού School_Unit_Workers και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncSchoolUnitWorkers = 'Ο συγχρονισμός του λεξικού School_Unit_Workers και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncSchoolUnitWorkerValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό School_Unit_Workers υπάρχουν πολλαπλές εγγραφές με τις τιμές των παραμέτρων $school_unit_id,$worker_id,$worker_position_id  . Τιμές παραμέτρων ';
    const DuplicateSyncSchoolUnitWorkerValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό School_Unit_Workers υπάρχει ήδη η εγγραφή με την τιμή των παραμέτρων σε διαφορετικό ID . Τιμές παραμέτρων ';
    const DuplicateSyncSchoolUnitWorkerIdValue = ' To id της υπάρχουσας εγγραφής είναι school_unit_worker_id = ';
    
    const DuplicateVocabularySyncSchoolUnitWorkerIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό SchoolUnitWorker με τιμή $school_unit_worker_id = ';
    const NotFoundVocabularySyncSchoolUnitWorkerIdValue = 'Η τιμή της παραμέτρου $school_unit_worker_id δεν υπάρχει στο λεξικό. Τιμή $school_unit_worker_id = '; 
    const DuplicateVocabularySyncSchoolUnitIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό SchoolUnit με τιμή $school_unit_id = ';
    const NotFoundVocabularySyncSchoolUnitIdValue = 'Η τιμή της παραμέτρου $school_unit_id δεν υπάρχει στο λεξικό. Τιμή $school_unit_id = '; 
//  const DuplicateVocabularySyncWorkerIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Worker με τιμή $worker_id = ';
//  const NotFoundVocabularySyncWorkerIdValue = 'Η τιμή της παραμέτρου $worker_id δεν υπάρχει στο λεξικό. Τιμή $worker_id = '; 
    const DuplicateVocabularySyncWorkerPositionIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό WorkerpPosition με τιμή $worker_position_id = ';
    const NotFoundVocabularySyncWorkerPositionIdValue = 'Η τιμή της παραμέτρου $worker_position_id δεν υπάρχει στο λεξικό. Τιμή $worker_position_id = '; 
    
    const GarbageRowSchoolUnitNameValue = 'Η εγγραφή ειναι καταργημένη και πιθανόν χρησιμοποιήθηκε για δοκιμαστικούς λόγους . Τιμή  id και name : '; 
    
    const IgnoreSyncSchoolUnitWorkersRecord = 'Η εγγραφή αγνοήθηκε, λόγω υπάρχουσας ενημερωμένης έκδοσης';
    const SuccessSyncInsertSchoolUnitWorkersRecord = 'Επιτυχής εισαγωγή εγγραφής στο λεξικού SchoolUnitWorkers';
    const SuccessSyncUpdateSchoolUnitWorkersRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού SchoolUnitWorkers';
    
    //sync circuit_type table
    const SyncCircuitTypes = 'Συγχρονισμός με τον πίνακα CircuitTypes';
    const SuccessSyncCircuitTypesRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού CircuitTypes ';
    const SuccessSyncUpdateCircuitTypesRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού CircuitTypes ';
    const FailureSyncCircuitTypesRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού CircuitTypes ';
    const CommitSyncCircuitTypes = 'Ο συγχρονισμός του λεξικού CircuitTypes και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncCircuitTypes = 'Ο συγχρονισμός του λεξικού CircuitTypes και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncCircuitTypesNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό CircuitTypes υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncCircuitTypesNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό CircuitTypes υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncCircuitTypesNameIdValue = ' To id της υπάρχουσας εγγραφής είναι circuit_type_id = ';
    
    //sync worker_position table
    const SyncWorkerPositions = 'Συγχρονισμός με τον πίνακα WorkerPositions';
    const SuccessSyncWorkerPositionsRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού WorkerPositions ';
    const SuccessSyncUpdateWorkerPositionsRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού WorkerPositions ';
    const FailureSyncWorkerPositionsRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού WorkerPositions ';
    const CommitSyncWorkerPositions = 'Ο συγχρονισμός του λεξικού WorkerPositions και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncWorkerPositions = 'Ο συγχρονισμός του λεξικού WorkerPositions και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncWorkerPositionsNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό WorkerPositions υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncWorkerPositionsNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό WorkerPositions υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncWorkerPositionsNameIdValue = ' To id της υπάρχουσας εγγραφής είναι worker_position_id = ';
    
    //sync worker_specialization table
    const SyncWorkerSpecializations = 'Συγχρονισμός με τον πίνακα WorkerSpecializations';
    const SuccessSyncWorkerSpecializationsRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού WorkerSpecializations ';
    const SuccessSyncUpdateWorkerSpecializationsRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού WorkerSpecializations ';
    const FailureSyncWorkerSpecializationsRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού WorkerSpecializations ';
    const CommitSyncWorkerSpecializations = 'Ο συγχρονισμός του λεξικού WorkerSpecializations και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncWorkerSpecializations = 'Ο συγχρονισμός του λεξικού WorkerSpecializations και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncWorkerSpecializationsNameValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό WorkerSpecializations υπάρχουν πολλαπλές εγγραφές με την τιμή της παραμέτρου $name  . Τιμή $name =  ';
    const DuplicateSyncWorkerSpecializationsNameValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό WorkerSpecializations υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name σε διαφορετικό ID . Τιμή $name =  ';
    const DuplicateSyncWorkerSpecializationsNameIdValue = ' To id της υπάρχουσας εγγραφής είναι worker_specialization_id = ';
    
    //sync workers table
    const SyncWorkers = 'Συγχρονισμός με τον πίνακα Workers';
    const SuccessSyncWorkersRecord = 'Επιτυχής καταχώρηση εγγραφής του λεξικού Workers ';
    const FailureSyncWorkersRecord = 'Αποτυχία καταχώρησης εγγραφής του λεξικού Workers ';
    const CommitSyncWorkers = 'Ο συγχρονισμός του λεξικού Workers και η ενημέρωση της βάσης είναι επιτυχής. ';
    const RollBackSyncWorkers = 'Ο συγχρονισμός του λεξικού Workers και η ενημέρωση της βάσης απέτυχαν. ';
    
    const IdenticalSyncWorkerValue = 'Είναι αδύνατη η εισαγωγή. Ενημερώστε το διαχειριστη διότι στο λεξικό Workers υπάρχουν πολλαπλές εγγραφές με τις τιμές των παραμέτρων $registru_no,$tax_number. Τιμές παραμέτρων ';
    const DuplicateSyncWorkerValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Workers υπάρχει ήδη η εγγραφή με την τιμή των παραμέτρων σε διαφορετικό ID . Τιμές παραμέτρων ';
    const DuplicateSyncWorkerIdValue = ' To id της υπάρχουσας εγγραφής είναι worker_id = ';
    
    const DuplicateVocabularySyncWorkerIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Workers με τιμή $worker_id = ';
    const NotFoundVocabularySyncWorkerIdValue = 'Η τιμή της παραμέτρου $worker_id δεν υπάρχει στο λεξικό. Τιμή $worker_id = '; 
    const DuplicateVocabularySyncWorkerSpecializationIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό WorkerSpecialization με τιμή $worker_specialization_id = ';
    const NotFoundVocabularySyncWorkerSpecializationIdValue = 'Η τιμή της παραμέτρου $worker_specialization_id δεν υπάρχει στο λεξικό. Τιμή $worker_specialization_id = '; 
    const DuplicateVocabularySyncWorkerRegistryNoValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Workers με τιμή $registry_no = ';
    const NotFoundVocabularySyncWorkerRegistryNoValue = 'Η τιμή της παραμέτρου $registry_no δεν υπάρχει στο λεξικό. Τιμή $registry_no = '; 
    const DuplicateVocabularySyncWorkerTaxNumberValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Workers με τιμή $tax_number = ';
    const NotFoundVocabularySyncWorkerTaxNumberValue = 'Η τιμή της παραμέτρου $tax_number δεν υπάρχει στο λεξικό. Τιμή $tax_number = '; 

    const IgnoreSyncWorkersRecord = 'Η εγγραφή αγνοήθηκε, λόγω υπάρχουσας ενημερωμένης έκδοσης';
    const SuccessSyncInsertWorkersRecord = 'Επιτυχής εισαγωγή εγγραφής στο λεξικού Workers';
    const SuccessSyncUpdateWorkersRecord = 'Επιτυχής ενημέρωση εγγραφής του λεξικού Workers';
    
  
}
?>