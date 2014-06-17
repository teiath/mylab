var LabsSearchVM = kendo.observable({

    school_unit_types_ds: newSchoolUnitTypesDS(),
    education_levels_ds: newEducationLevelsDS(),

    region_edu_admins_ds: newRegionEduAdminsDS(),
    edu_admins_ds: newEduAdminsDS(),
    transfer_areas_ds: newTransferAreasDS(),
    municipalities_ds: newMunicipalitiesDS(),    
    
    lab_types_ds: newLabTypesDS(),
    aquisition_sources_ds : newAquisitionSourcesDS(),
    lab_workers_ds : newWorkersDS(), // περιμένω του κώστα το newWorkersDS(position)
    lab_states_ds: newStatesDS(),
    school_unit_states_ds: newStatesDS(),
    lab_rating_ds: newRatingDS(),
    
    lab_id: "",                 //μονό
    name: "",                   //μονό
    special_name: "",           //μονό    
    lab_type: "",               //πολλαπλό
    creation_date: "",          //μονό
    
    aquisition_source: "",      //πολλαπλό
    lab_worker: "",             //πολλαπλό
    operational_rating: "",     //πολλαπλό
    technological_rating: "",   //πολλαπλό
    lab_state: "",              //μονό
    
    school_unit_id: "",         //μονό
    school_unit_name: "",       //μονό
    school_unit_type: "",       //πολλαπλό
    education_level: "",        //πολλαπλό
    school_unit_state: "",      //μονό
    
    region_edu_admin: "",       //πολλαπλό
    edu_admin: "",              //πολλαπλό
    transfer_area: "",          //πολλαπλό
    municipality: "",           //πολλαπλό
    

    resetForm: function(e) {

        e.preventDefault();
        console.log("resetform e:", e);
        
        this.set("lab_id", "");
        this.set("name", "");
        this.set("special_name", "");
        this.set("lab_type", "");
        this.set("creation_date", "");
        
        this.set("aquisition_source", "");
        this.set("lab_worker", "");
        this.set("operational_rating", "");
        this.set("technological_rating", "");
        this.set("lab_state", "");        
        
        this.set("school_unit", "");
        this.set("school_unit_type", "");
        this.set("education_level", "");
        this.set("school_unit_state", "");
        
        this.set("region_edu_admin", "");
        this.set("edu_admin", "");
        this.set("transfer_area", "");
        this.set("municipality", "");


        var formData = $("#search-form").serializeArray();
        LabsViewVM.labs.filter(normalizeParams(formData));
        
//        CASCADING fields repopulate multi select boxes with default values
//        $("#regionEduAdmins").data("kendoMultiSelect").setDataSource(regionEduAdminsDS);
//        $("#eduAdmins").data("kendoMultiSelect").setDataSource(eduAdminsDS);
//        $("#transferAreas").data("kendoMultiSelect").setDataSource(transferAreasDS);
//        $("#municipalities").data("kendoMultiSelect").setDataSource(municipalitiesDS);
//        $("#educationLevels").data("kendoMultiSelect").setDataSource(educationLevelsDS);
//        $("#schoolUnitTypes").data("kendoMultiSelect").setDataSource(schoolUnitTypesDS);   
        
    },
    filterChanged: function(e){
        console.log("filterChanged e :", e);
        var formData = $("#search-form").serializeArray();
        LabsViewVM.labs.filter(normalizeParams(formData));
    },
    toolbarFilter: function(e){

        //console.log("toolbarFilter e:", e);
        //console.log("this: ", this);

        var grid = e.sender.wrapper.closest(".k-grid").data("kendoGrid");
        var filter = [{name: "lab_type", value: this.lab_type}];        
        grid.dataSource.filter(normalizeParams(filter));
    }
    
    
});

//      CASCADING fields
//    regionEduAdminChanged: function(e){
//        console.log("regionEduAdminChanged e :", e);
//        var selected_region_edu_admins = this.region_edu_admin;
//        //console.log("this: ", this);
//        
//        //var edu_admin = $("#sl_edu_admin").data("kendoMultiSelect");
//        //var edu_admin = e.sender;
//        //edu_admin.setDataSource(newEduAdminsDS());
//        //this.set("edu_admins_ds",  newEduAdminsDS());
//        LabsViewVM.labs.filter(selected_region_edu_admins);
//    },