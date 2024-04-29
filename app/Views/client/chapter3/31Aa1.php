<?php  $crypt = \Config\Services::encrypter();?>
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

            <?php if (session()->get('invalid_input')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Invalid Input</h6>
                        Something wrong with your data inputd, please try again.
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

            <div class="card-body">
                <hr>
                <h4>AUDIT CONTROL RECORD</h4>
                <form action="<?= base_url()?>auditsystem/client/saveplaf/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">

                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Planning</th>
                                <th>Yes/No</th>
                                <th>Reference</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <input type="hidden" value="planning" name="part">
                            <?php foreach($datapl as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="extent[]"><?= $r['extent']?></textarea></td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>

                </form>
                <br><br><br><hr>

                <h6>Completion by most senior person completing the fieldwork</h6>
                <p>I have completed my work as summarised above, and consider that the working papers adequately support our proposed opinion, except for the outstanding points listed on </p>
                <p>Signed:		Date:	</p>
                <h6>Review completion by manager</h6>
                <p>I have completed my review of the working papers and consider that they support the opinion proposed except for the matters noted on .......................................</p>
                <h6>Review completion by Audit Engagement Partner</h6>
                <p>I have completed my review of:</p>
                <ul>
                    <li>
                        <p>the audit working papers, including:</p>
                        <ul>
                            <li>critical areas of judgment, especially those relating to difficult or contentious matters identified during the course of the engagement;</li>
                            <li>significant risks; and</li>
                            <li>points raised for my attention at Aa7</li>
                        </ul>
                    </li>
                    <li>the financial statements / set of financial statements sent to the directors and consider that they support the proposed opinion to be given except for the matters noted on ............................. and the audit has been carried out in accordance with International Standards on Auditing.</li>
                </ul>
                <p>Where it is proposed to provide an unmodified opinion, I can confirm that:</p>
                <ul>
                    <li>adequate accounting records have been kept, and we have received returns adequate for our audit from branches not visited by us;</li>
                    <li>the financial statements are in agreement with the accounting records and returns;</li>
                    <li>we have received all the information and explanations we require for our audit;</li>
                    <li>the financial statements have been properly prepared in accordance with *National GAAP / *IFRS, and any disclosure exemptions have been properly applied;</li>
                    <li>there are no material inconsistencies between the financial statements and other information presented with them;</li>
                    <li>there are no doubts regarding the reliability of representations we have received / are seeking to obtain in the letter of representation;</li>
                    <li>there are no matters which have been noted on the ISA Compliance Critical Issues Memorandum (Aa7) which would warrant the audit report to be modified;</li>
                    <li>items which have been recorded as unadjusted audit errors (Aa11), when considered individually and in aggregate, do not result in the financial statements being materially incorrect;</li>
                    <li>there have been no limitations in the scope of our work; and</li>
                    <li>there are no matters which we wish to include in our audit report to provide additional explanations to the users of the financial statements.</li>
                </ul>
                <p>Where the above cannot be confirmed, it is proposed that the audit opinion will be modified* / an Emphasis of matter paragraph* / Other matter paragraph* will be included for the reasons noted on …………………..(* - Delete as applicable)</p>
                <p>Signed:		Date:	</p>
                <p><i>The Audit Engagement Partner should also ensure that their relevant declarations have been completed on the front page of each of Aa3b Going Concern Checklist, and Aa7 ISA Compliance Critical Issues Memorandum.</i></p>
                <h6>Matters that must be cleared before the financial statements are signed:</h6>

                <p>Details:	</p>
                <p>Date required by client:	</p>
                <p>Number of copies required:</p>

                <h6>4.	Pre-sign off completion by Audit Engagement Partner</h6>


                <form action="<?= base_url()?>auditsystem/client/saveplaf/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">

                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Planning</th>
                                <th>Yes/No</th>
                                <th>Reference</th>
                            </tr>
                        </thead>
                        <tbody id="tbody1">
                            <input type="hidden" value="audit finalisation" name="part">
                            <?php foreach($dataaf as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="extent[]"><?= $r['extent']?></textarea></td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>

                </form>
                <br><br><br><hr>
 
                <h6>Signed Financial Statements and Audit Opinion</h6>
                <p>Have all outstanding matters noted above, including confirming that the financial statements do not contain material errors or misstatements, been cleared to the satisfaction of the originator (and crossed through to demonstrate this)?………………..........</p>
                <p>Has a letter of representation, dated on, or immediately prior to the date of the audit report, been obtained, or has an appropriate modification been given?……………………..</p>
                <p>I confirm that consideration has been given to subsequent events arising since the reporting date, to the date of the approval of the financial statements.  If matters have arisen, these have been disclosed in the financial statements in note ………………..........</p>
                <p>I confirm that the going concern basis *is / *is not appropriate, and that relevant disclosures have been made in the financial statements.</p>                       
                <p>In considering the audit opinion, I have considered whether:</p>
                <ul>
                    <li>Sufficient appropriate audit evidence has been obtained as to whether the financial statements as a whole are free from material misstatement, whether due to fraud or error;</li>
                    <li>Uncorrected misstatements, individually and in aggregate are immaterial;</li>
                    <li>The financial statements give a true and fair view; and</li>
                    <li>The financial statements have been correctly prepared in accordance with *National GAAP / *IFRS, including all relevant legal requirements.</li>
                </ul>
                <p>I approve the signing of an *unmodified / *modified audit opinion.</p>
                <p>*The opinion is modified for the reasons noted on………………………</p>
                <p>*The audit report includes an *emphasis of matter paragraph / *other matter paragraph for the reasons noted on .............................</p>
                <p>*As the audit opinion has been modified an additional paragraph has been included regarding the impact of the modification on the company’s ability to pay future dividends.</p>
                <p>Signed: (A.E.P)                 Date:</p>
                <h6>Completion by EQCR:</h6>
                <p>I have carried out a hot review, the scope of which is documented on………...</p>
                <p>*I am satisfied that all points raised in my review on ........................ have been cleared.</p>
                <p>*I have reviewed the proposed modification / emphasis of matter paragraph and consider it appropriate.</p>
                <p>*I confirm that the conclusion in 5 above is appropriate.</p>    
                <p>Signed:		(EQCR )                 Date:</p>
                <h6>Acceptance of Re-Appointment (to be completed by the A.E.P.)</h6>
                <h6>This section is to be completed by the A.E.P. prior to re-appointment.</h6>
                <p>Whilst answering these questions the following matters should be fully considered for the audit firm and any network firm: independence, integrity, conflicts of interest with other clients, economic dependence, trusts, matters arising with regulatory authorities, ability to service the client, other services provided to the client and hospitality. Additional guidance is available in legislation and the Code of Ethics issued by the International Ethics Standards Board for Accountants.</p>
                <h6>Any YES answers should be fully explained along with the safeguards, which will enable us to accept the re-appointment.</h6>
                <h6>Significant issues must be discussed with the Ethics Partner and details of the discussion should be documented on file.</h6>

                <form action="<?= base_url()?>auditsystem/client/saveaa1s3/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                <input type="hidden" name="acid" value="<?= $acID?>">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Yes/No</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Are there any matters which would alter any of the Ethical Considerations set out on the Regulation of Auditor’s Checklist (Ac2), Provision of Non-Audit Services to Audit Clients (Ac3), and Part 4 of the Audit Control Record?</td>
                            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="a1"><?= $s3['a1'];?></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="5" name="a2"><?= $s3['a2'];?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                Are there any matters which would alter any of the Ethical Considerations set out on the Regulation of Auditor’s Checklist (Ac2), Provision of Non-Audit Services to Audit Clients (Ac3), and Part 4 of the Audit Control Record?
                                <textarea class="form-control question" id="question" cols="30" rows="5" name="a3"><?= $s3['a3'];?></textarea>
                                Does any of the above affect our service as auditors of this client?
                            </td>
                            <td><textarea class="form-control question" id="question" cols="30" rows="7" name="a4"><?= $s3['a4'];?></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="7" name="a5"><?= $s3['a5'];?></textarea></td>
                        </tr>
                        <tr>
                            <td>Do we know of any other factors that could affect independence or otherwise indicate that we should not accept re-appointment?</td>
                            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="a6"><?= $s3['a6'];?></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="5" name="a7"><?= $s3['a7'];?></textarea></td>
                        </tr>
                    </tbody>
                </table>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>
                <h6>Authority to accept re-appointment:</h6>              
                <p>I have considered the above, and do not consider that there are any perceived threats to our independence, integrity and objectivity and believe that we *can accept / *can accept with the stated safeguards /* cannot accept this re-appointment. </p>         
                <p>Where necessary adequate consultation has been undertaken and documented with the Ethics Partner.</p>

            </div>
        </div>
    </div>
    
</main>


























