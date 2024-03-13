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
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bc1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $bc1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bc2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $bc2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bc3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $bc3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bc4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $bc4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bc5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $bc5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bc6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $bc6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $bcgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bce1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bce1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bce2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bce2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bce3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bce3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcpd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcpd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcpd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcpd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($bcpd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $bcpd3['question']?></textarea>
                            </td>
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
            
                <br>
                <br>


                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE RECEIVABLES:</h6>
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tr1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tr1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tr2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tr2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tr3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tr3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tr4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tr4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tr5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tr5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tr6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tr6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $trgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tre1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tre1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tre2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tre2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tre3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tre3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trpd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trpd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trpd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trpd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($trpd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $trpd3['question']?></textarea>
                            </td>
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

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER RECEIVABLES (INCLUDING PREPAYMENTS):</h6>
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($or1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $or1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($or2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $or2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($or3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $or3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($or4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $or4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($or5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $or5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($or6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $or6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $orgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ore1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ore1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ore2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ore2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ore3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ore3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orpd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orpd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orpd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orpd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($orpd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $orpd3['question']?></textarea>
                            </td>
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

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVENTORIES:</h6>
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inv1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inv1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inv2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inv2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inv3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inv3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inv4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inv4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inv5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inv5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inv6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inv6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $invgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inve1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $inve1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inve2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $inve2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inve3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $inve3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invpd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invpd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invpd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invpd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invpd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invpd3['question']?></textarea>
                            </td>
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


                <br>
                <br>


                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVESTMENTS:</h6>
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invst1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $invst1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invst2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $invst2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invst3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $invst3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invst4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $invst4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invst5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $invst5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invst6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $invst6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $invstgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invste1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invste1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invste2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invste2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invste3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invste3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstpd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstpd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstpd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstpd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($invstpd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $invstpd3['question']?></textarea>
                            </td>
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

                <br>
                <br>

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROPERTY, PLANT AND EQUIPMENT:</h6>
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppe1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $ppe1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppe2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $ppe2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppe3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $ppe3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppe4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $ppe4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppe5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $ppe5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppe6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $ppe6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppegen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $ppegen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppee1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppee1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppee2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppee2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppee3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppee3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppero1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppero1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppero2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppero2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppero3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppero3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppec1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppec1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppec2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppec2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppec3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppec3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppeva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppeva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppeva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppeva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppeva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppeva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppepd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppepd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppepd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppepd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ppepd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ppepd3['question']?></textarea>
                            </td>
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
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inca1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inca1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inca2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inca2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inca3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inca3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inca4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inca4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inca5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inca5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($inca6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $inca6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incagen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $incagen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incae1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incae1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incae2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incae2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incae3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incae3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incaro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incaro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incaro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incaro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incaro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incaro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incac1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incac1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incac2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incac2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incac3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incac3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incava1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incava1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incava2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incava2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incava3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incava3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incapd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incapd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incapd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incapd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($incapd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $incapd3['question']?></textarea>
                            </td>
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
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tp1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tp1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tp2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tp2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tp3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tp3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tp4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tp4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tp5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tp5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tp6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tp6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $tpgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpe1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpe1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpe2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpe2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpe3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpe3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tpva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tpva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tppd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tppd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tppd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tppd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tppd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $tppd3['question']?></textarea>
                            </td>
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
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($op1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $op1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($op2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $op2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($op3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $op3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($op4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $op4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($op5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $op5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($op6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $op6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $opgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ope1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ope1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ope2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ope2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($ope3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $ope3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $opro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $opro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $opro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $opc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $opc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $opc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $opva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $opva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($opva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $opva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oppd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oppd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oppd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oppd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oppd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oppd3['question']?></textarea>
                            </td>
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

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TAXATION:</h6>
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tax1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tax1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tax2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tax2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tax3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tax3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tax4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tax4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tax5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tax5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($tax6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $tax6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $taxgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxe1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxe1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxe2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxe2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxe3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxe3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxpd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxpd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxpd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxpd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($taxpd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $taxpd3['question']?></textarea>
                            </td>
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
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pfl1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pfl1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pfl2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pfl2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pfl3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pfl3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pfl4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pfl4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pfl5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pfl5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pfl6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pfl6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $pflgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pfle1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pfle1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pfle2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pfle2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pfle3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pfle3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflpd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflpd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflpd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflpd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pflpd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pflpd3['question']?></textarea>
                            </td>
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
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roi1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $roi1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roi2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $roi2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roi3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $roi3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roi4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $roi4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roi5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $roi5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roi6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $roi6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roigen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $roigen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roie1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roie1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roie2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roie2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roie3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roie3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roiro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roiro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roiro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roiro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roiro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roiro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roic1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roic1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roic2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roic2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roic3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roic3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roiva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roiva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roiva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roiva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roiva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roiva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roipd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roipd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roipd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roipd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($roipd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $roipd3['question']?></textarea>
                            </td>
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

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – DIRECT COSTS / OTHER EXPENSES:</h6>
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoe1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $dcoe1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoe2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $dcoe2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoe3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $dcoe3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoe4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $dcoe4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoe5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $dcoe5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoe6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $dcoe6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoegen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $dcoegen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoee1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoee1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoee2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoee2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoee3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoee3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoero1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoero1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoero2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoero2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoero3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoero3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoec1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoec1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoec2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoec2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoec3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoec3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoeva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoeva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoeva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoeva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoeva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoeva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoepd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoepd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoepd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoepd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($dcoepd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $dcoepd3['question']?></textarea>
                            </td>
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

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PAYROLL:</h6>
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pr1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pr1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pr2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pr2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pr3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pr3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pr4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pr4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pr5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pr5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pr6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $pr6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prgen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $prgen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pre1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pre1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pre2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pre2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($pre3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $pre3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prc1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prc1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prc2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prc2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prc3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prc3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prva1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prva1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prva2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prva2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prva3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prva3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prpd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prpd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prpd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prpd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($prpd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $prpd3['question']?></textarea>
                            </td>
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

                <h6>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – [OTHER AREA]:</h6>
                <table class="table table-bordered">
                <form action="<?= base_url()?>auditsystem/c1/s1/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                
                    <tr>
                        <td>1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oa1['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $oa1['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oa2['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $oa2['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oa3['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $oa3['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oa4['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $oa4['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oa5['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $oa5['yesno']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                        <td>
                            <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oa6['acID']))?>" name="acid[]">
                            <input class="form-control" type="text" name="yesno[]" placeholder="Yer or No" value="<?= $oa6['yesno']?>">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success float-end btn-block">Save</button>
                            </div>
                        </td>
                    </tr>
                    </form>
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
                    <form action="<?= base_url()?>auditsystem/c1/s2/update/AC7/<?= $header?>/<?= $c1tID?>" method="post">
                        <tr>
                            <td rowspan="5">
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oagen['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="30" name="question[]"><?= $oagen['question']?></textarea>
                            </td>
                            <td>Existence</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oae1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oae1['question']?></textarea>
                            </td>

                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oae2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oae2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oae3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oae3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Rights / Obligations</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oaro1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oaro1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oaro2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oaro2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oaro3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oaro3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Completeness</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oac1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oac1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oac2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oac2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oac3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oac3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>Valuation / Allocation</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oava1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oava1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oava2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oava2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oava3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oava3['question']?></textarea>
                            </td>
                        </tr>
                        <tr>
                           
                            <td>Presentation and Disclosure</td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oapd1['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oapd1['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oapd2['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oapd2['question']?></textarea>
                            </td>
                            <td>
                                <input type="hidden" value="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($oapd3['acID']))?>" name="acid[]">
                                <textarea class="form-control" cols="30" rows="3" name="question[]"><?= $oapd3['question']?></textarea>
                            </td>
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
