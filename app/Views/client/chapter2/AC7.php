
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            <?= $name?>
                        </h1>
                        <div class="page-header-subtitle"><?= $title?></div>
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
            <?php if (session()->get('success')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success!</h6>
                        <?= session()->get('success')?>
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Error!</h6>
                        <?= session()->get('failed')?>
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter2/view/')?><?= $code?>/<?= $mtID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>RISK SUMMARY</h4>
                    <p>This form should be completed when a narrative approach to inherent business risk assessment is undertaken. If more than one risk level applies, add additional lines as appropriate.</p>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac6ra/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="ac6ra">
                        <table class="table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th></th>
                                    <th  colspan="2">Risk Assessment</th>
                                    <th>Reference</th>
                                </tr>
                                <tr>
                                    <th>Question</th>
                                    <th>Planning</th>
                                    <th>Finalization</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="tbody text-center">
                                <?php foreach($ac6 as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= encr($r['mdID'])?>"><?= $r['field1']?></td>
                                        <td><input class="form-control" type="text" name="planning[]" value="<?= $r['field2']?>"></td>
                                        <td><input class="form-control" type="text" name="finalization[]" value="<?= $r['field3']?>"></td>
                                        <td><input class="form-control" type="text" name="reference[]" value="<?= $r['field4']?>"></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <p>Objective: This form is designed to determine the inherent risk of the business as a whole.  PSA 315 implies that all businesses should be high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
                    <h4>Section 1 – INHERENT BUSINESS RISK </h4>
                    <p>The inherent business risk of the client is deemed to be low / medium / high* for the following reasons:</p>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac6s12/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $mdID?>">
                        <textarea class="form-control" cols="30" rows="20" name="s1" required><?= $s['s1']?></textarea>
                        <p>Comprehensive consideration should be given to all clients even those deemed to be low risk. As part of this review consideration must be given to the Company’s going concern status and I.T. risk.</p>
                        <p>Objective: This form is designed to assess the adequacy of the entity’s control environment as a whole to determine whether a control based audit approach is appropriate. Section 3 looks at internal controls specific to the audit. To comply with PSA 315, both sections must be completed regardless of whether you intend to test, and if successful, place reliance on the entity’s controls.</p>
                        <p>In addition, this form should document the considerations of the risks related to management override of controls.</p>
                        <h4>Section 2a – CONSIDERATION OF THE RISK OF MANAGEMENT OVERRIDE OF CONTROLS </h4>
                        <p>The risk of management override is present in ALL entities. However, the level of that risk will vary from entity to entity. Where management can override key controls, document here the considerations relating to the level of risk posed by management override and the audit procedures planned to address this risk:</p>
                        <textarea class="form-control" cols="30" rows="20" name="s2a" required><?= $s['s2a']?></textarea>
                        <br>
                        <h4>Section 2b – CONSIDERATION OF THE CONTROL ENVIRONMENT </h4>
                        <p>The control environment of the client deemed to be effective / ineffective* for the following reasons: </p>
                        <textarea class="form-control" cols="30" rows="20" name="s2b" required><?= $s['s2b']?></textarea>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <p>Based on the above assessment control testing is / is not * going to be undertaken </p>
                    <h4>Section 3 - UNDERSTANDING THE DESIGN AND IMPLEMENTATION OF INTERNAL CONTROLS</h4>
                    <p>Objective: <br> The auditor is required to “obtain an understanding of internal control relevant to the audit. Although most controls relevant to the audit are likely to relate to financial reporting, not all controls that relate to financial reporting are relevant to the audit.” (paragraph 12 of PSA 315).</p>
                    <p>The auditor is required to evaluate the design of these controls and determine whether they have been appropriately implemented.  Per paragraph A74 of PSA 315:</p>
                    <ul>
                        <li>Evaluating the design of a control involves “considering whether the control, individually or in combination with other controls, is capable of effectively preventing, or detecting and correcting, material misstatements; </li>
                        <li>Implementation of a control means that the control exists, and the entity is using it”.</li>
                    </ul>
                    <p>Requirement: <br> Summarise below the internal controls that are relevant to the audit and evaluate whether those controls are effective. If the controls are considered effective, test that the controls are being used by the entity.   </p>
                    <p>As per paragraph A75 of PSA 315, the following procedures may be carried out to obtain evidence about the design and implementation of controls: </p>
                    <ul>
                        <li>Inquiry of entity personnel;</li>
                        <li>Observing the application of specific controls;</li>
                        <li>Inspecting documents and reports;</li>
                        <li>Tracing transactions through the information system relevant to financial reporting.</li>
                    </ul>
                    <p>NB: this requirement exists irrespective of whether the overall control environment has been deemed to be ineffective in section 2b above. </p>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac6s3/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="ac6s3">
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
                            <tbody id="tbody1" class="tbody">
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
                                <?php foreach($s3 as $r){?>
                                    <tr>
                                        <td><textarea class="form-control" id="" name="financialstatement[]" cols="30" rows="5"><?= $r['field1']?></textarea> </td>
                                        <td><textarea class="form-control" id="" name="descriptioncontrol[]" cols="30" rows="5"><?= $r['field2']?></textarea> </td>
                                        <td><textarea class="form-control" id="" name="controleffective[]" cols="30" rows="5"><?= $r['field3']?></textarea> </td>
                                        <td><textarea class="form-control" id="" name="controlimplemented[]" cols="30" rows="5"><?= $r['field4']?></textarea> </td>
                                        <td><textarea class="form-control" id="" name="assesed[]" cols="30" rows="5"><?= $r['field5']?></textarea> </td>
                                        <td><textarea class="form-control" id="" name="crosstesting[]" cols="30" rows="5"><?= $r['field6']?></textarea> </td>
                                        <td><textarea class="form-control" id="" name="reliancecontrol[]" cols="30" rows="5"><?= $r['field7']?></textarea> </td>
                                        <td>
                                            <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm m-1 float-end" type="button" id="add-field1"><i class="fas fa-plus-square m-1"></i>Add Field</button>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>
<script>
    $(document).ready(function () {

        $('.tbody').on('click', 'button.remove', function () {
            $(this).closest('tr').remove();
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
                <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
            </tr>`);
        });

    });
</script>
