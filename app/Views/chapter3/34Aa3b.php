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
                <hr>
                <h4>GOING CONCERN CHECKLIST</h4>
                <h6>Objective:</h6>
                <p>To ensure that the fundamental concept of going concern is fully considered and that the requirements of ISA 570 are met.</p>
                <h6>Overview:  Under the going concern assumption, an entity is viewed as continuing in business for the foreseeable future.  Financial statements are prepared on a going concern basis, unless management either intends to liquidate the entity or to cease to operate, or has no realistic alternative to do so (in these circumstances the financial statements are prepared on a break-up basis).</h6>
                <h6>Part 1 – Discussion with the Client Regarding Going Concern:</h6>
                <form action="<?= base_url()?>auditsystem/c3/saveaa3b/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" value="p1" name="part">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Values</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($bp1 as $r){?>
                                <tr>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"><?= $r['question']?></textarea></td>
                                    <td><textarea class="form-control reference" id="reference" cols="30" rows="5" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td class="text-center"><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                    <td>
                                        <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
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

                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i>Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>
                <h6>Part 2 – The Auditor’s Assessment ~ General Considerations:</h6>
                <form action="<?= base_url()?>auditsystem/c3/saveaa3b/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" value="p2" name="part">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Values</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($bp2 as $r){?>
                                <tr>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"><?= $r['question']?></textarea></td>
                                    <td><textarea class="form-control reference" id="reference" cols="30" rows="5" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td class="text-center"><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                    <td>
                                        <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
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

                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i>Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>

                <br><br><br><hr>

                <h6>Part 3a – The Auditor’s Assessment ~ Specific Concerns:</h6>
                <h6><i>Completion of this section is optional unless potential issues regarding the going concern presumption have been identified in Parts 1 or 2 above.</i></h6>
               
                <form action="<?= base_url()?>auditsystem/c3/saveaa3b/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" value="p3a" name="part">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Values</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($bp3a as $r){?>
                                <tr>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"><?= $r['question']?></textarea></td>
                                    <td><textarea class="form-control reference" id="reference" cols="30" rows="5" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td class="text-center"><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                    <td>
                                        <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
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

                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i>Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>

                <br><br><br><hr>

                <h6>Part 3b – The Auditor’s Assessment ~ Disclosure considerations:</h6>
               
                <form action="<?= base_url()?>auditsystem/c3/saveaa3b/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" value="p3b" name="part">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Values</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($bp3b as $r){?>
                                <tr>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"><?= $r['question']?></textarea></td>
                                    <td><textarea class="form-control reference" id="reference" cols="30" rows="5" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td class="text-center"><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                    <td>
                                        <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
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

                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i>Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>

                <br><br><br><hr>

                <h6>Part 4 – Conclusion:</h6>
                <p>Where potential problems with the going concern presumption have been identified, summarise the issue and resolution:</p>
                <form action="<?= base_url()?>auditsystem/c3/saveaa3bp4/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <td><textarea class="form-control" cols="30" rows="15" name="p41" required><?= $bp4['p41'];?></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="15" name="p42" required><?= $bp4['p42'];?></textarea></td>
                        </tr>
                        
                    </table>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>

                <p>On the basis of the work recorded above, I consider that:</p>
                <ul>
                    <li>The financial statements have been correctly prepared on the break-up basis.*</li>
                    <li>The going concern concept is* / is not* correctly applied to this client.</li>
                    <li>There is no concern* / concern* / significant concern* regarding the going concern concept for this client.</li>
                    <li>The notes to the financial statements require* / do not require* additional information regarding the going concern concept.</li>
                    <li>The audit report should be unmodified* / unmodified with a “Material uncertainty related to going concern” paragraph* / qualified with respect to going concern.*</li>
                    <li><i>(If qualification or ”Material uncertainty” paragraph) Consideration has been given as to whether a report to a regulatory authority is required.(* Delete as applicable)</i></li>
                </ul>

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
            <td><textarea class="form-control question" id="question" cols="30" rows="5" name="question[]"></textarea></td>
            <td><textarea class="form-control reference" id="reference" cols="30" rows="5" name="reference[]"></textarea></td>
            <td></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('.tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });


    $('#tbody3').on('click', 'button.remove3', function () {
        $(this).closest('tr').remove();
    });


});
</script>
























