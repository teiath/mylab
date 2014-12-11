<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
<!--        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />-->

        <link rel="shortcut icon" href="" />

        <title>MyLab</title>
        
        <?php
            require_once('includes.html');
        ?>

        <style>
/*            .sch_logo_text {
                color: #1d73a3;
                float: left;
                font-size: 19px;
                line-height: 0.9;
                margin: 21px 0 0;
                font-weight:bold;
            }

            .sch_logo_text2 {
                color: #73a41d;
                font-size: 12px;
                fonr-weight:bold;
                 font-weight:bold;
            }

            .vcenter {
                display: inline-block;
                vertical-align: middle;
                float: none;
            }*/
            
            .btn-sso{
                color:#5E5E5E;
                padding:10px;
                font-size:14px;
                border-radius:3px;
            }
            
/*            .btn-default:hover, .btn-default:focus, .btn-default:active, .open, .dropdown-toggle.btn-default{
               background-color: #445E3E;
               border-color: #445E3E;
               color: #FFFFFF;
            }
            
            .btn-default{
               background-color: #699360;
               border-color: #699360;
               color: #FFFFFF;
            }*/
            
        </style>

    </head>

    <body>

        <div class="container">

            <!--<div style="clear: both;" >&nbsp;</div>-->

<!--            <div class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="pull-left"><img src="client/pages/icons/sch_logo.png" />&nbsp;&nbsp;&nbsp;</p>			
                            <p class="pull-left" style="padding-top:5px;"><strong><a href="http://www.sch.gr" style="color: #1d73a3;font: bold 20px Tahoma,sans-serif;">Πανελλήνιο Σχολικό Δίκτυο</a></strong><br>
                                <span class="sch_logo_text2">Το Δίκτυο στην Υπηρεσία της Εκπαίδευσης</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>-->

            <div class="jumbotron" style="background-color:#fcfcfc; color:#5E5E5E;">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="row">
                                <div class="col-md-12"><p style="text-align:center; margin:0px;"><img src="client/pages/icons/logo-light@2x.png"/></p></div>
                                <div class="col-md-12"><h3 style="text-align:center; color:#5E5E5E;">Υπηρεσία MyLab</h3></div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size:16px;line-height:150%; margin:20px 0px;">
                                        Στόχος της Υπηρεσίας MyLab του ΠΣΔ, είναι η ανάδειξη της οντότητας του Εργαστηρίου μέσα από 
                                    </p>
                                    
                                    <ul style="list-style-type: none; font-size:16px; font-weight:lighter;">
                                        <li><i class="fa fa-check-square-o"></i> την ψηφιακή αποτύπωση των τυπικών Εργαστηρίων Πληροφορικής ΣΕΠΕΗΥ, των Εργαστηρίων Τομέα Πληροφορικής των ΕΚ καθώς και άλλων ομαδοποιημένων Διατάξεων Η/Υ όπως Τροχήλατων Εργαστηρίων, Γωνιών Η/Υ, Διαδραστικών Συστημάτων, εφεξής Διατάξεις Η/Υ, που ανήκουν στις Δημόσιες Σχολικές Μονάδες Πρωτοβάθμιας και Δευτεροβάθμιας Εκπαίδευσης</li>
                                        <li><i class="fa fa-check-square-o"></i> την αποκεντρικοποιημένη επικαιροποίηση των στοιχείων των Διατάξεων Η/Υ</li>
                                        <li><i class="fa fa-check-square-o"></i> τη στρατηγική αξιοποίηση της παρεχόμενης πληροφορίας από τις αρμόδιες Υπηρεσίες του ΥΠΑΙΘ</li>
                                        <li><i class="fa fa-check-square-o"></i> τη βελτίωση των παρεχόμενων υπηρεσιών όλων των υποστηρικτικών δομών</li>
                                    </ul>
                                    
                                    <p style="font-size:13px;margin:30px 0px;">
                                        <i class="fa fa-exclamation-triangle"></i> 
                                        Σημειώνεται ότι ΔΕΝ αποτελεί στόχο του ΠΣ myLab η λεπτομερής αποτύπωση του εξοπλισμού της Διάταξης Η/Υ, 
                                        η οποία αποτελεί στόχο του ΠΣ Κτηματολογίου του ΠΣΔ. Η πληροφορία που αφορά τον εξοπλισμό στο ΠΣ myLab είναι 
                                        συνοπτική και στοχεύει αποκλειστικά στην αντίληψη του μεγέθους (διαστασιοποίηση) της Διάταξης Η/Υ.
                                    </p>
                                </div>				
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="text-align:center; padding:20px; margin-bottom:20px;">
                                        <a type="button" class="btn btn-lg btn-default btn-sso" href="toHome.php"> 
                                            <span> 
                                                Σύνδεση SSO <i class="fa fa-sign-in" style="margin: 0px 10px 0px 30px;"></i> 
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="text-align:center; margin-top:20px;">
                                        Υποστηρίξη: <strong>ΤΕΙ Αθήνας</strong> | Επικοινωνία: <strong>mm@sch.gr</strong>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>

            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <img class="img-responsive" src="client/pages/icons/mainlogo_p8.png" style="display:block;margin-left:auto;margin-right:auto;"/>
                        </div>
                        <div class="col-md-2">
                            <img class="img-responsive" src="client/pages/icons/Logo ΕΠΕΕΔΒΜ-2013-BW.png" style="display:block;margin-left:auto;margin-right:auto;"/>
                        </div>
                        <div class="col-md-2">
                            <img class="img-responsive" src="client/pages/icons/stirizo.png"  style="display:block;margin-left:auto;margin-right:auto;"/>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>

        </div>

    </body>

</html>