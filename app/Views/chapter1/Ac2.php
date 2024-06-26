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
            <?php if (session()->get('success_update')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Update</h6>
                        Contents has been successfully updated.
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
            <div class="card-body">
               <!-- Contents Here -->
                <hr>
                <h4>PROVISION OF NON-AUDIT SERVICES</h4>
                <h6>Aim:</h6>
                <p>To give adequate consideration of the acceptability of providing non-audit services to entities which are not listed (or affiliates of such an entity).</p>
                <h6>The form must be completed prior to the commencement of each type of non-audit work (including the preparation of statutory financial statements) undertaken either by the firm, or by any network firm, and approved by the A.E.P. (or, in the A.E.P.’s absence, another A.E.P. within the firm).  </h6>
                <h6>For new audit clients, this should extend to non-audit services provided prior to appointment, but relating to a period that the firm will audit. In subsequent years, consideration should be given before any work is undertaken on the audit.</h6>
                <p>This checklist only provides general guidance and reference should be made to IESBA’s Section 290: Independence ~ Audit and Review Engagements where any doubts exist. In particular, this form does not consider:</p>
                <ul>
                    <li>Internal Audit Services;</li>
                    <li>IT Services;</li>
                    <li>Recruiting Services; and</li>
                    <li>Corporate Finance Services.</li>
                </ul>
                <p>If any of the above is to be undertaken, this should be separately considered, with reference to the IESBA Code of Ethics.</p>
                <h6>NB: If the client does not have ‘informed management’ the provision of both audit and non-audit services is not permitted.</h6>
                <h6>Section 1 – Consideration of Prohibited Services</h6>
            
                <div class="container">
                    <img src="<?= base_url()?>img/ac2/ac2 flow1.png" alt="">
                </div>
                <h6>Section 2 – Consideration of the Type of Non-Audit Services Provided and Safeguards in Place </h6>
                <p>N.B. Complete multiple sheets if more than four different types of non-audit service are provided
                N.B. Audit related non-audit services (for example, a separate report to a regulator, (e.g. that on client money handled by a solicitor)) should still be treated as a non-audit service, but it is not necessary for safeguards to be put in place, as threats to independence are insignificant
                </p>
                <form action="<?= base_url()?>auditsystem/c1/saveac2/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
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
                                <th>Status</th>
                                <th style="width: 7%;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach($ac2 as $r){?>
                                <tr >
                                    <td><textarea class="form-control" cols="30" rows="3" name="question[]"><?= $r['question']?></textarea></td>
                                    <td><input class="form-control" type="text" name="corptax[]" value="<?= $r['corptax']?>"></td>
                                    <td><input class="form-control" type="text" name="statutory[]" value="<?= $r['statutory']?>"></td>
                                    <td><input class="form-control" type="text" name="accountancy[]" value="<?= $r['accountancy']?>" ></td>
                                    <td><input class="form-control" type="text" name="other[]" value="<?= $r['other']?>"></td>
                                    <td><input class="form-control" type="text" name="totalcu[]" value="<?= $r['totalcu']?>"></td>
                                    <td class="text-center"><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button>
                                        <?php if($r['status'] == 'Active'){?>
                                            <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['acID']))?>" data-status="<?= $r['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                        <?php }else{?>
                                            <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-ac-id="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['acID']))?>" data-status="<?= $r['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary m-1 float-end add-field  btn-sm" type="button"><i class="fas fa-plus-square m-1"></i>Add Field</button>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br>
                <hr>
                <h4>Section 3 – Consideration of Self Interest Threat Arising from Substantial Fees from Non Audit Services</h4>
                <div class="container">
                    <img src="<?= base_url()?>img/ac2/ac2 flow2.png" alt="">
                </div>
                <div class="container border-dark">
                    <h6>***(Where appropriate): Documentation by the A.E.P. of how the self interest threat has been reduced to an acceptable level / details of communication with the Ethics Partner / Details of which services (audit or non-audit) will not be provided:</h6>
                    <form action="<?= base_url()?>auditsystem/c1/saveac2aep/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                        <input type="hidden" name="part" value="ac2aep">
                        <textarea class="form-control border-dark" cols="30" rows="3" name="eap" required><?= $aep['question']?></textarea>
                </div>
                <h4>Conclusion</h4>
                        <select name="concl" id="" class="form-control form-select" required>
                            <option value="<?= $aep['name']?>" selected><?= $aep['name']?></option>
                            <option value="The client has informed management.  I consider that there are no threats arising from fee income from the non-audit services provided / to be provided to the client and that the services can be provided.">The client has informed management.  I consider that there are no threats arising from fee income from the non-audit services provided / to be provided to the client and that the services can be provided.</option>
                            <option value="The client has informed management. I consider that the threats imposed by the non-audit services provided / to be provided to the client and the resulting level of fee income have been reduced to an acceptable level as documented above.">The client has informed management. I consider that the threats imposed by the non-audit services provided / to be provided to the client and the resulting level of fee income have been reduced to an acceptable level as documented above.</option>
                            <option value="We will not provide other services as it is not possible to put sufficient safeguards in place and we wish to remain as auditor">We will not provide other services as it is not possible to put sufficient safeguards in place and we wish to remain as auditor</option>
                            <option value="We will provide other services but because it is not possible to put sufficient safeguards in place, we will resign as auditor">We will provide other services but because it is not possible to put sufficient safeguards in place, we will resign as auditor</option>
                        </select>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                <div>
                    Signature:	(A.E.P.) Date:	 * Delete as appropriate
                </div>
                <div>
                    <h6>Notes:</h6>
                    <p>1.	The audit firm can set their own criteria, but non-audit fees greater than three times the audit fee are likely to create a self-interest threat, which needs to be mitigated.</p>
                    <p>2.	Although the audit firm can set its own criteria, in circumstances where the audit fee is more significant to the firm, non-audit fees which represent a lower multiple of the audit fee are likely to be considered ‘substantial’.</p>
                    <h4>Definitions:</h4>
                    <table class="table">
                    <tr>
                        <td><h6>Audit related non-audit services:</h6></td>
                        <td>
                            <p>The following are generally treated as being audit related non-audit services:</p>
                            <ul>
                                <li>Reporting required by law or regulation to be provided by the auditor;</li>
                                <li>Reviews of interim financial information;</li>
                                <li>Reporting on regulatory returns;</li>
                                <li>Reporting to a regulator on client assets;</li>
                                <li>Reporting on government grants;</li>
                                <li>Reporting on internal financial controls when required by law or regulation; and</li>
                                <li>Extended audit work that is authorized by those charged with governance performed on financial information and / or financial controls where this work is integrated with the audit work and is performed on the same principal terms and conditions.</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><h6>“Informed management”:</h6></td>
                        <td>
                            <p>Member of management (or senior employee), of the audited entity who has the authority and capability to make independent management judgments and decisions in relation to non-audit services on the basis of information provided by the audit firm.</p>
                        </td>
                    </tr>
                    <tr>
                        <td><h6>Safeguards:</h6></td>
                        <td>
                            <p>Safeguards include:</p>
                            <ul>
                                <li>Non-audit services provided by the firm are performed by partners and staff who have no involvement in the external audit of the financial statements; or</li>
                                <li>The non-audit services are reviewed by a partner or other senior staff member with appropriate expertise who is not a member of the audit team; or</li>
                                <li>An engagement quality control review is performed.</li>
                            </ul>
                        </td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</main>
<script>
    $(document).ready(function () {
        $(".active-data").on("click", function() {
            var status = $(this).data('status');
            var acID = $(this).data('ac-id');
                $('#myactiveform').attr('action', "<?= base_url('auditsystem/c1/activeinactive/')?><?= $code?>/<?= $header?>/<?= $c1tID?>/" + acID);
                if (status == 'Active') {
                    $('.msgconfirm').html(`<h3>Are you sure to Disable this content?</h3>`);
                }else{
                    $('.msgconfirm').html(`<h3>Are you sure to Enable this content?</h3>`);
                }
        });
        $('.add-field').on('click', function () {
        // Adding a row inside the tbody.
        var form = $(this).closest('form');
        var tbody = form.find('tbody');
        tbody.append(`
        <tr>
            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
            <td><input class="form-control" type="text" name="corptax[]"></td>
            <td><input class="form-control" type="text" name="statutory[]"></td>
            <td><input class="form-control" type="text" name="accountancy[]"></td>
            <td><input class="form-control" type="text" name="other[]"></td>
            <td><input class="form-control" type="text" name="totalcu[]"></td>
            <td></td>
            <td><button class="btn btn-danger btn-icon btn-sm remove" type="button" data-action="remove"><i class="fas fa-trash"></i></button></td>
        </tr>`);
        });
        $('.tbody').on('click', 'button.remove', function () {
            $(this).closest('tr').remove();
        });
    });
</script>
