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
                        <h6 class="alert-heading">Failed Registration</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">

                <nav class="nav nav-borders">
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Unadjusted')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c3/manageaa11/un/<?= $code?>/<?= $header?>/<?= $c3tID; ?>">Unadjusted Errors</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Adjusments')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c3/manageaa11/ad/<?= $code?>/<?= $header?>/<?= $c3tID; ?>">Adjustments Made</a>
                </nav>
                <hr class="mt-0 mb-4" />
                <br>

                
                <h4>SUMMARY OF UNADJUSTED ERRORS</h4>
                <p>If, during the assignment, either the aggregate of accumulated misstatements approaches performance materiality, or the nature of identified misstatements indicate that other misstatements may exist which would lead to accumulated misstatements exceeding performance materiality, it shall be determined whether the overall audit strategy and audit plan need to be revised.</p>
                <h6>Objective:</h6>
                <p>This summary of errors is to determine whether any errors, including disclosure errors, which have not yet been corrected (including uncorrected misstatements relating to prior periods), are individually or in total, sufficiently material to warrant correction in the financial statements and to ensure, if appropriate, that they are communicated to the client.  Where applicable, the effect of taxation should also be documented.</p>
                
                <h6>Scope: </h6>
                <p>Either all errors should be recorded on this form or just those over a de minimis level which can be set by the A.E.P. (this should normally be less than or equal to the clearly trivial threshold).</p>
                
                
                <form action="<?= base_url()?>auditsystem/c3/saveaa11ue/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" name="part" value="aa11ue">
                    <table class="table">
                        <tr>
                            <td>Clearly Trivial per Ac13</td>
                            <td>CU</td>
                            <td><input type="text" class="form-control" name="cta" value="<?= $ue['cta']?>"></td>
                        </tr>
                        <tr>
                            <td>Final Performance Materiality per Ac13</td>
                            <td>CU</td>
                            <td><input type="text" class="form-control" name="fpm" value="<?= $ue['fpm']?>"></td>
                        </tr>
                        <tr>
                            <td>Final Materiality per Ac13</td>
                            <td>CU</td>
                            <td><input type="text" class="form-control" name="fma" value="<?= $ue['fma']?>"></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end">Save</button>
                </form>


                <form action="<?= base_url()?>auditsystem/c3/saveaa11un/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" name="part" value="aef">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th colspan="4">Potential Effect on the Financial Statements</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                                <th colspan="2">Performance Statements</th>
                                <th colspan="2">S'ment of Fin. Position</th>
                                <th>Adjust?</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>WP Ref.</th>
                                <th>Account and Description of Error</th>
                                <th>Dr</th>
                                <th>Cr</th>
                                <th>Dr</th>
                                <th>Cr</th>
                                <th>Yes/No</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <th colspan="7">ACTUAL ERRORS - FACTUAL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php 
                                $aef_drps = 0;
                                $aef_crps = 0;
                                $aef_drfp = 0;
                                $aef_crfp = 0;
                                foreach($aef as $r){
                                $aef_drps += $r['drps'];
                                $aef_crps += $r['crps'];
                                $aef_drfp += $r['drfp'];
                                $aef_crfp += $r['crfp'];
                            
                            ?>
                                <tr>
                                    <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td><textarea class="form-control desc" id="desc" cols="30" rows="3" name="desc[]"><?= $r['initials']?></textarea></td>
                                    <td><textarea class="form-control drps" id="drps" cols="30" rows="3" name="drps[]"><?= $r['drps']?></textarea></td>
                                    <td><textarea class="form-control crps" id="crps" cols="30" rows="3" name="crps[]"><?= $r['crps']?></textarea></td>
                                    <td><textarea class="form-control drfp" id="drfp" cols="30" rows="3" name="drfp[]"><?= $r['drfp']?></textarea></td>
                                    <td><textarea class="form-control crfp" id="crfp" cols="30" rows="3" name="crfp[]"><?= $r['crfp']?></textarea></td>
                                    <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                    <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" >Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end">Save</button>
                </form>


                <form action="<?= base_url()?>auditsystem/c3/saveaa11un/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" name="part" value="aej">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th colspan="7">ACTUAL ERRORS - JUDGMENTAL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php
                                $aej_drps = 0;
                                $aej_crps = 0;
                                $aej_drfp = 0;
                                $aej_crfp = 0; 
                                foreach($aej as $r){
                                    $aej_drps += $r['drps'];
                                    $aej_crps += $r['crps'];
                                    $aej_drfp += $r['drfp'];
                                    $aej_crfp += $r['crfp'];        
                            ?>
                                <tr>
                                    <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td><textarea class="form-control desc" id="desc" cols="30" rows="3" name="desc[]"><?= $r['initials']?></textarea></td>
                                    <td><textarea class="form-control drps" id="drps" cols="30" rows="3" name="drps[]"><?= $r['drps']?></textarea></td>
                                    <td><textarea class="form-control crps" id="crps" cols="30" rows="3" name="crps[]"><?= $r['crps']?></textarea></td>
                                    <td><textarea class="form-control drfp" id="drfp" cols="30" rows="3" name="drfp[]"><?= $r['drfp']?></textarea></td>
                                    <td><textarea class="form-control crfp" id="crfp" cols="30" rows="3" name="crfp[]"><?= $r['crfp']?></textarea></td>
                                    <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                    <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" >Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end">Save</button>
                </form>


                <form action="<?= base_url()?>auditsystem/c3/saveaa11un/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" name="part" value="ee">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th colspan="7">EXTRAPOLATED ERRORS</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php 
                                $ee_drps = 0;
                                $ee_crps = 0;
                                $ee_drfp = 0;
                                $ee_crfp = 0; 
                                foreach($ee as $r){
                                    $ee_drps += $r['drps'];
                                    $ee_crps += $r['crps'];
                                    $ee_drfp += $r['drfp'];
                                    $ee_crfp += $r['crfp'];
                            ?>
                                <tr>
                                    <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td><textarea class="form-control desc" id="desc" cols="30" rows="3" name="desc[]"><?= $r['initials']?></textarea></td>
                                    <td><textarea class="form-control drps" id="drps" cols="30" rows="3" name="drps[]"><?= $r['drps']?></textarea></td>
                                    <td><textarea class="form-control crps" id="crps" cols="30" rows="3" name="crps[]"><?= $r['crps']?></textarea></td>
                                    <td><textarea class="form-control drfp" id="drfp" cols="30" rows="3" name="drfp[]"><?= $r['drfp']?></textarea></td>
                                    <td><textarea class="form-control crfp" id="crfp" cols="30" rows="3" name="crfp[]"><?= $r['crfp']?></textarea></td>
                                    <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                    <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" >Add Field</button>
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end">Save</button>
                </form>


                <form action="<?= base_url()?>auditsystem/c3/saveaa11un/<?= $code?>/<?= $header?>/<?= $c3tID?>" method="post">
                    <input type="hidden" name="part" value="de">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th colspan="7">DISCLOSURE ERRORS</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php 
                                $de_drps = 0;
                                $de_crps = 0;
                                $de_drfp = 0;
                                $de_crfp = 0; 
                                foreach($de as $r){
                                    $de_drps += $r['drps'];
                                    $de_crps += $r['crps'];
                                    $de_drfp += $r['drfp'];
                                    $de_crfp += $r['crfp'];
                            ?>
                                <tr>
                                    <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['reference']?></textarea></td>
                                    <td><textarea class="form-control desc" id="desc" cols="30" rows="3" name="desc[]"><?= $r['initials']?></textarea></td>
                                    <td><textarea class="form-control drps" id="drps" cols="30" rows="3" name="drps[]"><?= $r['drps']?></textarea></td>
                                    <td><textarea class="form-control crps" id="crps" cols="30" rows="3" name="crps[]"><?= $r['crps']?></textarea></td>
                                    <td><textarea class="form-control drfp" id="drfp" cols="30" rows="3" name="drfp[]"><?= $r['drfp']?></textarea></td>
                                    <td><textarea class="form-control crfp" id="crfp" cols="30" rows="3" name="crfp[]"><?= $r['crfp']?></textarea></td>
                                    <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                    <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            <?php }?>
                        </tbody>
                                
                        <tfoot>
                            <tr>
                                <td colspan="2">Total Effect of Unadjusted Errors</td>
                                <td><input type="text" class="form-control tdrps" value="<?= $aef_drps + $aej_drps + $ee_drps + $de_drps ?>" readonly></td>
                                <td><input type="text" class="form-control tcrps" value="<?= $aef_crps + $aej_crps + $ee_crps + $de_crps ?>" readonly></td>
                                <td><input type="text" class="form-control tdrfp" value="<?= $aef_drfp + $aej_drfp + $ee_drfp + $de_drfp ?>" readonly></td>
                                <td><input type="text" class="form-control tcrfp" value="<?= $aef_crfp + $aej_crfp + $ee_crfp + $de_crfp ?>" readonly></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
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
            <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"></textarea></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
    });

    
    $('.tbody').on('click', 'button.remove', function () {
        $(this).closest('tr').remove();
    });


});
</script>


















