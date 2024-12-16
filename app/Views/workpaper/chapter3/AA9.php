
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
                    <h4>AUDITOR’S OBJECTIVE:</h4>
                    <ol type="a">The objectives of the auditor, having read the other information, are
                        <li>)To consider whether there is a material inconsistency between the other information and the financial statements;</li>
                        <li>)To consider whether there is a material inconsistency between the other information and the auditor’s knowledge obtained in the audit;</li>
                        <li>)To respond appropriately when the auditor identifies that such material inconsistencies appear to exist, or when the auditor otherwise becomes aware that other information appears to be materially misstated; and</li>
                        <li>)To report in accordance with this PSA.</li>
                    </ol>
                    <h4>AUDIT PROCEDURES</h4>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c3/saveaa9/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $mdID?>">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 60%;"></th>
                                    <th>WP REF.</th>
                                    <th>DONE BY</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p>1.	Determine, through discussion with management, which document(s) comprises the annual report, and the entity’s planned manner and timing of the issuance of such document(s);</p>
                                        <p>2.	Make appropriate arrangements with management to obtain in a timely manner and, if possible, prior to the date of the auditor’s report, the final version of the document(s) comprising the annual report; </p>
                                        <p>3.	When some or all of the document(s) determined  will not be available until after the date of the auditor’s report, request management to provide a written representation that the final version of the document(s) will be provided to the auditor when available, and prior to its issuance by the entity, such that the auditor can complete the procedures required by this PSA.</p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref1"><?= $a9['wpref1']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby1"><?= $a9['doneby1']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>4.	The auditor shall read the other information and consider whether there is a material inconsistency between the other information and the financial statements. </p>
                                        <p>5.	As the basis for the above consideration, the auditor shall, to evaluate their consistency, compare selected amounts or other items in the other information (that are intended to be the same as, to summarize, or to provide greater detail about, the amounts or other items in the financial statements) with such amounts or other items in the financial statements; </p>
                                        <p>6.	Consider whether there is a material inconsistency between the other information and the auditor’s knowledge obtained in the audit, in the context of audit evidence obtained and conclusions reached in the audit. </p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref2"><?= $a9['wpref2']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby2"><?= $a9['doneby2']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>7.	While reading the other information, the auditor shall remain alert for indications that the other information not related to the financial statements or the auditor’s knowledge obtained in the audit appears to be materially misstated.</p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref3"><?= $a9['wpref3']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby3"><?= $a9['doneby3']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>8.	If the auditor identifies that a material inconsistency appears to exist (or becomes aware that the other information appears to be materially misstated), the auditor shall discuss the matter with management and, if necessary, perform other procedures to conclude whether: (a) A material misstatement of the other information exists; (b) A material misstatement of the financial statements exists; or (c) The auditor’s understanding of the entity and its environment needs to be updated.</p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref4"><?= $a9['wpref4']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby4"><?= $a9['doneby4']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>9.	If the auditor concludes that a material misstatement of the other information exists, the auditor shall request management to correct the other information. </p>
                                        <p>10.	If management agrees to make the correction, the auditor shall determine that the correction has been made.</p>
                                        <p>11.	If management refuses to make the correction, the auditor shall communicate the matter with those charged with governance and request that the correction be made.</p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref5"><?= $a9['wpref5']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby5"><?= $a9['doneby5']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>12.	If the auditor concludes that a material misstatement exists in other information obtained prior to the date of the auditor’s report, and the other information is not corrected after communicating with those charged with governance, the auditor shall take appropriate action, including communicating with those charged with governance about how the auditor plans to address the material misstatement in the auditor’s report; or withdrawing from the engagement, where withdrawal is possible under applicable law or regulation.</p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref6"><?= $a9['wpref6']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby6"><?= $a9['doneby6']?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>