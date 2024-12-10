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
    <h3>GUIDANCE ON EMPHASIS OF MATTER PARAGRAPHS AND OTHER MATTER PARAGRAPHS IN THE INDEPENDENT AUDITOR’S REPORT</h3>
    <p><b>AUDITOR’S OBJECTIVE:</b></p>
    <p>The objective of the auditor, having formed an opinion on the financial statements, is to draw users’ attention, when in the auditor’s judgment it is necessary to do so, </p>
    <ol type="a">
        <li>) A matter, although appropriately presented or disclosed in the financial statements, that is of such importance that it is fundamental to users’ understanding of the financial statements; or </li>
        <li>) As appropriate, any other matter that is relevant to users’ understanding of the audit, the auditor’s responsibilities or the auditor’s report. </li>
    </ol>
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
                    <p><b><i>If the auditor considers it necessary to draw users’ attention to a matter presented or disclosed in the financial statements that, in the auditor’s judgment, is of such importance that it is fundamental to users’ understanding of the financial statements, the auditor shall include an Emphasis of Matter paragraph in the auditor’s report provided: </i></b></p>
                    <ol type="a">
                        <li><b><i>)The auditor would not be required to modify the opinion in accordance with PSA 705 (Revised)3 as a result of the matter; and </i></b></li>
                        <li><b><i>)When PSA 701 applies, the matter has not been determined to be a key audit matter to be communicated in the auditor’s report. </i></b></li>
                    </ol>
                </td>
                <td style="width: 20%;">'.$a12['wpref1'].'</td>
                <td style="width: 20%;">'.$a12['doneby1'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">
                    <p>When the auditor includes an Emphasis of Matter paragraph in the auditor’s report, the auditor shall: </p>
                    <ol type="a">
                        <li>Include the paragraph within a separate section of the auditor’s report with an appropriate heading that includes the term “Emphasis of Matter”; </li>
                        <li>Include in the paragraph a clear reference to the matter being emphasized and to where relevant disclosures that fully describe the matter can be found in the financial statements. The paragraph shall refer only to information presented or disclosed in the financial statements; and </li>
                        <li>Indicate that the auditor’s opinion is not modified in respect of the matter emphasized. </li>
                    </ol>
                </td>
                <td style="width: 20%;">'.$a12['wpref2'].'</td>
                <td style="width: 20%;">'.$a12['doneby2'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">
                    <p><b><i>If the auditor considers it necessary to communicate a matter other than those that are presented or disclosed in the financial statements that, in the auditor’s judgment, is relevant to users’ understanding of the audit, the auditor’s responsibilities or the auditor’s report, the auditor shall include an Other Matter paragraph in the auditor’s report, provided: </i></b></p>
                    <ol type="a">
                        <li><b><i>) This is not prohibited by law or regulation; and </i></b></li>
                        <li><b><i>) When PSA 701 applies, the matter has not been determined to be a key audit matter to be communicated in the auditor’s report.</i></b></li>
                    </ol>
                    <p><b><i>When the auditor includes an Other Matter paragraph in the auditor’s report, the auditor shall include the paragraph within a separate section with the heading “Other Matter,” or other appropriate heading.</i></b></p>
                </td>
                <td style="width: 20%;">'.$a12['wpref3'].'</td>
                <td style="width: 20%;">'.$a12['doneby3'].'</td>
            </tr>
            <tr>
                <td>
                    <p><b><i>If the auditor expects to include an Emphasis of Matter or an Other Matter paragraph in the auditor’s report, the auditor shall communicate with those charged with governance regarding this expectation and the wording of this paragraph.</i></b></p>
                </td>
                <td style="width: 20%;">'.$a12['wpref4'].'</td>
                <td style="width: 20%;">'.$a12['doneby4'].'</td>
            </tr>
        </tbody>
    </table>
    <p><b><i>Circumstances in Which an Emphasis of Matter Paragraph May Be Necessary </i></b></p>
    <ul>
        <li>When a financial reporting framework prescribed by law or regulation would be unacceptable but for the fact that it is prescribed by law or regulation. </li>
        <li>To alert users that the financial statements are prepared in accordance with a special purpose framework. </li>
        <li>When facts become known to the auditor after the date of the auditor’s report and the auditor provides a new or amended auditor’s report (i.e., subsequent events).</li>
        <li>An uncertainty relating to the future outcome of exceptional litigation or regulatory action.</li>
        <li>A significant subsequent event that occurs between the date of the financial statements and the date of the auditor’s report.</li>
        <li>Early application (where permitted) of a new accounting standard that has a material effect on the financial statements. </li>
        <li>A major catastrophe that has had, or continues to have, a significant effect on the entity’s financial position. </li>
        <li>A widespread use of Emphasis of Matter paragraphs may diminish the effectiveness of the auditor’s communication about such matters. </li>
    </ul>
    <p><b><i>Including an Emphasis of Matter Paragraph in the Auditor’s Report </i></b></p>
    <p>The inclusion of an Emphasis of Matter paragraph in the auditor’s report does not affect the auditor’s opinion. An Emphasis of Matter paragraph is not a substitute for: </p>
    <ol type="a">
        <li>) A modified opinion in accordance with PSA 705 (Revised) when required by the circumstances of a specific audit engagement; </li>
        <li>) Disclosures in the financial statements that the applicable financial reporting framework requires management to make, or that are otherwise necessary to achieve fair presentation; or </li>
        <li>) Reporting in accordance with PSA 570 (Revised)7 when a material uncertainty exists relating to events or conditions that may cast significant doubt on an entity’s ability to continue as a going concern. </li>
    </ol>
    <p><b><i>Circumstances in Which an Other Matter Paragraph May Be Necessary/ Relevant to Users’ </i></b></p>
    <p>Other Matter paragraph may be necessary for the users when: </p>
    <ul>
        <li>It will aid in the understanding of the Audit </li>
        <li>It is relevant to Users’ Understanding of the Auditor’s Responsibilities or the Auditor’s Report </li>
        <li>The auditor is reporting on more than one set of financial statements </li>
        <li>There is a restriction on distribution or use of the auditor’s report </li>
    </ul>
    <p><b><i>Including an Other Matter Paragraph in the Auditor’s Report </i></b></p>
    <p>The content of an Other Matter paragraph reflects clearly that such other matter is not required to be presented and disclosed in the financial statements.</p>
    <p>An Other Matter paragraph does not include information that the auditor is prohibited from providing by law, regulation or other professional standards, for example, ethical standards relating to confidentiality of information.</p>
    <p>An Other Matter paragraph also does not include information that is required to be provided by management. </p>
    <p><b>Placement of Emphasis of Matter Paragraphs and Other Matter Paragraphs in the Auditor’s Report </b></p>
    <p>The placement of an Emphasis of Matter paragraph or Other Matter paragraph in the auditor’s report depends on the nature of the information to be communicated, and the auditor’s judgment as to the relative significance of such information to intended users compared to other elements required to be reported in accordance with PSA 700 (Revised). For example: </p>
    <p><i>Emphasis of Matter Paragraphs </i></p>
    <ul>
        <li>When the Emphasis of Matter paragraph relates to the applicable financial reporting framework, including circumstances where the auditor determines that the financial reporting framework prescribed by law or regulation would otherwise be unacceptable,11 the auditor may consider it necessary to place the paragraph immediately following the Basis of Opinion section to provide appropriate context to the auditor’s opinion. </li>
        <li>When a Key Audit Matters section is presented in the auditor’s report, an Emphasis of Matter paragraph may be presented either directly before or after the Key Audit Matters section, based on the auditor’s judgment as to the relative significance of the information included in the Emphasis of Matter paragraph. The auditor may also add further context to the heading 
            <br><br>
            For example, as required by PSA 210, <i>Agreeing the Terms of Audit Engagements</i>, paragraph 19 and PSA 800, <i>Special Considerations—Audits of Financial Statements Prepared in Accordance with Special Purpose Frameworks</i>, paragraph 14
            <br><br>
            “Emphasis of Matter”, such as “Emphasis of Matter – Subsequent Event”, to differentiate the Emphasis of Matter paragraph from the individual matters described in the Key Audit Matters section. 
        </li>
    </ul>
    <p><i>Other Matter Paragraphs </i></p>
    <ul>
        <li>When a Key Audit Matters section is presented in the auditor’s report and an Other Matter paragraph is also considered necessary, the auditor may add further context to the heading “Other Matter”, such as “Other Matter – Scope of the Audit”, to differentiate the Other Matter paragraph from the individual matters described in the Key Audit Matters section. </li>
        <li>When an Other Matter paragraph is included to draw users’ attention to a matter relating to Other Reporting Responsibilities addressed in the auditor’s report, the paragraph may be included in the Report on Other Legal and Regulatory Requirements section. </li>
        <li>When relevant to all the auditor’s responsibilities or users’ understanding of the auditor’s report, the Other Matter paragraph may be included as a separate section following the Report on the Audit of the Financial Statements and the Report on Other Legal and Regulatory Requirements. </li>
    </ul>
    <p><b>Communication with Those Charged with Governance </b></p>
    <p>The communication required by paragraph 12 enables those charged with governance to be made aware of the nature of any specific matters that the auditor intends to highlight in the auditor’s report, and provides them with an opportunity to obtain further clarification from the auditor where necessary. 
        Where the inclusion of an Other Matter paragraph on a particular matter in the auditor’s report recurs on each successive engagement, the auditor may determine that it is unnecessary to repeat the communication on each engagement, unless otherwise required to do so by law or regulation.
        </p>
    <p><b>List of PSAs Containing Requirements for Emphasis of Matter Paragraphs </b></p>
    <ul>
        <li>PSA 210, <i>Agreeing the Terms of Audit Engagements</i> – paragraph 19(b) </li>
        <li>PSA 560, <i>Subsequent Events</i> – paragraphs 12(b) and 16 </li>
        <li>PSA 800, <i>Special Considerations—Audits of Financial Statements Prepared in Accordance with Special Purpose Frameworks</i> – paragraph 14</li>
    </ul>
    <p><b>List of PSAs Containing Requirements for Other Matter Paragraphs </b></p>
    <ul>
        <li>PSA 560, Subsequent Events – paragraphs 12(b) and 16 </li>
        <li>PSA 710, Comparative Information—Corresponding Figures and Comparative Financial Statements – paragraphs 13–14, 16–17 and 19 </li>
        <li>PSA 720, The Auditor’s Responsibilities Relating to Other Information in Documents Containing Audited Financial Statements – paragraph 10(a)</li>
    </ul>
';


//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();