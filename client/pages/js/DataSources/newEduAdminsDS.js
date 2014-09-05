function newEduAdminsDS(){
    
    //console.log("newEduAdminsDS !!");
    
    var edu_admins_ds =  new kendo.data.DataSource({
                                    transport: {
                                        read: {
                                            url: "api/edu_admins",
                                            type: "GET",
                                            dataType: "json"
                                        }//,
//                                        parameterMap: function(data, type) {
//                                            if (type === 'read') {
//
//                                                if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                           
//                                                    var normalizedFilter = {};
//                                                    $.each(data.filter.filters, function(index, value){
//                                                        var filter = data.filter.filters[index];
//                                                        var value = normalizedFilter[filter.field];
//                                                        value = (value ? value+"," : "")+ filter.value;
//                                                        normalizedFilter[filter.field] = value;                                   
//                                                    });
//                                                    $.extend(data, normalizedFilter);
//                                                    delete data.filter;
//                                                }
//                                                return data;
//                                            }
//                                        }
                                    },
                                    schema: {
                                        data: "data",
                                        model:{
                                            id: "edu_admin_id",
                                            fields:{
                                                edu_admin_id: {editable: false},
                                                name:{editable: false},
                                                edu_admin_code:{editable: false},
                                                region_edu_admin_id: {editable: false},
                                                region_edu_admin_name:{editable: false}
                                            }
                                        }
                                    },
                                    //filter: { field: "used", operator: "neq", value: true },
                                    //change: function(e){ console.log("newEduAdminsDS change event:", e);},
                                    //requestEnd: function(e){console.log("newEduAdminsDS requestEnd event:", e);}
                                });
    return edu_admins_ds;
    
}