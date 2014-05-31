function newStatesDS(){
    
    var states_ds =  new kendo.data.DataSource({
                                    data: [{ state_id: 1, name: "ενεργή" }, { state_id: 2, name: "σε αναστολή" },{ state_id: 3, name: "καταργημένη" }],
                                    schema: {
                                        model:{
                                            id: "state_id",
                                            fields:{
                                                state_id: {editable: false},
                                                name:{editable: false}
                                            }
                                        }
                                    }
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newStatesDS change event:", e);},
                                    //requestEnd: function(e){console.log("newStatesDS requestEnd event:", e);}
                                });
    return states_ds;
    
}