var SearchVM = kendo.observable({

    isVisible: true,

    school_unit_types_ds: newSchoolUnitTypesDS(),
    education_levels_ds: newEducationLevelsDS(),

    region_edu_admins_ds: newRegionEduAdminsDS(),
    edu_admins_ds: newEduAdminsDS(),
    transfer_areas_ds: newTransferAreasDS(),
    prefectures_ds: newPrefecturesDS(),
    municipalities_ds: newMunicipalitiesDS(),    
    
    lab_types_ds: newLabTypesDS(),
    aquisition_sources_ds : newAquisitionSourcesDS(),
    lab_workers_ds : newWorkersDS(), // περιμένω του κώστα το newWorkersDS(position)
    lab_states_ds: newStatesDS(),
    school_unit_states_ds: newStatesDS(),
    lab_rating_ds: newRatingDS(),
    
    lab_id: "",                 //πολλαπλό
    lab_name: "",               //μονό
    lab_special_name: "",       //μονό    
    lab_type: "",               //πολλαπλό
    creation_date: "",          // μονό
    
    aquisition_source: "",      //πολλαπλό
    lab_worker: "",             //πολλαπλό
    operational_rating: "",     //πολλαπλό
    technological_rating: "",   //πολλαπλό
    lab_state: "",              //πολλαπλό
    
    school_unit_id: "",         //πολλαπλό
    school_unit_name: "",       //μονό
    school_unit_type: "",       //πολλαπλό
    education_level: "",        //πολλαπλό
    school_unit_state: "",      //πολλαπλό
    
    region_edu_admin: "",       //πολλαπλό
    edu_admin: "",              //πολλαπλό
    transfer_area: "",          //πολλαπλό
    prefecture:"",              //πολλαπλό
    municipality: "",           //πολλαπλό
    
    resetForm: function(e) {

        e.preventDefault();
        //console.log("resetform e:", e);
        
        this.set("lab_id", "");
        this.set("lab_name", "");
        this.set("lab_special_name", "");
        this.set("lab_type", "");
        this.set("creation_date", "");
        
        this.set("aquisition_source", "");
        this.set("lab_worker", "");
        this.set("operational_rating", "");
        this.set("technological_rating", "");
        this.set("lab_state", "");        
        
        this.set("school_unit_id", "");
        this.set("school_unit_name", "");
        this.set("school_unit_type", "");
        this.set("education_level", "");
        this.set("school_unit_state", "");
        
        this.set("region_edu_admin", "");
        this.set("edu_admin", "");
        this.set("transfer_area", "");
        this.set("prefecture", "");
        this.set("municipality", "");


        var formData = $("#search-form").serializeArray();
        SchoolUnitsViewVM.school_units.filter(normalizeParams(formData));
        LabsViewVM.labs.filter(normalizeParams(formData));
        //repopulate multi select boxes with default datasource values
//        $("#regionEduAdmins").data("kendoMultiSelect").setDataSource(regionEduAdminsDS);
//        $("#eduAdmins").data("kendoMultiSelect").setDataSource(eduAdminsDS);
//        $("#transferAreas").data("kendoMultiSelect").setDataSource(transferAreasDS);
//        $("#municipalities").data("kendoMultiSelect").setDataSource(municipalitiesDS);
//        $("#educationLevels").data("kendoMultiSelect").setDataSource(educationLevelsDS);
//        $("#schoolUnitTypes").data("kendoMultiSelect").setDataSource(schoolUnitTypesDS);   
        
    },
    filterChanged: function(e){
        //console.log("filterChanged e :", e);
        var formData = $("#search-form").serializeArray();
        SchoolUnitsViewVM.school_units.filter(normalizeParams(formData));
        LabsViewVM.labs.filter(normalizeParams(formData));
        
        searchParameters = formData;
    },
    exportToXLSX: function(e){
        e.preventDefault();
        
        var parameters = normalizeParams(searchParameters);
        //console.log("parameters:", parameters);

        var normalizedFilter = {};
        $.each(parameters, function(index, value){
            var filter = parameters[index];
            var value = normalizedFilter[filter.field];
            value = (value ? value+"," : "")+ filter.value;
            normalizedFilter[filter.field] = value;                                   
        });
        //console.log("normalizedFilter: ", normalizedFilter);

        var url;
        if(LabsViewVM.isVisible){
        //if($('#switch_to_labs_view_btn').is(':checked')){
            url = baseURL + 'search_labs?export=xlsx&';
        }else{
            url = baseURL + 'search_school_units?export=xlsx&';
        }        

        $.ajax({
                type: 'GET',
                url: url,
                dataType: "json",
                data: normalizedFilter,
                success: function(data){
                    window.location.href = data.tmp_xlsx_filepath;
                },
                error: function (data){ 
                    console.log("export to xls data failed: ", data);
                    var xls_download_error_dialog = $("#xls_download_error_dialog").kendoWindow({
                        title: "Αποτυχία Έκδοσης .xls Αρχείου",
                        modal: true,
                        visible: false,
                        resizable: false,
                        width: 400,
                        pinned: true
                    }).data("kendoWindow");

                    xls_download_error_dialog.content();
                    xls_download_error_dialog.center().open();
                }
        });
    },
    labIDInfoTooltip: function(e){
        var tooltip = $("#sl_lab_id").kendoTooltip({
            autoHide: true,
            content:"για εισαγωγή περισσότερων κωδικών διαχωρίστε με κόμμα",
            width:185,
            height:35,
            position: "left",
            animation: {
                close: {effects: "fade:out",  duration: 1000},
                open: {effects: "fade:in",  duration: 1000}
            }
        }).data("kendoTooltip");

        tooltip.show($("#sl_lab_id"));
    },
    schoolUnitIDInfoTooltip: function(e){
        var tooltip = $("#sl_school_unit_id").kendoTooltip({
            autoHide: true,
            content:"για εισαγωγή περισσότερων κωδικών διαχωρίστε με κόμμα",
            width:185,
            height:35,
            position: "left",
            animation: {
                close: {effects: "fade:out",  duration: 1000},
                open: {effects: "fade:in",  duration: 1000}
            }
        }).data("kendoTooltip");
        tooltip.show($("#sl_school_unit_id"));
    },
    xlsTooltip: function(e){

        var tooltip = $(".export_to_xlsx").kendoTooltip({
            autoHide: true,
            content:"εξαγωγή σε .xlsx",
            width:95,
            height:20,
            position: "top",
            animation: {
                close: {effects: "fade:out",  duration: 500},
                open: {effects: "fade:in",  duration: 500}
            }
        }).data("kendoTooltip");
        tooltip.show($(".export_to_xlsx"));
    },
    
    panelBarCollapse:function(e){
        //console.log("panelBarCollapse!!", e.item);
        $(e.item).find("span").removeClass('k-state-selected');
    }
    
});