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
        <td style="width: 50%;">
            <table>
                <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                <tr><td></td></tr>
                <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
            </table>
        </td>
        <td style="width: 50%;">
            <table border="1">
                <tr>
                    <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                    <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                </tr>
                <tr>
                    <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                    <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
';
$html .= '<h3>PROPERTY, PLANT AND EQUIPMENT – TOP UP PROGRAMME</h3>';
$html .= '
        <p>This programme includes “top up” tests to be completed when the entity has the following:</i></p>
        <ul>
            <li><i>Leased assets</i></li>
            <li><i>Assets financed by capital grants</i></li>
        </ul>
    <p><b>SPECIFIC AREA 1 – LEASED ASSETS </b></p>
    <p><i>IFRS 16 ‘Leases’ is a brand-new Standard and is mandatory for accounting periods commencing on/after 1 January 2019. </i></p>
    <p><i>IFRS 16 fundamentally affects the way in which <u><b>lessees</b></u> account for leases; all leases (except those which are short term (i.e. 12 months or less) or those for which the underlying asset is of low value) now result in the recognition of a “right of use” asset and a corresponding lease liability. </i></p>
    <p><i>There are a couple of specific areas where lessors are affected by IFRS 16; sale and leaseback transactions and where the lessor is an intermediate lessor. </i></p>
    <p><i>First time adoption of IFRS 16 requires transition adjustments. The entity has a choice over the transition method adopted:</i></p>
    <ul>
        <li>full retrospective restatement (i.e. restate comparatives in line with the IFRS 16 requirements), subject to some practical expedients; or</li>
        <li>a “cumulative catch up”, where opening retained earnings are adjusted to account for the IFRS 16 impact, but the comparatives are unaffected.</li>
    </ul>
    <p><i>Audit work will be required on the transition adjustments made. </i></p>
    <p><i>Auditors must read IFRS 16, the accompanying application guidance (Appendix B of IFRS 16) and the transition requirements (Appendix C of IFRS 16) to gain a full understanding of the accounting requirements. </i></p>
    ';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 6%;"></th>
            <th style="width: 60%;"><b>Audit Test</b></th>
            <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
            <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
            <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
        </tr>
    </thead>
    <tbody>';
    $count = 0;
    foreach($qdata as $r){
        $count ++;
        $html .= '
        <tr>
            <td style="width: 6%;">'.$count.'.<br></td>
            <td style="width: 60%;">'.$r['question'].'<br></td>
            <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
            <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
            <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
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