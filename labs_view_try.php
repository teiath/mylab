<!DOCTYPE html>
<div id="labs_container"> <!--grid-->

    <?php
        
        /* grid column templates */
        require_once('client/pages/js/Templates/grid_column_template/labsViewRatingColumnTemplate.html');
        require_once('client/pages/js/Templates/grid_column_template/labsViewLabStateColumnTemplate.html');
        /* list view templates */
        require_once('client/pages/js/Templates/list_view_template/generalInfoTemplate.html');
        require_once('client/pages/js/Templates/list_view_template/editGeneralInfoTemplate.html');
        require_once('client/pages/js/Templates/list_view_template/ratingTemplate.html');
        require_once('client/pages/js/Templates/list_view_template/editRatingTemplate.html');
        /* grid toolbar templates */
        require_once('client/pages/js/Templates/grid_toolbar_template/labToolbarTemplate_labs_view.html');
        require_once('client/pages/js/Templates/grid_toolbar_template/labDetailsLabWorkersToolbarTemplate.html');
        /* grid detail templates */
        require_once('client/pages/js/Templates/grid_detail_template/labDetailsTemplate.html');
        /* grid toolbar command popup dialog templates */
        require_once('client/pages/js/Templates/grid_toolbar_command_popup_dialog_template/labCreateTemplate.html');
        require_once('client/pages/js/Templates/grid_toolbar_command_popup_dialog_template/labsColumnSelectionTemplate.html');
        /* grid column command popup dialog templates */
        require_once('client/pages/js/Templates/grid_column_command_popup_dialog_template/deleteLabDetailsTemplate.html');
        require_once('client/pages/js/Templates/grid_column_command_popup_dialog_template/labTransitTemplate.html');
        require_once('client/pages/js/Templates/grid_column_command_popup_dialog_template/labSubmitTemplate.html');
        require_once('client/pages/js/Templates/grid_column_command_popup_dialog_template/labRemoveTemplate.html');
        require_once('client/pages/js/Templates/grid_column_command_popup_dialog_template/removeLabWorkerTemplate.html');
        require_once('client/pages/js/Templates/grid_column_command_popup_dialog_template/disableLabWorkerTemplate.html');
        /* notification templates */
        require_once('client/pages/js/Templates/notification_template/errorNotificationTemplate.html');
        require_once('client/pages/js/Templates/notification_template/successNotificationTemplate.html');
        
    ?>
   
    <!--transition dialog-->
    <div id="transition_dialog"></div>
    
    <!--submit dialog-->
    <div id="submit_dialog"></div>

    <!--remove dialog-->
    <div id="remove_dialog"></div>
    
    <!--disable lab worker dialog-->
    <div id="disable_lab_worker_dialog"></div>

    <!--delete lab worker dialog-->
    <div id="remove_lab_worker_dialog"></div>    
    
    <!--column selection dialog-->
    <div id="labs_column_selection_dialog"></div>
    
    <!--delete lab equipment dialog-->
    <div id="delete_lab_details_dialog"></div>

    <!--transition notification-->
    <span id="notification" style="display:none;"></span>

    <!-- grid element -->
    <div id="general-container" class="container">      
        <div class="row">          
            <div class="col-md-12">        
                <div    id="labs_view"
                        data-role="grid"
                        data-bind="source: labs, visible: isVisible, events: {edit: createLab, save: saveLab, dataBound: dataBound, dataBinding: dataBinding}"
                        data-detail-init="LabsViewVM.detailInit"
                        data-detail-template= 'lab_details_template'
                        data-selectable="row"
                        data-scrollable= "true"
                        data-resizable= "true"
                        data-sortable= "{'allowUnsort': false}"
                        data-pageable="{ 'pageSizes': [5, 10, 15, 20, 25, 30, 50], 
                                         'messages':  { 'display': '{0}-{1} από {2} Διατάξεις Η/Υ', 
                                                        'empty': 'Δεν βρέθηκαν Διατάξεις Η/Υ',
                                                        'itemsPerPage': 'Διατάξεις Η/Υ ανά σελίδα', 
                                                        'first': 'μετάβαση στην πρώτη σελίδα',
                                                        'previous': 'μετάβαση στην προηγούμενη σελίδα',
                                                        'next': 'μετάβαση στην επόμενη σελίδα',
                                                        'last': 'μετάβαση στην τελευταία σελίδα' }}"
                        data-editable="{ 'mode' : 'popup', 'template': $('#lab_create_template').html()}"
                        data-toolbar="[{ 'template' : $('#lab_toolbar_template_labs_view').html()  }]"
                        data-columns="[{ 'field': 'lab_id', 'title':'Κωδικός Διάταξης Η/Υ', 'width':'140px', 'hidden' : true},
                                       { 'field': 'lab_name', 'title':'Ονομασία', 'width':'460px'},
                                       { 'field': 'lab_type', 'title':'Τύπος', 'width':'150px', 'hidden' : true},
                                       { 'field': 'lab_state', 'title':'Λειτουργική Κατάσταση', 'template' : $('#labs_view_lab_state_column_template').html(), 'width':'150px'},
                                       { 'field': 'rating', 'title':'Αξιολόγηση', 'template' : $('#labs_view_rating_column_template').html(), 'width':'95px'},
                                       { 'field': 'positioning', 'title':'Τοποθεσία', 'width':'180px', 'hidden' : true},
                                       { 'field': 'lab_special_name', 'title':'Ειδική Ονομασία', 'width':'180px', 'hidden' : true},
                                       { 'field': 'creation_date', 'title':'Ημερομηνία Δημιουργίας', 'width':'160px', 'hidden' : true},
                                       { 'field': 'last_updated', 'title':'Τελευταία Ενημέρωση', 'width':'145px'},
                                       { 'field': 'created_by', 'title':'Δημιουργία από', 'width':'150px', 'hidden' : true},
                                       { 'command': [ {'text':' Ενεργοποίηση', 'click':LabsViewVM.transitLab, 'name':'activate', 'imageClass': 'fa fa-check'},
                                                      {'text':' Αναστολή', 'click':LabsViewVM.transitLab, 'name':'suspend', 'imageClass': 'fa fa-clock-o'},
                                                      {'text':' Κατάργηση', 'click':LabsViewVM.transitLab, 'name':'abolish', 'imageClass': 'fa fa-ban'},
                                                      {'text':' Οριστική Υποβολή', 'click':LabsViewVM.submitLab, 'name':'submit', 'imageClass': 'fa fa-floppy-o'},
                                                      {'text':' Διαγραφή', 'click':LabsViewVM.removeLab, 'name':'remove', 'imageClass': 'fa fa-times'}], 'title': 'Ενέργειες', 'width':'240px', 'hidden': LabsViewVM.actionsColumnVisible() }
                                        ]">
                </div>
            </div>
        </div>
    </div>

</div>


<!--'template' : $('#labs_view_lab_state_column_template').html(),-->

<!--{ 'command': [{'text':'Οριστική Υποβολή', 'click':LabsViewVM.submitDraftLab, 'name':'submit'}, 
              {'text':'Διαγραφή', 'click':LabsViewVM.removeDraftLab, 'name':'remove'}], 
              'title': 'Ενέργειες', 
              'width':'270px', 
              'hidden': LabsViewVM.hideLabEditColumn() 
} 

{ 'command': [{'name':'commands', 'template': $('#labs_grid_command_column_template').html()}], 'title': 'Ενέργειες', 'width':'270px' }

-->


<!--

{ 'command': [{'name':'commands', 'template': $('#labs_grid_command_column_template').html()}], 'title': 'Ενέργειες', 'width':'270px' }

    { 'command': [{'text':'Ενεργοποίηση', 'click':LabsViewVM.transitLab, 'name':'activate'},
                  {'text':'Αναστολή', 'click':LabsViewVM.transitLab, 'name':'suspend', },
                  {'text':'Κατάργηση', 'click':LabsViewVM.transitLab, 'name':'abolish'},
                  {'text':'Οριστική Υποβολή', 'click':LabsViewVM.submitLab, 'name':'submit'},
                  {'text':'Διαγραφή', 'click':LabsViewVM.removeLab, 'name':'remove'}], 'title': 'Ενέργειες', 'width':'500px', 'hidden': LabsViewVM.actionsColumnVisible() }

-->