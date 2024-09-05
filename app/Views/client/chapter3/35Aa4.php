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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $code?>/<?= $c3tID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h1 class="text-center">SUGGESTED LETTER OF REPRESENTATION</h1>
                    <form class="form-inline" action="<?= base_url()?>auditsystem/client/saveaa4/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                        <div class="row justify-content-center">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1" for="leg1">We confirm that the following representations are made on the basis of enquiries of management and staff with relevant knowledge and experience and where appropriate, of inspection of supporting documentation, sufficient to satisfy ourselves that we can properly make each of the following representations to you in connection with your audit of the company's financial statements for the year ended [date].</label>
                                        <label class="mb-1" for="leg2">We acknowledge our legal responsibilities regarding disclosure of information to you as auditors and confirm that so far as we are aware, there is no relevant audit information needed by you in connection with preparing your audit report of which you are unaware.  Each director has taken all the steps that they ought to have taken as a director in order to make themselves aware of any relevant audit information and to establish that you are aware of that information.</label>
                                    </div>
                                </div>
                                <h6>Financial Statements:</h6>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1" for="leg1">1. We acknowledge, and have fulfilled, as directors, our collective responsibility under:</label>
                                        <input class="form-control" id="leg1" type="text" placeholder="Insert legislation" name="leg1" value="<?= $aa4['leg1']?>" />
                                        <label class="mb-1" for="leg2">for presenting financial statements (in accordance with:</label>
                                        <input class="form-control" id="leg2" type="text" placeholder="Insert legislation" name="leg2" value="<?= $aa4['leg2']?>" />
                                        <label class="mb-1" for="leg2"> and International Financial Reporting Standards), which give a true and fair view of the financial position of the company at the reporting date, and of its result for the period then ended, and for making accurate representations to you.  We confirm that we have approved the financial statements for the year ended [date]. </label>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1" for="isa">2. We confirm that the accounting policies and estimation techniques:</label>
                                        <input class="form-control" id="isa" type="text" value="<?= $aa4['isa']?>" placeholder="Insert including significant assumptions used to determine estimates measured at fair value" name="isa" />
                                        <label class="mb-1" for="isa">adopted for the preparation of the financial statements are the most appropriate to the circumstances in which the company operates.</label>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1" for="leg3">3. Other than as disclosed in the financial statements, the company has not entered into any transactions involving directors, officers or other related parties, which require disclosure under:</label>
                                        <input class="form-control" id="leg3" type="text" value="<?= $aa4['leg3']?>" placeholder="Insert legislation" name="leg3" />
                                        <label class="mb-1" for="leg3">adopted for the preparation of the financial statements are the most appropriate to the circumstances in which the company operates.</label>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1">4.	We have disclosed all known or possible litigation and claims whose effects should be considered when preparing the financial statements and these have been disclosed in accordance with the requirements of accounting standards.</label>
                                        <label class="mb-1">5.	The financial statements of the company have been prepared on the going concern basis as we believe that adequate cash resources will be available to cover the company’s requirements for working capital and capital expenditure for at least the next twelve months.  We are not aware of any other factors which could put into jeopardy the company’s going concern status during or beyond this period.</label>
                                        <label class="mb-1">6.	There have been no events since the reporting date which necessitate revision of the figures included in the financial statements or inclusion of a note thereto.  Should further material events occur, which may necessitate revision of the figures included in the financial statements or inclusion of a note thereto, we will advise you accordingly.</label>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1" for="num7">7.</label>
                                        <select name="num7" id="num7" class="form-select">
                                            <option value="<?= $aa4['num7']?>" selected><?= $aa4['num7']?></option>
                                            <option value="We confirm that we have considered the unadjusted errors advised to us by you as appended to this letter.  It is our view that the cost of making these adjustments to the financial statements outweighs any benefits that will be gained by the users of the financial statements.  The combined effect of the unadjusted errors is not material and we do not consider that their absence from the financial statements affects the true and fair view given.">We confirm that we have considered the unadjusted errors advised to us by you as appended to this letter.  It is our view that the cost of making these adjustments to the financial statements outweighs any benefits that will be gained by the users of the financial statements.  The combined effect of the unadjusted errors is not material and we do not consider that their absence from the financial statements affects the true and fair view given.</option>
                                            <option value="We confirm that we have been notified by you that either no unadjusted or only clearly trivial errors were identified during the audit.">We confirm that we have been notified by you that either no unadjusted or only clearly trivial errors were identified during the audit.</option>
                                        </select>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1">8.	We confirm that we have agreed the adjustments appended to this letter which have been made to the performance statement(s), and statement of financial position which we presented to you for audit.</label>
                                        <label class="mb-1">9.	We confirm we have no plans or intentions that may materially affect the carrying value or classification of any assets and liabilities reflected in the financial statements.</label>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1" for="num10yes">The following three paragraphs should only be included where applicable:</label>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" id="num10yes" type="checkbox" name="num10yes" value="With regard to the defined benefit pension plan, we are satisfied that:
                                            <ul>
                                                <li>the actuarial assumptions underlying the valuation are consistent with our knowledge of the business;</li>
                                                <li>all significant retirement benefits have been identified and properly accounted for; and</li>
                                                <li>all settlements and curtailments have been identified and properly accounted for.</li>
                                            </ul>" <?php if($aa4['num10yes'] != ''){echo 'checked';}?>/>
                                            <label class="form-check-label" for="num10yes">
                                                10. With regard to the defined benefit pension plan, we are satisfied that:
                                                <ul>
                                                    <li>the actuarial assumptions underlying the valuation are consistent with our knowledge of the business;</li>
                                                    <li>all significant retirement benefits have been identified and properly accounted for; and</li>
                                                    <li>all settlements and curtailments have been identified and properly accounted for.</li>
                                                </ul>
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" id="num11yes" type="checkbox" name="num11yes" value="num11yes" <?php if($aa4['num11yes'] != ''){echo 'checked';}?>/>
                                            <label class="form-check-label" for="num11yes">11. Where there has been a prior period adjustment as a result of a material error, and comparative information has been restated, a specific representation is required (ISA 710.9).</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <textarea class="form-control" name="num11" id="num11yes" cols="30" rows="5" placeholder="Insert prior period adjustment"><?php if($aa4['num11yes'] != ''){echo $aa4['num11'];}?></textarea>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" id="num12yes" type="checkbox" name="num12yes" value="num12yes" <?php if($aa4['num12yes'] != ''){echo 'checked';}?>/>
                                            <label class="form-check-label" for="num12yes">12. Add any additional representations related to new or revised accounting standards that are being implemented for the first time that have a material impact on financial statements</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <textarea class="form-control" name="num12" id="num12yes" cols="30" rows="5" placeholder="Insert additional representations"><?php if($aa4['num12yes'] != ''){echo $aa4['num12'];}?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <h6>Information provided:</h6>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1">13.	All the accounting records have been made available to you for the purpose of your audit and all the transactions undertaken by the company have been properly reflected and recorded in the accounting records.  We have provided to you all other information requested and given unrestricted access to persons within the entity from whom you have deemed it necessary to speak to.  All other records and relevant information, including minutes of all management and shareholders' meetings, have been made available to you.</label>
                                        <label class="mb-1">14.	Other than those disclosed in the financial statements we are not aware of any material liabilities, provisions, contingent liabilities, contingent assets or contracted for capital commitments, that need to be provided for or disclosed in the financial statements.</label>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">about:blank#blocked
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1" for="num15">15. The company has satisfactory title to all assets and there are no liens or encumbrances on the company’s assets:</label>
                                        <input class="form-control" id="num15" type="text" value="<?= $aa4['num15']?>" placeholder="Enter except as disclosed in the notes to the financial statements" name="num15" />
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1" for="num16">16. We confirm that the functional currency of the company is:</label>
                                        <input class="form-control" id="num16" type="text" value="<?= $aa4['num16']?>" placeholder="Enter Currency" name="num16" />
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1" for="num17">17. Where investment properties are carried at cost in a portfolio which is valued on a fair value basis or there are unlisted investments (other than investments in subsidiaries, associates and joint ventures) that have been carried at historic cost, we confirm that a reliable estimate of fair value cannot be established for the following reasons:</label>
                                        <textarea class="form-control" name="num17" id="num17" cols="30" rows="5" placeholder="Reasons"><?= $aa4['num17']?></textarea>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <label class="mb-1" for="imp">18. We confirm that we have reviewed all material items of property, plant and equipment and intangible fixed assets and we have assessed the reasonableness of their useful economic lives and residual values.  We have also reviewed all material items of property, plant and equipment, intangible fixed assets and investments (other than those carried at fair value) and consider that:</label>
                                    <select name="imp" id="imp" class="form-select">
                                        <option value="<?= $aa4['imp']?>" selected><?= $aa4['imp']?></option>
                                        <option value="no impairment review was necessary, as there were no indication of impairment">no impairment review was necessary, as there were no indication of impairment</option>
                                        <option value="an impairment review was necessary and the results of this review have been provided to you">an impairment review was necessary and the results of this review have been provided to you</option>
                                    </select>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="mb-1">19.	We confirm that we have notified you of all related party relationships, and transactions that the company has entered into with those related parties during the year of which we are aware.</label>
                                        <label class="mb-1">20.	We acknowledge our responsibility for the design and implementation of internal controls to prevent and detect errors or fraud, and have disclosed to you the results of our assessment of the risk that the financial statements may be materially misstated as a result of fraud.  We are unaware of any irregularities, including fraud and suspected fraud, involving management, employees or others who have significant roles in internal control, or those employed by the company where the fraud could have a material effect on the financial statements.  No allegations of such irregularities or breaches have come to our notice.</label>
                                        <label class="mb-1">21.	We are unaware of any breaches or possible breaches of statute, regulations, contracts, agreements or the company's constitution which might result in the company suffering significant penalties or other loss.  No allegations of such irregularities or breaches have come to our notice.</label>
                                    </div>
                                </div>    
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" id="num22yes1" type="checkbox" name="num22yes1" value="num22yes1" <?php if($aa4['num22yes1'] != ''){echo 'checked';}?>/>
                                            <label class="form-check-label" for="num22yes1">22. We confirm that we have been notified by you that there are no matters which you are required to raise with us to comply with your profession’s ethical guidance which are in addition to the matters included in your planning letter to us dated </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-control" id="period" type="date" placeholder="Enter Currency" name="num221" value="<?php if($aa4['num22yes1'] != ''){echo $aa4['num221'];}?>" />
                                        </div>

                                        <div class="form-check mb-2">
                                            <input class="form-check-input" id="num22yes2" type="checkbox" name="num22yes2" value="num22yes2" <?php if($aa4['num22yes2'] != ''){echo 'checked';}?>/>
                                            <label class="form-check-label" for="num22yes2">We confirm that you have notified to us the following matters, which are additional to the matters raised in your planning letter which you are required to raise with us to comply with your profession’s ethical guidance:</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <label class="mb-1" for="num222">List additional non-audit services now provided:</label>
                                            <textarea class="form-control" name="num222" id="num222" cols="30" rows="5" placeholder="Insert List additional non-audit services now provided"><?php if($aa4['num22yes2'] != ''){echo $aa4['num222'];}?></textarea>
                                        </div>
                                        <div class="form-check mb-2">
                                            <label class="mb-1" for="num223">List any change to the member of informed management:</label>
                                            <textarea class="form-control" name="num223" id="num223" cols="30" rows="5" placeholder="Insert List any change to the member of informed management"><?php if($aa4['num22yes2'] != ''){echo $aa4['num223'];}?></textarea>
                                        </div>
                                        <div class="form-check mb-2">
                                            <label class="mb-1" for="num224">List any change to interests held in the client’s shares:</label>
                                            <textarea class="form-control" name="num224" id="num224" cols="30" rows="5" placeholder="Insert List any change to interests held in the client’s shares"><?php if($aa4['num22yes2'] != ''){echo $aa4['num224'];}?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr style="color: #7752FE;">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" id="num23yes1" type="checkbox" name="num23yes1" value="num23yes1" <?php if($aa4['num23yes1'] != ''){echo 'checked';}?>/>
                                            <label class="form-check-label" for="num23yes1">23.	We confirm receipt of your planning letter dated [date1] and we confirm receipt of your management letter dated [date2].</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <label class="mb-1" for="num23d1">Date1:</label>
                                            <input class="form-control" id="num23d1" type="date" value="<?php if($aa4['num23yes1'] != ''){echo $aa4['num23d1'];}?>" placeholder="Enter Currency" name="num23d1" />
                                            <label class="mb-1" for="num23d2">Date2:</label>
                                            <input class="form-control" id="num23d2" type="date" value="<?php if($aa4['num23yes1'] != ''){echo $aa4['num23d2'];}?>" placeholder="Enter Currency" name="num23d2" />
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" id="num23yes2" type="checkbox" name="num23yes2" value="num23yes2" <?php if($aa4['num23yes2'] != ''){echo 'checked';}?>/>
                                            <label class="form-check-label" for="num23yes2">We confirm receipt of your planning letter dated [date] and we confirm that we have been notified by you that there are no matters of governance interest (which include deficiencies in internal control, comments regarding accounting policies, estimation techniques and financial statement disclosure, and details of significant difficulties during the audit fieldwork) which you wish to draw to our attention.</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <label class="mb-1" for="num23d">Date:</label>
                                            <input class="form-control" id="num23d" type="date" value="<?php if($aa4['num23yes2'] != ''){echo $aa4['num23d'];}?>" placeholder="Enter Currency" name="num23d" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>
                        <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>


















