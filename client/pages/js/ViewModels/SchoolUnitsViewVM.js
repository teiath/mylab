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
            }
        },
        pageSize: 20, //κάθε φορά που ο χρήστης επιλέγει άλλο pagesize από το Grid, γίνεται request στον server με παράμετρο την 1η σελίδα (page=1) και το επιλεχθέν pagesize
        serverPaging: true, //κάθε φορά που ο χρήστης επιλέγει άλλη σελίδα, γίνεται request στον server με παράμετρο τη συγκεκριμένη σελίδα (page) και το pagesize
        serverFiltering: true,
        serverSorting: true,
        requestEnd: function(e) {/*console.log("school units datasource requestEnd e:", e);*/},
        change: function(e) { /*console.log("school units datasource change e:", e); */}
    }),
        
    detailInit: function(e){
        //console.log("SchoolUnitsViewVM detailInit: ", e);

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
            columns: [{ field: 'lab_id', title:'Κωδικός Διάταξης Η/Υ', width:'140px', hidden : true},
                      { field: 'lab_name', title:'Ονομασία', width:'460px'},
                      { field: 'lab_type', title:'Τύπος', width:'150px', hidden : true},
                      { field: 'lab_state', 
                        title:'Λειτουργική Κατάσταση',
                        template: function(dataItem) {
                            
                            var state= dataItem.lab_state;
                            var itemReturned;
                            
                            if(state === "ΕΝΕΡΓΗ"){
                                itemReturned = '<i class="fa fa-circle state_green"></i> <span style="margin-left:4px;">' + state + '</span>';
                            }else if(state === "ΣΕ ΑΝΑΣΤΟΛΗ"){
                                itemReturned = '<i class="fa fa-circle state_orange"></i> <span style="margin-left:4px;">' + state + '</span>';
                            }else if(state === "ΚΑΤΑΡΓΗΜΕΝΗ"){
                                itemReturned = '<i class="fa fa-circle state_red"></i> <span style="margin-left:4px;">' + state + '</span>';
                            }
                            
                            return itemReturned;
                        },
                        width:'150px'
                      },
                      {     
                            field:'rating',
                            title:'Αξιολόγηση',
                            template: function(dataItem) { //το dataItem ειναι περιέχει όλα τα στοιχεια της Διάταξης Η/Υ έτσι όπως τα επεστρεψε η searchLabs μεσα στο λεκτικό data +καποια επιπλεον!                            

                                var oRating, tRating;
                                var oRating = (dataItem.operational_rating !== null && typeof dataItem.operational_rating !== 'undefined') ? dataItem.operational_rating : "-";
                                var tRating = (dataItem.technological_rating !== null && typeof dataItem.operational_rating !== 'undefined') ? dataItem.technological_rating : "-";

                                var itemReturned = '<span>' + tRating +  ' <i class="fa fa-thumbs-up"></i> ' + oRating + ' <i class="fa fa-star"></i> ' + '</span>';
                                return itemReturned;
                            },
                            width:'95px'
                      },
                      { field: 'positioning', title:'Τοποθεσία', width:'180px', hidden : true},
                      { field: 'lab_special_name', title:'Ειδική Ονομασία', width:'180px', hidden : true},
                      { field: 'creation_date', title:'Ημερομηνία Δημιουργίας', width:'160px', hidden : true},
                      { field: 'last_updated', title:'Τελευταία Ενημέρωση', width:'145px'},
                      { field: 'created_by', title:'Δημιουργία από', width:'150px', hidden : true},
                      { command: [{text:'Ενεργοποίηση', click:LabsViewVM.transitLab, name:'activate', 'imageClass': 'fa fa-check'}, 
                                  {text:'Αναστολή', click:LabsViewVM.transitLab, name:'suspend', 'imageClass': 'fa fa-clock-o'},
                                  {text:'Κατάργηση', click:LabsViewVM.transitLab, name:'abolish', 'imageClass': 'fa fa-ban'},
                                  {text:'Οριστική Υποβολή', click:LabsViewVM.submitLab, name:'submit', 'imageClass': 'fa fa-floppy-o'},
                                  {text:'Διαγραφή', click:LabsViewVM.removeLab, name:'remove', 'imageClass': 'fa fa-times'}], title: 'Ενέργειες', width:'240px', hidden: LabsViewVM.actionsColumnVisible()}],
            edit: function(event){
                //console.log("SchoolUnitsViewVM: nested labs grid EDIT event: ", event);
                kendo.bind(event.container, LabsViewVM);
                kendo.bind(event.container, event.model);
                LabsViewVM.createLab(event);
            },
            dataBinding: function(event){
                //console.log("SchoolUnitsViewVM: nested labs grid DATABINDING event: ", event);
                LabsViewVM.dataBinding(event);
            },
            dataBound: function(event){
                //console.log("SchoolUnitsViewVM: nested labs grid DATABOUND event: ", event);
                kendo.bind(event.sender.element.find(".k-grid-toolbar>.school_unit_labs_refresh_btn"), LabsViewVM);
                kendo.bind(event.sender.element.find(".k-grid-toolbar>.school_unit_labs_grid_columns_btn"), LabsViewVM);
                LabsViewVM.dataBound(event);
            }
            
        }).data("kendoGrid");
            
        e.data.total_labs_by_type['ΔΙΑΔΡΑΣΤΙΚΟΣΥΣΤΗΜΑ'] = e.data.total_labs_by_type['ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ']; //workaround on total_labs_by_type['ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ'] which won't make the binding

        kendo.bind(e.detailRow.find('#school_unit_labs'), LabsViewVM);
        kendo.bind(e.detailRow.find(".k-grid-toolbar"), e.data.total_labs_by_type);
        //kendo.bind(e.detailRow.find(".k-grid-toolbar>.toolbar_filter>span"), LabsSearchVM); //φίλτρο τύπων εργαστηρίου
        
    },
    
    showContactDetails: function(e){

        var contact_details_dialog = $("#contact_details_dialog").kendoWindow({
                    title: "Στοιχεία Επικοινωνίας Σχολικής Μονάδας",
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
                                                    <button class="k-button k-button-icontext" onclick="SchoolUnitsViewVM.restoreDefaultColumns()">\
                                                        <i class="fa fa-undo"></i> Επαναφορά Προεπιλεγμένων\
                                                    </button>\
                                                </div>');
                    }
        }).data("kendoWindow");
        var template = kendo.template($("#school_units_column_selection_template").html());
        var content = "";
        var grid = $(e.target).closest(".k-grid").data("kendoGrid");
        
        $.each(grid.columns, function (idx, item) {
            content += template({ idx: idx, item: item });
        });

        column_selection_dialog.content(content);
        column_selection_dialog.center().open();
    },
    refresh: function(e){
        var grid = $(e.target).closest(".k-grid").data("kendoGrid");
        grid.dataSource.read();
    },
    toggleColumn: function(col) {
        var grid = $("#school_units_view").data("kendoGrid");
        
        if (grid.columns[col].hidden) {
            grid.showColumn(+col);
        } else {
            grid.hideColumn(+col);
        }
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
    refreshTooltip: function(e){
        
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
    },
    columnsTooltip: function(e){

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
    }
    //xlsTooltip inside SearchVM
});