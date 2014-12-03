<?php 

    if (isset($_POST['authorized_user'])) {
        $authorized_user = $_POST['authorized_user']; //get authorized_user from toHome.php
    }else{
        $authorized_user = null; //page refreshed, so authorized_user is not taken from toHome.php
    }
    
    //ΠΣΔ user authentication to front-end
    require_once ('server/system/config.php');
    require_once ('server/libs/phpCAS/CAS.php');

    if(!isset($casOptions["NoAuth"]) || $casOptions["NoAuth"] != true) {
        //echo("eimai mesa stou index to if");
        // initialize phpCAS using SAML
        phpCAS::client(SAML_VERSION_1_1,$casOptions["Url"],$casOptions["Port"],'', false);
        // no SSL validation for the CAS server, only for testing environments
        phpCAS::setNoCasServerValidation();
        // handle backend logout requests from CAS server
        phpCAS::handleLogoutRequests(array($casOptions["Url"]));
        if(isset($_GET['logout']) && $_GET['logout'] == 'true') {
            phpCAS::logoutWithRedirectService($casOptions["LogoutURL"]);
            exit();
        } else {
            // force CAS authentication
            if (!phpCAS::checkAuthentication())
              phpCAS::forceAuthentication();
        }
        // at this step, the user has been authenticated by the CAS server and the user's login name can be read with //phpCAS::getUser(). for this test, simply print who is the authenticated user and his attributes.
        $user = phpCAS::getAttributes();
        //var_dump($user['title']);//die();
    }
    $user['backendAuthorizationHash'] = base64_encode($frontendOptions['frontendUsername'].':'.$frontendOptions['frontendPassword']);
        
//    echo "<pre>";
//    var_dump($user); exit();
//    echo "</pre>";
?>

<!DOCTYPE html>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="client/config.js"></script>
        <script src="client/libs/frameworks/telerik.kendoui.web.2014.1.318.open-source/js/jquery.js"></script>

        <script>
            
            baseURL = config.serverUrl;//"http://mmsch.teiath.gr/mylab/api/";
            var user = JSON.parse(atob("<?php echo base64_encode(json_encode($user));?>"));
            var user_url = encodeURIComponent(JSON.stringify(user));
            var authorized_user= <?php 
                                    if( isset($authorized_user) ){ 
                                        echo json_encode($authorized_user); 
                                    }else{
                                        echo json_encode(null);
                                    } 
                                ?>;
            if(authorized_user === null){ // if user refreshed page home.php, make an additional user_permits request in order to populate authorized_user
                $.ajax({
                        type: 'GET',
                        url: baseURL + 'user_permits',
                        data: { user: user },
                        dataType: "json",
                        beforeSend: function(req) {
                            req.setRequestHeader('Authorization', "Basic " + user.backendAuthorizationHash);
                        },
                        success: function(data){
                            if (data.status === 200){
                                authorized_user = data.data[0].user_role;
                            }
                        },
                        error: function (data){ console.log("GET user_permits error data: ", data);}
                });
            }
                              
            var search_xls = ["ΚΕΠΛΗΝΕΤ", "ΥΠΕΠΘ", "ΠΣΔ"];
            var edit_lab_details = ["ΣΕΠΕΗΥ", "ΔΙΕΥΘΥΝΤΗΣ", "ΤΟΜΕΑΡΧΗΣ", "ΕΤΠ"];
            var edit_lab_worker = ["ΔΙΕΥΘΥΝΤΗΣ", "ΤΟΜΕΑΡΧΗΣ"];
            var transit_lab = ["ΔΙΕΥΘΥΝΤΗΣ", "ΤΟΜΕΑΡΧΗΣ"];
            var create_lab = ["ΔΙΕΥΘΥΝΤΗΣ", "ΤΟΜΕΑΡΧΗΣ"];

        </script>
            
        <?php require_once('includes.html'); ?> 
        
        <script>
                           
            $(document).ready(function() {
                $.ajaxSetup({
                    data: { user: user },
                    beforeSend: function(req) {
                        req.setRequestHeader('Authorization', "Basic " + user.backendAuthorizationHash);
                    }
                });
                
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
                kendo.bind($("#search-lab-workers-container"), SearchLabWorkersVM);
                kendo.bind($("#switch_views"), LabsViewVM);
                kendo.bind($("#school_unit_info_pane").find("#details-container"), SchoolUnitsViewVM);
                
                
                kendo.bind($("#statistics-container"), StatisticsVM);
                kendo.bind($("#info-container"), InfoVM);
                
                kendo.bind($("#mylab_navigation_bar"), NavBarVM);
                
                kendo.bind($("#lab_workers_container"), LabWorkersViewVM);
                kendo.bind($("#lab_workers_view").find(".k-grid-toolbar>.export_to_xlsx"), SearchLabWorkersVM);
                kendo.bind($("#lab_workers_view").find(".k-grid-toolbar>.lab_worker_grid_columns_btn"), LabWorkersViewVM);
                kendo.bind($("#lab_workers_view").find(".k-grid-toolbar>.lab_worker_refresh_btn"), LabWorkersViewVM);
                
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
                                
                
                /* call user_permits in order to populate user info  */
                $.ajax({
                        type: 'GET',
                        url: baseURL + 'user_permits',
                        dataType: "json",
                        success: function(data){
                            if (data.status === 200){
                                InfoVM.set("user", data.data[0].user_infos.user_name);
                                InfoVM.set("role", data.data[0].user_infos.ldap_role);
                                InfoVM.set("unit", data.data[0].user_infos.user_unit);
                                InfoVM.set("phone", data.data[0].user_infos.phone_number);
                                InfoVM.set("fax", data.data[0].user_infos.fax_number);
                                InfoVM.set("email", data.data[0].user_infos.email);
                                InfoVM.set("address", data.data[0].user_infos.street_address);
                            }
                        },
                        error: function (data){ console.log("GET user_permits error data: ", data);}
                });
                
                
                //index holds thr grid's row index in school units view, in order to expand it after lab creation
                index= null;
                //searchParameters holds search form filters in order to be used inside SearchVM's exportToXLSX
                searchParameters = [];
                searchWorkersParameters = [];
                statisticParameters = [];
                                               
            });
            
        </script>
     
    </head>
   
    <body style="background-color: #e6ece1;">
        
        <?php require_once('navigation_bar.php'); //navigation bar ?>
        <div style='height:90px'> </div>
        <?php require_once('switch_views.php'); //switch views?>
        <div style='height:50px'> </div>      
        <?php
                require_once('search.html');  //search
                require_once('search_lab_workers.html');  //search lab workers
                require_once('labs_view_try.php'); //labs view
                require_once('school_units_view_try.php'); //school units view
                require_once('lab_workers_view.php'); //lab workers view
                require_once('statistics.php'); //statistics
                require_once('info.php'); //info
        ?>
        <a href="#" class="scrollup">Scroll</a>
                      
    </body>
</html>