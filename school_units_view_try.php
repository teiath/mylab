<!DOCTYPE html>
<div id="school_units_container" >

    <?php
        
        require_once('client/pages/js/Templates/generalInfoTemplate.html');
        require_once('client/pages/js/Templates/editGeneralInfoTemplate.html');
        require_once('client/pages/js/Templates/ratingTemplate.html');
        require_once('client/pages/js/Templates/editRatingTemplate.html');

        require_once('client/pages/js/Templates/schoolUnitsColumnSelectionTemplate.html');
        require_once('client/pages/js/Templates/labToolbarTemplate_school_units_view.html');
        
        require_once('client/pages/js/Templates/labCreateTemplate.html');
        require_once('client/pages/js/Templates/labToolbarTemplate_school_unit_labs.html');
        require_once('client/pages/js/Templates/labDetailsTemplate.html');
        require_once('client/pages/js/Templates/labTransitTemplate.html');

        require_once('client/pages/js/Templates/schoolUnitContactDetailsTemplate.html');
        require_once('client/pages/js/Templates/schoolUnitDetailsTemplate.html');

        require_once('client/pages/js/Templates/errorNotificationTemplate.html');
        require_once('client/pages/js/Templates/successNotificationTemplate.html');
        require_once('client/pages/js/Templates/schoolUnitsViewSchoolUnitStateColumnTemplate.html');
        
    ?> 

    <!--contact details dialog-->
    <div id="contact_details_dialog"></div>

    <!--column selection dialog-->
    <div id="school_units_column_selection_dialog"></div>

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
                        data-scrollable= "true"
                        data-resizable= "true"
                        data-sortable= "{'allowUnsort': false}"
                        data-pageable="{ 'pageSizes': [5, 10, 15, 20, 25, 30, 50], 
                                         'messages':  { 'display': '{0}-{1} από {2} Σχολικές Μονάδες', 
                                                        'empty': 'Δεν βρέθηκαν Σχολικές Μονάδες',
                                                        'itemsPerPage': 'Σχολικές Μονάδες ανά σελίδα', 
                                                        'first': 'μετάβαση στην πρώτη σελίδα',
                                                        'previous': 'μετάβαση στην προηγούμενη σελίδα',
                                                        'next': 'μετάβαση στην επόμενη σελίδα',
                                                        'last': 'μετάβαση στην τελευταία σελίδα' }}"
                        data-toolbar="[{ 'template' : $('#lab_toolbar_template_school_units_view').html()  }]"
                        data-columns="[{ 'field': 'school_unit_id', 'title':'Κωδικός ΜΜ', 'width':'90px'},
                                       { 'field': 'school_unit_name', 'title':'Ονομασία', 'width':'350px'},
                                       { 'field': 'school_unit_special_name', 'title':'Ειδική Ονομασία', 'width':'250px', 'hidden': true},
                                       { 'field': 'school_unit_type', 'title':'Τύπος', 'width':'115px', 'hidden': true},
                                       { 'field': 'education_level', 'title':'Βαθμίδα', 'width':'115px', 'hidden': true},
                                       { 'field': 'school_unit_state', 'title':'Λειτουργική Κατάσταση', 'template' : $('#school_units_view_school_unit_state_column_template').html(), 'width':'150px'},
                                       { 'field': 'region_edu_admin', 'title':'Περιφερειακή Διεύθυνση Εκπαίδευσης', 'width':'250px', 'hidden': true},
                                       { 'field': 'edu_admin', 'title':'Διεύθυνση Εκπαίδευσης', 'width':'250px'},
                                       { 'field': 'transfer_area', 'title':'Περιοχή Μετάθεσης', 'width':'200px', 'hidden': true},
                                       { 'field': 'prefecture', 'title':'Περιφερειακή Ενότητα', 'width':'200px', 'hidden': true},
                                       { 'field': 'municipality', 'title':'Δήμος', 'width':'200px', 'hidden': true},
                                       { 'field': 'phone_number', 'title':'Τηλέφωνο', 'width':'150px', 'hidden': true},
                                       { 'field': 'fax_number', 'title':'Φαξ', 'width':'150px', 'hidden': true},
                                       { 'field': 'email', 'title':'E-mail', 'width':'250px', 'hidden': true},
                                       { 'field': 'street_address', 'title':'Διεύθυνση', 'width':'350px', 'hidden': true},
                                       { 'field': 'postal_code', 'title':'ΤΚ', 'width':'100px', 'hidden': true},
                                       { 'field': 'last_update', 'title':'Τελευταία Ανανέωση', 'width':'150px'},
                                       { 'command': [{'text':'', 'className': 'fa fa-info', 'click':SchoolUnitsViewVM.showContactDetails, 'name':'contactDetails'}],'width':'35px'}]">
                </div>
            </div>
        </div>
    </div>

</div>