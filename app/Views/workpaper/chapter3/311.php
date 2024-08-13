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
            <?php if (session()->get('success_update')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Update</h6>
                        Contents has been successfully updated.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed_update')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Failed update</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
            <hr>
                <h1 class="text-center">AUDITOR’S REPORT ON FINANCIAL STATEMENTS </h1>
                <form class="form-inline" action="<?= base_url()?>auditsystem/wp/save311/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    
                    <div class="row justify-content-center">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <h6>Unqualified Opinion</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea class="form-control form-control-sm" name="uqo" id="uqo" cols="30" rows="5" placeholder="Insert Unqualified Opinion"><?= $arf['uqo']?></textarea>
                                </div>
                            </div>
                            <hr>
                            <h6></h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1" for="isa">INDEPENDENT AUDITOR’S REPORT TO THE MEMBERS OF [NAME OF ENTITY] LIMITED</label>
                                </div>
                            </div>
                            <hr>
                            <h6>Opinion</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1" for="tops">We have audited the financial statements of [Name of Entity] (the ‘company’) for the year ended [date] which comprise </label>
                                    <textarea class="form-control form-control-sm" name="tops" id="tops" cols="30" rows="5" placeholder="specify the titles of the primary statements"><?= $arf['tops']?></textarea>
                                    <label class="small mb-1" for="tops">and notes to the financial statements, including a summary of significant accounting policies.</label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">In our opinion, the accompanying financial statements:</label>
                                    <ul>
                                        <li>
                                            <label class="small mb-1" for="afsd">give a true and fair view of the financial position of the company as at </label>
                                            <input class="form-control" id="afsd" type="date" placeholder="Insert  [date]" name="afsd" value="<?= $arf['afsd']?>" />
                                            <label class="small mb-1" for="cf">and of its financial performance and </label>
                                            <input class="form-control" id="cf" type="text" placeholder="Insert  [cash flows]" name="cf" value="<?= $arf['cf']?>" />
                                            <label class="small mb-1" for="cf">for the year then ended;</label>
                                        </li>
                                        <li><label class="small mb-1" >have been properly prepared in accordance with International Financial Reporting Standards;</label></li>
                                        <li>
                                            <label class="small mb-1" for="leg1">and have been properly prepared in accordance with </label>
                                            <input class="form-control" id="leg1" type="text" placeholder="Insert  [legislation]" name="leg1" value="<?= $arf['leg1']?>"/>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <h6>Basis for opinion</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1" for="num7">We conducted our audit in accordance with International Standards on Auditing (ISAs).  Our responsibilities under those standards are further described in the Auditor’s Responsibilities for the Audit of the Financial Statements section of our report.  We are independent of the Company in accordance with the International Ethics Standards Board for Accountants Code of Ethics for Professional Accountants (IESBA Code), and we have fulfilled our other ethical responsibilities in accordance with these requirements.  We believe that the audit evidence we have obtained is sufficient and appropriate to provide a basis for our opinion.</label>
                                </div>
                            </div>
                            <hr>
                            <h6>Use of our report</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1" for="leg2">This report, including the opinion, has been prepared for and only for the company’s members as a body in accordance with </label>
                                    <input class="form-control" id="leg2" type="text" placeholder="Insert  [legislation]" name="leg2" value="<?= $arf['leg2']?>"/>
                                    <label class="small mb-1" for="leg2">and for no other purpose.  We do not, in giving these opinions, accept or assume responsibility for any other purpose or to any other person to whom this report is shown or into whose hands it may come save where expressly agreed by our prior consent in writing.</label>
                                </div>
                            </div>
                            <hr>
                            <h6>Responsibilities of directors for the financial statements</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1" for="jurleg">The directors are responsible for the preparation of financial statements that give a true and fair view in accordance with </label>
                                    <input class="form-control" id="jurleg" type="text" placeholder="Insert  [jurisdiction / legislation]" name="jurleg" value="<?= $arf['jurleg']?>"/>
                                    <label class="small mb-1" for="jurleg">and International Financial Reporting Standards, and for such internal control as the directors determine is necessary to enable the preparation of financial statements that are free from material misstatement, whether due to fraud or error.</label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">In preparing the financial statements, the directors are responsible for assessing the company’s ability to continue as a going concern, disclosing, as applicable, matters related to going concern and using the going concern basis of accounting unless the directors either intend to liquidate the company or to cease operations, or have no realistic alternative but to do so.</label>
                                </div>
                            </div>
                            <hr>
                            <h6>Auditor’s responsibilities for the audit of the financial statements</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1">Our objectives are to obtain reasonable assurance about whether the financial statements as a whole are free from material misstatement, whether due to fraud or error, and to issue an auditor’s report that includes our opinion.  Reasonable assurance is a high level of assurance, but is not a guarantee that an audit conducted in accordance with ISAs will always detect a material misstatement when it exists.</label>
                                    <label class="small mb-1">Misstatements can arise from fraud or error and are considered material if, individually or in the aggregate, they could reasonably be expected to influence the economic decisions of users taken on the basis of these financial statements.</label>
                                    <label class="small mb-1">As part of an audit in accordance with ISAs, we exercise professional judgment and maintain professional scepticism throughout the audit. We also:</label>
                                    <label class="small mb-1">
                                        <ul>
                                            <li>identify and assess the risks of material misstatement of the financial statements, whether due to fraud or error, design and perform audit procedures responsive to those risks, and obtain audit evidence that is sufficient and appropriate to provide a basis for our opinion.  The risk of not detecting a material misstatement resulting from fraud is higher than for one resulting from error, as fraud may involve collusion, forgery, intentional omissions, misrepresentations, or the override of internal control;</li>
                                            <li>obtain an understanding of internal control relevant to the audit in order to design audit procedures that are appropriate in the circumstances, but not for the purpose of expressing an opinion on the effectiveness of the company’s internal control;</li>
                                            <li>obtain an understanding of internal control relevant to the audit in order to design audit procedures that are appropriate in the circumstances, but not for the purpose of expressing an opinion on the effectiveness of the company’s internal control;</li>
                                            <li>conclude on the appropriateness of the directors’ use of the going concern basis of accounting and, based on the audit evidence obtained, whether a material uncertainty exists related to events or conditions that may cast significant doubt on the company’s ability to continue as a going concern. If we conclude that a material uncertainty exists, we are required to draw attention in our auditor’s report to the related disclosures in the financial statements or, if such disclosures are inadequate, to modify our opinion. Our conclusions are based on the audit evidence obtained up to the date of our auditor’s report. However, future events or conditions may cause the company to cease to continue as a going concern; and</li>
                                            <li>evaluate the overall presentation, structure and content of the financial statements, including the disclosures, and whether the financial statements represent the underlying transactions and events in a manner that achieves fair presentation.</li>
                                        </ul>
                                    </label>
                                    <label class="small mb-1">We communicate with those charged with governance regarding, among other matters, the planned scope and timing of the audit and significant audit findings, including any significant deficiencies in internal control that we identify during our audit.</label>
                                </div>
                            </div>
                            <hr>
                            <h6>Report on other legal and regulatory requirements</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="small mb-1" for="leg3">Opinions on other matters prescribed by the</label>
                                    <input class="form-control" id="leg3" type="text" placeholder="Insert  [legislation]" name="leg3" value="<?= $arf['leg3']?>"/>
                                    <textarea class="form-control form-control-sm" name="op1" id="op1" cols="30" rows="5" placeholder="Insert opinions " required><?= $arf['op1']?></textarea>
                                    <label class="small mb-1">Matters on which we are required to report by exception</label>
                                    <textarea class="form-control form-control-sm" name="op2" id="op2" cols="30" rows="5" placeholder="Insert opinions " required><?= $arf['op2']?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>

                    <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
            
            </div>
        </div>
    </div>
</main>


















