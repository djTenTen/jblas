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
                <h4>PRELIMINARY PLANNING PROCEDURES – CLIENT INVOLVEMENT IN THE PLANNING PROCESS</h4>
                <h6>NB: The key issues noted from this document must be recorded in the relevant areas of the audit file or the PAF and should feed through into the risk assessment, audit approach and fieldwork.</h6>
                <form action="<?= base_url()?>auditsystem/client/saveac4ppr/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $name?>" method="post">
                    <input type="hidden" name="acid" value="<?= $acID?>">
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <h6>Which members of the client staff and the audit team have been involved in the preplanning process and what are their roles?</h6>
                                <textarea class="form-control" cols="30" rows="3" name="ppr1" required><?= $ppr['ppr1']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>How was the communication undertaken and on what date? </h6>
                                <textarea class="form-control" cols="30" rows="3" name="ppr2" required><?= $ppr['ppr2']?></textarea>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>

                <br><br><br><hr>
                <p>In respect of a new audit assignment, where the discussion points below request “changes” to be noted, full information should be documented, as the working papers will not document “existing” issues affecting the client.</p>

                <form action="<?= base_url()?>auditsystem/client/saveac4/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $name?>" method="post">
                    <input type="hidden" name="part" value="ac4sod">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted:</th>
                                <th style="width: 50%;"></th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac4 as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
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

