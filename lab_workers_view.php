<!DOCTYPE html>
<div id="lab_workers_container"> <!--grid-->

    <?php
        
        /* notification templates */
        require_once('client/pages/js/Templates/notification_template/errorNotificationTemplate.html');
        require_once('client/pages/js/Templates/notification_template/successNotificationTemplate.html');
        
    ?>
  

    <!--transition notification-->
    <span id="notification" style="display:none;"></span>

    <!-- grid element -->
    <div id="general-container" class="container">      
        <div class="row">          
            <div class="col-md-12">        
                <div    id="lab_workers_view"
                        data-role="grid"
                        data-bind="source: lab_workers, visible: isVisible"
                        data-detail-init="LabsViewVM.detailInit"
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
                        data-columns="[{ 'field': 'worker_id', 'title':'Κωδικός', 'width':'150px'},
                                       { 'field': 'firstname', 'title':'Όνομα', 'width':'150px'},
                                       { 'field': 'lastname', 'title':'Επώνυμο', 'width':'150px'},
                                       { 'field': 'fathername', 'title':'Όνομα Πατρός', 'width':'150px'},
                                       { 'field': 'worker_registry_no', 'title':'Αρ. Μητρώου', 'width':'95px'},
                                       { 'field': 'tax_number', 'title':'ΑΦΜ', 'width':'100px',},
                                       { 'field': 'sex', 'title':'Φύλο', 'width':'100px', },
                                       { 'field': 'specialization_code_name', 'title':'Κλάδος', 'width':'100px'}]"
                    >
                </div>
            </div>
        </div>
    </div>

</div>