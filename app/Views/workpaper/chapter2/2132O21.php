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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/wp/viewpdfc2/')?><?= $code?>/<?= $c2tID?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>IFRS 15 CONSIDERATIONS</h4>
                    <p><i>IFRS 15 ‘Revenue from Contracts with Customers’ became mandatory for accounting periods commencing on/after 1 January 2018. </i></p>
                    <p><i>The core principle of IFRS 15 is that “an entity shall recognise revenue to depict the transfer of promised goods or services to customers in an amount that reflects the consideration to which the entity expects to be entitled in exchange for those goods or services”. </i></p>
                    <p><i>The 5-step approach to recognising revenue is as follows:</i></p>
                    <p><i>Step 1: Identify the contract(s) with a customer.</i></p>
                    <p><i>Step 2: Identify the performance obligations in the contract.</i></p>
                    <p><i>Step 3: Determine the transaction price.</i></p>
                    <p><i>Step 4: Allocate the transaction price to the performance obligations in the contract.</i></p>
                    <p><i>Step 5: Recognise revenue when (or as) the entity satisfies a performance obligation.</i></p>
                    <p><i>Auditors must read IFRS 15, the accompanying application guidance (Appendix B of IFRS 15) and the transition requirements (Appendix C of IFRS 15) to gain a full understanding of the accounting requirements. </i></p>
                    <form action="<?= base_url()?>auditsystem/wp/savec2/<?= $code?>/<?= $c2tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">ACCOUNTING ESTIMATES</th>
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
