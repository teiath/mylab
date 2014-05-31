function newLabAquisitionSourcesDS(labID, detailRow){

    return {
        serverFiltering: true,
        transport: {
            read: {
                url: "api/lab_aquisition_sources",
                type: "GET",
                data: { "lab": labID },
                dataType: "json"
            },
            create: {
                url: "api/lab_aquisition_sources",
                type: "POST",
                dataType: "json"
            },
            update: {
                url: "api/lab_aquisition_sources",
                type: "PUT",
                dataType: "json"
            },
            destroy: {
                url: "api/lab_aquisition_sources",
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
                    lab_id:{editable: false, defaultValue: labID},
                    lab:{editable: false},
                    aquisition_source_id: {editable: false},
                    aquisition_source: {type: "string"/*, validation: { required: true, validationMessage:"Ξέχασες την πηγή χρηματοδότησης!" }*/},
                    aquisition_year: { type: "string"/*, validation: { required: true, validationMessage:"Ξέχασες τη χρονολογία χρηματοδότησης!" }*/},
                    aquisition_comments:{ type: "string" }
                }
            }
        },
        //change: function(e){console.log("newLabEquipmentTypesDS CHANGE event", e);},
        requestEnd: function(e){
            /*εδώ θα μπουν και τα μηνύματα επιτυχίας/αποτυχίας */
            console.log("newLabAquisitionSourcesDS REQUESTEND event", e);
            
            if (e.type==="create" || e.type==="update" || e.type==="destroy"){
                detailRow.find("#aquisition_sources_details").data("kendoGrid").dataSource.read();            
            }
        }
    };
    
}