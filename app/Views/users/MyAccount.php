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
                        <div class="page-header-subtitle">Manage your profile here</div>
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
            <div class="card-body">
                <hr>

                <form id="uploadForm" action="<?= base_url('auditsystem/myaccount/update')?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($u['userID']))?>" method="post" enctype="multipart/form-data">

                    <div class="row" id="editform">
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <?php if($u['photo'] == '' or empty($u['photo'])){?>
                                        <img class="img-account-profile rounded-circle mb-2 photo" src="<?= base_url()?>uploads/logo/<?= $u['logo']?>" alt="" />
                                    <?php }else{?>
                                        <img class="img-account-profile rounded-circle mb-2 photo" src="<?= base_url()?>uploads/photo/<?= $u['photo']?>" alt="" />
                                    <?php }?>
                                    <!-- <img class="img-account-profile rounded-circle mb-2" src="assets/img/illustrations/profiles/profile-1.png" alt="" /> -->
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB and 2x2 or square size image</div>
                                    <!-- Profile picture upload button-->
                                    <input type="file" id="imagephoto" name="photo" class="form-control btn btn-primary" >
                                    
                                </div>
                            </div>
                            
                            <div id="errorContainer" style="display: none;">
                                <div class="alert alert-danger alert-icon" role="alert">
                                    <div class="alert-icon-content">
                                        <h6 class="alert-heading">Image too Large</h6>
                                        The image has been too large to upload.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Signature</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <?php if($u['signature'] == '' or empty($u['signature'])){?>
                                        <img class="img-account-profile mb-2" src="<?= base_url()?>assets/img/illustrations/profiles/profile-1.png" alt="" />
                                    <?php }else{?>
                                        <img class="img-account-profile mb-2" src="<?= base_url()?>uploads/signature/<?= $u['signature']?>" alt="" />
                                    <?php }?>
                                    <!-- <img class="img-account-profile rounded-circle mb-2" src="assetss/img/illustrations/profiles/profile-1.png" alt="" /> -->
                                    <div class="small font-italic text-muted mb-4">PNG no larger than 5 MB</div>
                                    <!-- Profile picture upload button-->
                                    <input type="file" id="signatureinput" name="signature" class="form-control btn btn-primary" >

                                    
                                </div>
                            </div>

                            <div id="errorContainer2" style="display: none;">
                                <div class="alert alert-danger alert-icon" role="alert">
                                    <div class="alert-icon-content">
                                        <h6 class="alert-heading">Image too Large</h6>
                                        The image has been too large to upload.
                                    </div>
                                </div>
                            </div>
                            <div id="errorContainer3" style="display: none;">
                                <div class="alert alert-danger alert-icon" role="alert">
                                    <div class="alert-icon-content">
                                        <h6 class="alert-heading">Image not PNG</h6>
                                        Please select a PNG image
                                    </div>
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
                                                <input class="form-control" id="fname" type="text" placeholder="Enter full name" name="fname" value="<?= $u['name']?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="firm">Firm Name:</label>
                                        <h4><?= $u['firm']?></h4>
                                    </div>
                                    <div class="row gx-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="address">Address:</label>
                                                <input class="form-control" id="address" type="text"  placeholder="Enter Address" name="address" value="<?= $u['address']?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="contact">Contact No.:</label>
                                                <input class="form-control" id="contact" type="number"  placeholder="Enter Contact" name="contact" value="<?= $u['contact']?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                            
                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" value="<?= $u['email']?>" required/>
                                    </div>
                                    <div class="row gx-3">
                                        <h6>New Password</h6>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="pass">Password</label>
                                                <input class="form-control" id="pass" type="password" placeholder="Enter New password" name="pass" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                        
                                            <div class="mb-3">
                                                <label class="small mb-1" for="confirmpass">Confirm Password</label>
                                                <input class="form-control" id="confirmpass" type="password" placeholder="Confirm password" name="cpass" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block float-end">Update</button>

                </form>

            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {

        $('#imagephoto').change(function() {
            var maxSizeInBytes = 5 * 1024 * 1024; // 5MB
            var fileSize = this.files[0].size;
            if (fileSize > maxSizeInBytes) {
                $('#errorContainer').show();
                $(this).val('');
            } else {
                $('#errorContainer').hide();
            }
        });
    
        $('#signatureinput').change(function() {
            var maxSizeInBytes = 5 * 1024 * 1024; // 5MB
            var fileSize = this.files[0].size;
            var fileType = this.files[0].type;
            if (fileType !== 'image/png') {
                $('#errorContainer3').show();
                $(this).val('');
            }else if (fileSize > maxSizeInBytes) {
                $('#errorContainer2').show();
                $(this).val('');
            } else {
                $('#errorContainer2').hide();
                $('#errorContainer3').hide();
            }
        });

        
    });
</script>

