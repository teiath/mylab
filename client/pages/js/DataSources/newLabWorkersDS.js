function newLabWorkersDS(labID, detailRow, status){

    return {
        serverFiltering: true,
        transport: {
            read: {
                url: "api/lab_workers",
                type: "GET",
                dataType: "json"
            },
            create: {
                url: "api/lab_workers",
                type: "POST",
                dataType: "json"
            },
            update: {
                url: "api/lab_workers",
                type: "PUT",
                dataType: "json"
            },
            destroy: {
                url: "api/lab_workers",
                type: "DELETE",
                dataType: "json"
            },
            parameterMap: function(data, type) {
                if (type === 'read') {
                    data['lab'] = labID;
                    if (typeof status !== 'undefined'){
                        data['worker_status'] = status;   
                    }
                    return data;
                }else if (type === 'create') {
                    data['worker_id'] = data['fullname'];
                    data['worker_status'] = 1;
                    data['worker_position'] = 2;
                    data['worker_start_service'] = kendo.toString(data['worker_start_service'], "yyyy-MM-dd");
                    return data;
                }
            }
        },
        schema:{
            data: "data",
            total: "total",
            model:{
                id:"worker_id",
                fields:{

                    lab_id:{editable: false, defaultValue: labID},
                    lab:{editable: false},
                    worker_id: {},  
                    worker_position:{},
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
                    fullname: {}
                }
            }
        },
        sort: { field: "worker_start_service", dir: "desc" },
        change: function(e){
            console.log("newLabEquipmentTypesDS CHANGE event", e);
        },
        requestEnd: function(e){
            /*εδώ θα μπουν και τα μηνύματα επιτυχίας/αποτυχίας */
            console.log("newLabWorkersDS REQUESTEND event", e);
            
            if (e.type==="create" || e.type==="update" || e.type==="destroy"){
                detailRow.find("#lab_workers_details").data("kendoGrid").dataSource.read();
                detailRow.find("#lab_workers_logs").data("kendoGrid").dataSource.read(); 
            }
        }
    };
    
}