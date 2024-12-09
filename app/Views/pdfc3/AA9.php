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
    <h3>THE AUDITOR’S RESPONSIBILITIES RELATING TO OTHER INFORMATION</h3>
    <p><b>AUDITOR’S OBJECTIVE:</b></p>
    <p>The objectives of the auditor, having read the other information, are:</p>
    <ol type="a">
        <li>)To consider whether there is a material inconsistency between the other information and the financial statements;</li>
        <li>)To consider whether there is a material inconsistency between the other information and the auditor’s knowledge obtained in the audit;</li>
        <li>)To respond appropriately when the auditor identifies that such material inconsistencies appear to exist, or when the auditor otherwise becomes aware that other information appears to be materially misstated; and</li>
        <li>)To report in accordance with this PSA.</li>
    </ol>
    <p><b>AUDIT PROCEDURES</b></p>

    <table border="1">
        <thead>
            <tr>
                <th style="width: 60%;"></th>
                <th style="width: 20%;">WP REF.</th>
                <th style="width: 20%;">DONE BY</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 60%;">
                    <p>1.	Determine, through discussion with management, which document(s) comprises the annual report, and the entity’s planned manner and timing of the issuance of such document(s);</p>
                    <p>2.	Make appropriate arrangements with management to obtain in a timely manner and, if possible, prior to the date of the auditor’s report, the final version of the document(s) comprising the annual report; </p>
                    <p>3.	When some or all of the document(s) determined  will not be available until after the date of the auditor’s report, request management to provide a written representation that the final version of the document(s) will be provided to the auditor when available, and prior to its issuance by the entity, such that the auditor can complete the procedures required by this PSA.</p>
                </td>
                <td style="width: 20%;">'.$a9['wpref1'].'</td>
                <td style="width: 20%;">'.$a9['doneby1'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">
                    <p>4.	The auditor shall read the other information and consider whether there is a material inconsistency between the other information and the financial statements. </p>
                    <p>5.	As the basis for the above consideration, the auditor shall, to evaluate their consistency, compare selected amounts or other items in the other information (that are intended to be the same as, to summarize, or to provide greater detail about, the amounts or other items in the financial statements) with such amounts or other items in the financial statements; </p>
                    <p>6.	Consider whether there is a material inconsistency between the other information and the auditor’s knowledge obtained in the audit, in the context of audit evidence obtained and conclusions reached in the audit. </p>
                </td>
                <td style="width: 20%;">'.$a9['wpref2'].'</td>
                <td style="width: 20%;">'.$a9['doneby2'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">
                    <p>7.	While reading the other information, the auditor shall remain alert for indications that the other information not related to the financial statements or the auditor’s knowledge obtained in the audit appears to be materially misstated.</p>
                </td>
                <td style="width: 20%;">'.$a9['wpref3'].'</td>
                <td style="width: 20%;">'.$a9['doneby3'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">
                    <p>8.	If the auditor identifies that a material inconsistency appears to exist (or becomes aware that the other information appears to be materially misstated), the auditor shall discuss the matter with management and, if necessary, perform other procedures to conclude whether: (a) A material misstatement of the other information exists; (b) A material misstatement of the financial statements exists; or (c) The auditor’s understanding of the entity and its environment needs to be updated.</p>
                </td>
                <td style="width: 20%;">'.$a9['wpref4'].'</td>
                <td style="width: 20%;">'.$a9['doneby4'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">
                    <p>9.	If the auditor concludes that a material misstatement of the other information exists, the auditor shall request management to correct the other information. </p>
                    <p>10.	If management agrees to make the correction, the auditor shall determine that the correction has been made.</p>
                    <p>11.	If management refuses to make the correction, the auditor shall communicate the matter with those charged with governance and request that the correction be made.</p>
                </td>
                <td style="width: 20%;">'.$a9['wpref5'].'</td>
                <td style="width: 20%;">'.$a9['doneby5'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">
                    <p>12.	If the auditor concludes that a material misstatement exists in other information obtained prior to the date of the auditor’s report, and the other information is not corrected after communicating with those charged with governance, the auditor shall take appropriate action, including communicating with those charged with governance about how the auditor plans to address the material misstatement in the auditor’s report; or withdrawing from the engagement, where withdrawal is possible under applicable law or regulation.</p>
                </td>
                <td style="width: 20%;">'.$a9['wpref6'].'</td>
                <td style="width: 20%;">'.$a9['doneby6'].'</td>
            </tr>
        </tbody>
    </table>
    <p><b>Reporting</b></p>
    <ul>
        <li>The auditor’s report shall include a separate section with a heading “Other Information”, or other appropriate heading, when, at the date of the auditor’s report:
            <ol type="a">
                <li>) For an audit of financial statements of a listed entity, the auditor has obtained, or expects to obtain, the other information; or</li>
                <li>) For an audit of financial statements of an entity other than a listed entity, the auditor has obtained some or all of the other information. </li>
            </ol>
        </li>
        <li>When the auditor’s report is required to include Other Information section  this section shall include: (Ref: Para. A53)
            <ol type="a">
                <li>) A statement that management is responsible for the other information;</li>
                <li>) An identification of:
                    <ol type="i">
                        <li> )Other information, if any, obtained by the auditor prior to the date of the auditor’s report; and</li>
                        <li>) For an audit of financial statements of a listed entity, other information, if any, expected to be obtained after the date</li>
                    </ol>
                </li>
                <li>) A statement that the auditor’s opinion does not cover the other information and, accordingly, that the auditor does not express (or will not express) an audit opinion or any form of assurance conclusion thereon;</li>
                <li>) A description of the auditor’s responsibilities relating to reading, considering and reporting on other information as required by this PSA; and</li>
                <li>) When other information has been obtained prior to the date of the auditor’s report, either:
                    <ol type="i">
                        <li>) A statement that the auditor has nothing to report; or</li>
                        <li>) If the auditor has concluded that there is an uncorrected material misstatement of the other information, a statement that describes the uncorrected material misstatement of the other information.</li>
                    </ol>
                </li>
            </ol>
        </li>
        <li>When the auditor expresses a qualified or adverse opinion in accordance with PSA 705 (Revised), the auditor shall consider the implications of the matter giving rise to the modification of opinion for the statement.</li>
    </ul>
    <p><b><i>Reporting Prescribed by Law or Regulation</i></b></p>
    <ul>
        <li>If the auditor is required by law or regulation of a specific jurisdiction to refer to the other information in the auditor’s report using a specific layout or wording, the auditor’s report shall refer to Philippine Standards on Auditing only if the auditor’s report includes, at a minimum: 
            <ol type="a">
                <li>) Identification of the other information obtained by the auditor prior to the date of the auditor’s report;</li>
                <li>) A description of the auditor’s responsibilities with respect to the other information; and</li>
                <li>) An explicit statement addressing the outcome of the auditor’s work for this purpose.</li>
            </ol>
        </li>
    </ul>
    <p><b>GUIDANCE</b></p>
    <p><b><i>Examples of Amounts or Other Items that May Be Included in the Other Information</i></b></p>
    <p><b>Amounts</b></p>
    <ul>
        <li>Items in a summary of key financial results, such as net income, earnings per share, dividends, sales and other operating revenues, and purchases and operating expenses.</li>
        <li>Selected operating data, such as income from continuing operations by major operating area, or sales by geographical segment or product line.</li>
        <li>Special items, such as asset dispositions, litigation provisions, asset impairments, tax adjustments, environmental remediation provisions, and restructuring and reorganization expenses.</li>
        <li>Liquidity and capital resource information, such as cash, cash equivalents and marketable securities; dividends; and debt, capital lease and minority interest obligations.</li>
        <li>Capital expenditures by segment or division.</li>
        <li>Amounts involved in, and related financial effects of, off-balance sheet arrangements.</li>
        <li>Amounts involved in guarantees, contractual obligations, legal or environmental claims, and other contingencies.</li>
        <li>Financial measures or ratios, such as gross margin, return on average capital employed, return on average shareholders’ equity, current ratio, interest coverage ratio and debt ratio. Some of these may be directly reconcilable to the financial statements.</li>
    </ul>
    <p><b>Other Items</b></p>
    <ul>
        <li>Explanations of critical accounting estimates and related assumptions.</li>
        <li>Identification of related parties and descriptions of transactions with them.</li>
        <li>Articulation of the entity’s policies or approach to manage commodity, foreign exchange or interest rate risks, such as through the use of forward contracts, interest rate swaps, or other financial instruments.</li>
        <li>Descriptions of the nature of off-balance sheet arrangements.</li>
        <li>Descriptions of guarantees, indemnifications, contractual obligations, litigation or environmental liability cases, and other contingencies, including management’s qualitative assessments of the entity’s related exposures.</li>
        <li>Descriptions of changes in legal or regulatory requirements, such as new tax or environmental regulations, that have materially impacted the entity’s operations or fiscal position, or will have a material impact on the entity’s future financial prospects.</li>
        <li>Management’s qualitative assessments of the impacts of new financial reporting standards that have come into effect during the period, or will come into effect in the following period, on the entity’s financial results, financial position and cash flows.</li>
        <li>General descriptions of the business environment and outlook.</li>
        <li>Overview of strategy.</li>
        <li>Descriptions of trends in market prices of key commodities or raw materials.</li>
        <li>Contrasts of supply, demand and regulatory circumstances between geographic regions.</li>
        <li>Explanations of specific factors influencing the entity’s profitability in specific segments.</li>
    </ul>

';


//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();