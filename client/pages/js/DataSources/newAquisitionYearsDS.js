function newAquisitionYearsDS(since_year){
    
    var years = new Array();
    var date = new Date();
    var currentYear = date.getFullYear();
    for(var year=since_year; year<=currentYear; year++){
            years[year-since_year] = {year : year} ;
    }
    years.reverse();
    
    var aquisition_years_ds =  new kendo.data.DataSource({
                                    data: years,
                                    schema: {
                                        model:{
                                            id: "year",
                                            fields:{
                                                year: {editable: false}
                                            }
                                        }
                                    }
                                });
    //console.log("aquisition_years_ds", aquisition_years_ds);
    return aquisition_years_ds;
    
}