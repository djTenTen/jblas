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

$html .= '<h3>POINTS FORWARD</h3>
<p><b>Objective: </b> <br>
    To provide a summary of the key points arising from the audit, where it is possible for improvements to the efficiency of the audit to be made, and should include both financial and non-financial matters. <br><i>The use of this form is optional.</i></p>
<p><b>Recording:</b> <br>This form should be completed during the audit, and should cover key matters which are of relevance to next year’s assignment.</p>
<p>If information has been included elsewhere on the audit file (for example, Subsequent Events Review, or the ISA Compliance Critical Issues Memorandum), it does not need to be repeated.  Where appropriate, details of suggested improvements should be outlined.</p>
';

$html .= '
<table border="1">
    <tbody>
        <tr>
            <td><b>Problems encountered during the audit (regarding audit tests):</b>
                <br>
                <p>'.$aa2['rat'].'</p>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </tbody>
</table>
<br><br>
<table border="1">
    <tbody>
        <tr>
            <td><b>Problems encountered during the audit (regarding the client, and their accessibility etc.):</b>
                <br>
                <p>'.$aa2['rcae'].'</p>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </tbody>
</table>
<br><br>
<table border="1">
    <tbody>
        <tr>
            <td><b>Audit tests which can be removed / reduced without impairing audit quality:</b>
                <br>
                <p>'.$aa2['atriaq'].'</p>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </tbody>
</table>
<br><br>
<table border="1">
    <tbody>
        <tr>
            <td><b>Known changes to, or new accounting policies and estimation techniques in the forthcoming period:</b>
                <br>
                <p>'.$aa2['kcapet'].'</p>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </tbody>
</table>
<br><br>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage();
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
<table border="1">
    <tbody>
        <tr>
            <td><b>Future developments (nature of business, locations, acquisitions and disposals):</b>
                <br>
                <p>'.$aa2['fd'].'</p>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </tbody>
</table>
<br><br>
<table border="1">
    <tbody>
        <tr>
            <td><b>Future structure of the audit team:</b>
                <br>
                <p>'.$aa2['fs'].'</p>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </tbody>
</table>
<br><br>
<table border="1">
    <tbody>
        <tr>
            <td><b>Other issues:</b>
                <br>
                <p>'.$aa2['oi'].'</p>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </tbody>
</table>
';

    


//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();