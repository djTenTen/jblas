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
               <!-- Contents Here -->
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter1/view/')?><?= $code?>/<?= $c1tID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>PROVISION OF NON-AUDIT SERVICES</h4>
                    <h6>Section 2 – Consideration of the Type of Non-Audit Services Provided and Safeguards in Place </h6>
                    <p>N.B. Complete multiple sheets if more than four different types of non-audit service are provided N.B. Audit related non-audit services (for example, a separate report to a regulator, (e.g. that on client money handled by a solicitor)) should still be treated as a non-audit service, but it is not necessary for safeguards to be put in place, as threats to independence are insignificant</p>
                    <form action="<?= base_url()?>auditsystem/client/saveac2/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="part" value="pans">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Non-audit service to be provided:</th>
                                    <th>Corporation tax</th>
                                    <th>Statutoryservices</th>
                                    <th>Accountancy(including preparation of financial statements)</th>
                                    <th>Other (specify)</th>
                                    <th>Total CU</th>

                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php foreach($ac2 as $r){?>
                                    <tr >
                                        <td><input type="hidden" name="acid[]" value="<?= $crypt->encrypt($r['acID'])?>"><?= $r['question']?></td>
                                        <td><input class="form-control" type="text" name="corptax[]" value="<?= $r['corptax']?>"></td>
                                        <td><input class="form-control" type="text" name="statutory[]" value="<?= $r['statutory']?>"></td>
                                        <td><input class="form-control" type="text" name="accountancy[]" value="<?= $r['accountancy']?>" ></td>
                                        <td><input class="form-control" type="text" name="other[]" value="<?= $r['other']?>"></td>
                                        <td><input class="form-control" type="text" name="totalcu[]" value="<?= $r['totalcu']?>"></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                    <h4>Section 3 – Consideration of Self Interest Threat Arising from Substantial Fees from Non Audit Services</h4>
                    <div class="container border-dark">
                        <h6>***(Where appropriate): Documentation by the A.E.P. of how the self interest threat has been reduced to an acceptable level / details of communication with the Ethics Partner / Details of which services (audit or non-audit) will not be provided:</h6>
                        <form action="<?= base_url()?>auditsystem/client/saveac2aep/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $name?>" method="post">
                            <input type="hidden" name="acid" value="<?= $crypt->encrypt($aep['acID'])?>">
                            <textarea class="form-control" cols="30" rows="3" name="eap" required><?= $aep['question']?></textarea>
                            <h4>Conclusion</h4>
                            <select name="concl" id="" class="form-control form-select" required>
                                <option value="<?= $aep['name']?>" selected><?= $aep['name']?></option>
                                <option value="The client has informed management.  I consider that there are no threats arising from fee income from the non-audit services provided / to be provided to the client and that the services can be provided.">The client has informed management.  I consider that there are no threats arising from fee income from the non-audit services provided / to be provided to the client and that the services can be provided.</option>
                                <option value="The client has informed management. I consider that the threats imposed by the non-audit services provided / to be provided to the client and the resulting level of fee income have been reduced to an acceptable level as documented above.">The client has informed management. I consider that the threats imposed by the non-audit services provided / to be provided to the client and the resulting level of fee income have been reduced to an acceptable level as documented above.</option>
                                <option value="We will not provide other services as it is not possible to put sufficient safeguards in place and we wish to remain as auditor">We will not provide other services as it is not possible to put sufficient safeguards in place and we wish to remain as auditor</option>
                                <option value="We will provide other services but because it is not possible to put sufficient safeguards in place, we will resign as auditor">We will provide other services but because it is not possible to put sufficient safeguards in place, we will resign as auditor</option>
                            </select>
                            <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>
