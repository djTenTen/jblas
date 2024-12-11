<?php  
    function encr($ecr){
        $crypt = \Config\Services::encrypter();
        return str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ecr));
    }
?>
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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/wp/viewpdfc3/')?><?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>CRITICAL REVIEW OF THE FINANCIAL STATEMENTS</h4>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveab1/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
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
                                        <td><input type="hidden" name="acid[]" value="<?= encr($r['mdID'])?>"><?= $r['field1']?></td>
                                        <td>
                                            <select name="yesno[]" id="" class="form-select yesno">
                                                <option value="<?= $r['field2']?>"><?= $r['field2']?></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </td>
                                        <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['field3']?></textarea></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <p>The tests above were undertaken on draft financial statements sent to the client.</p>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>