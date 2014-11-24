var LabWorkersViewVM = kendo.observable({

    isVisible: false,

    lab_workers: new kendo.data.DataSource({
        transport: {
            read: {
                url: "api/lab_workers",
                type: "GET",
                dataType: "json"
            },
            parameterMap: function(data, type) {
//                if (type === 'read') {
//                    
//                    //normalize data filters
//                    if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {                    
//                        var normalizedFilter = {};
//                        $.each(data.filter.filters, function(index, value){
//                            var filter = data.filter.filters[index];
//                            var value = normalizedFilter[filter.field];
//                            value = (value ? value+"," : "")+ filter.value;
//                            normalizedFilter[filter.field] = value;                                   
//                        });
//                        $.extend(data, normalizedFilter);
//                        delete data.filter;
//                    }
//                    
//                    //normalize sorting filters
//                    if (typeof data.sort !== 'undefined' && typeof data.sort[0] !== 'undefined') {
//                        var sortingNormalizedFilter = {};
//                        //var sortingFilter = data.sort[0];
//                        sortingNormalizedFilter["orderby"] = data.sort[0].field;
//                        sortingNormalizedFilter["ordertype"] = data.sort[0].dir.toUpperCase();
//                        $.extend(data, sortingNormalizedFilter);
//                        delete data.sort;
//                    }else{
//                        //if no sorting is defined, sort by lab's creation date
//                        data["orderby"]= "creation_date";
//                        data["ordertype"]= "DESC";
//                    }
//                    
//                    data['pagesize'] = data.pageSize;
//                    // for  multiple partial string search in school_unit_name, school_unit_special_name, lab_name, lab_special_name inputs
//                    data['searchtype'] = "containall";
//                    delete data.pageSize;
//                    return data;
//                    
//                }
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
    })
    
});