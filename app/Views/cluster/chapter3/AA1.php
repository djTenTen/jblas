
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
                    <h4>AUDIT CONTROL RECORD</h4>
                    <form action="<?= base_url()?>auditsystem/cluster/savevalues/c3/saveplaf/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Planning</th>
                                    <th style="width: 25%;">Yes/No</th>
                                    <th style="width: 25%;">Reference</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <input type="hidden" value="planning" name="part">
                                <?php foreach($datapl as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= encr($r['mdID'])?>"><?= $r['field1']?></td>
                                        <td>
                                            <select name="extent[]" id="" class="form-select">
                                                <option value="<?= $r['field2']?>" selected><?= $r['field2']?></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="reference[]"><?= $r['field3']?></textarea></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <form action="<?= base_url()?>auditsystem/cluster/savevalues/c3/saverceap/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $mdID2?>">
                        <h6>Completion by most senior person completing the fieldwork</h6>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-1" for="awp4">I have completed my work as summarised above, and consider that the working papers adequately support our proposed opinion, except for the outstanding points listed on: </label>
                                <textarea class="form-control" cols="30" rows="3" name="awp4" placeholder="Insert outstanding points listed on"><?= $rc['awp4']?></textarea>
                            </div>
                        </div>
                        <h6>Review completion by manager</h6>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-1" for="awp5">I have completed my review of the working papers and consider that they support the opinion proposed except for the matters noted on: </label>
                                <textarea class="form-control" cols="30" rows="3" name="awp5" placeholder="Insert the matters noted on"><?= $rc['awp5']?></textarea>
                            </div>
                        </div>
                        <h6>Review completion by Audit Engagement Partner</h6>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-1" for="awp6">I have completed my review of:</label>
                                <textarea class="form-control" cols="30" rows="3" name="awp6" placeholder="Insert outstanding points listed on"><?= $rc['awp6']?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-1" for="num10yes">the audit working papers, including:</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="awp1" type="checkbox" name="awp1" value="critical areas of judgment, especially those relating to difficult or contentious matters identified during the course of the engagement;" <?php if($rc['awp1'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="awp1">critical areas of judgment, especially those relating to difficult or contentious matters identified during the course of the engagement;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="awp2" type="checkbox" name="awp2" value="significant risks;" <?php if($rc['awp2'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="awp2">significant risks;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="awp3" type="checkbox" name="awp3" value="points raised for my attention at Aa7" <?php if($rc['awp3'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="awp3">points raised for my attention at Aa7</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="awp7">the financial statements / set of financial statements sent to the directors and consider that they support the proposed opinion to be given except for the matters noted on </label>
                                <textarea class="form-control" cols="30" rows="3" name="awp7" placeholder="Insert given except for the matters noted on"><?= $rc['awp7']?></textarea>
                                <label class="form-check-label" for="awp7">and the audit has been carried out in accordance with International Standards on Auditing.</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-1" for="num10yes">Where it is proposed to provide an unmodified opinion, I can confirm that:</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap1" type="checkbox" name="rceap1" value="adequate accounting records have been kept, and we have received returns adequate for our audit from branches not visited by us;" <?php if($rc['rceap1'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap1">adequate accounting records have been kept, and we have received returns adequate for our audit from branches not visited by us;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap2" type="checkbox" name="rceap2" value="the financial statements are in agreement with the accounting records and returns;" <?php if($rc['rceap2'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap2">the financial statements are in agreement with the accounting records and returns;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap3" type="checkbox" name="rceap3" value="we have received all the information and explanations we require for our audit;" <?php if($rc['rceap3'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap3">we have received all the information and explanations we require for our audit;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap4" type="checkbox" name="rceap4" value="the financial statements have been properly prepared in accordance with *National GAAP / *IFRS, and any disclosure exemptions have been properly applied;" <?php if($rc['rceap4'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap4">the financial statements have been properly prepared in accordance with *National GAAP / *IFRS, and any disclosure exemptions have been properly applied;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap5" type="checkbox" name="rceap5" value="there are no material inconsistencies between the financial statements and other information presented with them;" <?php if($rc['rceap5'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap5">there are no material inconsistencies between the financial statements and other information presented with them;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap6" type="checkbox" name="rceap6" value="there are no doubts regarding the reliability of representations we have received / are seeking to obtain in the letter of representation;" <?php if($rc['rceap6'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap6">there are no doubts regarding the reliability of representations we have received / are seeking to obtain in the letter of representation;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap7" type="checkbox" name="rceap7" value="there are no matters which have been noted on the ISA Compliance Critical Issues Memorandum (Aa7) which would warrant the audit report to be modified;" <?php if($rc['rceap7'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap7">there are no matters which have been noted on the ISA Compliance Critical Issues Memorandum (Aa7) which would warrant the audit report to be modified;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap8" type="checkbox" name="rceap8" value="items which have been recorded as unadjusted audit errors (Aa11), when considered individually and in aggregate, do not result in the financial statements being materially incorrect;" <?php if($rc['rceap8'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap8">items which have been recorded as unadjusted audit errors (Aa11), when considered individually and in aggregate, do not result in the financial statements being materially incorrect;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap9" type="checkbox" name="rceap9" value="there have been no limitations in the scope of our work;" <?php if($rc['rceap9'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap9">there have been no limitations in the scope of our work;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="rceap10" type="checkbox" name="rceap10" value="there are no matters which we wish to include in our audit report to provide additional explanations to the users of the financial statements." <?php if($rc['rceap10'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="rceap10">there are no matters which we wish to include in our audit report to provide additional explanations to the users of the financial statements.</label>
                                </div>
                            </div>
                        </div>
                        <p><i>The Audit Engagement Partner should also ensure that their relevant declarations have been completed on the front page of each of Aa3b Going Concern Checklist, and Aa7 ISA Compliance Critical Issues Memorandum.</i></p>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-1" for="details">Details: </label>
                                <input class="form-control" id="details" type="text" placeholder="Insert Details" name="details" value="<?= $rc['details']?>"/>
                                
                                <label class="mb-1" for="datereq">Date required by client: </label>
                                <input class="form-control" id="datereq" type="date" placeholder="Insert Details" name="datereq" value="<?= $rc['datereq']?>"/>

                                <label class="mb-1" for="numcop">Number of copies required: </label>
                                <input class="form-control" id="numcop" type="number" placeholder="Insert Details" name="numcop" value="<?= $rc['numcop']?>"/>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>4.	Pre-sign off completion by Audit Engagement Partner</h6>
                    <form action="<?= base_url()?>auditsystem/cluster/savevalues/c3/saveplaf/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Planning</th>
                                    <th style="width: 25%;">Yes/No</th>
                                    <th style="width: 25%;">Reference</th>
                                </tr>
                            </thead>
                            <tbody id="tbody1">
                                <input type="hidden" value="audit finalisation" name="part">
                                <?php foreach($dataaf as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= encr($r['mdID'])?>"><?= $r['field1']?></td>
                                        <td>
                                            <select name="extent[]" id="" class="form-select">
                                                <option value="<?= $r['field2']?>" selected><?= $r['field2']?></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="reference[]"><?= $r['field3']?></textarea></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <form action="<?= base_url()?>auditsystem/cluster/savevalues/c3/saveaa1s3/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $mdID?>">
                        <h6>Signed Financial Statements and Audit Opinion</h6>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-1" for="a1">Have all outstanding matters noted above, including confirming that the financial statements do not contain material errors or misstatements, been cleared to the satisfaction of the originator (and crossed through to demonstrate this)? </label>
                                <textarea class="form-control form-control-sm" name="a1" id="a1" cols="30" rows="5" placeholder="Insert Have all outstanding matters noted above"><?= $s3['a1']?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="a2">Has a letter of representation, dated on, or immediately prior to the date of the audit report, been obtained, or has an appropriate modification been given? </label>
                                <textarea class="form-control form-control-sm" name="a2" id="a2" cols="30" rows="5" placeholder="Insert Has a letter of representation"><?= $s3['a2']?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="a3">I confirm that consideration has been given to subsequent events arising since the reporting date, to the date of the approval of the financial statements.  If matters have arisen, these have been disclosed in the financial statements in note </label>
                                <textarea class="form-control form-control-sm" name="a3" id="a3" cols="30" rows="5" placeholder="Insert Note"><?= $s3['a3']?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="a4">I confirm that the going concern basis</label>
                                <select name="a4" id="a4" class="form-select">
                                    <option value="<?= $s3['a4']?>" selected><?= $s3['a4']?></option>
                                    <option value="is">is</option>
                                    <option value="is not">is not</option>
                                </select>
                                <label class="mb-1" for="a4">appropriate, and that relevant disclosures have been made in the financial statements.</label>
                            </div>
                        </div>
                        <p>In considering the audit opinion, I have considered whether:</p>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-1" for="num10yes">Where it is proposed to provide an unmodified opinion, I can confirm that:</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a5" type="checkbox" name="a5" value="Sufficient appropriate audit evidence has been obtained as to whether the financial statements as a whole are free from material misstatement, whether due to fraud or error;" <?php if($s3['a5'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a5">Sufficient appropriate audit evidence has been obtained as to whether the financial statements as a whole are free from material misstatement, whether due to fraud or error;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a6" type="checkbox" name="a6" value="Uncorrected misstatements, individually and in aggregate are immaterial;" <?php if($s3['a6'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a6">Uncorrected misstatements, individually and in aggregate are immaterial;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a7" type="checkbox" name="a7" value="The financial statements give a true and fair view;" <?php if($s3['a7'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a7">The financial statements give a true and fair view;</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a8" type="checkbox" name="a8" value="The financial statements have been correctly prepared in accordance with National GAAP / IFRS, including all relevant legal requirements." <?php if($s3['a8'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a8">The financial statements have been correctly prepared in accordance with National GAAP / IFRS, including all relevant legal requirements.</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-1" for="a9">I approve the signing of an </label>
                                <select name="a9" id="a9" class="form-select">
                                    <option value="<?= $s3['a9']?>" selected><?= $s3['a9']?></option>
                                    <option value="unmodified">unmodified</option>
                                    <option value="modified">modified</option>
                                </select>
                                <label class="mb-1" for="a9">audit opinion</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a10" type="checkbox" name="a10" value="The opinion is modified for the reasons noted on" <?php if($s3['a10'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a10">The opinion is modified for the reasons noted on</label>
                                </div>
                                <textarea class="form-control form-control-sm" name="a10d" id="a10d" cols="30" rows="5" placeholder="Insert modified for the reasons"><?php if($s3['a10'] != ''){echo $s3['a10d'];}?></textarea>
                            </div>
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a11" type="checkbox" name="a11" value="The audit report includes an emphasis of matter paragraph for the reasons noted on" <?php if($s3['a11'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a11">The audit report includes an emphasis of matter paragraph for the reasons noted on</label>
                                </div>
                                <textarea class="form-control form-control-sm" name="a11d" id="a11d" cols="30" rows="5" placeholder="Insert emphasis of matter paragraph"><?php if($s3['a11'] != ''){echo $s3['a11d'];}?></textarea>
                            </div>
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a12" type="checkbox" name="a12" value="As the audit opinion has been modified an additional paragraph has been included regarding the impact of the modification on the company’s ability to pay future dividends." <?php if($s3['a12'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a12">As the audit opinion has been modified an additional paragraph has been included regarding the impact of the modification on the company’s ability to pay future dividends.</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h6>Completion by EQCR:</h6>
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <label class="form-check-label" for="a13">I have carried out a hot review, the scope of which is documented on</label>
                                    <textarea class="form-control form-control-sm" name="a13" id="a13" cols="30" rows="5" placeholder="Insert documented on"><?= $s3['a13']?></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a14" type="checkbox" name="a14" value="I am satisfied that all points raised in my review on" <?php if($s3['a14'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a14">I am satisfied that all points raised in my review on </label>
                                </div>
                                <textarea class="form-control form-control-sm" name="a14d" id="a14d" cols="30" rows="5" placeholder="Insert review on"><?php if($s3['a14'] != ''){echo $s3['a14d'];}?></textarea>
                                <label class="form-check-label" for="a14d">have been cleared.</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a15" type="checkbox" name="a15" value="I have reviewed the proposed modification / emphasis of matter paragraph and consider it appropriate." <?php if($s3['a15'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a15">I have reviewed the proosed modification / emphasis of matter paragraph and consider it appropriate</label>
                                </di>
                            </div>
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="a16" type="checkbox" name="a16" value="I confirm that the conclusion in 5 above is appropriate." <?php if($s3['a16'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="a16">I confirm that the conclusion in 5 above is appropriate.</label>
                                </div>
                            </div>
                        </div>
                        <h6>This section is to be completed by the A.E.P. prior to re-appointment.</h6>
                        <p>Whilst answering these questions the following matters should be fully considered for the audit firm and any network firm: independence, integrity, conflicts of interest with other clients, economic dependence, trusts, matters arising with regulatory authorities, ability to service the client, other services provided to the client and hospitality. Additional guidance is available in legislation and the Code of Ethics issued by the International Ethics Standards Board for Accountants.</p>
                        <h6>Any YES answers should be fully explained along with the safeguards, which will enable us to accept the re-appointment.</h6>
                        <h6>Significant issues must be discussed with the Ethics Partner and details of the discussion should be documented on file.</h6>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 55%;"></th>
                                    <th style="width: 10%;">Yes/No</th>
                                    <th style="width: 35%;">Reference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Are there any matters which would alter any of the Ethical Considerations set out on the Regulation of Auditor’s Checklist (Ac2), Provision of Non-Audit Services to Audit Clients (Ac3), and Part 4 of the Audit Control Record?</td>
                                    <td>
                                        <select name="a17" id="" class="form-select">
                                            <option value="<?= $s3['a17'];?>" selected><?= $s3['a17'];?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="a18"><?= $s3['a18'];?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        If the answer to the above question is “Yes”, what matters need to be considered:
                                        <textarea class="form-control question" id="question" cols="30" rows="3" name="a19"><?= $s3['a19'];?></textarea>
                                        Does any of the above affect our service as auditors of this client?
                                    </td>
                                    <td>
                                        <select name="a20" id="" class="form-select">
                                            <option value="<?= $s3['a20'];?>" selected><?= $s3['a20'];?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="a21"><?= $s3['a21'];?></textarea></td>
                                </tr>
                                <tr>
                                    <td>Do we know of any other factors that could affect independence or otherwise indicate that we should not accept re-appointment?</td>
                                    <td>
                                        <select name="a22" id="" class="form-select">
                                            <option value="<?= $s3['a22'];?>" selected><?= $s3['a22'];?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="a23"><?= $s3['a23'];?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <h6>Authority to accept re-appointment:</h6>           
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-1" for="a24">I have considered the above, and do not consider that there are any perceived threats to our independence, integrity and objectivity and believe that we</label>
                                <select name="a24" id="a24" class="form-select">
                                    <option value="<?= $s3['a24'];?>" selected><?= $s3['a24'];?></option>
                                    <option value="can accept">can accept</option>
                                    <option value="can accept with the stated safeguards">can accept with the stated safeguards</option>
                                    <option value="cannot accept">cannot accept</option>
                                </select>
                                <label class="mb-1" for="a24">this re-appointment</label>
                            </div>
                        </div>
                        <p>Where necessary adequate consultation has been undertaken and documented with the Ethics Partner.</p>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>


























