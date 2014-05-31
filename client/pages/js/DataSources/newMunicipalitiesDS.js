function newMunicipalitiesDS(){
    
    var municipalities_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/municipalities",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "municipality_id",
                                            fields:{
                                                municipality_id: {editable: false},
                                                name:{editable: false},
                                                transfer_area_id:{editable: false},
                                                transfer_area:{editable: false},
                                                edu_admin_id:{editable: false},
                                                edu_admin:{editable: false},
                                                region_edu_admin_id:{editable: false},
                                                region_edu_admin:{editable: false}
                                            }
                                        }
                                    }
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newMunicipalitiesDS change event:", e);},
                                    //requestEnd: function(e){console.log("newMunicipalitiesDS requestEnd event:", e);}
                                });
    return municipalities_ds;
    
}