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
                
                <h4>SUBSEQUENT EVENTS REVIEW</h4>
                <h6>Objective:</h6>
                <p>To determine whether any material adjustment or disclosure is required to the financial statements as a result of events occurring between the end of the accounting period and the date of signing the audit report and to ensure the requirements of ISA 560 regarding subsequent events are met.</p>
                <h6>NB: An adjusting event is an event that provides evidence of a condition that existed at the reporting date.  A non-adjusting event is an event that arose solely after the reporting date, however, its disclosure is necessary to give a true and fair view.</h6>
                <h6>Review of Clients Records</h6>
                <form action="<?= base_url()?>auditsystem/c3/saveaa3a/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" value="cr" name="part">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php foreach($cr as $r){?>
                            <tr>
                                <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"><?= $r['question']?></textarea></td>
                                <td><textarea class="form-control question" id="question" cols="30" rows="5" name="comment[]"><?= $r['reference']?></textarea></td>
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

                <br>
                <h6>Discussion with Client</h6>

                <form action="<?= base_url()?>auditsystem/c3/saveaa3a/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" value="dc" name="part">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody1">
                            <?php foreach($dc as $r){?>
                            <tr>
                                <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"><?= $r['question']?></textarea></td>
                                <td><textarea class="form-control question" id="question" cols="30" rows="5" name="comment[]"><?= $r['reference']?></textarea></td>
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

                    <button class="btn btn-primary btn-sm m-1 float-end" type="button" data-action="add-field1" id="add-field1">Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end">Save</button>
                </form>


                <h6>Finalisation of the Audit File</h6>
                <p>This section should also detail any other work done on subsequent events not covered by the questions below.</p>

                <form action="<?= base_url()?>auditsystem/c3/saveaa3afaf/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" value="faf" name="part">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Initial & Date</th>
                                <th>Reference</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody2">
                            <?php foreach($faf as $r){?>
                            <tr>
                                <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"><?= $r['question']?></textarea></td>
                                <td><textarea class="form-control question" id="question" cols="30" rows="5" name="extent[]"><?= $r['extent']?></textarea></td>
                                <td><textarea class="form-control" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
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

                    <button class="btn btn-primary btn-sm m-1 float-end" type="button" data-action="add-field2" id="add-field2">Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end">Save</button>
                </form>

                <h4>Initial Conclusion:</h4>
                <p>* Delete as applicable </p>
                <p>Having completed the above procedures:</p>
                <p>There were no significant events. *</p>
                <p>Subsequent events identified above have* / have not* been adequately reflected in the financial statements.</p>
                <p>Significant events highlighted by this review, including any disagreements with the client have been brought to the A.E.P.'s attention and are noted on schedule ___________ *</p>
                <h4>Final Conclusion:	</h4>
                <i>
                    <p>If there is a significant delay* between the initial subsequent event review and the signing of the audit report:</p>
                    <ul>
                        <li>then a detailed subsequent event review will need to be reperformed to this date;</li>
                        <li>consideration should be given to the reason for the delay, as this may be indicative of potential going concern problems; and</li>
                        <li>if there is no justifiable reason for the delay, revisit and update the going concern review.</li>
                    </ul>
                    <p>* - “Significant delay” is not defined, but a delay in excess of three months is likely to mean that the subsequent events review will need to be reperformed.</p>
                </i>
                <p>The initial review was conducted sufficiently close to the proposed date of the audit report not to require the work to be revised.*</p>
                <p>The initial review has been updated to _____________ (insert date). The work performed is outlined below:*</p>
                <form action="<?= base_url()?>auditsystem/c3/saveaa3air/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <textarea class="form-control" cols="30" rows="15" name="ir" required><?= $ir['question']?></textarea>
                    <button type="submit" class="btn btn-sm btn-icon btn-success float-end"><i class="fas fa-file-alt"></i></button>
                </form>
                <p>Having reviewed the above procedures:</p>
                <p>I am satisfied that no further significant events have occurred between the initial review as documented by the conclusion above and _____________ (date of the final review) *</p>
                <p>Significant events that have occurred are explained above, have been communicated to the A.E.P., and adequately accounted for / disclosed in the financial statements. *</p>
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
    
    $('#add-field').on('click', function () {
        // Adding a row inside the tbody.
        $('#tbody').append(`
        <tr>
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"></textarea></td>
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="comment[]"></textarea></td>
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
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="comment[]"></textarea></td>
            <td></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove1" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('#tbody1').on('click', 'button.remove1', function () {
        $(this).closest('tr').remove();
    });


    $('#add-field2').on('click', function () {
        // Adding a row inside the tbody.
        $('#tbody2').append(`
        <tr>
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"></textarea></td>
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="extent[]"></textarea></td>
            <td><textarea class="form-control" cols="30" rows="3" name="reference[]"></textarea></td>
            <td></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove2" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('#tbody2').on('click', 'button.remove2', function () {
        $(this).closest('tr').remove();
    });



});
</script>














<p>14.	Ensure that an appropriate paragraph is included in the letter of representation.</p>

















