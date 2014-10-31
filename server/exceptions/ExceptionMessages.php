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
        const MethodNotFound = 'H μέθοδος δεν βρέθηκε';
        
        const Unauthorized = 'Unauthorized';
        
        const MissingXAxisParam = 'Ο Άξονας x είναι υποχρεωτικό πεδίο';
        const MissingXAxisValue = 'Ο Άξονας x πρέπει να έχει τιμή';
        const InvalidXAxisType = 'Ο Άξονας x πρέπει να είναι αλφαριθμητικός';
        const InvalidXAxisArray = 'Ο Άξονας x δεν μπορεί να έχει πολλαπλές τιμές';
        const InvalidXAxis = 'Ο Άξονας x πρέπεινα πρέπει να είναι κάποιο από τα πεδία που επιστρέφει η συνάρτηση';

        const MissingYAxisParam = 'Ο Άξονας y είναι υποχρεωτικό πεδίο';
        const MissingYAxisValue = 'Ο Άξονας y πρέπει να έχει τιμή';
        const InvalidYAxisType = 'Ο Άξονας y πρέπει να είναι αλφαριθμητικός';
        const InvalidYAxisArray = 'Ο Άξονας y δεν μπορεί να έχει πολλαπλές τιμές';
        const InvalidYAxis = 'Ο Άξονας y πρέπεινα πρέπει να είναι κάποιο από τα πεδία που επιστρέφει η συνάρτηση';
        
        const DuplicateXYAxisParam = 'Ο Άξονας x και y δεν μπορούν να έχουν την ίδια τιμή.';
  
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
    const InvalidSchoolUnitUnitDns = 'Ο Κωδικός DNS της Μονάδας πρέπει να είναι αλφαριθμητικός';
     
    const DuplicatedSchoolUnitValue = 'H Μονάδα υπάρχει ήδη';
    const DuplicateSchoolUnitUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key SchoolUnit';
    
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
    const DuplicateCircuitUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key Circuit';
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
    const DuplicateSchoolWorkerUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key Worker';
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
   
    const MissingWorkerRegistryNoParam = 'Ο Αριθμός Μητρώου του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerRegistryNoValue = 'Ο Αριθμός Μητρώου του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerRegistryNoType = 'Ο Αριθμός Μητρώου του Εργαζομένου πρέπει να είναι αριθμητικός';
    const InvalidWorkerRegistryNoArray = 'Ο Αριθμός Μητρώου του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingWorkerTaxNumberParam = 'Το ΑΦΜ του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerTaxNumberValue = 'Το ΑΦΜ του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerTaxNumberType = 'Το ΑΦΜ του Εργαζομένου πρέπει να είναι αριθμητικός';
    const InvalidWorkerTaxNumberArray = 'Το ΑΦΜ του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingWorkerLastnameParam = 'Το Επώνυμο του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerLastnameValue = 'Το Επώνυμο του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerLastnameType = 'Το Επώνυμο του Εργαζομένου πρέπει να είναι αλφαριθμητικό';
    const InvalidWorkerLastnameArray = 'Το Επώνυμο του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';

    const MissingWorkerFirstnameParam = 'Το Όνομα του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerFirstnameValue = 'Το Όνομα του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerFirstnameType = 'Το Όνομα του Εργαζομένου πρέπει να είναι αλφαριθμητικό';
    const InvalidWorkerFirstnameArray = 'Το Όνομα του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingWorkerFatherNameParam = 'Το Όνομα Πατρός του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerFatherNameValue = 'Το Όνομα Πατρός του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerFatherNameType = 'Το Όνομα Πατρός του Εργαζομένου πρέπει να είναι αλφαριθμητικό';
    const InvalidWorkerFatherNameArray = 'Το Όνομα Πατρός του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingWorkerSexTypeParam = 'Το Φύλο του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingWorkerSexTypeValue = 'Το Φύλο του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidWorkerSexTypeType = 'Το Φύλο του Εργαζομένου πρέπει να είναι αλφαριθμητική : Α (Άντρας) ή Γ (Γυναικα';
    const InvalidWorkerSexTypeArray = 'Το Φύλο του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicateWorkerUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key Worker';
  
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
    
    const MissingLabWorkerStatusParam = 'H Κατάσταση του Εργαζομένου Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabWorkerStatusValue = 'H Κατάσταση του Εργαζομένου Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabWorkerStatusType = 'H Κατάσταση του Εργαζομένου Εργαστηρίου πρέπει να είναι αριθμητική : 1 (Ενεργή) ή 3 (Ανενεργή)';
    const InvalidLabWorkerStatusArray = 'H Κατάσταση του Εργαζομένου Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';

    const MissingLabWorkerStartServiceParam = 'Η Ημερομηνία Έναρξης του Εργαζομένου Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabWorkerStartServiceValue = 'Η Ημερομηνία Έναρξης του Εργαζομένου Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabWorkerStartServiceType = 'Η Ημερομηνία Έναρξης  του Εργαζομένου Εργαστηρίου πρέπει να είναι Ημερομηνία (dd/mm/yyyy)';
    const InvalidLabWorkerStartServiceArray = 'Η Ημερομηνία Έναρξης  του Εργαζομένου Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabWorkerValue = 'Ο Εργαζόμενος Εργαστηρίου υπάρχει ήδη';
    const UsedLabWorkerByLabs = 'Ο Κωδικός του Εργαζόμενου Εργαστηρίου χρησιμοποιείται από Σχολικά Εργαστήρια';
    const DuplicateLabWorkerUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key Worker';
    const NotAllowedLabWorkerStartService = 'Δεν είναι δυνατή η εισαγωγή ημερομηνίας προγενέστερη από την ημερομηνία εισαγωγής του προηγούμενου υπεύθυνου';
    
    //extra
    const InvalidLabWorkerEmailType = 'Το Email του Εργαζομένου Εργαστηρίου πρέπει να έχει την μορφή xxxxx@xxxxx.xx';
    const InvalidLabWorkerStartServiceValidType = 'Η Ημερομηνία Έναρξης του Εργαζομένου Εργαστηρίου πρέπει να έιναι μεταξύ των τιμών "1975 - current_date"';
    const InvalidLabWorkerActiveStatus = 'Βρέθηκαν παραπάνω από 1 Ενεργός Eργαζόμενος για το συγκεκριμένο Εργαστήριο';
    const InvalidLabWorkerNewWorkerStatus = 'Δεν είναι δυνατή η προσθήκη νέου Ενεργού Εργαζόμενου, επειδή υπάρχει ήδη Ενεργός Εργαζόμενος';
    const InvalidLabWorkerSetStatus = 'Δεν είναι δυνατή η προσθήκη νέου Ενεργού Εργαζόμενου, επειδή δεν έχει γίνει οριστική υποβολή Εργαστηρίου';
     
    //delete
    const DuplicateDelLabWorkerValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο κωδικό εργαστηρίου και κωδικό εγγραφής.'; 
    const NotFoundDelLabWorkerValue = 'Δεν βρέθηκε η εγγραφή προς διαγραφή.';
    const NoPermissionDelLabWorkerValue = 'Δεν είναι δυνατή η διαγραφή ενός μή ενεργού Εργαζόμενου.';
    
    //= MylabWorkers

    const MissingMylabWorkerIDParam = 'Ο Κωδικός του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingMylabWorkerIDValue = 'Ο Κωδικός του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidMylabWorkerIDType = 'Ο Κωδικός του Εργαζομένου πρέπει να είναι αριθμητικός';
    const InvalidMylabWorkerIDArray = 'Ο Κωδικός του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
   
    const MissingMylabWorkerParam = 'Ο Εργαζόμενος είναι υποχρεωτικό πεδίο';
    const MissingMylabWorkerValue = 'Ο Εργαζόμενος πρέπει να έχει τιμή';
    const InvalidMylabWorkerValue = 'Ο Εργαζόμενος δεν βρέθηκε';
    const InvalidMylabWorkerType = 'Ο Εργαζόμενος πρέπει να είναι αριθμητικός ή αλφαριθμητικός';
    const InvalidMylabWorkerArray = 'Ο Εργαζόμενος δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedMylabWorkerValue = 'Ο Εργαζόμενος υπάρχει ήδη';
    const DuplicatedMylabWorkerRegistryNoValue = 'Ο Αριθμός Μητρώου του Εργαζομένου υπάρχει ήδη';
    const DuplicatedMylabWorkerTaxNumberValue = 'Το ΑΦΜ του Εργαζομένου υπάρχει ήδη';
    const UsedMylabWorkerBySchoolUnitLabs = 'Ο Κωδικός του Εργαζόμενου χρησιμοποιείται από Σχολικά Εργαστήρια';
   
    const MissingMylabWorkerRegistryNoParam = 'Ο Αριθμός Μητρώου του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingMylabWorkerRegistryNoValue = 'Ο Αριθμός Μητρώου του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidMylabWorkerRegistryNoType = 'Ο Αριθμός Μητρώου του Εργαζομένου πρέπει να είναι αριθμητικός';
    const InvalidMylabWorkerRegistryNoArray = 'Ο Αριθμός Μητρώου του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingMylabWorkerLastnameParam = 'Το Επώνυμο του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingMylabWorkerLastnameValue = 'Το Επώνυμο του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidMylabWorkerLastnameType = 'Το Επώνυμο του Εργαζομένου πρέπει να είναι αριθμητικός ή αλφαριθμητικός';
    const InvalidMylabWorkerLastnameArray = 'Το Επώνυμο του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';

    const MissingMylabWorkerFirstnameParam = 'Το Όνομα του Εργαζομένου είναι υποχρεωτικό πεδίο';
    const MissingMylabWorkerFirstnameValue = 'Το Όνομα του Εργαζομένου πρέπει να έχει τιμή';
    const InvalidMylabWorkerFirstnameType = 'Το Όνομα του Εργαζομένου πρέπει να είναι αριθμητικός ή αλφαριθμητικός';
    const InvalidMylabWorkerFirstnameArray = 'Το Όνομα του Εργαζομένου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const InvalidMylabWorkerTaxNumberType = 'Το ΑΦΜ του Εργαζομένου πρέπει να είναι αριθμητικό';
    const InvalidMylabWorkerFatherNameType = 'Το Όνομα Πατρός του Εργαζομένου πρέπει να είναι αλφαριθμητικός';
    const InvalidMylabWorkerSexType = 'Το Φύλο του Εργαζομένου πρέπει να είναι αλφαριθμητική : Α (Άντρας) ή Γ (Γυναικα)';
    
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
     
    const MissingLabNameParam = 'Το Όνομα του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabNameValue = 'Το Όνομα του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabNameType = 'Το Όνομα του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabNameArray = 'Το Όνομα του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
  
    const MissingLabOperationalRatingParam = 'Η Λειτουργική Βαθμολόγηση του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabOperationalRatingValue = 'Η Λειτουργική Βαθμολόγηση του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabOperationalRatingType = 'Η Λειτουργική Βαθμολόγηση του Εργαστηρίου πρέπει να είναι αριθμητική';
    const InvalidLabOperationalRatingArray = 'Η Λειτουργική Βαθμολόγηση του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingLabTechnologicalRatingParam = 'Η Τεχνολογική Βαθμολόγηση του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabTechnologicalRatingValue = 'Η Τεχνολογική Βαθμολόγηση του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabTechnologicalRatingType = 'Η Τεχνολογική Βαθμολόγηση του Εργαστηρίου πρέπει να είναι αριθμητική';
    const InvalidLabTechnologicalRatingArray = 'Η Τεχνολογική Βαθμολόγηση του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingLabEllakParam = 'Ο χαρακτηρισμός ΕΛΛΑΚ του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabEllakValue = 'Ο χαρακτηρισμός ΕΛΛΑΚ του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabEllakType = 'Ο χαρακτηρισμός ΕΛΛΑΚ του Εργαστηρίου πρέπει να είναι της μορφής true/false';
    const InvalidLabEllakArray = 'Ο χαρακτηρισμός ΕΛΛΑΚ Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingLabSubmittedParam = 'Ο χαρακτηρισμός κατάστασης εγγραφής (δοκιμαστική/οριστική υποβολή) του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabSubmittedValue = 'Ο χαρακτηρισμός κατάστασης εγγραφής (δοκιμαστική/οριστική υποβολή) του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabSubmittedType = 'Ο χαρακτηρισμός κατάστασης εγγραφής (δοκιμαστική/οριστική υποβολή) του Εργαστηρίου πρέπει να είναι της μορφής true/false';
    const InvalidLabSubmittedArray = 'Ο χαρακτηρισμός κατάστασης εγγραφής (δοκιμαστική/οριστική υποβολή) Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';    

    const DuplicatedLabValue = 'Το Εργαστήριο υπάρχει ήδη';
    const DuplicatedLabNameValue = 'Το Όνομα του Εργαστηρίου υπάρχει ήδη';
    const DuplicateLabUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key Lab';
    const NotAllowedLabNameValue = 'Δεν επιτρέπεται η δημιουργία εργαστηρίου σε σχολικές μονάδες που είναι σε αναστολή ή καταργημένες';
    const NotAllowedEllakValue = 'Δεν επιτρέπεται ο χαρακτηρισμός ΕΛΛΑΚ σε εργαστηρίου που ΔΕΝ είναι τύπου ΣΕΠΕΥΗ ή ΕΤΠ';
    
    //extra
    const InvalidLabSpecialNameType = 'Το Ειδικό Όνομα του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabCreationDateType = 'Η Ημερομηνία Δημιουργίας του Εργαστηρίου πρέπει να είναι Ημερομηνία (dd/mm/yyyy)';
    const InvalidLabCreatedByType = 'Το Ονοματεπώνυμο του Δημιουργού της Εγγραφής του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabLastUpdatedType = 'Η Ημερομηνία Τελευταίας Ενημερωσης του Εργαστηρίου πρέπει να είναι Ημερομηνία (dd/mm/yyyy)';
    const InvalidLabUpdatedByType = 'Το Ονοματεπώνυμο του Τελευταίου που Ενημέρωσε την Εγγραφής του Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabPositioningType = 'Η Γεωγραφική/Χωροταξική Θέση του Εργαστηρίου πρέπει να είναι αλφαριθμητική';
    const InvalidLabCommentsType = 'Τα Σχόλια για το Εργαστήριο πρέπει να αλφαριθμητικά ή αλφαριθμητικά';
    const AlreadyLabSubmittedActiveValue = 'Εχει πραγματοποιηθέι ήδη οριστική υποβολή Εργαστηρίου';    
    const AlreadyLabSubmittedInitialValue = 'Εχει οριστεί ήδη ή αρχική λειτουργική κατάσταση στον πίνακα μεταβάσεων';   
    
    //delete
    const DuplicateDelLabValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο κωδικό εργαστηρίου και κωδικό εγγραφής.'; 
    const NotFoundDelLabValue = 'Δεν βρέθηκε η εγγραφή προς διαγραφή.';
    const NoDemoDelLabValue = 'Η εγγραφή δεν είναι δοκιμαστική και δεν επιτεπεται η διαγραφή της.';
    
    //references
    const ReferencesLabAquisitionSources = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabAquisitionSources.Διαγραψτε τις αντίστοιχες εγγραφές με χρήση api request DelLabAquisitionSources ';
    const ReferencesLabEquipmentTypes = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabEquipmentTypes. Διαγραψτε τις αντίστοιχες εγγραφές με χρήση api request DelLabEquipmentTypes ';
    const ReferencesLabWorkers = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabWorkers. Διαγραψτε τις αντίστοιχες εγγραφές με χρήση api request DelLabWorkers ';
    const ReferencesLabRelations = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabRelations. Διαγραψτε τις αντίστοιχες εγγραφές με χρήση api request DelLabRelations ';
    const ReferencesLabTransitions = 'Δεν είναι δυνατή η διαγραφή της εγγραφής, λόγω συσχετισμού με τον πίνακα LabTransitions. Διαγραψτε τις αντίστοιχες εγγραφές με χρήση api request DelLabTransitions ';

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
     
    const MissingLabEquipmentTypeItemsParam = 'Το Πλήθος του Εξοπλισμού του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabEquipmentTypeItemsValue = 'Το Πλήθος του Εξοπλισμού του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabEquipmentTypeItemsType = 'Το Πλήθος του Εξοπλισμού του Εργαστηρίου πρέπει να είναι αριθμητικο';
    const InvalidLabEquipmentTypeItemsArray = 'Το Πλήθος του Εξοπλισμού του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabEquipmentTypeValue = 'Ο Εξοπλισμός του Εργαστηρίου υπάρχει ήδη';
    const UsedLabEquipmentTypeByLabs = 'Ο Κωδικός του Εξοπλισμού του Εργαστηρίου χρησιμοποιείται από Σχολικά Εργαστήρια';
    const DuplicateLabEquipmentTypeUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key LabEquipmentType';
    
    //extra
    const InvalidLabEquipmentTypeItemsValidType = 'Το Πλήθος του Εξοπλισμού του Εργαστηρίου πρέπει να είναι αριθμητική τιμή μεταξύ 1-10000';
    
    //delete
    const DuplicateDelLabEquipmentTypeValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο κωδικό εργαστηρίου και κωδικό εξοπλισμού.'; 
    const NotFoundDelLabEquipmentTypeValue = 'Δεν βρέθηκε η εγγραφή προς διαγραφή.';
    
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
     
    const MissingLabAquisitionSourceYearParam = 'Το Έτος Απόκτησης της Πηγής Χρηματοδότησης του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabAquisitionSourceYearValue = 'Το Έτος Απόκτησης της Πηγής Χρηματοδότησης του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabAquisitionSourceYearType = 'Το Έτος Απόκτησης της Πηγής Χρηματοδότησης του Εργαστηρίου πρέπει να είναι αριθμητικό format="yyyy"';
    const InvalidLabAquisitionSourceYearArray = 'Το Έτος Απόκτησης της Πηγής Χρηματοδότησης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 

    const MissingLabAquisitionSourceCommentsParam = 'Τα Σχόλια για την Πηγή Χρηματοδότησης του Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabAquisitionSourceCommentsValue = 'Τα Σχόλια για την Πηγή Χρηματοδότησης του Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabAquisitionSourceCommentsType = 'Τα Σχόλια για την Πηγή Χρηματοδότησης του Εργαστηρίου πρέπει να είναι αλφαριθμητικά';
    const InvalidLabAquisitionSourceCommentsArray = 'Τα Σχόλια για την Πηγή Χρηματοδότησης του Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const DuplicatedLabAquisitionSourceValue = 'Η Πηγή Χρηματοδότησης του Εργαστηρίου του Εργαστηρίου υπάρχει ήδη';
    const UsedLabAquisitionSourceByLabs = 'Ο Κωδικός της Πηγής Χρηματοδότησης του Εργαστηρίου χρησιμοποιείται από Σχολικά Εργαστήρια';
    const DuplicateLabAquisitionSourceUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key LabAquisitionSource';
    
    //extra
    const InvalidLabAquisitionSourceYearValidType = 'Το Έτος Απόκτησης της Πηγής Χρηματοδότησης του Εργαστηρίου πρέπει να είναι μεταξύ των τιμών "1975 - τρέχων έτος" .';
   
    //delete
    const DuplicateDelLabAquisitionSourceValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο κωδικό εργαστηρίου και κωδικό εγγραφής.'; 
    const NotFoundDelLabAquisitionSourceValue = 'Δεν βρέθηκε η εγγραφή προς διαγραφή.';
    
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
    
    const DuplicatedLabTransitionValue = 'Η Αλλαγή της Κατάστασης Μετάβασης του Εργαστηρίου του Εργαστηρίου υπάρχει ήδη';
    const UsedLabTransitionByLabs = 'Οι Καταστάσεις Μετάβασης του Εργαστηρίου χρησιμοποιούνται από Σχολικά Εργαστήρια';
    const InvalidDiscontinuedStateValue = 'Η τελευταία Κατάσταση Μεταβασης του Εργαστηρίου έχει τιμή 3=ΚΑΤΑΡΓΗΜΕΝΗ και δεν δυνατή η Μετάβαση του σε άλλα Κατάσταση.';
    const InvalidSameStateValue = 'Η τελευταία Κατάσταση Μεταβασης του Εργαστηρίου έχει την ίδια τιμή και δεν δυνατή η Μετάβαση του σε άλλα Κατάσταση.';
    const NotAllowedLabTransitionDate = 'Δεν είναι δυνατή η εισαγωγή ημερομηνίας προγενέστερη από την ημερομηνία εισαγωγής της προηγούμενης μεταβασης';
    const SeriousProblemLabTransitionState = 'Ενημερωστε τον διαχειριστή!! Η Κατάσταση Μεταβασης έιναι διαφορετικη στους πίνακες Εργαστηριων Καταστάσεων Μεταβασης';

    //extra
    const InvalidLabTransitionValidType = 'Η Ημερομηνία Αλλαγής της Κατάστασης του Εργαστηρίου πρέπει να έιναι μεταξύ των τιμών "1975 - current_date"';
    const InvalidLabTransitionDemoValue = 'Το εργαστήριο δεν έχει υποβληθεί οριστικά, και είναι αδύνατη η αλλαγή μεταβάσεων';
    
    //delete
    const DuplicateDelLabTransitionValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο κωδικό εργαστηρίου και κωδικό εγγραφής.'; 
    const NotFoundDelLabTransitionValue = 'Δεν βρέθηκε η εγγραφή προς διαγραφή.';
    
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
    
    const DuplicatedLabRelationValue = 'Η Συσχέτιση του Εργαστηρίου που εξυπηρετειται υπηρεσιακά από Σχολική Μονάδα υπάρχει ήδη';
    const UsedLabRelationByLabs = 'Η Συσχέτιση του Εργαστηρίου χρησιμοποιείται από Σχολικά Εργαστήρια';
    const UsedLabRelationServerOnline = 'Είναι αδύνατη η εισαγωγή, διότι το εργαστήριο εξυπηρετείται διαδικτυακά από σχολική μονάδα.';
   
    //extra
    const ErrorInputCircuitIdParam  = 'H εισαγωγή κυκλώματος δεν επιτρέπεται στην περίπτωση που το εχει γίνει επιλογή Κωδικού Συσχετισης 2=(ΕΞΥΠΗΡΕΤΕΙ ΥΠΗΡΕΣΙΑΚΑ)';

    //delete
    const DuplicateDelLabRelationValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή με ίδιο κωδικό εργαστηρίου και κωδικό εγγραφής.'; 
    const NotFoundDelLabRelationValue = 'Δεν βρέθηκε η εγγραφή προς διαγραφή.';
    
    
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
    const DuplicateRegionEduAdminUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key RegionEduAdmin';
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
    const DuplicateEduAdminUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key EduAdmin';
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
    const DuplicateTransferAreaUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key TransferArea';
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
    const DuplicateMunicipalityUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key Municipality';
    const UsedMunicipalityBySchoolUnits = 'Ο Κωδικός Δήμου χρησιμοποιείται από Σχολικές Μονάδες';
    const UsedMunicipalityByPrefectures = 'Ο Κωδικός Δήμου χρησιμοποιείται από Περιφερειακές Ενότητες'; 
    
    //= Prefectures
    const MissingPrefectureIDParam = 'Ο Κωδικός της Περιφερειακής Ενότητας είναι υποχρεωτικό πεδίο';
    const MissingPrefectureIDValue = 'Ο Κωδικός της Περιφερειακής Ενότητας πρέπει να έχει τιμή';
    const InvalidPrefectureIDType = 'Ο Κωδικός της Περιφερειακής Ενότητας πρέπει να είναι αριθμητικός';
    const InvalidPrefectureIDArray = 'Ο Κωδικός της Περιφερειακής Ενότητας δεν μπορεί να έχει πολλαπλές τιμές';

    const MissingPrefectureParam = 'Η Περιφερειακή Ενότητα είναι υποχρεωτικό πεδίο';
    const MissingPrefectureValue = 'Η Περιφερειακή Ενότητα πρέπει να έχει τιμή';
    const InvalidPrefectureValue = 'Η Περιφερειακή Ενότητα δεν υπάρχει στο λεξικό';
    const InvalidPrefectureType = 'Η Περιφερειακή Ενότητα πρέπει να είναι αριθμητικός ή αλφαριθμητικός';
    const InvalidPrefectureArray = 'Η Περιφερειακή Ενότητα δεν μπορεί να έχει πολλαπλές τιμές';
  
    const MissingPrefectureNameParam = 'Το Όνομα της Περιφερειακής Ενότητας είναι υποχρεωτικό πεδίο';
    const MissingPrefectureNameValue = 'Το Όνομα της Περιφερειακής Ενότητας πρέπει να έχει τιμή';
    const InvalidPrefectureNameType = 'Το Όνομα της Περιφερειακής Ενότητας πρέπει να είναι αλφαριθμητικό';
    const InvalidPrefectureNameArray = 'Το Όνομα της Περιφερειακής Ενότητας δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedPrefectureValue = 'Η Περιφερειακή Ενότητα υπάρχει ήδη';
    const DuplicatePrefectureUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key Prefecture';
    const UsedPrefectureBySchoolUnits = 'Ο Κωδικός Περιφερειακής Ενότητας χρησιμοποιείται από Σχολικές Μονάδες';

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
    const DuplicateEducationLevelUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key EducationLevel';
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
    const DuplicateSchoolUnitTypeUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key SchoolUnitType';
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
    const DuplicateStateUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key State';    
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
    const DuplicateCircuitTypeUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key Worker';
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
    const DuplicateRelationTypeUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key RelationType';
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
    const DuplicateWorkerPositionUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key WorkerPosition';
    const UsedWorkerPositionBySchoolUnitWorkers = 'Ο Κωδικός της Θέσης Εργασίας χρησιμοποιείται από Εργαζόμενους Σχολικών Μοναδων';
    const UsedWorkerPositionByLabWorkers = 'Ο Κωδικός της Θέσης Εργασίας χρησιμοποιείται από Εργαζόμενους Εργαστηρίων';
    
    //= WorkerSpecializations
    const MissingWorkerSpecializationIDParam = 'Ο Κωδικός του Κλάδου Εργαζόμενου είναι υποχρεωτικό πεδίο';
    const MissingWorkerSpecializationIDValue = 'Ο Κωδικός του Κλάδου Εργαζόμενου πρέπει να έχει τιμή';
    const InvalidWorkerSpecializationIDType = 'Ο Κωδικός του Κλάδου Εργαζόμενου πρέπει να είναι αριθμητικός';
    const InvalidWorkerSpecializationIDArray = 'Ο Κωδικός του Κλάδου Εργαζόμενου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingWorkerSpecializationParam = 'Ο Κλάδος Εργαζόμενου είναι υποχρεωτικό πεδίο';
    const MissingWorkerSpecializationValue = 'Ο Κλάδος Εργαζόμενου πρέπει να έχει τιμή';
    const InvalidWorkerSpecializationValue = 'Ο Κλάδος Εργαζόμενου δεν υπάρχει στο λεξικό';
    const InvalidWorkerSpecializationType = 'Ο Κλάδος Εργαζόμενου πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidWorkerSpecializationArray = 'Ο Κλάδος Εργαζόμενου δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingWorkerSpecializationNameParam = 'Το Όνομα του Κλάδου Εργαζόμενου είναι υποχρεωτικό πεδίο';
    const MissingWorkerSpecializationNameValue = 'Το Όνομα του Κλάδου Εργαζόμενου πρέπει να έχει τιμή';
    const InvalidWorkerSpecializationNameType = 'Το Όνομα του Κλάδου Εργαζόμενου πρέπει να είναι αλφαριθμητικό';
    const InvalidWorkerSpecializationNameArray = 'Το Όνομα του Κλάδου Εργαζόμενου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedWorkerSpecializationValue = 'Ο Κλάδος Εργαζόμενου υπάρχει ήδη';
    const DuplicateWorkerSpecializationUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key WorkerSpecialization';
    const UsedWorkerSpecializationBySchoolUnitWorkers = 'Ο Κωδικός του Κλάδου Εργαζόμενου χρησιμοποιείται από Εργαζόμενους Σχολικών Μοναδων';
    const UsedWorkerSpecializationByLabWorkers = 'Ο Κωδικός του Κλάδου Εργαζόμενου χρησιμοποιείται από Εργαζόμενους Εργαστηρίων';
    
    //= Sources
    const MissingSourceIDParam = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων είναι υποχρεωτικό πεδίο';
    const MissingSourceIDValue = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων πρέπει να έχει τιμή';
    const InvalidSourceIDType = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων πρέπει να είναι αριθμητικός';
    const InvalidSourceIDArray = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων δεν μπορεί να έχει πολλαπλές τιμές';
    
    const MissingSourceParam = 'Η Πρωτογενής Πηγή Δεδομένων είναι υποχρεωτικό πεδίο';
    const MissingSourceValue = 'Η Πρωτογενής Πηγή Δεδομένων πρέπει να έχει τιμή';
    const InvalidSourceValue = 'Η Πρωτογενής Πηγή Δεδομένων δεν υπάρχει στο λεξικό';
    const InvalidSourceType = 'Η Πρωτογενής Πηγή Δεδομένων πρέπει να είναι αριθμητικό ή αλφαριθμητικό';
    const InvalidSourceArray = 'Η Πρωτογενής Πηγή Δεδομένων δεν μπορεί να έχει πολλαπλές τιμές'; 
    
    const MissingSourceNameParam = 'Το Όνομα της Πρωτογενής Πηγής Δεδομένων είναι υποχρεωτικό πεδίο';
    const MissingSourceNameValue = 'Το Όνομα της Πρωτογενής Πηγής Δεδομένων πρέπει να έχει τιμή';
    const InvalidSourceNameType = 'Το Όνομα της Πρωτογενής Πηγής Δεδομένων πρέπει να είναι αλφαριθμητικό';
    const InvalidSourceNameArray = 'Το Όνομα της Πρωτογενής Πηγής Δεδομένων δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedSourceValue = 'Η Πρωτογενής Πηγή Δεδομένων υπάρχει ήδη';
    const DuplicateSourceUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key Source';
    const UsedSourceByWorkers = 'Ο Κωδικός της Πρωτογενής Πηγής Δεδομένων χρησιμοποιείται από Εργαζόμενο';
    
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
    const DuplicateLabTypeUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key LabType';
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
    
    const MissingLabSourceInfosParam = 'Οι Πληροφοριες της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου είναι υποχρεωτικό πεδίο';
    const MissingLabSourceInfosValue = 'Οι Πληροφοριες της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου πρέπει να έχει τιμή';
    const InvalidLabSourceInfosType = 'Οι Πληροφοριες της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου πρέπει να είναι αλφαριθμητικό';
    const InvalidLabSourceInfosArray = 'Οι Πληροφοριες της Πρωτογενής Πηγής Δεδομένων Εργαστηρίου δεν μπορεί να έχει πολλαπλές τιμές';
    
    const DuplicatedLabSourceValue = 'Η Πρωτογενής Πηγή Δεδομένων Εργαστηρίου υπάρχει ήδη';
    const DuplicateLabSourceUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key LabSource';
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
    const DuplicateEquipmentCategoryUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key EquipmentCategory';
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
    const DuplicateEquipmentTypeUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key EquipmentType';
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
    const DuplicateAquisitionSourceUniqueValue = 'Ενημερώστε τον διαχειριστή! Βρέθηκε διπλοεγγραφή primary key AquisitionSource';
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