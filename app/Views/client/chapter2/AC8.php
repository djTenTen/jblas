
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
            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row" id="cardTab" role="tablist">
                    <!-- Wizard navigation item 1-->
                    <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">B & C</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-bs-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">T.R</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard3-tab" href="#wizard3" data-bs-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">O.R</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard4-tab" href="#wizard4" data-bs-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Invtry</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard5-tab" href="#wizard5" data-bs-toggle="tab" role="tab" aria-controls="wizard5" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Invtmnt</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard6-tab" href="#wizard6" data-bs-toggle="tab" role="tab" aria-controls="wizard6" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">PPE</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard7-tab" href="#wizard7" data-bs-toggle="tab" role="tab" aria-controls="wizard7" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">INCA</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard8-tab" href="#wizard8" data-bs-toggle="tab" role="tab" aria-controls="wizard8" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">T.P</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard9-tab" href="#wizard9" data-bs-toggle="tab" role="tab" aria-controls="wizard9" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">O.P</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard10-tab" href="#wizard10" data-bs-toggle="tab" role="tab" aria-controls="wizard10" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Tax</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard11-tab" href="#wizard11" data-bs-toggle="tab" role="tab" aria-controls="wizard11" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Prov.</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard12-tab" href="#wizard12" data-bs-toggle="tab" role="tab" aria-controls="wizard12" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Rev.</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard13-tab" href="#wizard13" data-bs-toggle="tab" role="tab" aria-controls="wizard13" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">D.C</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard14-tab" href="#wizard14" data-bs-toggle="tab" role="tab" aria-controls="wizard14" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">P.R</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard15-tab" href="#wizard15" data-bs-toggle="tab" role="tab" aria-controls="wizard15" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">O.A</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter2/view/')?><?= $code?>/<?= $mtID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <h4>SPECIFIC AREA NARRATIVE INHERENT RISK ASSESSMENT</h4>
                <p>Objective: This form is designed to assess the risk for each audit assertion relevant to each audit area.  PSA 315 implies that all areas and all assertions are high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
                <div class="tab-content" id="cardTabContent">
                    <!-- Wizard tab pane item 1-->
                    <div class="tab-pane fade show active m-5" id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="bacdata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $bacdata['y1']?>" selected><?= $bacdata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $bacdata['y2']?>" selected><?= $bacdata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $bacdata['y3']?>" selected><?= $bacdata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $bacdata['y4']?>" selected><?= $bacdata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $bacdata['y5']?>" selected><?= $bacdata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $bacdata['y6']?>" selected><?= $bacdata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $bacdata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $bacdata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $bacdata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $bacdata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $bacdata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $bacdata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $bacdata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $bacdata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $bacdata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $bacdata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $bacdata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $bacdata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $bacdata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $bacdata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $bacdata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $bacdata['pd3']?></textarea></td>
                                    </tr>
                                    </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE RECEIVABLES:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="trdata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $trdata['y1']?>" selected><?= $trdata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $trdata['y2']?>" selected><?= $trdata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $trdata['y3']?>" selected><?= $trdata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $trdata['y4']?>" selected><?= $trdata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $trdata['y5']?>" selected><?= $trdata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $trdata['y6']?>" selected><?= $trdata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $trdata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $trdata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $trdata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $trdata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $trdata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $trdata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $trdata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $trdata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $trdata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $trdata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $trdata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $trdata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $trdata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $trdata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $trdata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $trdata['pd3']?></textarea></td>
                                    </tr>
                                    </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER RECEIVABLES (INCLUDING PREPAYMENTS):</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="ordata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $ordata['y1']?>" selected><?= $ordata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $ordata['y2']?>" selected><?= $ordata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $ordata['y3']?>" selected><?= $ordata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $ordata['y4']?>" selected><?= $ordata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $ordata['y5']?>" selected><?= $ordata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $ordata['y6']?>" selected><?= $ordata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $ordata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $ordata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $ordata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $ordata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $ordata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $ordata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $ordata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $ordata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $ordata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $ordata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $ordata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $ordata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $ordata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $ordata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $ordata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $ordata['pd3']?></textarea></td>
                                    </tr>
                                    </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVENTORIES:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="invtrdata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $invtrdata['y1']?>" selected><?= $invtrdata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $invtrdata['y2']?>" selected><?= $invtrdata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $invtrdata['y3']?>" selected><?= $invtrdata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $invtrdata['y4']?>" selected><?= $invtrdata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $invtrdata['y5']?>" selected><?= $invtrdata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $invtrdata['y6']?>" selected><?= $invtrdata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $invtrdata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $invtrdata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $invtrdata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $invtrdata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $invtrdata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $invtrdata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $invtrdata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $invtrdata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $invtrdata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $invtrdata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $invtrdata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $invtrdata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $invtrdata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $invtrdata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $invtrdata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $invtrdata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard5" role="tabpanel" aria-labelledby="wizard5-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVESTMENTS:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="invmtdata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $invmtdata['y1']?>" selected><?= $invmtdata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $invmtdata['y2']?>" selected><?= $invmtdata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $invmtdata['y3']?>" selected><?= $invmtdata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $invmtdata['y4']?>" selected><?= $invmtdata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $invmtdata['y5']?>" selected><?= $invmtdata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $invmtdata['y6']?>" selected><?= $invmtdata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $invmtdata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $invmtdata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $invmtdata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $invmtdata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $invmtdata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $invmtdata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $invmtdata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $invmtdata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $invmtdata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $invmtdata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $invmtdata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $invmtdata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $invmtdata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $invmtdata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $invmtdata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $invmtdata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>   
                    </div>
                    <div class="tab-pane fade m-5" id="wizard6" role="tabpanel" aria-labelledby="wizard6-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROPERTY, PLANT AND EQUIPMENT:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="ppedata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $ppedata['y1']?>" selected><?= $ppedata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $ppedata['y2']?>" selected><?= $ppedata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $ppedata['y3']?>" selected><?= $ppedata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $ppedata['y4']?>" selected><?= $ppedata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $ppedata['y5']?>" selected><?= $ppedata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $ppedata['y6']?>" selected><?= $ppedata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $ppedata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $ppedata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $ppedata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $ppedata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $ppedata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $ppedata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $ppedata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $ppedata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $ppedata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $ppedata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $ppedata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $ppedata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $ppedata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $ppedata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $ppedata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $ppedata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard7" role="tabpanel" aria-labelledby="wizard7-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INTANGIBLE NON-CURRENT ASSETS:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="incadata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $incadata['y1']?>" selected><?= $incadata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $incadata['y2']?>" selected><?= $incadata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $incadata['y3']?>" selected><?= $incadata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $incadata['y4']?>" selected><?= $incadata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $incadata['y5']?>" selected><?= $incadata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $incadata['y6']?>" selected><?= $incadata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $incadata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $incadata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $incadata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $incadata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $incadata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $incadata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $incadata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $incadata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $incadata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $incadata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $incadata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $incadata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $incadata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $incadata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $incadata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $incadata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard8" role="tabpanel" aria-labelledby="wizard8-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE PAYABLES:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="tpdata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $tpdata['y1']?>" selected><?= $tpdata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $tpdata['y2']?>" selected><?= $tpdata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $tpdata['y3']?>" selected><?= $tpdata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $tpdata['y4']?>" selected><?= $tpdata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $tpdata['y5']?>" selected><?= $tpdata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $tpdata['y6']?>" selected><?= $tpdata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $tpdata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $tpdata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $tpdata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $tpdata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $tpdata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $tpdata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $tpdata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $tpdata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $tpdata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $tpdata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $tpdata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $tpdata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $tpdata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $tpdata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $tpdata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $tpdata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard9" role="tabpanel" aria-labelledby="wizard9-tab">
                    <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER PAYABLES (INCLUDING ACCRUALS):</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="opdata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $opdata['y1']?>" selected><?= $opdata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $opdata['y2']?>" selected><?= $opdata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $opdata['y3']?>" selected><?= $opdata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $opdata['y4']?>" selected><?= $opdata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $opdata['y5']?>" selected><?= $opdata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $opdata['y6']?>" selected><?= $opdata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $opdata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $opdata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $opdata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $opdata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $opdata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $opdata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $opdata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $opdata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $opdata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $opdata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $opdata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $opdata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $opdata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $opdata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $opdata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $opdata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard10" role="tabpanel" aria-labelledby="wizard10-tab">
                    <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TAXATION:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="taxdata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $taxdata['y1']?>" selected><?= $taxdata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $taxdata['y2']?>" selected><?= $taxdata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $taxdata['y3']?>" selected><?= $taxdata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $taxdata['y4']?>" selected><?= $taxdata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $taxdata['y5']?>" selected><?= $taxdata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $taxdata['y6']?>" selected><?= $taxdata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $taxdata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $taxdata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $taxdata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $taxdata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $taxdata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $taxdata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $taxdata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $taxdata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $taxdata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $taxdata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $taxdata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $taxdata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $taxdata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $taxdata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $taxdata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $taxdata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard11" role="tabpanel" aria-labelledby="wizard11-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROVISIONS FOR LIABILITIES:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="provdata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $provdata['y1']?>" selected><?= $provdata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $provdata['y2']?>" selected><?= $provdata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $provdata['y3']?>" selected><?= $provdata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $provdata['y4']?>" selected><?= $provdata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $provdata['y5']?>" selected><?= $provdata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $provdata['y6']?>" selected><?= $provdata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $provdata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $provdata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $provdata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $provdata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $provdata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $provdata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $provdata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $provdata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $provdata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $provdata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $provdata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $provdata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $provdata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $provdata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $provdata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $provdata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard12" role="tabpanel" aria-labelledby="wizard12-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – REVENUE / OTHER INCOME:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="roidata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $roidata['y1']?>" selected><?= $roidata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $roidata['y2']?>" selected><?= $roidata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $roidata['y3']?>" selected><?= $roidata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $roidata['y4']?>" selected><?= $roidata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $roidata['y5']?>" selected><?= $roidata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $roidata['y6']?>" selected><?= $roidata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $roidata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $roidata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $roidata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $roidata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $roidata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $roidata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $roidata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $roidata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $roidata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $roidata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $roidata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $roidata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $roidata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $roidata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $roidata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $roidata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard13" role="tabpanel" aria-labelledby="wizard13-tab">
                    <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – DIRECT COSTS / OTHER EXPENSES:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="dcodata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $dcodata['y1']?>" selected><?= $dcodata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $dcodata['y2']?>" selected><?= $dcodata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $dcodata['y3']?>" selected><?= $dcodata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $dcodata['y4']?>" selected><?= $dcodata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $dcodata['y5']?>" selected><?= $dcodata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $dcodata['y6']?>" selected><?= $dcodata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $dcodata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $dcodata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $dcodata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $dcodata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $dcodata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $dcodata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $dcodata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $dcodata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $dcodata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $dcodata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $dcodata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $dcodata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $dcodata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $dcodata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $dcodata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $dcodata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard14" role="tabpanel" aria-labelledby="wizard14-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PAYROLL:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="prdata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $prdata['y1']?>" selected><?= $prdata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $prdata['y2']?>" selected><?= $prdata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $prdata['y3']?>" selected><?= $prdata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $prdata['y4']?>" selected><?= $prdata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $prdata['y5']?>" selected><?= $prdata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $prdata['y6']?>" selected><?= $prdata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $prdata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $prdata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $prdata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $prdata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $prdata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $prdata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $prdata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $prdata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $prdata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $prdata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $prdata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $prdata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $prdata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $prdata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $prdata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $prdata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                    <div class="tab-pane fade m-5" id="wizard15" role="tabpanel" aria-labelledby="wizard15-tab">
                        <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER AREA:</h6>
                        <form action="<?= base_url()?>auditsystem/client/savevalues/c2/saveac7/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $name?>" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                    <td>
                                        <input type="hidden" value="oadata" name="part">
                                        <select name="y1" id="" class="form-select">
                                            <option value="<?= $oadata['y1']?>" selected><?= $oadata['y1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                    <td>
                                        <select name="y2" id="" class="form-select">
                                            <option value="<?= $oadata['y2']?>" selected><?= $oadata['y2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                    <td>
                                        <select name="y3" id="" class="form-select">
                                            <option value="<?= $oadata['y3']?>" selected><?= $oadata['y3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                    <td>
                                        <select name="y4" id="" class="form-select">
                                            <option value="<?= $oadata['y4']?>" selected><?= $oadata['y4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                    <td>
                                        <select name="y5" id="" class="form-select">
                                            <option value="<?= $oadata['y5']?>" selected><?= $oadata['y5']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                    <td>
                                        <select name="y6" id="" class="form-select">
                                            <option value="<?= $oadata['y6']?>" selected><?= $oadata['y6']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                            <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High)</th>
                                        <th>Assertion</th>
                                        <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                        <th>Impact on the audit including how risk has been addressed</th>
                                        <th>Audit test reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="gen"><?= $oadata['gen']?></textarea></td>
                                        <td>Existence</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e1"><?= $oadata['e1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e2"><?= $oadata['e2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="e3"><?= $oadata['e3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Rights / Obligations</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro1"><?= $oadata['ro1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro2"><?= $oadata['ro2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="ro3"><?= $oadata['ro3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Completeness</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c1"><?= $oadata['c1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c2"><?= $oadata['c2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="c3"><?= $oadata['c3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Valuation / Allocation</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va1"><?= $oadata['va1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va2"><?= $oadata['va2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="va3"><?= $oadata['va3']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Disclosure</td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd1"><?= $oadata['pd1']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd2"><?= $oadata['pd2']?></textarea></td>
                                        <td><textarea class="form-control" cols="30" rows="3" name="pd3"><?= $oadata['pd3']?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-end btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>
