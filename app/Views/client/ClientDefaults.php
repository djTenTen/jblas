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
                        <div class="page-header-subtitle">Set your client HAT audit files</div>
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
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Organization</th>
                            <th>Firm</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($client as $r){?>
                        <tr>
                            <td><?= $r['name']?></td>
                            <td><?= $r['org']?></td>
                            <th><?= $r['firm']?></th>
                            <td><?= $r['email']?></td>
                            <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>                            
                            <td>
                                <a class="btn btn-primary btn-icon btn-sm get-data" title="Process" type="button" href="<?= base_url('auditsystem/client/files/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>/<?= $r['name']?>"><i class="fas fa-stream"></i></button>
                               
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    
</main>
