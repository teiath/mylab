function newRelationTypesDS(isServedOnline){
    
    var relation_types_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/relation_types",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "relation_type_id",
                                            fields:{
                                                relation_type_id: {editable: false},
                                                name:{editable: false}
                                            }
                                        }
                                    },
                                    filter: { field: "used", operator: "neq", value: true },
                                    change: function(e){
                                        console.log("newRelationTypesDS change event:", e);
                                    },
                                    requestEnd: function(e){
                                        console.log("newRelationTypesDS requestEnd event:", e);
                                        
                                        // με βάση το isServedOnline διαμόρφωσε ανάλογα την τιμή used στα δεδομένα που επιστρέφονται
                                        $.each(e.response.data, function(index, value){
                                            e.response.data[index].used = (isServedOnline && e.response.data[index].name === "ΕΞΥΠΗΡΕΤΕΙΤΑΙ ΔΙΑΔΙΚΤΥΑΚΑ" ) ? true : false;
                                        });
                                        
                                    }
                                });
    return relation_types_ds;
    
}