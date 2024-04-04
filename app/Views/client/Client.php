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
            <?php if (session()->get('invalid_input')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Invalid Input</h6>
                        Something wrong with your data inputd, please try again.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('exist')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Data already Exist</h6>
                        Client already exist.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('added')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Registration</h6>
                        Client has been successfully registered
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('updated')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Update Success</h6>
                        Client has been successfully updated
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">

            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addclient">Add Client</button>
            
            <table class="table table-hover" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>Firm</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
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
                                <button class="btn btn-primary btn-icon btn-sm get-data" title="Edit" type="button" data-bs-toggle="modal" data-bs-target="#edit"  data-name="<?= $r['name']?>" data-cid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>"><i class="fas fa-edit"></i></button>
                                <?php if($r['status'] == 'Active'){?>
                                    <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-name="<?= $r['name']?>" data-cid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>" data-status="<?= $r['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                <?php }else{?>
                                    <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-name="<?= $r['name']?>" data-cid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>" data-status="<?= $r['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Register a Client</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="" action="<?= base_url('auditsystem/client/save')?>" method="post">

                    <div class="mb-3">
                        <label class="small mb-1" for="name">Name:</label>
                        <input class="form-control" id="name" type="text" name="name" placeholder="Enter Name" />
                    </div>
                    <!-- Form Group (email address)            -->
                    <div class="mb-3">
                        <label class="small mb-1" for="org">Organization</label>
                        <input class="form-control" id="org" type="text" name="org" placeholder="Enter Organization" />
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email" />
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Register a Client</h5>
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




<script>
$(document).ready(function () {

    $(".active-data").on("click", function() {
        var name = $(this).data('name');
        var status = $(this).data('status');
        var cid = $(this).data('cid');
        $('#myactiveform').attr('action', "<?= base_url('auditsystem/client/acin/')?>" + cid);
        if (status == 'Active') {
            $('.msgconfirm').html(`<h3>Are you sure to Disable this `+name+` client?</h3>`);
        }else{
            $('.msgconfirm').html(`<h3>Are you sure to Enable this `+name+` client?</h3>`);
        }
    });

    $(".get-data").on("click", function() {
        var name = $(this).data('name');
        var cid = $(this).data('cid');
        $('#editform').attr('action', "<?= base_url('auditsystem/client/update/')?>" + cid);

        $("#editform").html(`
        <div class="container mt-3">
            <p>Loading...</p>
            <div class="spinner-grow text-muted"></div>
            <div class="spinner-grow text-primary"></div>
            <div class="spinner-grow text-success"></div>
            <div class="spinner-grow text-info"></div>
            <div class="spinner-grow text-warning"></div>
            <div class="spinner-grow text-danger"></div>
            <div class="spinner-grow text-secondary"></div>
            <div class="spinner-grow text-dark"></div>
            <div class="spinner-grow text-light"></div>
        </div>`);
        $.ajax({
            url: "<?= base_url('auditsystem/client/edit/')?>" + cid,  // Replace with your actual data endpoint URL
            method: "GET",
            dataType: 'json',
            success: function(data) {

                $("#editform").html(`
                <div class="mb-3">
                        <label class="small mb-1" for="name">Name:</label>
                        <input class="form-control name" id="name" type="text" name="name" placeholder="Enter Name" />
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="org">Organization</label>
                    <input class="form-control org" id="org" type="text" name="org" placeholder="Enter Organization" />
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="email">Email</label>
                    <input class="form-control email" id="email" type="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email" />
                </div>`);
                $('.name').attr('value', data.name);
                $('.org').attr('value', data.org);
                $('.email').attr('value', data.email);

            },
            error: function() {
                // Handle error if the data fetch fails
                $(".tbitem").html("Error loading data");
            }

        });



    });

});
</script>
