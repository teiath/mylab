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
            var authorized_user;
                       
        </script>
            
        <?php require_once('includes.html'); ?> 
        
        <script>
            
            baseURL = config.serverUrl;//"http://mmsch.teiath.gr/mylab/api/";
            
            $(document).ready(function() {
                
                $.ajaxSetup({
                    data: { user: user },
                    beforeSend: function(req) {
                        req.setRequestHeader('Authorization', "Basic " + user.backendAuthorizationHash);
                    }
                });
                

                /* make a user_permits request in order to get user_role */
                $.ajax({
                        type: 'GET',
                        url: baseURL + 'user_permits',
                        dataType: "json",
                        success: function(data){
                            if(data.status === 200){
                                
                                authorized_user = data.data[0].user_role;
                                $("#myformId>input#authorized_user").val(authorized_user); //initialize form's hidden field, which holds authorized_user value                             
                                
                                if(authorized_user==="ΥΠΕΥΘΥΝΟΣ-ΔΙΑΤΑΞΗΣ" && data.data[0].user_permissions.permit_labs.length === 0 ){
                                    $("#mylab_authentication_message_pane").text("Δεν υπάρχουν Διατάξεις Η/Υ μέσα στην Υπηρεσία myLab στις οποίες να \
                                                                                έχετε οριστεί ως Υπεύθυνος. Ως εκ τούτου, η πρόσβαση στην Υπηρεσία \
                                                                                δεν ειναι προς το παρόν εφικτή. Παρακαλώ επικοινωνείστε με τον αρμόδιο \
                                                                                Διευθυντή Σχολικής Μονάδας ή Υπεύθυνο Τομέα ΕΚ, για την πραγματοποίηση \
                                                                                του σχετικού ορισμού και ξαναπροσπαθήστε να συνδεθείτε.");
                                }else{
                                    $('#logoutbtn').closest("div.col-md-12").css("display", "none");
                                    $("#mylab_authentication_message_pane").html("Εχετε συνδεθεί επιτυχώς στην Υπηρεσία MyLab. Παρακαλώ περιμένετε\
                                                                                    <i class='fa fa-spinner fa-spin' style='margin-left:3px;'></i>");
                                    countDown(3); //in sec
                                }
                                
                            }else if(data.status === 601){
                                $("#mylab_authentication_message_pane").text(error_601); //ok - όταν ο χρήστης δεν ανήκει σε κάποια από τις ομάδες χρηστών της Υπηρεσίας MyLab                                                   
                            }else if(data.status === 611){
                                $("#mylab_authentication_message_pane").text(error_611);                                                              
                            }else if(data.status === 620){
                                $("#mylab_authentication_message_pane").text(error_620);                                                              
                            }else if(data.status === 621){
                                $("#mylab_authentication_message_pane").text(error_621);                                                              
                            }else if(data.status === 622){
                                $("#mylab_authentication_message_pane").text(error_622);                                                              
                            }else if(data.status === 623){ /*ok - όταν ο ρόλος χρήστη που ανήκει σε κάποια από τις ομάδες χρηστών έχει αντιστοιχιστεί με σχολική μονάδα του LDAP η οποία ΔΕΝ έχει κωδικό ΜΜ (GsnRegistryCode)*/
                                $("#mylab_authentication_message_pane").text(error_623);                                                      
                            }else if(data.status === 624){
                                $("#mylab_authentication_message_pane").text(error_624);                                                              
                            }else if(data.status === 625){
                                $("#mylab_authentication_message_pane").text(error_625);
                            }else if(data.status === 626){/*ok - ίδιο με 623 μόνο που αφορά σε τμήματα του ΥΠΕΠΘ -χρήστες ΥΠΕΠΘ- και όχι σε σχολικές μονάδες*/
                                $("#mylab_authentication_message_pane").text(error_626);                                                              
                            }else if(data.status === 627){
                                $("#mylab_authentication_message_pane").text(error_627);                                                              
                            }else if(data.status === 629){
                                $("#mylab_authentication_message_pane").text(error_629);                                                              
                            }else if(data.status === 630){
                                $("#mylab_authentication_message_pane").text(error_630);                                                              
                            }else if(data.status === 631){
                                $("#mylab_authentication_message_pane").text(error_631);                                                              
                            }else if(data.status === 632){
                                $("#mylab_authentication_message_pane").text(error_632);                                                              
                            }else{
                                $("#mylab_authentication_message_pane").text(error_other);
                            }
                            
                            $('#connection_info').slideDown("slow");
                            
                        },
                        error: function(data){ console.log("user_permits in toHome.php failed : ", data);}
                });
                                               
            });
            
            function countDown(endTime) {
                if (endTime > 0) {
                    $("#countdown").text(Math.floor(endTime));
                    setTimeout(function () { countDown(endTime - 1); }, 1000);
                }else{
                    submitform();
                }
            }
            
            function submitform(){
                document.myform.submit();
            }
                       
        </script>
        
        <style>
            .btn-sso{
                color:#5E5E5E;
                padding:6px 6px 6px 16px;
                font-size:14px;
                border-radius:3px;
            }
        </style>
        
    </head>
   
    <body>

        <div class="container">

<!--            <div style="clear: both;" >&nbsp;</div>

            <div class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="pull-left"><img src="client/pages/icons/sch_logo.png" />&nbsp;&nbsp;&nbsp;</p>			
                            <p class="pull-left" style="padding-top:5px;"><strong><a href="http://www.sch.gr" style="color: #1d73a3;font: bold 20px Tahoma,sans-serif;">Πανελλήνιο Σχολικό Δίκτυο</a></strong><br>
                                <span class="sch_logo_text2">Το Δίκτυο στην Υπηρεσία της Εκπαίδευσης</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>-->

            <div class="jumbotron" style="background-color:#fcfcfc; color:#5E5E5E;">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="row">
                                <div class="col-md-12"><p style="text-align:center; margin:0px;"><img src="client/pages/icons/logo-light@2x.png"/></p></div>
                                <div class="col-md-12"><h3 style="text-align:center; color:#5E5E5E;">Υπηρεσία MyLab</h3></div>
                            </div>

                            <div id="connection_info" class="row" style="display:none;">
                                <div class="col-md-12">
                                    <p id="mylab_authentication_message_pane" style="font-size:16px;line-height:150%; margin:20px 0px; text-align: center;"> </p>
                                </div>				

                                <div class="col-md-12">
                                    <div style="text-align:center; padding:20px; margin-bottom:20px;">
                                        <a id="logoutbtn" type="button" class="btn btn-lg btn-default btn-sso"> 
                                            <span> 
                                                Αποσύνδεση <i class="fa fa-sign-out" style="margin: 0px 10px 0px 30px;"></i> 
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>                       
                            
                            <form id="myformId" name="myform" method="POST" action="home.php">
                                <input id='authorized_user' type="hidden" name='authorized_user' />
                            </form>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="text-align:center; margin-top:20px;">
                                        Υποστηρίξη: <strong>ΤΕΙ Αθήνας</strong> | Επικοινωνία: <strong>mm@sch.gr</strong>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <img class="img-responsive" src="client/pages/icons/mainlogo_p8.png" style="display:block;margin-left:auto;margin-right:auto;"/>
                        </div>
                        <div class="col-md-2">
                            <img class="img-responsive" src="client/pages/icons/Logo ΕΠΕΕΔΒΜ-2013-BW.png" style="display:block;margin-left:auto;margin-right:auto;"/>
                        </div>
                        <div class="col-md-2">
                            <img class="img-responsive" src="client/pages/icons/stirizo.png"  style="display:block;margin-left:auto;margin-right:auto;"/>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

<script>
    $("#logoutbtn").attr("href", config.url + "home.php?logout=true");
</script>


<!--            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4"><p><img class="img-responsive" src="client/pages/icons/mainlogo_p8.png" /></p></div>
                        <div class="col-md-4"><p><img class="img-responsive" src="client/pages/icons/logo_stirizo.png" /></p></div>
                        <div class="col-md-4"><p><img class="img-responsive" src="client/pages/icons/logo.png" /></p></div>
                    </div>
                </div>
            </div>-->