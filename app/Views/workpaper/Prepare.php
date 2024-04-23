<?php  
    $crypt = \Config\Services::encrypter();
    use \App\Models\WorkpaperModel;
    $wpmodel = new WorkpaperModel();
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
                        <div class="page-header-subtitle">Initiate you client working paper here.</div>
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
                        $percent = $wpmodel->getprogress($r['wpID'],$r['client']);
                        ?>
                        <tr>
                            <td><?= $r['cli']?></td>
                            <td><?= $r['financial_year']?></td>
                            <td><?= date('F-d', strtotime($r['financial_year'].'-'.$r['end_financial_year']))?></td>
                            <td>
                                <span class="badge bg-primary"><?= $r['aud']?></span><br>
                                <span class="badge bg-secondary"><?= $r['sup']?></span><br>
                                <span class="badge bg-success"><?= $r['audm']?></span>
                            </td>
                            <td>
                                <?php if($r['status'] == 'Preparing'){?>
                                    <span class="badge bg-primary"><?= $r['status']?></span>
                                <?php }elseif($r['status'] == 'Reviewing'){?>
                                    <span class="badge bg-secondary"><?= $r['status']?></span>
                                <?php }elseif($r['status'] == 'Approved'){?>
                                    <span class="badge bg-success"><?= $r['status']?></span>
                                <?php }?>
                            </td>
                            <td>
                                <div class="progress mt-1">
                                    <span class="progress-bar progress-bar-striped progress-bar-animated" style="width:<?= $percent?>%"><?= $percent?>%</span>
                                </div>
                            </td>
                            <td><?= date('F d, Y h:i A', strtotime($r['added_on']))?></td>
                            <td><?= $r['added']?></td>
                            <td>
                                <a class="btn btn-secondary btn-icon btn-sm get-data" title="Set values" type="button" href="<?= base_url('auditsystem/wp/getfiles/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['client']))?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['wpID']))?>/<?= $r['cli']?>"><i class="fas fa-highlighter"></i></a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>

        </div>
    </div>
</main>