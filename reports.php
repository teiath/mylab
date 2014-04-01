<?php
    header("Content-Type: text/html; charset=utf-8");
    //include "/api/system/config.php";
    require_once('api/system/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title class="navbarTitle">myLab</title>

    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/kendo.common-bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/kendo.bootstrap.min.css" >    
    
    
    <!--kendo css files-->
    <link rel="stylesheet" href="client/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="client/styles/kendo.default.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/kendo.common-bootstrap.min.css" >      <!--new one--> 
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/kendo.bootstrap.min.css" >             <!--new one--> 
    
    <!--bootstrap css files-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="client/styles/bootstrap.css" >  modified by me -->
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/bootstrap.icon-large.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/bootstrap-responsive.min.css" >
    
    <!--font-awesome-4.0.3-->
    <link rel="stylesheet" type="text/css" media="screen" href="client/font-awesome-4.0.3/css/font-awesome.min.css" >
    
    <!--custom css files-->
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/myLabStyles.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/searchForm.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/infoPane.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/labEquipmentTabstrip.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/schoolUnitsGridDetailRow.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/labsGridDetailRow.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/labCreationForm.css">
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/alerts.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/reportsForm.css" >
    
    
    <!--jquery js files-->
    <script src="client/js/jquery.min.js"></script>
    <script src="client/js/jquery-ui-1.10.3.custom.min.js"></script>
    <!--bootstrap js files-->
    <script src="client/js/bootstrap.min.js"></script>
    <!--kendo js files-->
    <script src="client/src/js/kendo.web.js"></script>
    <!--custom js files-->
    <script type="text/javascript" src="client/myJs/jquery.scrollTo-1.4.3.1-min.js"></script>
    <script type="text/javascript" src="client/myJs/DataSources.js"></script>
    <script type="text/javascript" src="client/myJs/snippets.js"></script>
    
    <script type="text/javascript" src="client/myJs/raty-2.5.2/lib/jquery.raty.min.js"></script>
    <script type="text/javascript" src="jquery.bootstrap.wizard.js"></script>
    
    <script>        
        $(document).ready(function() { //Specify a function to execute when the DOM is fully loaded.

            $("#navbar-reports-button").closest("li").addClass("active");

            $("#navbar-home-button").click( function() {
                window.location = "index.php";
            });

            $("#navbar-statistics-button").click( function() {
                window.location = "statistics.php";
            });

            $("#navbar-reports-button").click( function() {
                window.location = "reports.php";
            });

            $("#navbar-search-button").hide();

            //depending on the .scrollTop() value fade in or out the scroll-to-top img
            $(window).scroll(function(){
                if ($(this).scrollTop() > 100) {
                    $('.scrollup').fadeIn();
                } else {
                    $('.scrollup').fadeOut();
                }
            });

            // scroll to top
            $('.scrollup').click(function(){
                $("html, body").animate({ scrollTop: 0 }, 600);
                return false;
            });

            //statistics wizard
            $('#rootwizard').bootstrapWizard();

           reporting_element = $("#reporting_element").kendoComboBox({
               dataTextField: "name",
               dataValueField: "name",
               dataSource: reportingElementDS
           });
           

        });
    </script>
     
</head>

<body>

    <?php include "navigation-bar.php" ?>
       
    <!--REPORTS WIZARD-->
    <div id="reports-pane">
        <div id="rootwizard">
            <ul>
                <li><a href="#tab1" data-toggle="tab">Βήμα 1</a></li>
                <li><a href="#tab2" data-toggle="tab">Βήμα 2</a></li>
                <li><a href="#tab3" data-toggle="tab">Βήμα 3</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                    <div id="tab1_content">
                        <h4 class="reports_wizard_headers">Επιλογή στοιχείου αναφοράς</h4>
                        <div class="reports_wizard_instructions">
                            <span><i class="fa fa-lightbulb-o fa-2x"></i></span>
                            <span class="reports_wizard_instructions_text"> Επιλέξτε το στοιχείο για το οποιο θέλετε να παράγετε την αναφορά. </span>
                        </div>
                        <div class="reports_wizard_selections">
                            <label class="statistics_wizard_labels" for="variable">στοιχείο</label>
                            <select name="reporting_element" id="reporting_element"></select>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2">
                    <div id="tab2_content">
                        <h4 class="reports_wizard_headers">Επιλογή Φίλτρων</h4>
                        <div class="reports_wizard_instructions">
                            <span><i class="fa fa-lightbulb-o fa-2x"></i></span>
                            <span class="reports_wizard_instructions_text">Φιλτράρετε τα αποτελέσματα της αναφοράς επιλέγοντας ένα ή περισσότερα από τα παρακάτω κριτήρια.</span>
                        </div>
                        <div class="reports_wizard_selections">
                            <?php include "statistics-filter.php" ?>
                        </div>
                    </div>                    
                </div>
                <div class="tab-pane" id="tab3">
                    <div id="tab3_content">
                        <h4 class="reports_wizard_headers">Αναφορά</h4>
                        <div class="reports_wizard_instructions">
                            <span><i class="fa fa-lightbulb-o fa-2x"></i></span>
                            <span class="reports_wizard_instructions_text">Πατήστε "Προηγούμενο" για να μεταβάλετε τις επιλογές σας και να εξάγετε εκ νέου αναφορά.</span>
                        </div>
                    </div>                   
                </div>
                <ul class="pager wizard">
                    <li class="previous first" style="display:none;"><a href="#">First</a></li>
                    <li class="previous"><a href="#">Previous</a></li>
                    <li class="next last" style="display:none;"><a href="#">Last</a></li>
                    <li class="next"><a href="#">Next</a></li>
                </ul>
            </div>	
        </div>
    </div>
    
    <a href="#" class="scrollup">Scroll</a>
    
    <footer>
      <img src="client/img/footer.png">
    </footer>
    
</body>
</html>