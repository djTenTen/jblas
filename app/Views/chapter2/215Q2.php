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
                
                <h4>OTHER INCOME AND GAINS</h4>
                <p>This audit programme should only cover items recognised in profit or loss, items recognised in other comprehensive income should be addressed by the S Audit Programme.</p>

                <form action="<?= base_url()?>auditsystem/c2/manage/save/<?= $code?>/<?= $header?>/<?= $c2tID?>" method="post">

                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Audit tests</th>
                                <th>Extent</th>
                                <th>Reference</th>
                                <th>Initials/Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php foreach($qdata as $r){?>
                                <tr>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"><?= $r['question']?></textarea></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="extent[]"><?= $r['extent']?></textarea></td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="initials[]"><?= $r['initials']?></textarea></td>
                                    <td class="text-center"><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                    <td>
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

                    <button class="btn btn-primary btn-sm m-1 float-end" type="button" data-action="add-field" id="add-field">Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end">Save</button>

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
            $('#myactiveform').attr('action', "<?= base_url('auditsystem/c2/manage/activeinactive/')?><?= $code?>/<?= $header?>/<?= $c2tID?>/" + acID);
            if (status == 'Active') {
                $('.msgconfirm').html(`<h3>Are you sure to Disable this content?</h3>`);
            }else{
                $('.msgconfirm').html(`<h3>Are you sure to Enable this content?</h3>`);
            } 
    });
    
    $('#add-field').on('click', function () {
        // Adding a row inside the tbody.
        $('#tbody').append(`
        <tr>
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"></textarea></td>
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="extent[]"></textarea></td>
            <td><textarea class="form-control" cols="30" rows="5" name="reference[]"></textarea></td>
            <td><textarea class="form-control" cols="30" rows="5" name="initials[]"></textarea></td>
            <td></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('#tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });



});
</script>



