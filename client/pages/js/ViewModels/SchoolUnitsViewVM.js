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
//            if (e.type=="read"){
//                
//                LabsViewVM.set("labs_count",  e.response.total);
//                LabsViewVM.set("sepehy_count", e.response.all_labs_by_type["ΣΕΠΕΗΥ"]);
//                LabsViewVM.set("etp_count",  e.response.all_labs_by_type["ΕΤΠ"]);
//                LabsViewVM.set("troxilata_count",  e.response.all_labs_by_type["ΤΡΟΧΗΛΑΤΟ"]);
//                LabsViewVM.set("gwnies_count", e.response.all_labs_by_type["ΓΩΝΙΑ"]);
//                LabsViewVM.set("diadrastika_sistimata_count", e.response.all_labs_by_type["ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"]);
//                
//            }
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
    
    showContactDetails: function(e){
        //console.log("showContactDetails e: ", e);

        var contact_details_dialog = $("#contact_details_dialog").kendoWindow({
                    title: "Στοιχεία Επικοινωνίας",
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 500
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
                       
            dataSource: newLabsDS(e.data.school_unit_id, e, SchoolUnitsViewVM.get("school_unit_parameters")),
            detailInit: LabsViewVM.detailInit,
            detailTemplate: $("#lab_details_template").html(),
            selectable:"row",
            scrollable: false,
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
            toolbar: [{ template : $('#lab_toolbar_template').html()  }],
            columns: [{ field: 'lab_id', title:'κωδικός', width:'5%', hidden : true},
                      { field: 'lab_name', title:'ονομασία', width:'40%'},
                      { field: 'lab_type', title:'τύπος', width:'10%'},
                      { field: 'lab_state', title:'κατάσταση', width:'10%'},
                      { field: 'operational_rating', title:'βαθμολογία', width:'10%'},
                      { command: [{text:'Ενεργοποίηση', click:LabsViewVM.transitLab, name:'activate'}, 
                                  {text:'Αναστολή', click:LabsViewVM.transitLab, name:'suspend'},
                                  {text:'Κατάργηση', click:LabsViewVM.transitLab, name:'abolish'}], title: 'ενέργειες', width:'30%'}],
            edit: function(event){
                console.log("labs grid edit event: ", event);
                kendo.bind(event.container, LabsViewVM);
                kendo.bind(event.container, event.model);
                LabsViewVM.createLab(event);
            },
            dataBound: function(event){
                console.log("labs grid databound event: ", event);
                //kendo.bind(event.sender.element, LabsViewVM);
                LabsViewVM.dataBoundLab(event);
            }
            
        }).data("kendoGrid");
        
        
        kendo.bind(e.detailRow.find('#school_unit_labs'), LabsViewVM);
        kendo.bind(e.detailRow.find(".k-grid-toolbar"), e.data.total_labs_by_type);
        //kendo.bind(e.detailRow.find(".k-grid-toolbar>.toolbar_filter>span"), LabsSearchVM); //φίλτρο τύπων εργαστηρίου
        
    }

});