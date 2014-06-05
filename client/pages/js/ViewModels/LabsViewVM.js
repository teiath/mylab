var LabsViewVM = kendo.observable({

    labs:  new kendo.data.DataSource({
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
                
//                LabsViewVM.set("labs_count",  e.response.total);
//                LabsViewVM.set("sepehy_count", e.response.all_labs_by_type["ΣΕΠΕΗΥ"]);
//                LabsViewVM.set("etp_count",  e.response.all_labs_by_type["ΕΤΠ"]);
//                LabsViewVM.set("troxilata_count",  e.response.all_labs_by_type["ΤΡΟΧΗΛΑΤΟ"]);
//                LabsViewVM.set("gwnies_count", e.response.all_labs_by_type["ΓΩΝΙΑ"]);
//                LabsViewVM.set("diadrastika_sistimata_count", e.response.all_labs_by_type["ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"]);
                
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
    
            console.log("labs datasource change e:", e);
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
            console.log("labs datasource sync e:", e);
        }
    }), // Να καλείται η newLabsDS

    //labs_count:"",
//    sepehy_count:"",
//    etp_count:"",
//    troxilata_count:"",
//    gwnies_count:"",
//    diadrastika_sistimata_count:"",
//    
//    lab_type:"", //lab_type grid toolbar filter
    
    ds_lab_types: newLabTypesDS(),
    ds_school_units: newSchoolUnitsDS(),
    
    
    createLab:  function(e){

        console.log("labsview create lab");
        
        if (e.model.isNew()) {
            e.container.prev().find(".k-window-title").text("Προσθήκη νέας Διάταξης Η/Υ");
            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
        }
        
        $("#cl_transition_date").data("kendoDatePicker").max(new Date());
              
    },
    transitLab: function(e){
        console.log("transitLab e:", e);

        //var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        //var toState = dataItem.state_id;
        //var command = e.data.commandName;

        var transition_dialog = $("#transition_dialog").kendoWindow({
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 500,
                    open: function(){
                
                        var toState = "";
                        
                        if(e.data.commandName === "activate"){
                            transition_dialog.title("Ενεργοποίηση Διάταξης Η/Υ");
                            $("#transition_dialog").find("#tl>div.k-edit-buttons>button.k-grid-transit").html('<span class="k-icon k-update"></span> Ενεργοποίηση');
                            $("#transition_dialog").find("#tl>div.form-group>div>label#TransitDate").text('Ημερομηνία Ενεργοποίησης');
                            $("#transition_dialog").find("#tl>div.form-group>div>label#TransitJustification").text('Αιτιολογία Ενεργοποίησης');
                            toState = 1;
                        }else if(e.data.commandName === "suspend"){
                            transition_dialog.title("Αναστολή Διάταξης Η/Υ");
                            $("#transition_dialog").find("#tl>div.k-edit-buttons>button.k-grid-transit").html('<span class="k-icon k-update"></span> Αναστολή');
                            $("#transition_dialog").find("#tl>div.form-group>div>label#TransitDate").text('Ημερομηνία Αναστολής');
                            $("#transition_dialog").find("#tl>div.form-group>div>label#TransitJustification").text('Αιτιολογία Αναστολής');
                            toState = 2;
                        }else if(e.data.commandName === "abolish"){
                            transition_dialog.title("Κατάργηση Διάταξης Η/Υ");
                            $("#transition_dialog").find("#tl>div.k-edit-buttons>button.k-grid-transit").html('<span class="k-icon k-update"></span> Κατάργηση');
                            $("#transition_dialog").find("#tl>div.form-group>div>label#TransitDate").text('Ημερομηνία Κατάργησης');
                            $("#transition_dialog").find("#tl>div.form-group>div>label#TransitJustification").text('Αιτιολογία Κατάργησης');
                            toState = 3;
                        }                    
                        
                        $("#cl_transit_date").kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now())
                        });
                
                        $(".k-grid-cancel-transition").on("click", function(e){
                            e.preventDefault(); //?
                            transition_dialog.close();
                        });
                        
                        $(".k-grid-transit").on("click", function(e){
                            e.preventDefault(); //?

                            var suspend_window_element = transition_dialog.element;
                            var suspension_date = suspend_window_element.find("#cl_transit_date").val();
                            var suspension_justification = suspend_window_element.find("#cl_justification").val();

                            var parameters = {
                                      lab_id: dataItem.lab_id,
                                      transition_date: suspension_date,
                                      transition_justification: suspension_justification,
                                      transition_source: 'mylab',
                                      state: toState
                                    };

                            transitAjaxRequest('POST', 'lab_transitions', parameters, transition_dialog);
                            
                        });
                    }
        }).data("kendoWindow");
        
        var transitTemplate = kendo.template($("#lab_transit_template").html());
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        transition_dialog.content(transitTemplate(dataItem));
        transition_dialog.center().open();
    },
    detailInit: function(e){
        console.log("labs view detailInit", e);
                
        //kendo.bind($("#lab_details_tabstrip"), LabsViewVM); //δεν καταλαβαίνω γιατι αλλά without this line, detail template EVENT bindings  will not work!!
        kendo.bind(e.detailRow, e.data); //SOS: without this line, detail template bindings will not work!!
        
        //console.log("e.detailRow: ", e.detailRow);
        //console.log("e.data: ", e.data);
        
        e.detailRow.find("#lab_details_tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn" } }
        });
                
        var equipment_details = e.detailRow.find("#equipment_details").kendoGrid({
            //dataSource: e.data.equipment_types,
            dataSource: newLabEquipmentTypesDS(e.data.lab_id, e.detailRow),
            scrollable: false,
            selectable: false,
            editable: "inline",
            toolbar: [{ name: "create", text: "Προσθήκη Εξοπλισμού" }],
            columns: [
                { field: "equipment_type", 
                  title: "εξοπλισμός",
                  editor: function (container, options){
                      
                        var data = equipment_details.dataSource.data();
                        var usedEquipment = [];
                        $.each(data, function(index, value){
                            if (data[index].equipment_type !== ""){
                                usedEquipment.push(data[index].equipment_type);
                            }
                        });
                        
                        //options.field = "equipment_type"
                        $('<input id="equipment_type_column_editor" name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="name" data-value-field="name" required data-required-msg="Ξέχασες τον τύπο εξοπλισμού!" />')
                        .appendTo(container)
                        .kendoComboBox({
                            dataSource: newEquipmentTypesDS(usedEquipment)
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);                        
                        
                  },
                  width: '50%' 
                },
                { field: "items", 
                  title:"πλήθος", 
                  format: "{0:n0}",
                  width: '20%' 
                },
                { command: [{ name: 'edit'}, {name: 'destroy'}], 
                  title: 'ενέργειες', 
                  width: '30%' 
                }
            ],
            edit: function(e){
                if (!e.model.isNew()) {
                    //on update, make equipment_type not editable
                    e.container.find("td:eq(0)").text(e.model.equipment_type);
                }
            }
        }).data("kendoGrid");        
        
        var aquisition_sources_details = e.detailRow.find("#aquisition_sources_details").kendoGrid({
            //dataSource: e.data.aquisition_sources,
            dataSource: newLabAquisitionSourcesDS(e.data.lab_id, e.detailRow),
            scrollable: false,
            selectable: false,
            editable: "inline",
            toolbar: [{ name: "create", text: "Προσθήκη Πηγής Χρηματοδότησης" }],
            columns: [
                { field: "aquisition_source", 
                  title: "πηγή χρηματοδότησης",
                  editor: function (container, options){
                      
                        //options.field = aquisition_source
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="name" data-value-field="name" required data-required-msg="Ξέχασες την πηγή χρηματοδότησης!"/>')
                        .appendTo(container)
                        .kendoComboBox({
                            dataSource: newAquisitionSourcesDS()
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);
                  }, 
                  width: '20%' 
                },
                { field: "aquisition_year",
                  title:"έτος",
                  editor: function (container, options){                    
                        //options.field =  aquisition_year
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="year" data-value-field="year" required data-required-msg="Ξέχασες το έτος χρηματοδότησης!"/>')
                        .appendTo(container)
                        .kendoComboBox({
                            dataSource: newAquisitionYearsDS(1975)
                        });    
                                                
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);    
                  }, 
                  width: '20%' 
                },
                { field: "aquisition_comments", 
                  title: "σχόλια",
                  editor: function (container, options){
                      $('<textarea class="k-textbox" data-bind="value: ' + options.field + '"></textarea>').appendTo(container);
                  }, 
                  width: '30%' 
                },
                { command: [{ name: 'edit'}, {name: 'destroy'}], 
                  title: 'ενέργειες', 
                  width: '30%' 
                }
            ],
            edit: function(e){
                if (!e.model.isNew()) {
                    //on update, make aquisition_source not editable
                    e.container.find("td:eq(0)").text(e.model.aquisition_source);
                }
            }           
        }).data("kendoGrid");

        var lab_workers_details = e.detailRow.find("#lab_workers_details").kendoGrid({
            //dataSource: e.data.lab_workers,
            dataSource: newLabWorkersDS(e.data.lab_id, e.detailRow, 1),
            scrollable: false,
            selectable: false,
            editable: "inline",
            toolbar: [{ name: "create", text: "Προσθήκη Υπεύθυνου Εργαστηρίου" }],
            columns: [
                { field: "fullname", 
                  title: "ονοματεπώνυμο",
                  template: "#= lastname + ' ' + firstname #",
                  editor: function (container, options){
                        console.log("options.field", options.field);
                        //options.field = fullname
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="fullname" data-value-field="worker_id" required data-required-msg="Ξέχασες τον υπεύθυνο!" />')
                        .appendTo(container)
                        .kendoComboBox({
                            dataSource: newWorkersDS(),
                            autoBind: false,
                            filter: "contains",
                            //dataValueField: "worker_id",
                            //dataTextField: "fullname",
                            minLength: 3,
                            change: function(e){
                                console.log("worker_id column editor on change e:", e);
                            }
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);
                  }, 
                  width: '30%'
                },
                { field: "registry_no", 
                  title: "ΑΜ", 
                  width: '5%' 
                },
                { field: "specialization_code", 
                  title: "ειδικότητα", 
                  width: '5%' 
                },
                {
                  field: "worker_start_service", 
                  title: "ημ/νία διορισμού",
                  editor: function (container, options){
                        //options.field: The name of the field to which the column is bound.
                        //options.field= worker_start_service
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '"  required data-required-msg="Ξέχασες την ημερομηνία!" />')
                        .appendTo(container)
                        .kendoDatePicker({
                            max: new Date(),
                            format: "yyyy-MM-dd"
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);                        
                        
                  }, 
                  width: '10%' 
                },
                {
                  field: "worker_status",
                  template: function(dataItem) {
                      if(dataItem.worker_status == 1) return "ΕΝΕΡΓΟΣ"; else if (dataItem.worker_status == 3) return "ΑΝΕΝΕΡΓΟΣ";
                  },
                  title: "κατάσταση", 
                  width: '5%' 
                },
                { command: [ { name: 'edit'}, 
                             { name: "Απενεργοποίηση Υπευθύνου",
                                click: function(e) {
                                    var tr = $(e.target).closest("tr");
                                    var data = this.dataItem(tr);
                                    console.log("data: ", data);
                                    
                                    var parameters = {
                                      lab_worker_id: data.lab_worker_id,
                                      worker_status: 3
                                    };
                                    
                                    $.ajax({
                                            type: 'PUT',
                                            url: 'http://172.16.16.80/mylab/api/lab_workers',
                                            dataType: "json",
                                            data: JSON.stringify(parameters),
                                            success: function(data){

                                                if(data.status == 200){
                                                    notification.show({
                                                        title: "Η απενεργοποίηση πραγματοποιήθηκε",
                                                        message: data.message
                                                    }, "upload-success");                                            

                                                    //detailRow.find("#lab_workers_details").data("kendoGrid").dataSource.read();
                                                    lab_workers_details.dataSource.read();
                                                    lab_workers_logs.dataSource.read();

                                                }else if(data.status == 500){

                                                    notification.show({
                                                        title: "Η απενεργοποίηση απέτυχε",
                                                        message: data.message
                                                    }, "error");

                                                }

                                            },
                                            error: function (data){ console.log("PUT lab_workers error data: ", data);}
                                    });                                    
                                    
                                }
                             }
                           ],
                  title: 'ενέργειες', 
                  width: '30%'
                }
            ],
            edit: function(e){
                //if (!e.model.isNew()) {
                    //on update, make aquisition_source not editable
                    e.container.find("td:eq(1)").text(e.model.registry_no);
                    e.container.find("td:eq(2)").text(e.model.specialization_code);
                    e.container.find("td:eq(4)").text("ΕΝΕΡΓΟΣ");
                //}
            }
        }).data("kendoGrid");      

        var lab_workers_logs = e.detailRow.find("#lab_workers_logs").kendoGrid({
            dataSource: newLabWorkersDS(e.data.lab_id, e.detailRow, 3),
            scrollable: false,
            selectable: false,
            columns: [
                { template: "#= lastname + ' ' + firstname #",
                  title: "ονοματεπώνυμο", 
                  width: '10%' 
                },
                { field: "registry_no", 
                  title: "ΑΜ", 
                  width: '5%' 
                },
                { field: "specialization_code", 
                  title: "ειδικότητα", 
                  width: '5%' 
                },
                {
                  field: "worker_start_service", 
                  title: "ημ/νία διορισμού",
                  width: '10%' 
                },
                {
                  field: "worker_status",
                  template: function(dataItem){
                      if(dataItem.worker_status == 1) return "ΕΝΕΡΓΟΣ"; else if (dataItem.worker_status == 3) return "ΑΝΕΝΕΡΓΟΣ";
                  },
                  title: "κατάσταση", 
                  width: '5%' 
                }
            ]
        }).data("kendoGrid");

        var lab_relations_details = e.detailRow.find("#lab_relations_details").kendoGrid({
            //dataSource: e.data.lab_relations,
            dataSource: newLabRelationsDS(e.data.lab_id, e.detailRow),
            scrollable: false,
            selectable: false,
            editable: "inline",
            toolbar: [{ name: "create", text: "Προσθήκη νέας συσχέτισης" }],
            columns: [
                { field: "relation_type_name",
                  title: "συσχέτιση",
                  editor: function (container, options){

                        var data = lab_relations_details.dataSource.data();
                        var isServedOnline=false;
                        $.each(data, function(index, value){
                            if (data[index].relation_type_id === "1"){
                                isServedOnline = true;
                                return;
                            }
                        });
                        
                        console.log("options.field", options.field);
                        $('<input id="relation_type_parent" name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="name" data-value-field="name" required data-required-msg="Ξέχασες τον τύπο συσχέτισης!" />')
                        .appendTo(container)
                        .kendoDropDownList({
                            autoBind: false,
                            optionLabel: {
                                name: "Επιλέξτε συσχέτιση"
                            },
                            dataSource: newRelationTypesDS(isServedOnline),
                            change: function(e){                                                 
                                
                                var child = $('#child').data("kendoDropDownList");
                                if(this.value() === "ΕΞΥΠΗΡΕΤΕΙΤΑΙ ΔΙΑΔΙΚΤΥΑΚΑ"){
                                    child.enable(true);
                                }else if(this.value() === "ΕΞΥΠΗΡΕΤΕΙ ΥΠΗΡΕΣΙΑΚΑ"){
                                    child.enable(false);
                                    //αν υπάρχει validation tooltip στον αρ. κυκλώματος βγάλτο
                                }
                           }
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);
                  }, 
                  width: '20%'
                },
                { field: "school_unit", 
                  title:"σχολική μονάδα",
                  editor: function (container, options){
                        
                        //console.log("options.field", options.field);
                        $('<input id="school_unit_parent" name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="name" data-value-field="school_unit_id" required data-required-msg="Ξέχασες τη σχολική μονάδα!" />')
                        .appendTo(container)
                        .kendoComboBox({
                            autoBind: false,
                            dataSource: newSchoolUnitsDS(), //εδω μπορεί να μπεί και παράμετρος edu_admin
                            filter: "contains",
                            change: function(e){
                                                               
                                var relation_type_parent = $('#relation_type_parent').data("kendoDropDownList");
                                if(relation_type_parent.value() === "ΕΞΥΠΗΡΕΤΕΙΤΑΙ ΔΙΑΔΙΚΤΥΑΚΑ"){
                                    var school_unit_id = this.value();
                                    var child = $('#child').data("kendoDropDownList");
                                    child.dataSource.read({ school_unit: school_unit_id });
                                }
                                
                            }                         
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);                      
                      
                  }, 
                  width: '35%'        
                },
                { field: "circuit_phone_number", 
                  title: "αριθμός κυκλώματος",
                  editor: function (container, options){
              
                        //console.log("options.field", options.field);
                        $('<input id="child" name="' + options.field + '" data-bind="value:' + options.field + '" data-value-field="circuit_id" required data-required-msg="Ξέχασες τον αρ. κυκλώματος!" />')
                        .appendTo(container)
                        .kendoDropDownList({
                            autoBind: false,
                            dataTextField : "phone_number",
                            template: "#= phone_number + ' (' + relation_type_name + ')'#",
                            optionLabel: {
                                phone_number: "Επιλέξτε κύκλωμα",
                                circuit_id: "",
                                relation_type_name:"αρ. κυκλώματος"
                            },
                            enable: false,
//                            cascadeFrom: "school_unit_parent",
//                            cascadeFromField: "school_unit_id",
                            dataSource: newCircuitsDS()
//                          cascade: function(e){}
                        });
                        
                        var tooltipElement = $('<span id="circuit_tooltip" class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);                      
                      
                  }, 
                  width: '25%'
                },
                { command: [{ name: 'edit'}, {name: 'destroy'}], 
                  title: 'ενέργειες', 
                  width: '20%' 
                }
            ]           
        }).data("kendoGrid");
        
        var lab_transitions_details = e.detailRow.find("#lab_transitions_details").kendoGrid({
            dataSource: newLabTransitionsDS(e.data.lab_id, e.detailRow), //e.data.lab_transitions,
            scrollable: false,
            selectable: false,
            columns: [
                { field: "from_state", title: "προηγούμενη κατάσταση"},
                { field: "to_state", title:"παρούσα κατάσταση"},
                { field: "transition_date", title: "ημερομηνία μετάβασης"},
                { field: "transition_justification", title: "αιτιολογία μετάβασης"},
                { field: "transition_source", title: "πηγή μετάβασης"}
            ]           
        }).data("kendoGrid");
        
//        e.detailRow.find("#special_name_edit").click(function(e) {
//            console.log("special_name_edit e:", e);
//        });
    },
    dataBoundLab: function(e){
        console.log("dataBoundLab e: ", e );
        var data_items = e.sender.dataSource.data();        
        $.each(data_items, function(index, value){
            
            var currentRow = $(e.sender.tbody).find("tr").eq(index);
            var activateButton = $(currentRow).children('td:last').find(".k-grid-activate");
            var suspendButton = $(currentRow).children('td:last').find(".k-grid-suspend");
            var abolishButton = $(currentRow).children('td:last').find(".k-grid-abolish");

            var state = data_items[index].state_id;

            if(state == "1"){
                
                activateButton.addClass('k-state-disabled');
                activateButton.click(function() { return false; });
                
                suspendButton.removeClass('k-state-disabled');
                //suspendButton.on('transitLab');
                
                abolishButton.removeClass('k-state-disabled');
                //abolishButton.on('transitLab');
                
            }else if(state == "2"){

                activateButton.removeClass('k-state-disabled');
                //activateButton.removeAttr('disabled');
                
                suspendButton.addClass('k-state-disabled');
                suspendButton.click(function() { return false; });
                
                abolishButton.removeClass('k-state-disabled');
                //abolishButton.removeAttr('disabled');         
                
            }else if(state == "3"){

                activateButton.addClass('k-state-disabled');
                activateButton.click(function() { return false; });
                
                suspendButton.addClass('k-state-disabled');
                suspendButton.click(function() { return false; });
                
                abolishButton.addClass('k-state-disabled');
                abolishButton.click(function() { return false; });

            }
            
        });
//        console.log("e.sender.element: ", e.sender.element);
//        kendo.bind(e.sender.element.find(".k-toolbar"), LabsSearchVM);
    }
//    toolbarFilter: function(e){
//        console.log("toolbarFilter: ", e);
//        
//        var school_units_grid = $("#school_units_view").data("kendoGrid");
//        var school_unit_row = e.sender.wrapper.closest("tr.k-detail-row").prev();
//        var dataItem = school_units_grid.dataItem(school_unit_row);
//        
//        var filter = [{name: "lab_type", value: e.data.lab_type}, 
//                      {name: "school_unit_id", value: dataItem.school_unit_id}];        
//        
//        //console.log("school_units_view",school_unit_row);
//        //console.log("dataItem",dataItem);
//        //console.log("filter: ", filter);
//        
//        var labs_grid = e.sender.wrapper.closest(".k-grid").data("kendoGrid");
//        labs_grid.dataSource.filter(normalizeParams(filter));
//        //LabsViewVM.labs.filter(normalizeParams(filter)); //δεν χρειάζεται για το Labs view
//    }
});