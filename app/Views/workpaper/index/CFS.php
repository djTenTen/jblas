<?php  
    $crypt = \Config\Services::encrypter();
?>
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
                        <div class="page-header-subtitle"><?= $subt?></div>
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

            <div class="card-body">
                <h3 class="p-3"><?= $subt?></h3>
                
                <div class="row mb-3">
                    <div class="col-3">
                        <h3>Upload PDF File</h3>
                        <form action="<?= base_url()?>auditsystem/wp/index/cfs/upload/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post" enctype="multipart/form-data">
                            <input type="file" name="pdf" id="excelInput" accept=".pdf" class="form form-control">
                            <br>
                            <button type="submit" class="btn btn-success">Import File</button>
                        </form>
                    </div>
                    <div class="col-7">
                    
                    </div>
                </div>
                <div class="container">
                    <object data="<?= base_url()?>uploads/pdf/wp/<?= $crypt->decrypt(session()->get('firmID'))?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $aa['file']?>" type="application/pdf" frameborder="0" width="100%" height="1000"> </object>
                </div>
                
            </div>
        </div>
    </div>
</main>


    
    
    
  