function newEquipmentTypesDS(usedEquipment){
    
    var equipment_types_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/equipment_types",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "name",
                                            fields:{
                                                equipment_type_id: {editable: false},
                                                name:{editable: false},
                                                equipment_category: {editable: false},
                                                used: {type:"boolean"}
                                            }
                                        }
                                    },
                                    filter: { field: "used", operator: "neq", value: true },
                                    change: function(e){
                                        console.log("newEquipmentTypesDS change event:", e);
                                    },
                                    requestEnd: function(e){
                                        console.log("newEquipmentTypesDS requestEnd event:", e);
                                        
                                        // με βάση το usedEquipment διαμόρφωσε ανάλογα την τιμή used στα δεδομένα που επιστρέφονται
                                        $.each(e.response.data, function(index, value){
                                            e.response.data[index].used = (jQuery.inArray( e.response.data[index].name, usedEquipment ) > -1) ? true : false;
                                        });
                                        
                                    }
                                });
    return equipment_types_ds;
    
}