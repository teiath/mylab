<!DOCTYPE html>
<div id="switch_views" style="">
    <div class="container">
        <div class="row">
                <div id="listView" class="col-md-12"></div>
        </div>
    </div>
</div>

<script type="text/x-kendo-tmpl" id="template">
    <div class="view col-md-3">
         <i class="#:logo#"></i>
        <h3>#:name#</h3>
    </div>
</script>


<script>
    $(document).ready(function() {
        
//        console.log("authorized_user: ", authorized_user);

        var view_1 = { id: 1, name: "Προβολή Διατάξεων Η/Υ", logo: "fa fa-search fa-lg"};
        var view_2 = { id: 2, name: "Προβολή Σχολικών Μονάδων", logo: "fa fa-search fa-lg"};
        var view_3 = { id: 3, name: "Στατιστικά", logo: "fa fa-bar-chart-o fa-lg"};
        var view_4 = { id: 4, name: "Σχετικά", logo: "fa fa-user fa-lg"};
        
        var views;
        var width;
        
        switch(authorized_user) {
            case 'ΚΕΠΛΗΝΕΤ':
                views = [view_1, view_2, view_3, view_4];
                width= "24.146%";
                break;
            case  'ΣΕΠΕΗΥ' :
                views = [view_1, view_2];
                width= "49.146%";
                break;
            case  'ΠΣΔ' :
                views = [view_1, view_2, view_3, view_4];
                width= "24.146%";
                break;
            case  'ΔΙΕΥΘΥΝΤΗΣ' :
                views = [view_1, view_2, view_4];
                width= "32.48%";
                break;
            case  'ΥΠΕΠΘ' :
                views = [view_1, view_2, view_3, view_4];
                width= "24.146%";
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
        $('#listView').children().css("width", width);  
        
        var listView = $("#listView").data("kendoListView");
        // initially select first list view item
        listView.select(listView.element.children().first());

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
        
    .view {
        cursor: pointer;
        float: left;
        height: 30px;
        margin: 0;
        padding: 5px;
    }
    .view i {
        float: left;
        height: 20px;
        margin: 7px 12px 0;
        width: 20px;
    }
    .view h3 {
        float: left;
        font-family: calibri;
        font-size: 13px;
        margin: 0;
        overflow: hidden;
        padding: 7px 20px;
    }

    .k-listview:after
    {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }
    .k-listview
    {
        padding: 0;
        min-width: 600px;
        min-height: 40px;
    }
</style>