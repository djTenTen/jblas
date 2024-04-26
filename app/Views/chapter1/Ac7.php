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
                <h4>SPECIFIC AREA NARRATIVE INHERENT RISK ASSESSMENT</h4>
                <p>Objective: This form is designed to assess the risk for each audit assertion relevant to each audit area.  PSA 315 implies that all areas and all assertions are high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
                <p>The risk forms should not be completed until –</p>
                <ul>
                    <li>Appropriate enquiries have been made of management;</li>
                    <li>Points forward from last year have been considered;</li>
                    <li>The permanent audit file has been reviewed; and</li>
                    <li>Preliminary analytical procedures have been carried out.</li>
                </ul>
                <p>Notes on completion of this document –</p>
                <ul>
                    <li>A list of possible risk factors has been collated (Appendix 1.14.1) can be used as an aide memoire;</li>
                    <li>An answer of “Yes” to one of the preliminary questions on each audit area will mean that there are potential risks associated with that area, and therefore a full commentary for that audit area will be required; and</li>
                    <li>Sections which are less than expected performance materiality or are not applicable should be deleted.</li>
                </ul>
                <h6>Specific Considerations relating to Revenue</h6>
                <p>Per PSA 240, paragraph 26 “the auditor shall, based on a presumption that there are risks of fraud in revenue recognition, evaluate which types of revenue, revenue transactions or assertions give rise to such risks”.  Paragraph 47 states “if the auditor has concluded that the presumption that there is a risk of material misstatement due to fraud related to revenue recognition is not applicable in the circumstances of the engagement, the auditor shall include in the audit documentation the reasons for that conclusion”. </p>
                <p>It is therefore expected that the risk attributed to Revenue will be high unless there is sufficient justification given to rebut the presumption of high risk. Paragraphs A28 to A30 of the Application and Other Explanatory Material of PSA 240 should be referred to for additional guidance.</p>
                <p>If the risk of fraud in revenue recognition cannot be rebutted, it is a significant risk (see below).</p>
                <p>Significant risks: <br> All risks which are deemed to be significant should be specifically highlighted.  A significant risk is one which would be a “blockbuster”.  A risk may be deemed to be significant for the following reasons:</p>
                <ul>
                    <li>The risk is a risk of fraud;</li>
                    <li>The risk is related to significant economic, accounting or other developments, and therefore, requiring specific attention;</li>
                    <li>The complexity of transactions;</li>
                    <li>Whether the risk involves significant transactions with related parties;</li>
                    <li>The degree of subjectivity in the measurement of the financial information related to the risk; </li>
                    <li>Whether the risk involves significant transactions (including those with related parties) that are outside the normal course of business; and</li>
                </ul>
                <p>Where significant risks have been identified:</p>
                <ul>
                    <li>At the assertion level, substantive procedures specific to that risk need to be performed;</li>
                    <li>The entity's controls relevant to those risks should be understood; </li>
                    <li>They will automatically be deemed to be “high risk”, and other risks will be deemed to be “low risk”.  The “default” risk can (and should) be over-ridden if it is deemed to be appropriate.  Reasons should be fully documented;</li>
                    <li>They will be communicated to the client at the planning stage in the Planning Letter; and</li>
                    <li>How the risk has been addressed during the assignment should be summarized on the PSA Compliance Critical Issues Memorandum.</li>
                </ul>
                <hr>
                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="bacdata" name="part">
                            <input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $bacdata['y1']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $bacdata['y2']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $bacdata['y3']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $bacdata['y4']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $bacdata['y5']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $bacdata['y6']?>">
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
                    <button type="submit" class="btn btn-success float-end btn-block"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE RECEIVABLES:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="trdata" name="part">
                            <input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $trdata['y1']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $trdata['y2']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $trdata['y3']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $trdata['y4']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $trdata['y5']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $trdata['y6']?>">
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
                    <button type="submit" class="btn btn-success float-end btn-block"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER RECEIVABLES (INCLUDING PREPAYMENTS):</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="ordata" name="part">
                            <input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $ordata['y1']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $ordata['y2']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $ordata['y3']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $ordata['y4']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $ordata['y5']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $ordata['y6']?>">
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
                    <button type="submit" class="btn btn-success float-end btn-block"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVENTORIES:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="invtrdata" name="part">
                            <input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $invtrdata['y1']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $invtrdata['y2']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $invtrdata['y3']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $invtrdata['y4']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $invtrdata['y5']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $invtrdata['y6']?>">
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </form>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVESTMENTS:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="invmtdata" name="part">
                            <input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $invmtdata['y1']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $invmtdata['y2']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $invmtdata['y3']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $invmtdata['y4']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $invmtdata['y5']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $invmtdata['y6']?>">
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
                    <button type="submit" class="btn btn-success float-end btn-block"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROPERTY, PLANT AND EQUIPMENT:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="ppedata" name="part">
                            <input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $ppedata['y1']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $ppedata['y2']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $ppedata['y3']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $ppedata['y4']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $ppedata['y5']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $ppedata['y6']?>">
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </form>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INTANGIBLE NON-CURRENT ASSETS:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="incadata" name="part">
                            <input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $incadata['y1']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $incadata['y2']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $incadata['y3']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $incadata['y4']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $incadata['y5']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $incadata['y6']?>">
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </form>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE PAYABLES:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td><input type="hidden" value="tpdata" name="part"><input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $tpdata['y1']?>"></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td><input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $tpdata['y2']?>"></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td><input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $tpdata['y3']?>"></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td><input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $tpdata['y4']?>"></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td><input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $tpdata['y5']?>"></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td><input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $tpdata['y6']?>"></td>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </form>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER PAYABLES (INCLUDING ACCRUALS):</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td><input type="hidden" value="opdata" name="part"><input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $opdata['y1']?>"></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td><input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $opdata['y2']?>"></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td><input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $opdata['y3']?>"></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td><input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $opdata['y4']?>"></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td><input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $opdata['y5']?>"></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td><input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $opdata['y6']?>"></td>
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
                    <button type="submit" class="btn btn-success float-end btn-block"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TAXATION:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td><input type="hidden" value="taxdata" name="part"><input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $taxdata['y1']?>"></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td><input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $taxdata['y2']?>"></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td><input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $taxdata['y3']?>"></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td><input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $taxdata['y4']?>"></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td><input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $taxdata['y5']?>"></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td><input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $taxdata['y6']?>"></td>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </form>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROVISIONS FOR LIABILITIES:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td><input type="hidden" value="provdata" name="part"><input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $provdata['y1']?>"></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td><input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $provdata['y2']?>"></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td><input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $provdata['y3']?>"></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td><input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $provdata['y4']?>"></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td><input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $provdata['y5']?>"></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td><input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $provdata['y6']?>"></td>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </form>
                </table>
                

                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – REVENUE / OTHER INCOME:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td><input type="hidden" value="roidata" name="part"><input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $roidata['y1']?>"></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td><input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $roidata['y2']?>"></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td><input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $roidata['y3']?>"></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td><input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $roidata['y4']?>"></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td><input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $roidata['y5']?>"></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td><input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $roidata['y6']?>"></td>
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
                    <button type="submit" class="btn btn-success float-end btn-block"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – DIRECT COSTS / OTHER EXPENSES:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td><input type="hidden" value="dcodata" name="part"><input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $dcodata['y1']?>"></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td><input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $dcodata['y2']?>"></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td><input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $dcodata['y3']?>"></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td><input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $dcodata['y4']?>"></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td><input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $dcodata['y5']?>"></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td><input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $dcodata['y6']?>"></td>
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
                    <button type="submit" class="btn btn-success float-end btn-block"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>
                <br><br><br><hr>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PAYROLL:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td><input type="hidden" value="prdata" name="part"><input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $prdata['y1']?>"></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td><input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $prdata['y2']?>"></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td><input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $prdata['y3']?>"></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td><input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $prdata['y4']?>"></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td><input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $prdata['y5']?>"></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td><input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $prdata['y6']?>"></td>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </form>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER AREA:</h6>
                <form action="<?= base_url()?>auditsystem/c1/saveac7/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                <table class="table table-bordered">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td><input type="hidden" value="oadata" name="part"><input class="form-control" type="text" name="y1" placeholder="Yer or No" value="<?= $oadata['y1']?>"></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td><input class="form-control" type="text" name="y2" placeholder="Yer or No" value="<?= $oadata['y2']?>"></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td><input class="form-control" type="text" name="y3" placeholder="Yer or No" value="<?= $oadata['y3']?>"></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td><input class="form-control" type="text" name="y4" placeholder="Yer or No" value="<?= $oadata['y4']?>"></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td><input class="form-control" type="text" name="y5" placeholder="Yer or No" value="<?= $oadata['y5']?>"></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td><input class="form-control" type="text" name="y6" placeholder="Yer or No" value="<?= $oadata['y6']?>"></td>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </form>
                </table>


            </div>
        </div>
    </div>
    
</main>
