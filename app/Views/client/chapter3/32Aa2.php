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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $code?>/<?= $c3tID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>POINTS FORWARD</h4>
                    <h6>Objective: </h6>
                    <p>To provide a summary of the key points arising from the audit, where it is possible for improvements to the efficiency of the audit to be made, and should include both financial and non-financial matters. <i> The use of this form is optional. </i> </p>
                    <h6>Recording:</h6>
                    <p>This form should be completed during the audit, and should cover key matters which are of relevance to next year’s assignment.</p>
                    <p>If information has been included elsewhere on the audit file (for example, Subsequent Events Review, or the ISA Compliance Critical Issues Memorandum), it does not need to be repeated.  Where appropriate, details of suggested improvements should be outlined.</p>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa2/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $acID?>">
                        <h6>Problems encountered during the audit (regarding audit tests):</h6>
                        <textarea class="form-control" cols="30" rows="15" name="rat" ><?= $aa2['rat']?></textarea>
                        <br>
                        <h6>Problems encountered during the audit (regarding the client, and their accessibility etc.):</h6>
                        <textarea class="form-control" cols="30" rows="15" name="rcae" ><?= $aa2['rcae']?></textarea>
                        <br>
                        <h6>Audit tests which can be removed / reduced without impairing audit quality:</h6>
                        <textarea class="form-control" cols="30" rows="15" name="atriaq" ><?= $aa2['atriaq']?></textarea>
                        <br>
                        <h6>Known changes to, or new accounting policies and estimation techniques in the forthcoming period:</h6>
                        <textarea class="form-control" cols="30" rows="15" name="kcapet" ><?= $aa2['kcapet']?></textarea>
                        <br>
                        <h6>Future developments (nature of business, locations, acquisitions and disposals):</h6>
                        <textarea class="form-control" cols="30" rows="15" name="fd" ><?= $aa2['fd']?></textarea>
                        <br>
                        <h6>Future structure of the audit team:</h6>
                        <textarea class="form-control" cols="30" rows="15" name="fs" ><?= $aa2['fs']?></textarea>
                        <br>
                        <h6>Other issues:</h6>
                        <textarea class="form-control" cols="30" rows="15" name="oi" ><?= $aa2['oi']?></textarea>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>



















