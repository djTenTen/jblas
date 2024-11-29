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
                        <div class="page-header-subtitle"><?= $subt?></div>
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
            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row" id="cardTab" role="tablist">
                    <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Module 1</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-bs-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Module 2</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard3-tab" href="#wizard3" data-bs-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Module 3</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard4-tab" href="#wizard4" data-bs-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Module 4</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard5-tab" href="#wizard5" data-bs-toggle="tab" role="tab" aria-controls="wizard5" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Module 5</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard6-tab" href="#wizard6" data-bs-toggle="tab" role="tab" aria-controls="wizard6" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Module 6</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard7-tab" href="#wizard7" data-bs-toggle="tab" role="tab" aria-controls="wizard7" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Module 7</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard8-tab" href="#wizard8" data-bs-toggle="tab" role="tab" aria-controls="wizard8" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Module 8</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard9-tab" href="#wizard9" data-bs-toggle="tab" role="tab" aria-controls="wizard9" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Module 9</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizards1-tab" href="#wizards1" data-bs-toggle="tab" role="tab" aria-controls="wizards1" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">c1</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizards2-tab" href="#wizards2" data-bs-toggle="tab" role="tab" aria-controls="wizards2" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">c2</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizards3-tab" href="#wizards3" data-bs-toggle="tab" role="tab" aria-controls="wizards3" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">c3</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">
     
                    <div class="tab-pane py-3 fade show active" id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                        <h4>Refresher to the QAR Program</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($m1 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane py-3 fade show" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                        <h4>Pre-engagement activities</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($m2 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane py-3 fade show" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                        <h4>Audit Planning</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($m3 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane py-3 fade show" id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                        <h4>Cash</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($m4 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane py-3 fade show" id="wizard5" role="tabpanel" aria-labelledby="wizard5-tab">
                        <h4>Auditing Revenues and Receivables</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($m5 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane py-3 fade show" id="wizard6" role="tabpanel" aria-labelledby="wizard6-tab">
                        <h4>Inventories</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($m6 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane py-3 fade show" id="wizard7" role="tabpanel" aria-labelledby="wizard7-tab">
                        <h4>Property, plant, and equipment</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($m7 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane py-3 fade show" id="wizard8" role="tabpanel" aria-labelledby="wizard8-tab">
                        <h4>Expense</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($m8 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane py-3 fade show" id="wizard9" role="tabpanel" aria-labelledby="wizard9-tab">
                        <h4>Concluding the audit</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($m9 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['mtID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane py-5 fade show" id="wizards1" role="tabpanel" aria-labelledby="wizards1-tab">
                        <h4>Chapter 1</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($c1 as $r){?>
                                    <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                    
                                        <?php if($r['code'] == 'AC10'){?>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-icon btn-sm" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Tangibles/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Tangibles</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-PPE/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">PPE</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Investments/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Investments</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Inventory/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Inventory</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Trade Receivables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Trade Receivables</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Other Receivables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Other Receivables</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Bank and Cash/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Bank and Cash</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Trade Payables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Trade Payables</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Other Payables/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Other Payables</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Provisions/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Provisions</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Revenue/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Revenue</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Costs/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Costs</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Payroll/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Payroll</a>
                                                    <a target="_blank"class="dropdown-item" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>-Summary/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>">Summary</a>
                                                </div>
                                            </div>
                                        <?php }else{?>
                                            <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c1titleID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Wizard tab pane item 2-->
                    <div class="tab-pane py-5 fade" id="wizards2" role="tabpanel" aria-labelledby="wizards2-tab">
                        <h4>Chapter 2</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($c2 as $r){?>
                                <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c2" value="c2" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter2/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c2titleID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Wizard tab pane item 3-->
                    <div class="tab-pane py-5 fade" id="wizards3" role="tabpanel" aria-labelledby="wizards3-tab">
                        <h4>Chapter 3</h4>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Select</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 60%;">Title</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($c3 as $r){?>
                                <tr>
                                    <td>
                                    <?php if(session()->get('allowed')->add == "Yes"){?>
                                        <input class="form-check-input filecheck" id="add" type="checkbox" name="c3" value="c3" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <?php if($r['code'] == '3.10 Aa11'){?>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-icon btn-sm" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $r['code']?>-un/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>">Unadjusted Errors</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $r['code']?>-ad/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>">Adjusted Mades</a>
                                                </div>
                                            </div>
                                        <?php }else{?>
                                            <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $r['code']?>/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['c3titleID']))?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                    <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>


<script>
    $(document).ready(function () {

        $('.filecheck').change(function(){

            var yn = this.checked ? 'Yes' : 'No';
            var val = $(this).val();
            var urladd = $(this).data('urladd');
            var urlremove = $(this).data('urlremove');
            if(yn == 'Yes'){
                url = urladd
            }
            if(yn == 'No'){
                url = urlremove
            }
            $.ajax({
                url: url, 
                type: 'POST',
                data: { checked: val , ischeck: yn},
                success: function(response) {
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    
                }
            });
        });

    });
</script>



