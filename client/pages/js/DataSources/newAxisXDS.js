function newAxisXDS(){
    
    var axis_x_ds =  new kendo.data.DataSource({
                                    data: [
                                            { axis_id: 1, axis_name: "lab_type", name: "Τύπος Διάταξης Η/Υ"},
                                            { axis_id: 2, axis_name: "lab_state", name: "Λειτουργική Κατάσταση Διάταξης Η/Υ"},
                                            { axis_id: 3, axis_name: "school_unit_type", name: "Τύπος Σχολικής Μονάδας"}, 
                                            { axis_id: 4, axis_name: "school_unit_state", name: "Λειτουργική Κατάσταση Σχολικής Μονάδας"},
                                            { axis_id: 5, axis_name: "education_level", name: "Βαθμίδα Εκπαίδευσης"},
                                            { axis_id: 6, axis_name: "region_edu_admin", name: "Περιφερειακή Διεύθυνση Εκπαίδευσης"},
                                            { axis_id: 7, axis_name: "edu_admin", name: "Διεύθυνση Εκπαίδευσης"},
                                            { axis_id: 8, axis_name: "transfer_area", name: "Περιοχή Μετάθεσης"},
                                            { axis_id: 9, axis_name: "prefecture", name: "Περιφερειακή Ενότητα"},
                                            { axis_id: 10, axis_name: "municipality", name: "Δήμος"}],
                                    schema: {
                                        model:{
                                            id: "axis_name",
                                            fields:{
                                                axis_id: {editable: false, type: "number"},
                                                axis_name:{editable: false, type: "string"},
                                                name:{editable: false, type: "string"}
                                            }
                                        }
                                    }
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newRatingDS change event:", e);},
                                    //requestEnd: function(e){console.log("newRatingDS requestEnd event:", e);}
                                });
    return axis_x_ds;
    
}