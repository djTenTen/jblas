
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
                    <p>The objective of the auditor, having formed an opinion on the financial statements, is to draw users’ attention, when in the auditor’s judgment it is necessary to do so, </p>
                    <ol type="a">
                        <li>) A matter, although appropriately presented or disclosed in the financial statements, that is of such importance that it is fundamental to users’ understanding of the financial statements; or </li>
                        <li>) As appropriate, any other matter that is relevant to users’ understanding of the audit, the auditor’s responsibilities or the auditor’s report. </li>
                    </ol>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveaa12/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
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
                                        <p><b><i>If the auditor considers it necessary to draw users’ attention to a matter presented or disclosed in the financial statements that, in the auditor’s judgment, is of such importance that it is fundamental to users’ understanding of the financial statements, the auditor shall include an Emphasis of Matter paragraph in the auditor’s report provided: </i></b></p>
                                        <ol type="a">
                                            <li><b><i>)The auditor would not be required to modify the opinion in accordance with PSA 705 (Revised)3 as a result of the matter; and </i></b></li>
                                            <li><b><i>)When PSA 701 applies, the matter has not been determined to be a key audit matter to be communicated in the auditor’s report. </i></b></li>
                                        </ol>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref1"><?= $a12['wpref1']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby1"><?= $a12['doneby1']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>When the auditor includes an Emphasis of Matter paragraph in the auditor’s report, the auditor shall: </p>
                                        <ol type="a">
                                            <li>Include the paragraph within a separate section of the auditor’s report with an appropriate heading that includes the term “Emphasis of Matter”; </li>
                                            <li>Include in the paragraph a clear reference to the matter being emphasized and to where relevant disclosures that fully describe the matter can be found in the financial statements. The paragraph shall refer only to information presented or disclosed in the financial statements; and </li>
                                            <li>Indicate that the auditor’s opinion is not modified in respect of the matter emphasized. </li>
                                        </ol>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref2"><?= $a12['wpref2']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby2"><?= $a12['doneby2']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b><i>If the auditor considers it necessary to communicate a matter other than those that are presented or disclosed in the financial statements that, in the auditor’s judgment, is relevant to users’ understanding of the audit, the auditor’s responsibilities or the auditor’s report, the auditor shall include an Other Matter paragraph in the auditor’s report, provided: </i></b></p>
                                        <ol type="a">
                                            <li><b><i>) This is not prohibited by law or regulation; and </i></b></li>
                                            <li><b><i>) When PSA 701 applies, the matter has not been determined to be a key audit matter to be communicated in the auditor’s report.</i></b></li>
                                        </ol>
                                        <p><b><i>When the auditor includes an Other Matter paragraph in the auditor’s report, the auditor shall include the paragraph within a separate section with the heading “Other Matter,” or other appropriate heading.</i></b></p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref3"><?= $a12['wpref3']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby3"><?= $a12['doneby3']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b><i>If the auditor expects to include an Emphasis of Matter or an Other Matter paragraph in the auditor’s report, the auditor shall communicate with those charged with governance regarding this expectation and the wording of this paragraph.</i></b></p>
                                    </td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="wpref4"><?= $a12['wpref4']?></textarea></td>
                                    <td><textarea class="form-control comment" id="comment" cols="30" rows="5" name="doneby4"><?= $a12['doneby4']?></textarea></td>
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