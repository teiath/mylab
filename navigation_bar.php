<!DOCTYPE html>
<!--navigation bar-->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#5E5E5E;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <img class="psd_icon" alt="ΠΣΔ" src="client/pages/icons/sch_grey_2.jpg">
        <!--<img src="client/img/logo-teia.jpg" alt="ΤΕΙ Αθήνας" style="float:left; padding-left:15px;">-->
        <!--<a class="navbar-brand" href="home.php" style="font-size:30px;font-weight:bold;font-family: 'Crafty Girls', cursive;">Υπηρεσία MyLab</a>-->
        <a href="home.php" style="line-height: 1.60; margin-left:20px; font-size:30px; font-family: 'Crafty Girls', cursive; color: #8EBC00;"> MyLab</a>
            <!--<span style="font-family: 'Calibri'; font-size:32px; font-weight:400;">Υπηρεσία</span> MyLab</a>-->
        <!--<span class="label label-danger" style="position:absolute; margin-top:5px;">BETA</span>-->
    </div>

    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            
            <div id="user_menu" class="btn-group" style="margin: 8px 23px 0px 0px;">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i> <span id="user_button" style="font-size: 13px;"> </span> <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" style="cursor:pointer; cursor:hand;">
                <li><a href="#" id="lnkLogout"><i class="fa fa-sign-out"></i> Αποσύνδεση</a></li>
              </ul>
            </div>
        </ul>
    </div>    
</nav>



    <!--file_download_dialog-->
    <div id="file_download_dialog" style="display:none; color: #5E5E5E">
        
        <div style="padding:13px;">Η έκδοση της αναφοράς βρίσκεται σε εξέλιξη, παρακαλώ περιμένετε...</div>                                        

        <div id="progressBar" class="k-widget k-progressbar k-progressbar-horizontal k-progressbar-indeterminate" data-role="progressbar" style="margin:13px;">
            <span class="k-progress-status-wrap">
                <span class="k-progress-status">0</span>
            </span>
        </div>       
        
    </div>


    <!--file_download_error_dialog-->
    <div id="file_download_error_dialog" style="display:none; color: #5E5E5E">
        <div style="padding:13px;">Υπήρξε κάποιο σφάλμα κατα τη διάρκεια της έκδοσης της αναφοράς, παρακαλώ ξαναπροσπαθείστε.</div>                                                
    </div>
    
<script>

    if(authorized_user === "ΚΕΠΛΗΝΕΤ"){
        $("#user_menu").find("ul li:eq(0)").before('<li role="presentation" class="dropdown-header">Έκδοση Αναφορών</li><li><a id="annual_ypaith_report" data-bind="events: {click : exportReport}"><i class="fa fa-file-pdf-o"></i> Ετήσια Αναφορά ΥΠΑΙΘ</a></li><li class="divider"></li>');
    }

    var g_casUrl = "<?php echo $casOptions['Url'] ?>";

    // Build logout link
    $("#lnkLogout").attr("href", config.url + "home.php?logout=true");
    $("#user_button").html(user.uid);
    
</script>

