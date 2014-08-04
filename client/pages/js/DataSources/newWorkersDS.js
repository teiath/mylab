function newWorkersDS(){
    
    var workers_ds =  new kendo.data.DataSource({
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/workers",
                                type: "GET",
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {

                                //console.log("newWorkersDS parametermap data", data);
                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {
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
                                      tax_number: {},
                                      firstname: {},
                                      lastname: {},
                                      fathername: {},
                                      sex: {},
                                      worker_specialization: {},
                                      fullname: {type:"string"},
                                      worker:{}
                                }
                            }
                        },
                        //filter: { field: "used", operator: "neq", value: true },
                        change: function(e){ 
                            //console.log("newWorkersDS change event:", e);
                        },
                        requestEnd: function(e){
                            //console.log("newWorkersDS requestEnd event:", e);

                            $.each(e.response.data, function(index, value){
                                e.response.data[index].fullname = e.response.data[index].lastname + " " + e.response.data[index].firstname + " (ΑΜ: " + e.response.data[index].registry_no + ")";
                            });

                        }
                    });
                    
    return workers_ds;
    
}