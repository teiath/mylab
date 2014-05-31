function newAquisitionSourcesDS(){
    
    var aquisition_sources_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/aquisition_sources",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "name",
                                            fields:{
                                                aquisition_source_id: {editable: false},
                                                name:{editable: false}
                                            }
                                        }
                                    }
                                    //change: function(e){ console.log("newAquisitionSourcesDS change event:", e);},
                                    //requestEnd: function(e){ console.log("newEquipmentTypesDS requestEnd event:", e);}
                                });
                                
    //console.log("aquisition_sources_ds", aquisition_sources_ds);
    return aquisition_sources_ds;
    
}