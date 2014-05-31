function newLabResponsiblesDS(){

    var lab_responisbles_ds =  new kendo.data.DataSource({
        
            serverFiltering: true,
            transport: {
                read: {
                    url: "api/lab_workers",
                    type: "GET",
                    dataType: "json"
                },
                parameterMap: function(data, type) {

                    console.log("newLabResponsiblesDS parametermap data", data);
                    if (type === 'read') {
                        if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {
                            data["lab_worker"] = data.filter.filters[0].value;
                            delete data.filter;
                        }
                    }
                    return data;
                }
            },
            schema:{
                data: "data",
                total: "total",
                model:{
                    id:"worker_id",
                    fields:{

                        lab_id:{},
                        lab:{},
                        worker_id: {},  
                        worker_position:{defaultValue:2},
                        worker_position_id:{},
                        worker_status:{},
                        worker_start_service:{},
                        worker_email:{},                    
                        registry_no: {},
                        tax_number: {},
                        firstname: {},
                        lastname: {},
                        fathername: {},
                        sex: {},
                        specialization_code: {},
                        fullname: {type:"string"}
                    }
                }
            },
            change: function(e){
                console.log("newLabResponsiblesDS CHANGE event", e);
            },
            requestEnd: function(e){
                console.log("newLabResponsiblesDS REQUESTEND event", e);

                $.each(e.response.data, function(index, value){
                    e.response.data[index].fullname = e.response.data[index].lastname + " " + e.response.data[index].firstname + " (ΑΜ: " + e.response.data[index].registry_no + ")";
                });                
                
            }
            
    });
    
    return lab_responisbles_ds;
}