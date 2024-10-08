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
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <?php if (session()->get('senttoaud')) { ?>
            <div class="alert alert-success alert-icon" role="alert">
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-icon-content">
                    <h6 class="alert-heading">Files Sent</h6>
                    The file has been sent to Auditor for Correction.
                </div>
            </div>
        <?php  }?>
        <?php if (session()->get('invalid_input')) { ?>
            <div class="alert alert-danger alert-icon" role="alert">
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-icon-content">
                    <h6 class="alert-heading">Invalid Input</h6>
                    Something wrong with your data inputd, please try again.
                </div>
            </div>
        <?php  }?>
        <div class="card">
            <div class="card-body">
            <table class="table table-hover table-sm" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>FY</th>
                        <th>End of FY</th>
                        <th>Assigned</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Added_on</th>
                        <th>Added_by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($wp as $r){
                            $x = $r['x1'] + $r['x2'] + $r['x3'];
                            $y = $r['y1'] + $r['y2'] + $r['y3'];
                            if($x == 0 or $y == 0){
                                $p = 1;
                            }else{
                                $ir = ($r['ir'] * 50) /  $r['ti'];
                                $ic = ($r['ic'] * 75) /  $r['ti'];
                                $ia = ($r['ia'] * 100) /  $r['ti'];
                                $z = round($ir + $ic + $ia, 2);
                                $p = round($y / $x, 2) * 100;
                                $p = round(($p * .75) + ($z * .25));
                            }
                    ?>
                        <tr>
                            <td><?= $r['cli']?></td>
                            <td><?= $r['financial_year']?></td>
                            <td><?= date('F-d', strtotime($r['financial_year'].'-'.$r['end_financial_year']))?></td>
                            <td>
                                <span class="badge bg-warning"><?= $r['aud']?></span><br>
                                <span class="badge bg-secondary"><?= $r['sup']?></span><br>
                                <span class="badge bg-success"><?= $r['audm']?></span>
                            </td>
                            <td>
                                <?php if($r['status'] == 'Preparing'){?>
                                    <span class="badge bg-warning"><?= $r['status']?></span>
                                <?php }elseif($r['status'] == 'Reviewing'){?>
                                    <span class="badge bg-secondary"><?= $r['status']?></span>
                                <?php }elseif($r['status'] == 'Checking'){?>
                                    <span class="badge bg-primary"><?= $r['status']?></span>
                                <?php }elseif($r['status'] == 'Approved'){?>
                                    <span class="badge bg-success"><?= $r['status']?></span>
                                <?php }?>
                            </td>
                            <td>
                                <div class="progress mt-1">
                                    <span class="progress-bar" style="width:<?= $p?>%"><?= $p?>%</span>
                                </div>
                            </td>
                            <td><?= date('F d, Y h:i A', strtotime($r['added_on']))?></td>
                            <td><?= $r['added']?></td>
                            <td>
                                <?php if($r['remarks'] != 'Not Submitted' and $r['remarks'] != ''){?>
                                    <button class="btn btn-danger btn-icon btn-sm rem" data-bs-toggle="modal" data-remarks="<?= $r['remarks']?>" data-bs-target="#remarks" title="View Remarks"><i class="fas fa-flag"></i></button>
                                <?php }?>
                                <?php if(session()->get('allowed')->edit == "Yes"){?>
                                    <a class="btn btn-secondary btn-icon btn-sm get-data" title="Set values" type="button" href="<?= base_url('auditsystem/wp/getfiles/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['client']))?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['wpID']))?>/<?= $r['cli'].' - '.$r['org']?>"><i class="fas fa-highlighter"></i></a>
                                <?php }?>
                                <?php if($r['status'] == 'Reviewing'){?>
                                    <button class="btn btn-warning btn-icon btn-sm sendtoauditor" type="button" data-file="<?= 'FY-'.$r['financial_year'].': '.$r['cli']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtopreparer/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['wpID']))?>" data-bs-toggle="modal" data-bs-target="#sendtoauditor" title="Send to Auditor"><i class="fas fa-undo"></i></button>
                                    <button class="btn btn-success btn-icon btn-sm sendtomanager" type="button" data-file="<?= 'FY-'.$r['financial_year'].': '.$r['cli']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoapprover/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['wpID']))?>" data-bs-toggle="modal" data-bs-target="#sendtoauditor" title="Send to Manager"><i class="fas fa-paper-plane"></i></button>
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
<!-- Modal Review-->
<div class="modal fade" id="sendtoauditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formsend" action="" method="post">
            </div>
            <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal REMARKS-->
<div class="modal fade" id="remarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Remarks</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="rem">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('.sendtoauditor').on('click', function () {
        var file = $(this).data('file');
        var urlsubmit = $(this).data('urlsubmit');
        $('#formsend').html(`<h6>Are you sure to send this file <b>`+ file +`</b> for Correction?</h6></h6><textarea name="remarks" class="lh-base form-control" type="text" placeholder="Remarks/Comment" rows="4"></textarea>`);
        $('#formsend').attr('action',urlsubmit);
    });  
    $('.sendtomanager').on('click', function () {
        var file = $(this).data('file');
        var urlsubmit = $(this).data('urlsubmit');
        $('#formsend').html(`<h6>Are you sure to send this file <b>`+ file +`</b> to Manager?</h6></h6><textarea name="remarks" class="lh-base form-control" type="text" placeholder="Remarks/Comment" rows="4"></textarea>`);
        $('#formsend').attr('action',urlsubmit);
    }); 
    $('.rem').on('click', function () {
        var remarks = $(this).data('remarks');
        $('#rem').html(remarks);
    });  
});
</script>