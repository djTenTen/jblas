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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/wp/viewpdfc3/')?><?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>GOING CONCERN CHECKLIST</h4>
                    <h6>Objective:</h6>
                    <p>To ensure that the fundamental concept of going concern is fully considered and that the requirements of ISA 570 are met.</p>
                    <h6>Overview:  Under the going concern assumption, an entity is viewed as continuing in business for the foreseeable future.  Financial statements are prepared on a going concern basis, unless management either intends to liquidate the entity or to cease to operate, or has no realistic alternative to do so (in these circumstances the financial statements are prepared on a break-up basis).</h6>
                    <h6>Part 1 – Discussion with the Client Regarding Going Concern:</h6>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveaa3b/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" value="p1" name="part">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Question</th>
                                    <th style="width: 50%;">Values</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($bp1 as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= encr($r['mdID'])?>"><?= $r['field1']?></td>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field2']?></textarea></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Part 2 – The Auditor’s Assessment ~ General Considerations:</h6>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveaa3b/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" value="p2" name="part">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Question</th>
                                    <th style="width: 50%;">Values</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($bp2 as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= encr($r['mdID'])?>"><?= $r['field1']?></td>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field2']?></textarea></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Part 3a – The Auditor’s Assessment ~ Specific Concerns:</h6>
                    <h6><i>Completion of this section is optional unless potential issues regarding the going concern presumption have been identified in Parts 1 or 2 above.</i></h6>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveaa3b/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" value="p3a" name="part">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Question</th>
                                    <th style="width: 50%;">Values</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($bp3a as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= encr($r['mdID'])?>"><?= $r['field1']?></td>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field2']?></textarea></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Part 3b – The Auditor’s Assessment ~ Disclosure considerations:</h6>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveaa3b/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" value="p3b" name="part">
                        <table class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Question</th>
                                    <th style="width: 50%;">Values</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($bp3b as $r){?>
                                    <tr>
                                        <td><input type="hidden" name="acid[]" value="<?= encr($r['mdID'])?>"><?= $r['field1']?></td>
                                        <td><textarea class="form-control reference" id="reference" cols="30" rows="3" name="reference[]"><?= $r['field2']?></textarea></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h6>Part 4 – Conclusion:</h6>
                    <p>Where potential problems with the going concern presumption have been identified, summarise the issue and resolution:</p>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveaa3bp4/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <table class="table table-bordered">
                            <tr><input type="hidden" name="acid" value="<?= $mdID?>">
                                <td><textarea class="form-control" cols="30" rows="15" name="p41" required><?= $bp4['p41'];?></textarea></td>
                                <td><textarea class="form-control" cols="30" rows="15" name="p42" required><?= $bp4['p42'];?></textarea></td>
                            </tr>
                        </table>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-1" for="num10yes">On the basis of the work recorded above, I consider that:</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="bwr1" type="checkbox" name="bwr1" value="The financial statements have been correctly prepared on the break-up basis." <?php if($bp4['bwr1'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="bwr1">The financial statements have been correctly prepared on the break-up basis.</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="bwr2" type="checkbox" name="bwr2" value="The going concern concept " <?php if($bp4['bwr2'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="bwr2">The going concern concept  </label>
                                    <select name="bwr2d" id="bwr2d" class="form-select">
                                        <option value="<?= $bp4['bwr2d'];?>" selected><?= $bp4['bwr2d'];?></option>
                                        <option value="is">is</option>
                                        <option value="is not">is not</option>
                                    </select>
                                    <label class="form-check-label" for="bwr2d">correctly applied to this client..</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="bwr3" type="checkbox" name="bwr3" value="There is " <?php if($bp4['bwr3'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="bwr3">There is  </label>
                                    <select name="bwr3d" id="bwr3d" class="form-select">
                                        <option value="<?= $bp4['bwr3d'];?>" selected><?= $bp4['bwr3d'];?></option>
                                        <option value="no concern">no concern</option>
                                        <option value="concern">concern</option>
                                        <option value="significant concern">significant concern</option>
                                    </select>
                                    <label class="form-check-label" for="bwr3d">regarding the going concern concept for this client.</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="bwr4" type="checkbox" name="bwr4" value="The notes to the financial statements " <?php if($bp4['bwr4'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="bwr4">The notes to the financial statements  </label>
                                    <select name="bwr4d" id="bwr4d" class="form-select">
                                        <option value="<?= $bp4['bwr4d'];?>" selected><?= $bp4['bwr4d'];?></option>
                                        <option value="require">require</option>
                                        <option value="do not require">do not require</option>
                                    </select>
                                    <label class="form-check-label" for="bwr4d">additional information regarding the going concern concept.</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="bwr5" type="checkbox" name="bwr5" value="The audit report should be " <?php if($bp4['bwr5'] != ''){echo 'checked';}?>/>
                                    <label class="form-check-label" for="bwr5">The audit report should be  </label>
                                    <select name="bwr5d" id="bwr5d" class="form-select">
                                        <option value="<?= $bp4['bwr5d'];?>" selected><?= $bp4['bwr5d'];?></option>
                                        <option value="unmodified">unmodified</option>
                                        <option value="unmodified with a “Material uncertainty related to going concern” ">unmodified with a “Material uncertainty related to going concern” </option>
                                        <option value="qualified with respect to going concern">qualified with respect to going concern</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>






















