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
                            <div class="col-md-6 small">Copyright &copy; Applaud 2021</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!" type="button"  data-bs-toggle="modal" data-bs-target="#privacy">Privacy Policy</a>
                                &middot;
                                <a href="#!" type="button"  data-bs-toggle="modal" data-bs-target="#terms">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Modal Terms-->
        <div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalCenterTitle">Terms & Conditions</h2>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container p-5">
                            <h4>ApplAud Terms & Conditions</h4>
                            <p>Effective June 1, 2024</p>
                            <br>
                            <h6>Introduction</h6>
                            <p>Welcome to ApplAud. These Terms and Conditions govern your use of our website located at <a href="<?= base_url()?>"><?= base_url()?></a> and form a binding agreement between you and ApplAud. 
                                By accessing or using our website, you agree to be bound by these Terms and Conditions. If you do not agree with any part of these Terms and Conditions, you must not use our website.</p>
                            <h6>Use of the Website</h6>
                            <ol type="a">
                                <li><b>Eligibility</b>: You must be at least 18 years of age to use our website. By using our website, you represent and warrant that you have the right, authority, and capacity to enter into this agreement.</li>
                                <li><b>Account Registration</b>: To access certain features of our website, you may be required to register an account. You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate, current, and complete.</li>
                                <li><b>Account Security</b>: You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You agree to notify us immediately of any unauthorized use of your account.</li>
                            </ol>
                            <h6>User Conduct</h6>
                            <ol type="a">
                                <li><b>Prohibited Activities</b>: You agree not to engage in any of the following prohibited activities:
                                    <ul>
                                        <li>Violating any applicable laws or regulations.</li>
                                        <li>Posting or transmitting any content that is infringing, defamatory, obscene, or otherwise objectionable.</li>
                                        <li>Attempting to interfere with the security or integrity of our website.</li>
                                        <li>Using our website for any fraudulent or deceptive purposes.</li>
                                    </ul>
                                </li>
                                <li><b>Content Ownership</b>: You retain ownership of any content you post or transmit on our website. 
                                However, by posting or transmitting content, you grant us a non-exclusive, royalty-free, perpetual, and worldwide license to use, reproduce, modify, adapt, publish, translate, distribute, and display such content.</li>
                            </ol>
                            <h6>Intellectual Property</h6>
                            <p>All content, trademarks, service marks, logos, and other intellectual property displayed on our website are the property of ApplAud or third parties. You are not permitted to use these materials without our prior written consent or the consent of the respective third party.</p>
                            <h6>Data Privacy</h6>
                            <ol type="a">
                                <li><b>Compliance with Philippine Data Privacy Law</b> : We are committed to protecting your privacy and ensuring that your personal data is handled in accordance with the <b>Data Privacy Act of 2012 (Republic Act No. 10173)</b> and other relevant laws in the Philippines.</li>
                                <li><b>Collection of Personal Data</b>: We collect personal data that you voluntarily provide to us, including but not limited to your name, email address, contact information, and payment details. We also collect data about your use of our website through cookies and other tracking technologies.</li>
                                <li><b>Use of Personal Data</b>: Your personal data is used to provide and improve our services, process transactions, communicate with you, and comply with legal obligations. We may also use your data for marketing purposes with your consent.</li>
                                <li><b>Data Sharing and Transfer</b>: We may share your personal data with third-party service providers who assist us in operating our website and conducting our business. These third parties are required to maintain the confidentiality and security of your personal data. We do not sell or rent your personal data to third parties.</li>
                                <li><b>Data Security</b>: We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, disclosure, alteration, or destruction.</li>
                                <li><b>Your Rights</b>: You have the right to access, correct, delete, or restrict the processing of your personal data. You also have the right to data portability and to object to the processing of your personal data. To exercise these rights, please contact us at <span class="text-primary">bamss@buildappminds.com</span>.</li>
                                <li><b>Data Retention</b>: We retain your personal data for as long as necessary to fulfill the purposes for which it was collected, or as required by law.</li>
                            </ol>
                            <h6>Termination</h6>
                            <p>We reserve the right to terminate or suspend your access to our website, without prior notice or liability, for any reason, including if you breach these Terms and Conditions. Upon termination, your right to use our website will immediately cease.</p>
                            <h6>Limitation of Liability</h6>
                            <p>To the fullest extent permitted by law, ApplAud and its affiliates, officers, directors, employees, and agents will not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses, resulting from (a) your use or inability to use the website; (b) any unauthorized access to or use of our servers and/or any personal information stored therein; (c) any bugs, viruses, trojan horses, or the like that may be transmitted to or through our website by any third party; or (d) any errors or omissions in any content or for any loss or damage incurred as a result of your use of any content posted, emailed, transmitted, or otherwise made available through the website, whether based on warranty, contract, tort (including negligence), or any other legal theory, whether or not we have been informed of the possibility of such damage.</p>
                            <h6>Governing Law</h6>
                            <p>These Terms and Conditions are governed by and construed in accordance with the laws of the Philippines, without regard to its conflict of law principles. You agree to submit to the exclusive jurisdiction of the courts located in [Your City/Province] for the resolution of any disputes.</p>
                            <h6>Changes to These Terms</h6>
                            <p>We reserve the right to modify or replace these Terms and Conditions at any time. We will notify you of any changes by posting the new Terms and Conditions on our website. Your continued use of the website following the posting of any changes constitutes acceptance of those changes.</p>
                            <h6>Contact Us</h6>
                            <p>If you have any questions about these Terms and Conditions, please contact us at <span class="text-primary">bamss@buildappminds.com</span>.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Privacy-->
        <div class="modal fade" id="privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalCenterTitle">Privacy Policy</h2>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container p-5">
                            <h4>ApplAud Privacy Policy</h4>
                            <p>Effective June 1, 2024</p>
                            <br>
                            <h6>Introduction</h6>
                            <p>Welcome to ApplAud. We at Build App Minds Software Solutions Inc. want you to understand that we are committed to 
                                protecting your personal information and your right to privacy. If you have any questions or concerns about our policy or our practices 
                                regarding your personal information, please contact us at <span class="text-primary">bamss@buildappminds.com</span>.</p>

                            <h6>Information We Collect</h6>
                            <p>We collect information from you when you visit our website, register on our site,
                                The types of personal information collected may include your name, email address, mailing address, and phone number</p>
                            
                            <h6>How We Use Your Information</h6>
                            <p>We may use the information we collect from you in the following ways:</p>
                            <ul>
                                <li>To personalize your experience on our site</li>
                                <li>To process transactions</li>
                                <li>To send periodic emails regarding your account and other matters</li>
                                <li>To send email confirmations</li>
                                <li>To Contact you directly</li>
                                <li>To assess your eligibility to use this system</li>
                            </ul>
                            <h6>How We Protect Your Information</h6>
                            <p>We implement a variety of security measures to maintain the safety of your personal information. <br> These measures include:</p>
                            <ul>
                                <li><b>Encryption</b>: Sensitive information provided via our website is encrypted using Secure Socket Layer (SSL) technology when accessing the website, and the data stored on our database and also encrypted</li>
                                <li><b>Access Controls</b>: Only authorized personnel have access to personal information, and such access is limited to what is necessary for the purposes of carrying out their duties.</li>
                                <li><b>Data Security</b>: We use firewalls, intrusion detection systems, and secure network architecture to prevent unauthorized access to our systems.</li>
                                <li><b>Data Minimization</b>: We only collect and store the personal information that is necessary for the purposes outlined in this Privacy Policy.</li>
                                <li><b>Training</b>: Our staff are trained on data security practices to ensure that they understand the importance of protecting your personal information.</li>
                                <li><b>Physical Security</b>: Physical access to our facilities where personal data is stored is restricted to authorized personnel.</li>
                            </ul>
                            <p>Despite these measures, please be aware that no method of transmitting or storing data is completely secure. While we strive to use commercially acceptable means to 
                                protect your personal information, we cannot guarantee its absolute security.</p>
                            <p>If you have any questions about the security of your personal information, you can contact us at <span class="text-primary">bamss@buildappminds.com</span>.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
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
