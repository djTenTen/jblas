<?php 
    \Config\Services::session(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
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
                                <?php if (session()->get('invalid_input')) { ?>
                                    <div class="alert alert-danger alert-icon" role="alert">
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <div class="alert-icon-content">
                                            <h6 class="alert-heading">Invalid Input</h6>
                                            There's something wrong with your input.
                                        </div>
                                    </div>
                                <?php  }?>
                                <?php if (session()->get('infonotfound')) { ?>
                                    <div class="alert alert-danger alert-icon" role="alert">
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <div class="alert-icon-content">
                                            <h6 class="alert-heading">Info not Found</h6>
                                            Your information cannot be found, please double check your password and reference ID.
                                        </div>
                                    </div>
                                <?php  }?>
                                <div class="card-header justify-content-center"><h3 class="fw-light my-4">Confirmation</h3></div>
                                <div class="card-body">
                                    <!-- Login form-->
                                    <form action="<?= base_url()?>accept/aud/<?= $email?>" method="post">
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Reference ID</label>
                                            <input class="form-control" id="inputEmailAddress" type="number" placeholder="Enter Reference Number" name="refid" required/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter email address" name="email" value="<?= $email?>" required disabled/>
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Enter password" name="password" required/>
                                        </div>
                                        <!-- Form Group (login box)-->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

</body>
</html>