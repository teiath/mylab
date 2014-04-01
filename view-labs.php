<!-- view1 - labs view -->

<script type="text/javascript" src="client/myJs/snippets.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="client/myCss/viewsBar.css" >

<script>
    
    $(document).ready(function() {
    
        view1_labsGrid = $("#view1").kendoGrid({
                dataSource:{  // dataSource, set as a JavaScript object
                    transport: {
                        read: {
                            url: "api/labs",
                            type: "GET",
                            data: {},
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
                                //return data;

                            }
                            data['pagesize'] = data.pageSize;
                            delete data.pageSize;
                            return data;
                        }
                    },
                    schema: {
                        data: "data",
                        total: "total",
                        model: {
                             id: "lab_id",
                             fields: {}
                        }             
                    },
                    pageSize: 25, //κάθε φορά που ο χρήστης επιλέγει άλλο pagesize από το Grid, γίνεται request στον server με παράμετρο την 1η σελίδα (page=1) και το επιλεχθέν pagesize
                    serverPaging: true, //κάθε φορά που ο χρήστης επιλέγει άλλη σελίδα, γίνεται request στον server με παράμετρο τη συγκεκριμένη σελίδα (page) και το pagesize
                    serverFiltering: true,
                    serverSorting: true
                },
                //toolbar: { template: kendo.template($("#refresh-btn").html())},
                columnMenu: {
                    messages: {
                        sortAscending: "Αύξουσα Ταξινόμηση",
                        sortDescending: "Φθίνουσα Ταξινόμηση"
                    }
                },
                selectable: "row",
                sortable: {
                    allowUnsort: false
                },
                scrollable: false,
                navigatable: false,
                pageable: {
                  //input: true,
                  pageSizes: [15, 20, 25, 30, 50],
                  //refresh: true,
                  messages: {
                      display: "{0}-{1} από {2} εγγραφές",
                      empty: "Δεν βρέθηκαν εγγραφές",
                      itemsPerPage: "εγγραφες ανά σελίδα",
                      first: "μετάβαση στην πρώτη σελίδα",
                      previous: "μετάβαση στην προηγούμενη σελίδα",
                      next: "μετάβαση στην επόμενη σελίδα",
                      last: "μετάβαση στην τελευταία σελίδα",
                      refresh: "Ανανέωση"
                  }                             
                },
                detailTemplate: kendo.template($("#labViewLabDetailsTemplate").html()),
                detailInit: labViewLabDetailsInit,
                detailExpand: function(e) { //Fired when the user expands a detail table row.
                    //console.log("schoolUnitsGrid detail expand event");
                    //e.detailRow   jQuery          The jQuery object which represents the detail table row.
                    //e.masterRow   jQuery          The jQuery object which represents the master table row.
                    //e.sender      kendo.ui.Grid   The widget instance which fired the event.
                },
                detailCollapse: function(e) { //Fired when the user collapses a detail table row.
                    //console.log("schoolUnitsGrid detail collapse event");
                    //e.detailRow jQuery      The jQuery object which represents the detail table row.
                    //e.masterRow jQuery      The jQuery object which represents the master table row.
                    //e.sender kendo.ui.Grid  The widget instance which fired the event.
                },
                columns: [ {
                                field:"school_unit_id",
                                title:"κωδικός ΜΜ σχ. μονάδας",
                                width:"15%"
                           },
                           {
                                field: "lab_id",
                                title:"κωδικός",
                                width:"4%",
                                hidden:true,
                                headerAttributes: {
                                    style: "text-align: center"
                                }
                           },
                           {
                                field: "name",
                                title: "ονομασία",
                                template: function(dataItem) {

                                    var itemReturned;

                                    if(dataItem.special_name === ""){
                                        itemReturned = "";
                                    }else if(dataItem.special_name !== null){
                                        itemReturned =  "<span>" + kendo.htmlEncode(dataItem.name) + " ( " + kendo.htmlEncode(dataItem.special_name) + " ) " + "</span>";                           
                                    }else{
                                        itemReturned =  "<span>" + kendo.htmlEncode(dataItem.name) + "</span>";         
                                    }
                                    return itemReturned;
                                },
                                headerAttributes: {
                                  style: "text-align: center"
                                },
                                width: "50%"
                           },
                           {
                                field: "lab_type",
                                title: "τύπος",
                                width: "15%",
                                headerAttributes: {
                                  style: "text-align: center"
                                }
                           },
                           {
                                field: "state_id",
                                title: "κατάσταση",
                                template: function(dataItem) {

                                    var itemReturned;                              

                                    if(dataItem.state_id == 1){
                                        itemReturned = '<span class="label label-success label-active">ενεργή</span>';
                                    }else if(dataItem.state_id == 2){
                                        itemReturned = '<span class="label label-warning label-suspended">ανεσταλμένη</span>';
                                    }else if(dataItem.state_id == 3){
                                        itemReturned = '<span class="label label-danger label-abolished">καταργημένη</span>';
                                    }else{
                                        itemReturned = "";
                                    }

                                    return itemReturned;
                                },
                                width: "10%",
                                headerAttributes: {
                                  style: "text-align: center"
                                }
                           },
                           {
                                field: "rating",
                                title: "βαθμολογία",
                                template: function(dataItem) {                            

                                    var oRating, tRating;
                                    var oRating = (dataItem.operational_rating !== null && typeof dataItem.operational_rating !== 'undefined') ? dataItem.operational_rating : "-";
                                    var tRating = (dataItem.technological_rating !== null && typeof dataItem.operational_rating !== 'undefined') ? dataItem.technological_rating : "-";

                                    var itemReturned = '<span><img src="./client/img/raty/star-on.png" data-toggle="tooltip" data-placement="top" title="λειτουργικός δείκτης"> ' + oRating + ', <img src="./client/img/raty/on.png" data-toggle="tooltip" data-placement="top" title="τεχνολογικός δείκτης"> ' + tRating + '</span>';
                                    return itemReturned;
                                },
                                width: "10%",
                                headerAttributes: {
                                  style: "text-align: center"
                                }
                           }
                          ]
        });
      
        function labViewLabDetailsInit(e){
                //e.data         (kendo.data.ObservableObject)  -> The data item to which the master table row is bound.
                //e.detailCell   (jQuery)                       -> The jQuery object which represents the detail table cell.
                //e.detailRow    (jQuery)                       -> The jQuery object which represents the detail table row.
                //e.masterRow    (jQuery)                       -> The jQuery object which represents the master table row.
                //e.sender       (kendo.ui.Grid)                -> The widget instance which fired the event.

                var labData = e.data;
                var labDetailRow = e.detailRow;
                var panelbar_id = "labView_panelbar_" + labData.lab_id;
                var labDetailsTabContent_id = "labView_labDetailsTabContent_" + labData.lab_id;
                var equipment_tab_id = "labView_equipment_tab_id_" + labData.lab_id;
                var aquisition_sources_tab_id =  "labView_aquisition_sources_tab_" + labData.lab_id;
                var lab_workers_tab_id =  "labView_lab_workers_tab_" + labData.lab_id;
                var lab_relations_tab_id =  "labView_lab_relations_tab_" + labData.lab_id;
                var lab_transitions_tab_id =  "labView_lab_transitions_tab_" + labData.lab_id;
                var general_tab_id =  "labView_general_tab_" + labData.lab_id;
                var rating_tab_id =  "labView_rating_tab_" + labData.lab_id;
                
                console.log("labData", labData);
                console.log("labDetailRow", labDetailRow);

                labDetailRow.find("lab-details-row").kendoSplitter({
                                    panes: [{ collapsible: false, resizable: true, scrollable: false}]
                                });

                labDetailRow.find(".lab-details-row").append(navigation_bar);
                
                labDetailRow.find(".lab-details-row>#panelbar").attr("id", panelbar_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#labDetailsTabContent").attr("id", labDetailsTabContent_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#equipment_tab").attr("id", equipment_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#aquisition_sources_tab").attr("id", aquisition_sources_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#lab_workers_tab").attr("id", lab_workers_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#lab_relations_tab").attr("id", lab_relations_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#lab_transitions_tab").attr("id", lab_transitions_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#general_tab").attr("id", general_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#rating_tab").attr("id", rating_tab_id);
                
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(1)>a").attr("href", "#"+equipment_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(2)>a").attr("href", "#"+aquisition_sources_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(3)>a").attr("href", "#"+lab_workers_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(4)>a").attr("href", "#"+lab_relations_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(5)>a").attr("href", "#"+lab_transitions_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(6)>a").attr("href", "#"+general_tab_id);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">nav>ul li:nth-child(7)>a").attr("href", "#"+rating_tab_id);
                
                
                                                            // ======= EQUIPMENT =======//
                                                            
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_equipment);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id).append('<button id="edit_lab_equipment" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>  επεξεργασία</button>');
                }
                
                //create tabstrip widget
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id).append(lab_equipment_snippet);
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip").kendoTabStrip({
                    animation:  {
                        open: {
                            effects: "fadeIn"
                        }
                    }
                    //,activate: function(e){}
                });

                var grid_tab_1 = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").kendoGrid({
                    dataSource: {
                        //data: computational_equipment_data,
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_equipment_types",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id,
                                    "equipment_category" : "1" 
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_equipment_types",
                                type: "POST",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema
                                    
                                },
                                dataType: "json"
                            },
                            update: {
                                url: "api/lab_equipment_types",
                                type: "PUT",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema
                                    
                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_equipment_types",
                                type: "DELETE",
                                data: {
                                    "lab_id": labData.lab_id
                                    //"equipment_type" παιρνονται από το schema
                                },
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
                                    return data;
                                    
                                }else if(type === 'create'){                             
                                    return data;
                                    
                                }else if(type === 'update'){                                                                       
                                    return data;
                                    
                                }else if(type === 'destroy'){                                    
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id:"equipment_type_id",//το id πρέπει να ΜΗΝ ειναι μηδέν ή null (μέσα στo data)
                                fields:{
                                    equipment_type_id: {editable: false},
                                    equipment_type: { validation: { required: true, validationMessage:"Ξέχασες τον εξοπλισμό!" } },                                    
                                    items:{ type: "number", validation: { required: true, validationMessage:"Ξέχασες το πλήθος!", min: 1, max: 1000} }//,
                                    //lab:{editable: false},
                                    //lab_id: {editable: false}
                                }
                            }
                        },
                        requestEnd: function(e){
                            
                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div style='display:none' class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο νέος εξοπλισμός εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});                                    
                                }
                            }else if (e.type=="update"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός ενημερώθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η ενημέρωση εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){
                                inserted_computational_equipment=[];
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός διαγράφηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>#tab1").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η διαγραφή εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-1>div.alert").remove();});
                                }
                            }                            
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            confirmation: true,
                            window: {
                                width : "350px",
                                scrollable: false
                            }
                    },
                    scrollable: false,
                    columns: [
                        { field: "equipment_type", title: "εξοπλισμός", width: "82%", editor: computationalEquipmentDropDownEditor, template: "#=equipment_type#" },
                        { field: "items", title:"πλήθος", format: "{0:n0}", width: "10%"},
                        {   command: [{name: "edit", className: "btn btn-default btn-xs", text: ""}, {name: "destroy", className: "btn btn-default btn-xs", text: ""}],
                            title: "ενέργειες",
                            width: "8%"
                        }
                    ],
                    edit: function(e){
                        console.log("GRID EDIT EVENT! e", e);
                        
                        var inserted_computational_equipment_raw = e.sender._data;
                        $.each( inserted_computational_equipment_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_computational_equipment.push(item.equipment_type);
                        });
                        console.log("inserted_computational_equipment: ", inserted_computational_equipment);

                        if (e.model.isNew()) {
                            e.container.prev().find(".k-window-title").text("Προσθήκη Υπολογιστικού Εξοπλισμού");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }else{
                            $(e.container).find(".k-edit-form-container>div[data-container-for='equipment_type']").html(e.model.equipment_type);
                            e.container.prev().find(".k-window-title").text("Ενημέρωση Υπολογιστικού Εξοπλισμού");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Ενημέρωση");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }
                    },
                    cancel: function(e) {
                        inserted_computational_equipment=[];
                        console.log("inserted_computational_equipment: ", inserted_computational_equipment);
                    },
                    remove: function(e){
                        console.log("GRID REMOVE EVENT! ", e);
                        
                        var deletedItem = e.model.equipment_type;
                        console.log("deletedItem", deletedItem);
                        var inserted_computational_equipment_raw = e.sender._data;
                        $.each( inserted_computational_equipment_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_computational_equipment.push(item.equipment_type);
                        });
                        console.log("inserted_computational_equipment: ", inserted_computational_equipment);
                        var deletedItemIndex = inserted_computational_equipment.indexOf(deletedItem);
                        console.log("deletedItemIndex: ", deletedItemIndex);
                        inserted_computational_equipment.splice(deletedItemIndex, 1);                          

                        console.log("inserted_computational_equipment: ", inserted_computational_equipment);
                        
                        console.log("END OF GRID REMOVE EVENT!");
                    }           
                });
                var grid_tab_1_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#equipment_tab>#tabstrip>#tabstrip-1>#tab1>table>thead");
                grid_tab_1_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span><span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                grid_tab_1.data("kendoGrid").hideColumn(2);
                grid_tab_1.find("div.k-toolbar").hide();


                var grid_tab_2 = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").kendoGrid({
                    dataSource: {
                        //data: network_equipment_data,
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_equipment_types",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id,
                                    "equipment_category" : "2" 
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_equipment_types",
                                type: "POST",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema
                                    
                                },
                                dataType: "json"
                            },
                            update: {
                                url: "api/lab_equipment_types",
                                type: "PUT",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema
                                    
                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_equipment_types",
                                type: "DELETE",
                                data: {
                                    "lab_id": labData.lab_id
                                },
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
                                    return data;
                                    
                                }else if(type === 'create'){
                                                                       
                                    return data;
                                    
                                }else if(type === 'update'){
                                                                       
                                    return data;
                                    
                                }else if(type === 'destroy'){
                                    
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "equipment_type_id",
                                fields:{
                                    equipment_type_id: { editable: false },
                                    equipment_type: { validation: { required: true, validationMessage:"Ξέχασες τον εξοπλισμό!" } },
                                    items:{ type: "number", validation: { required: true, validationMessage:"Ξέχασες το πλήθος!", min: 1, max: 1000} }                                
                                }
                            }
                        },
                        requestEnd: function(e){
                            
                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div style='display:none' class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο νέος εξοπλισμός εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});                                    
                                }
                            }else if (e.type=="update"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός ενημερώθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η ενημέρωση εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){
                                inserted_computational_equipment=[];
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός διαγράφηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η διαγραφή εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>div.alert").remove();});
                                }
                            }
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            confirmation: true,
                            window: {
                                width : "350px",
                                scrollable: false
                            }
                    },
                    scrollable: false,
                    columns: [
                        { field: "equipment_type", title: "εξοπλισμός", width: "82%", editor: networkEquipmentDropDownEditor, template: "#=equipment_type#" },
                        { field: "items", title:"πλήθος", format: "{0:n0}", width: "10%"},
                        {   command: [{name: "edit", className: "btn btn-default btn-xs", text: ""}, {name: "destroy", className: "btn btn-default btn-xs", text: ""}],
                            title: "ενέργειες",
                            width: "8%"
                        }
                    ],
                    edit: function(e){
                
                        console.log("GRID EDIT EVENT! e", e);
                        
                        var inserted_network_equipment_raw = e.sender._data;
                        $.each( inserted_network_equipment_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_network_equipment.push(item.equipment_type);
                        });
                        console.log("inserted_network_equipment: ", inserted_network_equipment);

                        if (e.model.isNew()) {
                            e.container.prev().find(".k-window-title").text("Προσθήκη Δικτυακού Εξοπλισμού");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }else{
                            $(e.container).find(".k-edit-form-container>div[data-container-for='equipment_type']").html(e.model.equipment_type);
                            e.container.prev().find(".k-window-title").text("Ενημέρωση Δικτυακού Εξοπλισμού");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Ενημέρωση");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }
                    },
                    cancel: function(e) {
                        inserted_network_equipment=[];
                        console.log("inserted_network_equipment: ", inserted_network_equipment);
                    },
                    remove: function(e){

                        console.log("GRID REMOVE EVENT! ", e);
                        
                        var deletedItem = e.model.equipment_type;
                        console.log("deletedItem", deletedItem);
                        var inserted_network_equipment_raw = e.sender._data;
                        $.each( inserted_network_equipment_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_network_equipment.push(item.equipment_type);
                        });
                        console.log("inserted_network_equipment: ", inserted_network_equipment);
                        var deletedItemIndex = inserted_network_equipment.indexOf(deletedItem);
                        console.log("deletedItemIndex: ", deletedItemIndex);
                        inserted_network_equipment.splice(deletedItemIndex, 1);                          

                        console.log("inserted_network_equipment: ", inserted_network_equipment);
                        
                        console.log("END OF GRID REMOVE EVENT!");
                    }                    
                });
                var grid_tab_2_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-2>#tab2>table>thead");
                grid_tab_2_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span><span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                grid_tab_2.data("kendoGrid").hideColumn(2);
                grid_tab_2.find("div.k-toolbar").hide();

    
                var grid_tab_3 = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").kendoGrid({
                    dataSource: {
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_equipment_types",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id,
                                    "equipment_category" : "3" 
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_equipment_types",
                                type: "POST",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema

                                },
                                dataType: "json"
                            },
                            update: {
                                url: "api/lab_equipment_types",
                                type: "PUT",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type" παιρνονται από το schema
                                  //"items" παιρνονται από το schema

                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_equipment_types",
                                type: "DELETE",
                                data: {
                                    "lab_id": labData.lab_id
                                  //"equipment_type":,
                                },
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
                                    return data;

                                }else if(type === 'create'){

                                    return data;

                                }else if(type === 'update'){

                                    return data;

                                }else if(type === 'destroy'){

                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "equipment_type_id",
                                fields:{
                                    equipment_type_id: { editable: false },
                                    equipment_type: { validation: { required: true, validationMessage:"Ξέχασες τον εξοπλισμό!"} },
                                    items:{ type: "number", validation: { required: true, validationMessage:"Ξέχασες το πλήθος!", min: 1, max: 1000} }
                                }
                            }
                        },
                        requestEnd: function(e){                  
                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div style='display:none' class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο νέος εξοπλισμός εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});                                    
                                }
                            }else if (e.type=="update"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός ενημερώθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η ενημέρωση εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){
                                inserted_computational_equipment=[];
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div class='alert alert-success alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο εξοπλισμός διαγράφηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3").before("<div class='alert alert-danger alert-dismissable alert-success-custom'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η διαγραφή εξοπλισμού απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>div.alert").remove();});
                                }
                            }
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            confirmation: true,
                            window: {
                                width : "350px",
                                scrollable: false
                            }
                    },
                    scrollable: false,
                    columns: [
                        { field: "equipment_type", title: "εξοπλισμός", width: "82%", editor: peripheralDevicesDropDownEditor, template: "#=equipment_type#" },
                        { field: "items", title:"πλήθος", format: "{0:n0}", width: "10%"},
                        {   command: [{name: "edit", className: "btn btn-default btn-xs", text: ""}, {name: "destroy", className: "btn btn-default btn-xs", text: ""}],
                            title: "ενέργειες",
                            width: "8%"
                        }
                    ],
                    edit: function(e){
                
                        console.log("GRID EDIT EVENT! e", e);
                        
                        var inserted_peripheral_devices_raw = e.sender._data;
                        $.each( inserted_peripheral_devices_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_peripheral_devices.push(item.equipment_type);
                        });
                        console.log("inserted_peripheral_devices: ", inserted_peripheral_devices);

                        if (e.model.isNew()) {
                            e.container.prev().find(".k-window-title").text("Προσθήκη Περιφερειακής Συσκευής");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }else{
                            $(e.container).find(".k-edit-form-container>div[data-container-for='equipment_type']").html(e.model.equipment_type);
                            e.container.prev().find(".k-window-title").text("Ενημέρωση Περιφερειακής Συσκευής");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Ενημέρωση");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }
                    },
                    cancel: function(e) {
                        inserted_peripheral_devices=[];
                        console.log("inserted_peripheral_devices: ", inserted_peripheral_devices);
                    },
                    remove: function(e){

                        console.log("GRID REMOVE EVENT! ", e);
                        
                        var deletedItem = e.model.equipment_type;
                        console.log("deletedItem", deletedItem);
                        var inserted_peripheral_devices_raw = e.sender._data;
                        $.each( inserted_peripheral_devices_raw, function( index, item ) {
                            if(item.equipment_type !== "")inserted_peripheral_devices.push(item.equipment_type);
                        });
                        console.log("inserted_peripheral_devices: ", inserted_peripheral_devices);
                        var deletedItemIndex = inserted_peripheral_devices.indexOf(deletedItem);
                        console.log("deletedItemIndex: ", deletedItemIndex);
                        inserted_peripheral_devices.splice(deletedItemIndex, 1);                          

                        console.log("inserted_peripheral_devices: ", inserted_peripheral_devices);
                        
                        console.log("END OF GRID REMOVE EVENT!");
                    }
                });    
                var grid_tab_3_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+equipment_tab_id+">#tabstrip>#tabstrip-3>#tab3>table>thead");
                grid_tab_3_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span><span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                grid_tab_3.data("kendoGrid").hideColumn(2);
                grid_tab_3.find("div.k-toolbar").hide();
               

                                                            // ======= AQUISITION SOURCES ======= //

                //labDetailRow.find(".lab-details-row").append(lab_blockquote_aquisition_sources);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id).append('<button id="edit_aquisition_sources" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>  επεξεργασία</button>');
                }
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id).append("<div id='aquisition_sources_grid'></div>");
                var aquisitionSourcesGrid = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").kendoGrid({
                    dataSource: {
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_aquisition_sources",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_aquisition_sources",
                                type: "POST",
                                data: {
                                    "lab_id": labData.lab_id 
                                },
                                dataType: "json"
                            },
                            update: {
                                url: "api/lab_aquisition_sources",
                                type: "PUT",
                                data: {
                                    "lab_id": labData.lab_id 
                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_aquisition_sources",
                                type: "DELETE",
                                data: {
                                    "lab_id": labData.lab_id 
                                },
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
                                    return data;

                                }else if(type === 'create'){
                                    console.log("aquisition_source CREATE: ", data);
                                    return data;

                                }else if(type === 'update'){
                                    return data;

                                }else if(type === 'destroy'){
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "lab_aquisition_source_id",
                                fields:{
                                    lab_aquisition_source_id: {editable: false},
                                    aquisition_source: { validation: { required: true, validationMessage:"ξέχασες τη χρηματοδότηση!" } },
                                    //aquisition_source_id:{editable: false},
                                    aquisition_year: { validation: { required: true, validationMessage:"ξέχασες το έτος χρηματοδότησης!" } },
                                    aquisition_comments:{}//,
                                    //lab:{editable: false},
                                    //lab_id: {editable: false}
                                }
                            }
                        },
                        requestEnd: function(e){                
                            if (e.type=="create"){
                                console.log("im in request end CREATE!!");
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").data("kendoGrid").dataSource.read();
                                                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η νέα πηγή χρηματοδότησης εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέας πηγής χρηματοδότησης απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});                                    
                                }
                            }else if (e.type=="update"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η πηγή χρηματοδότησης ενημερώθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η ενημέρωση της πηγής χρηματοδότησης απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){
                            
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η πηγή χρηματοδότησης διαγράφηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid").before("<div class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η διαγραφή της πηγής χρηματοδότησης απέτυχε. Παρακαλώ δοκιμάστε ξανα.</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">div.alert").remove();});
                                }
                            }
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            confirmation: true,
                            window: {
                                width : "400px",
                                scrollable: false
                            }
                    },                        
                    scrollable: false,
                    columns:
                    [
                        { field: "aquisition_source", width: "20%", title: "πηγή χρηματοδότησης", editor : aquisitionSourcesDropDownEditor2, template: "#=aquisition_source#" },
                        { field: "aquisition_year", width: "20%", title: "χρονολογία", editor : aquisitionYearDropDownEditor2/*, template: "#=aquisition_year#" */},
                        { field: "aquisition_comments", width: "55%", title: "σχόλια", editor : commentsTextAreaEditor/*, template: "#=aquisition_comments#" */},
                        { command: [{name: "edit", className: "btn btn-default btn-xs", text: ""}, {name: "destroy", className: "btn btn-default btn-xs", text: ""}],
                            title: "ενέργειες",
                            width: "8%"
                        }
                    ],                        
                    sortable: {
                        allowUnsort: false
                    },
                    edit: function(e){               
                        console.log("GRID EDIT EVENT! e", e);
                        if (e.model.isNew()) {
                            e.container.prev().find(".k-window-title").text("Προσθήκη Πηγής Χρηματοδότησης");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }else{
                            $(e.container).find(".k-edit-form-container>div[data-container-for='aquisition_source']").html(e.model.aquisition_source);
                            e.container.prev().find(".k-window-title").text("Ενημέρωση Πηγής Χρηματοδότησης");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Ενημέρωση");
                            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                        }
                    }
                });                
                var aquisitionSourcesGrid_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+aquisition_sources_tab_id+">#aquisition_sources_grid>table>thead");
                aquisitionSourcesGrid_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span><span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                aquisitionSourcesGrid.data("kendoGrid").hideColumn(3);
                aquisitionSourcesGrid.find("div.k-toolbar").hide();
                
                                                            // ======= RESPONSIBLES =======//
                                                            
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_responsible);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id).append('<button id="edit_responsibles" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> επεξεργασία</button>');
                }
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id).append("<div id='lab_worker_grid'></div>");
                var labWorkerGrid = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").kendoGrid({
                    dataSource: {
                        //data: lab_worker_array,
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_workers",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id,
                                    "worker_position": 2,
                                    "worker_status": 1
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_workers",
                                type: "POST",
                                data: {
//                                    "lab": labData.lab_id,
//                                    "worker_position": 2,
//                                    "worker_status": 1
                                },
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_workers",
                                type: "PUT",
                                data: {},
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
                                    return data;
                                    
                                }else if(type === 'create'){
                                    
                                    data["lab_id"]= labData.lab_id;
                                    data["worker_position"]= 2;
                                    data["worker_status"]= 1;
                                    
                                    var selectedLabWorker = $("#edit_lab_worker").data("kendoAutoComplete");//._old;
                                    console.log("selectedLabWorker ", selectedLabWorker);
                                    //data["lab_worker"] = selectedLabWorker.split(" ").pop();                                    
                                    
                                    data["worker_id"] = data.edit_lab_worker.worker_id;
                                    data["worker_start_service"] = data.edit_worker_start_service;
                                    
                                    delete data.edit_lab_worker;
                                    delete data.edit_worker_start_service;
                                    //console.log("data", data);
                                    
                                    return data;
                                    
                                }else if(type === 'destroy'){
                                    
                                    //data["lab_worker_id"] = 
                                    data["worker_status"]= 3;
                                    
                                    //console.log("data", data);
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "lab_id",
                                fields:{
                            
                                    lab_worker_id:{editable: false},
                                    lab_id: { editable: false },
                                    worker_id:{editable: false},
                                    worker_position:{editable: false},
                                    worker_status:{editable: false},
                                    edit_worker_start_service:{editable: false},
                                    //edit_lab_worker:{editable: false},
                                    
                                    lastname:{editable: false},
                                    firstname:{editable: false},
                                    fathername:{editable: false},
                                    registry_no:{editable: false},
                                    specialization_code:{editable: false}
                                }
                            }
                        },
                        requestEnd: function(e){

                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο νέος υπεύθυνος εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου υπευθύνου απέτυχε. Παρακαλώ ξαναδοκιμάστε</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){                               
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Ο υπεύθυνος αποδεσμεύτηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η αποδέσμευση του υπευθύνου απέτυχε. Παρακαλώ ξαναδοκιμάστε</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">div.alert").remove();});
                                }
                            }

                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            template: kendo.template($("#popup_responsible_editor").html()),
                            confirmation: true,
                            window: {
                                width : "400px",
                                scrollable: false
                            }
                    },                        
                    scrollable: false,
                    columns: [{
                            field: "lastname",
                            template: "#= lastname + ' ' + firstname #",
                            title:"ονοματεπώνυμο"
                        },
                        {
                            field: "fathername",
                            title:"πατρώνυμο"
                        },
                        {
                            field: "registry_no",
                            title: "αρ. μητρώοου"
                        },
                        {
                            field: "specialization_code",
                            title: "κλάδος"
                        },
                        {
                            field: "worker_start_service",
                            title: "ημ. ανάληψης ευθύνης"
                        },
                        {   command: [{name: "destroy", className: "btn btn-default btn-xs", text: ""}], //,{name: "edit", className: "btn btn-default btn-xs", text: ""}
                            title: "ενέργειες",
                            width: "4%"
                        }],                        
                    sortable: {
                        allowUnsort: false
                    },
                    edit: function(e){
                        console.log("GRID EDIT EVENT! e", e);

                        $("#edit_lab_worker").kendoAutoComplete({
                          dataSource: labWorkersDS,
                          dataTextField: "fullname",
                          placeholder: "επιλογή νέου υπευθύνου ...",
                          template: "<div class='labWorkersTemplate'>\
                                          <span class='template_fullname'> #= lastname + ' ' + firstname #</span>\
                                          <div class='template_details'>\
                                              <span> ΑΜ </span>\
                                              <span class='template_data'> #= registry_no # </span>\
                                          </div>\
                                      <div>",
                          minLength: 3,
                          change: function(e){
                                           
                              console.log("change event e: ", e);
                              var lab_worker_userInput = this.value();
                              console.log("η τιμή του autocomplete: ", lab_worker_userInput);
                              var labWorkers = labWorkersDS.data();

                              var validResponsible=false;
                              $.each( labWorkers, function( index, selectedLabResponsible ) {
                                  if (selectedLabResponsible.registry_no == lab_worker_userInput.split(" ").pop()){
                                      validResponsible = true;
                                      return false;
                                  }
                              });
                              if(!validResponsible){
                                  //editBtn.closest(".edit_lab").next().last().append('<span class="edit_failure_msg">Ο υπεύθυνος που εισήχθηκε δεν υπάρχει</span>');
                                  //console.log("lab responsible input '" + lab_worker_userInput + "' is not a valid one");
                                  this.value('');
                              }
                          }
                        });
                        $("#edit_lab_worker").parent().attr("style", "width: 265px;"); /*margin: 20px 10px 0px 20px*/
                        
                        $("#edit_worker_start_service").kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now()),//kendo.toString(new Date(Date.now()), "yyyy-mm-dd"),
                            change: function() {
                                var date = kendo.toString(this.value(),  "yyyy-MM-dd");
                                console.log("η τιμή του date picker: ", date); //value is the selected date in the datepicker
                                e.model.edit_worker_start_service = date;
                                return date;
                            }
                        });

                        e.container.prev().find(".k-window-title").text("Προσθήκη Νέου Υπευθύνου");
                        e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                        e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                    }
                });                
                var labWorkerGrid_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_workers_tab_id+">#lab_worker_grid>table>thead");
                labWorkerGrid_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>'); //<span class=" glyphicon glyphicon-pencil custom-grid-icons" style="margin: 0px 9px"></span>
                labWorkerGrid.data("kendoGrid").hideColumn(5);
                labWorkerGrid.find("div.k-toolbar").hide();
                
                                                            // ======= RELATIONS =======//              
                
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_relations);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id).append('<button id="edit_relations" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> επεξεργασία</button>');
                }
                //var relations = ( labData.lab_relations !== null) ? labData.lab_relations : new Array();
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id).append("<div id='lab_relations_grid'></div>");
                var labRelationsGrid = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").kendoGrid({
                    dataSource: {
                        //data: lab_worker_array,
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_relations",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id
                                },
                                dataType: "json"
                            },
                            create: {
                                url: "api/lab_relations",
                                type: "POST",
                                data: {},
                                dataType: "json"
                            },
                            destroy: {
                                url: "api/lab_relations",
                                type: "DELETE",
                                data: {},
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
                                    return data;
                                    
                                }else if(type === 'create'){
                                                                        
                                    var selectedRelationType =  $("#edit_relation_type").data("kendoComboBox")._old;
                                    var selectedSchoolUnit =  $("#edit_school_unit").data("kendoAutoComplete")._old;
                                    var selectedCircuit =  $("#edit_circuit").data("kendoComboBox")._old;
                                    
                                    data["lab_id"]= labData.lab_id;
                                    data["school_unit"]= selectedSchoolUnit;
                                    data["relation_type"]= selectedRelationType;
                                    data["circuit_id"]= selectedCircuit;
                                    
                                    
                                    if(selectedRelationType == "ΕΞΥΠΗΡΕΤΕΙ ΥΠΗΡΕΣΙΑΚΑ"){
                                        delete data.circuit_id;
                                    }
                                        
                                    delete data.edit_circuit;
                                    delete data.edit_school_unit;
                                    delete data.edit_relation_type;
                                    
                                    return data;
                                    
                                }else if(type === 'destroy'){
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total",
                            model:{
                                id: "lab_relation_id",//"lab_id",
                                fields:{
                                    circuit_id:{editable: false},
                                    circuit_phone_number:{},
                                    lab_id:{editable: false},
                                    lab_name:{editable: false},
                                    lab_relation_id:{editable: false},
                                    relation_type_id:{editable: false},
                                    relation_type_name:{},
                                    school_unit:{},
                                    school_unit_id:{editable: false}
                                }
                            }
                        },
                        requestEnd: function(e){

                            if (e.type=="create"){
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η νέα συσχέτιση εισήχθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η εισαγωγή νέου συσχέτισης απέτυχε. Παρακαλώ ξαναδοκιμάστε</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">div.alert").remove();});
                                }
                            }else if (e.type=="destroy"){                               
                                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").data("kendoGrid").dataSource.read();
                                
                                if (e.response.status == "200"){
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").before("<div style='display:none' class='alert alert-success alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η συσχέτιση καταργήθηκε με επιτυχία</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">div.alert").remove();});
                                }else{
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid").before("<div style='display:none' class='alert alert-danger alert-dismissable alert-custom-resp'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Η κατάργηση της συσχέτισης απέτυχε. Παρακαλώ ξαναδοκιμάστε</strong></div>");
                                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">.alert").show("blind", 500).delay(4000).hide("blind", 500, function() {labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">div.alert").remove();});
                                }
                            }
                        }
                    },
                    toolbar: [
                        { name: "create", text: "" }
                    ],
                    editable:{
                            mode: "popup",
                            template: kendo.template($("#popup_relations_editor").html()),
                            confirmation: true,
                            window: {
                                width : "400px",
                                scrollable: false
                            }
                    },
                    scrollable: false,
                    columns: [{field: "relation_type_name", title:"συσχέτιση"},
                              {field: "school_unit", title: "Σχολική Μονάδα"},
                              {field: "circuit_phone_number", title: "αρ. κυκλωματος"},
                              {   command: [{name: "destroy", className: "btn btn-default btn-xs", text: ""}], //,{name: "edit", className: "btn btn-default btn-xs", text: ""}
                                  title: "ενέργειες",
                                  width: "4%"
                              }],
                    sortable: {
                        allowUnsort: false
                    },
                    edit: function(e){

                        $("#edit_relation_type").kendoComboBox({
                            autoBind: false,
                            dataTextField: "name",
                            dataValueField: "name",
                            placeholder: "επιλογή συσχέτισης ...",
                            dataSource: {
                                //serverFiltering: true,
                                transport: {
                                    read: {
                                        url: "api/relation_types",
                                        type: "GET",
                                        data: {},
                                        dataType: "json"
                                    }
                                },
                                schema: {
                                    model : {
                                        id : "relation_type_id",
                                        fields:{
                                            name: {editable: false},
                                            relation_type_id: {editable:false},
                                            invisible: {editable:false}
                                        }
                                    },
                                    data: function(response) {
                                            var schoolUnitAlreadyServed=false;
                                            var relationsGridData = labRelationsGrid.data("kendoGrid")._data;
                                            $.each( relationsGridData, function( index, selectedRelation ) {
                                                if (selectedRelation.relation_type_id == 1){
                                                    schoolUnitAlreadyServed = true;
                                                    return false; //exit each
                                                }
                                            });
                                            
                                            if(schoolUnitAlreadyServed){
                                                for (var i = 0; i < response.data.length; ++i) {
                                                    if (response.data[i].relation_type_id == 1) response.data[i].invisible = 1;
                                                }
                                            }

                                            return response.data;
                                    },
                                    total: "total"
                                },
                                filter: { field: "invisible", operator: "neq", value: 1 }
                            },
                            change: function(e){                             
                                var userInput = this.value();
                                var relations = e.sender.dataSource._data;
                                //console.log("relations", relations);
                                //console.log("userInput", userInput);
                                
                                validRelation=false;
                                $.each( relations, function( index, selectedRelation ) {
                                    if (selectedRelation.name == userInput){
                                        validRelation = true;
                                        return false;
                                    }
                                });
                                if(!validRelation){
                                    console.log("relation input '" + userInput + "' is not a valid one");
                                    this.value('');                                    
                                }
                                
                                // enable/disable circuit input and corresponding validation tooltip
                                if(userInput === "ΕΞΥΠΗΡΕΤΕΙΤΑΙ ΔΙΑΔΙΚΤΥΑΚΑ"){
                                    $("#edit_circuit").data("kendoComboBox").enable();
                                    $("#edit_circuit").attr("required","");
                                    $("#edit_circuit").attr("data-required-msg","ξέχασες τον αριθμό κυκλώματος!");                                    
                                }else{
                                    $("#edit_circuit").data("kendoComboBox").value("");
                                    $("#edit_circuit").data("kendoComboBox").enable(false);
                                    $("#edit_circuit").removeAttr("required");
                                    $("#edit_circuit").removeAttr("data-required-msg");
                                    $("#edit_circuit").next(".k-tooltip-validation").hide();
                                }
                            }
                        });
                        
                        $("#edit_school_unit").kendoAutoComplete({
                            autoBind: false,
                            dataTextField: "name",
                            placeholder: "επιλογή Σχολικής Μονάδας ...",
                            minLength: 3,
                            dataSource: {
                                  serverFiltering: true,
                                  transport: {
                                      read: {
                                          url: "api/school_units",
                                          type: "GET",
                                          data: {},
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
                                              return data;

                                          }
                                      }
                                  },
                                  schema: {
                                      data: "data",
                                      total: "total",
                                      model:{
                                          id: "name"
                                      }
                                  }
                              },
                            change: function(e){

                                    var userInput = this.value();
                                    var schoolUnits = e.sender.dataSource._data;

                                    validUnit=false;
                                    $.each( schoolUnits, function( index, selectedSchoolUnit ) {
                                        if (selectedSchoolUnit.name == userInput){
                                            validUnit = true;
                                            return false;
                                        }
                                    });
                                    if(!validUnit){
                                        console.log("school unit input '" + userInput + "' is not a valid one");
                                        this.value('');                                    
                                    }
                                    
                                    $("#edit_circuit").data("kendoComboBox").value("");
                                    //$("#edit_circuit").data("kendoComboBox").dataSource.read();
                                }
                        });
                        
                        $("#edit_circuit").kendoComboBox({                 
                            autoBind: false,
                            dataTextField: "fulltemplate",
                            dataValueField: "circuit_id",
                            template: "#= relation_type_name # (αρ.κυκλ. #= phone_number #)",
                            placeholder: "επιλογή κυκλώματος ...",
                            //filter: "contains",
                            dataSource: {
                                transport: {
                                    read: {
                                        url: "api/circuits",
                                        type: "GET",
                                        data: {
                                            //school_unit:
                                        },
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
                                            if ( $("#edit_school_unit").data("kendoAutoComplete").value() != ""){
                                                data["school_unit"] = $("#edit_school_unit").data("kendoAutoComplete").value();
                                            }
                                            return data;

                                        }
                                    }
                                },
                                serverFiltering: true,
                                schema: {
                                    data: function(response) {
                                            console.log(response);
                                            for (var i = 0; i < response.data.length; ++i) {
                                                response.data[i].fulltemplate = response.data[i].relation_type_name + " (αρ. κυκλ. " + response.data[i].phone_number + ")";
                                            }
                                            return response.data;
                                    },
                                    total: "total",
                                    model:{
                                        id: "name"
                                    }
                                }
                            },
                            change: function(e){
                                var userInput = this.value();
                                console.log("userInput: ", userInput);
                                var circuit = e.sender.dataSource._data;

                                validCircuit=false;
                                $.each( circuit, function( index, selectedCircuit ) {
                                    if (selectedCircuit.circuit_id == userInput){
                                        validCircuit = true;
                                        return false;
                                    }
                                });
                                if(!validCircuit){
                                    console.log("circuit input '" + userInput + "' is not a valid one");
                                    this.value('');                                    
                                }
                            }
                        });
                        $("#edit_circuit").data("kendoComboBox").enable(false);

                        e.container.prev().find(".k-window-title").text("Προσθήκη Νέας Συσχέτισης");
                        e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
                        e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
                    }
                });
                var labRelationsGrid_header = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_relations_tab_id+">#lab_relations_grid>table>thead");
                labRelationsGrid_header.find("tr th:last-child").html('<span class=" glyphicon glyphicon-trash custom-grid-icons" style="margin: 0px 9px"></span>');
                labRelationsGrid.data("kendoGrid").hideColumn(3);
                labRelationsGrid.find("div.k-toolbar").hide();

                                                            // ======= TRANSITIONS =======//
                
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_transitions);
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_transitions_tab_id).append("<div id='lab_transitions_grid'></div>");
                var labTransitionsGrid = labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+lab_transitions_tab_id+">#lab_transitions_grid").kendoGrid({
                    //dataSource: transitions,
                    dataSource: {
                        serverFiltering: true,
                        transport: {
                            read: {
                                url: "api/lab_transitions",
                                type: "GET",
                                data: {
                                    "lab": labData.lab_id
                                },
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
                                    return data;
                                }
                            }
                        },
                        schema:{
                            data: "data",
                            total: "total"
                        }
                    },
                    scrollable: false,
                    columns: [{
                            field: "from_state",
                            title:"προηγούμενη κατάσταση"
                        },
                        {
                            field: "to_state",
                            title: "παρούσα κατάσταση"
                        },
                        {
                            field: "transition_date",
                            title: "ημερομηνία μετάβασης"
                        },
                        {
                            field: "transition_justification",
                            title: "αιτιολογία μετάβασης"
                        },
                        {
                            field: "transition_source",
                            title: "πηγή μετάβασης"
                        }],
                    sortable: {
                        allowUnsort: false
                    }
                });
                
                
                                                            // ======= GENERAL =======//
                
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_general);
                if(labData.state_id != 2 & labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+general_tab_id).append('<button id="edit_general" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> επεξεργασία</button>');
                }

                var special_name = (labData.special_name != null) ? labData.special_name : "-- δεν έχει οριστεί ειδικό όνομα για τη Διάταξη Η/Υ --";
                var positioning = (labData.positioning != null) ? labData.positioning : "-- δεν έχει οριστεί τοποθεσία για τη Διάταξη Η/Υ --";
                var creation_date = (labData.lab_transitions[0].transition_date != null) ? labData.lab_transitions[0].transition_date : "-- δεν έχει οριστεί ημερομηνία δημιουργίας για τη Διάταξη Η/Υ --";
                
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+general_tab_id).append('<div id="general_info">\
                                                                                <div class="general_info_item2"><div class="full_label"><span class="glyphicon glyphicon-tag"></span><span class="general_info_label"> Ειδική Ονομασία</span></div><div class="full_data"><span class="general_info_data">' + special_name + '</span></div></div>\
                                                                                <div class="general_info_item1"><div class="full_label"><span class="glyphicon glyphicon-map-marker"></span><span class="general_info_label"> Τοποθεσία</span></div><div class="full_data"><span class="general_info_data">' + positioning + '</span></div></div>\
                                                                                <div class="general_info_item3"><div class="full_label"><span class="glyphicon glyphicon-calendar"></span><span class="general_info_label"> Ημερομηνία Δημιουργίας</span></div><div class="full_data"><span class="general_info_data">' + creation_date + '</span></div></div>\
                                                                             </div>');
    
    
                                                                // ======= RATING =======//
                                                                
                //labDetailRow.find(".lab-details-row").append(lab_blockquote_rating);
                if(labData.state_id != 2 && labData.state_id != 3 ){
                    labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id).append('<button id="edit_rating" type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> επεξεργασία</button>');                
                }
                labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id).append('<div id="rating_info">\
                                                                                <div class="oRating_info_item"><div class="rating_label"><span class="glyphicon glyphicon-star"></span><span class="general_info_label"> Λειτουργικός Δείκτης </span></div><div class="rating_data"><div id="oRating" class="general_info_data"></div></div></div>\
                                                                                <div class="tRating_info_item"><div class="rating_label"><i class="fa fa-lightbulb-o"></i>\<span class="general_info_label"> Τεχνολογικός Δείκτης </span></div><div class="rating_data"><div id="tRating" class="general_info_data"></div></div></div>\
                                                                             </div>');

                (labData.operational_rating !== null) ? labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id+">#rating_info>.oRating_info_item>.rating_data>#oRating").raty({ readOnly: true, score: labData.operational_rating, path: 'client/img/raty' }) : labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id+">#rating_info>.oRating_info_item>.rating_data>#oRating").raty({ readOnly: true, score: 0, path: 'client/img/raty' });
                (labData.technological_rating !== null) ? labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id+">#rating_info>.tRating_info_item>.rating_data>#tRating").raty({ readOnly: true, score: labData.technological_rating, starOff: 'off.png', starOn: 'on.png', path: 'client/img/raty' }) : labDetailRow.find(".lab-details-row>#"+panelbar_id+">#"+labDetailsTabContent_id+">#"+rating_tab_id+">#rating_info>.tRating_info_item>.rating_data>#tRating").raty({ readOnly: true, score: 0, starOff: 'off.png', starOn: 'on.png', path: 'client/img/raty' });

        };      
      
        //σχετίζεται με το grid εισαγωγής εξοπλισμού στην επεξεργασία Διάταξης Η/Υ ("#popup_equipment")
        function computationalEquipmentDropDownEditor(container, options) {
            //console.log("container", container);
            //console.log("options.field", options.field);
            var computationalEquipmentComboBox = $('<input id="computationalEquipmentDropDownEditor" required validationMessage="Ξέχασες τον εξοπλισμό!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                .appendTo(container)
                .kendoComboBox({
                    autoBind: false,
                    dataSource: {
                        transport: {
                            read: {
                                url: "api/equipment_types",
                                type: "GET",
                                data: {
                                    "equipment_category": 1
                                },
                                dataType: "json"
                            }
                        },
                        schema: {
                            data: "data",
                            total: "total",
                            model:{
                                id: "name"
                            }
                        },
                        filter: { field: "used", operator: "neq", value: true },
                        requestEnd: function(e) {
                            console.log("START OF get equipment_types cat1 requestEnd event e :", e);

                            while (inserted_computational_equipment.length > 0){

                                var cur_equip = inserted_computational_equipment.pop();

                                for(var i=0; i<e.response.data.length; i++) {
                                    if (e.response.data[i].name === cur_equip){
                                        e.response.data[i].used = true;
                                    }
                                }
                            }
                            console.log("END OF get equipment_types cat1 requestEnd event");
                        }
                    },
                    change: function(e){
                        var userInput = this.value();
                        var equipment = e.sender.dataSource._data;//computationalEquipmentTypesDS.data();

                        validEquipment=false;
                        $.each( equipment, function( index, selectedEquipment ) {
                            if (selectedEquipment.name == userInput){
                                validEquipment = true;
                                return false;
                            }
                        });
                        if(!validEquipment){
                            console.log("equipment input '" + userInput + "' is not a valid one");
                            this.value('');                                    
                        }
                    }
                });
        }
        function networkEquipmentDropDownEditor(container, options) {
        //                console.log("container", container);
        //                console.log("options", options);
            var networkEquipmentComboBox = $('<input id="networkEquipmentDropDownEditor" required validationMessage="Ξέχασες τον εξοπλισμό!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                .appendTo(container)
                .kendoComboBox({
                    autoBind: false,
                    dataSource: {
                        transport: {
                            read: {
                                url: "api/equipment_types",
                                type: "GET",
                                data: {
                                    "equipment_category": 2
                                },
                                dataType: "json"
                            }
                        },
                        schema: {
                            data: "data",
                            total: "total",
                            model:{
                                id: "name"
                            }
                        },
                        filter: { field: "used", operator: "neq", value: true },
                        requestEnd: function(e) {
                            console.log("START OF get equipment_types cat2 requestEnd event e :", e);
                            //Το request end τρέχει ακόμα κι όταν ΔΕΝ γινει το GET request (get equipment types)
                            while (inserted_network_equipment.length > 0){

                                var cur_equip = inserted_network_equipment.pop();

                                for(var i=0; i<e.response.data.length; i++) {
                                    if (e.response.data[i].name === cur_equip){
                                        e.response.data[i].used = true;
                                    }
                                }
                            }                                
                            console.log("END OF get equipment_types cat2 requestEnd event e :");
                        }
                    },
                    change: function(e){
                        var userInput = this.value();
                        var equipment = e.sender.dataSource._data;

                        validEquipment=false;
                        $.each( equipment, function( index, selectedEquipment ) {
                            if (selectedEquipment.name == userInput){
                                validEquipment = true;
                                return false;
                            }
                        });
                        if(!validEquipment){
                            console.log("equipment input '" + userInput + "' is not a valid one");
                            this.value('');                                    
                        }
                    }
                });
        }
        function peripheralDevicesDropDownEditor(container, options) {
        //                console.log("container", container);
        //                console.log("options", options);
            var peripheralDevicesEquipmentComboBox = $('<input id="peripheralDevicesDropDownEditor" required validationMessage="Ξέχασες τον εξοπλισμό!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                .appendTo(container)
                .kendoComboBox({
                    autoBind: false,
                    dataSource: {
                        transport: {
                            read: {
                                url: "api/equipment_types",
                                type: "GET",
                                data: {
                                    "equipment_category": 3
                                },
                                dataType: "json"
                            }
                        },
                        schema: {
                            data: "data",
                            total: "total",
                            model:{
                                id: "name"
                            }
                        },
                        filter: { field: "used", operator: "neq", value: true },
                        requestEnd: function(e) {
                            console.log("START OF get equipment_types cat3 requestEnd event e :", e);

                            while (inserted_peripheral_devices.length > 0){

                                var cur_equip = inserted_peripheral_devices.pop();

                                for(var i=0; i<e.response.data.length; i++) {
                                    if (e.response.data[i].name === cur_equip){
                                        e.response.data[i].used = true;
                                    }
                                }
                            }
                            console.log("END OF get equipment_types cat3 requestEnd event");
                        }
                    },
                    change: function(e){
                        var userInput = this.value();
                        var equipment = e.sender.dataSource._data;

                        validEquipment=false;
                        $.each( equipment, function( index, selectedEquipment ) {
                            if (selectedEquipment.name == userInput){
                                validEquipment = true;
                                return false;
                            }
                        });
                        if(!validEquipment){
                            console.log("equipment input '" + userInput + "' is not a valid one");
                            this.value('');                                    
                        }
                    }
                });
        }
        //σχετίζεται με το grid εισαγωγής πηγών χρηματοδότησης στην επεξεργασία Διάταξης Η/Υ
        function aquisitionSourcesDropDownEditor2(container, options){

            console.log("aquisitionSourcesDS2", aquisitionSourcesDS2);

            var aquisitionSourcesComboBox2 = $('<input id="aquisitionSourcesDropDownEditor2" required validationMessage="Ξέχασες την πηγή χρηματοδότησης!" data-text-field="name" data-value-field="name" data-bind="value:' + options.field + '"/>')
                .appendTo(container)
                .kendoComboBox({
                    autoBind: false,
                    dataSource: aquisitionSourcesDS2,
                    change: function(e){
                        var userInput = this.value();
                        var aquisition_source = e.sender.dataSource._data;

                        validAquisitionSource=false;
                        $.each( aquisition_source, function( index, selectedAquisitionSource ) {
                            if (selectedAquisitionSource.name == userInput){
                                validAquisitionSource = true;
                                return false;
                            }
                        });
                        if(!validAquisitionSource){
                            console.log("aquisition source input '" + userInput + "' is not a valid one");
                            this.value('');                                    
                        }
                    }
                });
        } 
        function aquisitionYearDropDownEditor2(container, options){

            var data = new Array();
            var date = new Date();
            var currentYear = date.getFullYear();
            for(var year=1975; year<=currentYear; year++){
                    data[year-1975] = { year : year  } ;
            }
            data.reverse();

            var aquisitionYearComboBox2 = $('<input id="aquisitionYearDropDownEditor2" required validationMessage="Ξέχασες το έτος χρηματοδότησης!" data-text-field="year" data-value-field="year" data-bind="value:' + options.field + '"/>')
                .appendTo(container)
                .kendoComboBox({
                    autoBind: false,
                    dataSource: data,// {
//                            data: data,
//                            model:{
//                                id:"year",
//                                fields:{
//                                    year: { validation: { required: true, validationMessage:"Ξέχασες το έτος χρηματοδότησης!" } }
//                                }
//                            }
//                        },
                    change: function(e){

                        console.log("year e: ", e);
                        var userInput = this.value();
                        var year = e.sender.dataSource._data;

                        validYear=false;
                        $.each( year, function( index, selectedYear ) {
                            if (selectedYear.year == userInput){
                                validYear = true;
                                return false;
                            }
                        });
                        if(!validYear){
                            console.log("year input '" + userInput + "' is not a valid one");
                            this.value('');                                    
                        }
                    }
                });
        }
        function commentsTextAreaEditor(container, options) {
            $('<textarea class="k-textbox" data-bind="value: ' + options.field + '"></textarea>').appendTo(container);
        }
      
    });
    


</script>

<div id="view1" class="k-grid" style="display: none">
    <script type="text/x-kendo-template" id="labViewLabDetailsTemplate">
        <div class="lab-details-row k-splitter"></div>
    </script>
</div>