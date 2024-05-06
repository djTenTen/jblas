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
$pdf->SetMargins(25,15,15);  
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
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '
<table>
    <tr>
        <td style="width: 60%;">
            <table>
                <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                <tr><td></td></tr>
                <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
            </table>
        </td>
        <td style="width: 40%;">
            <table border="1">
                <tr>
                    <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                    <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                </tr>
                <tr>
                    <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                    <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
';
$html .= '<h3>SPECIFIC AREA NARRATIVE INHERENT RISK ASSESSMENT</h3>';
$html .= '
    <p><b>Objective:</b> This form is designed to assess the risk for each audit assertion relevant to each audit area.  PSA 315 implies that all areas and all assertions are high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
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
    <p><b>Specific Considerations relating to Revenue</b></p>
    <p>Per PSA 240, paragraph 26 <i>“the auditor shall, based on a presumption that there are risks of fraud in revenue recognition, evaluate which types of revenue, revenue transactions or assertions give rise to such risks”.  Paragraph 47 states “if the auditor has concluded that the presumption that there is a risk of material misstatement due to fraud related to revenue recognition is not applicable in the circumstances of the engagement, the auditor shall include in the audit documentation the reasons for that conclusion”. </i></p>
    <p>It is therefore expected that the risk attributed to Revenue will be high unless there is sufficient justification given to rebut the presumption of high risk. Paragraphs A28 to A30 of the Application and Other Explanatory Material of PSA 240 should be referred to for additional guidance.</p>
    <p>If the risk of fraud in revenue recognition cannot be rebutted, it is a significant risk (see below).</p>
    <p><b>Significant risks: </b><br> All risks which are deemed to be significant should be specifically highlighted.  A significant risk is one which would be a “blockbuster”.  A risk may be deemed to be significant for the following reasons:</p>
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
        <li>The entity\'s controls relevant to those risks should be understood; </li>
        <li>They will automatically be deemed to be “high risk”, and other risks will be deemed to be “low risk”.  The “default” risk can (and should) be over-ridden if it is deemed to be appropriate.  Reasons should be fully documented;</li>
        <li>They will be communicated to the client at the planning stage in the Planning Letter; and</li>
        <li>How the risk has been addressed during the assignment should be summarized on the PSA Compliance Critical Issues Memorandum.</li>
    </ul>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$bacdata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$bacdata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$bacdata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$bacdata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$bacdata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$bacdata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$bacdata['gen'].'</td>
                <td>Existence</td>
                <td>'.$bacdata['e1'].'</td>
                <td>'.$bacdata['e2'].'</td>
                <td>'.$bacdata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$bacdata['ro1'].'</td>
                <td>'.$bacdata['ro2'].'</td>
                <td>'.$bacdata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$bacdata['c1'].'</td>
                <td>'.$bacdata['c2'].'</td>
                <td>'.$bacdata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$bacdata['va1'].'</td>
                <td>'.$bacdata['va2'].'</td>
                <td>'.$bacdata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$bacdata['pd1'].'</td>
                <td>'.$bacdata['pd2'].'</td>
                <td>'.$bacdata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE RECEIVABLES:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$trdata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$trdata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$trdata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$trdata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$trdata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$trdata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$trdata['gen'].'</td>
                <td>Existence</td>
                <td>'.$trdata['e1'].'</td>
                <td>'.$trdata['e2'].'</td>
                <td>'.$trdata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$trdata['ro1'].'</td>
                <td>'.$trdata['ro2'].'</td>
                <td>'.$trdata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$trdata['c1'].'</td>
                <td>'.$trdata['c2'].'</td>
                <td>'.$trdata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$trdata['va1'].'</td>
                <td>'.$trdata['va2'].'</td>
                <td>'.$trdata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$trdata['pd1'].'</td>
                <td>'.$trdata['pd2'].'</td>
                <td>'.$trdata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER RECEIVABLES (INCLUDING PREPAYMENTS):</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$ordata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$ordata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$ordata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$ordata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$ordata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$ordata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$ordata['gen'].'</td>
                <td>Existence</td>
                <td>'.$ordata['e1'].'</td>
                <td>'.$ordata['e2'].'</td>
                <td>'.$ordata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$ordata['ro1'].'</td>
                <td>'.$ordata['ro2'].'</td>
                <td>'.$ordata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$ordata['c1'].'</td>
                <td>'.$ordata['c2'].'</td>
                <td>'.$ordata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$ordata['va1'].'</td>
                <td>'.$ordata['va2'].'</td>
                <td>'.$ordata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$ordata['pd1'].'</td>
                <td>'.$ordata['pd2'].'</td>
                <td>'.$ordata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVENTORIES:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$invtrdata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$invtrdata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$invtrdata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$invtrdata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$invtrdata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$invtrdata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$invtrdata['gen'].'</td>
                <td>Existence</td>
                <td>'.$invtrdata['e1'].'</td>
                <td>'.$invtrdata['e2'].'</td>
                <td>'.$invtrdata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$invtrdata['ro1'].'</td>
                <td>'.$invtrdata['ro2'].'</td>
                <td>'.$invtrdata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$invtrdata['c1'].'</td>
                <td>'.$invtrdata['c2'].'</td>
                <td>'.$invtrdata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$invtrdata['va1'].'</td>
                <td>'.$invtrdata['va2'].'</td>
                <td>'.$invtrdata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$invtrdata['pd1'].'</td>
                <td>'.$invtrdata['pd2'].'</td>
                <td>'.$invtrdata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVESTMENTS:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$invmtdata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$invmtdata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$invmtdata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$invmtdata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$invmtdata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$invmtdata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$invmtdata['gen'].'</td>
                <td>Existence</td>
                <td>'.$invmtdata['e1'].'</td>
                <td>'.$invmtdata['e2'].'</td>
                <td>'.$invmtdata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$invmtdata['ro1'].'</td>
                <td>'.$invmtdata['ro2'].'</td>
                <td>'.$invmtdata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$invmtdata['c1'].'</td>
                <td>'.$invmtdata['c2'].'</td>
                <td>'.$invmtdata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$invmtdata['va1'].'</td>
                <td>'.$invmtdata['va2'].'</td>
                <td>'.$invmtdata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$invmtdata['pd1'].'</td>
                <td>'.$invmtdata['pd2'].'</td>
                <td>'.$invmtdata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROPERTY, PLANT AND EQUIPMENT:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$ppedata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$ppedata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$ppedata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$ppedata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$ppedata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$ppedata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$ppedata['gen'].'</td>
                <td>Existence</td>
                <td>'.$ppedata['e1'].'</td>
                <td>'.$ppedata['e2'].'</td>
                <td>'.$ppedata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$ppedata['ro1'].'</td>
                <td>'.$ppedata['ro2'].'</td>
                <td>'.$ppedata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$ppedata['c1'].'</td>
                <td>'.$ppedata['c2'].'</td>
                <td>'.$ppedata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$ppedata['va1'].'</td>
                <td>'.$ppedata['va2'].'</td>
                <td>'.$ppedata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$ppedata['pd1'].'</td>
                <td>'.$ppedata['pd2'].'</td>
                <td>'.$ppedata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INTANGIBLE NON-CURRENT ASSETS:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$incadata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$incadata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$incadata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$incadata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$incadata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$incadata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$incadata['gen'].'</td>
                <td>Existence</td>
                <td>'.$incadata['e1'].'</td>
                <td>'.$incadata['e2'].'</td>
                <td>'.$incadata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$incadata['ro1'].'</td>
                <td>'.$incadata['ro2'].'</td>
                <td>'.$incadata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$incadata['c1'].'</td>
                <td>'.$incadata['c2'].'</td>
                <td>'.$incadata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$incadata['va1'].'</td>
                <td>'.$incadata['va2'].'</td>
                <td>'.$incadata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$incadata['pd1'].'</td>
                <td>'.$incadata['pd2'].'</td>
                <td>'.$incadata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE PAYABLES:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$tpdata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$tpdata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$tpdata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$tpdata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$tpdata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$tpdata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$tpdata['gen'].'</td>
                <td>Existence</td>
                <td>'.$tpdata['e1'].'</td>
                <td>'.$tpdata['e2'].'</td>
                <td>'.$tpdata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$tpdata['ro1'].'</td>
                <td>'.$tpdata['ro2'].'</td>
                <td>'.$tpdata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$tpdata['c1'].'</td>
                <td>'.$tpdata['c2'].'</td>
                <td>'.$tpdata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$tpdata['va1'].'</td>
                <td>'.$tpdata['va2'].'</td>
                <td>'.$tpdata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$tpdata['pd1'].'</td>
                <td>'.$tpdata['pd2'].'</td>
                <td>'.$tpdata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER PAYABLES (INCLUDING ACCRUALS):</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$opdata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$opdata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$opdata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$opdata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$opdata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$opdata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$opdata['gen'].'</td>
                <td>Existence</td>
                <td>'.$opdata['e1'].'</td>
                <td>'.$opdata['e2'].'</td>
                <td>'.$opdata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$opdata['ro1'].'</td>
                <td>'.$opdata['ro2'].'</td>
                <td>'.$opdata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$opdata['c1'].'</td>
                <td>'.$opdata['c2'].'</td>
                <td>'.$opdata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$opdata['va1'].'</td>
                <td>'.$opdata['va2'].'</td>
                <td>'.$opdata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$opdata['pd1'].'</td>
                <td>'.$opdata['pd2'].'</td>
                <td>'.$opdata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TAXATION:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$taxdata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$taxdata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$taxdata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$taxdata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$taxdata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$taxdata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$taxdata['gen'].'</td>
                <td>Existence</td>
                <td>'.$taxdata['e1'].'</td>
                <td>'.$taxdata['e2'].'</td>
                <td>'.$taxdata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$taxdata['ro1'].'</td>
                <td>'.$taxdata['ro2'].'</td>
                <td>'.$taxdata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$taxdata['c1'].'</td>
                <td>'.$taxdata['c2'].'</td>
                <td>'.$taxdata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$taxdata['va1'].'</td>
                <td>'.$taxdata['va2'].'</td>
                <td>'.$taxdata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$taxdata['pd1'].'</td>
                <td>'.$taxdata['pd2'].'</td>
                <td>'.$taxdata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROVISIONS FOR LIABILITIES:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$provdata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$provdata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$provdata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$provdata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$provdata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$provdata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$provdata['gen'].'</td>
                <td>Existence</td>
                <td>'.$provdata['e1'].'</td>
                <td>'.$provdata['e2'].'</td>
                <td>'.$provdata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$provdata['ro1'].'</td>
                <td>'.$provdata['ro2'].'</td>
                <td>'.$provdata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$provdata['c1'].'</td>
                <td>'.$provdata['c2'].'</td>
                <td>'.$provdata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$provdata['va1'].'</td>
                <td>'.$provdata['va2'].'</td>
                <td>'.$provdata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$provdata['pd1'].'</td>
                <td>'.$provdata['pd2'].'</td>
                <td>'.$provdata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – REVENUE / OTHER INCOME:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$roidata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$roidata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$roidata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$roidata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$roidata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$roidata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$roidata['gen'].'</td>
                <td>Existence</td>
                <td>'.$roidata['e1'].'</td>
                <td>'.$roidata['e2'].'</td>
                <td>'.$roidata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$roidata['ro1'].'</td>
                <td>'.$roidata['ro2'].'</td>
                <td>'.$roidata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$roidata['c1'].'</td>
                <td>'.$roidata['c2'].'</td>
                <td>'.$roidata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$roidata['va1'].'</td>
                <td>'.$roidata['va2'].'</td>
                <td>'.$roidata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$roidata['pd1'].'</td>
                <td>'.$roidata['pd2'].'</td>
                <td>'.$roidata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – DIRECT COSTS / OTHER EXPENSES:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$dcodata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$dcodata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$dcodata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$dcodata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$dcodata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$dcodata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$dcodata['gen'].'</td>
                <td>Existence</td>
                <td>'.$dcodata['e1'].'</td>
                <td>'.$dcodata['e2'].'</td>
                <td>'.$dcodata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$dcodata['ro1'].'</td>
                <td>'.$dcodata['ro2'].'</td>
                <td>'.$dcodata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$dcodata['c1'].'</td>
                <td>'.$dcodata['c2'].'</td>
                <td>'.$dcodata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$dcodata['va1'].'</td>
                <td>'.$dcodata['va2'].'</td>
                <td>'.$dcodata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$dcodata['pd1'].'</td>
                <td>'.$dcodata['pd2'].'</td>
                <td>'.$dcodata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PAYROLL:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$prdata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$prdata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$prdata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$prdata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$prdata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$prdata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$prdata['gen'].'</td>
                <td>Existence</td>
                <td>'.$prdata['e1'].'</td>
                <td>'.$prdata['e2'].'</td>
                <td>'.$prdata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$prdata['ro1'].'</td>
                <td>'.$prdata['ro2'].'</td>
                <td>'.$prdata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$prdata['c1'].'</td>
                <td>'.$prdata['c2'].'</td>
                <td>'.$prdata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$prdata['va1'].'</td>
                <td>'.$prdata['va2'].'</td>
                <td>'.$prdata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$prdata['pd1'].'</td>
                <td>'.$prdata['pd2'].'</td>
                <td>'.$prdata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER AREA:</h3>';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                <td style="width: 10%;">'.$oadata['y1'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                <td style="width: 10%;">'.$oadata['y2'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                <td style="width: 10%;">'.$oadata['y3'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                <td style="width: 10%;">'.$oadata['y4'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                <td style="width: 10%;">'.$oadata['y5'].'</td>
            </tr>
            <tr>
                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                <td style="width: 10%;">'.$oadata['y6'].'</td>
            </tr>
        </tbody>
    </table>
    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
    <table border="1">
        <thead>
            <tr>
                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                <th>Assertion</th>
                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                <th>Impact on the audit including how risk has been addressed</th>
                <th>Audit test reference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="5">'.$oadata['gen'].'</td>
                <td>Existence</td>
                <td>'.$oadata['e1'].'</td>
                <td>'.$oadata['e2'].'</td>
                <td>'.$oadata['e3'].'</td>
            </tr>
            <tr>
                <td>Rights / Obligations</td>
                <td>'.$oadata['ro1'].'</td>
                <td>'.$oadata['ro2'].'</td>
                <td>'.$oadata['ro3'].'</td>
            </tr>
            <tr>
                <td>Completeness</td>
                <td>'.$oadata['c1'].'</td>
                <td>'.$oadata['c2'].'</td>
                <td>'.$oadata['c3'].'</td>
            </tr>
            <tr>
                <td>Valuation / Allocation</td>
                <td>'.$oadata['va1'].'</td>
                <td>'.$oadata['va2'].'</td>
                <td>'.$oadata['va3'].'</td>
            </tr>
            <tr>
                <td>Presentation and Disclosure</td>
                <td>'.$oadata['pd1'].'</td>
                <td>'.$oadata['pd2'].'</td>
                <td>'.$oadata['pd3'].'</td>
            </tr>
        </tbody>
    </table>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();