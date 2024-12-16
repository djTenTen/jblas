
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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $code?>/<?= $mtID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>ISA COMPLIANCE CRITICAL ISSUES MEMORANDUM</h4>
                    <h6>Objective:</h6>
                    <p>To ensure compliance with ISA by providing a summary of critical audit issues and how these have been resolved. When read in conjunction with final analytical procedures, completion of this memorandum should provide the Audit Engagement Partner with an executive summary of the key points arising from the assignment.</p>
                    <h6>Recording:</h6>
                    <p>This form must be completed and include any changes made to the original planning documentation, how significant risks have been addressed during the audit and certain other issues specifically required by ISA. <i><u>The first 3 pages of this form are mandatory</u></i>.</p>
                    <p>If the A.E.P. wishes, this form can be fully completed thus providing a comprehensive executive summary which (when read in conjunction with final analytical procedures) provides a critical review of financial and non-financial matters, notes outstanding work; key issues where the A.E.P.’s input is needed and key issues that require further client involvement.</p>
                    <p>This form should not be used to record routine review points or administrative points for the A.E.P.’s attention or to record outstanding work at interim stages of the assignment.</p>
                    <h6>Summary and Impact of Changes Made to Audit Planning After the Date of the A.E.P’s Approval:</h6>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa7aepapp/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="aepapp">
                        <input type="hidden" name="acid" value="<?= encr($aepapp['mdID'])?>">
                        <textarea class="form-control reference" id="reference" cols="30" rows="5" name="question"><?= $aepapp['field1']?></textarea>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <p>I approve the above changes to the planning, and consider that these changes have been adequately integrated into the audit approach.</p>
                    <h6>I have considered the requirements of ISA 315 and specifically, the definition of a significant risk being, “an identified and assessed risk of material misstatement that, in the auditor’s judgment, requires special audit consideration”.</h6>
                    <h6>A summary of significant risks identified, the outcome from audit tests performed on those risks, and the conclusions reached (mandatory section):</h6>
                    <p><i>(Insert additional rows as required)</i></p>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa7isa/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="isa315">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Area / Assertion</th>
                                    <th>Significant risk identified</th>
                                    <th>Audit test reference</th>
                                    <th>Results of audit tests</th>
                                    <th>Conclusions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($aa7 as $r){?>
                                    <tr>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field1']?></textarea></td>
                                        <td><textarea class="form-control issue" id="issue" cols="30" rows="3" name="issue[]"><?= $r['field2']?></textarea></td>
                                        <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['field3']?></textarea></td>
                                        <td><textarea class="form-control recommendation" id="recommendation" cols="30" rows="3" name="recommendation[]"><?= $r['field4']?></textarea></td>
                                        <td><textarea class="form-control result" id="result" cols="30" rows="3" name="result[]"><?= $r['field5']?></textarea></td>
                                        <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Areas where consultation has been undertaken </h6>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa7isa/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="consultation">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Issue(s):</th>
                                    <th>Comments and conclusion of the audit team:</th>
                                    <th>(If applicable) 
                                        Further information needed from the client and a summary of information subsequently received:
                                    </th>
                                    <th>(If applicable) 
                                        A.E.P. input required:
                                    </th>
                                    <th>A.E.P. Conclusion(s):</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($cons as $r){?>
                                    <tr>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field1']?></textarea></td>
                                        <td><textarea class="form-control issue" id="issue" cols="30" rows="3" name="issue[]"><?= $r['field2']?></textarea></td>
                                        <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['field3']?></textarea></td>
                                        <td><textarea class="form-control recommendation" id="recommendation" cols="30" rows="3" name="recommendation[]"><?= $r['field4']?></textarea></td>
                                        <td><textarea class="form-control result" id="result" cols="30" rows="3" name="result[]"><?= $r['field5']?></textarea></td>
                                        <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Inconsistencies noted between information provided by the client and other findings of the audit team (mandatory section):</h6>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa7isa/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="inconsistencies">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Issue(s):</th>
                                    <th>Comments and conclusion of the audit team:</th>
                                    <th>(If applicable) 
                                        Further information needed from the client and a summary of information subsequently received:
                                    </th>
                                    <th>(If applicable) 
                                        A.E.P. input required:
                                    </th>
                                    <th>A.E.P. Conclusion(s):</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($inc as $r){?>
                                    <tr>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field1']?></textarea></td>
                                        <td><textarea class="form-control issue" id="issue" cols="30" rows="3" name="issue[]"><?= $r['field2']?></textarea></td>
                                        <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['field3']?></textarea></td>
                                        <td><textarea class="form-control recommendation" id="recommendation" cols="30" rows="3" name="recommendation[]"><?= $r['field4']?></textarea></td>
                                        <td><textarea class="form-control result" id="result" cols="30" rows="3" name="result[]"><?= $r['field5']?></textarea></td>
                                        <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Areas where management refusal to allow the audit team to send a confirmation request has led to alternative procedures being performed (mandatory section):</h6>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa7isa/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="refusal">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Issue(s):</th>
                                    <th>Comments and conclusion of the audit team:</th>
                                    <th>(If applicable) 
                                        Further information needed from the client and a summary of information subsequently received:
                                    </th>
                                    <th>(If applicable) 
                                        A.E.P. input required:
                                    </th>
                                    <th>A.E.P. Conclusion(s):</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($ref as $r){?>
                                    <tr>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field1']?></textarea></td>
                                        <td><textarea class="form-control issue" id="issue" cols="30" rows="3" name="issue[]"><?= $r['field2']?></textarea></td>
                                        <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['field3']?></textarea></td>
                                        <td><textarea class="form-control recommendation" id="recommendation" cols="30" rows="3" name="recommendation[]"><?= $r['field4']?></textarea></td>
                                        <td><textarea class="form-control result" id="result" cols="30" rows="3" name="result[]"><?= $r['field5']?></textarea></td>
                                        <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">                
                    <h6>Departures from requirements of ISA, reasons for the departure and alternative audit procedures performed (mandatory section):</h6>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa7isa/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="departures">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Issue(s):</th>
                                    <th>Comments and conclusion of the audit team:</th>
                                    <th>(If applicable) 
                                        Further information needed from the client and a summary of information subsequently received:
                                    </th>
                                    <th>(If applicable) 
                                        A.E.P. input required:
                                    </th>
                                    <th>A.E.P. Conclusion(s):</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($dep as $r){?>
                                    <tr>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field1']?></textarea></td>
                                        <td><textarea class="form-control issue" id="issue" cols="30" rows="3" name="issue[]"><?= $r['field2']?></textarea></td>
                                        <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['field3']?></textarea></td>
                                        <td><textarea class="form-control recommendation" id="recommendation" cols="30" rows="3" name="recommendation[]"><?= $r['field4']?></textarea></td>
                                        <td><textarea class="form-control result" id="result" cols="30" rows="3" name="result[]"><?= $r['field5']?></textarea></td>
                                        <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form> 
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Other Issues (including any key outstanding audit matters):</h6>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa7isa/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="other">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Issue(s):</th>
                                    <th>Comments and conclusion of the audit team:</th>
                                    <th>(If applicable) 
                                        Further information needed from the client and a summary of information subsequently received:
                                    </th>
                                    <th>(If applicable) 
                                        A.E.P. input required:
                                    </th>
                                    <th>A.E.P. Conclusion(s):</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($oth as $r){?>
                                    <tr>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field1']?></textarea></td>
                                        <td><textarea class="form-control issue" id="issue" cols="30" rows="3" name="issue[]"><?= $r['field2']?></textarea></td>
                                        <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['field3']?></textarea></td>
                                        <td><textarea class="form-control recommendation" id="recommendation" cols="30" rows="3" name="recommendation[]"><?= $r['field4']?></textarea></td>
                                        <td><textarea class="form-control result" id="result" cols="30" rows="3" name="result[]"><?= $r['field5']?></textarea></td>
                                        <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form> 
                    <br><br><br><hr style="color: #7752FE;">
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa7aep/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $mdID?>">
                        <h6>Changes to, or new accounting policies and estimation techniques in the period:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Points to A.E.P.:</th>
                                    <th>A.E.P. Comments:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><textarea id="" cols="30" rows="5" class="form-control" name="ch1"><?= $aep['ch1']?></textarea></td>
                                    <td><textarea id="" cols="30" rows="5" class="form-control" name="ch2"><?= $aep['ch2']?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <h6>Developments during the period:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Points to A.E.P.:</th>
                                    <th>A.E.P. Comments:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><textarea id="" cols="30" rows="5" class="form-control" name="dev1"><?= $aep['dev1']?></textarea></td>
                                    <td><textarea id="" cols="30" rows="5" class="form-control" name="dev2"><?= $aep['dev2']?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <h6>Future developments:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Points to A.E.P.:</th>
                                    <th>A.E.P. Comments:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><textarea id="" cols="30" rows="5" class="form-control" name="fut1"><?= $aep['fut1']?></textarea></td>
                                    <td><textarea id="" cols="30" rows="5" class="form-control" name="fut2"><?= $aep['fut2']?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <h6>Costs to date, including an explanation of deviation from budget, and timetable for completion:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Points to A.E.P.:</th>
                                    <th>A.E.P. Comments:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><textarea id="" cols="30" rows="5" class="form-control" name="cst1"><?= $aep['cst1']?></textarea></td>
                                    <td><textarea id="" cols="30" rows="5" class="form-control" name="cst2"><?= $aep['cst2']?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
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
    
    $('.add-field').on('click', function () {
        // Adding a row inside the tbody.
        var form = $(this).closest('form');
        var tbody = form.find('tbody');
        tbody.append(`
        <tr>
            <td><textarea class="form-control reference" id="reference" cols="30" rows="5" name="reference[]"></textarea></td>
            <td><textarea class="form-control issue" id="issue" cols="30" rows="5" name="issue[]"></textarea></td>
            <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="comment[]"></textarea></td>
            <td><textarea class="form-control recommendation" id="recommendation" cols="30" rows="5" name="recommendation[]"></textarea></td>
            <td><textarea class="form-control result" id="result" cols="30" rows="5" name="result[]"></textarea></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    
    $('.tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });


});
</script>

















