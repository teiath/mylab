function newLabsDS(school_unit_id, detailInitEvent){
        
    var labs_ds =  new kendo.data.DataSource({
        transport: {
            read: {
                url: "api/search_labs",
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
            }, // το update γιατι υπάρχει ;;
            parameterMap: function(data, type) {
                if (type === 'read') {

                    if(school_unit_id !== undefined){
                        data["school_unit_id"] = school_unit_id;
                    }

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
                    
                    data['user'] = user;
                                        
                    return data;
                    
                }else if(type === 'create'){

                    if(school_unit_id !== undefined){
                        data["school_unit_id"] = school_unit_id;
                    }

                    //normalize transition_date parameter
                    data["transition_date"] = kendo.toString(data["transition_date"], "yyyy/MM/dd");
                   
                    //standar parameters in lab creation
                    data["state"] = "1";
                    data["lab_source"] = "1";
                    data["transition_source"] = "mylab";
                    data["transition_justification"] = "δημιουργία Διάταξης Η/Υ";                    
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
            if (e.type=="create" || e.type=="destroy"){
                
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
                    
                    notification.show({
                        title: "Το εργαστήριο δημιουργήθηκε επιτυχώς",
                        message: message
                    }, "success");
                    
                    grid.dataSource.read(); // refresh school units view
                    LabsViewVM.labs.read(); //refresh labs view
                    
                }else{
                    
                    notification.show({
                        title: "Η δημιουργία του εργαστηρίου απέτυχε",
                        message: message
                    }, "error");
                    
                    grid.dataSource.read(); // refresh school units view
                    LabsViewVM.labs.read(); //refresh labs view
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
    
            //console.log("newLabsDS - labs datasource change e:", e);
            //console.log("einai to 1o lab new?:", e.items[0].isNew());
            //console.log("einai to 1o lab dirty?:", e.items[0].dirty);
        }
    });
    
    return labs_ds;
    
}



                    
                    
//get the table row for records with model.id = 2
//var dataItem = $("#school_units_view").data("kendoGrid").dataSource.get(detailInitEvent.data.school_unit_id); //get the grid row's dataItem based on the school_unit_id
//console.log("dataItem", dataItem);
//var row = $("#school_units_view").data("kendoGrid").tbody.find("tr[data-uid='" + dataItem.uid + "']"); //an then get its row
//console.log("row: ", row);
//index = row.index();
//console.log("INDEX: ", index);
//
//if(e.response.lab_type == 1){
//    detailInitEvent.data.total_labs_by_type["ΣΕΠΕΗΥ"] = (+ detailInitEvent.data.total_labs_by_type["ΣΕΠΕΗΥ"] + 1).toString;
//    console.log(e.response.lab_type);
//    console.log(detailInitEvent.data.total_labs_by_type);
//}else if(e.response.lab_type == 2){
//    detailInitEvent.data.total_labs_by_type["ΤΡΟΧΗΛΑΤΟ"] = (+ detailInitEvent.data.total_labs_by_type["ΤΡΟΧΗΛΑΤΟ"] + 1).toString;
//    console.log(e.response.lab_type);
//    console.log(detailInitEvent.data.total_labs_by_type);
//}else if(e.response.lab_type == 3){
//    detailInitEvent.data.total_labs_by_type["ΕΤΠ"] = (+ detailInitEvent.data.total_labs_by_type["ΕΤΠ"] + 1).toString;
//    console.log(e.response.lab_type);
//    console.log(detailInitEvent.data.total_labs_by_type);
//}else if(e.response.lab_type == 4){
//    detailInitEvent.data.total_labs_by_type["ΓΩΝΙΑ"] = (+ detailInitEvent.data.total_labs_by_type["ΓΩΝΙΑ"] + 1).toString;
//    console.log(e.response.lab_type);
//    console.log(detailInitEvent.data.total_labs_by_type);
//}else if(e.response.lab_type == 5){
//    detailInitEvent.data.total_labs_by_type["ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"] = (+ detailInitEvent.data.total_labs_by_type["ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"] + 1).toString;
//    console.log(e.response.lab_type);
//    console.log(detailInitEvent.data.total_labs_by_type);
//}
                    //console.log("e.response.all_labs_by_type: ", e.response.all_labs_by_type);
                    //dataItem.total_labs_by_type = e.response.all_labs_by_type;
//dataItem.set("total_labs_by_type", detailInitEvent.data.total_labs_by_type);
                    //$("#school_units_view").data("kendoGrid").expandRow(row);

                    //console.log("row-after: ", row);
                    
                    //                    var grid = $("#school_units_view").data("kendoGrid");                   // Get a reference to the school units grid                    
                    //                    var select = grid.select(); //"tr:detailInitEvent.masterRow"            // Access the row that is selected                    
                    //                    var data = grid.dataItem(select);                                       // and now the data                    
                    //                    data.set("total_labs_by_type", e.response.all_labs_by_type);            // update the toolbar's info
                    //                    grid.expandRow(select); //"detailInitEvent.masterRow"                   // expand selected row
                    //                  
                    
                    
                    
                   
 