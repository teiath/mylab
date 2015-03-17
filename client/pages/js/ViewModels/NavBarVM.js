var NavBarVM = kendo.observable({
      
    exportReport: function(e){
        e.preventDefault();
        
        var report_publication_in_progress_dialog = $("#report_publication_in_progress_dialog").kendoWindow({
            title: "Έκδοση Αναφοράς",
            modal: true,
            visible: false,
            resizable: false,
            width: 400,
            pinned: true,
            actions: []
        }).data("kendoWindow");
        var report_publication_failure_notification = $("#report_publication_failure_notification").kendoNotification({
            animation: {
                open: {
                    effects: "slideIn:left",
                    duration:700
                },
                close: {
                    effects: "slideIn:left",
                    duration:1000,
                    reverse: true
                }
            },
            position: {
                pinned: true,
                top: 70,
                right: 30
            },
            allowHideAfter: 2000,
            autoHideAfter: 5000, //0 for no auto hide
            hideOnClick: true,
            stacking: "down",
            width:"25em"
        }).data("kendoNotification");

        report_publication_in_progress_dialog.content();
        report_publication_in_progress_dialog.center().open();        
        
        var edu_admin = user.l.split(",")['1'].split("=")['1']; 
        var url= config.serverUrl + "report_keplhnet?edu_admin_code=" + edu_admin;     
        
        $.ajax({
            type: 'GET',
            url: url,
            dataType: "json",
            success: function(data){
                report_publication_in_progress_dialog.close();
                if(typeof data.tmp_report_filepath !== "undefined"){
                    window.open(data.tmp_report_filepath);
                }else if(data.status === 500){
                    report_publication_failure_notification.show("Η έκδοση της αναφοράς απέτυχε. " + data.message.substr(data.message.indexOf(":") + 1), "error");
                }
            },
            error: function(data){
                report_publication_in_progress_dialog.close();
                report_publication_failure_notification.show("Υπήρξε κάποιο σφάλμα κατα την έκδοση της αναφοράς, παρακαλώ ξαναπροσπαθείστε.", "error");
            }
        });
    },
    
/*    exportUserGuide: function(e){
//        e.preventDefault();
//        var url;
//    
//        if(authorized_user === "ΚΕΠΛΗΝΕΤ" ){
//            url = "http://myfiles.sch.gr/server/get/d6231bc417d1641948eb66244a0f6c691"; //config.url + "client/user_guides/keplinet.pdf";
//        }else if(authorized_user === "ΣΕΠΕΗΥ" || authorized_user === "ΕΤΠ"){
//            url = "http://myfiles.sch.gr/server/get/dcaae3ba61d5845fcac9aedeb983caedb"; //config.url + "client/user_guides/sepehy.pdf";
//        }else if(authorized_user === "ΠΣΔ" ){
//            //url = "http://myfiles.sch.gr/server/get/d7701f86e3fcc44238c18f2b6b08cad4b"; //config.url + "client/user_guides/psd.pdf";
//        }else if(authorized_user === "ΔΙΕΥΘΥΝΤΗΣ" || authorized_user === "ΤΟΜΕΑΡΧΗΣ" ){
//            url = "http://myfiles.sch.gr/server/get/d2db1b8b798fc4413b6f3b40e79d036eb"; //config.url + "client/user_guides/dieuthintis.pdf";
//        }else if(authorized_user === "ΥΠΕΠΘ" ){
//            //url = "http://myfiles.sch.gr/server/get/d7701f86e3fcc44238c18f2b6b08cad4b"; //config.url + "client/user_guides/upepth.pdf";
//        }
//        
//        window.open(url);
//    },
*/

    exportUserGuideSepehy: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/d32f5630517cb4c9b914e42a9786b2f8b";
        window.open(url);
    },

    exportUserGuideEtp: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/d32f5630517cb4c9b914e42a9786b2f8b"; //ίδιο link με ΣΕΠΕΗΥ
        window.open(url);
    },

    exportUserGuideKeplinet: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/d463f247ff9cb40d5af9f0c618e6dce59";
        window.open(url);
    },

    exportUserGuideDieuthyntis: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/dbd0581d697b04bd38609c9a0e6b374ba";
        window.open(url);
    },

    exportUserGuideTomearxis: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/dbd0581d697b04bd38609c9a0e6b374ba"; //ίδιο link με ΔΙΕΥΘΥΝΤΗ
        window.open(url);
    },

    exportUserGuidePSD: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/da2dd966ada5b41599ef408e3b3527990";
        window.open(url);
    },

    exportUserGuideYpaith: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/d0a8edca5660549eca28fa5331a48ecc8";
        window.open(url);
    }
    
});