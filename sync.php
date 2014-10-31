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
            console.log("LDAP user: ", user);
            
        </script>
        
        <?php require_once('includes.html'); ?> 
        
        <script>
        
         $(document).ready(function() {
             
//            $.ajaxSetup({
//                data: { user: user },
//                beforeSend: function(req) {
//                    req.setRequestHeader('Authorization', "Basic " + user.backendAuthorizationHash);
//                }
//            });

            baseURL = config.serverUrl;//"http://mmsch.teiath.gr/mylab/api/";
        
            $("#sync").on("click", function(e){
                
                var parameters = {
                          pagesize: 100
                        };

                $.ajax({
                        type: "GET",
                        url: baseURL + "search_labs" + "?user=" + user_url,
                        dataType: "json",
                        data: JSON.stringify(parameters),
                        success: function(data){

                            if(data.status == 200){

                                $("#result").text(data.data);

                            }else if(data.status == 500){

                                alert("error!!!");
                            }
                        }
                    });
            });
            
         });
        
        </script>
        
    </head>
    
    <body>
        <div class="container" style="margin-top:100px;">
            <div class="row">

                <div class="col-md-12">
                    <button id="sync" type="button" class="btn btn-primary">Primary</button>
                </div>

                <div class="col-md-12">
                    <div id="result" class="highlight"></div>
                </div>

            </div>
        </div>
        
    </body>

</html>