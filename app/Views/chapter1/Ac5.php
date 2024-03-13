<?php  $crypt = \Config\Services::encrypter();?>
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            <?= $title?>
                        </h1>
                        <div class="page-header-subtitle"><?= $code.' - '.$header?></div>
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
    
            <div class="card-body">
               
                <h4>PRELIMINARY ANALYTICAL PROCEDURES</h4>
                <h6>Summary of results and preliminary analytical procedures</h6>
                <h6>Objectives:</h6>
                <ul>
                    <li>To highlight the impact on this period’s audit, including consideration of any unexpected ratios or variances which could be indicative of fraud.</li>
                    <li>To ensure that risks identified are transferred to the risk assessment and into the audit approach / work programmes as required and are cross referenced to indicate this.</li>
                    <li>Where a parent company produces consolidated financial statements, consideration must be given to the parent company figures and the consolidated figures.</li>
                </ul>

                <h4>Results:</h4>
                <form action="<?= base_url()?>auditsystem/c1/res/update/AC5/<?= $header?>/<?= $c1tID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($res['acID']))?>" method="post">
                    <textarea class="form-control" cols="30" rows="20" name="res" required><?= $res['question']?></textarea>
                    <button type="submit" class="btn btn-sm btn-icon btn-success float-end"><i class="fas fa-file-alt"></i></button>
                </form>

                <h4>Conclusion:</h4>
                <form action="<?= base_url()?>auditsystem/c1/res/update/AC5/<?= $header?>/<?= $c1tID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($con['acID']))?>" method="post">
                    <textarea class="form-control" cols="30" rows="20" name="res" required><?= $con['question']?></textarea>
                    <button type="submit" class="btn btn-sm btn-icon btn-success float-end"><i class="fas fa-file-alt"></i></button>
                </form>
    










            </div>
        </div>
    </div>
    
</main>
