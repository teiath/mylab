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
                    console.log(data.tmp_report_filepath);
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
    }
            
});