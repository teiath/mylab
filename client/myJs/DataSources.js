// ================= SCHOOL UNITS DATA SOURCE ================= //
var totalLabs, totalLabsByPageSize, totalLabsByCat, filters, path; 

var schoolUnitsDS=  new kendo.data.DataSource({
    transport: {
        read: {
            url: "api/school_units",
            type: "GET",
            data: {
                //"pagesize": 50
                //"sort_mode": "DESC",
                //"sort_field": "name"
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
                if (typeof data.sort !== 'undefined' && typeof data.sort[0] !== 'undefined') {
                    var sortingNormalizedFilter = {};
                    //var sortingFilter = data.sort[0];
                    sortingNormalizedFilter["sort_field"] = data.sort[0].field;
                    sortingNormalizedFilter["sort_mode"] = data.sort[0].dir.toUpperCase();
                    $.extend(data, sortingNormalizedFilter);
                    delete data.sort;
                }
            }
            data['pagesize'] = data.pageSize;
            
            data['state'] = "";

            if(data['checkbox_active'] !== undefined && data['checkbox_active'] === "on"){
                data['state'] = data['state'] + "1,";
            }
            if(data['checkbox_suspended'] !== undefined && data['checkbox_suspended'] === "on"){
                data['state'] = data['state'] + "2,";
            }
            if(data['checkbox_abolished'] !== undefined && data['checkbox_abolished'] === "on"){
                data['state'] = data['state'] + "3,";
            }
            if(data['state'] !== ""){
                data["state"]= data["state"].slice(0,-1);
            }else{
                data["state"]= "1";
            }

  
            data['lab_state'] = "";

            if(data['lab_checkbox_active'] !== undefined && data['lab_checkbox_active'] === "on"){
                data['lab_state'] = data['lab_state'] + "1,";
            }
            if(data['lab_checkbox_suspended'] !== undefined && data['lab_checkbox_suspended'] === "on"){
                data['lab_state'] = data['lab_state'] + "2,";
            }
            if(data['lab_checkbox_abolished'] !== undefined && data['lab_checkbox_abolished'] === "on"){
                data['lab_state'] = data['lab_state'] + "3,";
            }
            if(data['lab_state'] !== ""){
                data["lab_state"]= data["lab_state"].slice(0,-1);
            }else{
                data["lab_state"]= "1, 2, 3";
            }            
            
            
            delete data.pageSize;
            delete data.checkbox_active;
            delete data.checkbox_suspended;
            delete data.checkbox_abolished;
            delete data.lab_checkbox_active;
            delete data.lab_checkbox_suspended;
            delete data.lab_checkbox_abolished;
            
            filters = data; //for the "breadcrumb"
            return data;
        }
    },
    schema: {
        data: "data",
        total: "total"
    },
    pageSize: 25, //κάθε φορά που ο χρήστης επιλέγει άλλο pagesize από το Grid, γίνεται request στον server με παράμετρο την 1η σελίδα (page=1) και το επιλεχθέν pagesize
    serverPaging: true, //κάθε φορά που ο χρήστης επιλέγει άλλη σελίδα, γίνεται request στον server με παράμετρο τη συγκεκριμένη σελίδα (page) και το pagesize
    serverFiltering: true,
    serverSorting: true,
    //Fired when a remote service request is finished.
    requestEnd: function(e) {

        //e.response    Object                  The raw remote service response.
        //e.sender      kendo.data.DataSource   The data source instance which fired the event.
        //e.type        String                  The type of the request. Set to "create", "read", "update" or "destroy".

        //console.log("schoolUnitsGrid requestEnd event ", e);

        if (e.response.status === 200){
           
            if($('#search-btn').data('clicked')) {

                $('#search-btn').data('clicked', false);
                
                totalSchoolUnits = e.response.total;
                totalLabs = e.response.all_labs;
                totalLabsByCat = e.response.all_labs_by_type;

                //populate info-pane with data
                $("#total_units span").text(totalSchoolUnits);
                $("#total_labs span").text(totalLabs);         
                $("#sepehy-count span").text(totalLabsByCat["ΣΕΠΕΗΥ"]);
                $("#troxilato-count span").text(totalLabsByCat["ΤΡΟΧΗΛΑΤΟ"]);
                $("#tomea-count span").text(totalLabsByCat["ΕΤΠ"]);
                $("#gwnia-count span").text(totalLabsByCat["ΓΩΝΙΑ"]);        
                $("#diadrastiko-count span").text(totalLabsByCat["ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"]);
                //show info-pane
                $("#info-pane").toggle("blind", 500);

                
                //populate search-path with data
                if (typeof filters['region_edu_admin'] !== 'undefined' && filters['region_edu_admin'] !== ''){
                    $('.tag1').css("display", "inline");
                    $('#region-edu-admin-tag').text(filters['region_edu_admin']);
                }else{
                    $('.tag1').css("display", "none");
                };

                if (typeof filters['edu_admin'] !== 'undefined' && filters['edu_admin'] !== ''){
                    $('.tag2').css("display", "inline");
                    $('#edu-admin-tag').text(filters['edu_admin']);
                }else{
                    $('.tag2').css("display", "none");
                };
                
                if (typeof filters['transfer_area'] !== 'undefined' && filters['transfer_area'] !== ''){
                    $('.tag3').css("display", "inline");
                    $('#transfer-area-tag').text(filters['transfer_area']);
                }else{
                    $('.tag3').css("display", "none");
                };
                
                if (typeof filters['municipality'] !== 'undefined' && filters['municipality'] !== ''){
                    $('.tag4').css("display", "inline");
                    $('#municipality-tag').text(filters['municipality']);
                }else{
                    $('.tag4').css("display", "none");
                };
                
                if (typeof filters['name'] !== 'undefined' && filters['name'] !== ''){
                    $('.tag5').css("display", "inline");
                    $('#school-unit-name-tag').text(filters['name']);
                }else{
                    $('.tag5').css("display", "none");
                };
                
                if (typeof filters['school_unit_id'] !== 'undefined' && filters['school_unit_id'] !== ''){
                    $('.tag6').css("display", "inline");
                    $('#school-unit-id-tag').text(filters['school_unit_id']);
                }else{
                    $('.tag6').css("display", "none");
                };
                
                if (typeof filters['school_unit_type'] !== 'undefined' && filters['school_unit_type'] !== ''){
                    $('.tag7').css("display", "inline");
                    $('#school-unit-type-tag').text(filters['school_unit_type']);
                }else{
                    $('.tag7').css("display", "none");
                };
                
                if (typeof filters['education_level'] !== 'undefined' && filters['education_level'] !== ''){
                    $('.tag8').css("display", "inline");
                    $('#education-level-tag').text(filters['education_level']);
                }else{
                    $('.tag8').css("display", "none");
                };
                
                if (typeof filters['lab_id'] !== 'undefined' && filters['lab_id'] !== ''){
                    $('.tag9').css("display", "inline");
                    $('#lab-id-tag').text(filters['lab_id']);
                }else{
                    $('.tag9').css("display", "none");
                };
                
                if (typeof filters['lab_type'] !== 'undefined' && filters['lab_type'] !== ''){
                    $('.tag10').css("display", "inline");
                    $('#lab-type-tag').text(filters['lab_type']);
                }else{
                    $('.tag10').css("display", "none");
                };
                
                if (typeof filters['aquisition_source'] !== 'undefined' && filters['aquisition_source'] !== ''){
                    $('.tag11').css("display", "inline");
                    $('#aquisition-source-tag').text(filters['aquisition_source']);
                }else{
                    $('.tag11').css("display", "none");
                };

                if (typeof filters['lab_worker'] !== 'undefined' && filters['lab_worker'] !== ''){
                    $('.tag12').css("display", "inline");
                    $('#lab-worker-tag').text(filters['lab_worker']);
                }else{
                    $('.tag12').css("display", "none");
                };
                
                //show search-path
                $("#search-path-pane").toggle("blind", 500);
           } 
        }else{
            $("#search-error-pane").toggle("blind", 100);
        }
    }
});


//================================================================//
// ====================== PANE ΑΝΑΖΗΤΗΣΗΣ  =======================//
//================================================================//

// ================= REGION EDU EDMIN DATA SOURCE ================= //
var regionEduAdminsDS=  new kendo.data.DataSource({
    //type: "odata",
    serverFiltering: false,
    transport: {
        read: {
            url: "api/region_edu_admins",
            type: "GET",
            data: {
                //"pagesize": 12
            },
            dataType: "json"
        }
    },
    schema: {
        data: "data",
        total: "total_school_units"
    }
});

// ================= EDU EDMIN DATA SOURCE ================= //
var eduAdminsDS=  new kendo.data.DataSource({
    //type: "odata",
    serverFiltering: false,
    transport: {
        read: {
            url: "api/edu_admins",
            type: "GET",                                    
            data: {
                //"method": "GetEduAdmins"
            },
            dataType: "json"
        }
    },
    schema: {
        data: "data",
        total: "total_school_units"
    }
});

// ================= TRANSFER AREA DATA SOURCE ================= //
var transferAreasDS=  new kendo.data.DataSource({
     //type: "odata",
    serverFiltering: false,
    transport: {
        read: {
            url: "api/transfer_areas",
            type: "GET",
            data: {
                //"pagesize": 12
            },
            dataType: "json"
        }
    },
    schema: {
        data: "data",
        total: "total_school_units"
    }
});

// ================= MUNICIPALITIES DATA SOURCE ================= //
var municipalitiesDS=  new kendo.data.DataSource({
    //type: "odata",
    serverFiltering: false,
    transport: {
        read: {
            url: "api/municipalities",
            type: "GET",
            data: {
                //"pagesize": 12
            },
            dataType: "json"
        }
    },
    schema: {
        data: "data",
        total: "total_school_units"
    }
});

// ================= EDUCATION LEVELS DATA SOURCE ================= //
var educationLevelsDS=  new kendo.data.DataSource({
    //type: "odata",
    serverFiltering: false,
    transport: {
        read: {
            url: "api/education_levels",
            type: "GET",
            data: {
                //"pagesize": 12
            },
            dataType: "json"
        }
    },
    schema: {
        data: "data",
        total: "total_school_units"
    }
});

// ================= SCHOOL UNIT TYPES DATA SOURCE ================= //
var schoolUnitTypesDS=  new kendo.data.DataSource({
    //type: "odata",
    serverFiltering: false,
    transport: {
        read: {
            url: "api/school_unit_types",
            type: "GET",
            data: {
                //"pagesize": 12
                //education_level_id: "1,2"
            },
            dataType: "json"
        }
//        ,parameterMap: function(data, type) {
//            if (type === 'read'){
//                //if any education level is selected, filter school unit types accordingly
//                if($("#educationLevels").data("kendoMultiSelect").value()){
//                    data["education_level"] = ( $("#educationLevels").data("kendoMultiSelect").value()).toString();
//                }
//            }
//            return data;
//        }
    },
    schema: {
        data: "data",
        total: "total_school_units"
    }
});

// ================= LAB TYPES DATA SOURCE ================= //
var labTypesDS=  new kendo.data.DataSource({
    //type: "odata",
    serverFiltering: false,
    transport: {
        read: {
            url: "api/lab_types",
            type: "GET",
            data: {
                //"pagesize": 12
            },
            dataType: "json"
        }
    },
    schema: {
        data: "data",
        total: "total_school_units"
    }
});

// ================= AQUISITION SOURCES DATA SOURCE ================= //
var aquisitionSourcesDS=  new kendo.data.DataSource({
    //type: "odata",
    serverFiltering: false,
    transport: {
        read: {
            url: "api/aquisition_sources",
            type: "GET",
            data: {
                //"pagesize": 12
            },
            dataType: "json"
        }
    },
    schema: {
        data: "data",
        total: "total_school_units",
        model:{
            id: "name"
        }
    },
    filter: { field: "used", operator: "neq", value: true }
});


//////////////////////////////////////////////////////////////////////////////////////////////////////////


// ================= AQUISITION SOURCES DATA SOURCE ================= //
var aquisitionSourcesDS2=  new kendo.data.DataSource({
    //type: "odata",
    serverFiltering: true,
    transport: {
        read: {
            url: "api/aquisition_sources",
            type: "GET",
            data: {
                //"pagesize": 12
            },
            dataType: "json"
        }
    },
    schema: {
        data: "data",
        total: "total_school_units",
        model:{
            id:"name"
        }
    },
    filter: { field: "used", operator: "neq", value: true }
});

// ================= LAB RESPONSIBLES DATA SOURCE - lab detail row ================= //
var labWorkersDS=  new kendo.data.DataSource({
    //type: "odata",
    serverFiltering: true,
    transport: {
        read: {
            url: "api/workers",
            type: "GET",
            data: {
                //"pagesize": 12,
            },
            dataType: "json"
        },
        parameterMap: function(data, type) {
            if (type === 'read') {
                data["worker"] = data.filter.filters[0].value;
                delete data.filter;
            }
            return data;
        }
    },
    schema: {
        data: function(response) {
                for (var i = 0; i < response.data.length; ++i) {
                    response.data[i].fullname = response.data[i].lastname + " " + response.data[i].firstname + ", ΑΜ " + response.data[i].registry_no;
                }
                return response.data;
        },
        total: "total"//,
//        model:{
//            id:"name"
//        }
    }
});

// ================= CIRCUITS DATA SOURCE - lab creation ================= //
var circuitsDS=  new kendo.data.DataSource({
    serverFiltering: true,
    transport: {
        read: {
            url: "api/circuits",
            type: "GET",
            data: {},
            dataType: "json"
        },    
        parameterMap: function(data, type) {
            if (type === 'read') {
                if (typeof data.filter !== 'undefined' && typeof data.filter.filters !== 'undefined') {
                    data["circuit"] = data.filter.filters[0].value;
                    delete data.filter;
                }
            }
            return data;
        }
    },
    schema: {
        data: function(response) {
                for (var i = 0; i < response.data.length; ++i) {
                    response.data[i].fulltemplate = response.data[i].relation_type_name + ", αρ. κυκλ. " + response.data[i].phone_number + ", " + response.data[i].school_unit_id;
                }
                return response.data;
        },
        total: "total"
    }
});

// ================= EQUIPMENT TYPES DATA SOURCE ================= //
var equipmentTypesDS=  new kendo.data.DataSource({
    //type: "odata",
    //serverFiltering: true,
    transport: {
        read: {
            url: "api/equipment_types",
            type: "GET",
            data: {
                //"equipment_category": 1
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
    filter: { field: "used", operator: "neq", value: true }
});


var statisticVariableDS =   new kendo.data.DataSource({
  data: [
    { name: "πλήθος εργαστηρίων" },
    { name: "πλήθος εξοπλισμού" },
    { name: "πλήθος υπευθύνων" }
  ]   
});

var reportingElementDS =   new kendo.data.DataSource({
  data: [
    { name: "διατάξεις Η/Υ", tag: "labs" },
    { name: "υπεύθυνοι Η/Υ", tag: "lab_workers" },
    { name: "σχολικές μονάδες", tag: "school_units" }
  ]   
});


var axisXDS =   new kendo.data.DataSource({
  data: [
    { name: "Περιφερειακή Διεύθυνση Εκπαίδευσης" },
    { name: "Διεύθυνση Εκπαίδευσης" },
    { name: "Δήμος" },
    { name: "Βαθμίδα" },
    { name: "Τύπος Σχολικής Μονάδας" },
    { name: "Κατάσταση Σχολικής Μονάδας" },
    { name: "Κατάσταση Διάταξης Η/Υ" },
    { name: "Βαθμολογία Διάταξης Η/Υ" },
    { name: "Τύπος Διάταξης Η/Υ" },
    { name: "Πηγή Χρηματοδότησης Διάταξης Η/Υ" },
    { name: "Έτος Δημιουργίας Διάταξης Η/Υ" }
  ],
  schema : {
      model : {
          id : "name"
      }
  },
  filter: { field: "used", operator: "neq", value: true }
});

var axisYDS =   new kendo.data.DataSource({
  data: [
    { name: "Περιφερειακή Διεύθυνση Εκπαίδευσης" },
    { name: "Διεύθυνση Εκπαίδευσης" },
    { name: "Δήμος" },
    { name: "Βαθμίδα" },
    { name: "Τύπος Σχολικής Μονάδας" },
    { name: "Κατάσταση Σχολικής Μονάδας" },
    { name: "Κατάσταση Διάταξης Η/Υ" },
    { name: "Βαθμολογία Διάταξης Η/Υ" },
    { name: "Τύπος Διάταξης Η/Υ" },
    { name: "Πηγή Χρηματοδότησης Διάταξης Η/Υ" },
    { name: "Έτος Δημιουργίας Διάταξης Η/Υ" }
  ],
  schema : {
      model : {
          id : "name"
      }
  },
  filter: { field: "used", operator: "neq", value: true }
});

var axisZDS =   new kendo.data.DataSource({
  data: [
    { name: "Περιφερειακή Διεύθυνση Εκπαίδευσης" },
    { name: "Διεύθυνση Εκπαίδευσης" },
    { name: "Δήμος" },
    { name: "Βαθμίδα" },
    { name: "Τύπος Σχολικής Μονάδας" },
    { name: "Κατάσταση Σχολικής Μονάδας" },
    { name: "Κατάσταση Διάταξης Η/Υ" },
    { name: "Βαθμολογία Διάταξης Η/Υ" },
    { name: "Τύπος Διάταξης Η/Υ" },
    { name: "Πηγή Χρηματοδότησης Διάταξης Η/Υ" },
    { name: "Έτος Δημιουργίας Διάταξης Η/Υ" }
  ],
  schema : {
      model : {
          id : "name"
      }
  },
  filter: { field: "used", operator: "neq", value: true }
});

var ratingDS =   new kendo.data.DataSource({
  data: [
    { id: "1", name: "ανεπαρκώς εξοπλισμένο"},
    { id: "2", name: "μέτρια εξοπλισμένο"},
    { id: "3", name: "επαρκως εξοπλισμένο"},
    { id: "4", name: "καλώς εξοπλισμένο"},
    { id: "5", name: "άριστα εξοπλισμένο"}
  ],
  schema : {
      model : {
          id : "id"
      }
  }
});