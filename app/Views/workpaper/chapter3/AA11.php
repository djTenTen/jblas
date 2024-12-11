<?php  
    function encr($ecr){
        $crypt = \Config\Services::encrypter();
        return str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ecr));
    }
?>
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            <?= $name?>
                        </h1>
                        <div class="page-header-subtitle"><?= $title?></div>
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
            <?php if (session()->get('success')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success!</h6>
                        <?= session()->get('success')?>
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Error!</h6>
                        <?= session()->get('failed')?>
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/wp/viewpdfc3/')?><?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>AUDITOR’S OBJECTIVE:</h4>
                    <ol type="a">The objectives of the auditor, having read the other information, are
                        <li>)To consider whether there is a material inconsistency between the other information and the financial statements;</li>
                        <li>)To consider whether there is a material inconsistency between the other information and the auditor’s knowledge obtained in the audit;</li>
                        <li>)To respond appropriately when the auditor identifies that such material inconsistencies appear to exist, or when the auditor otherwise becomes aware that other information appears to be materially misstated; and</li>
                        <li>)To report in accordance with this PSA.</li>
                    </ol>
                    <h4>AUDIT PROCEDURES</h4>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveaa11/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="aa11">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">Nature of Matter Giving Rise to the Modification</th>
                                    <th colspan="2">Auditor's Judgment about the Pervasiveness of the Effects or Possible Effects on the Financial Statements.</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Material but Not Pervasive</th>
                                    <th>Material and Pervasive</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php foreach($a11 as $r){?>
                                    <tr>
                                        <td><textarea class="form-control matter" id="reference" cols="30" rows="5" name="matter[]"><?= $r['field1']?></textarea></td>
                                        <td><textarea class="form-control notperv" id="issue" cols="30" rows="5" name="notperv[]"><?= $r['field2']?></textarea></td>
                                        <td><textarea class="form-control perv" id="comment" cols="30" rows="5" name="perv[]"><?= $r['field3']?></textarea></td>
                                        <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>

                        <button class="btn btn-primary btn-sm m-1 float-end" type="button" data-action="add-field" id="add-field"><i class="fas fa-plus-square m-1"></i>Add Field</button>
                        <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>
<script>
$(document).ready(function () {
    
    $('#add-field').on('click', function () {
        // Adding a row inside the tbody.
        $('#tbody').append(`
        <tr>
            <td><textarea class="form-control matter" id="reference" cols="30" rows="5" name="matter[]"></textarea></td>
            <td><textarea class="form-control notperv" id="issue" cols="30" rows="5" name="notperv[]"></textarea></td>
            <td><textarea class="form-control perv" id="comment" cols="30" rows="5" name="perv[]"></textarea></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('#tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });



});
</script>
