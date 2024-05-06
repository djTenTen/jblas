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
                <h4>DSHARE-BASED PAYMENTS</h4>
                <p><i>This work programme should be used when an entity has share-based payment transactions that fall within the scope of IFRS 2.  Typically share-based payments are offered to employees as an incentive to remain with the entity, but they can be offered to third parties in return for the provision of goods and services.  The corresponding disclosure requirements of IFRS 2 are set out in a Supplementary Checklist to the full Corporate Disclosure Checklist, see Appendix 3.15.3.</i></p>
                <p><i>NB: The valuation of share-based payments cannot be undertaken by the auditor. It is unlikely that most audit firms could demonstrate competency in this area and unless the fair value was immaterial it would also be a breach of the IESBA’s Code of Ethics. </i></p>
                <form action="<?= base_url()?>auditsystem/wp/savec2/<?= $code?>/<?= $c2tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Audit Tests</th>
                                <th>Extent</th>
                                <th>Reference</th>
                                <th>Initials/Date</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php foreach($qdata as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="extent[]"><?= $r['extent']?></textarea></td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="initials[]"><?= $r['initials']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
            </div>
        </div>
    </div>
</main>
