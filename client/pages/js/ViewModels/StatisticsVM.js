var StatisticsVM = kendo.observable({

    isVisible: false,

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
    
//    hideSameValue: function(e) {
//        console.log("hideSameValue e: ", e);
//        if(e.sender.element[0].id === "st_x_axis"){
//            console.log( StatisticsVM.axis_y_ds.data());//.used = true;
//            console.log("axis_y_ds: ", StatisticsVM.axis_y_ds);
//        }
//        
//    },
    resetForm: function(e) {

        e.preventDefault();

        this.set("x_axis", "");
        this.set("y_axis", "");

        this.set("lab_type", "");
        this.set("lab_state", "");
        this.set("operational_rating", "");
        this.set("technological_rating", "");
        
        this.set("school_unit_type", "");
        this.set("education_level", "");
        this.set("school_unit_state", "");
        
        this.set("region_edu_admin", "");
        this.set("edu_admin", "");
        this.set("transfer_area", "");
        this.set("municipality", "");
        this.set("prefecture", "");
        
    },
    getStatistic: function(e){
        
        e.preventDefault();
        
        jQuery("#statistics-table tbody").empty();
        jQuery("#statistics-table thead tr").empty();
        jQuery("#statistics-table thead tr").append("<th></th>");
        
        var formData = $("#statistics-form").serializeArray();
        var parameters = normalizeParams(formData);
        
        var normalizedFilter = {};
        $.each(parameters, function(index, value){
            var filter = parameters[index];
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
                    }else if (typeof data.message_internal !== 'undefined'){
                        message= data.message_internal;
                    }else if (typeof data.message_external !== 'undefined'){
                        message= data.message_external;
                    }

                    if(data.status == 500){

                        notification.show({
                            title: "Η εξαγωγή του στατιστικού απέτυχε",
                            message: message
                        }, "error");

                    }else{

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
                            jQuery("#statistics-table thead tr").append("<th>" + axis_x[j] + "</th>");
                        }

                        for (var i = 0; i < axis_y.length; i++) {
                            jQuery("#statistics-table tbody").append("<tr id=" + i + "><th class='text-nowrap'>" + axis_y[i] + "</th></tr>");

                            for(var j = 0; j < axis_x.length; j++){
                                jQuery("#"+i).append("<td> </td>");
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
                                    console.log("column: " + column + ", row: " + row + ", value: " + value);
                                }
                            }
                            
                        }
                                               
                        console.log("axis_x: ", axis_x);
                        console.log("axis_y: ", axis_y);
                        
                    }
            },
            error: function (data){
                console.log("GET statistic_units error data: ", data); 
            }
        });

    }
    
});