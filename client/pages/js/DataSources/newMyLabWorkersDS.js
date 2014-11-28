function newMyLabWorkersDS(){
    
    var workers_ds =  new kendo.data.DataSource({
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/mylab_workers",
                                type: "GET",
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {
                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined' && typeof data.filter.filters[0] !== 'undefined') {
                                        data["worker"] = data.filter.filters[0].value;
                                        delete data.filter;
                                    }
                                }
                                return data;
                            }
                        },
                        schema: {
                            data: 'data',
                            model:{
                                id: "worker_id",
                                fields:{
                                      worker_id: {},
                                      registry_no: {},
                                      uid:{},
                                      firstname: {},
                                      lastname: {},
                                      fathername: {},
                                      email:{},
                                      worker_specialization: {},
                                      lab_source:{}, //source:{},
                                      worker:{},
                                      fullname: {type:"string"}
                                }
                            }
                        },
                        //filter: { field: "used", operator: "neq", value: true },
                        //change: function(e){ console.log("newMyLabWorkersDS change event:", e); },
                        requestEnd: function(e){
                            //console.log("newMyLabWorkersDS requestEnd event:", e);
                            $.each(e.response.data, function(index, value){
                                e.response.data[index].fullname = e.response.data[index].lastname + " " + e.response.data[index].firstname + " (ΑΜ: " + e.response.data[index].registry_no + ")";
                            });

                        }
                    });
                    
    return workers_ds;
    
}