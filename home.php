<?php 
    //psd user authentication to front-end

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
            phpCAS::logout();
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

    //$user['backendAuthorizationHash'] = base64_encode($frontendOptions['backendUsername'].':'.$frontendOptions['backendPassword']);
    $user['backendAuthorizationHash'] = base64_encode($frontendOptions['frontendUsername'].':'.$frontendOptions['frontendPassword']);
?>

<!DOCTYPE html>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <?php require_once('includes.html');?>
        
        <script>
                       
            $(document).ready(function() {
                $.ajaxSetup({
                    data: { user: user },
                    beforeSend: function(req) {
//                    console.log("beforeSend: req = ", req);
                        req.setRequestHeader('Authorization', "Basic " + user.backendAuthorizationHash);
                    }
                });

                baseURL = config.serverUrl;//"http://mmsch.teiath.gr/mylab/api/";

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
                kendo.bind($("#school_unit_info_pane").find("#details-container"), SchoolUnitsViewVM);
                kendo.bind($("#school_unit_info_dialog"), SchoolUnitsViewVM);
                
                
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
                
                //get user role
                    
                $.ajax({
                        type: 'GET',
                        url: baseURL + 'user_permits',
                        dataType: "json",
                        success: function(data){

                            if (data.user_role === "noAccess"){
                                notification.show({
                                    title: "Η λήψη δεδομένων από την υπηρεσία myLab δεν ειναι εφικτή",
                                    message: "Δεν πληρούνται τα απαραίτητα δικαιώματα πρόσβασης"
                                }, "error");
                            }

                        },
                        error: function (data){ console.log("GET user_permits error data: ", data);}
                });
                
                
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
        <script> 
//            if(jQuery.inArray( authorized_user, search_xls ) !== -1){
//                alert("im in!!");
//            };
        </script>
        
        <?php
                //var_dump($user['title']); //string(25) "ΠΡΟΣΩΠΙΚΟ ΠΣΔ" 
                //$search_xls = array("ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ", "ΠΡΟΣΩΠΙΚΟ ΠΣΔ", "ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ", "ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", "ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ");
                //if(in_array($user['title'], $search_xls)){ require_once('search.html'); } //search pane
                //require_once('search.html'); //search pane
                //var_dump($user['title']);
                if(in_array("ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ", $user['title']) || ($user['title'] === "ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ") ||
                   in_array("ΠΡΟΣΩΠΙΚΟ ΠΣΔ", $user['title']) || ($user['title'] === "ΠΡΟΣΩΠΙΚΟ ΠΣΔ") ||
                   in_array("ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ", $user['title']) || ($user['title'] === "ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ") ||
                   in_array("ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", $user['title']) || ($user['title'] === "ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ") ||
                   in_array("ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", $user['title']) || ($user['title'] === "ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ") ){ 
                    require_once('search.html'); 
                }
                if(in_array("ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ", $user['title'])){ require_once('school_unit_info.html'); }
                //require_once('school_unit_info.html');
                require_once('switch_views.html'); //switch views button
                require_once('labs_view_try.php'); //labs view
                require_once('school_units_view_try.php'); //school units view
        ?>
        <a href="#" class="scrollup">Scroll</a>
        
        
        <script>
    
            var g_casUrl = "<?php echo $casOptions['Url'] ?>";
            
            // Build logout link
            $("#lnkLogout").attr("href", config.url + "home.php?logout=true"); //"http://mmsch.teiath.gr/mylab/?logout=true"
            $("#user_button").html(user.uid);

        </script>        
        
    </body>
</html>
