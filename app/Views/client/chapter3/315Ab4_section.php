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
                <nav class="nav nav-borders">
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'checklist')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-checklist/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Checklist</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section1')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-section1/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 1</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section2')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-section2/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 2</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section3')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-section3/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 3</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section4')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-section4/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 4</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section5')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-section5/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 5</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section6')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-section6/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 6</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section7')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-section7/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 7</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section8')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-section8/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 8</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section9')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/client/chapter3/setvalues/3.15 Ab4-section9/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 9</a>
                </nav>
                <hr class="mt-0 mb-4" style="color: #7752FE;"/>
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter3/view/')?>3.15 Ab4/<?= $c3tID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <div class="m-5">
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveab4/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="<?= $section?>">
                        <table class="table table-bordered">
                            <thead>
                                <tr>    
                                    <th colspan="6"><?= $sectiontitle?></th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th colspan="2" style="width: 5%;">Reference</th>
                                    <th style="width: 55%;">Questions</th>
                                    <th style="width: 10%;">Y/N/NA</th>
                                    <th style="width: 30%;">Comments</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($sec as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['reference']?></td>
                                        <td><?= $r['extent']?></td>
                                        <td><?= $r['question']?></td>
                                        <td>
                                            <select name="yesno[]" id="" class="form-select">
                                                <option value="<?= $r['yesno']?>" selected><?= $r['yesno']?></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="N/A">N/A</option>
                                            </select>    
                                        </td>
                                        <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                    </tr>
                                <?php }?>
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




