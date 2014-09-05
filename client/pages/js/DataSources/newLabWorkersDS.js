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
            update: { //δεν χρησιμοποιείται εδω
                url: "api/lab_workers?user=" + user_url,
                type: "PUT",
                dataType: "json"
            },
            destroy: { //δεν χρησιμοποιείται
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

                    lab_worker_id:{},
                    lab_id:{editable: false, defaultValue: labID},
                    lab_name:{editable: false},
                    worker_status:{},
                    worker_start_service:{},
                    worker_id: {},  
                    worker_position:{},
                    worker_email:{},
                    fullname: {},          
                    worker_registry_no: {},
                    specialization_code_name: {},
                    firstname: {},
                    lastname: {},
                    worker_position_name:{},
                    worker_position_id:{},
                    specialization_code_id: {},
                    tax_number: {},
                    fathername: {},
                    sex: {}
                    
                }
            }
        },
        sort: [{ field: "worker_status", dir: "asc" } , { field: "worker_start_service", dir: "desc" }],
        change: function(e){
            //console.log("newLabWorkersDS CHANGE event", e);
//            if(e.field = "fullname" && e.action == "itemchange"){
//                e.items[0].registry_no = 123456;
//                e.items[0].specialization_code = 'ΠΕ40';
//            }
        },
        requestEnd: function(e){
            /*εδώ θα μπουν και τα μηνύματα επιτυχίας/αποτυχίας */
            //console.log("newLabWorkersDS REQUESTEND event", e);
            
            if (e.type==="create" || e.type==="update" || e.type==="destroy"){
                
                var message;
                if (typeof e.response.message !== 'undefined'){
                    message= e.response.message;
                }else if (typeof e.response.message_internal !== 'undefined'){
                    message= e.response.message_internal;
                }else if (typeof e.response.message_external !== 'undefined'){
                    message= e.response.message_external;
                }
                
                if (e.response.status == "200"){
                    
                    notification.show({
                        title: "Επιτυχής ενημέρωση Διάταξης Η/Υ",
                        message: message
                    }, "success");               
                    
                }else{
                    
                    notification.show({
                        title: "Η ενημέρωση της Διάταξης Η/Υ απέτυχε",
                        message: message
                    }, "error");
                    
                }                
                
                detailRow.find("#lab_workers_details").data("kendoGrid").dataSource.read();
            }
        }
    };
    
}