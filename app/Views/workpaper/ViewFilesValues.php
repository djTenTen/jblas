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
                        <div class="page-header-subtitle">Select files for you clients</div>
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
            <?php if (session()->get('senttosup')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Files Sent</h6>
                        The file has been sent to Supervisor for Review.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('senttoaud')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Files Sent</h6>
                        The file has been sent to Auditor for Correction.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('sentoman')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Files Sent</h6>
                        The file has been sent to Auditor for Correction.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Progress</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="4"><h4>Chapter 1</h4></th>
                        </tr>
                        <?php foreach($c1 as $r){
                            $p = round(($r['y'] / $r['x']), 2) * 100;
                            ?>
                            <tr>
                                <td><?= $r['code']?></td>
                                <td><?= $r['title']?></td>
                                <td>
                                    <div class="progress mt-1">
                                        <span class="progress-bar bg-success" style="width:<?= $p?>%"><?= $p?>%</span>
                                    </div>
                                </td>
                                <td class="row">
                                    <?php if($r['remarks'] != 'Not Submitted' and $r['remarks'] != ''){?>
                                        <button class="btn btn-danger btn-icon btn-sm rem" data-bs-toggle="modal" data-remarks="<?= $r['remarks']?>" data-bs-target="#remarks" title="View Remarks"><i class="fas fa-flag"></i></button> 
                                    <?php }?>
                                    <?php if($r['code'] == 'AC10'){?>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/wp/chapter1/setvalues/')?><?= $r['code']?>-Tangibles/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" target="_blank" title="Set Values"><i class="fas fa-tools"></i></a>
                                    <?php }else{?>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/wp/chapter1/setvalues/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" target="_blank" title="Set Values"><i class="fas fa-tools"></i></a>
                                    <?php }?>
                                    <?php if($r['code'] == 'AC10'){?>
                                        <a class="btn btn-secondary btn-icon btn-sm" href="<?= base_url('auditsystem/wp/viewpdfc1/')?><?= $r['code']?>-Summary/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    <?php }else{?>
                                    <a class="btn btn-secondary btn-icon btn-sm" href="<?= base_url('auditsystem/wp/viewpdfc1/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    <?php }?>
                                    <?php if($p == 100){?>
                                        <?php if($type == 'Preparer'){?>
                                            <button class="btn btn-success btn-icon btn-sm sendtoreviewer" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoreview/c1/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to Reviewer"><i class="fas fa-paper-plane"></i></button>
                                        <?php }elseif($type == 'Reviewer'){?>   
                                            <button class="btn btn-warning btn-icon btn-sm sendtoauditor" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoauditor/c1/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send back to Auditor"><i class="fas fa-undo"></i></button>
                                            <button class="btn btn-success btn-icon btn-sm sendtomanager" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtomanager/c1/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to Manager"><i class="fas fa-paper-plane"></i></button>
                                        <?php }elseif($type == 'Audit Manager'){?>   
                                            <button class="btn btn-warning btn-icon btn-sm sendbacktoreviewer" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoreview/c1/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to back to Reviewer"><i class="fas fa-undo"></i></button>
                                            <button class="btn btn-success btn-icon btn-sm approve" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/approve/c1')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Approve"><i class="fas fa-thumbs-up"></i></button>
                                        <?php }?>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                        <tr>
                            <th colspan="4"><h4>Chapter 2</h4></th>
                        </tr>
                        <?php foreach($c2 as $r){
                            $p = round(($r['y'] / $r['x']), 2) * 100;
                            ?>
                            <tr>
                                <td><?= $r['code']?></td>
                                <td><?= $r['title']?></td>
                                <td>
                                    <div class="progress mt-1">
                                        <span class="progress-bar bg-success" style="width:<?= $p?>%"><?= $p?>%</span>
                                    </div>
                                </td>
                                <td class="row">
                                    <?php if($r['remarks'] != 'Not Submitted' and $r['remarks'] != ''){?>
                                        <button class="btn btn-danger btn-icon btn-sm rem" data-bs-toggle="modal" data-remarks="<?= $r['remarks']?>" data-bs-target="#remarks" title="View Remarks"><i class="fas fa-flag"></i></button> 
                                    <?php }?>
                                    <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/wp/chapter2/setvalues/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" target="_blank" title="Set Values"><i class="fas fa-tools"></i></a>
                                    <a class="btn btn-secondary btn-icon btn-sm" href="<?= base_url('auditsystem/wp/viewpdfc2/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    <?php if($p == 100){?>
                                        <?php if($type == 'Preparer'){?>
                                            <button class="btn btn-success btn-icon btn-sm sendtoreviewer" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoreview/c2/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to Reviewer"><i class="fas fa-paper-plane"></i></button>
                                        <?php }elseif($type == 'Reviewer'){?>   
                                            <button class="btn btn-warning btn-icon btn-sm sendtoauditor" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoauditor/c2/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send back to Auditor"><i class="fas fa-undo"></i></button>
                                            <button class="btn btn-success btn-icon btn-sm sendtomanager" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtomanager/c2/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to Manager"><i class="fas fa-paper-plane"></i></button>
                                        <?php }elseif($type == 'Audit Manager'){?>   
                                            <button class="btn btn-warning btn-icon btn-sm sendbacktoreviewer" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoreview/c2/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to back to Reviewer"><i class="fas fa-undo"></i></button>
                                            <button class="btn btn-success btn-icon btn-sm approve" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/approve/c2')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Approve"><i class="fas fa-thumbs-up"></i></button>
                                        <?php }?>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                        <tr>
                            <th colspan="4"><h4>Chapter 3</h4></th>
                        </tr>
                        <?php foreach($c3 as $r){
                            $p = round(($r['y'] / $r['x']), 2) * 100;
                            ?>
                            <tr>
                                <td><?= $r['code']?></td>
                                <td><?= $r['title']?></td>
                                <td>
                                    <div class="progress mt-1">
                                        <span class="progress-bar bg-success" style="width:<?= $p?>%"><?= $p?>%</span>
                                    </div>
                                </td>
                                <td class="row">
                                    <?php if($r['remarks'] != 'Not Submitted' and $r['remarks'] != ''){?>
                                        <button class="btn btn-danger btn-icon btn-sm rem" data-bs-toggle="modal" data-remarks="<?= $r['remarks']?>" data-bs-target="#remarks" title="View Remarks"><i class="fas fa-flag"></i></button> 
                                    <?php }?>
                                    <?php if($r['code'] == '3.10 Aa11'){?>
                                        <a class="btn btn-primary btn-icon btn-sm" data-file="<?= $r['code']?>" href="<?= base_url('auditsystem/wp/chapter3/setvalues/')?><?= $r['code']?>-un/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" target="_blank" title="Set Values"><i class="fas fa-tools"></i></a>
                                    <?php }elseif($r['code'] == '3.15 Ab4'){?>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/wp/chapter3/setvalues/')?><?= $r['code']?>-checklist/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" target="_blank" title="Set Values"><i class="fas fa-tools"></i></a>
                                    <?php }else{?>
                                        <a class="btn btn-primary btn-icon btn-sm" data-file="<?= $r['code']?>" href="<?= base_url('auditsystem/wp/chapter3/setvalues/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" target="_blank" title="Set Values"><i class="fas fa-tools"></i></a>
                                    <?php }?>
                                    <?php if($r['code'] == '3.10 Aa11'){?>
                                        <a class="btn btn-secondary btn-icon btn-sm" href="<?= base_url('auditsystem/wp/viewpdfc3/')?><?= $r['code']?>-un/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    <?php }else{?>
                                        <a class="btn btn-secondary btn-icon btn-sm" href="<?= base_url('auditsystem/wp/viewpdfc3/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    <?php }?>
                                    <?php if($p == 100){?>
                                        <?php if($type == 'Preparer'){?>
                                            <button class="btn btn-success btn-icon btn-sm sendtoreviewer" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoreview/c3/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to Reviewer"><i class="fas fa-paper-plane"></i></button>
                                        <?php }elseif($type == 'Reviewer'){?>   
                                            <button class="btn btn-warning btn-icon btn-sm sendtoauditor" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoauditor/c3/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send back to Auditor"><i class="fas fa-undo"></i></button>
                                            <button class="btn btn-success btn-icon btn-sm sendtomanager" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtomanager/c3/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to Manager"><i class="fas fa-paper-plane"></i></button>
                                        <?php }elseif($type == 'Audit Manager'){?>   
                                            <button class="btn btn-warning btn-icon btn-sm sendbacktoreviewer" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoreview/c3/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to back to Reviewer"><i class="fas fa-undo"></i></button>
                                            <button class="btn btn-success btn-icon btn-sm approve" type="button" data-file="<?= $r['code'].'-'.$r['title']?>" data-urlsubmit="<?= base_url('auditsystem/wp/approve/c3')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Approve"><i class="fas fa-thumbs-up"></i></button>
                                        <?php }?>
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

    <!-- Modal Send to Reviewer-->
    <div class="modal fade" id="tosend" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="toconfirm" action="" method="post">
                </div>
                <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Send</button>
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
        
        $('.sendtoreviewer').on('click', function () {
            var file = $(this).data('file');
            var urlsubmit = $(this).data('urlsubmit');
            $('#toconfirm').html(`<h6>Are you sure to send this file <b>`+ file +`</b> for Review?</h6><textarea name="remarks" class="lh-base form-control" type="text" placeholder="Remarks/Comment" rows="4"></textarea>`);
            $('#toconfirm').attr('action',urlsubmit);
        });  

        $('.sendtoauditor').on('click', function () {
            var file = $(this).data('file');
            var urlsubmit = $(this).data('urlsubmit');
            $('#toconfirm').html(`<h6>Are you sure to send back this file <b>`+ file +`</b> to Auditor for correction?</h6><textarea name="remarks" class="lh-base form-control" type="text" placeholder="Remarks/Comment" rows="4"></textarea>`);
            $('#toconfirm').attr('action',urlsubmit);
        });  

        $('.sendtomanager').on('click', function () {
            var file = $(this).data('file');
            var urlsubmit = $(this).data('urlsubmit');
            $('#toconfirm').html(`<h6>Are you sure to send this file <b>`+ file +`</b> to Manager for Approval?</h6><textarea name="remarks" class="lh-base form-control" type="text" placeholder="Remarks/Comment" rows="4"></textarea>`);
            $('#toconfirm').attr('action',urlsubmit);
        });  

        $('.sendbacktoreviewer').on('click', function () {
            var file = $(this).data('file');
            var urlsubmit = $(this).data('urlsubmit');
            $('#toconfirm').html(`<h6>Are you sure to send back this file <b>`+ file +`</b> to Reviewer for correction?</h6><textarea name="remarks" class="lh-base form-control" type="text" placeholder="Remarks/Comment" rows="4"></textarea>`);
            $('#toconfirm').attr('action',urlsubmit);
        }); 

        $('.approve').on('click', function () {
            var file = $(this).data('file');
            var urlsubmit = $(this).data('urlsubmit');
            $('#toconfirm').html(`<h6>Are you sure you approved this file <b>`+ file +`</b>? There are no more corrections?</h6><textarea name="remarks" class="lh-base form-control" type="text" placeholder="Remarks/Comment" rows="4"></textarea>`);
            $('#toconfirm').attr('action',urlsubmit);
        }); 


        $('.rem').on('click', function () {
            var remarks = $(this).data('remarks');
            $('#rem').html(remarks);
        });  


    });
    </script>
