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
                        <div class="page-header-subtitle">Chapter 2 - Detailed Procedures</div>
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
            <div class="card-header">Chapter 2 Titles</div>
            <div class="card-body">

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($c2 as $r){?>
                            <tr>
                                <td><?= $r['code']?></td>
                                <td><?= $r['title']?></td>
                                <td>
                                    <a target="_blank" href="<?= base_url()?>auditsystem/c2/manage/<?= $r['code']?>/<?= $r['title']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID'])); ?>" class="btn btn-primary btn-sm">Manage</a>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
</main>
