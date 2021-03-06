<?php

/**
 *
 * @version 1.0.0
 * @author  ΤΕΙ Αθήνας
 * @package System
 */

header("Content-Type: text/html; charset=utf-8");

/** 
 * Παράμετροι Συστήματος
 * 
 * Παρακάτω εμφανίζονται όλες οι τιμές των παραμέτρων του Συστήματος
 * 
 * 
 */

class Parameters
{
    /**
    * Ο προκαθορισμένος αριθμός εγγραφών που επιστρέφονται ανά κλήση όταν δεν έχουν καθοριστεί στοιχεία σελιδοποίησης 
    */
    const DefaultPageSize = 200;
    
    /**
    * Η τιμή που πρέπει να έχει η παράμετρος σελιδοποίησης για να επιστραφούν όλες οι εγγραφές
    */
    const AllPageSize = 0;
    
    /**
    * Ο μέγιστος αριθμός εγγραφών που μπορούν να επιστραφούν ανά κλήση 
    */
    const MaxPageSize = 500;
  
    /**
    * Ο μέγιστος αριθμός εγγραφών που μπορούν να επιστραφούν ανά κλήση για export format excell/csv
    */
    const ExportPageSize = 0;
    
    /**
    *Ο προκαθορισμένος αριθμός σελιδοποίησης ανά κλήση 
    */
    const DefaultPage = 1;
   
}    

?>