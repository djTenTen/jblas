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
                
                <h4>CRITICAL REVIEW OF THE FINANCIAL STATEMENTS</h4>
               

                <form action="<?= base_url()?>auditsystem/wp/saveab1/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Question</th>
                                <th>Yes/No</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ab1 as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                </tr>
                            
                            <?php }?>
                        </tbody>
                    </table>
                
                    <button type="submit" class="btn btn-success m-1 float-end">Save</button>

                </form>
            
            
                <p>The tests above were undertaken on draft financial statements sent to the client.</p>
            
            
            
            </div>
        </div>
    </div>
    
</main>