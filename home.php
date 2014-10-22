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
            //console.log("LDAP user: ", user);
            
        </script>
            
        <?php require_once('includes.html'); ?> 
        
        <script>
            
            /* 
             * Ο χρήστης, στα στοιχεία που επιστρέφονται από τον ldap (var user), μπορεί να έχει έναν 
             * ή περισσότερους από τους ρόλους ('title' attribute) που διακρίνονται παρακάτω (εντός switch).  
             * Στην authorized_user, θα αποδοθεί στον χρήστη ο ρόλος που έχει το μεγαλύτερο ranking σε σχέση 
             * με τους υπόλοιπους ρόλους του. Κάθε ένα από τα arrays search_xls, edit_lab_details, edit_lab_worker, 
             * transit_lab, create_lab περιέχει τους ρόλους χρηστών που έχουν δικαιώματα στη λειτουργία του myLab
             * που εκφράζει το όνομά του πχ δυνατότητα αναζήτησης έχουν όσοι χρήστες έχουν κάποιο ρόλο απ' αυτούς
             * που βρίσκονται εντός του search_xls.
            */
            var search_xls = ["ΚΕΠΛΗΝΕΤ", "ΥΠΕΠΘ", "ΠΣΔ"];
            var edit_lab_details = ["ΣΕΠΕΗΥ", "ΔΙΕΥΘΥΝΤΗΣ", "ΤΟΜΕΑΡΧΗΣ", "ΕΤΠ"];
            var edit_lab_worker = ["ΔΙΕΥΘΥΝΤΗΣ", "ΤΟΜΕΑΡΧΗΣ"];
            var transit_lab = ["ΔΙΕΥΘΥΝΤΗΣ", "ΤΟΜΕΑΡΧΗΣ"];
            var create_lab = ["ΔΙΕΥΘΥΝΤΗΣ", "ΤΟΜΕΑΡΧΗΣ"];

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
                    case  'ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ' :
                        value_ranks.push({ldap_title: 'ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ', ranking : 20, role: 'ΕΤΠ'});
                        break;
                    case  'ΠΡΟΣΩΠΙΚΟ ΠΣΔ' :
                        value_ranks.push({ldap_title: 'ΠΡΟΣΩΠΙΚΟ ΠΣΔ', ranking : 25, role: 'ΠΣΔ'});
                        break;
                    case  'ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ' :
                        value_ranks.push({ldap_title: 'ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ', ranking : 15, role: 'ΔΙΕΥΘΥΝΤΗΣ'});
                        break;
                    case 'ΤΟΜΕΑΡΧΗΣ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ' :
                        value_ranks.push({ldap_title: 'ΤΟΜΕΑΡΧΗΣ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ', ranking : 15, role: 'ΤΟΜΕΑΡΧΗΣ'});
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
                kendo.bind($("#switch_views"), LabsViewVM);
                kendo.bind($("#school_unit_info_pane").find("#details-container"), SchoolUnitsViewVM);
                
                
                kendo.bind($("#statistics-container"), StatisticsVM);
                kendo.bind($("#info-container"), InfoVM);
                
                kendo.bind($("#mylab_navigation_bar"), NavBarVM);
                
                
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
                
                pinned_notification = $("#notification").kendoNotification({
                    position: {
                        pinned: true,
                        top: 70,
                        right: 30
                    },
                    //allowHideAfter: 2000,
                    autoHideAfter: 0,
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
                
                
                /*
                 * H user_permits καλείται με παράμετρο τη user και επιστρέφει
                 * 1)user_role
                 * 2)user_permissions(permit_labs, permit_school_units)
                 * 3)user_infos (με τα οποία πληθυσμώνεται η καρτέλα 'Σχετικά')
                 */
                $.ajax({
                        type: 'GET',
                        url: baseURL + 'user_permits',
                        dataType: "json",
                        success: function(data){
                            //έλεγχος αν ο χρήστης ανήκει σε κάποια από τις ομάδες χρηστών (ΔΙΕΥΘΥΝΤΗΣ, ΣΕΠΕΗΥ, ΚΕΠΛΗΝΕΤ, ΠΣΔ, ΥΠΑΙΘ, ΤΟΜΕΑΡΧΗΣ, ΕΤΠ)
                            if (data.status === 200 && data.user_role === "noAccess"){
                                pinned_notification.show({
                                    title: "Η λήψη δεδομένων από την υπηρεσία myLab δεν ειναι εφικτή",
                                    message: "Δεν πληρούνται τα απαραίτητα δικαιώματα πρόσβασης στην υπηρεσία."
                                }, "error");
                            }else if(data.user_role === "ΣΕΠΕΗΥ" && data.user_permissions.permit_labs.length === 0 ){
                                pinned_notification.show({
                                    title: "Η λήψη δεδομένων από την υπηρεσία myLab δεν ειναι εφικτή",
                                    message: "Ο Διευθυντής της Σχολικής σας Μονάδας δεν σας έχει ορίσει ως Υπεύθυνο στην Υπηρεσία myLab"
                                }, "error");
                            }else if(data.status === 500){
                                pinned_notification.show({
                                    title: "Η λήψη δεδομένων από την υπηρεσία myLab δεν ειναι εφικτή",
                                    message: data.message
                                }, "error");
                            }else{
                                InfoVM.set("all_info", data);
                                InfoVM.set("user", data.user_infos.user_name);
                                InfoVM.set("role", data.user_infos.ldap_role);
                                InfoVM.set("unit", data.user_infos.user_unit);
                                InfoVM.set("phone", data.user_infos.phone_number);
                                InfoVM.set("fax", data.user_infos.fax_number);
                                InfoVM.set("email", data.user_infos.email);
                                InfoVM.set("address", data.user_infos.street_address);
                            }

                        },
                        error: function (data){ console.log("GET user_permits error data: ", data);}
                });
                
                
                //index holds thr grid's row index in school units view, in order to expand it after lab creation
                index= null;
                //searchParameters holds search form filters in order to be used inside SearchVM's exportToXLSX
                searchParameters = [];
                                               
            });
            
        </script>
     
    </head>
   
    <body style="background-color: #e6ece1;">
        
        <?php require_once('navigation_bar.php'); //navigation bar ?>
        <div style='height:90px'> </div>
        <?php require_once('switch_views.php'); //switch views?>
        <div style='height:50px'> </div>      
        <?php
                if(in_array("ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ", $user['title']) || ($user['title'] === "ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ") ||
                   in_array("ΠΡΟΣΩΠΙΚΟ ΠΣΔ", $user['title']) || ($user['title'] === "ΠΡΟΣΩΠΙΚΟ ΠΣΔ") ||
                   in_array("ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ", $user['title']) || ($user['title'] === "ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ") ||
                   in_array("ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", $user['title']) || ($user['title'] === "ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ") ||
                   in_array("ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", $user['title']) || ($user['title'] === "ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ") ){ 
                    require_once('search.html');  //search
                }
                require_once('labs_view_try.php'); //labs view
                require_once('school_units_view_try.php'); //school units view
                require_once('statistics.php'); //statistics
                require_once('info.php'); //info
        ?>
        <a href="#" class="scrollup">Scroll</a>
                      
    </body>
</html>