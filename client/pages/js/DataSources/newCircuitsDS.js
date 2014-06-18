function newCircuitsDS(){
    
    var circuits_ds =  new kendo.data.DataSource({
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/circuits",
                                type: "GET",
                                dataType: "json"
                            }//,
//                            parameterMap: function(data, type) {
//
//                                console.log("newCircuitsDS parametermap data", data);
//                                if (type === 'read') {
//                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {
//                                        data['school_unit'] = data.filter.filters[0].value;
//                                        delete data.filter;
//                                    }
//                                }
//                                return data;
//                            }
                        },
                        schema: {
                            data: 'data',
                            model:{
                                id: "circuit_id",
                                fields:{
                                      circuit_id: {},
                                      phone_number: {},
                                      updated_date: {},
                                      status: {},
                                      circuit_type: {},
                                      circuit_type_name: {},
                                      school_unit_id: {},
                                      school_unit_name: {}
                                }
                            }
                        },
                        change: function(e){ 
                            console.log("newCircuitsDS change event:", e);
                        },
                        requestEnd: function(e){
                            console.log("newCircuitsDS requestEnd event:", e);
                        }
                    });
                    
    return circuits_ds;
    
}