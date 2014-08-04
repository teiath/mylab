function newLabTransitionsDS(labID, detailRow){
    
    /*η newLabTransitionsDS χρησιμοποιείται μόνο για read, καθότι η post 
     * πραγματοποιείται μέσα στην transitAjaxRequest. Οι update και destroy
     * δεν χρησιμοποιούνται
     * */
    
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
                    data['lab_id'] = labID;
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
                    lab_name:{editable: false},
                    from_state_id: {},
                    from_state_name: {},
                    to_state_id: {},
                    to_state_name: {},
                    transition_date: {},
                    transition_justification: {},
                    transition_source: {}
                }
            }
        },
        change: function(e){console.log("newLabRelationsDS CHANGE event", e);},
        requestEnd: function(e){console.log("newLabRelationsDS REQUESTEND event", e);}
    };
    
}