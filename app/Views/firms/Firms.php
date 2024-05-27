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
                        <div class="page-header-subtitle">Firms</div>
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
            <?php if (session()->get('verified')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Verified</h6>
                        The User has been successfully verified.
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
               
                <table class="table table-hover" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Firm</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Verified</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($firm as $r){?>
                            <tr>
                                <td><?= $r['name']?></td>
                                <td><?= $r['firmname']?></td>
                                <td><?= $r['email']?></td>
                                <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                <td><?php if($r['verified'] == 'Yes'){echo '<span class="badge bg-success">'.$r['verified'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['verified'].'</span>';}?></td>
                                <td>
                                    <button class="btn btn-secondary btn-icon btn-sm view-data" title="View Info" type="button" data-bs-toggle="modal" data-bs-target="#viewfirm" data-firm="<?= $r['firmname']?>" data-verify="<?= $r['name']?>" data-usid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['userID']))?>"><i class="fas fa-eye"></i></button>
                                    <?php if($r['verified'] == 'No'){?>
                                        <button class="btn btn-primary btn-icon btn-sm verify-data" title="Verify" type="button" data-bs-toggle="modal" data-bs-target="#verify" data-firm="<?= $r['firmname']?>" data-verify="<?= $r['name']?>" data-url="<?= base_url()?>auditsystem/firms/verify/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['userID']))?>"><i class="fas fa-check-circle"></i></button>
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



<!-- Modal View-->
<div class="modal fade" id="viewfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><span class="firm"></span></h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row" id="editform">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <div id="profilelogo">

                                </div>
                                <!-- Profile picture help block-->
                                <!-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <div class="row gx-3">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="small mb-1" for="fname">Name:</label>
                                            <p><b class="name"></b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="firm">Firm Name:</label>
                                    <p><b class="firm"></b></p>
                                </div>
                                <div class="row gx-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="small mb-1" for="address">Address:</label>
                                            <p><b class="address"></b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="small mb-1" for="contact">Contact No.:</label>
                                            <p><b class="contact"></b></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row gx-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="small mb-1" for="noemployee">No. of Employees</label>
                                            <p><b class="noemployee"></b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="small mb-1" for="noclient">No. of Clients</label>
                                            <p><b class="noclient"></b></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <p><b class="email"></b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal Logout-->
<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <h4>Are you sure to Verify <b><span class="user"></span></b> from <b><span class="firm"></span></b> firm?</h4>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                <form id="vform" action="" method="post">
                    <button class="btn btn-primary" type="submit">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    $(".view-data").on("click", function() {
        var firm = $(this).data('firm');
        var verify = $(this).data('verify');
        var usid = $(this).data('usid');
        var email = $(this).data('email');
        $('.user').html(verify);
        $('.firm').html(firm);

        var originalContent = $("#editform").html();

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
            url: "<?= base_url('auditsystem/user/edit/')?>" + usid,  // Replace with your actual data endpoint URL
            method: "GET",
            dataType: 'json',
            success: function(data) {

                console.log(data.name);
                console.log(data.firm);

                $("#editform").html(originalContent);
                $('.name').html(data.name);
                $('.firm').html(data.firm);
                $('.address').html(data.address);
                $('.contact').html(data.contact);
                $('.noemployee').html(data.noemployee);
                $('.noclient').html(data.noclient);
                $('.email').html(data.email);
                if(data.logo === null || data.logo === ''){
                    $('#profilelogo').html(`<img class="img-account-profile rounded-circle mb-2" src="<?= base_url()?>assets/img/illustrations/profiles/profile-1.png" alt="" />`);
                }else{
                    $('#profilelogo').html(`<img class="img-account-profile rounded-circle mb-2" src="<?= base_url()?>uploads/logo/`+data.logo+`" alt="" />`);
                }
                
                
                
            },
            error: function() {
                // Handle error if the data fetch fails
                $(".tbitem").html("Error loading data");
            }

        });



    });



    $(".verify-data").on("click", function() {
        var firm = $(this).data('firm');
        var verify = $(this).data('verify');
        var url = $(this).data('url');
        $('#vform').attr('action', url);
        $('.user').html(verify);
        $('.firm').html(firm);
    });

});
</script>

