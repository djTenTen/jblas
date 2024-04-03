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
                        <div class="page-header-subtitle">Firms</div>
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
            <?php if (session()->get('verified')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Verified</h6>
                        The User has been successfully verified.
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
               
                <table class="table table-hover" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Firm</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Verified</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($firm as $r){?>
                            <tr>
                                <td><?= $r['name']?></td>
                                <td><?= $r['firmname']?></td>
                                <td><?= $r['email']?></td>
                                <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                <td><?php if($r['verified'] == 'Yes'){echo '<span class="badge bg-success">'.$r['verified'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['verified'].'</span>';}?></td>
                                <td>
                                    <?php if($r['verified'] == 'No'){?>
                                        <button class="btn btn-primary btn-icon btn-sm verify-data" title="Verify" type="button" data-bs-toggle="modal" data-bs-target="#verify" data-firm="<?= $r['firmname']?>" data-verify="<?= $r['name']?>" data-usid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['userID']))?>"><i class="fas fa-check-circle"></i></button>
                                    <?php }?>
                                    
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>







            
                
            </div>
        </div>
    </div>
    
</main>

<!-- Modal Logout-->
<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <h4>Are you sure to Verify <span class="user"></span> from <span class="firm"></span> firm?</h4>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                <form id="vform" action="" method="post">
                    <button class="btn btn-primary" type="submit">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    $(".verify-data").on("click", function() {
        var firm = $(this).data('firm');
        var verify = $(this).data('verify');
        var usid = $(this).data('usid');
        $('#vform').attr('action', "<?= base_url('auditsystem/firms/verify/')?>" + usid);
        $('.user').html(verify);
        $('.firm').html(firm);
    });

});
</script>

