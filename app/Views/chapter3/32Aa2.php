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
                
                <h4>POINTS FORWARD</h4>
                <h6>Objective: </h6>
                <p>To provide a summary of the key points arising from the audit, where it is possible for improvements to the efficiency of the audit to be made, and should include both financial and non-financial matters. <i> The use of this form is optional. </i> </p>
                <h6>Recording:</h6>
                <p>This form should be completed during the audit, and should cover key matters which are of relevance to next year’s assignment.</p>
                <p>If information has been included elsewhere on the audit file (for example, Subsequent Events Review, or the ISA Compliance Critical Issues Memorandum), it does not need to be repeated.  Where appropriate, details of suggested improvements should be outlined.</p>
                

                <form action="<?= base_url()?>auditsystem/c3/saveaa2/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                
                    <h6>Problems encountered during the audit (regarding audit tests):</h6>
                    <textarea class="form-control" cols="30" rows="15" name="rat" required><?= $aa2['rat']?></textarea>
                    <br>
                    <h6>Problems encountered during the audit (regarding the client, and their accessibility etc.):</h6>
                    <textarea class="form-control" cols="30" rows="15" name="rcae" required><?= $aa2['rcae']?></textarea>
                    <br>
                    <h6>Audit tests which can be removed / reduced without impairing audit quality:</h6>
                    <textarea class="form-control" cols="30" rows="15" name="atriaq" required><?= $aa2['atriaq']?></textarea>
                    <br>
                    <h6>Known changes to, or new accounting policies and estimation techniques in the forthcoming period:</h6>
                    <textarea class="form-control" cols="30" rows="15" name="kcapet" required><?= $aa2['kcapet']?></textarea>
                    <br>
                    <h6>Future developments (nature of business, locations, acquisitions and disposals):</h6>
                    <textarea class="form-control" cols="30" rows="15" name="fd" required><?= $aa2['fd']?></textarea>
                    <br>
                    <h6>Future structure of the audit team:</h6>
                    <textarea class="form-control" cols="30" rows="15" name="fs" required><?= $aa2['fs']?></textarea>
                    <br>
                    <h6>Other issues:</h6>
                    <textarea class="form-control" cols="30" rows="15" name="oi" required><?= $aa2['oi']?></textarea>

                    <div class="container m-2">
                        <div class="col-3 float-end">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success  btn-block">Save</button>
                            </div>
                        </div>
                    </div>

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
            $('#myactiveform').attr('action', "<?= base_url('auditsystem/c3/manage/activeinactive/')?><?= $code?>/<?= $header?>/<?= $c3tID?>/" + acID);
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
            <td><textarea class="form-control" cols="30" rows="3" name="reference[]"></textarea></td>
            <td></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('#tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });

    $('#add-field1').on('click', function () {
        // Adding a row inside the tbody.
        $('#tbody1').append(`
        <tr>
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"></textarea></td>
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="extent[]"></textarea></td>
            <td><textarea class="form-control" cols="30" rows="3" name="reference[]"></textarea></td>
            <td></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove1" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('#tbody1').on('click', 'button.remove1', function () {
        $(this).closest('tr').remove();
    });



});
</script>



























