function newPrefecturesDS(){
    
    var prefectures_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/prefectures",
                                            type: "GET",
                                            dataType: "json"
                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "prefecture_id",
                                            fields:{
                                                prefecture_id: {editable: false},
                                                name:{editable: false}
                                            }
                                        }
                                    }
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newRegionEduAdminsDS change event:", e);},
                                    //requestEnd: function(e){console.log("newRegionEduAdminsDS requestEnd event:", e);}
                                });
    return prefectures_ds;
    
}