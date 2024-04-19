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
                        <div class="page-header-subtitle">Select files for you clients</div>
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
            <form action="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>" method="post">

                <table class="table table-hover" >
                    <thead>
                        <tr>
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
                                <td><?= $r['code']?></td>
                                <td><?= $r['title']?></td>
                                <td>
                                    <?php if($r['code'] == 'AC10'){?>
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-icon btn-sm" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tools"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Tangibles/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Tangibles</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-PPE/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">PPE</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Investments/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Investments</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Inventory/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Inventory</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Trade Receivables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Trade Receivables</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Other Receivables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Other Receivables</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Bank and Cash/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Bank and Cash</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Trade Payables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Trade Payables</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Other Payables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Other Payables</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Provisions/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Provisions</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Revenue/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Revenue</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Costs/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Costs</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Payroll/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Payroll</a>
                                                <a target="_blank"class="dropdown-item" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>-Summary/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>">Summary</a>
                                            </div>
                                        </div>
                                    <?php }else{?>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/chapter1/setvalues/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>/<?= $cID?>/<?= $name?>" target="_blank" title="Set Values"><i class="fas fa-tools"></i></a>
                                    <?php }?>

                                </td>
                            </tr>
                        <?php }?>
                        <tr>
                            <th colspan="4"><h4>Chapter 2</h4></th>
                        </tr>
                        <?php foreach($c2 as $r){?>
                            <tr>
                                <td><?= $r['code']?></td>
                                <td><?= $r['title']?></td>
                                <td>
                                    <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/chapter2/setvalues/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>/<?= $cID?>/<?= $name?>" target="_blank" title="Set Values"><i class="fas fa-tools"></i></a>
                                </td>
                            </tr>
                        <?php }?>
                        <tr>
                            <th colspan="4"><h4>Chapter 3</h4></th>
                        </tr>
                        <?php foreach($c3 as $r){?>
                            <tr>
                                <td><?= $r['code']?></td>
                                <td><?= $r['title']?></td>
                                <td>
                                    <?php if($r['code'] == '3.10 Aa11'){?>
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-icon btn-sm" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tools"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter3/setvalues/')?><?= $r['code']?>-un/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $name?>">Unadjusted Errors</a>
                                                <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/chapter3/setvalues/')?><?= $r['code']?>-ad/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $name?>">Adjusted Mades</a>
                                            </div>
                                        </div>
                                    <?php }else{?>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/chapter3/setvalues/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>/<?= $cID?>/<?= $name?>" target="_blank" title="Set Values"><i class="fas fa-tools"></i></a>
                                <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>

                <button class="btn btn-success float-end">Set Files</button>

            </form>
            

            </div>
        </div>
    </div>
    
</main>





