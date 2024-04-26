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
                        <div class="page-header-subtitle"><?= $code.' - '.$header?></div>
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
            <?php if (session()->get('success_registration')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Registration</h6>
                        Contents has been successfully saved.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('success_update')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Update</h6>
                        Contents has been successfully updated.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed_registration')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Failed Registration</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>


            <div class="card-body">
            <hr>
                <h4>PERMANENT FILE CHECKLIST</h4>
                <p>Objective: This form is to be used to ensure the permanent file contains sufficient background information about the client. </p>
                <p>This is a mandatory form.  Any “no” answers indicate a deficiency on the permanent file and a comment should be made as to how this will be addressed.</p>
                <p>Per PSA 315, para A128c, “Disclosures in the financial statements of smaller entities may be less detailed or less complex (e.g., some financial reporting frameworks allow smaller entities to provide fewer disclosures in the financial statements). However, this does not relieve the auditor of the responsibility to obtain an understanding of the entity and its environment, including internal control, as it relates to disclosures.”</p>

                <form action="<?= base_url()?>auditsystem/c1/saveac3/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                    <input type="hidden" name="part" value="genmat">
                    <h3>General Matters</h3>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Yes/No</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac3genmat as $r1){?>
                                <tr>

                                    <td><textarea class="form-control" cols="30" rows="3" name="question[]"><?= $r1['question']?></textarea></td>
                                    <td><input class="form-control" type="text" name="yesno[]" value="<?= $r1['yesno']?>"></td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r1['comment']?></textarea></td>
                                    <td><?php if($r1['status'] == 'Active'){echo '<span class="badge bg-success">'.$r1['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r1['status'].'</span>';}?></td>
                                    <td>
                                        <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
                                        <?php if($r1['status'] == 'Active'){?>
                                            <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                        <?php }else{?>
                                            <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button class="btn btn-primary m-1 float-end add-field  btn-sm" type="button"><i class="fas fa-plus-square m-1"></i> Add Field</button>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br>
                <hr>



                <form action="<?= base_url()?>auditsystem/c1/saveac3/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                    <input type="hidden" name="part" value="doccors">
                    <h3>Documents and Correspondence of a Permanent Nature</h3>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Yes/No</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac3doccors as $r1){?>
                                <tr>

                                    <td><textarea class="form-control" cols="30" rows="3" name="question[]"><?= $r1['question']?></textarea></td>
                                    <td><input class="form-control" type="text" name="yesno[]" value="<?= $r1['yesno']?>"></td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r1['comment']?></textarea></td>
                                    <td><?php if($r1['status'] == 'Active'){echo '<span class="badge bg-success">'.$r1['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r1['status'].'</span>';}?></td>
                                    <td>
                                        <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
                                        <?php if($r1['status'] == 'Active'){?>
                                            <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                        <?php }else{?>
                                            <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button class="btn btn-primary m-1 float-end add-field  btn-sm" type="button"><i class="fas fa-plus-square m-1"></i> Add Field</button>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br>
                <hr>


                <form action="<?= base_url()?>auditsystem/c1/saveac3/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                    <input type="hidden" name="part" value="statutory">
                    <h3>Statutory Matters</h3>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Yes/No</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac3statutory as $r1){?>
                                <tr>

                                    <td><textarea class="form-control" cols="30" rows="3" name="question[]"><?= $r1['question']?></textarea></td>
                                    <td><input class="form-control" type="text" name="yesno[]" value="<?= $r1['yesno']?>"></td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r1['comment']?></textarea></td>
                                    <td><?php if($r1['status'] == 'Active'){echo '<span class="badge bg-success">'.$r1['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r1['status'].'</span>';}?></td>
                                    <td>
                                        <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
                                        <?php if($r1['status'] == 'Active'){?>
                                            <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                        <?php }else{?>
                                            <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button class="btn btn-primary m-1 float-end add-field  btn-sm" type="button"><i class="fas fa-plus-square m-1"></i> Add Field</button>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br>
                <hr>
               


                <form action="<?= base_url()?>auditsystem/c1/saveac3/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                    <input type="hidden" name="part" value="accsys">
                    <h3>The Accounting System</h3>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Yes/No</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac3accsys as $r1){?>
                                <tr>

                                    <td><textarea class="form-control" cols="30" rows="3" name="question[]"><?= $r1['question']?></textarea></td>
                                    <td><input class="form-control" type="text" name="yesno[]" value="<?= $r1['yesno']?>"></td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r1['comment']?></textarea></td>
                                    <td><?php if($r1['status'] == 'Active'){echo '<span class="badge bg-success">'.$r1['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r1['status'].'</span>';}?></td>
                                    <td>
                                        <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
                                        <?php if($r1['status'] == 'Active'){?>
                                            <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                        <?php }else{?>
                                            <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r1['acID']))?>" data-status="<?= $r1['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button class="btn btn-primary m-1 float-end add-field  btn-sm" type="button"><i class="fas fa-plus-square m-1"></i> Add Field</button>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br>
                <hr>

            </div>
        </div>
    </div>
    
</main>


<script>
    $(document).ready(function () {


        $(".active-data").on("click", function() {
            var status = $(this).data('status');
            var acID = $(this).data('ac-id');
                $('#myactiveform').attr('action', "<?= base_url('auditsystem/c1/activeinactive/')?><?= $code?>/<?= $header?>/<?= $c1tID?>/" + acID);
                if (status == 'Active') {
                    $('.msgconfirm').html(`<h3>Are you sure to Disable this content?</h3>`);
                }else{
                    $('.msgconfirm').html(`<h3>Are you sure to Enable this content?</h3>`);
                }
        });


        $('.add-field').on('click', function () {
        // Adding a row inside the tbody.
        var form = $(this).closest('form');
        var tbody = form.find('tbody');
        tbody.append(`
        <tr>
            <td><input type="hidden" name="part[]" value="genmat"><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
            <td><input class="form-control" type="text" name="yesno[]" value="YES"></td>
            <td><textarea class="form-control" cols="30" rows="3" name="comment[]">None</textarea></td>
            <td></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
        });

        $('.tbody').on('click', 'button.remove', function () {
            $(this).closest('tr').remove();
        });

    });
</script>
