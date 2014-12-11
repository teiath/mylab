<!DOCTYPE html>
<div id="lab_workers_container"> <!--grid-->

    <?php
        
        /* notification templates */
        require_once('client/pages/js/Templates/notification_template/errorNotificationTemplate.html');
        require_once('client/pages/js/Templates/notification_template/successNotificationTemplate.html');
        /* grid toolbar templates */
        require_once('client/pages/js/Templates/grid_toolbar_template/labToolbarTemplate_lab_workers_view.html');
        require_once('client/pages/js/Templates/grid_toolbar_template/labToolbarTemplate_lab_workers_labs.html');
        /* grid detail templates */
        require_once('client/pages/js/Templates/grid_detail_template/labWorkerDetailsTemplate.html');
        /* grid toolbar command popup dialog templates */
        require_once('client/pages/js/Templates/grid_toolbar_command_popup_dialog_template/labWorkersColumnSelectionTemplate.html');
        require_once('client/pages/js/Templates/grid_column_template/labWorkersViewFullnameColumnTemplate.html');
        /* grid column command popup dialog templates */
        require_once('client/pages/js/Templates/grid_column_command_popup_dialog_template/schoolUnitContactDetailsTemplate.html');
        
    ?>
  

    <!--column selection dialog-->
    <div id="lab_workers_column_selection_dialog"></div>

    <!-- grid element -->
    <div id="general-container" class="container">      
        <div class="row">          
            <div class="col-md-12">        
                <div    id="lab_workers_view"
                        data-role="grid"
                        data-bind="source: lab_workers, visible: isVisible"
                        data-detail-init="LabWorkersViewVM.detailInit"
                        data-detail-template= 'lab_worker_details_template'
                        data-selectable="row"
                        data-scrollable= "true"
                        data-resizable= "true"
                        data-sortable= "{'allowUnsort': false}"
                        data-pageable="{ 'pageSizes': [5, 10, 15, 20, 25, 30, 50], 
                                         'messages':  { 'display': '{0}-{1} από {2} Υπεύθυνοι Διατάξεων Η/Υ', 
                                                        'empty': 'Δεν βρέθηκαν Υπεύθυνοι Διατάξεων Η/Υ',
                                                        'itemsPerPage': 'Υπεύθυνοι Διατάξεων Η/Υ ανά σελίδα', 
                                                        'first': 'πρώτη σελίδα',
                                                        'previous': 'προηγούμενη σελίδα',
                                                        'next': 'επόμενη σελίδα',
                                                        'last': 'τελευταία σελίδα' }}"
                        data-toolbar="[{ 'template' : $('#lab_toolbar_template_lab_workers_view').html()  }]"
                        data-columns="[{ 'field': 'lastname', 'title': 'Ονοματεπώνυμο', 'template' : $('#lab_workers_view_fullname_column_template').html(), 'width':'200px'},
                                       { 'field': 'fathername', 'title':'Όνομα Πατρός', 'width':'100px'},
                                       { 'field': 'registry_no', 'title':'Αρ. Μητρώου', 'width':'100px'},
                                       { 'field': 'worker_uid', 'title':'Ldap UID', 'width':'120px'},
                                       { 'field': 'email', 'title':'E-mail', 'width':'170px'},
                                       { 'field': 'worker_specialization_name', 'title':'Κλάδος', 'width':'70px'}]"
                    >
                </div>
            </div>
        </div>
    </div>

</div>