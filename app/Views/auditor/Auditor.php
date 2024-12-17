
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
                        <div class="page-header-subtitle">You can manage your auditors here</div>
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
            <?php if(session()->get('allowed')->add == "Yes"){?>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addauditor">Add Auditor</button>
            <?php  }?>
                <table class="table table-hover" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Firm</th>
                            <th>Position</th>
                            <th>Type</th>
                            <th>Verified</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($aud as $r){?>
                            <tr>
                                <td><?= $r['name']?></td>
                                <td><?= $r['email']?></td>
                                <td><?= $r['firm']?></td>
                                <td><?= $r['position']?></td>
                                <td><?= $r['type']?></td>
                                <td><?php if($r['verified'] == 'Yes'){echo '<span class="badge bg-success">'.$r['verified'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['verified'].'</span>';}?></td>
                                <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                <td>
                                    <?php if(session()->get('allowed')->edit == "Yes"){?>
                                        <button class="btn btn-primary btn-icon btn-sm get-data" title="Edit" type="button" data-bs-toggle="modal" data-bs-target="#edit"  data-name="<?= $r['name']?>" data-uid="<?= encr($r['userID'])?>"><i class="fas fa-edit"></i></button>
                                    <?php }?>
                                    <?php if(session()->get('allowed')->acin == "Yes"){?>
                                        <?php if($r['status'] == 'Active'){?>
                                            <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-name="<?= $r['name']?>" data-uid="<?= encr($r['userID'])?>" data-status="<?= $r['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                        <?php }else{?>
                                            <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-name="<?= $r['name']?>" data-uid="<?= encr($r['userID'])?>" data-status="<?= $r['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
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
<!-- Modal add-->
<div class="modal fade" id="addauditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Register a Auditor</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="" action="<?= base_url('auditsystem/auditor/save')?>" method="post" enctype="multipart/form-data">
                    <div class="row gx-3">
                        <div class="col-md-12">

                            <div class="mb-3">
                                <label class="small mb-1" for="name">Name:</label>
                                <input class="form-control" id="name" type="text" placeholder="Enter full name" name="name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="address">Address:</label>
                                <input class="form-control" id="address" type="text"  placeholder="Enter Address" name="address" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="contact">Contact No.:</label>
                                <input class="form-control" id="contact" type="number"  placeholder="Enter Contact" name="contact" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email:</label>
                                <input class="form-control" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" required/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="type">Role:</label>
                                <select name="type" id="type" class="form-control form-select" required>
                                    <option value="" selected>Select Role</option>
                                    <option value="Preparer">Preparer</option>
                                    <option value="Reviewer">Reviewer</option>
                                    <option value="Audit Manager">Audit Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="type">Signature</label>
                                <div class="small font-italic text-muted mb-4">The file must be PNG, no larger than 5 MB and 2x2 or square size image</div>
                                <!-- Profile picture upload button-->
                                <input type="file" id="imageInput" name="signature" accept=".png" class="form-control btn btn-primary">
                            </div>
                            <div id="errorContainer" style="display: none;"></div>
                        </div>             
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit a Auditor</h5>
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
    $('#imageInput').change(function() {
        var maxSizeInBytes = 5 * 1024 * 1024; // 5MB
        var fileSize = this.files[0].size;
        var fileType = this.files[0].type;
        if (fileType !== 'image/png') {
            $('#errorContainer').html(`
            <div class="alert alert-danger alert-icon" role="alert">
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-icon-content">
                    <h6 class="alert-heading">Image not PNG</h6>
                    Please select a PNG image
                </div>
            </div>`).show();
            $(this).val('');
            return; // Exit the function if file type is not PNG
        }
        if (fileSize > maxSizeInBytes) {
            $('#errorContainer').html(`
            <div class="alert alert-danger alert-icon" role="alert">
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-icon-content">
                    <h6 class="alert-heading">Image too Large</h6>
                    File size exceeds the maximum limit (5MB)
                </div>
            </div>`).show();
            $(this).val('');
            return; // Exit the function if file size exceeds the limit
        }
        $('#errorContainer').hide();
    });
    $(".active-data").on("click", function() {
        var name = $(this).data('name');
        var status = $(this).data('status');
        var uid = $(this).data('uid');
        $('#myactiveform').attr('action', "<?= base_url('auditsystem/auditor/acin/')?>" + uid);
        if (status == 'Active') {
            $('.msgconfirm').html(`<h3>Are you sure to Disable this auditor `+name+`?</h3>`);
        }else{
            $('.msgconfirm').html(`<h3>Are you sure to Enable this auditor `+name+`?</h3>`);
        }
    });
    $(".get-data").on("click", function() {
        var name = $(this).data('name');
        var uid = $(this).data('uid');
        $('#editform').attr('action', "<?= base_url('auditsystem/auditor/update/')?>" + uid);
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
            url: "<?= base_url('auditsystem/auditor/edit/')?>" + uid,  // Replace with your actual data endpoint URL
            method: "GET",
            dataType: 'json',
            success: function(data) {
                $("#editform").html(`
                <div class="row gx-3">
                    <div class="col-md-12">
                        <!-- Form Group (first name)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="name">Name:</label>
                            <input class="form-control name" id="name" type="text" placeholder="Enter full name" name="name" required/>
                        </div>
                    </div>
                </div>
                <div class="row gx-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="small mb-1" for="address">Address:</label>
                            <input class="form-control address" id="address" type="text"  placeholder="Enter Address" name="address" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="small mb-1" for="contact">Contact No.:</label>
                            <input class="form-control contact" id="contact" type="number"  placeholder="Enter Contact" name="contact" required/>
                        </div>
                    </div>
                </div>
                <div class="row gx-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control email" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="small mb-1" for="type">Type</label>
                            <select name="type" id="type" class="form-control form-select" required>
                                <option value="`+ data.type +`" selected>`+ data.type +`</option>
                                <option value="Preparer">Preparer</option>
                                <option value="Reviewer">Reviewer</option>
                                <option value="Audit Manager">Audit Manager</option>
                            </select>
                        </div>
                    </div>
                </div>`);
                $('.name').attr('value', data.name);
                $('.email').attr('value', data.email);
                $('.address').attr('value', data.address);
                $('.contact').attr('value', data.contact);
            },
            error: function() {
                // Handle error if the data fetch fails
                $(".tbitem").html("Error loading data");
            }
        });
    });
});
</script>


