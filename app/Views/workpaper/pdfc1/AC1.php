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
$pdf->setPrintHeader(false);
// set margins
$pdf->SetMargins(25,15,15);  
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-60, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderMargin(0);   
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
        <td style="width: 55%;">
            <table>
                <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                <tr><td></td></tr>
                <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
            </table>
        </td>
        <td style="width: 45%;">
            <table border="1">
                <tr>
                    <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                    <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= date('F d, Y', strtotime($fl['prepared_on']));}else{$html .= '';} $html .='</b></td>
                </tr>
                <tr>
                    <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                    <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= date('F d, Y', strtotime($fl['reviewed_on']));}else{$html .= '';} $html .='</b></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
';


$html .= '
<h3>Client Acceptance or Continuance Form</h3>
<p><b>This form must be completed by the A.E.P. before any work is undertaken on the file.</b></p>
<p>While answering these questions the following matters should be fully considered for the audit firm and any network firm: independence, integrity, conflicts of interest with other clients, economic dependence, trusts, matters arising with regulatory authorities, ability to service the client, other services provided to the client and hospitality. Additional guidance is available in legislation and the Code of Ethics issued by the International Ethics Standards Board for Accountants.  </p>
<p><b>Any YES answers should be fully explained along with the safeguards, which will enable us to accept / continue with the appointment. </b></p>
<p><b>Significant issues must be discussed with the <span style="color: red;">Ethics Partner</span>  and details of the discussion documented on file.</b></p>

';

$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 10%"></th>
            <th style="width: 50%"></th>
            <th style="width: 20%" class="cent bo"><b>YES/NO</b></th>
            <th style="width: 20%" class="cent bo"><b>COMMENTS</b></th>
        </tr>
    </thead>
    <tbody>';
    $c = 0;
    foreach($ac1 as $r){
        $c ++;
        $html .='
            <tr>
                <td style="width: 10%">'.$c.'</td>
                <td style="width: 50%;">'.$r['field1'].'</td>
                <td style="width: 20%" class="cent bo">'.$r['field2'].'</td>
                <td style="width: 20%" class="cent bo">'.$r['field3'].'</td>
            </tr>
        ';
    }

$html .= '   
    </tbody>
</table>';


$html .= '
    <p>Name of A.P., not connected with this assignment, to whom staff may bring any grievances related to this engagement:_______________</p>
    <p><b>ENGAGEMENT QUALITY REVIEW:</b></p>
    <p>An EQR needs to be undertaken on all audits where:</p>';
    switch ($eqr['eqr']) {
        case 'It is necessary for an EQR to be performed and this will be performed by: ':
            $html .=  '<ul><li>'.$eqr['eqr'].' '.$eqr['eq1'].'</li></ul>';
        break;
        case 'Where the EQR is undertaken by an external reviewer the name of the organisation which they work for ':
            $html .=  '<ul><li>'.$eqr['eqr'].' '.$eqr['eq2'].'</li></ul>';
        break;
        default:
            $html .=  '<ul><li>'.$eqr['eqr'].'</li></ul>';
        break;
    }

$html .= '
    <p><b>REASON FOR EQR:</b></p>
    <p>'.$eqr['eqrr'].'</p>
    <p><b>Authority to accept appointment:</b></p>
    <p>Having completed the checklist '.$eqr['hcc'].' consider that there are any perceived threats to our independence, integrity and objectivity, and believe that we '.$eqr['iio'].' this appointment.</p>
    <p>Where necessary, adequate consultation has been undertaken and documented at_______________.</p>
    <table>
        <tbody>
            <tr>
                <td style="width: 50%;">Signature: </td>
                <td style="width: 50%;">(A.E.P.)</td>
            </tr>
            <tr>
                <td style="width: 50%;"><p>Date: '.date('F d, Y', strtotime($fl['prepared_on'])).'</p><br></td>
                <td style="width: 50%;" class="cent"></td>
            </tr>
            <tr>
                <td style="width: 50%;"><p><i>If appropriate:</i></p><br></td>
                <td style="width: 50%;" class="cent"></td>
            </tr>
            <tr>
                <td style="width: 50%;">Signature:</td>
                <td style="width: 50%;">(EQR) </td>
            </tr>
            <tr>
                <td style="width: 50%;"><p>Date: </p></td>
                <td style="width: 50%;" class="cent"></td>
            </tr>
        </tbody>
    </table>
';


    
    






//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();