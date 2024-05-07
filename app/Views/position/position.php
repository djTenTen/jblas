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
                        <div class="page-header-subtitle">Position</div>
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
            <?php if (session()->get('added')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Position Added</h6>
                        Position has been successfully added
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('updated')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Position Updated</h6>
                        Position has been successfully updated
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
            <div class="card-body">
            <div class="row">
                <div class="col-xl-5">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Positions</div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pos as $r){?>
                                        <tr>
                                            <td><?= $r['position']?></td>
                                            <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                            <td>
                                                <button class="btn btn-primary btn-icon btn-sm verify-data" title="Verify" type="button" data-bs-toggle="modal" data-bs-target="#verify"  data-pos="<?= $r['position']?>" data-usid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['posID']))?>"><i class="fas fa-edit"></i></button>
                                                <?php if($r['status'] == 'Active'){?>
                                                    <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-usid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['posID']))?>" data-status="<?= $r['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                                <?php }else{?>
                                                    <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-usid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['posID']))?>" data-status="<?= $r['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Position Details</div>
                        <div class="card-body">
                            <form action="<?= base_url('auditsystem/position/save')?>" method="post">
                                
                                <div class="mb-3">
                                    <label class="small mb-1" for="pos">Position Name</label>
                                    <input class="form-control" id="pos" type="text" placeholder="Enter position name" name="pos" required/>
                                </div>
                                <label class="small mb-1" >Select allowed managements for the position.</label>
                                <div class="row">
                                    <h6>Rules:</h6>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="add" type="checkbox" name="add" value="Yes"/>
                                                <label class="form-check-label" for="add">Add</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="edit" type="checkbox" name="edit" value="Yes"/>
                                                <label class="form-check-label" for="edit">Edit</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="acin" type="checkbox" name="acin" value="Yes" />
                                                <label class="form-check-label" for="acin">Inactive / Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <h6>Departments:</h6>
                                    <div class="form-check mb-2 col-4">
                                        <input class="form-check-input" id="clm" type="checkbox" name="clm" value="Yes"/>
                                        <label class="form-check-label" for="clm">Client Management</label>
                                        <div class="col-12">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="cl" type="checkbox" name="cl" value="Yes"/>
                                                <label class="form-check-label" for="cl">Client</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="sd" type="checkbox" name="sd" value="Yes"/>
                                                <label class="form-check-label" for="sd">Set Defaults</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check mb-2 col-4">
                                        <input class="form-check-input" id="audm" type="checkbox" name="audm" value="Yes"/>
                                        <label class="form-check-label" for="audm">Auditor Management</label>
                                        <div class="col-12">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="aud" type="checkbox" name="aud" value="Yes"/>
                                                <label class="form-check-label" for="aud">Auditor</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check mb-2 col-4">
                                        <input class="form-check-input" id="workp" type="checkbox" name="workp" value="Yes"/>
                                        <label class="form-check-label" for="workp">Work Paper</label>
                                        <div class="col-12">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="preparer" type="checkbox" name="preparer" value="Yes"/>
                                                <label class="form-check-label" for="preparer">Preparer</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="reviewer" type="checkbox" name="reviewer" value="Yes"/>
                                                <label class="form-check-label" for="reviewer">Reviewer</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="audmanager" type="checkbox" name="audmanager" value="Yes"/>
                                                <label class="form-check-label" for="audmanager">Audit Manager</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check mb-2 col-4">
                                        <input class="form-check-input" id="frm" type="checkbox" name="frm" value="Yes"/>
                                        <label class="form-check-label" for="frm">Firms Management</label>
                                    </div>
                                    <div class="form-check mb-2 col-4">
                                        <input class="form-check-input" id="sett" type="checkbox" name="sett" value="Yes"/>
                                        <label class="form-check-label" for="sett">Settings</label>
                                        <div class="col-12">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="user" type="checkbox" name="user" value="Yes"/>
                                                <label class="form-check-label" for="user">User Management</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="position" type="checkbox" name="position" value="Yes"/>
                                                <label class="form-check-label" for="position">Position Management</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="hat" type="checkbox" name="hat" value="Yes"/>
                                                <label class="form-check-label" for="hat">HAT Management</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check mb-2 col-4">
                                        <input class="form-check-input" id="dash" type="checkbox" name="dash" value="Yes"/>
                                        <label class="form-check-label" for="dash">Dashboard</label>
                                    </div>
                                </div>
                                <button class="btn btn-success float-end" type="submit">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal Logout-->
<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="vform" action="" method="post">
                    <div class="mb-3">
                        <label class="small mb-1" for="pos">Position Name</label>
                        <input class="form-control pos" id="pos" type="text" placeholder="Enter position name" name="pos" required/>
                    </div>
                        <label class="small mb-1" >Select allowed managements for the position.</label>
                        <div class="row">
                            <h6>Rules:</h6>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input add" id="add" type="checkbox" name="add" value="Yes"/>
                                        <label class="form-check-label" for="add">Add</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input edit" id="edit" type="checkbox" name="edit" value="Yes"/>
                                        <label class="form-check-label" for="edit">Edit</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input acin" id="acin" type="checkbox" name="acin" value="Yes" />
                                        <label class="form-check-label" for="acin">Inactive / Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h6>Departments:</h6>
                            <div class="form-check mb-2 col-4">
                                <input class="form-check-input clm" id="clm" type="checkbox" name="clm" value="Yes"/>
                                <label class="form-check-label" for="clm">Client Management</label>
                                <div class="col-12">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input cl" id="cl" type="checkbox" name="cl" value="Yes"/>
                                        <label class="form-check-label" for="cl">Client</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input sd" id="sd" type="checkbox" name="sd" value="Yes"/>
                                        <label class="form-check-label" for="sd">Set Defaults</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check mb-2 col-4">
                                <input class="form-check-input audm" id="audm" type="checkbox" name="audm" value="Yes"/>
                                <label class="form-check-label" for="audm">Auditor Management</label>
                                <div class="col-12">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input aud" id="aud" type="checkbox" name="aud" value="Yes"/>
                                        <label class="form-check-label" for="aud">Auditor</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check mb-2 col-4">
                                <input class="form-check-input workp" id="workp" type="checkbox" name="workp" value="Yes"/>
                                <label class="form-check-label" for="workp">Work Paper</label>
                                <div class="col-12">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input preparer" id="preparer" type="checkbox" name="preparer" value="Yes"/>
                                        <label class="form-check-label" for="preparer">Preparer</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input reviewer" id="reviewer" type="checkbox" name="reviewer" value="Yes"/>
                                        <label class="form-check-label" for="reviewer">Reviewer</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input audmanager" id="audmanager" type="checkbox" name="audmanager" value="Yes"/>
                                        <label class="form-check-label" for="audmanager">Audit Manager</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check mb-2 col-4">
                                <input class="form-check-input frm" id="frm" type="checkbox" name="frm" value="Yes"/>
                                <label class="form-check-label" for="frm">Firms Management</label>
                            </div>
                            <div class="form-check mb-2 col-4">
                                <input class="form-check-input sett" id="sett" type="checkbox" name="sett" value="Yes"/>
                                <label class="form-check-label" for="sett">Settings</label>
                                <div class="col-12">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input user" id="user" type="checkbox" name="user" value="Yes"/>
                                        <label class="form-check-label" for="user">User Management</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input position" id="position" type="checkbox" name="position" value="Yes"/>
                                        <label class="form-check-label" for="position">Position Management</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input hat" id="hat" type="checkbox" name="hat" value="Yes"/>
                                        <label class="form-check-label" for="hat">HAT Management</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check mb-2 col-4">
                                <input class="form-check-input dash" id="dash" type="checkbox" name="dash" value="Yes"/>
                                <label class="form-check-label" for="dash">Dashboard</label>
                            </div>
                        </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $(".active-data").on("click", function() {
        var status = $(this).data('status');
        var usid = $(this).data('usid');
        $('#myactiveform').attr('action', "<?= base_url('auditsystem/position/acin/')?>" + usid);
        if (status == 'Active') {
            $('.msgconfirm').html(`<h3>Are you sure to Disable this Position?</h3>`);
        }else{
            $('.msgconfirm').html(`<h3>Are you sure to Enable this Position?</h3>`);
        }
    });
    $(".verify-data").on("click", function() {
        var pos = $(this).data('pos');
        var usid = $(this).data('usid');
        $('#vform').attr('action', "<?= base_url('auditsystem/position/update/')?>" + usid);
        $('.pos').attr('value', pos);
        $.ajax({
            url: "<?= base_url('auditsystem/position/edit/')?>" + usid,  // Replace with your actual data endpoint URL
            method: "GET",
            dataType: 'json',
            success: function(data) {
                // get the json encoded from database and parse it 
                var ad = JSON.parse(data.allowed);
                $.each(ad, function(i, a) {
                    // populate the checkboxes
                    if(a == "Yes"){
                        $('.'+ i).prop('checked', true);
                    }else{
                        $('.'+ i).prop('checked', false);
                    }
                });
                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".tbitem").html("Error loading data");
                }
        });
    });
});
</script>

