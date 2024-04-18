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
                <h6>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)</h6>
                <h6> ~ Additional Disclosures for First Time Adopters of IFRS</h6>
                <h6><u>Scope</u></h6>
                <p>This checklist should be completed for all entities that are adopting IFRS for the first time.</p>

                <form action="<?= base_url()?>auditsystem/c3/saveab4a/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" name="part" value="ab4e">
                    <table class="table table-bordered">
                        <thead>
                            <tr>    
                                <th colspan="6"></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th colspan="2">Reference</th>
                                <th>Questions</th>
                                <th>Y/N/NA</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ab4e as $r){?>
                                <tr>
                                    <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td><input type="text" class="form-control" name="num[]" value="<?= $r['extent']?>"></td>
                                    <td><textarea class="form-control question" id="question" cols="30" rows="3" name="question[]"><?= $r['question']?></textarea></td>
                                    <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                    <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" >Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end">Save</button>
                </form>































           
           
           
           
            </div>
        </div>
    </div>
    
</main>


<script>
$(document).ready(function () {

    $('.add-field').on('click', function () {
        // Adding a row inside the tbody.
        var form = $(this).closest('form');
        var tbody = form.find('tbody');
        tbody.append(`
        <tr>
            <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"></textarea></td>
            <td><input type="text" class="form-control" name="num[]"></td>
            <td><textarea class="form-control question" id="question" cols="30" rows="3" name="question[]"></textarea></td>
            <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"></textarea></td>
            <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"></textarea></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('.tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });


});
</script>






