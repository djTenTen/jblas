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
                
                <h4>MANAGEMENT LETTER WORKSHEET [INTERIM / FINAL AUDIT]</h4>
                <form action="<?= base_url()?>auditsystem/c3/saveaa5b/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" name="part" value="aa5b">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SchRef.</th>
                                <th>Issues Identified </th>
                                <th>Client’s Comments</th>
                                <th>Recommendations</th>
                                <th>To be Included in Management Letter YES / NO</th>
                                <th>Results of Follow up at Next Audit Visit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        <?php foreach($aa5b as $r){?>
                            <tr>
                                <td><textarea class="form-control reference" id="reference" cols="30" rows="5" name="reference[]"><?= $r['reference']?></textarea></td>
                                <td><textarea class="form-control issue" id="issue" cols="30" rows="5" name="issue[]"><?= $r['issue']?></textarea></td>
                                <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="comment[]"><?= $r['comment']?></textarea></td>
                                <td><textarea class="form-control recommendation" id="recommendation" cols="30" rows="5" name="recommendation[]"><?= $r['recommendation']?></textarea></td>
                                <td><textarea class="form-control yesno" id="yesno" cols="30" rows="5" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                <td><textarea class="form-control result" id="result" cols="30" rows="5" name="result[]"><?= $r['result']?></textarea></td>
                                <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                <td></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>

                    <button class="btn btn-primary btn-sm m-1 float-end" type="button" data-action="add-field" id="add-field"><i class="fas fa-plus-square m-1"></i>Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>

                <p>This should cover weaknesses in the accounting system and control environment plus comments on the qualitative aspects of the financial statements and the appropriateness of the accounting policies and estimation techniques adopted by the client.</p>
                <p>All significant issues should be included in the management letter.  For other issues verbal communication is adequate.  If there are no significant issues then this can be confirmed in a “voluntary” management letter or alternatively, the letter of representation can note that a management letter is not necessary ~ note, however, that this is likely to be a rare occurrence when applying IFRS.</p>
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
            <td><textarea class="form-control reference" id="reference" cols="30" rows="5" name="reference[]"></textarea></td>
            <td><textarea class="form-control issue" id="issue" cols="30" rows="5" name="issue[]"></textarea></td>
            <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="comment[]"></textarea></td>
            <td><textarea class="form-control recommendation" id="recommendation" cols="30" rows="5" name="recommendation[]"></textarea></td>
            <td><textarea class="form-control yesno" id="yesno" cols="30" rows="5" name="yesno[]"></textarea></td>
            <td><textarea class="form-control result" id="result" cols="30" rows="5" name="result[]"></textarea></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    $('#tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });



});
</script>

















