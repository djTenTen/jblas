<?php  $crypt = \Config\Services::encrypter();?>
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            <?= $title?>
                        </h1>
                        <div class="page-header-subtitle"><?= $code.' - '.$header?></div>
                    </div>
                    <div class="col-12 col-xl-auto mt-4">
                        <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                            <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                            <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <?php if (session()->get('invalid_input')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Invalid Input</h6>
                        Something wrong with your data inputd, please try again.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('success_registration')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Registration</h6>
                        Contents has been successfully saved.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('success_update')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Update</h6>
                        Contents has been successfully updated.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed_registration')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Failed Registration</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
                
                <h4>RISK SUMMARY</h4>
                <h6>This form should be completed when a narrative approach to inherent business risk assessment is undertaken. If more than one risk level applies, add additional lines as appropriate.</h6>

                <table class="table table-hover table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th></th>
                            <th colspan="2">Risk Assessment</th>
                            <th>Reference</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <th>Question</th>
                            <th>Planning</th>
                            <th>Finalisation</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach($ac6 as $r){?>
                            <tr>
                                <td><?= $r['question']?></td>
                                <td><?= $r['planning']?></td>
                                <td><?= $r['finalization']?></td>
                                <td><?= $r['reference']?></td>
                                <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                <td>
                                    <button class="btn btn-primary btn-icon btn-sm load-data" type="button" data-bs-toggle="modal" data-bs-target="#modaledit" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['acID']))?>" title="Edit" ><i class="fas fa-edit"></i></button>
                                    <?php if($r['status'] == 'Active'){?>
                                        <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['acID']))?>" data-status="<?= $r['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                    <?php }else{?>
                                        <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['acID']))?>" data-status="<?= $r['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
                

                <br><br>
                <form action="<?= base_url()?>auditsystem/c1/manage/save/AC6/<?= $header?>/<?= $c1tID?>" method="post">

                    <table class="table table-hover table-sm">
                        <thead class="text-center">
                            <tr>
                                <th></th>
                                <th  colspan="2">Risk Assessment</th>
                         
                                <th>Reference</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <th>Question</th>
                                <th>Planning</th>
                                <th>Finalization</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody" class="text-center">
                            
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field" id="add-field">Add Field</button>
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                    

                </form>

                <br>
                <br>

                <h4>NARRATIVE RISK ASSESSMENT INHERENT BUSINESS RISK AND CONTROL ENVIRONMENT ASSESSMENT</h4>
                <p>The risk forms should not be completed until –</p>
                <ul>
                    <li>Appropriate enquiries have been made of management;</li>
                    <li>Points forward from last year have been considered;</li>
                    <li>The permanent audit file has been reviewed; and</li>
                    <li>Preliminary analytical procedures have been carried out.</li>
                </ul>
                <p>Notes on completion of this document –</p>
                <ul>
                    <li>Where significant risks have been identified, the entity's controls relevant to those risks should be understood;</li>
                    <li>Items marked * should be appropriately tailored.</li>
                </ul>
                <p>It should be ensured that appropriate consideration should be given to –</p>
                <ul>
                    <li>Events and conditions that cast significant doubt on the entity’s ability to continue as a Going Concern;</li>
                    <li>The client’s use of Service Organisations and Experts;</li>
                    <li>The impact of litigation, claims and areas of non-compliance with law and regulations on the financial statements;</li>
                    <li>The extent to which transactions with related parties are incorporated into the financial statements;</li>
                    <li>The extent to which there are material figures in the financial statements which are derived from Accounting Estimates.</li>
                </ul>

                <p>Objective: This form is designed to determine the inherent risk of the business as a whole.  PSA 315 implies that all businesses should be high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
                <h4>Section 1 – INHERENT BUSINESS RISK </h4>
                <p>The inherent business risk of the client is deemed to be low / medium / high* for the following reasons:</p>
                <form action="<?= base_url()?>auditsystem/c1/section/update/AC6/<?= $header?>/<?= $c1tID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($s1['acID']))?>" method="post">
                    <textarea class="form-control" cols="30" rows="20" name="section" required><?= $s1['question']?></textarea>
                    <button type="submit" class="btn btn-sm btn-icon btn-success float-end"><i class="fas fa-file-alt"></i></button>
                </form>
                <p>	Comprehensive consideration should be given to all clients even those deemed to be low risk. As part of this review consideration must be given to the Company’s going concern status and I.T. risk.</p>
                <br>
                <p>Objective: This form is designed to assess the adequacy of the entity’s control environment as a whole to determine whether a control based audit approach is appropriate. Section 3 looks at internal controls specific to the audit. To comply with PSA 315, both sections must be completed regardless of whether you intend to test, and if successful, place reliance on the entity’s controls.</p>
                <p>In addition, this form should document the considerations of the risks related to management override of controls.</p>
                <h4>Section 2a – CONSIDERATION OF THE RISK OF MANAGEMENT OVERRIDE OF CONTROLS </h4>
                <p>The risk of management override is present in ALL entities. However, the level of that risk will vary from entity to entity. Where management can override key controls, document here the considerations relating to the level of risk posed by management override and the audit procedures planned to address this risk:</p>
                <form action="<?= base_url()?>auditsystem/c1/section/update/AC6/<?= $header?>/<?= $c1tID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($s2a['acID']))?>" method="post">
                    <textarea class="form-control" cols="30" rows="20" name="section" required><?= $s2a['question']?></textarea>
                    <button type="submit" class="btn btn-sm btn-icon btn-success float-end"><i class="fas fa-file-alt"></i></button>
                </form>
                <br>
                <h4>Section 2b – CONSIDERATION OF THE CONTROL ENVIRONMENT </h4>
                <p>The control environment of the client deemed to be effective / ineffective* for the following reasons: </p>
                <form action="<?= base_url()?>auditsystem/c1/section/update/AC6/<?= $header?>/<?= $c1tID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($s2b['acID']))?>" method="post">
                    <textarea class="form-control" cols="30" rows="20" name="section" required><?= $s2b['question']?></textarea>
                    <button type="submit" class="btn btn-sm btn-icon btn-success float-end"><i class="fas fa-file-alt"></i></button>
                </form>
                <p>Based on the above assessment control testing is / is not * going to be undertaken </p>
                <br>
                <h4>Section 3 - UNDERSTANDING THE DESIGN AND IMPLEMENTATION OF INTERNAL CONTROLS</h4>
                <p>Objective: <br>
                The auditor is required to “obtain an understanding of internal control relevant to the audit. Although most controls relevant to the audit are likely to relate to financial reporting, not all controls that relate to financial reporting are relevant to the audit.” (paragraph 12 of PSA 315).</p>
                <p>The auditor is required to evaluate the design of these controls and determine whether they have been appropriately implemented.  Per paragraph A74 of PSA 315:</p>
                <ul>
                    <li>Evaluating the design of a control involves “considering whether the control, individually or in combination with other controls, is capable of effectively preventing, or detecting and correcting, material misstatements; </li>
                    <li>Implementation of a control means that the control exists, and the entity is using it”.</li>
                </ul>
                <p>Requirement: <br>
                Summarise below the internal controls that are relevant to the audit and evaluate whether those controls are effective. If the controls are considered effective, test that the controls are being used by the entity.   
                </p>
                <p>As per paragraph A75 of PSA 315, the following procedures may be carried out to obtain evidence about the design and implementation of controls: </p>
                <ul>
                    <li>Inquiry of entity personnel;</li>
                    <li>Observing the application of specific controls;</li>
                    <li>Inspecting documents and reports;</li>
                    <li>Tracing transactions through the information system relevant to financial reporting.</li>
                </ul>
                <p>NB: this requirement exists irrespective of whether the overall control environment has been deemed to be ineffective in section 2b above. </p>
                <form action="<?= base_url()?>auditsystem/c1/section3/save/AC6/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Financial Statement Area</th>
                            <th>Description of the control </th>
                            <th>Is the control effective?</th>
                            <th>Has the control been implemented effectively?</th>
                            <th>How has this been assessed?</th>
                            <th>Cross reference to testing </th>
                            <th>Reliance to be placed on control? (*)</th>
                            <th style="width: 7%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody1">
                        <tr>
                            <td>e.g. <br> Trade Debtors</td>
                            <td>e.g.<br> All new customers are subject to credit checks and credit limits restricted to £50k.</td>
                            <td>e.g.<br> Yes</td>
                            <td>e.g.<br> Yes</td>
                            <td>e.g.<br> The risk of bad debts has been reduced. Inquired with the sales ledger team about the process and seen evidence of this by performing a walkthrough of a new customer set up.</td>
                            <td>e.g.<br> T4</td>
                            <td>e.g.<br> No</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>e.g.<br>Creditors and Stock</td>
                            <td>e.g.<br>All goods received are matched to purchase orders before being booked into stock.</td>
                            <td>e.g.<br>Yes</td>
                            <td>e.g.<br>No</td>
                            <td>e.g.<br>Despite this being noted as a control in the client’s systems notes, the warehouse team often do not evidence that the check has taken place. </td>
                            <td>e.g.<br>T6</td>
                            <td>e.g.<br>No</td>
                            <td></td>
                        </tr>
                        <?php foreach($s3 as $r1){?>
                            <tr>
                                <td><?= $r1['finstate']?></td>
                                <td><?= $r1['desc']?></td>
                                <td><?= $r1['controleffect']?></td>
                                <td><?= $r1['implemented']?></td>
                                <td><?= $r1['assessed']?></td>
                                <td><?= $r1['reference']?></td>
                                <td><?= $r1['reliance']?></td>
                                <td>
                                    <button class="btn btn-primary btn-icon btn-sm load-data2" type="button" data-bs-toggle="modal" data-bs-target="#modaledit" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" title="Edit" ><i class="fas fa-edit"></i></button>
                                    <?php if($r1['status'] == 'Active'){?>
                                        <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                    <?php }else{?>
                                        <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>

                    <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field1" id="add-field1">Add Field</button>
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                </form>
                <br>
                <br>

                <h6>Notes Regarding Assessment of Controls:	</h6>
                <p>1.	The audit approach section of the assignment plan should include details of how the risk and control environment assessment have influenced the design of the audit programmes and have identified key items and key audit issues.</p>
                <p>2.	Where it is unlikely that sufficient, appropriate audit evidence can be obtained solely from substantive procedures, it is necessary to obtain an understanding of the controls over risks which may arise.  In such circumstances, it is necessary for controls testing to be performed (for example, a company which sells goods and services over the internet, where the process is highly automated, and relies on little or no human input).  In such cases, the entity's controls over such risks are relevant to the audit.  (PSA 315.30, PSA 315.A140-142).</p>
                <p>3.	Where significant risks have been identified, the entity's controls relevant to those risks should be understood.</p>
                <p>4.	Paragraph 31 of PSA 240 states "Management is in a unique position to perpetrate fraud because of management’s ability to manipulate accounting records and prepare fraudulent financial statements by overriding controls that otherwise appear to be operating effectively. Although the level of risk of management override of controls will vary from entity to entity, the risk is nevertheless present in all entities. Due to the unpredictable way in which such override could occur, it is a risk of material misstatement due to fraud and thus a significant risk".</p>
            </div>
        </div>
    </div>
    
</main>


<script>
    $(document).ready(function () {


        $(".active-data").on("click", function() {
            var status = $(this).data('status');
            var acID = $(this).data('ac-id');
                $('#myactiveform').attr('action', "<?= base_url('auditsystem/c1/manage/activeinactive/')?>AC6/<?= $header?>/<?= $c1tID?>/" + acID);
                if (status == 'Active') {
                    $('.msgconfirm').html(`<h3>Are you sure to Disable this content?</h3>`);
                }else{
                    $('.msgconfirm').html(`<h3>Are you sure to Enable this content?</h3>`);
                }
        });

        $(".load-data2").on("click", function() {
            // Show the modal
            var acID = $(this).data('ac-id');

            $(".loading").html(`
                <div class="spinner-grow text-muted"></div>
                <div class="spinner-grow text-primary"></div>
                <div class="spinner-grow text-success"></div>
                <div class="spinner-grow text-info"></div>
                <div class="spinner-grow text-warning"></div>
                <div class="spinner-grow text-danger"></div>
                <div class="spinner-grow text-secondary"></div>
                <div class="spinner-grow text-dark"></div>
                <div class="spinner-grow text-light"></div>
                <h3>Loading...</h3>
            `);
            // Fetch data using AJAX
			$.ajax({
                url: "<?= base_url('auditsystem/c1/ac6/edit2/')?>" + acID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    $(".loading").html(`
                        <div class="row gx-3 mb-3">

                            <div class="col-md-6">
                                <label class="small mb-1" for="financialstatement">Financial Statement:</label>
                                <textarea class="form-control financialstatement" id="financialstatement" name="financialstatement" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="descriptioncontrol">Description Control:</label>
                                <textarea class="form-control descriptioncontrol" id="descriptioncontrol" name="descriptioncontrol" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="controleffective">Control Effective:</label>
                                <textarea class="form-control controleffective" id="controleffective" name="controleffective" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="controlimplemented">Control Implemented:</label>
                                <textarea class="form-control controlimplemented" id="controlimplemented" name="controlimplemented" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="assesed">Assessed:</label>
                                <textarea class="form-control assesed" id="assesed" name="assesed" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="crosstesting">Cross Testing:</label>
                                <textarea class="form-control crosstesting" id="crosstesting" name="crosstesting" cols="30" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="reliancecontrol">Reliance Control:</label>
                                <textarea class="form-control reliancecontrol" id="reliancecontrol" name="reliancecontrol" cols="30" rows="5"></textarea>
                            </div>
                           
                           
                        </div>
                    `);


                    $(".financialstatement").val(data.finstate);
                    $(".descriptioncontrol").val(data.desc);
                    $(".controleffective").val(data.controleffect);
                    $(".controlimplemented").val(data.implemented);
                    $(".assesed").val(data.assessed);
                    $(".crosstesting").val(data.reference);
                    $(".reliancecontrol").val(data.reliance);


                    $('#myform').attr('action', "<?= base_url('auditsystem/c1/section3/update/')?>AC6/<?= $header?>/<?= $c1tID?>/" + acID);

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".loading").html("Error loading data");
                }

            });

        });

        

        $(".load-data").on("click", function() {
            // Show the modal
            var acID = $(this).data('ac-id');

            $(".loading").html(`
                <div class="spinner-grow text-muted"></div>
                <div class="spinner-grow text-primary"></div>
                <div class="spinner-grow text-success"></div>
                <div class="spinner-grow text-info"></div>
                <div class="spinner-grow text-warning"></div>
                <div class="spinner-grow text-danger"></div>
                <div class="spinner-grow text-secondary"></div>
                <div class="spinner-grow text-dark"></div>
                <div class="spinner-grow text-light"></div>
                <h3>Loading...</h3>
            `);
            // Fetch data using AJAX
			$.ajax({
                url: "<?= base_url('auditsystem/c1/ac6/edit/')?>" + acID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    $(".loading").html(`
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="question">Question:</label>
                                <input class="form-control question"  id="question" type="text" name="question">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="planning">Planning:</label>
                                <input class="form-control planning"  id="planning" type="text" name="planning">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="finalization">Finalization:</label>
                                <input class="form-control finalization"  id="finalization" type="text" name="finalization">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="reference">Reference:</label>
                                <input class="form-control reference"  id="reference" type="text" name="reference">
                            </div>
                        </div>
                    `);

                    $(".question").val(data.question);
                    $(".planning").val(data.planning);
                    $(".finalization").val(data.finalization);
                    $(".reference").val(data.reference);

                    $('#myform').attr('action', "<?= base_url('auditsystem/c1/manage/update/')?>AC6/<?= $header?>/<?= $c1tID?>/" + acID);

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".loading").html("Error loading data");
                }

            });

        });



        var rowIdx = 0;

        $('#add-field').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody').append(` <tr>
                            <td><input class="form-control" type="text" name="question[]"></td>
                            <td><input class="form-control" type="text" name="planning[]"></td>
                            <td><input class="form-control" type="text" name="finalization[]"></td>
                            <td><input class="form-control" type="text" name="reference[]"></td>
                            <td><button class="btn btn-danger btn-icon remove btn-sm" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                        </tr>`);
        });

        

        $('#tbody').on('click', '.remove', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });



        $('#add-field1').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody1').append(`<tr>
                            <td><textarea class="form-control" id="" name="financialstatement[]" cols="30" rows="5"></textarea> </td>
                            <td><textarea class="form-control" id="" name="descriptioncontrol[]" cols="30" rows="5"></textarea> </td>
                            <td><textarea class="form-control" id="" name="controleffective[]" cols="30" rows="5"></textarea> </td>
                            <td><textarea class="form-control" id="" name="controlimplemented[]" cols="30" rows="5"></textarea> </td>
                            <td><textarea class="form-control" id="" name="assesed[]" cols="30" rows="5"></textarea> </td>
                            <td><textarea class="form-control" id="" name="crosstesting[]" cols="30" rows="5"></textarea> </td>
                            <td><textarea class="form-control" id="" name="reliancecontrol[]" cols="30" rows="5"></textarea> </td>
                            <td><button class="btn btn-danger btn-icon remove btn-sm" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                        </tr>`);
        });

        

        $('#tbody1').on('click', '.remove1', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });


    });
</script>
