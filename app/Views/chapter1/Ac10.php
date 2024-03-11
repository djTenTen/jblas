
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

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th colspan="5"><?= $sheet?></th>
                            </tr>
                            <tr>

                                <th colspan="4"></th>
                                <th>CU</th>
                            </tr>
                            <tr>
                                <td colspan="4">Value Per Financial Statements</td>
                                <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>Less</th>
                                <th  colspan="4">Large Items (to include all items greater than performance materiality)</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th colspan="2">Name</th>
                                <th colspan="2">Balance</th>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control"></td>
                                <td colspan="2"><input type="text" class="form-control"></td>
                                <td colspan="2"><input type="text" class="form-control"></td>
                            </tr>

                            <tr>
                                <th>Less</th>
                                <th  colspan="4">Key Items</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th colspan="1">Description</th>
                                <th colspan="1">Reason</th>
                                <th colspan="2">Balance</th>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control"></td>
                                <td colspan="1"><input type="text" class="form-control"></td>
                                <td colspan="1"><input type="text" class="form-control"></td>
                                <td colspan="2"><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <td colspan="4">Total Large and Key Items</td>
                                <td><input type="text" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="4">Population after Large and Key Items</td>
                                <td><input type="text" class="form-control" readonly></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    
</main>
