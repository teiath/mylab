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
    
    <!--select2 css files-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="client/select2-3.4.5/select2.css">-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="client/select2-3.4.5/select2-bootstrap.css">-->
    
    
    <!--jquery js files-->
    <script src="client/js/jquery.min.js"></script>
    <script src="client/js/jquery-ui-1.10.3.custom.min.js"></script>
    <!--bootstrap js files-->
    <script src="client/js/bootstrap.min.js"></script>
    <!--select2 js files-->
    <!--<script src="client/select2-3.4.5/select2.min.js"></script>-->
    <!--kendo js files-->
    <script src="client/src/js/kendo.web.js"></script>
    <!--custom js files-->
    <script type="text/javascript" src="client/myJs/jquery.scrollTo-1.4.3.1-min.js"></script>
    <script type="text/javascript" src="client/myJs/DataSources.js"></script>
    <script type="text/javascript" src="client/myJs/snippets.js"></script>
    
    <script type="text/javascript" src="client/myJs/raty-2.5.2/lib/jquery.raty.min.js"></script>
    <script type="text/javascript" src="jquery.bootstrap.wizard.js"></script>
    
    <script>
        
        var currentRow;
        //var regionEduAdminsDS, eduAdminsDS, transferAreasDS, municipalitiesDS;
        var schoolUnitsGrid; //schoolUnitsGridData;   //mesa sto js_event_handlers giati paizoun autes oi metavlites akoma afou den einai global??? (otan einai comment out) 
        var regionEduAdminsMultiSelect, regionEduAdminsMultiSelectData;
        var eduAdminsMultiSelect, eduAdminsMultiSelectData;
        var transferAreasMultiSelect, transferAreasMultiSelectData;
        var municipalitiesMultiSelect, municipalitiesMultiSelectData;
        var educationLevelsMultiSelect, educationLevelsMultiSelectData;
        var schoolUnitTypesMultiSelect, schoolUnitTypesMultiSelectData; 
        var labTypesMultiSelect, labTypesMultiSelectData;
        var aquisitionSourcesMultiSelect, aquisitionSourcesMultiSelectData;
        var labWorkerMultiSelect;
        var statistic;

        var regionEduAdmin_eduAdminsData = new Array();
        var regionEduAdmin_transferAreasData = new Array();
        var regionEduAdmin_municipalitiesData = new Array();
        
        var eduAdmin_eduAdminsData = new Array();
        var eduAdmin_transferAreasData = new Array();
        var eduAdmin_municipalitiesData = new Array();

        var transferArea_eduAdminsData = new Array();
        var transferArea_transferAreasData = new Array();
        var transferArea_municipalitiesData = new Array();
        
        var educationLevel_schoolUnitTypesData = new Array();
        
        //var currentPage, pagerUnitsMessage, pagerLabsMessage, pagerFinalMessage;

        var windowHeight, offsetFromTopToSelectedRowHeight, masterRowHeight, detailRowHeight, availableContainer, scrollPixels;
        var nestedwindowHeight, nestedoffsetFromTopToSelectedRowHeight, nestedmasterRowHeight, nesteddetailRowHeight, nestedavailableContainer, nestedscrollPixels;

        var computationalEquipmentData, networkEquipmentData, peripheralDevicesEquipmentData;
        var selectedAquisitionSources, selectedEquipmentTypes = new Array();
        var validLabType;//?????
        //var valid;
        //var currentlyInsertedEquipmentTypes= new Array();
        
        //var labTypesData;
        
        var inserted_computational_equipment= new Array();
        //var edit_computational_equipment_first_time = false;      
        var inserted_network_equipment= new Array();
        //var edit_network_equipment_first_time = false;        
        var inserted_peripheral_devices= new Array();
        //var edit_peripheral_devices_first_time = false;        
        var inserted_aquisition_sources= new Array();
        //var edit_aquisition_sources_first_time = false;
        
        var index_view= 0;
        var target_view;
        
        $(document).ready(function() { //Specify a function to execute when the DOM is fully loaded.

            $("#navbar-home-button").closest("li").addClass("active");

            $("#navbar-statistics-button").click( function() {
                window.location = "statistics.php";
            });

            $("#navbar-home-button").click( function() {
                window.location = "index.php";
            });

            $("#navbar-reports-button").click( function() {
                window.location = "reports.php";
            });

            $("#navbar-search-button").click( function() {
                  $("#search-pane").toggle("blind", 500);
              });
    
              
            //reset all form fields
            document.getElementById("search-form").reset();
            $('#checkbox_active').prop('checked', true);
            //$('#lab_checkbox_active').prop('checked', true);

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
             

            // ===================== SCHOOL UNITS GRID ===================== //
            schoolUnitsGrid = $("#view0").kendoGrid({
                            dataSource: schoolUnitsDS,
                            //toolbar: { template: kendo.template($("#refresh-btn").html())},
                            columnMenu: {
                                messages: {
                                    sortAscending: "Αύξουσα Ταξινόμηση",
                                    sortDescending: "Φθίνουσα Ταξινόμηση",
                                    columns: "Προσθαφαίρεση Στηλών"
                                }
                            },
                            selectable: "row",
                            sortable: {
                                allowUnsort: false
                            },
                            scrollable: false,
                            navigatable: false,
                            pageable: {
                              //input: true,
                              pageSizes: [15, 20, 25, 30, 50],
                              //refresh: true,
                              messages: {
                                  display: "{0}-{1} από {2} εγγραφές",
                                  empty: "Δεν βρέθηκαν εγγραφές",
                                  itemsPerPage: "εγγραφες ανά σελίδα",
                                  first: "μετάβαση στην πρώτη σελίδα",
                                  previous: "μετάβαση στην προηγούμενη σελίδα",
                                  next: "μετάβαση στην επόμενη σελίδα",
                                  last: "μετάβαση στην τελευταία σελίδα",
                                  refresh: "Ανανέωση"
                              }                             
                            },
                            detailTemplate: kendo.template($("#details-row-template").html()),  //The template which renders the detail rows.
                            detailInit: detailInit, //Fired when a detail table row is initialized, which happens when we expand a row for the first time.
                            detailExpand: function(e) { //Fired when the user expands a detail table row.
                                //console.log("schoolUnitsGrid detail expand event");
                                //e.detailRow   jQuery          The jQuery object which represents the detail table row.
                                //e.masterRow   jQuery          The jQuery object which represents the master table row.
                                //e.sender      kendo.ui.Grid   The widget instance which fired the event.

                                //console.log("e.detailRow", e.detailRow);
                                //console.log("e.masterRow", e.masterRow);

                                windowHeight = $(window).height();
                                offsetFromTopToSelectedRowHeight = e.masterRow.offset().top - $(document).scrollTop() ;  //the height of the window TILL the selected row
                                masterRowHeight = e.masterRow.height(); //master row height
                                //detailRowHeight = e.masterRow.next().height();  //detail row height
                                detailRowHeight = e.detailRow.height();
                                availableContainer = windowHeight-offsetFromTopToSelectedRowHeight-masterRowHeight;
                                //console.log("windowHeight", windowHeight);
                                //console.log("offsetFromTopToSelectedRowHeight", offsetFromTopToSelectedRowHeight);
                                //console.log("masterRowHeight", masterRowHeight);
                                //console.log("detailRowHeight", detailRowHeight);
                                //console.log("availableContainer", availableContainer);
                                
                                if(detailRowHeight > availableContainer){
                                    scrollPixels = detailRowHeight - availableContainer + 100;                                    
                                    $.scrollTo('+=' + scrollPixels + 'px', 800, {onAfter: function(){
                                                                                    //console.log("scrollTop: ", $(document).scrollTop());
                                                                                }});
                                }
                            },
                            detailCollapse: function(e) { //Fired when the user collapses a detail table row.
                                //console.log("schoolUnitsGrid detail collapse event");
                                //e.detailRow jQuery      The jQuery object which represents the detail table row.
                                //e.masterRow jQuery      The jQuery object which represents the master table row.
                                //e.sender kendo.ui.Grid  The widget instance which fired the event.
                                
                                //refresh(=collapse any expanded row, unselect any selected row) labs grid
                                var schoolUnitsLabs = e.detailRow.find(".k-detail-cell>.details-row>#labs-grid").data("kendoGrid"); 
                                if(typeof schoolUnitsLabs !== 'undefined'){
                                    schoolUnitsLabs.refresh();
                                }
                            },
                            // πρόβλημα με τις στήλες, πως θα τις διαμορφώσω ετσι ώστε να μην χαλάνε τα ποσοστά ;;;;;;;
                            columns: [{
                                    field:"school_unit_id",
                                    title:"κωδικός ΜΜ",
                                    width:"10%"
                                },
                                {
                                    field: "name",
                                    template: "#= name + ' (' + total_labs + ')' #",
                                    title: "ονομασία",
                                    width: "43%"
                                },
                                {
                                    field: "school_unit_type",
                                    title: "τύπος μονάδας",
                                    width: "12%"
                                },
                                {
                                    field: "education_level",
                                    title: "βαθμίδα",
                                    width: "10%",
                                    hidden: true
                                },
                                {
                                    field: "region_edu_admin",
                                    title: "περιφερειακή διεύθυνση εκπαίδευσης",
                                    width: "20%",
                                    hidden: true
                                },
                                {
                                    field: "edu_admin",
                                    title: "διεύθυνση εκπαίδευσης",
                                    width: "20%"
                                },
                                {
                                    field: "transfer_area",
                                    title: "περιοχή μετάθεσης",
                                    width: "20%",
                                    hidden: true
                                },
                                {
                                    field: "prefecture",
                                    title: "νομός",
                                    width: "20%",
                                    hidden: true
                                },
                                {
                                    field: "municipality",
                                    title: "δήμος",
                                    width: "15%"
                                },
                                {
                                    field: "email",
                                    title: "ηλ. ταχυδρομείο",
                                    width: "15%",
                                    hidden: true,
                                    sortable: false
                                },
                                {
                                    field: "fax_number",
                                    title: "φαξ",
                                    width: "15%",
                                    hidden: true,
                                    sortable: false
                                },
                                {
                                    field: "phone_number",
                                    title: "τηλέφωνο",
                                    width: "10%",
                                    sortable: false,
                                    hidden: true
                                },
                                {
                                    field: "street_address",
                                    title: "ταχ. διεύθυνση",
                                    width: "15%",
                                    hidden: true,
                                    sortable: false
                                },
                                {
                                    field: "postal_code",
                                    title: "ταχ. κώδικας",
                                    width: "15%",
                                    hidden: true,
                                    sortable: false
                                },
                                {
                                    field: "last_update",
                                    title: "τελευταία ανανέωση",
                                    width: "12%",
                                    hidden: true,
                                    sortable: false
                                }]
            }); //#school-units-grid
           
            // =============== school unit's detail row initialization  =============== //
            function detailInit(e){ //Fired when a detail table row is initialized.
                console.log("DETAIL INIT event");
                //e.data         (kendo.data.ObservableObject)  -> The data item to which the master table row is bound.
                //e.detailCell   (jQuery)                       -> The jQuery object which represents the detail table cell.
                //e.detailRow    (jQuery)                       -> The jQuery object which represents the detail table row.
                //e.masterRow    (jQuery)                       -> The jQuery object which represents the master table row.
                //e.sender       (kendo.ui.Grid)                -> The widget instance which fired the event.

                var data = e.data; // einai ta dedomena pou epistrefei i getSchoolUnits mesa sto "data" gia ti sugekrimeni sxoliki monada px data[0]
                var detailCell = e.detailCell;
                var detailRow = e.detailRow;
                var masterRow = e.masterRow;
                var sender = e.sender;
                
                var activate_window, suspend_window, abolish_window;
                var detailsActivateTemplate, detailsSuspendTemplate, detailsAbolishTemplate;
                var labToActivate, labToSuspend, labToAbolish;
                
                var extendedForTheFirstTime= false;
                
                console.log("last search filters: ", filters);
                
                console.log("e.data: ", data);
                console.log("e.detailCell: ", detailCell);
                console.log("e.detailRow: ", detailRow);
                console.log("e.masterRow: ", masterRow);
                console.log("e.sender: ", sender);

                detailRow.find("details-row").kendoSplitter({
                                    panes: [{ collapsible: false, resizable: true, scrollable: false}] // details-row
                                });

                detailRow.find(".details-row>#school-unit-details").append(school_unit_contact_details_snippet); 
                //populate with school unit details data - Τα στοιχεια επικοινωνίας πληθυσμώνονται με δεδομένα που επιστέφονται από τη getSchoolUnits
                if (data.email !== null) detailRow.find(".details-row>#school-unit-details>#contact-details>.contact-details-mail>.full_data>span").text(data.email);
                if (data.phone_number !== null) detailRow.find(".details-row>#school-unit-details>#contact-details>.contact-details-phone>.full_data>span").text(data.phone_number);
                if (data.street_address !== null) detailRow.find(".details-row>#school-unit-details>#contact-details>.contact-details-address>.full_data>span").text(data.street_address + ", " + data.postal_code);
                if (data.school_unit_worker !== null) detailRow.find(".details-row>#school-unit-details>#contact-details>.contact-details-principal>.full_data>span").text(data.school_unit_worker[0].firstname + " " + data.school_unit_worker[0].lastname);
                
                
                var labsGrid = detailRow.find(".details-row>#labs-grid").kendoGrid({

                    dataSource:{  // dataSource, set as a JavaScript object
                        transport: {
                            read: {
                                url: "api/labs",
                                type: "GET",
                                data: {
                                    "school_unit": data.school_unit_id//,
                                    //"lab_type": labTypesGlobal,
                                    //"aquisition_source": aquisitionSourcesGlobal
                                },
                                dataType: "json",
                                // ---------------- READ EVENTS ---------------- //
                                complete: function(e) {}
                            },
                            create: {
                                url: "api/labs",
                                type: "POST",
                                data: {
                                    //"school_unit": data.school_unit_id
                                },
                                dataType: "json",
                                // ---------------- CREATE EVENTS ---------------- //
                                complete: function(e) {
                                    console.log("create complete event", e);
                                    //$("#labs-grid").data("kendoGrid").dataSource.read();
                                }
                            },
                            destroy: {
                                url: "api/labs",
                                type: "DELETE",
                                data: {
                                    //"school_unit": data.school_unit_id
                                },
                                dataType: "json",
                                // ---------------- DELETE EVENTS ---------------- //
                                complete: function(e) {
                                    console.log("delete complete event");
                                    //$("#labs-grid").data("kendoGrid").dataSource.read();                               
                                }
                            },
                            parameterMap: function(data, type) {                      
                                if (type === 'read') {

                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                               
                                        var normalizedFilter = {};
                                        $.each(data.filter.filters, function(index, value){
                                            var filter = data.filter.filters[index];
                                            var value = normalizedFilter[filter.field];
                                            value = (value ? value+"," : "")+ filter.value;
                                            normalizedFilter[filter.field] = value;                                   
                                        });
                                        $.extend(data, normalizedFilter);
                                        delete data.filter;
                                    }                                    
                                    
                                    if (!extendedForTheFirstTime){
                                        data["lab_type"]= labTypesGlobal;
                                        data["aquisition_source"]= aquisitionSourcesGlobal;
                                        data["lab_id"]= labIdGlobal;
                                        data["lab_worker"]= labWorkerGlobal;
                                        data["state"] = labStateGlobal;
                                        data["operational_rating"] = operationalRatingGlobal;
                                        data["technological_rating"] = technologicalRatingGlobal;
                                        extendedForTheFirstTime=true;
                                    }
                                    
                                    return data;

                                }else if(type === 'create'){
                                
                                    var selectedEquipmentTypes = $("#popup_equipment").data("kendoGrid")._data;
                                    var equipment_types="";                                        
                                    $.each(selectedEquipmentTypes, function(index, value){
                                        var item = selectedEquipmentTypes[index];
                                        var normalized_item = item.name + "=" + item.items + ",";
                                        equipment_types += normalized_item;
                                    });
                                    data["equipment_types"] = equipment_types.slice(0, -1);
                                    
                                    
                                    var selectedAquisitionSources = $("#popup_aquisition_sources").data("kendoGrid")._data;
                                    var aquisition_sources="";                                        
                                    $.each(selectedAquisitionSources, function(index, value){
                                        var item = selectedAquisitionSources[index];
                                        var normalized_item = item.name + "=" + item.aquisition_date + "=" + item.comments + ",";
                                        aquisition_sources += normalized_item;
                                    });
                                    data["aquisition_sources"] = aquisition_sources.slice(0, -1);
                                    
                                    var selectedLabWorker = $("#labWorkerRegistryNo").data("kendoAutoComplete")._old;
                                    console.log("selectedLabWorker ", selectedLabWorker);
                                    data["lab_worker"] = selectedLabWorker.split(" ").pop();
                                    //data["lab_worker"] = selectedLabWorker.split(' ')[3];
                                    
                                    var selectedOnlineService = $("#create_relation_served_online").data("kendoAutoComplete")._old;
                                    console.log("selectedOnlineService", selectedOnlineService);
                                    if(selectedOnlineService !== ''){
                                        data["relation_served_online"] = selectedOnlineService.split(' ')[4] + "=" + selectedOnlineService.split(' ')[3].slice(0, -1);
                                    }
                                    
                                    var selectedServedService = $("#create_relation_served_service").data("kendoMultiSelect").dataItems();
                                    console.log("selectedServedService ", selectedServedService);
                                    var served_units="";                                        
                                    $.each(selectedServedService, function(index, value){
                                        console.log("do i get in here??");
                                        var item = selectedServedService[index];
                                        var normalized_item = item.school_unit_id + ",";
                                        served_units += normalized_item;
                                    });
                                    data["relation_served_service"] = served_units.slice(0, -1);
                                    
                                    
                                    
                                    var selectedWorkerDate = $("#worker_start_service").data("kendoDatePicker")._oldText;
                                    console.log("selectedWorkerDate ", selectedWorkerDate);
                                    data["worker_start_service"] = selectedWorkerDate;

                                    var operationalRating = $("#popup_operational_rating").data("kendoComboBox")._old;
                                    var technologicalRating = $("#popup_technological_rating").data("kendoComboBox")._old;
                                    
                                    data["operational_rating"] = operationalRating;
                                    data["technological_rating"] = technologicalRating;

                                    var selectedLabDate = $("#transition_date").data("kendoDatePicker")._oldText;
                                    console.log("selectedLabDate ", selectedLabDate);
                                    data["transition_date"] = selectedLabDate;
                                    
                                    data["school_unit"]= e.data.school_unit_id;
                                    data["state"]= 1;  //κατάσταση διάταξης Η/Υ: ενεργή 
                                    data["lab_source"]= 1; //πηγή δημιουργίας: UI mylab
                                    data["transition_source"]= "mylab"; //πηγή μετάβασης: mylab
                                    data["transition_justification"]= "δημιουργία Διάταξης Η/Υ"; 

                                    delete data.popup_operational_rating;
                                    delete data.popup_technological_rating;
                                    
                                    return JSON.stringify(data);                                        
                                }
                            }
                        },
                        schema: {
                            data: "data",
                            total: "total",
                            model: {
                                 id: "lab_id",
                                fields: { // αυτά τα πεδία θα εμφανίζονται μέσα στο e.model του event "edit" (δημιουργία/επεξεργασία Διάταξης Η/Υ)

                                    //Τα "fields" ειναι τα λεκτικά στα οποία θα μπουν οι τιμές που θα δώσει ο χρήστης στα αντίστοιχα widgets στο create μιας μονάδας!
                                                                        
                                    lab_type: {},
                                    positioning: {},
                                    school_unit: {editable: false},
                                    worker_start_service: {},
                                    special_name: {}
                                    //aquisition_sources: {},
                                    //equipment_types:{},
                                    //lab_worker: {},
                                    //relation_served_online:{},
                                    //relation_served_service:{},
                                    

                                    //Τα παρακάτω πεδία ΔΕΝ εισάγονται ΠΟΤΕ από το χρήστη 
                                    //lab_id: {editable: false},
                                    //name: {editable: false}, 
                                    //creation_date: {editable: false},
                                    //created_by: {editable: false},
                                    //last_updated: {editable: false},
                                    //updated_by: {editable: false},
                                }

                            }                           
                        },
                        // ------------------ DATASOURCE EVENTS ------------------ //
                        requestEnd: function(e) {
                            //Fired when a remote service request is finished.
                            //e.response Object                     The raw remote service response.
                            //e.sender kendo.data.DataSource        The data source instance which fired the event.
                            //e.type                                String

                            //console.log("labsGrid dataSource requestEnd event", e);
                            //console.log("requestEnd: e.response: ", e.response);
                            //console.log("requestEnd: e.sender: ", e.sender);
                            //console.log("requestEnd: e.type: ", e.type);

                            if (e.type=="create" || e.type=="destroy"){
                                if (e.response.status == "200"){
                                    //detailRow.find(".details-row").prepend('<div class=" alert-msg alert alert-success" style="display:none"> Η Διάταξη Η/Υ δημιουργήθηκε επιτυχώς </div>');
                                    detailRow.find(".details-row>.alert-success").toggle("blind", 500).delay(4000).toggle("blind", 500);//.fadeOut(800), fadeIn(800);  
                                    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();
                                }else{
                                    detailRow.find(".details-row>.alert-danger").toggle("blind", 500).delay(4000).toggle("blind", 500);//.fadeOut(800), fadeIn(800);
                                    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();                                    
                                }
                            }

                            if (e.type=="read"){
                                
                                //update labs summary data
                                if(e.response.total !=0){
                                    detailRow.find(".details-row>#labs-summary").empty();
                                    detailRow.find(".details-row>#labs-summary").append(labs_summary_snippet);

                                    var sepehy_no = e.response.all_labs_by_type_from_school_unit[data.school_unit_id]["ΣΕΠΕΗΥ"];
                                    var sepehy_pos = detailRow.find(".details-row>#labs-summary>#lab-summary>#sepehy>.lab_summary_full_label>.lab_summary_label");
                                    var sepehy_items = detailRow.find(".details-row>#labs-summary>#lab-summary>#sepehy>.lab_summary_full_label>.label");
                                    //sepehy_pos.empty();
                                    if(sepehy_no > 0) sepehy_pos.html('<a class="a-sepehy" href="#">ΣεπεΗΥ</a>');
                                    sepehy_items.text(sepehy_no);
                                    //(sepehy_no > 0) ? sepehy_pos.append( '<a class="a-sepehy" href="#">ΣΕΠΕΗΥ</a>: ' + sepehy_no) : sepehy_pos.text("ΣΕΠΕΗΥ: " + sepehy_no);

                                    var troxilato_no = e.response.all_labs_by_type_from_school_unit[data.school_unit_id]["ΤΡΟΧΗΛΑΤΟ"];
                                    var troxilato_pos = detailRow.find(".details-row>#labs-summary>#lab-summary>#troxilato>.lab_summary_full_label>.lab_summary_label");
                                    var troxilato_items = detailRow.find(".details-row>#labs-summary>#lab-summary>#troxilato>.lab_summary_full_label>.label");
                                    //troxilato_pos.empty();
                                    if(troxilato_no > 0) troxilato_pos.html('<a class="a-troxilato" href="#">Τροχήλατο</a>');
                                    troxilato_items.text(troxilato_no);
                                    //(troxilato_no > 0) ? troxilato_pos.append( '<a class="a-troxilato" href="#">ΤΡΟΧΗΛΑΤΟ</a>: ' + troxilato_no) : troxilato_pos.text("ΤΡΟΧΗΛΑΤΟ: " + troxilato_no); 

                                    var tomea_no = e.response.all_labs_by_type_from_school_unit[data.school_unit_id]["ΕΤΠ"];
                                    var tomea_pos = detailRow.find(".details-row>#labs-summary>#lab-summary>#tomea>.lab_summary_full_label>.lab_summary_label");
                                    var tomea_items = detailRow.find(".details-row>#labs-summary>#lab-summary>#tomea>.lab_summary_full_label>.label");
                                    //tomea_pos.empty();
                                    if(tomea_no > 0) tomea_pos.html('<a class="a-tomea" href="#">ΕΤΠ</a>');
                                    tomea_items.text(tomea_no);
                                    //(tomea_no > 0) ? tomea_pos.append( '<a class="a-tomea" href="#">ΕΡΓΑΣΤΗΡΙΟ ΤΟΜΕΑ</a>: ' + tomea_no) : tomea_pos.text("ΕΡΓΑΣΤΗΡΙΟ ΤΟΜΕΑ: " + tomea_no); 
 
                                    var gwnia_no = e.response.all_labs_by_type_from_school_unit[data.school_unit_id]["ΓΩΝΙΑ"];
                                    var gwnia_pos = detailRow.find(".details-row>#labs-summary>#lab-summary>#gwnia>.lab_summary_full_label>.lab_summary_label");
                                    var gwnia_items = detailRow.find(".details-row>#labs-summary>#lab-summary>#gwnia>.lab_summary_full_label>.label");
                                    //gwnia_pos.empty();
                                    if(gwnia_no > 0) gwnia_pos.html('<a class="a-gwnia" href="#">Γωνιά</a>');
                                    gwnia_items.text(gwnia_no);
                                    //(gwnia_no > 0) ? gwnia_pos.append( '<a class="a-gwnia" href="#">ΓΩΝΙΑ</a>: ' + gwnia_no) : gwnia_pos.text("ΓΩΝΙΑ: " + gwnia_no);
                                    
                                    var diadrastiko_no = e.response.all_labs_by_type_from_school_unit[data.school_unit_id]["ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"];
                                    var diadrastiko_pos = detailRow.find(".details-row>#labs-summary>#lab-summary>#diadrastiko>.lab_summary_full_label>.lab_summary_label");
                                    var diadrastiko_items = detailRow.find(".details-row>#labs-summary>#lab-summary>#diadrastiko>.lab_summary_full_label>.label");
                                    //diadrastiko_pos.empty();
                                    if(diadrastiko_no > 0) diadrastiko_pos.html('<a class="a-diadrastiko" href="#">Διαδραστικό Σύστημα</a>');
                                    diadrastiko_items.text(diadrastiko_no);
                                    //(diadrastiko_no > 0) ? diadrastiko_pos.append( '<a class="a-diadrastiko" href="#">ΔΙΑΔΡΑΣΤΙΚΑ ΣΥΣΤΗΜΑΤΑ</a>: ' + diadrastiko_no) : diadrastiko_pos.text("ΔΙΑΔΡΑΣΤΙΚΑ ΣΥΣΤΗΜΑΤΑ: " + diadrastiko_no);                                    
                                    
                                }else{
                                    detailRow.find(".details-row>#labs-summary").empty();
                                }
                                
                                //update school unit's name with updated total labs
                                var masterRowName = masterRow.children().eq(2).text();
                                var rgx = /\(([^)]+)\)/;
                                var match = masterRowName.match(rgx);                                
                                var masterRowNameChanged = masterRowName.replace(match[1], e.response.total);
                                masterRow.children().eq(2).text(masterRowNameChanged);                               
                           }
                        }
                    },
                    scrollable: false,
                    sortable: {
                        allowUnsort: false
                    },
                    selectable: "row",
                    toolbar: [{name: "create", text: "Προσθήκη νέας Διάταξης Η/Υ" }],//'<a class="k-button" href="\\#" onclick="return create_lab()">Command</a>',  //[{ template: kendo.template($("#template").html()) }],
                    detailTemplate: kendo.template($("#lab-details-row-template").html()),
                    detailInit: labDetailsInit,
                    columns: [{     //columns: An array of JavaScript objects or strings. A JavaScript objects are interpreted as column configurations. Here: array of JavaScript objects
                            field: "lab_id",
                            title:"κωδικός",
                            width:"4%",
                            hidden:true,
                            headerAttributes: {
                              style: "text-align: center"
                            }
                        },
                        {
                            field: "name",
                            title: "ονομασία",
                            template: function(dataItem) { //το dataItem ειναι περιέχει όλα τα στοιχεια της Διάταξης Η/Υ έτσι όπως τα επεστρεψε η getLabs μεσα στο λεκτικό data +καποια επιπλεον!
                                                              
                                var itemReturned;
                                //console.log("dataItem", dataItem);
                                //console.log("dataItem.state_id", dataItem.state_id);
                                //console.log("dataItem.special_name", dataItem.special_name);
                                //console.log("dataItem.name", dataItem.name);                                
                                
//                                if(dataItem.state_id == 1){
//                                    itemReturned = '<span class="label label-success label-active">ενεργή</span>';
//                                }else if(dataItem.state_id == 2){
//                                    itemReturned = '<span class="label label-warning label-suspended">ανεσταλμένη</span>';
//                                }else if(dataItem.state_id == 3){
//                                    itemReturned = '<span class="label label-danger label-abolished">καταργημένη</span>';
//                                }else{
//                                    itemReturned = "";
//                                }

                                if(dataItem.special_name === ""){
                                    itemReturned = "";
                                }else if(dataItem.special_name !== null){
                                    itemReturned =  "<span>" + kendo.htmlEncode(dataItem.name) + " ( " + kendo.htmlEncode(dataItem.special_name) + " ) " + "</span>";                           
                                }else{
                                    itemReturned =  "<span>" + kendo.htmlEncode(dataItem.name) + "</span>";         
                                }
                                
                                //console.log("itemReturned: ", itemReturned);
                                return itemReturned;
                            },
                            headerAttributes: {
                              style: "text-align: center"
                            },
                            width: "57%"
                        },
                        {
                            field: "lab_type",
                            title: "τύπος",
                            width: "15%",
                            headerAttributes: {
                              style: "text-align: center"
                            }
                            //hidden: true
                        },
                        {
                            field: "state_id",
                            title: "κατάσταση",
                            template: function(dataItem) { //το dataItem ειναι περιέχει όλα τα στοιχεια της Διάταξης Η/Υ έτσι όπως τα επεστρεψε η getLabs μεσα στο λεκτικό data +καποια επιπλεον!
                                                              
                                var itemReturned;
                                //console.log("dataItem", dataItem);
                                //console.log("dataItem.state_id", dataItem.state_id);
                                //console.log("dataItem.special_name", dataItem.special_name);
                                //console.log("dataItem.name", dataItem.name);                                
                                
                                if(dataItem.state_id == 1){
                                    itemReturned = '<span class="label label-success label-active">ενεργή</span>';
                                }else if(dataItem.state_id == 2){
                                    itemReturned = '<span class="label label-warning label-suspended">ανεσταλμένη</span>';
                                }else if(dataItem.state_id == 3){
                                    itemReturned = '<span class="label label-danger label-abolished">καταργημένη</span>';
                                }else{
                                    itemReturned = "";
                                }
                                
                                //console.log("itemReturned: ", itemReturned);
                                return itemReturned;
                            },
                            width: "8%",
                            headerAttributes: {
                              style: "text-align: center"
                            }
                            //hidden: true
                        },
                        {
                            field: "rating",
                            title: "βαθμολογία",
                            template: function(dataItem) { //το dataItem ειναι περιέχει όλα τα στοιχεια της Διάταξης Η/Υ έτσι όπως τα επεστρεψε η getLabs μεσα στο λεκτικό data +καποια επιπλεον!                            
                                
                                var oRating, tRating;
                                var oRating = (dataItem.operational_rating !== null && typeof dataItem.operational_rating !== 'undefined') ? dataItem.operational_rating : "-";
                                var tRating = (dataItem.technological_rating !== null && typeof dataItem.operational_rating !== 'undefined') ? dataItem.technological_rating : "-";
                                
                                var itemReturned = '<span><img src="./client/img/raty/star-on.png" data-toggle="tooltip" data-placement="top" title="λειτουργικός δείκτης"> ' + oRating + ', <img src="./client/img/raty/on.png" data-toggle="tooltip" data-placement="top" title="τεχνολογικός δείκτης"> ' + tRating + '</span>';
                                return itemReturned;
                            },
                            width: "8%",
                            headerAttributes: {
                              style: "text-align: center"
                            }
                            //hidden: true
                        },
                        {
                            field: "email",
                            title: "ηλ. ταχυδρομείο",
                            width: "12%",
                            hidden: true
                        },
                        {
                            field: "creation_date",
                            title: "δημιουργία",
                            width: "15%",
                            hidden: true
                        },
                        {
                            field: "created_by",
                            title: "δημιουργήθηκε από",
                            width: "15%",
                            hidden: true
                        },
                        {
                            field: "updated_by",
                            title: "τελευταία ανανέωση από",
                            width: "15%",
                            hidden: true
                        },
                        {
                            field: "positioning",
                            title: "τοποθεσία",
                            width: "18%",
                            hidden: true
                        },
                        {
                            field: "school_unit_id",
                            title: "κωδικός σχ.μονάδας",
                            width: "15%",
                            hidden: true
                        },
                        {
                            field: "last_updated",
                            title: "τελευταία ανανέωση",
                            width:"8%",
                            hidden:true
                        },
                        {
                          field: "special_name",
                          title: "ειδικό όνομα",
                          width:"45%",
                          hidden: true
                        },
                        {   
                            command: [
                                { name: "activate",
                                  className: "btn btn-default btn-xs",
                                  imageClass: "glyphicon glyphicon-ok custom-grid-icons",
                                  text: "",
                                  click: showActivateWindow
                                },
                                { name: "suspend",
                                  className: "btn btn-default btn-xs",
                                  imageClass: "glyphicon glyphicon-time custom-grid-icons",
                                  text: "",
                                  click: showSuspendWindow
                                },
                                { name: "abolish",
                                  className: "btn btn-default btn-xs",
                                  imageClass: "glyphicon glyphicon-remove custom-grid-icons",
                                  text: "",
                                  click: showAbolishWindow
                                }
                            ],
                            title: "ενέργειες",
                            width: "12%",
                            headerAttributes: {
                              style: "text-align: center"
                            }
                          //template: kendo.template($("#lab-commands-template").html())
                        }],
                    //το attr editable, αφορά το popup window δημιουργίας νέας Διάταξης Η/Υ
                    editable:{
                    //If set to true the user would be able to edit the data to which the grid is bound to.
                    //Can be set to a JavaScript object which represents the editing configuration.
                        mode: "popup",
                        //template: The template which renders popup editor. 
                        //The template should contain elements whose name HTML attributes are set as the editable fields. 
                        //This is how the grid will know which field to update. The other option is to use MVVM bindings 
                        //in order to bind HTML elements to data item fields.
                        template: kendo.template($("#popup_editor").html()),
                    },
                    // ---------------------- GRID EVENTS ---------------------- //
                    //Fired when the user expands a detail table row.
                    detailExpand: function(e) {
                        //console.log("labsGrid detailExpand event");

                        nestedwindowHeight = $(window).height();
                        nestedoffsetFromTopToSelectedRowHeight = e.masterRow.offset().top - $(document).scrollTop() ;  //the height of the window TILL the selected row
                        nestedmasterRowHeight = e.masterRow.height(); //master row height
                        nesteddetailRowHeight = e.masterRow.next().height();  //detail row height
                        nestedavailableContainer = nestedwindowHeight-nestedoffsetFromTopToSelectedRowHeight-nestedmasterRowHeight;

                        if(nesteddetailRowHeight > nestedavailableContainer){
                            nestedscrollPixels = nesteddetailRowHeight - nestedavailableContainer + 100;
                            //console.log("nestedscrollPixels", nestedscrollPixels);

                            $.scrollTo('+=' + nestedscrollPixels + 'px', 800, {onAfter: function(){
                                                                            //console.log("scrollTop: ", $(document).scrollTop());
                                                                        }});
                        }
                    },
                    //empty //Fired when the user collapses a detail table row.    
                    detailCollapse: function(e){//TODO: reset labs equipment tabstrip to first tab
                        //console.log("labsGrid detailCollapse event");
                            //refresh(=unselect any selected row and return to default tab)

    //                                e.detailRow.find(".k-detail-cell>.details-row>#labs-grid").data("kendoGrid"); 
    //                                
    //                                
    //                                var labsEquipment = detailRow.find(".k-detail-cell>.details-row>#labs-grid>table>tbody>tr .k-state-selected").data("kendoTabStrip");
    //                                console.log("labsEquipment", labsEquipment);
    //                                if(typeof labsEquipment !== 'undefined'){
    //                                    labsEquipment.activateTab("tab_1");
    //                                }
                    },
                    //Fired when the user edits or creates a data item.
                    edit: function(e) {
                        //e.container jQuery          The jQuery object representing the container element. That element contains the editing UI.
                        //e.model kendo.data.Model    The data item which is going to be edited. Use its isNew method to check if the data item is new (created) or not (edited).
                        //e.sender kendo.ui.Grid      The widget instance which fired the event.
                        //console.log("labsGrid edit event", e);

                        if (e.model.isNew()) {
                            e.container.prev().find(".k-window-title").text("Δημιουργία Διάταξης Η/Υ");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Δημιουργία");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }

                        //---------- Δημιουργία Διάταξης Η/Υ - Τύπος Διάταξης Η/Υ
                        $("#popupLabType").kendoComboBox({
                            dataSource: labTypesDS,
                            dataTextField: "name",
                            dataValueField: "name",
                            change: function(e){
                                var lab_type_userInput = this.value();
                                var labTypes = labTypesDS.data();

                                //check if user input is valid; if not reset
                                validLabType=false;
                                $.each( labTypes, function( index, selectedLabType ) {
                                    if (selectedLabType.name == lab_type_userInput){
                                        validLabType = true;
                                        return false;
                                    }
                                });
                                if(!validLabType){
                                    console.log("lab type input '" + lab_type_userInput + "' is not a valid one");
                                    this.value('');                                    
                                }
                                
                                //check if user input is ΕΡΓΑΣΤΗΡΙΟ ΤΟΜΕΑ or ΣΕΠΕΗΥ; if yes enable input several elements
                                if(lab_type_userInput !== "ΕΤΠ" && lab_type_userInput !== "ΣΕΠΕΗΥ"){
                                    $("#labWorkerRegistryNo").data("kendoAutoComplete").value("");
                                    $("#worker_start_service").data("kendoDatePicker").value("");
                                    $("#create_relation_served_online").data("kendoAutoComplete").value("");
                                    $("#create_relation_served_service").data("kendoMultiSelect").value("");
                                    $("#special_name").val("");
                                    
                                    $("#labWorkerRegistryNo").closest("div").prev().find(".required_field").empty();
                                    $("#worker_start_service").closest("div").prev().find(".required_field").empty();
                                    $("#create_relation_served_online").closest("div").prev().find(".required_field").empty();
                                    
                                    $("#labWorkerRegistryNo").data("kendoAutoComplete").enable(false);
                                    $("#worker_start_service").data("kendoDatePicker").enable(false);
                                    $("#create_relation_served_online").data("kendoAutoComplete").enable(false);
                                    $("#create_relation_served_service").data("kendoMultiSelect").enable(false);
                                    $("#special_name").attr("disabled", true);
                                }else{
                                    $("#labWorkerRegistryNo").closest("div").prev().find(".required_field").html('*');
                                    $("#worker_start_service").closest("div").prev().find(".required_field").html('*');
                                    $("#create_relation_served_online").closest("div").prev().find(".required_field").html('*');
                                    $("#labWorkerRegistryNo").data("kendoAutoComplete").enable();
                                    $("#worker_start_service").data("kendoDatePicker").enable();
                                    $("#create_relation_served_online").data("kendoAutoComplete").enable();
                                    $("#create_relation_served_service").data("kendoMultiSelect").enable();
                                    $("#special_name").removeAttr("disabled");
                                }
                            }
                        });
                        
                        //---------- Δημιουργία Διάταξης Η/Υ - Υπεύθυνος Διάταξης Η/Υ
                        $("#labWorkerRegistryNo").kendoAutoComplete({
                            dataSource: labWorkersDS,
                            dataTextField: "fullname",
                            template: "<div class='labWorkersTemplate'>\
                                            <span class='template_fullname'> #= lastname + ' ' + firstname #</span>\
                                            <div class='template_details'>\
                                                <span> ΑΜ </span>\
                                                <span class='template_data'> #= registry_no # </span>\
                                            </div>\
                                        <div>",
                            minLength: 3,
                            suggest: true,
                            change: function(e){

                                var lab_worker_userInput = this.value();
                                var labWorkers = labWorkersDS.data();

                                var validResponsible=false;
                                $.each( labWorkers, function( index, selectedLabResponsible ) {
                                    if (selectedLabResponsible.registry_no == lab_worker_userInput.split(" ").pop()){
                                        validResponsible = true;
                                        return false;
                                    }
                                });
                                if(!validResponsible){
                                    this.value('');
                                }
                            }
                        });
                        $("#labWorkerRegistryNo").data("kendoAutoComplete").enable(false);                        
                                                
                        //---------- Δημιουργία Διάταξης Η/Υ - Ημερομηνία Ανάληψης Ευθύνης Διάταξης Η/Υ
                        $("#worker_start_service").kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now())
                        });
                        $("#worker_start_service").data("kendoDatePicker").enable(false);

                        //---------- Δημιουργία  Διάταξης Η/Υ - Εξυπηρετεί Υπηρεσιακά
                        $("#create_relation_served_service").kendoMultiSelect({
                            dataSource: {
                                transport: {
                                    read: {
                                        url: "api/school_units",
                                        type: "GET",
                                        data: {
                                            "edu_admin": data.edu_admin
                                        },
                                        dataType: "json"
                                    },
                                    parameterMap: function(data, type) {        
                                        if (type === 'read') {
                                            if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {
                                                console.log("parametermap data: ", data);                         
                                                var normalizedFilter = {};
                                                $.each(data.filter.filters, function(index, value){
                                                    var filter = data.filter.filters[index];
                                                    var value = normalizedFilter[filter.field];
                                                    value = (value ? value+"," : "")+ filter.value;
                                                    normalizedFilter[filter.field] = value;                               
                                                });
                                                $.extend(data, normalizedFilter);
                                                delete data.filter;
                                            }

                                            var edu_admin_tag = data["edu_admin"].substring(15); //substring: Begin the extraction at position 15 starting from 0
                                            data["edu_admin"] = "ΔΙΕΥΘΥΝΣΗ Δ.Ε. " + edu_admin_tag + ", " + "ΔΙΕΥΘΥΝΣΗ Π.Ε. " + edu_admin_tag;
                                        }
                                        return data;
                                    }
                                },
                                schema: {
                                    data: "data",
                                    total: "total"
                                },
                                serverFiltering: true
                            },
                            autoBind: false,
                            dataValueField: "name",
                            dataTextField : "name",
                            minLength: 3
                        });                       
                        $("#create_relation_served_service").data("kendoMultiSelect").enable(false);

                        //---------- Δημιουργία Διάταξης Η/Υ - Εξυπηρετείται Διαδικτυακά
                        $("#create_relation_served_online").kendoAutoComplete({
                            //dataSource: circuitsDS,
                            dataSource: {
                                serverFiltering: true,
                                transport: {
                                    read: {
                                        url: "api/circuits",
                                        type: "GET",
                                        data: {
                                            //"edu_admin": data.edu_admin
                                        },
                                        dataType: "json"
                                    },    
                                    parameterMap: function(data, type) {
                                        if (type === 'read') {
                                            if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {
                                                console.log("data.filter.filters", data.filter.filters);
                                                data["circuit"] = data.filter.filters[0].value;
                                                delete data.filter;
                                            }
                                            
                                            //var edu_admin_tag = data["edu_admin"].substring(15); //substring: Begin the extraction at position 15 starting from 0
                                            //data["edu_admin"] = "ΔΙΕΥΘΥΝΣΗ Δ.Ε. " + edu_admin_tag + ", " + "ΔΙΕΥΘΥΝΣΗ Π.Ε. " + edu_admin_tag;
                                        }
                                        return data;
                                    }
                                },
                                schema: {
                                    data: function(response) {
                                            console.log(response);
                                            for (var i = 0; i < response.data.length; ++i) {
                                                response.data[i].fulltemplate = response.data[i].relation_type_name + ", αρ. κυκλ. " + response.data[i].phone_number + ", " + response.data[i].school_unit_id;
                                            }
                                            return response.data;
                                    },
                                    total: "total"
                                }                            
                            },
                            dataTextField: "fulltemplate",
                            template: "<div class='getsInternetTemplate'>\
                                <span class='template_school_name'> #= school_unit_name #</span>\
                                <div class='template_details2'>\
                                    <span> τύπος </span>\
                                    <span class='template_data'> #= relation_type_name # </span>\
                                    <span> , αρ.κυκλωματος </span>\
                                    <span class='template_data'> #= phone_number # </span>\
                                </div>\
                            <div>",
                            minLength: 3
                        });
                        $("#create_relation_served_online").data("kendoAutoComplete").enable(false);

                        //---------- Δημιουργία Διάταξης Η/Υ - Ειδικό Όνομα
                        $("#special_name").attr("disabled", true);

                        //---------- Δημιουργία Διάταξης Η/Υ - Πηγη/ές Χρηματοδότησης
                        $("#popup_aquisition_sources").kendoGrid({
                                dataSource: {
                                    schema:{
                                        model:{
                                            id: "aquisition_source_id",
                                            fields:{
                                                aquisition_source_id: { editable: false },
                                                aquisition_date: { },
                                                name: { },
                                                comments: { }
                                            }
                                        }
                                    }
                                },
                                toolbar: [
                                    { name: "create", text: "" }
                                ],
                                columns   :
                                [
                                    { field: "name", width: "40%", title: "πηγή", editor : aquisitionSourcesDropDownEditor, template: "#=name#" },
                                    { field: "aquisition_date", width: "25%", title: "έτος", editor : aquisitionYearDropDownEditor },
                                    { field: "comments", width: "30%", title: "σχόλια", editor : commentsTextAreaEditor },
                                    {   command: [{
                                            name: "destroy",
                                            className: "btn btn-default btn-xs",
                                            text: ""
                                        }],
                                        title: "ενέργειες",
                                        width: "5%"
                                    }
                                ],
                                editable:{
                                    confirmation: false
                                },
                                scrollable: false,
                                selectable: false,
                                save : function(e) {
//                                    console.log("e", e);
//                                    var aq_source = e.model.name;
//                                    aquisitionSourcesDS.get(aq_source).used = true;
                                }
                            });
                        //glyphicon-trash icon header in grid's last column
                        var popup_aquisition_sources_header = $("#popup_aquisition_sources thead");
                        popup_aquisition_sources_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-trash custom-grid-icons"></span>');

                        //---------- Δημιουργία Διάταξης Η/Υ - Εξοπλισμός
                        $("#popup_equipment").kendoGrid({
                            dataSource: {
                                schema:{
                                    model:{
                                        id: "equipment_type_id",
                                        fields:{
                                            equipment_type_id: { editable: false },
                                            name: { }, //validation: {required: true}, defaultValue: "LAPTOP", 
                                            items:{ type: "number", defaultValue:1, validation: { required: true, min: 1, validationMessage: "Ξέχασες το πλήθος εξοπλισμού!" } }
                                        }
                                    }
                                }
                            },
                            toolbar: [
                                { name: "create", text: "" }
                            ],
                            columns: [
                                { field: "name", title: "εξοπλισμός", width: "82%", editor: equipmentDropDownEditor, template: "#=name#" },
                                { field: "items", title:"πλήθος", format: "{0:n0}", width: "10%"},
                                { command: [{name: "destroy", className: "btn btn-default btn-xs", text: "" }], title: "ενέργειες", width: "8%" }
                            ],
                            //editable: "popup",//,inline, true
                            editable:{
                                    mode: "popup",
                                    confirmation: false,
                                    window: {
                                        width : "350px",
                                        scrollable: false
                                    }
                            },
                            scrollable: false,
                            selectable: false,
                            edit: function(e){
                                e.container.prev().find(".k-window-title").text("Προσθήκη Εξοπλισμού");
                                e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                                e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                            },
                            save: function(e){
                                console.log("GRID SAVE EVENT! ", e);
                                
                                if(e.model.name){
                                    var equipment_name = e.model.name;                                    
                                    equipmentTypesDS.get(equipment_name).used = true;
                                }
                                
                                console.log("END OF GRID SAVE EVENT!");
                            },
                            remove: function(e){
                                console.log("GRID REMOVE EVENT! ", e);
                                
                                if(e.model.name){
                                    var equipment_name = e.model.name;                                    
                                    equipmentTypesDS.get(equipment_name).used = false;
                                }
                                
                                console.log("END OF GRID REMOVE EVENT!");
                            }
                        });
                        //glyphicon-trash icon header in grid's last column
                        var popup_equipment_header = $("#popup_equipment thead");
                        popup_equipment_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-trash custom-grid-icons"></span>');
                        
                        //---------- Δημιουργία Διάταξης Η/Υ - Λειτουργική Βαθμολογία Διάταξης Η/Υ
                        $("#popup_operational_rating").kendoComboBox({
                            dataSource : ratingDS,
                            autoBind: false,
                            dataTextField: "name",
                            dataValueField: "id",
                            template: '#if(id == 1){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                                           #}else if(id == 2){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                                           #}else if(id == 3){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                                           #}else if(id == 4){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>\
                                           #}else if(id == 5){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>\
                                           #}#'                            
                        });

                        //---------- Δημιουργία Διάταξης Η/Υ - Τεχνολογική Βαθμολογία Διάταξης Η/Υ
                        $("#popup_technological_rating").kendoComboBox({
                            dataSource : ratingDS,
                            autoBind: false,
                            dataTextField: "name",
                            dataValueField: "id",
                            template: '#if(id == 1){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                                           #}else if(id == 2){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                                           #}else if(id == 3){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                                           #}else if(id == 4){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>\
                                           #}else if(id == 5){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>\
                                           #}#'                            
                        });

                        //---------- Δημιουργία Διάταξης Η/Υ - Ημερομηνία ενεργοποίησης Διάταξης Η/Υ
                        $("#transition_date").kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now())
                        });

                        //---------- Δημιουργία Διάταξης Η/Υ - Info Tooltips
                        $("#tooltip_relation_served_service").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content: "Εισάγονται οι Σχολικές Μονάδες -εντός Δ.Ε. Διάταξης Η/Υ- που εξυπηρετεί η Διάταξη Η/Υ. Η αναζήτηση στο πεδίο πραγματοποιείται με την εισαγωγή ονόματος Σχολικής Μονάδας.",
                                                      width: 200,
                                                      height: 130
                                                    });
                        $("#tooltip_relation_served_online").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content: "Εισάγεται το κύκλωμα της Σχολικής Μονάδας από το οποίο παίρνει δίκτυο η Διάταξη Η/Υ. Η αναζήτηση στο πεδίο πραγματοποιείται είτε με την εισαγωγή ονόματος Σχολικής Μονάδας, είτε με την εισαγωγή αριθμού κυκλώματος.",
                                                      width: 200,
                                                      height: 140
                                                    });
                        $("#tooltip_positioning").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content: "Εισάγεται η τοποθεσία της Διάταξης Η/Υ μέσα στη Σχολική Μονάδα (επιθυμητό format: κτήριο, όροφος, αίθουσα)",
                                                      width: 200,
                                                      height: 75
                                                    });
                        $("#tooltip_aquisition_sources").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content: "Εισάγεται ένας ή περισσότεροι τύποι χρηματοδότησης της Διάταξης Η/Υ. Σε περίπτωση που ο τύπος χρηματοδότησης δεν βρίσκεται στη λίστα, απαιτείται επικοινωνία με την ΚΕΔΟ mylab για την εισαγωγή του",
                                                      width: 200,
                                                      height: 120
                                                    });
                        $("#tooltip_equipment").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content: "Εισάγεται ένας ή περισσότεροι τύποι εξοπλισμού που διαθέτει η Διάταξη Η/Υ. Σε περίπτωση που ο τύπος εξοπλισμού δεν βρίσκεται στη λίστα, απαιτείται επικοινωνία με την ΚΕΔΟ mylab για την εισαγωγή του",
                                                      width: 200,
                                                      height: 120
                                                    });                                                    
                        $("#tooltip_transition_date").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content: "Εισάγεται η επίσημη ημερομηνία δημιουργίας της Διάταξης Η/Υ",
                                                      width: 200,
                                                      height: 40
                                                    });
                        $("#tooltip_worker_start_service").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content: "Εισάγεται η επίσημη ημερομηνία ανάληψης ευθύνης της Διάταξης Η/Υ από τον υπεύθυνο",
                                                      width: 200,
                                                      height: 60
                                                    });
                        $("#tooltip_special_name").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content: "Εισάγεται το υπάρχον όνομα της Διάταξης Η/Υ που διευκολύνει την αναγνώρισή του ανάμεσα στις υπόλοιπες Διατάξεις Η/Υ της Σχολικής Μονάδας",
                                                      width: 200,
                                                      height: 90
                                                    });
                        $("#tooltip_operational_rating").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content: "Εισάγεται η βαθμολογία της Διάταξης Η/Υ σε επίπεδο λειτουργικής απόδοσης βάσει των στόχων λειτουργίας της.",
                                                      width: 200,
                                                      height: 90
                                                    })                                              
                        $("#tooltip_technological_rating").kendoTooltip({
                                                      position: "left",
                                                      autoHide:false,
                                                      callout: true,
                                                      showOn: "click",
                                                      content:  "Εισάγεται η βαθμολογία της Διάταξης Η/Υ σε επίπεδο τεχνολογικής απόδοσης βάσει της ποιότητας του εξοπλισμού της.",
                                                      width: 200,
                                                      height: 90
                                                    });                                                    
                    },
                    //empty //Fired when the user clicks the "cancel" button (in inline or popup editing mode) or closes the popup window.        
                    cancel: function(e) {
                        //console.log("labsGrid cancel event", e);
                        //var grid = e.sender.element.data("kendoGrid");
                        //var row = grid.select();
                        //console.log("nomizw auto!!!!!!!!!", row.find(".k-grid-edit"));
                        //row.find(".k-grid-edit>.custom-grid-icons").removeClass("k-icon");
                    },
                    //Fired when a data item is saved.
                    save: function(e){
                        //e.model       kendo.data.Model        The data item to which the table row is bound.
                        //e.row         jQuery                  The jQuery object representing the current table row.
                        //e.sender      kendo.ui.Grid           The widget instance which fired the event.
                        //e.values      Object                  The values entered by the user. Available only when the editable.mode option is set to "incell".

                        //console.log("labsGrid save event");
                        if($("#info-pane").is(":visible")){
                            $("#info-pane").toggle("blind", 500);
                        }
                    },
                    //Fired when the user clicks the "destroy" command button.
                    remove: function(e) {
                        //e.model   kendo.data.Model    The data item to which the table row is bound.
                        //e.row     jQuery              The jQuery object representing the current table row.
                        //e.sender  kendo.ui.Grid       The widget instance which fired the event.                    
                        //console.log("labsGrid remove event");
                        if($("#info-pane").is(":visible")){
                            $("#info-pane").toggle("blind", 500);
                        }
                    },
                    //empty //Fired when the user clicks the "save" command button.
                    saveChanges: function(e){
                        console.log("labsGrid saveChanges event");
                    },
                    //empty //Fired when the widget is bound to data from its data source.        
                    dataBound: function(e) {
                        //console.log("labsGrid dataBound event: ", e);
                        
                        //manage grid command buttons: activate-suspend-abolish
                        $.each(e.sender._data, function(index, value){

                            var row = $(e.sender.tbody).find("tr").eq(index);
                            var rowCommandsCell = row.children('td:last');
                            var rowData = e.sender._data[index];

                            //console.log("row:", row);
                            //console.log("rowCommandsCell:", rowCommandsCell);
                            //console.log("rowData:", rowData);

                            if(rowData.state_id == "1"){
                                rowCommandsCell.find("a.k-grid-activate").attr('disabled', 'disabled');
                                rowCommandsCell.find("a.k-grid-suspend").removeAttr('disabled');
                                rowCommandsCell.find("a.k-grid-suspend").attr({'data-toggle':"tooltip", 'data-placement':"right", 'title':"αναστολή"});
                                rowCommandsCell.find("a.k-grid-abolish").removeAttr('disabled');
                                rowCommandsCell.find("a.k-grid-abolish").attr({'data-toggle':"tooltip", 'data-placement':"right", 'title':"κατάργηση"});
                            }else if(rowData.state_id == "2"){
                                rowCommandsCell.find("a.k-grid-activate").removeAttr('disabled');
                                rowCommandsCell.find("a.k-grid-activate").attr({'data-toggle':"tooltip", 'data-placement':"right", 'title':"ενεργοποίηση"});
                                rowCommandsCell.find("a.k-grid-suspend").attr('disabled', 'disabled');
                                rowCommandsCell.find("a.k-grid-abolish").removeAttr('disabled');
                                rowCommandsCell.find("a.k-grid-abolish").attr({'data-toggle':"tooltip", 'data-placement':"right", 'title':"κατάργηση"});
                            }else if(rowData.state_id == "3"){
                               rowCommandsCell.find("a.k-grid-activate").attr('disabled', 'disabled');
                               rowCommandsCell.find("a.k-grid-suspend").attr('disabled', 'disabled');
                               rowCommandsCell.find("a.k-grid-abolish").attr('disabled', 'disabled');
                            }

                        });
                    }
                });

                /*activate lab*/
                function showActivateWindow(e){
                    e.preventDefault();
                    
                    var labToActivateRow = $(e.currentTarget).closest("tr");
                    var dataItem= this.dataItem(labToActivateRow);
                    labToActivate= dataItem.lab_id;

                    activate_window.content(detailsActivateTemplate(dataItem));
                    activate_window.center().open();
                }
                detailsActivateTemplate = kendo.template($("#activate_template").html());
                activate_window = $("#activate_dialog").kendoWindow({
                    visible: false,
                    title: "Ενεργοποίηση Λειτουργίας",
                    //width: "28%",
                    //height: "14%",
                    modal: true,
                    resizable:false,
                    open: function(){
                                
                        var validatable = $("#lab_activation").kendoValidator().data("kendoValidator");        
                                
			$("#activate_transition_date").kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now())
			});
                        
                        $(".k-grid-click-cancel-activation").on("click", function(e){
                            
                            e.preventDefault();
                            
                            activate_window.close();
                            
                            if($("#activate_dialog").find(".k-edit-form-container").children().length === 3){
                                $("#activate_dialog").find(".k-edit-form-container>.alert").remove();
                                //activate_window.setOptions({height: "14%"});
                            }
                        });                        

                        $(".k-grid-click-close-activation").on("click", function(e){
                            
                            e.preventDefault();
                            
                            activate_window.close();
                            
                            $("#activate_dialog").find(".k-edit-form-container>.alert").remove();
                            //activate_window.setOptions({height: "14%"});
                            $("#activate_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-close-activation").hide();
                            $("#activate_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-cancel-activation").show();
                            $("#activate_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-activate").show();
                        });
                        
                        $(".k-grid-click-activate").on("click", function(e){
                            
                                e.preventDefault();
                                
                                if (validatable.validate()) {
                                
                                    if($("#activate_dialog").find(".k-edit-form-container").children().length === 3){
                                        $("#activate_dialog").find(".k-edit-form-container>.alert").remove();
                                        //activate_window.setOptions({height: "14%"});
                                    }

                                    var activate_window_element = activate_window.element;
                                    var activation_date = activate_window_element.find("#activate_transition_date").val();
                                    var activation_justification = activate_window_element.find("#activation_justification").val();

                                    $("#activate_transition_date").data("kendoDatePicker").enable(false);
                                    $("#activation_justification").prop('disabled',true);
                                    $("#activation_justification").css('resize', 'none');

                                    var parameters = {
                                              lab_id: labToActivate,//data.lab_id,
                                              transition_date: activation_date,
                                              transition_justification: activation_justification,
                                              transition_source: 'mylab',
                                              state: '1'
                                            };

                                    $.ajax({
                                            type: 'POST',
                                            url: 'http://172.16.16.80/mylab_ver4/api/lab_transitions',
                                            dataType: "json",
                                            data: JSON.stringify(parameters),
                                            //beforeSend: function(req) {
                                            //    //req.setRequestHeader('Authorization', btoa('username' + ":" + 'password'));
                                            //},
                                            success: function(data){
                                                
                                                console.log("ajax data:", data);
                                                
                                                //activate_window.setOptions({height: "18%"});
                                                if(data.status == 200){
                                                    $("#activate_dialog").find(".k-edit-form-container").prepend("<div class='alert alert-success'><strong>Η Διάταξη Η/Υ ενεργοποιήθηκε με επιτυχία</strong></div>");
                                                    $("#activate_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-activate").hide();
                                                    $("#activate_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-cancel-activation").hide();
                                                    $("#activate_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-close-activation").show();
                                                    
                                                    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();
                                                    
                                                }else if(data.status == 500){
                                                    $("#activate_dialog").find(".k-edit-form-container").prepend("<div class='alert alert-danger'><strong>Η ενεργοποίηση της Διάταξης Η/Υ απέτυχε</strong></div>");

                                                    $("#activate_transition_date").data("kendoDatePicker").enable();
                                                    $("#activation_justification").prop('disabled',false);
                                                    $("#activation_justification").removeAttr('resize');
                                                    
                                                    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();
                                                }
                                            },
                                            error: function (data){
                                                console.log("error data: ", data);
                                            }
                                    });
                                }
                                
                        });                       
                    }
                }).data("kendoWindow");               

                /*suspend lab
                 * 1. at first, function showSuspendWindow gets called when suspend button-command is clicked on a labsGrid row
                 * 2. then, detailsSuspendTemplate -which contains the window's form- gets created through showSuspendWindow function
                 * 3. in the end, the initially empty suspend_dialog div gets the kendo window
                 * */
                function showSuspendWindow(e){
                    //console.log("showSuspendWindow e", e);
                    //console.log("showSuspendWindow this", this);
                    e.preventDefault();
                    
                    var labToSuspendRow = $(e.currentTarget).closest("tr");
                    var dataItem = this.dataItem(labToSuspendRow);
                    labToSuspend = dataItem.lab_id;
                    
                    suspend_window.content(detailsSuspendTemplate(dataItem));
                    suspend_window.center().open();
                }
                detailsSuspendTemplate = kendo.template($("#suspend_template").html());
                suspend_window = $("#suspend_dialog").kendoWindow({
                    visible: false,
                    title: "Αναστολή Λειτουργίας",
                    //width: "28%",
                    //height: "14%",
                    modal: true,
                    resizable:false,
                    open: function(){
                                
                        var validatable = $("#lab_suspension").kendoValidator().data("kendoValidator");        
                                
			$("#suspend_transition_date").kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now())
			});
                        
                        $(".k-grid-click-cancel-suspension").on("click", function(e){
                            
                            e.preventDefault();
                            
                            suspend_window.close();
                            
                            if($("#suspend_dialog").find(".k-edit-form-container").children().length === 3){
                                $("#suspend_dialog").find(".k-edit-form-container>.alert").remove();
                                //suspend_window.setOptions({height: "14%"});
                            }
                        });                        

                        $(".k-grid-click-close-suspension").on("click", function(e){
                            
                            e.preventDefault();
                            
                            suspend_window.close();
                            
                            $("#suspend_dialog").find(".k-edit-form-container>.alert").remove();
                            //suspend_window.setOptions({height: "14%"});
                            $("#suspend_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-close-suspension").hide();
                            $("#suspend_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-cancel-suspension").show();
                            $("#suspend_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-suspend").show();
                        });
                        
                        $(".k-grid-click-suspend").on("click", function(e){
                            
                                e.preventDefault();
                                
                                if (validatable.validate()) {
                                
                                    if($("#suspend_dialog").find(".k-edit-form-container").children().length === 3){
                                        $("#suspend_dialog").find(".k-edit-form-container>.alert").remove();
                                        //suspend_window.setOptions({height: "14%"});
                                    }

                                    var suspend_window_element = suspend_window.element;
                                    var suspension_date = suspend_window_element.find("#suspend_transition_date").val();
                                    var suspension_justification = suspend_window_element.find("#suspension_justification").val();

                                    $("#suspend_transition_date").data("kendoDatePicker").enable(false);
                                    $("#suspension_justification").prop('disabled',true);
                                    $("#suspension_justification").css('resize', 'none');

                                    var parameters = {
                                              lab_id: labToSuspend,//data.lab_id,
                                              transition_date: suspension_date,
                                              transition_justification: suspension_justification,
                                              transition_source: 'mylab',
                                              state: '2'
                                            };

                                    $.ajax({
                                            type: 'POST',
                                            url: 'http://172.16.16.80/mylab_ver4/api/lab_transitions',
                                            dataType: "json",
                                            data: JSON.stringify(parameters),
                                            //beforeSend: function(req) {
                                            //    //req.setRequestHeader('Authorization', btoa('username' + ":" + 'password'));
                                            //},
                                            success: function(data){
                                                
                                                console.log("ajax data:", data);
                                                
                                                //suspend_window.setOptions({height: "18%"});
                                                if(data.status == 200){
                                                    $("#suspend_dialog").find(".k-edit-form-container").prepend("<div class='alert alert-success'><strong>Η Διάταξη Η/Υ ανεστάλη με επιτυχία</strong></div>");
                                                    $("#suspend_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-suspend").hide();
                                                    $("#suspend_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-cancel-suspension").hide();
                                                    $("#suspend_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-close-suspension").show();
                                                    
                                                    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();
                                                    
                                                }else if(data.status == 500){
                                                    $("#suspend_dialog").find(".k-edit-form-container").prepend("<div class='alert alert-danger'><strong>Η αναστολή της Διάταξης Η/Υ απέτυχε</strong></div>");

                                                    $("#suspend_transition_date").data("kendoDatePicker").enable();
                                                    $("#suspension_justification").prop('disabled',false);
                                                    $("#suspension_justification").removeAttr('resize');
                                                    
                                                    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();
                                                }
                                            },
                                            error: function (data){
                                                console.log("error data: ", data);
                                            }
                                    });
                                }
                        });
                                              
                    }
                }).data("kendoWindow");
                         
                
                /*abolish lab*/
                function showAbolishWindow(e){
                    e.preventDefault();
                    
                    var labToAbolishRow = $(e.currentTarget).closest("tr");
                    var dataItem = this.dataItem(labToAbolishRow);
                    labToAbolish = dataItem.lab_id;
                    
                    abolish_window.content(detailsAbolishTemplate(dataItem));
                    abolish_window.center().open();
                }
                detailsAbolishTemplate = kendo.template($("#abolish_template").html());
                abolish_window = $("#abolish_dialog").kendoWindow({
                    visible: false,
                    title: "Κατάργηση Διάταξης Η/Υ",
                    //width: "28%",
                    //height: "14%",
                    modal: true,
                    resizable:false,
                    open: function(){
                                
                        var validatable = $("#lab_abolishment").kendoValidator().data("kendoValidator");        
                                
			$("#abolish_transition_date").kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now())
			});
                        
                        $(".k-grid-click-cancel-abolishment").on("click", function(e){
                            
                            e.preventDefault();
                            
                            abolish_window.close();
                            
                            if($("#abolish_dialog").find(".k-edit-form-container").children().length === 3){
                                $("#abolish_dialog").find(".k-edit-form-container>.alert").remove();
                                //abolish_window.setOptions({height: "14%"});
                            }
                        });                        

                        $(".k-grid-click-close-abolishment").on("click", function(e){
                            
                            e.preventDefault();
                            
                            abolish_window.close();
                            
                            $("#abolish_dialog").find(".k-edit-form-container>.alert").remove();
                            //abolish_window.setOptions({height: "14%"});
                            $("#abolish_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-close-abolishment").hide();
                            $("#abolish_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-cancel-abolishment").show();
                            $("#abolish_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-abolish").show();
                        });
                        
                        $(".k-grid-click-abolish").on("click", function(e){
                            
                                e.preventDefault();
                                
                                if (validatable.validate()) {
                                
                                    if($("#abolish_dialog").find(".k-edit-form-container").children().length === 3){
                                        $("#abolish_dialog").find(".k-edit-form-container>.alert").remove();
                                        //abolish_window.setOptions({height: "14%"});
                                    }

                                    var abolish_window_element = abolish_window.element;
                                    var abolishment_date = abolish_window_element.find("#abolish_transition_date").val();
                                    var abolishment_justification = abolish_window_element.find("#abolishment_justification").val();

                                    $("#abolish_transition_date").data("kendoDatePicker").enable(false);
                                    $("#abolishment_justification").prop('disabled',true);
                                    $("#abolishment_justification").css('resize', 'none');

                                    var parameters = {
                                              lab_id: labToAbolish,//data.lab_id,
                                              transition_date: abolishment_date,
                                              transition_justification: abolishment_justification,
                                              transition_source: 'mylab',
                                              state: '3'
                                            };

                                    $.ajax({
                                            type: 'POST',
                                            url: 'http://172.16.16.80/mylab_ver4/api/lab_transitions',
                                            dataType: "json",
                                            data: JSON.stringify(parameters),
                                            //beforeSend: function(req) {
                                            //    //req.setRequestHeader('Authorization', btoa('username' + ":" + 'password'));
                                            //},
                                            success: function(data){
                                                
                                                console.log("ajax data:", data);
                                                
                                                //abolish_window.setOptions({height: "18%"});
                                                if(data.status == 200){
                                                    $("#abolish_dialog").find(".k-edit-form-container").prepend("<div class='alert alert-success'><strong>Η Διάταξη Η/Υ καταργήθηκε με επιτυχία</strong></div>");
                                                    $("#abolish_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-abolish").hide();
                                                    $("#abolish_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-cancel-abolishment").hide();
                                                    $("#abolish_dialog").find(".k-edit-form-container>.k-edit-buttons>a.k-grid-click-close-abolishment").show();
                                                    
                                                    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();
                                                    
                                                }else if(data.status == 500){
                                                    $("#abolish_dialog").find(".k-edit-form-container").prepend("<div class='alert alert-danger'><strong>Η κατάργηση της Διάταξης Η/Υ απέτυχε</strong></div>");

                                                    $("#abolish_transition_date").data("kendoDatePicker").enable();
                                                    $("#abolishment_justification").prop('disabled',false);
                                                    $("#abolishment_justification").removeAttr('resize');
                                                    
                                                    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();
                                                }
                                            },
                                            error: function (data){
                                                console.log("error data: ", data);
                                            }
                                    });
                                }
                        });
                       
                        
                    }
                }).data("kendoWindow");                              
                             
                
            }

            //σχετίζεται με το grid εισαγωγής πηγών χρηματοδότησης στη δημιουργία Διάταξης Η/Υ ("#popup_aquisition_sources")
            function aquisitionSourcesDropDownEditor(container, options){
            
                console.log("aquisitionSourcesDS", aquisitionSourcesDS);
                
                var aquisitionSourcesComboBox = $('<input id="aquisitionSourcesDropDownEditor" required data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoComboBox({
                        autoBind: false,
                        dataSource: aquisitionSourcesDS,
                        change: function(e){
                                var aquisition_source_userInput = this.value();
                                var aquisitionSources = aquisitionSourcesDS.data();

                                //check if user input is valid; if not reset
                                validAquisitionSource=false;
                                $.each( aquisitionSources, function( index, selectedAquisitionSource ) {
                                    if (selectedAquisitionSource.name == aquisition_source_userInput){
                                        validAquisitionSource = true;
                                        return false;
                                    }
                                });
                                if(!validAquisitionSource){
                                    console.log(" aquisition source input '" + aquisition_source_userInput + "' is not a valid one");
                                    this.value('');                                    
                                }
                        }
                    });
            }
            function aquisitionYearDropDownEditor(container, options){

                var data = new Array();
                var date = new Date();
                var currentYear = date.getFullYear();
                for(var year=1975; year<=currentYear; year++){
                        data[year-1975] = { year : year  } ;
                }
                data.reverse();
                
                var aquisitionYearComboBox = $('<input id="aquisitionYearDropDownEditor" required data-text-field="year" data-value-field="year" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoComboBox({
                        autoBind: false,
                        dataSource: data,
                        change: function(e){
                                var aquisition_year_userInput = this.value();
                                var aquisitionYears = data;

                                //check if user input is valid; if not reset
                                validAquisitionYear=false;
                                $.each( aquisitionYears, function( index, selectedAquisitionYear ) {
                                    if (selectedAquisitionYear.year == aquisition_year_userInput){
                                        validAquisitionYear = true;
                                        return false;
                                    }
                                });
                                if(!validAquisitionYear){
                                    console.log(" aquisition year input '" + aquisition_year_userInput + "' is not a valid one");
                                    this.value('');                                    
                                }
                        }
                    });
            }
            function commentsTextAreaEditor(container, options) {
                $('<textarea class="k-textbox" data-bind="value: ' + options.field + '"></textarea>').appendTo(container);
            }

            //σχετίζεται με το grid εισαγωγής εξοπλισμού στη δημιουργία Διάταξης Η/Υ ("#popup_equipment")
            function equipmentDropDownEditor(container, options) {
//                console.log("container", container);
//                console.log("options", options);
                var equipmentComboBox = $('<input id="equipmentDropDownEditor" required data-required-msg="Ξέχασες τον τύπο εξοπλισμού!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoComboBox({
                        autoBind: false,
                        dataSource: equipmentTypesDS,
                        change: function(e){
                                var equipment_type_userInput = this.value();
                                var equipmentTypes = equipmentTypesDS.data();

                                //check if user input is valid; if not reset
                                validEquipmentType=false;
                                $.each( equipmentTypes, function( index, selectedEquipmentType ) {
                                    if (selectedEquipmentType.name == equipment_type_userInput){
                                        validEquipmentType = true;
                                        return false;
                                    }
                                });
                                if(!validEquipmentType){
                                    console.log(" aquisition source input '" + equipment_type_userInput + "' is not a valid one");
                                    this.value('');                                    
                                }
                        }
                    });
            }
            
            //σχετίζεται με το grid εισαγωγής πηγών χρηματοδότησης στην επεξεργασία Διάταξης Η/Υ
            function aquisitionSourcesDropDownEditor2(container, options){
            
                console.log("aquisitionSourcesDS2", aquisitionSourcesDS2);
                
                var aquisitionSourcesComboBox2 = $('<input id="aquisitionSourcesDropDownEditor2" required validationMessage="Ξέχασες την πηγή χρηματοδότησης!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoComboBox({
                        autoBind: false,
                        dataSource: aquisitionSourcesDS2,
                        change: function(e){
                            var userInput = this.value();
                            var aquisition_source = e.sender.dataSource._data;

                            validAquisitionSource=false;
                            $.each( aquisition_source, function( index, selectedAquisitionSource ) {
                                if (selectedAquisitionSource.name == userInput){
                                    validAquisitionSource = true;
                                    return false;
                                }
                            });
                            if(!validAquisitionSource){
                                console.log("aquisition source input '" + userInput + "' is not a valid one");
                                this.value('');                                    
                            }
                        }
                    });
            } 
            function aquisitionYearDropDownEditor2(container, options){

                var data = new Array();
                var date = new Date();
                var currentYear = date.getFullYear();
                for(var year=1975; year<=currentYear; year++){
                        data[year-1975] = { year : year  } ;
                }
                data.reverse();
                
                var aquisitionYearComboBox2 = $('<input id="aquisitionYearDropDownEditor2" required validationMessage="Ξέχασες το έτος χρηματοδότησης!" data-text-field="year" data-value-field="year" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoComboBox({
                        autoBind: false,
                        dataSource: data,// {
//                            data: data,
//                            model:{
//                                id:"year",
//                                fields:{
//                                    year: { validation: { required: true, validationMessage:"Ξέχασες το έτος χρηματοδότησης!" } }
//                                }
//                            }
//                        },
                        change: function(e){
                            
                            console.log("year e: ", e);
                            var userInput = this.value();
                            var year = e.sender.dataSource._data;

                            validYear=false;
                            $.each( year, function( index, selectedYear ) {
                                if (selectedYear.year == userInput){
                                    validYear = true;
                                    return false;
                                }
                            });
                            if(!validYear){
                                console.log("year input '" + userInput + "' is not a valid one");
                                this.value('');                                    
                            }
                        }
                    });
            }
            
            //σχετίζεται με το grid εισαγωγής εξοπλισμού στην επεξεργασία Διάταξης Η/Υ
            function computationalEquipmentDropDownEditor(container, options) {
                //console.log("container", container);
                //console.log("options.field", options.field);
                var computationalEquipmentComboBox = $('<input id="computationalEquipmentDropDownEditor" required validationMessage="Ξέχασες τον εξοπλισμό!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoComboBox({
                        autoBind: false,
                        dataSource: {
                            transport: {
                                read: {
                                    url: "api/equipment_types",
                                    type: "GET",
                                    data: {
                                        "equipment_category": 1
                                    },
                                    dataType: "json"
                                }
                            },
                            schema: {
                                data: "data",
                                total: "total",
                                model:{
                                    id: "name"
                                }
                            },
                            filter: { field: "used", operator: "neq", value: true },
                            requestEnd: function(e) {
                                console.log("START OF get equipment_types cat1 requestEnd event e :", e);
                                
                                while (inserted_computational_equipment.length > 0){

                                    var cur_equip = inserted_computational_equipment.pop();

                                    for(var i=0; i<e.response.data.length; i++) {
                                        if (e.response.data[i].name === cur_equip){
                                            e.response.data[i].used = true;
                                        }
                                    }
                                }
                                console.log("END OF get equipment_types cat1 requestEnd event");
                            }
                        },
                        change: function(e){
                            var userInput = this.value();
                            var equipment = e.sender.dataSource._data;//computationalEquipmentTypesDS.data();

                            validEquipment=false;
                            $.each( equipment, function( index, selectedEquipment ) {
                                if (selectedEquipment.name == userInput){
                                    validEquipment = true;
                                    return false;
                                }
                            });
                            if(!validEquipment){
                                console.log("equipment input '" + userInput + "' is not a valid one");
                                this.value('');                                    
                            }
                        }
                    });
            }
            function networkEquipmentDropDownEditor(container, options) {
//                console.log("container", container);
//                console.log("options", options);
                var networkEquipmentComboBox = $('<input id="networkEquipmentDropDownEditor" required validationMessage="Ξέχασες τον εξοπλισμό!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoComboBox({
                        autoBind: false,
                        dataSource: {
                            transport: {
                                read: {
                                    url: "api/equipment_types",
                                    type: "GET",
                                    data: {
                                        "equipment_category": 2
                                    },
                                    dataType: "json"
                                }
                            },
                            schema: {
                                data: "data",
                                total: "total",
                                model:{
                                    id: "name"
                                }
                            },
                            filter: { field: "used", operator: "neq", value: true },
                            requestEnd: function(e) {
                                console.log("START OF get equipment_types cat2 requestEnd event e :", e);
                                //Το request end τρέχει ακόμα κι όταν ΔΕΝ γινει το GET request (get equipment types)
                                while (inserted_network_equipment.length > 0){

                                    var cur_equip = inserted_network_equipment.pop();

                                    for(var i=0; i<e.response.data.length; i++) {
                                        if (e.response.data[i].name === cur_equip){
                                            e.response.data[i].used = true;
                                        }
                                    }
                                }                                
                                console.log("END OF get equipment_types cat2 requestEnd event e :");
                            }
                        },
                        change: function(e){
                            var userInput = this.value();
                            var equipment = e.sender.dataSource._data;

                            validEquipment=false;
                            $.each( equipment, function( index, selectedEquipment ) {
                                if (selectedEquipment.name == userInput){
                                    validEquipment = true;
                                    return false;
                                }
                            });
                            if(!validEquipment){
                                console.log("equipment input '" + userInput + "' is not a valid one");
                                this.value('');                                    
                            }
                        }
                    });
            }
            function peripheralDevicesDropDownEditor(container, options) {
//                console.log("container", container);
//                console.log("options", options);
                var peripheralDevicesEquipmentComboBox = $('<input id="peripheralDevicesDropDownEditor" required validationMessage="Ξέχασες τον εξοπλισμό!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoComboBox({
                        autoBind: false,
                        dataSource: {
                            transport: {
                                read: {
                                    url: "api/equipment_types",
                                    type: "GET",
                                    data: {
                                        "equipment_category": 3
                                    },
                                    dataType: "json"
                                }
                            },
                            schema: {
                                data: "data",
                                total: "total",
                                model:{
                                    id: "name"
                                }
                            },
                            filter: { field: "used", operator: "neq", value: true },
                            requestEnd: function(e) {
                                console.log("START OF get equipment_types cat3 requestEnd event e :", e);
                                
                                while (inserted_peripheral_devices.length > 0){

                                    var cur_equip = inserted_peripheral_devices.pop();

                                    for(var i=0; i<e.response.data.length; i++) {
                                        if (e.response.data[i].name === cur_equip){
                                            e.response.data[i].used = true;
                                        }
                                    }
                                }
                                console.log("END OF get equipment_types cat3 requestEnd event");
                            }
                        },
                        change: function(e){
                            var userInput = this.value();
                            var equipment = e.sender.dataSource._data;

                            validEquipment=false;
                            $.each( equipment, function( index, selectedEquipment ) {
                                if (selectedEquipment.name == userInput){
                                    validEquipment = true;
                                    return false;
                                }
                            });
                            if(!validEquipment){
                                console.log("equipment input '" + userInput + "' is not a valid one");
                                this.value('');                                    
                            }
                        }
                    });
            }
            
            
            function relationTypesDropDownEditor(container, options) {

                var relationTypesComboBox = $('<input id="relationTypesDropDownEditor" required validationMessage="Ξέχασες τον τύπο συσχέτισης!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoComboBox({
                        autoBind: false,
                        dataSource: {
                            transport: {
                                read: {
                                    url: "api/relation_types",
                                    type: "GET",
                                    data: {},
                                    dataType: "json"
                                }
                            },
                            schema: {
                                data: "data",
                                total: "total",
                                model:{
                                    id: "name"
                                }
                            }
                        },
                        change: function(e){
                            var userInput = this.value();
                            var relation = e.sender.dataSource._data;

                            validRelation=false;
                            $.each( relation, function( index, selectedRelation ) {
                                if (selectedRelation.name == userInput){
                                    validRelation = true;
                                    return false;
                                }
                            });
                            if(!validRelation){
                                console.log("relation input '" + userInput + "' is not a valid one");
                                this.value('');                                    
                            }
                        }
                    });
            }
            function schoolUnitsDropDownEditor(container, options) {
//                console.log("container", container);
//                console.log("options", options);
                var schoolUnitsAutoComplete = $('<input id="schoolUnitsDropDownEditor" required validationMessage="Ξέχασες τη Σχολική Μονάδα!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoAutoComplete({
                        autoBind: false,
                        dataSource: {
                            transport: {
                                read: {
                                    url: "api/school_units",
                                    type: "GET",
                                    data: {},
                                    dataType: "json"
                                },
                                parameterMap: function(data, type) {

                                    //console.log("schoolUnitsAutoComplete parametermap data: ", data);
                                    if (type === 'read') {
                                        if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                               
                                            var normalizedFilter = {};
                                            $.each(data.filter.filters, function(index, value){
                                                var filter = data.filter.filters[index];
                                                var value = normalizedFilter[filter.field];
                                                value = (value ? value+"," : "")+ filter.value;
                                                normalizedFilter[filter.field] = value;                                   
                                            });
                                            $.extend(data, normalizedFilter);
                                            delete data.filter;
                                        }
                                        return data;

                                    }
                                }
                            },
                            schema: {
                                data: "data",
                                total: "total",
                                model:{
                                    id: "name"
                                }
                            }
                        },
                        dataTextField: "name",
                        placeholder: "επιλογή σχ. μονάδας ...",
                        minLength: 1
//                        change: function(e){
//                            var userInput = this.value();
//                            var school_unit = e.sender.dataSource._data;
//
//                            validSchoolUnit=false;
//                            $.each( school_unit, function( index, selectedSchoolUnit ) {
//                                if (selectedSchoolUnit.name == userInput){
//                                    validSchoolUnit = true;
//                                    return false;
//                                }
//                            });
//                            if(!validSchoolUnit){
//                                console.log("school_unit input '" + userInput + "' is not a valid one");
//                                this.value('');                                    
//                            }
//                        }
                    });
            }


            // =============== lab's detail row initialization  =============== //
            function labDetailsInit(e){
                console.log("LAB DETAIL INIT event");
                //e.data         (kendo.data.ObservableObject)  -> The data item to which the master table row is bound.
                //e.detailCell   (jQuery)                       -> The jQuery object which represents the detail table cell.
                //e.detailRow    (jQuery)                       -> The jQuery object which represents the detail table row.
                //e.masterRow    (jQuery)                       -> The jQuery object which represents the master table row.
                //e.sender       (kendo.ui.Grid)                -> The widget instance which fired the event.

                var labData = e.data;
                var labDetailRow = e.detailRow;
                var panelbar_id = "panelbar" + labData.lab_id;
                var labDetailsTabContent_id = "labDetailsTabContent" + labData.lab_id;
                var equipment_tab_id = "equipment_tab_id" + labData.lab_id;
                var aquisition_sources_tab_id =  "aquisition_sources_tab" + labData.lab_id;
                var lab_workers_tab_id =  "lab_workers_tab" + labData.lab_id;
                var lab_relations_tab_id =  "lab_relations_tab" + labData.lab_id;
                var lab_transitions_tab_id =  "lab_transitions_tab" + labData.lab_id;
                var general_tab_id =  "general_tab" + labData.lab_id;
                var rating_tab_id =  "rating_tab" + labData.lab_id;
                
                console.log("labData", labData);
                console.log("labDetailRow", labDetailRow);

                labDetailRow.find("lab-details-row").kendoSplitter({
                                    panes: [{ collapsible: false, resizable: true, scrollable: false}]
                                });

                labDetailRow.find(".lab-details-row").append(navigation_bar);
                
                labDetailRow.find(".lab-details-row>#panelbar").attr("id", panelbar_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#labDetailsTabContent").attr("id", labDetailsTabContent_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#equipment_tab").attr("id", equipment_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#aquisition_sources_tab").attr("id", aquisition_sources_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#lab_workers_tab").attr("id", lab_workers_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#lab_relations_tab").attr("id", lab_relations_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#lab_transitions_tab").attr("id", lab_transitions_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#general_tab").attr("id", general_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#rating_tab").attr("id", rating_tab_id);
                
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(1)>a").attr("href", "#"+equipment_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(2)>a").attr("href", "#"+aquisition_sources_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(3)>a").attr("href", "#"+lab_workers_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(4)>a").attr("href", "#"+lab_relations_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(5)>a").attr("href", "#"+lab_transitions_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(6)>a").attr("href", "#"+general_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(7)>a").attr("href", "#"+rating_tab_id);
                
                
                                                            // ======= EQUIPMENT =======//
                                                            
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_equipment);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id).append('<button id="edit_lab_equipment" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>  επεξεργασία</button>');
                }
                
                //create tabstrip widget
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id).append(lab_equipment_snippet);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip").kendoTabStrip({
                    animation:  {
                        open: {
                            effects: "fadeIn"
                        }
                    }
                    //,activate: function(e){}
                });

                var grid_tab_1 = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").kendoGrid({
                    dataSource: {
                        //data: computational_equipment_data,
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_equipment_types",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id,
                                    "equipment_category" : "1" 
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_equipment_types",
                                type: "POST",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema
                                    
                                },
                                dataType: "json"
                            },
                            update: {
                                url: "api/lab_equipment_types",
                                type: "PUT",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema
                                    
                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_equipment_types",
                                type: "DELETE",
                                data: {
                                    "lab_id": labData.lab_id
                                    //"equipment_type" παιρνονται από το schema
                                },
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {
                                
                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                               
                                        var normalizedFilter = {};
                                        $.each(data.filter.filters, function(index, value){
                                            var filter = data.filter.filters[index];
                                            var value = normalizedFilter[filter.field];
                                            value = (value ? value+"," : "")+ filter.value;
                                            normalizedFilter[filter.field] = value;                                   
                                        });
                                        $.extend(data, normalizedFilter);
                                        delete data.filter;
                                    }
                                    return data;
                                    
                                }else if(type === 'create'){                             
                                    return data;
                                    
                                }else if(type === 'update'){                                                                       
                                    return data;
                                    
                                }else if(type === 'destroy'){                                    
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id:"equipment_type_id",//το id πρέπει να ΜΗΝ ειναι μηδέν ή null (μέσα στo data)
                                fields:{
                                    equipment_type_id: {editable: false},
                                    equipment_type: { validation: { required: true, validationMessage:"Ξέχασες τον εξοπλισμό!" } },                                    
                                    items:{ type: "number", validation: { required: true, validationMessage:"Ξέχασες το πλήθος!", min: 1, max: 1000} }//,
                                    //lab:{editable: false},
                                    //lab_id: {editable: false}
                                }
                            }
                        },
                        requestEnd: function(e){
                            
                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div style='display:none' class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο νέος εξοπλισμός εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});                                    
                                }
                            }else if (e.type=="update"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός ενημερώθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η ενημέρωση εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){
                                inserted_computational_equipment=[];
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός διαγράφηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η διαγραφή εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }
                            }                            
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            confirmation: true,
                            window: {
                                width : "350px",
                                scrollable: false
                            }
                    },
                    scrollable: false,
                    columns: [
                        { field: "equipment_type", title: "εξοπλισμός", width: "82%", editor: computationalEquipmentDropDownEditor, template: "#=equipment_type#" },
                        { field: "items", title:"πλήθος", format: "{0:n0}", width: "10%"},
                        {   command: [{name: "edit", className: "btn btn-default btn-xs", text: ""}, {name: "destroy", className: "btn btn-default btn-xs", text: ""}],
                            title: "ενέργειες",
                            width: "8%"
                        }
                    ],
                    edit: function(e){
                        console.log("GRID EDIT EVENT! e", e);
                        
                        var inserted_computational_equipment_raw = e.sender._data;
                        $.each( inserted_computational_equipment_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_computational_equipment.push(item.equipment_type);
                        });
                        console.log("inserted_computational_equipment: ", inserted_computational_equipment);

                        if (e.model.isNew()) {
                            e.container.prev().find(".k-window-title").text("Προσθήκη Υπολογιστικού Εξοπλισμού");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }else{
                            $(e.container).find(".k-edit-form-container>div[data-container-for='equipment_type']").html(e.model.equipment_type);
                            e.container.prev().find(".k-window-title").text("Ενημέρωση Υπολογιστικού Εξοπλισμού");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Ενημέρωση");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }
                    },
                    cancel: function(e) {
                        inserted_computational_equipment=[];
                        console.log("inserted_computational_equipment: ", inserted_computational_equipment);
                    },
                    remove: function(e){
                        console.log("GRID REMOVE EVENT! ", e);
                        
                        var deletedItem = e.model.equipment_type;
                        console.log("deletedItem", deletedItem);
                        var inserted_computational_equipment_raw = e.sender._data;
                        $.each( inserted_computational_equipment_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_computational_equipment.push(item.equipment_type);
                        });
                        console.log("inserted_computational_equipment: ", inserted_computational_equipment);
                        var deletedItemIndex = inserted_computational_equipment.indexOf(deletedItem);
                        console.log("deletedItemIndex: ", deletedItemIndex);
                        inserted_computational_equipment.splice(deletedItemIndex, 1);                          

                        console.log("inserted_computational_equipment: ", inserted_computational_equipment);
                        
                        console.log("END OF GRID REMOVE EVENT!");
                    }           
                });
                var grid_tab_1_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#equipment_tab>#tabstrip>#tabstrip-1>#tab1>table>thead");
                grid_tab_1_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span><span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                grid_tab_1.data("kendoGrid").hideColumn(2);
                grid_tab_1.find("div.k-toolbar").hide();


                var grid_tab_2 = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").kendoGrid({
                    dataSource: {
                        //data: network_equipment_data,
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_equipment_types",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id,
                                    "equipment_category" : "2" 
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_equipment_types",
                                type: "POST",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema
                                    
                                },
                                dataType: "json"
                            },
                            update: {
                                url: "api/lab_equipment_types",
                                type: "PUT",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema
                                    
                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_equipment_types",
                                type: "DELETE",
                                data: {
                                    "lab_id": labData.lab_id
                                },
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {
                                
                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                               
                                        var normalizedFilter = {};
                                        $.each(data.filter.filters, function(index, value){
                                            var filter = data.filter.filters[index];
                                            var value = normalizedFilter[filter.field];
                                            value = (value ? value+"," : "")+ filter.value;
                                            normalizedFilter[filter.field] = value;                                   
                                        });
                                        $.extend(data, normalizedFilter);
                                        delete data.filter;
                                    }
                                    return data;
                                    
                                }else if(type === 'create'){
                                                                       
                                    return data;
                                    
                                }else if(type === 'update'){
                                                                       
                                    return data;
                                    
                                }else if(type === 'destroy'){
                                    
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "equipment_type_id",
                                fields:{
                                    equipment_type_id: { editable: false },
                                    equipment_type: { validation: { required: true, validationMessage:"Ξέχασες τον εξοπλισμό!" } },
                                    items:{ type: "number", validation: { required: true, validationMessage:"Ξέχασες το πλήθος!", min: 1, max: 1000} }                                
                                }
                            }
                        },
                        requestEnd: function(e){
                            
                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div style='display:none' class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο νέος εξοπλισμός εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});                                    
                                }
                            }else if (e.type=="update"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός ενημερώθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η ενημέρωση εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){
                                inserted_computational_equipment=[];
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός διαγράφηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η διαγραφή εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }
                            }
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            confirmation: true,
                            window: {
                                width : "350px",
                                scrollable: false
                            }
                    },
                    scrollable: false,
                    columns: [
                        { field: "equipment_type", title: "εξοπλισμός", width: "82%", editor: networkEquipmentDropDownEditor, template: "#=equipment_type#" },
                        { field: "items", title:"πλήθος", format: "{0:n0}", width: "10%"},
                        {   command: [{name: "edit", className: "btn btn-default btn-xs", text: ""}, {name: "destroy", className: "btn btn-default btn-xs", text: ""}],
                            title: "ενέργειες",
                            width: "8%"
                        }
                    ],
                    edit: function(e){
                
                        console.log("GRID EDIT EVENT! e", e);
                        
                        var inserted_network_equipment_raw = e.sender._data;
                        $.each( inserted_network_equipment_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_network_equipment.push(item.equipment_type);
                        });
                        console.log("inserted_network_equipment: ", inserted_network_equipment);

                        if (e.model.isNew()) {
                            e.container.prev().find(".k-window-title").text("Προσθήκη Δικτυακού Εξοπλισμού");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }else{
                            $(e.container).find(".k-edit-form-container>div[data-container-for='equipment_type']").html(e.model.equipment_type);
                            e.container.prev().find(".k-window-title").text("Ενημέρωση Δικτυακού Εξοπλισμού");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Ενημέρωση");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }
                    },
                    cancel: function(e) {
                        inserted_network_equipment=[];
                        console.log("inserted_network_equipment: ", inserted_network_equipment);
                    },
                    remove: function(e){

                        console.log("GRID REMOVE EVENT! ", e);
                        
                        var deletedItem = e.model.equipment_type;
                        console.log("deletedItem", deletedItem);
                        var inserted_network_equipment_raw = e.sender._data;
                        $.each( inserted_network_equipment_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_network_equipment.push(item.equipment_type);
                        });
                        console.log("inserted_network_equipment: ", inserted_network_equipment);
                        var deletedItemIndex = inserted_network_equipment.indexOf(deletedItem);
                        console.log("deletedItemIndex: ", deletedItemIndex);
                        inserted_network_equipment.splice(deletedItemIndex, 1);                          

                        console.log("inserted_network_equipment: ", inserted_network_equipment);
                        
                        console.log("END OF GRID REMOVE EVENT!");
                    }                    
                });
                var grid_tab_2_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2>table>thead");
                grid_tab_2_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span><span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                grid_tab_2.data("kendoGrid").hideColumn(2);
                grid_tab_2.find("div.k-toolbar").hide();

    
                var grid_tab_3 = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").kendoGrid({
                    dataSource: {
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_equipment_types",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id,
                                    "equipment_category" : "3" 
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_equipment_types",
                                type: "POST",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema

                                },
                                dataType: "json"
                            },
                            update: {
                                url: "api/lab_equipment_types",
                                type: "PUT",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema

                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_equipment_types",
                                type: "DELETE",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type":,
                                },
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {

                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                               
                                        var normalizedFilter = {};
                                        $.each(data.filter.filters, function(index, value){
                                            var filter = data.filter.filters[index];
                                            var value = normalizedFilter[filter.field];
                                            value = (value ? value+"," : "")+ filter.value;
                                            normalizedFilter[filter.field] = value;                                   
                                        });
                                        $.extend(data, normalizedFilter);
                                        delete data.filter;
                                    }
                                    return data;

                                }else if(type === 'create'){

                                    return data;

                                }else if(type === 'update'){

                                    return data;

                                }else if(type === 'destroy'){

                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "equipment_type_id",
                                fields:{
                                    equipment_type_id: { editable: false },
                                    equipment_type: { validation: { required: true, validationMessage:"Ξέχασες τον εξοπλισμό!"} },
                                    items:{ type: "number", validation: { required: true, validationMessage:"Ξέχασες το πλήθος!", min: 1, max: 1000} }
                                }
                            }
                        },
                        requestEnd: function(e){                  
                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div style='display:none' class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο νέος εξοπλισμός εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});                                    
                                }
                            }else if (e.type=="update"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός ενημερώθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η ενημέρωση εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){
                                inserted_computational_equipment=[];
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός διαγράφηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η διαγραφή εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }
                            }
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            confirmation: true,
                            window: {
                                width : "350px",
                                scrollable: false
                            }
                    },
                    scrollable: false,
                    columns: [
                        { field: "equipment_type", title: "εξοπλισμός", width: "82%", editor: peripheralDevicesDropDownEditor, template: "#=equipment_type#" },
                        { field: "items", title:"πλήθος", format: "{0:n0}", width: "10%"},
                        {   command: [{name: "edit", className: "btn btn-default btn-xs", text: ""}, {name: "destroy", className: "btn btn-default btn-xs", text: ""}],
                            title: "ενέργειες",
                            width: "8%"
                        }
                    ],
                    edit: function(e){
                
                        console.log("GRID EDIT EVENT! e", e);
                        
                        var inserted_peripheral_devices_raw = e.sender._data;
                        $.each( inserted_peripheral_devices_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_peripheral_devices.push(item.equipment_type);
                        });
                        console.log("inserted_peripheral_devices: ", inserted_peripheral_devices);

                        if (e.model.isNew()) {
                            e.container.prev().find(".k-window-title").text("Προσθήκη Περιφερειακής Συσκευής");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }else{
                            $(e.container).find(".k-edit-form-container>div[data-container-for='equipment_type']").html(e.model.equipment_type);
                            e.container.prev().find(".k-window-title").text("Ενημέρωση Περιφερειακής Συσκευής");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Ενημέρωση");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }
                    },
                    cancel: function(e) {
                        inserted_peripheral_devices=[];
                        console.log("inserted_peripheral_devices: ", inserted_peripheral_devices);
                    },
                    remove: function(e){

                        console.log("GRID REMOVE EVENT! ", e);
                        
                        var deletedItem = e.model.equipment_type;
                        console.log("deletedItem", deletedItem);
                        var inserted_peripheral_devices_raw = e.sender._data;
                        $.each( inserted_peripheral_devices_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_peripheral_devices.push(item.equipment_type);
                        });
                        console.log("inserted_peripheral_devices: ", inserted_peripheral_devices);
                        var deletedItemIndex = inserted_peripheral_devices.indexOf(deletedItem);
                        console.log("deletedItemIndex: ", deletedItemIndex);
                        inserted_peripheral_devices.splice(deletedItemIndex, 1);                          

                        console.log("inserted_peripheral_devices: ", inserted_peripheral_devices);
                        
                        console.log("END OF GRID REMOVE EVENT!");
                    }
                });    
                var grid_tab_3_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3>table>thead");
                grid_tab_3_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span><span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                grid_tab_3.data("kendoGrid").hideColumn(2);
                grid_tab_3.find("div.k-toolbar").hide();
               

                                                            // ======= AQUISITION SOURCES ======= //

                //labDetailRow.find(".lab-details-row").append(lab_blockquote_aquisition_sources);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id).append('<button id="edit_aquisition_sources" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>  επεξεργασία</button>');
                }
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id).append("<div id='aquisition_sources_grid'></div>");
                var aquisitionSourcesGrid = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").kendoGrid({
                    dataSource: {
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_aquisition_sources",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_aquisition_sources",
                                type: "POST",
                                data: {
                                    "lab_id": labData.lab_id 
                                },
                                dataType: "json"
                            },
                            update: {
                                url: "api/lab_aquisition_sources",
                                type: "PUT",
                                data: {
                                    "lab_id": labData.lab_id 
                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_aquisition_sources",
                                type: "DELETE",
                                data: {
                                    "lab_id": labData.lab_id 
                                },
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {

                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                               
                                        var normalizedFilter = {};
                                        $.each(data.filter.filters, function(index, value){
                                            var filter = data.filter.filters[index];
                                            var value = normalizedFilter[filter.field];
                                            value = (value ? value+"," : "")+ filter.value;
                                            normalizedFilter[filter.field] = value;                                   
                                        });
                                        $.extend(data, normalizedFilter);
                                        delete data.filter;
                                    }
                                    return data;

                                }else if(type === 'create'){
                                    console.log("aquisition_source CREATE: ", data);
                                    return data;

                                }else if(type === 'update'){
                                    return data;

                                }else if(type === 'destroy'){
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "lab_aquisition_source_id",
                                fields:{
                                    lab_aquisition_source_id: {editable: false},
                                    aquisition_source: { validation: { required: true, validationMessage:"ξέχασες τη χρηματοδότηση!" } },
                                    //aquisition_source_id:{editable: false},
                                    aquisition_year: { validation: { required: true, validationMessage:"ξέχασες το έτος χρηματοδότησης!" } },
                                    aquisition_comments:{}//,
                                    //lab:{editable: false},
                                    //lab_id: {editable: false}
                                }
                            }
                        },
                        requestEnd: function(e){                
                            if (e.type=="create"){
                                console.log("im in request end CREATE!!");
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").data("kendoGrid").dataSource.read();
                                                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η νέα πηγή χρηματοδότησης εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέας πηγής χρηματοδότησης απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});                                    
                                }
                            }else if (e.type=="update"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η πηγή χρηματοδότησης ενημερώθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η ενημέρωση της πηγής χρηματοδότησης απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){
                            
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η πηγή χρηματοδότησης διαγράφηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η διαγραφή της πηγής χρηματοδότησης απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }
                            }
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            confirmation: true,
                            window: {
                                width : "400px",
                                scrollable: false
                            }
                    },                        
                    scrollable: false,
                    columns:
                    [
                        { field: "aquisition_source", width: "20%", title: "πηγή χρηματοδότησης", editor : aquisitionSourcesDropDownEditor2, template: "#=aquisition_source#" },
                        { field: "aquisition_year", width: "20%", title: "χρονολογία", editor : aquisitionYearDropDownEditor2/*, template: "#=aquisition_year#" */},
                        { field: "aquisition_comments", width: "55%", title: "σχόλια", editor : commentsTextAreaEditor/*, template: "#=aquisition_comments#" */},
                        { command: [{name: "edit", className: "btn btn-default btn-xs", text: ""}, {name: "destroy", className: "btn btn-default btn-xs", text: ""}],
                            title: "ενέργειες",
                            width: "8%"
                        }
                    ],                        
                    sortable: {
                        allowUnsort: false
                    },
                    edit: function(e){               
                        console.log("GRID EDIT EVENT! e", e);
                        if (e.model.isNew()) {
                            e.container.prev().find(".k-window-title").text("Προσθήκη Πηγής Χρηματοδότησης");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }else{
                            $(e.container).find(".k-edit-form-container>div[data-container-for='aquisition_source']").html(e.model.aquisition_source);
                            e.container.prev().find(".k-window-title").text("Ενημέρωση Πηγής Χρηματοδότησης");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Ενημέρωση");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }
                    }
                });                
                var aquisitionSourcesGrid_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid>table>thead");
                aquisitionSourcesGrid_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span><span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                aquisitionSourcesGrid.data("kendoGrid").hideColumn(3);
                aquisitionSourcesGrid.find("div.k-toolbar").hide();
                
                                                            // ======= RESPONSIBLES =======//
                                                            
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_responsible);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id).append('<button id="edit_responsibles" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> επεξεργασία</button>');
                }
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id).append("<div id='lab_worker_grid'></div>");
                var labWorkerGrid = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").kendoGrid({
                    dataSource: {
                        //data: lab_worker_array,
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_workers",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id,
                                    "worker_position": 2,
                                    "worker_status": 1
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_workers",
                                type: "POST",
                                data: {
//                                    "lab": labData.lab_id,
//                                    "worker_position": 2,
//                                    "worker_status": 1
                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_workers",
                                type: "PUT",
                                data: {},
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {
                                
                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                           
                                        var normalizedFilter = {};
                                        $.each(data.filter.filters, function(index, value){
                                            var filter = data.filter.filters[index];
                                            var value = normalizedFilter[filter.field];
                                            value = (value ? value+"," : "")+ filter.value;
                                            normalizedFilter[filter.field] = value;                                   
                                        });
                                        $.extend(data, normalizedFilter);
                                        delete data.filter;
                                    }
                                    return data;
                                    
                                }else if(type === 'create'){
                                    
                                    data["lab_id"]= labData.lab_id;
                                    data["worker_position"]= 2;
                                    data["worker_status"]= 1;
                                    
                                    var selectedLabWorker = $("#edit_lab_worker").data("kendoAutoComplete");//._old;
                                    console.log("selectedLabWorker ", selectedLabWorker);
                                    //data["lab_worker"] = selectedLabWorker.split(" ").pop();                                    
                                    
                                    data["worker_id"] = data.edit_lab_worker.worker_id;
                                    data["worker_start_service"] = data.edit_worker_start_service;
                                    
                                    delete data.edit_lab_worker;
                                    delete data.edit_worker_start_service;
                                    //console.log("data", data);
                                    
                                    return data;
                                    
                                }else if(type === 'destroy'){
                                    
                                    //data["lab_worker_id"] = 
                                    data["worker_status"]= 3;
                                    
                                    //console.log("data", data);
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "lab_id",
                                fields:{
                            
                                    lab_worker_id:{editable: false},
                                    lab_id: { editable: false },
                                    worker_id:{editable: false},
                                    worker_position:{editable: false},
                                    worker_status:{editable: false},
                                    edit_worker_start_service:{editable: false},
                                    //edit_lab_worker:{editable: false},
                                    
                                    lastname:{editable: false},
                                    firstname:{editable: false},
                                    fathername:{editable: false},
                                    registry_no:{editable: false},
                                    specialization_code:{editable: false}
                                }
                            }
                        },
                        requestEnd: function(e){

                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο νέος υπεύθυνος εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου υπευθύνου απέτυχε. Παρακαλώ ξαναδοκιμάστε</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){                               
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο υπεύθυνος αποδεσμεύτηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η αποδέσμευση του υπευθύνου απέτυχε. Παρακαλώ ξαναδοκιμάστε</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">div.alert").remove();});
                                }
                            }

                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            template: kendo.template($("#popup_responsible_editor").html()),
                            confirmation: true,
                            window: {
                                width : "400px",
                                scrollable: false
                            }
                    },                        
                    scrollable: false,
                    columns: [{
                            field: "lastname",
                            template: "#= lastname + ' ' + firstname #",
                            title:"ονοματεπώνυμο"
                        },
                        {
                            field: "fathername",
                            title:"πατρώνυμο"
                        },
                        {
                            field: "registry_no",
                            title: "αρ. μητρώοου"
                        },
                        {
                            field: "specialization_code",
                            title: "κλάδος"
                        },
                        {
                            field: "worker_start_service",
                            title: "ημ. ανάληψης ευθύνης"
                        },
                        {   command: [{name: "destroy", className: "btn btn-default btn-xs", text: ""}], //,{name: "edit", className: "btn btn-default btn-xs", text: ""}
                            title: "ενέργειες",
                            width: "4%"
                        }],                        
                    sortable: {
                        allowUnsort: false
                    },
                    edit: function(e){
                        console.log("GRID EDIT EVENT! e", e);

                        $("#edit_lab_worker").kendoAutoComplete({
                          dataSource: labWorkersDS,
                          dataTextField: "fullname",
                          placeholder: "επιλογή νέου υπευθύνου ...",
                          template: "<div class='labWorkersTemplate'>\
                                          <span class='template_fullname'> #= lastname + ' ' + firstname #</span>\
                                          <div class='template_details'>\
                                              <span> ΑΜ </span>\
                                              <span class='template_data'> #= registry_no # </span>\
                                          </div>\
                                      <div>",
                          minLength: 3,
                          change: function(e){
                                           
                              console.log("change event e: ", e);
                              var lab_worker_userInput = this.value();
                              console.log("η τιμή του autocomplete: ", lab_worker_userInput);
                              var labWorkers = labWorkersDS.data();

                              var validResponsible=false;
                              $.each( labWorkers, function( index, selectedLabResponsible ) {
                                  if (selectedLabResponsible.registry_no == lab_worker_userInput.split(" ").pop()){
                                      validResponsible = true;
                                      return false;
                                  }
                              });
                              if(!validResponsible){
                                  //editBtn.closest(".edit_lab").next().last().append('<span class="edit_failure_msg">Ο υπεύθυνος που εισήχθηκε δεν υπάρχει</span>');
                                  //console.log("lab responsible input '" + lab_worker_userInput + "' is not a valid one");
                                  this.value('');
                              }
                          }
                        });
                        $("#edit_lab_worker").parent().attr("style", "width: 265px;"); /*margin: 20px 10px 0px 20px*/
                        
                        $("#edit_worker_start_service").kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now()),//kendo.toString(new Date(Date.now()), "yyyy-mm-dd"),
                            change: function() {
                                var date = kendo.toString(this.value(),  "yyyy-MM-dd");
                                console.log("η τιμή του date picker: ", date); //value is the selected date in the datepicker
                                e.model.edit_worker_start_service = date;
                                return date;
                            }
                        });

                        e.container.prev().find(".k-window-title").text("Προσθήκη Νέου Υπευθύνου");
                        e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                        e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                    }
                });                
                var labWorkerGrid_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid>table>thead");
                labWorkerGrid_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>'); //<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span>
                labWorkerGrid.data("kendoGrid").hideColumn(5);
                labWorkerGrid.find("div.k-toolbar").hide();
                
                                                            // ======= RELATIONS =======//              
                
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_relations);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id).append('<button id="edit_relations" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> επεξεργασία</button>');
                }
                //var relations = ( labData.lab_relations !== null) ? labData.lab_relations : new Array();
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id).append("<div id='lab_relations_grid'></div>");
                var labRelationsGrid = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").kendoGrid({
                    dataSource: {
                        //data: lab_worker_array,
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_relations",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_relations",
                                type: "POST",
                                data: {},
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_relations",
                                type: "DELETE",
                                data: {},
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {
                                
                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                     
                                        var normalizedFilter = {};
                                        $.each(data.filter.filters, function(index, value){
                                            var filter = data.filter.filters[index];
                                            var value = normalizedFilter[filter.field];
                                            value = (value ? value+"," : "")+ filter.value;
                                            normalizedFilter[filter.field] = value;                                   
                                        });
                                        $.extend(data, normalizedFilter);
                                        delete data.filter;
                                    }
                                    return data;
                                    
                                }else if(type === 'create'){
                                                                        
                                    var selectedRelationType =  $("#edit_relation_type").data("kendoComboBox")._old;
                                    var selectedSchoolUnit =  $("#edit_school_unit").data("kendoAutoComplete")._old;
                                    var selectedCircuit =  $("#edit_circuit").data("kendoComboBox")._old;
                                    
                                    data["lab_id"]= labData.lab_id;
                                    data["school_unit"]= selectedSchoolUnit;
                                    data["relation_type"]= selectedRelationType;
                                    data["circuit_id"]= selectedCircuit;
                                    
                                    
                                    if(selectedRelationType == "ΕΞΥΠΗΡΕΤΕΙ ΥΠΗΡΕΣΙΑΚΑ"){
                                        delete data.circuit_id;
                                    }
                                        
                                    delete data.edit_circuit;
                                    delete data.edit_school_unit;
                                    delete data.edit_relation_type;
                                    
                                    return data;
                                    
                                }else if(type === 'destroy'){
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "lab_relation_id",//"lab_id",
                                fields:{
                                    circuit_id:{editable: false},
                                    circuit_phone_number:{},
                                    lab_id:{editable: false},
                                    lab_name:{editable: false},
                                    lab_relation_id:{editable: false},
                                    relation_type_id:{editable: false},
                                    relation_type_name:{},
                                    school_unit:{},
                                    school_unit_id:{editable: false}
                                }
                            }
                        },
                        requestEnd: function(e){

                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η νέα συσχέτιση εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου συσχέτισης απέτυχε. Παρακαλώ ξαναδοκιμάστε</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){                               
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η συσχέτιση καταργήθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η κατάργηση της συσχέτισης απέτυχε. Παρακαλώ ξαναδοκιμάστε</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">div.alert").remove();});
                                }
                            }
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            template: kendo.template($("#popup_relations_editor").html()),
                            confirmation: true,
                            window: {
                                width : "400px",
                                scrollable: false
                            }
                    },
                    scrollable: false,
                    columns: [{field: "relation_type_name", title:"συσχέτιση"},
                              {field: "school_unit", title: "Σχολική Μονάδα"},
                              {field: "circuit_phone_number", title: "αρ. κυκλωματος"},
                              {   command: [{name: "destroy", className: "btn btn-default btn-xs", text: ""}], //,{name: "edit", className: "btn btn-default btn-xs", text: ""}
                                  title: "ενέργειες",
                                  width: "4%"
                              }],
                    sortable: {
                        allowUnsort: false
                    },
                    edit: function(e){

                        $("#edit_relation_type").kendoComboBox({
                            autoBind: false,
                            dataTextField: "name",
                            dataValueField: "name",
                            placeholder: "επιλογή συσχέτισης ...",
                            dataSource: {
                                //serverFiltering: true,
                                transport: {
                                    read: {
                                        url: "api/relation_types",
                                        type: "GET",
                                        data: {},
                                        dataType: "json"
                                    }
                                },
                                schema: {
                                    model : {
                                        id : "relation_type_id",
                                        fields:{
                                            name: {editable: false},
                                            relation_type_id: {editable:false},
                                            invisible: {editable:false}
                                        }
                                    },
                                    data: function(response) {
                                            var schoolUnitAlreadyServed=false;
                                            var relationsGridData = labRelationsGrid.data("kendoGrid")._data;
                                            $.each( relationsGridData, function( index, selectedRelation ) {
                                                if (selectedRelation.relation_type_id == 1){
                                                    schoolUnitAlreadyServed = true;
                                                    return false; //exit each
                                                }
                                            });
                                            
                                            if(schoolUnitAlreadyServed){
                                                for (var i = 0; i < response.data.length; ++i) {
                                                    if (response.data[i].relation_type_id == 1) response.data[i].invisible = 1;
                                                }
                                            }

                                            return response.data;
                                    },
                                    total: "total"
                                },
                                filter: { field: "invisible", operator: "neq", value: 1 }
                            },
                            change: function(e){                             
                                var userInput = this.value();
                                var relations = e.sender.dataSource._data;
                                //console.log("relations", relations);
                                //console.log("userInput", userInput);
                                
                                validRelation=false;
                                $.each( relations, function( index, selectedRelation ) {
                                    if (selectedRelation.name == userInput){
                                        validRelation = true;
                                        return false;
                                    }
                                });
                                if(!validRelation){
                                    console.log("relation input '" + userInput + "' is not a valid one");
                                    this.value('');                                    
                                }
                                
                                // enable/disable circuit input and corresponding validation tooltip
                                if(userInput === "ΕΞΥΠΗΡΕΤΕΙΤΑΙ ΔΙΑΔΙΚΤΥΑΚΑ"){
                                    $("#edit_circuit").data("kendoComboBox").enable();
                                    $("#edit_circuit").attr("required","");
                                    $("#edit_circuit").attr("data-required-msg","ξέχασες τον αριθμό κυκλώματος!");                                    
                                }else{
                                    $("#edit_circuit").data("kendoComboBox").value("");
                                    $("#edit_circuit").data("kendoComboBox").enable(false);
                                    $("#edit_circuit").removeAttr("required");
                                    $("#edit_circuit").removeAttr("data-required-msg");
                                    $("#edit_circuit").next(".k-tooltip-validation").hide();
                                }
                            }
                        });
                        
                        $("#edit_school_unit").kendoAutoComplete({
                            autoBind: false,
                            dataTextField: "name",
                            placeholder: "επιλογή Σχολικής Μονάδας ...",
                            minLength: 3,
                            dataSource: {
                                  serverFiltering: true,
                                  transport: {
                                      read: {
                                          url: "api/school_units",
                                          type: "GET",
                                          data: {},
                                          dataType: "json"
                                      },
                                      parameterMap: function(data, type) {
                                          if (type === 'read') {
                                              if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                               
                                                  var normalizedFilter = {};
                                                  $.each(data.filter.filters, function(index, value){
                                                      var filter = data.filter.filters[index];
                                                      var value = normalizedFilter[filter.field];
                                                      value = (value ? value+"," : "")+ filter.value;
                                                      normalizedFilter[filter.field] = value;                                   
                                                  });
                                                  $.extend(data, normalizedFilter);
                                                  delete data.filter;
                                              }
                                              return data;

                                          }
                                      }
                                  },
                                  schema: {
                                      data: "data",
                                      total: "total",
                                      model:{
                                          id: "name"
                                      }
                                  }
                              },
                            change: function(e){

                                    var userInput = this.value();
                                    var schoolUnits = e.sender.dataSource._data;

                                    validUnit=false;
                                    $.each( schoolUnits, function( index, selectedSchoolUnit ) {
                                        if (selectedSchoolUnit.name == userInput){
                                            validUnit = true;
                                            return false;
                                        }
                                    });
                                    if(!validUnit){
                                        console.log("school unit input '" + userInput + "' is not a valid one");
                                        this.value('');                                    
                                    }
                                    
                                    $("#edit_circuit").data("kendoComboBox").value("");
                                    //$("#edit_circuit").data("kendoComboBox").dataSource.read();
                                }
                        });
                        
                        $("#edit_circuit").kendoComboBox({                 
                            autoBind: false,
                            dataTextField: "fulltemplate",
                            dataValueField: "circuit_id",
                            template: "#= relation_type_name # (αρ.κυκλ. #= phone_number #)",
                            placeholder: "επιλογή κυκλώματος ...",
                            //filter: "contains",
                            dataSource: {
                                transport: {
                                    read: {
                                        url: "api/circuits",
                                        type: "GET",
                                        data: {
                                            //school_unit:
                                        },
                                        dataType: "json"
                                    },
                                    parameterMap: function(data, type) {
                                        if (type === 'read') {
                                            if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                               
                                                var normalizedFilter = {};
                                                $.each(data.filter.filters, function(index, value){
                                                    var filter = data.filter.filters[index];
                                                    var value = normalizedFilter[filter.field];
                                                    value = (value ? value+"," : "")+ filter.value;
                                                    normalizedFilter[filter.field] = value;                                   
                                                });
                                                $.extend(data, normalizedFilter);
                                                delete data.filter;
                                            }
                                            if ( $("#edit_school_unit").data("kendoAutoComplete").value() != ""){
                                                data["school_unit"] = $("#edit_school_unit").data("kendoAutoComplete").value();
                                            }
                                            return data;

                                        }
                                    }
                                },
                                serverFiltering: true,
                                schema: {
                                    data: function(response) {
                                            console.log(response);
                                            for (var i = 0; i < response.data.length; ++i) {
                                                response.data[i].fulltemplate = response.data[i].relation_type_name + " (αρ. κυκλ. " + response.data[i].phone_number + ")";
                                            }
                                            return response.data;
                                    },
                                    total: "total",
                                    model:{
                                        id: "name"
                                    }
                                }
                            },
                            change: function(e){
                                var userInput = this.value();
                                console.log("userInput: ", userInput);
                                var circuit = e.sender.dataSource._data;

                                validCircuit=false;
                                $.each( circuit, function( index, selectedCircuit ) {
                                    if (selectedCircuit.circuit_id == userInput){
                                        validCircuit = true;
                                        return false;
                                    }
                                });
                                if(!validCircuit){
                                    console.log("circuit input '" + userInput + "' is not a valid one");
                                    this.value('');                                    
                                }
                            }
                        });
                        $("#edit_circuit").data("kendoComboBox").enable(false);

                        e.container.prev().find(".k-window-title").text("Προσθήκη Νέας Συσχέτισης");
                        e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                        e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                    }
                });
                var labRelationsGrid_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid>table>thead");
                labRelationsGrid_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                labRelationsGrid.data("kendoGrid").hideColumn(3);
                labRelationsGrid.find("div.k-toolbar").hide();

                                                            // ======= TRANSITIONS =======//
                
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_transitions);
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_transitions_tab_id).append("<div id='lab_transitions_grid'></div>");
                var labTransitionsGrid = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_transitions_tab_id+">#lab_transitions_grid").kendoGrid({
                    //dataSource: transitions,
                    dataSource: {
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_transitions",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id
                                },
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {
                                
                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                     
                                        var normalizedFilter = {};
                                        $.each(data.filter.filters, function(index, value){
                                            var filter = data.filter.filters[index];
                                            var value = normalizedFilter[filter.field];
                                            value = (value ? value+"," : "")+ filter.value;
                                            normalizedFilter[filter.field] = value;                                   
                                        });
                                        $.extend(data, normalizedFilter);
                                        delete data.filter;
                                    }
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total"
                        }
                    },
                    scrollable: false,
                    columns: [{
                            field: "from_state",
                            title:"προηγούμενη κατάσταση"
                        },
                        {
                            field: "to_state",
                            title: "παρούσα κατάσταση"
                        },
                        {
                            field: "transition_date",
                            title: "ημερομηνία μετάβασης"
                        },
                        {
                            field: "transition_justification",
                            title: "αιτιολογία μετάβασης"
                        },
                        {
                            field: "transition_source",
                            title: "πηγή μετάβασης"
                        }],
                    sortable: {
                        allowUnsort: false
                    }
                });
                
                
                                                            // ======= GENERAL =======//
                
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_general);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+general_tab_id).append('<button id="edit_general" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> επεξεργασία</button>');
                }

                var special_name = (labData.special_name != null) ? labData.special_name : "-- δεν έχει οριστεί ειδικό όνομα για τη Διάταξη Η/Υ --";
                var positioning = (labData.positioning != null) ? labData.positioning : "-- δεν έχει οριστεί τοποθεσία για τη Διάταξη Η/Υ --";
                var creation_date = (labData.lab_transitions[0].transition_date != null) ? labData.lab_transitions[0].transition_date : "-- δεν έχει οριστεί ημερομηνία δημιουργίας για τη Διάταξη Η/Υ --";
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+general_tab_id).append('<div id="general_info">\
                                                                                <div class="general_info_item2"><div class="full_label"><span class="glyphicon glyphicon-tag"></span><span class="general_info_label"> Ειδική Ονομασία</span></div><div class="full_data"><span class="general_info_data">' + special_name + '</span></div></div>\
                                                                                <div class="general_info_item1"><div class="full_label"><span class="glyphicon glyphicon-map-marker"></span><span class="general_info_label"> Τοποθεσία</span></div><div class="full_data"><span class="general_info_data">' + positioning + '</span></div></div>\
                                                                                <div class="general_info_item3"><div class="full_label"><span class="glyphicon glyphicon-calendar"></span><span class="general_info_label"> Ημερομηνία Δημιουργίας</span></div><div class="full_data"><span class="general_info_data">' + creation_date + '</span></div></div>\
                                                                             </div>');
    
    
                                                                // ======= RATING =======//
                                                                
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_rating);
                if(labData.state_id != 2 && labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id).append('<button id="edit_rating" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> επεξεργασία</button>');                
                }
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id).append('<div id="rating_info">\
                                                                                <div class="oRating_info_item"><div class="rating_label"><span class="glyphicon glyphicon-star"></span><span class="general_info_label"> Λειτουργικός Δείκτης </span></div><div class="rating_data"><div id="oRating" class="general_info_data"></div></div></div>\
                                                                                <div class="tRating_info_item"><div class="rating_label"><i class="fa fa-lightbulb-o"></i>\<span class="general_info_label"> Τεχνολογικός Δείκτης </span></div><div class="rating_data"><div id="tRating" class="general_info_data"></div></div></div>\
                                                                             </div>');

                (labData.operational_rating !== null) ? labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id+">#rating_info>.oRating_info_item>.rating_data>#oRating").raty({ readOnly: true, score: labData.operational_rating, path: 'client/img/raty' }) : labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id+">#rating_info>.oRating_info_item>.rating_data>#oRating").raty({ readOnly: true, score: 0, path: 'client/img/raty' });
                (labData.technological_rating !== null) ? labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id+">#rating_info>.tRating_info_item>.rating_data>#tRating").raty({ readOnly: true, score: labData.technological_rating, starOff: 'off.png', starOn: 'on.png', path: 'client/img/raty' }) : labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id+">#rating_info>.tRating_info_item>.rating_data>#tRating").raty({ readOnly: true, score: 0, starOff: 'off.png', starOn: 'on.png', path: 'client/img/raty' });
                
            }; 
            
            $("#views-bar-buttons button").click(function() {
                
                target_view = parseInt($(this).data("index"));               
        
                if (target_view === index_view) {
                    return;
                }
                
                $(this).addClass("viewButtonIsSelected");
                $(this).siblings().removeClass("viewButtonIsSelected");
                
                $("#view" + target_view).show();
                $("#view" + index_view).hide();
        
                index_view = target_view;
            });    

        });

     </script>
     
</head>

<body>

<?php include "navigation-bar.php" ?>
<?php include "home-search.php" ?>
<?php include "views-bar.php" ?>
    
    <!--general container-->
    <div id="general-container" class="container">        
        <div class="row">          
            <div class="col-md-12">
                <div id="view0" class="k-grid">  <!-- id="school-units-grid"-->
                    <script type="text/x-kendo-template" id="details-row-template">
                            <div class="details-row k-splitter">
                                <div class=" alert-msg alert alert-success" style="display:none"> Η Διάταξη Η/Υ δημιουργήθηκε επιτυχώς </div>
                                <div class=" alert-msg alert alert-danger" style="display:none"> Η δημιουργία της Διάταξης Η/Υ απέτυχε </div>
                                <div id="school-unit-details"></div>
                                <div id="labs-summary"></div>

                                <div id="labs-grid" class="k-grid">
                                    <script type="text/x-kendo-template" id="lab-details-row-template">
                                        <div class="lab-details-row k-splitter"></div>
                                    </script>
                                </div>
                            </div>
                    </script>                            
                </div>
                <?php include "view-labs.php" ?>
                <?php include "view-lab-workers.php" ?>        
<!--                <div id="view1" class="k-grid" style="display: none"> sdkugwhirughwireguwjerg </div>
                <div id="view2" class="k-grid" style="display: none"> eufgwieufgwieufgwieufw </div>-->
            </div>

    
    <!--in this div the activation window will be placed-->
    <div id="activate_dialog"></div>
    
    <!-- activate lab template -->
    <script id="activate_template" type="text/x-kendo-template">
        <form id="lab_activation" class="k-edit-form-container">
                <div class="form-horizontal form-widgets col-md-11"> 

                    <div class="form-group">
                        <label for="activate_transition_date" class="col-md-3 required">Ημερομηνία ενεργοποίησης λειτουργίας</label>
                        <div class="col-md-6 widget">
                            <input id="activate_transition_date" name="activate_transition_date" data-bind="value:activate_transition_date" required validationMessage='ξέχασες την ημ/νία ενεργοποίησης!'/>
                            <span class="k-invalid-msg" data-for="activate_transition_date"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="activation_justification" class="col-md-3 required">Αιτιολογία ενεργοποίησης λειτουργίας</label>
                        <div class="col-md-6 widget">
                            <textarea id="activation_justification" class="k-textbox col-md-12" name="activation_justification" data-bind="value:activation_justification" required validationMessage='ξέχασες την αιτιολογία ενεργοποίησης!' style="width:260px;height:100px"></textarea>
                        </div>                     
                    </div>

                </div>

                <div class="k-edit-buttons k-state-default">
                    <a class="k-button k-button-icontext k-grid-click-activate" href='\#'>Ενεργοποίηση</a>
                    <a class="k-button k-button-icontext k-grid-click-cancel-activation" href='\#'>Άκυρο</a>
                    <a class="k-button k-button-icontext k-grid-click-close-activation" style="display:none" href='\#'>Κλείσιμο</a>
                </div>
        </form>
    </script>
    
    
    <!-- in this div the suspension window will be placed-->
    <div id="suspend_dialog"></div>
    
    <!-- suspend lab template -->
    <script id="suspend_template" type="text/x-kendo-template">
        <form id="lab_suspension" class="k-edit-form-container">
                <div class="form-horizontal form-widgets col-md-11"> 

                    <div class="form-group">
                        <label for="suspend_transition_date" class="col-md-3 required">Ημερομηνία αναστολής λειτουργίας</label>
                        <div class="col-md-6 widget">
                            <input id="suspend_transition_date" name="suspend_transition_date" data-bind="value:suspend_transition_date" required validationMessage='ξέχασες την ημ/νία αναστολής!'/>
                            <span class="k-invalid-msg" data-for="suspend_transition_date"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="suspension_justification" class="col-md-3 required">Αιτιολογία αναστολής λειτουργίας</label>
                        <div class="col-md-6 widget">
                            <textarea id="suspension_justification" class="k-textbox col-md-12" name="suspension_justification" data-bind="value:suspension_justification" required validationMessage='ξέχασες την αιτιολογία αναστολής!' style="width:260px;height:100px"></textarea>
                        </div>                     
                    </div>

                </div>

                <div class="k-edit-buttons k-state-default">
                    <a class="k-button k-button-icontext k-grid-click-suspend" href='\#'>Αναστολή</a>
                    <a class="k-button k-button-icontext k-grid-click-cancel-suspension" href='\#'>Άκυρο</a>
                    <a class="k-button k-button-icontext k-grid-click-close-suspension" style="display:none" href='\#'>Κλείσιμο</a>
                </div>
        </form>
    </script>
       
    <!--in this div the abolishment window will be placed-->
    <div id="abolish_dialog"></div>
    
    <!-- abolish lab template -->
    <script id="abolish_template" type="text/x-kendo-template">
        <form id="lab_abolishment" class="k-edit-form-container">
                <div class="form-horizontal form-widgets col-md-11"> 

                    <div class="form-group">
                        <label for="abolish_transition_date" class="col-md-3 required">Ημερομηνία κατάργησης λειτουργίας</label>
                        <div class="col-md-6 widget">
                            <input id="abolish_transition_date" name="abolish_transition_date" data-bind="value:abolish_transition_date" required validationMessage='ξέχασες την ημ/νία κατάργησης!'/>
                            <span class="k-invalid-msg" data-for="abolish_transition_date"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="abolishment_justification" class="col-md-3 required">Αιτιολογία κατάργησης λειτουργίας</label>
                        <div class="col-md-6 widget">
                            <textarea id="abolishment_justification" class="k-textbox col-md-12" name="abolishment_justification" data-bind="value:abolishment_justification" required validationMessage='ξέχασες την αιτιολογία κατάργησης!' style="width:260px;height:100px"></textarea>
                        </div>                     
                    </div>

                </div>

                <div class="k-edit-buttons k-state-default">
                    <a class="k-button k-button-icontext k-grid-click-abolish" href='\#'>Κατάργηση</a>
                    <a class="k-button k-button-icontext k-grid-click-cancel-abolishment" href='\#'>Άκυρο</a>
                    <a class="k-button k-button-icontext k-grid-click-close-abolishment" style="display:none" href='\#'>Κλείσιμο</a>
                </div>
        </form>
    </script>    
    
    <!-- create lab responsible template-->
    <script id="popup_responsible_editor" type="text/x-kendo-template">
        <div class="form-horizontal form-widgets col-md-11">       
            <div class='form-group'>
                <label for='edit_lab_worker' class='control-label col-md-2'>Υπεύθυνος</label>       
                <div class="col-md-8 widget">
                    <input id='edit_lab_worker' name='edit_lab_worker' data-bind="value:edit_lab_worker"  required validationMessage='ξέχασες τον υπεύθυνο!'/>
                </div>
            </div>

            <div class='form-group'>
                <label for='edit_worker_start_service' class='control-label col-md-2'>Ημερομηνία ανάληψης ευθύνης</label>       
                <div class="col-md-8 widget">
                    <input id="edit_worker_start_service" name="edit_worker_start_service" data-bind="value:edit_worker_start_service"  required validationMessage='ξέχασες την ημ/νία ανάληψης ευθύνης!' />
                </div>
            </div>
        </div>
    </script>
    
    <!-- create relations template-->
    <script id="popup_relations_editor" type="text/x-kendo-template">
        <div class="form-horizontal form-widgets col-md-11">       
            <div class='form-group'>
                <label for='edit_relation_type' class='control-label col-md-2'>Τύπος Συσχέτισης</label>       
                <div class="col-md-8 widget">
                    <input id='edit_relation_type' name='edit_relation_type' data-bind="value:edit_relation_type" required validationMessage='ξέχασες τον τύπο συσχέτισης!'/>
                </div>
            </div>

            <div class='form-group'>
                <label for='edit_school_unit' class='control-label col-md-2'>Σχολική Μονάδα</label>       
                <div class="col-md-8 widget">
                    <input id="edit_school_unit" name="edit_school_unit" data-bind="value:edit_school_unit" required validationMessage='ξέχασες τη Σχολική Μονάδα!'  />
                </div>
            </div>

            <div class='form-group'>
                <label for='edit_circuit' class='control-label col-md-2'>Κύκλωμα</label>       
                <div class="col-md-8 widget">
                    <input id="edit_circuit" name="edit_circuit" data-bind="value:edit_circuit"  />
                </div>
            </div>
        </div>
    </script>
    
    <!-- create lab template-->
    <script id="popup_editor" type="text/x-kendo-template">

    <div class="form-horizontal form-widgets col-md-11">

        <div class='form-group'>
            <label for="lab_type" class="control-label col-md-3 required">Τύπος <span style="color:red">*</span></label>
            <div class="col-md-6 widget">
                <input id="popupLabType" name="lab_type" required data-required-msg="το πεδίο τύπος Διάταξης Η/Υ ειναι υποχρεωτικό"/>
            </div>
        </div>

        <div class='form-group'>
            <label for='lab_worker' class='control-label col-md-3'>
                <span id="tooltip_responsible" class="glyphicon glyphicon-info-sign"> </span> Υπεύθυνος <span class='required_field' style="color:red"></span>
            </label>
            <div class="col-md-6 widget">
                    <input id='labWorkerRegistryNo' name='lab_worker' required validationMessage='το πεδίο υπεύθυνος Διάταξης Η/Υ ειναι υποχρεωτικό'/>
                    <span class="k-invalid-msg" data-for="lab_worker"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="worker_start_service" class="col-md-3 required">
                <span id="tooltip_worker_start_service" class="glyphicon glyphicon-info-sign"></span>Ημερομηνία ανάληψης ευθύνης <span class='required_field' style="color:red"></span>
            </label>
            <div class="col-md-6 widget">
                <input id="worker_start_service" name="worker_start_service" required validationMessage='το πεδίο ημερομηνία ανάληψης ευθύνης ειναι υποχρεωτικό' data-bind="value:worker_start_service"/>
            </div>                        
        </div>

    </div>

    <div class="form-horizontal form-widgets col-md-11">

        <div class='form-group'>
            <label for="relation_served_service" class="col-md-3">
                <span id="tooltip_relation_served_service" class="glyphicon glyphicon-info-sign"></span> Εξυπηρετεί υπηρεσιακά
            </label>
            <div class="col-md-6 widget">
                <select id="create_relation_served_service" name='relation_served_service' multiple="multiple"></select>
            </div>
        </div>

        <div class='form-group'>
            <label for="relation_served_online" class="col-md-3 required">
                <span id="tooltip_relation_served_online" class="glyphicon glyphicon-info-sign"> </span> Εξυπηρετείται διαδικτυακά <span class='required_field' style="color:red"></span>
            </label>
            <div class="col-md-6 widget">
                <input id='create_relation_served_online' name='relation_served_online' required data-required-msg='το πεδίο εξυπηρετείται διαδικτυακά ειναι υποχρεωτικό'/>
            </div>
        </div>

        <div class="form-group">
            <label for="positioning" class="col-md-3">
                <span id="tooltip_positioning" class="glyphicon glyphicon-info-sign"></span> Tοποθεσία
            </label>
            <div class="col-md-6 widget">
                <textarea class="k-textbox col-md-12" name="positioning" data-bind="value:positioning"></textarea>
            </div>                        
        </div>

        <div class="form-group">
            <label for="special_name" class="col-md-3">
                <span id="tooltip_special_name" class="glyphicon glyphicon-info-sign"></span> Ειδικό Όνομα
            </label>
            <div class="col-md-6 widget">
                <input id="special_name" class="k-textbox col-md-12" name="special_name" data-bind="value:special_name"/>
            </div>                        
        </div>

    </div>

    <div class="clearfix"></div>

    <div class="form-horizontal form-widgets col-md-11">
        <div class="form-group">
            <label for="equipment_types" class="control-label col-md-3">
                <span id="tooltip_equipment" class="glyphicon glyphicon-info-sign"></span> Εξοπλισμός
            </label>    
            <div class="col-md-7">
                <div id="popup_equipment"></div>
            </div>            
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="form-horizontal form-widgets col-md-11">
        <div class="form-group">
            <label for="aquisition_sources" class="control-label col-md-3">
                <span id="tooltip_aquisition_sources" class="glyphicon glyphicon-info-sign"></span> Πηγή Χρηματοδότησης
            </label>
            <div class="col-md-7">
                <div id="popup_aquisition_sources"></div>
            </div>            
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="form-horizontal form-widgets col-md-11">
        <div class="form-group">    
            <label for="popup_operational_rating" class="col-md-3 required"><span id="tooltip_operational_rating" class="glyphicon glyphicon-info-sign"></span> λειτουργική βαθμολογία</label>
            <div class="col-md-3 widget">
                <select name="popup_operational_rating" id="popup_operational_rating" multiple="multiple"/></select>
            </div>
        </div>
        <div class="form-group">
            <label for="popup_technological_rating" class="col-md-3 required"><span id="tooltip_technological_rating" class="glyphicon glyphicon-info-sign"></span> τεχνολογική βαθμολογία</label>
            <div class="col-md-3 widget">
                <select name="popup_technological_rating" id="popup_technological_rating" multiple="multiple"/></select>
            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    
    <div class="form-horizontal form-widgets col-md-11">
        <div class="form-group">
            <label for="transition_date" class="col-md-3 required">
                <span id="tooltip_transition_date" class="glyphicon glyphicon-info-sign"></span> Ημερομηνία ενεργοποίησης Διάταξης Η/Υ <span style="color:red">*</span>
            </label>
            <div class="col-md-6 widget">
                <input id="transition_date" name="transition_date" required data-required-msg="το πεδίο ημερομηνία ενεργοποίησης Διάταξης Η/Υ ειναι υποχρεωτικό" data-bind="value:transition_date"  />
            </div>                        
        </div>    
    </div>

    <div class="clearfix"></div>

    </script>
    
            <a href="#" class="scrollup">Scroll</a>
        </div>
    </div>

    <footer>
      <img src="client/img/footer.png">
    </footer>
    
<script type="text/javascript" src="client/myJs/js_event_handlers.js"></script> <!-- let the DOM load first, does not need to be in document.ready -->
</body>
</html>