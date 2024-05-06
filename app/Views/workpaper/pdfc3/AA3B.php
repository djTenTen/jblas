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
$pdf->AddPage('L');
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
$html .= '<h3>GOING CONCERN CHECKLIST</h3>
    <p><b>Objective: </b> <br>
    To ensure that the fundamental concept of going concern is fully considered and that the requirements of ISA 570 are met.</p>
    <p class="bo"><b>Overview:  Under the going concern assumption, an entity is viewed as continuing in business for the foreseeable future.  Financial statements are prepared on a going concern basis, unless management either intends to liquidate the entity or to cease to operate, or has no realistic alternative to do so (in these circumstances the financial statements are prepared on a break-up basis).</b></p>';
$html .= '
    <br><br><br>
    <table>
        <thead>
            <tr>
                <th style="width: 6%;"></th>
                <th style="width: 65%;"><b>Part 1 – Discussion with the Client Regarding Going Concern:</b></th>
                <th class="cent" style="width: 29%;"><b></b></th>
            </tr>
        </thead>
        <tbody>';
        $count = 0;
        foreach($bp1 as $r){
            $count ++;
            $html .= '
            <tr>
                <td style="width: 6%;">'.$count.'.<br></td>
                <td style="width: 65%;">'.$r['question'].'</td>
                <td class="cent bo" style="width: 29%;">'.$r['reference'].'</td>
            </tr>
            ';
        }
$html .= '
    </tbody>
</table>
';
$html .= '
    <br><br>
    <table>
        <thead>
            <tr>
                <th style="width: 6%;"></th>
                <th style="width: 65%;"><b>Part 2 – The Auditor’s Assessment ~ General Considerations:</b></th>
                <th class="cent bo" style="width: 29%;"><b>Comments / Ref</b></th>
            </tr>
        </thead>
        <tbody>';
        $count = 0;
        foreach($bp2 as $r){
            $count ++;
            $html .= '
            <tr>
                <td style="width: 6%;">'.$count.'.<br></td>
                <td style="width: 65%;">'.$r['question'].'</td>
                <td class="cent bo" style="width: 29%;">'.$r['reference'].'</td>
            </tr>
        ';
    }
$html .= '
        </tbody>
    </table>
';
$html .= '
    <br><br>
    <p><b>Part 3a – The Auditor’s Assessment ~ Specific Concerns: <br><i>Completion of this section is optional unless potential issues regarding the going concern presumption have been identified in Parts 1 or 2 above. </i></b></p>
    <table>
        <thead>
            <tr>
                <th style="width: 6%;"></th>
                <th style="width: 65%;"><b></b></th>
                <th class="cent bo" style="width: 29%;"><b>Comments / Ref</b></th>
            </tr>
        </thead>
        <tbody>';
        $count = 0;
        foreach($bp3a as $r){
            $count ++;
            $html .= '
            <tr>
                <td style="width: 6%;">'.$count.'.<br></td>
                <td style="width: 65%;">'.$r['question'].'</td>
                <td class="cent bo" style="width: 29%;">'.$r['reference'].'</td>
            </tr>
        ';
    }
$html .= '
        </tbody>
    </table>
';
$html .= '
    <br><br>
    <p><b>Part 3b – The Auditor’s Assessment ~ Disclosure considerations:</b></p>
    <table>
        <thead>
            <tr>
                <th style="width: 6%;"></th>
                <th style="width: 65%;"><b></b></th>
                <th class="cent bo" style="width: 29%;"><b>Comments / Ref</b></th>
            </tr>
        </thead>
        <tbody>';
        $count = 0;
        foreach($bp3b as $r){
            $count ++;
            $html .= '
            <tr>
                <td style="width: 6%;">'.$count.'.<br></td>
                <td style="width: 65%;">'.$r['question'].'</td>
                <td class="cent bo" style="width: 29%;">'.$r['reference'].'</td>
            </tr>
        ';
    }
$html .= '
        </tbody>
    </table>
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
    <p><b>Part 4 – Conclusion:</b></p>
    <p>Where potential problems with the going concern presumption have been identified, summarise the issue and resolution:</p>
    <table border="1">
        <thead>
            <tr>
                <th class="cent"><b>Going Concern Problem</b></th>
                <th class="cent"><b>Audit Evidence Gained / Schedule Reference</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <br><br><br>
                    '.$bp4['p41'].'
                    <br><br><br>
                </td>
                <td>
                    <br><br><br>
                    '.$bp4['p42'].'
                    <br><br><br>
                </td>
            </tr>
        </tbody>
    </table>
    <p>On the basis of the work recorded above, I consider that:</p>
    <ul>
        <li>The financial statements have been correctly prepared on the break-up basis.*</li>
        <li>The going concern concept is* / is not* correctly applied to this client.</li>
        <li>There is no concern* / concern* / significant concern* regarding the going concern concept for this client.</li>
        <li>The notes to the financial statements require* / do not require* additional information regarding the going concern concept.</li>
        <li>The audit report should be unmodified* / unmodified with a “Material uncertainty related to going concern” paragraph* / qualified with respect to going concern.*</li>
        <li><i>(If qualification or ”Material uncertainty” paragraph) Consideration has been given as to whether a report to a regulatory authority is required.(* Delete as applicable)</i></li>
    </ul>
    <table>
        <tr>
            <td style="width: 50%;">Signed:___________[A.E.P.]</td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
    </table>
    <p><i>There is more guidance on the impact on the financial statements and audit report of going concern issues in Chapter 3, paragraph 5.4 of the Manual, as well as in ISA 570.</i></p>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();