<?php 
    require_once ('server/system/config.php');
    $user['syncAuthorizationHash'] = base64_encode($Options['ServerSyncUsername'].':'.$Options['ServerSyncPassword']);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="client/config.js"></script>
        <script src="client/libs/frameworks/telerik.kendoui.web.2014.1.318.open-source/js/jquery.js"></script>
        <script src="client/libs/frameworks/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
        <link href="client/libs/frameworks/bootstrap-3.1.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
        
        <script>
            
            var user = JSON.parse(atob("<?php echo base64_encode(json_encode($user));?>"));

        </script>
        
    
        
        <script>
        
         $(document).ready(function() {
             
            $.ajaxSetup({
                data: { user: user },
                beforeSend: function(req) {
                    req.setRequestHeader('Authorization', "Basic " + user.syncAuthorizationHash);
                }
            });

            baseURL = config.syncUrl;
            
            $("#sync").on("click", function(e){
                
                var parameters = {
                          pagesize: 100
                        };

                $.ajax({
                        type: "GET",
                        url: baseURL + "region_edu_admins",
                        dataType: "json",
                        data: JSON.stringify(parameters),
                        success: function(data){

                          //  if(data.status == 200){

                                $("#result").text(data.countData);

//                            }else if(data.status == 500){
//
//                                alert("error!!!");
//                            }
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