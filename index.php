<!DOCTYPE html>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <?php require_once('includes.html');?>
        
        <script>
                      
            $(document).ready(function() {
            

                baseURL = "http://mmsch.teiath.gr/mylab/api/";

                kendo.bind($("#labs_container"), LabsViewVM);
                kendo.bind($("#labs_container").find(".k-grid-toolbar"), LabsViewVM);                
                kendo.bind($("#school_units_container"), SchoolUnitsViewVM);
                kendo.bind($("#search-container"), SearchVM);
                
                //kendo.bind($("#switch_view"), SchoolUnitsViewVM);
                kendo.bind($("#switch_view"), LabsViewVM);
                
                notification = $("#notification").kendoNotification({
                    position: {
                        pinned: true,
                        top: 30,
                        right: 30
                    },
                    allowHideAfter: 2000,
                    autoHideAfter: 5000,
                    hideOnClick: true,
                    stacking: "down",
                    //button: true, //??? γιατι δεν παίζει?
                    templates: [{
                        type: "error",
                        template: $("#errorTemplate").html()
                    }, {
                        type: "upload-success",
                        template: $("#successTemplate").html()
                    }]

                }).data("kendoNotification");
                              
            });
            
        </script>
        
    </head>
    
    <body>
        
        <?php 
                require_once('navigation_bar.php'); //navigation bar
        ?>
        <div style='height:90px'> </div>    
        <?php
                require_once('search.html'); //search pane
                require_once('switch_views.html'); //switch views button
                require_once('labs_view_try.php'); //labs view
                require_once('school_units_view_try.php'); //school units view
        ?>
        
    </body>
</html>