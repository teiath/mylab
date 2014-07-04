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
        <img class="psd_icon" alt="ΠΣΔ" src="client/pages/icons/sch-icon38px.png">
        <!--<img src="client/img/logo-teia.jpg" alt="ΤΕΙ Αθήνας" style="float:left; padding-left:15px;">-->
        <a class="navbar-brand" href="index.php" style="font-size:30px;">Υπηρεσία MyLab - Πανελλήνιο Σχολικό Δίκτυο </a> 
        <span class="label label-danger" style="position:absolute; margin-top:5px;">BETA</span>
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
    var user = JSON.parse(atob("<?php echo base64_encode(json_encode($user));?>"));
    console.log("user: ", user);
    var value_ranks=[], authorized_user;

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
    
    console.log("value_ranks: ", value_ranks);
    
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
    
        
    var search_xls = ["ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", "ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ", "ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ", "ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ"];
    var edit_lab_details = ["ΥΠΕΥΘΥΝΟΣ ΣΧΟΛΙΚΟΥ ΕΡΓΑΣΤΗΡΙΟΥ ΣΕΠΕΗΥ", "ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ"];
    var edit_lab_worker = ["ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ"];
    var transit_lab = ["ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ"];
    var create_lab = ["ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ"];

    


</script>