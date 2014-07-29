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
    
//page,pagesize,searchtype,ordertype,orderby MESSAGES===========================

//Page
    
//PageSize
    
//SeachType
    
//OrderType
    
//OrderBy
    

    
    
//FILTER MESSAGES===============================================================    

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
    
    
    
}

?>