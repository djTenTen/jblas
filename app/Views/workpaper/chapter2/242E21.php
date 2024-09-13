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
                    <h4>INVENTORY APPENDIX 1 – INVENTORY COUNT PLANNING</h4>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c2/aicpppa/save/<?= $code?>/<?= $c2tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Audit Tests – Attendance at Inventory Count – Planning Procedures Prior to Attending </th>
                                    <th style="width: 50%;">Comments/Reference</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php foreach($aicpppa as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                        <td><textarea class="form-control question" id="question" cols="30" rows="5" name="comment[]"><?= $r['reference']?></textarea></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Review of client’s inventory count procedures</h6>
                    <p>This review should be completed before attending the client’s inventory count in conjunction with a copy of the client’s inventory count instructions.  Section 1 deals with overall controls, and sections 2 to 4 with inventory count instructions and procedures, section 5 covers inventory counts performed by independent inventory counters and section 6 covers clients that operate a cyclical inventory count system.</p>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c2/rcicp/save/<?= $code?>/<?= $c2tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Do the inventory count procedures cover:</th>
                                    <th style="width: 25%;"> Yes/No/N/A</th>
                                    <th style="width: 25%;" >Comments/ Reference</th>
                                </tr>
                            </thead>
                            <tbody id="tbody2">
                                <?php foreach($rcicp as $r1){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r1['acID'])?>"><?= $r1['question']?></td>
                                        <td>
                                            <select name="yesno[]" id="" class="form-select">
                                                <option value="<?= $r1['extent']?>" selected><?= $r1['extent']?></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </td>
                                        <td><textarea class="form-control question" id="question" cols="30" rows="3" name="comment[]"><?= $r1['reference']?></textarea></td>
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



  
    
    
    








