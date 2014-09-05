function newRatingDS(){
    
    var rating_ds =  new kendo.data.DataSource({
                                    data: [ 
                                            { rating_id: 1, name: "ανεπαρκώς εξοπλισμένο" },
                                            { rating_id: 2, name: "μέτρια εξοπλισμένο" },
                                            { rating_id: 3, name: "επαρκώς εξοπλισμένο" }, 
                                            { rating_id: 4, name: "καλώς εξοπλισμένο" },
                                            { rating_id: 5, name: "αριστα εξοπλισμένο" }],
                                    schema: {
                                        model:{
                                            id: "rating_id",
                                            fields:{
                                                rating_id: {editable: false},
                                                name:{editable: false}
                                            }
                                        }
                                    }
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newRatingDS change event:", e);},
                                    //requestEnd: function(e){console.log("newRatingDS requestEnd event:", e);}
                                });
    return rating_ds;
    
}