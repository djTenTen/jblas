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
                <h6>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)</h6>
                <h6> ~ Additional Disclosures for an Entity with Agricultural Activities</h6>
                <h6><u>Scope</u></h6>
                <p>This checklist should be completed where the entity is engaged in agricultural activities.</p>
                <p> <b> Agricultural Activities </b> are defined as ‘The management by an entity of the biological transformation and harvest of biological assets for sale or for conversion into agricultural produce or into additional biological assets’.</p>
                <p><b>Agricultural Produce </b> is defined as ‘The harvested product of the entity’s biological assets’.</p>
                <p><b>Biological Assets </b> are defined as ‘A living animal or plant’.</p>

                <form action="<?= base_url()?>auditsystem/wp/saveab4a/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    <input type="hidden" name="part" value="ab4d">
                    <table class="table table-bordered">
                        <thead>
                            <tr>    
                                <th colspan="6"></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th colspan="2">Reference</th>
                                <th>Questions</th>
                                <th>Y/N/NA</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ab4d as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['reference']?></td>
                                    <td><?= $r['extent']?></td>
                                    <td><?= $r['question']?></td>
                                    <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-success m-1 float-end">Save</button>

                </form>

            </div>
        </div>
    </div>
    
</main>










