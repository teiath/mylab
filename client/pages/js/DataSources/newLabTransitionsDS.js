function newLabTransitionsDS(labID, detailRow){

    return {
        serverFiltering: true,
        transport: {
            read: {
                url: "api/lab_transitions",
                type: "GET",
                dataType: "json"
            },
            create: {
                url: "api/lab_transitions",
                type: "POST",
                dataType: "json"
            },
            update: {
                url: "api/lab_transitions",
                type: "PUT",
                dataType: "json"
            },
            destroy: {
                url: "api/lab_transitions",
                type: "DELETE",
                dataType: "json"
            },
            parameterMap: function(data, type) {
                if (type === 'read') {
                    data['lab'] = labID;
                    return data;
                }else if (type === 'create') {
                    //δεν χρησιμοποιείται
                    return data;
                }else if (type === 'destroy'){
                    //δεν χρησιμοποιείται
                    return data;
                }else if (type === 'update'){
                    //δεν χρησιμοποιείται
                    return data;
                }
            }
        },
        schema:{
            data: "data",
            total: "total",
            model:{
                id:"lab_transition_id",
                fields:{
                    lab_transition_id:{editable: false},
                    lab_id:{editable: false, defaultValue: labID},
                    from_state_id: {},
                    from_state: {},
                    to_state_id: {},
                    to_state: {},
                    transition_date: {},
                    transition_justification: {},
                    transition_source: {}
                }
            }
        },
        change: function(e){console.log("newLabRelationsDS CHANGE event", e);},
        requestEnd: function(e){
            /*εδώ θα μπουν και τα μηνύματα επιτυχίας/αποτυχίας */
            console.log("newLabRelationsDS REQUESTEND event", e);
            
            if (e.type==="create" || e.type==="update" || e.type==="destroy"){
                detailRow.find("#lab_relations_details").data("kendoGrid").dataSource.read();            
            }
        }
    };
    
}