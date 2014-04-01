<?php

/**
 *
 * @version 1.0
 * @author  ΤΕΙ Αθήνας
 * @package Exceptions
 */

header("Content-Type: text/html; charset=utf-8");

/** 
 * Μηνύματα Σφαλμάτων
 * 
 * Παρακάτω εμφανίζονται τα Μηνύματα Σφαλμάτων που διαχειρίζετε η {@see CustomException}
 * 
 */

class ExceptionMessages
{   
    //general messages=========================================================================================================================== 
    
        const NoErrors = 'success';
        const InvalidPageNumber = 'Η παράμετρος $page πρέπει να είναι μεγαλύτερη από 0';
        const InvalidMaxPageNumber = 'Η παράμετρος $page έιναι μεγαλύτερη από την μέγιστη τιμή της σελιδοποίησης. $maxPage = ';
        const InvalidPageType = 'Η παράμετρος $page πρέπει να είναι αριθμητική';
        const InvalidPageSizeNumber = 'Η παράμετρος $pagesize πρέπει να είναι μεγαλύτερη από 0 και < 500';
        const InvalidPageSizeType = 'Η παράμετρος $pagesize πρέπει να είναι αριθμητική';
        const InvalidSortModeType = 'Η παράμετρος $sort_table πρέπει να έχει τιμή "ASC"/"0" ή "DESC"/"1"';
        const InvalidSortFieldType = 'Η παράμετρος $sort_table δεν ειναι υπάρχει στο λεξικό προς ταξινόμηση των στοιχείων';
        const MethodNotFound = 'H μέθοδος δεν βρέθηκε';
        const DeleteError = 'Ενημερώστε τον διαχειριστή! Δεν βρέθηκε η εγγραφή στην βάση δεδομένων προς διαγραφή. ';
        const DeleteNotFoundAquisitionSources = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabAquisitionSources προς διαγραφή με τιμές παραμέτρων .';
        const DeleteNotFoundEquipmentTypes = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabEquipmentTypes προς διαγραφή με τιμές παραμέτρων .';
        const DeleteNotFoundLabWorkers = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabWorkers προς διαγραφή με τιμές παραμέτρων .';
        const DeleteNotFoundLabRelations = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabRelations προς διαγραφή με τιμές παραμέτρων .';
        const DeleteNotFoundLabTransitions = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabTransitions προς διαγραφή με τιμές παραμέτρων .';
        
        const InsertMoreVariablesAquisitionSources ='Δεν είναι δυνατή η προσθήκη περισσότερων τιμών από τις συνολικές τιμές του λεξικού Aquisition_sources < ';
        const InsertMoreVariablesSchoolUnits ='Δεν είναι δυνατή η προσθήκη περισσότερων τιμών από τις συνολικές τιμές του λεξικού School_units < ';
        const InsertMoreVariablesEquipmentTypes ='Δεν είναι δυνατή η προσθήκη περισσότερων τιμών από τις συνολικές τιμές του λεξικού Equipment_types < ';
        const InsertErrorFormatEquipmentTypes = 'Λάθος format εισαγωγής equipment_types ή ελλειπής στοιχεία συμπλήρωσης. H μεταβλητή equipment_types πρέπει να έχει την μορφή "equipment_type=items" : ';
        const InsertErrorFormatRelationServedOnline = 'Λάθος format εισαγωγής relation_served_online ή ελλειπής στοιχεία συμπλήρωσης. H μεταβλητή relation_served_online πρέπει να έχει την μορφή "school_unit=circuit_id" : ';
        const InsertErrorFormatAquisitionSources = 'Λάθος format εισαγωγής aquisition_sources ή ελλειπής στοιχεία συμπλήρωσης. H μεταβλητή aquisition_sources πρέπει να έχει την μορφή "aquisition_source=aquisition_year=aquisition_comment" : ';
        const InsertDuplicateAquisitionSources = 'Δεν είναι δυνατή η εισαγωγή, δύο ή περισσότερων παραμέτρων με τις ίδιες τιμές σε όλα τα πεδία ';
        const InsertDuplicateEquipmentTypes = 'Δεν είναι δυνατή η εισαγωγή, δύο ή περισσότερων παραμέτρων με τις ίδιες τιμές equipment_type = ';
        const InsertDuplicateSchoolUnits = 'Δεν είναι δυνατή η εισαγωγή, δύο ή περισσότερων παραμέτρων με τις ίδιες τιμές school_unit_id = ';
        
        const Unauthorized = 'Unauthorized';
    // dictionary messages (not found)=============================================================================================================
   
        //const InvalidLabValue = 'Το εργαστήριο δεν βρέθηκε';
        const InvalidLabIdValue = 'Το εργαστήριο δεν βρέθηκε';
        const UnknownLabIdValue = 'Αγνωστη τιμή $lab_id';
        const UnknownLabTypeValue = 'Αγνωστη τιμή $lab_type';
        const UnknownLabSourceValue = 'Αγνωστη τιμή $lab_source';
        const UnknownLabStateValue = 'Αγνωστη τιμή $state';
        const UnknownWorkerPositionValue = 'Αγνωστη τιμή $worker_position';
        const UnknownLabWorkerIdValue = 'Αγνωστη τιμή $lab_worker_id';
        const UnknownSchoolUnitValue = 'Αγνωστη τιμή $school_unit';
        const UnknownRelationTypeValue = 'Αγνωστη τιμή $relation_type';
        const UnknownCircuitIdValue = 'Αγνωστη τιμή $circuit_id';
        const UnknownLabRelationIdValue = 'Αγνωστη τιμή $lab_relation_id';
        const UnknownLabAquisitionSourceIdValue = 'Αγνωστη τιμή $lab_aquisition_source_id';
        const UnknownLabTransitionIdValue = 'Αγνωστη τιμή $lab_transition_id';
        const UnknownOperationalRatingValue = 'Αγνωστη τιμή $operational_rating';
        const UnknownTechnologicalRatingValue = 'Αγνωστη τιμή $technological_rating';
        
        const InvalidLabTypeValue = 'Η τιμή της παραμέτρου $lab_type δεν υπάρχει στο λεξικό';
        const InvalidWorkerValue = 'Η τιμή της παραμέτρου $worker δεν υπάρχει στο λεξικό';
        const InvalidSpecializationCodeValue = 'Η τιμή της παραμέτρου $specialization_code δεν υπάρχει στο λεξικό';
        const InvalidEmploymentRelationshipValue = 'Η τιμή της παραμέτρου $employment_relationship δεν υπάρχει στο λεξικό';
        const InvalidAquisitionSourceValue = 'Η τιμή της παραμέτρου $aquisition_source δεν υπάρχει στο λεξικό';
        const InvalidNewAquisitionSourceValue = 'Η τιμή της παραμέτρου $new_aquisition_source δεν υπάρχει στο λεξικό';
        const InvalidEquipmentTypeValue = 'Η τιμή της παραμέτρου $equipment_type δεν υπάρχει στο λεξικό';
        const InvalidNewEquipmentTypeValue = 'Η τιμή της παραμέτρου $new_equipment_type δεν υπάρχει στο λεξικό';
        const InvalidEquipmentCategoryValue = 'Η τιμή της παραμέτρου $equipment_category δεν υπάρχει στο λεξικό';
        const InvalidStateValue = 'Η τιμή της παραμέτρου $state δεν υπάρχει στο λεξικό';
        const InvalidLabSourceValue = 'Η τιμή της παραμέτρου $lab_source δεν υπάρχει στο λεξικό';
        const InvalidWorkerPositionValue = 'Η τιμή της παραμέτρου $worker_position δεν υπάρχει στο λεξικό';
        const NotFoundLabWorkerIDValue = 'Η τιμή της παραμέτρου $lab_worker_id δεν υπάρχει στο λεξικό';
        const NotFoundLabRelationIDValue = 'Η τιμή της παραμέτρου $lab_relation_id δεν υπάρχει στο λεξικό';
        const NotFoundLabAquisitionSourceIdValue = 'Η τιμή της παραμέτρου $lab_aquisition_source_id δεν υπάρχει στο λεξικό';
        const NotFoundLabTransitionIDValue = 'Η τιμή της παραμέτρου $lab_transition_id δεν υπάρχει στο λεξικό';
        
        const InvalidSchoolUnitValue = 'Η τιμή της παραμέτρου $school_unit δεν υπάρχει στο λεξικό';
        const InvalidSchoolUnitTypeValue = 'Η τιμή της παραμέτρου $school_unit_type δεν υπάρχει στο λεξικό';
        const InvalidEducationLevelValue = 'Η τιμή της παραμέτρου $education_level δεν υπάρχει στο λεξικό';
        const InvalidRegionEduAdminValue = 'Η τιμή της παραμέτρου $region_edu_admin δεν υπάρχει στο λεξικό';
        const InvalidEduAdminValue = 'Η τιμή της παραμέτρου $edu_admin δεν υπάρχει στο λεξικό';
        const InvalidTransferAreaValue = 'Η τιμή της παραμέτρου $transfer_area δεν υπάρχει στο λεξικό';
        const InvalidPrefectureValue = 'Η τιμή της παραμέτρου $prefecture δεν υπάρχει στο λεξικό';
        const InvalidMunicipalityValue = 'Η τιμή της παραμέτρου $municipality δεν υπάρχει στο λεξικό';
        const InvalidCircuitPhoneNumberValue = 'Η τιμή της παραμέτρου $phone_number δεν υπάρχει στο λεξικό';
        const InvalidRelationTypeValue = 'Η τιμή της παραμέτρου $relation_type δεν υπάρχει στο λεξικό';
        const InvalidCircuitValue = 'Η τιμή της παραμέτρου $circuit_id με σχολική μονάδα $school_unit_id δεν υπάρχει στο λεξικό';
        
        const InvalidMmIdValue ='Η σχολική μονάδα δεν βρέθηκε';
        const InvalidNameValue='Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό';
        const InvalidCreationDateValue = 'Η τιμή της παραμέτρου $creation_date δεν υπάρχει στο λεξικό';

    //missing values (POST/PUT)===================================================================================================================
        
        const MissingNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή';
        const MissingInfoNameValue = 'Η παράμετρος $info_name πρέπει να έχει τιμή';
        const InvalidSpecialNameValue = 'Η παράμετρος $special_name έχει μη αποδεκτή τιμή';
        const MissingCodeValue = 'Η παράμετρος $code πρέπει να έχει τιμή';
        const InvalidNumberType  = 'Η παράμετρος $number πρέπει να είναι αριθμητική';
        const MissingLabValue  = 'Η παράμετρος $lab_id πρέπει να έχει τιμή';
        const InvalidLabValue  = 'Η παράμετρος $lab_id πρέπει να είναι αριθμητική και >0';
        const MissingRegistryNumberValue  = 'Η παράμετρος $registry_number πρέπει να έχει τιμή';
        const InvalidRegistryNumberValue  = 'Η παράμετρος $registry_number πρέπει να είναι αριθμητική';
        const InvalidPhoneNumberValue  = 'Η παράμετρος $phone_number πρέπει να είναι αριθμητική';
        const InvalidLastNameValue  = 'Η παράμετρος $lastname έχει μη αποδεκτή τιμή (αριθμητική)';
        const MissingFirstNameValue  = 'Η παράμετρος $firstname πρέπει να έχει τιμή';
        const MissingLastNameValue  = 'Η παράμετρος $lastname πρέπει να έχει τιμή';
        const MissingFathernameValue  = 'Η παράμετρος $fathername πρέπει να έχει τιμή';
        const MissingSexValue  = 'Η παράμετρος $sex πρέπει να έχει τιμή';
        const InvalidSexValue  = 'Η παράμετρος $sex πρέπει να έχει τιμή "Α" ή "Θ"';
        const MissingStreetAddressValue  = 'Η παράμετρος $street_address πρέπει να έχει τιμή';
        const MissingPostalCodeValue  = 'Η παράμετρος $postal_code πρέπει να έχει τιμή';
        const InvalidPostalCodeValue  = 'Η παράμετρος $postal_code πρέπει να είναι αριθμητική';
        const MissingItemValue  = 'Η παράμετρος $items πρέπει να έχει τιμή';
        const InvalidItemValue  = 'Η παράμετρος $items πρέπει να είναι αριθμητική και 10000< $items >0 ';
        const InvalidAquisitionYearValue  = 'Η παράμετρος $aquisition_year πρέπει να είναι αριθμητική, >0 και να αποτελείται από 4 αριθμητικά ψηφία ';
        const InvalidAquisitionYearValidValue  = 'Η παράμετρος $aquisition_year πρέπει να έιναι μεταξύ των τιμών "1975 - current_year" ' ;
        const InvalidWorkerStartServiceValue  = 'Η παράμετρος $worker_start_service πρέπει να έχει μορφή ημερομηνίας "Υ-m-d" ';
        const InvalidWorkerStartServiceValidValue  = 'Η παράμετρος $worker_start_service πρέπει να έιναι μεταξύ των τιμών "1975 - current_date" ' ;
        const InvalidTransitionSourceValue  = 'Η παράμετρος $transition_source πρέπει να έχει τιμή "mylab" ή "mmsch"';
        const MissingTransitionDateValue  = 'Η παράμετρος $transition_date πρέπει να έχει τιμή';
        const MissingTransitionSourceValue  = 'Η παράμετρος $transition_source πρέπει να έχει τιμή';
        const MissingTransitionJustificationValue  = 'Η παράμετρος $transition_justification πρέπει να έχει τιμή';
        const InvalidTransitionDateValue  = 'Η παράμετρος $transition_date πρέπει να έχει μορφή ημερομηνίας "Υ-m-d" ';
        const InvalidTransitionDateValidValue  = 'Η παράμετρος $transition_date πρέπει να έιναι μεταξύ των τιμών "1975 - current_date" ' ;
        const InvalidPositioningValue = 'Η παράμετρος $positioning έχει μη αποδεκτή τιμή';
        const InvalidCommentsValue = 'Η παράμετρος $comments έχει μη αποδεκτή τιμή';
        const InvalidTransitionJustificationValue = 'Η παράμετρος $transition_justification έχει μη αποδεκτή τιμή';
        const InvalidRelationServedServiceValue = 'Η παράμετρος $relation_served_service έχει μη αποδεκτή τιμή';
        const InvalidRelationServedOnlineValue = 'Η παράμετρος $relation_served_online έχει μη αποδεκτή τιμή';        
        const InvalidAquisitionSourceInputValue = 'Η παράμετρος $aquisition_source έχει μη αποδεκτή τιμή'; 
        const InvalidEquipmentTypeInputValue = 'Η παράμετρος $equipment_type έχει μη αποδεκτή τιμή';
        const InvalidWorkerInputValue = 'Η παράμετρος $worker πρέπει να είναι αριθμητική';
        const MissingWorkerPositionValue  = 'Η παράμετρος $worker_position πρέπει να έχει τιμή';       
        const MissingLabWorkerIdValue  = 'Η παράμετρος $lab_worker_id πρέπει να έχει τιμή';  
        const InvalidLabWorkerIdValue  = 'Η παράμετρος $lab_worker_id πρέπει να είναι αριθμητική και >0';
        const InvalidWorkerStatusValue  = 'Η παράμετρος $transition_source πρέπει να έχει τιμή "1"(ΕΝΕΡΓΟΣ) ή "3"(ΑΝΕΝΕΡΓΟΣ)'; 
        const MissingAquisitionYearValue  = 'Η παράμετρος $aquisition_year πρέπει να έχει τιμή';
        const InvalidUpdateWorkerStatusValue  = 'Η παράμετρος $transition_source πρέπει να έχει τιμή "3"(ΑΝΕΝΕΡΓΟΣ)';
        const MissingLabRelationIdValue  = 'Η παράμετρος $lab_relation_id πρέπει να έχει τιμή';
        const InvalidLabRelationIdValue  = 'Η παράμετρος $lab_relation_id πρέπει να είναι αριθμητική και >0';
        const MissingLabAquisitionSourceIdValue  = 'Η παράμετρος $lab_aquisition_source_id πρέπει να έχει τιμή';
        const InvalidLabAquisitionSourceIdValue  = 'Η παράμετρος $lab_aquisition_source_id πρέπει να είναι αριθμητική και >0';
        const MissingLabTypeValue  = 'Η παράμετρος $lab_type πρέπει να έχει τιμή';
        const MissingLabSourceValue  = 'Η παράμετρος $lab_source πρέπει να έχει τιμή';
        const MissingLabStateValue  = 'Η παράμετρος $lab_state πρέπει να έχει τιμή';
        const MissingLabTransitionIdValue  = 'Η παράμετρος $lab_transition_id πρέπει να έχει τιμή';
        const InvalidLabTransitionIdValue  = 'Η παράμετρος $lab_transition_id πρέπει να είναι αριθμητική και >0';
        const MissingOperationalRatingValue  = 'Η παράμετρος $operational_rating πρέπει να έχει τιμή';
        const InvalidOperationalRatingValue  = 'Η παράμετρος $operational_rating πρέπει να είναι αριθμητική και >0';
        const MissingTechnologicalRatingValue  = 'Η παράμετρος $technological_rating πρέπει να έχει τιμή';
        const InvalidTechnologicalRatingValue  = 'Η παράμετρος $technological_rating πρέπει να είναι αριθμητική και >0';
        
        const MissingLabParam  = 'Η παράμετρος $lab_id είναι υποχρεωτικό πεδίο';
        const MissingWorkerIdParam  = 'Η παράμετρος $worker_id είναι υποχρεωτικό πεδίο';
        const MissingWorkerStartServiceParam  = 'Η παράμετρος $worker_start_service είναι υποχρεωτικό πεδίο';
        const MissingWorkerPositionParam  = 'Η παράμετρος $worker_position είναι υποχρεωτικό πεδίο';
        const MissingWorkerStatusParam  = 'Η παράμετρος $worker_status είναι υποχρεωτικό πεδίο';
        const MissingEquipmentTypesParam  = 'Η παράμετρος $equipment_types είναι υποχρεωτικό πεδίο';
        const MissingItemsParam  = 'Η παράμετρος $items είναι υποχρεωτικό πεδίο';
        const MissingEquipmentTypeParam  = 'Η παράμετρος $equipment_type είναι υποχρεωτικό πεδίο';
        const MissingLabEquipmentTypeParam  = 'Οι παράμετροι equipment_type,items είναι υποχρεωτικά πεδία';
        const MissingLabAquisitionSourceParam  = 'Η παράμετρος aquisition_source είναι υποχρεωτικά πεδία';
        const MissingAquisitionYearParam  = 'Η παράμετρος aquisition_year είναι υποχρεωτικά πεδία';
        const MissingSchoolUnitParam  = 'Η παράμετρος $school_unit είναι υποχρεωτικό πεδίο';
        const MissingRelationTypeParam  = 'Η παράμετρος $relation_type είναι υποχρεωτικό πεδίο';
        const MissingCircuitIdParam  = 'Η παράμετρος $circuit_id είναι υποχρεωτικό πεδίο';
        const MissingLabRelationIdParam  = 'Η παράμετρος $lab_relation_id είναι υποχρεωτικό πεδίο';       
        const MissingLabAquisitionSourceIdParam  = 'Η παράμετρος $lab_aquisition_source_id είναι υποχρεωτικό πεδίο';    
        const MissingLabTypeParam = 'Η παράμετρος $lab_type είναι υποχρεωτικό πεδίο';  
        const MissingLabSourceParam = 'Η παράμετρος $lab_source είναι υποχρεωτικό πεδίο';  
        const MissingLabStateParam = 'Η παράμετρος $lab_state είναι υποχρεωτικό πεδίο';  
        const MissingLabTransitionIdParam  = 'Η παράμετρος $lab_transition_id είναι υποχρεωτικό πεδίο';
        const MissingTransitionDateParam  = 'Η παράμετρος $transition_date είναι υποχρεωτικό πεδίο';
        const MissingTransitionSourceParam  = 'Η παράμετρος $transition_source είναι υποχρεωτικό πεδίο';
        const MissingTransitionJustificationParam  = 'Η παράμετρος $transition_justification είναι υποχρεωτικό πεδίο';
        const MissingCircuitPhoneNumberParam  = 'Η παράμετρος $phone_number είναι υποχρεωτικό πεδίο';
        const MissingOperationalRatingParam  = 'Η παράμετρος $operational_rating είναι υποχρεωτικό πεδίο';
        const MissingTechnologicalRatingParam  = 'Η παράμετρος $technological_rating είναι υποχρεωτικό πεδίο';
        
        
        const MissingLabTypeIdValue  = 'Η παράμετρος $lab_type_id πρέπει να έχει τιμή';
        const InvalidLabTypeIdValue  = 'Η παράμετρος $lab_type_id πρέπει να είναι αριθμητική και >0 ';
        const MissingSpecializationCodeIdValue = 'Η παράμετρος $specialization_code_id πρέπει να έχει τιμή';
        const InvalidSpecializationCodeIdValue  = 'Η παράμετρος $specialization_code_id πρέπει να είναι αριθμητική και >0 ';
        const MissingEmploymentRelationshipIdValue = 'Η παράμετρος $employment_relationship_id πρέπει να έχει τιμή';
        const InvalidEmploymentRelationshipIdValue  = 'Η παράμετρος $employment_relationship_id πρέπει να είναι αριθμητική και >0 ';
        const MissingAquisitionSourceIdValue = 'Η παράμετρος $aquisition_source_id πρέπει να έχει τιμή';
        const InvalidAquisitionSourceIdValue  = 'Η παράμετρος $aquisition_source_id πρέπει να είναι αριθμητική και >0 ';
        const MissingNewAquisitionSourceIdValue = 'Η παράμετρος $new_aquisition_source πρέπει να έχει τιμή';
        const MissingEquipmentTypeIdValue = 'Η παράμετρος $equipment_type_id πρέπει να έχει τιμή'; 
        const InvalidEquipmentTypeIdValue  = 'Η παράμετρος $equipment_type_id πρέπει να είναι αριθμητική και >0 ';
        const MissingNewEquipmentTypeIdValue = 'Η παράμετρος $new_equipment_type πρέπει να έχει τιμή';
        const MissingEquipmentCategoryIdValue = 'Η παράμετρος $equipment_category_id πρέπει να έχει τιμή'; 
        const InvalidEquipmentCategoryIdValue  = 'Η παράμετρος $equipment_category_id πρέπει να είναι αριθμητική και >0 ';
        const MissingLabResponsibleIdValue = 'Η παράμετρος $lab_responsible_id πρέπει να έχει τιμή'; 
        const InvalidLabResponsibleIdValue  = 'Η παράμετρος $lab_responsible_id πρέπει να είναι αριθμητική και >0 ';
        const MissingLabWorkerValue = 'Η παράμετρος $lab_worker πρέπει να έχει τιμή'; 
        const MissingWorkerStartServiceValue = 'Η παράμετρος $worker_start_service πρέπει να έχει τιμή'; 
        const MissingWorkerValue = 'Η παράμετρος $worker πρέπει να έχει τιμή';        
        const MissingEquipmentTypeValue = 'Η παράμετρος $equipment_type πρέπει να έχει τιμή'; 
        const MissingAquisitionSourceValue = 'Η παράμετρος $aquisition_source πρέπει να έχει τιμή'; 
        
        const MissingSchoolUnitIdValue = 'Η παράμετρος $school_unit_id πρέπει να έχει τιμή'; 
        const InvalidSchoolUnitIdValue  = 'Η παράμετρος $school_unit_id πρέπει να είναι αριθμητική και >0 ';
        const MissingEducationLevelIdValue = 'Η παράμετρος $education_level_id πρέπει να έχει τιμή'; 
        const InvalidEducationLevelIdValue  = 'Η παράμετρος $education_level_id πρέπει να είναι αριθμητική και >0 ';
        const MissingSchoolUnitTypeIdValue = 'Η παράμετρος $school_unit_type_id πρέπει να έχει τιμή'; 
        const InvalidSchoolUnitTypeIdValue  = 'Η παράμετρος $school_unit_type_id πρέπει να είναι αριθμητική και >0 ';
        const MissingRegionEduAdminIdValue = 'Η παράμετρος $region_edu_admin_id πρέπει να έχει τιμή'; 
        const InvalidRegionEduAdminIdValue  = 'Η παράμετρος $region_edu_admin_id πρέπει να είναι αριθμητική και >0 ';
        const MissingEduAdminIdValue = 'Η παράμετρος $edu_admin_id πρέπει να έχει τιμή'; 
        const InvalidEduAdminIdValue  = 'Η παράμετρος $edu_admin_id πρέπει να είναι αριθμητική και >0 ';
        const MissingTranferAreaIdValue = 'Η παράμετρος $transfer_area_id πρέπει να έχει τιμή'; 
        const InvalidTranferAreaIdValue  = 'Η παράμετρος $transfer_area_id πρέπει να είναι αριθμητική και >0 ';
        const MissingMunicipalityIdValue = 'Η παράμετρος $municipality_id πρέπει να έχει τιμή'; 
        const InvalidMunicipalityIdValue  = 'Η παράμετρος $municipality_id πρέπει να είναι αριθμητική και >0 ';
        const MissingPrefectureIdValue = 'Η παράμετρος $prefecture_id πρέπει να έχει τιμή'; 
        const InvalidPrefectureIdValue  = 'Η παράμετρος $prefecture_id πρέπει να είναι αριθμητική και >0 ';
        const InvalidFromDiscontinuedToStateIdValue  = 'Η παράμετρος $to_state δεν μπορεί να πάρει τιμή, διότι η παράμετρος $from_state εχεί τιμή 3=ΚΑΤΑΡΓΗΜΕΝΗ και δεν αλλάζει η κατάσταση.';
        const InvalidSameFromToStateValue  = 'Η παράμετρος $to_state και η παράμετρος $from_state έχουν την ίδια τιμή και δεν αλλάζει η κατάσταση.';
        const MissingRelationTypeValue = 'Η παράμετρος $relation_type πρέπει να έχει τιμή'; 
        const InvalidRelationTypeIdValue ='Η παράμετρος $relation_type πρέπει να είναι αριθμητική και >0 ';
        const MissingCircuitIdValue ='Η παράμετρος $circuit πρέπει να έχει τιμή ';
        const InvalidCircuitIdValue ='Η παράμετρος $circuit πρέπει πρέπει να είναι αριθμητική και >0 ';
        const MissingCircuitPhoneNumberValue ='Η παράμετρος $phone_number πρέπει να έχει τιμή ';
        const InvalidCircuitIdPhoneNumberValue ='Η παράμετρος $phone_number πρέπει πρέπει να είναι αριθμητική και >0 ';
        
    //not found values for create/update rows(PUT)================================================================================================================= 
    
        const UpdateLabIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $lab_id';
        const UpdateLabTypeIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $lab_type_id';
        const UpdateLabResponsibleIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $lab_responsible_id';
        const UpdateSpecializationCodeIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $specialization_code_id';
        const UpdateEmploymentRelationshipIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $employment_relationship_id';
        const UpdateAquisitionSourceIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $aquisition_source_id';
        const UpdateEquipmentTypeIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $equipment_type_id';
        const UpdateEquipmentCategoryIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $equipment_category_id';
        const UpdateLabHasAquisitionSourceIdValue = 'Δεν υπάρχει εγγραφή με τις τιμές των παραμέτρων';
        const UpdateLabHasEquipmentTypeIdValue = 'Δεν υπάρχει εγγραφή με τις τιμές των παραμέτρων';
        const UpdateLabsIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $lab_id';
        const UpdateLabAquisitionSourcesValue = 'Δεν υπάρχει εγγραφή με τις τιμές των παραμέτρων';
        const UpdateLabEquipmentTypesValue = 'Δεν υπάρχει εγγραφή με τις τιμές των παραμέτρων';
        
        const UpdateSchoolUnitIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $school_unit_id';
        const UpdateSchoolUnitTypeIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $school_unit_type_id';
        const UpdateEducationLevelIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $education_level_id';
        const UpdateRegionEduAdminIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $region_edu_admin_id';
        const UpdateEduAdminIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $edu_admin_id';  
        const UpdateTransferAreaIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $transfer_area_id';
        const UpdatePrefectureIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $prefecture_id';  
        const UpdateMunicipalityIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $municipality_id';  
    
    //required fields(foreign keys) for create a new field (POST)==============================================================================================================
        
        const CreateLabTypeIdValue = 'Το πεδίο $lab_type είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateLabResponsibleIdValue = 'Το πεδίο $lab_responsible είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateSpecializationCodeIdValue = 'Το πεδίο $specialization_code είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateEmploymentRelationshipIdValue = 'Το πεδίο $employment_relationship είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateAquisitionSourceIdValue = 'Το πεδίο $aquisition_source είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateEquipmentTypeIdValue = 'Το πεδίο $equipment_type είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateEquipmentCategoryIdValue = 'Το πεδίο $equipment_category είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateStateIDValue = 'Το πεδίο $state είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateToStateValue = 'Το πεδίο $to_state είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateLabSourceIdValue = 'Το πεδίο $lab_source είναι υποχρεωτικό πρός συμπλήρωση ';
          
        const CreateSchoolUnitIdValue = 'Το πεδίο $school_unit είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateSchoolUnitTypeIdValue = 'Το πεδίο $school_unit_type είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateEducationLevelIdValue = 'Το πεδίο $education_level είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateRegionEduAdminIdValue = 'Το πεδίο $region_edu_admin είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateEduAdminIdValue = 'Το πεδίο $edu_admin είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateTransferAreaIdValue = 'Το πεδίο $transfer_area είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreatePrefectureIdValue = 'Το πεδίο $prefecture είναι υποχρεωτικό πρός συμπλήρωση ';
        const CreateMunicipalityIdValue = 'Το πεδίο $municipality είναι υποχρεωτικό πρός συμπλήρωση ';

    //warning about duplicate vocabulary values when create or update a field values(POST/PUT)=============================================================================================================================
    
        const DuplicateRegistryNumberValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη υπεύθυνος εργαστηρίου με με την τιμή της παραμέτρου $registry_number ';
        const DuplicateLabWorkerValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη υπεύθυνος εργαστηρίου με με την τιμή της παραμέτρου $worker_id ';
        const DuplicateLabTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Lab_Types υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateInfoLabTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Lab_Types υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $info_name ';
        const DuplicateSpecializationCodeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Specialization_Codes υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $code ';
        const DuplicateEmploymentRelationshipValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Employment_Relationships υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateAquisitionSourceValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Aquisitions_Sources υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateEquipmentTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Equipment_Types υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateEquipmentCategoryValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Equipment_Categories υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateLabHasAquisitionSourceValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
        const DuplicateLabHasEquipmentTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
        const DuplicateRelationServedServiceValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
        const DuplicateLabValue = 'Είναι αδύνατη η εισαγωγή, διότι στο πίνακα Labs υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateRelationServedOnlineValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
        const DuplicateLabTransitionsValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
        const DuplicateLabsValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
        const DuplicateUpdateLabWorkerValue = 'Είναι αδύνατη η ενημέρωση της εγγραφής διότι υπάρχει ενεργός υπεύθυνος εργαστηρίου';
        const DuplicateLabAquisitionSourceValue = 'Είναι αδύνατη η ενημέρωση, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
        const DuplicateLabEquipmentTypeValue = 'Είναι αδύνατη η ενημέρωση, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
        const DuplicateLabRelationValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
        const DuplicateLabRelationServerOnlineValue = 'Είναι αδύνατη η εισαγωγή, διότι το εργαστήριο εξυπηρετείται διαδικτυακά από σχολική μονάδα.';
        const DuplicateLabTransitionValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με τιμές ';

        const DuplicateSchoolUnitValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη σχολική μονάδα με την τιμή της παραμέτρου $name ';
        const DuplicateSchoolUnitTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό School_Unit_Types υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateEducationLevelValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Education_Level υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';   
        const DuplicateRegionEduAdminValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Region_Edu_Admins υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateEduAdminValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Edu_Admin υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateTransferAreaValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Transform_Areas υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicateMunicipalityValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Municipalities υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
        const DuplicatePrefectureValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Prefectures υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';

    //found duplicated values into a vocabulary table. This is a very critical error.( POST/PUT)==========================================================================================================================
    
        const DuplicateLabsIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_id ';  
        const DuplicateLabTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Lab_Types με τιμή $lab_type_id';
        const DuplicateWorkerIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Workers με τιμή $lab_responsible_id';
        const DuplicateSpecializationCodeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Specialization_Codes με τιμή $specialization_code_id ';  
        const DuplicateEmploymentRelationshipIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Employment_Relationships με τιμή $employment_relatioship_id ';  
        const DuplicateAquisitionSourceIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Aquisition_Sources με τιμή $aquisition_source_id';
        const DuplicateEquipmentTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Equipment_Types με τιμή $equipment_type_id';  
        const DuplicateEquipmentCategoryIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Equipment_Category με τιμή $equipment_category_id ';
        const DuplicateLabHasAquisitionSourceIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με τα ίδια primary keys, στο πίνακα Labs_Have_Aquisition_Sources με τις τιμές των παραμέτρων';
        const DuplicateLabHasEquipmentTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με τα ίδια primary keys, στο πίνακα Labs_Have_Equipment_Types με τις τιμές των παραμέτρων';
        const DuplicateStateIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό States με τιμή $state_id';  
        const DuplicateLabSourceIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Sources με τιμή $lab_source_id';  
        const DuplicateWorkerPositionIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Worker_Positions με τιμή $worker_position';
        const DuplicateLabWorkerIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_worker_id ';                
        const DuplicateLabRelationIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_relation_id ';  
        const DuplicateLabAquisitionSourceIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_aquisition_source_id '; 
        const DuplicateLabTransitionIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_transition_id ';  
        
        const DuplicateSchoolUnitIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό School_Units με τιμή $school_unit_id';  
        const DuplicateSchoolUnitTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό School_Unit_Types με τιμή $school_unit_type_id';
        const DuplicateEducationLevelIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Education_Level με τιμή $education_level_id'; 
        const DuplicateRegionEduAdminIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Region_Edu_Admins με τιμή $region_edu_admin_id';
        const DuplicateEduAdminIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Edu_Admins με τιμή $edu_admin_id';
        const DuplicateTransferAreaIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Transfer_Areas με τιμή $transfer_area_id';
        const DuplicateMunicipalityIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Municipalities με τιμή $municipality_id';
        const DuplicatePrefectureIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Prefectures με τιμή $prefecture_id';
        const DuplicateCircuitPhoneNumberValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Circuits με τιμή $phone_number';  
        const DuplicateRelationTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Relation_Types με τιμή $relation_type_id';  
        const DuplicateCircuitValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Circuits με τιμή $circuit_id και $school_unit_id'; 
    //not found vocabulary value for delete rows(PUT)================================================================================================================= 

        const DeleteNotFoundLabNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο πίνακα Labs ';
        const DeleteNotFoundLabTypeNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο πίνακα Lab_Types ';
        const DeleteNotFoundLabResponsibleRegistryNumberValue = 'Η τιμή της παραμέτρου $registry_number δεν υπάρχει στο πίνακα Lab_Responsibles';
        const DeleteNotFoundSpecializationCodeNameValue = 'Η τιμή της παραμέτρου $code δεν υπάρχει στο λεξικό Specialization_Codes';
        const DeleteNotFoundEmploymentRelationshipNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Employment_Relationships';
        const DeleteNotFoundAquisitionSourceNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Aquisition_Sources';
        const DeleteNotFoundNewAquisitionSourceNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Aquisition_Sources';
        const DeleteNotFoundEquipmentTypeNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Equipment_Types';
        const DeleteNotFoundNewEquipmentTypeNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Equipment_Types';
        const DeleteNotFoundEquipmentCategoryNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Equipment_Categories';
        const DeleteNotFoundLabHasAquisitionSourceLabIdValue = 'Η τιμή της παραμέτρου $lab_id δεν υπάρχει στο πίνακα LabsHaveAquisitionSources';
        const DeleteNotFoundLabHasEquipmentTypeLabIdValue = 'Η τιμή της παραμέτρου $lab_id δεν υπάρχει στο πίνακα LabsHaveEquipmentTypes';
        const DeleteNotFoundLabHasAquisitionSourceValue = 'Η τιμή της παραμέτρου $aquisition_source δεν υπάρχει στο πίνακα LabsHaveAquisitionSources';
        const DeleteNotFoundLabHasEquipmentTypeValue = 'Η τιμή της παραμέτρου $equipment_type δεν υπάρχει στο πίνακα LabsHaveEquipmentTypes';
        
        const DeleteNotFoundSchoolUnitNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο πίνακα School_Units';
        const DeleteNotFoundSchoolUnitTypeNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό School_Units_Types';
        const DeleteNotFoundEducationLevelNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Education_Levels';
        const DeleteNotFoundRegionEduAdminNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Region_Edu_Admins';
        const DeleteNotFoundEduAdminNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Edu_Admins';
        const DeleteNotFoundTransferAreaNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Transfer_Areas';
        const DeleteNotFoundPrefectureNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Prefectures';
        const DeleteNotFoundMunicipalityNameValue = 'Η τιμή tης παραμέτρου $name δεν υπάρχει στο λεξικό Municipalities';
            
    //required fields for delete fields==========================================================================================================================================
    
        const DeleteLabNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteLabResponsibleRegistryNumberValue = 'Το πεδίο $registry_number είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteAquisitionNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteEmploymentRelationshipNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteSpecializationCodeValue = 'Το πεδίο $code είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteLabTypeNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteEquipmentTypeNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteEquipmentCategoryNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteLabHasAquisitionSourceLabIdValue = 'Το πεδίο $lab_id είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteLabHasEquipmentTypeLabIdValue = 'Το πεδίο $lab_id είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteLabWorkerIdValue = 'Το πεδίο $lab_worker_id είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        
        
        const DeleteSchoolUnitNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteSchoolUnitTypeNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteEducationLevelNameValue ='Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteRegionEduAdminNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteEduAdminNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteTransferAreaNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeletePrefectureNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
        const DeleteMunicipalityNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';

    //restricted deletion of duplicate values=========================================================================================================================================
        
        const DuplicateDelLabNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο πίνακα Labs με την τιμή της παραμέτρου $name';
        const DuplicateDelLabResponsibleRegistryNumberValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο πίνακα LabResponsibles με την τιμή της παραμέτρου $registry_number';
        const DuplicateDelAquisitionNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Aquisition_Sources με την τιμή της παραμέτρου $name';
        const DuplicateDelEmploymentRelationshipNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Employment_Relationships με την τιμή της παραμέτρου $name';
        const DuplicateDelSpecializationCodeValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Specialization_Codes με την τιμή της παραμέτρου $code';
        const DuplicateDelLabTypeNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Lab_Types με την τιμή της παραμέτρου $name';
        const DuplicateDelEquipmentTypeNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Equipment_Types με την τιμή της παραμέτρου $name';
        const DuplicateDelEquipmentCategoryNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Equipment_Categories με την τιμή της παραμέτρου $name';
        
        const DuplicateDelSchoolUnitNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο πίνακα School_Units με την τιμή της παραμέτρου $name';
        const DuplicateDelSchoolUnitTypeNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό School_Unit_Types με την τιμή της παραμέτρου $name';
        const DuplicateDelEducationLevelNameValue ='Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Education_Levels με την τιμή της παραμέτρου $name';
        const DuplicateDelRegionEduAdminNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Region_Edu_Admins με την τιμή της παραμέτρου $name';
        const DuplicateDelEduAdminNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό  Edu_Admins με την τιμή της παραμέτρου $name';
        const DuplicateDelTransferAreaNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Transfer_Areas με την τιμή της παραμέτρου $name';
        const DuplicateDelPrefectureNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Prefectures με την τιμή της παραμέτρου $name';
        const DuplicateDelMunicipalityNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Municipalities με την τιμή της παραμέτρου $name';
        
    //restricted deletion of references values on other tables==========================================================================================================================
        
        const ReferencesAquisitionSources = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα AquisitionSources. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα AquisitionSources 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesEmploymentRelationships = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EmploymentRelationships. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EmploymentRelationships 
                                            με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων  στις εγγραφές στις που επηρεάζονται';
        const ReferencesSpecializationCodes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα SpecializationCodes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα SpecializationCodes 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesLabTypes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabTypes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabTypes 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesEquipmentTypes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EquipmentTypes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EquipmentTypes 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesEquipmentCategories = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EquipmentCategories. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EquipmentCategories 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesLabAquisitionSources = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabAquisitionSources. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabAquisitionSources 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesLabEquipmentTypes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabEquipmentTypes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabEquipmentTypes 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesLabs = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα Labs. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα Labs 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesLabResponsibles = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabResponsibles. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabResponsibles 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesLabWorkers = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabWorkers. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabWorkers 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesLabRelations = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabRelations. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabRelations 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesLabTransitions = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabTransitions. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabTransitions 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        
        
        
        const ReferencesSchoolUnitTypes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα SchoolUnitTypes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα SchoolUnitTypes 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesEducationLevels = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EducationLevels. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EducationLevels 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesRegionEduAdmins = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα RegionEduAdmins. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα RegionEduAdmins 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesEduAdmins = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EduAdmins. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EduAdmins 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesTransferAreas = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα TransferAreas. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα TransferAreas 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesPrefectures = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα Prefectures. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα Prefectures 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesMunicipalities = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα Municipalities. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα Municipalities 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        const ReferencesSchoolUnits = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα SchoolUnits. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα SchoolUnits 
                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
        
        //postEquipmentTypes
        const NotAllowedLabEquipmentTypes = 'Δεν είναι δυνατή η ταυτόχρονη εισαγωγή πολλαπλών τιμών και μοναδικής τιμής equipment_type=items ';
        const NotAllowedLabAquisitionSources = 'Δεν είναι δυνατή η ταυτόχρονη εισαγωγή πολλαπλών τιμών και μοναδικής τιμής aquisition_source=aquisition_year=aquisition_comments ';
        const NotAllowedLabWorkerStartService = 'Δεν είναι δυνατή η εισαγωγή ημερομηνίας προγενέστερη από την ημερομηνία εισαγωγής του προηγούμενου υπεύθυνου';
        const NotAllowedLabTransitionService = 'Δεν είναι δυνατή η εισαγωγή ημερομηνίας προγενέστερη από την ημερομηνία εισαγωγής της προηγούμενης κατάστασης';
        const ConflictLabTransitionWithLabsValue = 'Η κατάσταση του εργαστηρίου στον πίνακα Labs είναι διαφορετική από την τελική κατάσταση του εργαστηρίου στον πίνακα LabTransitions';
        
        //update
        const ErrorUpdateLabWorkerStatus = "Αποτυχία ενημέρωσης της εγγραφής";
        const ErrorUpdateLabTransitionStatus = "Αποτυχία ενημέρωσης της εγγραφής";
        const ErrorUpdateLabRelationStatus = "Αποτυχία ενημέρωσης της εγγραφής";
        
        //lab_relations
        const ErrorInputCircuitIdParam  = 'Η παράμετρος $circuit_id δεν επιτρέπεται στην περίπτωση που το relation_type=2(ΕΞΥΠΗΡΕΤΕΙ ΥΠΗΡΕΣΙΑΚΑ)';
        const ErrorInputLabTransitionsValues  = 'Δεν είναι επιτρεπτή η καταχώρηση τιμών aquisition_source, aquisition_justification, aquisition_date χωρίς την καταχώρηση τιμής state';
        
        //delete lab_transitions
        const ReferencesLabTransitionsValue = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα Labs.Γίνεται προσπάθεια διαγραφής της τελευταίας κατάστασης του εργαστηρίου';
        
        //post labs
        const NotAllowedLabNameValue = 'Δεν επιτρέπεται η δημιουργία εργαστηρίου σε σχολικές μονάδες που είναι σε αναστολή ή καταργημένες';
        
}
   ?>