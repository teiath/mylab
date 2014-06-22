function newLabEquipmentTypesDS(labID, detailRow){

    return {
        serverFiltering: true,
        transport: {
            read: {
                url: "api/lab_equipment_types",
                type: "GET",
                data: { "lab": labID },
                dataType: "json"
            },
            create: {
                url: "api/lab_equipment_types",
                type: "POST",
                dataType: "json"
            },
            update: {
                url: "api/lab_equipment_types",
                type: "PUT",
                dataType: "json"
            },
            destroy: {
                url: "api/lab_equipment_types",
                type: "DELETE",
                dataType: "json"
            }
        },
        schema:{
            data: "data",
            total: "total",
            model:{
                id:"equipment_type_id",
                fields:{
                    lab_id:{editable: false, defaultValue: labID},
                    lab:{editable: false},
                    //ΠΡΟΣΕΧΩΣ equipment_category_id: {editable: false},
                    //ΠΡΟΣΕΧΩΣ equipment_category: { editable: false },
                    equipment_type_id: {editable: false},
                    equipment_type: { type: "string", validation: { required: true, validationMessage:"Ξέχασες τον εξοπλισμό!" } },
                    items:{ type: "number", validation: { required: true, validationMessage:"Ξέχασες το πλήθος!", min: 1, max: 1000} }
                }
            }
        },
        //change: function(e){console.log("newLabEquipmentTypesDS CHANGE event", e);},
        requestEnd: function(e){
            /*εδώ θα μπουν και τα μηνύματα επιτυχίας/αποτυχίας */
            console.log("newLabEquipmentTypesDS REQUESTEND event", e);
                        
            if (e.type==="create" || e.type==="update" || e.type==="destroy"){
                
                if (e.response.status == "200"){
                    
                    notification.show({
                        title: "Επιτυχής ενημέρωση Διάταξης Η/Υ",
                        message: e.response.message
                    }, "success");               
                    
                }else{
                    
                    notification.show({
                        title: "Η ενημέρωση τεη Διάταξης Η/Υ απέτυχε",
                        message: e.response.message
                    }, "error");
                    
                }
                
                detailRow.find("#equipment_details").data("kendoGrid").dataSource.read();            
            }
        }
    };
    
}