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
            <?php if (session()->get('invalid_input')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Invalid Input</h6>
                        Something wrong with your data inputd, please try again.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('success_registration')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Registration</h6>
                        Contents has been successfully saved.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed_registration')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Failed Registration</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>
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

                <div class="table-responsive">
                    <form action="<?= base_url()?>auditsystem/c1/saveac10cu/<?= $code?>/<?= $sheet?>/<?= $header?>/<?= $c1tID?>" method="post">
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
                                    <input type="hidden" class="form-control" name="acid" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($cu['acID']))?>">
                                    <input type="text" class="form-control cu" name="question" value="<?= $cu['question']?>">
                                </td>
                                <td><button type="submit" class="btn btn-success m-1 btn-icon btn-sm" title="Save"><i class="fas fa-file-alt"></i></button></td>
                            </tr>
                        </tbody>
                    </table> 
                    </form>

                    <form action="<?= base_url()?>auditsystem/c1/saveac10s1/<?= $code?>/<?= $sheet?>/<?= $header?>/<?= $c1tID?>" method="post">
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
                                    $bal1 += $r['balance'];
                                ?>
                                <tr>
                                    <td><input type="text" class="form-control" name="less[]" value="<?= $r['less']?>"></td>
                                    <td colspan="2"><input type="text" class="form-control" name="namedesc[]" value="<?= $r['name']?>"></td>
                                    <td colspan="2"><input type="text" class="form-control count" name="balance[]" value="<?= $r['balance']?>"></td>
                                    <td><button class="btn btn-danger btn-icon remove1 btn-sm" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            <?php }?>
                        </tbody>   
                            <tr>
                                <td colspan="5" >
                                    <button type="submit" class="btn btn-success float-end m-1">Save</button>
                                    <button class="btn btn-primary float-end m-1" type="button" data-action="add-field1" id="add-field1">Add Field</button>
                                </td>
                            </tr>
                    </table>
                    </form>


                    <form action="<?= base_url()?>auditsystem/c1/saveac10s2/<?= $code?>/<?= $sheet?>/<?= $header?>/<?= $c1tID?>" method="post">
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
                                    $bal2 += $r1['balance'];
                            ?>
                                <tr>
                                    <td><input type="text" class="form-control" name="less[]" value="<?= $r1['less']?>"></td>
                                    <td colspan="1"><input type="text" class="form-control" name="namedesc[]" value="<?= $r1['name']?>"></td>
                                    <td colspan="1"><input type="text" class="form-control" name="reason[]" value="<?= $r1['reason']?>"></td>
                                    <td colspan="2"><input type="text" class="form-control count" name="balance[]" value="<?= $r1['balance']?>"></td>
                                    <td><button class="btn btn-danger btn-icon remove2 btn-sm" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            <?php }?>
                        </tbody>
                            <tr>
                                <td colspan="5" >
                                    <button type="submit" class="btn btn-success float-end m-1">Save</button>
                                    <button class="btn btn-primary float-end m-1" type="button" data-action="add-field2" id="add-field2">Add Field</button>
                                </td>
                            </tr>
                        <tfoot>
                            <?php 
                                $ototal = $bal1 + $bal2;
                                $ptota = 0;
                                if($cu['question'] > $ototal ){
                                    $ptota = $cu['question'] - $ototal;
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