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
                                        <th></th>
                                        <th>Section</th>
                                        <th>Desc</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($fi as $r){?>
                                        <tr>
                                            <td><input class="form-check-input" id="add" type="checkbox" name="c1[]" value="<?= $crypt->encrypt($r['fiID'])?>"/></td>
                                            <td><?= $r['section']?></td>
                                            <td><?= $r['desc']?></td>
                                            <td></td>
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



                        <input type="file" id="excelInput" accept=".xlsx, .xls">

                        <table class="table table-hover table-sm">
                            <thead id="tbhead">
                                <tr>
                                    <th>Account Code</th>
                                    <th>Account</th>
                                    <th>Account Type</th>
                                    <th>Debit-Year to date</th>
                                    <th>Credit-Year to date</th>
                                    <th>Index</th>
                                </tr>
                            </thead>
                            <tbody id="tbbody">

                            </tbody>
                        </table>

                        <br><br>
                        
                        <h3>Import Trial Balance</h3>
                        <div class="col-3">
                            <input type="file" name="" id="" class="form form-control">
                        </div>
                        
                        
                            <button type="button" class="btn btn-primary">Import</button>
                        
                        
                             
                       
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

        $('#excelInput').change(function(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var data = new Uint8Array(reader.result);
                var workbook = XLSX.read(data, { type: 'array' });

                // Assume the first sheet is the one we want to display
                var sheetName = workbook.SheetNames[0];
                var sheet = workbook.Sheets[sheetName];

                // Convert the sheet data to JSON
                var jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

                //console.log(sheet);

                // Clear existing table data
                //$('#tbhead').empty();

                // Add table headers
                // var headerRow = '<tr>';
                //     jsonData[0].forEach(function(cell) {
                //     headerRow += '<th>' + cell + '</th>';
                // });
                // headerRow += '<th>Index</th>';
                // headerRow += '</tr>';

                // $('#tbhead').append(headerRow);

                //Add table rows
                for (var i = 1; i < jsonData.length; i++) {
                    var row = '<tr>';
                    jsonData[i].forEach(function(cell) {
                        row += '<td><input type="text" class="form form-control form-control-sm" value="' + cell + '"></td>';
                    });
                    row += `
                    <td>
                        <select name="" id="" class="form form-select" required>
                            <option value="" selected>Select Index</option>
                        <?php foreach($fi as $r){?>
                            <option value="<?= $crypt->encrypt($r['fiID'])?>" ><?= $r['section'].' - '.$r['desc']?></option>
                        <?php }?>
                        </select>
                    </td>
                    `;
                    row += '</tr>';
                    $('#tbbody').append(row);
                }
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
            $('#rem').html(remarks);
        });  
    });
    </script>
