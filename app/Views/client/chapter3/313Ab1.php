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

            <?php if (session()->get('success_update')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Update</h6>
                        Contents has been successfully updated.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed_update')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Failed update</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">
                
                <h4>CRITICAL REVIEW OF THE FINANCIAL STATEMENTS</h4>
               

                <form action="<?= base_url()?>auditsystem/c3/saveab1/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Yes/No</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ab1 as $r){?>
                                <tr>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="3" name="question[]"><?= $r['question']?></textarea></td>
                                    <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
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
                
                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" >Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end">Save</button>
                </form>
            
            
                <p>The tests above were undertaken on draft financial statements sent to the client.</p>
            
            
            
            </div>
        </div>
    </div>
    
</main>

<script>
$(document).ready(function () {

    $(".active-data").on("click", function() {
        var status = $(this).data('status');
        var acID = $(this).data('ac-id');
            $('#myactiveform').attr('action', "<?= base_url('auditsystem/c3/activeinactive/')?><?= $code?>/<?= $header?>/<?= $c3tID?>/" + acID);
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
            <td><textarea class="form-control question" id="question" cols="30" rows="3" name="question[]"></textarea></td>
            <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"></textarea></td>
            <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"></textarea></td>
            <td></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('.tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });


});
</script>











