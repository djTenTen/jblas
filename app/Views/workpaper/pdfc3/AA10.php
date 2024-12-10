<?php
// create new PDF document
$pageLayout = array(21, 29.7);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->setPrintFooter(false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ApplAud');
$pdf->SetTitle($code);
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
//$pdf->SetHeaderData("headerdispatch.png", 65);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(25,10,15);   
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-60, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderMargin(0);   
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set font
// add a page
$pdf->AddPage();
//$pdf->SetPageSize('A4');
$style = "<style>
    *{
        font-family: 'Times New Roman', Times, serif;
        font-size: 14px;
    }
    h3{
        font-size: 16px;
    }
    .cent{
        text-align: center;
    }
    .bo{
        border: 1px solid black;
    }
    p,li{
        text-align: justify;
    }
    .bb{
        border-bottom: 1px solid black;
    }
    .ind{
        text-indent: 20px;
    }
    </style>";
$html =  "";
$html .= $style;

$html .= '
    <h3>COMMUNICATION OF AUDIT MATTERS WITH THOSE CHARGED WITH GOVERNANCE</h3>
    <p><b>AUDIT OBJECTIVES:</b></p>
    <ol type="a">
        <li>) To communicate clearly with those charged with governance the responsibilities of the auditor in relation to the financial statement audit, and an overview of the planned scope and timing of the audit; </li>
        <li>) To obtain from those charged with governance information relevant to the audit; </li>
        <li>) To provide those charged with governance with timely observations arising from the audit that are significant and relevant to their responsibility to oversee the financial reporting process; and </li>
        <li>) To promote effective two-way communication between the auditor and those charged with governance.  </li>
    </ol>
    <p><b>AUDIT PROCEDURES</b></p>

    <table border="1">
        <thead>
            <tr>
                <th style="width: 60%;"><b><i>The auditor should determine the appropriate persons within the organization’s governance structure with whom to communicate.</i></b></th>
                <th style="width: 20%;">WP REF.</th>
                <th style="width: 20%;">DONE BY</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 60%;">
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
                <td style="width: 20%;">'.$a10['wpref1'].'</td>
                <td style="width: 20%;">'.$a10['doneby1'].'</td>
            </tr>
            <tr>
                <td colspan="3"><i><b>The auditor shall communicate with those charged with governance the responsibilities of the auditor in relation to the financial statements audit</b></i></td>
            </tr>
            <tr>
                <td style="width: 60%;">
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
                <td style="width: 20%;">'.$a10['wpref2'].'</td>
                <td style="width: 20%;">'.$a10['doneby2'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">
                    <p>12.	When audit matters of governance interest are communicated orally, document in the working papers the matters communicated and any responses to those matters. 
                        <br> This documentation may take the form of a copy of the minutes of the auditor’s discussion with those charged with governance. 
                    </p>
                </td>
                <td style="width: 20%;">'.$a10['wpref3'].'</td>
                <td style="width: 20%;">'.$a10['doneby3'].'</td>
            </tr>
            <tr>
                <td>
                    <p>13.	Where deemed necessary, depending on the nature, sensitivity, and significance of the matter, confirm in writing with those charged with governance any oral communications on audit matters of governance interest.</p>
                </td>
                <td style="width: 20%;">'.$a10['wpref4'].'</td>
                <td style="width: 20%;">'.$a10['doneby4'].'</td>
            </tr>
        </tbody>
    </table>
    <p><b>GUIDANCE</b></p>
    <p><b>MATTERS TO BE COMMUNICATED TO THOSE CHARGED WITH GOVERNANCE</b></p>
    <ol type="1">
        <li>) The auditor’s responsibilities in relation to the financial statements;</li>
        <li>) Planned scope and timing of the audit;</li>
        <li>) Significant findings from the audit;</li>
        <li>) Significant difficulties encountered during the audit;</li>
        <li>) Significant matters discussed, or subject to correspondence with management;</li>
        <li>) Circumstances that affect the form and content of the auditor’s report;</li>
        <li>) Other significant matters relevant to the financial reporting process;</li>
        <li>) Auditor independence;</li>
        <li>) Supplementary matters.</li>
    </ol>
    <p><b>Cross-referencing with Other Standards</b></p>
    <p>Specific Requirements in PSQC 1 and Other PSAs that Refer to communications with Those Charged With Governance </p>
    <ul>
        <li> PSQC 1,  <i>Quality Control for Firms that Perform Audits and Reviews of Financial Statements, and Other Assurance and Related Services Engagements </i> – paragraph 30(a) </li>
        <li> PSA 240, <i>The Auditor’s Responsibilities Relating to Fraud in an Audit of Financial Statements</i> – paragraphs 21, 38(c)(i) and 40-42 </li>
        <li> PSA 250, <i>Consideration of Laws and Regulations in an Audit of Financial Statements</i> – paragraphs 14, 19 and 22–24 </li>
        <li> PSA 265, <i>Communicating Deficiencies in Internal Control to Those Charged with Governance and Management </i> – paragraph 9 </li>
        <li> PSA 450, <i>Evaluation of Misstatements Identified during the Audit</i> – paragraphs 12-13 </li>
        <li> PSA 505, <i>External Confirmations</i> – paragraph 9 </li>
        <li> PSA 510, <i>Initial Audit Engagements―Opening Balances </i> – paragraph 7 </li>
        <li> PSA 550, <i>Related Parties</i> – paragraph 27 </li>
        <li> PSA 560, <i>Subsequent Events</i>–  paragraphs 7(b)-(c), 10(a), 13(b), 14(a) and 1</li>
        <li> PSA 570 (Revised), <i>Going Concern</i> – paragraph 25 </li>
        <li> PSA 600, <i>Special Considerations―Audits of Group Financial Statements (Including the Work of Component Auditors)</i> – paragraph 49 </li>
        <li> PSA 610 (Revised), <i>Using the Work of Internal Auditors</i> – paragraph 18; PSA 610 (Revised 2013), <i>Using the Work of Internal Auditors</i> – paragraphs 20 and 31 </li>
        <li> PSA 700 (Revised),<i>Forming an Opinion and Reporting on Financial Statements</i> – paragraph 45 </li>
        <li> PSA 701, <i>Communicating Key Audit Matters in the Independent Auditor’s Report</i> – paragraph 17 </li>
        <li> PSA 705 (Revised), <i>Modifications to the Opinion in the Independent Auditor’s Report </i>– paragraphs 12, 14, 23 and 30 </li>
        <li> PSA 706 (Revised), <i>Emphasis of Matter Paragraphs and Other Matter Paragraphs in the Independent Auditor’s Report</i>– paragraph 12 </li>
        <li> PSA 710, <i>Comparative Information—Corresponding Figures and Comparative Financial Statements</i> – paragraph 18 </li>
        <li> PSA 720, <i>The Auditor’s Responsibilities Relating to Other Information in Documents Containing Audited Financial Statements </i> – paragraphs 10, 13 and 16 </li>
    </ul>
    <p><b>Qualitative Aspects of Accounting Practices</b></p>
    <p>The communication required by paragraph 12(a), and discussed in paragraph A21, may include such matters as:</p>
    <p>Accounting Policies</p>
    <ul>
        <li> The appropriateness of the accounting policies to the particular circumstances of the entity, having regard to the need to balance the cost of providing information with the likely benefit to users of the entity’s financial statements. Where acceptable alternative accounting policies exist, the communication may include identification of the financial statement items that are affected by the choice of significant accounting policies as well as information on accounting policies used by similar entities.</li>
        <li> The initial selection of, and changes in significant accounting policies, including the application of new accounting pronouncements. The communication may include: the effect of the timing and method of adoption of a change in accounting policy on the current and future earnings of the entity; and the timing of a change in accounting policies in relation to expected new accounting pronouncements.</li>
        <li> The effect of significant accounting policies in controversial or emerging areas (or those unique to an industry, particularly when there is a lack of authoritative guidance or consensus).</li>
        <li> The effect of the timing of transactions in relation to the period in which they are recorded.</li>
    </ul>
    <p>Accounting Estimates</p>
    <p>For items for which estimates are significant, issues discussed in PSA 540,28 including, for example: </p>
    <ul>
        <li> How management identifies those transactions, events and conditions that may give rise to the need for accounting estimates to be recognized or disclosed in the financial statements. </li>
        <li> Changes in circumstances that may give rise to new, or the need to revise existing, accounting estimates. </li>
        <li> Whether management’s decision to recognize, or to not recognize, the accounting estimates in the financial statements is in accordance with the applicable financial reporting framework. </li>
        <li> Whether there has been or ought to have been a change from the prior period in the methods for making the accounting estimates and, if so, why, as well as the outcome of accounting estimates in prior periods. </li>
        <li> Management’s process for making accounting estimates (e.g., when management has used a model), including whether the selected measurement basis for the accounting estimate is in accordance with the applicable financial reporting framework. </li>
        <li> Whether the significant assumptions used by management in developing the accounting estimate are reasonable. </li>
        <li> Where relevant to the reasonableness of the significant assumptions used by management or the appropriate application of the applicable financial reporting framework, management’s intent to carry out specific courses of action and its ability to do so. </li>
        <li> Risks of material misstatement. </li>
        <li> Indicators of possible management bias. </li>
        <li> How management has considered alternative assumptions or outcomes and why it has rejected them, or how management has otherwise addressed estimation uncertainty in making the accounting estimate. </li>
        <li> The adequacy of disclosure of estimation uncertainty in the financial statements </li>
    </ul>
    <p>Financial Statement Disclosures</p>
    <ul>
        <li>The issues involved, and related judgments made, in formulating particularly sensitive financial statement disclosures (e.g., disclosures related to revenue recognition, remuneration, going concern, subsequent events, and contingency issues).</li>
        <li>The overall neutrality, consistency and clarity of the disclosures in the financial statements.</li>
    </ul>
    <p>Related Matters</p>
    <ul>
        <li>The potential effect on the financial statements of significant risks, exposures and uncertainties, such as pending litigation, that are disclosed in the financial statements.</li>
        <li>The extent to which the financial statements are affected by significant transactions that are outside the normal course of business for the entity, or that otherwise appear to be unusual. This communication may highlight: 
            <ul>
                <li>The non-recurring amounts recognized during the period. </li>
                <li>The extent to which such transactions are separately disclosed in the financial statements. </li>
                <li>Whether such transactions appear to have been designed to achieve a particular accounting or tax treatment, or a particular legal or regulatory objective. </li>
                <li>Whether the form of such transactions appears overly complex or where extensive advice regarding the structuring of the transaction has been taken. </li>
                <li>Where management is placing more emphasis on the need for a particular accounting treatment than on the underlying economics of the transaction. </li>
            </ul>
        </li>
        <li>The factors affecting asset and liability carrying values, including the entity’s bases for determining useful lives assigned to tangible and intangible assets. The communication may explain how factors affecting carrying values were selected and how alternative selections would have affected the financial statements.</li>
        <li>The selective correction of misstatements, for example, correcting misstatements with the effect of increasing reported earnings, but not those that have the effect of decreasing reported earnings.</li>
    </ul>
';


//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();