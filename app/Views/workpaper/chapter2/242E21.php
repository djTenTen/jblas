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
                <h4>INVENTORY APPENDIX 1 – INVENTORY COUNT PLANNING</h4>
                <form action="<?= base_url()?>auditsystem/wp/aicpppa/save/<?= $code?>/<?= $c2tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">

                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Audit Tests – Attendance at Inventory Count – Planning Procedures Prior to Attending </th>
                                <th>Comments/Reference</th>
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

                <br><br><br><hr>


                <h6>Review of client’s inventory count procedures</h6>
                <p>This review should be completed before attending the client’s inventory count in conjunction with a copy of the client’s inventory count instructions.  Section 1 deals with overall controls, and sections 2 to 4 with inventory count instructions and procedures, section 5 covers inventory counts performed by independent inventory counters and section 6 covers clients that operate a cyclical inventory count system.</p>
                
                
                <form action="<?= base_url()?>auditsystem/wp/rcicp/save/<?= $code?>/<?= $c2tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">

                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Do the inventory count procedures cover:</th>
                                <th>Yes/No/N/A</th>
                                <th>Comments/ Reference</th>
                            </tr>
                        </thead>
                        <tbody id="tbody2">
                            <?php foreach($rcicp as $r1){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r1['acID'])?>"><?= $r1['question']?></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="yesno[]"><?= $r1['extent']?></textarea></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="comment[]"><?= $r1['reference']?></textarea></td>
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



  
    
    
    








