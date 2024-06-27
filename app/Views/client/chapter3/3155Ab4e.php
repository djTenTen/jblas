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
                <h6>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)</h6>
                <h6> ~ Additional Disclosures for First Time Adopters of IFRS</h6>
                <h6><u>Scope</u></h6>
                <p>This checklist should be completed for all entities that are adopting IFRS for the first time.</p>

                <form action="<?= base_url()?>auditsystem/client/saveab4a/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                    <input type="hidden" name="part" value="ab4e">
                    <table class="table table-bordered">
                        <thead>
                            <tr>    
                                <th colspan="6"></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th colspan="2" style="width: 5%;">Reference</th>
                                <th style="width: 55%;">Questions</th>
                                <th style="width: 10%;">Y/N/NA</th>
                                <th style="width: 30%;">Comments</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ab4e as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['reference']?></td>
                                    <td><?= $r['extent']?></td>
                                    <td><?= $r['question']?></td>
                                    <td>
                                        <select name="yesno[]" id="" class="form-select">
                                            <option value="<?= $r['yesno']?>" selected><?= $r['yesno']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>

                </form>
                <br><br><br><hr>

            </div>
        </div>
    </div>
    
</main>


