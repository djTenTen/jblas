
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
            
            <div class="card-body">

                <nav class="nav nav-borders">
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Tangibles')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Tangibles/<?= $header?>/<?= $c1tID; ?>">Tangibles</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'PPE')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-PPE/<?= $header?>/<?= $c1tID; ?>">PPE</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Investments')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Investments/<?= $header?>/<?= $c1tID; ?>">Investments</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Inventory')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Inventory/<?= $header?>/<?= $c1tID; ?>">Inventory</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Trade%20Receivables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Trade Receivables/<?= $header?>/<?= $c1tID; ?>">Trade Receivables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Other%20Receivables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Other Receivables/<?= $header?>/<?= $c1tID; ?>">Other Receivables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Bank%20and%20Cash')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Bank and Cash/<?= $header?>/<?= $c1tID; ?>">Bank and Cash</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Trade%20Payables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Trade Payables/<?= $header?>/<?= $c1tID; ?>">Trade Payables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Other%20Payables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Other Payables/<?= $header?>/<?= $c1tID; ?>">Other Payables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Provisions')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Provisions/<?= $header?>/<?= $c1tID; ?>">Provisions</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Revenue')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Revenue/<?= $header?>/<?= $c1tID; ?>">Revenue</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Costs')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Costs/<?= $header?>/<?= $c1tID; ?>">Costs</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Payroll')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Payroll/<?= $header?>/<?= $c1tID; ?>">Payroll</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Summary')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter1/manage/<?= $code?>-Summary/<?= $header?>/<?= $c1tID; ?>">Summary</a>
                </nav>
                <hr class="mt-0 mb-4" />
                <br>


                <h4>AUDIT APPROACH AND SAMPLE SIZE CALCULATION</h4>
               
               <p>To complete the table below enter the risk level as per Ac6 and the materiality level as documented at Ac8. Where a different risk level is relevant for different assertions the table can be expanded as indicated on the lefthand margin. The audit approach should be selected by entering 'Y' or 'N' as appropriate. Where sampling is not required under the approach selected the remainder of the row will be greyed out. </p>
               <p>Where substantive testing is to be undertaken document whether this will be supported by controls testing or supportive analytical procedures. For each area, enter the population and any large or key items on the appropriate supporting schedule. The residual sample size will then be automatically calculated by dividing the residual population (after large and key items) by materiality and multiplying this by the risk factor which is determined by the audit approach as documented on the reference table below.</p>
               <p>Where transaction testing is to be undertaken select the approximate number of transactions from the drop down. This together with the risk level entered will calculate the appropriate sample size, again based on the information on the reference table below.</p>

               <div class="table-responsive">
                    <table class="table table-bordered table-sm">
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
                        <tbody>
                            <tr>
                                <td>Intangible Assets</td>
                                <td>All</td>
                                <td> 
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>PPE</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Investments</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Inventories</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Trade Receivables</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>All Other Receivables</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Bank and Cash</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Trade Payables</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>All Other Payables</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Provisions</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="17"></td>
                            </tr>
                            <tr>
                                <td>Revenue</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Costs</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Payroll</td>
                                <td>All</td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm">
                                </td>
                            </tr>

                            <tr>
                                <td>Materiality </td>
                                <td><input type="text" class="form-control form-control-sm"></td>
                            </tr>
                        </tbody>
                    </table>
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
