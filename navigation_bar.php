<!DOCTYPE html>
<!--navigation bar-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <img style="float:left; padding-left:10px; padding-top:7px" alt="ΠΣΔ" src="client/pages/icons/sch-icon38px.png">
        <!--<img src="client/img/logo-teia.jpg" alt="ΤΕΙ Αθήνας" style="float:left; padding-left:15px;">-->
        <a class="navbar-brand" href="index.php" style="font-size:30px;">Υπηρεσία MyLab </a> 
        <!--<span class="label label-danger" style="position:absolute; left:7px;top:46px;">BETA Version</span>-->
    </div>
        
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Αναφορές <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="http://mmsch.teiath.gr/mylab/api/report_keplhnet" target="_blank">Ετήσια Αναφορά ΥΠΑΙΘ</a></li>
                </ul>
            </li>
          <li><div style="margin:10px 30px"><a href="#" id="lnkLogout" class="btn btn-sm btn-warning"></a></div></li>
        </ul>
    </div>    
</nav>


<script>
    var user = JSON.parse(atob("<?php echo base64_encode(json_encode($user)); ?>")); 
    var g_casUrl = "<?php echo $casOptions['Url'] ?>";
    // Build logout link
    $("#lnkLogout").attr("href", "http://" + g_casUrl + "/logout");
    $("#lnkLogout").html("<strong>" + user.uid + " [Logout]" + "</strong>");
</script>
