<?php
/**
 *
 * @version 1.0.3
 * @author  ΤΕΙ Αθήνας
 * @package System
 */

header("Content-Type: text/html; charset=utf-8");
require_once('classes/ExportDataTypes.php');
/**
 * Τύποι Εξαγωγής Δεδομένων
 *
 * Παρακάτω εμφανίζονται οι Τύποι Εξαγωγής Δεδομένων οι οποίοι χρεισιμοποιούνται για την Εξαγωγή Δεδομένων σε συγκεκριμένo format των αποτελεσμάτων μιας συνάρτησης.
 *
 */

class ExportDataEnumTypes extends ExportDataTypes
{

    /**
     * Ο Τύπος Εξαγωγής Δεδομένων επιστρέφει τα αποτελέσματα σε συγκεκριμένο format  σύμφωνα με το Εξαγωγής Δεδομένων που έχει οριστεί.
     * <br>Η Εξαγωγή των δεδομένων γίνεται σε json format
     */
    const JSON = "JSON";

    /**
     * Ο Τύπος Εξαγωγής Δεδομένων επιστρέφει τα αποτελέσματα σε συγκεκριμένο format  σύμφωνα με το Εξαγωγής Δεδομένων που έχει οριστεί.
     * <brΗ Εξαγωγή των δεδομένων γίνεται σε xml format
     */
    const XML = "XML";
    
    /**
     * Ο Τύπος Εξαγωγής Δεδομένων επιστρέφει τα αποτελέσματα σε συγκεκριμένο format  σύμφωνα με το Εξαγωγής Δεδομένων που έχει οριστεί.
     * <br>Η Εξαγωγή των δεδομένων γίνεται σε xlsx format
     */
    const XLSX = "XLSX";
    
    /**
     * Ο Τύπος Εξαγωγής Δεδομένων επιστρέφει τα αποτελέσματα σε συγκεκριμένο format  σύμφωνα με το Εξαγωγής Δεδομένων που έχει οριστεί.
     * <br>Η Εξαγωγή των δεδομένων γίνεται σε pdf format
     */
    const PDF = "PDF";

    /**
     * Ο Τύπος Εξαγωγής Δεδομένων επιστρέφει τα αποτελέσματα σε συγκεκριμένο format  σύμφωνα με το Εξαγωγής Δεδομένων που έχει οριστεί.
     * <b>rΗ Εξαγωγή των δεδομένων γίνεται σε csv format
     */
    const CSV = "CSV";
    
}
?>