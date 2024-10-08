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
                <nav class="nav nav-borders">
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Aa11-un')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.10 Aa11-un/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Unadjusted Errors</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Aa11-ad')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.10 Aa11-ad/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Adjustments Made</a>
                </nav>
                <hr class="mt-0 mb-4" style="color: #7752FE;"/>
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/wp/viewpdfc3/')?><?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <div class="m-5">
                    <h4><?= $sectiontitle?></h4>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveaa11ad/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2"></th>
                                    <th colspan="4">Amendments to Client's Draft Financial Statements</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="2"></th>
                                    <th colspan="2">Performance Statements</th>
                                    <th colspan="2">S'ment of Fin. Position</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>WP Ref.</th>
                                    <th>Account and Description of Adjustment</th>
                                    <th>Dr</th>
                                    <th>Cr</th>
                                    <th>Dr</th>
                                    <th>Cr</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php 
                                    $drps = 0;
                                    $crps = 0;
                                    $drfp = 0;
                                    $crfp = 0; 
                                    foreach($ad as $r){
                                        $drps += $r['drps'];
                                        $crps += $r['crps'];
                                        $drfp += $r['drfp'];
                                        $crfp += $r['crfp'];
                                ?>
                                    <tr>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                        <td><textarea class="form-control desc" id="desc" cols="30" rows="3" name="desc[]"><?= $r['initials']?></textarea></td>
                                        <td><textarea class="form-control drps" id="drps" cols="30" rows="3" name="drps[]"><?= $r['drps']?></textarea></td>
                                        <td><textarea class="form-control crps" id="crps" cols="30" rows="3" name="crps[]"><?= $r['crps']?></textarea></td>
                                        <td><textarea class="form-control drfp" id="drfp" cols="30" rows="3" name="drfp[]"><?= $r['drfp']?></textarea></td>
                                        <td><textarea class="form-control crfp" id="crfp" cols="30" rows="3" name="crfp[]"><?= $r['crfp']?></textarea></td>
                                        <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Total Effect of Unadjusted Errors</td>
                                    <td><input type="text" class="form-control tdrps" value="<?= $drps?>" readonly></td>
                                    <td><input type="text" class="form-control tcrps" value="<?= $crps?>" readonly></td>
                                    <td><input type="text" class="form-control tdrfp" value="<?= $drfp?>" readonly></td>
                                    <td><input type="text" class="form-control tcrfp" value="<?= $crfp?>" readonly></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveaa11uead/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="aa11uead">
                        <input type="hidden" name="acid" value="<?= $ueacID?>">
                        <table class="table">
                            <tr>
                                <td>Profit (Loss) for the Period per Draft Financial Statements</td>
                                <td>CU</td>
                                <td><input type="text" class="form-control" name="pl" value="<?= $ue['pl']?>"></td>
                            </tr>
                            <tr>
                                <td>Net Adjustments Made by Auditors to Client's Draft Figures</td>
                                <td>CU</td>
                                <td><input type="text" class="form-control" name="na" value="<?= $ue['na']?>"></td>
                            </tr>
                            <tr>
                                <td>Profit (Loss)  for the Period per Final Financial Statements</td>
                                <td>CU</td>
                                <td><input type="text" class="form-control" name="pl2" value="<?= $ue['pl2']?>"></td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
</main>
<script>
$(document).ready(function () {
    $('.drps').on('change', function () {
        // Adding a row inside the tbody.
        var total = 0;
        $('.drps').each(function() {
            var value = $(this).val();
            var numericValue = parseFloat(value);
            total += numericValue;
        });
        $('.tdrps').attr('value', total);
    });
    $('.crps').on('change', function () {
        // Adding a row inside the tbody.
        var total = 0;
        $('.crps').each(function() {
            var value = $(this).val();
            var numericValue = parseFloat(value);
            total += numericValue;
        });
        $('.tcrps').attr('value', total);
    });
    $('.drfp').on('change', function () {
        // Adding a row inside the tbody.
        var total = 0;
        $('.drfp').each(function() {
            var value = $(this).val();
            var numericValue = parseFloat(value);
            total += numericValue;
        });
        $('.tdrfp').attr('value', total);
    });
    $('.crfp').on('change', function () {
        // Adding a row inside the tbody.
        var total = 0;
        $('.crfp').each(function() {
            var value = $(this).val();
            var numericValue = parseFloat(value);
            total += numericValue;
        });
        $('.tcrfp').attr('value', total);
    });
    $('.add-field').on('click', function () {
        // Adding a row inside the tbody.
        var form = $(this).closest('form');
        var tbody = form.find('tbody');
        tbody.append(`
        <tr>
            <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"></textarea></td>
            <td><textarea class="form-control desc" id="desc" cols="30" rows="3" name="desc[]"></textarea></td>
            <td><textarea class="form-control drps" id="drps" cols="30" rows="3" name="drps[]"></textarea></td>
            <td><textarea class="form-control crps" id="crps" cols="30" rows="3" name="crps[]"></textarea></td>
            <td><textarea class="form-control drfp" id="drfp" cols="30" rows="3" name="drfp[]"></textarea></td>
            <td><textarea class="form-control crfp" id="crfp" cols="30" rows="3" name="crfp[]"></textarea></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });
    $('.tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });
});
</script>


















