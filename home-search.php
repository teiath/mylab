<!--

Το αρχειο περιλαμβάνει τον HTML και JAVASCRIPT κώδικα που αφορά:

* τη φόρμα αναζήτησης σχολικών μονάδων
* το πανελ πληροφοριών (info pane) των αποτελεσμάτων αναζήτησης
* το πάνελ φίλτρων (search path pane) της αναζήτησης
* μήνυμα λάθους όταν η αναζήτηση του χρήστη ειναι λανθασμένη

Λειτουργίες

* kendo widgets των πεδίων αναζήτησης
* λειτουργικότητα αναζήτησης
* λειτουργικότητα καθαρισμού φόρμας
* λειτουργικότητα κλείσιμου του πάνελ πληροφοριών (info pane)

-->

<script>
    
    var labTypesGlobal, aquisitionSourcesGlobal, labIdGlobal, labWorkerGlobal, labStateGlobal, operationalRatingGlobal, technologicalRatingGlobal;
    
    $(document).ready(function() {

        //-------------------- REGION EDU EDMIN MULTI SELECT --------------------//
        regionEduAdminsMultiSelect = $("#regionEduAdmins").kendoMultiSelect({
            //placeholder: "επιλέξτε Περιφέρεια",
            dataTextField: "name", //the text content of the list items.
            dataValueField: "name",//the value content of the list items.
            dataSource: regionEduAdminsDS,
            filter: "contains",     
            autoBind:true
        });

        // get a reference to the instance of the regionEduAdminsMultiSelect
        regionEduAdminsMultiSelectData = $("#regionEduAdmins").data("kendoMultiSelect");

        // bind to the change event (ON CHANGE)
        regionEduAdminsMultiSelectData.bind("change", function(e) {          

            //clear the option-values of all dependant multiselect widgets
            $("#eduAdmins").data("kendoMultiSelect").value("");
            $("#transferAreas").data("kendoMultiSelect").value("");
            $("#municipalities").data("kendoMultiSelect").value("");

            var regionEduAdminsEduAdmins = new Array();
            var eduAdminsTransferAreas = new Array();
            var transferAreasMunicipalities = new Array();

            regionEduAdmin_eduAdminsData = [];
            regionEduAdmin_transferAreasData = [];
            regionEduAdmin_municipalitiesData = [];

            // μπαίνει στο 'if' κάθε φορά που ο χρήστης μετά την νέα του επιλογή στο widget (προσθήκη/διαγραφή ΠΔΕ) έχει μία ή περισσότερες ΠΔΕ επιλεγμένες
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΔΔΕ, Περ.Μετ., Δήμοι) με νέο σύνολο τιμών
            if(regionEduAdminsMultiSelectData.dataItems().length > 0){

                //get the id of the selected region edu admins and retrieve the corresponding values of all dependant fields
                var selected_region_edu_admins = regionEduAdminsMultiSelectData.dataItems();
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
                $("#eduAdmins").data("kendoMultiSelect").setDataSource(regionEduAdmin_eduAdminsData);
                $("#transferAreas").data("kendoMultiSelect").setDataSource(regionEduAdmin_transferAreasData);
                $("#municipalities").data("kendoMultiSelect").setDataSource(regionEduAdmin_municipalitiesData);

            // μπαίνει στο 'else' κάθε φορά που η νέα επιλογή του χρήστη ειναι η διαγραφή της μοναδικής επιλεγμένης ΠΔΕ
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΔΔΕ, ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) με το default σύνολο τιμών (όλες οι τιμές)
            }else{
                // populate the dependant multiselect widgets with the default values
                $("#eduAdmins").data("kendoMultiSelect").setDataSource(eduAdminsDS);
                $("#transferAreas").data("kendoMultiSelect").setDataSource(transferAreasDS);
                $("#municipalities").data("kendoMultiSelect").setDataSource(municipalitiesDS);                    
            }
        });


        //-------------------- EDU EDMIN MULTI SELECT --------------------//
        eduAdminsMultiSelect = $("#eduAdmins").kendoMultiSelect({
            //placeholder: "επιλέξτε Διεύθυνση",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: eduAdminsDS,
            filter: "contains"
        });        

        // get a reference to the instance of the eduAdminsMultiSelect
        eduAdminsMultiSelectData = $("#eduAdmins").data("kendoMultiSelect");

        // bind to the change event (ON CHANGE)
        eduAdminsMultiSelectData.bind("change", function(e) {

            //clear all dependant fields
            $("#transferAreas").data("kendoMultiSelect").value("");                
            $("#municipalities").data("kendoMultiSelect").value("");

            var regionEduAdminsEduAdmins = new Array();
            var eduAdminsTransferAreas = new Array();
            var transferAreasMunicipalities = new Array();

            eduAdmin_eduAdminsData = []
            eduAdmin_transferAreasData = [];
            eduAdmin_municipalitiesData = [];

            // μπαίνει στο 'if' κάθε φορά που ο χρήστης μετά την νέα του επιλογή στο widget (προσθήκη/διαγραφή ΔΔΕ) έχει μία ή περισσότερες ΔΔΕ επιλεγμένες
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (Περ.Μετ., Δήμοι) με νέο σύνολο τιμών
            if( eduAdminsMultiSelectData.dataItems().length > 0){

                //get the id of the selected edu admin and retrieve the corresponding values of all dependant fields
                var selected_edu_admins = eduAdminsMultiSelectData.dataItems();

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
                $("#transferAreas").data("kendoMultiSelect").setDataSource(eduAdmin_transferAreasData);
                $("#municipalities").data("kendoMultiSelect").setDataSource(eduAdmin_municipalitiesData);

            // μπαίνει στο 'else' κάθε φορά που η νέα επιλογή του χρήστη ειναι η διαγραφή της μοναδικής επιλεγμένης ΔΔΕ και
            // ΑΝ υπάρχει τουλάχιστον μία επιλεγμένη ΠΔΕ, τα ιεραρχικά εξαρτώμενά της/των widgets (ΔΔΕ, ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) γίνονται repopulate με βάση το ΠΔΕ widget
            // ΑΛΛΙΩΣ τα ιεραρχικά εξαρτώμενα widgets (ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) γίνονται repopulate με το default σύνολο τιμών (όλες οι τιμές)
            }else{

              //if( typeof regionEduAdminsMultiSelectData.dataItems() != "undefined"){
                if( regionEduAdminsMultiSelectData.dataItems().length > 0){

                    //get the ids of the selected region edu admins and retrieve the corresponding values of all dependant fields
                    var selected_region_edu_admins = regionEduAdminsMultiSelectData.dataItems();
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
                    $("#eduAdmins").data("kendoMultiSelect").setDataSource(eduAdmin_eduAdminsData);
                    $("#transferAreas").data("kendoMultiSelect").setDataSource(eduAdmin_transferAreasData);
                    $("#municipalities").data("kendoMultiSelect").setDataSource(eduAdmin_municipalitiesData);

                }else{
                    // populate the dependant fields with default values
                    $("#transferAreas").data("kendoMultiSelect").setDataSource(transferAreasDS);
                    $("#municipalities").data("kendoMultiSelect").setDataSource(municipalitiesDS);
                }
            }
            //console.log("eduAdminsMultiSelectData", eduAdminsMultiSelectData);
            //console.log("transferAreasMultiSelectData", transferAreasMultiSelectData);
            //console.log("municipalitiesMultiSelectData", municipalitiesMultiSelectData);
        });


        //-------------------- TRANSFER AREA MULTI SELECT --------------------//            
        transferAreasMultiSelect = $("#transferAreas").kendoMultiSelect({
            //placeholder: "επιλέξτε Περιοχή Μετάθεσης",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: transferAreasDS,
            filter: "contains"
        });


        // get a reference to the instance of the transferAreasComboBox
        transferAreasMultiSelectData = $("#transferAreas").data("kendoMultiSelect");

        // bind to the change event ON CHANGE
        transferAreasMultiSelectData.bind("change", function(e) {

            //clear all dependant fields
            $("#municipalities").data("kendoMultiSelect").value("");

            var regionEduAdminsEduAdmins = new Array();
            var eduAdminsTransferAreas = new Array();
            var transferAreasMunicipalities = new Array();

            transferArea_eduAdminsData = [];
            transferArea_transferAreasData = [];
            transferArea_municipalitiesData = [];


            // μπαίνει στο 'if' κάθε φορά που ο χρήστης μετά την νέα του επιλογή στο widget (προσθήκη/διαγραφή Περ.Μετ.) έχει μία ή περισσότερες Περ.Μετ. επιλεγμένες
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets με νέο σύνολο τιμών
            if( transferAreasMultiSelectData.dataItems().length > 0){ //some transfer area is selected by the user

                //get the id of the selected transfer areas HERE
                var selected_transfer_areas = transferAreasMultiSelectData.dataItems(); // object in array: transfer area with all of its data

                $.each( selected_transfer_areas, function( index, selectedTransferArea ) {
                    transferAreasMunicipalities[index] = selectedTransferArea.municipalities.municipality_info; // object in array: transfer area's municipalities
                });

                $.each ( transferAreasMunicipalities, function( index2, municipalitiesOfTransferArea ){
                    for(z=0; z<municipalitiesOfTransferArea.length; z++){
                        transferArea_municipalitiesData.push(municipalitiesOfTransferArea[z]);
                    }
                });

                // populate the dependant fields with values retrieved above
                $("#municipalities").data("kendoMultiSelect").setDataSource(transferArea_municipalitiesData);

            // μπαίνει στο 'else' κάθε φορά που η νέα επιλογή του χρήστη ειναι η διαγραφή της μοναδικής επιλεγμένης Περ.Μετ. και
            // ΑΝ υπάρχει τουλάχιστον μία επιλεγμένη ΔΔΕ, κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) με βάση το ΔΔΕ widget
            // ΑΛΛΙΩΣ ΑΝ υπάρχει τουλάχιστον μία επιλεγμένη ΠΔΕ, κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΔΔΕ, ΠΕΡ.ΜΕΤ, ΔΗΜΟΙ) με βάση το ΔΔΕ widget
            // ΑΛΛΙΩΣ κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (ΔΗΜΟΙ) με το default σύνολο τιμών (όλες οι τιμές)                
            }else{

                if( eduAdminsMultiSelectData.dataItems().length > 0){

                    //get the id of the selected edu admin and retrieve the corresponding values of all dependant fields
                    var selected_edu_admins = eduAdminsMultiSelectData.dataItems();
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
                    $("#transferAreas").data("kendoMultiSelect").setDataSource(transferArea_transferAreasData);
                    $("#municipalities").data("kendoMultiSelect").setDataSource(transferArea_municipalitiesData);

                }else if( regionEduAdminsMultiSelectData.dataItems().length > 0){             

                    //get the id of the selected region edu admins and retrieve the corresponding values of all dependant fields
                    var selected_region_edu_admins = regionEduAdminsMultiSelectData.dataItems();

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
            //console.log("eduAdminsMultiSelectData", eduAdminsMultiSelectData);
            //console.log("transferAreasMultiSelectData", transferAreasMultiSelectData);
            //console.log("municipalitiesMultiSelectData", municipalitiesMultiSelectData);
        });


        //-------------------- MUNICIPALITIES MULTI SELECT --------------------//
        municipalitiesMultiSelect = $("#municipalities").kendoMultiSelect({
            //placeholder: "επιλέξτε Δήμο",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: municipalitiesDS,
            filter: "contains"
        });

        // get a reference to the instance of the municipalitiesComboBox
        municipalitiesMultiSelectData = $("#municipalities").data("kendoMultiSelect");


        //--------------------EDUCATION LEVELS MULTI SELECT--------------------//           
        educationLevelsMultiSelect = $("#educationLevels").kendoMultiSelect({
            //placeholder: "Επιλέξτε Βαθμίδα",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: educationLevelsDS,
            filter: "contains"
        });

        // get a reference to the instance of the educationLevelsMultiSelect and reset the widget's value
        educationLevelsMultiSelectData = $("#educationLevels").data("kendoMultiSelect");
        // bind to the change event -and filter school unit types accordingly-
        educationLevelsMultiSelectData.bind("change", function(e) {

            //clear all dependant fields
            $("#schoolUnitTypes").data("kendoMultiSelect").value("");
            var educationLevelsSchoolUnitTypes = new Array();
            educationLevel_schoolUnitTypesData = [];

            // μπαίνει στο 'if' κάθε φορά που ο χρήστης μετά την νέα του επιλογή στο widget (προσθήκη/διαγραφή Βαθμίδας) έχει μία ή περισσότερες Βαθμίδες επιλεγμένες
            // και κάνει repopulate τα ιεραρχικά εξαρτώμενα widgets (τύπος Σχολικής Μονάδας) με νέο σύνολο τιμών
            if(educationLevelsMultiSelectData.dataItems().length > 0){

                //get the id of the selected region edu admins and retrieve the corresponding values of all dependant fields
                var selected_education_levels = educationLevelsMultiSelectData.dataItems();

                $.each( selected_education_levels, function( index, selectedEducationLevel ) {
                    educationLevelsSchoolUnitTypes[index] = selectedEducationLevel.school_unit_types.school_unit_type_info;
                });

                $.each ( educationLevelsSchoolUnitTypes, function( index2, schoolUnitTypesOfEducationLevels){
                    for(z=0; z<schoolUnitTypesOfEducationLevels.length; z++){
                        educationLevel_schoolUnitTypesData.push(schoolUnitTypesOfEducationLevels[z]);
                    }
                });  
                // populate the dependant multiselect widget with the new values retrieved above
                $("#schoolUnitTypes").data("kendoMultiSelect").setDataSource(educationLevel_schoolUnitTypesData);

            }else{
                // populate the dependant multiselect widget with the default values
                $("#schoolUnitTypes").data("kendoMultiSelect").setDataSource(schoolUnitTypesDS);
            }
        });


        //--------------------SCHOOL UNIT TYPES MULTI SELECT--------------------//            
        schoolUnitTypesMultiSelect = $("#schoolUnitTypes").kendoMultiSelect({
            //placeholder: "Επιλέξτε Τύπο Σχ.Μονάδας",
            dataTextField: "name",
            dataValueField: "name",
            filter: "contains",
            dataSource: schoolUnitTypesDS
        });


        //--------------------LAB TYPES COMBO BOX--------------------// 
        labTypesMultiSelect = $("#labTypes").kendoMultiSelect({
            //placeholder: "Επιλέξτε Τύπο Διάταξης Η/Υ",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: labTypesDS,
            filter: "contains"
        }); 


        //--------------------AQUISITION SOURCES COMBO BOX--------------------// 
        aquisitionSourcesMultiSelect = $("#aquisitionSources").kendoMultiSelect({
            //placeholder: "Επιλέξτε πηγή χρηματοδότησης",
            dataTextField: "name",
            dataValueField: "name",
            dataSource: aquisitionSourcesDS,
            filter: "contains"
        });

        // get a reference to the instance of the educationLevelsMultiSelect and reset the widget's value
        aquisitionSourcesMultiSelectData = $("#aquisitionSources").data("kendoMultiSelect");

        // bind to the change event -and filter school unit types accordingly-
        aquisitionSourcesMultiSelectData.bind("change", function(e) {
            console.log("aquisitionSourcesMultiSelectData e", e);
        });


        labWorkerMultiSelect = $("#labWorkerRegNo").kendoMultiSelect({
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


        operationalRatingMultiSelect = $("#operational_rating").kendoMultiSelect({
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


        technologicalRatingMultiSelect = $("#technological_rating").kendoMultiSelect({
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

        

        //Search
        $("#search-btn").click(function(e) {

            e.preventDefault();

            //hide info-pane
            if($("#info-pane").is(":visible")){
                $("#info-pane").toggle("blind", 500);
            }

            //hide search-path-pane
            if($("#search-path-pane").is(":visible")){
                $("#search-path-pane").toggle("blind", 500);
            }

            //hide search-error-pane
            if($("#search-error-pane").is(":visible")){
                $("#search-error-pane").toggle("blind", 500);
            }

            //hide search-pane
            if($("#search-pane").is(":visible")){
                $("#search-pane").toggle("blind", 500);
            }

            $(this).data('clicked', true);

            var formData = $("#search-form").serializeArray();
            console.log("formData", formData);
            var dsSrcParams = [];
            aquisitionSourcesGlobal = "";
            labTypesGlobal = "";
            labIdGlobal = "";
            labWorkerGlobal = "";
            operationalRatingGlobal = "";
            technologicalRatingGlobal = "";
            labStateGlobal = "";

            $.each(formData, function(i, field) {
                dsSrcParams.push({'field': field.name, 'value': field.value});

                if(field.name=="aquisition_source"){
                    aquisitionSourcesGlobal += (aquisitionSourcesGlobal == "") ? field.value : "," + field.value;
                }
                if(field.name=="lab_type"){
                    labTypesGlobal += (labTypesGlobal == "") ? field.value : "," + field.value;
                }
                if(field.name=="lab_id"){
                    labIdGlobal += (labIdGlobal == "") ? field.value : "," + field.value;
                }
                if(field.name=="lab_worker"){
                    labWorkerGlobal += (labWorkerGlobal == "") ? field.value : "," + field.value;
                }
                if(field.name=="operational_rating"){
                    operationalRatingGlobal += (operationalRatingGlobal == "") ? field.value : "," + field.value;
                }
                if(field.name=="technological_rating"){
                    technologicalRatingGlobal += (technologicalRatingGlobal == "") ? field.value : "," + field.value;
                }
                if(field.name=="lab_checkbox_active"){
                    labStateGlobal += (labStateGlobal == "") ? "1" : ",1";
                }
                if(field.name=="lab_checkbox_suspended"){
                    labStateGlobal += (labStateGlobal == "") ? "2" : ",2";
                }
                if(field.name=="lab_checkbox_abolished"){
                    labStateGlobal += (labStateGlobal == "") ? "3" : ",3";
                }
            });

            //$("#school-units-grid").data("kendoGrid").dataSource.filter(dsSrcParams); //sets the filter configuration.
            $("#view0").data("kendoGrid").dataSource.filter(dsSrcParams); //sets the filter configuration.

        });

        //Clear Form
        $("#clear-btn").click( function() {

            //reset search form's text input values
            document.getElementById("search-form").reset();

            //reset search form's multiselect values ( reset method does not currenty support kendo widgets reset, .value("") will do the job )
            $("#regionEduAdmins").data("kendoMultiSelect").value("");
            $("#eduAdmins").data("kendoMultiSelect").value("");
            $("#transferAreas").data("kendoMultiSelect").value("");
            $("#municipalities").data("kendoMultiSelect").value("");
            $("#educationLevels").data("kendoMultiSelect").value("");
            $("#schoolUnitTypes").data("kendoMultiSelect").value("");               
            $("#labTypes").data("kendoMultiSelect").value("");
            $("#aquisitionSources").data("kendoMultiSelect").value("");
            $("#labWorkerRegNo").data("kendoMultiSelect").value("");
            $("#operational_rating").data("kendoMultiSelect").value("");
            $("#technological_rating").data("kendoMultiSelect").value("");
            

            //repopulate multi select boxes with default values
            $("#regionEduAdmins").data("kendoMultiSelect").setDataSource(regionEduAdminsDS);
            $("#eduAdmins").data("kendoMultiSelect").setDataSource(eduAdminsDS);
            $("#transferAreas").data("kendoMultiSelect").setDataSource(transferAreasDS);
            $("#municipalities").data("kendoMultiSelect").setDataSource(municipalitiesDS);
            $("#educationLevels").data("kendoMultiSelect").setDataSource(educationLevelsDS);
            $("#schoolUnitTypes").data("kendoMultiSelect").setDataSource(schoolUnitTypesDS);
            //$("#labTypes").data("kendoMultiSelect").setDataSource(labTypesDS);
            //$("#aquisitionSources").data("kendoMultiSelect").setDataSource(aquisitionSourcesDS);
            $('#checkbox_active').prop('checked', true);

        });

        //Close Info Pane
        $("#close-info-pane-btn").click( function() {
            //hide info-pane
            if($("#info-pane").is(":visible")){
                $("#info-pane").toggle("blind", 500);
            }
        });            
            
            
    });

</script>


<!--info pane-->
<div id="info-pane" style="display:none">
     <button id="close-info-pane-btn" type="button" class="close" aria-hidden="true">&times;</button>

     <div class="row info-pane-row">
        <div class="col-md-2"><h5>Συνολικά αποτελέσματα αναζήτησης</h5></div>
        <div class="col-md-9">
            <ul class="info-pane-ul">
                <li id='total_units'><span class='badge'></span>Σχολικές Μονάδες</li>
                <li id='total_labs'><span class='badge'></span>Διατάξεις Η/Υ </li>
            </ul>
        </div>
     </div>

     <div class="row info-pane-row">
        <div class="col-md-2"><h5>Συνολικά αποτελέσματα ανά κατηγορία</h5></div>       
        <div class="col-md-9">
            <ul class="info-pane-ul">
                <li id='sepehy-count'><span class='badge'></span>ΣεπεΗΥ</li>
                <li id='troxilato-count'><span class='badge'></span> Τροχήλατο </li>
                <li id='tomea-count'><span class='badge'></span> ΕΤΠ</li>
                <li id='gwnia-count'><span class='badge'></span> Γωνιά </li>
                <li id='diadrastiko-count'><span class='badge'></span> Διαδραστικό Σύστημα </li>
            </ul>
        </div>
     </div>
</div>

<!--search path pane-->
<div id="search-path-pane" style="display:none">
    <!--<span id="search-path-pane-label"> φίλτρα τελευταίας αναζήτησης </span>-->
    <!--<div id="search-path">-->
        <!--<div>-->
            <span class="tag1 glyphicon glyphicon-tags"></span>
            <span class="tag1 search-path-pane-tag"> Περιφερειακή Διεύθυνση Εκπαίδευσης </span>
            <span class="tag1" id="region-edu-admin-tag"></span>
        <!--</div>-->
        <!--<div>-->
            <span class="tag2 glyphicon glyphicon-tags"></span>
            <span class="tag2 search-path-pane-tag"> Διεύθυνση Εκπαίδευσης </span>
            <span class="tag2" id="edu-admin-tag"></span>
        <!--</div>-->
        <!--<div>-->
            <span class="tag3 glyphicon glyphicon-tags"></span>
            <span class="tag3 search-path-pane-tag"> Περιοχή Μετάθεσης </span>
            <span class="tag3" id="transfer-area-tag"></span>
        <!--</div>-->
        <!--<div>-->
            <span class="tag4 glyphicon glyphicon-tags"></span>
            <span class="tag4 search-path-pane-tag"> Δήμος </span>
            <span class="tag4" id="municipality-tag"></span>
        <!--</div>-->
        <!--<div>-->
            <span class="tag5 glyphicon glyphicon-tags"></span>
            <span class="tag5 search-path-pane-tag"> Όνομα Σχολικής Μονάδας </span>
            <span class="tag5" id="school-unit-name-tag"></span>
        <!--</div>-->
        <!--<div>-->
            <span class="tag6 glyphicon glyphicon-tags"></span>
            <span class="tag6 search-path-pane-tag"> Κωδικός Σχολικής Μονάδας </span>
            <span class="tag6" id="school-unit-id-tag"></span>
        <!--</div>-->
        <!--<div>-->
            <span class="tag7 glyphicon glyphicon-tags"></span>
            <span class="tag7 search-path-pane-tag"> Τύπος Σχολικής Μονάδας </span>
            <span class="tag7" id="school-unit-type-tag"></span>
<!--            </div>
        <div>-->
            <span class="tag8 glyphicon glyphicon-tags"></span>
            <span class="tag8 search-path-pane-tag"> Βαθμίδα εκπαίδευσης </span>
            <span class="tag8" id="education-level-tag"></span>
<!--            </div>
        <div>-->
            <span class="tag9 glyphicon glyphicon-tags"></span>
            <span class="tag9 search-path-pane-tag"> Κωδικός Διάταξης Η/Υ </span>
            <span class="tag9" id="lab-id-tag"></span>
<!--            </div>
        <div>-->
            <span class="tag10 glyphicon glyphicon-tags"></span>
            <span class="tag10 search-path-pane-tag"> Τύπος Διάταξης Η/Υ </span>
            <span class="tag10" id="lab-type-tag"></span>
<!--            </div>
        <div>-->
            <span class="tag11 glyphicon glyphicon-tags"></span>
            <span class="tag11 search-path-pane-tag"> Πηγή χρηματοδότησης Διάταξης Η/Υ </span>
            <span class="tag11" id="aquisition-source-tag"></span>
        <!--</div>-->
            <span class="tag12 glyphicon glyphicon-tags"></span>
            <span class="tag12 search-path-pane-tag"> Υπεύθυνος Διάταξης Η/Υ </span>
            <span class="tag12" id="lab-worker-tag"></span>
    <!--</div>-->
</div>

<!--search pane-->
<div id="search-pane" style="display:none">
    <form id="search-form">

        <div id="search-form-filters" class="row">
            <div class="col-md-1"></div>
            <div class="col-md-1 search-form-titles">
                <h5 >Στοιχεία Σχολικής Μονάδας</h5>
            </div>
            <div class="col-md-2">
                <label for="school_unit_id" >κωδικός Σχολικής Μονάδας</label>
                <input id="schoolUnitId" name="school_unit_id" class="form-control input-sm"/>

                <label for="name">όνομα Σχολικής Μονάδας</label>
                <input id="schoolUnitName" name="name" class="form-control input-sm"/>

                <label for="school_unit_type">τύπος Σχολικής Μονάδας</label>
                <select name="school_unit_type" id="schoolUnitTypes" multiple="multiple"></select>
                
                <div class="school_unit_operational_state">
                    <label>λειτουργική κατάσταση Σχολικής Μονάδας</label>
                    <label for='checkbox_active' class="checkbox_label"><input id='checkbox_active' name='checkbox_active' type="checkbox">ενεργή</label>
                    <label for='checkbox_suspended' class="checkbox_label"><input id='checkbox_suspended' name='checkbox_suspended' type="checkbox">σε αναστολή</label>
                    <label for='checkbox_abolished' class="checkbox_label"><input id='checkbox_abolished' name='checkbox_abolished' type="checkbox">κατηργημένη</label>
                </div>

            </div>
            <div class="col-md-2">
                <label for="region_edu_admin">Περιφερειακή Διεύθυνση Εκπαίδευσης</label>
                <select name="region_edu_admin" id="regionEduAdmins" multiple="multiple"></select>

                <label for="education_level">Βαθμίδα Εκπαίδευσης</label>
                <select name="education_level" id="educationLevels" multiple="multiple"></select>

                <label for="edu_admin">Διεύθυνση Εκπαίδευσης</label>
                <select name="edu_admin" id="eduAdmins" multiple="multiple"></select>

                <label for="transfer_area">Περιοχή Μετάθεσης</label>                    
                <select name="transfer_area" id="transferAreas" multiple="multiple"></select>

                <label for="municipality">Δήμος</label>
                <select name="municipality" id="municipalities" multiple="multiple"></select>
            </div>
            <div class="col-md-1  search-form-titles">
                <h5 >Στοιχεία Διάταξης Η/Υ</h5>
            </div>
            <div class="col-md-2">
                <label for="lab_id">κωδικός Διάταξης Η/Υ</label>
                <input id="labId" name="lab_id" class="form-control input-sm"/>

                <label for="lab_type">τύπος Διάταξης Η/Υ</label>
                <select name="lab_type" id="labTypes" multiple="multiple"/></select>

                <label for="aquisition_source">πηγή χρηματοδότησης Διάταξης Η/Υ</label>
                <select name="aquisition_source" id="aquisitionSources" multiple="multiple"/></select>

                <label for="lab_worker">υπεύθυνος Διάταξης Η/Υ</label>
                <select name="lab_worker" id="labWorkerRegNo" multiple="multiple"/></select>

            </div>
            <div class="col-md-2">

                <label for="operational_rating">λειτουργική βαθμολόγηση</label>
                <select name="operational_rating" id="operational_rating" multiple="multiple"/></select>

                <label for="technological_rating">τεχνολογική βαθμολόγηση</label>
                <select name="technological_rating" id="technological_rating" multiple="multiple"/></select>

                <div class="lab_operational_state">
                    <label>λειτουργική κατάσταση Διάταξης Η/Υ</label>
                    <label for='lab_checkbox_active' class="checkbox_label"><input id='lab_checkbox_active' name='lab_checkbox_active' type="checkbox">ενεργή</label>
                    <label for='lab_checkbox_suspended' class="checkbox_label"><input id='lab_checkbox_suspended' name='lab_checkbox_suspended' type="checkbox">σε αναστολή</label>
                    <label for='lab_checkbox_abolished' class="checkbox_label"><input id='lab_checkbox_abolished' name='lab_checkbox_abolished' type="checkbox">κατηργημένη</label>
                </div>

            </div>            
            <div class="col-md-1">
                <!--<button id="clear-btn" type="button" class="btn btn-warning btn-xs">καθαρισμός</button>-->
            </div>
        </div>

        <div id="search-form-button" class="row">
            <div class="col-md-2 col-md-offset-5">

               <!--<button id="clear-btn" type="button" class="btn btn-warning btn-xs">καθαρισμός</button>-->
               <button id="search-btn" type="submit" class="btn btn-primary btn-block">Αναζήτηση</button> <!-- type="button" -->
               <a href="#" id="clear-btn">καθαρισμός</a>
            </div>
        </div>

    </form>
</div>

<!--search error pane-->
<div id="search-error-pane" style="display:none"> <!--class="alert-msg alert alert-error"-->
    Υπάρχει κάποιο λάθος στα στοιχεία που εισήχθησαν κατά την αναζήτηση
</div>