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
        const UserNoRoleAccess = 'Ο χρήστης δεν έχει κανένα ρόλο, και δεν επιτρεπεται η πρόσβαση.';
        const UserAccesDenied = 'Πολλαπλα ονόματα χρήστη. Ο χρήστης δεν έχει πρόσβαση';
        const UserAccesFrontDenied = 'Δεν σταλθηκα δεδομένα του χρήστη.Ο χρήστης δεν έχει πρόσβαση';
        const UserAccesEmptyDenied = 'Ονομα χρήστη κενό. Ο χρήστης δεν έχει πρόσβαση';
        const UserNoRolePermissions = 'Ο χρήστης δεν έχει συγκεριμενα δικαιώματα πρόσβασης';
        //const InvalidPageNumber = 'Η παράμετρος $page πρέπει να είναι μεγαλύτερη από 0';
        //const InvalidPageType = 'Η παράμετρος $page πρέπει να είναι αριθμητική';
        //const InvalidPageSizeNumber = 'Η παράμετρος $pagesize πρέπει να είναι μεγαλύτερη από 0 και < 500';
        //const InvalidPageSizeType = 'Η παράμετρος $pagesize πρέπει να είναι αριθμητική';
//        const InvalidSortModeType = 'Η παράμετρος $sort_table πρέπει να έχει τιμή "ASC"/"0" ή "DESC"/"1"';
//        const InvalidSortFieldType = 'Η παράμετρος $sort_table δεν ειναι υπάρχει στο λεξικό προς ταξινόμηση των στοιχείων';
//        const InvalidExport = 'Η παράμετρος $export δεν υπάρχει στο λεξικό';
        const MethodNotFound = 'H μέθοδος δεν βρέθηκε';
//        const DeleteError = 'Ενημερώστε τον διαχειριστή! Δεν βρέθηκε η εγγραφή στην βάση δεδομένων προς διαγραφή. ';
//        const DeleteNotFoundAquisitionSources = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabAquisitionSources προς διαγραφή με τιμές παραμέτρων .';
//        const DeleteNotFoundEquipmentTypes = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabEquipmentTypes προς διαγραφή με τιμές παραμέτρων .';
//        const DeleteNotFoundLabWorkers = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabWorkers προς διαγραφή με τιμές παραμέτρων .';
//        const DeleteNotFoundLabRelations = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabRelations προς διαγραφή με τιμές παραμέτρων .';
//        const DeleteNotFoundLabTransitions = 'Δεν βρέθηκε η εγγραφή στoν πίνακα LabTransitions προς διαγραφή με τιμές παραμέτρων .';
//        
//        const InsertMoreVariablesAquisitionSources ='Δεν είναι δυνατή η προσθήκη περισσότερων τιμών από τις συνολικές τιμές του λεξικού Aquisition_sources < ';
//        const InsertMoreVariablesSchoolUnits ='Δεν είναι δυνατή η προσθήκη περισσότερων τιμών από τις συνολικές τιμές του λεξικού School_units < ';
//        const InsertMoreVariablesEquipmentTypes ='Δεν είναι δυνατή η προσθήκη περισσότερων τιμών από τις συνολικές τιμές του λεξικού Equipment_types < ';
//        const InsertErrorFormatEquipmentTypes = 'Λάθος format εισαγωγής equipment_types ή ελλειπής στοιχεία συμπλήρωσης. H μεταβλητή equipment_types πρέπει να έχει την μορφή "equipment_type=items" : ';
//        const InsertErrorFormatRelationServedOnline = 'Λάθος format εισαγωγής relation_served_online ή ελλειπής στοιχεία συμπλήρωσης. H μεταβλητή relation_served_online πρέπει να έχει την μορφή "school_unit=circuit_id" : ';
//        const InsertErrorFormatAquisitionSources = 'Λάθος format εισαγωγής aquisition_sources ή ελλειπής στοιχεία συμπλήρωσης. H μεταβλητή aquisition_sources πρέπει να έχει την μορφή "aquisition_source=aquisition_year=aquisition_comment" : ';
//        const InsertDuplicateAquisitionSources = 'Δεν είναι δυνατή η εισαγωγή, δύο ή περισσότερων παραμέτρων με τις ίδιες τιμές σε όλα τα πεδία ';
//        const InsertDuplicateEquipmentTypes = 'Δεν είναι δυνατή η εισαγωγή, δύο ή περισσότερων παραμέτρων με τις ίδιες τιμές equipment_type = ';
//        const InsertDuplicateSchoolUnits = 'Δεν είναι δυνατή η εισαγωγή, δύο ή περισσότερων παραμέτρων με τις ίδιες τιμές school_unit_id = ';
//        
//        const Unauthorized = 'Unauthorized';
//    // dictionary messages (not found)=============================================================================================================
//   
//
//        const UnknownLabIdValue = 'Αγνωστη τιμή lab_id';
//        const UnknownLabTypeValue = 'Αγνωστη τιμή lab_type';
//        const UnknownLabSourceValue = 'Αγνωστη τιμή lab_source';
//        const UnknownLabStateValue = 'Αγνωστη τιμή state';
//        const UnknownWorkerPositionValue = 'Αγνωστη τιμή worker_position';
//        const UnknownLabWorkerIdValue = 'Αγνωστη τιμή lab_worker_id';
//        const UnknownSchoolUnitValue = 'Αγνωστη τιμή school_unit';
//        const UnknownRelationTypeValue = 'Αγνωστη τιμή relation_type';
//        const UnknownCircuitIdValue = 'Αγνωστη τιμή circuit_id';
//        const UnknownLabRelationIdValue = 'Αγνωστη τιμή lab_relation_id';
//        const UnknownLabAquisitionSourceIdValue = 'Αγνωστη τιμή lab_aquisition_source_id';
//        const UnknownLabTransitionIdValue = 'Αγνωστη τιμή lab_transition_id';
//        const UnknownOperationalRatingValue = 'Αγνωστη τιμή operational_rating';
//        const UnknownTechnologicalRatingValue = 'Αγνωστη τιμή technological_rating';
//        const UnknowneEduAdminCodeValue = 'Αγνωστη τιμή edu_admin_code';
//        
//        const InvalidLabIdValue = 'Το εργαστήριο δεν βρέθηκε';
//        const InvalidMmIdValue ='Η σχολική μονάδα δεν βρέθηκε';
//        const InvalidNameValue='Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό';
//        const InvalidCreationDateValue = 'Η τιμή της παραμέτρου $creation_date δεν υπάρχει στο λεξικό';
//        const InvalidCircuitPhoneNumberValue = 'Η τιμή της παραμέτρου $phone_number δεν υπάρχει στο λεξικό';
//        const InvalidSpecializationCodeValue = 'Η τιμή της παραμέτρου $specialization_code δεν υπάρχει στο λεξικό';
//        const InvalidEmploymentRelationshipValue = 'Η τιμή της παραμέτρου $employment_relationship δεν υπάρχει στο λεξικό';
//        const InvalidNewAquisitionSourceValue = 'Η τιμή της παραμέτρου $new_aquisition_source δεν υπάρχει στο λεξικό';
//        const InvalidNewEquipmentTypeValue = 'Η τιμή της παραμέτρου $new_equipment_type δεν υπάρχει στο λεξικό';
//        
//        const NotFoundLabWorkerIDValue = 'Η τιμή της παραμέτρου $lab_worker_id δεν υπάρχει στο λεξικό';
//        const NotFoundLabRelationIDValue = 'Η τιμή της παραμέτρου $lab_relation_id δεν υπάρχει στο λεξικό';
//        const NotFoundLabAquisitionSourceIdValue = 'Η τιμή της παραμέτρου $lab_aquisition_source_id δεν υπάρχει στο λεξικό';
//        const NotFoundLabTransitionIDValue = 'Η τιμή της παραμέτρου $lab_transition_id δεν υπάρχει στο λεξικό';
//
//    //missing values (POST/PUT)===================================================================================================================
//        
//        const MissingNameValue = 'Η παράμετρος $name πρέπει να έχει τιμή';
//        const MissingInfoNameValue = 'Η παράμετρος $info_name πρέπει να έχει τιμή';
//        const InvalidSpecialNameValue = 'Η παράμετρος $special_name έχει μη αποδεκτή τιμή';
//        const MissingCodeValue = 'Η παράμετρος $code πρέπει να έχει τιμή';
//        const InvalidNumberType  = 'Η παράμετρος $number πρέπει να είναι αριθμητική';
//        const MissingRegistryNumberValue  = 'Η παράμετρος $registry_number πρέπει να έχει τιμή';
//        const InvalidRegistryNumberValue  = 'Η παράμετρος $registry_number πρέπει να είναι αριθμητική';
//        const InvalidPhoneNumberValue  = 'Η παράμετρος $phone_number πρέπει να είναι αριθμητική';
//        const InvalidLastNameValue  = 'Η παράμετρος $lastname έχει μη αποδεκτή τιμή (αριθμητική)';
//        const MissingFirstNameValue  = 'Η παράμετρος $firstname πρέπει να έχει τιμή';
//        const MissingLastNameValue  = 'Η παράμετρος $lastname πρέπει να έχει τιμή';
//        const MissingFathernameValue  = 'Η παράμετρος $fathername πρέπει να έχει τιμή';
//        const MissingSexValue  = 'Η παράμετρος $sex πρέπει να έχει τιμή';
//        const InvalidSexValue  = 'Η παράμετρος $sex πρέπει να έχει τιμή "Α" ή "Θ"';
//        const MissingStreetAddressValue  = 'Η παράμετρος $street_address πρέπει να έχει τιμή';
//        const MissingPostalCodeValue  = 'Η παράμετρος $postal_code πρέπει να έχει τιμή';
//        const InvalidPostalCodeValue  = 'Η παράμετρος $postal_code πρέπει να είναι αριθμητική';
//        const MissingItemValue  = 'Η παράμετρος $items πρέπει να έχει τιμή';
//        const InvalidItemValue  = 'Η παράμετρος $items πρέπει να είναι αριθμητική και 10000< $items >0 ';
//        const InvalidAquisitionYearValue  = 'Η παράμετρος $aquisition_year πρέπει να είναι αριθμητική, >0 και να αποτελείται από 4 αριθμητικά ψηφία ';
//        const InvalidAquisitionYearValidValue  = 'Η παράμετρος $aquisition_year πρέπει να έιναι μεταξύ των τιμών "1975 - current_year" ' ;
//        const InvalidWorkerStartServiceValue  = 'Η παράμετρος $worker_start_service πρέπει να έχει μορφή ημερομηνίας "Υ-m-d" ';
//        const InvalidWorkerStartServiceValidValue  = 'Η παράμετρος $worker_start_service πρέπει να έιναι μεταξύ των τιμών "1975 - current_date" ' ;
//        const InvalidTransitionSourceValue  = 'Η παράμετρος $transition_source πρέπει να έχει τιμή "mylab" ή "mmsch"';
//        const MissingTransitionDateValue  = 'Η παράμετρος $transition_date πρέπει να έχει τιμή';
//        const MissingTransitionSourceValue  = 'Η παράμετρος $transition_source πρέπει να έχει τιμή';
//        const MissingTransitionJustificationValue  = 'Η παράμετρος $transition_justification πρέπει να έχει τιμή';
//        const InvalidTransitionDateValue  = 'Η παράμετρος $transition_date πρέπει να έχει μορφή ημερομηνίας "Υ-m-d" ';
//        const InvalidTransitionDateValidValue  = 'Η παράμετρος $transition_date πρέπει να έιναι μεταξύ των τιμών "1975 - current_date" ' ;
//        const InvalidPositioningValue = 'Η παράμετρος $positioning έχει μη αποδεκτή τιμή';
//        const InvalidCommentsValue = 'Η παράμετρος $comments έχει μη αποδεκτή τιμή';
//        const InvalidTransitionJustificationValue = 'Η παράμετρος $transition_justification έχει μη αποδεκτή τιμή';
//        const InvalidRelationServedServiceValue = 'Η παράμετρος $relation_served_service έχει μη αποδεκτή τιμή';
//        const InvalidRelationServedOnlineValue = 'Η παράμετρος $relation_served_online έχει μη αποδεκτή τιμή';        
//        const InvalidAquisitionSourceInputValue = 'Η παράμετρος $aquisition_source έχει μη αποδεκτή τιμή'; 
//        const InvalidEquipmentTypeInputValue = 'Η παράμετρος $equipment_type έχει μη αποδεκτή τιμή';
//        const InvalidWorkerInputValue = 'Η παράμετρος $worker πρέπει να είναι αριθμητική';
//        const MissingLabWorkerIdValue  = 'Η παράμετρος $lab_worker_id πρέπει να έχει τιμή';  
//        const InvalidLabWorkerIdValue  = 'Η παράμετρος $lab_worker_id πρέπει να είναι αριθμητική και >0';
//        const InvalidWorkerStatusValue  = 'Η παράμετρος $transition_source πρέπει να έχει τιμή "1"(ΕΝΕΡΓΟΣ) ή "3"(ΑΝΕΝΕΡΓΟΣ)'; 
//        const MissingAquisitionYearValue  = 'Η παράμετρος $aquisition_year πρέπει να έχει τιμή';
//        const InvalidUpdateWorkerStatusValue  = 'Η παράμετρος $worker_status πρέπει να έχει τιμή "3"(ΑΝΕΝΕΡΓΟΣ)';
//        const MissingLabRelationIdValue  = 'Η παράμετρος $lab_relation_id πρέπει να έχει τιμή';
//        const InvalidLabRelationIdValue  = 'Η παράμετρος $lab_relation_id πρέπει να είναι αριθμητική και >0';
//        const MissingLabAquisitionSourceIdValue  = 'Η παράμετρος $lab_aquisition_source_id πρέπει να έχει τιμή';
//        const InvalidLabAquisitionSourceIdValue  = 'Η παράμετρος $lab_aquisition_source_id πρέπει να είναι αριθμητική και >0';
//        const MissingLabStateValue  = 'Η παράμετρος $lab_state πρέπει να έχει τιμή';
//        const MissingLabTransitionIdValue  = 'Η παράμετρος $lab_transition_id πρέπει να έχει τιμή';
//        const InvalidLabTransitionIdValue  = 'Η παράμετρος $lab_transition_id πρέπει να είναι αριθμητική και >0';
//        const MissingOperationalRatingValue  = 'Η παράμετρος $operational_rating πρέπει να έχει τιμή';
//        const InvalidOperationalRatingValue  = 'Η παράμετρος $operational_rating πρέπει να είναι αριθμητική και >0';
//        const MissingTechnologicalRatingValue  = 'Η παράμετρος $technological_rating πρέπει να έχει τιμή';
//        const InvalidTechnologicalRatingValue  = 'Η παράμετρος $technological_rating πρέπει να είναι αριθμητική και >0';
//        
//        const MissingWorkerStartServiceParam  = 'Η παράμετρος $worker_start_service είναι υποχρεωτικό πεδίο';
//        const MissingWorkerStatusParam  = 'Η παράμετρος $worker_status είναι υποχρεωτικό πεδίο';
//        const MissingEquipmentTypesParam  = 'Η παράμετρος $equipment_types είναι υποχρεωτικό πεδίο';
//        const MissingItemsParam  = 'Η παράμετρος $items είναι υποχρεωτικό πεδίο';
//        const MissingAquisitionYearParam  = 'Η παράμετρος aquisition_year είναι υποχρεωτικά πεδία';
//        const MissingLabStateParam = 'Η παράμετρος $lab_state είναι υποχρεωτικό πεδίο';  
//        const MissingTransitionDateParam  = 'Η παράμετρος $transition_date είναι υποχρεωτικό πεδίο';
//        const MissingTransitionSourceParam  = 'Η παράμετρος $transition_source είναι υποχρεωτικό πεδίο';
//        const MissingTransitionJustificationParam  = 'Η παράμετρος $transition_justification είναι υποχρεωτικό πεδίο';
//        const MissingOperationalRatingParam  = 'Η παράμετρος $operational_rating είναι υποχρεωτικό πεδίο';
//        const MissingTechnologicalRatingParam  = 'Η παράμετρος $technological_rating είναι υποχρεωτικό πεδίο';
//        
//        const InvalidLabTypeIdValue  = 'Η παράμετρος $lab_type_id πρέπει να είναι αριθμητική και >0 ';
//        const MissingSpecializationCodeIdValue = 'Η παράμετρος $specialization_code_id πρέπει να έχει τιμή';
//        const InvalidSpecializationCodeIdValue  = 'Η παράμετρος $specialization_code_id πρέπει να είναι αριθμητική και >0 ';
//        const MissingEmploymentRelationshipIdValue = 'Η παράμετρος $employment_relationship_id πρέπει να έχει τιμή';
//        const InvalidEmploymentRelationshipIdValue  = 'Η παράμετρος $employment_relationship_id πρέπει να είναι αριθμητική και >0 ';
//        const InvalidAquisitionSourceIdValue  = 'Η παράμετρος $aquisition_source_id πρέπει να είναι αριθμητική και >0 ';
//        const MissingNewAquisitionSourceIdValue = 'Η παράμετρος $new_aquisition_source πρέπει να έχει τιμή';
//        const InvalidEquipmentTypeIdValue  = 'Η παράμετρος $equipment_type_id πρέπει να είναι αριθμητική και >0 ';
//        const MissingNewEquipmentTypeIdValue = 'Η παράμετρος $new_equipment_type πρέπει να έχει τιμή';
//        const InvalidEquipmentCategoryIdValue  = 'Η παράμετρος $equipment_category_id πρέπει να είναι αριθμητική και >0 ';
//        const MissingLabResponsibleIdValue = 'Η παράμετρος $lab_responsible_id πρέπει να έχει τιμή'; 
//        const InvalidLabResponsibleIdValue  = 'Η παράμετρος $lab_responsible_id πρέπει να είναι αριθμητική και >0 ';
//        const MissingWorkerStartServiceValue = 'Η παράμετρος $worker_start_service πρέπει να έχει τιμή'; 
//
//        const InvalidSchoolUnitIdValue  = 'Η παράμετρος $school_unit_id πρέπει να είναι αριθμητική και >0 ';
//        const InvalidEducationLevelIdValue  = 'Η παράμετρος $education_level_id πρέπει να είναι αριθμητική και >0 ';
//        const InvalidSchoolUnitTypeIdValue  = 'Η παράμετρος $school_unit_type_id πρέπει να είναι αριθμητική και >0 ';
//        const InvalidRegionEduAdminIdValue  = 'Η παράμετρος $region_edu_admin_id πρέπει να είναι αριθμητική και >0 ';
//        const InvalidEduAdminIdValue  = 'Η παράμετρος $edu_admin_id πρέπει να είναι αριθμητική και >0 ';
//        const InvalidTransferAreaIdValue  = 'Η παράμετρος $transfer_area_id πρέπει να είναι αριθμητική και >0 ';
//        const InvalidMunicipalityIdValue  = 'Η παράμετρος $municipality_id πρέπει να είναι αριθμητική και >0 ';
//        const InvalidPrefectureIdValue  = 'Η παράμετρος $prefecture_id πρέπει να είναι αριθμητική και >0 ';
//        const InvalidFromDiscontinuedToStateIdValue  = 'Η παράμετρος $to_state δεν μπορεί να πάρει τιμή, διότι η παράμετρος $from_state εχεί τιμή 3=ΚΑΤΑΡΓΗΜΕΝΗ και δεν αλλάζει η κατάσταση.';
//        const InvalidSameFromToStateValue  = 'Η παράμετρος $to_state και η παράμετρος $from_state έχουν την ίδια τιμή και δεν αλλάζει η κατάσταση.';
//        const InvalidRelationTypeIdValue ='Η παράμετρος $relation_type πρέπει να είναι αριθμητική και >0 ';
//        const InvalidCircuitIdValue ='Η παράμετρος $circuit πρέπει πρέπει να είναι αριθμητική και >0 ';
//        const InvalidCircuitIdPhoneNumberValue ='Η παράμετρος $phone_number πρέπει πρέπει να είναι αριθμητική και >0 ';
//        
//    //not found values for create/update rows(PUT)================================================================================================================= 
//    
//        const UpdateLabIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $lab_id';
//        const UpdateLabTypeIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $lab_type_id';
//        const UpdateLabResponsibleIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $lab_responsible_id';
//        const UpdateSpecializationCodeIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $specialization_code_id';
//        const UpdateEmploymentRelationshipIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $employment_relationship_id';
//        const UpdateAquisitionSourceIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $aquisition_source_id';
//        const UpdateEquipmentTypeIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $equipment_type_id';
//        const UpdateEquipmentCategoryIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $equipment_category_id';
//        const UpdateLabHasAquisitionSourceIdValue = 'Δεν υπάρχει εγγραφή με τις τιμές των παραμέτρων';
//        const UpdateLabHasEquipmentTypeIdValue = 'Δεν υπάρχει εγγραφή με τις τιμές των παραμέτρων';
//        const UpdateLabsIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $lab_id';
//        const UpdateLabAquisitionSourcesValue = 'Δεν υπάρχει εγγραφή με τις τιμές των παραμέτρων';
//        const UpdateLabEquipmentTypesValue = 'Δεν υπάρχει εγγραφή με τις τιμές των παραμέτρων';
//        
//        const UpdateSchoolUnitIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $school_unit_id';
//        const UpdateSchoolUnitTypeIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $school_unit_type_id';
//        const UpdateEducationLevelIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $education_level_id';
//        const UpdateRegionEduAdminIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $region_edu_admin_id';
//        const UpdateEduAdminIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $edu_admin_id';  
//        const UpdateTransferAreaIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $transfer_area_id';
//        const UpdatePrefectureIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $prefecture_id';  
//        const UpdateMunicipalityIdValue = 'Δεν υπάρχει εγγραφή με την τιμή της παραμέτρου $municipality_id';  
//    
//    //required fields(foreign keys) for create a new field (POST)==============================================================================================================
//        
//        const CreateLabTypeIdValue = 'Το πεδίο $lab_type είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateLabResponsibleIdValue = 'Το πεδίο $lab_responsible είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateSpecializationCodeIdValue = 'Το πεδίο $specialization_code είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateEmploymentRelationshipIdValue = 'Το πεδίο $employment_relationship είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateAquisitionSourceIdValue = 'Το πεδίο $aquisition_source είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateEquipmentTypeIdValue = 'Το πεδίο $equipment_type είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateEquipmentCategoryIdValue = 'Το πεδίο $equipment_category είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateStateIDValue = 'Το πεδίο $state είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateToStateValue = 'Το πεδίο $to_state είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateLabSourceIdValue = 'Το πεδίο $lab_source είναι υποχρεωτικό πρός συμπλήρωση ';
//          
//        const CreateSchoolUnitIdValue = 'Το πεδίο $school_unit είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateSchoolUnitTypeIdValue = 'Το πεδίο $school_unit_type είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateEducationLevelIdValue = 'Το πεδίο $education_level είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateRegionEduAdminIdValue = 'Το πεδίο $region_edu_admin είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateEduAdminIdValue = 'Το πεδίο $edu_admin είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateTransferAreaIdValue = 'Το πεδίο $transfer_area είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreatePrefectureIdValue = 'Το πεδίο $prefecture είναι υποχρεωτικό πρός συμπλήρωση ';
//        const CreateMunicipalityIdValue = 'Το πεδίο $municipality είναι υποχρεωτικό πρός συμπλήρωση ';
//
//    //warning about duplicate vocabulary values when create or update a field values(POST/PUT)=============================================================================================================================
//    
//        const DuplicateRegistryNumberValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη υπεύθυνος εργαστηρίου με με την τιμή της παραμέτρου $registry_number ';
//        const DuplicateLabWorkerValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη υπεύθυνος εργαστηρίου με με την τιμή της παραμέτρου $worker_id ';
//        const DuplicateLabTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Lab_Types υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateInfoLabTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Lab_Types υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $info_name ';
//        const DuplicateSpecializationCodeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Specialization_Codes υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $code ';
//        const DuplicateEmploymentRelationshipValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Employment_Relationships υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateAquisitionSourceValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Aquisitions_Sources υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateEquipmentTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Equipment_Types υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateEquipmentCategoryValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Equipment_Categories υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateLabHasAquisitionSourceValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
//        const DuplicateLabHasEquipmentTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
//        const DuplicateRelationServedServiceValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
//        const DuplicateLabValue = 'Είναι αδύνατη η εισαγωγή, διότι στο πίνακα Labs υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateRelationServedOnlineValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
//        const DuplicateLabTransitionsValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
//        const DuplicateLabsValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
//        const DuplicateUpdateLabWorkerValue = 'Είναι αδύνατη η ενημέρωση της εγγραφής διότι υπάρχει ενεργός υπεύθυνος εργαστηρίου';
//        const DuplicateLabAquisitionSourceValue = 'Είναι αδύνατη η ενημέρωση, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
//        const DuplicateLabEquipmentTypeValue = 'Είναι αδύνατη η ενημέρωση, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
//        const DuplicateLabRelationValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με την τιμές ';
//        const DuplicateLabRelationServerOnlineValue = 'Είναι αδύνατη η εισαγωγή, διότι το εργαστήριο εξυπηρετείται διαδικτυακά από σχολική μονάδα.';
//        const DuplicateLabTransitionValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη η εγγραφή με τιμές ';
//
//        const DuplicateSchoolUnitValue = 'Είναι αδύνατη η εισαγωγή, διότι υπάρχει ήδη σχολική μονάδα με την τιμή της παραμέτρου $name ';
//        const DuplicateSchoolUnitTypeValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό School_Unit_Types υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateEducationLevelValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Education_Level υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';   
//        const DuplicateRegionEduAdminValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Region_Edu_Admins υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateEduAdminValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Edu_Admin υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateTransferAreaValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Transform_Areas υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicateMunicipalityValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Municipalities υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//        const DuplicatePrefectureValue = 'Είναι αδύνατη η εισαγωγή, διότι στο λεξικό Prefectures υπάρχει ήδη η εγγραφή με την τιμή της παραμέτρου $name ';
//
//    //found duplicated values into a vocabulary table. This is a very critical error.( POST/PUT)==========================================================================================================================
//    
//        const DuplicateLabsIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_id ';  
//        const DuplicateLabTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Lab_Types με τιμή $lab_type_id';
//        const DuplicateWorkerIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Workers με τιμή $lab_responsible_id';
//        const DuplicateSpecializationCodeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Specialization_Codes με τιμή $specialization_code_id ';  
//        const DuplicateEmploymentRelationshipIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Employment_Relationships με τιμή $employment_relatioship_id ';  
//        const DuplicateAquisitionSourceIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Aquisition_Sources με τιμή $aquisition_source_id';
//        const DuplicateEquipmentTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Equipment_Types με τιμή $equipment_type_id';  
//        const DuplicateEquipmentCategoryIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Equipment_Category με τιμή $equipment_category_id ';
//        const DuplicateLabHasAquisitionSourceIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με τα ίδια primary keys, στο πίνακα Labs_Have_Aquisition_Sources με τις τιμές των παραμέτρων';
//        const DuplicateLabHasEquipmentTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με τα ίδια primary keys, στο πίνακα Labs_Have_Equipment_Types με τις τιμές των παραμέτρων';
//        const DuplicateStateIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό States με τιμή $state_id';  
//        const DuplicateLabSourceIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Sources με τιμή $lab_source_id';  
//        const DuplicateWorkerPositionIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Worker_Positions με τιμή $worker_position';
//        const DuplicateLabWorkerIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_worker_id ';                
//        const DuplicateLabRelationIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_relation_id ';  
//        const DuplicateLabAquisitionSourceIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_aquisition_source_id '; 
//        const DuplicateLabTransitionIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο εργαστήριο με τιμή $lab_transition_id ';  
//        
//        const DuplicateSchoolUnitIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό School_Units με τιμή $school_unit_id';  
//        const DuplicateSchoolUnitTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό School_Unit_Types με τιμή $school_unit_type_id';
//        const DuplicateEducationLevelIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Education_Level με τιμή $education_level_id'; 
//        const DuplicateRegionEduAdminIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Region_Edu_Admins με τιμή $region_edu_admin_id';
//        const DuplicateEduAdminIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Edu_Admins με τιμή $edu_admin_id';
//        const DuplicateTransferAreaIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Transfer_Areas με τιμή $transfer_area_id';
//        const DuplicateMunicipalityIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Municipalities με τιμή $municipality_id';
//        const DuplicatePrefectureIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Prefectures με τιμή $prefecture_id';
//        const DuplicateCircuitPhoneNumberValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Circuits με τιμή $phone_number';  
//        const DuplicateRelationTypeIdValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Relation_Types με τιμή $relation_type_id';  
//        const DuplicateCircuitValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο primary key,στο λεξικό Circuits με τιμή $circuit_id και $school_unit_id'; 
//    //not found vocabulary value for delete rows(PUT)================================================================================================================= 
//
//        const DeleteNotFoundLabNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο πίνακα Labs ';
//        const DeleteNotFoundLabTypeNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο πίνακα Lab_Types ';
//        const DeleteNotFoundLabResponsibleRegistryNumberValue = 'Η τιμή της παραμέτρου $registry_number δεν υπάρχει στο πίνακα Lab_Responsibles';
//        const DeleteNotFoundSpecializationCodeNameValue = 'Η τιμή της παραμέτρου $code δεν υπάρχει στο λεξικό Specialization_Codes';
//        const DeleteNotFoundEmploymentRelationshipNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Employment_Relationships';
//        const DeleteNotFoundAquisitionSourceNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Aquisition_Sources';
//        const DeleteNotFoundNewAquisitionSourceNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Aquisition_Sources';
//        const DeleteNotFoundEquipmentTypeNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Equipment_Types';
//        const DeleteNotFoundNewEquipmentTypeNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Equipment_Types';
//        const DeleteNotFoundEquipmentCategoryNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Equipment_Categories';
//        const DeleteNotFoundLabHasAquisitionSourceLabIdValue = 'Η τιμή της παραμέτρου $lab_id δεν υπάρχει στο πίνακα LabsHaveAquisitionSources';
//        const DeleteNotFoundLabHasEquipmentTypeLabIdValue = 'Η τιμή της παραμέτρου $lab_id δεν υπάρχει στο πίνακα LabsHaveEquipmentTypes';
//        const DeleteNotFoundLabHasAquisitionSourceValue = 'Η τιμή της παραμέτρου $aquisition_source δεν υπάρχει στο πίνακα LabsHaveAquisitionSources';
//        const DeleteNotFoundLabHasEquipmentTypeValue = 'Η τιμή της παραμέτρου $equipment_type δεν υπάρχει στο πίνακα LabsHaveEquipmentTypes';
//        
//        const DeleteNotFoundSchoolUnitNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο πίνακα School_Units';
//        const DeleteNotFoundSchoolUnitTypeNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό School_Units_Types';
//        const DeleteNotFoundEducationLevelNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Education_Levels';
//        const DeleteNotFoundRegionEduAdminNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Region_Edu_Admins';
//        const DeleteNotFoundEduAdminNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Edu_Admins';
//        const DeleteNotFoundTransferAreaNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Transfer_Areas';
//        const DeleteNotFoundPrefectureNameValue = 'Η τιμή της παραμέτρου $name δεν υπάρχει στο λεξικό Prefectures';
//        const DeleteNotFoundMunicipalityNameValue = 'Η τιμή tης παραμέτρου $name δεν υπάρχει στο λεξικό Municipalities';
//            
//    //required fields for delete fields==========================================================================================================================================
//    
//        const DeleteLabNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteLabResponsibleRegistryNumberValue = 'Το πεδίο $registry_number είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteAquisitionNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteEmploymentRelationshipNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteSpecializationCodeValue = 'Το πεδίο $code είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteLabTypeNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteEquipmentTypeNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteEquipmentCategoryNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteLabHasAquisitionSourceLabIdValue = 'Το πεδίο $lab_id είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteLabHasEquipmentTypeLabIdValue = 'Το πεδίο $lab_id είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteLabWorkerIdValue = 'Το πεδίο $lab_worker_id είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        
//        
//        const DeleteSchoolUnitNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteSchoolUnitTypeNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteEducationLevelNameValue ='Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteRegionEduAdminNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteEduAdminNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteTransferAreaNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeletePrefectureNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//        const DeleteMunicipalityNameValue = 'Το πεδίο $name είναι υποχρεωτικό πρός συμπλήρωση, για την αντίστοιχη διαγραφή';
//
//    //restricted deletion of duplicate values=========================================================================================================================================
//        
//        const DuplicateDelLabNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο πίνακα Labs με την τιμή της παραμέτρου $name';
//        const DuplicateDelLabResponsibleRegistryNumberValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο πίνακα LabResponsibles με την τιμή της παραμέτρου $registry_number';
//        const DuplicateDelAquisitionNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Aquisition_Sources με την τιμή της παραμέτρου $name';
//        const DuplicateDelEmploymentRelationshipNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Employment_Relationships με την τιμή της παραμέτρου $name';
//        const DuplicateDelSpecializationCodeValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Specialization_Codes με την τιμή της παραμέτρου $code';
//        const DuplicateDelLabTypeNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Lab_Types με την τιμή της παραμέτρου $name';
//        const DuplicateDelEquipmentTypeNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Equipment_Types με την τιμή της παραμέτρου $name';
//        const DuplicateDelEquipmentCategoryNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Equipment_Categories με την τιμή της παραμέτρου $name';
//        
//        const DuplicateDelSchoolUnitNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο πίνακα School_Units με την τιμή της παραμέτρου $name';
//        const DuplicateDelSchoolUnitTypeNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό School_Unit_Types με την τιμή της παραμέτρου $name';
//        const DuplicateDelEducationLevelNameValue ='Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Education_Levels με την τιμή της παραμέτρου $name';
//        const DuplicateDelRegionEduAdminNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Region_Edu_Admins με την τιμή της παραμέτρου $name';
//        const DuplicateDelEduAdminNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό  Edu_Admins με την τιμή της παραμέτρου $name';
//        const DuplicateDelTransferAreaNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Transfer_Areas με την τιμή της παραμέτρου $name';
//        const DuplicateDelPrefectureNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Prefectures με την τιμή της παραμέτρου $name';
//        const DuplicateDelMunicipalityNameValue = 'Είναι αδύνατη η διαγραφή, διότι υπάρχει διπλοεγγραφή στο λεξικό Municipalities με την τιμή της παραμέτρου $name';
//        
//    //restricted deletion of references values on other tables==========================================================================================================================
//        
//        const ReferencesAquisitionSources = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα AquisitionSources. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα AquisitionSources 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesEmploymentRelationships = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EmploymentRelationships. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EmploymentRelationships 
//                                            με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων  στις εγγραφές στις που επηρεάζονται';
//        const ReferencesSpecializationCodes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα SpecializationCodes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα SpecializationCodes 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesLabTypes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabTypes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabTypes 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesEquipmentTypes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EquipmentTypes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EquipmentTypes 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesEquipmentCategories = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EquipmentCategories. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EquipmentCategories 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesLabAquisitionSources = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabAquisitionSources. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabAquisitionSources 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesLabEquipmentTypes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabEquipmentTypes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabEquipmentTypes 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesLabs = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα Labs. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα Labs 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesLabResponsibles = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabResponsibles. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabResponsibles 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesLabWorkers = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabWorkers. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabWorkers 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesLabRelations = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabRelations. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabRelations 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesLabTransitions = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabTransitions. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα LabTransitions 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        
//        
//        
//        const ReferencesSchoolUnitTypes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα SchoolUnitTypes. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα SchoolUnitTypes 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesEducationLevels = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EducationLevels. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EducationLevels 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesRegionEduAdmins = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα RegionEduAdmins. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα RegionEduAdmins 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesEduAdmins = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα EduAdmins. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα EduAdmins 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesTransferAreas = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα TransferAreas. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα TransferAreas 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesPrefectures = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα Prefectures. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα Prefectures 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesMunicipalities = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα Municipalities. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα Municipalities 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        const ReferencesSchoolUnits = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα SchoolUnits. Ενημερώστε/διαγραψτε τις παραπάνω εγγραφές στον πίνακα SchoolUnits 
//                                             με την καταχώρηση νέων τιμών λεξικού ή κενών πεδίων στις εγγραφές που επηρεάζονται';
//        
//        //postEquipmentTypes
//        const NotAllowedLabEquipmentTypes = 'Δεν είναι δυνατή η ταυτόχρονη εισαγωγή πολλαπλών τιμών και μοναδικής τιμής equipment_type=items ';
//        const NotAllowedLabAquisitionSources = 'Δεν είναι δυνατή η ταυτόχρονη εισαγωγή πολλαπλών τιμών και μοναδικής τιμής aquisition_source=aquisition_year=aquisition_comments ';
//        const NotAllowedLabWorkerStartService = 'Δεν είναι δυνατή η εισαγωγή ημερομηνίας προγενέστερη από την ημερομηνία εισαγωγής του προηγούμενου υπεύθυνου';
//        const NotAllowedLabTransitionService = 'Δεν είναι δυνατή η εισαγωγή ημερομηνίας προγενέστερη από την ημερομηνία εισαγωγής της προηγούμενης κατάστασης';
//        const ConflictLabTransitionWithLabsValue = 'Η κατάσταση του εργαστηρίου στον πίνακα Labs είναι διαφορετική από την τελική κατάσταση του εργαστηρίου στον πίνακα LabTransitions';
//        
//        //update
//        const ErrorUpdateLabWorkerStatus = "Αποτυχία ενημέρωσης της εγγραφής";
//        const ErrorUpdateLabTransitionStatus = "Αποτυχία ενημέρωσης της εγγραφής";
//        const ErrorUpdateLabRelationStatus = "Αποτυχία ενημέρωσης της εγγραφής";
//        
//        //lab_relations
//        const ErrorInputCircuitIdParam  = 'Η παράμετρος $circuit_id δεν επιτρέπεται στην περίπτωση που το relation_type=2(ΕΞΥΠΗΡΕΤΕΙ ΥΠΗΡΕΣΙΑΚΑ)';
//        const ErrorInputLabTransitionsValues  = 'Δεν είναι επιτρεπτή η καταχώρηση τιμών aquisition_source, aquisition_justification, aquisition_date χωρίς την καταχώρηση τιμής state';
//        
//        //delete lab_transitions
//        const ReferencesLabTransitionsValue = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα Labs.Γίνεται προσπάθεια διαγραφής της τελευταίας κατάστασης του εργαστηρίου';
//        
//        //post labs
//        const NotAllowedLabNameValue = 'Δεν επιτρέπεται η δημιουργία εργαστηρίου σε σχολικές μονάδες που είναι σε αναστολή ή καταργημένες';
//        
    //########################################
    //Search Functions
    //######################################## 
        
    //======================================================================================================================
    // =Search Array School Units
    //======================================================================================================================
        
//SchoolUnits
        
    const MissingSchoolUnitIDParam = 'Ο Κωδικός της Μονάδας είναι υποχρεωτικό πεδίο';
    const MissingSchoolUnitIDValue = 'Ο Κωδικός της Μονάδας πρέπει να έχει τιμή';
    const InvalidSchoolUnitIDType = 'Ο Κωδικός της Μονάδας πρέπει να είναι αριθμητικός';
    const InvalidSchoolUnitIDArray = 'Ο Κωδικός της Μονάδας δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingSchoolUnitParam = 'Η Μονάδα είναι υποχρεωτικό πεδίο';   
    const MissingSchoolUnitValue = 'Η Μονάδα πρέπει να έχει τιμή';
    const InvalidSchoolUnitValue = 'Η Μονάδα δεν βρέθηκε';
    const InvalidSchoolUnitType = 'Η Μονάδα πρέπει να είναι αριθμητική ή αλφαριθμητική';
    const InvalidSchoolUnitArray = 'Η Μονάδα δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedSchoolUnitValue = 'H Μονάδα υπάρχει ήδη';
    const DuplicatedSchoolUnitNameValue = 'Το Όνομα της Μονάδας υπάρχει ήδη';
     
    const MissingSchoolUnitNameParam = 'Το Όνομα της Μονάδας είναι υποχρεωτικό πεδίο';
    const MissingSchoolUnitNameValue = 'Το Όνομα της Μονάδας πρέπει να έχει τιμή';
    const InvalidSchoolUnitNameType = 'Το Όνομα της Μονάδας πρέπει να είναι αλφαριθμητικό';
    const InvalidSchoolUnitNameArray = 'Το Όνομα της Μονάδας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const InvalidSchoolUnitSpecialNameType = 'Το Ειδικό Όνομα της Μονάδας πρέπει να είναι αλφαριθμητικό';
    const InvalidSchoolUnitLastUpdateType = 'Η Ημερομηνία Τελευταίας Ενημερωσης της Μονάδας πρέπει να είναι Ημερομηνία (dd/mm/yyyy)';
    const InvalidSchoolUnitFaxNumberType = 'Το Φαξ της Μονάδας πρέπει να είναι αριθμητικό';
    const InvalidSchoolUnitPhoneNumberType = 'Ο Τηλεφωνικός Αριθμός της Μονάδας πρέπει να είναι αριθμητικός';
    const InvalidSchoolUnitEmailType = 'Το Email της Μονάδας πρέπει να έχει την μορφή xxxxx@xxxxx.xx';
    const InvalidSchoolUnitStreetAddressType = 'Η Διεύθυνση της Μονάδας πρέπει να είναι αλφαριθμητική';
    const InvalidSchoolUnitPostalCodeType = 'Ο Ταχυδρομικός Κώδικας της Μονάδας πρέπει να είναι αριθμητικός';
 
//= Circuits
    
    const MissingCircuitIDParam = 'Ο Κωδικός του Τηλεπικοινωνιακού Κυκλώματος είναι υποχρεωτικό πεδίο';
    const MissingCircuitIDValue = 'Ο Κωδικός του Τηλεπικοινωνιακού Κυκλώματος πρέπει να έχει τιμή';
    const InvalidCircuitIDType = 'Ο Κωδικός του Τηλεπικοινωνιακού Κυκλώματος πρέπει να είναι αριθμητικός';
    const InvalidCircuitIDArray = 'Ο Κωδικός του Τηλεπικοινωνιακού Κυκλώματος δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingCircuitParam = 'Το Τηλεπικοινωνιακό Κύκλωμα είναι υποχρεωτικό πεδίο';
    const MissingCircuitValue = 'Το Τηλεπικοινωνιακό Κύκλωμα πρέπει να έχει τιμή';
    const InvalidCircuitValue = 'Το Τηλεπικοινωνιακό Κύκλωμα δεν βρέθηκε';
    const InvalidCircuitType = 'Το Τηλεπικοινωνιακό Κύκλωμα πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidCircuitArray = 'Το Τηλεπικοινωνιακό Κύκλωμα δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedCircuitValue = 'Το Τηλεπικοινωνιακό Κύκλωμα υπάρχει ήδη';
    const DuplicatedCircuitPhoneNumberValue = 'Ο Τηλεφωνικός Αριθμός του Τηλεπικοινωνιακού Κυκλώματος υπάρχει ήδη';
    const UsedCircuitBySchoolUnits = 'Ο Κωδικός του Τηλεπικοινωνιακού Κυκλώματος χρησιμοποιείται από Σχολικές Μονάδες';
    
    const MissingCircuitPhoneNumberParam = 'Ο Αριθμός του Τηλεπικοινωνιακού Κυκλώματος είναι υποχρεωτικό πεδίο';
    const MissingCircuitPhoneNumberValue = 'Ο Αριθμός του Τηλεπικοινωνιακού Κυκλώματος πρέπει να έχει τιμή';
    const InvalidCircuitPhoneNumberType = 'Ο Αριθμός του Τηλεπικοινωνιακού Κυκλώματος πρέπει να είναι αριθμητικός';
    const InvalidCircuitPhoneNumberArray = 'Ο Αριθμός του Τηλεπικοινωνιακού Κυκλώματος δεν μπορεί να έχει πολλαπλές τιμές';

    const MissingCircuitStatusParam = 'Η Κατάσταση του Τηλεπικοινωνιακού Κυκλώματος είναι υποχρεωτικό πεδίο';
    const MissingCircuitStatusValue = 'Η Κατάσταση του Τηλεπικοινωνιακού Κυκλώματος πρέπει να έχει τιμή';
    const InvalidCircuitStatusType = 'Η Κατάσταση του Τηλεπικοινωνιακού Κυκλώματος πρέπει να είναι Ενεργή ή Ανενεργή';
    const InvalidCircuitStatusArray = 'Η Κατάσταση του Τηλεπικοινωνιακού Κυκλώματος δεν μπορεί να έχει πολλαπλές τιμές';
     
    const MissingCircuitUpdatedDateParam = 'Η Ημερομηνία Ενημέρωσης του Τηλεπικοινωνιακού Κυκλώματος είναι υποχρεωτικό πεδίο';
    const MissingCircuitUpdatedDateValue = 'Η Ημερομηνία Ενημέρωσης του Τηλεπικοινωνιακού Κυκλώματος πρέπει να έχει τιμή';
    const InvalidCircuitUpdatedDateType = 'Η Ημερομηνία Ενημέρωσης του Τηλεπικοινωνιακού Κυκλώματος πρέπει να είναι Ημερομηνία (dd/mm/yyyy)';
    const InvalidCircuitUpdatedDateArray = 'Η Ημερομηνία Ενημέρωσης του Τηλεπικοινωνιακού Κυκλώματος δεν μπορεί να έχει πολλαπλές τιμές';

//= SchoolUnitWorkers
    
    const MissingSchoolUnitWorkerIDParam = 'Ο Κωδικός του Εργαζόμενου Σχολικής Μονάδας είναι υποχρεωτικό πεδίο';
    const MissingSchoolUnitWorkerIDValue = 'Ο Κωδικός του Εργαζόμενου Σχολικής Μονάδας πρέπει να έχει τιμή';
    const InvalidSchoolUnitWorkerIDType = 'Ο Κωδικός του Εργαζόμενου Σχολικής Μονάδας πρέπει να είναι αριθμητικός';
    const InvalidSchoolUnitWorkerIDArray = 'Ο Κωδικός του Εργαζόμενου Σχολικής Μονάδας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingSchoolUnitWorkerParam = 'Ο Εργαζόμενος Σχολικής Μονάδας είναι υποχρεωτικό πεδίο';
    const MissingSchoolUnitWorkerValue = 'Ο Εργαζόμενος Σχολικής Μονάδας πρέπει να έχει τιμή';
    const InvalidSchoolUnitWorkerValue = 'Ο Εργαζόμενος Σχολικής Μονάδας δεν βρέθηκε';
    const InvalidSchoolUnitWorkerType = 'Ο Εργαζόμενος Σχολικής Μονάδας πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidSchoolUnitWorkerArray = 'Ο Εργαζόμενος Σχολικής Μονάδας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedSchoolUnitWorkerValue = 'Ο Εργαζόμενος Σχολικής Μονάδας υπάρχει ήδη';
    const UsedSchoolUnitWorkerBySchoolUnits = 'Ο Κωδικός του Εργαζόμενου Σχολικής Μονάδας χρησιμοποιείται από Σχολικές Μονάδες';
    
//= Workers

    const MissingWorkerIDParam = 'Ο Κωδικός του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerIDValue = 'Ο Κωδικός του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerIDType = 'Ο Κωδικός του Εργαζομένου πρέπει να είναι αριθμητικός';
    const InvalidWorkerIDArray = 'Ο Κωδικός του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
   
    const MissingWorkerParam = 'Ο Εργαζόμενος είναι υποχρεωτικό πεδίο';
    const MissingWorkerValue = 'Ο Εργαζόμενος πρέπει να έχει τιμή';
    const InvalidWorkerValue = 'Ο Εργαζόμενος δεν βρέθηκε';
    const InvalidWorkerType = 'Ο Εργαζόμενος πρέπει να είναι αριθμητικός ή αλφαριθμητικός';
    const InvalidWorkerArray = 'Ο Εργαζόμενος δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedWorkerValue = 'Ο Εργαζόμενος υπάρχει ήδη';
    const DuplicatedWorkerRegistryNoValue = 'Ο Αριθμός Μητρώου του Εργαζομένου υπάρχει ήδη';
    const DuplicatedWorkerTaxNumberValue = 'Το ΑΦΜ του Εργαζομένου υπάρχει ήδη';
    const UsedWorkerBySchoolUnitWorkers = 'Ο Κωδικός του Εργαζόμενου χρησιμοποιείται από Σχολικές Μονάδες';
    const UsedWorkerBySchoolUnitLabs = 'Ο Κωδικός του Εργαζόμενου χρησιμοποιείται από Σχολικά Εργαστήρια';
   
    const MissingWorkerRegistryNoParam = 'Ο Αριθμός Μητρώου του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerRegistryNoValue = 'Ο Αριθμός Μητρώου του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerRegistryNoType = 'Ο Αριθμός Μητρώου του Εργαζομένου πρέπει να είναι αριθμητικός';
    const InvalidWorkerRegistryNoArray = 'Ο Αριθμός Μητρώου του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingWorkerLastnameParam = 'Το Επώνυμο του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerLastnameValue = 'Το Επώνυμο του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerLastnameType = 'Το Επώνυμο του Εργαζομένου πρέπει να είναι αριθμητικός ή αλφαριθμητικός';
    const InvalidWorkerLastnameArray = 'Το Επώνυμο του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';

    const MissingWorkerFirstnameParam = 'Το Όνομα του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerFirstnameValue = 'Το Όνομα του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerFirstnameType = 'Το Όνομα του Εργαζομένου πρέπει να είναι αριθμητικός ή αλφαριθμητικός';
    const InvalidWorkerFirstnameArray = 'Το Όνομα του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const InvalidWorkerTaxNumberType = 'Το ΑΦΜ του Εργαζομένου πρέπει να είναι αριθμητικό';
    const InvalidWorkerFatherNameType = 'Το Όνομα Πατρός του Εργαζομένου πρέπει να είναι αλφαριθμητικός';
    const InvalidWorkerSexType = 'Το Φύλο του Εργαζομένου πρέπει να είναι αλφαριθμητική : Α (Άντρας) ή Γ (Γυναικα)';
    
   //= LabWorkers
    
    const MissingLabWorkerIDParam = 'Ο Κωδικός του Εργαζόμενου Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabWorkerIDValue = 'Ο Κωδικός του Εργαζόμενου Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabWorkerIDType = 'Ο Κωδικός του Εργαζόμενου Εργαστηρίου πρέπει να είναι αριθμητικός';
    const InvalidLabWorkerIDArray = 'Ο Κωδικός του Εργαζόμενου Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingLabWorkerParam = 'Ο Εργαζόμενος Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabWorkerValue = 'Ο Εργαζόμενος Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabWorkerValue = 'Ο Εργαζόμενος Εργαστηρίου δεν βρέθηκε';
    const InvalidLabWorkerType = 'Ο Εργαζόμενος Εργαστηρίου πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidLabWorkerArray = 'Ο Εργαζόμενος Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabWorkerValue = 'Ο Εργαζόμενος Εργαστηρίου υπάρχει ήδη';
    const UsedLabWorkerByLabs = 'Ο Κωδικός του Εργαζόμενου Εργαστηρίου χρησιμοποιείται από Σχολικά Εργαστήρια';
    
    const MissingLabWorkerStatusParam = 'H Κατάσταση του Εργαζομένου Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabWorkerStatusValue = 'H Κατάσταση του Εργαζομένου Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabWorkerStatusType = 'H Κατάσταση του Εργαζομένου Εργαστηρίου πρέπει να είναι αριθμητική : 1 (Ενεργή) ή 3 (Ανενεργή)';
    const InvalidLabWorkerStatusArray = 'H Κατάσταση του Εργαζομένου Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';

    const MissingLabWorkerStartServiceParam = 'Η Ημερομηνία Έναρξης του Εργαζομένου Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabWorkerStartServiceValue = 'Η Ημερομηνία Έναρξης του Εργαζομένου Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabWorkerStartServiceType = 'Η Ημερομηνία Έναρξης  του Εργαζομένου Εργαστηρίου πρέπει να είναι Ημερομηνία (dd/mm/yyyy)';
    const InvalidLabWorkerStartServiceArray = 'Η Ημερομηνία Έναρξης  του Εργαζομένου Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const InvalidLabWorkerEmailType = 'Το Email του Εργαζομένου Εργαστηρίου πρέπει να έχει την μορφή xxxxx@xxxxx.xx';
        
//Labs
        
    const MissingLabIDParam = 'Ο Κωδικός του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabIDValue = 'Ο Κωδικός του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabIDType = 'Ο Κωδικός του Εργαστηρίου πρέπει να είναι αριθμητικός';
    const InvalidLabIDArray = 'Ο Κωδικός του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingLabParam = 'Το Εργαστήριο είναι υποχρεωτικό πεδίο';   
    const MissingLabValue = 'Το Εργαστήριο πρέπει να έχει τιμή';
    const InvalidLabValue = 'Το Εργαστήριο δεν βρέθηκε';
    const InvalidLabType = 'Το Εργαστήριο πρέπει να είναι αλφαριθμητική';
    const InvalidLabArray = 'Το Εργαστήριο δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabValue = 'Το Εργαστήριο υπάρχει ήδη';
    const DuplicatedLabNameValue = 'Το Όνομα του Εργαστηρίου υπάρχει ήδη';
     
    const MissingLabNameParam = 'Το Όνομα του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabNameValue = 'Το Όνομα του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabNameType = 'Το Όνομα του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabNameArray = 'Το Όνομα του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const InvalidLabSpecialNameType = 'Το Ειδικό Όνομα του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabCreationDateType = 'Η Ημερομηνία Δημιουργίας του Εργαστηρίου πρέπει να είναι Ημερομηνία (dd/mm/yyyy)';
    const InvalidLabCreatedByType = 'Το Ονοματεπώνυμο του Δημιουργού της Εγγραφής του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabLastUpdatedType = 'Η Ημερομηνία Τελευταίας Ενημερωσης του Εργαστηρίου πρέπει να είναι Ημερομηνία (dd/mm/yyyy)';
    const InvalidLabUpdatedByType = 'Το Ονοματεπώνυμο του Τελευταίου που Ενημέρωσε την Εγγραφής του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabPositioningType = 'Η Γεωγραφική/Χωροταξική Θέση του Εργαστηρίου πρέπει να είναι αλφαριθμητική';
    const InvalidLabCommentsType = 'Τα Σχόλια για το Εργαστήριο πρέπει να αλφαριθμητικά ή αλφαριθμητικά';
    const InvalidLabOperationalRatingType = 'Η Λειτουργική Βαθμολόγηση του Εργαστηρίου πρέπει να είναι αριθμητική';
    const InvalidLabTechnologicalRatingType = 'Η Τεχνολογική Βαθμολόγηση του Εργαστηρίου πρέπει να είναι αριθμητική';

//LabEquipmentTypes
        
    const MissingLabEquipmentTypeIDParam = 'Ο Κωδικός του Εξοπλισμού του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabEquipmentTypeIDValue = 'Ο Κωδικός του Εξοπλισμού του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabEquipmentTypeIDType = 'Ο Κωδικός του Εξοπλισμού του Εργαστηρίου πρέπει να είναι αριθμητικός';
    const InvalidLabEquipmentTypeIDArray = 'Ο Κωδικός του Εξοπλισμού του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingLabEquipmentTypeParam = 'Ο Εξοπλισμός του Εργαστηρίου είναι υποχρεωτικό πεδίο';   
    const MissingLabEquipmentTypeValue = 'Ο Εξοπλισμός του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabEquipmentTypeValue = 'Ο Εξοπλισμός του Εργαστηρίου δεν βρέθηκε';
    const InvalidLabEquipmentTypeType = 'Ο Εξοπλισμός του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabEquipmentTypeArray = 'Ο Εξοπλισμός του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabEquipmentTypeValue = 'Ο Εξοπλισμός του Εργαστηρίου υπάρχει ήδη';
    const UsedLabEquipmentTypeByLabs = 'Ο Κωδικός του Εξοπλισμού του Εργαστηρίου χρησιμοποιείται από Σχολικά Εργαστήρια';
     
    const MissingLabEquipmentTypeItemsParam = 'Το Πλήθος του Εξοπλισμού του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabEquipmentTypeItemsValue = 'Το Πλήθος του Εξοπλισμού του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabEquipmentTypeItemsType = 'Το Πλήθος του Εξοπλισμού του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabEquipmentTypeItemsArray = 'Το Πλήθος του Εξοπλισμού του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';

//LabAquisitionSources
        
    const MissingLabAquisitionSourceIDParam = 'Ο Κωδικός της Πηγής Χρηματοδότησης του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabAquisitionSourceIDValue = 'Ο Κωδικός της Πηγής Χρηματοδότησης του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabAquisitionSourceIDType = 'Ο Κωδικός της Πηγής Χρηματοδότησης του Εργαστηρίου πρέπει να είναι αριθμητικός';
    const InvalidLabAquisitionSourceIDArray = 'Ο Κωδικός της Πηγής Χρηματοδότησης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 

    const MissingLabAquisitionSourceParam = 'Η Πηγή Χρηματοδότησης του Εργαστηρίου είναι υποχρεωτικό πεδίο';   
    const MissingLabAquisitionSourceValue = 'Η Πηγή Χρηματοδότησης του Εργαστηρίου του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabAquisitionSourceValue = 'Η Πηγή Χρηματοδότησης του Εργαστηρίου του Εργαστηρίου δεν βρέθηκε';
    const InvalidLabAquisitionSourceType = 'Η Πηγή Χρηματοδότησης του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabAquisitionSourceArray = 'Η Πηγή Χρηματοδότησης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabAquisitionSourceValue = 'Η Πηγή Χρηματοδότησης του Εργαστηρίου του Εργαστηρίου υπάρχει ήδη';
    const UsedLabAquisitionSourceByLabs = 'Ο Κωδικός της Πηγής Χρηματοδότησης του Εργαστηρίου χρησιμοποιείται από Σχολικά Εργαστήρια';
     
    const InvalidLabAquisitionSourceYearType = 'Το Έτος Απόκτησης της Πηγής Χρηματοδότησης του Εργαστηρίου πρέπει να είναι της μορφής (yyyy)';
    const InvalidLabAquisitionSourceCommentsType = 'Τα Σχόλια για την Πηγής Χρηματοδότησης του Εργαστηρίου πρέπει να είναι αλφαριθμητικά';
    
//LabTransitions
        
    const MissingLabTransitionIDParam = 'Ο Κωδικός των Καταστάσεων Μετάβασης του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabTransitionIDValue = 'Ο Κωδικός των Καταστάσεων Μετάβασης του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTransitionIDType = 'Ο Κωδικός των Καταστάσεων Μετάβασης του Εργαστηρίου πρέπει να είναι αριθμητικός';
    const InvalidLabTransitionIDArray = 'Ο Κωδικός των Καταστάσεων Μετάβασης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 

    const MissingLabTransitionParam = 'Οι Καταστάσεις Μετάβασης του Εργαστηρίου είναι υποχρεωτικό πεδίο';   
    const MissingLabTransitionValue = 'Οι Καταστάσεις Μετάβασης  του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTransitionValue = 'Οι Καταστάσεις Μετάβασης του Εργαστηρίου δεν βρέθηκε';
    const InvalidLabTransitionType = 'Οι Καταστάσεις Μετάβασης του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabTransitionArray = 'Οι Καταστάσεις Μετάβασης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabTransitionValue = 'Η Αλλαγή της Κατάστασης Μετάβασης του Εργαστηρίου του Εργαστηρίου υπάρχει ήδη';
    const UsedLabTransitionByLabs = 'Οι Καταστάσεις Μετάβασης του Εργαστηρίου χρησιμοποιούνται από Σχολικά Εργαστήρια';
    
    const MissingLabTransitionJustificationParam = 'Η Αιτιολογία Αλλαγής της Κατάστασης Μετάβασης του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabTransitionJustificationValue = 'Η Αιτιολογία Αλλαγής της Κατάστασης Μετάβασηςτου Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTransitionJustificationType = 'Η Αιτιολογία Αλλαγής της Κατάστασης Μετάβασης του Εργαστηρίου πρέπει να είναι αλφαριθμητική';
    const InvalidLabTransitionJustificationArray = 'Η Αιτιολογία Αλλαγής της Κατάστασης Μετάβασης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingLabTransitionDateParam = 'Η Ημερομηνία Αλλαγής της Κατάστασης του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabTransitionDateValue = 'Η Ημερομηνία Αλλαγής της Κατάστασης του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTransitionDateType = 'Η Ημερομηνία Αλλαγής της Κατάστασης του Εργαστηρίου πρέπει να είναι Ημερομηνία (dd/mm/yyyy)';
    const InvalidLabTransitionDateArray = 'Η Ημερομηνία Αλλαγής της Κατάστασης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingLabTransitionSourceParam = 'Η Πηγή Αλλαγής της Κατάστασης Μετάβασης του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabTransitionSourceValue = 'Η Πηγή Αλλαγής της Κατάστασης Μετάβασης του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTransitionSourceType = 'Η Πηγή Αλλαγής της Κατάστασης Μετάβασης του Εργαστηρίου πρέπει να είναι mmsch ή mylab';
    const InvalidLabTransitionSourceArray = 'Η Πηγή Αλλαγής της Κατάστασης Μετάβασης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
//LabRelations
        
    const MissingLabRelationIDParam = 'Ο Κωδικός Συσχέτισης του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabRelationIDValue = 'Ο Κωδικός Συσχέτισης του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabRelationIDType = 'Ο Κωδικός Συσχέτισης του Εργαστηρίου πρέπει να είναι αριθμητικός';
    const InvalidLabRelationIDArray = 'Ο Κωδικός Συσχέτισης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 

    const MissingLabRelationParam = 'Η Συσχέτιση του Εργαστηρίου είναι υποχρεωτικό πεδίο';   
    const MissingLabRelationValue = 'Η Συσχέτιση του Εργαστηρίου του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabRelationValue = 'Η Συσχέτιση του Εργαστηρίου του Εργαστηρίου δεν βρέθηκε';
    const InvalidLabRelationType = 'Η Συσχέτιση του Εργαστηρίου πρέπει να είναι αλφαριθμητική';
    const InvalidLabRelationArray = 'Η Συσχέτιση του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabRelationValue = 'Η Συσχέτιση του Εργαστηρίου  του Εργαστηρίου υπάρχει ήδη';
    const UsedLabRelationByLabs = 'Η Συσχέτιση του Εργαστηρίου χρησιμοποιείται από Σχολικά Εργαστήρια';
    
    //########################################
    //Vocabularies Functions
    //######################################## 
    
    //= RegionEduAdmins
    const MissingRegionEduAdminIDParam = 'Ο Κωδικός της Περιφέρειας είναι υποχρεωτικό πεδίο';
    const MissingRegionEduAdminIDValue = 'Ο Κωδικός της Περιφέρειας πρέπει να έχει τιμή';
    const InvalidRegionEduAdminIDType = 'Ο Κωδικός της Περιφέρειας πρέπει να είναι αριθμητικός';
    const InvalidRegionEduAdminIDArray = 'Ο Κωδικός της Περιφέρειας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingRegionEduAdminParam = 'Η Περιφέρεια είναι υποχρεωτικό πεδίο';
    const MissingRegionEduAdminValue = 'Η Περιφέρεια πρέπει να έχει τιμή';
    const InvalidRegionEduAdminValue = 'Η Περιφέρεια δεν υπάρχει στο λεξικό';
    const InvalidRegionEduAdminType = 'Η Περιφέρεια πρέπει να είναι αριθμητική ή αλφαριθμητική';
    const InvalidRegionEduAdminArray = 'Η Περιφέρεια δεν μπορεί να έχει πολλαπλές τιμές';
     
    const MissingRegionEduAdminNameParam = 'Το Όνομα της Περιφέρειας είναι υποχρεωτικό πεδίο';
    const MissingRegionEduAdminNameValue = 'Το Όνομα της Περιφέρειας πρέπει να έχει τιμή';
    const InvalidRegionEduAdminNameType = 'Το Όνομα της Περιφέρειας πρέπει να είναι αλφαριθμητικό';
    const InvalidRegionEduAdminNameArray = 'Το Όνομα της Περιφέρειας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedRegionEduAdminValue = 'Η Περιφέρεια υπάρχει ήδη';
    const UsedRegionEduAdminBySchoolUnits = 'Ο Κωδικός Περιφέρειας χρησιμοποιείται από Σχολικές Μονάδες';
    const UsedRegionEduAdminByEduAdmins = 'Ο Κωδικός Περιφέρειας χρησιμοποιείται από Διευθύνσεις Εκπαίδευσης';
    
    //= EduAdmins
    const MissingEduAdminIDParam = 'Ο Κωδικός της Διεύθυνσης Εκπαίδευσης είναι υποχρεωτικό πεδίο';
    const MissingEduAdminIDValue = 'Ο Κωδικός της Διεύθυνσης Εκπαίδευσης πρέπει να έχει τιμή';
    const InvalidEduAdminIDType = 'Ο Κωδικός της Διεύθυνσης Εκπαίδευσης πρέπει να είναι αριθμητικός';
    const InvalidEduAdminIDArray = 'Ο Κωδικός της Διεύθυνσης Εκπαίδευσης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingEduAdminParam = 'Η Διεύθυνση Εκπαίδευσης είναι υποχρεωτικό πεδίο';
    const MissingEduAdminValue = 'Η Διεύθυνση Εκπαίδευσης πρέπει να έχει τιμή';
    const InvalidEduAdminValue = 'Η Διεύθυνση Εκπαίδευσης δεν υπάρχει στο λεξικό';
    const InvalidEduAdminType = 'Η Διεύθυνση Εκπαίδευσης πρέπει να είναι αριθμητική ή αλφαριθμητική';
    const InvalidEduAdminArray = 'Η Διεύθυνση Εκπαίδευσης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingEduAdminCodeParam = 'Ο Κωδικός της Διεύθυνσης Εκπαίδευσης είναι υποχρεωτικό πεδίο';
    const MissingEduAdminCodeValue = 'Ο Κωδικός της Διεύθυνσης Εκπαίδευσης πρέπει να έχει τιμή';
    const InvalidEduAdminCodeType = 'Ο Κωδικός της Διεύθυνσης Εκπαίδευσης πρέπει να είναι αλφαριθμητικό';
    const InvalidEduAdminCodeArray = 'Ο Κωδικός της Διεύθυνσης Εκπαίδευσης δεν μπορεί να έχει πολλαπλές τιμές';
     
    const MissingEduAdminNameParam = 'Το Όνομα της Διεύθυνσης Εκπαίδευσης είναι υποχρεωτικό πεδίο';
    const MissingEduAdminNameValue = 'Το Όνομα της Διεύθυνσης Εκπαίδευσης πρέπει να έχει τιμή';
    const InvalidEduAdminNameType = 'Το Όνομα της Διεύθυνσης Εκπαίδευσης πρέπει να είναι αλφαριθμητικό';
    const InvalidEduAdminNameArray = 'Το Όνομα της Διεύθυνσης Εκπαίδευσης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedEduAdminValue = 'Η Διεύθυνση Εκπαίδευσης υπάρχει ήδη';
    const UsedEduAdminBySchoolUnits = 'Ο Κωδικός Διεύθυνσης Εκπαίδευσης χρησιμοποιείται από Σχολικές Μονάδες';
    const UsedEduAdminByTransferAreas = 'Ο Κωδικός Διεύθυνσης Εκπαίδευσης χρησιμοποιείται από Περιοχές Μετάθεσης ';
  
    //= TransferAreas
    const MissingTransferAreaIDParam = 'Ο Κωδικός της Περιοχής Μετάθεσης είναι υποχρεωτικό πεδίο';
    const MissingTransferAreaIDValue = 'Ο Κωδικός της Περιοχής Μετάθεσης πρέπει να έχει τιμή';
    const InvalidTransferAreaIDType = 'Ο Κωδικός της Περιοχής Μετάθεσης πρέπει να είναι αριθμητικός';
    const InvalidTransferAreaIDArray = 'Ο Κωδικός της Περιοχής Μετάθεσης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingTransferAreaParam = 'Η Περιοχή Μετάθεσης είναι υποχρεωτικό πεδίο';
    const MissingTransferAreaValue = 'Η Περιοχή Μετάθεσης πρέπει να έχει τιμή';
    const InvalidTransferAreaValue = 'Η Περιοχή Μετάθεσης δεν υπάρχει στο λεξικό';
    const InvalidTransferAreaType = 'Η Περιοχή Μετάθεσης πρέπει να είναι αριθμητική ή αλφαριθμητική';
    const InvalidTransferAreaArray = 'Η Περιοχή Μετάθεσης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingTransferAreaNameParam = 'Το Όνομα της Περιοχής Μετάθεσης είναι υποχρεωτικό πεδίο';
    const MissingTransferAreaNameValue = 'Το Όνομα της Περιοχής Μετάθεσης πρέπει να έχει τιμή';
    const InvalidTransferAreaNameType = 'Το Όνομα της Περιοχής Μετάθεσης πρέπει να είναι αλφαριθμητικό';
    const InvalidTransferAreaNameArray = 'Το Όνομα της Περιοχής Μετάθεσης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedTransferAreaValue = 'Η Περιοχή Μετάθεσης υπάρχει ήδη';
    const UsedTransferAreaBySchoolUnits = 'Ο Κωδικός Περιοχής Μετάθεσης χρησιμοποιείται από Σχολικές Μονάδες';
    const UsedTransferAreaByMunicipalities = 'Ο Κωδικός Περιοχής Μετάθεσης χρησιμοποιείται από Δήμους ';

    //= Municipalities
    const MissingMunicipalityIDParam = 'Ο Κωδικός του Δήμου είναι υποχρεωτικό πεδίο';
    const MissingMunicipalityIDValue = 'Ο Κωδικός του Δήμου πρέπει να έχει τιμή';
    const InvalidMunicipalityIDType = 'Ο Κωδικός του Δήμου πρέπει να είναι αριθμητικός';
    const InvalidMunicipalityIDArray = 'Ο Κωδικός του Δήμου δεν μπορεί να έχει πολλαπλές τιμές';

    const MissingMunicipalityParam = 'Ο Δήμος είναι υποχρεωτικό πεδίο';
    const MissingMunicipalityValue = 'Ο Δήμος πρέπει να έχει τιμή';
    const InvalidMunicipalityValue = 'Ο Δήμος δεν υπάρχει στο λεξικό';
    const InvalidMunicipalityType = 'Ο Δήμος πρέπει να είναι αριθμητικός ή αλφαριθμητικός';
    const InvalidMunicipalityArray = 'Ο Δήμος δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingMunicipalityNameParam = 'Το Όνομα του Δήμου είναι υποχρεωτικό πεδίο';
    const MissingMunicipalityNameValue = 'Το Όνομα του Δήμου πρέπει να έχει τιμή';
    const InvalidMunicipalityNameType = 'Το Όνομα του Δήμου πρέπει να είναι αλφαριθμητικό';
    const InvalidMunicipalityNameArray = 'Το Όνομα του Δήμου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedMunicipalityValue = 'Ο Δήμος υπάρχει ήδη';
    const UsedMunicipalityBySchoolUnits = 'Ο Κωδικός Δήμου χρησιμοποιείται από Σχολικές Μονάδες';
    const UsedMunicipalityByPrefectures = 'Ο Κωδικός Δήμου χρησιμοποιείται από Νομούς '; 
    
    //= Prefectures
    const MissingPrefectureIDParam = 'Ο Κωδικός του Νομού είναι υποχρεωτικό πεδίο';
    const MissingPrefectureIDValue = 'Ο Κωδικός του Νομού πρέπει να έχει τιμή';
    const InvalidPrefectureIDType = 'Ο Κωδικός του Νομού πρέπει να είναι αριθμητικός';
    const InvalidPrefectureIDArray = 'Ο Κωδικός του Νομού δεν μπορεί να έχει πολλαπλές τιμές';

    const MissingPrefectureParam = 'Ο Νομός είναι υποχρεωτικό πεδίο';
    const MissingPrefectureValue = 'Ο Νομός πρέπει να έχει τιμή';
    const InvalidPrefectureValue = 'Ο Νομός δεν υπάρχει στο λεξικό';
    const InvalidPrefectureType = 'Ο Νομός πρέπει να είναι αριθμητικός ή αλφαριθμητικός';
    const InvalidPrefectureArray = 'Ο Νομός δεν μπορεί να έχει πολλαπλές τιμές';
  
    const MissingPrefectureNameParam = 'Το Όνομα του Νομού είναι υποχρεωτικό πεδίο';
    const MissingPrefectureNameValue = 'Το Όνομα του Νομού πρέπει να έχει τιμή';
    const InvalidPrefectureNameType = 'Το Όνομα ου Νομού πρέπει να είναι αλφαριθμητικό';
    const InvalidPrefectureNameArray = 'Το Όνομα του Νομού δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedPrefectureValue = 'Ο Νομός υπάρχει ήδη';
    const UsedPrefectureBySchoolUnits = 'Ο Κωδικός Νομού χρησιμοποιείται από Σχολικές Μονάδες';

    //= EducationLevels
    const MissingEducationLevelIDParam = 'Ο Κωδικός του Επιπέδου Εκπαίδευσης είναι υποχρεωτικό πεδίο';
    const MissingEducationLevelIDValue = 'Ο Κωδικός του Επιπέδου Εκπαίδευσης πρέπει να έχει τιμή';
    const InvalidEducationLevelIDType = 'Ο Κωδικός του Επιπέδου Εκπαίδευσης πρέπει να είναι αριθμητικός';
    const InvalidEducationLevelIDArray = 'Ο Κωδικός του Επιπέδου Εκπαίδευσης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingEducationLevelParam = 'Το Επίπεδο Εκπαίδευσης είναι υποχρεωτικό πεδίο';
    const MissingEducationLevelValue = 'Το Επίπεδο Εκπαίδευσης πρέπει να έχει τιμή';
    const InvalidEducationLevelValue = 'Το Επίπεδο Εκπαίδευσης δεν υπάρχει στο λεξικό';
    const InvalidEducationLevelType = 'Το Επίπεδο Εκπαίδευσης πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidEducationLevelArray = 'Το Επίπεδο Εκπαίδευσης δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingEducationLevelNameParam = 'Το Όνομα του Επιπέδου Εκπαίδευσης είναι υποχρεωτικό πεδίο';
    const MissingEducationLevelNameValue = 'Το Όνομα του Επιπέδου Εκπαίδευσης πρέπει να έχει τιμή';
    const InvalidEducationLevelNameType = 'Το Όνομα του Επιπέδου Εκπαίδευσης πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidEducationLevelNameArray = 'Το Όνομα του Επιπέδου Εκπαίδευσης δεν μπορεί να έχει πολλαπλές τιμές';    

    const DuplicatedEducationLevelValue = 'Το Επίπεδο Εκπαίδευσης υπάρχει ήδη';
    const UsedEducationLevelBySchoolUnits = 'Ο Κωδικός Επίπεδου Εκπαίδευσης χρησιμοποιείται από Σχολικές Μονάδες';
    const UsedEducationLevelBySchoolUnitTYpes = 'Ο Κωδικός Επίπεδου Εκπαίδευσης χρησιμοποιείται από Τύπους Σχολικών Μονάδων';
    
    //= SchoolUnitTypes
    const MissingSchoolUnitTypeIDParam = 'Ο Κωδικός του Τύπου Σχολικής Μονάδας είναι υποχρεωτικό πεδίο';
    const MissingSchoolUnitTypeIDValue = 'Ο Κωδικός του Τύπου Σχολικής Μονάδας πρέπει να έχει τιμή';
    const InvalidSchoolUnitTypeIDType = 'Ο Κωδικός του Τύπου Σχολικής Μονάδας πρέπει να είναι αριθμητικός';
    const InvalidSchoolUnitTypeIDArray = 'Ο Κωδικός του Τύπου Σχολικής Μονάδας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingSchoolUnitTypeParam = 'Ο Τύπος Σχολικής Μονάδας είναι υποχρεωτικό πεδίο';
    const MissingSchoolUnitTypeValue = 'Ο Τύπος Σχολικής Μονάδας πρέπει να έχει τιμή';
    const InvalidSchoolUnitTypeValue = 'Ο Τύπος Σχολικής Μονάδας δεν υπάρχει στο λεξικό';
    const InvalidSchoolUnitTypeType = 'Ο Τύπος Σχολικής Μονάδας πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidSchoolUnitTypeArray = 'Ο Τύπος Σχολικής Μονάδας δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingSchoolUnitTypeNameParam = 'Το Όνομα του Τύπου Σχολικής Μονάδας είναι υποχρεωτικό πεδίο';
    const MissingSchoolUnitTypeNameValue = 'Το Όνομα του Τύπου Σχολικής Μονάδας πρέπει να έχει τιμή';
    const InvalidSchoolUnitTypeNameType = 'Το Όνομα του Τύπου Σχολικής Μονάδας πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidSchoolUnitTypeNameArray = 'Το Όνομα του Τύπου Σχολικής Μονάδας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingSchoolUnitTypeInitialParam = 'Η Συντομογραφία Ονόματος του Τύπου Σχολικής Μονάδας είναι υποχρεωτικό πεδίο';
    const MissingSchoolUnitTypeInitialValue = 'Η Συντομογραφία Ονόματος του Τύπου Σχολικής Μονάδας πρέπει να έχει τιμή';
    const InvalidSchoolUnitTypeInitialType = 'Η Συντομογραφία Ονόματος του Τύπου Σχολικής Μονάδας πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidSchoolUnitTypeInitialArray = 'Η Συντομογραφία Ονόματος του Τύπου Σχολικής Μονάδας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedSchoolUnitTypeValue = 'Ο Τύπος Σχολικής Μονάδας υπάρχει ήδη';
    const DuplicatedSchoolUnitTypeNameValue = 'Το Όνομα του Τύπου Σχολικής Μονάδας υπάρχει ήδη';
    const DuplicatedSchoolUnitTypeInitialValue = 'Η Συντομογραφία Ονόματος του Τύπου Σχολικής Μονάδας υπάρχει ήδη';
    const UsedSchoolUnitTypeBySchoolUnits = 'Ο Κωδικός του Τύπου Σχολικής Μονάδας χρησιμοποιείται από Σχολικές Μονάδες';

    //= States
    const MissingStateIDParam = 'Ο Κωδικός της Κατάστασης είναι υποχρεωτικό πεδίο';
    const MissingStateIDValue = 'Ο Κωδικός της Κατάστασης πρέπει να έχει τιμή';
    const InvalidStateIDType = 'Ο Κωδικός της Κατάστασης πρέπει να είναι αριθμητικός';
    const InvalidStateIDArray = 'Ο Κωδικός της Κατάστασης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingStateParam = 'Η Κατάσταση είναι υποχρεωτικό πεδίο';
    const MissingStateValue = 'Η Κατάσταση πρέπει να έχει τιμή';
    const InvalidStateValue = 'Η Κατάσταση δεν υπάρχει στο λεξικό';
    const InvalidStateType = 'Η Κατάσταση πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidStateArray = 'Η Κατάσταση δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingStateNameParam = 'Το Όνομα της Κατάστασης είναι υποχρεωτικό πεδίο';
    const MissingStateNameValue = 'Το Όνομα της Κατάστασης πρέπει να έχει τιμή';
    const InvalidStateNameType = 'Το Όνομα της Κατάστασης πρέπει να είναι αλφαριθμητικό';
    const InvalidStateNameArray = 'Το Όνομα της Κατάστασης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedStateValue = 'Η Κατάσταση υπάρχει ήδη';
    const UsedStateBySchoolUnits = 'Ο Κωδικός της Κατάστασης χρησιμοποιείται από Σχολικές Μονάδες';
    const UsedStateBySchoolUnitTYpes = 'Ο Κωδικός της Κατάστασης χρησιμοποιείται από Τύπους Σχολικών Μονάδων';
    
    //= CircuitTypes
    const MissingCircuitTypeIDParam = 'Ο Κωδικός του Τυπου Τηλεπικοινωνιακού Κυκλώματος είναι υποχρεωτικό πεδίο';
    const MissingCircuitTypeIDValue = 'Ο Κωδικός του Τυπου Τηλεπικοινωνιακού Κυκλώματος πρέπει να έχει τιμή';
    const InvalidCircuitTypeIDType = 'Ο Κωδικός του Τυπου Τηλεπικοινωνιακού Κυκλώματος πρέπει να είναι αριθμητικός';
    const InvalidCircuitTypeIDArray = 'Ο Κωδικός του Τυπου Τηλεπικοινωνιακού Κυκλώματος δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingCircuitTypeParam = 'Ο Τύπος Τηλεπικοινωνιακού Κυκλώματος είναι υποχρεωτικό πεδίο';
    const MissingCircuitTypeValue = 'Ο Τύπος Τηλεπικοινωνιακού Κυκλώματος πρέπει να έχει τιμή';
    const InvalidCircuitTypeValue = 'Ο Τύπος Τηλεπικοινωνιακού Κυκλώματος δεν υπάρχει στο λεξικό';
    const InvalidCircuitTypeType = 'Ο Τύπος Τηλεπικοινωνιακού Κυκλώματος πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidCircuitTypeArray = 'Ο Τύπος Τηλεπικοινωνιακού Κυκλώματος δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingCircuitTypeNameParam = 'Το Όνομα του Τύπου Τηλεπικοινωνιακού Κυκλώματος είναι υποχρεωτικό πεδίο';
    const MissingCircuitTypeNameValue = 'Το Όνομα του Τύπου Τηλεπικοινωνιακού Κυκλώματος πρέπει να έχει τιμή';
    const InvalidCircuitTypeNameType = 'Το Όνομα του Τύπου Τηλεπικοινωνιακού Κυκλώματος πρέπει να είναι αλφαριθμητικό';
    const InvalidCircuitTypeNameArray = 'Το Όνομα του Τύπου Τηλεπικοινωνιακού Κυκλώματος δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedCircuitTypeValue = 'Ο Τύπος Τηλεπικοινωνιακού Κυκλώματος υπάρχει ήδη';
    const UsedCircuitTypeByCircuits = 'Ο Κωδικός του Τυπου Τηλεπικοινωνιακού Κυκλώματος χρησιμοποιείται από Τηλεπικοινωνιακά Κυκλώματα';

    //= RelationTypes
    const MissingRelationTypeIDParam = 'Ο Κωδικός του Τυπου Συσχέτισης είναι υποχρεωτικό πεδίο';
    const MissingRelationTypeIDValue = 'Ο Κωδικός του Τυπου Συσχέτισης πρέπει να έχει τιμή';
    const InvalidRelationTypeIDType = 'Ο Κωδικός του Τυπου Συσχέτισης πρέπει να είναι αριθμητικός';
    const InvalidRelationTypeIDArray = 'Ο Κωδικός του Τυπου Συσχέτισης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingRelationTypeParam = 'Ο Τύπος Συσχέτισης είναι υποχρεωτικό πεδίο';
    const MissingRelationTypeValue = 'Ο Τύπος Συσχέτισης πρέπει να έχει τιμή';
    const InvalidRelationTypeValue = 'Ο Τύπος Συσχέτισης δεν υπάρχει στο λεξικό';
    const InvalidRelationTypeType = 'Ο Τύπος Συσχέτισης πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidRelationTypeArray = 'Ο Τύπος Συσχέτισης δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingRelationTypeNameParam = 'Το Όνομα του Τύπου Συσχέτισης είναι υποχρεωτικό πεδίο';
    const MissingRelationTypeNameValue = 'Το Όνομα του Τύπου Συσχέτισης πρέπει να έχει τιμή';
    const InvalidRelationTypeNameType = 'Το Όνομα του Τύπου Συσχέτισης πρέπει να είναι αλφαριθμητικό';
    const InvalidRelationTypeNameArray = 'Το Όνομα του Τύπου Συσχέτισης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedRelationTypeValue = 'Ο Τύπος Συσχέτισης υπάρχει ήδη';
    const UsedRelationTypeByLabRelations = 'Ο Κωδικός του Τυπου Συσχέτισης χρησιμοποιείται από Συσχέτισεις Εργαστηρίων';
  
    //= WorkerPositions
    const MissingWorkerPositionIDParam = 'Ο Κωδικός της Θέσης Εργασίας είναι υποχρεωτικό πεδίο';
    const MissingWorkerPositionIDValue = 'Ο Κωδικός της Θέσης Εργασίας πρέπει να έχει τιμή';
    const InvalidWorkerPositionIDType = 'Ο Κωδικός της Θέσης Εργασίας πρέπει να είναι αριθμητικός';
    const InvalidWorkerPositionIDArray = 'Ο Κωδικός της Θέσης Εργασίας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingWorkerPositionParam = 'Η Θέση Εργασίας είναι υποχρεωτικό πεδίο';
    const MissingWorkerPositionValue = 'Η Θέση Εργασίας πρέπει να έχει τιμή';
    const InvalidWorkerPositionValue = 'Η Θέση Εργασίας δεν υπάρχει στο λεξικό';
    const InvalidWorkerPositionType = 'Η Θέση Εργασίας πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidWorkerPositionArray = 'Η Θέση Εργασίας δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingWorkerPositionNameParam = 'Το Όνομα της Θέσης Εργασίας είναι υποχρεωτικό πεδίο';
    const MissingWorkerPositionNameValue = 'Το Όνομα της Θέσης Εργασίας πρέπει να έχει τιμή';
    const InvalidWorkerPositionNameType = 'Το Όνομα της Θέσης Εργασίας πρέπει να είναι αλφαριθμητικό';
    const InvalidWorkerPositionNameArray = 'Το Όνομα της Θέσης Εργασίας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedWorkerPositionValue = 'Η Θέση Εργασίας υπάρχει ήδη';
    const UsedWorkerPositionBySchoolUnitWorkers = 'Ο Κωδικός της Θέσης Εργασίας χρησιμοποιείται από Εργαζόμενους Σχολικών Μοναδων';
    const UsedWorkerPositionByLabWorkers = 'Ο Κωδικός της Θέσης Εργασίας χρησιμοποιείται από Εργαζόμενους Εργαστηρίων';
    
    //= WorkerSpecializations
    const MissingWorkerSpecializationIDParam = 'Ο Κωδικός της Ειδικότητας Εργαζόμενου είναι υποχρεωτικό πεδίο';
    const MissingWorkerSpecializationIDValue = 'Ο Κωδικός της Ειδικότητας Εργαζόμενου πρέπει να έχει τιμή';
    const InvalidWorkerSpecializationIDType = 'Ο Κωδικός της Ειδικότητας Εργαζόμενου πρέπει να είναι αριθμητικός';
    const InvalidWorkerSpecializationIDArray = 'Ο Κωδικός της Ειδικότητας Εργαζόμενου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingWorkerSpecializationParam = 'Η Ειδικότητα Εργαζόμενου είναι υποχρεωτικό πεδίο';
    const MissingWorkerSpecializationValue = 'Η Ειδικότητα Εργαζόμενου πρέπει να έχει τιμή';
    const InvalidWorkerSpecializationValue = 'Η Ειδικότητα Εργαζόμενου δεν υπάρχει στο λεξικό';
    const InvalidWorkerSpecializationType = 'Η Ειδικότητα Εργαζόμενου πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidWorkerSpecializationArray = 'Η Ειδικότητα Εργαζόμενου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingWorkerSpecializationNameParam = 'Το Όνομα της Ειδικότητας Εργαζόμενου είναι υποχρεωτικό πεδίο';
    const MissingWorkerSpecializationNameValue = 'Το Όνομα της Ειδικότητας Εργαζόμενου πρέπει να έχει τιμή';
    const InvalidWorkerSpecializationNameType = 'Το Όνομα της Ειδικότητας Εργαζόμενου πρέπει να είναι αλφαριθμητικό';
    const InvalidWorkerSpecializationNameArray = 'Το Όνομα της Ειδικότητας Εργαζόμενου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedWorkerSpecializationValue = 'Η Ειδικότητα Εργαζόμενου υπάρχει ήδη';
    const UsedWorkerSpecializationBySchoolUnitWorkers = 'Ο Κωδικός της Ειδικότητας Εργαζόμενου χρησιμοποιείται από Εργαζόμενους Σχολικών Μοναδων';
    const UsedWorkerSpecializationByLabWorkers = 'Ο Κωδικός της Ειδικότητας Εργαζόμενου χρησιμοποιείται από Εργαζόμενους Εργαστηρίων';
    
    //= LabTypes
    const MissingLabTypeIDParam = 'Ο Κωδικός του Τύπου Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabTypeIDValue = 'Ο Κωδικός του Τύπου Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTypeIDType = 'Ο Κωδικός του Τύπου Εργαστηρίου πρέπει να είναι αριθμητικός';
    const InvalidLabTypeIDArray = 'Ο Κωδικός του Τύπου Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingLabTypeParam = 'Ο Τύπος Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabTypeValue = 'Ο Τύπος Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTypeValue = 'Ο Τύπος Εργαστηρίου δεν υπάρχει στο λεξικό';
    const InvalidLabTypeType = 'Ο Τύπος Εργαστηρίου πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidLabTypeArray = 'Ο Τύπος Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingLabTypeNameParam = 'Το Όνομα του Τύπου Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabTypeNameValue = 'Το Όνομα του Τύπου Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTypeNameType = 'Το Όνομα του Τύπου Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabTypeNameArray = 'Το Όνομα του Τύπου Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingLabTypeFullNameParam = 'Το Πλήρης Όνομα του Τύπου Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabTypeFullNameValue = 'Το Πλήρης Όνομα του Τύπου Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTypeFullNameType = 'Το Πλήρης Όνομα του Τύπου Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabTypeFullNameArray = 'Το Πλήρης Όνομα του Τύπου Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabTypeValue = 'Ο Τύπος Εργαστηρίου υπάρχει ήδη';
    const UsedLabTypeByLabs = 'Ο Κωδικός του Τύπου Εργαστηρίου χρησιμοποιείται από Εργαστήρια';

    //= LabSources
    const MissingLabSourceIDParam = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabSourceIDValue = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabSourceIDType = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου πρέπει να είναι αριθμητικός';
    const InvalidLabSourceIDArray = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingLabSourceParam = 'Η Πρωτογενής Πηγή Δεδομένων Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabSourceValue = 'Η Πρωτογενής Πηγή Δεδομένων Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabSourceValue = 'Η Πρωτογενής Πηγή Δεδομένων Εργαστηρίου δεν υπάρχει στο λεξικό';
    const InvalidLabSourceType = 'Η Πρωτογενής Πηγή Δεδομένων Εργαστηρίου πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidLabSourceArray = 'Η Πρωτογενής Πηγή Δεδομένων Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingLabSourceNameParam = 'Το Όνομα της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabSourceNameValue = 'Το Όνομα της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabSourceNameType = 'Το Όνομα της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabSourceNameArray = 'Το Όνομα της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabSourceValue = 'Η Πρωτογενής Πηγή Δεδομένων Εργαστηρίου υπάρχει ήδη';
    const UsedLabSourceByLabs = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου χρησιμοποιείται από Εργαστήρια';
    
    //= EquipmentCategories
    const MissingEquipmentCategoryIDParam = 'Ο Κωδικός της Κατηγορίας Εξοπλισμού είναι υποχρεωτικό πεδίο';
    const MissingEquipmentCategoryIDValue = 'Ο Κωδικός της Κατηγορίας Εξοπλισμού πρέπει να έχει τιμή';
    const InvalidEquipmentCategoryIDType = 'Ο Κωδικός της Κατηγορίας Εξοπλισμού πρέπει να είναι αριθμητικός';
    const InvalidEquipmentCategoryIDArray = 'Ο Κωδικός της Κατηγορίας Εξοπλισμού δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingEquipmentCategoryParam = 'Η Κατηγορία Εξοπλισμού είναι υποχρεωτικό πεδίο';
    const MissingEquipmentCategoryValue = 'Η Κατηγορία Εξοπλισμού πρέπει να έχει τιμή';
    const InvalidEquipmentCategoryValue = 'Η Κατηγορία Εξοπλισμού δεν υπάρχει στο λεξικό';
    const InvalidEquipmentCategoryType = 'Η Κατηγορία Εξοπλισμού πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidEquipmentCategoryArray = 'Η Κατηγορία Εξοπλισμού δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingEquipmentCategoryNameParam = 'Το Όνομα της Κατηγορίας Εξοπλισμού είναι υποχρεωτικό πεδίο';
    const MissingEquipmentCategoryNameValue = 'Το Όνομα της Κατηγορίας Εξοπλισμού πρέπει να έχει τιμή';
    const InvalidEquipmentCategoryNameType = 'Το Όνομα της Κατηγορίας Εξοπλισμού πρέπει να είναι αλφαριθμητικό';
    const InvalidEquipmentCategoryNameArray = 'Το Όνομα της Κατηγορίας Εξοπλισμού δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedEquipmentCategoryValue = 'Η Κατηγορία Εξοπλισμού υπάρχει ήδη';
    const UsedEquipmentCategoryByEquipmentTypes = 'Ο Κωδικός της Κατηγορίας Εξοπλισμού χρησιμοποιείται από Τύπους Εξοπλισμού Εργαστηρίων';
    
    //= EquipmentTypes
    const MissingEquipmentTypeIDParam = 'Ο Κωδικός του Τύπου Εξοπλισμού είναι υποχρεωτικό πεδίο';
    const MissingEquipmentTypeIDValue = 'Ο Κωδικός του Τύπου Εξοπλισμού πρέπει να έχει τιμή';
    const InvalidEquipmentTypeIDType = 'Ο Κωδικός του Τύπου Εξοπλισμού πρέπει να είναι αριθμητικός';
    const InvalidEquipmentTypeIDArray = 'Ο Κωδικός του Τύπου Εξοπλισμού δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingEquipmentTypeParam = 'Ο Τύπος Εξοπλισμού είναι υποχρεωτικό πεδίο';
    const MissingEquipmentTypeValue = 'Ο Τύπος Εξοπλισμού πρέπει να έχει τιμή';
    const InvalidEquipmentTypeValue = 'Ο Τύπος Εξοπλισμού δεν υπάρχει στο λεξικό';
    const InvalidEquipmentTypeType = 'Ο Τύπος Εξοπλισμού πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidEquipmentTypeArray = 'Ο Τύπος Εξοπλισμού δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingEquipmentTypeNameParam = 'Το Όνομα του Τύπου Εξοπλισμού είναι υποχρεωτικό πεδίο';
    const MissingEquipmentTypeNameValue = 'Το Όνομα του Τύπου Εξοπλισμού πρέπει να έχει τιμή';
    const InvalidEquipmentTypeNameType = 'Το Όνομα του Τύπου Εξοπλισμού πρέπει να είναι αλφαριθμητικό';
    const InvalidEquipmentTypeNameArray = 'Το Όνομα του Τύπου Εξοπλισμού δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedEquipmentTypeValue = 'Ο Τύπος Εξοπλισμού υπάρχει ήδη';
    const UsedEquipmentTypeByLabEquipmentTypes = 'Ο Κωδικός του Τύπου Εξοπλισμού χρησιμοποιείται στον Εξοπλισμό Εργαστηρίων';
    
    //= AquisitionSources
    const MissingAquisitionSourceIDParam = 'Ο Κωδικός της Πηγής Χρηματοδότησης είναι υποχρεωτικό πεδίο';
    const MissingAquisitionSourceIDValue = 'Ο Κωδικός της Πηγής Χρηματοδότησης πρέπει να έχει τιμή';
    const InvalidAquisitionSourceIDType = 'Ο Κωδικός της Πηγής Χρηματοδότησης πρέπει να είναι αριθμητικός';
    const InvalidAquisitionSourceIDArray = 'Ο Κωδικός της Πηγής Χρηματοδότησης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingAquisitionSourceParam = 'Η Πηγή Χρηματοδότησης είναι υποχρεωτικό πεδίο';
    const MissingAquisitionSourceValue = 'Η Πηγή Χρηματοδότησης πρέπει να έχει τιμή';
    const InvalidAquisitionSourceValue = 'Η Πηγή Χρηματοδότησης δεν υπάρχει στο λεξικό';
    const InvalidAquisitionSourceType = 'Η Πηγή Χρηματοδότησης πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidAquisitionSourceArray = 'Η Πηγή Χρηματοδότησης δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingAquisitionSourceNameParam = 'Το Όνομα της Πηγής Χρηματοδότησης είναι υποχρεωτικό πεδίο';
    const MissingAquisitionSourceNameValue = 'Το Όνομα της Πηγής Χρηματοδότησης πρέπει να έχει τιμή';
    const InvalidAquisitionSourceNameType = 'Το Όνομα της Πηγής Χρηματοδότησης πρέπει να είναι αλφαριθμητικό';
    const InvalidAquisitionSourceNameArray = 'Το Όνομα της Πηγής Χρηματοδότησης δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedAquisitionSourceValue = 'Η Πηγή Χρηματοδότησης υπάρχει ήδη';
    const UsedAquisitionSourceByLabAquisitionSources = 'Ο Κωδικός της Πηγής Χρηματοδότησης χρησιμοποιείται στην Πηγή Χρηματοδότησης Εργαστήριων';
    
    //page,pagesize,orderby,ordertype,searchtype
    const MissingPageValue = 'Ο Αριθμός Σελίδας πρέπει να έχει τιμή';
    const InvalidPageNumber = 'Ο Αριθμός Σελίδας δεν μπορεί να έχει αρνητική τιμή και πρέπει να είναι μεγαλύτερος από 0';
    const InvalidPageType = 'Ο Αριθμός Σελίδας πρέπει να είναι αριθμητικός';
    const InvalidPageArray = 'Ο Αριθμός Σελίδας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const InvalidMaxPageNumber = 'Ο Αριθμός Σελίδας έιναι μεγαλύτερος από την μέγιστη τιμή της σελιδοποίησης. Μέγιστη τιμή σελιδοποίησης = ';
    
    const MissingPageSizeValue = 'Ο Αριθμός Εγγραφών/Σελίδα πρέπει να έχει τιμή';
    const MissingPageSizeNegativeValue = 'Ο Αριθμός Εγγραφών/Σελίδα δεν μπορεί να έχει αρνητική τιμή και πρέπει να είναι μεγαλύτερος από 0';
    const InvalidPageSizeNumber = 'Ο Αριθμός Εγγραφών/Σελίδα πρέπει να είναι από 0 έως 500';
    const InvalidPageSizeType = 'Ο Αριθμός Εγγραφών/Σελίδα πρέπει να είναι αριθμητικός';
    const InvalidPageSizeArray = 'Ο Αριθμός Εγγραφών/Σελίδα δεν μπορεί να έχει πολλαπλές τιμές';
    
    const InvalidSearchType = 'Ο Τύπος Αναζήτησης είναι λάθος';
    const InvalidOrderType = 'Ο Τύπος Ταξινόμησης πρέπει να είναι ASC ή DESC';
    const InvalidOrderBy = 'Το Πεδίο Ταξινόμησης πρέπει να είναι κάποιο από τα πεδία που επιστρέφει η συνάρτηση';
    
    //authentication roles
    const NoPermissionsError = 'Δεν βρέθηκαν σχολική μονάδα που να αντιστοιχεί στον ρόλο του χρήστη';
    
    const NotFoundUserPermissions = 'Δεν βρεθηκαν δικαιωματα για τον ρόλο του χρήστη.';
    const NotFoundFullSchoolUnitDnsName = 'Δεν βρέθηκε σχολική μονάδα που να συνδέεται με τον ldap λογαριασμό του χρήστη.';
    const DuplicateFullSchoolUnitDnsName = 'Βρέθηκαν παραπάνω από μία σχολική μονάδα που να συνδέεται με τον ldap λογαριασμό του χρήστη.';
    const MissingLdapLattribute = 'Δεν βρέθηκε to "l" attribute στον ldap λογαριασμό του χρήστη.';
    const MissingLdapEmployeeNumberAttribute = 'Δεν βρέθηκε to "employeeNumber" attribute στον ldap λογαριασμό του χρήστη.';
    
    const NoPermissionToPostLab = 'Ο χρήστης δεν έχει δικαίωμα εισαγωγής στο συγκεκριμενο εργαστηριο';
    const NoPermissionToPutLab = 'Ο χρήστης δεν έχει δικαίωμα ενημερωσης στο συγκεκριμενο εργαστηριο';
    const NoPermissionToDeleteLab = 'Ο χρήστης δεν έχει δικαίωμα διαγραφης στο συγκεκριμενο εργαστηριο';    
    const NoPermissionToGetLab = 'Ο χρήστης δεν έχει δικαίωμα αναζητησης στο συγκεκριμενο εργαστηριο';
   
    //reports
    const ErrorEduAdminReportKeplhnet = 'Κάθε ΚΕΠΛΗΝΕΤ αντιστοιχίζεται υποχρεωτικά με μια Διεύθυνση Δ.Ε. και μια Διεύθυνση Δ.Ε. ίδιας πόλης.'; 
}
   ?>