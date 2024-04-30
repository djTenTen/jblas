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
                        <h6 class="alert-heading">Failed update</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">
                
                <nav class="nav nav-borders">
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'checklist')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-checklist/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Checklist</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section1')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-section1/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Section 1</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section2')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-section2/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Section 2</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section3')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-section3/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Section 3</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section4')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-section4/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Section 4</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section5')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-section5/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Section 5</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section6')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-section6/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Section 6</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section7')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-section7/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Section 7</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section8')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-section8/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Section 8</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section9')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/wp/chapter3/setvalues/3.15 Ab4-section9/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>">Section 9</a>
                </nav>
                <hr class="mt-0 mb-4" />
                <br>

                <form action="<?= base_url()?>auditsystem/wp/saveab4/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    <input type="hidden" name="part" value="<?= $section?>">
                    <table class="table table-bordered">
                        <thead>
                            <tr>    
                                <th colspan="6"><?= $sectiontitle?></th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th colspan="2">Reference</th>
                                <th>Questions</th>
                                <th>Y/N/NA</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($sec as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['reference']?></td>
                                    <td><?= $r['extent']?></td>
                                    <td><?= $r['question']?></td>
                                    <td><textarea class="form-control yesno" id="yesno" cols="30" rows="3" name="yesno[]"><?= $r['yesno']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>

                </form>
                <br><br><br><hr>
           
            </div>
        </div>
    </div>
    
</main>




