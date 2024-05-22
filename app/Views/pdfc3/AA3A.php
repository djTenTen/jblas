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
                <tr><td class="bb">Client:</td></tr>
                <tr><td></td></tr>
                <tr><td class="bb">Period:</td></tr>
            </table>
        </td>
    </tr>
</table>
';
$html .= '<h3>SUBSEQUENT EVENTS REVIEW</h3>
<p><b>Objective: </b> <br>
To determine whether any material adjustment or disclosure is required to the financial statements as a result of events occurring between the end of the accounting period and the date of signing the audit report and to ensure the requirements of ISA 560 regarding subsequent events are met.</p>
<p class="bo"><b>NB: An adjusting event is an event that provides evidence of a condition that existed at the reporting date.  A non-adjusting event is an event that arose solely after the reporting date, however, its disclosure is necessary to give a true and fair view.</b></p>';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 6%;"></th>
            <th style="width: 47%;"><b>Review of Clients Records</b></th>
            <th class="cent bo" style="width: 47%;"><b>Working Paper Reference or Comment</b></th>
        </tr>
    </thead>
    <tbody>';
    $count = 0;
    foreach($cr as $r){
        $count ++;
        $html .= '
        <tr>
            <td style="width: 6%;">'.$count.'.<br></td>
            <td style="width: 47%;">'.$r['question'].'<br></td>
            <td class="cent bo" style="width: 47%;">'.$r['reference'].'</td>
        </tr>
        ';
    }
$html .= '
    </tbody>
</table>
';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 6%;"></th>
            <th style="width: 47%;"><b>Discussion with Client</b></th>
            <th class="cent bo" style="width: 47%;"><b>Working Paper Reference or Comment</b></th>
        </tr>
    </thead>
    <tbody>';
    $count = 0;
    foreach($dc as $r){
        $count ++;
        $html .= '
        <tr>
            <td style="width: 6%;">'.$count.'.<br></td>
            <td style="width: 47%;">'.$r['question'].'<br></td>
            <td class="cent bo" style="width: 47%;">'.$r['reference'].'</td>
        </tr>
        ';
    }
$html .= '
    </tbody>
</table>
';
$html .= '
    <p><b>Finalisation of the Audit File</b></p>
    <p>This section should also detail any other work done on subsequent events not covered by the questions below.</p>
';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 6%;"></th>
            <th style="width: 60%;"><b></b></th>
            <th class="cent bo" style="width: 18%;"><b>Initial & Date</b></th>
            <th class="cent bo" style="width: 18%;"><b>WP Ref / Comment</b></th>
        </tr>
    </thead>
    <tbody>';
    $count = 0;
    foreach($faf as $r){
        $count ++;
        $html .= '
        <tr>
            <td style="width: 6%;">'.$count.'.<br></td>
            <td style="width: 60%;">'.$r['question'].'<br></td>
            <td class="cent bo" style="width: 18%;">'.$r['extent'].'</td>
            <td class="cent bo" style="width: 18%;">'.$r['reference'].'</td>
        </tr>
        ';
    }
$html .= '
    </tbody>
</table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
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
    <h3>Initial Conclusion:</h3>
    <p>* Delete as applicable </p>
    <p>Having completed the above procedures:</p>
    <p>There were no significant events. *</p>
    <p>Subsequent events identified above have* / have not* been adequately reflected in the financial statements.</p>
    <p>Significant events highlighted by this review, including any disagreements with the client have been brought to the A.E.P.\'s attention and are noted on schedule ___________ *</p>
    <table>
        <tr>
            <td style="width: 50%;">Prepared by:___________</td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
        <tr>
            <td style="width: 50%;">Reviewed by:___________</td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
    </table>
    <h3>Final Conclusion:</h3>
    <p><i>If there is a significant delay* between the initial subsequent event review and the signing of the audit report:</i></p>
    <ul>
        <li><i>then a detailed subsequent event review will need to be reperformed to this date;</i></li>
        <li><i>consideration should be given to the reason for the delay, as this may be indicative of potential going concern problems; and</i></li>
        <li><i>if there is no justifiable reason for the delay, revisit and update the going concern review.</i></li>
    </ul>
    <p><i>* - “Significant delay” is not defined, but a delay in excess of three months is likely to mean that the subsequent events review will need to be reperformed.</i></p>
    <p>The initial review was conducted sufficiently close to the proposed date of the audit report not to require the work to be revised.*</p>
    <p>The initial review has been updated to _____________ (insert date). The work performed is outlined below:*</p>
    <table>
        <tbody>
            <tr>
                <td class="bo">
                    <br><br><br>
                    '.$ir['question'].'
                    <br><br><br>
                </td>
            </tr>
        </tbody>
    </table>
    <p>Having reviewed the above procedures:</p>
    <p>I am satisfied that no further significant events have occurred between the initial review as documented by the conclusion above and _____________ (date of the final review) * <br> Significant events that have occurred are explained above, have been communicated to the A.E.P., and adequately accounted for / disclosed in the financial statements. *</p>
    <table>
        <tr>
            <td style="width: 50%;">Prepared by:___________</td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
        <tr>
            <td style="width: 50%;">Reviewed by:___________</td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
    </table>
    <p><i>N.B. If a matter is discovered after the financial statements are approved which may have changed the opinion given, consider the following (ISA 560.10):</i></p>
    <ul>
        <li><i>Discuss the issue with management;</i></li>
        <li><i>Revising the financial statements;</i></li>
        <li><i>Taking appropriate action.</i></li>
    </ul>
    ';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();