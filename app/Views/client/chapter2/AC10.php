
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
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Tangibles')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Tangibles/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Tangibles</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'PPE')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-PPE/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">PPE</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Investments')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Investments/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Investments</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Inventory')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Inventory/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Inventory</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Trade%20Receivables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Trade Receivables/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Trade Receivables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Other%20Receivables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Other Receivables/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Other Receivables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Bank%20and%20Cash')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Bank and Cash/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Bank and Cash</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Trade%20Payables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Trade Payables/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Trade Payables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Other%20Payables')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Other Payables/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Other Payables</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Provisions')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Provisions/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Provisions</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Revenue')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Revenue/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Revenue</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Costs')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Costs/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Costs</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Payroll')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Payroll/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Payroll</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'Summary')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter2/setvalues/<?= $code?>-Summary/<?= $mtID; ?>/<?= $cID?>/<?= $name?>">Summary</a>
                </nav>
                <hr style="color: #7752FE;" class="mt-0 mb-4" />
                <br>
                <div class="m-5">
                    <div class="table-responsive">
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac10cu/<?= $code?>-<?= $sheet?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th colspan="5"><?= $sheet?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3"></th>
                                        <th colspan="2">CU</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3">Value Per Financial Statements</td>
                                        <td>
                                            <input type="hidden" class="form-control" name="acid" value="<?= encr($cu['mdID'])?>">
                                            <input type="text" class="form-control cu" name="question" value="<?= $cu['field1']?>">
                                        </td>
                                        <td><button type="submit" class="btn btn-success m-1 btn-sm" title="Save"><i class="fas fa-file-alt"></i> Save</button></td>
                                    </tr>
                                </tbody>
                            </table> 
                        </form>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac10s1/<?= $code?>-<?= $sheet?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered table-sm">
                                <thead> 
                                    <tr>
                                        <th>Less</th>
                                        <th  colspan="4">Large Items (to include all items greater than performance materiality)</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th colspan="2">Name</th>
                                        <th colspan="2">Balance</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody1">
                                    <?php 
                                        $ototal = 0;
                                        $bal1 = 0;
                                        foreach($ac10s1 as $r){
                                            $bal1 += $r['field2'];
                                        ?>
                                        <tr>
                                            <td><input type="text" class="form-control" name="less[]" value="<?= $r['field3']?>"></td>
                                            <td colspan="2"><input type="text" class="form-control" name="namedesc[]" value="<?= $r['field4']?>"></td>
                                            <td colspan="2"><input type="text" class="form-control count" name="balance[]" value="<?= $r['field2']?>"></td>
                                            <td><button class="btn btn-danger btn-icon remove1 btn-sm" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                        </tr>
                                    <?php }?>
                                </tbody>   
                                    <tr>
                                        <td colspan="5" >
                                            <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                                            <button class="btn btn-primary float-end m-1 btn-sm" type="button" data-action="add-field1" id="add-field1"><i class="fas fa-plus-square m-1"></i>Add Field</button>
                                        </td>
                                    </tr>
                            </table>
                        </form>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac10s2/<?= $code?>-<?= $sheet?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered table-sm">
                                <thead>
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
                                </thead>
                                <tbody id="tbody2">
                                    <?php 
                                        $bal2 = 0;
                                        foreach($ac10s2 as $r1){ 
                                            $bal2 += $r1['field2'];
                                    ?>
                                        <tr>
                                            <td><input type="text" class="form-control" name="less[]" value="<?= $r1['field3']?>"></td>
                                            <td colspan="1"><input type="text" class="form-control" name="namedesc[]" value="<?= $r1['field4']?>"></td>
                                            <td colspan="1"><input type="text" class="form-control" name="reason[]" value="<?= $r1['field5']?>"></td>
                                            <td colspan="2"><input type="text" class="form-control count" name="balance[]" value="<?= $r1['field2']?>"></td>
                                            <td><button class="btn btn-danger btn-icon remove2 btn-sm" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                                    <tr>
                                        <td colspan="5" >
                                            <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                                            <button class="btn btn-primary float-end m-1 btn-sm" type="button" data-action="add-field2" id="add-field2"><i class="fas fa-plus-square m-1"></i>Add Field</button>
                                        </td>
                                    </tr>
                                <tfoot>
                                    <?php 
                                        $ototal = $bal1 + $bal2;
                                        $ptota = 0;
                                        if($cu['field1'] > $ototal ){
                                            $ptota = $cu['field1'] - $ototal;
                                        }
                                    ?>
                                    <tr>
                                        <td colspan="4">Total Large and Key Items</td>
                                        <td><input type="text" class="form-control total" value="<?= $ototal ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Population after Large and Key Items</td>
                                        <td><input type="text" class="form-control ptotal" value="<?= $ptota ?>" readonly></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                        <br><br><br><hr style="color: #7752FE;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>


<script>
$(document).ready(function () {

    

    $('.count').on('change', function () {
        // Adding a row inside the tbody.
        var total = 0;

        $('.count').each(function() {
            var value = $(this).val();
            var numericValue = parseFloat(value);
            total += numericValue;
        });
        var cu = $(".cu").val();
        if(parseInt(cu) > total){
            $('.ptotal').attr('value', parseInt(cu) - total);
        }

        $('.total').attr('value', total);
        
    });
    

    $('#add-field1').on('click', function () {
        // Adding a row inside the tbody.
        $('#tbody1').append(` <tr>
                                <td><input type="text" class="form-control" name="less[]"></td>
                                <td colspan="2"><input type="text" class="form-control" name="namedesc[]"></td>
                                <td colspan="2"><input type="text" class="form-control count" name="balance[]"></td>
                                <td><button class="btn btn-danger btn-icon remove1 btn-sm" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                            </tr>`);
    });

    $('#tbody1').on('click', 'button.remove1', function () {
        $(this).closest('tr').remove();
    });

    $('#add-field2').on('click', function () {
        // Adding a row inside the tbody.
        $('#tbody2').append(` <tr>
                                <td><input type="text" class="form-control" name="less[]"></td>
                                <td colspan="1"><input type="text" class="form-control" name="namedesc[]"></td>
                                <td colspan="1"><input type="text" class="form-control" name="reason[]"></td>
                                <td colspan="2"><input type="text" class="form-control count" name="balance[]"></td>
                                <td><button class="btn btn-danger btn-icon remove2 btn-sm" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                            </tr>`);
    });

    $('#tbody2').on('click', 'button.remove2', function () {
        $(this).closest('tr').remove();
    });

});
</script>