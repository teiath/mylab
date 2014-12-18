function newLabsDS(school_unit_id, worker_registry_no, detailInitEvent){
        
    var labs_ds =  new kendo.data.DataSource({
        transport: {
            read: {
                url: "api/search_labs",
                type: "GET",
                dataType: "json"
            },
            create: {
                url: "api/labs?user=" + user_url,
                type: "POST",
                dataType: "json"
            },
            parameterMap: function(data, type) {
                if (type === 'read') {

//                    if(school_unit_id !== undefined){
                    if(school_unit_id !== null){ data["school_unit_id"] = school_unit_id; }
                    if(worker_registry_no !== null){ data["lab_worker"] = worker_registry_no; }

                    //normalize data filters
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
                    
                    //normalize sorting filters
                    if (typeof data.sort !== 'undefined' && typeof data.sort[0] !== 'undefined') {
                        var sortingNormalizedFilter = {};
                        //var sortingFilter = data.sort[0];
                        sortingNormalizedFilter["orderby"] = data.sort[0].field;
                        sortingNormalizedFilter["ordertype"] = data.sort[0].dir.toUpperCase();
                        $.extend(data, sortingNormalizedFilter);
                        delete data.sort;
                    }else{
                        //if no sorting is defined, sort by lab's creation date
                        data["orderby"]= "creation_date";
                        data["ordertype"]= "DESC";
                    }                 
                    
                    data['pagesize'] = data.pageSize;
                    delete data.pageSize;
                                                            
                    return data;
                    
                }else if(type === 'create'){

                    if(school_unit_id !== undefined){
                        data["school_unit_id"] = school_unit_id;
                    }

                    //normalize ellak parameter
                    //data["transition_date"] = kendo.toString(data["transition_date"], "yyyy/MM/dd");
                    data["ellak"] = (data["ellak"])? true : false; 
                   
                    //standar parameters in lab creation
                    data["lab_source"] = "1";
                    
                    //υποβάλλονται κενά, λόγω του ότι βρίσκονται στο schema, παρότι στη δημιουργία εργαστηρίου δεν εισάγονται
                    delete data.operational_rating;
                    delete data.technological_rating;           
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
                    lab_name:{},
                    lab_type:{},
                    ellak:{},
                    submitted:{},
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
                    lab_state:{},
                    lab_state_id:{},
                    state:{}, //{defaultValue: 1},
                    lab_source:{}, //{defaultValue: 1},
                    transition_source:{}, //{defaultValue: "mylab"},            
                    transition_justification:{}, //{defaultValue: "δημιουργία Διάταξης Η/Υ"},
                    //school_unit:{},
                    school_unit_id:{},
                    school_unit_name:{},
                    school_unit:{},
                    //---------------//
                    lab_relations:{},
                    lab_transitions:{},
                    lab_workers:{}
                    //transit_date:{},
                    //justification:{}
                }
            }//,
            //errors: "message" !!!Πρέπει να υπάρχει στον server παράμετρος ΑΠΟΚΛΕΙΣΤΙΚΑ για errors που να μην επιστρέφεται σε άλλη περίπτωση
        },
        //pageSize: 5, //κάθε φορά που ο χρήστης επιλέγει άλλο pagesize από το Grid, γίνεται request στον server με παράμετρο την 1η σελίδα (page=1) και το επιλεχθέν pagesize
        //serverPaging: true, //κάθε φορά που ο χρήστης επιλέγει άλλη σελίδα, γίνεται request στον server με παράμετρο τη συγκεκριμένη σελίδα (page) και το pagesize
        serverFiltering: true,
        serverSorting: true,
        //error: function(e) { console.log("error e:", e);},
        requestEnd: function(e) {
            //console.log("newLabsDS - labs datasource requestEnd e:", e);
            if (e.type=="create"){
                
                var grid = detailInitEvent.detailRow.find("#school_unit_labs").data("kendoGrid");
                
                var message;
                if (typeof e.response.message !== 'undefined'){
                    message= e.response.message;
                }else if (typeof e.response.message_internal !== 'undefined'){
                    message= e.response.message_internal;
                }else if (typeof e.response.message_external !== 'undefined'){
                    message= e.response.message_external;
                }
                
                if (e.response.status == "200"){
                    
                    notification.show("Το εργαστήριο δημιουργήθηκε επιτυχώς. ", "success");
                    
                    grid.dataSource.read(); // refresh school units view
                    LabsViewVM.labs.read(); //refresh labs view
                    
                }else{
                    
                    notification.show("Η δημιουργία του εργαστηρίου απέτυχε. " + message.substr(message.indexOf(":") + 1), "error");
                    
                    grid.dataSource.read(); // refresh school units view
                    LabsViewVM.labs.read(); //refresh labs view
                }
            }
        },
        change: function(e) {
    
            //console.log("newLabsDS - labs datasource change e:", e);
            //console.log("einai to 1o lab new?:", e.items[0].isNew());
            //console.log("einai to 1o lab dirty?:", e.items[0].dirty);
        }
    });
    
    return labs_ds;
    
}