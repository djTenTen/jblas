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
                <?php if(session()->get('allowed')->add == "Yes"){?>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addclient">Add Client</button>
                <?php  }?>
                <table class="table table-hover" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Organization</th>
                            <th>Org. Type</th>
                            <th>Industry</th>
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
                                <td><?= $r['orgtype']?></td>
                                <td><?= $r['industry']?></td>
                                <td><?= $r['email']?></td>
                                <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>                            
                                <td>
                                    <?php if(session()->get('allowed')->edit == "Yes"){?>
                                        <button class="btn btn-primary btn-icon btn-sm get-data" title="Edit" type="button" data-bs-toggle="modal" data-bs-target="#edit"  data-name="<?= $r['name']?>" data-cid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>"><i class="fas fa-edit"></i></button>
                                    <?php }?>
                                    <?php if(session()->get('allowed')->acin == "Yes"){?>
                                        <?php if($r['status'] == 'Active'){?>
                                            <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-name="<?= $r['name']?>" data-cid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>" data-status="<?= $r['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                        <?php }else{?>
                                            <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-name="<?= $r['name']?>" data-cid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>" data-status="<?= $r['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
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
                        <input class="form-control" id="name" type="text" name="name" placeholder="Enter Name" required/>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="org">Organization</label>
                        <input class="form-control" id="org" type="text" name="org" placeholder="Enter Organization" required/>
                    </div>
                    <div class="row gx-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="contact">Contact Number:</label>
                                <input class="form-control" id="contact" type="text" name="contact" placeholder="Enter Contact Number" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control" id="email" type="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email" required/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="address">Address:</label>
                        <input class="form-control" id="address" type="text" name="address" placeholder="Enter Address" required/>
                    </div>
                    <div class="row gx-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="industry">Industry:</label>
                                <select name="industry" id="industry" class="form-control form-select" required>
                                    <option value="" selected>Select Industry</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Accounting">Accounting</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                    <option value="Hospitality and Tourism">Hospitality and Tourism</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Energy">Energy</option>
                                    <option value="Transportation and Logistics">Transportation and Logistics</option>
                                    <option value="Media and Entertainment">Media and Entertainment</option>
                                    <option value="Food and Beverage">Food and Beverage</option>
                                    <option value="Automotive">Automotive</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Telecommunications">Telecommunications</option>
                                    <option value="Pharmaceuticals">Pharmaceuticals</option>
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Biotechnology">Biotechnology</option>
                                    <option value="Education">Education</option>
                                    <option value="Professional Services">Professional Services</option>
                                    <option value="Environmental Services">Environmental Services</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="orgtype">Organization Type:</label>
                                <select name="orgtype" id="orgtype" class="form-control form-select" required>
                                    <option value="" selected>Select Type</option>
                                    <option value="Company">Company</option>
                                    <option value="Partnership">Partnership</option>
                                    <option value="Sole Proprietorship">Sole Proprietorship</option>
                                </select>
                            </div>
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
                    <input class="form-control" id="name" type="text" name="name" placeholder="Enter Name" value="`+ data.name +`" required/>
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="org">Organization</label>
                    <input class="form-control" id="org" type="text" name="org" placeholder="Enter Organization" value="`+ data.org +`" required/>
                </div>
                <div class="row gx-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="small mb-1" for="contact">Contact Number:</label>
                            <input class="form-control" id="contact" type="text" name="contact" placeholder="Enter Contact Number" value="`+ data.contact +`" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email" value="`+ data.email +`" required/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="address">Address:</label>
                    <input class="form-control" id="address" type="text" name="address" placeholder="Enter Address" value="`+ data.address +`" required/>
                </div>
                <div class="row gx-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="small mb-1" for="industry">Industry:</label>
                            <select name="industry" id="industry" class="form-control form-select" required>
                                <option value="`+ data.industry +`" selected>`+ data.industry +`</option>
                                <option value="Technology">Technology</option>
                                <option value="Finance">Finance</option>
                                <option value="Accounting">Accounting</option>
                                <option value="Retail">Retail</option>
                                <option value="Manufacturing">Manufacturing</option>
                                <option value="Hospitality and Tourism">Hospitality and Tourism</option>
                                <option value="Real Estate">Real Estate</option>
                                <option value="Energy">Energy</option>
                                <option value="Transportation and Logistics">Transportation and Logistics</option>
                                <option value="Media and Entertainment">Media and Entertainment</option>
                                <option value="Food and Beverage">Food and Beverage</option>
                                <option value="Automotive">Automotive</option>
                                <option value="Construction">Construction</option>
                                <option value="Telecommunications">Telecommunications</option>
                                <option value="Pharmaceuticals">Pharmaceuticals</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Biotechnology">Biotechnology</option>
                                <option value="Education">Education</option>
                                <option value="Professional Services">Professional Services</option>
                                <option value="Environmental Services">Environmental Services</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="small mb-1" for="orgtype">Organization Type:</label>
                            <select name="orgtype" id="orgtype" class="form-control form-select" required>
                                <option value="`+ data.orgtype +`" selected>`+ data.orgtype +`</option>
                                <option value="Company">Company</option>
                                <option value="Partnership">Partnership</option>
                                <option value="Sole Proprietorship">Sole Proprietorship</option>
                            </select>
                        </div>
                    </div>
                </div>`);

            },
            error: function() {
                // Handle error if the data fetch fails
                $(".tbitem").html("Error loading data");
            }

        });



    });

});
</script>
