var SchoolUnitsViewVM = kendo.observable({

    isVisible: false,

    school_units:  new kendo.data.DataSource({
        transport: {
            read: {
                url: "api/search_school_units",
                type: "GET",
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
                    }
                    
                    data['pagesize'] = data.pageSize;
                    delete data.pageSize;
                    
                    // for  multiple partial string search in school_unit_name, school_unit_special_name, lab_name, lab_special_name inputs
                    data['searchtype'] = "containall";
                    //user authorization
                    //data['user'] = user;
                    
                    SchoolUnitsViewVM.set("school_unit_parameters",  data);
                    
                    return data;
                    
                }
            }
        },      
        schema: {
            data: "data",            
            total: "total", //necessary for the grid pager
            model: {
                id: "school_unit_id",
                fields:{
                    school_unit_id:{editable:false},
                    school_unit_name:{},
                    //name:{},
                    special_name:{},
                    school_unit_type:{},
                    education_level:{},
                    school_unit_state:{},
                    region_edu_admin:{},
                    edu_admin:{},
                    transfer_area:{},
                    municipality:{},
                    prefecture:{},
                    last_update:{},
                    fax_number:{},
                    phone_number:{},
                    email:{},
                    street_address:{},
                    postal_code:{},
                    labs:{},
                    total_labs_by_type:{}
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
            console.log("school units datasource requestEnd e:", e);
            if (e.type=="read" && authorized_user === "ΔΙΕΥΘΥΝΤΗΣ"){ //maxRole === "noAccess", authorized_user === "noAccess"
                
                SchoolUnitsViewVM.set("principal_school_unit_name", e.response.data[0].school_unit_name);
                SchoolUnitsViewVM.set("principal_school_unit_special_name", e.response.data[0].school_unit_special_name);
                SchoolUnitsViewVM.set("principal_phone_number", e.response.data[0].phone_number);
                SchoolUnitsViewVM.set("principal_fax_number", e.response.data[0].fax_number);
                SchoolUnitsViewVM.set("principal_email", e.response.data[0].email);
                SchoolUnitsViewVM.set("principal_street_address", e.response.data[0].street_address + ", ΤΚ " + e.response.data[0].postal_code);
                SchoolUnitsViewVM.set("principal_school_unit_worker", e.response.data[0].school_unit_worker[0].lastname + " " + e.response.data[0].school_unit_worker[0].firstname);
                                
//                notification.show({
//                    title: "Η λήψη δεδομένων από την υπηρεσία myLab δεν ειναι εφικτή",
//                    message: e.response.message
//                }, "error");
                
//                console.log("ΣΕΠΕΗΥ:", e.response.all_labs_by_type["ΣΕΠΕΗΥ"]);
//                console.log("ΕΤΠ:", e.response.all_labs_by_type["ΕΤΠ"]);
//                console.log("ΤΡΟΧΗΛΑΤΟ:", e.response.all_labs_by_type["ΤΡΟΧΗΛΑΤΟ"]);
//                console.log("ΓΩΝΙΑ:", e.response.all_labs_by_type["ΓΩΝΙΑ"]);
//                console.log("ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ:", e.response.all_labs_by_type["ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"]);
//                LabsViewVM.set("labs_count",  e.response.total);
//                LabsViewVM.set("sepehy_count", e.response.all_labs_by_type["ΣΕΠΕΗΥ"]);
//                LabsViewVM.set("etp_count",  e.response.all_labs_by_type["ΕΤΠ"]);
//                LabsViewVM.set("troxilata_count",  e.response.all_labs_by_type["ΤΡΟΧΗΛΑΤΟ"]);
//                LabsViewVM.set("gwnies_count", e.response.all_labs_by_type["ΓΩΝΙΑ"]);
//                LabsViewVM.set("diadrastika_sistimata_count", e.response.all_labs_by_type["ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"]);
//                
            }
        },
        change: function(e) {
    
            /*  Fired when the data source is populated from a JavaScript array or a remote service, a data item is inserted, updated or removed, the data items are paged, sorted, filtered or grouped.
             * 
             *  e.sender kendo.data.DataSource    The data source instance which fired the event.
             *  e.action string(optional)         String describing the action type (available for all actions other than "read"). Possible values are "itemchange", "add", "remove" and "sync".
             *  e.items Array                     The array of data items that were affected (or read).
             */
    
            console.log("school units datasource change e:", e);
        }
    }),
    
    school_unit_parameters: null,
    
    principal_school_unit_name: null,
    principal_school_unit_special_name: null,
    principal_phone_number: null,
    principal_fax_number: null,
    principal_email: null,
    principal_street_address: null,
    principal_school_unit_worker: null,
    showPrincipalSchoolUnitInfo: function(e){
       
        var school_unit_info_dialog = $("#school_unit_info_dialog").kendoWindow({
            title: SchoolUnitsViewVM.principal_school_unit_name,
            modal: true,
            visible: false,
            resizable: false,
            width: 400,
            pinned: true
        }).data("kendoWindow");
        
        school_unit_info_dialog.content();
        school_unit_info_dialog.center().open();
        
    },
        
    showContactDetails: function(e){
        //console.log("showContactDetails e: ", e);

        var contact_details_dialog = $("#contact_details_dialog").kendoWindow({
                    title: "Στοιχεία Επικοινωνίας",
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 500,
                    pinned: true
        }).data("kendoWindow");
        
        var schoolUnitContactDetailsTemplate = kendo.template($("#school_unit_contact_details_template").html());
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        contact_details_dialog.content(schoolUnitContactDetailsTemplate(dataItem));
        contact_details_dialog.center().open();
        
    },
    detailInit: function(e){
        console.log("SchoolUnitsViewVM detailInit: ", e);

        //nested labsGrid 
        var labsGrid = e.detailRow.find("#school_unit_labs").kendoGrid({
                       
            dataSource: newLabsDS(e.data.school_unit_id, e),
            detailInit: LabsViewVM.detailInit,
            detailTemplate: $("#lab_details_template").html(),
            selectable:"row",
            scrollable: true,
            resizable: true,
            sortable: "{'allowUnsort': false}",
//            pageable: { pageSizes : [5, 10, 15, 20, 25, 30, 50], 
//                        messages:  {
//                                     display: '{0}-{1} από {2} διατάξεις Η/Υ', 
//                                     empty: 'Δεν βρέθηκαν διατάξεις Η/Υ',
//                                     itemsPerPage: 'διατάξεις Η/Υ ανά σελίδα', 
//                                     first: 'μετάβαση στην πρώτη σελίδα',
//                                     previous: 'μετάβαση στην προηγούμενη σελίδα',
//                                     next: 'μετάβαση στην επόμενη σελίδα',
//                                     last: 'μετάβαση στην τελευταία σελίδα' 
//                                   }
//            },
            pageable: false,
            editable: { mode : 'popup', template: $('#lab_create_template').html()},
            toolbar: [{ template : $('#lab_toolbar_template_school_unit_labs').html(), binded_data: e.data }],
            columns: [{ field: 'lab_id', title:'κωδικός', width:'65px', hidden : true},
                      { field: 'lab_name', title:'ονομασία', width:'440px'},
                      { field: 'lab_type', title:'τύπος', width:'150px', hidden : true},
                      { field: 'lab_state', title:'κατάσταση', width:'100px'},
                      {     
                            field:'rating',
                            title:'βαθμολογία',
                            template: function(dataItem) { //το dataItem ειναι περιέχει όλα τα στοιχεια της Διάταξης Η/Υ έτσι όπως τα επεστρεψε η getLabs μεσα στο λεκτικό data +καποια επιπλεον!                            

                                var oRating, tRating;
                                var oRating = (dataItem.operational_rating !== null && typeof dataItem.operational_rating !== 'undefined') ? dataItem.operational_rating : "-";
                                var tRating = (dataItem.technological_rating !== null && typeof dataItem.operational_rating !== 'undefined') ? dataItem.technological_rating : "-";

                                var itemReturned = '<span>' + oRating +  ' <i class="fa fa-star"></i> ' + tRating + ' <i class="fa fa-thumbs-up"></i> ' + '</span>';
                                return itemReturned;
                            },
                            width:'85px'
                      },
                      { field: 'positioning', title:'Τοποθεσία', width:'180px', hidden : true},
                      { field: 'lab_special_name', title:'Ειδική Ονομασία', width:'180px', hidden : true},
                      { field: 'creation_date', title:'Ημερομηνία Δημιουργίας', width:'150px', hidden : true},
                      { field: 'last_updated', title:'Τελευταία Ενημέρωση', width:'150px'},
                      { field: 'created_by', title:'Δημιουργία από', width:'130px', hidden : true},
                      { field: 'lab_source', title:'Πηγή', width:'130px', hidden : true},   
                      { command: [{text:'Ενεργοποίηση', click:LabsViewVM.transitLab, name:'activate'}, 
                                  {text:'Αναστολή', click:LabsViewVM.transitLab, name:'suspend'},
                                  {text:'Κατάργηση', click:LabsViewVM.transitLab, name:'abolish'}], title: 'ενέργειες', width:'270px', hidden: LabsViewVM.hideLabTransitColumn()}],
            edit: function(event){
                console.log("SchoolUnitsViewVM: nested labs grid EDIT event: ", event);
                kendo.bind(event.container, LabsViewVM);
                kendo.bind(event.container, event.model);
                LabsViewVM.createLab(event);
            },
            dataBinding: function(event){
                console.log("SchoolUnitsViewVM: nested labs grid DATABINDING event: ", event);
                
                LabsViewVM.dataBinding(event);
            },
            dataBound: function(event){
                console.log("SchoolUnitsViewVM: nested labs grid DATABOUND event: ", event);
                
                kendo.bind($("#school_unit_labs").find(".k-grid-toolbar>.school_unit_labs_refresh_btn"), LabsViewVM);
                kendo.bind($("#school_unit_labs").find(".k-grid-toolbar>.school_unit_labs_grid_columns_btn"), LabsViewVM);
                
                LabsViewVM.dataBound(event);
            }
            
        }).data("kendoGrid");
                
        e.data.total_labs_by_type['ΔΙΑΔΡΑΣΤΙΚΟΣΥΣΤΗΜΑ'] = e.data.total_labs_by_type['ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ']; //workaround on total_labs_by_type['ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ'] which won't make the binding

        kendo.bind(e.detailRow.find('#school_unit_labs'), LabsViewVM);
        kendo.bind(e.detailRow.find(".k-grid-toolbar"), e.data.total_labs_by_type);
        //kendo.bind(e.detailRow.find(".k-grid-toolbar>.toolbar_filter>span"), LabsSearchVM); //φίλτρο τύπων εργαστηρίου
        
    },
    openColumnSelection: function(e){
               
        var column_selection_dialog = $("#school_units_column_selection_dialog").kendoWindow({
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 250,
                    pinned: true,
                    title: "Επιλογή Στηλών",
                    open: function(e){

                        e.sender.element.append('<div class="k-edit-buttons k-state-default" style="margin-top:10px; text-align:center">\
                                                    <button class="k-button k-button-icontext k-grid-transit" onclick="SchoolUnitsViewVM.restoreDefaultColumns()">\
                                                        Επαναφορά Προεπιλεγμένων\
                                                    </button>\
                                                </div>');
                    }
        }).data("kendoWindow");

        var template = kendo.template($("#school_units_column_selection_template").html());
        var toolbar = "";
        var grid = $("#school_units_view").data("kendoGrid");
        console.log("grid: ", grid);
        $.each(grid.columns, function (idx, item) {
            toolbar += template({ idx: idx, item: item });
        });

        column_selection_dialog.content(toolbar);
        column_selection_dialog.center().open();
    },
    hideColumn: function(col) {
        var grid = $("#school_units_view").data("kendoGrid");
        if (grid.columns[col].hidden) {
            grid.showColumn(+col);
        } else {
            grid.hideColumn(+col);
        }
        
        console.log("grid: ", grid);
    },
    restoreDefaultColumns: function() {
        
        var grid = $("#school_units_view").data("kendoGrid");
        var columnSelectWnd = $("#school_units_column_selection_dialog").data("kendoWindow");
        var show= [0,1,5,7,16,17]; //default columns
        
        $.each(grid.columns, function(index, value){
            if(jQuery.inArray( index, show ) !== -1 ){
                grid.showColumn(+index);
                columnSelectWnd.element.find($("div.column_selection>label>input#field-"+value.field)).prop('checked', true);
            }else{
                grid.hideColumn(+index);
                columnSelectWnd.element.find($("div.column_selection>label>input#field-"+value.field)).prop('checked', false);
            }
        });
    },
    refresh: function(){
        var grid = $("#school_units_view").data("kendoGrid");
        grid.refresh();
    },
    refreshTooltip: function(e){

        var tooltip = $(".school_unit_refresh_btn").kendoTooltip({
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
        tooltip.show($(".school_unit_refresh_btn"));
    },
    columnsTooltip: function(e){

        var tooltip = $(".school_unit_grid_columns_btn").kendoTooltip({
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
        tooltip.show($(".school_unit_grid_columns_btn"));
    }
    //xlsTooltip inside SearchVM
});