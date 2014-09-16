<!DOCTYPE html>

<div id="statistics-container"  data-bind="visible: isVisible">

    <div id="statistics-parameters" class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="statistics-form">

                    <div class="col-md-11" style="margin:20px 0px 25px 0px;">
                        <button class="k-button" data-bind="click: resetForm">καθαρισμός</button>
                        <button class="k-button" data-bind="click: getStatistic">Προβολή Στατιστικού</button>
                    </div>
                    
                    <div class="col-md-11">
                        <label for="x_axis">Άξονας x: Επιλέξτε με ποια παράμετρο επιθυμείτε να πληθυσμώσετε τις στήλες του στατιστικού πίνακα</label>
                    </div>
                    <div class="col-md-11" style="margin:5px 0px;">
                        <input id="st_x_axis"  
                                name="x_axis"
                                data-role="combobox"
                                data-auto-bind="true"
                                data-text-field="name"
                                data-value-field="axis_name"
                                data-bind="source: axis_x_ds, value: x_axis "
                                data-filter="contains"/>
                    </div>
                    
                    <div class="col-md-11">
                        <label for="y_axis"> Άξονας y: Επιλέξτε με ποια παράμετρο επιθυμείτε να πληθυσμώσετε τις γραμμές του στατιστικού πίνακα</label>
                    </div>
                    <div class="col-md-11" style="margin:5px 0px;">
                       <input id="st_y_axis"  
                                name="y_axis"
                                data-role="combobox"
                                data-ignore-case= "false"
                                data-text-field="name"
                                data-value-field="axis_name"
                                data-bind="source: axis_y_ds, value: y_axis"
                                data-filter="contains"/>
                    </div>
                    
                    <div class="col-md-11" style="margin:10px 0px 20px 0px;">
                        <label> Φίλτρα : Επιλέξτε ένα ή περισσότερα φίλτρα για την αποτελεσματικότερη εξαγωγή στατιστικών </label>
                    </div>
                    
                    <div class="row" style="padding:20px;">

                        <div class="col-md-4">

                            <div class="col-md-11">
                                <label for="lab_type">τύπος Διάταξης Η/Υ</label>
                            </div>
                            <div class="col-md-11">
                                <select id="st_lab_types"  
                                        name="lab_type"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="name"
                                        data-bind="source: lab_types_ds, value: lab_type"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">
                                </select>
                            </div>

                            <div class="col-md-11">
                                <label for="lab_state">λειτουργική κατάσταση Διάταξης Η/Υ</label>
                             </div>
                            <div class="col-md-11">
                                <select id="st_lab_state" 
                                       name="lab_state"
                                       data-role="multiselect"
                                       data-auto-bind="false"
                                       data-text-field="name"
                                       data-value-field="state_id"
                                       data-filter="contains"
                                       data-bind="source: lab_states_ds, value: lab_state"
                                       data-placeholder="επιλέξτε από τη λίστα"
                                       multiple="multiple">
                                </select>
                             </div>                                    

                            <div class="col-md-11">
                                <label for="operational_rating">λειτουργική βαθμολόγηση</label>
                            </div>
                            <div class="col-md-11">
                                <select id="st_operational_rating" 
                                        name="operational_rating"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="rating_id"
                                        data-bind="source: lab_rating_ds, value: operational_rating"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">
                                </select>
                            </div>

                            <div class="col-md-11">
                                <label for="technological_rating">τεχνολογική βαθμολόγηση</label>
                             </div>
                            <div class="col-md-11">
                                <select id="st_technological_rating" 
                                        name="technological_rating"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="rating_id"
                                        data-bind="source: lab_rating_ds, value: technological_rating"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">
                                </select>
                             </div>

                        </div>

                        <div class="col-md-4">

                            <div class="col-md-11">
                                <label for="education_level">Βαθμίδα Εκπαίδευσης</label>
                            </div>
                            <div class="col-md-11">
                                <select id="sl_education_level" 
                                        name="education_level"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="education_level_id"
                                        data-bind="source: education_levels_ds, value: education_level"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">
                                </select> 
                            </div>

                            <div class="col-md-11">
                                <label for="school_unit_type">τύπος Σχολικής Μονάδας</label>                                    
                            </div>
                            <div class="col-md-11">
                                <select id="sl_school_unit_type" 
                                        name="school_unit_type"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="school_unit_type_id"
                                        data-bind="source: school_unit_types_ds, value: school_unit_type"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">  
                                </select>                           
                            </div>                                

                            <div class="col-md-11">
                                <label for="school_unit_state">λειτουργική κατάσταση Σχολικής Μονάδας</label>
                            </div>
                            <div class="col-md-11">
                                <select id="sl_school_unit_state" 
                                        name="school_unit_state"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="state_id"
                                        data-filter="contains"
                                        data-bind="source: school_unit_states_ds, value: school_unit_state"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">
                                </select>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="col-md-11">
                                <label for="region_edu_admin">Περιφερειακή Διεύθυνση Εκπαίδευσης</label> <!--data-bind="visible: regionEduAdminVisible"-->
                            </div>                                
                            <div class="col-md-11">
                                <select id="st_region_edu_admin" 
                                        name="region_edu_admin"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-value-primitive="true"
                                        data-text-field="name"
                                        data-value-field="region_edu_admin_id"
                                        data-bind="source: region_edu_admins_ds, value: region_edu_admin"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">                    
                                </select>  
                            </div>

                            <div class="col-md-11">
                                <label for="edu_admin">Διεύθυνση Εκπαίδευσης</label> <!--data-bind="visible: eduAdminVisible-->
                            </div>                                
                            <div class="col-md-11">
                                <select id="st_edu_admin" 
                                        name="edu_admin"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="edu_admin_id"
                                        data-bind="source: edu_admins_ds, value: edu_admin"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">
                                </select>
                            </div>

                            <div class="col-md-11">
                                <label for="transfer_area">Περιοχή Μετάθεσης</label>
                            </div>                                
                            <div class="col-md-11">
                                <select id="st_transfer_area" 
                                        name="transfer_area"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="transfer_area_id"
                                        data-bind="source: transfer_areas_ds, value: transfer_area"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">
                                </select>                       
                            </div>

                            <div class="col-md-11">
                                <label for="prefecture">Νομός</label>
                            </div>                                
                            <div class="col-md-11">
                                <select id="st_prefecture" 
                                        name="prefecture"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="prefecture_id"
                                        data-bind="source: prefectures_ds, value: prefecture"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">
                                </select>
                            </div>                                    

                            <div class="col-md-11">
                                <label for="municipality">Δήμος</label>
                            </div>                                
                            <div class="col-md-11">
                                <select id="st_municipality" 
                                        name="municipality"
                                        data-role="multiselect"
                                        data-auto-bind="false"
                                        data-text-field="name"
                                        data-value-field="municipality_id"
                                        data-bind="source: municipalities_ds, value: municipality"
                                        data-filter="contains"
                                        data-placeholder="επιλέξτε από τη λίστα"
                                        multiple="multiple">
                                </select>
                            </div>                                

                        </div>                                

                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <div id="statistics-results" class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-12">

                <table id="statistics-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </div>
    </div>

</div>

