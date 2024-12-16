
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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $code?>/<?= $mtID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>AUDITOR’S OBJECTIVE:</h4>
                    <ol type="a">
                        <li>)To communicate clearly with those charged with governance the responsibilities of the auditor in relation to the financial statement audit, and an overview of the planned scope and timing of the audit; </li>
                        <li>)To obtain from those charged with governance information relevant to the audit; </li>
                        <li>)To provide those charged with governance with timely observations arising from the audit that are significant and relevant to their responsibility to oversee the financial reporting process; and </li>
                        <li>)To promote effective two-way communication between the auditor and those charged with governance.  </li>
                    </ol>
                    <h4>AUDIT PROCEDURES</h4>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa10/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $mdID?>">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 60%;"><i><b>The auditor should determine the appropriate persons within the organization’s governance structure with whom to communicate.</b></i></th>
                                    <th>WP REF.</th>
                                    <th>DONE BY</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p>1.	Based on the results of obtaining an understanding of the entity and its environment, identify the relevant persons who are charged with governance and with whom audit matters of governance interest are communicated.</p>
                                        <p>2.	Where necessary, use judgment to determine those persons with whom audit matters of governance interest are communicated, taking into account:</p>
                                        <ul>
                                            <li>the governance structure of the entity</li>
                                            <li>the circumstances of the engagement and any relevant legislation; and </li>
                                            <li>the legal responsibilities of those persons.</li>
                                        </ul>
                                        <p>3.	When the entity’s governance structure is not well defined, or those charged with governance are not clearly identified by the circumstances of the engagement, or by legislation, come to an agreement with the entity about with whom audit matters of governance interest are to be communicated.</p>
                                        <p>4.	Include in the audit engagement letter an explanation that </p>
                                        <ul>
                                            <li>We will communicate only those matters of governance interest that come to attention as a result of the performance of an audit  </li>
                                            <li>We are not required to design audit procedures for the specific purpose of identifying matters of governance interest.</li>
                                        </ul>
                                        <p>5.	As necessary,include in the engagement letter:</p>
                                        <ul>
                                            <li>a description of the form in which any communications on audit matters of governance interest will be made</li>
                                            <li>identification of the relevant persons with whom such communications will be made; </li>
                                            <li>identification of any specific audit matters of governance interest which it has been agreed are to be communicated.</li>
                                        </ul>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref1"><?= $a10['wpref1']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby1"><?= $a10['doneby1']?></textarea></td>
                                </tr>
                                <tr>
                                    <td><i><b>The auditor shall communicate with those charged with governance the responsibilities of the auditor in relation to the financial statements audit</b></i></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>6.	Review the results of procedures for acceptance/retention of clients, and audit planning, for possible matters of governance interest.  Such matters may include:</p>
                                        <ul>
                                            <li>Planned scope anf timing of the audit;</li>
                                            <li>Significant risks identified that may require special audit consideration,</li>
                                        </ul>
                                        <p>7.	During the performance of risk assessment procedures, identify the potential effect on the financial statements of any material risks and exposures, such as pending litigation, that are required to be disclosed in the financial statements.</p>
                                        <p>8.	During the performance of the audit, identify audit adjustments (whether or not recorded by the entity) that have, or could have, a material effect on the entity’s financial statements</p>
                                        <p>9.	Identify other matters of governance interest.</p>
                                        <p>10.	Using the form of communication agreed with the client, summarize the matters of governance interest and communicate the same to those charged with governance.</p>
                                        <p>11.	Inform those charged with governance regarding those uncorrected misstatements we aggregated during the audit that were determined by management to be immaterial, both individually and in the aggregate, to the financial statements taken as a whole.</p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref2"><?= $a10['wpref2']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby2"><?= $a10['doneby2']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>12.	When audit matters of governance interest are communicated orally, document in the working papers the matters communicated and any responses to those matters. 
                                            <br> This documentation may take the form of a copy of the minutes of the auditor’s discussion with those charged with governance. 
                                        </p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref3"><?= $a10['wpref3']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby3"><?= $a10['doneby3']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>13.	Where deemed necessary, depending on the nature, sensitivity, and significance of the matter, confirm in writing with those charged with governance any oral communications on audit matters of governance interest.</p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref4"><?= $a10['wpref4']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby4"><?= $a10['doneby4']?></textarea></td>
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