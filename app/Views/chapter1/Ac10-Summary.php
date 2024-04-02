
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
                        <h6 class="alert-heading">Failed Update</h6>
                        Error updating contents.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">

                <nav class="nav nav-borders">
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Tangibles')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Tangibles/<?= $header?>/<?= $c1tID; ?>">Tangibles</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'PPE')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-PPE/<?= $header?>/<?= $c1tID; ?>">PPE</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Investments')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Investments/<?= $header?>/<?= $c1tID; ?>">Investments</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Inventory')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Inventory/<?= $header?>/<?= $c1tID; ?>">Inventory</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Trade%20Receivables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Trade Receivables/<?= $header?>/<?= $c1tID; ?>">Trade Receivables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Other%20Receivables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Other Receivables/<?= $header?>/<?= $c1tID; ?>">Other Receivables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Bank%20and%20Cash')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Bank and Cash/<?= $header?>/<?= $c1tID; ?>">Bank and Cash</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Trade%20Payables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Trade Payables/<?= $header?>/<?= $c1tID; ?>">Trade Payables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Other%20Payables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Other Payables/<?= $header?>/<?= $c1tID; ?>">Other Payables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Provisions')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Provisions/<?= $header?>/<?= $c1tID; ?>">Provisions</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Revenue')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Revenue/<?= $header?>/<?= $c1tID; ?>">Revenue</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Costs')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Costs/<?= $header?>/<?= $c1tID; ?>">Costs</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Payroll')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Payroll/<?= $header?>/<?= $c1tID; ?>">Payroll</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Summary')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/c1/manage/<?= $code?>-Summary/<?= $header?>/<?= $c1tID; ?>">Summary</a>
                </nav>
                <hr class="mt-0 mb-4" />
                <br>

                <h4>AUDIT APPROACH AND SAMPLE SIZE CALCULATION</h4>
               
               <p>To complete the table below enter the risk level as per Ac6 and the materiality level as documented at Ac8. Where a different risk level is relevant for different assertions the table can be expanded as indicated on the lefthand margin. The audit approach should be selected by entering 'Y' or 'N' as appropriate. Where sampling is not required under the approach selected the remainder of the row will be greyed out. </p>
               <p>Where substantive testing is to be undertaken document whether this will be supported by controls testing or supportive analytical procedures. For each area, enter the population and any large or key items on the appropriate supporting schedule. The residual sample size will then be automatically calculated by dividing the residual population (after large and key items) by materiality and multiplying this by the risk factor which is determined by the audit approach as documented on the reference table below.</p>
               <p>Where transaction testing is to be undertaken select the approximate number of transactions from the drop down. This together with the risk level entered will calculate the appropriate sample size, again based on the information on the reference table below.</p>

               <div class="table-responsive">
                    <form action="<?= base_url()?>auditsystem/c1/saveac10summ/<?= $code?>/<?= $sheet?>/<?= $header?>/<?= $c1tID?>" method="post">
                    <table class="table table-bordered table-sm" style="width: 2500px;">
                        <thead>
                            <tr class="text-center">
                                <th colspan="3"></th>

                                <th colspan="5">A</th>
                                <th>B</th>
                                <th>C</th>
                                <th colspan="7"></th>
                            </tr>
                            <tr class="text-center">
                                <th colspan="8">General</th>
                                <th colspan="7">Substantive</th>
                                <th colspan="2">Transaction</th>
                            </tr>
                            <tr>
                                <th>Audit Area</th>
                                <th>Audit Assertion (1) (Expand if different risks apply to different assertions)</th>
                                <th style="width: 5%;" class="text-center">Risk per Ac10</th>
                                <th style="width: 5%;" class="text-center">I</th>
                                <th style="width: 5%;" class="text-center">P</th>
                                <th style="width: 5%;" class="text-center">%</th>
                                <th style="width: 5%;" class="text-center">S</th>
                                <th style="width: 5%;" class="text-center">T</th>
                                <th>Tests of control  # (2) @</th>
                                <th>Supportive analytical procedures #</th>
                                <th>Risk factor (as below)</th>
                                <th>Value of population after large and key items</th>
                                <th>Section Ref</th>
                                <th>Residual sample size</th>
                                <th>No of material / key items to be tested </th>
                                <th>Approximate number of transactions</th>
                                <th>Transaction sample size from table B</th>
                            </tr>
                        </thead>

                        <tbody id="tbody">
                            <tr>
                                <td>Intangible Assets</td>
                                <td>All</td>
                                <td> 
                                    <select name="tgb_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $tgb['tgb_rpac10']?>" selected>
                                            <?php 
                                                switch ($tgb['tgb_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tgb_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $tgb['tgb_i']?>" selected><?= $tgb['tgb_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tgb_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $tgb['tgb_p']?>" selected><?= $tgb['tgb_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tgb_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $tgb['tgb_pcnt']?>" selected><?= $tgb['tgb_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tgb_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $tgb['tgb_s']?>" selected><?= $tgb['tgb_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tgb_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $tgb['tgb_t']?>" selected><?= $tgb['tgb_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tgb_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $tgb['tgb_ctrf']?>" selected>
                                            <?php 
                                                switch ($tgb['tgb_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tgb_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $tgb['tgb_arf']?>" selected>
                                            <?php 
                                                switch ($tgb['tgb_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $tgb['tgb_rf']?>" name="tgb_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="tgb_vop" type="text" class="form-control form-control-sm" value="<?= $vop_tgb?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $tgb['tgb_secref']?>" name="tgb_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $tgb['tgb_rss']?>" name="tgb_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="tgb_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_tgb?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $tgb['tgb_ant']?>" name="tgb_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $tgb['tgb_tss']?>" name="tgb_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>PPE</td>
                                <td>All</td>
                                <td> 
                                    <select name="ppe_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $ppe['ppe_rpac10']?>" selected>
                                            <?php 
                                                switch ($ppe['ppe_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ppe_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $ppe['ppe_i']?>" selected><?= $ppe['ppe_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ppe_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $ppe['ppe_p']?>" selected><?= $ppe['ppe_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ppe_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $ppe['ppe_pcnt']?>" selected><?= $ppe['ppe_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ppe_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $ppe['ppe_s']?>" selected><?= $ppe['ppe_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ppe_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $ppe['ppe_t']?>" selected><?= $ppe['ppe_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ppe_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $ppe['ppe_ctrf']?>" selected>
                                            <?php 
                                                switch ($ppe['ppe_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ppe_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $ppe['ppe_arf']?>" selected>
                                            <?php 
                                                switch ($ppe['ppe_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $ppe['ppe_rf']?>" name="ppe_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="ppe_vop" type="text" class="form-control form-control-sm" value="<?= $vop_ppe?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $ppe['ppe_secref']?>" name="ppe_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $ppe['ppe_rss']?>" name="ppe_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="ppe_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_ppe?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $ppe['ppe_ant']?>" name="ppe_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $ppe['ppe_tss']?>" name="ppe_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Investments</td>
                                <td>All</td>
                                <td> 
                                    <select name="invmt_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $invmt['invmt_rpac10']?>" selected>
                                            <?php 
                                                switch ($invmt['invmt_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invmt_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $invmt['invmt_i']?>" selected><?= $invmt['invmt_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invmt_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $invmt['invmt_p']?>" selected><?= $invmt['invmt_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invmt_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $invmt['invmt_pcnt']?>" selected><?= $invmt['invmt_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invmt_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $invmt['invmt_s']?>" selected><?= $invmt['invmt_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invmt_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $invmt['invmt_t']?>" selected><?= $invmt['invmt_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invmt_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $invmt['invmt_ctrf']?>" selected>
                                            <?php 
                                                switch ($invmt['invmt_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invmt_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $invmt['invmt_arf']?>" selected>
                                            <?php 
                                                switch ($invmt['invmt_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $invmt['invmt_rf']?>" name="invmt_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="invmt_vop" type="text" class="form-control form-control-sm" value="<?= $vop_invmt?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $invmt['invmt_secref']?>" name="invmt_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $invmt['invmt_rss']?>" name="invmt_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="invmt_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_invmt?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $invmt['invmt_ant']?>" name="invmt_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $invmt['invmt_tss']?>" name="invmt_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Inventories</td>
                                <td>All</td>
                                <td> 
                                    <select name="invtr_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $invtr['invtr_rpac10']?>" selected>
                                            <?php 
                                                switch ($invtr['invtr_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invtr_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $invtr['invtr_i']?>" selected><?= $invtr['invtr_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invtr_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $invtr['invtr_p']?>" selected><?= $invtr['invtr_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invtr_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $invtr['invtr_pcnt']?>" selected><?= $invtr['invtr_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invtr_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $invtr['invtr_s']?>" selected><?= $invtr['invtr_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invtr_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $invtr['invtr_t']?>" selected><?= $invtr['invtr_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invtr_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $invtr['invtr_ctrf']?>" selected>
                                            <?php 
                                                switch ($invtr['invtr_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="invtr_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $invtr['invtr_arf']?>" selected>
                                            <?php 
                                                switch ($invtr['invtr_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $invtr['invtr_rf']?>" name="invtr_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="invtr_vop" type="text" class="form-control form-control-sm" value="<?= $vop_invtr?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $invtr['invtr_secref']?>" name="invtr_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $invtr['invtr_rss']?>" name="invtr_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="invtr_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_invtr?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $invtr['invtr_ant']?>" name="invtr_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $invtr['invtr_tss']?>" name="invtr_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Trade Receivables</td>
                                <td>All</td>
                                <td> 
                                    <select name="tr_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $tr['tr_rpac10']?>" selected>
                                            <?php 
                                                switch ($tr['tr_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tr_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $tr['tr_i']?>" selected><?= $tr['tr_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tr_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $tr['tr_p']?>" selected><?= $tr['tr_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tr_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $tr['tr_pcnt']?>" selected><?= $tr['tr_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tr_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $tr['tr_s']?>" selected><?= $tr['tr_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tr_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $tr['tr_t']?>" selected><?= $tr['tr_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tr_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $tr['tr_ctrf']?>" selected>
                                            <?php 
                                                switch ($tr['tr_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tr_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $tr['tr_arf']?>" selected>
                                            <?php 
                                                switch ($tr['tr_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $tr['tr_rf']?>" name="tr_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="tr_vop" type="text" class="form-control form-control-sm" value="<?= $vop_tr?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $tr['tr_secref']?>" name="tr_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $tr['tr_rss']?>" name="tr_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="tr_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_tr?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $tr['tr_ant']?>" name="tr_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $tr['tr_tss']?>" name="tr_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>All Other Receivables</td>
                                <td>All</td>
                                <td> 
                                    <select name="or_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $or['or_rpac10']?>" selected>
                                            <?php 
                                                switch ($or['or_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="or_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $or['or_i']?>" selected><?= $or['or_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="or_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $or['or_p']?>" selected><?= $or['or_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="or_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $or['or_pcnt']?>" selected><?= $or['or_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="or_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $or['or_s']?>" selected><?= $or['or_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="or_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $or['or_t']?>" selected><?= $or['or_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="or_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $or['or_ctrf']?>" selected>
                                            <?php 
                                                switch ($or['or_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="or_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $or['or_arf']?>" selected>
                                            <?php 
                                                switch ($or['or_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $or['or_rf']?>" name="or_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="or_vop" type="text" class="form-control form-control-sm" value="<?= $vop_or?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $or['or_secref']?>" name="or_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $or['or_rss']?>" name="or_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="or_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_or?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $or['or_ant']?>" name="or_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $or['or_tss']?>" name="or_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Bank and Cash</td>
                                <td>All</td>
                                <td> 
                                    <select name="bac_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $bac['bac_rpac10']?>" selected>
                                            <?php 
                                                switch ($bac['bac_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="bac_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $bac['bac_i']?>" selected><?= $bac['bac_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="bac_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $bac['bac_p']?>" selected><?= $bac['bac_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="bac_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $bac['bac_pcnt']?>" selected><?= $bac['bac_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="bac_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $bac['bac_s']?>" selected><?= $bac['bac_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="bac_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $bac['bac_t']?>" selected><?= $bac['bac_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="bac_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $bac['bac_ctrf']?>" selected>
                                            <?php 
                                                switch ($bac['bac_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="bac_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $bac['bac_arf']?>" selected>
                                            <?php 
                                                switch ($bac['bac_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $bac['bac_rf']?>" name="bac_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="bac_vop" type="text" class="form-control form-control-sm" value="<?= $vop_bac?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $bac['bac_secref']?>" name="bac_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $bac['bac_rss']?>" name="bac_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="bac_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_bac?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $bac['bac_ant']?>" name="bac_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $bac['bac_tss']?>" name="bac_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Trade Payables</td>
                                <td>All</td>
                                <td> 
                                    <select name="tp_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $tp['tp_rpac10']?>" selected>
                                            <?php 
                                                switch ($tp['tp_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tp_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $tp['tp_i']?>" selected><?= $tp['tp_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tp_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $tp['tp_p']?>" selected><?= $tp['tp_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tp_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $tp['tp_pcnt']?>" selected><?= $tp['tp_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tp_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $tp['tp_s']?>" selected><?= $tp['tp_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tp_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $tp['tp_t']?>" selected><?= $tp['tp_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tp_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $tp['tp_ctrf']?>" selected>
                                            <?php 
                                                switch ($tp['tp_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="tp_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $tp['tp_arf']?>" selected>
                                            <?php 
                                                switch ($tp['tp_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $tp['tp_rf']?>" name="tp_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="tp_vop" type="text" class="form-control form-control-sm" value="<?= $vop_tp?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $tp['tp_secref']?>" name="tp_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $tp['tp_rss']?>" name="tp_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="tp_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_tp?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $tp['tp_ant']?>" name="tp_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $tp['tp_tss']?>" name="tp_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>All Other Payables</td>
                                <td>All</td>
                                <td> 
                                    <select name="op_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $op['op_rpac10']?>" selected>
                                            <?php 
                                                switch ($op['op_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="op_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $op['op_i']?>" selected><?= $op['op_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="op_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $op['op_p']?>" selected><?= $op['op_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="op_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $op['op_pcnt']?>" selected><?= $op['op_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="op_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $op['op_s']?>" selected><?= $op['op_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="op_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $op['op_t']?>" selected><?= $op['op_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="op_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $op['op_ctrf']?>" selected>
                                            <?php 
                                                switch ($op['op_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="op_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $op['op_arf']?>" selected>
                                            <?php 
                                                switch ($op['op_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $op['op_rf']?>" name="op_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="op_vop" type="text" class="form-control form-control-sm" value="<?= $vop_op?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $op['op_secref']?>" name="op_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $op['op_rss']?>" name="op_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="op_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_op?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $op['op_ant']?>" name="op_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $op['op_tss']?>" name="op_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Provisions</td>
                                <td>All</td>
                                <td> 
                                    <select name="prov_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $prov['prov_rpac10']?>" selected>
                                            <?php 
                                                switch ($prov['prov_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="prov_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $prov['prov_i']?>" selected><?= $prov['prov_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="prov_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $prov['prov_p']?>" selected><?= $prov['prov_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="prov_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $prov['prov_pcnt']?>" selected><?= $prov['prov_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="prov_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $prov['prov_s']?>" selected><?= $prov['prov_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="prov_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $prov['prov_t']?>" selected><?= $prov['prov_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="prov_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $prov['prov_ctrf']?>" selected>
                                            <?php 
                                                switch ($prov['prov_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="prov_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $prov['prov_arf']?>" selected>
                                            <?php 
                                                switch ($prov['prov_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $prov['prov_rf']?>" name="prov_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="prov_vop" type="text" class="form-control form-control-sm" value="<?= $vop_prov?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $prov['prov_secref']?>" name="prov_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $prov['prov_rss']?>" name="prov_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="prov_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_prov?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $prov['prov_ant']?>" name="prov_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $prov['prov_tss']?>" name="prov_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="17"></td>
                            </tr>
                            <tr>
                                <td>Revenue</td>
                                <td>All</td>
                                <td> 
                                    <select name="rev_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $rev['rev_rpac10']?>" selected>
                                            <?php 
                                                switch ($rev['rev_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="rev_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $rev['rev_i']?>" selected><?= $rev['rev_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="rev_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $rev['rev_p']?>" selected><?= $rev['rev_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="rev_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $rev['rev_pcnt']?>" selected><?= $rev['rev_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="rev_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $rev['rev_s']?>" selected><?= $rev['rev_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="rev_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $rev['rev_t']?>" selected><?= $rev['rev_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="rev_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $rev['rev_ctrf']?>" selected>
                                            <?php 
                                                switch ($rev['rev_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="rev_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $rev['rev_arf']?>" selected>
                                            <?php 
                                                switch ($rev['rev_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $rev['rev_rf']?>" name="rev_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="rev_vop" type="text" class="form-control form-control-sm" value="<?= $vop_rev?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $rev['rev_secref']?>" name="rev_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $rev['rev_rss']?>" name="rev_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="rev_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_rev?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $rev['rev_ant']?>" name="rev_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $rev['rev_tss']?>" name="rev_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Costs</td>
                                <td>All</td>
                                <td> 
                                    <select name="cst_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $cst['cst_rpac10']?>" selected>
                                            <?php 
                                                switch ($cst['cst_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="cst_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $cst['cst_i']?>" selected><?= $cst['cst_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="cst_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $cst['cst_p']?>" selected><?= $cst['cst_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="cst_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $cst['cst_pcnt']?>" selected><?= $cst['cst_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="cst_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $cst['cst_s']?>" selected><?= $cst['cst_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="cst_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $cst['cst_t']?>" selected><?= $cst['cst_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="cst_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $cst['cst_ctrf']?>" selected>
                                            <?php 
                                                switch ($cst['cst_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="cst_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $cst['cst_arf']?>" selected>
                                            <?php 
                                                switch ($cst['cst_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $cst['cst_rf']?>" name="cst_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="cst_vop" type="text" class="form-control form-control-sm" value="<?= $vop_cst?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $cst['cst_secref']?>" name="cst_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $cst['cst_rss']?>" name="cst_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="cst_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_cst?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $cst['cst_ant']?>" name="cst_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $cst['cst_tss']?>" name="cst_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Payroll</td>
                                <td>All</td>
                                <td> 
                                    <select name="pr_rpac10" id="" class="form-control form-control-sm selectrisk" readonly>
                                        <option value="<?= $pr['pr_rpac10']?>" selected>
                                            <?php 
                                                switch ($pr['pr_rpac10']) {
                                                    case '1.2':echo 'Low';break;
                                                    case '1.8':echo 'Medium';break;
                                                    case '2.5':echo 'High';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="1.2">Low</option>
                                        <option value="1.8">Medium</option>
                                        <option value="2.5">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="pr_i" id="" class="form-control form-control-sm">
                                        <option value="<?= $pr['pr_i']?>" selected><?= $pr['pr_i']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="pr_p" id="" class="form-control form-control-sm">
                                        <option value="<?= $pr['pr_p']?>" selected><?= $pr['pr_p']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="pr_pcnt" id="" class="form-control form-control-sm">
                                        <option value="<?= $pr['pr_pcnt']?>" selected><?= $pr['pr_pcnt']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="pr_s" id="" class="form-control form-control-sm">
                                        <option value="<?= $pr['pr_s']?>" selected><?= $pr['pr_s']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="pr_t" id="" class="form-control form-control-sm">
                                        <option value="<?= $pr['pr_t']?>" selected><?= $pr['pr_t']?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="pr_ctrf" id="" class="form-control form-control-sm ctrf">
                                        <option value="<?= $pr['pr_ctrf']?>" selected>
                                            <?php 
                                                switch ($pr['pr_ctrf']) {
                                                    case '0.5':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.5">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="pr_arf" id="" class="form-control form-control-sm arf">
                                        <option value="<?= $pr['pr_arf']?>" selected>
                                            <?php 
                                                switch ($pr['pr_arf']) {
                                                    case '0.67':echo 'Yes';break;
                                                    case '1':echo 'No';break;
                                                    default:break;
                                                }
                                            ?>
                                        </option>
                                        <option value="0.67">Yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input value="<?= $pr['pr_rf']?>" name="pr_rf" type="text" class="form-control form-control-sm riskf" readonly>
                                </td>
                                <td>
                                    <input name="pr_vop" type="text" class="form-control form-control-sm" value="<?= $vop_pr?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $pr['pr_secref']?>" name="pr_secref" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $pr['pr_rss']?>" name="pr_rss" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="pr_mki" type="text" class="form-control form-control-sm" value="<?= $nmk_pr?>" readonly>
                                </td>
                                <td>
                                    <input value="<?= $pr['pr_ant']?>" name="pr_ant" type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input value="<?= $pr['pr_tss']?>" name="pr_tss" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>

                            <tr>
                                <td>Materiality </td>
                                <td><input name="materiality" type="text" class="form-control form-control-sm" value="<?= $mat['question']?>"></td>
                            </tr>
                        </tbody>   
                            <div class="container">
                                <div class="col-3 float-end">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success  btn-block m-2">Save</button>
                                    </div>
                                </div>
                            </div>     
                    </table>
                            
                    </form>
                </div>
               <p>(1) Risk must be assessed for each area at assertion level.  If for an area, all assertions have the same risk use the "all" line. However, if there are different levels of risks then the various assertion rows should be expanded in each area as relevant. At the testing stage the key assertions are occurrence, completeness, accuracy, cut off and classification for transactions and existence, rights and obligations, completeness, valuation and allocation and disclosure for balances.</p>
               <p>'(2) If testing controls then the operating effectiveness of the non critical controls must be tested at least every three years to ensure that they are effective, all critical controls should still be tested annually.  Walkthrough tests should be carried out every year to ensure that controls have not changed.</p>
               <p>(3) It will usually only be appropriate to test controls where they are expected to be effective therefore a low risk sample size should be used.</p>

               <h4>Reference Table</h4>
               <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="4">Reference Table</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Balance Sheet</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Profit or Loss</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>

                            <th>Audit Approach</th>
                            <th></th>
                            <th></th>
                            <th>Risk Level</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Risk Level</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                     
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>H</th>
                            <th>M</th>
                            <th>L</th>
                            <th>Population</th>
                            <th>H</th>
                            <th>M</th>
                            <th>L</th>
                        </tr>
                        <tr>
                        
                            <th>Approach</th>
                            <th>Control</th>
                            <th>AR</th>
                            <th>Risk Factor</th>
                            <th></th>
                            <th></th>
                            <th>Size</th>
                            <th>Risk Factor</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td rowspan="11">Method of obtaining audit evidence</td>
                            <td>I,P,%</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td></td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>S**</td>
                            <td>No</td>
                            <td>No</td>
                            <td>2.5</td>
                            <td>1.8</td>
                            <td>1.2</td>
                            <td></td>
                            <td>1.2</td>
                            <td>0.9</td>
                            <td>0.6</td>
                        </tr>
                        <tr>
                            <td>S**</td>
                            <td>Yes</td>
                            <td>No</td>
                            <td>1.3</td>
                            <td>0.9</td>
                            <td>0.4</td>
                            <td></td>
                            <td>0.4</td>
                            <td>0.3</td>
                            <td>0.2</td>
                        </tr>
                        <tr>
                            <td>S**</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>1.7</td>
                            <td>1.2</td>
                            <td>0.8</td>
                            <td></td>
                            <td>0.8</td>
                            <td>0.6</td>
                            <td>0.4</td>
                        </tr>
                        <tr>
                            <td>S**</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>0.9</td>
                            <td>0.6</td>
                            <td>0.4</td>
                            <td></td>
                            <td>0.4</td>
                            <td>0.3</td>
                            <td>0.2</td>
                        </tr>
                        <tr>
                            <td colspan="10">Sample Sizes**</td>
                        </tr>
                        <tr>
                            <td>T / C</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>> 401</td>
                            <td>60+</td>
                            <td>40</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>T / C</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>226-400</td>
                            <td>48+</td>
                            <td>32</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>T / C</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>101-225</td>
                            <td>36+</td>
                            <td>24</td>
                            <td>15</td>
                        </tr>
                        <tr>
                            <td>T / C</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>26-100</td>
                            <td>24+</td>
                            <td>16</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>T / C</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>1-25</td>
                            <td>12+</td>
                            <td>8</td>
                            <td>5</td>
                        </tr>
                    </tbody>
               </table>
               


                <dl>
                    <dt>Key</dt>
                    <dt>I</dt>
                    <dd>- Less than performance materiality</dd>
                    <dt>P</dt>
                    <dd>- Proof in total (extensive analytical procedures)</dd>
                    <dt>%</dt>
                    <dd>- 100% testing</dd>
                    <dt>S </dt>
                    <dd>- Substantive sampling</dd>
                    <dt>T </dt>
                    <dd>- Transaction testing</dd>
                    <dt>#</dt>
                    <dd>- If a yes is recorded in either column B or C then suitable testing must be undertaken and the validity of this response must be reviewed at the end of the fieldwork and it must be cross referenced to supporting working papers</dd>
                    <dt>@</dt>
                    <dd>- It is only possible to record a yes in this column if controls have been tested, and they are effective.  If the controls are ineffective, a no must be recorded in this column.  This column may be completed with a yes at the planning stage if it is intended to test controls.</dd>
                    <dt>C</dt>
                    <dd>- Tests of control</dd>
                    <dt>**</dt>
                    <dd>- When performing substantive procedures, the number of items selected from the residual population (after testing all "large" / "key" items) may be capped at the levels noted for transaction / control testing.</dd>
                </dl>    

            </div>
        </div>
    </div>
    
</main>


<script>
    $(document).ready(function() {

        $('#tbody').on('change', '.selectrisk , .ctrf, .arf', function() {
            //$('.pcur').attr('value',  revpr);

            var riskval = $(this).closest('tr').find('.selectrisk').val();
            var ctr = $(this).closest('tr').find('.ctrf').val();
            var arf = $(this).closest('tr').find('.arf').val();
            
            var riskf = $(this).closest('tr').find('.riskf');

            var fin = parseFloat(riskval) * parseFloat(ctr) * parseFloat(arf);

            riskf.attr('value', Math.round(fin * 10) / 10);
            
        });
    });
</script>