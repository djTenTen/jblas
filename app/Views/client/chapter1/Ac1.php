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
               <!-- Contents Here -->
                <hr>
                <h4>Client Acceptance or Continuance Form</h4>
                <h6">This form must be completed by the A.E.P. before any work is undertaken on the file.</p>
                <p>While answering these questions the following matters should be fully considered for the audit firm and any network firm: independence, integrity, conflicts of interest with other clients, economic dependence, trusts, matters arising with regulatory authorities, ability to service the client, other services provided to the client and hospitality. Additional guidance is available in legislation and the Code of Ethics issued by the International Ethics Standards Board for Accountants.  </h6>
                <h6>Any YES answers should be fully explained along with the safeguards, which will enable us to accept / continue with the appointment. </h6>
                <h6>Significant issues must be discussed with the <span class="text-danger">Ethics Partner</span> and details of the discussion documented on file.</h6>
                
                <form action="<?= base_url()?>auditsystem/client/saveac1/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $name?>" method="post">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 55%;">Question</th>
                                <th style="width: 10%;">Yes/No</th>
                                <th style="width: 35%;">Comment</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac1 as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"> <?= $r['question']?></td>
                                    <td>
                                        <select name="yesno[]" id="" class="form-select">
                                            <option value="<?= $r['yesno']?>" selected><?= $r['yesno']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success m-1 float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>

                <br><br><br><hr>


                <form action="<?= base_url()?>auditsystem/client/saveac1eqr/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $name?>" method="post">
                <input type="hidden" name="acid" value="<?= $acID?>">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="small mb-1" for="eqr"><h4>ENGAGEMENT QUALITY REVIEW:</h4></label>
                        <select name="eqr" id="eqr" class="form-select">
                            <option value="<?= $eqr['eqr']?>" selected><?= $eqr['eqr']?></option>
                            <option value="The firm’s criteria for a review has been met.">The firm’s criteria for a review has been met.</option>
                            <option value="The A.E.P. deems it necessary for a review to be undertaken.">The A.E.P. deems it necessary for a review to be undertaken.</option>
                            <option value="It is required as a safeguard against threats which have been identified to the firm’s objectivity and independence.  It should be considered on all assignments where non-audit services have been provided.">It is required as a safeguard against threats which have been identified to the firm’s objectivity and independence.  It should be considered on all assignments where non-audit services have been provided.</option>
                            <option value="No EQR needs to be performed.">No EQR needs to be performed.</option> 
                            <option value="It is necessary for an EQR to be performed and this will be performed by: ">It is necessary for an EQR to be performed and this will be performed by: </option>               
                            <option value="Where the EQR is undertaken by an external reviewer the name of the organisation which they work for ">Where the EQR is undertaken by an external reviewer the name of the organisation which they work for </option>     
                        </select>
                        <label class="small mb-1" for="eqr1">It is necessary for an EQR to be performed and this will be performed by:</label>
                        <input type="text" class="form-control border-dark" id="eqr1" name="eqr1" value="<?= $eqr['eqr1']?>">
                        <label class="small mb-1" for="eqr2">Where the EQR is undertaken by an external reviewer the name of the organisation which they work for</label>
                        <input type="text" class="form-control border-dark" id="eqr2" name="eqr2" value="<?= $eqr['eqr2']?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="small mb-1" for="eqrr">REASON FOR EQR (If an EQR review was performed in the previous period, but is not being performed in the current period, this decision must also be justified.)</label>
                        <textarea class="form-control border-dark" cols="30" rows="5" name="eqrr" required><?= $eqr['eqrr']?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Authority to accept appointment:</h4>
                    <div class="mb-3">
                        <label class="small mb-1" for="hcc">Having completed the checklist</label>
                        <select name="hcc" id="hcc" class="form-select">
                            <option value="<?= $eqr['hcc']?>" selected><?= $eqr['hcc']?></option>
                            <option value="I do">I do</option>
                            <option value="I do not">I do not</option>
                        </select>
                        <label class="small mb-1" for="iio">consider that there are any perceived threats to our independence, integrity and objectivity, and believe that we</label>
                        <select name="iio" id="iio" class="form-select">
                            <option value="<?= $eqr['iio']?>" selected><?= $eqr['iio']?></option>
                            <option value="can accept">can accept</option>
                            <option value="can accept with the stated safeguards">can accept with the stated safeguards</option>
                            <option value="cannot accept">cannot accept</option>
                        </select>
                        <label class="small mb-1" for="iio">this appointment.</label>
                    </div>
                </div>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                
            </div>
        </div>
    </div>
    
</main>

