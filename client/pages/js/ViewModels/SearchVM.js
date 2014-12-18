var SearchVM = kendo.observable({

    isVisible: false,

    school_unit_types_ds: newSchoolUnitTypesDS(),
    education_levels_ds: newEducationLevelsDS(),

    region_edu_admins_ds: newRegionEduAdminsDS(),
    edu_admins_ds: newEduAdminsDS(),
    transfer_areas_ds: newTransferAreasDS(),
    prefectures_ds: newPrefecturesDS(),
    municipalities_ds: newMunicipalitiesDS(),    
    
    lab_types_ds: newLabTypesDS(),
    aquisition_sources_ds : newAquisitionSourcesDS(),
    lab_workers_ds : newMyLabWorkersDS(), // περιμένω του κώστα το newMyLabWorkersDS(position)
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
        //console.log("SearchVM resetform e:", e);
        e.preventDefault();
        
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


        var filters = normalizeParams( $("#search-form").serializeArray() );
        SchoolUnitsViewVM.school_units.filter(filters);
        LabsViewVM.labs.filter(filters);
        searchParameters = filters;
        
        //fix kendo bug: button remains blurred after being pressed
        e.currentTarget.blur();
        
        //repopulate multi select boxes with default datasource values
//        $("#regionEduAdmins").data("kendoMultiSelect").setDataSource(regionEduAdminsDS);
//        $("#eduAdmins").data("kendoMultiSelect").setDataSource(eduAdminsDS);
//        $("#transferAreas").data("kendoMultiSelect").setDataSource(transferAreasDS);
//        $("#municipalities").data("kendoMultiSelect").setDataSource(municipalitiesDS);
//        $("#educationLevels").data("kendoMultiSelect").setDataSource(educationLevelsDS);
//        $("#schoolUnitTypes").data("kendoMultiSelect").setDataSource(schoolUnitTypesDS);   
        
    },
    filterGrids: function(e){
        var filters = normalizeParams( $("#search-form").serializeArray() );
        SchoolUnitsViewVM.school_units.filter(filters);
        LabsViewVM.labs.filter(filters);
        searchParameters = filters;
    },
    exportToXLSX: function(e){
        e.preventDefault();
        
        var search_xls_publication_in_progress_dialog = $("#search_xls_publication_in_progress_dialog").kendoWindow({
            title: "Έκδοση Excel",
            modal: true,
            visible: false,
            resizable: false,
            width: 400,
            pinned: true,
            actions: []
        }).data("kendoWindow");
        var search_xls_publication_failure_notification = $("#search_xls_publication_failure_notification").kendoNotification({
            animation: {
                open: {
                    effects: "slideIn:left",
                    duration:700
                },
                close: {
                    effects: "slideIn:left",
                    duration:1000,
                    reverse: true
                }
            },
            position: {
                pinned: true,
                top: 70,
                right: 30
            },
            allowHideAfter: 2000,
            autoHideAfter: 5000, //0 for no auto hide
            hideOnClick: true,
            stacking: "down",
            width:"25em"
        }).data("kendoNotification");
        
        search_xls_publication_in_progress_dialog.content();
        search_xls_publication_in_progress_dialog.center().open();        
        
        var filters = searchParameters;

        var normalizedFilter = {};
        $.each(filters, function(index, value){
            var filter = filters[index];
            var value = normalizedFilter[filter.field];
            value = (value ? value+"," : "")+ filter.value;
            normalizedFilter[filter.field] = value;                                   
        });

        var url = (LabsViewVM.isVisible) ? baseURL + 'search_labs?export=xlsx&' : baseURL + 'search_school_units?export=xlsx&';

        $.ajax({
                type: 'GET',
                url: url,
                dataType: "json",
                data: normalizedFilter,
                success: function(data){
                    search_xls_publication_in_progress_dialog.close();
                    if(typeof data.result !== "undefined"){
                        window.location.href = data.tmp_xlsx_filepath;
                    }else if(data.status === 500){
                        search_xls_publication_failure_notification.show("Η έκδοση του excel απέτυχε. " + data.message.substr(data.message.indexOf(":") + 1), "error");
                    }
                },
                error: function (data){
                    search_xls_publication_in_progress_dialog.close();
                    search_xls_publication_failure_notification.show("Υπήρξε κάποιο σφάλμα κατα την έκδοση του excel, παρακαλώ ξαναπροσπαθείστε.", "error");
                }
        });
    },
    
    labIDInfoTooltip: function(e){
        
        var tooltip = $(e.target).kendoTooltip({
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

        tooltip.show($(e.target));
    },
    schoolUnitIDInfoTooltip: function(e){

        var tooltip = $(e.target).kendoTooltip({
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
        
        tooltip.show($(e.target));
    },
    xlsTooltip: function(e){
        
        var tooltip = $(e.target).kendoTooltip({
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
        
        tooltip.show($(e.target));
    },
    
    panelBarUnselect:function(e){
        $(e.item).find("span").removeClass('k-state-selected');
    }
    
});