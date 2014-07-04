<?php 

//psd user authentication to front-end

require_once ('server/system/config.php');
require_once ('server/libs/phpCAS/CAS.php');

if(!isset($casOptions["NoAuth"]) || $casOptions["NoAuth"] != true) {
    if(isset($_GET['logout']) && $_GET['logout'] == 'true') {
        phpCAS::logout();
        exit();
    } else {
        // initialize phpCAS using SAML
        phpCAS::client(SAML_VERSION_1_1,$casOptions["Url"],$casOptions["Port"],'');
        // no SSL validation for the CAS server, only for testing environments
        phpCAS::setNoCasServerValidation();
        // handle backend logout requests from CAS server
        phpCAS::handleLogoutRequests(array($casOptions["Url"]));
        // force CAS authentication
        if (!phpCAS::checkAuthentication())
          phpCAS::forceAuthentication();
        // at this step, the user has been authenticated by the CAS server and the user's login name can be read with //phpCAS::getUser(). for this test, simply print who is the authenticated user and his attributes.
        $user = phpCAS::getAttributes();
    
        //var_dump($user['title']);//die();
    }
} 


$user['backendUsername'] = $frontendOptions['backendUsername'];
$user['backendPassword'] = $frontendOptions['backendPassword'];

?>

<!DOCTYPE html>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <?php require_once('includes.html');?>
        
        <script>
                       
            $(document).ready(function() {
            
                baseURL = "http://mmsch.teiath.gr/mylab/api/";

                //BINDINGS
                kendo.bind($("#labs_container"), LabsViewVM);
                kendo.bind($("#labs_container").find(".k-grid-toolbar"), LabsViewVM);
                kendo.bind($("#labs_view").find(".k-grid-toolbar>.export_to_xlsx"), SearchVM); //bind labs view toolbar 'export to xlsx button' to SearchVM
                kendo.bind($("#labs_view").find(".k-grid-toolbar>.lab_grid_columns_btn"), LabsViewVM);
                kendo.bind($("#labs_view").find(".k-grid-toolbar>.lab_refresh_btn"), LabsViewVM);
                
                kendo.bind($("#school_units_container"), SchoolUnitsViewVM);
                kendo.bind($("#school_units_view").find(".k-grid-toolbar>.export_to_xlsx"), SearchVM); // bind school units view toolbar 'export to xlsx button' to SearchVM
                kendo.bind($("#school_units_view").find(".k-grid-toolbar>.school_unit_grid_columns_btn"), SchoolUnitsViewVM);
                kendo.bind($("#school_units_view").find(".k-grid-toolbar>.school_unit_refresh_btn"), SchoolUnitsViewVM);
                
                
                kendo.bind($("#search-container"), SearchVM);
                kendo.bind($("#switch_view"), LabsViewVM);
                
                //NOTIFICATIONS
                notification = $("#notification").kendoNotification({
                    position: {
                        pinned: true,
                        top: 70,
                        right: 30
                    },
                    allowHideAfter: 2000,
                    autoHideAfter: 7000, //0
                    hideOnClick: true,
                    stacking: "down",
                    //button: true, //??? γιατι δεν παίζει?
                    templates: [{
                        type: "error",
                        template: $("#errorTemplate").html()
                    }, {
                        //type: "upload-success",
                        type: "success",
                        template: $("#successTemplate").html()
                    }]

                }).data("kendoNotification");
                
                //SCROLL-TOP
                //depending on the .scrollTop() value fade in or out the scroll-to-top img
                $(window).scroll(function(){
                    if ($(this).scrollTop() > 100) {
                        $('.scrollup').fadeIn();
                    } else {
                        $('.scrollup').fadeOut();
                    }
                });
                // scroll to top
                $('.scrollup').click(function(){
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    return false;
                });
                
                //reset radio btn to labs view
                $('#switch_to_labs_view_btn').attr('checked',true);
                $('#switch_to_school_units_view_btn').attr('checked',false);
                
                //index holds thr grid's row index in school units view, in order to expand it after lab creation
                index= null;
                searchParameters = [];
                
            });
            
        </script>
        
    </head>
    
    <body>
        
        <?php 
                require_once('navigation_bar.php'); //navigation bar
        ?>
        <div style='height:90px'> </div>    
        <?php
                $search_xls = array("ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", "ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", "ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ", "ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ");
                $edit_lab_details = array("ΥΠΕΥΘΥΝΟΣ ΣΧΟΛΙΚΟΥ ΕΡΓΑΣΤΗΡΙΟΥ ΣΕΠΕΗΥ", "ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ");
                $edit_lab_worker = array("ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ");
                $transit_lab = array("ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ");
                $create_lab = array("ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ");
                
                //if(in_array($user['title'], $search_xls)){ require_once('search.html'); } //search pane
                require_once('search.html'); //search pane
                require_once('switch_views.html'); //switch views button
                require_once('labs_view_try.php'); //labs view
                require_once('school_units_view_try.php'); //school units view
        ?>
        <a href="#" class="scrollup">Scroll</a>
    </body>
</html>


<script>

    var search_xls = JSON.parse(atob("<?php echo base64_encode(json_encode($search_xls)); ?>"));
    var edit_lab_details = JSON.parse(atob("<?php echo base64_encode(json_encode($edit_lab_details)); ?>"));
    var edit_lab_worker = JSON.parse(atob("<?php echo base64_encode(json_encode($edit_lab_worker)); ?>"));
    var transit_lab = JSON.parse(atob("<?php echo base64_encode(json_encode($transit_lab)); ?>"));
    var create_lab = JSON.parse(atob("<?php echo base64_encode(json_encode($create_lab)); ?>"));

//    console.log("search_xls: ", search_xls);
//    console.log("edit_lab_details: ", edit_lab_details);
//    console.log("edit_lab_worker: ", edit_lab_worker);
//    console.log("transit_lab: ", transit_lab);
//    console.log("create_lab: ", create_lab);

</script>
