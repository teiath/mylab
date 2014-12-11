var LabWorkersViewVM = kendo.observable({

    isVisible: false,

    lab_workers: new kendo.data.DataSource({
        transport: {
            read: {
                url: "api/find_lab_workers",
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
                        //delete data.sort;
                    }else{
                        //if no sorting is defined, sort by lab worker's ...
                    }
                    
                    data['pagesize'] = data.pageSize;
                    // for  multiple partial string search in school_unit_name, school_unit_special_name, lab_name, lab_special_name inputs
                    data['searchtype'] = "containall";
                    delete data.pageSize;
                    return data;
                    
                }
            }
        },      
        schema: {
            data: "data",            
            total: "total", //necessary for the grid pager
            model: {
                id: "worker_id",
                fields:{
                    worker_id:{editable:false},
                    registry_no:{},
                    tax_number:{},
                    lastname:{},
                    firstname:{},
                    fathername:{},
                    sex:{},
                    worker_specialization:{}
                }
            }
        },
        pageSize: 20, /* κάθε φορά που ο χρήστης επιλέγει άλλο pagesize από το Grid, γίνεται request στον server με παράμετρο την 1η σελίδα (page=1) και το επιλεχθέν pagesize*/
        serverPaging: true, /* κάθε φορά που ο χρήστης επιλέγει άλλη σελίδα, γίνεται request στον server με παράμετρο τη συγκεκριμένη σελίδα (page) και το pagesize*/
        serverFiltering: true,
        serverSorting: true
    }),
        
    detailInit: function(e){
        console.log("LabWorkersViewVM detailInit: ", e);

        var school_unit_data;
        var parameters = {
            lab_worker: e.data.registry_no
        };
          
        $.ajax({
                type: "GET",
                url: baseURL + "search_school_units?user=" + user_url,
                dataType: "json",
                data: parameters,
                success: function(data){
                    if(data.status == 200){
                        school_unit_data = data;
                        
                        //nested labsGrid 
                        var labsGrid = e.detailRow.find("#lab_worker_labs").kendoGrid({

                            dataSource: newLabsDS(null, e.data.registry_no, e),
                            //detailInit: LabsViewVM.detailInit,
                            //detailTemplate: $("#lab_details_template").html(),
                            //selectable:"row",
                            selectable:false,
                            scrollable: true,
                            resizable: true,
                            sortable: "{'allowUnsort': false}",
                            pageable: false,
                            toolbar: [{ template : $('#lab_toolbar_template_lab_workers_labs').html(), binded_data: school_unit_data }],
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
                                        width:'95px',
                                        sortable:false
                                      },
                                      { field: 'positioning', title:'Τοποθεσία', width:'180px', hidden : true, sortable:false},
                                      { field: 'lab_special_name', title:'Ειδική Ονομασία', width:'180px', hidden : true, sortable:false},
                                      { field: 'creation_date', title:'Ημερομηνία Δημιουργίας', width:'160px', hidden : true},
                                      { field: 'last_updated', title:'Τελευταία Ενημέρωση', width:'145px', sortable:false},
                                      { field: 'created_by', title:'Δημιουργία από', width:'150px', hidden : true, sortable:false},
                                      { command: [{text:'', className: 'fa fa-info', click:LabWorkersViewVM.showContactDetails, name:'contactDetails'}], title:'', width:'217px'}],
                            dataBound: function(event){
                                //console.log("LabWorkersViewVM: nested labs grid DATABOUND event: ", event);                
                                kendo.bind(event.sender.element.find(".k-grid-toolbar>.school_unit_labs_refresh_btn"), LabsViewVM);
                                kendo.bind(event.sender.element.find(".k-grid-toolbar>.school_unit_labs_grid_columns_btn"), LabsViewVM);
                                LabsViewVM.dataBound(event);
                            }

                        }).data("kendoGrid");
                        kendo.bind(e.detailRow.find('#lab_worker_labs'), LabsViewVM);                        
                        
                        e.detailRow.find("#lab_worker_labs_labsNo").text("Διατάξεις Η/Υ: " + school_unit_data.all_labs);
                        
                    }else if(data.status == 500){ 
                    }
                },
                error: function (data){ console.log("ΛΑΘΟΣ AJAX REQUEST: ", data);}
        });

        //kendo.bind(e.detailRow.find(".k-grid-toolbar"), e.data.total_labs_by_type);
        //kendo.bind(e.detailRow.find(".k-grid-toolbar>.toolbar_filter>span"), LabsSearchVM); //φίλτρο τύπων εργαστηρίου
        
    },
    openColumnSelection: function(e){
               
        var column_selection_dialog = $("#lab_workers_column_selection_dialog").kendoWindow({
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 250,
                    pinned: true,
                    title: "Επιλογή Στηλών",
                    open: function(e){

                        e.sender.element.append('<div class="k-edit-buttons k-state-default" style="margin-top:10px; text-align:center">\
                                                    <button class="k-button k-button-icontext" onclick="LabWorkersViewVM.restoreDefaultColumns()">\
                                                        <i class="fa fa-undo"></i> Επαναφορά Όλων\
                                                    </button>\
                                                </div>');
                    }
        }).data("kendoWindow");
        var template = kendo.template($("#lab_workers_column_selection_template").html());
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
        var grid = $("#lab_workers_view").data("kendoGrid");
        
        if (grid.columns[col].hidden) {
            grid.showColumn(+col);
        } else {
            grid.hideColumn(+col);
        }
    },
    restoreDefaultColumns: function() {
        
        var grid = $("#lab_workers_view").data("kendoGrid");
        var columnSelectWnd = $("#lab_workers_column_selection_dialog").data("kendoWindow");
        
        $.each(grid.columns, function(index, value){ 
            grid.showColumn(+index);
            columnSelectWnd.element.find($("div.column_selection>label>input#field-"+value.field)).prop('checked', true);
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
    },
    showContactDetails: function(e){

        var labsGrid = $('body').find("#lab_worker_labs").data("kendoGrid");
        var tr = $(e.target).closest("tr");
        var item = labsGrid.dataItem(tr);
        var school_unit_id = item.school_unit_id;
        
        var parameters = {
            school_unit_id: school_unit_id
        };
        
        var contact_details_dialog = $("#contact_details_dialog").kendoWindow({
                    title: "Στοιχεία Επικοινωνίας Σχολικής Μονάδας",
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 500,
                    pinned: true
        }).data("kendoWindow");        
          
        $.ajax({
                type: "GET",
                url: baseURL + "search_school_units?user=" + user_url,
                dataType: "json",
                data: parameters,
                success: function(data){

                    if(data.status == 200){
                        var school_unit_data = data.data["0"];
                        
                        var schoolUnitContactDetailsTemplate = kendo.template($("#school_unit_contact_details_template").html());
                        contact_details_dialog.content(schoolUnitContactDetailsTemplate(school_unit_data));
                        contact_details_dialog.center().open();
                        
                    }else if(data.status == 500){
                        notification.show({
                            title: "Προέκυψε κάποιο πρόβλημα με την εμφάνιση των στοιχείων της Σχολικής Μονάδας"
                        }, "error"); 
                    }

                },
                error: function (data){ console.log("ΛΑΘΟΣ AJAX REQUEST: ", data);}
        });
    }
    
});