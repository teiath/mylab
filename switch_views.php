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

        var view_1 = { id: 1, name: "Προβολή Διατάξεων Η/Υ", logo: "fa fa-search fa-lg"};
        var view_2 = { id: 2, name: "Προβολή Σχολικών Μονάδων", logo: "fa fa-search fa-lg"};
        var view_3 = { id: 3, name: "Στατιστικά", logo: "fa fa-bar-chart-o fa-lg"};
        var view_4 = { id: 4, name: "Σχετικά", logo: "fa fa-user fa-lg"};
        
        var views;
        var bootstrap_class;
        
        switch(authorized_user) {
            case 'ΚΕΠΛΗΝΕΤ':
                views = [view_1, view_2, view_3, view_4];
                bootstrap_class = "col-md-3";
                break;
            case  'ΣΕΠΕΗΥ' :
                views = [view_1, view_2, view_4];
                bootstrap_class = "col-md-4";
                break;
            case  'ΕΤΠ' :
                views = [view_1, view_2, view_4];
                bootstrap_class = "col-md-4";
                break;
            case  'ΠΣΔ' :
                views = [view_1, view_2, view_3, view_4];
                bootstrap_class = "col-md-3";
                break;
            case  'ΔΙΕΥΘΥΝΤΗΣ' :
                views = [view_1, view_4];
                bootstrap_class = "col-md-6";
                break;
            case  'ΤΟΜΕΑΡΧΗΣ' :
                views = [view_1, view_4];
                bootstrap_class = "col-md-6";
                break;
            case  'ΥΠΕΠΘ' :
                views = [view_1, view_2, view_3, view_4];
                bootstrap_class = "col-md-3";
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

        function switchView(e){
            
            var koko;
            
            var data = dataSource.view();
            var selected = $.map(this.select(), function(item) {
                    koko =  data[$(item).index()].id;
                    return koko;
                });

            switch(koko) {
                case 1:
                    LabsViewVM.set("isVisible", true);
                    SchoolUnitsViewVM.set("isVisible", false);
                    StatisticsVM.set("isVisible", false);
                    SearchVM.set("isVisible", true);
                    InfoVM.set("isVisible", false);
                    break;
                case 2:
                    LabsViewVM.set("isVisible", false);
                    SchoolUnitsViewVM.set("isVisible", true);
                    StatisticsVM.set("isVisible", false);
                    SearchVM.set("isVisible", true);
                    InfoVM.set("isVisible", false);
                    break;
                case 3:
                    LabsViewVM.set("isVisible", false);
                    SchoolUnitsViewVM.set("isVisible", false);
                    StatisticsVM.set("isVisible", true);
                    SearchVM.set("isVisible", false);
                    InfoVM.set("isVisible", false);
                    break;
                case 4:
                    LabsViewVM.set("isVisible", false);
                    SchoolUnitsViewVM.set("isVisible", false);
                    StatisticsVM.set("isVisible", false);
                    SearchVM.set("isVisible", false);
                    InfoVM.set("isVisible", true);
                    break;
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
    
</style>