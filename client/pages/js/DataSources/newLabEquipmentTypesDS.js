function newLabEquipmentTypesDS(labID, detailRow){

    return {
        serverFiltering: true,
        transport: {
            read: {
                url: "api/lab_equipment_types",
                type: "GET",
                data: { "lab_id": labID },
                dataType: "json"
            },
            create: {
                url: "api/lab_equipment_types?user=" + user_url,
                type: "POST",
                dataType: "json"
            },
            update: {
                url: "api/lab_equipment_types?user=" + user_url,
                type: "PUT",
                dataType: "json"
            },
            destroy: {
                url: "api/lab_equipment_types?user=" + user_url,
                type: "DELETE",
                dataType: "json"
            },
            parameterMap: function(data, type) {
                if (type === 'read') {
                    return data;
                }else if (type === 'create') {
                    data['equipment_type'] = data['equipment_type_name'];
                    return data;
                }else if (type === 'update') {
                    return data;
                }else if (type === 'destroy') {
                    return data;
                }
            }
        },
        schema:{
            data: "data",
            total: "total",
            model:{
                id:"equipment_type_id",
                fields:{
                    lab_id:{editable: false, defaultValue: labID},
                    lab_name:{editable: false},
                    equipment_type_id: {editable: false},
                    equipment_type_name: {},
                    items:{ type: "number", validation: { required: true, validationMessage:"Ξέχασες το πλήθος!", min: 1, max: 1000} },
                    
                    equipment_type:{} // η παράμετρος του POST { type: "string", validation: { required: true, validationMessage:"Ξέχασες τον εξοπλισμό!" } },
            
                    //ΠΡΟΣΕΧΩΣ equipment_category_id: {editable: false},
                    //ΠΡΟΣΕΧΩΣ equipment_category: { editable: false },
                }
            }
        },
        //change: function(e){console.log("newLabEquipmentTypesDS CHANGE event", e);},
        requestEnd: function(e){
            /*εδώ θα μπουν και τα μηνύματα επιτυχίας/αποτυχίας */
            //console.log("newLabEquipmentTypesDS REQUESTEND event", e);
                        
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
                    
                    notification.show("Επιτυχής ενημέρωση Διάταξης Η/Υ. ", "success");               
                    
                }else{
                    
                    notification.show("Η ενημέρωση της Διάταξης Η/Υ απέτυχε. " + message.substr(message.indexOf(":") + 1), "error");
                    
                }
                
                detailRow.find("#equipment_details").data("kendoGrid").dataSource.read();            
            }
        }
    };
    
}