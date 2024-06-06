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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
        <style>
            .strength-meter {
                height: 10px;
                margin-top: 5px;
                background: #ddd;
                border-radius: 5px;
                transition: width 0.3s;
            }

            .strength-meter.weak {
                width: 20%;
                background: red;
            }

            .strength-meter.medium {
                width: 60%;
                background: yellow;
            }

            .strength-meter.strong {
                width: 100%;
                background: green;
            }
        </style>
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
                                    
                                    <div class="card-body p-5 text-center"><div class="h3 fw-light mb-0">Set new Password</div></div>
                                    <hr class="my-0" />
                                    <div class="card-body p-5">
                                        <div class="text-center small text-muted mb-4">Enter your OTP and New Password</div>
                                        <!-- Forgot password form-->
                                        <form action="<?= base_url()?>savepass/<?= $email?>" method="post">
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="text-gray-600 small" for="otp">OTP:</label>
                                                <input class="form-control form-control-solid" id="otp" type="text" placeholder="Enter One time Password" name="otp" required/>
                                            </div>
                                            <div class="mb-3">
                                                <label class="text-gray-600 small" for="password">New Password: </label>
                                                <input class="form-control form-control-solid" id="password" type="password" placeholder="Enter New Password" name="password" required/>
                                                <div id="password-strength" class="strength-meter"></div>
                                                <small id="password-help" class="form-text text-muted"></small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="text-gray-600 small" for="confirmpass">Retype Password:</label>
                                                <input class="form-control form-control-solid" id="confirmpass" type="password" placeholder="Retype Password" name="cpassword" required/>
                                            </div>
                                            
                                            <div id="password-match">                         
                                            </div>
                                            <!-- Form Group (reset password button)    -->
                                            <button type="submit" id="ca" class="btn btn-primary" hidden>Reset Password</button>
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
<script>
    $(document).ready(function() {

        var password;

        $('#password').on('input', function() {
            password = $(this).val();
            var strength = evaluatePasswordStrength(password);
            $('#password-strength').removeClass();
            $('#password-help').text('');

            if(password.length < 8){
                $('#password-strength').addClass('strength-meter weak');
                $('#password-help').text('Please make a password atleast 8 characters long.');
                $('#ca').attr('hidden', 'hidden');
            }else{
                if (strength === 'weak') {
                    $('#password-strength').addClass('strength-meter weak');
                    $('#password-help').text('Weak password. Try adding more characters, numbers, and symbols.');
                } else if (strength === 'medium') {
                    $('#password-strength').addClass('strength-meter medium');
                    $('#password-help').text('Medium strength. Consider adding more unique characters.');
                } else if (strength === 'strong') {
                    $('#password-strength').addClass('strength-meter strong');
                    $('#password-help').text('Strong password.');
                }
            }
            
        });

        $('#confirmpass').on('input', function() {
            var cpass = $(this).val();
            if(cpass == password){
                $('#password-match').html(`
                    <div class="alert alert-success alert-icon" role="alert">
                        <div class="alert-icon-content">
                            Password match
                        </div>
                    </div>
                `);
                $('#ca').removeAttr('hidden');
            }else{
                $('#password-match').html(`
                    <div class="alert alert-danger alert-icon" role="alert">
                        <div class="alert-icon-content">
                            Password not Match
                        </div>
                    </div>
                `);
            }
        });
        

        function evaluatePasswordStrength(password) {
            var strength = 'weak';
            var score = 0;
            if (password.length >= 8) score++;
            if (password.match(/[A-Z]/)) score++;
            if (password.match(/[a-z]/)) score++;
            if (password.match(/[0-9]/)) score++;
            if (password.match(/[^A-Za-z0-9]/)) score++;
            if (score >= 4) {
                strength = 'strong';
            } else if (score >= 2) {
                strength = 'medium';
            }
            return strength;
        }


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
