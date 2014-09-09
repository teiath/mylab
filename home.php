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

        <script>
            
            var user = JSON.parse(atob("<?php echo base64_encode(json_encode($user));?>"));
            var user_url = encodeURIComponent(JSON.stringify(user));
                       
        </script>
            
        <?php require_once('includes.html'); // Prosexe. Fortwneis edw ta includes. Dld to LabViewVM fortwnei edw.?> 
        
        <script>
            
            var search_xls = ["ΚΕΠΛΗΝΕΤ", "ΥΠΕΠΘ", "ΠΣΔ"];
            var edit_lab_details = ["ΣΕΠΕΗΥ", "ΔΙΕΥΘΥΝΤΗΣ"];
            var edit_lab_worker = ["ΔΙΕΥΘΥΝΤΗΣ"];
            var transit_lab = ["ΔΙΕΥΘΥΝΤΗΣ"];
            var create_lab = ["ΔΙΕΥΘΥΝΤΗΣ"];

            var value_ranks=[], authorized_user;
            if(typeof user.title != 'object' && typeof user.title != 'array') {
                user.title = [user.title];
            }
            $.each(user.title, function(index, value){
                switch(value) {
                    case 'ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ':
                        value_ranks.push({ldap_title: 'ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ', ranking : 10, role: 'ΚΕΠΛΗΝΕΤ'});
                        break;
                    case 'ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ':
                        value_ranks.push({ldap_title: 'ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ', ranking : 10, role: 'ΚΕΠΛΗΝΕΤ'});
                        break;
                    case  'ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ' :
                        value_ranks.push({ldap_title: 'ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ', ranking : 10, role: 'ΚΕΠΛΗΝΕΤ'});
                        break;
                    case  'ΥΠΕΥΘΥΝΟΣ ΣΧΟΛΙΚΟΥ ΕΡΓΑΣΤΗΡΙΟΥ ΣΕΠΕΗΥ' :
                        value_ranks.push({ldap_title: 'ΥΠΕΥΘΥΝΟΣ ΣΧΟΛΙΚΟΥ ΕΡΓΑΣΤΗΡΙΟΥ ΣΕΠΕΗΥ', ranking : 20, role: 'ΣΕΠΕΗΥ'});
                        break;
                    case  'ΠΡΟΣΩΠΙΚΟ ΠΣΔ' :
                        value_ranks.push({ldap_title: 'ΠΡΟΣΩΠΙΚΟ ΠΣΔ', ranking : 25, role: 'ΠΣΔ'});
                        break;
                    case  'ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ' :
                        value_ranks.push({ldap_title: 'ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ', ranking : 15, role: 'ΔΙΕΥΘΥΝΤΗΣ'});
                        break;
                    case  'ΕΚΠΑΙΔΕΥΤΙΚΟΣ' :
                        value_ranks.push({ldap_title: 'ΕΚΠΑΙΔΕΥΤΙΚΟΣ', ranking : 35, role: 'ΕΚΠΑΙΔΕΥΤΙΚΟΣ'});
                        break;
                    case  'ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ' :
                        value_ranks.push({ldap_title: 'ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ', ranking : 30, role: 'ΥΠΕΠΘ'});
                        break;
                    default:
                        value_ranks.push({ldap_title: '', ranking : 50, role: 'noAccess'});
                }
            });

            var maxRanking = 50;
            var maxRole = "noAccess";
            $.each(value_ranks, function(index, value){
                if (value.ranking < maxRanking) {
                    maxRanking = value.ranking;
                    maxRole = value.role;
                }
            });

            authorized_user = maxRole;
            console.log("authorized_user: ", authorized_user);            
 
        </script>
        
        <script>
                           
            $(document).ready(function() {
                $.ajaxSetup({
                    data: { user: user },
                    beforeSend: function(req) {
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
                
                kendo.bind($("#annual_ypaith_report"), NavBarVM);
                
                
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
   
    <body style="background-color: #e6ece1;">
        
        <?php 
                require_once('navigation_bar.php'); //navigation bar // To navigation bar fortwnei edw. Pou shmainei oti PRWTA exei fortwsei to LabsViewVM kai META tou orizeis to user. .Ara otan fortwnei DEN yparxei user
        ?>
        <div style='height:90px'> </div>
        <?php
                if(in_array("ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ", $user['title']) || ($user['title'] === "ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ") ||
                   in_array("ΠΡΟΣΩΠΙΚΟ ΠΣΔ", $user['title']) || ($user['title'] === "ΠΡΟΣΩΠΙΚΟ ΠΣΔ") ||
                   in_array("ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ", $user['title']) || ($user['title'] === "ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ") ||
                   in_array("ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", $user['title']) || ($user['title'] === "ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ") ||
                   in_array("ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", $user['title']) || ($user['title'] === "ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ") ){ 
                    require_once('search.html'); 
                }
                if(in_array("ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ", $user['title'])){ 
                    require_once('school_unit_info.html');
                }
                require_once('switch_views.html'); //switch views button
                require_once('labs_view_try.php'); //labs view
                require_once('school_units_view_try.php'); //school units view
        ?>
        <a href="#" class="scrollup">Scroll</a>
               
<!--        <script>
    
            var g_casUrl = "<?php //echo $casOptions['Url'] ?>";
            
            // Build logout link
            $("#lnkLogout").attr("href", config.url + "home.php?logout=true"); //"http://mmsch.teiath.gr/mylab/?logout=true"
            $("#user_button").html(user.uid);

        </script>        -->
        
    </body>
</html>
