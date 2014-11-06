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
        <script src="client/libs/frameworks/telerik.kendoui.web.2014.1.318.open-source/src/js/kendo.web.js"></script>
        <link href="client/libs/frameworks/bootstrap-3.1.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
        <link href="client/libs/frameworks/telerik.kendoui.web.2014.1.318.open-source/styles/kendo.common.min.css" rel="stylesheet"/>
        <link href="client/libs/frameworks/telerik.kendoui.web.2014.1.318.open-source/styles/kendo.metro.min.css" rel="stylesheet" />
        
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
            var selection;
            
            $("#dropdownlist").kendoDropDownList({
                dataSource: {
                    data: ["edu_admins", "region_edu_admins"]
                },
                dataBound: function(e){
                    var value = this.value();
                    selection= value;
                },
                change: function(e){
                    var value = this.value();
                    selection= value;
                }
            });
            
            $("#sync").on("click", function(e){
                
                $("#result>table>tbody").empty();
                
                var parameters = {
                          type: "json"
                        };

                $.ajax({
                        type: "GET",
                        url: baseURL + selection,
                        dataType: "json",
                        data: parameters,
                        success: function(data){
                            var row;
                            $.each(data, function(index, value){
                                if(typeof value == "object"){
                                    $.each(value, function(index2, value2){
                                        row =  "<tr><td>" + index +"."+ index2 + "</td><td>" + value2 + "</td></tr>";
                                        $("#result>table>tbody").append(row);
                                    });
                                }else{
                                    row = "<tr><td>" + index + "</td><td>" + value + "</td></tr>";
                                    $("#result>table>tbody").append(row);
                                }
                                
                            });
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
                    <input id="dropdownlist" />
                </div>

                <div id="result" class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>index</th>
                                <th>content</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>    
                </div>

            </div>
        </div>
        
    </body>

</html>