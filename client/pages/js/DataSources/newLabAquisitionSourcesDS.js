function newLabAquisitionSourcesDS(labID, detailRow){

    return {
        serverFiltering: true,
        transport: {
            read: {
                url: "api/lab_aquisition_sources",
                type: "GET",
                data: { "lab_id": labID },
                dataType: "json"
            },
            create: {
                url: "api/lab_aquisition_sources?user=" + user_url,
                type: "POST",
                dataType: "json"
            },
            update: {
                url: "api/lab_aquisition_sources?user=" + user_url,
                type: "PUT",
                dataType: "json"
            },
            destroy: {
                url: "api/lab_aquisition_sources?user=" + user_url,
                type: "DELETE",
                dataType: "json"
            }
        },
        schema:{
            data: "data",
            total: "total",
            model:{
                id:"aquisition_source_id",
                fields:{
                    lab_aquisition_source_id:{},
                    lab_id:{editable: false, defaultValue: labID},
                    lab_name:{editable: false},
                    aquisition_year: { type: "string"/*, validation: { required: true, validationMessage:"Ξέχασες τη χρονολογία χρηματοδότησης!" }*/},
                    aquisition_source: {type: "string"/*, validation: { required: true, validationMessage:"Ξέχασες την πηγή χρηματοδότησης!" }*/},
                    aquisition_comments:{ type: "string" },
                    aquisition_source_id: {editable: false},
                }
            }
        },
        //change: function(e){console.log("newLabEquipmentTypesDS CHANGE event", e);},
        requestEnd: function(e){
            /*εδώ θα μπουν και τα μηνύματα επιτυχίας/αποτυχίας */
            //console.log("newLabAquisitionSourcesDS REQUESTEND event", e);
            
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
                
                detailRow.find("#aquisition_sources_details").data("kendoGrid").dataSource.read();            
            }
        }
    };
    
}