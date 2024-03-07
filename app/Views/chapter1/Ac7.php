
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
            <div class="card-body">
               
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

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>
            
                <br>
                <br>


                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE RECEIVABLES:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER RECEIVABLES (INCLUDING PREPAYMENTS):</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVENTORIES:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>


                <br>
                <br>


                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVESTMENTS:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROPERTY, PLANT AND EQUIPMENT:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INTANGIBLE NON-CURRENT ASSETS:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE PAYABLES:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER PAYABLES (INCLUDING ACCRUALS):</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TAXATION:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROVISIONS FOR LIABILITIES:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – REVENUE / OTHER INCOME:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – DIRECT COSTS / OTHER EXPENSES:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PAYROLL:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>


                <br><br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – [OTHER AREA]:</h6>
                <table class="table">
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>Yes<input type="checkbox" name="" id=""> No<input type="checkbox" name="" id=""></td>
                    </tr>
                </table>

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
                            <td rowspan="5"><textarea class="form-control" cols="30" rows="30" name="question[]"></textarea></td>
                            <td>Existence</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Rights / Obligations</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                            <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</main>
