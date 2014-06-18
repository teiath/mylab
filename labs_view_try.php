<div id="labs_container"> <!--grid-->

    <?php
        //require_once('client/pages/js/Templates/createLabServedOnlineTemplate.html');
        require_once('client/pages/js/Templates/labCreateTemplate.html');
        //require_once('client/pages/js/Templates/labToolbarTemplate.html');
        require_once('client/pages/js/Templates/labToolbarTemplate_labs_view.html');
        require_once('client/pages/js/Templates/labDetailsTemplate.html');
        require_once('client/pages/js/Templates/labTransitTemplate.html');
        require_once('client/pages/js/Templates/errorNotificationTemplate.html');
        require_once('client/pages/js/Templates/successNotificationTemplate.html');
    ?>

    <!--transition dialog-->
    <div id="transition_dialog"></div>
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
                        data-scrollable= "false"
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
                        data-columns="[{ 'field': 'lab_id', 'title':'κωδικός', 'width':'5%', 'hidden' : true},
                                       { 'field': 'lab_name', 'title':'ονομασία', 'width':'40%'},
                                       { 'field': 'lab_type', 'title':'τύπος', 'width':'15%'},
                                       { 'field': 'lab_state', 'title':'κατάσταση', 'width':'10%'},
                                       { 'field': 'operational_rating', 'title':'λειτουργική βαθμολογία', 'width':'10%'},
                                       { 'command': [{'text':'Ενεργοποίηση', 'click':LabsViewVM.transitLab, 'name':'activate'}, 
                                                     {'text':'Αναστολή', 'click':LabsViewVM.transitLab, 'name':'suspend'},
                                                     {'text':'Κατάργηση', 'click':LabsViewVM.transitLab, 'name':'abolish'}], 'title': 'ενέργειες', 'width':'25%'}
                                      ]">
                </div>
            </div>
        </div>
    </div>

</div>