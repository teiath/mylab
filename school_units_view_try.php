<!DOCTYPE html>
<div id="school_units_container" >

    <?php
        
        require_once('client/pages/js/Templates/generalInfoTemplate.html');
        require_once('client/pages/js/Templates/editGeneralInfoTemplate.html');
        require_once('client/pages/js/Templates/ratingTemplate.html');
        require_once('client/pages/js/Templates/editRatingTemplate.html');

        require_once('client/pages/js/Templates/labToolbarTemplate_school_units_view.html');
        
        require_once('client/pages/js/Templates/labCreateTemplate.html');
        require_once('client/pages/js/Templates/labToolbarTemplate.html');
        require_once('client/pages/js/Templates/labDetailsTemplate.html');
        require_once('client/pages/js/Templates/labTransitTemplate.html');

        require_once('client/pages/js/Templates/schoolUnitContactDetailsTemplate.html');
        require_once('client/pages/js/Templates/schoolUnitDetailsTemplate.html');

        require_once('client/pages/js/Templates/errorNotificationTemplate.html');
        require_once('client/pages/js/Templates/successNotificationTemplate.html');
    ?> 

    <!--contact details dialog-->
    <div id="contact_details_dialog"></div>

    <!--transition dialog-->
    <div id="transition_dialog"></div>

    <!--transition notification-->
    <span id="notification" style="display:none;"></span>

    <!-- grid element -->
    <div class="container">        
        <div class="row">          
            <div class="col-md-12">        
                <div    id="school_units_view"
                        data-role="grid"
                        data-bind="source: school_units, visible: isVisible"
                        data-detail-init="SchoolUnitsViewVM.detailInit"
                        data-detail-template= 'school_unit_details_template'
                        data-selectable="row"
                        data-scrollable= "false"
                        data-sortable= "{'allowUnsort': false}"
                        data-pageable="{ 'pageSizes': [15, 20, 25, 30, 50], 
                                         'messages':  { 'display': '{0}-{1} από {2} Σχολικές Μονάδες', 
                                                        'empty': 'Δεν βρέθηκαν Σχολικές Μονάδες',
                                                        'itemsPerPage': 'Σχολικές Μονάδες ανά σελίδα', 
                                                        'first': 'μετάβαση στην πρώτη σελίδα',
                                                        'previous': 'μετάβαση στην προηγούμενη σελίδα',
                                                        'next': 'μετάβαση στην επόμενη σελίδα',
                                                        'last': 'μετάβαση στην τελευταία σελίδα' }}"
                        data-toolbar="[{ 'template' : $('#lab_toolbar_template_school_units_view').html()  }]"
                        data-columns="[{ 'field': 'school_unit_id', 'title':'κωδικός Μητρώου', 'width':'10%'},
                                       { 'field': 'school_unit_name', 'title':'ονομασία', 'width':'20%'},
                                       { 'field': 'school_unit_special_name', 'title':'ειδικό όνομα', 'width':'20%'},
                                       { 'field': 'school_unit_type', 'title':'τύπος', 'width':'10%'},
                                       { 'field': 'education_level', 'title':'βαθμίδα', 'width':'10%'},
                                       { 'field': 'school_unit_state', 'title':'λειτουργική κατάσταση', 'width':'10%'},
                                       { 'field': 'region_edu_admin', 'title':'περ. διεύθυνση εκπαίδευσης', 'hidden':true},
                                       { 'field': 'edu_admin', 'title':'διεύθυνση εκπαίδευσης', 'width':'20%'},
                                       { 'field': 'transfer_area', 'title':'περιοχή μετάθεσης', 'hidden':true},
                                       { 'field': 'municipality', 'title':'δήμος', 'hidden':true},
                                       { 'field': 'prefecture', 'title':'νομός', 'hidden':true},
                                       { 'command': [{'text':'', 'className': 'fa fa-info', 'click':SchoolUnitsViewVM.showContactDetails, 'name':'contactDetails'}],'width':'5%'}]">
                </div>
            </div>
        </div>
    </div>

</div>