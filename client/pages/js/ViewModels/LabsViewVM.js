var LabsViewVM = kendo.observable({

    isVisible: true,

    labs:  new kendo.data.DataSource({
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
//            update: {
//                url: "api/labs",
//                type: "POST",
//                dataType: "json"
//            },
            parameterMap: function(data, type) {
                if (type === 'read') {
                    
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
                    
                    // for  multiple partial string search in school_unit_name, school_unit_special_name, lab_name, lab_special_name inputs
                    data['searchtype'] = "containall";
                    //user authorization
                    //data['user'] = user;
                    
                    return data;
                    
                }else if(type === 'create'){
                    
                    
                    
                    //normalize transition_date parameter
                    data["transition_date"] = kendo.toString(data["transition_date"], "yyyy/MM/dd");
                    data["ellak"] = (data["ellak"])? true : false; 

                    //standar parameters in lab creation
                    data["state"] = "1";
                    data["lab_source"] = "1";
                    data["transition_source"] = "mylab";
                    data["transition_justification"] = "δημιουργία Διάταξης Η/Υ";
                    
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
                    state:{},
                    lab_source:{},
                    transition_source:{},                    
                    transition_justification:{},
                    school_unit_id:{},
                    school_unit_name:{},
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
            //console.log("labs datasource requestEnd e:", e);
            if (e.type=="read"){
                if(typeof e.response.all_labs_by_type !== 'undefined'){
                    LabsViewVM.set("sepehy",  e.response.all_labs_by_type['ΣΕΠΕΗΥ']);
                    LabsViewVM.set("etp",  e.response.all_labs_by_type['ΕΤΠ']);
                    LabsViewVM.set("gwnia",  e.response.all_labs_by_type['ΓΩΝΙΑ']);
                    LabsViewVM.set("diadrastiko",  e.response.all_labs_by_type['ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ']);
                    LabsViewVM.set("troxilato",  e.response.all_labs_by_type['ΤΡΟΧΗΛΑΤΟ']);
                }else{ //εαν ο χρήστης βάλει βλακείες σε κάποιο πεδίο πχ lab_id = sefwgei, τότε ΔΕΝ επιστρεφεται το all_labs_by_type 
                    LabsViewVM.set("sepehy",  0);
                    LabsViewVM.set("etp", 0);
                    LabsViewVM.set("gwnia",  0);
                    LabsViewVM.set("diadrastiko", 0);
                    LabsViewVM.set("troxilato", 0);                    
                }
            }else if (e.type=="create" || e.type=="destroy"){
                
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
                    
                    LabsViewVM.labs.read();               
                    
                }else{
                    
                    notification.show({
                        title: "Η δημιουργία του εργαστηρίου απέτυχε",
                        message: message
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
        }
    }), // Να καλείται η newLabsDS

    sepehy: null,
    etp:null,
    gwnia: null,
    diadrastiko: null,
    troxilato: null,    
    
    ds_lab_types: newLabTypesDS(),
    ds_school_units: newSchoolUnitsDS(1), //used inside labCreateTemplate.html
    
    refresh_btn: false,
    //ellakVisible: false,
    
    createLab:  function(e){

        console.log("labsview create lab: ", e);
        e.preventDefault(); //?
        
        if (e.model.isNew()) {
            e.container.prev().find(".k-window-title").text("Προσθήκη νέας Διάταξης Η/Υ");
            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update").text("Προσθήκη");
            e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel").text("Άκυρο");
        }
        
        $("#cl_transition_date").data("kendoDatePicker").max(new Date());
        
        //kendo.bind($("#cl_ellak"), LabsViewVM);
        //$("#cl_ellak").attr("visible", LabsViewVM.ellakVisible);
        
        function changeEllak(e){
            console.log("changeEllak e: ", e);
            var value = this.value();
            if (value==1){ // σεπεηυ = 1
                $("#cl_ellak").closest("div.form-group").show();
                //LabsViewVM.ellakVisible = true;
            }else{
                $("#cl_ellak").closest("div.form-group").hide();
                //LabsViewVM.ellakVisible = false;
            }
        }
        
        var lab_type = $("#cl_lab_type").data("kendoComboBox");
        lab_type.bind("change", changeEllak);
        
        //Αυτή η συνθήκη παίζει να μην χρειάζεται και απλά το πεδίο της σχ. μονάδας να γίνεται hide
        if (e.sender.element.closest("tr").hasClass("k-detail-row")){ //έλεγξε αν βρισκόμαστε σε school units view
            var tr = e.sender.element.closest("tr").prev();
            var grid = tr.closest("div#school_units_view").data("kendoGrid");
            var item = grid.dataItem(tr);
            var school_unit = item.school_unit_name; //item.school_unit_id;
            
            $("#cl_school_unit").data("kendoComboBox").readonly(true);
            $("#cl_school_unit").prev().find("input").prop('disabled', true);
            $("#cl_school_unit").data("kendoComboBox").value(school_unit);
        }
         
        
        //e.container.closest(".k-window").attr('pinned', true);
        //editWindow.center().pin();
        //console.log("editWindow: ", editWindow);
         
    },
    transitLab: function(e){
        //console.log("transitLab e:", e);
        e.preventDefault();
        //var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        //var toState = dataItem.state_id;
        //var command = e.data.commandName;
        var parent_grid = $(e.delegateTarget).data("kendoGrid");
        
        var transition_dialog = $("#transition_dialog").kendoWindow({
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 500,
                    pinned:true,
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

                            transitAjaxRequest('POST', 'lab_transitions', parameters, transition_dialog, parent_grid);
                            
                        });
                    }
        }).data("kendoWindow");
        
        var transitTemplate = kendo.template($("#lab_transit_template").html());
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        transition_dialog.content(transitTemplate(dataItem));
        transition_dialog.center().open();
    },
    detailInit: function(e){
                
        //console.log("labs view detailInit", e);
        e.preventDefault();
        //kendo.bind($("#lab_details_tabstrip"), LabsViewVM); //δεν καταλαβαίνω γιατι αλλά without this line, detail template EVENT bindings  will not work!!
        kendo.bind(e.detailRow, e.data); //SOS: without this line, detail template bindings will not work!!
        
        //console.log("e.detailRow: ", e.detailRow);
        //console.log("e.data: ", e.data);
        
        var scroll;
        e.detailRow.find("#lab_details_tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn" } },
            select: function(e){
                scroll = $(document).scrollTop();
            },
            activate: function(e){
                $(document).scrollTop(scroll);
            }
        });
                   
        var equipment_details = e.detailRow.find("#equipment_details").kendoGrid({
            //dataSource: e.data.equipment_types,
            dataSource: newLabEquipmentTypesDS(e.data.lab_id, e.detailRow),
            scrollable: false,
            selectable: false,
            editable: "inline",
            toolbar: function(){
                        if(jQuery.inArray( authorized_user , edit_lab_details ) !== -1 && e.data.lab_state_id === 1){
                            return [{ name: "create", text: "Προσθήκη Εξοπλισμού" }];
                        }
                     }(),
            columns: [
                { field: "equipment_type_name", 
                  title: "εξοπλισμός",
                  editor: function (container, options){
                      
                        var data = equipment_details.dataSource.data();
                        var usedEquipment = [];
                        //exclude already used equipment
                        $.each(data, function(index, value){
                            if (data[index].equipment_type_name !== ""){
                                usedEquipment.push(data[index].equipment_type_name);
                            }
                        });
                        
                        console.log("equipment_details options.field: ", options.field);
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
                  width: '30%', 
                  hidden: function(){
                      var hide = (jQuery.inArray( authorized_user , edit_lab_details ) !== -1) ? false : true;
                      return hide;
                  }()
                }
            ],
            edit: function(e){
                if (!e.model.isNew()) {
                    //on update, make equipment_type not editable
                    e.container.find("td:eq(0)").text(e.model.equipment_type_name);
                }
            }
        }).data("kendoGrid");        
        
        var aquisition_sources_details = e.detailRow.find("#aquisition_sources_details").kendoGrid({
            //dataSource: e.data.aquisition_sources,
            dataSource: newLabAquisitionSourcesDS(e.data.lab_id, e.detailRow),
            scrollable: false,
            selectable: false,
            editable: "inline",
            toolbar: function(){
                        if(jQuery.inArray( authorized_user , edit_lab_details ) !== -1 && e.data.lab_state_id !== 2 && e.data.lab_state_id !== 3){
                            return [{ name: "create", text: "Προσθήκη Πηγής Χρηματοδότησης" }];
                        }
                    }(),
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
                        //console.log("options.field: ", options.field);
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" required data-required-msg="Ξέχασες το έτος χρηματοδότησης!"/>')
                        .appendTo(container)
                        .kendoComboBox({                    
                            dataTextField: "year",
                            dataValueField: "year",
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
                  width: '30%', 
                  hidden: function(){
                      var hide = (jQuery.inArray( authorized_user , edit_lab_details ) !== -1) ? false : true;
                      return hide;
                  }()
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
            dataSource: newLabWorkersDS(e.data.lab_id, e.detailRow/*, 1*/),
            scrollable: false,
            selectable: false,
            editable: "inline",
            toolbar: [{ template: kendo.template($("#lab_details_lab_workers_toolbar_template").html()), binded_data: e.data }], //binded_data is custom
            columns: [
                { field: "fullname", 
                  title: "ονοματεπώνυμο",
                  template: "#= lastname + ' ' + firstname #",
                  editor: function (container, options){
                        //options.field = fullname
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="fullname" data-value-field="worker_id" required data-required-msg="Ξέχασες τον υπεύθυνο!" />')
                        .appendTo(container)
                        .kendoComboBox({
                            dataSource: newWorkersDS(),
                            autoBind: false,
                            filter: "contains",
                            //dataValueField: "worker_id",
                            //dataTextField: "fullname",
                            //minLength: 1,
                            change: function(e){
                                //console.log("worker_id column editor on change e:", e);
                                //var dataItem =  lab_workers_details.dataSource.at(0);
                                //console.log("dataItem: ", dataItem);
                                //dataItem.specialization_code_name = "ΠΕ70";
                                //dataItem.worker_registry_no = "123146";
                                        
                            }
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);
                  }, 
                  width: '30%'
                },
                { field: "worker_registry_no", 
                  title: "ΑΜ", 
                  width: '10%' 
                },
                { field: "specialization_code_name", 
                  title: "ειδικότητα", 
                  width: '10%' 
                },
                {
                  field: "worker_start_service", 
                  title: "ανάληψη ευθύνης",
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
                  width: '15%' 
                },
                {
                  field: "worker_status",
                  template: function(dataItem) {
                      if(dataItem.worker_status == 1) return "ΕΝΕΡΓΟΣ"; else if (dataItem.worker_status == 3) return "ΑΝΕΝΕΡΓΟΣ";
                  },
                  title: "κατάσταση", 
                  width: '10%' 
                },
                { command: [ { name: 'edit'}, 
                             { name: "Απενεργοποίηση Υπευθύνου",
                                click: function(e) {

                                    e.preventDefault();

                                    var tr = $(e.target).closest("tr");
                                    var data = this.dataItem(tr);

                                    var parameters = {
                                      lab_worker_id: data.lab_worker_id,
                                      worker_status: 3
                                    };

                                    var disable_lab_worker_dialog = $("#disable_lab_worker_dialog").kendoWindow({
                                                modal: true,
                                                visible: false,
                                                resizable: false,
                                                width: 400,
                                                pinned:true,
                                                title:"Απενεργοποίηση Υπεύθυνου Εργαστηρίου",
                                                open: function(){

                                                    $(".k-grid-cancel-disabling").on("click", function(e){
                                                        e.preventDefault(); //?
                                                        disable_lab_worker_dialog.close();
                                                    });

                                                    $(".k-grid-disable").on("click", function(e){
                                                        e.preventDefault(); //?

                                                        $.ajax({
                                                                type: 'PUT',
                                                                url: baseURL + 'lab_workers?user=' + user_url,
                                                                dataType: "json",
                                                                data: JSON.stringify(parameters),
                                                                success: function(data){

                                                                    var message;
                                                                    if (typeof data.message !== 'undefined'){
                                                                        message= data.message;
                                                                    }else if (typeof data.message_internal !== 'undefined'){
                                                                        message= data.message_internal;
                                                                    }else if (typeof data.message_external !== 'undefined'){
                                                                        message= data.message_external;
                                                                    }

                                                                    if(data.status == 200){
                                                                        notification.show({
                                                                            title: "Η απενεργοποίηση πραγματοποιήθηκε",
                                                                            message: message
                                                                        }, "success");                                            

                                                                        //detailRow.find("#lab_workers_details").data("kendoGrid").dataSource.read();
                                                                        lab_workers_details.dataSource.read();

                                                                    }else if(data.status == 500){

                                                                        notification.show({
                                                                            title: "Η απενεργοποίηση απέτυχε",
                                                                            message: message
                                                                        }, "error");

                                                                    }

                                                                },
                                                                error: function (data){ console.log("PUT lab_workers error data: ", data);}
                                                        });
                                                        disable_lab_worker_dialog.close();

                                                    });
                                                }
                                    }).data("kendoWindow");

                                    var disableTemplate = kendo.template($("#disable_lab_worker_template").html());
                                    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                                    disable_lab_worker_dialog.content(disableTemplate(dataItem));
                                    disable_lab_worker_dialog.center().open();                                    
                                }
                             }
                           ],
                  title: 'ενέργειες', 
                  width: '25%',
                  hidden: function(){
                      var hide = (jQuery.inArray( authorized_user , edit_lab_worker ) !== -1) ? false : true;
                      return hide;
                  }()
                }
            ],
            edit: function(e){
                //if (!e.model.isNew()) {
                    //on update, make lab_worker not editable
                    e.container.find("td:eq(1)").text(e.model.worker_registry_no); //registry_no
                    e.container.find("td:eq(2)").text(e.model.specialization_code_name); //specialization_code
                    e.container.find("td:eq(4)").text("ΕΝΕΡΓΟΣ");
                //}
            },
            dataBound: function(e){
                //console.log("lab workers databound: ", e);
                $.each(e.sender.dataSource.data(), function(index, value){
                    var tr= e.sender.tbody.find("tr:eq(" + index + ")");
                    var dataitem= e.sender.dataItem(tr);
                    // if worker is not active 1)remove its row's "disable responsible" functionality and 2) hide its row from grid if grid is not in the "show logs" mode
                    if (dataitem.worker_status !== 1 && dataitem.worker_status !== ""){
                        tr.find("td:last-child>a.k-grid-ΑπενεργοποίησηΥπευθύνου").remove(); 
                        if(lab_workers_details.element.find(".k-toolbar>button#show_lab_worker_logs_btn").text() === "προβολή ιστορικού"){
                            tr.hide();
                        }
                    }
                });
            }
        }).data("kendoGrid");
        //kendo.bind($("#lab_details_lab_workers_toolbar_template"), e.data);

        var lab_relations_details = e.detailRow.find("#lab_relations_details").kendoGrid({
            //dataSource: e.data.lab_relations,
            dataSource: newLabRelationsDS(e.data.lab_id, e.detailRow),
            scrollable: false,
            selectable: false,
            editable: "inline",
            toolbar: function(){
                        if(jQuery.inArray( authorized_user , edit_lab_details ) !== -1 && e.data.lab_state_id !== 2 && e.data.lab_state_id !== 3){
                            return [{ name: "create", text: "Προσθήκη νέας συσχέτισης" }];
                        }
                    }(),
            columns: [
                { field: "relation_type_name",
                  title: "συσχέτιση",
                  editor: function (container, options){
                        
                        //check if there's already a 'served online' relation and hide the corresponding option
                        var data = lab_relations_details.dataSource.data();
                        var isServedOnline=false;
                        $.each(data, function(index, value){
                            if (data[index].relation_type_id === 1){
                                isServedOnline = true;
                                return;
                            }
                        });
                        
                        //console.log("options.field", options.field);
                        $('<input id="relation_type_parent" name="' + options.field + '" data-bind="value:' + options.field + '" data-value-field="name" required data-required-msg="Ξέχασες τον τύπο συσχέτισης!" />')
                        .appendTo(container)
                        .kendoDropDownList({
                            autoBind: false,
                            dataTextField: "name",
                            optionLabel: { //bug του kendo λογικα.. όταν το optionLabel ειναι enabled δεν παίζει το validation tooltip
                                name: "Επιλέξτε συσχέτιση"
                            },
                            dataSource: newRelationTypesDS(isServedOnline),
                            change: function(e){
                                
                                var parent = $('#school_unit_parent').data("kendoComboBox");
                                var child = $('#child').data("kendoDropDownList");
                                
                                parent.text("");
                                parent.value("");
                                var koko = newSchoolUnitsDS();
                                koko.read();
                                parent.setDataSource(koko);
                                
                                var kiki = newCircuitsDS();
                                kiki.read();
                                child.setDataSource(kiki);
                                
                                if(this.value() === "ΕΞΥΠΗΡΕΤΕΙΤΑΙ ΔΙΑΔΙΚΤΥΑΚΑ"){ //BUG: στην 1η επιλογή του χρήστη απ'την ddl, αν αυτή είναι το "ΕΞΥΠΗΡΕΤΕΙΤΑΙ ΔΙΑΔΙΚΤΥΑΚΑ", ΔΕΝ τρέχει το on change event
                                    child.enable(true);
                                }else if(this.value() === "ΕΞΥΠΗΡΕΤΕΙ ΥΠΗΡΕΣΙΑΚΑ"){
                                    //αν υπάρχει validation tooltip στον αρ. κυκλώματος βγάλτο
                                    child.enable(false); // discable circuit input
                                    child.select(child.ul.children().eq(0)); // set circuit input's text to its option label
                                    child.element.closest(".k-dropdown").next().css("display", "none"); // hide circuit's input validation tooltip
                                }
                           }
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);
                  }, 
                  width: '20%'
                },
                { field: "school_unit_name", 
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
                                    child.dataSource.read({ school_unit_id: school_unit_id });
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
              
                        //console.log("options.field", options.field); // =circuit_phone_number
                        $('<input id="child" name="' + options.field + '" data-bind="value:' + options.field + '" data-value-field="circuit_id" required data-required-msg="Ξέχασες τον αρ. κυκλώματος!" />')
                        .appendTo(container)
                        .kendoDropDownList({
                            autoBind: false,
                            dataTextField : "phone_number",
                            template: "#= phone_number + ' (' + circuit_type_name + ')'#",
                            optionLabel: {
                                phone_number: "Επιλέξτε κύκλωμα",
                                circuit_id: "",
                                circuit_type_name:"αρ. κυκλώματος"
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
                  width: '20%', 
                  hidden: function(){
                      var hide = (jQuery.inArray( authorized_user , edit_lab_details ) !== -1) ? false : true;
                      return hide;
                  }()
                }
            ]           
        }).data("kendoGrid");
        
        var lab_transitions_details = e.detailRow.find("#lab_transitions_details").kendoGrid({
            dataSource: newLabTransitionsDS(e.data.lab_id, e.detailRow), //e.data.lab_transitions,
            scrollable: false,
            selectable: false,
            columns: [
                { field: "from_state_name", title: "προηγούμενη κατάσταση"},
                { field: "to_state_name", title:"παρούσα κατάσταση"},
                { field: "transition_date", title: "ημερομηνία μετάβασης"},
                { field: "transition_justification", title: "αιτιολογία μετάβασης"},
                { field: "transition_source", title: "πηγή μετάβασης"}
            ]           
        }).data("kendoGrid");
        
        var data = this.dataSource.data(); //ta data items tou labs grid
        var codeDetailData = e.data;    //ta data tou expanded row
        
        var lab_general_info_details = e.detailRow.find("#lab_general_info_details").kendoListView({
            //dataSource: [e.data], //newLabGeneralInfoDS(e.data.lab_id, e.detailRow),
            //dataSource: newLabGeneralInfoDS(e.data.lab_id, e.detailRow),
            dataSource : new kendo.data.DataSource({
                data: [codeDetailData.toJSON()],
                schema : {
                    //data: "data",
                    model: {
                        id: "lab_id",
                        fields:{
                            lab_id:{editable:false},
                            positioning:{},
                            lab_special_name:{},
                            creation_date:{},
                            lab_type:{}, //needed for ellak
                            ellak:{}
                        }
                    }
                }
            }),
            save: function(e) {
                if (this.editable.end()) {
                    data.splice(data.indexOf(codeDetailData), 1, e.model); //αντικατέστησε στο datasource του grid, το item το οποιο επεξεργάστηκες (e.model)
                               
                    console.log("e.model: ", e.model);
                    
                    var parameters = {
                              lab_id: e.model.lab_id,
                              special_name: e.model.lab_special_name,
                              positioning: e.model.positioning,
                              ellak: "'" + e.model.ellak_boolean + "'"//)? "1" : "0"
                            };
                    
                    $.ajax({
                            type: 'PUT',
                            url: baseURL + "labs?user=" + user_url,
                            dataType: "json",
                            data: JSON.stringify(parameters),
                            success: function(data){

                                var message;
                                if (typeof data.message !== 'undefined'){
                                    message= data.message;
                                }else if (typeof data.message_internal !== 'undefined'){
                                    message= data.message_internal;
                                }else if (typeof data.message_external !== 'undefined'){
                                    message= data.message_external;
                                }

                                if(data.status == 200){
                                    notification.show({
                                        title: "Επιτυχής ενημέρωση Διάταξης Η/Υ",
                                        message: message
                                    }, "success");                                            

                                    //lab_workers_details.dataSource.read();

                                }else if(data.status == 500 || data.status_external == 500){

                                    notification.show({
                                        title: "Η ενημέρωση της Διάταξης Η/Υ απέτυχε",
                                        message: message
                                    }, "error");

                                }

                            },
                            error: function (data){ console.log("PUT labs (lab_general_info_details) error data: ", data);}
                    });
                }
            },
            template: kendo.template($("#general_info_template").html()),
            editTemplate: kendo.template($("#edit_general_info_template").html())
        }).data("kendoListView");

        var lab_rating_details = e.detailRow.find("#lab_rating_details").kendoListView({
            dataSource : new kendo.data.DataSource({
                data: [codeDetailData.toJSON()],
                schema : {
                    model: {
                        id: "lab_id",
                        fields:{
                            lab_id:{editable:false},
                            technological_rating:{},
                            operational_rating:{}
                        }
                    }
                }
            }),
            save: function(e) {
                if (this.editable.end()) {
                    data.splice(data.indexOf(codeDetailData), 1, e.model); //αντικατέστησε στο datasource του grid, το item το οποιο επεξεργάστηκες (e.model)
                                        
                    var parameters = {
                              lab_id: e.model.lab_id,
                              technological_rating: parseInt(e.model.technological_rating),
                              operational_rating: parseInt(e.model.operational_rating)
                            };
                    
                    $.ajax({
                            type: 'PUT',
                            url: baseURL + "labs?user=" + user_url,
                            dataType: "json",
                            data: JSON.stringify(parameters),
                            success: function(data){

                                //console.log("put rating response", data);

                                var message;
                                if (typeof data.message !== 'undefined'){
                                    message= data.message;
                                }else if (typeof data.message_internal !== 'undefined'){
                                    message= data.message_internal;
                                }else if (typeof data.message_external !== 'undefined'){
                                    message= data.message_external;
                                }

                                if(data.status == 200){
                                    notification.show({
                                        title: "Επιτυχής ενημέρωση Διάταξης Η/Υ",
                                        message: message
                                    }, "success");                                            

                                    //lab_workers_details.dataSource.read();

                                }else if(data.status == 500 || data.status_external == 500){

                                    notification.show({
                                        title: "Η ενημέρωση της Διάταξης Η/Υ απέτυχε",
                                        message: message
                                    }, "error");

                                }

                            },
                            error: function (data){ console.log("PUT labs (lab_rating_details) error data: ", data);}
                    });
                }
            },
            template: kendo.template($("#rating_template").html()),
            editTemplate: kendo.template($("#edit_rating_template").html())
        }).data("kendoListView");
        
        // edit_lab_details & edit_lab_workers authorization
        if(jQuery.inArray( authorized_user , edit_lab_details ) === -1){
            e.detailRow.find("#equipment_details>.k-grid-toolbar").hide();
            e.detailRow.find("#aquisition_sources_details>.k-grid-toolbar").hide();
            e.detailRow.find("#lab_relations_details>.k-grid-toolbar").hide();
        }
        
        //toggle lab workers logs
        lab_workers_details.element.find(".k-toolbar").on("click", "button#show_lab_worker_logs_btn", function(e){
            
            $.each(lab_workers_details.dataSource.data(), function(index, value){
                var tr= lab_workers_details.tbody.find("tr:eq(" + index + ")");
                var dataitem= lab_workers_details.dataItem(tr);
                if (dataitem.worker_status !== 1 && dataitem.worker_status !== ""){
                    tr.toggle();
                }
            });            
                        
            $(this).text(function(i, text){
                return (text === "προβολή ιστορικού") ? "απόκρυψη ιστορικού" : "προβολή ιστορικού";
            });
            
        });
         
    },
    dataBinding: function(e){
        //console.log("LabsViewVM: labs grid DATABINDING event: ", e);
        
        /* create "expandedRows" array as data attribute to labs view grid.
         * "expandedRows" will contain info for the currently expanded rows
         * in order to maintain their status (expanded, tabstrip index, scroll position)
         * after lab general info or rating update (inside dataBound event)
        */
        
        if(e.action !== "add" && LabsViewVM.get("refresh_btn") === false){ //αυτη η συνθήκη παίζει να πρέπει να εμπλουτιστεί γιατί ισως πετάει bugακια σε κάποια σενάρια
            
            var expandedRows = e.sender.element.data("kendoGrid").table.find("tr.k-master-row a.k-minus").closest("tr");

            //εδω θα μπεί μόνο αν υπάρχουν expanded rows
            e.sender.element.data('expandedRows', []);
            $.each(expandedRows, function(index,value){

                var detailRowTabstrip = $(this).next().find("div#lab_details_tabstrip").data("kendoTabStrip");
                var tabstrip_index = detailRowTabstrip.select().index();

                e.sender.element.data('expandedRows').push( {row_index: $(this).index(), tabstrip_index: tabstrip_index, scroll_position: $(document).scrollTop()} );
            });

            //εδω θα μπεί μόνο αν υπάρχουν expanded rows
            $.each(e.sender.element.data('expandedRows'), function(index,value){
                e.sender.element.data('expandedRows')[index]['row_index'] = e.sender.element.data('expandedRows')[index]['row_index'] - index;
                index++;
            });
        }else{
            //console.log("im inside dataBinding after i pressed refresh", LabsViewVM.get("refresh_btn"));
        }
        
    },
    dataBound: function(e){
        //console.log("LabsViewVM: labs grid DATABOUND event: ", e);
          
        if(LabsViewVM.get("refresh_btn") === false){
            var grid = e.sender.element.data("kendoGrid");
            //εδω θα μπεί μόνο αν υπάρχουν expanded rows
            $.each(e.sender.element.data('expandedRows'), function(index,value){
                // get current row and expand it
                var tr = grid.table.find("tr.k-master-row:eq("+ value['row_index'] + ")");//.closest("tr");
                grid.expandRow( tr );
                // preserving scroll position
                $(document).scrollTop(value['scroll_position']);
                // and selected tab
                var tabstrip = tr.next().find("div#lab_details_tabstrip").data("kendoTabStrip");
                tabstrip.select(value['tabstrip_index']);
            });
        }else{
            LabsViewVM.set("refresh_btn", false);
            //console.log("i set refresh_btn to false after refresh: ", LabsViewVM.get("refresh_btn"));
        }
    
        //disable transit buttons according to lab state
        var data_items = e.sender.dataSource.data();
        //console.log("data_items: ", data_items);
        $.each(data_items, function(index, value){
            var currentRow = $(e.sender.tbody).children("tr.k-master-row").eq(index);
            if(currentRow.hasClass("k-master-row")){
                //console.log("index: ", index);
                //console.log("currentRow: ", currentRow);
                var activateButton = $(currentRow).children('td:last').find(".k-grid-activate");
                var suspendButton = $(currentRow).children('td:last').find(".k-grid-suspend");
                var abolishButton = $(currentRow).children('td:last').find(".k-grid-abolish");

                //check whether databound gets triggered from school units view (get labs api function) or labs view (search labs api function)
                if(typeof data_items[index].lab_state_id !== 'undefined'){
                    var state = data_items[index].lab_state_id; //get labs api function
                }else{
                    var state = data_items[index].state_id; //search labs api function
                }

                if(state == "1"){
                    //console.log("state 1");
                    activateButton.addClass('k-state-disabled');
                    activateButton.click(function() { return false; });

                    suspendButton.removeClass('k-state-disabled');
                    //suspendButton.on('transitLab');

                    abolishButton.removeClass('k-state-disabled');
                    //abolishButton.on('transitLab');

                }else if(state == "2"){
                    //console.log("state 2");
                    activateButton.removeClass('k-state-disabled');
                    //activateButton.removeAttr('disabled');

                    suspendButton.addClass('k-state-disabled');
                    suspendButton.click(function() { return false; });

                    abolishButton.removeClass('k-state-disabled');
                    //abolishButton.removeAttr('disabled');         

                }else if(state == "3"){
                    //console.log("state 3");
                    activateButton.addClass('k-state-disabled');
                    activateButton.click(function() { return false; });

                    suspendButton.addClass('k-state-disabled');
                    suspendButton.click(function() { return false; });

                    abolishButton.addClass('k-state-disabled');
                    abolishButton.click(function() { return false; });
                }
            }

        });

    },
  
    
//    hideLabsGrid: function(e) {
//        //console.log("im inside hideLabsGrid", e);
//        this.set("isVisible", false);
//        SchoolUnitsViewVM.set("isVisible", true);
//    },
//    showLabsGrid: function(e) {
//        //console.log("im inside showLabsGrid", e);
//        this.set("isVisible", true);
//        SchoolUnitsViewVM.set("isVisible", false);
//    },
    openColumnSelection: function(e){
        var column_selection_dialog = $("#labs_column_selection_dialog").kendoWindow({
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 250,
                    pinned: true,
                    title: "Επιλογή Στηλών",
                    open: function(e){

                        e.sender.element.append('<div class="k-edit-buttons k-state-default" style="margin-top:10px; text-align:center">\
                                                    <button class="k-button k-button-icontext k-grid-transit" onclick="LabsViewVM.restoreDefaultColumns()">\
                                                        Επαναφορά Προεπιλεγμένων\
                                                    </button>\
                                                </div>');
                    }
        }).data("kendoWindow");

        var template = kendo.template($("#labs_column_selection_template").html());
        var toolbar = "";
        
        var grid;
        if(LabsViewVM.isVisible){
        //if($('#switch_to_labs_view_btn').is(':checked')){
            grid = $("#labs_view").data("kendoGrid");
        }else{
            grid = $("#school_unit_labs").data("kendoGrid");
        }

        $.each(grid.columns, function (idx, item) {
            toolbar += template({ idx: idx, item: item });
        });

        column_selection_dialog.content(toolbar);
        column_selection_dialog.center().open();
    },
    hideColumn: function(col) {

        var grid;
        if(LabsViewVM.isVisible){
        //if($('#switch_to_labs_view_btn').is(':checked')){
            grid = $("#labs_view").data("kendoGrid");
        }else{
            grid = $("#school_unit_labs").data("kendoGrid");
        }

        if (grid.columns[col].hidden) {
            grid.showColumn(+col);
        } else {
            grid.hideColumn(+col);
        }
    },
    restoreDefaultColumns: function() {
        
        var grid;
        if(LabsViewVM.isVisible){
        //if($('#switch_to_labs_view_btn').is(':checked')){
            grid = $("#labs_view").data("kendoGrid");
        }else{
            grid = $("#school_unit_labs").data("kendoGrid");
        }
        
        var columnSelectWnd = $("#labs_column_selection_dialog").data("kendoWindow");
        var show= [1,3,4,8]; //default columns
        
        if( jQuery.inArray( authorized_user , transit_lab ) !== -1 && jQuery.inArray(11 , show) === -1 ){
            show.push(11);
        }
        
        $.each(grid.columns, function(index, value){
            if(jQuery.inArray( index, show ) !== -1 ){
                grid.showColumn(+index);
                columnSelectWnd.element.find("div.column_selection>label>input#field-"+value.field).prop("checked", true);
            }else{
                grid.hideColumn(+index);
                columnSelectWnd.element.find("div.column_selection>label>input#field-"+value.field).prop("checked", false);
            }
        });
    },
    refresh: function(){
        var grid;
        if(LabsViewVM.isVisible){
        //if($('#switch_to_labs_view_btn').is(':checked')){
            grid = $("#labs_view").data("kendoGrid");
        }else{
            grid = $("#school_unit_labs").data("kendoGrid");
        }
        //grid.refresh();
        LabsViewVM.set("refresh_btn", true);
        grid.dataSource.read();
    },
    refreshTooltip: function(e){

        if(LabsViewVM.isVisible){
        //if($('#switch_to_labs_view_btn').is(':checked')){
            var tooltip = $(".lab_refresh_btn").kendoTooltip({
                autoHide: true,
                content:"ανανέωση",
                width:55,
                height:20,
                position: "top",
                animation: {
                    close: {effects: "fade:out",  duration: 500},
                    open: {effects: "fade:in",  duration: 500}
                }
            }).data("kendoTooltip");
            tooltip.show($(".lab_refresh_btn"));
        }else{
            var tooltip = $(".school_unit_labs_refresh_btn").kendoTooltip({
                autoHide: true,
                content:"ανανέωση",
                width:55,
                height:20,
                position: "top",
                animation: {
                    close: {effects: "fade:out",  duration: 500},
                    open: {effects: "fade:in",  duration: 500}
                }
            }).data("kendoTooltip");
            tooltip.show($(".school_unit_labs_refresh_btn"));
        }
    },
    columnsTooltip: function(e){
        if(LabsViewVM.isVisible){
        //if($('#switch_to_labs_view_btn').is(':checked')){
            var tooltip = $(".lab_grid_columns_btn").kendoTooltip({
                autoHide: true,
                content:"επιλογή στηλών",
                width:100,
                height:20,
                position: "top",
                animation: {
                    close: {effects: "fade:out",  duration: 500},
                    open: {effects: "fade:in",  duration: 500}
                }
            }).data("kendoTooltip");
            tooltip.show($(".lab_grid_columns_btn"));
        }else{
            var tooltip = $(".school_unit_labs_grid_columns_btn").kendoTooltip({
                autoHide: true,
                content:"επιλογή στηλών",
                width:100,
                height:20,
                position: "top",
                animation: {
                    close: {effects: "fade:out",  duration: 500},
                    open: {effects: "fade:in",  duration: 500}
                }
            }).data("kendoTooltip");
            tooltip.show($(".school_unit_labs_grid_columns_btn"));
            
        }
    },
    
    hideLabTransitColumn: function(e){
        var hide = (jQuery.inArray(authorized_user, transit_lab) !== - 1) ? false : true;
        return hide;
    }
});