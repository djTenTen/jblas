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

                <nav class="nav nav-borders">
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Aa11-un')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.10 Aa11-un/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Unadjusted Errors</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Aa11-ad')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.10 Aa11-ad/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Adjustments Made</a>
                </nav>
                <hr class="mt-0 mb-4" />
                <br>

                
                <h4>SUMMARY OF UNADJUSTED ERRORS</h4>
                <p>If, during the assignment, either the aggregate of accumulated misstatements approaches performance materiality, or the nature of identified misstatements indicate that other misstatements may exist which would lead to accumulated misstatements exceeding performance materiality, it shall be determined whether the overall audit strategy and audit plan need to be revised.</p>
                <h6>Objective:</h6>
                <p>This summary of errors is to determine whether any errors, including disclosure errors, which have not yet been corrected (including uncorrected misstatements relating to prior periods), are individually or in total, sufficiently material to warrant correction in the financial statements and to ensure, if appropriate, that they are communicated to the client.  Where applicable, the effect of taxation should also be documented.</p>
                
                <h6>Scope: </h6>
                <p>Either all errors should be recorded on this form or just those over a de minimis level which can be set by the A.E.P. (this should normally be less than or equal to the clearly trivial threshold).</p>
                
                
                <form action="<?= base_url()?>auditsystem/client/saveaa11ue/3.10 Aa11/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                    <input type="hidden" name="part" value="aa11ue">
                    <input type="hidden" name="acid" value="<?= $ueacID?>">
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
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>


                <form action="<?= base_url()?>auditsystem/client/saveaa11un/3.10 Aa11/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
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
                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>


                <form action="<?= base_url()?>auditsystem/client/saveaa11un/3.10 Aa11/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
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
                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>


                <form action="<?= base_url()?>auditsystem/client/saveaa11un/3.10 Aa11/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
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
                    <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>


                <form action="<?= base_url()?>auditsystem/client/saveaa11un/3.10 Aa11/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
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
                        <button class="btn btn-primary btn-sm m-1 float-end add-field" type="button" ><i class="fas fa-plus-square m-1"></i> Add Field</button>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>

                </form>
                
                <br><br>
                <form action="<?= base_url()?>auditsystem/client/saveaa11con/3.10 Aa11/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                    <input type="hidden" name="part" value="con">
                    <input type="hidden" name="acid" value="<?= $conacID?>">
                    <table class="table table-bordered table-sm" id="myTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th colspan="4">Potential Effect on the Financial Statements</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th colspan="2">Performance Statements</th>
                                <th colspan="2">S\'ment of Fin. Position</th>
                            </tr>
                            <tr>
                                <th>WP Ref.</th>
                                <th>Details</th>
                                <th>Dr</th>
                                <th>Cr</th>
                                <th>Dr</th>
                                <th>Cr</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>B DIV</td>
                                <td>Intangibles and goodwill</td>
                                <td><input type="text" class="form-control" name="bdr1" value="<?= $con['bdr1']?>"></td>
                                <td><input type="text" class="form-control" name="bcr1" value="<?= $con['bcr1']?>"></td>
                                <td><input type="text" class="form-control" name="bdr2" value="<?= $con['bdr2']?>"></td>
                                <td><input type="text" class="form-control" name="bcr2" value="<?= $con['bcr2']?>"></td>
                            </tr>
                            <tr>
                                <td>C DIV</td>
                                <td>Property, plant and equipment</td>
                                <td><input type="text" class="form-control" name="cdr1" value="<?= $con['cdr1']?>"></td>
                                <td><input type="text" class="form-control" name="ccr1" value="<?= $con['ccr1']?>"></td>
                                <td><input type="text" class="form-control" name="cdr2" value="<?= $con['cdr2']?>"></td>
                                <td><input type="text" class="form-control" name="ccr2" value="<?= $con['ccr2']?>"></td>
                            </tr>
                            <tr>
                                <td>D/G DIV</td>
                                <td>Investments</td>
                                <td><input type="text" class="form-control" name="ddr1" value="<?= $con['ddr1']?>"></td>
                                <td><input type="text" class="form-control" name="dcr1" value="<?= $con['dcr1']?>"></td>
                                <td><input type="text" class="form-control" name="ddr2" value="<?= $con['ddr2']?>"></td>
                                <td><input type="text" class="form-control" name="dcr2" value="<?= $con['dcr2']?>"></td>
                            </tr>
                            <tr>
                                <td>E DIV</td>
                                <td>Inventories</td>
                                <td><input type="text" class="form-control" name="edr1" value="<?= $con['edr1']?>"></td>
                                <td><input type="text" class="form-control" name="ecr1" value="<?= $con['ecr1']?>"></td>
                                <td><input type="text" class="form-control" name="edr2" value="<?= $con['edr2']?>"></td>
                                <td><input type="text" class="form-control" name="ecr2" value="<?= $con['ecr2']?>"></td>
                            </tr>
                            <tr>
                                <td>F DIV</td>
                                <td>Receivables</td>
                                <td><input type="text" class="form-control" name="fdr1" value="<?= $con['fdr1']?>"></td>
                                <td><input type="text" class="form-control" name="fcr1" value="<?= $con['fcr1']?>"></td>
                                <td><input type="text" class="form-control" name="fdr2" value="<?= $con['fdr2']?>"></td>
                                <td><input type="text" class="form-control" name="fcr2" value="<?= $con['fcr2']?>"></td>
                            </tr>
                            <tr>
                                <td>H DIV</td>
                                <td>Cash at bank and in hand</td>
                                <td><input type="text" class="form-control" name="hdr1" value="<?= $con['hdr1']?>"></td>
                                <td><input type="text" class="form-control" name="hcr1" value="<?= $con['hcr1']?>"></td>
                                <td><input type="text" class="form-control" name="hdr2" value="<?= $con['hdr2']?>"></td>
                                <td><input type="text" class="form-control" name="hcr2" value="<?= $con['hcr2']?>"></td>
                            </tr>
                            <tr>
                                <td>I DIV</td>
                                <td>Payables</td>
                                <td><input type="text" class="form-control" name="idr1" value="<?= $con['idr1']?>"></td>
                                <td><input type="text" class="form-control" name="icr1" value="<?= $con['icr1']?>"></td>
                                <td><input type="text" class="form-control" name="idr2" value="<?= $con['idr2']?>"></td>
                                <td><input type="text" class="form-control" name="icr2" value="<?= $con['icr2']?>"></td>
                            </tr>
                            <tr>
                                <td>J DIV</td>
                                <td>Taxation</td>
                                <td><input type="text" class="form-control" name="jdr1" value="<?= $con['jdr1']?>"></td>
                                <td><input type="text" class="form-control" name="jcr1" value="<?= $con['jcr1']?>"></td>
                                <td><input type="text" class="form-control" name="jdr2" value="<?= $con['jdr2']?>"></td>
                                <td><input type="text" class="form-control" name="jcr2" value="<?= $con['jcr2']?>"></td>
                            </tr>
                            <tr>
                                <td>L DIV</td>
                                <td>Provisions</td>
                                <td><input type="text" class="form-control" name="ldr1" value="<?= $con['ldr1']?>"></td>
                                <td><input type="text" class="form-control" name="lcr1" value="<?= $con['lcr1']?>"></td>
                                <td><input type="text" class="form-control" name="ldr2" value="<?= $con['ldr2']?>"></td>
                                <td><input type="text" class="form-control" name="lcr2" value="<?= $con['lcr2']?>"></td>
                            </tr>
                            <tr>
                                <td>M DIV</td>
                                <td>Equity</td>
                                <td><input type="text" class="form-control" name="mdr1" value="<?= $con['mdr1']?>"></td>
                                <td><input type="text" class="form-control" name="mcr1" value="<?= $con['mcr1']?>"></td>
                                <td><input type="text" class="form-control" name="mdr2" value="<?= $con['mdr2']?>"></td>
                                <td><input type="text" class="form-control" name="mcr2" value="<?= $con['mcr2']?>"></td>
                            </tr>
                            <tr>
                                <td>O DIV</td>
                                <td>Revenue</td>
                                <td><input type="text" class="form-control" name="odr1" value="<?= $con['odr1']?>"></td>
                                <td><input type="text" class="form-control" name="ocr1" value="<?= $con['ocr1']?>"></td>
                                <td><input type="text" class="form-control" name="odr2" value="<?= $con['odr2']?>"></td>
                                <td><input type="text" class="form-control" name="ocr2" value="<?= $con['ocr2']?>"></td>
                            </tr>
                            <tr>
                                <td>P DIV</td>
                                <td>Direct costs</td>
                                <td><input type="text" class="form-control" name="pdr1" value="<?= $con['pdr1']?>"></td>
                                <td><input type="text" class="form-control" name="pcr1" value="<?= $con['pcr1']?>"></td>
                                <td><input type="text" class="form-control" name="pdr2" value="<?= $con['pdr2']?>"></td>
                                <td><input type="text" class="form-control" name="pcr2" value="<?= $con['pcr2']?>"></td>
                            </tr>
                            <tr>
                                <td>Q DIV</td>
                                <td>Other income and gains</td>
                                <td><input type="text" class="form-control" name="qdr1" value="<?= $con['qdr1']?>"></td>
                                <td><input type="text" class="form-control" name="qcr1" value="<?= $con['qcr1']?>"></td>
                                <td><input type="text" class="form-control" name="qdr2" value="<?= $con['qdr2']?>"></td>
                                <td><input type="text" class="form-control" name="qcr2" value="<?= $con['qcr2']?>"></td>
                            </tr>
                            <tr>
                                <td>R DIV</td>
                                <td>Other expenditure and losses</td>
                                <td><input type="text" class="form-control" name="rdr1" value="<?= $con['rdr1']?>"></td>
                                <td><input type="text" class="form-control" name="rcr1" value="<?= $con['rcr1']?>"></td>
                                <td><input type="text" class="form-control" name="rdr2" value="<?= $con['rdr2']?>"></td>
                                <td><input type="text" class="form-control" name="rcr2" value="<?= $con['rcr2']?>"></td>
                            </tr>
                        </tbody>
                        
                    </table>
                    <table class="table table-bordered table-sm">
                        <tfoot>
                            <tr>
                                <td colspan="2">Total Effect of Unadjusted Errors</td>
                                <td><input type="text" class="form-control conc3" value="" readonly></td>
                                <td><input type="text" class="form-control conc4" value="" readonly></td>
                                <td><input type="text" class="form-control conc5" value="" readonly></td>
                                <td><input type="text" class="form-control conc6" value="" readonly></td>
                            </tr>
                        </tfoot>
                    </table>

                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>









            </div>
        </div>
    </div>
    
</main>
<script>
$(document).ready(function () {

    var totalColumn3 = 0;
    var totalColumn4 = 0;
    var totalColumn5 = 0;
    var totalColumn6 = 0;

    $('#myTable tr').each(function() {

        // Find input elements in columns 3, 4, 5, and 6 within the current row
        var inputs = $(this).find('td:nth-child(3) input, td:nth-child(4) input, td:nth-child(5) input, td:nth-child(6) input');
        // Iterate over the input elements and accumulate their values for each column
        inputs.each(function() {

            console.log(inputs);
            var value = parseFloat($(this).val()) || 0;
            if ($(this).closest('td').index() === 2) { // Column 3
                totalColumn3 += value;
            } else if ($(this).closest('td').index() === 3) { // Column 4
                totalColumn4 += value;
            } else if ($(this).closest('td').index() === 4) { // Column 5
                totalColumn5 += value;
            } else if ($(this).closest('td').index() === 5) { // Column 6
                totalColumn6 += value;
            }
        });

        $('.conc3').attr('value', totalColumn3);
        $('.conc4').attr('value', totalColumn4);
        $('.conc5').attr('value', totalColumn5);
        $('.conc6').attr('value', totalColumn6);
    });

    $('#myTable').on('change', function() {

        var totalColumn3 = 0;
        var totalColumn4 = 0;
        var totalColumn5 = 0;
        var totalColumn6 = 0;

        $('#myTable tr').each(function() {

            // Find input elements in columns 3, 4, 5, and 6 within the current row
            var inputs = $(this).find('td:nth-child(3) input, td:nth-child(4) input, td:nth-child(5) input, td:nth-child(6) input');
            // Iterate over the input elements and accumulate their values for each column
            inputs.each(function() {

                console.log(inputs);
                var value = parseFloat($(this).val()) || 0;
                if ($(this).closest('td').index() === 2) { // Column 3
                    totalColumn3 += value;
                } else if ($(this).closest('td').index() === 3) { // Column 4
                    totalColumn4 += value;
                } else if ($(this).closest('td').index() === 4) { // Column 5
                    totalColumn5 += value;
                } else if ($(this).closest('td').index() === 5) { // Column 6
                    totalColumn6 += value;
                }
            });

            $('.conc3').attr('value', totalColumn3);
            $('.conc4').attr('value', totalColumn4);
            $('.conc5').attr('value', totalColumn5);
            $('.conc6').attr('value', totalColumn6);
        });
    });
    

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


















