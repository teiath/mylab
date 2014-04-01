<!--

Το αρχειο περιλαμβάνει τον HTML και JAVASCRIPT κώδικα που αφορά:

-->

<script>
    
    //var labTypesGlobal, aquisitionSourcesGlobal, labIdGlobal, labWorkerGlobal, labState, operationalRating, technologicalRating;
    
    
        var statistics_regionEduAdminsMultiSelect, statistics_regionEduAdminsMultiSelectData;
        var statistics_eduAdminsMultiSelect, statistics_eduAdminsMultiSelectData;
        var statistics_transferAreasMultiSelect, statistics_transferAreasMultiSelectData;
        var statistics_municipalitiesMultiSelect, statistics_municipalitiesMultiSelectData;
        var statistics_educationLevelsMultiSelect, statistics_educationLevelsMultiSelectData;
        var statistics_schoolUnitTypesMultiSelect, statistics_schoolUnitTypesMultiSelectData; 
        var statistics_labTypesMultiSelect, statistics_labTypesMultiSelectData;
        var statistics_aquisitionSourcesMultiSelect, statistics_aquisitionSourcesMultiSelectData;
        var statistics_labWorkerMultiSelect;
        var statistics_operationalRatingMultiSelect;
        var statistics_technologicalRatingMultiSelect;

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
    
    $(document).ready(function() {      

        //-------------------- REGION EDU EDMIN MULTI SELECT --------------------//
        statistics_regionEduAdminsMultiSelect = $("#statistics_regionEduAdmins").kendoMultiSelect({
            //placeholder: "επιλέξτε Περιφέρεια",
            dataTextField: "name", //the text content of the list items.
            dataValueField: "name",//the value content of the list items.
            dataSource: regionEduAdminsDS,
            filter: "contains",     
            autoBind:true
        });

        // get a reference to the instance of the regionEduAdminsMultiSelect
        statistics_regionEduAdminsMultiSelectData = $("#statistics_regionEduAdmins").data("kendoMultiSelect");

        // bind to the change event (ON CHANGE)
        statistics_regionEduAdminsMultiSelectData.bind("change", function(e) {          

            //clear the option-values of all dependant multiselect widgets
            $("#statistics_eduAdmins").data("kendoMultiSelect").value("");
            $("#statistics_transferAreas").data("kendoMultiSelect").value("");
            $("#statistics_municipalities").data("kendoMultiSelect").value("");

            var regionEduAdminsEduAdmins = new Array();
            var eduAdminsTransferAreas = new Array();
            var transferAreasMunicipalities = new Array();

            regionEduAdmin_eduAdminsData = [];
            regionEduAdmin_transferAreasData = [];
            regionEduAdmin_municipalitiesData = [];

            // μπαίνει στο 'if' κάθε φορά που ο χρήστης μετά την νέα του επιλογή στο widget (προσθήκη/διαγραφή ΠΔΕ) έχει μία ή περισσότερες ΠΔΕ επιλεγμένες
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΔΔΕ, Περ.Μετ., Δήμοι) με νέο σύνολο τιμών
            if(statistics_regionEduAdminsMultiSelectData.dataItems().length > 0){

                //get the id of the selected region edu admins and retrieve the corresponding values of all dependant fields
                var selected_region_edu_admins = statistics_regionEduAdminsMultiSelectData.dataItems();
                //console.log(selected_region_edu_admins);

                $.each( selected_region_edu_admins, function( index, selectedRegionEduAdmin ) {
                    regionEduAdminsEduAdmins[index] = selectedRegionEduAdmin.edu_admins.edu_admin_info; // object in array: region edu admins edu admins
                });

                $.each ( regionEduAdminsEduAdmins, function( index2, eduAdminsOfRegionEduAdmins){
                    for(z=0; z<eduAdminsOfRegionEduAdmins.length; z++){
                        regionEduAdmin_eduAdminsData.push(eduAdminsOfRegionEduAdmins[z]);
                    }
                });
                //console.log(regionEduAdmin_eduAdminsData);

                $.each( regionEduAdmin_eduAdminsData, function( index3, selectedEduAdmin ) {
                    eduAdminsTransferAreas[index3] = selectedEduAdmin.transfer_areas.transfer_area_info; // object in array: edu admins transfer areas
                });

                $.each ( eduAdminsTransferAreas, function( index4, transferAreasOfEduAdmins){
                    for(z=0; z<transferAreasOfEduAdmins.length; z++){
                        regionEduAdmin_transferAreasData.push(transferAreasOfEduAdmins[z]);
                    }
                });
                //console.log(regionEduAdmin_transferAreasData);

                $.each( regionEduAdmin_transferAreasData, function( index5, selectedTransferArea ) {
                    transferAreasMunicipalities[index5] = selectedTransferArea.municipalities.municipality_info; // object in array: transfer area's municipalities
                });

                $.each ( transferAreasMunicipalities, function( index6, municipalitiesOfTransferArea ){
                    for(z=0; z<municipalitiesOfTransferArea.length; z++){
                        regionEduAdmin_municipalitiesData.push(municipalitiesOfTransferArea[z]);
                    }
                });
                //console.log(regionEduAdmin_municipalitiesData);

                // populate the dependant multiselect widgets with the new values retrieved above
                $("#statistics_eduAdmins").data("kendoMultiSelect").setDataSource(regionEduAdmin_eduAdminsData);
                $("#statistics_transferAreas").data("kendoMultiSelect").setDataSource(regionEduAdmin_transferAreasData);
                $("#statistics_municipalities").data("kendoMultiSelect").setDataSource(regionEduAdmin_municipalitiesData);

            // μπαίνει στο 'else' κάθε φορά που η νέα επιλογή του χρήστη ειναι η διαγραφή της μοναδικής επιλεγμένης ΠΔΕ
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΔΔΕ, ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) με το default σύνολο τιμών (όλες οι τιμές)
            }else{
                // populate the dependant multiselect widgets with the default values
                $("#statistics_eduAdmins").data("kendoMultiSelect").setDataSource(eduAdminsDS);
                $("#statistics_transferAreas").data("kendoMultiSelect").setDataSource(transferAreasDS);
                $("#statistics_municipalities").data("kendoMultiSelect").setDataSource(municipalitiesDS);                    
            }
        });


        //-------------------- EDU EDMIN MULTI SELECT --------------------//
        statistics_eduAdminsMultiSelect = $("#statistics_eduAdmins").kendoMultiSelect({
            //placeholder: "επιλέξτε Διεύθυνση",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: eduAdminsDS,
            filter: "contains"
        });        

        // get a reference to the instance of the eduAdminsMultiSelect
        statistics_eduAdminsMultiSelectData = $("#statistics_eduAdmins").data("kendoMultiSelect");

        // bind to the change event (ON CHANGE)
        statistics_eduAdminsMultiSelectData.bind("change", function(e) {

            //clear all dependant fields
            $("#statistics_transferAreas").data("kendoMultiSelect").value("");                
            $("#statistics_municipalities").data("kendoMultiSelect").value("");

            var regionEduAdminsEduAdmins = new Array();
            var eduAdminsTransferAreas = new Array();
            var transferAreasMunicipalities = new Array();

            eduAdmin_eduAdminsData = []
            eduAdmin_transferAreasData = [];
            eduAdmin_municipalitiesData = [];

            // μπαίνει στο 'if' κάθε φορά που ο χρήστης μετά την νέα του επιλογή στο widget (προσθήκη/διαγραφή ΔΔΕ) έχει μία ή περισσότερες ΔΔΕ επιλεγμένες
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (Περ.Μετ., Δήμοι) με νέο σύνολο τιμών
            if( statistics_eduAdminsMultiSelectData.dataItems().length > 0){

                //get the id of the selected edu admin and retrieve the corresponding values of all dependant fields
                var selected_edu_admins = statistics_eduAdminsMultiSelectData.dataItems();

                $.each( selected_edu_admins, function( index3, selectedEduAdmin ) {
                    eduAdminsTransferAreas[index3] = selectedEduAdmin.transfer_areas.transfer_area_info; // object in array: edu admins transfer areas
                });

                $.each ( eduAdminsTransferAreas, function( index4, transferAreasOfEduAdmins){
                    for(z=0; z<transferAreasOfEduAdmins.length; z++){
                        eduAdmin_transferAreasData.push(transferAreasOfEduAdmins[z]);
                    }
                });

                $.each( eduAdmin_transferAreasData, function( index5, selectedTransferArea ) {
                    transferAreasMunicipalities[index5] = selectedTransferArea.municipalities.municipality_info; // object in array: transfer area's municipalities
                });

                $.each ( transferAreasMunicipalities, function( index6, municipalitiesOfTransferArea ){
                    for(z=0; z<municipalitiesOfTransferArea.length; z++){
                        eduAdmin_municipalitiesData.push(municipalitiesOfTransferArea[z]);
                    }
                });

                // populate the dependant fields with the new values retrieved above
                $("#statistics_transferAreas").data("kendoMultiSelect").setDataSource(eduAdmin_transferAreasData);
                $("#statistics_municipalities").data("kendoMultiSelect").setDataSource(eduAdmin_municipalitiesData);

            // μπαίνει στο 'else' κάθε φορά που η νέα επιλογή του χρήστη ειναι η διαγραφή της μοναδικής επιλεγμένης ΔΔΕ και
            // ΑΝ υπάρχει τουλάχιστον μία επιλεγμένη ΠΔΕ, τα ιεραρχικά εξαρτώμενά της/των widgets (ΔΔΕ, ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) γίνονται repopulate με βάση το ΠΔΕ widget
            // ΑΛΛΙΩΣ τα ιεραρχικά εξαρτώμενα widgets (ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) γίνονται repopulate με το default σύνολο τιμών (όλες οι τιμές)
            }else{

              //if( typeof regionEduAdminsMultiSelectData.dataItems() != "undefined"){
                if( statistics_regionEduAdminsMultiSelectData.dataItems().length > 0){

                    //get the ids of the selected region edu admins and retrieve the corresponding values of all dependant fields
                    var selected_region_edu_admins = statistics_regionEduAdminsMultiSelectData.dataItems();
                    //console.log(selected_region_edu_admin);

                    $.each( selected_region_edu_admins, function( index, selectedRegionEduAdmin ) {
                        regionEduAdminsEduAdmins[index] = selectedRegionEduAdmin.edu_admins.edu_admin_info; // object in array: region edu admins edu admins
                    });

                    $.each ( regionEduAdminsEduAdmins, function( index2, eduAdminsOfRegionEduAdmins){
                        for(z=0; z<eduAdminsOfRegionEduAdmins.length; z++){
                            eduAdmin_eduAdminsData.push(eduAdminsOfRegionEduAdmins[z]);
                        }
                    });


                    $.each( eduAdmin_eduAdminsData, function( index3, selectedEduAdmin ) {
                        eduAdminsTransferAreas[index3] = selectedEduAdmin.transfer_areas.transfer_area_info; // object in array: edu admins transfer areas
                    });

                    $.each ( eduAdminsTransferAreas, function( index4, transferAreasOfEduAdmins){
                        for(z=0; z<transferAreasOfEduAdmins.length; z++){
                            eduAdmin_transferAreasData.push(transferAreasOfEduAdmins[z]);
                        }
                    });


                    $.each( eduAdmin_transferAreasData, function( index5, selectedTransferArea ) {
                        transferAreasMunicipalities[index5] = selectedTransferArea.municipalities.municipality_info; // object in array: transfer area's municipalities
                    });

                    $.each ( transferAreasMunicipalities, function( index6, municipalitiesOfTransferArea ){
                        for(z=0; z<municipalitiesOfTransferArea.length; z++){
                            eduAdmin_municipalitiesData.push(municipalitiesOfTransferArea[z]);
                        }
                    });

                    // populate the dependant fields with values retrieved above
                    $("#statistics_eduAdmins").data("kendoMultiSelect").setDataSource(eduAdmin_eduAdminsData);
                    $("#statistics_transferAreas").data("kendoMultiSelect").setDataSource(eduAdmin_transferAreasData);
                    $("#statistics_municipalities").data("kendoMultiSelect").setDataSource(eduAdmin_municipalitiesData);

                }else{
                    // populate the dependant fields with default values
                    $("#statistics_transferAreas").data("kendoMultiSelect").setDataSource(transferAreasDS);
                    $("#statistics_municipalities").data("kendoMultiSelect").setDataSource(municipalitiesDS);
                }
            }
        });


        //-------------------- TRANSFER AREA MULTI SELECT --------------------//            
        statistics_transferAreasMultiSelect = $("#statistics_transferAreas").kendoMultiSelect({
            //placeholder: "επιλέξτε Περιοχή Μετάθεσης",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: transferAreasDS,
            filter: "contains"
        });


        // get a reference to the instance of the transferAreasComboBox
        statistics_transferAreasMultiSelectData = $("#statistics_transferAreas").data("kendoMultiSelect");

        // bind to the change event ON CHANGE
        statistics_transferAreasMultiSelectData.bind("change", function(e) {

            //clear all dependant fields
            $("#statistics_municipalities").data("kendoMultiSelect").value("");

            var regionEduAdminsEduAdmins = new Array();
            var eduAdminsTransferAreas = new Array();
            var transferAreasMunicipalities = new Array();

            transferArea_eduAdminsData = [];
            transferArea_transferAreasData = [];
            transferArea_municipalitiesData = [];


            // μπαίνει στο 'if' κάθε φορά που ο χρήστης μετά την νέα του επιλογή στο widget (προσθήκη/διαγραφή Περ.Μετ.) έχει μία ή περισσότερες Περ.Μετ. επιλεγμένες
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets με νέο σύνολο τιμών
            if( statistics_transferAreasMultiSelectData.dataItems().length > 0){ //some transfer area is selected by the user

                //get the id of the selected transfer areas HERE
                var selected_transfer_areas = statistics_transferAreasMultiSelectData.dataItems(); // object in array: transfer area with all of its data

                $.each( selected_transfer_areas, function( index, selectedTransferArea ) {
                    transferAreasMunicipalities[index] = selectedTransferArea.municipalities.municipality_info; // object in array: transfer area's municipalities
                });

                $.each ( transferAreasMunicipalities, function( index2, municipalitiesOfTransferArea ){
                    for(z=0; z<municipalitiesOfTransferArea.length; z++){
                        transferArea_municipalitiesData.push(municipalitiesOfTransferArea[z]);
                    }
                });

                // populate the dependant fields with values retrieved above
                $("#statistics_municipalities").data("kendoMultiSelect").setDataSource(transferArea_municipalitiesData);

            // μπαίνει στο 'else' κάθε φορά που η νέα επιλογή του χρήστη ειναι η διαγραφή της μοναδικής επιλεγμένης Περ.Μετ. και
            // ΑΝ υπάρχει τουλάχιστον μία επιλεγμένη ΔΔΕ, κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) με βάση το ΔΔΕ widget
            // ΑΛΛΙΩΣ ΑΝ υπάρχει τουλάχιστον μία επιλεγμένη ΠΔΕ, κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΔΔΕ, ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) με βάση το ΔΔΕ widget
            // ΑΛΛΙΩΣ κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΔΗΜΟΙ) με το default σύνολο τιμών (όλες οι τιμές)                
            }else{

                if( statistics_eduAdminsMultiSelectData.dataItems().length > 0){

                    //get the id of the selected edu admin and retrieve the corresponding values of all dependant fields
                    var selected_edu_admins = statistics_eduAdminsMultiSelectData.dataItems();
                    //console.log(selected_edu_admins);

                    $.each( selected_edu_admins, function( index3, selectedEduAdmin ) {
                        eduAdminsTransferAreas[index3] = selectedEduAdmin.transfer_areas.transfer_area_info; // object in array: edu admins transfer areas
                    });

                    $.each ( eduAdminsTransferAreas, function( index4, transferAreasOfEduAdmins){
                        for(z=0; z<transferAreasOfEduAdmins.length; z++){
                            transferArea_transferAreasData.push(transferAreasOfEduAdmins[z]);
                        }
                    });

                    $.each( transferArea_transferAreasData, function( index5, selectedTransferArea ) {
                        transferAreasMunicipalities[index5] = selectedTransferArea.municipalities.municipality_info; // object in array: transfer area's municipalities
                    });

                    $.each ( transferAreasMunicipalities, function( index6, municipalitiesOfTransferArea ){
                        for(z=0; z<municipalitiesOfTransferArea.length; z++){
                            transferArea_municipalitiesData.push(municipalitiesOfTransferArea[z]);
                        }
                    });

                    // populate the dependant fields with the new values retrieved above
                    $("#statistics_transferAreas").data("kendoMultiSelect").setDataSource(transferArea_transferAreasData);
                    $("#statistics_municipalities").data("kendoMultiSelect").setDataSource(transferArea_municipalitiesData);

                }else if( statistics_regionEduAdminsMultiSelectData.dataItems().length > 0){             

                    //get the id of the selected region edu admins and retrieve the corresponding values of all dependant fields
                    var selected_region_edu_admins = statistics_regionEduAdminsMultiSelectData.dataItems();

                    $.each( selected_region_edu_admins, function( index, selectedRegionEduAdmin ) {
                        regionEduAdminsEduAdmins[index] = selectedRegionEduAdmin.edu_admins.edu_admin_info; // object in array: region edu admins edu admins
                    });

                    $.each ( regionEduAdminsEduAdmins, function( index2, eduAdminsOfRegionEduAdmins){
                        for(z=0; z<eduAdminsOfRegionEduAdmins.length; z++){
                            transferArea_eduAdminsData.push(eduAdminsOfRegionEduAdmins[z]);
                        }
                    });

                    $.each( transferArea_eduAdminsData, function( index3, selectedEduAdmin ) {
                        eduAdminsTransferAreas[index3] = selectedEduAdmin.transfer_areas.transfer_area_info; // object in array: edu admins transfer areas
                    });

                    $.each ( eduAdminsTransferAreas, function( index4, transferAreasOfEduAdmins){
                        for(z=0; z<transferAreasOfEduAdmins.length; z++){
                            transferArea_transferAreasData.push(transferAreasOfEduAdmins[z]);
                        }
                    });

                    $.each( transferArea_transferAreasData, function( index5, selectedTransferArea ) {
                        transferAreasMunicipalities[index5] = selectedTransferArea.municipalities.municipality_info; // object in array: transfer area's municipalities
                    });

                    $.each ( transferAreasMunicipalities, function( index6, municipalitiesOfTransferArea ){
                        for(z=0; z<municipalitiesOfTransferArea.length; z++){
                            transferArea_municipalitiesData.push(municipalitiesOfTransferArea[z]);
                        }
                    });

                    // populate the dependant multiselect widgets with the new values retrieved above
                    $("#eduAdmins").data("kendoMultiSelect").setDataSource(transferArea_eduAdminsData);
                    $("#transferAreas").data("kendoMultiSelect").setDataSource(transferArea_transferAreasData);
                    $("#municipalities").data("kendoMultiSelect").setDataSource(transferArea_municipalitiesData);

                }else{

                    // populate the dependant fields with default values
                    $("#municipalities").data("kendoMultiSelect").setDataSource(municipalitiesDS);
                }
            }
        });


        //-------------------- MUNICIPALITIES MULTI SELECT --------------------//
        statistics_municipalitiesMultiSelect = $("#statistics_municipalities").kendoMultiSelect({
            //placeholder: "επιλέξτε Δήμο",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: municipalitiesDS,
            filter: "contains"
        });

        // get a reference to the instance of the municipalitiesComboBox
        statistics_municipalitiesMultiSelectData = $("statistics_#municipalities").data("kendoMultiSelect");


        //--------------------EDUCATION LEVELS MULTI SELECT--------------------//           
        statistics_educationLevelsMultiSelect = $("#statistics_educationLevels").kendoMultiSelect({
            //placeholder: "Επιλέξτε Βαθμίδα",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: educationLevelsDS,
            filter: "contains"
        });

        // get a reference to the instance of the educationLevelsMultiSelect and reset the widget's value
        statistics_educationLevelsMultiSelectData = $("#statistics_educationLevels").data("kendoMultiSelect");
        // bind to the change event -and filter school unit types accordingly-
        statistics_educationLevelsMultiSelectData.bind("change", function(e) {

            //clear all dependant fields
            $("#statistics_schoolUnitTypes").data("kendoMultiSelect").value("");
            var educationLevelsSchoolUnitTypes = new Array();
            educationLevel_schoolUnitTypesData = [];

            // μπαίνει στο 'if' κάθε φορά που ο χρήστης μετά την νέα του επιλογή στο widget (προσθήκη/διαγραφή Βαθμίδας) έχει μία ή περισσότερες Βαθμίδες επιλεγμένες
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (τύπος Σχολικής Μονάδας) με νέο σύνολο τιμών
            if(statistics_educationLevelsMultiSelectData.dataItems().length > 0){

                //get the id of the selected region edu admins and retrieve the corresponding values of all dependant fields
                var selected_education_levels = statistics_educationLevelsMultiSelectData.dataItems();

                $.each( selected_education_levels, function( index, selectedEducationLevel ) {
                    educationLevelsSchoolUnitTypes[index] = selectedEducationLevel.school_unit_types.school_unit_type_info;
                });

                $.each ( educationLevelsSchoolUnitTypes, function( index2, schoolUnitTypesOfEducationLevels){
                    for(z=0; z<schoolUnitTypesOfEducationLevels.length; z++){
                        educationLevel_schoolUnitTypesData.push(schoolUnitTypesOfEducationLevels[z]);
                    }
                });  
                // populate the dependant multiselect widget with the new values retrieved above
                $("#statistics_schoolUnitTypes").data("kendoMultiSelect").setDataSource(educationLevel_schoolUnitTypesData);

            }else{
                // populate the dependant multiselect widget with the default values
                $("#statistics_schoolUnitTypes").data("kendoMultiSelect").setDataSource(schoolUnitTypesDS);
            }
        });


        //--------------------SCHOOL UNIT TYPES MULTI SELECT--------------------//            
        statistics_schoolUnitTypesMultiSelect = $("#statistics_schoolUnitTypes").kendoMultiSelect({
            //placeholder: "Επιλέξτε Τύπο Σχ.Μονάδας",
            dataTextField: "name",
            dataValueField: "name",
            filter: "contains",
            dataSource: schoolUnitTypesDS
        });


        //--------------------LAB TYPES COMBO BOX--------------------// 
        statistics_labTypesMultiSelect = $("#statistics_labTypes").kendoMultiSelect({
            //placeholder: "Επιλέξτε Τύπο Διάταξης Η/Υ",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: labTypesDS,
            filter: "contains"
        }); 


        //--------------------AQUISITION SOURCES COMBO BOX--------------------// 
        statistics_aquisitionSourcesMultiSelect = $("#statistics_aquisitionSources").kendoMultiSelect({
            //placeholder: "Επιλέξτε πηγή χρηματοδότησης",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: aquisitionSourcesDS,
            filter: "contains"
        });

        // get a reference to the instance of the educationLevelsMultiSelect and reset the widget's value
        statistics_aquisitionSourcesMultiSelectData = $("#statistics_aquisitionSources").data("kendoMultiSelect");

        // bind to the change event -and filter school unit types accordingly-
        statistics_aquisitionSourcesMultiSelectData.bind("change", function(e) {
            console.log("aquisitionSourcesMultiSelectData e", e);
        });


        statistics_labWorkerMultiSelect = $("#statistics_labWorkerRegNo").kendoMultiSelect({
            dataTextField: "fullname",
            dataValueField: "registry_no",
            minLength: 2,
            autoBind: false,
            //suggest: true,
            dataSource: {
                serverFiltering: true,
                transport: {
                    read: {
                        url: "api/workers",
                        type: "GET",
                        data: {
                            //"pagesize": 12,
                        },
                        dataType: "json"
                    },
                    parameterMap: function(data, type) {
                        if (type === 'read') {
                            if (typeof data.filter !== 'undefined' && typeof data.filter.filters[0] !== 'undefined') {
                                data["worker"] = data.filter.filters[0].value;
                            }
                            delete data.filter;
                        }
                        return data;
                    }
                },
                schema: {
                    data: function(response) {
                            console.log(response);
                            for (var i = 0; i < response.data.length; ++i) {
                                response.data[i].fullname = response.data[i].lastname + " " + response.data[i].firstname + ", ΑΜ " + response.data[i].registry_no;
                            }
                            return response.data;
                    },
                    total: "total"//,
        //                        model:{
        //                            id:"registry_no"
        //                        }
                }
            }
        });


        statistics_operationalRatingMultiSelect = $("#statistics_operational_rating").kendoMultiSelect({
            dataTextField: "name",
            dataValueField: "id",
            itemTemplate: '#if(id == 1){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 2){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 3){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 4){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 5){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>\
                           #}#',
            tagTemplate: '#if(id == 1){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 2){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 3){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 4){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 5){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>\
                           #}#',
            dataSource: ratingDS
        });


        statistics_technologicalRatingMultiSelect = $("#statistics_technological_rating").kendoMultiSelect({
            dataTextField: "name",
            dataValueField: "id",
            itemTemplate: '#if(id == 1){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 2){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 3){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 4){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 5){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>\
                           #}#',
            tagTemplate: '#if(id == 1){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 2){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 3){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 4){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>\
                           #}else if(id == 5){# <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>\
                           #}#',
            dataSource: ratingDS
        });         
            
            
    });

</script>


<!--statistics filter pane-->
<div id="statistics-filter-pane">
    <form id="statistics-filter-form">

        <div id="statistics-filter-form-options" class="row">

            <div class="col-md-3">

                <label for="statistics_school_unit_type">τύπος Σχολικής Μονάδας</label>
                <select name="statistics_school_unit_type" id="statistics_schoolUnitTypes" multiple="multiple"></select>
                
                <div class="school_unit_operational_state">
                    <label>λειτουργική κατάσταση Σχολικής Μονάδας</label>
                    <label for='statistics_checkbox_active' class="checkbox_label"><input id='statistics_checkbox_active' name='statistics_checkbox_active' type="checkbox">ενεργή</label>
                    <label for='statistics_checkbox_suspended' class="checkbox_label"><input id='statistics_checkbox_suspended' name='statistics_checkbox_suspended' type="checkbox">σε αναστολή</label>
                    <label for='statistics_checkbox_abolished' class="checkbox_label"><input id='statistics_checkbox_abolished' name='statistics_checkbox_abolished' type="checkbox">κατηργημένη</label>
                </div>

            </div>
            <div class="col-md-3">
                <label for="statistics_region_edu_admin">Περιφερειακή Διεύθυνση Εκπαίδευσης</label>
                <select name="statistics_region_edu_admin" id="statistics_regionEduAdmins" multiple="multiple"></select>

                <label for="statistics_education_level">Βαθμίδα Εκπαίδευσης</label>
                <select name="statistics_education_level" id="statistics_educationLevels" multiple="multiple"></select>

                <label for="statistics_edu_admin">Διεύθυνση Εκπαίδευσης</label>
                <select name="statistics_edu_admin" id="statistics_eduAdmins" multiple="multiple"></select>

                <label for="statistics_transfer_area">Περιοχή Μετάθεσης</label>                    
                <select name="statistics_transfer_area" id="statistics_transferAreas" multiple="multiple"></select>

                <label for="statistics_municipality">Δήμος</label>
                <select name="statistics_municipality" id="statistics_municipalities" multiple="multiple"></select>
            </div>

            <div class="col-md-3">

                <label for="statistics_lab_type">τύπος Διάταξης Η/Υ</label>
                <select name="statistics_lab_type" id="statistics_labTypes" multiple="multiple"/></select>

                <label for="statistics_aquisition_source">πηγή χρηματοδότησης Διάταξης Η/Υ</label>
                <select name="statistics_aquisition_source" id="statistics_aquisitionSources" multiple="multiple"/></select>

                <label for="statistics_lab_worker">υπεύθυνος Διάταξης Η/Υ</label>
                <select name="statistics_lab_worker" id="statistics_labWorkerRegNo" multiple="multiple"/></select>

            </div>
            <div class="col-md-3">

                <label for="statistics_operational_rating">λειτουργική βαθμολόγηση</label>
                <select name="statistics_operational_rating" id="statistics_operational_rating" multiple="multiple"/></select>

                <label for="statistics_technological_rating">τεχνολογική βαθμολόγηση</label>
                <select name="statistics_technological_rating" id="statistics_technological_rating" multiple="multiple"/></select>

                <div class="lab_operational_state">
                    <label>λειτουργική κατάσταση Διάταξης Η/Υ</label>
                    <label for='statistics_lab_checkbox_active' class="checkbox_label"><input id='statistics_lab_checkbox_active' name='statistics_lab_checkbox_active' type="checkbox">ενεργή</label>
                    <label for='statistics_lab_checkbox_suspended' class="checkbox_label"><input id='statistics_lab_checkbox_suspended' name='statistics_lab_checkbox_suspended' type="checkbox">σε αναστολή</label>
                    <label for='statistics_lab_checkbox_abolished' class="checkbox_label"><input id='statistics_lab_checkbox_abolished' name='statistics_lab_checkbox_abolished' type="checkbox">κατηργημένη</label>
                </div>

            </div>
        </div>

    </form>
</div>