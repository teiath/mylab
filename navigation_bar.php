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
              <ul class="dropdown-menu" role="menu">
                <li role="presentation" class="dropdown-header">Έκδοση Αναφορών</li>
                <li><a href="http://mmsch.teiath.gr/mylab/api/report_keplhnet" target="_blank"><i class="fa fa-file-pdf-o"></i> Ετήσια Αναφορά ΥΠΑΙΘ</a></li>
                <li><a href="#"><i class="fa fa-file-pdf-o"></i> Αναφορά 1</a></li>
                <li><a href="#"><i class="fa fa-file-pdf-o"></i> Αναφορά 2</a></li>
                <li class="divider"></li>
                <li><a href="#" id="lnkLogout"><i class="fa fa-sign-out"></i> Αποσύνδεση</a></li>
              </ul>
            </div>
        </ul>
    </div>    
</nav>


<script>
    
    var search_xls = ["ΚΕΠΛΗΝΕΤ", "ΥΠΕΠΘ", "ΠΣΔ"];
    //console.log("search_xls: ", search_xls);
    var edit_lab_details = ["ΣΕΠΕΗΥ", "ΔΙΕΥΘΥΝΤΗΣ"];
    //console.log("edit_lab_details: ", edit_lab_details);
    var edit_lab_worker = ["ΔΙΕΥΘΥΝΤΗΣ"];
    //console.log("edit_lab_worker: ", edit_lab_worker);
    var transit_lab = ["ΔΙΕΥΘΥΝΤΗΣ"];
    //console.log("transit_lab: ", transit_lab);
    var create_lab = ["ΔΙΕΥΘΥΝΤΗΣ"];
    //console.log("create_lab: ", create_lab);
    
    var user = JSON.parse(atob("<?php echo base64_encode(json_encode($user));?>"));
    console.log("user: ", user);
    
    
    var user_url = encodeURIComponent(JSON.stringify(user));
    
//    var user_url="";
//    $.each(user, function(key, value){
//        console.log("key: ", key);
//        if(value instanceof Array){ 
//            console.log("stringified value: ", JSON.stringify(value)); 
//            user_url += (user_url === "") ? "user[" + key + "]=" + encodeURIComponent(JSON.stringify(value)) : "&user[" + key + "]=" + encodeURIComponent(JSON.stringify(value));
//        }else{
//            console.log("value: ", value);
//            user_url += (user_url === "") ? "user[" + key + "]=" + value : "&user[" + key + "]=" + value;
//        };        
//    });
    console.log("user_url: ", user_url);
    
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
    
    //console.log("value_ranks: ", value_ranks);
    
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