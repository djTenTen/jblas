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
                        <div class="page-header-subtitle">You can manage your cliets here</div>
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
            <?php if (session()->get('success')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success!</h6>
                        <?= session()->get('success')?>
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Error!</h6>
                        <?= session()->get('failed')?>
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
                <?php if(session()->get('allowed')->add == "Yes"){?>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addclient">Add Cluster</button>
                <?php  }?>
                <table class="table table-hover" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Cluster</th>
                            <th>Added_on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cl as $r){?>
                            <tr>
                                <td><?= $r['cluster']?></td>
                                <td><?= date('F d, Y', strtotime($r['added_on']))?></td>
                                <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <a class="btn btn-primary btn-icon btn-sm get-data" title="Set files" type="button" href="<?= base_url('auditsystem/cluster/files/')?><?= encr($r['clusterID'])?>/<?= $r['cluster']?>"><i class="fas fa-stream"></i></a>
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



<!-- Modal add-->
<div class="modal fade" id="addclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Register a Cluster</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="" action="<?= base_url('auditsystem/cluster/save')?>" method="post">
                    <div class="mb-3">
                        <label class="small mb-1" for="cname">Cluster Name:</label>
                        <input class="form-control" type="text" name="cname" placeholder="Enter Cluster Name" required/>
                    </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal edit-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit a Client</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editform" action="" method="post">

            </div>
            <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

