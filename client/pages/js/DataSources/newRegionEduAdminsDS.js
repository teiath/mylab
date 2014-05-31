function newRegionEduAdminsDS(){
    
    var region_edu_admins_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/region_edu_admins",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "region_edu_admin_id",
                                            fields:{
                                                region_edu_admin_id: {editable: false},
                                                name:{editable: false}
                                            }
                                        }
                                    }
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newRegionEduAdminsDS change event:", e);},
                                    //requestEnd: function(e){console.log("newRegionEduAdminsDS requestEnd event:", e);}
                                });
    return region_edu_admins_ds;
    
}