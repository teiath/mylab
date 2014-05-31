function newTransferAreasDS(){
    
    var transfer_areas_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/transfer_areas",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "transfer_area_id",
                                            fields:{
                                                transfer_area_id: {editable: false},
                                                name:{editable: false},
                                                edu_admin_id:{editable: false},
                                                edu_admin:{editable: false},
                                                region_edu_admin_id:{editable: false},
                                                region_edu_admin:{editable: false},
                                            }
                                        }
                                    },
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newTransferAreasDS change event:", e);},
                                    //requestEnd: function(e){console.log("newTransferAreasDS requestEnd event:", e);}
                                });
    return transfer_areas_ds;
    
}