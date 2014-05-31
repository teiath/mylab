function newEducationLevelsDS(){
    
    var education_levels_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/education_levels",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "education_level_id",
                                            fields:{
                                                education_level_id: {editable: false},
                                                name:{editable: false},
                                                school_unit_types:{editable: false}
                                            }
                                        }
                                    }
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newEducationLevelsDS change event:", e);},
                                    //requestEnd: function(e){console.log("newEducationLevelsDS requestEnd event:", e);}
                                });
    return education_levels_ds;
    
}