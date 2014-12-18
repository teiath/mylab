<!DOCTYPE html>
<!--navigation bar-->
<nav id="mylab_navigation_bar" class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#5E5E5E;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header"> <!--style="width:300px;"-->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
        <a href="home.php">
            <img class="" height="43" style="padding:8px 10px 0px 10px; float:left;" alt="ΠΣΔ" src="client/pages/icons/logo@2x.png">
            <div>
                <span style="margin-left:10px; font-size:18px; color: #F5F5F5; font-family:Helvetica; float:left;"> Υπηρεσία MyLab </span>
                <span style="margin-left:10px; font-size:14px; color: #F5F5F5; font-family:Helvetica; float:left;"> Πανελλήνιο Σχολικό Δίκτυο</span>
            </div>
        </a>
        <!--<img class="psd_icon" alt="ΠΣΔ" src="client/pages/icons/sch_grey_2.jpg">-->
        <!--<img src="client/img/logo-teia.jpg" alt="ΤΕΙ Αθήνας" style="float:left; padding-left:15px;">-->
        <!--<a class="navbar-brand" href="home.php" style="font-size:30px;font-weight:bold;font-family: 'Crafty Girls', cursive;">Υπηρεσία MyLab</a>-->
        <!--<a href="home.php" style="line-height: 1.60; margin-left:20px; font-size:30px; color: #F5F5F5;"> Υπηρεσία MyLab</a>-->
            <!--<span style="font-family: 'Calibri'; font-size:32px; font-weight:400;">Υπηρεσία</span> MyLab</a>-->
        <!--<span class="label label-danger" style="position:absolute; margin-top:5px;">BETA</span>-->
    </div>

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
</nav>

<!--report_publication_failure_notification-->
<span id="report_publication_failure_notification" style="display:none;"></span>

<!--report_publication_in_progress_dialog-->
<div id="report_publication_in_progress_dialog" style="display:none; color: #5E5E5E">
    <div style="padding:13px;">Η έκδοση της αναφοράς βρίσκεται σε εξέλιξη, παρακαλώ περιμένετε...</div>                                        

    <div id="progressBar" class="k-widget k-progressbar k-progressbar-horizontal k-progressbar-indeterminate" data-role="progressbar" style="margin:13px;">
        <span class="k-progress-status-wrap">
            <span class="k-progress-status">0</span>
        </span>
    </div>
</div>


<script>
    
    //console.log("authorized_user [navigation_bar]: ", authorized_user);
    
    var psd_user_guides_snippet = '<li role="presentation" class="dropdown-header">Εγχειρίδια Χρήσης</li>\
                                   <li><a id="user_guide_sepehy" data-bind="events: {click : exportUserGuideSepehy}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης Υπεύθυνος Διαταξης Η/Υ (ΣΕΠΕΗΥ)</a></li>\
                                   <li><a id="user_guide_etp" data-bind="events: {click : exportUserGuideSepehy}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης Υπεύθυνος Διαταξης Η/Υ (ΕΚ)</a></li>\
                                   <li><a id="user_guide_dieythuntis" data-bind="events: {click : exportUserGuideDieuthyntis}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης Διευθυντής Σχολικής Μονάδας</a></li>\
                                   <li><a id="user_guide_tomearxis" data-bind="events: {click : exportUserGuideTomearxis}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης Υπεύθυνος Τομέα (ΕΚ)</a></li>\
                                   <li><a id="user_guide_keplinet" data-bind="events: {click : exportUserGuideKeplinet}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης Κεπληνετ</a></li>\
                                   <li><a id="user_guide_psd" data-bind="events: {click : exportUserGuidePSD}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης ΦΥ (ΠΣΔ)</a></li>\
                                   <li><a id="user_guide_ypaith" data-bind="events: {click : exportUserGuideYpaith}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης ΥΠΑΙΘ</a></li>\
                                   <li class="divider"></li>';
    
    if(authorized_user === "ΣΕΠΕΗΥ"){
        $("#user_menu").find("ul li:last-child").before('<li><a id="user_guide" data-bind="events: {click : exportUserGuideSepehy}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης</a></li><li class="divider"></li>');
    }else if(authorized_user === "ΕΤΠ"){
        $("#user_menu").find("ul li:last-child").before('<li><a id="user_guide" data-bind="events: {click : exportUserGuideEtp}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης</a></li><li class="divider"></li>');
    }else if(authorized_user === "ΔΙΕΥΘΥΝΤΗΣ"){
        $("#user_menu").find("ul li:last-child").before('<li><a id="user_guide" data-bind="events: {click : exportUserGuideDieuthyntis}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης</a></li><li class="divider"></li>');
    }else if(authorized_user === "ΤΟΜΕΑΡΧΗΣ"){
        $("#user_menu").find("ul li:last-child").before('<li><a id="user_guide" data-bind="events: {click : exportUserGuideTomearxis}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης</a></li><li class="divider"></li>');
    }else if(authorized_user === "ΚΕΠΛΗΝΕΤ"){    
        $("#user_menu").find("ul li:eq(0)").before('<li role="presentation" class="dropdown-header">Έκδοση Αναφορών</li><li><a id="annual_ypaith_report" data-bind="events: {click : exportReport}"><i class="fa fa-file-pdf-o"></i> Ετήσια Αναφορά ΥΠΑΙΘ</a></li><li class="divider"></li>');
        $("#user_menu").find("ul li:last-child").before('<li><a id="user_guide" data-bind="events: {click : exportUserGuideKeplinet}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης</a></li><li class="divider"></li>');
    }else if(authorized_user === "ΠΣΔ"){
        $("#user_menu").find("ul li:eq(0)").before(psd_user_guides_snippet);
    }else if(authorized_user === "ΥΠΕΠΘ"){
        $("#user_menu").find("ul li:last-child").before('<li><a id="user_guide" data-bind="events: {click : exportUserGuideYpaith}"><i class="fa fa-book"></i> Εγχειρίδιο Χρήσης</a></li><li class="divider"></li>');
    }
     
    //var g_casUrl = "<?php //echo $casOptions['Url'] ?>";

    // Build logout link
    $("#lnkLogout").attr("href", config.url + "home.php?logout=true");
    $("#user_button").html(user.uid);
    
</script>

