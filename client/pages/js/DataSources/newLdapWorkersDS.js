function newLdapWorkersDS(){
    
    var workers_ds =  new kendo.data.DataSource({
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/ldap_workers",
                                type: "GET",
                                dataType: "json"
                            },
                            parameterMap: function(data, type) {
                                if (type === 'read') {
                                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined' && typeof data.filter.filters[0] !== 'undefined') {
                                        data["uid"] = data.filter.filters[0].value;
                                        delete data.filter;
                                    }
                                }
                                return data;
                            }
                        },
                        schema: {
                            data: 'data',
                            model:{
                                id: "UID",
                                fields:{
                                      UID: {},
                                      fathername: {},
                                      mail:{},
                                      name:{},
                                      registry_no:{},
                                      surname:{},
                                      title:{},
                                      worker_specialization: {}
                                }
                            }
                        }
                        //, requestEnd: function(e){ console.log("newLdapWorkersDS requestEnd event:", e); }
                    });
                    
    return workers_ds;
    
}