var NavBarVM = kendo.observable({
    
    exportReport: function(e){
        e.preventDefault();
        
        var file_download_dialog = $("#file_download_dialog").kendoWindow({
            title: "Έκδοση Αναφοράς",
            modal: true,
            visible: false,
            resizable: false,
            width: 400,
            pinned: true,
            actions: []
        }).data("kendoWindow");
        
        file_download_dialog.content();
        file_download_dialog.center().open();        
        
        var edu_admin = user.l.split(",")['1'].split("=")['1']; 
        var url= config.serverUrl + "report_keplhnet?edu_admin_code=" + edu_admin;
        
        $.ajax({
                type: 'GET',
                url: url,
                dataType: "json",
                success: function(data){
                    file_download_dialog.close(); 
                    //console.log(data.tmp_report_filepath);
                    window.open(data.tmp_report_filepath);
                },
                error: function (data){
                    console.log("report export failed: ", data);
                    file_download_dialog.close();
                    
                    var file_download_error_dialog = $("#file_download_error_dialog").kendoWindow({
                        title: "Αποτυχία Έκδοσης Αναφοράς",
                        modal: true,
                        visible: false,
                        resizable: false,
                        width: 400,
                        pinned: true
                    }).data("kendoWindow");

                    file_download_error_dialog.content();
                    file_download_error_dialog.center().open();
                }
        });
    },
    
    exportUserGuide: function(e){
        e.preventDefault();
        var url;
    
        if(authorized_user === "ΚΕΠΛΗΝΕΤ" ){
            url = "http://myfiles.sch.gr/server/get/d6231bc417d1641948eb66244a0f6c691"; //config.url + "client/user_guides/keplinet.pdf";
        }else if(authorized_user === "ΣΕΠΕΗΥ" || authorized_user === "ΕΤΠ"){
            url = "http://myfiles.sch.gr/server/get/dcaae3ba61d5845fcac9aedeb983caedb"; //config.url + "client/user_guides/sepehy.pdf";
        }else if(authorized_user === "ΠΣΔ" ){
            //url = "http://myfiles.sch.gr/server/get/d7701f86e3fcc44238c18f2b6b08cad4b"; //config.url + "client/user_guides/psd.pdf";
        }else if(authorized_user === "ΔΙΕΥΘΥΝΤΗΣ" || authorized_user === "ΤΟΜΕΑΡΧΗΣ" ){
            url = "http://myfiles.sch.gr/server/get/d2db1b8b798fc4413b6f3b40e79d036eb"; //config.url + "client/user_guides/dieuthintis.pdf";
        }else if(authorized_user === "ΥΠΕΠΘ" ){
            //url = "http://myfiles.sch.gr/server/get/d7701f86e3fcc44238c18f2b6b08cad4b"; //config.url + "client/user_guides/upepth.pdf";
        }
        
        window.open(url);
    },

    exportUserGuideSepehy: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/dcaae3ba61d5845fcac9aedeb983caedb";
        window.open(url);
    },

    exportUserGuideEtp: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/dcaae3ba61d5845fcac9aedeb983caedb"; //ίδιο link με ΣΕΠΕΗΥ
        window.open(url);
    },

    exportUserGuideKeplinet: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/d6231bc417d1641948eb66244a0f6c691";
        window.open(url);
    },

    exportUserGuideDieuthyntis: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/d2db1b8b798fc4413b6f3b40e79d036eb";
        window.open(url);
    },

    exportUserGuideTomearxis: function(e){
        e.preventDefault();
        var url = "http://myfiles.sch.gr/server/get/d2db1b8b798fc4413b6f3b40e79d036eb"; //ίδιο link με ΔΙΕΥΘΥΝΤΗ
        window.open(url);
    },

    exportUserGuidePSD: function(e){
        e.preventDefault();
        var url = "";
        window.open(url);
    },

    exportUserGuideYpaith: function(e){
        e.preventDefault();
        var url = "";
        window.open(url);
    }
    
});