var SearchLabWorkersVM = kendo.observable({

    isVisible: false,

    mylab_workers_ds : newMyLabWorkersDS(),
    lab_worker_status_ds: new kendo.data.DataSource({ data: [ {id: 1, name: "ενεργός" }, { id: 3, name: "ανενεργός" }] }),
    
    lab_states_ds: newStatesDS(),
    lab_types_ds: newLabTypesDS(),
    
    school_unit_types_ds: newSchoolUnitTypesDS(),
    education_levels_ds: newEducationLevelsDS(),
    school_unit_states_ds: newStatesDS(),
    region_edu_admins_ds: newRegionEduAdminsDS(),
    edu_admins_ds: newEduAdminsDS(),
    transfer_areas_ds: newTransferAreasDS(),
    prefectures_ds: newPrefecturesDS(),
    municipalities_ds: newMunicipalitiesDS(),    
   
    worker_uid:"",
    worker_registry_no:"",
    lab_worker_status:"",
    
    lab_id: "",                 //μονό
    lab_name: "",               //μονό
    lab_type: "",               //πολλαπλό
    lab_state: "",              //πολλαπλό
    
    school_unit_id: "",         //μονό
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
        
        this.set("worker_registry_no", "");
        this.set("worker_uid", "");
        this.set("lab_worker_status", "");
        
        this.set("lab_id", "");
        this.set("lab_name", "");
        this.set("lab_type", "");
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

        SearchLabWorkersVM.filterLabWorkersGrid();
        
        //fix kendo bug: button remains blurred after being pressed
        e.currentTarget.blur();
        
    },
    filterLabWorkersGrid: function(e){
        var filters = normalizeParams( $("#search-lab-workers-form").serializeArray() );
        LabWorkersViewVM.lab_workers.filter(filters);
        searchWorkersParameters = filters;
    },
    exportToXLSX: function(e){
        e.preventDefault();
        
        var search_lab_workers_xls_publication_in_progress_dialog = $("#search_lab_workers_xls_publication_in_progress_dialog").kendoWindow({
            title: "Έκδοση Excel",
            modal: true,
            visible: false,
            resizable: false,
            width: 400,
            pinned: true,
            actions: []
        }).data("kendoWindow");
        var search_lab_workers_xls_publication_failure_notification = $("#search_lab_workers_xls_publication_failure_notification").kendoNotification({
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
               
        search_lab_workers_xls_publication_in_progress_dialog.content();
        search_lab_workers_xls_publication_in_progress_dialog.center().open();        
        
        var filters = searchWorkersParameters;

        var normalizedFilter = {};
        $.each(filters, function(index, value){
            var filter = filters[index];
            var value = normalizedFilter[filter.field];
            value = (value ? value+"," : "")+ filter.value;
            normalizedFilter[filter.field] = value;                                   
        });

        $.ajax({
                type: 'GET',
                url: baseURL + 'find_lab_workers?export=XLSX',
                dataType: "json",
                data: normalizedFilter,
                success: function(data){
                    search_lab_workers_xls_publication_in_progress_dialog.close();
                    if(typeof data.result !== "undefined"){
                        window.location.href = data.tmp_xlsx_filepath;
                    }else if(data.status === 500){
                        search_lab_workers_xls_publication_failure_notification.show("Η έκδοση του excel απέτυχε. " + data.message.substr(data.message.indexOf(":") + 1), "error");
                    }
                },
                error: function (data){
                    search_lab_workers_xls_publication_in_progress_dialog.close();
                    search_lab_workers_xls_publication_failure_notification.show("Υπήρξε κάποιο σφάλμα κατα την έκδοση του excel, παρακαλώ ξαναπροσπαθείστε.", "error");
                }
        });
    },
    infoTooltip: function(e){
        
        var tooltip = $(e.target).kendoTooltip({
            autoHide: true,
            content: function(e) {
                var content;
                if(e.target.attr("id") === "slw_worker_uid"){
                    content = "για την εισαγωγή περισσότερων UID, διαχωρίστε με κόμμα";
                }else if(e.target.attr("id") === "slw_lab_id"){
                    content = "για την εισαγωγή περισσότερων Κωδικών Διατάξεων Η/Υ, διαχωρίστε με κόμμα";
                }else if(e.target.attr("id") === "slw_school_unit_id"){
                    content = "για την εισαγωγή περισσότερων Κωδικών Σχολικών Μονάδων, διαχωρίστε με κόμμα";
                }
                return content;
            },
            width:185,
            //height:50,
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