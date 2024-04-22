<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title?></title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container-xl px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <!-- Basic registration form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="fw-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                    

                                        <?php if (session()->get('invalidimage')) { ?>
                                            <div class="alert alert-danger alert-icon" role="alert">
                                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <div class="alert-icon-content">
                                                    <h6 class="alert-heading">Invalid Image</h6>
                                                    Something went wrong on your image uploading
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
                                        <?php if (session()->get('exist')) { ?>
                                            <div class="alert alert-danger alert-icon" role="alert">
                                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <div class="alert-icon-content">
                                                    <h6 class="alert-heading">Data already Exist</h6>
                                                    Your data has been already exist to our system, Please try forgot password or contact the administrator for further actions.
                                                </div>
                                            </div>
                                        <?php  }?>
                                        <?php if (session()->get('success_registration')) { ?>
                                            <div class="alert alert-success alert-icon" role="alert">
                                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <div class="alert-icon-content">
                                                    <h6 class="alert-heading">Success Registration</h6>
                                                    We have received your registration, PLease wait a email confirmation before signing in.
                                                </div>
                                            </div>
                                        <?php  }?>
                                        <?php if (session()->get('passnotmatch')) { ?>
                                            <div class="alert alert-danger alert-icon" role="alert">
                                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <div class="alert-icon-content">
                                                    <h6 class="alert-heading">Password did not matched</h6>
                                                    The password confirmation did not match, please try again.
                                                </div>
                                            </div>
                                        <?php  }?>
                                        
                                        <!-- Registration form-->
                                        <form id="uploadForm" action="<?= base_url('signup')?>" method="post" enctype="multipart/form-data">

                                            <div class="row" id="editform">
                                                <div class="col-xl-4">
                                                    <!-- Profile picture card-->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <div class="card-header">Logo</div>
                                                        <div class="card-body text-center">
                                                            <!-- Profile picture image-->
                                                            <img class="img-account-profile rounded-circle mb-2" src="<?= base_url()?>assets/img/demo/user-placeholder.svg" alt="" />
                                                            <!-- <img class="img-account-profile rounded-circle mb-2" src="assets/img/illustrations/profiles/profile-1.png" alt="" /> -->
                                                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB and 2x2 or square size image</div>
                                                            <!-- Profile picture upload button-->
                                                            <input type="file" id="imageInput" name="logo" class="form-control btn btn-primary" required>
                                                        </div>
                                                        
                                                    </div>
                                                    <div id="errorContainer" style="display: none;">
                                                            <div class="alert alert-danger alert-icon" role="alert">
                                                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                <div class="alert-icon-content">
                                                                    <h6 class="alert-heading">Image too Large</h6>
                                                                    The image has been too large to upload.
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
                                                                        <input class="form-control" id="fname" type="text" placeholder="Enter full name" name="fname" required/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="firm">Firm Name:</label>
                                                                <input class="form-control" id="firm" type="text"  placeholder="Enter Firm name" name="firm" required/>
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
                                                                        <label class="small mb-1" for="noemployee">No. of Employees</label>
                                                                        <input class="form-control" id="noemployee" type="number" placeholder="Enter Number of Employees" name="noemployee" required/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="small mb-1" for="noclient">No. of Clients</label>
                                                                        <input class="form-control" id="noclient" type="number" placeholder="Enter Number of Clients" name="noclient" required/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="email">Email</label>
                                                                <input class="form-control" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" required/>
                                                            </div>
                                                            <div class="row gx-3">
                                                                <div class="col-md-6">
                                            
                                                                    <div class="mb-3">
                                                                        <label class="small mb-1" for="pass">Password</label>
                                                                        <input class="form-control" id="pass" type="password" placeholder="Enter password" name="pass" required/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                
                                                                    <div class="mb-3">
                                                                        <label class="small mb-1" for="confirmpass">Confirm Password</label>
                                                                        <input class="form-control" id="confirmpass" type="password" placeholder="Confirm password" name="cpass" required/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block float-end">Create Account</button>
           
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="<?= base_url('/login')?>">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="footer-admin mt-auto footer-dark">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<script>
    $(document).ready(function() {
        $('#imageInput').change(function() {
            var maxSizeInBytes = 5 * 1024 * 1024; // 5MB
            var fileSize = this.files[0].size;
            if (fileSize > maxSizeInBytes) {
                $('#errorContainer').show();
                $(this).val('');
            } else {
                $('#errorContainer').hide();
            }
        });
    });
</script>
