var StatisticsVM = kendo.observable({

    isVisible: false,
    filtersPaneVisible: false,
    statisticTableVisible: false,
    sameValueValidationVisible: false,
    bothFieldsValidationVisible:false,

    axis_x_ds: newAxisXDS(),
    axis_y_ds: newAxisYDS(),

    school_unit_types_ds: newSchoolUnitTypesDS(),
    education_levels_ds: newEducationLevelsDS(),

    region_edu_admins_ds: newRegionEduAdminsDS(),
    edu_admins_ds: newEduAdminsDS(),
    transfer_areas_ds: newTransferAreasDS(),
    municipalities_ds: newMunicipalitiesDS(),  
    prefectures_ds: newPrefecturesDS(),  
    
    school_unit_states_ds: newStatesDS(),
    
    lab_types_ds: newLabTypesDS(),
    lab_states_ds: newStatesDS(),
   
    lab_rating_ds: newRatingDS(),
    has_lab_worker_ds: new kendo.data.DataSource({ data: [ {id: 1, name: "ναι" }, { id: 3, name: "όχι" }] }),
    
    x_axis: "",
    y_axis: "",

    
    lab_type: "",               //πολλαπλό
    operational_rating: "",     //πολλαπλό
    technological_rating: "",   //πολλαπλό
    lab_state: "",              //πολλαπλό
    
    school_unit_type: "",       //πολλαπλό
    education_level: "",        //πολλαπλό
    school_unit_state: "",      //πολλαπλό
    
    region_edu_admin: "",       //πολλαπλό
    edu_admin: "",              //πολλαπλό
    transfer_area: "",          //πολλαπλό
    municipality: "",           //πολλαπλό
    prefecture:"",
    
    resetAxisAndFilters: function(e) {

        e.preventDefault();

        this.set("x_axis", "");
        this.set("y_axis", "");

        this.set("lab_type", "");
        this.set("lab_state", "");
        this.set("operational_rating", "");
        this.set("technological_rating", "");
        this.set("has_lab_worker", "");
        
        this.set("school_unit_type", "");
        this.set("education_level", "");
        this.set("school_unit_state", "");
        
        this.set("region_edu_admin", "");
        this.set("edu_admin", "");
        this.set("transfer_area", "");
        this.set("municipality", "");
        this.set("prefecture", "");
        
        StatisticsVM.set("bothFieldsValidationVisible", false);
        StatisticsVM.set("sameValueValidationVisible", false);
        
    },
    exportStatisticTable: function(e){

        e.preventDefault();
        
        if (StatisticsVM.x_axis === "" || StatisticsVM.y_axis === ""){
            StatisticsVM.set("bothFieldsValidationVisible", true);
            StatisticsVM.set("sameValueValidationVisible", false);
        }else if(StatisticsVM.x_axis === StatisticsVM.y_axis){
            StatisticsVM.set("bothFieldsValidationVisible", false);
            StatisticsVM.set("sameValueValidationVisible", true); 
        }else{
            
            StatisticsVM.set("bothFieldsValidationVisible", false);
            StatisticsVM.set("sameValueValidationVisible", false); 
            StatisticsVM.set("statisticTableVisible", false);
            
            var statistics_table_publication_in_progress_dialog = $("#statistics_table_publication_in_progress_dialog").kendoWindow({
                title: "Έκδοση Στατιστικού",
                modal: true,
                visible: false,
                resizable: false,
                width: 400,
                pinned: true,
                actions: []
            }).data("kendoWindow");
            var statistics_table_publication_failure_notification = $("#statistics_xls_publication_failure_notification").kendoNotification({
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
            
            statistics_table_publication_in_progress_dialog.content();
            statistics_table_publication_in_progress_dialog.center().open();          

            jQuery("#statistics-table tbody").empty();
            jQuery("#statistics-table thead tr").empty();
            jQuery("#statistics-table thead tr").append("<th></th>");

            var filters = normalizeParams( $("#statistics-form").serializeArray() );
            statisticParameters = filters;

            var normalizedFilter = {};
            $.each(filters, function(index, value){
                var filter = filters[index];
                var value = normalizedFilter[filter.field];
                value = (value ? value+"," : "")+ filter.value;
                normalizedFilter[filter.field] = value;                                   
            });        


            $.ajax({
                type: "GET",
                url: config.serverUrl + "stat_labs",
                dataType: "json",
                data: normalizedFilter,
                success: function(data){

                        var message;
                        if (typeof data.message !== 'undefined'){
                            message= data.message;
                        }
                        
                        if(data.status == 500){
                            statistics_table_publication_in_progress_dialog.close();
                            statistics_table_publication_failure_notification.show("Η έκδοση του στατιστικού απέτυχε. " + message.substr(message.indexOf(":") + 1), "error");
                        }else if(data.results.length === 0){
                            statistics_table_publication_in_progress_dialog.close();
                            statistics_table_publication_failure_notification.show("Δεν υπάρχουν διαθέσιμα στατιστικά για τις τιμές που εισήχθησαν.", "info");
                        }else{

                            statistics_table_publication_in_progress_dialog.close(); 

                            var results = data.results;
                            var axis_x=[], axis_y=[];
                            var keys = _.keys(results[0]);

                            //populate arrays with axis x&y values
                            for (var i = 0; i < results.length; i++) {
                                if(jQuery.inArray( results[i][keys[0]], axis_x ) === -1){
                                    axis_x.push(results[i][keys[0]]);
                                }
                                if(jQuery.inArray( results[i][keys[1]], axis_y ) === -1){
                                    axis_y.push(results[i][keys[1]]);
                                }
                            }

                            for (var j = 0; j < axis_x.length; j++) {
                                jQuery("#statistics-table thead tr").append("<th style='white-space:nowrap'>" + axis_x[j] + "</th>");
                            }

                            for (var i = 0; i < axis_y.length; i++) {
                                jQuery("#statistics-table tbody").append("<tr id=" + i + "><th class='text-nowrap'>" + axis_y[i] + "</th></tr>");

                                for(var j = 0; j < axis_x.length; j++){
                                    jQuery("#"+i).append("<td style='text-align: center;'> </td>");
                                }
                            }

                            for (var i = 0; i < results.length; i++) {

                                var axisX = results[i][keys[0]];
                                var axisY = results[i][keys[1]];
                                var value = results[i][keys[2]];

                                var column = jQuery.inArray( axisX, axis_x );

                                var row;
                                for (var k = 0; k < axis_y.length; k++) {
                                    if(axis_y[k] === axisY){
                                        row = k;
                                        jQuery("#statistics-table tbody").find("tr:eq(" + row + ")>td:eq(" + column + ")").text(value);
                                        //console.log("column: " + column + ", row: " + row + ", value: " + value);
                                    }
                                }

                            }

                            StatisticsVM.set("statisticTableVisible", true);
                            //scroll to the beginning of the statistic table
                            $('html, body').animate({
                                scrollTop: $("#statistics-results").offset().top
                            }, 1000);
                        }
                },
                error: function (data){
                    statistics_table_publication_in_progress_dialog.close();
                    statistics_table_publication_failure_notification.show("Υπήρξε κάποιο σφάλμα κατα την έκδοση του στατιστικού, παρακαλώ ξαναπροσπαθείστε.", "error");
                }
            });
        }
    },     
    exportStatisticExcel: function(e){
        e.preventDefault();
               
        if (StatisticsVM.x_axis === "" || StatisticsVM.y_axis === ""){
            StatisticsVM.set("bothFieldsValidationVisible", true);
            StatisticsVM.set("sameValueValidationVisible", false);
        }else if(StatisticsVM.x_axis === StatisticsVM.y_axis){
            StatisticsVM.set("bothFieldsValidationVisible", false);
            StatisticsVM.set("sameValueValidationVisible", true); 
        }else{
                            
            StatisticsVM.set("bothFieldsValidationVisible", false);
            StatisticsVM.set("sameValueValidationVisible", false);
            
            var statistics_xls_publication_in_progress_dialog = $("#statistics_xls_publication_in_progress_dialog").kendoWindow({
                title: "Έκδοση Excel",
                modal: true,
                visible: false,
                resizable: false,
                width: 400,
                pinned: true,
                actions: []
            }).data("kendoWindow");
            var statistics_xls_publication_failure_notification = $("#statistics_xls_publication_failure_notification").kendoNotification({
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
          
            statistics_xls_publication_in_progress_dialog.content();
            statistics_xls_publication_in_progress_dialog.center().open();            
            
            var filters = normalizeParams( $("#statistics-form").serializeArray() );
            statisticParameters = filters;

            var normalizedFilter = {};
            $.each(filters, function(index, value){
                var filter = filters[index];
                var value = normalizedFilter[filter.field];
                value = (value ? value+"," : "")+ filter.value;
                normalizedFilter[filter.field] = value;                                   
            });

            $.ajax({
                type: 'GET',
                url: config.serverUrl + "stat_labs?export=XLSX&",
                dataType: "json",
                data: normalizedFilter,
                success: function(data){
                    statistics_xls_publication_in_progress_dialog.close();
                    if(typeof data.result !== "undefined"){
                        window.location.href = data.tmp_xlsx_filepath;
                    }else if(data.status === 500){
                        statistics_xls_publication_failure_notification.show("Η έκδοση του excel απέτυχε. " + data.message.substr(data.message.indexOf(":") + 1), "error");
                    }
                },
                error: function (data){
                    statistics_xls_publication_in_progress_dialog.close();
                    statistics_xls_publication_failure_notification.show("Υπήρξε κάποιο σφάλμα κατα την έκδοση του excel, παρακαλώ ξαναπροσπαθείστε.", "error");
                }
            });
        }
    },
    toggleFiltersPane: function(e){

        if($('#show_statistic_filters_btn').find('span').hasClass("k-i-arrow-e")){
            $('#show_statistic_filters_btn').find('span').removeClass("k-i-arrow-e");
            $('#show_statistic_filters_btn').find('span').addClass("k-i-arrow-s");
        }else{
            $('#show_statistic_filters_btn').find('span').addClass("k-i-arrow-e");
            $('#show_statistic_filters_btn').find('span').removeClass("k-i-arrow-s");
        }
        
        StatisticsVM.filtersPaneVisible ? StatisticsVM.set("filtersPaneVisible", false) : StatisticsVM.set("filtersPaneVisible", true);
    }
});