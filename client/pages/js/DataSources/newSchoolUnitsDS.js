// !Αυτό το Datasource ΔΕΝ ειναι ολοκληρωμένο. Πρέπει η αναζήτηση πέραν του ονόματος 
//  της σχολικής μονάδας να γίνεται και με το school_unit_id

function newSchoolUnitsDS(){
    
    var school_units_ds =  new kendo.data.DataSource({
                                    serverFiltering: true,
                                    transport: {
                                        read: {
                                            url: "api/school_units",
                                            type: "GET",
                                            dataType: "json"
                                        },
                                        parameterMap: function(data, type) {

                                            console.log("newSchoolUnitsDS parametermap data", data);
                                            if (type === 'read') {
                                                if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {
                                                    data["name"] = data.filter.filters[0].value;
                                                    delete data.filter;
                                                }
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
                                                  name: {},
                                                  text_field_template: {}
                                            }
                                        }
                                    },
                                    change: function(e){ 
                                        console.log("newSchoolUnitsDS change event:", e);
                                    },
                                    requestEnd: function(e){
                                        console.log("newSchoolUnitsDS requestEnd event:", e);
                                        
                                        $.each(e.response.data, function(index, value){
                                            e.response.data[index].text_field_template = e.response.data[index].name + " | " + e.response.data[index].school_unit_id;
                                        });                                        
                                        
                                    }
                                });
    return school_units_ds;
    
}