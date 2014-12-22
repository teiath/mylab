<!DOCTYPE html>

<div id="switch_views" class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="listView"></div>
        </div>
    </div>
</div>

<script type="text/x-kendo-tmpl" id="template">
    <div class="view_tab">
         <div class="col-md-12" style="padding:5px 0px; text-align: center;">
            <i class="#:logo#" style="margin:0px 8px;"></i><span>#:name#</span>
         </div>
    </div>
</script>


<script>
    $(document).ready(function() {
        
//        console.log("authorized_user [switch views]: ", authorized_user);

        var view_1 = { id: 1, name: "Διατάξεις Η/Υ", logo: "fa fa-sitemap fa-lg"};
        var view_2 = { id: 2, name: "Σχολικές Μονάδες", logo: "fa fa-university fa-lg"};
        var view_3 = { id: 3, name: "Υπεύθυνοι Διατάξεων Η/Υ", logo: "fa fa-users fa-lg"};
        var view_4 = { id: 4, name: "Στατιστικά", logo: "fa fa-bar-chart-o fa-lg"};
        var view_5 = { id: 5, name: "Στοιχεία Λογαριασμού", logo: "fa fa-user fa-lg"};
        
        var views;
        var bootstrap_class;
        
        switch(authorized_user) {
            case 'ΚΕΠΛΗΝΕΤ':
                views = [view_1, view_2, view_3, view_4, view_5];
                bootstrap_class = "col-md-2 changeColMd2Width";
                break;
            case  'ΣΕΠΕΗΥ' :
                views = [view_1, view_2, view_5];
                bootstrap_class = "col-md-4";
                break;
            case  'ΕΤΠ' :
                views = [view_1, view_2, view_5];
                bootstrap_class = "col-md-4";
                break;
            case  'ΠΣΔ' :
                views = [view_1, view_2, view_3, view_4, view_5];
                bootstrap_class = "col-md-2 changeColMd2Width";
                break;
            case  'ΔΙΕΥΘΥΝΤΗΣ' :
                views = [view_1, view_5];
                bootstrap_class = "col-md-6";
                break;
            case  'ΤΟΜΕΑΡΧΗΣ' :
                views = [view_1, view_5];
                bootstrap_class = "col-md-6";
                break;
            case  'ΥΠΕΠΘ' :
                views = [view_1, view_2, view_3, view_4, view_5];
                bootstrap_class = "col-md-2 changeColMd2Width";
                break;
        }
        
        var dataSource = new kendo.data.DataSource({
            data: views
        });
        
        $("#listView").kendoListView({
            dataSource: dataSource,
            selectable: "single",
            change: switchView,
            template: kendo.template($("#template").html())
        });

        //apply proper width to list tabs according to the number of tabs
        $('#listView').find("div.view_tab").addClass(bootstrap_class);

        var listView = $("#listView").data("kendoListView");
        listView.select(listView.element.children().first()); // initially select first list view item
        
        
        if($('#listView').children().length === 5){
            changeColMd2WidthOnResize($(window).width());
        }        
        
        $(window).resize(function() {
            if($('#listView').children().length === 5){
                changeColMd2WidthOnResize($(window).width());
            }
        });

        function switchView(e){
            
            var koko;
            
            var data = dataSource.view();
            var selected = $.map(this.select(), function(item) {
                    koko =  data[$(item).index()].id;
                    return koko;
                });

            switch(koko) {
                case 1: //καρτέλα 1
                    LabsViewVM.set("isVisible", true);
                    SchoolUnitsViewVM.set("isVisible", false);
                    LabWorkersViewVM.set("isVisible", false);
                    StatisticsVM.set("isVisible", false);
                    InfoVM.set("isVisible", false);
                    ( jQuery.inArray( authorized_user , search_xls ) !== -1 ) ? SearchVM.set("isVisible", true) : SearchVM.set("isVisible", false);
                    SearchLabWorkersVM.set("isVisible", false);
                    break;
                case 2: //καρτέλα 2
                    LabsViewVM.set("isVisible", false);
                    SchoolUnitsViewVM.set("isVisible", true);
                    LabWorkersViewVM.set("isVisible", false);
                    StatisticsVM.set("isVisible", false);
                    InfoVM.set("isVisible", false);
                    ( jQuery.inArray( authorized_user , search_xls ) !== -1 ) ? SearchVM.set("isVisible", true) : SearchVM.set("isVisible", false);
                    SearchLabWorkersVM.set("isVisible", false);
                    break;
                case 3: //καρτέλα 3
                    LabsViewVM.set("isVisible", false);
                    SchoolUnitsViewVM.set("isVisible", false);
                    LabWorkersViewVM.set("isVisible", true);
                    StatisticsVM.set("isVisible", false);
                    InfoVM.set("isVisible", false);
                    SearchVM.set("isVisible", false);
                    SearchLabWorkersVM.set("isVisible", true);
                    break;
                case 4: //καρτέλα 4
                    LabsViewVM.set("isVisible", false);
                    SchoolUnitsViewVM.set("isVisible", false);
                    LabWorkersViewVM.set("isVisible", false);
                    StatisticsVM.set("isVisible", true);
                    InfoVM.set("isVisible", false);
                    SearchVM.set("isVisible", false);
                    SearchLabWorkersVM.set("isVisible", false);
                    break;
                case 5: //καρτέλα 5
                    LabsViewVM.set("isVisible", false);
                    SchoolUnitsViewVM.set("isVisible", false);
                    LabWorkersViewVM.set("isVisible", false);
                    StatisticsVM.set("isVisible", false);
                    InfoVM.set("isVisible", true);
                    SearchVM.set("isVisible", false);
                    SearchLabWorkersVM.set("isVisible", false);
                    break;
            }
        }
        function changeColMd2WidthOnResize(viewport_width){
            if(viewport_width < 992){
                if($('#listView').find("div.view_tab").hasClass("changeColMd2Width")){
                    $('#listView').find("div.view_tab").removeClass("changeColMd2Width");
                }
            }else{
                if(!$('#listView').find("div.view_tab").hasClass("changeColMd2Width")){
                    $('#listView').find("div.view_tab").addClass("changeColMd2Width");
                }
            }
        }
        
        
    });
</script>

<style scoped>
        
    .view_tab {
        cursor: pointer;
    }
    
    .k-listview:after
    {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }
    
    #listView > div{
        padding-left: 0px;
        padding-right: 0px;
    }
    
    .changeColMd2Width {
        width: 20%;
    }
    
</style>