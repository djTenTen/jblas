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


$html =  "
    <style>
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
    </style>
";

$html .= '
<p class="cent"><b>SUGGESTED LETTER OF REPRESENTATION</b> <br><br><br></p>
<table>
    <tr>
        <td>[Name of the auditors] <br><br></td>
    </tr>
    <tr>
        <td>[Address of the auditors]<br><br></td>
    </tr>
</table>
<p>Dear Sirs</p>
<p class="ind"><b>LETTER OF REPRESENTATION FOR THE [YEAR / PERIOD] ENDED [DATE]</b></p>
<p>We confirm that the following representations are made on the basis of enquiries of management and staff with relevant knowledge and experience and where appropriate, of inspection of supporting documentation, sufficient to satisfy ourselves that we can properly make each of the following representations to you in connection with your audit of the company\'s financial statements for the year ended [date].</p>
<p>We acknowledge our legal responsibilities regarding disclosure of information to you as auditors and confirm that so far as we are aware, there is no relevant audit information needed by you in connection with preparing your audit report of which you are unaware.  Each director has taken all the steps that they ought to have taken as a director in order to make themselves aware of any relevant audit information and to establish that you are aware of that information.</p>
<p><b>Financial Statements:</b></p>
<table>
    <tbody>
        <tr>
            <td style="width: 7%;">1.</td>
            <td style="width: 93%;"><b>We acknowledge, and have fulfilled, as directors, our collective responsibility under [insert legislation] for presenting financial statements (in accordance with [insert legislation] and International Financial Reporting Standards), which give a true and fair view of the financial position of the company at the reporting date, and of its result for the period then ended, and for making accurate representations to you.  We confirm that we have approved the financial statements for the year ended [date].</b> <br></td>
        </tr>
        <tr>
            <td style="width: 7%;">2.</td>
            <td style="width: 93%;"><b>We confirm that the accounting policies and estimation techniques [, including significant assumptions used to determine estimates measured at fair value,] adopted for the preparation of the financial statements are the most appropriate to the circumstances in which the company operates.</b> <br></td>
        </tr>
        <tr>
            <td style="width: 7%;">3.</td>
            <td style="width: 93%;"><b>Other than as disclosed in the financial statements, the company has not entered into any transactions involving directors, officers or other related parties, which require disclosure under [insert legislation] or International Financial Reporting Standards.  Appropriate disclosure has been made of the control of the company.</b><br></td>
        </tr>
        <tr>
            <td style="width: 7%;">4.</td>
            <td style="width: 93%;"><b>We have disclosed all known or possible litigation and claims whose effects should be considered when preparing the financial statements and these have been disclosed in accordance with the requirements of accounting standards.</b><br></td>
        </tr>
        <tr>
            <td style="width: 7%;">5.</td>
            <td style="width: 93%;"><b>The financial statements of the company have been prepared on the going concern basis as we believe that adequate cash resources will be available to cover the company’s requirements for working capital and capital expenditure for at least the next twelve months.  We are not aware of any other factors which could put into jeopardy the company’s going concern status during or beyond this period.</b><br></td>
        </tr>
        <tr>
            <td style="width: 7%;">6.</td>
            <td style="width: 93%;"><b>There have been no events since the reporting date which necessitate revision of the figures included in the financial statements or inclusion of a note thereto.  Should further material events occur, which may necessitate revision of the figures included in the financial statements or inclusion of a note thereto, we will advise you accordingly.</b><br></td>
        </tr>
        <tr>
            <td style="width: 7%;">7.</td>
            <td style="width: 93%;"><b>We confirm that we have considered the unadjusted errors advised to us by you as appended to this letter.  It is our view that the cost of making these adjustments to the financial statements outweighs any benefits that will be gained by the users of the financial statements.  The combined effect of the unadjusted errors is not material and we do not consider that their absence from the financial statements affects the true and fair view given.</b> <br> <i>[or]</i> <br> We confirm that we have been notified by you that either no unadjusted or only clearly trivial errors were identified during the audit.<br></td>
        </tr>
        <tr>
            <td style="width: 7%;">8.</td>
            <td style="width: 93%;">We confirm that we have agreed the adjustments appended to this letter which have been made to the performance statement(s), and statement of financial position which we presented to you for audit.<br></td>
        </tr>
        <tr>
            <td style="width: 7%;">9.</td>
            <td style="width: 93%;">We confirm we have no plans or intentions that may materially affect the carrying value or classification of any assets and liabilities reflected in the financial statements. <br></td>
        </tr>
        <tr>
            <td style="width: 7%;">10.</td>
            <td style="width: 93%;">With regard to the defined benefit pension plan, we are satisfied that:
                <ul>
                    <li>the actuarial assumptions underlying the valuation are consistent with our knowledge of the business;</li>
                    <li>all significant retirement benefits have been identified and properly accounted for; and</li>
                    <li>all settlements and curtailments have been identified and properly accounted for.</li>
                </ul>
                <br>
            </td>
        </tr>
        <tr>
            <td style="width: 7%;">11.</td>
            <td style="width: 93%;">[Where there has been a prior period adjustment as a result of a material error, and comparative information has been restated, a specific representation is required (ISA 710.9).]<br></td>
        </tr>
        <tr>
            <td style="width: 7%;">12.</td>
            <td style="width: 93%;">[Add any additional representations related to new or revised accounting standards that are being implemented for the first time that have a material impact on financial statements].<br><br> <b>Information provided:</b> <br><br></td>
        </tr>
        <tr>
            <td style="width: 7%;">13.</td>
            <td style="width: 93%;"><b>All the accounting records have been made available to you for the purpose of your audit and all the transactions undertaken by the company have been properly reflected and recorded in the accounting records.  We have provided to you all other information requested and given unrestricted access to persons within the entity from whom you have deemed it necessary to speak to.  All other records and relevant information, including minutes of all management and shareholders\' meetings, have been made available to you.</b><br></td>
        </tr>
        <tr>
            <td style="width: 7%;">14.</td>
            <td style="width: 93%;"><b>Other than those disclosed in the financial statements we are not aware of any material liabilities, provisions, contingent liabilities, contingent assets or contracted for capital commitments, that need to be provided for or disclosed in the financial statements.</b><br></td>
        </tr>
        <tr>
            <td style="width: 7%;">15.</td>
            <td style="width: 93%;">The company has satisfactory title to all assets and there are no liens or encumbrances on the company’s assets [except as disclosed in the notes to the financial statements].<br></td>
        </tr>
        <tr>
            <td style="width: 7%;">16.</td>
            <td style="width: 93%;">We confirm that the functional currency of the company is [insert currency].<br></td>
        </tr>
        <tr>
            <td style="width: 7%;">17.</td>
            <td style="width: 93%;">Where investment properties are carried at cost in a portfolio which is valued on a fair value basis or there are unlisted investments (other than investments in subsidiaries, associates and joint ventures) that have been carried at historic cost, we confirm that a reliable estimate of fair value cannot be established for the following reasons [reasons].<br></td>
        </tr>
        <tr>
            <td style="width: 7%;">18.</td>
            <td style="width: 93%;">We confirm that we have reviewed all material items of property, plant and equipment and intangible fixed assets and we have assessed the reasonableness of their useful economic lives and residual values.  We have also reviewed all material items of property, plant and equipment, intangible fixed assets and investments (other than those carried at fair value) and consider that [no impairment review was necessary, as there were no indication of impairment / an impairment review was necessary and the results of this review have been provided to you].<br></td>
        </tr>
        <tr>
            <td style="width: 7%;">19.</td>
            <td style="width: 93%;"><b>We confirm that we have notified you of all related party relationships, and transactions that the company has entered into with those related parties during the year of which we are aware.</b><br></td>
        </tr>
        <tr>
            <td style="width: 7%;">20.</td>
            <td style="width: 93%;"><b>We acknowledge our responsibility for the design and implementation of internal controls to prevent and detect errors or fraud, and have disclosed to you the results of our assessment of the risk that the financial statements may be materially misstated as a result of fraud.  We are unaware of any irregularities, including fraud and suspected fraud, involving management, employees or others who have significant roles in internal control, or those employed by the company where the fraud could have a material effect on the financial statements.  No allegations of such irregularities or breaches have come to our notice.</b><br></td>
        </tr>
        <tr>
            <td style="width: 7%;">21.</td>
            <td style="width: 93%;"><b>We are unaware of any breaches or possible breaches of statute, regulations, contracts,</b> agreements or the company\'s constitution <b>which might result in the company suffering significant penalties or other loss.</b>  No allegations of such irregularities or breaches have come to our notice.<br></td>
        </tr>
        <tr>
            <td style="width: 7%;">22.</td>
            <td style="width: 93%;"><b>22.	We confirm that we have been notified by you that there are no matters which you are required to raise with us to comply with your profession’s ethical guidance which are in addition to the matters included in your planning letter to us dated [date].</b> 
                <br> <i>[or]</i> <br>We confirm that you have notified to us the following matters, which are additional to the matters raised in your planning letter which you are required to raise with us to comply with your profession’s ethical guidance:
                <ul>
                    <li><b>[List additional non-audit services now provided];</b></li>
                    <li><b>[List any change to the member of informed management]; and</b></li>
                    <li><b>[List any change to interests held in the client’s shares].</b></li>
                </ul>
                <br>
            </td>
        </tr>
        <tr>
            <td style="width: 7%;">23.</td>
            <td style="width: 93%;"><b>We confirm receipt of your planning letter dated [date] and </b> we confirm receipt of your management letter dated [date].
                <br> <i>[or]</i> <br><b>We confirm receipt of your planning letter dated [date] and</b> <p>we confirm that we have been notified by you that there are no matters of governance interest (which include deficiencies in internal control, comments regarding accounting policies, estimation techniques and financial statement disclosure, and details of significant difficulties during the audit fieldwork) which you wish to draw to our attention.</p><br>
            </td>
        </tr>
    </tbody>
</table>

<p>Yours faithfully <br><br></p>
<p>[Name] <br> Signed on behalf of the Board of Directors (those charged with governance)</p>
<p><i>The following signature is only required where management differ from those charged with governance, as were identified on the Regulation of Auditor’s Checklist.  (Separate letters may be considered appropriate if there are representations which those charged with governance wish to remain confidential from management):</i> <br><br></p>
<p>[Name] <br>Signed on behalf of management</p>
';











    


//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();