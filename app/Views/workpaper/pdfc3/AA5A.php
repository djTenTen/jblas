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
    <tr>
        <td>Date: '.$aa5a['aa51d'].'<br></td>
    </tr>
</table>
<p>Dear Sirs</p>
<h3 class="cent">Management Letter <br> Financial statements for the [year/period] ending [date]</h3>
<p><b>Introduction</b></p>
<p>Following our recent '.$aa5a['ml1'].' audit in connection with the financial statements of [client name] for the [year/period] ending '.date('F d, Y', strtotime($aa5a['ml1d'])).', we are writing to bring to your attention certain matters that arose during the course of our work, together with suggestions for improvements of controls and procedures operated by the company.  We hope you will find our comments helpful and constructive.</p>
<p>Our work during the audit included an examination of some of the company’s transactions, procedures and controls with a view to expressing an opinion on the financial statements for the [year/period].  This work was not directed primarily towards discovering deficiencies in, or the operating effectiveness of your internal controls other than those that would affect our audit opinion or towards the detection of fraud.  We have included in this letter only matters that have come to our attention as a result of our normal audit procedures and consequently our comments should not be regarded as a comprehensive record of all deficiencies in internal control that may exist, of all improvements that might be made, or of the operating effectiveness of your internal controls.</p>';

if($aa5a['ml2'] != ''){
    $html .= '<p>'.$aa5a['ml2'].'</p>';
}

$html .='
<p>Our work also included a review of the adequacy of disclosures in the financial statements and consideration of the appropriateness of the accounting policies and estimation techniques adopted by the company. This review identified no significant matters, which we believe are necessary to draw to your attention.</p>
<p><b>Summary</b></p>
<p>The important matters that arose as a result of our work are set out in detail in the attached memorandum.</p>';

if($aa5a['ml3'] != ''){
    $html .= '<p>'.$aa5a['ml3'].'</p>';
}
$html .='<p>We would particularly draw your attention to the following matters:</p>';

if($aa5a['ml4'] != ''){
    $html .= '<p><b>'.$aa5a['ml4'].'</b></p>';
    $html .= '<p>'.$aa5a['ml4d'].'</p>';
}
if($aa5a['ml5'] != ''){
    $html .= '<p><b>'.$aa5a['ml5'].'</b></p>';
    $html .= '<p>'.$aa5a['ml5d'].'</p>';
}
if($aa5a['ml6'] != ''){
    $html .= '<p><b>'.$aa5a['ml6'].'</b></p>';
    $html .= '<p>'.$aa5a['ml6d'].'</p>';
}
if($aa5a['ml7'] != ''){
    $html .= '<p>We wrote to you previously on '.date('F d, Y', strtotime($aa5a['ml7d'])).' following our '.$aa5a['ml8'].' audit for the [year/period] ending [date]. We are pleased to record that many of the matters raised have been dealt with satisfactorily.</p>';
}

$html .='
<p><b>Conclusion</b></p>
<p>If you require any further information or assistance, we shall be very pleased to help you.</p>
<p>We would appreciate an acknowledgement of the receipt of this letter and look forward to receiving your comments when you have had the opportunity of considering the matters that we have raised. </p>
<p>This letter is for your private use only.  It has been prepared on the understanding that it will not be disclosed to any third party, or quoted to or referred to, without our prior written consent and we assume no responsibility to any other party.</p>
<p>We should like to take this opportunity of thanking you and your staff for the assistance and co-operation we have received during the course of our work. <br><br></p>
<p>Yours faithfully <br></p>
<p>……………………………………………………… <br>
    Signed for and on behalf of [Audit Firm]
</p>

';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();