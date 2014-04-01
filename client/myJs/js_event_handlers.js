//  Σύνοψη Πλήθους Διατάκεων Η/Υ
$("body").on("click", "a.a-sepehy", function(e){
    e.preventDefault();
    var detailRow = $(this).closest(".k-detail-row");
    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read({ "lab_type" : "ΣΕΠΕΗΥ" });
    //$(this).closest("li").addClass("lab_type_selected");
});
$("body").on("click", "a.a-troxilato", function(e){
    e.preventDefault();
    var detailRow = $(this).closest(".k-detail-row");
    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read({ "lab_type" : "ΤΡΟΧΗΛΑΤΟ" });                                            
});
$("body").on("click", "a.a-tomea", function(e){
    e.preventDefault();
    var detailRow = $(this).closest(".k-detail-row");
    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read({ "lab_type" : "ΕΤΠ" });                                            
});
$("body").on("click", "a.a-gwnia", function(e){
    e.preventDefault();
    var detailRow = $(this).closest(".k-detail-row");
    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read({ "lab_type" : "ΓΩΝΙΑ" });                                            
});
$("body").on("click", "a.a-diadrastiko", function(e){
    e.preventDefault();
    var detailRow = $(this).closest(".k-detail-row");
    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read({ "lab_type" : "ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ" });                                            
});
$("body").on("click", "a.a-all", function(e){
    e.preventDefault();
    var detailRow = $(this).closest(".k-detail-row");
    detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();                                            
});


//  edit, save OR preview lab details (equipment, aquisition_sources etc..)
$("body").on("click", "#edit_lab_equipment", function(e){

    var tab_grid1 = $(this).next().find("div#tab1.k-grid");
    var tab_grid2 = $(this).next().find("div#tab2.k-grid");
    var tab_grid3 = $(this).next().find("div#tab3.k-grid");
    
    tab_grid1.data("kendoGrid").showColumn(2);
    tab_grid1.find("div.k-toolbar").show();
    tab_grid2.data("kendoGrid").showColumn(2);
    tab_grid2.find("div.k-toolbar").show();
    tab_grid3.data("kendoGrid").showColumn(2);
    tab_grid3.find("div.k-toolbar").show();
    $(this).attr("id","preview_lab_equipment");
    $(this).attr("class", "btn btn-default btn-xs");
    $(this).html("<span class='glyphicon glyphicon-search'></span>  επισκόπηση");
});
$("body").on("click", "#preview_lab_equipment", function(e){
 
    var tab_grid1 = $(this).next().find("div#tab1.k-grid");
    var tab_grid2 = $(this).next().find("div#tab2.k-grid");
    var tab_grid3 = $(this).next().find("div#tab3.k-grid");

    tab_grid1.data("kendoGrid").hideColumn(2);
    tab_grid1.find("div.k-toolbar").hide();
    tab_grid2.data("kendoGrid").hideColumn(2);
    tab_grid2.find("div.k-toolbar").hide();
    tab_grid3.data("kendoGrid").hideColumn(2);
    tab_grid3.find("div.k-toolbar").hide();
    $(this).attr("id","edit_lab_equipment");   
    $(this).attr('class', 'btn btn-primary btn-xs');
    $(this).html("<span class='glyphicon glyphicon-pencil'></span>  επεξεργασία"); 
});

$("body").on("click", "#edit_responsibles", function(e){
           
    var lab_worker_grid = $(this).next();
    lab_worker_grid.data("kendoGrid").showColumn(5);
    lab_worker_grid.find("div.k-toolbar").show();
  
    $(this).attr("id","preview_lab_responsible");
    $(this).attr("class", "btn btn-default btn-xs");
    $(this).html("<span class='glyphicon glyphicon-search'></span>  επισκόπηση");
});
$("body").on("click", "#preview_lab_responsible", function(e){

    var lab_worker_grid = $(this).next();
    lab_worker_grid.data("kendoGrid").hideColumn(5);
    lab_worker_grid.find("div.k-toolbar").hide();
 
    $(this).attr("id","edit_responsibles");
    $(this).attr("class", "btn btn-primary btn-xs");
    $(this).html("<span class='glyphicon glyphicon-pencil'></span>  επεξεργασία");
    
});

$("body").on("click", "#edit_relations", function(e){
           
    var relations_grid = $(this).next();
    relations_grid.data("kendoGrid").showColumn(3);
    relations_grid.find("div.k-toolbar").show();
  
    $(this).attr("id","preview_relations");
    $(this).attr("class", "btn btn-default btn-xs");
    $(this).html("<span class='glyphicon glyphicon-search'></span>  επισκόπηση");
});
$("body").on("click", "#preview_relations", function(e){

    var relations_grid = $(this).next();
    relations_grid.data("kendoGrid").hideColumn(3);
    relations_grid.find("div.k-toolbar").hide();
 
    $(this).attr("id","edit_relations");
    $(this).attr("class", "btn btn-primary btn-xs");
    $(this).html("<span class='glyphicon glyphicon-pencil'></span>  επεξεργασία");
    
});

$("body").on("click", "#edit_aquisition_sources", function(e){  
  
    var aquisition_sources_grid = $(this).next();
    aquisition_sources_grid.data("kendoGrid").showColumn(3);
    aquisition_sources_grid.find("div.k-toolbar").show();
  
    $(this).attr("id","preview_aquisition_sources");
    $(this).attr("class", "btn btn-default btn-xs");
    $(this).html("<span class='glyphicon glyphicon-search'></span>  επισκόπηση");  
  
});
$("body").on("click", "#preview_aquisition_sources", function(e){

    var aquisition_sources_grid = $(this).next();
    aquisition_sources_grid.data("kendoGrid").hideColumn(3);
    aquisition_sources_grid.find("div.k-toolbar").hide();
 
    $(this).attr("id","edit_aquisition_sources");
    $(this).attr("class", "btn btn-primary btn-xs");
    $(this).html("<span class='glyphicon glyphicon-pencil'></span>  επεξεργασία");
    
});

$("body").on("click", "#edit_general", function(e){
  
    var positioning_info = $(this).next().find(".general_info_item1>.full_data>.general_info_data").text();
    $(this).next().find(".general_info_item1>.full_data").html('<textarea id="edit_positioning" class="k-textbox general_info_data" name="edit_positioning">' + positioning_info + '</textarea>');
  
    var special_name_info = $(this).next().find(".general_info_item2>.full_data>.general_info_data").text();
    $(this).next().find(".general_info_item2>.full_data").html('<textarea id="edit_special_name" class="k-textbox general_info_data" name="edit_special_name">' + special_name_info + '</textarea>');
    
    $(this).attr("id","save_general");
    $(this).attr("class", "btn btn-success btn-xs");
    $(this).html("<span class='glyphicon glyphicon-save'></span>  αποθήκευση");  
  
});
$("body").on("click", "#save_general", function(e){

    var positioning_info = document.getElementById("edit_positioning").value;
    var special_name_info = document.getElementById("edit_special_name").value;
 
    var lab_id = $(this).closest(".k-detail-row").prev().children().eq(1).text();
 
    var parameters = {
             lab_id: lab_id,
             positioning: positioning_info,
             special_name: special_name_info
           };

   $.ajax({
           type: 'PUT',
           //url: 'http://mmsch/mylab_ver4/api/labs',
           url: 'http://172.16.16.80/mylab_ver4/api/labs',
           dataType: "json",
           data: JSON.stringify(parameters),
           success: function(data){

//               if(data.status == 200){
//
//                   detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();
//
//               }else if(data.status == 500){
//
//                   detailRow.find(".details-row>#labs-grid").data("kendoGrid").dataSource.read();
//               }
           },
           error: function (data){
               console.log("error data: ", data);
           }
   });
 
   $(this).next().find(".general_info_item1>.full_data").html('<span class="general_info_data">' + positioning_info  + '</span>');
   $(this).next().find(".general_info_item2>.full_data").html('<span class="general_info_data">' + special_name_info  + '</span>');
 
   $(this).attr("id","edit_general");
   $(this).attr("class", "btn btn-primary btn-xs");
   $(this).html("<span class='glyphicon glyphicon-pencil'></span>  επεξεργασία");
    
});

$("body").on("click", "#edit_rating", function(e){
    
    var operational_rating = $(this).next().find(".oRating_info_item>.rating_data>#oRating>input").val();
    var technological_rating = $(this).next().find(".tRating_info_item>.rating_data>#tRating>input").val();

    var oRating = $(this).next().find(".oRating_info_item>.rating_data>#oRating").raty({ score: operational_rating, path: 'client/img/raty' });
    var tRating = $(this).next().find(".tRating_info_item>.rating_data>#tRating").raty({ score: technological_rating, starOff: 'off.png', starOn: 'on.png', path: 'client/img/raty' });
    
    $(this).attr("id","save_rating");
    $(this).attr("class", "btn btn-success btn-xs");
    $(this).html("<span class='glyphicon glyphicon-save'></span>  αποθήκευση");  
  
});
$("body").on("click", "#save_rating", function(e){

    var operational_rating = $(this).next().find(".oRating_info_item>.rating_data>#oRating>input").val();
    var technological_rating = $(this).next().find(".tRating_info_item>.rating_data>#tRating>input").val();
 
    var lab_id = $(this).closest(".k-detail-row").prev().children().eq(1).text();
 
    var parameters = {
             lab_id: lab_id,
             operational_rating: operational_rating,
             technological_rating: technological_rating
           };

   $.ajax({
           type: 'PUT',
           url: 'http://172.16.16.80/mylab_ver4/api/labs',
           dataType: "json",
           data: JSON.stringify(parameters)//,
//           success: function(data){},
//           error: function (data){ console.log("error data: ", data); }
   });
 
   $(this).next().find(".oRating_info_item>.rating_data>#oRating").raty({ readOnly: true, score: operational_rating, path: 'client/img/raty' });
   $(this).next().find(".tRating_info_item>.rating_data>#tRating").raty({ readOnly: true, score: technological_rating, starOff: 'off.png', starOn: 'on.png', path: 'client/img/raty' });
 
   $(this).attr("id","edit_rating");
   $(this).attr("class", "btn btn-primary btn-xs");
   $(this).html("<span class='glyphicon glyphicon-pencil'></span>  επεξεργασία");
    
});