<?php  
    function encr($ecr){
        $crypt = \Config\Services::encrypter();
        return str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ecr));
    }
?>
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
                    <a class="nav-item nav-link active" id="wizards1-tab" href="#wizards1" data-bs-toggle="tab" role="tab" aria-controls="wizards1" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Pre-Engagement Activities</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizards2-tab" href="#wizards2" data-bs-toggle="tab" role="tab" aria-controls="wizards2" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Audit Planning</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizards3-tab" href="#wizards3" data-bs-toggle="tab" role="tab" aria-controls="wizards3" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Concluding the Audit</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">
     
                    <div class="tab-pane py-5 fade show active" id="wizards1" role="tabpanel" aria-labelledby="wizards1-tab">
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
                                        <input class="form-check-input filecheck" type="checkbox" name="c1" value="c1" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= encr($r['mtID'])?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= encr($r['mtID'])?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $r['code']?>/<?= encr($r['mtID'])?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
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
                                        <input class="form-check-input filecheck" type="checkbox" name="c2" value="c2" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= encr($r['mtID'])?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= encr($r['mtID'])?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <?php if($r['code'] == 'AC10'){?>
                                            <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter2/view/')?><?= $r['code']?>-Summary/<?= encr($r['mtID'])?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                        <?php }else{?>
                                            <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter2/view/')?><?= $r['code']?>/<?= encr($r['mtID'])?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
                                        <?php }?>
                                       
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
                                        <input class="form-check-input filecheck" type="checkbox" name="c3" value="c3" data-urladd="<?= base_url('auditsystem/client/setfiles')?>/<?= $cID?>/<?= encr($r['mtID'])?>" data-urlremove="<?= base_url('auditsystem/client/removefiles')?>/<?= $cID?>/<?= encr($r['mtID'])?>" <?php if($r['yn'] == 'Yes'){echo 'checked';}?>/></td>
                                    <?php }?>
                                    <td><?= $r['code']?></td>
                                    <td><?= $r['title']?></td>
                                    <td>
                                        <?php if($r['code'] == 'AA8'){?>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-icon btn-sm" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-eye"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $r['code']?>-un/<?= encr($r['mtID'])?>">Unadjusted Errors</a>
                                                    <a target="_blank" class="dropdown-item" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $r['code']?>-ad/<?= encr($r['mtID'])?>">Adjusted Mades</a>
                                                </div>
                                            </div>
                                        <?php }else{?>
                                            <a class="btn btn-primary btn-icon btn-sm" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $r['code']?>/<?= encr($r['mtID'])?>" target="_blank" title="View"><i class="fas fa-eye"></i></a>
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



