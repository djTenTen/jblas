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
            <?php if (session()->get('added')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Workpaper Initialized</h6>
                        Work paper has been successfully initiated
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('exist')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Duplicate Detected</h6>
                        Work paper is already exist
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
            <?php if (session()->get('senttorev')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Work paper sent.</h6>
                        Work paper has been successfully sent back to reviewer
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('approved')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Work paper Approved.</h6>
                        Work paper has been Approved.
                    </div>
                </div>
            <?php  }?>
        <div class="card">
            <div class="card-body">
            <?php if(session()->get('allowed')->add == "Yes"){?>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#adduser">Add Work Paper</button>
            <?php  }?>
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
                                $p = round($y / $x, 2) * 70;
                            }
                            $pcnt = 0;
                            switch ($r['status']) {
                                case 'Preparing': $pcnt = 0; break;
                                case 'Reviewing': $pcnt = 10; break;
                                case 'Checking' : $pcnt = 20; break;
                                case 'Approved' : $pcnt = 30; break;
                            }
                        ?>
                        <tr>
                            <td><?= $r['cli'].' - '.$r['org']?></td>
                            <td><?= $r['financial_year']?></td>
                            <td><?= date('F-d', strtotime($r['financial_year'].'-'.$r['end_financial_year']))?></td>
                            <td>
                                <span class="badge bg-primary"><?= $r['aud']?></span><br>
                                <span class="badge bg-secondary"><?= $r['sup']?></span><br>
                                <span class="badge bg-success"><?= $r['audm']?></span>
                            </td>
                            <td>
                                <?php if($r['status'] == 'Preparing'){?>
                                    <span class="badge bg-danger"><?= $r['status']?></span>
                                <?php }elseif($r['status'] == 'Reviewing'){?>
                                    <span class="badge bg-primary"><?= $r['status']?></span>
                                <?php }elseif($r['status'] == 'Checking'){?>
                                    <span class="badge bg-secondary"><?= $r['status']?></span>
                                <?php }elseif($r['status'] == 'Approved'){?>
                                    <span class="badge bg-success"><?= $r['status']?></span>
                                <?php }?>
                            </td>
                            <td>
                                <div class="progress mt-1">
                                    <span class="progress-bar" style="width:<?= $p + $pcnt?>%"><?= $p + $pcnt?>%</span>
                                </div>
                            </td>
                            <td><?= date('F d, Y h:i A', strtotime($r['added_on']))?></td>
                            <td><?= $r['added']?></td>
                            <td>
                                <?php if($r['remarks'] != 'Not Submitted' and $r['remarks'] != ''){?>
                                    <button class="btn btn-danger btn-icon btn-sm rem" data-bs-toggle="modal" data-remarks="<?= $r['remarks']?>" data-bs-target="#remarks" title="View Remarks"><i class="fas fa-flag"></i></button>
                                <?php }?>
                                <a class="btn btn-secondary btn-icon btn-sm get-data" title="Set values" type="button" href="<?= base_url('auditsystem/wp/getfiles/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['client']))?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['wpID']))?>/<?= $r['cli'].' - '.$r['org']?>"><i class="fas fa-highlighter"></i></a>
                                <?php if($r['status'] == 'Checking'){?>
                                    <button class="btn btn-warning btn-icon btn-sm sendbacktoreviewer" type="button" data-file="<?= 'FY-'.$r['financial_year'].': '.$r['cli']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoreviewer/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['wpID']))?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send back to Auditor"><i class="fas fa-undo"></i></button>
                                    <button class="btn btn-success btn-icon btn-sm approved" type="button" data-file="<?= 'FY-'.$r['financial_year'].': '.$r['cli']?>" data-urlsubmit="<?= base_url('auditsystem/wp/approved/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['wpID']))?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Approve"><i class="fas fa-thumbs-up"></i></button>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<!-- Modal add-->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Initiate work paper information</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="" action="<?= base_url('auditsystem/wp/save')?>" method="post">
                <div class="row gx-3">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="small mb-1" for="client">Client / Organization:</label>
                            <select name="client" id="client" class="form-select" required>
                                <option value="" selected>Select Client</option>
                                <?php foreach($cl as $c){?>
                                    <option value="<?= $crypt->encrypt($c['cID']) ?>"><?= $c['name'].' - '.$c['org']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row gx-3">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="small mb-1" for="fy">Financial Year:</label>
                            <select name="fy" id="fy" class="form-select" required>
                                <option value="" >Financial Year</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024" selected>2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <option value="2031">2031</option>
                                <option value="2032">2032</option>
                                <option value="2033">2033</option>
                                <option value="2034">2034</option>
                                <option value="2035">2035</option>
                                <option value="2036">2036</option>
                                <option value="2037">2037</option>
                                <option value="2038">2038</option>
                                <option value="2039">2039</option>
                                <option value="2040">2040</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="small mb-1" for="efy">End of Financial Year:</label>
                            <select name="efy" id="efy" class="form-select" required>
                                <option value="" >End of Financial Year:</option>
                                <option value="01-31">January</option>
                                <option value="02-29">February</option>
                                <option value="03-31">March</option>
                                <option value="04-30">April</option>
                                <option value="05-31">May</option>
                                <option value="06-30">June</option>
                                <option value="07-31">July</option>
                                <option value="08-31">August</option>
                                <option value="09-30">September</option>
                                <option value="10-31">Otcober</option>
                                <option value="11-30">November</option>
                                <option value="12-31" selected>December</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="row gx-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="small mb-1" for="jobdur">Job Duration</label>
                            <div class="input-group input-group-joined" style="width: 16.5rem">
                                <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                                <input name="jobdur" class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gx-3">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="small mb-1" for="auditor">Assign Auditor:</label>
                            <select name="auditor" id="auditor" class="form-select" required>
                                <option value="" selected>Select Auditor</option>
                                <?php foreach($aud as $a){?>
                                    <option value="<?= $crypt->encrypt($a['userID'])?>"><?= $a['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="small mb-1" for="reviewer">Assign Reviewer:</label>
                            <select name="reviewer" id="reviewer" class="form-select" required>
                                <option value="" selected>Select Reviewer</option>
                                <?php foreach($sup as $s){?>
                                    <option value="<?= $crypt->encrypt($s['userID'])?>"><?= $s['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="small mb-1" for="audmanager">Assign Audit Manager:</label>
                            <select name="audmanager" id="audmanager" class="form-select" required>
                                <option value="" selected>Select Reviewer</option>
                                <?php foreach($mgr as $m){?>
                                    <option value="<?= $crypt->encrypt($m['userID'])?>"><?= $m['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Review-->

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
    $('.sendbacktoreviewer').on('click', function () {
        var file = $(this).data('file');
        var urlsubmit = $(this).data('urlsubmit');
        $('#toconfirm').html(`<h6>Are you sure to send back this file <b>`+ file +`</b> to Reviewer for correction?</h6><textarea name="remarks" class="lh-base form-control" type="text" placeholder="Remarks/Comment" rows="4"></textarea>`);
        $('#toconfirm').attr('action',urlsubmit);
    }); 

    $('.approved').on('click', function () {
        var file = $(this).data('file');
        var urlsubmit = $(this).data('urlsubmit');
        $('#toconfirm').html(`<h6>Please confirm that this file <b>`+ file +`</b> has been reviewed and all data are correct and mark it as approved?</h6><textarea name="remarks" class="lh-base form-control" type="text" placeholder="Remarks/Comment" rows="4"></textarea>`);
        $('#toconfirm').attr('action',urlsubmit);
    }); 

    $('.rem').on('click', function () {
        var remarks = $(this).data('remarks');
        $('#rem').html(remarks);
    });  
});
</script>
