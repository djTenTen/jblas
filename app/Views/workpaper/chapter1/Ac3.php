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
            <?php if (session()->get('invalid_input')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Invalid Input</h6>
                        Something wrong with your data inputd, please try again.
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
            <div class="card-body">
                <hr>
                <h4>PERMANENT FILE CHECKLIST</h4>
                <p>Objective: This form is to be used to ensure the permanent file contains sufficient background information about the client. </p>
                <p>This is a mandatory form.  Any “no” answers indicate a deficiency on the permanent file and a comment should be made as to how this will be addressed.</p>
                <p>Per PSA 315, para A128c, “Disclosures in the financial statements of smaller entities may be less detailed or less complex (e.g., some financial reporting frameworks allow smaller entities to provide fewer disclosures in the financial statements). However, this does not relieve the auditor of the responsibility to obtain an understanding of the entity and its environment, including internal control, as it relates to disclosures.”</p>
                <form action="<?= base_url()?>auditsystem/wp/saveac3/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    <h3>General Matters</h3>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 55%;">Question</th>
                                <th style="width: 10%;">Yes/No</th>
                                <th style="width: 35%;">Comment</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac3genmat as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td>
                                        <select name="yesno[]" id="" class="form-select">
                                            <option value="<?= $r['yesno']?>" selected><?= $r['yesno']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br>
                <hr>
                <form action="<?= base_url()?>auditsystem/wp/saveac3/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    <input type="hidden" name="part" value="doccors">
                    <h3>Documents and Correspondence of a Permanent Nature</h3>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 55%;">Question</th>
                                <th style="width: 10%;">Yes/No</th>
                                <th style="width: 35%;">Comment</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac3doccors as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td>
                                        <select name="yesno[]" id="" class="form-select">
                                            <option value="<?= $r['yesno']?>" selected><?= $r['yesno']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br>
                <hr>
                <form action="<?= base_url()?>auditsystem/wp/saveac3/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    <input type="hidden" name="part" value="statutory">
                    <h3>Statutory Matters</h3>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 55%;">Question</th>
                                <th style="width: 10%;">Yes/No</th>
                                <th style="width: 35%;">Comment</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac3statutory as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td>
                                        <select name="yesno[]" id="" class="form-select">
                                            <option value="<?= $r['yesno']?>" selected><?= $r['yesno']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br>
                <hr>
                <form action="<?= base_url()?>auditsystem/wp/saveac3/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                    <input type="hidden" name="part" value="accsys">
                    <h3>The Accounting System</h3>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 55%;">Question</th>
                                <th style="width: 10%;">Yes/No</th>
                                <th style="width: 35%;">Comment</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac3accsys as $r){?>
                                <tr>
                                    <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                    <td>
                                        <select name="yesno[]" id="" class="form-select">
                                            <option value="<?= $r['yesno']?>" selected><?= $r['yesno']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
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

