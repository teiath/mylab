function newLabTypesDS(){
    
    var lab_types_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/lab_types",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "lab_type_id",
                                            fields:{
                                                lab_type_id: {editable: false},
                                                name:{editable: false},
                                                fullname:{editable: false}
                                            }
                                        }
                                    }
                                    //change: function(e){ console.log("newLabTypesDS change event:", e);},
                                    //requestEnd: function(e){ console.log("newLabTypesDS requestEnd event:", e);}
                                });
    return lab_types_ds;
    
}