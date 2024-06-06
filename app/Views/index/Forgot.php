<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Forgot Password - SB Admin Pro</title>
        <link href="<?= base_url()?>css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="<?= base_url()?>assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container-xl px-4">
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                                <!-- Social forgot password form-->
                                <div class="card my-5">
                                    <?php if (session()->get('invalid_email')) { ?>
                                        <div class="alert alert-danger alert-icon" role="alert">
                                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <div class="alert-icon-content">
                                                <h6 class="alert-heading">Invalid Email</h6>
                                                Invalid input email. Please try again.
                                            </div>
                                        </div>
                                    <?php  }?>
                                    <?php if (session()->get('emailnotexist')) { ?>
                                        <div class="alert alert-danger alert-icon" role="alert">
                                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <div class="alert-icon-content">
                                                <h6 class="alert-heading">Email Not Exist</h6>
                                                Your email seems not exist on our records.
                                            </div>
                                        </div>
                                    <?php  }?>

                                    
                                    <div class="card-body p-5 text-center"><div class="h3 fw-light mb-0">Password Recovery</div></div>
                                    <hr class="my-0" />
                                    <div class="card-body p-5">
                                        <div class="text-center small text-muted mb-4">Enter your email address below and we will send you a link to reset your password.</div>
                                        <!-- Forgot password form-->
                                        <form action="<?= base_url()?>resetpass" method="post">
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="text-gray-600 small" for="inputEmailAddress">Email address</label>
                                                <input class="form-control form-control-solid" id="inputEmailAddress" type="email" placeholder="Enter email address" name="email" required/>
                                            </div>
                                            <!-- Form Group (reset password button)    -->
                                            <button type="submit" class="btn btn-primary">Set Password</button>
                                        </form>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body px-5 py-4">
                                        <div class="small text-center">
                                            New user?
                                            <a href="<?= base_url('register')?>">Create an account!</a>
                                        </div>
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
        <script src="<?= base_url()?>js/scripts.js"></script>
    </body>
</html>
