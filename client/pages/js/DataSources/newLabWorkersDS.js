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
                url: "api/lab_workers?user=" + user_url,
                type: "POST",
                dataType: "json"
            },
            update: { //δεν χρησιμοποιείται εδω αλλά στην Απενεργοποίηση του Υπευθύνου (LabsViewVM, lab_workers_details Grid)
                url: "api/lab_workers?user=" + user_url,
                type: "PUT",
                dataType: "json"
            },
            destroy: { //δεν χρησιμοποιείται εδω αλλά στην Διαγραφή του Υπευθύνου (LabsViewVM, lab_workers_details Grid)
                url: "api/lab_workers?user=" + user_url,
                type: "DELETE",
                dataType: "json"
            },
            parameterMap: function(data, type) {
                if (type === 'read') {
                    data['lab_id'] = labID;
                    if (typeof status !== 'undefined'){
                        data['worker_status'] = status;   
                    }
                    return data;
                }else if (type === 'create') {
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
                    lab_worker_id:{},
                    lab_id:{editable: false, defaultValue: labID},
                    lab_name:{editable: false},
                    worker_id: {},
                    worker_status:{},
                    worker_start_service:{},
                    worker_registry_no: {},
                    worker_position:{},
                    worker_position_id:{},
                    worker_position_name:{},
                    specialization_code_id: {},
                    specialization_code_name: {},
                    firstname: {},
                    lastname: {},
                    fathername: {},
                    registry_no:{},
                    email:{},
                    uid:{},
                    fullname: {}
                }
            }
        },
        sort: [{ field: "worker_status", dir: "asc" } , { field: "worker_start_service", dir: "desc" }],
        requestEnd: function(e){
            //console.log("newLabWorkersDS REQUESTEND event", e);
            
            if (e.type==="create" || e.type==="update" || e.type==="destroy"){
                
                var message= e.response.message;
                
                if (e.response.status == "200"){
                    notification.show("Επιτυχής ενημέρωση Διάταξης Η/Υ. ", "success");
                }else{
                    notification.show("Η ενημέρωση της Διάταξης Η/Υ απέτυχε. " + message.substr(message.indexOf(":") + 1),"error");
                }
                
                detailRow.find("#lab_workers_details").data("kendoGrid").dataSource.read();
            }
        }
    };
    
}