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
    <h3>GUIDANCE ON MODIFICATION TO THE OPINION  IN THE INDEPENDENT AUDITOR’S REPORT</h3>
    <p><b>AUDITOR’S OBJECTIVE:</b></p>
    <p>The objective of the auditor is to express clearly an appropriately modified opinion on the financial statements. </p>
    <p><b>REQUIREMENTS</b></p>
    <p><b><i>Circumstances When a Modification to the Auditor’s Opinion Is Required </i></b></p>
    <ol type="a">
        <li>) The auditor concludes that, based on the audit evidence obtained, the financial statements as a whole are not free from material misstatement; or </li>
        <li>) The auditor is unable to obtain sufficient appropriate audit evidence to conclude that the financial statements as a whole are free from material misstatement. </li>
    </ol>
    <p><b><i>Determining the Type of Modification to the Auditor’s Opinion</i></b></p>
    <p><i>Qualified Opinion </i></p>
    <p>The auditor shall express a <b>qualified opinion</b> when: </p>
    <ol type="a">
        <li>) The auditor, having obtained sufficient appropriate audit evidence, concludes that misstatements, individually or in the aggregate, are <b>material but not pervasive</b> , to the financial statements; or </li>
        <li>) The auditor is unable to obtain sufficient appropriate audit evidence on which to base the opinion, but the auditor concludes that the possible effects on the financial statements of undetected misstatements, if any, could be <b>material but not pervasive</b>. </li>
    </ol>
    <p><i>Adverse Opinion </i></p>
    <p>The auditor shall express an adverse opinion when the auditor, having obtained sufficient appropriate audit evidence, concludes that misstatements, individually or in the aggregate are, <b>both material and pervasive</b> to the financial statements. </p>
    <p><i>Disclaimer of Opinion </i></p>
    <p>The auditor shall disclaim an opinion when the auditor is unable to obtain sufficient appropriate audit evidence on which to base the opinion, and the auditor concludes that the possible effects on the financial statements of undetected misstatements, if any, could be <b>both material and pervasive.</b>  </p>
    <p>The auditor shall disclaim an opinion when, in extremely rare circumstances involving multiple uncertainties, the auditor concludes that, notwithstanding having obtained sufficient appropriate audit evidence regarding each of the individual uncertainties, it is not possible to form an opinion on the financial statements due to the potential interaction of the uncertainties and their possible cumulative effect on the financial statements. </p>
    <p><b><i>Consequence of an Inability to Obtain Sufficient Appropriate Audit Evidence Due to a Management- Imposed Limitation after the Auditor Has Accepted the Engagement </i></b></p>
    <ul>
        <li>If, after accepting the engagement, the auditor becomes aware that management has imposed a limitation on the scope of the audit that the auditor considers likely to result in the need to expressa qualified opinion or to disclaim an opinion on the financial statements, the auditor shall request that management remove the limitation. </li>
        <li>If management refuses to remove the limitation referred to in paragraph 11 of this PSA, the auditor shall communicate the matter to those charged with governance, unless all of those charged with governance are involved in managing the entity,2 and determine whether it is possible to perform alternative procedures to obtain sufficient appropriate audit evidence. </li>
        <li>If the auditor is unable to obtain sufficient appropriate audit evidence, the auditor shall determine the implications as follows: 
            <ol type="a">
                <li>) If the auditor concludes that the possible effects on the financial statements of undetected misstatements, if any, could be material but not pervasive, the auditor shall qualify the opinion; or </li>
                <li>) If the auditor concludes that the possible effects on the financial statements of undetected misstatements, if any, could be both material and pervasive so that a qualification of the opinion would be inadequate to communicate the gravity of the situation, the auditor shall: 
                    <ol type="i">
                        <li>) Withdraw from the audit, where practicable and possible under applicable law or regulation; or (Ref: Para. A13) </li>
                        <li>) If withdrawal from the audit before issuing the auditor’s report is not practicable or possible, disclaim an opinion on the financial statements. (Ref. Para. A14) </li>
                    </ol>
                </li>
            </ol>
        </li>
        <li>If the auditor withdraws as contemplated by (b)(i) above, before withdrawing, the auditor shall communicate to those charged with governance any matters regarding misstatements identified during the audit that would have given rise to a modification of the opinion. (Ref: Para. A1 5) </li>
    </ul>
    <p><b><i>Other Considerations Relating to an Adverse Opinion or Disclaimer of Opinion</i></b></p>
    <p>When the auditor considers it necessary to express an adverse opinion or disclaim an opinion on the financial statements as a whole, the auditor’s report shall not also include an unmodified opinion with respect to the same financial reporting framework on a single financial statement or one or more specific elements, accounts or items of a financial statement. To include such an unmodified opinion in the same report3 in these circumstances would contradict the auditor’s adverse opinion or disclaimer of opinion on the financial statements as a whole. (Ref: Para. A1 6)</p>
    <p><b>Form and Content of the Auditor’s Report When the Opinion Is Modified </b></p>
    <p><i>Auditor’s Opinion </i></p>
    <p>When the auditor modifies the audit opinion, the auditor shall use the heading “Qualified Opinion,” “Adverse Opinion,” or “Disclaimer of Opinion,” as appropriate, for the Opinion section. </p>
    <p><i>Basis for Opinion </i></p>
    <p>When the auditor modifies the opinion on the financial statements, the auditor shall, in addition to the specific elements required by PSA 700 (Revised): </p>
    <ol type="a">
        <li>) Amend the heading “Basis for Opinion” required by paragraph 28 of PSA 700 (Revised) to “Basis for Qualified Opinion,” “Basis for Adverse Opinion,” or “Basis for Disclaimer of Opinion,” as appropriate; and </li>
        <li>) Within this section, include a description of the matter giving rise to the modification.</li>
    </ol>
    <br>
    <p><b>MODIFIED REPORT</b></p>
    <table border="1">
        <thead>
            <tr>
                <th rowspan="2"><b>Nature of Matter Giving Rise to the Modification</b></th>
                <th colspan="2"><b>Auditor\'s Judgment about the Pervasiveness of the Effects or Possible Effects on the Financial Statements.</b></th>
            </tr>
            <tr>
                <th><b>Material but Not Pervasive</b></th>
                <th><b>Material and Pervasive</b></th>
            </tr>
        </thead>
        <tbody id="tbody"> 
            <tr>
                <td>Financial statements are materially misstated</td>
                <td>Qualified opinion</td>
                <td>Adverse opinion</td>
            </tr>
            <tr>
                <td>Inability to obtain sufficient appropriate audit evidence</td>
                <td>Qualified opinion</td>
                <td>Disclaimer of opinion</td>
            </tr>
            ';
            foreach($a11 as $r){
                $html .= '
                <tr>
                    <td>'.$r['field1'].'</td>
                    <td>'.$r['field2'].'</td>
                    <td>'.$r['field3'].'</td>
                </tr>
                ';
            }
$html .= '
        </tbody>
    </table>
';



$html .= '
    <p><b><i>Circumstances When a Modification to the Auditor’s Opinion Is Required</i></b></p>
    <ul>
        <li><i>Nature of Material Misstatements </i>
            <p>A material misstatement of the financial statements may arise in relation to: </p>
            <ol type="a">
                <li>) The appropriateness of the selected accounting policies; </li>
                <li>) The application of the selected accounting policies; or </li>
                <li>) The appropriateness or adequacy of disclosures in the financial statements </li>
            </ol>
        </li>
        <li><i>Nature of an Inability to Obtain Sufficient Appropriate Audit Evidence</i>
            <p>The auditor’s inability to obtain sufficient appropriate audit evidence (also referred to as a limitation on the scope of the audit) may arise from:</p>
            <ol type="a">
                <li>) Circumstances beyond the control of the entity; </li>
                <li>) Circumstances relating to the nature or timing of the auditor’s work; or </li>
                <li>) Limitations imposed by management. </li>
            </ol>
            <p><u>Examples of circumstances beyond the control of the entity include when: </u></p>
            <ul>
                <li>The entity’s accounting records have been destroyed. </li>
                <li>The accounting records of a significant component have been seized indefinitely by governmental authorities. </li>
            </ul>
            <p><u>Examples of circumstances relating to the nature or timing of the auditor’s work include when: </u></p>
            <ul>
                <li>The entity is required to use the equity method of accounting for an associated entity, and the auditor is unable to obtain sufficient appropriate audit evidence about the latter’s financial information to evaluate whether the equity method has been appropriately applied. </li>
                <li>The timing of the auditor’s appointment is such that the auditor is unable to observe the counting of the physical inventories. </li>
                <li>The auditor determines that performing substantive procedures alone is not sufficient, but the entity’s controls are not effective. </li>
            </ul>
            <p><u>Examples of an inability to obtain sufficient appropriate audit evidence arising from a limitation on the scope of the audit imposed by management include when: </u></p>
            <ul>
                <li>Management prevents the auditor from observing the counting of the physical inventory. </li>
                <li>Management prevents the auditor from requesting external confirmation of specific account balances. </li>
            </ul>
        </li>
    </ul>
    <p><b><i>Communication with Those Charged with Governance </i></b></p>
    <p>Communicating with those charged with governance the circumstances that lead to an expected modification to the auditor’s opinion and the wording of the modification enables: </p>
    <ol type="a">
        <li>) The auditor to give notice to those charged with governance of the intended modification(s) and the reasons (or circumstances) for the modification(s); </li>
        <li>) The auditor to seek the concurrence of those charged with governance regarding the facts of the matter(s) giving rise to the expected modification(s), or to confirm matters of disagreement with management as such; and,</li>
        <li>) Those charged with governance to have an opportunity, where appropriate, to provide the auditor with further information and explanations in respect of the matter(s) giving rise to the expected modification(s).</li>
    </ol>


















';


//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();