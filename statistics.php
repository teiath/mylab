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
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/statisticsForm.css" >
    
    
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
        
        var axis_x_value="", axis_y_value="", axis_z_value="";
        var axisXcombobox, axisYcombobox, axisZcombobox;
        
        //var statistic;
        $(document).ready(function() { //Specify a function to execute when the DOM is fully loaded.

            $("#navbar-statistics-button").closest("li").addClass("active");

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

           variable = $("#variable").kendoComboBox({
               dataTextField: "name",
               dataValueField: "name",
               dataSource: statisticVariableDS
           });

           $("#axisX").kendoComboBox({
               dataSource: axisXDS,
               dataTextField: "name",
               dataValueField: "name",
               filter: "contains",
               change: function(e) {
                    
                   axis_x_value = this.value();

                   console.log("axis x value:", axis_x_value);
                   console.log("axis y value:", axisYcombobox.value());
                   console.log("axis z value:", axisZcombobox.value());

                   //καθάρισε το attr "used" των axisYDS και axisZDS
                   $.each( axisXDS.data(), function( index, selectedValue ){
                        var item = selectedValue.name;
                        
                        if(item === axis_x_value){
                            console.log("1ο if");
                            axisYDS.get(item).used = true;
                        }else if(item === axisYcombobox.value()){
                            console.log("2ο if");
                            axisYDS.get(item).used = true;
                        }else{
                            axisYDS.get(item).used = false;
                        }

                        if(item === axis_x_value){
                            console.log("1ο if");
                            axisZDS.get(item).used = true;
                        }else if(item === axisZcombobox.value()){
                            console.log("2ο if");
                            axisZDS.get(item).used = true;
                        }else{
                            axisZDS.get(item).used = false;
                        }

                   });
                   
                    console.log("--------------------AXIS Y--------------------");
                    $.each(axisYDS.data(), function( index, selectedValue ){
                        console.log(selectedValue.name + ": " + selectedValue.used);
                    });
                    axisYcombobox.setDataSource(axisYDS);
                    axisYcombobox.refresh();
                    
                    console.log("--------------------AXIS Z--------------------");
                    $.each(axisZDS.data(), function( index, selectedValue ){
                        console.log(selectedValue.name + ": " + selectedValue.used);
                    });
                    axisZcombobox.setDataSource(axisZDS);
                    axisZcombobox.refresh();
               }
           });
           axisXcombobox = $("#axisX").data("kendoComboBox");

           $("#axisY").kendoComboBox({
               dataSource: axisYDS,
               dataTextField: "name",
               dataValueField: "name",
               filter: "contains",
               change: function(e) {
    
                   axis_y_value = this.value();
                   
                   console.log("axis x value:", axisXcombobox.value());
                   console.log("axis y value:", axis_y_value);
                   console.log("axis z value:", axisZcombobox.value());                   

                   //καθάρισε το attr "used" των axisYDS και axisXDS
                   $.each( axisYDS.data(), function( index, selectedValue ){
                        var item = selectedValue.name;
                        
                        if(item === axis_y_value){
                            console.log("1ο if");
                            axisXDS.get(item).used = true;
                        }else if(item === axisXcombobox.value()){
                            console.log("2ο if");
                            axisXDS.get(item).used = true;
                        }else{
                            axisXDS.get(item).used = false;
                        }

                        if(item === axis_y_value){
                            console.log("1ο if");
                            axisZDS.get(item).used = true;
                        }else if(item === axisZcombobox.value()){
                            console.log("2ο if");
                            axisZDS.get(item).used = true;
                        }else{
                            axisZDS.get(item).used = false;
                        }

                   });
                   
                    console.log("--------------------AXIS X--------------------");
                    $.each(axisXDS.data(), function( index, selectedValue ){
                        console.log(selectedValue.name + ": " + selectedValue.used);
                    });
                    axisXcombobox.setDataSource(axisXDS);
                    axisXcombobox.refresh();

                    console.log("--------------------AXIS Z--------------------");
                    $.each(axisZDS.data(), function( index, selectedValue ){
                        console.log(selectedValue.name + ": " + selectedValue.used);
                    });
                    axisZcombobox.setDataSource(axisZDS);
                    axisZcombobox.refresh();
                   
               }
           });
           axisYcombobox = $("#axisY").data("kendoComboBox");

           $("#axisZ").kendoComboBox({
               dataSource: axisZDS,
               dataTextField: "name",
               dataValueField: "name",
               filter: "contains",
               change: function(e) {

                   axis_z_value = this.value();
                   
                   console.log("axis x value:", axisXcombobox.value());
                   console.log("axis y value:", axisYcombobox.value());
                   console.log("axis z value:", axis_z_value);

                   $.each( axisZDS.data(), function( index, selectedValue ){
                        var item = selectedValue.name;
                        
                        if(item === axis_z_value){
                            console.log("1ο if");
                            axisXDS.get(item).used = true;
                        }else if(item === axisXcombobox.value()){
                            console.log("2ο if");
                            axisXDS.get(item).used = true;
                        }else{
                            axisXDS.get(item).used = false;
                        }

                        if(item === axis_z_value){
                            console.log("1ο if");
                            axisYDS.get(item).used = true;
                        }else if(item === axisYcombobox.value()){
                            console.log("2ο if");
                            axisYDS.get(item).used = true;
                        }else{
                            axisYDS.get(item).used = false;
                        }

                   });
                   
                    console.log("--------------------AXIS X--------------------"); 
                    $.each(axisXDS.data(), function( index, selectedValue ){
                        console.log(selectedValue.name + ": " + selectedValue.used);
                    });
                    axisXcombobox.setDataSource(axisXDS);
                    axisXcombobox.refresh();

                    console.log("--------------------AXIS Y--------------------");
                    $.each(axisYDS.data(), function( index, selectedValue ){
                        console.log(selectedValue.name + ": " + selectedValue.used);
                    });
                    axisYcombobox.setDataSource(axisYDS);
                    axisYcombobox.refresh();
               }
           });
           axisZcombobox = $("#axisZ").data("kendoComboBox");


           $("#clear_axis").click( function() {
                var axisDatasource = axisXDS.data();
                $.each( axisDatasource, function( index, axisSelectedValue ){
                    var item = axisSelectedValue.name;
                     axisXDS.get(item).used = false;
                     axisYDS.get(item).used = false;
                     axisZDS.get(item).used = false;
                });
                
                axisXcombobox.value("");
                axisYcombobox.value("");
                axisZcombobox.value("");
           });
           
           $("#origin").sortable({connectWith: "#drop"});
           $("#drop").sortable({connectWith: "#origin"});

        });
     </script>
     
</head>

<body>

    <?php include "navigation-bar.php" ?>
       
    <!--statistics-->
    <div id="statistics-pane">
        <div id="rootwizard">
            <ul>
                <li><a href="#tab1" data-toggle="tab">Βήμα 1</a></li>
                <li><a href="#tab2" data-toggle="tab">Βήμα 2</a></li>
                <li><a href="#tab3" data-toggle="tab">Βήμα 3</a></li>
                <li><a href="#tab4" data-toggle="tab">Βήμα 4</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                    <div id="tab1_content">
                        <h4 class="statistics_wizard_headers">Επιλογή Μεταβλητής</h4>
                        <div class="statistics_wizard_instructions">
                            <span><i class="fa fa-lightbulb-o fa-2x"></i></span>
                            <span class="statistics_wizard_instructions_text"> Επιλέξτε τη μεταβλητή με βάση την οποία θέλετε να διαμορφώσετε τον πίνακα στατιστικών.</span>
                        </div>
                        <div class="statistics_wizard_selections">
                            <label class="statistics_wizard_labels" for="variable">Μεταβλητή</label>
                            <select name="variable" id="variable"></select>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2">
                    <div id="tab2_content">
                        <h4 class="statistics_wizard_headers">Διαμόρφωση Πίνακα Στατιστικών</h4>
                        <div class="statistics_wizard_instructions">
                            <span><i class="fa fa-lightbulb-o fa-2x"></i></span>
                            <span class="statistics_wizard_instructions_text"> Επιλέξτε τις παραμέτρους με βάση τις οποίες θα πληθυσμωθεί ο πίνακας στατιστικών (βλ. σχετική εικόνα). Εισάγετε τουλάχιστον μία παράμετρο.</span>
                        </div>
                        <div class="statistics_wizard_selections">
                            <div class="statistics_wizard_selection">
                                <label class="statistics_wizard_labels" for="axisX">Γραμμές</label>
                                <select name="axisX" id="axisX" style="width:250px"></select>
                            </div>
                            <div class="statistics_wizard_selection">
                                <label class="statistics_wizard_labels" for="axisY">Στήλες</label>
                                <select name="axisY" id="axisY" style="width:250px"></select>
                            </div>
                            <div class="statistics_wizard_selection">
                                <label class="statistics_wizard_labels" for="axisZ">Υποστήλες</label>
                                <select name="axisZ" id="axisZ" style="width:250px"></select>
                            </div>
                            <div class="statistics_wizard_selection">
                                <button id="clear_axis" type="button" class="btn btn-default btn-xs btn-info"><span class="glyphicon glyphicon-remove-circle"></span> καθαρισμός</button>
                            </div>
                            
<!--
                            <div id="wrapper">
                                <div id="origin" class="fbox">
                                    <span id="one" class="label label-default draggable">δήμος</span>
                                    <span id="one" class="label label-default draggable">τύπος διάταξης</span> 
                                    <span id="one" class="label label-default draggable">βαθμολογία διάταξης</span>
                                </div>
                                <div id="drop" class="fbox">

                                </div>
                            </div>                            -->

                            <!--<div id="wrapper">
                                <div  >
                                    <ul id="origin" class="fbox">
                                      <li class="list-group-item"><span id="one" class="label label-default draggable">δήμος</span></li>
                                      <li class="list-group-item"><span id="two" class="label label-default draggable">τύπος διάταξης</span></li>
                                      <li class="list-group-item"><span id="three" class="label label-default draggable">βαθμολογία διάταξης</span></li>
                                      </ul>
                                </div>
                                <div >
                                    <ul id="drop" class="fbox">
                                      <li class="list-group-item"></li>
                                      <li class="list-group-item"></li>
                                      <li class="list-group-item"></li>
                                      </ul>
                                </div>
                            </div>                            
-->


                            
                        </div>
                    </div>                   
                </div>
                <div class="tab-pane" id="tab3">
                    <div id="tab3_content">
                        <h4 class="statistics_wizard_headers">Επιλογή Φίλτρων</h4>
                        <div class="statistics_wizard_instructions">
                            <span><i class="fa fa-lightbulb-o fa-2x"></i></span>
                            <span class="statistics_wizard_instructions_text">Επιλέξτε τις παραμέτρους με τις οποίες επιθυμείτε να φιλτράρετε το στατιστικό αποτέλεσμα.</span>
                        </div>
                        <div class="statistics_wizard_selections">
                            <?php include "statistics-filter.php" ?>
                        </div>
                    </div>                    
                </div>
                <div class="tab-pane" id="tab4">
                    <div id="tab4_content">
                        <h4 class="statistics_wizard_headers">Στατιστικό Αποτέλεσμα</h4>
                        <div class="statistics_wizard_instructions">
                            <span><i class="fa fa-lightbulb-o fa-2x"></i></span>
                            <span class="statistics_wizard_instructions_text">Πατήστε "Προηγούμενο" για να μεταβάλετε τις επιλογές σας και να εξάγετε εκ νέου στατιστικό αποτέλεσμα.</span>
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