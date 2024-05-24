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
                        <div class="page-header-subtitle">Set files for your clients</div>
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
            <?php if (session()->get('excel_upload')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Data Uploaded</h6>
                        The Trial Balance data has been successfully uploaded
                    </div>
                </div>
            <?php  }?>

            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row" id="cardTab" role="tablist">
                    <!-- Wizard navigation item 1-->
                    <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Workpaper</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-bs-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Chapter 1</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link" id="wizard3-tab" href="#wizard3" data-bs-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Chapter 2</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 4-->
                    <a class="nav-item nav-link" id="wizard4-tab" href="#wizard4" data-bs-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Chapter 3</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard5-tab" href="#wizard5" data-bs-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Import Trial Balance</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">

                <div class="tab-content" id="cardTabContent">
                    <!-- Wizard tab pane item 1-->
                    <div class="tab-pane py-5 fade show active" id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                        <div class="row justify-content-center">
                            <h3>Workpaper</h3>
                            <table class="table table-hover table-sm" >
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="text-center"></th>
                                        <th style="width: 10%;" class="text-center">Section</th>
                                        <th style="width: 45%;">Desc</th>
                                        <th style="width: 15%;" class="text-center">Status</th>
                                        <th style="width: 25%;" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    <?php foreach($fi as $r){?>
                                        <tr>
                                            <td class="text-center"><input class="form-check-input ficheck" id="add" type="checkbox" name="c1[]" value="<?= $crypt->encrypt($r['cfiID'])?>" data-url="<?= base_url()?>auditsystem/wp/updateindex/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cfiID']))?>" <?php if($r['acquired'] == 'Yes'){echo 'checked';} ?>/></td>
                                            <td class="text-center"><?= $r['section']?></td>
                                            <td><?= $r['desc']?></td>
                                            <td class="text-center">
                                                <?php if($r['status'] == 'Preparing'){?>
                                                    <span class="badge bg-primary"><?= $r['status']?></span>
                                                <?php }elseif($r['status'] == 'Reviewing'){?>
                                                    <span class="badge bg-secondary"><?= $r['status']?></span>
                                                <?php }elseif($r['status'] == 'Checking'){?>
                                                    <span class="badge bg-warning"><?= $r['status']?></span>
                                                <?php }elseif($r['status'] == 'Approved'){?>
                                                    <span class="badge bg-success"><?= $r['status']?></span>
                                                <?php }?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($r['remarks'] != 'Not Submitted' and $r['remarks'] != ''){?>
                                                    <button class="btn btn-danger btn-icon btn-sm rem" data-bs-toggle="modal" data-remarks="<?= $r['remarks']?>" data-bs-target="#remarks" data-pdf="<?= base_url()?>uploads/pdf/<?= $r['file']?>" title="View Remarks"><i class="fas fa-flag"></i></button>
                                                <?php }?>
                                                <a href="<?= base_url()?>auditsystem/wp/index/setvalues/<?= $r['section']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cfiID']))?>/<?= $cID?>/<?= $wpID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['index']))?>/<?= $r['desc']?>" class="btn btn-icon btn-sm btn-primary cfi" target="_blank" title="Set Values" <?php if($r['acquired'] == 'No'){echo 'hidden';} ?> ><i class="fas fa-tools"></i></a>
                                                <?php if($type == 'Preparer'){?>
                                                    <button class="btn btn-success btn-icon btn-sm sendtoreviewer sendto" type="button" data-file="<?= $r['section'].'-'.$r['desc']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoreview/index/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cfiID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to Reviewer" <?php if($r['acquired'] == 'No'){echo 'hidden';} ?>><i class="fas fa-paper-plane"></i></button>
                                                <?php }elseif($type == 'Reviewer'){?>   
                                                    <button class="btn btn-warning btn-icon btn-sm sendtoauditor sendto" type="button" data-file="<?= $r['section'].'-'.$r['desc']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoauditor/index/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cfiID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send back to Auditor" <?php if($r['acquired'] == 'No'){echo 'hidden';} ?>><i class="fas fa-undo"></i></button>
                                                    <button class="btn btn-success btn-icon btn-sm sendtomanager sendto" type="button" data-file="<?= $r['section'].'-'.$r['desc']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtomanager/index/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cfiID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to Manager" <?php if($r['acquired'] == 'No'){echo 'hidden';} ?>><i class="fas fa-paper-plane"></i></button>
                                                <?php }elseif($type == 'Audit Manager'){?>   
                                                    <button class="btn btn-warning btn-icon btn-sm sendbacktoreviewer sendto" type="button" data-file="<?= $r['section'].'-'.$r['desc']?>" data-urlsubmit="<?= base_url('auditsystem/wp/sendtoreview/index/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cfiID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Send to back to Reviewer" <?php if($r['acquired'] == 'No'){echo 'hidden';} ?>><i class="fas fa-undo"></i></button>
                                                    <button class="btn btn-success btn-icon btn-sm approve sendto" type="button" data-file="<?= $r['section'].'-'.$r['desc']?>" data-urlsubmit="<?= base_url('auditsystem/wp/approve/index/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cfiID']))?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" data-bs-toggle="modal" data-bs-target="#tosend" title="Approve" <?php if($r['acquired'] == 'No'){echo 'hidden';} ?>><i class="fas fa-thumbs-up"></i></button>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Wizard tab pane item 2-->
                    <div class="tab-pane py-5 fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                        <div class="row justify-content-center">
                            <h3>HAT Chapter 1</h3>
                            <table class="table table-hover table-sm" >
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Title</th>
                                        <th>Progress</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td class="row justify-content-center">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Wizard tab pane item 3-->
                    <div class="tab-pane py-5 fade" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                        <div class="row justify-content-center">
                            <h3>HAT Chapter 2</h3>
                            <table class="table table-hover table-sm" >
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Title</th>
                                        <th>Progress</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td class="row justify-content-center">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Wizard tab pane item 4-->
                    <div class="tab-pane py-5 fade" id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                        <div class="row justify-content-center">
                        <h3>HAT Chapter 3</h3>
                            <table class="table table-hover table-sm" >
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Title</th>
                                        <th>Progress</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td class="row justify-content-center">
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

                    <div class="tab-pane py-5 fade" id="wizard5" role="tabpanel" aria-labelledby="wizard5-tab">

                        <?php if(!empty($cfi)){?>
                            <h5>Latest upload:</h5>
                            <p>Added on: <b><?= date('F d, Y h:i A', strtotime($cfi['added_on']))?></b></p>
                            <p>Uploaded by: <b><?= $cfi['name']?></b></p>
                            <br><br>
                        <?php }?>

                        
                        <div class="row">
                            <div class="col-3">
                                <h3>Import Trial Balance</h3>
                                <input type="file" name="" id="excelInput" accept=".xlsx, .xls" class="form form-control">
                            </div>
                            <div class="col-7">
                            <?php if(!empty($cfi)){?>
                                <div class="alert alert-warning alert-icon" role="alert">
                                    <div class="alert-icon-content">
                                        <b>Note:</b> If you imported a file again, it will overwrite your previous data, all old data will be erased.
                                    </div>
                                </div> 
                            <?php }?>
                            </div>
                        </div>
                        

                        <br>

                        <form action="<?= base_url()?>auditsystem/wp/importtb/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                            <table class="table table-hover table-bordered table-sm">
                                <thead id="tbhead">
                                    <tr>
                                        <th>Account Code</th>
                                        <th>Account</th>
                                        <th>Account Type</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Index</th>
                                    </tr>
                                </thead>
                                <tbody id="tbbody">
                                    <?php if(!empty($tb)){?>
                                        <?php 
                                            $d = 0;
                                            $c = 0;
                                            foreach($tb as $r){
                                                $d += $r['debit'];
                                                $c += $r['credit'];
                                        ?>
                                            <tr>
                                                <td><?= $r['account_code']?></td>
                                                <td><?= $r['account']?></td>
                                                <td><?= $r['account_type']?></td>
                                                <td><?= $r['debit']?></td>
                                                <td><?= $r['credit']?></td>
                                                <td><?= $r['desc']?></td>
                                            </tr>
                                        <?php }?>
                                        <tr>
                                            <td colspan="3" class="text-end"><b>Total</b></td>
                                            <td><b>₱ <?= number_format($d,2)?></b></td>
                                            <td><b>₱ <?= number_format($c,2)?></b></td>
                                            <td>
                                                <?php if(($d - $c) != 0){?>
                                                    <div class="alert alert-danger alert-icon" role="alert">
                                                        <div class="alert-icon-content">
                                                            <h6 class="alert-heading">Balance Out!</h6>
                                                            Please check your trial balance file.
                                                        </div>
                                                    </div>     
                                                <?php }?> 
                                            </td>
                                        </tr>
                                    <?php }else{?>
                                        <tr class="table-danger">
                                            <td colspan="7" class="text-center"><h3>No Data Yet</h3></td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>

                            <button type="submit"  id="imp" class="btn btn-primary float-end">Import</button>
                        </form>
                        
                    
                    </div>
                </div>
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
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Remarks</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="rem"></div>
                    <hr>
                    <object id="pdf" data="" type="application/pdf" frameborder="0" width="100%" height="1000"> </object>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <script>
    $(document).ready(function () {

        $('.ficheck').change(function(){

            if (this.checked) {
                //$(this).closest('tr').find('.cfi').show();
                $(this).closest('tr').find('.cfi').removeAttr('hidden');
                $(this).closest('tr').find('.sendto').removeAttr('hidden');
                
            } else {
                //$(this).closest('tr').find('.cfi').hide();
                $(this).closest('tr').find('.cfi').attr('hidden', 'hidden');
                $(this).closest('tr').find('.sendto').attr('hidden', 'hidden');
            }

            var url = $(this).data('url');
            var dataToSend = this.checked ? 'Yes' : 'No';
            
            $.ajax({
                url: url, 
                type: 'POST',
                data: { checked: dataToSend },
                success: function(response) {
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    
                }
            });
            
            
        });

        $('#excelInput').change(function(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                
                var tb = [];
                var data = new Uint8Array(reader.result);
                var workbook = XLSX.read(data, { type: 'array' });

                // Assume the first sheet is the one we want to display
                var sheetName = workbook.SheetNames[0];
                var sheet = workbook.Sheets[sheetName];

                // Convert the sheet data to JSON
                var jsonData = XLSX.utils.sheet_to_json(sheet, { header: 'A' });
                jsonData = jsonData.slice(1);
                    
                jsonData.forEach(function(cell) {
                    var rd = {
                        'account_code' : cell.A ,
                        'account' : cell.B, 
                        'account_type': cell.C,
                        'debit':cell.D,
                        'credit' : cell.E,
                    };
                    tb.push(rd);
                });


                var dup = function finduplicate(data){
                    var accountCodeCounts = {};
                    var duplicates = [];
                    data.forEach(function(item){
                        var code = item.account_code;
                        if (accountCodeCounts[code]) {
                            accountCodeCounts[code]++;
                        } else {
                            accountCodeCounts[code] = 1;
                        }
                    });
                    for(var code in accountCodeCounts){
                        if (accountCodeCounts[code] > 1) {
                            duplicates.push(code);
                        }
                    }
                    return duplicates;
                }

                var row = '';
                let debit = 0;
                let credit = 0;
                tb.forEach(function(r){
                    debit += parseFloat(r.debit);
                    credit += parseFloat(r.credit);
                    row += `
                        <tr>
                            <td><input type="text" class="form form-control" name="account_code[]" value="`+r.account_code+`" readonly></td>
                            <td><input type="text" class="form form-control" name="account[]" value="`+r.account+`" readonly></td>
                            <td><input type="text" class="form form-control" name="account_type[]" value="`+r.account_type+`" readonly></td>
                            <td><input type="number" class="form form-control" name="debit[]" value="`+r.debit+`" readonly></td>
                            <td><input type="number" class="form form-control" name="credit[]" value="`+r.credit+`" readonly></td>
                            <td>
                                <select name="fileindex[]" id="" class="form form-select" required>
                                    <option value="" selected>Select Index</option>
                                <?php foreach($fi as $r){?>
                                    <option value="<?= $crypt->encrypt($r['fiID'])?>" ><?= $r['section'].' - '.$r['desc']?></option>
                                <?php }?>
                                </select>
                            </td>
                        </tr>
                    `;
                });

                var msg = '';
                if((debit - credit) != 0) {
                    msg += `
                        <div class="alert alert-danger alert-icon" role="alert">
                            <div class="alert-icon-content">
                                <h6 class="alert-heading">Balance Out!</h6>
                                Please check your trial balance file.
                            </div>
                        </div>     
                    `;
                    $('#imp').hide();
                }
                
                if(dup(tb).length > 0){
                    msg += `
                        <div class="alert alert-danger alert-icon" role="alert">
                            <div class="alert-icon-content">
                                <h6 class="alert-heading">Duplicate Detected</h6>
                                Duplicate data found on the Acount_code (`+dup(tb)+`)
                            </div>
                        </div>     
                    `;
                    $('#imp').hide();
                }
                row += `
                    <tr>
                        <td colspan="3" class="text-end"><b>Total</b></td>
                        <td><b>₱ `+debit.toLocaleString('en-PH')+`</b></td>
                        <td><b>₱ `+credit.toLocaleString('en-PH')+`</b></td>
                        <td>`+msg+`</td>
                    </tr>
                `;

                $('#tbbody').append(row);

            };

            reader.readAsArrayBuffer(input.files[0]);

        });


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
            var pdf = $(this).data('pdf');
            $('#rem').html(`<h1>`+remarks+`</h1>`);
            $('#pdf').attr('data', pdf);
        });  
    });
    </script>
