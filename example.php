<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title class="navbarTitle">myLab</title>

    
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/kendo.common-bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/kendo.bootstrap.min.css" >
    
    
    <!--kendo css files-->
    <link rel="stylesheet" href="client/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="client/styles/kendo.default.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/kendo.common-bootstrap.min.css" >      <!--new one--> 
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/kendo.bootstrap.min.css" >             <!--new one--> 
    
    <!--bootstrap css files-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="client/styles/bootstrap.css" >  modified by me -->
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/bootstrap.icon-large.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="client/styles/bootstrap-responsive.min.css" >
    
    <!--font-awesome-4.0.3-->
    <link rel="stylesheet" type="text/css" media="screen" href="client/font-awesome-4.0.3/css/font-awesome.min.css" >
    
    <!--custom css files-->
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/myLabStyles.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/searchForm.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/infoPane.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/labEquipmentTabstrip.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/schoolUnitsGridDetailRow.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/labsGridDetailRow.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/labCreationForm.css">
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/alerts.css" >
    <link rel="stylesheet" type="text/css" media="screen" href="client/myCss/statisticsForm.css" >
    
    <!--select2 css files-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="client/select2-3.4.5/select2.css">-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="client/select2-3.4.5/select2-bootstrap.css">-->
    
    
    <!--jquery js files-->
    <script src="client/js/jquery.min.js"></script>
    <script src="client/js/jquery-ui-1.10.3.custom.min.js"></script>
    <!--bootstrap js files-->
    <script src="client/js/bootstrap.min.js"></script>
    <!--select2 js files-->
    <!--<script src="client/select2-3.4.5/select2.min.js"></script>-->
    <!--kendo js files-->
    <script src="client/src/js/kendo.web.js"></script>
    <!--custom js files-->
    <script type="text/javascript" src="client/myJs/jquery.scrollTo-1.4.3.1-min.js"></script>
    <script type="text/javascript" src="client/myJs/DataSources.js"></script>
    <script type="text/javascript" src="client/myJs/snippets.js"></script>
    
    <script type="text/javascript" src="client/myJs/raty-2.5.2/lib/jquery.raty.min.js"></script>
    <script type="text/javascript" src="jquery.bootstrap.wizard.js"></script>
    
    
    <script>
        $(document).ready(function() {
            
                var index = 0;

            $("#views-bar-buttons button").click(function() {
                
                var target = parseInt($(this).data("index"));
        
                if (target === index) {
                    return;
                }
                
                $("#home" + target).show();
                $("#home" + index).hide();
        
                index = target;
            });
            
        });
    </script>
    
</head>

<div id="views-bar" class="container">
    <div id="views-bar-buttons" class="btn-group" style="margin: 9px 0 5px;">
        <button id="school_unit_view" data-index="0" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="όψη Σχολικών Μονάδων"><i class="fa fa-bell"></i></button>
        <button id="lab_view" data-index="1" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="όψη Διατάξεων Η/Υ"><i class="fa fa-flask"></i></button>
        <button id="lab_worker_view" data-index="2" class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="όψη Υπευθύνων Διατάξεων Η/Υ"><i class="fa fa-users"></i></button>
    </div>
</div>
<div id="general-container" class="container">        
    <div class="row">          
        <div class="col-md-12">
            <div id="home0">
                geia sou ti kaneis kala esi kala ki egw mia xarageia sou ti kaneis kala esi kala ki egw mia xara
                geia sou ti kaneis kala esi kala ki egw mia xarageia sou ti kaneis kala esi kala ki egw mia xarageia sou ti kaneis kala esi kala ki egw mia xara
                geia sou ti kaneis kala esi kala ki egw mia xarageia sou ti kaneis kala esi kala ki egw mia xarageia sou ti kaneis kala esi kala ki egw mia xara
                geia sou ti kaneis kala esi kala ki egw mia xarageia sou ti kaneis kala esi kala ki egw mia xarageia sou ti kaneis kala esi kala ki egw mia xara
            </div>
            <div id="home1" style="display: none">
                wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww 
                wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
            </div>
            <div id="home2" style="display: none">
                aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            </div>
        </div>
    </div>
</div>


