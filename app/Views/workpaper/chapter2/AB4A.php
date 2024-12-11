<?php  $crypt = \Config\Services::encrypter();?>
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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/wp/viewpdfc2/')?><?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>PERMANENT FILE DIVIDERS</h4>
                    <p>REVIEW DETAILS</p>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c2/saveab4a/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="rd">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Year to</th>
                                    <th>Prepared by</th>
                                    <th>Date</th>
                                    <th>Reviewed By</th>
                                    <th>Date</th>
                                    <th style="width: 7%;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody1" class="tbody">
                                <?php foreach ($ab4a as $r) { ?>
                                    <tr>
                                        <td><input class="form-control" type="number" name="yearto[]" id="" value="<?= $r['field1']?>"></td>
                                        <td><input class="form-control" type="text" name="preparedby[]" id="" value="<?= $r['field2']?>"></td>
                                        <td><input class="form-control" type="date" name="date1[]" id="" value="<?= $r['field3']?>"></td>
                                        <td><input class="form-control" type="text" name="reviewedby[]" id="" value="<?= $r['field4']?>"></td>
                                        <td><input class="form-control" type="date" name="date2[]" id="" value="<?= $r['field5']?>"></td>
                                        <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm m-1 float-end" type="button" id="add-field1"><i class="fas fa-plus-square m-1"></i>Add Field</button>
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
        $('.tbody').on('click', 'button.remove', function () {
            $(this).closest('tr').remove();
        });
        $('#add-field1').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody1').append(`
                <tr>
                    <td><input class="form-control" type="number" name="yearto[]" id=""></td>
                    <td><input class="form-control" type="text" name="preparedby[]" id=""></td>
                    <td><input class="form-control" type="date" name="date1[]" id=""></td>
                    <td><input class="form-control" type="text" name="reviewedby[]" id=""></td>
                    <td><input class="form-control" type="date" name="date2[]" id=""></td>
                    <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                </tr>`);
        });
    });
</script>