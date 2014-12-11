<?php 
    require_once ('server/system/config.php');
    require_once ('server/libs/phpCAS/CAS.php');
    
    //php cas auth
    phpCAS::client(SAML_VERSION_1_1,$casOptions["Url"],$casOptions["Port"],'', false);
    phpCAS::setNoCasServerValidation();//must replaces with setCasServerCaCert
    phpCAS::handleLogoutRequests(array($casOptions["Url"]));
    if(isset($_GET['logout']) && $_GET['logout'] == 'true') {
        phpCAS::logoutWithRedirectService($casOptions["LogoutURL"]);
        exit();
    } else {
        if (!phpCAS::checkAuthentication())
        phpCAS::forceAuthentication();
    }
    $user = phpCAS::getAttributes();
    $user['syncAuthorizationHash'] = base64_encode($Options['ServerSyncUsername'].':'.$Options['ServerSyncPassword']);
    
    if ($user['uid']!==$Options["ServerSyncUsername"]){
        phpCAS::logoutWithRedirectService($casOptions["LogoutURL"]);
        exit();
    }
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
        <link rel="stylesheet" type="text/css" media="screen" href="client/libs/fonts/font-awesome-4.1.0/css/font-awesome.min.css" >
  
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">

                <div id="user_menu" class="btn-group" style="margin: 14px 26px 0px 0px;">
                  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i> <span id="user_button" style="font-size: 13px;"> </span> <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="cursor:pointer; cursor:hand;">
                    <li><a href="#" id="lnkLogout"><i class="fa fa-sign-out"></i> Αποσύνδεση</a></li>
                  </ul>
                </div>
            </ul>
        </div>  
    
        <script>       
            var user = JSON.parse(atob("<?php echo base64_encode(json_encode($user));?>"));
            
            // Build logout link
            $("#lnkLogout").attr("href", config.url + "home.php?logout=true");
            $("#user_button").html(user.uid);
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
                    data: [ "circuit_types","edu_admins","education_levels",
                            "municipalities","prefectures","region_edu_admins",
                            "school_unit_types","sources","states","transfer_areas",
                            "worker_positions","worker_specializations"]
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
                
                var sync_dialog = $("#sync_dialog").kendoWindow({
                    modal: true,
                    visible: false,
                    resizable: false,
                    width: 400,
                    pinned:true,
                    open: function(ev){
                        ev.sender.element.addClass("k-popup-edit-form"); //add kendo class to apply some css
                        sync_dialog.title("Συγχρονισμός " + selection);
                                                
                        var syncButton = sync_dialog.element.find("div.k-edit-buttons>a.k-grid-sync");
                        var cancelSyncButton = sync_dialog.element.find("div.k-edit-buttons>a.k-grid-cancel-sync");
                                                
                        cancelSyncButton.on("click", function(e){
                            e.preventDefault();
                            sync_dialog.close();
                        });
                        
                        syncButton.on("click", function(e){
                            e.preventDefault();
                            sync_dialog.close();
                            kendo.ui.progress($(document.body), true);

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
                                        
                                        kendo.ui.progress($(document.body), false);
                                    }
                            });
                        });
                        
                        
                    }
                }).data("kendoWindow");
                
                var syncTemplate = kendo.template($("#sync_template").html());
                sync_dialog.content(syncTemplate(e));
                sync_dialog.center().open();
                
            });
            
         });
        
        </script>
        
    </head>
    
    <body>
        <div class="container" style="margin-top:100px;">
            <div class="row">

                <div class="col-md-12">
                    <button id="sync" type="button" class="btn btn-primary">Συγχρονισμός</button>
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
        <div id="sync_dialog"></div>
                
    </body>

</html>


<script id="sync_template" type="text/x-kendo-template">

    <div class="k-edit-form-container">

        <div class="form-horizontal col-md-11">
            <div class='form-group'>
                <div class="col-md-11">
                    <span> Είστε βέβαιος οτι θέλετε να συγχρονίσετε; </span>
                </div>
            </div>
        </div>

        <div class="k-edit-buttons k-state-default">
            <a class="k-button k-button-icontext k-grid-sync" href="\#">
                <span class="k-icon k-update"></span>Συγχρονισμός
            </a>
            <a class="k-button k-button-icontext k-grid-cancel-sync" href="\#">
                <span class="k-icon k-cancel"></span>Ακύρωση
            </a>
        </div>

    </div>

</script>