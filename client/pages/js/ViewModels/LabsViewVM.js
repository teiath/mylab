var LabsViewVM = kendo.observable({

    isVisible: true,
    actionsColumnVisible: function(e){
            var hide = (jQuery.inArray(authorized_user, transit_lab) !== - 1) ? false : true;
            return hide;
    },

    labs: new kendo.data.DataSource({
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
                    
                    return data;
                    
                }else if(type === 'create'){
                                       
                    //normalize ellak parameter
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
            }else if (e.type=="create"){
                
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
    
//            console.log("labs datasource change e:", e);
            
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
    
    createLab:  function(e){
        console.log("labsview createLab: ", e);
        e.preventDefault(); //?
        
        //e.container.closest("div.k-window").css("width", "450px").center();
        
        if (e.model.isNew()) {
                       
            var createDialogTitle = e.container.prev().find(".k-window-title");
            var createDialogUpdateButton = e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-update");
            var createDialogCancelButton = e.container.find(".k-edit-form-container>.k-edit-buttons>.k-grid-cancel");
            var createDialogSchoolUnitComboBox = e.container.find("#cl_school_unit");
            var createDialogLabTypeComboBox = e.container.find("#cl_lab_type");
            //var createDialogTransitionDatePicker = e.container.find("#cl_transition_date");
            var createDialogEllakInput = e.container.find("#cl_ellak");


            createDialogTitle.text("Προσθήκη Νέας Διάταξης Η/Υ");
            createDialogUpdateButton.html('<span class="k-icon k-update"></span> Προσθήκη');
            createDialogCancelButton.html('<span class="k-icon k-cancel"></span> Ακύρωση');

            //createDialogTransitionDatePicker.data("kendoDatePicker").max(new Date());

            function changeEllak(e){
                //console.log("changeEllak e: ", e);
                var value = this.value();
                if (value==1 || value==3){ // σεπεηυ = 1, ετπ = 3
                    createDialogEllakInput.closest("div").show();
                }else{
                    createDialogEllakInput.removeAttr('checked');
                    createDialogEllakInput.closest("div").hide();
                }
            }  
            var lab_type = createDialogLabTypeComboBox.data("kendoComboBox");
            lab_type.bind("change", changeEllak);        

            /*
             * 1. Η παρακάτω συνθήκη παίζει να μην χρειάζεται και απλά το πεδίο της σχ. μονάδας να γίνεται hide
             * 2. Η παρακάτω συνθήκη ΔΕΝ χρησιμοποιείται πλέον, δεδομένου ότι το school units view δεν είναι διαθέσιμο 
             *    στους Διευθυντές/Τομεάρχες που έχουν το δικαίωμα να δημιουργούν νέες Διατάξεις Η/Υ 
             */
            if (e.sender.element.closest("tr").hasClass("k-detail-row")){ //έλεγξε αν βρισκόμαστε σε school units view, οπότε και το grid θα βρίσκεται σε detail row
                var tr = e.sender.element.closest("tr").prev();
                var grid = tr.closest("div#school_units_view").data("kendoGrid");
                var item = grid.dataItem(tr);
                var school_unit = item.school_unit_name; //item.school_unit_id;

                createDialogSchoolUnitComboBox.data("kendoComboBox").readonly(true);
                createDialogSchoolUnitComboBox.prev().find("input").prop('disabled', true);
                createDialogSchoolUnitComboBox.data("kendoComboBox").value(school_unit);
            }
            
        }
    },
    saveLab: function(e){
        //console.log("saveLab e: ", e);
        var createDialogUpdateButton = e.container.find("div.k-edit-form-container>div.k-edit-buttons>a.k-grid-update");
        createDialogUpdateButton.addClass('k-state-disabled').html('<i class="fa fa-spinner"></i> Παρακαλώ περιμένετε...');
        createDialogUpdateButton.click(function() { return false; });
    },
    transitLab: function(e){
        //console.log("transitLab e:", e);
        e.preventDefault();
        
        var parent_grid = $(e.delegateTarget).data("kendoGrid");
        var command = e.data.commandName;
        
        var transition_dialog = $("#transition_dialog").kendoWindow({
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 430,
                    pinned:true,
                    open: function(ev){
                        //console.log("open ev:", ev);
                        ev.sender.element.addClass("k-popup-edit-form"); //add kendo class to apply some css
                        
                        var toState = "";
                        var transitDialogUpdateButton = transition_dialog.element.find("div.k-edit-buttons>button.k-grid-transit");
                        var transitDialogCancelButton = transition_dialog.element.find("div.k-edit-buttons>button.k-grid-cancel-transition");
                        var transitDialogTransitDateLabel = transition_dialog.element.find("#tl>div.form-group>div>label#tl_transition_date_label");
                        var transitDialogTransitDatePicker = transition_dialog.element.find("#tl>div.form-group>div>input#tl_transition_date");
                        var transitDialogTransitJustificationLabel = transition_dialog.element.find("#tl>div.form-group>div>label#tl_transition_justification_label");
                        var transitDialogTransitJustificationInput = transition_dialog.element.find("#tl>div.form-group>div>textarea#tl_transition_justification");
                        
                        if(command === "activate"){
                            transition_dialog.title("Ενεργοποίηση Διάταξης Η/Υ");
                            transitDialogUpdateButton.html('<span class="k-icon k-update"></span> Ενεργοποίηση');
                            transitDialogTransitDateLabel.html('Ημερομηνία Ενεργοποίησης <span style="color:red">*</span>');
                            transitDialogTransitJustificationLabel.html('Αιτιολογία Ενεργοποίησης  <span style="color:red">*</span>');
                            toState = 1;
                        }else if(command === "suspend"){
                            transition_dialog.title("Αναστολή Διάταξης Η/Υ");
                            transitDialogUpdateButton.html('<span class="k-icon k-update"></span> Αναστολή');
                            transitDialogTransitDateLabel.html('Ημερομηνία Αναστολής <span style="color:red">*</span>');
                            transitDialogTransitJustificationLabel.html('Αιτιολογία Αναστολής <span style="color:red">*</span>');
                            toState = 2;
                        }else if(command === "abolish"){
                            transition_dialog.title("Κατάργηση Διάταξης Η/Υ");
                            transitDialogUpdateButton.html('<span class="k-icon k-update"></span> Κατάργηση');
                            transitDialogTransitDateLabel.html('Ημερομηνία Κατάργησης <span style="color:red">*</span>');
                            transitDialogTransitJustificationLabel.html('Αιτιολογία Κατάργησης <span style="color:red">*</span>');
                            toState = 3;
                        }                    
                        
                        transitDialogTransitDatePicker.kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now())
                        });
                
                        transitDialogCancelButton.on("click", function(e){
                            e.preventDefault(); //?
                            transition_dialog.close();
                        });
                        
                        transitDialogUpdateButton.on("click", function(e){
                            e.preventDefault(); //?

                            transitDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner"></i> Παρακαλώ περιμένετε...');

                            var parameters = {
                                      lab_id: dataItem.lab_id,
                                      transition_date: transitDialogTransitDatePicker.val(),
                                      transition_justification: transitDialogTransitJustificationInput.val(),
                                      transition_source: 'mylab',
                                      state: toState
                                    };

                            transitAjaxRequest('POST', 'lab_transitions', parameters, transition_dialog, parent_grid);
                            
                        });
                    }
        }).data("kendoWindow");
        
        var transitTemplate = kendo.template($("#lab_transit_template").html());
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        dataItem.set("toState", command);//! για να περάσω τον τύπο μετάβασης στο template 'lab_transit_template'
        transition_dialog.content(transitTemplate(dataItem));
        transition_dialog.center().open();
    },
    submitLab: function(e){
        //console.log("submitLab e:", e);
        e.preventDefault();
        
        var parent_grid = $(e.delegateTarget).data("kendoGrid");
        
        var submit_dialog = $("#submit_dialog").kendoWindow({
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 450,
                    title:"Οριστική Υποβολή Διάταξης Η/Υ",
                    pinned:true,
                    open: function(ev){
                        ev.sender.element.addClass("k-popup-edit-form"); //add kendo class to apply some css
                        
                        var submitDialogUpdateButton = submit_dialog.element.find("div.k-edit-buttons>button.k-grid-submit-lab");
                        var submitDialogCancelButton = submit_dialog.element.find("div.k-edit-buttons>button.k-grid-cancel-submit-lab");
                        var submitDialogTransitDatePicker = submit_dialog.element.find("#sl>div.form-group>div>input#sl_transition_date");                 
                        
                        submitDialogTransitDatePicker.kendoDatePicker({
                            format: "yyyy-MM-dd",
                            max: new Date(Date.now())
                        });
                        
                        submitDialogUpdateButton.on("click", function(e){
                            e.preventDefault();

                            submitDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner"></i> Παρακαλώ περιμένετε...');

                            var parameters = {
                                      lab_id: dataItem.lab_id,
                                      submitted: "true",
                                      transition_date: submitDialogTransitDatePicker.val(),
                                      transition_justification: "δημιουργία Διάταξης Η/Υ",
                                      transition_source: "mylab"
                                    };

                            $.ajax({
                                    type: "PUT",
                                    url: baseURL + "initial_labs" + "?user=" + user_url,
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

                                            submit_dialog.close();

                                            notification.show({
                                                title: "Επιτυχής Υποβολή Διάταξης Η/Υ",
                                                message: message
                                            }, "success");
                                            
                                            parent_grid.dataSource.read(); //school units view or labs view depending on the current view

                                        }else if(data.status == 500){

                                            submitDialogUpdateButton.removeClass('k-state-disabled').attr("disabled", false).html('<span class="k-icon k-update"></span> Οριστική Υποβολή');

                                            notification.show({
                                                title: "Η Υποβολή της Διάταξης Η/Υ απέτυχε",
                                                message: message
                                            }, "error");
                                        }

                                    }//,
                                    //error: function (data){ console.log("ΛΑΘΟΣ AJAX REQUEST: ", data);}
                            });
                        });
                        
                        submitDialogCancelButton.on("click", function(e){
                            e.preventDefault();
                            submit_dialog.close();
                        });
                    }
        }).data("kendoWindow");
        
        var submitTemplate = kendo.template($("#lab_submit_template").html());
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        submit_dialog.content(submitTemplate(dataItem));
        submit_dialog.center().open();
 
    },
    removeLab: function(e){
        //console.log("removeLab e:", e);
        e.preventDefault();
        
        var parent_grid = $(e.delegateTarget).data("kendoGrid");
        
        var remove_dialog = $("#remove_dialog").kendoWindow({
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 450,
                    title:"Διαγραφή Διάταξης Η/Υ",
                    pinned:true,
                    open: function(ev){
                        ev.sender.element.addClass("k-popup-edit-form"); //add kendo class to apply some css

                        var removeDialogUpdateButton = remove_dialog.element.find("div.k-edit-buttons>button.k-grid-remove-lab");
                        var removeDialogCancelButton = remove_dialog.element.find("div.k-edit-buttons>button.k-grid-cancel-remove-lab");                 
                        
                        removeDialogUpdateButton.on("click", function(e){
                            e.preventDefault();
                            
                            removeDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner"></i> Παρακαλώ περιμένετε...');

                            var parameters = {
                                      lab_id: dataItem.lab_id
                                    };

                            $.ajax({
                                    type: "DELETE",
                                    url: baseURL + "initial_labs" + "?user=" + user_url,
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

                                            remove_dialog.close();

                                            notification.show({
                                                title: "Επιτυχής Διαγραφή Διάταξης Η/Υ",
                                                message: message
                                            }, "success");                                            

                                            parent_grid.dataSource.read(); //school units view or labs view depending on the current view

                                        }else if(data.status == 500){

                                            removeDialogUpdateButton.removeClass('k-state-disabled').attr("disabled", false).html('<span class="k-icon k-update"></span> Διαγραφή');

                                            notification.show({
                                                title: "Η Διαγραφή της Διάταξης Η/Υ απέτυχε",
                                                message: message
                                            }, "error");
                                        }

                                    }//,
                                    //error: function (data){ console.log("ΛΑΘΟΣ AJAX REQUEST: ", data);}
                            });
                            
                        });
                        
                        removeDialogCancelButton.on("click", function(e){
                            e.preventDefault();
                            remove_dialog.close();
                        });
                    }
        }).data("kendoWindow");
        
        var removeTemplate = kendo.template($("#lab_remove_template").html());
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        remove_dialog.content(removeTemplate(dataItem));
        remove_dialog.center().open();
 
    },
    detailInit: function(e){
        //console.log("labsview detailInit", e);
        //console.log("e.detailRow: ", e.detailRow);
        //console.log("e.data: ", e.data);
        e.preventDefault();
        kendo.bind(e.detailRow, e.data); //SOS: without this line, detail template bindings will not work!!
        
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
            editable: { mode: "inline", confirmation: false},
            toolbar: function(){
                        if(jQuery.inArray( authorized_user , edit_lab_details ) !== -1 &&  e.data.lab_state_id !== 2 && e.data.lab_state_id !== 3){
                            return [{ name: "create", text: "Προσθήκη Εξοπλισμού" }];
                        }
                     }(),
            columns: [
                { field: "equipment_type_name", 
                  title: "Τύπος Εξοπλισμού",
                  editor: function (container, options){
                      
                        var data = equipment_details.dataSource.data();
                        var usedEquipment = [];
                        //exclude already used equipment
                        $.each(data, function(index, value){
                            if (data[index].equipment_type_name !== ""){
                                usedEquipment.push(data[index].equipment_type_name);
                            }
                        });
                        
                        //console.log("equipment_details options.field: ", options.field);
                        //options.field = "equipment_type"
                        $('<input id="equipment_type_column_editor" name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="name" data-value-field="name" required data-required-msg="Ξέχασες τον τύπο εξοπλισμού!" />')
                        .appendTo(container)
                        .kendoComboBox({
                            dataSource: newEquipmentTypesDS(usedEquipment),
                            placeholder: "επιλέξτε από τη λίστα"
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);                        
                        
                  },
                  width: '50%' 
                },
                { field: "items", 
                  title:"Πλήθος", 
                  format: "{0:n0}",
                  width: '20%' 
                },
                { command: [{ name: 'edit', 
                              text: "Επεξεργασία"
                            }, 
                            { name: 'delete-details', 
                              text: "Διαγραφή",
                              imageClass: 'k-icon k-delete',
                              click: function(e) {
                                    e.preventDefault();                                    
                                    
                                    var delete_lab_equipment_dialog = $("#delete_lab_details_dialog").kendoWindow({
                                                modal: true,
                                                visible: false,
                                                resizable: false,
                                                width: 370,
                                                pinned:true,
                                                //title:"Διαγραφή Εξοπλισμού Διάταξης Η/Υ",
                                                open: function(ev){
                                                    ev.sender.element.addClass("k-popup-edit-form"); //add kendo class to apply some css
                                                    
                                                    var deleteLabEquipmentDialogTitle = delete_lab_equipment_dialog.wrapper.find("div.k-window-titlebar>span").text("Διαγραφή Εξοπλισμού Διάταξης Η/Υ");
                                                    var deleteLabEquipmentDialogUpdateButton = delete_lab_equipment_dialog.element.find("div.k-edit-buttons>a.k-grid-delete");
                                                    var deleteLabEquipmentDialogCancelButton = delete_lab_equipment_dialog.element.find("div.k-edit-buttons>a.k-grid-cancel");

                                                    deleteLabEquipmentDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        delete_lab_equipment_dialog.close();
                                                    });

                                                    deleteLabEquipmentDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        deleteLabEquipmentDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner"></i> Παρακαλώ περιμένετε...');
                                                        equipment_details.removeRow(row);
                                                        delete_lab_equipment_dialog.close();

                                                    });
                                                }
                                    }).data("kendoWindow");

                                    var row = $(e.currentTarget).closest("tr");
                                    var deleteTemplate = kendo.template($("#delete_lab_details_template").html());
                                    var dataItem = this.dataItem(row);
                                    delete_lab_equipment_dialog.content(deleteTemplate(dataItem));
                                    delete_lab_equipment_dialog.center().open();                                    
                                }
                            }], 
                  title: 'Ενέργειες', 
                  width: '30%', 
                  hidden: function(){
                      var hide = (jQuery.inArray( authorized_user , edit_lab_details ) !== -1 &&  e.data.lab_state_id !== 2 && e.data.lab_state_id !== 3) ? false : true;
                      return hide;
                  }()
                }
            ],
            edit: function(e){
                
                //localization
                e.container.find("td:eq(2)>a.k-grid-update").html('<span class="k-icon k-update"></span>Ενημέρωση');
                e.container.find("td:eq(2)>a.k-grid-cancel").html('<span class="k-icon k-cancel"></span>Ακύρωση');
                
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
            editable: { mode: "inline", confirmation: false},
            toolbar: function(){
                        if(jQuery.inArray( authorized_user , edit_lab_details ) !== -1 && e.data.lab_state_id !== 2 && e.data.lab_state_id !== 3){
                            return [{ name: "create", text: "Προσθήκη Πηγής Χρηματοδότησης" }];
                        }
                    }(),
            columns: [
                { field: "aquisition_source", 
                  title: "Πηγή Χρηματοδότησης",
                  editor: function (container, options){
                      
                        //options.field = aquisition_source
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="name" data-value-field="name" required data-required-msg="Ξέχασες την πηγή χρηματοδότησης!"/>')
                        .appendTo(container)
                        .kendoComboBox({
                            dataSource: newAquisitionSourcesDS(),
                            placeholder: "επιλέξτε από τη λίστα"
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);
                  }, 
                  width: '20%' 
                },
                { field: "aquisition_year",
                  title:"Έτος",
                  editor: function (container, options){
              
                        //options.field =  aquisition_year
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" required data-required-msg="Ξέχασες το έτος χρηματοδότησης!"/>')
                        .appendTo(container)
                        .kendoComboBox({                    
                            dataTextField: "year",
                            dataValueField: "year",
                            dataSource: newAquisitionYearsDS(1975),
                            placeholder: "επιλέξτε από τη λίστα"
                        });    
                                                
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);    
                  }, 
                  width: '20%' 
                },
                { field: "aquisition_comments", 
                  title: "Σχόλια",
                  editor: function (container, options){
                      $('<textarea class="k-textbox" data-bind="value: ' + options.field + '"></textarea>').appendTo(container);
                  }, 
                  width: '30%' 
                },
                { command: [{ name: 'edit', 
                              text: "Επεξεργασία"
                            },
                            { name: 'delete-details', 
                              text: "Διαγραφή",
                              imageClass: 'k-icon k-delete',
                              click: function(e) {
                                    e.preventDefault();                                    
                                                                        
                                    var delete_lab_aquisition_source_dialog = $("#delete_lab_details_dialog").kendoWindow({
                                                modal: true,
                                                visible: false,
                                                resizable: false,
                                                width: 370,
                                                pinned:true,
                                                //title:"Διαγραφή Πηγής Χρηματοδότησης Διάταξης Η/Υ",
                                                open: function(ev){
                                                    ev.sender.element.addClass("k-popup-edit-form"); //add kendo class to apply some css
                                                    
                                                    var deleteLabAquisitionSourceDialogTitle = delete_lab_aquisition_source_dialog.wrapper.find("div.k-window-titlebar>span").text("Διαγραφή Πηγής Χρηματοδότησης Διάταξης Η/Υ");
                                                    var deleteLabAquisitionSourceDialogUpdateButton = delete_lab_aquisition_source_dialog.element.find("div.k-edit-buttons>a.k-grid-delete");
                                                    var deleteLabAquisitionSourceDialogCancelButton = delete_lab_aquisition_source_dialog.element.find("div.k-edit-buttons>a.k-grid-cancel");

                                                    deleteLabAquisitionSourceDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        delete_lab_aquisition_source_dialog.close();
                                                    });

                                                    deleteLabAquisitionSourceDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        deleteLabAquisitionSourceDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner"></i> Παρακαλώ περιμένετε...');
                                                        aquisition_sources_details.removeRow(row);
                                                        delete_lab_aquisition_source_dialog.close();

                                                    });
                                                }
                                    }).data("kendoWindow");

                                    var row = $(e.currentTarget).closest("tr");
                                    var deleteTemplate = kendo.template($("#delete_lab_details_template").html());
                                    var dataItem = this.dataItem(row);
                                    delete_lab_aquisition_source_dialog.content(deleteTemplate(dataItem));
                                    delete_lab_aquisition_source_dialog.center().open();                                    
                                }
                            }], 
                  title: 'Ενέργειες', 
                  width: '30%', 
                  hidden: function(){
                      var hide = (jQuery.inArray( authorized_user , edit_lab_details ) !== -1 &&  e.data.lab_state_id !== 2 && e.data.lab_state_id !== 3) ? false : true;
                      return hide;
                  }()
                }
            ],
            edit: function(e){
                
                //localization
                e.container.find("td:eq(3)>a.k-grid-update").html('<span class="k-icon k-update"></span>Ενημέρωση');
                e.container.find("td:eq(3)>a.k-grid-cancel").html('<span class="k-icon k-cancel"></span>Ακύρωση');
                
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
                  title: "Ονοματεπώνυμο",
                  template: "#= lastname + ' ' + firstname #",
                  editor: function (container, options){
                        //options.field = fullname
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="fullname" data-value-field="worker_id" required data-required-msg="Ξέχασες τον υπεύθυνο!" />')
                        .appendTo(container)
                        .kendoComboBox({
                            dataSource: newWorkersDS(),
                            autoBind: false,
                            filter: "contains",
                            placeholder: "επιλέξτε από τη λίστα",
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
                  width: '36%'
                },
                { field: "worker_registry_no", 
                  title: "ΑΜ", 
                  width: '9%' 
                },
                { field: "specialization_code_name", 
                  title: "Κλάδος", 
                  width: '6%' 
                },
                {
                  field: "worker_start_service", 
                  title: "Ημ/νια Ανάληψης Ευθύνης",
                  editor: function (container, options){
                        //options.field: The name of the field to which the column is bound. Here, worker_start_service
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '"  required data-required-msg="Ξέχασες την ημερομηνία!" />')
                        .appendTo(container)
                        .kendoDatePicker({
                            max: new Date(),
                            format: "yyyy-MM-dd"
                        });
                        
                        var tooltipElement = $('<span class="k-invalid-msg" data-for="' + options.field + '"></span>');
                        tooltipElement.appendTo(container);                        
                        
                  }, 
                  width: '17%' 
                },
                {
                  field: "worker_status",
                  template: function(dataItem) {
                      if(dataItem.worker_status == 1) return "ΕΝΕΡΓΟΣ"; else if (dataItem.worker_status == 3) return "ΑΝΕΝΕΡΓΟΣ";
                  },
                  title: "Κατάσταση", 
                  width: '8%' 
                },
                { command: [ { name: 'edit'},
                             { text: " Απενεργοποίηση",
                               name: "disable-lab-worker",
                               imageClass: 'fa fa-chain-broken',
                               click: function(e) {
                                    e.preventDefault();                                    

                                    var disable_lab_worker_dialog = $("#disable_lab_worker_dialog").kendoWindow({
                                                modal: true,
                                                visible: false,
                                                resizable: false,
                                                width: 400,
                                                pinned:true,
                                                title:"Απενεργοποίηση Υπεύθυνου Διάταξης Η/Υ",
                                                open: function(ev){
                                                    ev.sender.element.addClass("k-popup-edit-form"); //add kendo class to apply some css
                                                    
                                                    var disableLabWorkerDialogUpdateButton = disable_lab_worker_dialog.element.find("div.k-edit-buttons>a.k-grid-disable");
                                                    var disableLabWorkerDialogCancelButton = disable_lab_worker_dialog.element.find("div.k-edit-buttons>a.k-grid-cancel-disabling");

                                                    disableLabWorkerDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        disable_lab_worker_dialog.close();
                                                    });

                                                    disableLabWorkerDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        disableLabWorkerDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner"></i> Παρακαλώ περιμένετε...');

                                                        var parameters = {
                                                          lab_worker_id: dataItem.lab_worker_id,
                                                          worker_status: 3
                                                        };
                                                        
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

                                                                        disable_lab_worker_dialog.close();
                                                                        lab_workers_details.dataSource.read();

                                                                    }else if(data.status == 500){

                                                                        disableLabWorkerDialogUpdateButton.removeClass('k-state-disabled').attr("disabled", false).html('<span class="k-icon k-update"></span> Απενεργοποίηση');

                                                                        notification.show({
                                                                            title: "Η απενεργοποίηση απέτυχε",
                                                                            message: message
                                                                        }, "error");                        

                                                                        disable_lab_worker_dialog.close();
                                                                    }

                                                                }//,
                                                                //error: function (data){ console.log("PUT error data: ", data);}
                                                        });

                                                    });
                                                }
                                    }).data("kendoWindow");

                                    var disableTemplate = kendo.template($("#disable_lab_worker_template").html());
                                    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                                    disable_lab_worker_dialog.content(disableTemplate(dataItem));
                                    disable_lab_worker_dialog.center().open();                                    
                                }
                             }, 
                             {  text: "Διαγραφή",
                                name: "remove-lab-worker",
                                imageClass: 'k-icon k-delete',
                                click: function(e) {
                                    e.preventDefault();

                                    var remove_lab_worker_dialog = $("#remove_lab_worker_dialog").kendoWindow({
                                                modal: true,
                                                visible: false,
                                                resizable: false,
                                                width: 400,
                                                pinned:true,
                                                title:"Διαγραφή Υπεύθυνου Διάταξης Η/Υ",
                                                open: function(ev){
                                                    ev.sender.element.addClass("k-popup-edit-form"); //add kendo class to apply some css
                                                    
                                                    var removeLabWorkerDialogUpdateButton = remove_lab_worker_dialog.element.find("div.k-edit-buttons>a.k-grid-remove");
                                                    var removeLabWorkerDialogCancelButton = remove_lab_worker_dialog.element.find("div.k-edit-buttons>a.k-grid-cancel-remove");

                                                    removeLabWorkerDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        remove_lab_worker_dialog.close();
                                                    });

                                                    removeLabWorkerDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        removeLabWorkerDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner"></i> Παρακαλώ περιμένετε...');

                                                        var parameters = {
                                                            lab_id: dataItem.lab_id,
                                                            lab_worker_id: dataItem.lab_worker_id
                                                        };

                                                        $.ajax({
                                                                type: 'DELETE',
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
                                                                            title: "Η διαγραφή πραγματοποιήθηκε",
                                                                            message: message
                                                                        }, "success");                                            

                                                                        remove_lab_worker_dialog.close();
                                                                        lab_workers_details.dataSource.read();

                                                                    }else if(data.status == 500){

                                                                        removeLabWorkerDialogUpdateButton.removeClass('k-state-disabled').attr("disabled", false).html('<span class="k-icon k-update"></span> Διαγραφή');

                                                                        notification.show({
                                                                            title: "Η διαγραφή απέτυχε",
                                                                            message: message
                                                                        }, "error");
                                                                        
                                                                        remove_lab_worker_dialog.close();
                                                                    }

                                                                }//,
                                                                //error: function (data){ console.log("DEL lab_workers error data: ", data);}
                                                        });

                                                    });
                                                }
                                    }).data("kendoWindow");

                                    var removeTemplate = kendo.template($("#remove_lab_worker_template").html());
                                    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                                    remove_lab_worker_dialog.content(removeTemplate(dataItem));
                                    remove_lab_worker_dialog.center().open();                                    
                                }
                             }
                           ],
                  title: 'Ενέργειες', 
                  width: '22%',
                  hidden: function(){
                      var hide = (jQuery.inArray( authorized_user , edit_lab_worker ) !== -1 && e.data.lab_state_id === 1) ? false : true;
                      return hide;
                  }()
                }
            ],
            edit: function(e){
                
                //localization
                e.container.find("td:eq(5)>a.k-grid-update").html('<span class="k-icon k-update"></span>Ενημέρωση');
                e.container.find("td:eq(5)>a.k-grid-cancel").html('<span class="k-icon k-cancel"></span>Ακύρωση');
                
                //on create+update, make lab_worker not editable
                e.container.find("td:eq(1)").text(e.model.worker_registry_no); //registry_no
                e.container.find("td:eq(2)").text(e.model.specialization_code_name); //specialization_code
                e.container.find("td:eq(4)").text("ΕΝΕΡΓΟΣ");
            },
            dataBound: function(e){
                //console.log("lab workers databound: ", e);
                
                /*if there is some active Lab Responsible DO NOT SHOW the 'create responisble' button*/
                var someActive = false;
                $.each(e.sender.dataSource.data(), function(index, value){
                    var tr= e.sender.tbody.find("tr:eq(" + index + ")");
                    var dataitem= e.sender.dataItem(tr);
                    
                    if(dataitem.worker_status === 1){
                        someActive = true;
                        return false; //exit 'each' loop
                    }
                });
                (someActive) ? e.sender.element.find(".k-toolbar>a.k-button").hide() : e.sender.element.find(".k-toolbar>a.k-button").show();
                
                /*if worker is not active 
                    1) remove its row's "disable+delete" functionalities and 
                    2) hide its row from grid if grid is not in the "show logs" mode
                */
                $.each(e.sender.dataSource.data(), function(index, value){
                    var tr= e.sender.tbody.find("tr:eq(" + index + ")");
                    var dataitem= e.sender.dataItem(tr);
                    if (dataitem.worker_status !== 1 && dataitem.worker_status !== ""){
                        tr.find("td:last-child>a.k-grid-disable-lab-worker").remove(); 
                        tr.find("td:last-child>a.k-grid-remove-lab-worker").remove(); 
                        if(lab_workers_details.element.find(".k-toolbar>button#show_lab_worker_logs_btn").html() === '<span class="fa fa-history"></span> Προβολή Ιστορικού'){
                            tr.hide();
                        }
                    }
                });
            }
        }).data("kendoGrid");
        //toggle lab workers logs
        lab_workers_details.element.find(".k-toolbar").on("click", "button#show_lab_worker_logs_btn", function(e){
            
            $.each(lab_workers_details.dataSource.data(), function(index, value){
                var tr= lab_workers_details.tbody.find("tr:eq(" + index + ")");
                var dataitem= lab_workers_details.dataItem(tr);
                if (dataitem.worker_status !== 1 && dataitem.worker_status !== ""){
                    tr.toggle();
                }
            });            
                        
            $(this).html(function(i, html){
                return (html === '<span class="fa fa-history"></span> Προβολή Ιστορικού') ? '<span class="fa fa-history"></span> Απόκρυψη Ιστορικού' : '<span class="fa fa-history"></span> Προβολή Ιστορικού';
            });
            
        });

        var lab_relations_details = e.detailRow.find("#lab_relations_details").kendoGrid({
            //dataSource: e.data.lab_relations,
            dataSource: newLabRelationsDS(e.data.lab_id, e.detailRow),
            scrollable: false,
            selectable: false,
            editable: { mode: "inline", confirmation: false},
            toolbar: function(){
                        if(jQuery.inArray( authorized_user , edit_lab_details ) !== -1 && e.data.lab_state_id !== 2 && e.data.lab_state_id !== 3){
                            return [{ name: "create", text: "Προσθήκη Συσχέτισης" }];
                        }
                    }(),
            columns: [
                { field: "relation_type_name",
                  title: "Τύπος Συσχέτισης",
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
                  title:"Σχολική Μονάδα",
                  editor: function (container, options){
                        
                        //console.log("options.field", options.field);
                        $('<input id="school_unit_parent" name="' + options.field + '" data-bind="value:' + options.field + '" data-text-field="name" data-value-field="school_unit_id" required data-required-msg="Ξέχασες τη σχολική μονάδα!" />')
                        .appendTo(container)
                        .kendoComboBox({
                            autoBind: false,
                            dataSource: newSchoolUnitsDS(), //εδω μπορεί να μπεί και παράμετρος edu_admin
                            filter: "contains",
                            placeholder: "επιλέξτε από τη λίστα",
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
                  title: "Αριθμός Κυκλώματος",
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
                { command: [{ name: 'edit', 
                              text: "Επεξεργασία"
                            }, 
                            { name: 'delete-details', 
                              text: "Διαγραφή",
                              imageClass: 'k-icon k-delete',
                              click: function(e) {
                                    e.preventDefault();                                    
                                                                       
                                    var delete_lab_transition_dialog = $("#delete_lab_details_dialog").kendoWindow({
                                                modal: true,
                                                visible: false,
                                                resizable: false,
                                                width: 370,
                                                pinned:true,
                                                //title:"Διαγραφή Συσχέτισης Διάταξης Η/Υ",
                                                open: function(ev){
                                                    ev.sender.element.addClass("k-popup-edit-form"); //add kendo class to apply some css
                                                    
                                                    var deleteLabRelationDialogTitle = delete_lab_transition_dialog.wrapper.find("div.k-window-titlebar>span").text("Διαγραφή Συσχέτισης Διάταξης Η/Υ");
                                                    var deleteLabRelationDialogUpdateButton = delete_lab_transition_dialog.element.find("div.k-edit-buttons>a.k-grid-delete");
                                                    var deleteLabRelationDialogCancelButton = delete_lab_transition_dialog.element.find("div.k-edit-buttons>a.k-grid-cancel");

                                                    deleteLabRelationDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        delete_lab_transition_dialog.close();
                                                    });

                                                    deleteLabRelationDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        deleteLabRelationDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner"></i> Παρακαλώ περιμένετε...');
                                                        lab_relations_details.removeRow(row);
                                                        delete_lab_transition_dialog.close();

                                                    });
                                                }
                                    }).data("kendoWindow");

                                    var row = $(e.currentTarget).closest("tr");
                                    var deleteTemplate = kendo.template($("#delete_lab_details_template").html());
                                    var dataItem = this.dataItem(row);
                                    delete_lab_transition_dialog.content(deleteTemplate(dataItem));
                                    delete_lab_transition_dialog.center().open();                                    
                                }
                            }], 
                  title: 'Ενέργειες', 
                  width: '20%', 
                  hidden: function(){
                      var hide = (jQuery.inArray( authorized_user , edit_lab_details ) !== -1 &&  e.data.lab_state_id !== 2 && e.data.lab_state_id !== 3) ? false : true;
                      return hide;
                  }()
                }
            ],
            edit: function(e){
                
                //localization
                e.container.find("td:eq(3)>a.k-grid-update").html('<span class="k-icon k-update"></span>Ενημέρωση');
                e.container.find("td:eq(3)>a.k-grid-cancel").html('<span class="k-icon k-cancel"></span>Ακύρωση');

            }         
        }).data("kendoGrid");
        
        var lab_transitions_details = e.detailRow.find("#lab_transitions_details").kendoGrid({
            dataSource: newLabTransitionsDS(e.data.lab_id, e.detailRow), //e.data.lab_transitions,
            scrollable: false,
            selectable: false,
            columns: [
                { field: "from_state_name", title: "Προηγούμενη Κατάσταση"},
                { field: "to_state_name", title:"Παρούσα Κατάσταση"},
                { field: "transition_date", title: "Ημερομηνία Μετάβασης"},
                { field: "transition_justification", title: "Αιτιολογία Μετάβασης"},
                { field: "transition_source", title: "Πηγή Μετάβασης"}
            ]           
        }).data("kendoGrid");
                
        var lab_general_info_details = e.detailRow.find("#lab_general_info_details").kendoListView({
            dataSource : new kendo.data.DataSource({
                data: [e.data.toJSON()],
                schema : {
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
            edit: function(event){
                if(event.model.ellak === "1"){
                    event.item.find("input:checkbox[id='isEllak']").prop("checked", "checked");
                }
            },
            save: function(event) {
                if (this.editable.end()) { //? δεν ειμαι σίγουρη οτι χρειάζεται αυτό...
                    //data.splice(data.indexOf(codeDetailData), 1, event.model); //αντικατέστησε στο datasource του grid, το item το οποιο επεξεργάστηκες (e.model)                 
                    
                    var parameters = {
                              lab_id: event.model.lab_id,
                              special_name: event.model.lab_special_name,
                              positioning: event.model.positioning
                            };
                    
                    if (e.detailRow.find("#lab_general_info_details input:checkbox[id='isEllak']").prop( "checked" )){
                        parameters.ellak = "true";
                    }else{
                        parameters.ellak = "false";
                    }
                    
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

                                }else if(data.status == 500 || data.status_external == 500){

                                    notification.show({
                                        title: "Η ενημέρωση της Διάταξης Η/Υ απέτυχε",
                                        message: message
                                    }, "error");

                                }

                            }//,
                            //error: function (data){ console.log("PUT labs (lab_general_info_details) error data: ", data);}
                    });
                }
            },
            template: kendo.template($("#general_info_template").html()),
            editTemplate: kendo.template($("#edit_general_info_template").html())
        }).data("kendoListView");

        var lab_rating_details = e.detailRow.find("#lab_rating_details").kendoListView({
            dataSource : new kendo.data.DataSource({
                data: [e.data.toJSON()],
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
                    //data.splice(data.indexOf(codeDetailData), 1, e.model); //αντικατέστησε στο datasource του grid, το item το οποιο επεξεργάστηκες (e.model)
                                        
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
                
    },
    dataBinding: function(e){
        console.log("LabsViewVM: labs grid DATABINDING event: ", e);
        
//        if(e.action === "add"){
//            setTimeout(function() {
//                var currentRow = $(e.sender.tbody).children("tr.k-master-row").eq("0");
//                var activateButton = currentRow.children('td:last').find(".k-grid-activate");
//                var suspendButton = currentRow.children('td:last').find(".k-grid-suspend");
//                var abolishButton = currentRow.children('td:last').find(".k-grid-abolish");
//                activateButton.hide();
//                suspendButton.hide();
//                abolishButton.hide();
//            }, 100);
//        }

    },
    dataBound: function(e){
        console.log("LabsViewVM: labs grid DATABOUND event: ", e);
    
        // show/hide action buttons according to lab state
        var data_items = e.sender.dataSource.data();
        $.each(data_items, function(index, value){
            var currentRow = $(e.sender.tbody).children("tr.k-master-row").eq(index);
            if(currentRow.hasClass("k-master-row")){
                var activateButton = $(currentRow).children('td:last').find(".k-grid-activate");
                var suspendButton = $(currentRow).children('td:last').find(".k-grid-suspend");
                var abolishButton = $(currentRow).children('td:last').find(".k-grid-abolish");
                var submitButton = $(currentRow).children('td:last').find(".k-grid-submit");
                var removeButton = $(currentRow).children('td:last').find(".k-grid-remove");

                if(typeof data_items[index].lab_state_id !== 'undefined'){
                    var state = data_items[index].lab_state_id;
                }

                if(value.submitted === "1"){
                    
//                    submitButton.hide();
//                    removeButton.hide();
                        
                    submitButton.addClass('k-state-disabled');
                    submitButton.hide();
                    submitButton.click(function() { return false; });

                    removeButton.addClass('k-state-disabled');
                    removeButton.hide();
                    removeButton.click(function() { return false; });

                    if(state === 1){
                        //console.log("state 1");
                        activateButton.addClass('k-state-disabled');
                        activateButton.hide();
                        activateButton.click(function() { return false; });

                        suspendButton.removeClass('k-state-disabled');
                        suspendButton.show();

                        abolishButton.removeClass('k-state-disabled');
                        abolishButton.show();

                    }else if(state === 2){
                        //console.log("state 2");
                        activateButton.removeClass('k-state-disabled');
                        activateButton.show();

                        suspendButton.addClass('k-state-disabled');
                        suspendButton.hide();
                        suspendButton.click(function() { return false; });

                        abolishButton.removeClass('k-state-disabled');
                        abolishButton.show();         

                    }else if(state === 3){
                        //console.log("state 3");
                        activateButton.addClass('k-state-disabled');
                        activateButton.hide();
                        activateButton.click(function() { return false; });

                        suspendButton.addClass('k-state-disabled');
                        suspendButton.hide();
                        suspendButton.click(function() { return false; });

                        abolishButton.addClass('k-state-disabled');
                        abolishButton.hide();
                        abolishButton.click(function() { return false; });
                    }
                
                }else if(value.submitted === "0"){
                    
//                        activateButton.hide();
//                        suspendButton.hide();
//                        abolishButton.hide();

                        activateButton.addClass('k-state-disabled');
                        activateButton.hide();
                        activateButton.click(function() { return false; });

                        suspendButton.addClass('k-state-disabled');
                        suspendButton.hide();
                        suspendButton.click(function() { return false; });

                        abolishButton.addClass('k-state-disabled');
                        abolishButton.hide();
                        abolishButton.click(function() { return false; });
                }
            }
        });
    },
    
    
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
                                                    <button class="k-button k-button-icontext" onclick="LabsViewVM.restoreDefaultColumns()">\
                                                        <i class="fa fa-undo"></i> Επαναφορά Προεπιλεγμένων\
                                                    </button>\
                                                </div>');
                    }
        }).data("kendoWindow");
        var template = kendo.template($("#labs_column_selection_template").html());
        var content = "";
        //var grid = (LabsViewVM.isVisible) ? $("#labs_view").data("kendoGrid") : $("#school_unit_labs").data("kendoGrid");
        var grid = $(e.target).closest(".k-grid").data("kendoGrid");

        $.each(grid.columns, function (idx, item) {
            content += template({ idx: idx, item: item });
        });

        column_selection_dialog.content(content);
        column_selection_dialog.center().open();
        
    },
    refresh: function(e){
        //var grid = (LabsViewVM.isVisible) ? $("#labs_view").data("kendoGrid") : $("#school_unit_labs").data("kendoGrid");
        var grid = $(e.target).closest(".k-grid").data("kendoGrid");
        grid.dataSource.read();
    },
    toggleColumn: function(col) {

        var grid = (LabsViewVM.isVisible) ? $("#labs_view").data("kendoGrid") : $("#school_unit_labs").data("kendoGrid");

        if (grid.columns[col].hidden) {
            grid.showColumn(+col);
        } else {
            grid.hideColumn(+col);
        }
        
    },
    restoreDefaultColumns: function() {

        var grid = (LabsViewVM.isVisible) ? $("#labs_view").data("kendoGrid") : $("#school_unit_labs").data("kendoGrid");        
        var columnSelectWnd = $("#labs_column_selection_dialog").data("kendoWindow");
        var show= [1,3,4,8]; //default columns
        
        if( jQuery.inArray( authorized_user , transit_lab ) !== -1 && jQuery.inArray(11 , show) === -1 ){
            show.push(10);
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
            
            
    refreshTooltip: function(e){
//        if(LabsViewVM.isVisible){
        var tooltip = $(e.target).kendoTooltip({
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
        tooltip.show($(e.target));
//        }else{
//            var tooltip = $(".school_unit_labs_refresh_btn").kendoTooltip({
//                autoHide: true,
//                content:"ανανέωση",
//                width:55,
//                height:20,
//                position: "top",
//                animation: {
//                    close: {effects: "fade:out",  duration: 500},
//                    open: {effects: "fade:in",  duration: 500}
//                }
//            }).data("kendoTooltip");
//            tooltip.show($(".school_unit_labs_refresh_btn"));
//        }
    },
    columnsTooltip: function(e){
//        if(LabsViewVM.isVisible){
            var tooltip = $(e.target).kendoTooltip({
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
            tooltip.show($(e.target));
//        }else{
//            var tooltip = $(".school_unit_labs_grid_columns_btn").kendoTooltip({
//                autoHide: true,
//                content:"επιλογή στηλών",
//                width:100,
//                height:20,
//                position: "top",
//                animation: {
//                    close: {effects: "fade:out",  duration: 500},
//                    open: {effects: "fade:in",  duration: 500}
//                }
//            }).data("kendoTooltip");
//            tooltip.show($(".school_unit_labs_grid_columns_btn"));
//            
//        }
    },
    
});