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
                        <div class="page-header-subtitle">Set defaults here</div>
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
            <?php if (session()->get('exist')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Data already Exist</h6>
                        Client already exist.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('added')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Registration</h6>
                        Client has been successfully registered
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('updated')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Update Success</h6>
                        Client has been successfully updated
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">

            <table class="table table-hover" >
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="4"><h4>Chapter 1</h4></th>
                    </tr>
                    <?php foreach($c1 as $r){?>
                        <tr>
                            <td><input class="form-check-input" id="add" type="checkbox" name="add" value="Yes"/></td>
                            <td><?= $r['code']?></td>
                            <td><?= $r['title']?></td>
                            <td>
                                <?php if( $r['code'] == 'AC10'){?>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-icon btn-sm" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Tangibles/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Tangibles</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-PPE/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">PPE</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Investments/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Investments</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Inventory/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Inventory</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Trade Receivables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Trade Receivables</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Other Receivables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Other Receivables</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Bank and Cash/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Bank and Cash</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Trade Payables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Trade Payables</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Other Payables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Other Payables</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Provisions/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Provisions</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Revenue/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Revenue</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Costs/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Costs</a>
                                            <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Payroll/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Payroll</a>
                                            <a target="_blank"class="dropdown-item" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>-Summary/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Summary</a>
                                        </div>
                                    </div>
                                <?php }else{?>
                                    <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                <?php }?>

                            </td>
                        </tr>
                    <?php }?>
                    <tr>
                        <th colspan="4"><h4>Chapter 2</h4></th>
                    </tr>
                    <?php foreach($c2 as $r){?>
                        <tr>
                            <td><input class="form-check-input" id="add" type="checkbox" name="add" value="Yes"/></td>
                            <td><?= $r['code']?></td>
                            <td><?= $r['title']?></td>
                            <td><button class="btn btn-primary btn-icon btn-sm get-data" title="View"><i class="fas fa-eye"></i></button></td>
                        </tr>
                    <?php }?>
                    <tr>
                        <th colspan="4"><h4>Chapter 3</h4></th>
                    </tr>
                    <?php foreach($c3 as $r){?>
                        <tr>
                            <td><input class="form-check-input" id="add" type="checkbox" name="add" value="Yes"/></td>
                            <td><?= $r['code']?></td>
                            <td><?= $r['title']?></td>
                            <td><button class="btn btn-primary btn-icon btn-sm get-data" title="View"><i class="fas fa-eye"></i></button></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>


            </div>
        </div>
    </div>
    
</main>





