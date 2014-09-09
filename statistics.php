<?php
require_once ('server/system/config.php');
             
$user['backendAuthorizationHash'] = base64_encode($frontendOptions['backendUsername'].':'.$frontendOptions['backendPassword']);      
//$results = $_POST['results']; 
//var_dump($results);
var_dump($user);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script>
            
            var user = JSON.parse(atob("<?php echo base64_encode(json_encode($user));?>"));
            //var user_url = encodeURIComponent(JSON.stringify(user));
            //console.log("user_url before includes:", user_url);
            
        </script>
        <?php require_once('includes.html');?>

        <script>
            
            //var user = JSON.parse(atob("<?php //echo base64_encode(json_encode($user)); ?>"));
            function make_base_auth(hash) { return "Basic " + hash;}

            var parameters = {
                 implementation_entity: "11",
                 x_axis: "edu_admin",
                 y_axis: "unit_type"
             };
            
            $.ajax({
                type: "GET",
                url: "http://mmsch.teiath.gr/mylab/api/statistic_school_units",
                dataType: "json",
                data: JSON.stringify(parameters),
                beforeSend: function(req) {
                    req.setRequestHeader(
                    'Authorization', make_base_auth (user.backendAuthorizationHash)
                    );
                },
                success: function(data){
                    $(document).ready(function() {
                        
                        var results = data.results;
                        /*var results = [{ "unit_type_name": "ΓΕΝΙΚΟ ΛΥΚΕΙΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Δ.Ε. ΑΘΗΝΑΣ Α΄", "total_units": "42" }, 
                                        { "unit_type_name": "ΓΕΝΙΚΟ ΛΥΚΕΙΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Δ.Ε. ΑΘΗΝΑΣ Γ΄", "total_units": "2" }, 
                                        { "unit_type_name": "ΓΥΜΝΑΣΙΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Δ.Ε. ΑΘΗΝΑΣ Α΄", "total_units": "53" }, 
                                        { "unit_type_name": "ΓΥΜΝΑΣΙΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Δ.Ε. ΑΘΗΝΑΣ Γ΄", "total_units": "3" }, 
                                        { "unit_type_name": "ΔΗΜΟΤΙΚΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Π.Ε. ΑΘΗΝΑΣ Α΄", "total_units": "158" }, 
                                        { "unit_type_name": "ΔΗΜΟΤΙΚΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Π.Ε. ΑΘΗΝΑΣ Γ΄", "total_units": "7" }, 
                                        { "unit_type_name": "ΕΙΔΙΚΟ ΕΡΓΑΣΤΗΡΙΟ ΕΠΑΓΓΕΛΜΑΤΙΚΗΣ ΕΚΠΑΙΔΕΥΣΗΣ ΚΑΙ ΚΑΤΑΡΤΙΣΗΣ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Δ.Ε. ΑΘΗΝΑΣ Α΄", "total_units": "1" }, 
                                        { "unit_type_name": "ΕΠΑΓΓΕΛΜΑΤΙΚΟ ΛΥΚΕΙΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Δ.Ε. ΑΘΗΝΑΣ Α΄", "total_units": "9" }, 
                                        { "unit_type_name": "ΕΡΓΑΣΤΗΡΙΑΚΟ ΚΕΝΤΡΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Δ.Ε. ΑΘΗΝΑΣ Α΄", "total_units": "2" }, 
                                        { "unit_type_name": "ΝΗΠΙΑΓΩΓΕΙΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Π.Ε. ΑΘΗΝΑΣ Α΄", "total_units": "172" }, 
                                        { "unit_type_name": "ΝΗΠΙΑΓΩΓΕΙΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Π.Ε. ΑΘΗΝΑΣ Γ΄", "total_units": "10" }, 
                                        { "unit_type_name": "ΤΕΧΝΙΚΟ ΕΠΑΓΓΕΛΜΑΤΙΚΟ ΕΚΠΑΙΔΕΥΤΗΡΙΟ", "edu_admin_name": "ΔΙΕΥΘΥΝΣΗ Δ.Ε. ΑΘΗΝΑΣ Α΄", "total_units": "1" }
                                        ];
                        */               
                        var unit_types = [{"unit_type_id": 1,"name": "ΝΗΠΙΑΓΩΓΕΙΟ","initials": "ΝΗΠ","category_id": 1,"education_level_id": 1}, {"unit_type_id": 2,"name": "ΔΗΜΟΤΙΚΟ","initials": "ΔΗΜ","category_id": 1,"education_level_id": 1}, {"unit_type_id": 3,"name": "ΓΥΜΝΑΣΙΟ","initials": "ΓΥΜ","category_id": 1,"education_level_id": 2}, {"unit_type_id": 4,"name": "ΓΕΝΙΚΟ ΛΥΚΕΙΟ","initials": "ΓΕΛ","category_id": 1,"education_level_id": 2}, {"unit_type_id": 5,"name": "ΕΠΑΓΓΕΛΜΑΤΙΚΟ ΛΥΚΕΙΟ","initials": "ΕΠΑΛ","category_id": 1,"education_level_id": 2}, {"unit_type_id": 6,"name": "ΕΠΑΓΓΕΛΜΑΤΙΚΗ ΣΧΟΛΗ","initials": "ΕΠΑΣ","category_id": 1,"education_level_id": 2}, {"unit_type_id": 7,"name": "ΤΕΧΝΙΚΟ ΕΠΑΓΓΕΛΜΑΤΙΚΟ ΕΚΠΑΙΔΕΥΤΗΡΙΟ","initials": "ΤΕΕ","category_id": 1,"education_level_id": 2}, {"unit_type_id": 8,"name": "ΕΡΓΑΣΤΗΡΙΑΚΟ ΚΕΝΤΡΟ","initials": "ΕΚ","category_id": 1,"education_level_id": 2}, {"unit_type_id": 9,"name": "ΕΠΑΓΓΕΛΜΑΤΙΚΟ ΓΥΜΝΑΣΙΟ ","initials": "ΕΠΑΓ","category_id": null,"education_level_id": null}, {"unit_type_id": 10,"name": "ΓΕΝΙΚΟ ΑΡΧΕΙΟ ΚΡΑΤΟΥΣ","initials": "ΓΑΚ","category_id": 5,"education_level_id": 4}, {"unit_type_id": 11,"name": "ΕΙΔΙΚΟ ΕΡΓΑΣΤΗΡΙΟ ΕΠΑΓΓΕΛΜΑΤΙΚΗΣ ΕΚΠΑΙΔΕΥΣΗΣ ΚΑΙ ΚΑΤΑΡΤΙΣΗΣ","initials": "ΕΕΕΕΚ","category_id": 1,"education_level_id": 2}, {"unit_type_id": 12,"name": "ΣΧΟΛΙΚΗ ΕΠΙΤΡΟΠΗ ΠΡΩΤΟΒΑΘΜΙΑΣ","initials": "ΣΕΠ","category_id": 3,"education_level_id": 4}, {"unit_type_id": 13,"name": "ΣΧΟΛΙΚΗ ΕΠΙΤΡΟΠΗ ΔΕΥΤΕΡΟΒΑΘΜΙΑΣ","initials": "ΣΕΔ","category_id": 3,"education_level_id": 4}, {"unit_type_id": 14,"name": "ΔΙΕΥΘΥΝΣΗ ΔΕΥΤΕΡΟΒΑΘΜΙΑΣ ΕΚΠΑΙΔΕΥΣΗΣ","initials": "ΔΔΕ","category_id": 8,"education_level_id": 4}, {"unit_type_id": 15,"name": "ΔΙΕΥΘΥΝΣΗ ΠΡΩΤΟΒΑΘΜΙΑΣ ΕΚΠΑΙΔΕΥΣΗΣ","initials": "ΔΠΕ","category_id": 8,"education_level_id": 4}, {"unit_type_id": 16,"name": "ΠΕΡΙΦΕΡΕΙΑΚΗ ΔΙΕΥΘΥΝΣΗ ΕΚΠΑΙΔΕΥΣΗΣ","initials": "ΠΔΕ","category_id": 8,"education_level_id": 4}, {"unit_type_id": 17,"name": "ΓΡΑΦΕΙΟ ΠΡΩΤΟΒΑΘΜΙΑΣ ΕΚΠΑΙΔΕΥΣΗΣ","initials": "ΓΠΕ","category_id": 8,"education_level_id": 4}, {"unit_type_id": 18,"name": "ΓΡΑΦΕΙΟ ΔΕΥΤΕΡΟΒΑΘΜΙΑΣ ΕΚΠΑΙΔΕΥΣΗΣ","initials": "ΓΔΕ","category_id": 8,"education_level_id": 4}, {"unit_type_id": 19,"name": "ΓΡΑΦΕΙΟ ΕΠΑΓΓΕΛΜΑΤΙΚΗΣ ΕΚΠΑΙΔΕΥΣΗΣ","initials": "ΓΕΕ","category_id": 8,"education_level_id": 4}, {"unit_type_id": 20,"name": "ΚΕΣΥΠ","initials": "ΚΕΣΥΠ","category_id": 2,"education_level_id": 4}, {"unit_type_id": 21,"name": "ΓΡΑΣΕΠ","initials": "ΓΡΑΣΕΠ","category_id": 2,"education_level_id": 4}, {"unit_type_id": 22,"name": "ΣΣΝ","initials": "ΣΣΝ","category_id": 2,"education_level_id": 4}, {"unit_type_id": 23,"name": "ΚΕΔΔΥ","initials": "ΚΕΔΔΥ","category_id": 2,"education_level_id": 4}, {"unit_type_id": 24,"name": "ΚΕΠΛΗΝΕΤ","initials": "ΚΕΠΛΗΝΕΤ","category_id": 2,"education_level_id": 4}, {"unit_type_id": 25,"name": "ΕΚΦΕ","initials": "ΕΚΦΕ","category_id": 2,"education_level_id": 4}, {"unit_type_id": 26,"name": "ΚΠΕ","initials": "ΚΠΕ","category_id": 2,"education_level_id": 4}, {"unit_type_id": 27,"name": "ΠΕΚ","initials": "ΠΕΚ","category_id": 2,"education_level_id": 4}, {"unit_type_id": 28,"name": "ΣΕΠΕΗΥ","initials": "ΣΕΠΕΗΥ","category_id": 4,"education_level_id": 4}, {"unit_type_id": 29,"name": "ΕΡΓΑΣΤΗΡΙΑ ΦΥΣΙΚΩΝ ΕΠΙΣΤΗΜΩΝ","initials": "ΕΦΕ","category_id": 4,"education_level_id": 4}, {"unit_type_id": 30,"name": "ΣΧΟΛΙΚΕΣ ΒΙΒΛΙΟΘΗΚΕΣ","initials": "ΣΒ","category_id": 4,"education_level_id": 4}];
                        var edu_admins = [];
                        
                        for (i = 0; i < results.length; i++) {
                            if(jQuery.inArray( results[i].edu_admin_name, edu_admins ) === -1){
                                edu_admins.push(results[i].edu_admin_name);
                            }
                        }

                        for (j = 0; j < edu_admins.length; j++) {
                            jQuery("#table thead tr").append("<th>" + edu_admins[j] + "</th>");
                        }

                        for (i = 0; i < unit_types.length; i++) {
                            jQuery("#table tbody").append("<tr id=" + i + "><th class='text-nowrap'>" + unit_types[i].name + "</th></tr>");

                            for(j = 0; j < edu_admins.length; j++){
                                jQuery("#"+i).append("<td> </td>");
                            }
                        }

                        for (i = 0; i < results.length; i++) {

                            var edu_admin = results[i].edu_admin_name;
                            var unit_type = results[i].unit_type_name;
                            var value = results[i].total_units;

                            var column = jQuery.inArray( edu_admin, edu_admins );

                            for (x = 0; x < unit_types.length; x++) {
                                if(unit_types[x].name === unit_type){
                                    var row = x;
                                }
                            }     

                            jQuery("#table tbody").find("tr:eq(" + row + ")>td:eq(" + column + ")").text(value);

                            //console.log(results); 
                            //console.log("edu_admins", edu_admins);
                            //console.log("edu_admin:" + edu_admin + ", " + "unit_type:" + unit_type + ", " + "value:" + value);
                            //console.log("row:" + row);
                            //console.log("column:" + column);
                            //console.log("tr: ", jQuery("#table tbody").find("tr:eq(" + row + ")>td:eq(" + column + ")"));

                        }
                        
                        //console.log("GET statistic_units success data: ", results);
                    });
                    
                    
                },
                error: function (data){
                    console.log("GET statistic_units error data: ", data); 
                }
            });
            
             
        </script>
    </head>
    <body style="font-size: 11px; color: #565e66">
        <h4 style="text-align: center; margin-top:15px;">Στατιστικά</h4>
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-12">

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>
    </body>
</html>