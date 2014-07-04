function newLabGeneralInfoDS(labID, detailRow){

    return {
        serverFiltering: true,
        transport: {
            read: {
                url: "api/search_labs",
                type: "GET",
                dataType: "json"
            },
            update: {
                url: "api/labs",
                type: "PUT",
                dataType: "json"
            },
            parameterMap: function(data, type) {
                if (type === 'read') {
                    data['lab_id'] = labID;
                    return data;
                }else if (type === 'update'){
                    //HERE
                    return data;
                }
            }
        },
        schema:{
            data: "data",
            total: "total",
            model:{
                id:"lab_id",
                fields:{
                    lab_id:{editable: false, defaultValue: labID},
                    lab_special_name:{},
                    positioning:{},
                    creation_date:{}
                }
            }
        },
        change: function(e){console.log("newLabGeneralInfoDS CHANGE event", e);},
        requestEnd: function(e){
            /*εδώ θα μπουν και τα μηνύματα επιτυχίας/αποτυχίας */
            console.log("newLabGeneralInfoDS REQUESTEND event", e);
            
            if (e.type==="update"){
                detailRow.find("#lab_general_info_details").data("kendoListView").dataSource.read();            
            }
        }
    };
    
}