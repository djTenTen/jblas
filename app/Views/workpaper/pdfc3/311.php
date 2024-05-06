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
    <p><b>INDEPENDENT AUDITOR’S REPORT TO THE MEMBERS OF [NAME OF ENTITY] LIMITED</b></p>
    <p><b>Opinion</b></p>
    <p>We have audited the financial statements of [Name of entity]1 (the ‘company’) for the year ended [date]1 which comprise [specify the titles of the primary statements]2 and notes to the financial statements, including a summary of significant accounting policies.</p>
    <p>In our opinion, the accompanying financial statements:</p>
    <ul>
        <li>give a true and fair view of the financial position of the company as at [date] and of its financial performance [and cash flows] for the year then ended;  </li>
        <li>have been properly prepared in accordance with International Financial Reporting Standards[; and</li>
        <li>have been properly prepared in accordance with [insert legislation]].3</li>
    </ul>
    <p><b>Basis for opinion</b></p>
    <p>We conducted our audit in accordance with International Standards on Auditing (ISAs).  Our responsibilities under those standards are further described in the Auditor’s Responsibilities for the Audit of the Financial Statements section of our report.  We are independent of the Company in accordance with the International Ethics Standards Board for Accountants Code of Ethics for Professional Accountants (IESBA Code), and we have fulfilled our other ethical responsibilities in accordance with these requirements.  We believe that the audit evidence we have obtained is sufficient and appropriate to provide a basis for our opinion.</p>
    <p><b>[Use of our report</b></p>
    <p>This report, including the opinion, has been prepared for and only for the company’s members as a body in accordance with [insert legislation]3 and for no other purpose.  We do not, in giving these opinions, accept or assume responsibility for any other purpose or to any other person to whom this report is shown or into whose hands it may come save where expressly agreed by our prior consent in writing.]4</p>
    <p><b>Responsibilities of directors for the financial statements</b></p>
    <p>The directors are responsible for the preparation of financial statements that give a true and fair view in accordance with [insert jurisdiction / legislation]3 and International Financial Reporting Standards, and for such internal control as the directors determine is necessary to enable the preparation of financial statements that are free from material misstatement, whether due to fraud or error.</p>
    <p>In preparing the financial statements, the directors are responsible for assessing the company’s ability to continue as a going concern, disclosing, as applicable, matters related to going concern and using the going concern basis of accounting unless the directors either intend to liquidate the company or to cease operations, or have no realistic alternative but to do so.</p>
    <p><b>Auditor’s responsibilities for the audit of the financial statements</b></p>
    <p>Our objectives are to obtain reasonable assurance about whether the financial statements as a whole are free from material misstatement, whether due to fraud or error, and to issue an auditor’s report that includes our opinion.  Reasonable assurance is a high level of assurance, but is not a guarantee that an audit conducted in accordance with ISAs will always detect a material misstatement when it exists.</p>
    <p>Misstatements can arise from fraud or error and are considered material if, individually or in the aggregate, they could reasonably be expected to influence the economic decisions of users taken on the basis of these financial statements.</p>
    <p>As part of an audit in accordance with ISAs, we exercise professional judgment and maintain professional scepticism throughout the audit. We also:</p>
    <ul>
        <li>identify and assess the risks of material misstatement of the financial statements, whether due to fraud or error, design and perform audit procedures responsive to those risks, and obtain audit evidence that is sufficient and appropriate to provide a basis for our opinion.  The risk of not detecting a material misstatement resulting from fraud is higher than for one resulting from error, as fraud may involve collusion, forgery, intentional omissions, misrepresentations, or the override of internal control;</li>
        <li>obtain an understanding of internal control relevant to the audit in order to design audit procedures that are appropriate in the circumstances, but not for the purpose of expressing an opinion on the effectiveness of the company’s internal control;</li>
        <li>evaluate the appropriateness of accounting policies used and the reasonableness of accounting estimates and related disclosures made by the directors;</li>
        <li>conclude on the appropriateness of the directors’ use of the going concern basis of accounting and, based on the audit evidence obtained, whether a material uncertainty exists related to events or conditions that may cast significant doubt on the company’s ability to continue as a going concern. If we conclude that a material uncertainty exists, we are required to draw attention in our auditor’s report to the related disclosures in the financial statements or, if such disclosures are inadequate, to modify our opinion. Our conclusions are based on the audit evidence obtained up to the date of our auditor’s report. However, future events or conditions may cause the company to cease to continue as a going concern; and</li>
        <li>evaluate the overall presentation, structure and content of the financial statements, including the disclosures, and whether the financial statements represent the underlying transactions and events in a manner that achieves fair presentation.</li>
    </ul>
    <p>We communicate with those charged with governance regarding, among other matters, the planned scope and timing of the audit and significant audit findings, including any significant deficiencies in internal control that we identify during our audit.</p>
    <p><b>[Report on other legal and regulatory requirements</b></p>
    <p><b>Opinions on other matters prescribed by the [insert legislation]3</b></p>
    <p>[Insert opinions required]</p>
    <p><b>Matters on which we are required to report by exception</b></p>
    <p>[Insert opinions required]]3</p>
    <p>[Signature]</p>
    <p>[Address]</p>
    <p>[Signature in the name of the audit firm, the personal name of the auditor, or both, depending on local legislation]3</p>
    <p>[Date]</p>
    <p><b>Notes:</b></p>
    <ol type="1">
        <li>Amend as appropriate.</li>
        <li>The audit report should identify the title of each statement comprising the financial statements (ISA 700, para 24c) - references to page numbers are no longer permitted. The terms used to describe the primary statements should be the same as those used by the directors.</li>
        <li>Where applicable, there should be appropriate reference to local legislation applicable to the financial statements of limited companies, including any additional auditor reporting requirements which may arise.</li>
        <li>Certain jurisdictions recommend including a disclaimer in the wording of the audit report to highlight that no duty of care is owed to any party other than the addressee of the report.  Such wording should be included if encouraged locally.</li>
    </ol>
    ';











    


//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();