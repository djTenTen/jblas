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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $code?>/<?= $c1tID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>ASSESSMENT OF MATERIALITY (INCLUDING PERFORMANCE MATERIALITY)</h4>
                    <p>OBJECTIVE: To assess materiality for the financial statements as a whole, performance materiality and other quantitative benchmarks based on materiality, which will reduce the risk of material misstatements in the financial statements to an acceptable level.</p>
                    <h4>OVERALL MATERIALITY</h4>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c1/saveac8/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $name?>" method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Benchmarks</th>
                                    <th>Planning 3</th>
                                    <th>Finalisation</th>
                                    <th>%</th>
                                    <th>Planning CU</th>
                                    <th>Finalisation CU</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Revenue</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($revp['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control revp" name="question[]" value="<?= $revp['question']?>">
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($revf['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control revf" name="question[]" value="<?= $revf['question']?>">
                                    </td>
                                    <td>1%</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($revpr['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control revpr" name="question[]" value="<?= $revpr['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($revfr['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control revfr" name="question[]" value="<?= $revfr['question']?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Profit Before Tax 2</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($prop['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control prop" name="question[]" value="<?= $prop['question']?>">
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($prof['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control prof" name="question[]" value="<?= $prof['question']?>">
                                    </td>
                                    <td>10%</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($propr['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control propr" name="question[]" value="<?= $propr['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($profr['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control profr" name="question[]" value="<?= $profr['question']?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gross Assets</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($grop['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control grop" name="question[]" value="<?= $grop['question']?>">
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($grof['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control grof" name="question[]" value="<?= $grof['question']?>">
                                    </td>
                                    <td>2%</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($gropr['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control gropr" name="question[]" value="<?= $gropr['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($grofr['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control grofr" name="question[]" value="<?= $grofr['question']?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Select the most appropriate benchmark for this entity</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($pcu['acID'])?>" name="acid[]">
                                        <select name="question[]" id="" class="form-control form-select pcu">
                                            <option value="<?= $pcu['question']?>" selected>
                                            <?php
                                                switch ($pcu['question']) {
                                                    case 'r':echo 'Revenue';break;
                                                    case 'pbt':echo 'Profit Before Tax';break;
                                                    case 'ga':echo 'Gross Assets';break;
                                                    case 'se':echo 'Something Else';break;
                                                    default:echo 'Select from Planning';break;
                                                }
                                            ?></option>
                                            <option value="r">Revenue</option>
                                            <option value="pbt">Profit Before Tax</option>
                                            <option value="ga">Gross Assets</option>
                                            <option value="se">Something Else</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($fcu['acID'])?>" name="acid[]">
                                        <select name="question[]" id="" class="form-control form-select fcu">
                                            <option value="<?= $fcu['question']?>" selected>
                                            <?php
                                                switch ($fcu['question']) {
                                                    case 'r':echo 'Revenue';break;
                                                    case 'pbt':echo 'Profit Before Tax';break;
                                                    case 'ga':echo 'Gross Assets';break;
                                                    case 'se':echo 'Something Else';break;
                                                    default:echo 'Select from Planning';break;
                                                }
                                            ?></option>
                                            <option value="r">Revenue</option>
                                            <option value="pbt">Profit Before Tax</option>
                                            <option value="ga">Gross Assets</option>
                                            <option value="se">Something Else</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5"><h6>JUSTIFY THE USE OF THE BENCHMARK SELECTED ABOVE (Notes 4 and 5) </h6></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="6"> 
                                        <input type="hidden" value="<?= $crypt->encrypt($justn45['acID'])?>" name="acid[]">
                                        <textarea class="form-control" cols="30" rows="5" name="question[]"><?= $justn45['question']?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4"><h6>Initial suggested Materiality Level:</h6></td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($pcur['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control pcur" name="question[]" value="<?= $pcur['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($fcur['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control fcur" name="question[]" value="<?= $fcur['question']?>" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4"><p>If any adjustments are required to initial materiality level, detail these here (Note 6) :</p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <input type="hidden" value="<?= $crypt->encrypt($adja['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control adja" name="question[]" value="<?= $adja['question']?>" >
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($adjap['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control adjap" name="question[]" value="<?= $adjap['question']?>" >
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($adjaf['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control adjaf" name="question[]" value="<?= $adjaf['question']?>" >
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <input type="hidden" value="<?= $crypt->encrypt($adjb['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control adjb" name="question[]" value="<?= $adjb['question']?>" >
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($adjbp['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control adjbp" name="question[]" value="<?= $adjbp['question']?>" >
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($adjbf['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control adjbf" name="question[]" value="<?= $adjbf['question']?>" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <input type="hidden" value="<?= $crypt->encrypt($adjc['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control adjc" name="question[]" value="<?= $adjc['question']?>" >
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($adjcp['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control adjcp" name="question[]" value="<?= $adjcp['question']?>" >
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($adjcf['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control adjcf" name="question[]" value="<?= $adjcf['question']?>" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6"><p>NB: adjustments need to be mutiplied by the appropriate benchmark percentage</p></td>      
                                </tr>
                                <tr>
                                    <td colspan="4"><h6>Assessed Overall Materiality</h6></td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($aomp['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control aomp" name="question[]" value="<?= $aomp['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($aomf['acID'])?>" name="acid[]">
                                        <input type="number" class="form-control aomf" name="question[]" value="<?= $aomf['question']?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><p>Materiality Level for previous period (for information only):</p></td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($mlpinfo['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control mlpinfo" name="question[]" value="<?= $mlpinfo['question']?>" >
                                    </td>
                                    <td></td> 
                                </tr>

                                <tr>
                                    <td colspan="6"><h6>Conclusion at planning stage</h6></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><p>The overall materiality level calculated above is deemed to be appropriate because:</p></td>
                                </tr>
                                <tr>
                                    <td colspan="6"> 
                                        <input type="hidden" value="<?= $crypt->encrypt($conplst['acID'])?>" name="acid[]">
                                        <textarea class="form-control" cols="30" rows="5" name="question[]"><?= $conplst['question']?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="6">
                                        <h6>Conclusion at finalisation stage</h6>
                                        <p>Document reasons for any revision to the materiality assessed at planning stage and the impact on the audit procedures undertaken:</p>
                                        <input type="hidden" value="<?= $crypt->encrypt($confnst['acID'])?>" name="acid[]">
                                        <textarea class="form-control" cols="30" rows="5" name="question[]"><?= $confnst['question']?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6"><h4>PERFORMANCE MATERIALITY</h4></td>
                                </tr>

                                <tr>
                                    <td colspan="4">Select Overall Inherent Risk (Low / Medium / High):</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($oirp['acID'])?>" name="acid[]">
                                        <select name="question[]" id="" class="form-control form-select oirp">
                                            <option value="<?= $oirp['question']?>" selected><?= $oirp['question']?></option>
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($oirf['acID'])?>" name="acid[]">
                                        <select name="question[]" id="" class="form-control form-select oirf">
                                            <option value="<?= $oirf['question']?>" selected><?= $oirf['question']?></option>
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                        </select>
                                    </td> 
                                </tr>
                                <tr>
                                    <td colspan="4">Performance Materiality Percentage (Note 7):</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($pmpp['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control pmpp" name="question[]" value="<?= $pmpp['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($pmpf['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control pmpf" name="question[]" value="<?= $pmpf['question']?>" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4">Assessed Performance Materiality</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($apmp['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control apmp" name="question[]" value="<?= $apmp['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($apmf['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control apmf" name="question[]" value="<?= $apmf['question']?>" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="6">
                                        <h6>Conclusion at planning stage</h6>
                                        <p>The performance materiality level calculated above is deemed to be appropriate because:</p>
                                        <input type="hidden" value="<?= $crypt->encrypt($conplst2['acID'])?>" name="acid[]">
                                        <textarea class="form-control" cols="30" rows="5" name="question[]"><?= $conplst2['question']?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="6">
                                        <h6>Conclusion at finalisation stage</h6>
                                        <p>Document reasons for any revision to the perfomance materiality assessed at planning stage and the impact on the audit procedures undertaken:</p>
                                        <input type="hidden" value="<?= $crypt->encrypt($confnst2['acID'])?>" name="acid[]">
                                        <textarea class="form-control" cols="30" rows="5" name="question[]"><?= $confnst2['question']?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="6"><h4>CLEARLY TRIVIAL</h4></td>
                                </tr>
                                <tr>
                                    <td colspan="3">Level at which errors are considered trivial (Note 8)</td>
                                    <td>1%</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($ctp['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control ctp" name="question[]" value="<?= $ctp['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($ctf['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control ctf" name="question[]" value="<?= $ctf['question']?>" readonly>
                                    </td>
                                </tr>rsp

                                <tr>
                                    <td colspan="6">
                                        <h6>Document reasons for any revision to the suggested percentage </h6>
                                        <input type="hidden" value="<?= $crypt->encrypt($rsp['acID'])?>" name="acid[]">
                                        <textarea class="form-control" cols="30" rows="5" name="question[]"><?= $rsp['question']?></textarea>
                            
                                    </td>
                                </tr>

                                <tr>

                                    <td colspan="6">
                                        <h6>SPECIFIC PERFORMANCE MATERIALITY LEVELS FOR CLASSES OF TRANSACTIONS, ACCOUNT BALANCES OR DISCLOSURES (Notes 9 and 10):</h6>
                                        <p>Factors that may indicate the existence of one or more particular classes of transactions, account balances or disclosures for which a lower level of materiality should be applied include the following:</p>
                                        
                                        <ul>
                                            <li>Related party transactions and compensation of key management personnel;</li>
                                            <li>Key disclosures in relation to the industry in which the entity operates;</li>
                                            <li>Particular focus on specific disclosures (such as business combinations);</li>
                                            <li>Accounting estimates.</li>
                                        </ul>
                                        <p>Document below the materiality levels to be applied to the relevant classes of transactions, account balances or disclosures. </p>
                                        <p>The auditor may find it useful to get the views and expectations of the client here.</p>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="6"><h6>Other levels of performance materiality to be applied:</h6></td>
                                </tr>
                                <tr>
                                    <td colspan="3">Related party transactions and Remuneration of key management</td>
                                    <td>5%</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($rptp['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control rptp" name="question[]" value="<?= $rptp['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($rptf['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control rptf" name="question[]" value="<?= $rptf['question']?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">Accounting estimates</td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($aest['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control aest" name="question[]" value="<?= $aest['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($aestp['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control aestp" name="question[]" value="<?= $aestp['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($aestf['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control aestf" name="question[]" value="<?= $aestf['question']?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <input type="hidden" value="<?= $crypt->encrypt($itbdae1['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control" name="question[]" value="<?= $itbdae1['question']?>">
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($itbd1['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control itbd1" name="question[]" value="<?= $itbd1['question']?>" >
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($itbd1p['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control itbd1p" name="question[]" value="<?= $itbd1p['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($itbd1f['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control itbd1f" name="question[]" value="<?= $itbd1f['question']?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <input type="hidden" value="<?= $crypt->encrypt($itbdae2['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control" name="question[]" value="<?= $itbdae2['question']?>">
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($itbd2['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control itbd2" name="question[]" value="<?= $itbd2['question']?>" >
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($itbd2p['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control itbd2p" name="question[]" value="<?= $itbd2p['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($itbd2f['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control itbd2f" name="question[]" value="<?= $itbd2f['question']?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <input type="hidden" value="<?= $crypt->encrypt($itbdae3['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control" name="question[]" value="<?= $itbdae3['question']?>">
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($itbd3['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control itbd3" name="question[]" value="<?= $itbd3['question']?>" >
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($itbd3p['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control itbd3p" name="question[]" value="<?= $itbd3p['question']?>" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="<?= $crypt->encrypt($itbd3f['acID'])?>" name="acid[]">
                                        <input type="text" class="form-control itbd3f" name="question[]" value="<?= $itbd3f['question']?>" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="6">
                                        <h6>Definition per PSA 320.9:</h6>
                                        <p>Performance materiality - For the purposes of the ISAs, performance materiality means the amount or amounts set by the auditor at less than materiality for the financial statements as a whole to reduce to an acceptably low level the probability that the aggregate of uncorrected and undetected misstatements exceeds materiality for the financial statements as a whole.  If applicable, performance materiality also refers to the amount or amounts set by the auditor at less than the materiality level or levels for particular classes of transactions, account balances or disclosures.</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="6">
                                        <h6>Guidance and Notes:</h6>
                                        <p>1. Blue cells require user input</p>
                                        <p>2. Use absolute figures (i.e. if there is a loss before tax, use this as a positive figure)</p>
                                        <p>3. At the planning stage use management accounts, flexed budgets or last period's figures if current figures are not available.</p>
                                        <p>4. The auditor must document the factors considered in the determination of materiality as a whole, performance materiality and, if applicable, the materiality level(s) for particular classes of transactions, account balances or disclosures. The determining of materiality involves the use of professional judgement, therefore the auditor must be able to justify the chosen benchmark used as a starting point in determining materiality. See PSA 320.A3 for guidance. </p>
                                        <p>For example: for a trading company where the Directors are focused on profit, profit before tax may be the most relevant benchmark to use. For an investment property company, it is likely that the gross assets figure would be the most appropriate benchmark. For service companies, cost-plus entities or not-for-profit entities, it is likely that revenue will be the most appropriate benchmark.</p>
                                        <p>If the most relevant benchmark for an entity is volatile year on year, such that using that benchmark would result in incomparable materiality figures year on year, other benchmarks may be considered to be more appropriate.</p>
                                        <p>5. The percentages applied to a chosen benchmark are also a matter of professional judgement. If the suggested percentages noted above are inappropriate, amend them as necessary.</p>
                                        <p>6. Adjust for any anomalies that may affect materiality.  For example, for an owner-managed business where the owner takes much of the profit before tax in the form of remuneration, "adding back" the owner's remuneration to the profit before taxation figure would provide a more relevant benchmark to be used in the materiality calculation.</p>
                                        <p>7. It is recommended that a level of 75% of audit materiality is used to determine performance materiality when overall inherent risk is low, 62.5% when overall inherent risk is medium and 50% when overall inherent risk is high (see definition above).  Percentages </p>
                                        <p>8. "Clearly trivial"  errors do not need to be accumulated.  These items are clearly inconsequential, whether taken individually or in aggregate, whether judged by size, nature or circumstances.  It is suggested that 1% of audit materiality is used to determine a level at which items are deemed to be clearly trivial, but a different percentage can be used if deemed to be more appropriate and is adequately justified.  </p>
                                        <p>However, misstatements relating to amounts may not be clearly trivial when judged on criteria of nature or circumstance. If this is the case, the misstatements should be accumulated as unadjusted errors.</p>
                                        <p>9. For "sensitive" disclosures, such as those relating to share capital, directors' remuneration and related party transactions, amounts which are disclosed in the financial statements should be correct.  It is recommended that that "allowable misstatements" relating to any related party matter are set at 5% of audit materiality.  It is permissible for different thresholds may be set, but these should be appropriate in the context.  Additional thresholds may also be set for other classes of transactions, account balances or disclosures, which should be fully documented, but may not exceed the level of performance materiality.  In each case, the percentage of audit materiality applied should be stated.</p>
                                        <p>10. The accuracy of accounting estimates needs to be established.  Estimates are "soft" figures in financial statements, and as such, have a level of risk attached to them.  The level of estimation uncertainty for accounting estimates should be documented and should be set at a level lower than performance materiality.</p>
                                        <p>11. Document reasons for not using a materiality level based on the amounts calculated, reasons for setting different levels for individual items in the financial statements and reasons why the final materiality level differs from the planning materiality level.</p>
                                    </td>
                                </tr>
                                
                                
                            </tbody>
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

        $(".revp").on("change", function() {
            var revp = $(".revp").val();
            $('.revpr').attr('value', Math.round(revp * 0.01));
        });
        $(".revf").on("change", function() {
            var revf = $(".revf").val();
            $('.revfr').attr('value',  Math.round(revf * 0.01));
        });
        $(".prop").on("change", function() {
            var prop = $(".prop").val();
            $('.propr').attr('value',  Math.round(prop * 0.10));
        });
        $(".prof").on("change", function() {
            var prof = $(".prof").val();
            $('.profr').attr('value',  Math.round(prof * 0.10));
        });
        $(".grop").on("change", function() {
            var grop = $(".grop").val();
            $('.gropr').attr('value',  Math.round(grop * 0.02));
        });
        $(".grof").on("change", function() {
            var grof = $(".grof").val();
            $('.grofr').attr('value',  Math.round(grof * 0.02));
        });

        $(".pcu").on("change", function() {

            var pcu = $(".pcu").val();
            var adjap = $(".adjap").val();
            var adjbp = $(".adjbp").val();
            var adjcp = $(".adjcp").val();   

            if(pcu == 'r'){
                var revpr = $(".revpr").val();  
                $('.pcur').attr('value',  revpr);
                $('.aomp').attr('value', parseInt(revpr) + parseInt(adjap) + parseInt(adjbp) + parseInt(adjcp));
                var aomp = $(".aomp").val();
                $('.ctp').attr('value',  Math.round(aomp * .01));
            }else if(pcu == 'pbt'){
                var propr = $(".propr").val();  
                $('.pcur').attr('value',  propr); 
                $('.aomp').attr('value', parseInt(propr) + parseInt(adjap) + parseInt(adjbp) + parseInt(adjcp));
                var aomp = $(".aomp").val();
                $('.ctp').attr('value',  Math.round(aomp * .01));
            }else if(pcu == 'ga'){
                var gropr = $(".gropr").val();  
                $('.pcur').attr('value',  gropr); 
                $('.aomp').attr('value', parseInt(gropr) + parseInt(adjap) + parseInt(adjbp) + parseInt(adjcp));
                var aomp = $(".aomp").val();
                $('.ctp').attr('value',  Math.round(aomp * .01));
            }else if(pcu == 'se'){
                $('.pcur').attr('value',  0); 
                $('.aomp').attr('value', parseInt(adjap) + parseInt(adjbp) + parseInt(adjcp));
                var aomp = $(".aomp").val();
                $('.ctp').attr('value',  Math.round(aomp * .01));
            }

        });


        $(".fcu").on("change", function() {
            var fcu = $(".fcu").val();
            var adjaf = $(".adjaf").val();
            var adjbf = $(".adjbf").val();
            var adjcf = $(".adjcf").val();   

            if(fcu == 'r'){
                var revfr = $(".revfr").val();  
                $('.fcur').attr('value',  revfr);
                $('.aomf').attr('value', parseInt(revfr) + parseInt(adjaf) + parseInt(adjbf) + parseInt(adjcf));
                var aomf = $(".aomf").val();
                $('.ctf').attr('value',  Math.round(aomf * .01));
                
            }else if(fcu == 'pbt'){
                var profr = $(".profr").val();  
                $('.fcur').attr('value',  profr); 
                $('.aomf').attr('value', parseInt(profr) + parseInt(adjaf) + parseInt(adjbf) + parseInt(adjcf));
                var aomf = $(".aomf").val();
            }else if(fcu == 'ga'){
                var grofr = $(".grofr").val();  
                $('.fcur').attr('value',  grofr); 
                $('.aomf').attr('value', parseInt(grofr) + parseInt(adjaf) + parseInt(adjbf) + parseInt(adjcf));
                var aomf = $(".aomf").val();
                $('.ctf').attr('value',  Math.round(aomf * .01));
            }else if(fcu == 'se'){
                $('.fcur').attr('value',  0); 
                $('.aomf').attr('value', parseInt(adjaf) + parseInt(adjbf) + parseInt(adjcf));
                var aomf = $(".aomf").val();
            }

        });


        $(".adjap, .adjbp, .adjcp").on("change", function() {
            var pcur = $(".pcur").val();
            var adjap = $(".adjap").val();
            var adjbp = $(".adjbp").val();
            var adjcp = $(".adjcp").val();   
            $('.aomp').attr('value', parseInt(pcur) + parseInt(adjap) + parseInt(adjbp) + parseInt(adjcp));
            var aomp = $(".aomp").val();
            $('.ctp').attr('value',  Math.round(aomp * .01));
        });

        $(".adjaf, .adjbf, .adjcf").on("change", function() {
            var fcur = $(".fcur").val();
            var adjaf = $(".adjaf").val();
            var adjbf = $(".adjbf").val();
            var adjcf = $(".adjcf").val();   
            $('.aomf').attr('value', parseInt(fcur) + parseInt(adjaf) + parseInt(adjbf) + parseInt(adjcf));
            var aomf = $(".aomf").val();
            $('.ctf').attr('value',  Math.round(aomf * .01));
        });


        $(".oirp").on("change", function() {
            var oirp = $(".oirp").val();
            var aomp = $(".aomp").val();

            if(oirp == 'Low'){
                $('.pmpp').attr('value',  '75%');
                $('.apmp').attr('value',  Math.round(aomp * .75));
                $('.aest').attr('value', '35.5%');
                $('.aestp').attr('value', Math.round(aomp * 0.375));
                $('.rptp').attr('value', Math.round(aomp * 0.05));


            }else if(oirp == 'Medium'){
                $('.pmpp').attr('value',  '62.5%');
                $('.apmp').attr('value',  Math.round(aomp * .625));
                $('.aest').attr('value', '31.3%');
                $('.aestp').attr('value', Math.round(aomp * 0.313));
                $('.rptp').attr('value', Math.round(aomp * 0.05));

            }else if(oirp == 'High'){
                $('.pmpp').attr('value',  '50%');
                $('.apmp').attr('value',  Math.round(aomp * .50));
                $('.aest').attr('value',  '25%');
                $('.aestp').attr('value', Math.round(aomp * 0.25));
                $('.rptp').attr('value', Math.round(aomp * 0.05));
            }

        });

        $(".oirf").on("change", function() {
            var oirf = $(".oirf").val();
            var aomf = $(".aomf").val();
            if(oirf == 'Low'){
                $('.pmpf').attr('value',  '75%');
                $('.apmf').attr('value',  Math.round(aomf * .75));
                $('.aestf').attr('value', Math.round(aomf * 0.375));
                $('.rptf').attr('value', Math.round(aomf * 0.05));

            }else if(oirf == 'Medium'){
                $('.pmpf').attr('value',  '62.5%');
                $('.apmf').attr('value',  Math.round(aomf * .625));
                $('.aestf').attr('value', Math.round(aomf * 0.313));
                $('.rptf').attr('value', Math.round(aomf * 0.05));

            }else if(oirf == 'High'){
                $('.pmpf').attr('value',  '50%');
                $('.apmf').attr('value',  Math.round(aomf * .50));
                $('.aestf').attr('value', Math.round(aomf * 0.25));
                $('.rptf').attr('value', Math.round(aomf * 0.05));
            }
            
        });

        $(".itbd1").on("change", function() {
            var itbd1 = $(".itbd1").val();
            var aomp = $(".aomp").val();
            var aomf = $(".aomf").val();
            var dec = parseFloat(itbd1) / 100;
            $('.itbd1p').attr('value',  aomp * dec);
            $('.itbd1f').attr('value',  aomf * dec);
        });

        $(".itbd2").on("change", function() {
            var itbd2 = $(".itbd2").val();
            var aomp = $(".aomp").val();
            var aomf = $(".aomf").val();
            var dec = parseFloat(itbd2) / 100;
            $('.itbd2p').attr('value',  aomp * dec);
            $('.itbd2f').attr('value',  aomf * dec);
        });

        $(".itbd3").on("change", function() {
            var itbd3 = $(".itbd3").val();
            var aomp = $(".aomp").val();
            var aomf = $(".aomf").val();
            var dec = parseFloat(itbd3) / 100;
            $('.itbd3p').attr('value',  aomp * dec);
            $('.itbd3f').attr('value',  aomf * dec);
        });

    });
</script>