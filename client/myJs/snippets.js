var school_unit_contact_details_snippet = '<h4>Στοιχεία Επικοινωνίας</h4>\
                                        <div id="contact-details">\
                                                <div class="contact-details-mail">\
                                                        <div class="full_contact_label">\
                                                                <span class="glyphicon glyphicon-envelope"></span>\
                                                                <span class="contact_info_label"> E-mail </span>\
                                                        </div>\
                                                        <div class="full_data">\
                                                                <span class="contact_info_data"></span>\
                                                        </div>\
                                                </div>\
                                                <div class="contact-details-phone">\
                                                        <div class="full_contact_label">\
                                                                <span class="glyphicon glyphicon-phone-alt"></span>\
                                                                <span class="contact_info_label"> Τηλέφωνο </span>\
                                                        </div>\
                                                        <div class="full_data">\
                                                                <span class="contact_info_data"></span>\
                                                        </div>\
                                                </div>\
                                                <div class="contact-details-address">\
                                                        <div class="full_contact_label">\
                                                                <span class="glyphicon glyphicon-home"></span>\
                                                                <span class="contact_info_label"> Διεύθυνση </span>\
                                                        </div>\
                                                        <div class="full_data">\
                                                                <span class="contact_info_data"></span>\
                                                        </div>\
                                                </div>\
                                                <div class="contact-details-principal">\
                                                        <div class="full_contact_label">\
                                                                <span class="glyphicon glyphicon-user"></span>\
                                                                <span class="contact_info_label"> Διευθυντής </span>\
                                                        </div>\
                                                        <div class="full_data">\
                                                                <span class="contact_info_data"></span>\
                                                        </div>\
                                                </div>\
                                        </div>';


var labs_summary_snippet = '<h4>Σύνοψη Πλήθους Διατάξεων Η/Υ <a class="a-all" href="#" style="font-size: 9px; vertical-align: middle;">(σύνολο)</a> </h4>\
                                        <div id="lab-summary">\
                                                <div id="sepehy">\
                                                        <div class="lab_summary_full_label">\
                                                                <span class="label label-default"> </span></span>\
                                                                <span class="lab_summary_label"> ΣεπεΗΥ </span>\
                                                        </div>\
                                                        <div class="full_data">\
                                                                <span class=""></span>\
                                                        </div>\
                                                </div>\
                                                <div id="troxilato">\
                                                        <div class="lab_summary_full_label">\
                                                                <span class="label label-default"> </span>\
                                                                <span class="lab_summary_label"> Τροχήλατο </span>\
                                                        </div>\
                                                        <div class="full_data">\
                                                                <span class=""></span>\
                                                        </div>\
                                                </div>\
                                                <div id="tomea">\
                                                        <div class="lab_summary_full_label">\
                                                                <span class="label label-default"> </span>\
                                                                <span class="lab_summary_label"> ΕΤΠ </span>\
                                                        </div>\
                                                        <div class="full_data">\
                                                                <span class=""></span>\
                                                        </div>\
                                                </div>\
                                                <div id="gwnia">\
                                                        <div class="lab_summary_full_label">\
                                                                <span class="label label-default"> </span>\
                                                                <span class="lab_summary_label"> Γωνιά </span>\
                                                        </div>\
                                                        <div class="full_data">\
                                                                <span class=""></span>\
                                                        </div>\
                                                </div>\
                                                <div id="diadrastiko">\
                                                        <div class="lab_summary_full_label">\
                                                                <span class="label label-default"> </span>\
                                                                <span class="lab_summary_label"> Διαδραστικό Σύστημα </span>\
                                                        </div>\
                                                        <div class="full_data">\
                                                                <span class=""></span>\
                                                        </div>\
                                                </div>\
                                        </div>';



var navigation_bar = '<div id="panelbar">\
                        <nav class="navbar navbar-default" role="navigation">\
                            <ul id="lab-details-panelbar" class="nav navbar-nav">\
                                <li class="active">\
                                    <a data-toggle="tab" href="#equipment_tab" >\
                                        <i class="fa fa-desktop" data-toggle="tooltip" data-placement="top" title="εξοπλισμός"></i>\
                                    </a>\
                                </li>\
                                <li class="">\
                                    <a data-toggle="tab" href="#aquisition_sources_tab">\
                                        <i class="fa fa-eur" data-toggle="tooltip" data-placement="top" title="πηγές χρηματοδότησης"></i>\
                                    </a>\
                                </li>\
                                <li class="">\
                                    <a data-toggle="tab" href="#lab_workers_tab">\
                                        <i class="fa fa-user" data-toggle="tooltip" data-placement="top" title="υπεύθυνος"></i>\
                                    </a>\
                                </li>\
                                <li class="">\
                                    <a data-toggle="tab" href="#lab_relations_tab">\
                                        <i class="fa fa-link" data-toggle="tooltip" data-placement="top" title="συσχετίσεις"></i>\
                                    </a>\
                                </li>\
                                <li class="">\
                                    <a data-toggle="tab" href="#lab_transitions_tab">\
                                        <i class="fa fa-random" data-toggle="tooltip" data-placement="top" title="μεταβάσεις κατάστασης"></i>\
                                    </a>\
                                </li>\
                                <li class="">\
                                    <a data-toggle="tab" href="#general_tab">\
                                        <i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="γενικές πληροφορίες"></i>\
                                    </a>\
                                </li>\
                                <li class="">\
                                    <a data-toggle="tab" href="#rating_tab">\
                                        <i class="fa fa-star" data-toggle="tooltip" data-placement="top" title="βαθμολογία"></i>\
                                    </a>\
                                </li>\
                            </ul>\
                        </nav>\
                        <div id="labDetailsTabContent" class="tab-content">\
                            <div id="equipment_tab" class="tab-pane fade active in"></div>\
                            <div id="aquisition_sources_tab" class="tab-pane fade"></div>\
                            <div id="lab_workers_tab" class="tab-pane fade"></div>\
                            <div id="lab_relations_tab" class="tab-pane fade"></div>\
                            <div id="lab_transitions_tab" class="tab-pane fade"></div>\
                            <div id="general_tab" class="tab-pane fade"></div>\
                            <div id="rating_tab" class="tab-pane fade"></div>\
                        </div>\
                    </div>';


var lab_equipment_snippet = "<div id='tabstrip'>\
                            <ul id='tabstrip-headers'> \
                                <li id='tab_1' class='k-state-active'>Υπολογιστικός Εξοπλισμός</li> \
                                <li id='tab_2'>Δικτυακός Εξοπλισμός</li> \
                                <li id='tab_3'>Περιφερειακές Συσκευές</li> \
                            </ul> \
                            <div> \
                              <div id='tab1' class='k-grid'></div> \
                            </div>\
                            <div> \
                              <div id='tab2' class='k-grid'></div> \
                            </div>\
                            <div> \
                              <div id='tab3' class='k-grid'></div> \
                            </div>\
                        </div>";


//var lab_blockquote_equipment = "<blockquote id='blockquote_equipment'>\
//                                    <i class='fa fa-chevron-right'></i>\
//                                    <span>Εξοπλισμός</span>\
//                                </blockquote>\
//                                <div id='equipment_block' class='blockquote_block' style='display:none'></div>";
//
//var lab_blockquote_aquisition_sources = "<blockquote id='blockquote_aquisition_sources'>\
//                                            <i class='fa fa-chevron-right'></i>\
//                                            <span>Πηγές Χρηματοδότησης</span>\
//                                        </blockquote>\
//                                        <div id='aquisition_sources_block' class='blockquote_block' style='display:none'></div>";
//
//var lab_blockquote_responsible = "<blockquote id='blockquote_lab_worker'>\
//                                            <i class='fa fa-chevron-right'></i>\
//                                            <span>Υπεύθυνος</span>\
//                                  </blockquote>\
//                                  <div id='responsibles_block' class='blockquote_block' style='display:none'></div>";
//
//var lab_blockquote_relations = "<blockquote id='blockquote_relations'>\
//                                    <i class='fa fa-chevron-right'></i>\
//                                    <span>Συσχετίσεις με Σχολικές Μονάδες</span>\
//                                </blockquote>\
//                                <div id='relations_block' class='blockquote_block' style='display:none'></div>";
//
//var lab_blockquote_transitions = "<blockquote id='blockquote_transitions'>\
//                                    <i class='fa fa-chevron-right'></i>\
//                                    <span>Μεταβάσεις Κατάστασης</span>\
//                                  </blockquote>\
//                                  <div id='transitions_block' class='blockquote_block' style='display:none'></div>";
//
//var lab_blockquote_general = "<blockquote id='blockquote_general'>\
//                                    <i class='fa fa-chevron-right'></i>\
//                                    <span>Γενικές Πληροφορίες</span>\
//                                  </blockquote>\
//                                  <div id='general_block' class='blockquote_block' style='display:none'></div>";
//
//var lab_blockquote_rating = "<blockquote id='blockquote_rating'>\
//                                    <i class='fa fa-chevron-right'></i>\
//                                    <span>Αξιολόγηση</span>\
//                                  </blockquote>\
//                                  <div id='rating_block' class='blockquote_block' style='display:none'></div>";




//var lab_worker_snippet = "<div id='lab_worker_details'>\
//                                    <ul id='name_details'>\
//                                        <li id='name_title' class='title'></li>\
//                                        <li id='name_data'></li>\
//                                    </ul>\
//                                    <ul id='registry_number_details'>\
//                                        <li id='registry_number_title' class='title'></li>\
//                                        <li id='registry_number_data'></li>\
//                                    </ul>\
//                                    <ul id='specialization_code_details'>\
//                                        <li id='specialization_code_title' class='title'></li>\
//                                        <li id='specialization_code_data'></li>\
//                                    </ul>\
//                                    <ul id='email_details'>\
//                                        <li id='email_title' class='title'></li>\
//                                        <li id='email_data'></li>\
//                                    </ul>\
//                                    <ul id='employment_relationship_details'>\
//                                        <li id='employment_relationship_title' class='title'></li>\
//                                        <li id='employment_relationship_data'></li>\
//                                    </ul>\
//                              </div>";
      

//var sepehy_input_fields = "<div class='form-group'>\
//                            <label for='lab_worker' class='required'>AM Υπεύθυνου Διάταξης Η/Υ</label>\
//                            <input id='labWorkerRegistryNo' name='lab_worker' required data-required-msg='το πεδίο υπεύθυνος Διάταξης Η/Υ ειναι υποχρεωτικό'/>\
//                          </div>\
//                          <div class='form-group'>\
//                            <label for='email' class='required'>Ηλ. Ταχυδρομείο Υπεύθυνου Διάταξης Η/Υ</label>\
//                            <input type='email' class='form-control input-sm' name='email'  data-bind='value:email'  required data-required-msg='το πεδίο διεύθυνση ηλ.ταχυδρομείου ειναι υποχρεωτικό' data-email-msg='η διευθυνση ηλ. ταχυδρομείου δεν ειναι έγκυρη'/>\
//                          </div>";
//
//var lab_create_btn = "<button class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModal'>\
//                        Προσθήκη Διάταξης Η/Υ\
//                      </button>";

