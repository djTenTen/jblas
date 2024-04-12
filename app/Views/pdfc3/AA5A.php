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
<p><b>Private and Confidential</b> <br><br></p>
<table>
    <tr>
        <td>The Directors</td>
    </tr>
    <tr>
        <td>[Name of Client]<br></td>
    </tr>
    <tr>
        <td>[Address]<br></td>
    </tr>
</table>
<p>Dear Sirs</p>
<h3 class="cent">Management Letter <br> Financial statements for the [year/period] ending [date]</h3>
<p><b>Introduction</b></p>
<p>Following our recent [interim/final] audit in connection with the financial statements of [client name] for the [year/period] ending [date], we are writing to bring to your attention certain matters that arose during the course of our work, together with suggestions for improvements of controls and procedures operated by the company.  We hope you will find our comments helpful and constructive.</p>
<p>Our work during the audit included an examination of some of the company’s transactions, procedures [and controls] with a view to expressing an opinion on the financial statements for the [year/period].  This work was not directed primarily towards discovering deficiencies in, or the operating effectiveness of your internal controls [other than those that would affect our audit opinion] or towards the detection of fraud.  We have included in this letter only matters that have come to our attention as a result of our normal audit procedures and consequently our comments should not be regarded as a comprehensive record of all deficiencies in internal control that may exist, of all improvements that might be made, or of the operating effectiveness of your internal controls.</p>
<p><i>[Small organisations or clients with a few accounting staff:</i> <br>
    We recognise that the number of your [accounting] staff makes a complete system of internal control impracticable and that the directors [or named client officials] exercise close personal supervision, which we consider reasonable in the circumstances.  We have taken this into account in conducting our audit and in preparing this letter].</p>
<p>[Final audit only] Our work also included a review of the adequacy of disclosures in the financial statements and consideration of the appropriateness of the accounting policies and estimation techniques adopted by the company. This review identified no significant matters, which we believe are necessary to draw to your attention. [amend as required].</p>
<p><b>Summary</b></p>
<p>The important matters that arose as a result of our work are set out in detail [below]/[in the attached memorandum]. [Matters of less significance are included in an appendix………..] [The attached memorandum and appendix collectively form part of this letter.]</p>
<p><i>[For groups or large organisations: </i><br>
    We have prepared a separate memorandum for each subsidiary, division or different level of functional responsibility, as set out below:]</p>
<p>We would particularly draw your attention to the following matters:</p>
<p><b>[Significant qualitative aspects of the entity’s accounting practices, including accounting policies, accounting estimates and financial statement disclosures:</b></p>
<p><i>Summary list of key matters:</i> <br>
1. <br>
2. etc.]</p>
<p><b>[Significant difficulties encountered during the audit:</b></p>
<p><i>Summary list of key matters:</i> <br>
1. <br>
2. etc.]</p>
<p><b>[Other matters, if any, arising from the audit that in our professional judgment, are significant to the oversight of the financial reporting process:</b></p>
<p><i>Summary list of key matters:</i> <br>
1. <br>
2. etc.]</p>
<p><i>[Where matters included in previous management letters have not been fully resolved:</i> <br>
    We wrote to you previously on [date(s)] following our [interim/final audit(s)] for the [year/period] ending [date].  We are pleased to record that many of the matters raised have been dealt with satisfactorily [although we appreciate that you are still carefully considering the implementation of [specific recommendation(s)]].
    </p>
<p>[Significant matters previously brought to your attention that, in our opinion, have not been effectively dealt with are summarised as follows:</p>
<table border="1">
    <thead>
        <tr>
            <th style="width: 60%;"><b>Subject</b></th>
            <th style="width: 20%;"><b>Date of Letter</b></th>
            <th style="width: 20%;"><b>Paragrap Ref.</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 60%;"><input type="text" class="form-control"></td>
            <td style="width: 20%;"><input type="text" class="form-control"></td>
            <td style="width: 20%;"><input type="text" class="form-control"></td>
        </tr>
        <tr>
            <td style="width: 60%;"><input type="text" class="form-control"></td>
            <td style="width: 20%;"><input type="text" class="form-control"></td>
            <td style="width: 20%;"><input type="text" class="form-control"></td>
        </tr>
    </tbody>
</table>
<p>Any matters of particular significance should be repeated in detail.]</p>
<p><b>Conclusion</b></p>
<p>If you require any further information or assistance, we shall be very pleased to help you.</p>
<p>We would appreciate an acknowledgement of the receipt of this letter and look forward to receiving your comments when you have had the opportunity of considering the matters that we have raised.  [You have agreed that the contents of this letter will be minuted by the company after due consideration by the board].</p>
<p>This letter is for your private use only.  It has been prepared on the understanding that it will not be disclosed to any third party, or quoted to or referred to, without our prior written consent and we assume no responsibility to any other party.</p>
<p>We should like to take this opportunity of thanking you and your staff for the assistance and co-operation we have received during the course of our work.  The contents of this letter were discussed with and have been approved by [name of client official(s)] on [date]. <br><br></p>
<p>Yours faithfully <br><br></p>
<p>……………………………………………………… <br>
    Signed for and on behalf of [Audit Firm]
</p>
<div class="bo">
    Notes
    <ol type="1">
        <li>The formal management letter, addressed to ‘The Board of Directors’ [or equivalent body], may be accompanied by an informal letter to a client official, with whom it has been agreed, to arrange distribution and response, e.g. company secretary, finance director, etc. <br></li>
        <li>The procedure for acknowledging management letters and minuting, if appropriate, needs to be agreed with the client in advance. <br></li>
        <li>Care needs to be taken to explain and discuss the disclaimer paragraph with the clients in advance.  There may be occasions when verbal, rather than written, consent to disclosure is more practicable or desirable. <br></li>
    </ol>
</div>
<p><b>ADDITIONAL REQUIREMENTS WHERE THOSE CHARGED WITH GOVERNANCE AND MANAGEMENT DIFFER</b></p>
<p>The following are additional communication requirements when those charged with governance and management differ, which may be communicated as a “combined” document, or may be communicated as separate documents to management and those charged with governance:</p>
<ul>
    <li>Any matters which have been communicated to management should also be communicated to those charged with governance (ISA 260.16(c));</li>
    <li>Where management have corrected misstatements, the corrections should be communicated to those charged with governance (ISA 450.A23-1);</li>
    <li>Where management has refused to allow the auditor to send a confirmation request, such as a debtors’ circularisation (which the auditor believes is unreasonable) and it has not been possible for alternative procedures to be performed (ISA 505.9);</li>
    <li>Significant matters arising during the audit in connection with the entity’s related parties (ISA 550.27); and</li>
    <li>Events or conditions identified which may cast significant doubt on the entity’s ability to continue as a going concern, which shall include the following:
        <ul>
            <li>Whether the events or conditions constitute a material uncertainty;</li>
            <li>Whether the use of the going concern basis of accounting is appropriate in the preparation of the financial statements; </li>
            <li>The adequacy of related disclosures in the financial statements; and</li>
            <li>Where applicable, the implications for the auditor’s report.  (ISA 570.25).</li>
        </ul>
    </li>   
</ul>

';











    


//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();