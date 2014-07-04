function transitAjaxRequest(type, api_function, parameters, transition_dialog, lab_grid){
    
    $.ajax({
            type: type,
            url: baseURL + api_function,
            dataType: "json",
            data: JSON.stringify(parameters),
            success: function(data){
                console.log("data:", data);

                if(data.status == 200){
                        
                        transition_dialog.close();
                        
                        notification.show({
                            title: "Επιτυχής ενημέρωση Διάταξης Η/Υ",
                            message: data.message
                        }, "success");                                            


                    lab_grid.dataSource.read(); //school units view or labs view depending on the current view

                }else if(data.status == 500){
                    
                        notification.show({
                            title: "Η ενημέρωση της Διάταξης Η/Υ απέτυχε",
                            message: data.message
                        }, "error");
                }

            }//,
            //error: function (data){ console.log("ΛΑΘΟΣ AJAX REQUEST: ", data);}
    });
        
}