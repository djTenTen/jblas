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
               
                <h4>PRELIMINARY PLANNING PROCEDURES – CLIENT INVOLVEMENT IN THE PLANNING PROCESS</h4>
                <h6>NB: The key issues noted from this document must be recorded in the relevant areas of the audit file or the PAF and should feed through into the risk assessment, audit approach and fieldwork.</h6>

                <table class="table">
                    <tr>
                        <td>
                            <h6>Which members of the client staff and the audit team have been involved in the preplanning process and what are their roles?</h6>
                            <form action="<?= base_url()?>auditsystem/c1/ppr/update/AC4/<?= $header?>/<?= $c1tID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppr1['acID']))?>" method="post">
                                <textarea class="form-control" cols="30" rows="3" name="ppr" required><?= $ppr1['question']?></textarea>
                                <button type="submit" class="btn btn-sm btn-icon btn-success float-end"><i class="fas fa-file-alt"></i></button>
                            </form>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>How was the communication undertaken and on what date? </h6>
                            <form action="<?= base_url()?>auditsystem/c1/ppr/update/AC4/<?= $header?>/<?= $c1tID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppr2['acID']))?>" method="post">
                                <textarea class="form-control" cols="30" rows="3" name="ppr" required><?= $ppr2['question']?></textarea>
                                <button type="submit" class="btn btn-sm btn-icon btn-success float-end"><i class="fas fa-file-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                </table>
                <br>
                <p>In respect of a new audit assignment, where the discussion points below request “changes” to be noted, full information should be documented, as the working papers will not document “existing” issues affecting the client.</p>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Default Value</th>
                            <th>Status</th>
                            <th style="width: 7%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ac4 as $r){?>
                            <tr>
                                <td><?= $r['question']?></td>
                                <td><?= $r['comment']?></td>
                                <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                <td>
                                    <button class="btn btn-primary btn-icon btn-sm load-data" type="button" data-bs-toggle="modal" data-bs-target="#modaledit" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['acID']))?>" title="Edit" ><i class="fas fa-edit"></i></button>
                                    <?php if($r['status'] == 'Active'){?>
                                        <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['acID']))?>" data-status="<?= $r['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                    <?php }else{?>
                                        <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['acID']))?>" data-status="<?= $r['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>

                <form action="<?= base_url()?>auditsystem/c1/manage/save/AC4/<?= $header?>/<?= $c1tID?>" method="post">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted:</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            
                        </tbody>
                    </table>


                    <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field" id="add-field">Add Field</button>

                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                </form>

            </div>
        </div>
    </div>
    
</main>



<script>
    $(document).ready(function () {

        $(".active-data").on("click", function() {
            var status = $(this).data('status');
            var acID = $(this).data('ac-id');
                $('#myactiveform').attr('action', "<?= base_url('auditsystem/c1/manage/activeinactive/')?>AC4/<?= $header?>/<?= $c1tID?>/" + acID);
                if (status == 'Active') {
                    $('.msgconfirm').html(`<h3>Are you sure to Disable this content?</h3>`);
                }else{
                    $('.msgconfirm').html(`<h3>Are you sure to Enable this content?</h3>`);
                }
        });

        $(".load-data").on("click", function() {
            // Show the modal
            var acID = $(this).data('ac-id');

            $(".loading").html(`
                <div class="spinner-grow text-muted"></div>
                <div class="spinner-grow text-primary"></div>
                <div class="spinner-grow text-success"></div>
                <div class="spinner-grow text-info"></div>
                <div class="spinner-grow text-warning"></div>
                <div class="spinner-grow text-danger"></div>
                <div class="spinner-grow text-secondary"></div>
                <div class="spinner-grow text-dark"></div>
                <div class="spinner-grow text-light"></div>
                <h3>Loading...</h3>
            `);
            // Fetch data using AJAX
			$.ajax({
                url: "<?= base_url('auditsystem/c1/ac4/edit/')?>" + acID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    $(".loading").html(`
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="question">Question:</label>
                                <textarea class="form-control question" id="question" cols="30" rows="5" name="question"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="comment">Comment:</label>
                                <textarea class="form-control comment" id="comment" cols="30" rows="5" name="comment"></textarea>
                            </div>
                        </div>
                    `);

                    $(".question").val(data.question);
                    $(".comment").val(data.comment);

                    $('#myform').attr('action', "<?= base_url('auditsystem/c1/manage/update/')?>AC4/<?= $header?>/<?= $c1tID?>/" + acID);

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".loading").html("Error loading data");
                }

            });

        });



        var rowIdx = 0;

        $('#add-field').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody').append(` <tr>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><input class="form-control" type="text" name="comment[]"></td>
                            <td><button class="btn btn-danger btn-icon remove btn-sm" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                        </tr>`);
        });

        $('#tbody').on('click', '.remove', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });
    });
</script>
