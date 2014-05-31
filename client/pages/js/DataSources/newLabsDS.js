function newLabsDS(school_unit_id){
    
    console.log("hello newLabsDS");
    
    var labs_ds =  new kendo.data.DataSource({
        transport: {
            read: {
                url: "api/labs",
                type: "GET",
                dataType: "json"
            },
            create: {
                url: "api/labs",
                type: "POST",
                dataType: "json"
            },
            update: {
                url: "api/labs",
                type: "POST",
                dataType: "json"
            },
            parameterMap: function(data, type) {
                if (type === 'read') {
                    
                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                           
                        var normalizedFilter = {};
                        $.each(data.filter.filters, function(index, value){
                            var filter = data.filter.filters[index];
                            var value = normalizedFilter[filter.field];
                            value = (value ? value+"," : "")+ filter.value;
                            normalizedFilter[filter.field] = value;                                   
                        });
                        $.extend(data, normalizedFilter);
                        delete data.filter;
                    }
                    data['pagesize'] = data.pageSize;
                    
                    if(school_unit_id !== undefined){
                        data["school_unit"] = school_unit_id;
                    }
                    
                    return data;
                    
                }else if(type === 'create'){

                    //normalize aquisition_sources parameter
                    var aquisition_sources= data.aquisition_sources;
                    var aquisition_sources_normalized= "";
                    $.each(aquisition_sources, function(index, value){
                        var name = aquisition_sources[index].name;
                        var year = aquisition_sources[index].aquisition_year;
                        var comments = aquisition_sources[index].comments;
                        var normalized_item = name + "=" + year + "=" + comments + ",";
                        aquisition_sources_normalized += normalized_item;
                    });
                    data["aquisition_sources"] = aquisition_sources_normalized.slice(0, -1);

                    //normalize equipment_types parameter
                    var equipment_types= data.equipment_types;
                    var equipment_types_normalized= "";                     
                    $.each(equipment_types, function(index, value){
                        var name = equipment_types[index].name;
                        var items = equipment_types[index].items;
                        var normalized_item = name + "=" + items + ",";
                        equipment_types_normalized += normalized_item;
                    });
                    data["equipment_types"] = equipment_types_normalized.slice(0, -1);

                    //normalize relation_served_service, worker_start_service, transition_date parameter
                    data["relation_served_service"] = data["relation_served_service"].toString();
                    data["worker_start_service"] = kendo.toString(data["worker_start_service"], "yyyy/MM/dd");
                    data["transition_date"] = kendo.toString(data["transition_date"], "yyyy/MM/dd");

                    if(school_unit_id !== undefined){
                        data["school_unit"] = school_unit_id;
                    }

                    //return JSON.stringify(data);                                        
                    return data;

                }
            }
        },      
        schema: {
            data: "data",            
            total: "total", //necessary for the grid pager
            model: {
                id: "lab_id",
                fields:{
                    lab_id:{editable:false},
                    lab_type:{},
                    lab_worker:{},
                    worker_start_service:{},
                    relation_served_service:{},
                    relation_served_online:{},
                    positioning:{},
                    special_name:{},
                    operational_rating:{},
                    technological_rating:{},
                    transition_date:{},
                    aquisition_sources:{},
                    equipment_types:{},
                    state:{defaultValue: 1},
                    lab_source:{defaultValue: 1},
                    transition_source:{defaultValue: "mylab"},                    
                    transition_justification:{defaultValue: "δημιουργία Διάταξης Η/Υ"},
                    school_unit:{},
                    //---------------//
                    lab_relations:{},
                    lab_transitions:{},
                    lab_workers:{}
//                    transit_date:{},
//                    justification:{}
                }
            }//,
            //errors: "message" !!!Πρέπει να υπάρχει στον server παράμετρος ΑΠΟΚΛΕΙΣΤΙΚΑ για errors που να μην επιστρέφεται σε άλλη περίπτωση
        },
        pageSize: 20, //κάθε φορά που ο χρήστης επιλέγει άλλο pagesize από το Grid, γίνεται request στον server με παράμετρο την 1η σελίδα (page=1) και το επιλεχθέν pagesize
        serverPaging: true, //κάθε φορά που ο χρήστης επιλέγει άλλη σελίδα, γίνεται request στον server με παράμετρο τη συγκεκριμένη σελίδα (page) και το pagesize
        serverFiltering: true,
        serverSorting: true,
        //error: function(e) { console.log("error e:", e);},
        requestEnd: function(e) {
            console.log("labs datasource requestEnd e:", e);
            
            if (e.type=="read"){
                
                LabsViewVM.set("labs_count",  e.response.total);
                LabsViewVM.set("sepehy_count", e.response.all_labs_by_type["ΣΕΠΕΗΥ"]);
                LabsViewVM.set("etp_count",  e.response.all_labs_by_type["ΕΤΠ"]);
                LabsViewVM.set("troxilata_count",  e.response.all_labs_by_type["ΤΡΟΧΗΛΑΤΟ"]);
                LabsViewVM.set("gwnies_count", e.response.all_labs_by_type["ΓΩΝΙΑ"]);
                LabsViewVM.set("diadrastika_sistimata_count", e.response.all_labs_by_type["ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"]);
                
            }else if (e.type=="create" || e.type=="destroy"){
                if (e.response.status == "200"){
                    
                    notification.show({
                        message: "Το εργαστήριο δημιουργήθηκε επιτυχώς"
                    }, "upload-success");
                    
                    LabsViewVM.labs.read();               
                    
                }else{
                    
                    notification.show({
                        title: "Η δημιουργία του εργαστηρίου απέτυχε",
                        message: e.response.message
                    }, "error");
                    
                    LabsViewVM.labs.read();
                }
            }
        },
        change: function(e) {
    
            /*  Fired when the data source is populated from a JavaScript array or a remote service, a data item is inserted, updated or removed, the data items are paged, sorted, filtered or grouped.
             * 
             *  e.sender kendo.data.DataSource    The data source instance which fired the event.
             *  e.action string(optional)         String describing the action type (available for all actions other than "read"). Possible values are "itemchange", "add", "remove" and "sync".
             *  e.items Array                     The array of data items that were affected (or read).
             */
    
            //console.log("labs datasource change e:", e);
            //console.log("einai to 1o lab new?:", e.items[0].isNew());
            //console.log("einai to 1o lab dirty?:", e.items[0].dirty);
        },
        sync : function(e){
            /* Saves any data item changes.
             *
             *    The sync method will request the remote service if:
             *
             *    the transport.create option is set and the data source contains new data items
             *    the transport.destroy option is set and data items have been removed from the data source
             *    the transport.update option is set and the data source contains updated data items    
             */
            //console.log("labs datasource sync e:", e);
        }
    });
    
    return labs_ds;
    
}