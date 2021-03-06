var LabsViewVM = kendo.observable({

    isVisible: false,
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
            update: {
                /* δεν μπορεί να χρησιμοποιηθεί απο την submitLab, transitLab 
                 * διότι η saveRow (αντίστοιχη της removeRow στην removeLab) 
                 * χρησιμοποιείται αποκλειστικα σε συνδυασμό με την editRow
                 * 
                 * url: "api/initial_labs?user=" + user_url,
                 * type: "PUT",
                 * dataType: "json"
                 */
            },
            destroy: {
                url: "api/initial_labs?user=" + user_url,
                type: "DELETE",
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
                    // for  multiple partial string search in school_unit_name, school_unit_special_name, lab_name, lab_special_name inputs
                    data['searchtype'] = "containall";
                    delete data.pageSize;
                    return data;
                    
                }else if(type === 'create'){
                                       
                    data["ellak"] = (data["ellak"])? true : false;
                    data["lab_source"] = "1";                    
                    //υποβάλλονται κενά, λόγω του ότι βρίσκονται στο schema, παρότι στη δημιουργία εργαστηρίου δεν εισάγονται
                    delete data.operational_rating;
                    delete data.technological_rating;
                    //return JSON.stringify(data);
                    return data;
                    
                }else if(type === 'destroy'){
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
            }
        },
        pageSize: 20, /* κάθε φορά που ο χρήστης επιλέγει άλλο pagesize από το Grid, γίνεται request στον server με παράμετρο την 1η σελίδα (page=1) και το επιλεχθέν pagesize*/
        serverPaging: true, /* κάθε φορά που ο χρήστης επιλέγει άλλη σελίδα, γίνεται request στον server με παράμετρο τη συγκεκριμένη σελίδα (page) και το pagesize*/
        serverFiltering: true,
        serverSorting: true,
        requestEnd: function(e) {
                       
            //console.log("labs datasource requestEnd e:", e);
            if (e.type=="read"){
                if(typeof e.response.all_labs_by_type !== 'undefined'){
                    LabsViewVM.set("sepehy",  e.response.all_labs_by_type['ΣΕΠΕΗΥ']);
                    LabsViewVM.set("etp",  e.response.all_labs_by_type['ΕΤΠ']);
                    LabsViewVM.set("gwnia",  e.response.all_labs_by_type['ΓΩΝΙΑ']);
                    LabsViewVM.set("diadrastiko",  e.response.all_labs_by_type['ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ']);
                    LabsViewVM.set("troxilato",  e.response.all_labs_by_type['ΤΡΟΧΗΛΑΤΟ']);
                }else{ //εαν ο χρήστης βάλει βλακείες σε κάποιο πεδίο της αναζήτησης πχ lab_id = sefwgei, τότε ΔΕΝ επιστρεφεται το all_labs_by_type 
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
                }
                
                var title_success, title_fail;
                if(e.type=="create"){
                    
                    title_success = "Η Διάταξη Η/Υ δημιουργήθηκε επιτυχώς";
                    title_fail= "Η δημιουργία της Διάταξης Η/Υ απέτυχε";
                    
                }else if(e.type=="destroy"){
                    
                    var remove_dialog = $("#remove_dialog").data("kendoWindow");
                    remove_dialog.close();
                    
                    title_success = "Η Διάταξη Η/Υ διαγράφηκε επιτυχώς";
                    title_fail= "Η διαγραφή της Διάταξης Η/Υ απέτυχε";
                    
                }
                
                if (e.response.status == "200"){
                    
                    notification.show({
                        title: title_success,
                        message: message
                    }, "success");
                    
                    LabsViewVM.labs.read();               
                    
                }else{
                    
                    notification.show({
                        title: title_fail,
                        message: message
                    }, "error");
                    
                    LabsViewVM.labs.read();
                }
            }
        },
        change: function(e) {
            //console.log("labs datasource change e:", e);
            //console.log("einai to 1o lab new?:", e.items[0].isNew());
            //console.log("einai to 1o lab dirty?:", e.items[0].dirty);
        }
    }),

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
        createDialogUpdateButton.addClass('k-state-disabled').html('<i class="fa fa-spinner fa-spin"></i> Παρακαλώ περιμένετε...');
        createDialogUpdateButton.click(function() { return false; });
    },
    transitLab: function(e){
        //console.log("transitLab e:", e);
        e.preventDefault();
        
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

                    transitDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Παρακαλώ περιμένετε...');

                    var parameters = {
                              lab_id: dataItem.lab_id,
                              transition_date: transitDialogTransitDatePicker.val(),
                              transition_justification: transitDialogTransitJustificationInput.val(),
                              transition_source: 'mylab',
                              state: toState
                            };

                    transitAjaxRequest('POST', 'lab_transitions', parameters, transition_dialog, lab_grid);

                });
            }
        }).data("kendoWindow");
        
        var command = e.data.commandName;
        var lab_grid = $(e.delegateTarget).data("kendoGrid");
        var row = $(e.currentTarget).closest("tr");
        var dataItem = this.dataItem(row);
        var transitTemplate = kendo.template($("#lab_transit_template").html());
        dataItem.set("toState", command);//!! για να περάσω τον τύπο μετάβασης στο template 'lab_transit_template'
        transition_dialog.content(transitTemplate(dataItem));
        transition_dialog.center().open();
    },
    submitLab: function(e){
        //console.log("submitLab e:", e);
        e.preventDefault();
        
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
                    submitDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Παρακαλώ περιμένετε...');
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

                                    lab_grid.dataSource.read(); //school units view or labs view depending on the current view

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
        
        var lab_grid = $(e.delegateTarget).data("kendoGrid");
        var row = $(e.currentTarget).closest("tr");
        var dataItem = this.dataItem(row);
        var submitTemplate = kendo.template($("#lab_submit_template").html());
        submit_dialog.content(submitTemplate(dataItem));
        submit_dialog.center().open();
 
    },
    removeLab: function(e){
        //console.log("removeLab e:", e);
        e.preventDefault();
                
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

                removeDialogUpdateButton.on("click", function(event){
                    event.preventDefault();
                    removeDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Παρακαλώ περιμένετε...');
                    lab_grid.removeRow(row);
                    //remove_dialog.close(); its closed inside Datasource requestEnd
                });

                removeDialogCancelButton.on("click", function(event){
                    event.preventDefault();
                    remove_dialog.close();
                });
            }
        }).data("kendoWindow");

        var lab_grid = $(e.delegateTarget).data("kendoGrid");
        var row = $(e.currentTarget).closest("tr");
        var dataItem = lab_grid.dataItem(row);
        var removeTemplate = kendo.template($("#lab_remove_template").html());
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
                                                    var deleteLabEquipmentDialogUpdateButton = delete_lab_equipment_dialog.element.find("div.k-edit-buttons>button.k-grid-delete");
                                                    var deleteLabEquipmentDialogCancelButton = delete_lab_equipment_dialog.element.find("div.k-edit-buttons>button.k-grid-cancel");

                                                    deleteLabEquipmentDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        delete_lab_equipment_dialog.close();
                                                    });

                                                    deleteLabEquipmentDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        deleteLabEquipmentDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Παρακαλώ περιμένετε...');
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
                                                    var deleteLabAquisitionSourceDialogUpdateButton = delete_lab_aquisition_source_dialog.element.find("div.k-edit-buttons>button.k-grid-delete");
                                                    var deleteLabAquisitionSourceDialogCancelButton = delete_lab_aquisition_source_dialog.element.find("div.k-edit-buttons>button.k-grid-cancel");

                                                    deleteLabAquisitionSourceDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        delete_lab_aquisition_source_dialog.close();
                                                    });

                                                    deleteLabAquisitionSourceDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        deleteLabAquisitionSourceDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Παρακαλώ περιμένετε...');
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
/*                      
                        console.log("container: ", container);
                        console.log("options: ", options);
                        data-bind="value:' + options.field + ', visible:' + LabsViewVM.get("mylabSearchVisible") + '"
*/                      
                        var parameters;
                        var ldap_user_matched = false;
                        var mylab_screen= false;
                        var new_lab_worker_tr = lab_workers_details.tbody.find("tr.k-grid-edit-row");
                        function toggle_screen(){
                            if(mylab_screen){
                                //toggle to ldap screen
                                mylab_input.wrapper.hide();
                                btn_switch_to_ldap_screen.hide();
                                ldap_input.wrapper.show();
                                ldap_input.focus();
                                btn_switch_to_mylab_screen.show();
                                if(ldap_user_matched){
                                    btn_submit_ldap_worker.show();
                                }
                                if(mylab_input.wrapper.next().hasClass("k-tooltip-validation")){
                                    mylab_input.wrapper.next(".k-tooltip-validation").hide();
                                }
                                mylab_screen = false;
                            }else{
                                //toggle to mylab screen
                                ldap_input.wrapper.hide();
                                btn_switch_to_mylab_screen.hide();
                                btn_submit_ldap_worker.hide();
                                mylab_input.wrapper.show();
                                btn_switch_to_ldap_screen.show();
                                mylab_input.focus();
                                mylab_screen = true;
                            }
                        }
                        //EVENT: on update click, if user is on ldap screen, just switch them to mylab screen. DO NOT UPDATE the entry (stop propagation)
                        container.siblings(":last").on("click", "a.k-grid-update", function(e){
                            if(!mylab_screen){
                                e.stopPropagation();
                                toggle_screen();
                            }
                        });
                        //var new_lab_worker_item = lab_workers_details.dataSource.get(""); //πάρε το item που έχει άδειο το πεδίο id (δηλ. το καινουριο item)
                        
                        /* SCREEN 1 - mylab screen */
                        
                        //mylab workers input field
                        var mylab_input = $('<input id="mylab_input" name="mylab_input" data-bind="value:worker_id" data-text-field="fullname" data-value-field="worker_id" required data-required-msg="Ξέχασες τον υπεύθυνο!"/>')
                        .appendTo(container)
                        .width("80%").
                        kendoComboBox({
                            dataSource: newMyLabWorkersDS(),
                            autoBind: false,
                            filter: "contains",
                            placeholder: "αναζήτηση στη λίστα με Επώνυμο ή ΑΜ",
                            dataBound: function(e){                                
                                //console.log("mylab_input dataBound e:", e);
                                if(e.sender.dataSource.data().length > 0){
                                    var bound_lab_worker_data = e.sender.dataSource.data();
                                    new_lab_worker_tr.find("td[data-container-for='worker_registry_no']").text(bound_lab_worker_data[0].registry_no);
                                    new_lab_worker_tr.find("td[data-container-for='specialization_code_name']").text(bound_lab_worker_data[0].worker_specialization_name);
                                }else{
                                    new_lab_worker_tr.find("td[data-container-for='worker_registry_no']").text("");
                                    new_lab_worker_tr.find("td[data-container-for='specialization_code_name']").text("");                                    
                                }
                            },
                            change: function(e){
                                //console.log("mylab_input change e:", e);
                                var worker_id = this.value();
                                if(e.sender.dataSource.data().length > 0){
                                    $.each(e.sender.dataSource.data(), function(index, value){
                                        if(value.worker_id == worker_id){
                                            new_lab_worker_tr.find("td[data-container-for='worker_registry_no']").text(value.registry_no);
                                            new_lab_worker_tr.find("td[data-container-for='specialization_code_name']").text(value.worker_specialization_name);
                                        }
                                    });
                                }
                            }
                        }).data("kendoComboBox");
                        
                        //mylab_input validation tooltip
                        var mylab_input_validation_tooltip = $('<span class="k-invalid-msg" data-for="mylab_input"></span>').appendTo(container);  

                        //switch to ldap screen
                        var btn_switch_to_ldap_screen = $('<em><i class="fa fa-search"></i> LDAP</em>').appendTo(container).width("18%").kendoButton({
                            click: function(){
                                toggle_screen();
                            }
                        });


                        /* SCREEN 2 - ldap screen */
                        
                        //switch to mylab screen
                        var btn_switch_to_mylab_screen = $('<em><i class="fa fa-arrow-circle-o-left"></i> πίσω</em>').appendTo(container).width("16%").kendoButton({
                            click: function(){
                                toggle_screen();
                            }
                        });

                        //ldap workers input field
                        var ldap_input = $('<input id="ldap_input" data-text-field="UID" data-value-field="UID" />')
                        .appendTo(container)
                        .width("74%")
                        .kendoAutoComplete({
                            dataSource: newLdapWorkersDS(),
                            autoBind: false,
                            //filter: "contains",
                            placeholder: "αναζήτηση με το LDAP UID",
                            dataBound: function(e){
                                //Fired when the widget is bound to data from its data source.
                                //console.log("ldap_input dataBound e:", e);
                                if(e.sender.dataSource.data().length < 1){ //if no worker uid matched
                                    ldap_user_matched = false;
                                    container.find("#submitLdapWorkerBtn").hide(); //hide submit ldap worker button
                                    e.sender.element.next(".fa-check-square-o").hide(); //hide 'found check' icon
                                    if(!e.sender.element.next().hasClass("fa-times")){ //show 'still searching' icon
                                        e.sender.element.after('<span class="fa fa-times" style="display: block; color:red; position:absolute; bottom:5px; right:3px;"></span>');
                                    }else{
                                        e.sender.element.next(".fa-times").show();
                                    }
                                }else{ //if worker uid matched
                                    ldap_user_matched = true;
                                    var ldap_worker = e.sender.dataSource.at(0); //get ldap worker's data & populate post mylab_workers ajax request's parameters
                                    parameters = {
                                          uid: ldap_worker.UID,
                                          firstname:  ldap_worker.name,
                                          lastname:  ldap_worker.surname,
                                          fathername: ldap_worker.fathername,
                                          email: ldap_worker.mail,
                                          registry_no: ldap_worker.registry_no,
                                          worker_specialization: ldap_worker.worker_specialization,
                                          lab_source: 5
                                        };
                                    container.find("#submitLdapWorkerBtn").show(); //show submit ldap worker button to permit saving to mylab_workers db table
                                    e.sender.element.next(".fa-times").hide(); //hide 'still searching' icon             
                                    if(!e.sender.element.next().hasClass("fa-check-square-o")){ //show 'found check' icon
                                        e.sender.element.after('<span class="fa fa-check-square-o fa-lg" style="display: block; color:green; position:absolute; bottom:5px; right:3px;"></span>');
                                    }else{
                                        e.sender.element.next(".fa-check-square-o").show();
                                    }
                                }
                            }
                        }).data("kendoAutoComplete");

                        //submit ldap worker functionality
                        var btn_submit_ldap_worker = $('<em id="submitLdapWorkerBtn"><i class="fa fa-floppy-o"></i></em>').appendTo(container).width("7%").kendoButton({
                            click: function(){
                                                                
                                container.find("#submitLdapWorkerBtn").hide(); //hide submit ldap worker button
                                $('<span id="submitLdapWorkerSpinner" style="padding:3px 5px; margin:0px 7px;"><i class="fa fa-spinner fa-spin fa-lg"></i></span>').appendTo(container); //add spinner
                                ldap_input.readonly(true); //make input field read-only
                                
                                $.ajax({
                                    type: "POST",
                                    url: baseURL + "mylab_workers" + "?user=" + user_url,
                                    dataType: "json",
                                    data: JSON.stringify(parameters),
                                    success: function(data){
                                        
                                        container.find("#submitLdapWorkerSpinner").remove(); //remove spinner
                                        ldap_input.element.next().hide(); //hide green check
                                        ldap_input.readonly(false);
                                        
                                        if(data.status == "200"){
                                            // !!! save 'worker_id', returned from the mylab_workers api function, to the dataitem's 'worker_id' attribute
                                            //new_lab_worker_item.worker_id = data.worker_id;
                                            ldap_input.value("");
                                            notification.show({
                                                title: "Επιτυχής ενημέρωση της Υπηρεσίας MyLab από τον LDAP ΠΣΔ με τον Υπεύθυνο Διάταξης Η/Υ",
                                                message: data.message
                                            }, "success");               
                                        }else{
                                            notification.show({
                                                title: "Η ενημέρωση της Υπηρεσίας MyLab από τον LDAP ΠΣΔ με τον Υπεύθυνο Διάταξης Η/Υ απέτυχε",
                                                message: data.message
                                            }, "error");
                                        }
                                    }
                                });
                            }
                        });
                             
                        
                        //initialization stuff
                        toggle_screen(); //switch to initial mylab screen
                        ldap_input.element.next("span.k-loading").remove(); //remove kendo ui autocomplete, default on search loading icon
                        
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
                        $('<input name="' + options.field + '" data-bind="value:' + options.field + '" required data-required-msg="Ξέχασες την ημερομηνία!" novalidate="novalidate"/>')
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
                                                    
                                                    var disableLabWorkerDialogUpdateButton = disable_lab_worker_dialog.element.find("div.k-edit-buttons>button.k-grid-disable");
                                                    var disableLabWorkerDialogCancelButton = disable_lab_worker_dialog.element.find("div.k-edit-buttons>button.k-grid-cancel-disabling");

                                                    disableLabWorkerDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        disable_lab_worker_dialog.close();
                                                    });

                                                    disableLabWorkerDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        disableLabWorkerDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Παρακαλώ περιμένετε...');

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
                                                    
                                                    var removeLabWorkerDialogUpdateButton = remove_lab_worker_dialog.element.find("div.k-edit-buttons>button.k-grid-remove");
                                                    var removeLabWorkerDialogCancelButton = remove_lab_worker_dialog.element.find("div.k-edit-buttons>button.k-grid-cancel-remove");

                                                    removeLabWorkerDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        remove_lab_worker_dialog.close();
                                                    });

                                                    removeLabWorkerDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        removeLabWorkerDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Παρακαλώ περιμένετε...');

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
                                                    var deleteLabRelationDialogUpdateButton = delete_lab_transition_dialog.element.find("div.k-edit-buttons>button.k-grid-delete");
                                                    var deleteLabRelationDialogCancelButton = delete_lab_transition_dialog.element.find("div.k-edit-buttons>button.k-grid-cancel");

                                                    deleteLabRelationDialogCancelButton.on("click", function(e){
                                                        e.preventDefault(); //?
                                                        delete_lab_transition_dialog.close();
                                                    });

                                                    deleteLabRelationDialogUpdateButton.on("click", function(e){
                                                        e.preventDefault(); //?

                                                        deleteLabRelationDialogUpdateButton.addClass('k-state-disabled').attr("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Παρακαλώ περιμένετε...');
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
    dataBound: function(e){
        //console.log("LabsViewVM: labs grid DATABOUND event: ", e);
    
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

        var grid;
        if(LabsViewVM.isVisible){
            grid= $("#labs_view").data("kendoGrid");
        }else if(SchoolUnitsViewVM.isVisible){
            grid= $("#school_unit_labs").data("kendoGrid");
        }else if(LabWorkersViewVM.isVisible){
            grid= $("#lab_worker_labs").data("kendoGrid");
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
            grid= $("#labs_view").data("kendoGrid");
        }else if(SchoolUnitsViewVM.isVisible){
            grid= $("#school_unit_labs").data("kendoGrid");
        }else if(LabWorkersViewVM.isVisible){
            grid= $("#lab_worker_labs").data("kendoGrid");
        }
        
        var columnSelectWnd = $("#labs_column_selection_dialog").data("kendoWindow");
        var show= [1,3,4,8]; //default columns
        
        if( jQuery.inArray( authorized_user , transit_lab ) !== -1 && jQuery.inArray(11 , show) === -1 ){
            show.push(10);
        }
        
        if( jQuery.inArray( authorized_user , search_xls ) !== -1 && jQuery.inArray(10 , show) === -1 && LabWorkersViewVM.isVisible){
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