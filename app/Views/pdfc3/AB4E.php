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
<p><b>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)<br>
~ Additional Disclosures for First Time Adopters of IFRS
   </b></p>
   <p><b><u>Scope</u></b> <br>This checklist should be completed for all entities that are adopting IFRS for the first time.</p>
';
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th style="width: 70%;" colspan="3"><b>IFRS  Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>
            ';
        foreach($ab4e as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();