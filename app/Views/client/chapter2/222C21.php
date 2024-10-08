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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter2/view/')?><?= $code?>/<?= $c2tID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>PROPERTY, PLANT AND EQUIPMENT – TOP UP PROGRAMME</h4>
                    <i><p>This programme includes “top up” tests to be completed when the entity has the following</p>
                        <ul>
                            <li>Leased assets</li>  
                            <li>Assets financed by capital grants</li>
                        </ul>
                    </i>
                    <h6>SPECIFIC AREA 1 – LEASED ASSETS </h6>
                    <p><i>IFRS 16 ‘Leases’ is a brand-new Standard and is mandatory for accounting periods commencing on/after 1 January 2019. </i></p>
                    <p><i>IFRS 16 fundamentally affects the way in which lessees account for leases; all leases (except those which are short term (i.e. 12 months or less) or those for which the underlying asset is of low value) now result in the recognition of a “right of use” asset and a corresponding lease liability. </i></p>
                    <p><i><p><i>IFRS 16 fundamentally affects the way in which lessees account for leases; all leases (except those which are short term (i.e. 12 months or less) or those for which the underlying asset is of low value) now result in the recognition of a “right of use” asset and a corresponding lease liability. </i></p></i></p>
                    <p><i>First time adoption of IFRS 16 requires transition adjustments. The entity has a choice over the transition method adopted:</i></p>
                    <i>
                        <ul>
                            <li>full retrospective restatement (i.e. restate comparatives in line with the IFRS 16 requirements), subject to some practical expedients; or</li>
                            <li>a “cumulative catch up”, where opening retained earnings are adjusted to account for the IFRS 16 impact, but the comparatives are unaffected.</li>
                        </ul>
                    </i>
                    <p><i>Audit work will be required on the transition adjustments made. </i></p>
                    <p><i>Auditors must read IFRS 16, the accompanying application guidance (Appendix B of IFRS 16) and the transition requirements (Appendix C of IFRS 16) to gain a full understanding of the accounting requirements. </i></p>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c2/savec2/<?= $code?>/<?= $c2tID?>/<?= $cID?>/<?= $name?>" method="post">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Audit Tests</th>
                                    <th style="width: 15%;">Extent</th>
                                    <th style="width: 15%;">Reference</th>
                                    <th style="width: 15%;">Initials/Date</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php foreach($qdata as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                        <td><textarea class="form-control question" id="question" cols="30" rows="3" name="extent[]"><?= $r['extent']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="initials[]"><?= $r['initials']?></textarea></td>
                                    </tr>
                                <?php }?>
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


























