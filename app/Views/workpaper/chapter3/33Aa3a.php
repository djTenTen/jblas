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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/wp/viewpdfc3/')?><?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>SUBSEQUENT EVENTS REVIEW</h4>
                    <h6>Objective:</h6>
                    <p>To determine whether any material adjustment or disclosure is required to the financial statements as a result of events occurring between the end of the accounting period and the date of signing the audit report and to ensure the requirements of ISA 560 regarding subsequent events are met.</p>
                    <h6>NB: An adjusting event is an event that provides evidence of a condition that existed at the reporting date.  A non-adjusting event is an event that arose solely after the reporting date, however, its disclosure is necessary to give a true and fair view.</h6>
                    <h6>Review of Clients Records</h6>
                    <form action="<?= base_url()?>auditsystem/wp/saveaa3a/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" value="cr" name="part">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Question</th>
                                    <th style="width: 50%;">Comment</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php foreach($cr as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="3" name="comment[]"><?= $r['reference']?></textarea></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Discussion with Client</h6>
                    <form action="<?= base_url()?>auditsystem/wp/saveaa3a/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" value="dc" name="part">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Question</th>
                                    <th style="width: 50%;">Comment</th>
                                </tr>
                            </thead>
                            <tbody id="tbody1">
                                <?php foreach($dc as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="3" name="comment[]"><?= $r['reference']?></textarea></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Finalisation of the Audit File</h6>
                    <p>This section should also detail any other work done on subsequent events not covered by the questions below.</p>
                    <form action="<?= base_url()?>auditsystem/wp/saveaa3afaf/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" value="faf" name="part">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Question</th>
                                    <th style="width: 25%;">Initial & Date</th>
                                    <th style="width: 25%;">Reference</th>
                                </tr>
                            </thead>
                            <tbody id="tbody2">
                                <?php foreach($faf as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="3" name="extent[]"><?= $r['extent']?></textarea></td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h4>Initial Conclusion:</h4>
                    <form action="<?= base_url()?>auditsystem/wp/saveaa3air/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <p>Having completed the above procedures:</p>
                        <p>There were no significant events. </p>
                        <input type="hidden" name="acid" value="<?= $acID?>">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-1" for="sia">Subsequent events identified above</label>
                                <select name="sia" id="sia" class="form-select">
                                    <option value="<?= $air['sia']?>" selected><?= $air['sia']?></option>
                                    <option value="have">have</option>
                                    <option value="have not">have not</option>
                                </select>
                                <label class="mb-1" for="sia">been adequately reflected in the financial statements.</label>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1" for="seh">Significant events highlighted by this review, including any disagreements with the client have been brought to the A.E.P.'s attention and are noted on schedule</label>
                                <textarea class="form-control" name="seh" id="seh" cols="30" rows="5" placeholder="Insert noted on schedule"><?= $air['seh']?></textarea>
                            </div>
                        </div>
                        <h4>Final Conclusion:</h4>
                        <p>The initial review was conducted sufficiently close to the proposed date of the audit report not to require the work to be revised.</p>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-1" for="tird">The initial review has been updated to</label>
                                <input class="form-control" type="date" name="tird" value="<?= $air['tird']?>">
                                <label class="mb-1" for="ir">The work performed is outlined below:</label>
                                <textarea class="form-control" cols="30" rows="5" name="ir" required><?= $air['ir']?></textarea>
                            </div>
                        </div>
                        <p>Having reviewed the above procedures:</p>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-1" for="tfrd">I am satisfied that no further significant events have occurred between the initial review as documented by the conclusion above and (date of the final review)</label>
                                <input class="form-control" type="date" name="tfrd" value="<?= $air['tfrd']?>">
                            </div>
                        </div>
                        <p>Significant events that have occurred are explained above, have been communicated to the A.E.P., and adequately accounted for / disclosed in the financial statements. *</p>
                        <button type="submit" class="btn btn-sm btn-success float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
</main>






























