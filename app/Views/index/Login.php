<?php 
    \Config\Services::session(); 
    if(session()->get('authentication')){
        return redirect()->to(site_url('auditsystem'));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="<?= base_url()?>css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>


</head>
<body class="bg-primary">

    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <!-- Basic login form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <?php if (session()->get('access_denied')) { ?>
                                    <div class="alert alert-danger alert-icon" role="alert">
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <div class="alert-icon-content">
                                            <h6 class="alert-heading">Access Denied</h6>
                                            Invalid email or password, Please try again.
                                        </div>
                                    </div>
                                <?php  }?>
                                <?php if (session()->get('accountnotexist')) { ?>
                                    <div class="alert alert-danger alert-icon" role="alert">
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <div class="alert-icon-content">
                                            <h6 class="alert-heading">Account does not Exist</h6>
                                            the account you have been using does not exist
                                        </div>
                                    </div>
                                <?php  }?>
                                <?php if (session()->get('accountinactive')) { ?>
                                    <div class="alert alert-danger alert-icon" role="alert">
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <div class="alert-icon-content">
                                            <h6 class="alert-heading">Account Inactive</h6>
                                            Your account is inactive, PLease contact your administrator for further actions.
                                        </div>
                                    </div>
                                <?php  }?>
                                <?php if (session()->get('accountunverified')) { ?>
                                    <div class="alert alert-danger alert-icon" role="alert">
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <div class="alert-icon-content">
                                            <h6 class="alert-heading">Account Unverified</h6>
                                            Your account is not yet verified, Please wait until it verifies or contact the administrator for further actions
                                        </div>
                                    </div>
                                <?php  }?>
                                <?php if (session()->get('confirmed')) { ?>
                                    <div class="alert alert-success alert-icon" role="alert">
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <div class="alert-icon-content">
                                            <h6 class="alert-heading">Account Confirmed</h6>
                                            Your Account has been verified please Login.
                                        </div>
                                    </div>
                                <?php  }?>

                                <div class="card-header justify-content-center"><h3 class="fw-light my-4">Login</h3></div>
                                <div class="card-body">
                                    <!-- Login form-->
                                    <form action="authenticate" method="post">
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter email address" name="email" required/>
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Enter password" name="password" required/>
                                        </div>
                                        <!-- Form Group (remember password checkbox)-->
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" value="" />
                                                <label class="form-check-label" for="rememberPasswordCheck">Remember password</label>
                                            </div>
                                        </div>
                                        <!-- Form Group (login box)-->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="auth-password-basic.html">Forgot Password?</a>
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="<?= base_url('register')?>">Need an account? Sign up!</a></div>
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