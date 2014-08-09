<?php

header("Content-Type: text/html; charset=utf-8");

/** 
 * <b>Αναφορά : Ετήσια Αναφορά ΚΕΠΛΗΝΕΤ</b>
 * 
 * 
 *
 * Η συνάρτηση αυτή επιστρέφει μια αναφορά για τα ΚΕΠΛΗΝΕΤ σύμφωνα με τις παραμέτρους που έγινε η κλήση
 *
 *
 * Η κλήση μπορεί να γίνει μέσω της παρακάτω διεύθυνσης με τη μέθοδο GET :
 * <br> http://mmsch.teiath.gr/mylab/api/report_keplhnet
 *
 *
 * <br><b>Πίνακας Σφαλμάτων</b>
 * <br>Στον Πίνακα Σφαλμάτων <a href="#throws">Thrown exceptions summary</a> εμφανίζονται τα Μηνύματα Σφαλμάτων που
 * μπορεί να προκύψουν κατά την κλήση της συνάρτησης
 * <br>Οι περιγραφές των Σφαλμάτων καθώς και οι Κωδικοί τους είναι διαθέσιμες μέσω του πίνακα
 * Μηνύματα Σφαλμάτων ({@see ExceptionMessages}) και Κωδικοί Σφαλμάτων ({@see ExceptionCodes}) αντίστοιχα
 *
 *
 * <br><b>Παραδείγματα Κλήσης</b>
 * <br>Παρακάτω εμφανίζεται μια σειρά από παραδείγματα κλήσης της συνάρτησης με διάφορους τρόπους :
 * <br><a href="#cURL">cURL</a> | <a href="#JavaScript">JavaScript</a> | <a href="#PHP">PHP</a> | <a href="#Ajax">Ajax</a>
 *
 * <br>
 *
 * <a id="cURL"></a>Παράδειγμα κλήσης της συνάρτησης με <b>cURL</b> (console) :
 * <code>
 *    curl -X GET http://mmsch.teiath.gr/api/report_keplhnet \
 *       -H "Content-Type: application/json" \
 *       -H "Accept: application/json" \
 *       -u username:password \
 *       -d '{"edu_admin_code":"kar"}'
 *       > report.pdf
 * </code>
 * <br>
 * 
 * 
 * 
 * <a id="JavaScript"></a>Παράδειγμα κλήσης της συνάρτησης με <b>JavaScript</b> :
 * <code>
 * <script>
 *    var params = JSON.stringify({
 *        "edu_admin_code" : "kar"
 *    });
 *
 *    var http = new XMLHttpRequest();
 *    http.open("GET", "http://mmsch.teiath.gr/mylab/api/report_keplhnet");
 *    http.setRequestHeader("Accept", "application/json");
 *    http.setRequestHeader("Content-type", "application/json; charset=utf-8");
 *    http.setRequestHeader("Content-length", params.length);
 *    http.setRequestHeader("Authorization", "Basic " + btoa('username' + ':' + 'password') );
 *
 *    http.onreadystatechange = function()
 *    {
 *        if(http.readyState == 4 && http.status == 200)
 *        {
 *            var result = JSON.parse(http.responseText);
 *            document.write(result.status + " : " + result.message + " : " + result.data);
 *        }
 *    }
 *
 *    http.send(params);
 * </script>
 * </code>
 * <br>
 *
 *
 *
 * <a id="PHP"></a>Παράδειγμα κλήσης της συνάρτησης με <b>PHP</b> :
 * <code>
 * <?php
 *    header("Content-Type: text/html; charset=utf-8");
 *
 *    $params = array(
 *       "edu_admin_code" => "kar"
 *    );
 *
 *    $curl = curl_init("http://mmsch.teiath.gr/mylab/api/report_keplhnet");
 *
 *    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 *    curl_setopt($curl, CURLOPT_USERPWD, "username:password");
 *    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
 *    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $params ));
 *    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 *
 *    $data = curl_exec($curl);
 *    $data = json_decode($data);
 *    echo "<pre>"; var_dump( $data ); echo "</pre>";
 * ?>
 * </code>
 * <br>
 *
 *
 *
 * <a id="Ajax"></a>Παράδειγμα κλήσης της συνάρτησης με <b>Ajax</b> :
 * <code>
 * <script>
 *    $.ajax({
 *        type: 'GET',
 *        url: 'http://mmsch.teiath.gr/mylab/api/report_keplhnet',
 *        dataType: "json",
 *        data: {
 *          "edu_admin_code" : "kar"
 *        },
 *        beforeSend: function(req) {
 *            req.setRequestHeader('Authorization', btoa('username' + ":" + 'password'));
 *        },
 *        success: function(data){
 *            console.log(data);
 *        }
 *    });
 * </script>
 * </code>
 * <br>
 *
 * 
 * @param string $edu_admin_code Κωδικός DNS Διεύθυνσης Εκπαίδευσης
 * <br>Ο Κωδικός DNS Διεύθυνσης Εκπαίδευσης που αντιστοιχεί στο ΚΕΠΛΗΝΕΤ της ιδιας της Διεύθυνσης
 * <br>H αντιστοιχία είναι 2 Διευθύνσεις Εκπαίδευσης(Πρωτοβάθμια και Δευτεροβάθμια) προς ένα ΚΕΠΛΗΝΕΤ  
 * <br>με τα στοιχεία του Κεπληνετ να ανήκουν στην Διεύθυνση Δευτεροβάθμιας Εκπαίδευσης
 * <br>π.χ. edu_admin_code = kar αντιστοιχεί στην Διεύθυνση Π.Ε. Καρδίτσας και Διεύθυνση Δ.Ε. Καρδίτσας με αντίστοιχία το ΚΕΠΛΗΝΕΤ Καρδίτσας   
 * <br>Λεξικό : Διευθύνσεις Εκπαίδευσης {@see GetEduAdmins})
 * <br>Η τιμή της παραμέτρου μπορεί να είναι : string}
 *    <ul>
 *       <li>string : Αλφαριθμητική (Η αναζήτηση γίνεται με το όνομα)</li>
 *    </ul>
 *
 * @return <PDF> Επιστρέφει ένα προκαθορισμένο pdf αρχείο με αποτελέσματα από ένα συγκεκριμένο ΚΕΠΛΗΝΕΤ 
 * και αφορά γενικές πληροφορίες,σχολικές μονάδες,εργαστήρια της αρμοδιότητας του.
 * <br> Σημείωση 
 * Εργαστήρια με άριστη/πολύ ικανοποιητική λειτουργία χαρακτηρίζονται τα εργαστήρια που εχουνε operational_rating = 4,5
 * Εργαστήρια με καλή/ικανοποιητική λειτουργία χαρακτηρίζονται τα εργαστήρια που εχουνε operational_rating = 3
 * Εργαστήρια που χρήζουν ανανένωσης χαρακτηρίζονται τα εργαστήρια που εχουνε technological_rating = 1,2
 * 
 * 
 *
 * @throws MissingEduAdminCodeParam {@see ExceptionMessages::MissingEduAdminCodeParam}
 * <br>{@see ExceptionCodes::MissingEduAdminCodeParam}
 * <br>Ο Κωδικός της Διεύθυνσης Εκπαίδευσης είναι υποχρεωτικό πεδίο
 * 
 * @throws MissingEduAdminCodeValue {@see ExceptionMessages::MissingEduAdminCodeValue}
 * <br>{@see ExceptionCodes::MissingEduAdminCodeValue}
 * <br>Ο Κωδικός της Διεύθυνσης Εκπαίδευσης πρέπει να έχει τιμή
 * 
 * @throws InvalidEduAdminCodeArray {@see ExceptionMessages::InvalidEduAdminCodeArray}
 * <br>{@see ExceptionCodes::InvalidEduAdminCodeArray}
 * <br>Ο Κωδικός της Διεύθυνσης Εκπαίδευσης δεν μπορεί να έχει πολλαπλές τιμές
 * 
 * @throws UnknowneEduAdminCodeValue {@see ExceptionMessages::UnknowneEduAdminCodeValue}
 * <br>{@see ExceptionCodes::UnknowneEduAdminCodeValue}
 * <br>Αγνωστη τιμή edu_admin_code
 *
 * @throws ErrorEduAdminReportKeplhnet {@see ExceptionMessages::ErrorEduAdminReportKeplhnet}
 * <br>{@see ExceptionCodes::ErrorEduAdminReportKeplhnet}
 * <br>Κάθε ΚΕΠΛΗΝΕΤ αντιστοιχίζεται υποχρεωτικά με μια Διεύθυνση Δ.Ε. και μια Διεύθυνση Δ.Ε. ίδιας πόλης.
 *
 *
 */


function ReportKeplhnet ($edu_admin_code ) {
    
global $app;

$result = array();

$controller = $app->environment();
$controller = substr($controller["PATH_INFO"], 1);

$result["data"] = array();
$result["controller"] = __FUNCTION__;
$result["function"] = $controller;
$result["method"] = $app->request()->getMethod();
    
    try{

        $stringDate = date('dmYHis');
        $filename = "KeplhnetReport".$stringDate.".pdf";

        // create new PDF document
        //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, UNICODE, ENCODING, DISKCACHE, PDF/A);
        $pdf = new TCPDF( 'P', 'mm', 'A4', true, 'UTF-8', false); 

        // set document information
        $pdf->SetCreator("Administrator MyLab");
        $pdf->SetAuthor("ΤΕΙ ΑΘήνας");
        $pdf->SetTitle( "Αναφορά ΚΕΠΛΗΝΕΤ : ".$stringDate);
        $pdf->SetSubject("Φόρμα");

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        //$pdf->SetHeaderData( $_SERVER["DOCUMENT_ROOT"]. "mylab/server/reports/images/tei.png", "20","test");
        //$pdf->ShowPageNumbers = false;   

        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
        //$pdf->SetFooterData( "asdasd" );

        // set header and footer fonts
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->setHeaderFont( Array('freesans', '', 9) );
        $pdf->setFooterFont( Array('freesans', '', 9) );

        // set default monospaced font
        //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetDefaultMonospacedFont('freesans');

        //set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        //set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 25);

        //set image scale factor
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setImageScale('courier'); 

        //set some language-dependent strings
        //if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        //    require_once(dirname(__FILE__).'/lang/eng.php');
        //    $pdf->setLanguageArray($l);
        //}
        $pdf->setLanguageArray($l); 

        $pdf->setFontSubsetting(false);

        //------------------------------------------------------------------------------

        //$pdf->MultiCell(
        //* @param $w (float) Width of cells. If 0, they extend up to the right margin of the page.
        //* @param $h (float) Cell minimum height. The cell extends automatically if needed.
        //* @param $txt (string) String to print
        //* @param $border (mixed) Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
        //* @param $align (string) Allows to center or align the text. Possible values are:<ul><li>L or empty string: left align</li><li>C: center</li><li>R: right align</li><li>J: justification (default value when $ishtml=false)</li></ul>
        //* @param $fill (boolean) Indicates if the cell background must be painted (true) or transparent (false).
        //* @param $ln (int) Indicates where the current position should go after the call. Possible values are:<ul><li>0: to the right</li><li>1: to the beginning of the next line [DEFAULT]</li><li>2: below</li></ul>
        //* @param $x (float) x position in user units
        //* @param $y (float) y position in user units
        //* @param $reseth (boolean) if true reset the last cell height (default true).
        //* @param $stretch (int) font stretch mode: <ul><li>0 = disabled</li><li>1 = horizontal scaling only if text is larger than cell width</li><li>2 = forced horizontal scaling to fit cell width</li><li>3 = character spacing only if text is larger than cell width</li><li>4 = forced character spacing to fit cell width</li></ul> General font stretching and scaling values will be preserved when possible.
        //* @param $ishtml (boolean) INTERNAL USE ONLY -- set to true if $txt is HTML content (default = false). Never set this parameter to true, use instead writeHTMLCell() or writeHTML() methods.
        //* @param $autopadding (boolean) if true, uses internal padding and automatically adjust it to account for line width.
        //* @param $maxh (float) maximum height. It should be >= $h and less then remaining space to the bottom of the page, or 0 for disable this feature. This feature works only when $ishtml=false.
        //* @param $valign (string) Vertical alignment of text (requires $maxh = $h > 0). Possible values are:<ul><li>T: TOP</li><li>M: middle</li><li>B: bottom</li></ul>. This feature works only when $ishtml=false and the cell must fit in a single page.
        //* @param $fitcell (boolean) if true attempt to fit all the text within the cell by reducing the font size (do not work in HTML mode). $maxh must be greater than 0 and wqual to $h.
        //);

        // set font
        $pdf->SetFont('freesans', '', 8);

        // add a page
        $pdf->AddPage();


        // set color for background
        $pdf->SetFillColor(255, 255, 255);

        //check edu_admin_code         
        if (Validator::isMissing('edu_admin_code'))
            throw new Exception(ExceptionMessages::MissingEduAdminCodeParam." : ".$edu_admin_code, ExceptionCodes::MissingEduAdminCodeParam);
        else if (Validator::IsNull($edu_admin_code) )
            throw new Exception(ExceptionMessages::MissingEduAdminCodeValue." : ".$edu_admin_code, ExceptionCodes::MissingEduAdminCodeValue); 
        else if (validator::IsArray($edu_admin_code))
            throw new Exception(ExceptionMessages::InvalidEduAdminCodeArray." : ".$edu_admin_code, ExceptionCodes::InvalidEduAdminCodeArray);           
        else if (Validator::IsValue($edu_admin_code)) {
        
            $edu_admins  = Reports::getKeplhnetfromEduAdminCode(Validator::ToValue($edu_admin_code));
            if ( ($edu_admins->counter != 2) || (!Validator::IsNumeric($edu_admins->secondary)) || (!Validator::IsNumeric($edu_admins->primary)) ) {
                throw new Exception(ExceptionMessages::ErrorEduAdminReportKeplhnet, ExceptionCodes::ErrorEduAdminReportKeplhnet);
            }
        
        } else {
            throw new Exception(ExceptionMessages::UnknowneEduAdminCodeValue." : ".$edu_admin_code, ExceptionCodes::UnknowneEduAdminCodeValue); 
        }

        //get infos about keplhnet. Value of edu_admin must be secondary only
        $params = array("state"=>1, "unit_type" => 24, "edu_admin"=>$edu_admins->secondary);
        $info_keplhnet = Reports::getKeplhnetInfo($params);

        $name = $info_keplhnet['data'][0]['name'];
        $street_address = $info_keplhnet['data'][0]['street_address'];
        $fax_number = $info_keplhnet['data'][0]['fax_number'];
        $phone_number = $info_keplhnet['data'][0]['phone_number'];
        $email = $info_keplhnet['data'][0]['email'];
        $website = NULL; //TODO
        
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
        $column_width = '90';

        $pdf->MultiCell(180, 6, "Στοιχεία του ΚΕ.ΠΛΗ.ΝΕ.Τ." , 0, 'C', 0, 1, '', '', true, 0);
        $pdf->Ln(1);
        $pdf->MultiCell($column_width, 6, "ΚΕΠΛΗΝΕΤ" , 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $name , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Στελέχωση" , 0, 'L', 0, 1, '', '', true, 0);


        foreach ($info_keplhnet['data'][0]['workers'] as $worker)
        {
            if ($worker['worker_position_id'] == 4){
                $pdf->MultiCell($column_width, 6, "Υπεύθυνος [Ονοματεπώνυμο]", 1, 'L', 0, 0, '', '', true, 0);
                $pdf->MultiCell($column_width, 6, $worker['firstname'].' '.$worker['lastname'] , 1, 'L', 0, 1, '', '', true, 0);
                $pdf->MultiCell($column_width, 6, "Υπέυθυνος [Ειδικότητα]", 1, 'L', 0, 0, '', '', true, 0);
                $pdf->MultiCell($column_width, 6, $worker['worker_position'] , 1, 'L', 0, 1, '', '', true, 0);
            } else if ($worker['worker_position_id'] == 5) {
                $pdf->MultiCell($column_width, 6, "Τεχνικός Υπεύθυνος [Ονοματεπώνυμο]", 1, 'L', 0, 0, '', '', true, 0);
                $pdf->MultiCell($column_width, 6, $worker['firstname'].' '.$worker['lastname'] , 1, 'L', 0, 1, '', '', true, 0);
                $pdf->MultiCell($column_width, 6, "Τεχνικός Υπεύθυνος [Ειδικότητα]", 1, 'L', 0, 0, '', '', true, 0);
                $pdf->MultiCell($column_width, 6, $worker['worker_position'] , 1, 'L', 0, 1, '', '', true, 0);
            }

        }

        $pdf->Ln(4);

        // set color for background
        $pdf->SetFillColor(220, 255, 220);

        $pdf->MultiCell(180, 6, "Στοιχεία λειτουργίας και επικοινωνίας" , 0, 'C', 0, 1, '', '', true, 0);
        $pdf->Ln(1);
        $pdf->MultiCell($column_width, 6, "Δ/νση Λειτουργίας" , 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $street_address , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Τηλέφωνο", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $phone_number, 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Fax", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $fax_number , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Ηλεκτρονική Δ/νση (email)", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $email , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Ιστοσελίδα", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $website , 1, 'L', 0, 1, '', '', true, 0);

        $pdf->Ln(4);

        // set color for background
        $pdf->SetFillColor(220, 255, 220);

         $keplhnet = array("edu_admin" => $edu_admins->secondary.','.$edu_admins->primary);

        $sum_kindergarten = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "school_unit_type"=>"1") );
        $sum_primary_school =  Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" ,"school_unit_type"=>"2") );
        $sum_secondary_education_units = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "education_level"=>"2") );
        
        $sum_primary_education_labs = Reports::Statistics('statistic_labs', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"1") );
        $sum_secondary_education_labs = Reports::Statistics('statistic_labs', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"2") );
        
        $sum_primary_education_troxilata = Reports::Statistics('statistic_labs', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"1" , "lab_type" => "2" ) );
        $sum_secondary_education_troxilata = Reports::Statistics('statistic_labs', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"2" , "lab_type" => "2") );
        
        $sum_primary_education_ellak_labs = Reports::Statistics('statistic_labs', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"1" , "equipment_type" => "48" ) );;
        $sum_secondary_education_ellak_labs = Reports::Statistics('statistic_labs', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"2" , "equipment_type" => "48" ) );;
        
        $sum_primary_education_excellent_operational_labs = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"1" , "operational_rating" => "4,5" ) );
        $sum_secondary_education_excellent_operational_labs = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"2" , "operational_rating" => "4,5") );

        $sum_primary_education_good_operational_labs = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"1" , "operational_rating" => "3" ) );
        $sum_secondary_educatio_good_operational_labs = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"2" , "operational_rating" => "3") );
        
        $sum_primary_education_poor_technological_labs = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"1" , "technological_rating" => "1,2" ) );
        $sum_secondary_education_poor_technological_labs = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "lab_state"=>"1" , "education_level"=>"2" , "technological_rating" => "1,2") );
   
        $sum_primary_education_null_labs = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "education_level"=>"1" , "lab_id" => "null" ) );
        $sum_secondary_education_null_labs = Reports::Statistics('statistic_school_units', $keplhnet, array("school_unit_state"=>"1" , "education_level"=>"2" , "lab_id" => "null") );

        //TODO
        $infos = NULL;
     
        $pdf->MultiCell(180, 6, "Εργαστήρια Πληροφορικής" , 0, 'C', 0, 1, '', '', true, 0);
        $pdf->MultiCell(180, 6, "Συνοπτικός πίνακας για τα εργαστήρια Πληροφορικής στα σχολεία αρμοδιότητας σας" , 0, 'L', 0, 1, '', '', true, 0);
        $pdf->Ln(1);
        $pdf->MultiCell($column_width, 6, "Πλήθος Σχολέιων [Ά/θμια]" , 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_kindergarten . " Δημοτικα - " . $sum_primary_school . " Γυμνασια " , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Πλήθος Σχολέιων [Β/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_secondary_education_units , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Πλήθος Εργαστηρίων [Ά/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_primary_education_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Πλήθος Εργαστηρίων [Β/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_secondary_education_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Φορητά Εργαστήρια [Ά/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_primary_education_troxilata , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Φορητά Εργαστήρια [Β/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_secondary_education_troxilata , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 10, "Εργαστήρια με πεπαλαιωμένο εξοπλισμό που έχουν αναβαθμιστεί και επαναλειτουργήσει με χρήση ΕΛ/ΛΑΚ [Ά/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 10, $sum_primary_education_ellak_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 10, "Εργαστήρια με πεπαλαιωμένο εξοπλισμό που έχουν αναβαθμιστεί και επαναλειτουργήσει με χρήση ΕΛ/ΛΑΚ [Β/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 10, $sum_secondary_education_ellak_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Εργαστήρια με άριστη/πολύ ικανοποιητική λειτουργία [Ά/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_primary_education_excellent_operational_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Εργαστήρια με άριστη/πολύ ικανοποιητική λειτουργία [Β/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_secondary_education_excellent_operational_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Εργαστήρια με καλή/ικανοποιητική λειτουργία [Ά/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_primary_education_good_operational_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Εργαστήρια με καλή/ικανοποιητική λειτουργία [Β/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_secondary_educatio_good_operational_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Εργαστήρια που χρήζουν ανανένωσης [Ά/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_primary_education_poor_technological_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Εργαστήρια που χρήζουν ανανένωσης [Β/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_secondary_education_poor_technological_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Σχολεία που δεν έχουν εργαστήριο [Ά/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_primary_education_null_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, "Σχολεία που δεν έχουν εργαστήριο [Β/θμια]", 1, 'L', 0, 0, '', '', true, 0);
        $pdf->MultiCell($column_width, 6, $sum_secondary_education_null_labs , 1, 'L', 0, 1, '', '', true, 0);
        $pdf->MultiCell($column_width, 20, "Παρατηρήσεις", 1, 'L', 0, 0, '', '', true, 0, false, true, 20, 'M');
        $pdf->MultiCell($column_width, 20, $infos , 1, 'L', 0, 1, '', '', true, 0, false, true, 20, 'M');

        // move pointer to last page
        $pdf->lastPage();

        //Close and output PDF document
        $pdf->Output( "Ticket_".$filename.".pdf", 'I');
        exit();

    } catch (Exception $e) {

        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();

    }
    return $result;
}
?>