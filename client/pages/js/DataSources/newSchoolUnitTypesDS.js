function newSchoolUnitTypesDS(){
    
    var school_unit_types_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/school_unit_types",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "school_unit_type_id",
                                            fields:{
                                                school_unit_type_id: {editable: false},
                                                name:{editable: false},
                                                initials:{editable: false},
                                                education_level :{editable: false}
                                            }
                                        }
                                    }
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newSchoolUnitTypesDS change event:", e);},
                                    //requestEnd: function(e){console.log("newSchoolUnitTypesDS requestEnd event:", e);}
                                });
    return school_unit_types_ds;
    
}