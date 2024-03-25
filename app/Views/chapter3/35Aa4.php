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
            <?php if (session()->get('failed_update')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Failed update</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">
                
                <p>Dear Sirs</p>

                

                <h4>LETTER OF REPRESENTATION FOR THE <input type="text" class="form-control form-control-sm col-1" placeholder="[YEAR / PERIOD]">   ENDED  <input type="date" class="form-control form-control-sm col-1" placeholder="[DATE]"></h4>
             

                <p>We confirm that the following representations are made on the basis of enquiries of management and staff with relevant knowledge and experience and where appropriate, of inspection of supporting documentation, sufficient to satisfy ourselves that we can properly make each of the following representations to you in connection with your audit of the company's financial statements for the year ended <input type="date" class="form-control form-control-sm col-1" placeholder="[DATE]"></p>
                <p>We acknowledge our legal responsibilities regarding disclosure of information to you as auditors and confirm that so far as we are aware, there is no relevant audit information needed by you in connection with preparing your audit report of which you are unaware.  Each director has taken all the steps that they ought to have taken as a director in order to make themselves aware of any relevant audit information and to establish that you are aware of that information.</p>
                    
                <h6>Financial Statements:</h6>

                <p>1.	We acknowledge, and have fulfilled, as directors, our collective responsibility under <input type="text" class="form-control form-control-sm col-1" placeholder="[insert legislation]"> for presenting financial statements (in accordance with <input type="text" class="form-control col-1" placeholder="[insert legislation]"> and International Financial Reporting Standards), which give a true and fair view of the financial position of the company at the reporting date, and of its result for the period then ended, and for making accurate representations to you.  We confirm that we have approved the financial statements for the year ended <input type="date" class="form-control col-1" placeholder="[DATE]">. </p>
                <p>2.	We confirm that the accounting policies and estimation techniques <textarea class="form-control form-control-sm" name="" id="" cols="30" rows="10" placeholder="[, including significant assumptions used to determine estimates measured at fair value,]"></textarea>  adopted for the preparation of the financial statements are the most appropriate to the circumstances in which the company operates.</p>
                <p>3.	Other than as disclosed in the financial statements, the company has not entered into any transactions involving directors, officers or other related parties, which require disclosure under <input type="text" class="form-control form-control-sm col-1" placeholder="[insert legislation]"> or International Financial Reporting Standards.  Appropriate disclosure has been made of the control of the company.</p>
                <p>4.	We have disclosed all known or possible litigation and claims whose effects should be considered when preparing the financial statements and these have been disclosed in accordance with the requirements of accounting standards.</p>
                <p>5.	The financial statements of the company have been prepared on the going concern basis as we believe that adequate cash resources will be available to cover the company’s requirements for working capital and capital expenditure for at least the next twelve months.  We are not aware of any other factors which could put into jeopardy the company’s going concern status during or beyond this period.</p>
                <p>6.	There have been no events since the reporting date which necessitate revision of the figures included in the financial statements or inclusion of a note thereto.  Should further material events occur, which may necessitate revision of the figures included in the financial statements or inclusion of a note thereto, we will advise you accordingly.</p>
                <p>7.	We confirm that we have considered the unadjusted errors advised to us by you as appended to this letter.  It is our view that the cost of making these adjustments to the financial statements outweighs any benefits that will be gained by the users of the financial statements.  The combined effect of the unadjusted errors is not material and we do not consider that their absence from the financial statements affects the true and fair view given. </p>
                <p>[or]</p>
                <p>We confirm that we have been notified by you that either no unadjusted or only clearly trivial errors were identified during the audit.</p>
                <p>8.	We confirm that we have agreed the adjustments appended to this letter which have been made to the performance statement(s), and statement of financial position which we presented to you for audit.</p>
                <p>9.	We confirm we have no plans or intentions that may materially affect the carrying value or classification of any assets and liabilities reflected in the financial statements.</p>

                <p><textarea class="form-control form-control-sm" name="" id="" cols="30" rows="10" placeholder="[The following three paragraphs should only be included where applicable:]"></textarea></p>

                <p>10.	With regard to the defined benefit pension plan, we are satisfied that:</p>
                <ul>
                    <li>the actuarial assumptions underlying the valuation are consistent with our knowledge of the business;</li>
                    <li>all significant retirement benefits have been identified and properly accounted for; and</li>
                    <li>all settlements and curtailments have been identified and properly accounted for.</li>
                </ul>

                <p>11.	[Where there has been a prior period adjustment as a result of a material error, and comparative information has been restated, a specific representation is required (ISA 710.9).]</p>
                <p>12.	[Add any additional representations related to new or revised accounting standards that are being implemented for the first time that have a material impact on financial statements].</p>

                <h6>Information provided:</h6>
                <p><strong>13.	All the accounting records have been made available to you for the purpose of your audit and all the transactions undertaken by the company have been properly reflected and recorded in the accounting records.  We have provided to you all other information requested and given unrestricted access to persons within the entity from whom you have deemed it necessary to speak to.  All other records and relevant information, including minutes of all management and shareholders' meetings, have been made available to you.  </strong></p>
                <p><strong>14.	Other than those disclosed in the financial statements we are not aware of any material liabilities, provisions, contingent liabilities, contingent assets or contracted for capital commitments, that need to be provided for or disclosed in the financial statements.</strong></p>
                <p>15.	The company has satisfactory title to all assets and there are no liens or encumbrances on the company’s assets [except as disclosed in the notes to the financial statements].</p>
                <p>16.	We confirm that the functional currency of the company is [insert currency].</p>
                <p>17.	Where investment properties are carried at cost in a portfolio which is valued on a fair value basis or there are unlisted investments (other than investments in subsidiaries, associates and joint ventures) that have been carried at historic cost, we confirm that a reliable estimate of fair value cannot be established for the following reasons [reasons].</p>
                <p>18.	We confirm that we have reviewed all material items of property, plant and equipment and intangible fixed assets and we have assessed the reasonableness of their useful economic lives and residual values.  We have also reviewed all material items of property, plant and equipment, intangible fixed assets and investments (other than those carried at fair value) and consider that [no impairment review was necessary, as there were no indication of impairment / an impairment review was necessary and the results of this review have been provided to you].</p>
                <p><strong>19.	We confirm that we have notified you of all related party relationships, and transactions that the company has entered into with those related parties during the year of which we are aware.</strong></p>
                <p>20.	We acknowledge our responsibility for the design and implementation of internal controls to prevent and detect errors or fraud, and have disclosed to you the results of our assessment of the risk that the financial statements may be materially misstated as a result of fraud.  We are unaware of any irregularities, including fraud and suspected fraud, involving management, employees or others who have significant roles in internal control, or those employed by the company where the fraud could have a material effect on the financial statements.  No allegations of such irregularities or breaches have come to our notice.</p>
                <p>21.	<strong>We are unaware of any breaches or possible breaches of statute, regulations,</strong> contracts, agreements or the company's constitution <strong> which might result in the company suffering significant penalties or other loss.</strong>  No allegations of such irregularities or breaches have come to our notice.</p>
                <p>22.	We confirm that we have been notified by you that there are no matters which you are required to raise with us to comply with your profession’s ethical guidance which are in addition to the matters included in your planning letter to us dated [date].</p>
                <p>[or] </p>
                <p><strong>We confirm that you have notified to us the following matters, which are additional to the matters raised in your planning letter which you are required to raise with us to comply with your profession’s ethical guidance:</strong></p>
                <ul>
                    <li>	[List additional non-audit services now provided];</li>
                    <li>	[List any change to the member of informed management]; and</li>
                    <li>	[List any change to interests held in the client’s shares].</li>
                </ul>

                <p>23.	We confirm receipt of your planning letter dated [date] and we confirm receipt of your management letter dated [date].</p>
                <p>[or]</p>
                <p>We confirm receipt of your planning letter dated [date] and we confirm that we have been notified by you that there are no matters of governance interest (which include deficiencies in internal control, comments regarding accounting policies, estimation techniques and financial statement disclosure, and details of significant difficulties during the audit fieldwork) which you wish to draw to our attention.</p>

                <p>Yours faithfully</p>

                <p>[Name]</p>
                <p>Signed on behalf of the Board of Directors (those charged with governance)</p>
                <p><i>The following signature is only required where management differ from those charged with governance, as were identified on the Regulation of Auditor’s Checklist.  (Separate letters may be considered appropriate if there are representations which those charged with governance wish to remain confidential from management):</i></p>
                <br>
                <p>[Name]</p>
                <p>Signed on behalf of management</p>

            </div>
        </div>
    </div>
    
</main>


















