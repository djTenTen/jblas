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
    <p><b>SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT\'S FINANCIAL STATEMENTS</b></p>
    <p><b>Objective:</b> <br> To carry out a review of the financial statements such that the results obtained, together with the conclusions drawn from other audit tests, give a basis for the opinion on the financial statements.</p>
    <p><b>Recording:</b> <br> Review key ratios of most significance to the entity. Any large or unexpected movements in these ratios should be explained. This section should also contain details of significant or unexpected changes in major Statement of Financial Position and Performance Statement items.</p>
    <p><b>Comparisons should be made of current period figures with prior period and / or budgeted figures.  Explanations obtained for significant or unexpected changes in key business ratios and items in the financial statements must be corroborated by other evidence. A conclusion should then be reached. </b></p>
    <p><b><i>Undertaking analytical procedures at finalisation is mandatory; however, the use of this form is optional.</i></b></p>
';
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th style="width: 10%;"></th>
                <th style="width: 40%;"></th>
                <th colspan="4" style="width: 40%;"><b>Potential Effect on the Financial Statements</b></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th colspan="2" style="width: 20%;"><b>Performance Statements</b></th>
                <th colspan="2" style="width: 20%;"><b>S\'ment of Fin. Position</b></th>
        
            </tr>
            <tr>
                <th style="width: 10%;"><b>WP Ref.</b></th>
                <th style="width: 40%;"><b>Account and Description of Adjustment</b></th>
                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                <th style="width: 10%;" class="cent"><b>Cr</b></th>
            </tr>
            <tr>
                <th colspan="6"><b>ADJUSTMENTS MADE BY AUDITORS</b></th>
            </tr>
        </thead>
        <tbody>';
            $drps = 0;
            $crps = 0;
            $drfp = 0;
            $crfp = 0; 
            foreach($ad as $r){
                $drps += $r['drps'];
                $crps += $r['crps'];
                $drfp += $r['drfp'];
                $crfp += $r['crfp'];

                $html .= '
                <tr>
                    <td style="width: 10%;">'.$r['reference'].'</td>
                    <td style="width: 40%;">'.$r['initials'].'</td>
                    <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                    <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                    <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                    <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                </tr>
            ';
    }
$html .= '
        <tr>
            <td colspan="6" style="width: 50%;"><b>Total Effect of Unadjusted Errors</b></td>
            <td style="width: 10%;" class="cent">'.$drps.'</td>
            <td style="width: 10%;" class="cent">'.$crps.'</td>
            <td style="width: 10%;" class="cent">'.$drfp.'</td>
            <td style="width: 10%;" class="cent">'.$crfp.'</td>
        </tr>
';
$html .= '
        </tbody>
    </table>
    <br><br>
    ';
$html .= '
    <table>
        <tbody>
            <tr>
                <td style="width: 65%;"><b>Profit (Loss) for the Period per Draft Financial Statements</b></td>
                <td style="width: 5%;"><b>CU</b></td>
                <td style="width: 20%;" class="bo">'.$ue['pl'].'</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td style="width: 65%;"><b>Net Adjustments Made by Auditors to Client\'s Draft Figures</b></td>
                <td style="width: 5%;"><b>CU</b></td>
                <td style="width: 20%;" class="bo">'.$ue['na'].'</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td style="width: 65%;"><b>Profit (Loss)  for the Period per Final Financial Statements</b></td>
                <td style="width: 5%;"><b>CU</b></td>
                <td style="width: 20%;" class="bo">'.$ue['pl2'].'</td>
            </tr>
        </tbody>
    </table>
    <p>No adjustments have been made to the client\'s draft financial statements.*</p>
    <p>The above adjustments have been identified, the directors ("informed management") have confirmed verbally that they wish to adjust them and this will be confirmed in the letter of representation.*</p>
    <table>
        <tr>
            <td style="width: 50%;">Signed:___________ (A.E.P.)</td>
            <td style="width: 50%;">Dated:_____________</td>
        </tr>
    </table>
    <p>* Delete as appropriate</p>
    ';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();