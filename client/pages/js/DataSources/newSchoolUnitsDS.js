// !Αυτό το Datasource ΔΕΝ ειναι ολοκληρωμένο. Πρέπει η αναζήτηση πέραν του ονόματος 
//  της σχολικής μονάδας να γίνεται και με το school_unit_id

function newSchoolUnitsDS(school_units_state){
    
    /* 
     * 1. 'search_school_units' api function : used to populate school units combobox, inside create lab popup
     * 2. 'school_units' api function : used to populate school units combobox, inside lab relations inline edit
     * 'school_units_state' parameter is passed to newSchoolUnitsDS, in order to distinguish those two cases
     * 
     * Ο λόγος που στην περίπτωση 2 χρησιμοποιείται η school_units ειναι επειδή αυτή ΔΕΝ απαιτεί δικαιώματα.
    */
    
    var school_units_ds =  new kendo.data.DataSource({
                                    serverFiltering: true,
                                    transport: {
                                        read: {
                                            url: (typeof school_units_state === "undefined") ? "api/school_units" : "api/search_school_units",
                                            type: "GET",
                                            dataType: "json"
                                        },
                                        parameterMap: function(data, type) {

                                            if (type === 'read') {
                                                if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined' && typeof data.filter.filters[0] !== 'undefined') {
                                                    
                                                    if(typeof school_units_state !== "undefined"){
                                                        data["school_unit_name"] = data.filter.filters[0].value;
                                                    }else{
                                                        data["name"] = data.filter.filters[0].value;
                                                    }
                                                    
                                                    delete data.filter;
                                                }
                                            }
                                            
                                            if(typeof school_units_state !== "undefined"){
                                                data["school_unit_state"] = school_units_state; // user is able to create labs only for the ACTIVE school units
                                            }else{
                                                data["state"] = 1;
                                            }
                                            return data;
                                        }
                                    },
                                    schema: {
                                        data: 'data',
                                        model:{
                                            id: "school_unit_id",
                                            fields:{
                                                  school_unit_id: {},
                                                  school_unit_name: {},
                                                  school_unit_state:{},
                                                  text_field_template: {}
                                            }
                                        }
                                    },
                                    change: function(e){ 
                                        //console.log("newSchoolUnitsDS change event:", e);
                                    },
                                    requestEnd: function(e){
                                        //console.log("newSchoolUnitsDS requestEnd event:", e);
                                        
                                        $.each(e.response.data, function(index, value){
                                            e.response.data[index].text_field_template = e.response.data[index].school_unit_name + " | " + e.response.data[index].school_unit_id;
                                        });                                        
                                        
                                    }
                                });
    return school_units_ds;
    
}