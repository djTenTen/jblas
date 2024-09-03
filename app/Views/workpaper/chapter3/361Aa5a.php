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
                <form class="form-inline" action="<?= base_url()?>auditsystem/wp/saveaa5a/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    
                    <div class="row justify-content-center">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <h4>Specimen Management Letter – points arising</h4>
                            <h4>Private and Confidential</h4>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="mb-1" for="aa51d">Date</label><br>
                                    <input class="form-control" id="aa51d" type="date" placeholder="Insert legislation" name="aa51d" value="<?= $aa5a['aa51d']?>" />
                                </div>
                            </div>
                            <h6 class="text-center">Management Letter</h6>
                            <h6 class="text-center">Financial statements for the [year/period] ending [date]</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="mb-1" for="ml1">Introduction</label> <br>
                                    <label class="mb-1" for="ml1">Following our recent </label>
                                    <select name="ml1" id="ml1" class="form-select">
                                        <option value="<?= $aa5a['ml1']?>" selected><?= $aa5a['ml1']?></option>
                                        <option value="interim">interim</option>
                                        <option value="final">final</option>
                                    </select>
                                    <label class="mb-1" for="ml1d">ending</label>
                                    <input class="form-control" id="ml1d" type="date" placeholder="Insert legislation" name="ml1d" value="<?= $aa5a['ml1d']?>"/>
                                    <label class="mb-1" for="ml1d">we are writing to bring to your attention certain matters that arose during the course of our work, together with suggestions for improvements of controls and procedures operated by the company.  We hope you will find our comments helpful and constructive.</label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-check mb-2">
                                <label class="mb-1" for="ml2"><i>(Small organisations or clients with a few accounting staff:)</i></label> <br>
                                <div class="mb-3">
                                    <input class="form-check-input" id="ml2" type="checkbox" name="ml2" value="We recognise that the number of your accounting staff makes a complete system of internal control impracticable and that the directors or named client officials exercise close personal supervision, which we consider reasonable in the circumstances.  We have taken this into account in conducting our audit and in preparing this letter." <?php if($aa5a['ml2'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="ml2">We recognise that the number of your accounting staff makes a complete system of internal control impracticable and that the directors or named client officials exercise close personal supervision, which we consider reasonable in the circumstances.  We have taken this into account in conducting our audit and in preparing this letter. </label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="mb-1" for="leg3">Our work also included a review of the adequacy of disclosures in the financial statements and consideration of the appropriateness of the accounting policies and estimation techniques adopted by the company. This review identified no significant matters, which we believe are necessary to draw to your attention. </label>
                                </div>
                            </div>
                            <hr>
                            <h6>Summary</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="mb-1">The important matters that arose as a result of our work are set out in detail in the attached memorandum</label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-check mb-2">
                                <label class="mb-1" for="ml3"><i>(For groups or large organisations:)</i></label> <br>
                                <div class="mb-3">
                                    <input class="form-check-input" id="ml3" type="checkbox" name="ml3" value="We have prepared a separate memorandum for each subsidiary, division or different level of functional responsibility, as set out below:" <?php if($aa5a['ml3'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="ml3">We have prepared a separate memorandum for each subsidiary, division or different level of functional responsibility, as set out below: </label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="mb-1">We would particularly draw your attention to the following matters:</label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="ml4" type="checkbox" name="ml4" value="Significant qualitative aspects of the entity’s accounting practices, including accounting policies, accounting estimates and financial statement disclosures:" <?php if($aa5a['ml4'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="ml4">Significant qualitative aspects of the entity’s accounting practices, including accounting policies, accounting estimates and financial statement disclosures: </label>
                                    <textarea class="form-control form-control-sm" name="ml4d" id="ml4d" cols="30" rows="5" placeholder="Insert Summary list of key matters"><?php if($aa5a['ml4'] != ''){echo $aa5a['ml4d'];}?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="ml5" type="checkbox" name="ml5" value="Significant difficulties encountered during the audit:" <?php if($aa5a['ml5'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="ml5">Significant difficulties encountered during the audit: </label>
                                    <textarea class="form-control form-control-sm" name="ml5d" id="ml5d" cols="30" rows="5" placeholder="Insert Summary list of key matters"><?php if($aa5a['ml5'] != ''){echo $aa5a['ml5d'];}?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="ml6" type="checkbox" name="ml6" value="Other matters, if any, arising from the audit that in our professional judgment, are significant to the oversight of the financial reporting process:" <?php if($aa5a['ml6'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="ml6">Other matters, if any, arising from the audit that in our professional judgment, are significant to the oversight of the financial reporting process: </label>
                                    <textarea class="form-control form-control-sm" name="ml6d" id="ml6d" cols="30" rows="5" placeholder="Insert Summary list of key matters"><?php if($aa5a['ml6'] != ''){echo $aa5a['ml6d'];}?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-check mb-2">
                                <label class="mb-1" for="leg1"><i>(Where matters included in previous management letters have not been fully resolved:)</i></label> <br>
                                <div class="mb-3">
                                    <input class="form-check-input" id="ml7" type="checkbox" name="ml7" value="We wrote to you previously on " <?php if($aa5a['ml7'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="ml7">We wrote to you previously on  </label>
                                    <input class="form-control" id="ml7d" type="date" placeholder="Insert legislation" name="ml7d" value="<?php if($aa5a['ml7'] != ''){echo $aa5a['ml7d'];}?>"/>
                                    <label class="form-check-label" for="ml8">following our</label>
                                    <select name="ml8" id="ml8" class="form-select">
                                        <option value="<?= $aa5a['ml8']?>" selected><?= $aa5a['ml8']?></option>
                                        <option value="interim">interim</option>
                                        <option value="final">final</option>
                                    </select>
                                    <label class="form-check-label" for="ml8">audit for the [year/period] ending [date]. We are pleased to record that many of the matters raised have been dealt with satisfactorily.</label>
                                </div>
                            </div>
                            <hr>
                            <h6>Conclusion</h6>
                            <div class="form-check mb-2">
                                <div class="mb-3">
                                    <label class="form-check-label" for="bwr4">If you require any further information or assistance, we shall be very pleased to help you.</label><br>
                                    <label class="form-check-label" for="bwr4">We would appreciate an acknowledgement of the receipt of this letter and look forward to receiving your comments when you have had the opportunity of considering the matters that we have raised.</label><br>
                                    <label class="form-check-label" for="bwr4">This letter is for your private use only.  It has been prepared on the understanding that it will not be disclosed to any third party, or quoted to or referred to, without our prior written consent and we assume no responsibility to any other party.</label><br>
                                    <label class="form-check-label" for="bwr4">We should like to take this opportunity of thanking you and your staff for the assistance and co-operation we have received during the course of our work.  The contents of this letter were discussed with and have been approved by [name of client official(s)] on [date].</label><br>
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


















