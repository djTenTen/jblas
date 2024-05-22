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
$pdf->AddPage('P');
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
<table>
    <tr>
        <td style="width: 60%;">
            <table>
                <tr><td class="bb">Client:</td></tr>
                <tr><td></td></tr>
                <tr><td class="bb">Period:</td></tr>
            </table>
        </td>
        <td style="width: 40%;">
            <table border="1">
                <tr>
                    <td>Prepared by: <br></td>
                    <td>Date: <br></td>
                </tr>
                <tr>
                    <td>Reviewed by: <br></td>
                    <td>Date: <br></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
';
$html .= '
<h3>ISA COMPLIANCE CRITICAL ISSUES MEMORANDUM</h3>
<p><b>Objective:</b></p>
<p>To ensure compliance with ISA by providing a summary of critical audit issues and how these have been resolved. When read in conjunction with final analytical procedures, completion of this memorandum should provide the Audit Engagement Partner with an executive summary of the key points arising from the assignment.</p>
<p><b>Recording:</b></p>
<p>This form must be completed and include any changes made to the original planning documentation, how significant risks have been addressed during the audit and certain other issues specifically required by ISA. <i>The first 3 pages of this form are mandatory</i>.</p>
<p>If the A.E.P. wishes, this form can be fully completed thus providing a comprehensive executive summary which (when read in conjunction with final analytical procedures) provides a critical review of financial and non-financial matters, notes outstanding work; key issues where the A.E.P.’s input is needed and key issues that require further client involvement.</p>
<p>This form should not be used to record routine review points or administrative points for the A.E.P.’s attention or to record outstanding work at interim stages of the assignment.</p>
<table border="1">
    <tbody>
        <tr>
            <td><b>Summary and Impact of Changes Made to Audit Planning After the Date of the A.E.P’s Approval:</b>
                <br><br><br>
                '.$aepapp['question'].'
                <br><br><br>
            </td>
        </tr>
    </tbody>
</table>
<p>I approve the above changes to the planning, and consider that these changes have been adequately integrated into the audit approach.</p>
<table>
    <tr>
        <td style="width: 50%;">Changes approved by:___________(A.E.P.) </td>
        <td style="width: 50%;">on_____________</td>
    </tr>
</table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage('L');
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
    </style>
";
$html .= '
    <p><b>I have considered the requirements of ISA 315 and specifically, the definition of a significant risk being, “an identified and assessed risk of material misstatement that, in the auditor’s judgment, requires special audit consideration”.</b></p>
    <p><b>A summary of significant risks identified, the outcome from audit tests performed on those risks, and the conclusions reached (mandatory section):</b> <br> <i>(Insert additional rows as required)</i></p>
';
$html .= '
<h3>MANAGEMENT LETTER WORKSHEET [INTERIM / FINAL AUDIT]</h3>
<table border="1" class="cent">
    <thead>
        <tr >
            <th style="width: 15%;"><b>Area / Assertion</b></th>
            <th style="width: 30%;"><b>Significant risk identified</b></th>
            <th style="width: 10%;"><b>Audit test reference</b></th>
            <th style="width: 20%;"><b>Results of audit tests</b></th>
            <th style="width: 20%;"><b>Conclusions</b></th>
        </tr>
    </thead>
    <tbody>
    ';
    foreach($aa7 as $r){
        $html .= '
        <tr>
            <td style="width: 15%;"><br><br>'.$r['reference'].'<br></td>
            <td style="width: 30%;"><br><br>'.$r['issue'].'<br></td>
            <td style="width: 10%;"><br><br>'.$r['comment'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
        </tr>';
    }
$html .='
    </tbody>
</table>';
$html .= '
<p>I consider that significant risks have been identified and adequately addressed by this assignment, and have been appropriately communicated to the client in the Planning Letter (or, for significant risks identified at a later stage of the assignment, via alternative, appropriate documentation).</p>
<table>
    <tr>
        <td style="width: 50%;">Signature:___________(A.E.P.) </td>
        <td style="width: 50%;">on_____________</td>
    </tr>
</table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage('L');
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
    </style>
";
$html .= '
<table border="1" >
    <thead>
        <tr>
            <th style="width: 20%;"><b>Issue(s):</b></th>
            <th style="width: 20%;"><b>Comments and conclusion of the audit team:</b></th>
            <th style="width: 20%;"><b>(If applicable) <br> Further information needed from the client and a summary of information subsequently received:</b></th>
            <th style="width: 20%;"><b>(If applicable) <br> A.E.P. input required:</b></th>
            <th style="width: 20%;"><b>A.E.P. Conclusion(s):</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="5"><b>Areas where consultation has been undertaken (mandatory section):</b></td>
        </tr>
    ';
    foreach($cons as $r){
        $html .= '
        <tr>
            <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
        </tr>';
    }
$html .= '
    <tr>
        <td colspan="5"><b>Inconsistencies noted between information provided by the client and other findings of the audit team (mandatory section):</b></td>
    </tr>';
    foreach($inc as $r){
        $html .= '
        <tr>
            <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
        </tr>';
    }
$html .= '
    <tr>
        <td colspan="5"><b>Areas where management refusal to allow the audit team to send a confirmation request has led to alternative procedures being performed (mandatory section):</b></td>
    </tr>';
    foreach($ref as $r){
        $html .= '
        <tr>
            <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
        </tr>';
    }
$html .= '
    <tr>
        <td colspan="5"><b>Departures from requirements of ISA, reasons for the departure and alternative audit procedures performed (mandatory section):</b></td>
    </tr>';
    foreach($dep as $r){
        $html .= '
        <tr>
            <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
        </tr>';
    }
$html .='
    </tbody>
</table>';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage('L');
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
    </style>
";
$html .= '<p><b>Other Issues (including any key outstanding audit matters):</b></p>';
$html .= '
<table border="1" >
    <thead>
        <tr>
            <th style="width: 20%;"><b>Issue(s):</b></th>
            <th style="width: 20%;"><b>Comments and conclusion of the audit team:</b></th>
            <th style="width: 20%;"><b>(If applicable) <br> Further information needed from the client and a summary of information subsequently received:</b></th>
            <th style="width: 20%;"><b>(If applicable) <br> A.E.P. input required:</b></th>
            <th style="width: 20%;"><b>A.E.P. Conclusion(s):</b></th>
        </tr>
    </thead>
    <tbody>
    ';
    foreach($oth as $r){
        $html .= '
        <tr>
            <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
        </tr>';
    }
$html .='
    </tbody>
</table>';
$html .= '
<p><b>Changes to, or new accounting policies and estimation techniques in the period:</b></p>
<table border="1">
    <thead>
        <tr>
            <th><b>Points to A.E.P.:</b></th>
            <th><b>A.E.P. Comments:</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <br><br><br>
                '.$aep['ch1'].'
                <br><br><br>
            </td>
            <td>
                <br><br><br>
                '.$aep['ch2'].'
                <br><br><br>
            </td>
        </tr>
    </tbody>
</table>
<p><b>Developments during the period:</b></p>
<table border="1">
    <thead>
        <tr>
            <th><b>Points to A.E.P.:</b></th>
            <th><b>A.E.P. Comments:</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <br><br><br>
                '.$aep['dev1'].'
                <br><br><br>
            </td>
            <td>
                <br><br><br>
                '.$aep['dev2'].'
                <br><br><br>
            </td>
        </tr>
    </tbody>
</table>
<p><b>Future developments:</b></p>
<table border="1">
    <thead>
        <tr>
            <th><b>Points to A.E.P.:</b></th>
            <th><b>A.E.P. Comments:</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <br><br><br>
                '.$aep['fut1'].'
                <br><br><br>
            </td>
            <td>
                <br><br><br>
                '.$aep['fut2'].'
                <br><br><br>
            </td>
        </tr>
    </tbody>
</table>
<p><b>Costs to date, including an explanation of deviation from budget, and timetable for completion:</b></p>
<table border="1">
    <thead>
        <tr>
            <th><b>Points to A.E.P.:</b></th>
            <th><b>A.E.P. Comments:</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <br><br><br>
                '.$aep['cst1'].'
                <br><br><br>
            </td>
            <td>
                <br><br><br>
                '.$aep['cst2'].'
                <br><br><br>
            </td>
        </tr>
    </tbody>
</table>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();