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
    <link rel="icon" type="image/x-icon" href="<?= base_url()?>assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>


</head>
<body class="bg-primary">

    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center align-items-center">

                        <div class="col-xl-7 col-lg-6 col-md-8 col-sm-11">
                            <div class="my-5 ">
                            <img src="<?= base_url()?>assets/img/illustrations/login.svg" alt="..." style="width: 30rem" />
                                <h1 class="text-white display-6"><b>Welcome to</b></h1>
                                <h1 class="text-white display-1"><b>APPLAUD SYSTEM</b></h1>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                            <div class="card my-5">
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
                                <?php if (session()->get('pass_changed')) { ?>
                                    <div class="alert alert-success alert-icon" role="alert">
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <div class="alert-icon-content">
                                            <h6 class="alert-heading">Password Changed</h6>
                                            Your password has been updated successfully, Please Login now.
                                        </div>
                                    </div>
                                <?php  }?>
                                <div class="card-body p-5 text-center">
                                    <div class="h3 fw-dark mb-3">Sign In</div>
                                </div>
                                <hr class="my-0" />
                                <div class="card-body p-5 animated--fade-in-up">
                                    <!-- Login form-->
                                    <form action="authenticate" method="post">
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="text-gray-600 small" for="inputEmailAddress">Email address</label>
                                            <input class="form-control form-control-solid" id="inputEmailAddress" type="email" placeholder="Enter email address" name="email" required/>
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="mb-3">
                                            <label class="text-gray-600 small" for="inputPassword">Password</label>
                                            <input class="form-control form-control-solid" id="inputPassword" type="password" placeholder="Enter password" name="password" required/>
                                        </div>
                                        <!-- Form Group (forgot password link)-->
                                        <div class="mb-3"><a class="small" href="<?= base_url()?>forgot">Forgot Password?</a></div>
                                        <!-- Form Group (login box)-->
                                        <div class="d-flex align-items-center justify-content-between mb-0">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
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
                        <div class="col-md-6 small">Copyright &copy; Applaud 2021 <span>||</span> Powered by: Build App Minds Software Solutions Inc.</div>
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