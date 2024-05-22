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
    <table>
        <tr>
            <td style="width: 60%;">
                <table>
                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                    <tr><td></td></tr>
                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                </table>
            </td>
        </tr>
    </table>
';
$html .= '
    <h3>CRITICAL REVIEW OF THE FINANCIAL STATEMENTS</h3>
';
$html .= '
    <table>
        <thead>
            <tr>
                <th style="width: 6%;"></th>
                <th style="width: 60%;"><b></b></th>
                <th class="cent bo" style="width: 18%;"><b>Yes / No / N/A</b></th>
                <th class="cent bo" style="width: 18%;"><b>WP Ref. / Comment</b></th>

            </tr>
        </thead>
        <tbody>';
        $count = 0;
        foreach($ab1 as $r){
            $count ++;
            $html .= '
            <tr>
                <td style="width: 6%;">'.$count.'.<br></td>
                <td style="width: 60%;">'.$r['question'].'<br></td>
                <td class="cent bo" style="width: 18%;">'.$r['yesno'].'</td>
                <td class="cent bo" style="width: 18%;">'.$r['comment'].'</td>
            </tr>
        ';
    }
$html .= '
        </tbody>
    </table>
    <p>The tests above were undertaken on draft financial statements sent to the client.</p>
    <table>
        <tr>
            <td style="width: 50%;">Signed:___________ </td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
    </table>
    <p>The tests above were undertaken on final financial statements sent to the client.  The financial statements are correctly prepared, and other information included within the Annual Report is consistent with the financial statements.</p>
    <table>
        <tr>
            <td style="width: 50%;">Signed:___________ (Manager)</td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
    </table>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();