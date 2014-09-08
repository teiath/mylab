var NavBarVM = kendo.observable({
    
    exportReport: function(e){
        e.preventDefault();
        var edu_admin = user.l.split(",")['1'].split("=")['1']; 
        var url= config.serverUrl + "report_keplhnet?edu_admin_code=" + edu_admin;
        
        $.ajax({
                type: 'GET',
                url: url,
                dataType: "json",
                success: function(data){

                    var message;
                    if (typeof data.message !== 'undefined'){
                        message= data.message;
                    }else if (typeof data.message_internal !== 'undefined'){
                        message= data.message_internal;
                    }else if (typeof data.message_external !== 'undefined'){
                        message= data.message_external;
                    }
                    
                    console.log(message);

                },
                error: function (data){ console.log("report export failed: ", data);}
        });
    }
            
});