<!DOCTYPE html>
<div id="labs_container"> <!--grid-->

    <?php
        
        require_once('client/pages/js/Templates/labsViewRatingColumnTemplate.html');
        require_once('client/pages/js/Templates/generalInfoTemplate.html');
        require_once('client/pages/js/Templates/editGeneralInfoTemplate.html');
        require_once('client/pages/js/Templates/ratingTemplate.html');
        require_once('client/pages/js/Templates/editRatingTemplate.html');
        //require_once('client/pages/js/Templates/createLabServedOnlineTemplate.html');
        require_once('client/pages/js/Templates/labCreateTemplate.html');
        //require_once('client/pages/js/Templates/labToolbarTemplate.html');
        require_once('client/pages/js/Templates/labsColumnSelectionTemplate.html');
        require_once('client/pages/js/Templates/labToolbarTemplate_labs_view.html');
        require_once('client/pages/js/Templates/labDetailsTemplate.html');
        require_once('client/pages/js/Templates/labTransitTemplate.html');
        require_once('client/pages/js/Templates/errorNotificationTemplate.html');
        require_once('client/pages/js/Templates/successNotificationTemplate.html');
        require_once('client/pages/js/Templates/labDetailsLabWorkersToolbarTemplate.html');
        require_once('client/pages/js/Templates/disableLabWorkerTemplate.html');
        
    ?>

    <!--transition dialog-->
    <div id="transition_dialog"></div>
    
    <!--disable lab worker dialog-->
    <div id="disable_lab_worker_dialog"></div>
    
    <!--column selection dialog-->
    <div id="labs_column_selection_dialog"></div>
    
    <!--transition notification-->
    <span id="notification" style="display:none;"></span>

    <!-- grid element -->
    <div id="general-container" class="container">      
        <div class="row">          
            <div class="col-md-12">        
                <div    id="labs_view"
                        data-role="grid"
                        data-bind="source: labs, visible: isVisible, events: {edit: createLab, dataBound: dataBoundLab}"
                        data-detail-init="LabsViewVM.detailInit"
                        data-detail-template= 'lab_details_template'
                        data-selectable="row"
                        data-scrollable= "true"
                        data-resizable= "true"
                        data-sortable= "{'allowUnsort': false}"
                        data-pageable="{ 'pageSizes': [5, 10, 15, 20, 25, 30, 50], 
                                         'messages':  { 'display': '{0}-{1} από {2} διατάξεις Η/Υ', 
                                                        'empty': 'Δεν βρέθηκαν διατάξεις Η/Υ',
                                                        'itemsPerPage': 'διατάξεις Η/Υ ανά σελίδα', 
                                                        'first': 'μετάβαση στην πρώτη σελίδα',
                                                        'previous': 'μετάβαση στην προηγούμενη σελίδα',
                                                        'next': 'μετάβαση στην επόμενη σελίδα',
                                                        'last': 'μετάβαση στην τελευταία σελίδα' }}"
                        data-editable="{ 'mode' : 'popup', 'template': $('#lab_create_template').html()}"
                        data-toolbar="[{ 'template' : $('#lab_toolbar_template_labs_view').html()  }]"
                        data-columns="[{ 'field': 'lab_id', 'title':'Κωδικός', 'width':'65px', 'hidden' : true},
                                       { 'field': 'lab_name', 'title':'Ονομασία', 'width':'440px'},
                                       { 'field': 'lab_type', 'title':'Τύπος', 'width':'150px', 'hidden' : true},
                                       { 'field': 'lab_state', 'title':'Κατάσταση', 'width':'100px'},
                                       { 'field': 'rating', 'title':'Βαθμολογία', 'template' : $('#labs_view_rating_column_template').html(), 'width':'85px'},
                                       { 'field': 'positioning', 'title':'Τοποθεσία', 'width':'180px', 'hidden' : true},
                                       { 'field': 'lab_special_name', 'title':'Ειδική Ονομασία', 'width':'180px', 'hidden' : true},
                                       { 'field': 'creation_date', 'title':'Ημερομηνία Δημιουργίας', 'width':'150px', 'hidden' : true},
                                       { 'field': 'last_updated', 'title':'Τελευταία Ενημέρωση', 'width':'150px'},
                                       { 'field': 'created_by', 'title':'Δημιουργία από', 'width':'130px', 'hidden' : true},
                                       { 'field': 'lab_source', 'title':'Πηγή', 'width':'130px', 'hidden' : true},
                                       { 'command': [{'text':'Ενεργοποίηση', 'click':LabsViewVM.transitLab, 'name':'activate'}, 
                                                     {'text':'Αναστολή', 'click':LabsViewVM.transitLab, 'name':'suspend'},
                                                     {'text':'Κατάργηση', 'click':LabsViewVM.transitLab, 'name':'abolish'}], 'title': 'ενέργειες', 'width':'270px', 'hidden': LabsViewVM.hideLabTransitColumn() }
                                      ]">
                </div>
            </div>
        </div>
    </div>

</div>