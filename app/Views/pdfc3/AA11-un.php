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
<p><b>SUMMARY OF UNADJUSTED ERRORS</b></p>
<p>If, during the assignment, either the aggregate of accumulated misstatements approaches performance materiality, or the nature of identified misstatements indicate that other misstatements may exist which would lead to accumulated misstatements exceeding performance materiality, it shall be determined whether the overall audit strategy and audit plan need to be revised.</p>
<p><b>Objective:</b> <br>This summary of errors is to determine whether any errors, including disclosure errors, which have not yet been corrected (including uncorrected misstatements relating to prior periods), are individually or in total, sufficiently material to warrant correction in the financial statements and to ensure, if appropriate, that they are communicated to the client.  Where applicable, the effect of taxation should also be documented.</p>
<p><b>Scope:</b> <br>Either all errors should be recorded on this form or just those over a de minimis level which can be set by the A.E.P. (this should normally be less than or equal to the clearly trivial threshold).</p>
<table>
    <tbody>
        <tr>
            <td style="width: 60%;"><b>Clearly Trivial per Ac13</b></td>
            <td style="width: 5%;"><b>CU</b></td>
            <td style="width: 20%;" class="bo">'.$ue['cta'].'</td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td style="width: 60%;"><b>Final Performance Materiality per Ac13</b></td>
            <td style="width: 5%;"><b>CU</b></td>
            <td style="width: 20%;" class="bo">'.$ue['fpm'].'</td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td style="width: 60%;"><b>Final Materiality per Ac13</b></td>
            <td style="width: 5%;"><b>CU</b></td>
            <td style="width: 20%;" class="bo">'.$ue['fma'].'</td>
        </tr>
    </tbody>
</table>
<br><br> ';
$html .= '
<table border="1">
    <thead>
        <tr>
            <th style="width: 10%;"></th>
            <th style="width: 40%;"></th>
            <th colspan="4" style="width: 40%;"><b>Potential Effect on the Financial Statements</b></th>
            <th style="width: 10%;"></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th colspan="2" style="width: 20%;"><b>Performance Statements</b></th>
            <th colspan="2" style="width: 20%;"><b>S\'ment of Fin. Position</b></th>
            <th style="width: 10%;"><b>Adjust?</b></th>
        </tr>
        <tr>
            <th style="width: 10%;"><b>WP Ref.</b></th>
            <th style="width: 40%;"><b>Account and Description of Error</b></th>
            <th style="width: 10%;" class="cent"><b>Dr</b></th>
            <th style="width: 10%;" class="cent"><b>Cr</b></th>
            <th style="width: 10%;" class="cent"><b>Dr</b></th>
            <th style="width: 10%;" class="cent"><b>Cr</b></th>
            <th style="width: 10%;" class="cent"><b>Yes/No</b></th>
        </tr>
        <tr>
            <th colspan="7"><b>ACTUAL ERRORS - FACTUAL</b></th>
        </tr>
    </thead>
    <tbody> ';
        $aef_drps = 0;
        $aef_crps = 0;
        $aef_drfp = 0;
        $aef_crfp = 0;
        foreach($aef as $r){
        $aef_drps += $r['drps'];
        $aef_crps += $r['crps'];
        $aef_drfp += $r['drfp'];
        $aef_crfp += $r['crfp'];
        $html .= '
            <tr>
                <td style="width: 10%;" class="cent">'.$r['reference'].'</td>
                <td style="width: 40%;">'.$r['initials'].'</td>
                <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                <td style="width: 10%;" class="cent">'.$r['yesno'].'</td>
            </tr>
        ';
        }
$html .= '
        <tr>
            <td colspan="6" style="width: 90%;"><b>ACTUAL ERRORS - JUDGMENTAL</b></td>
            <td style="width: 10%;"><b>Adjust?</b></td>
        </tr>
';
        $aej_drps = 0;
        $aej_crps = 0;
        $aej_drfp = 0;
        $aej_crfp = 0; 
        foreach($aej as $r){
        $aej_drps += $r['drps'];
        $aej_crps += $r['crps'];
        $aej_drfp += $r['drfp'];
        $aej_crfp += $r['crfp'];     
        $html .= '
            <tr>
                <td style="width: 10%;" class="cent">'.$r['reference'].'</td>
                <td style="width: 40%;">'.$r['initials'].'</td>
                <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                <td style="width: 10%;" class="cent">'.$r['yesno'].'</td>
            </tr>
        ';
        }
$html .= '
        <tr>
            <td colspan="6" style="width: 90%;"><b>EXTRAPOLATED ERRORS</b></td>
            <td style="width: 10%;"><b>Adjust?</b></td>
        </tr>
';
        $ee_drps = 0;
        $ee_crps = 0;
        $ee_drfp = 0;
        $ee_crfp = 0; 
        foreach($ee as $r){
        $ee_drps += $r['drps'];
        $ee_crps += $r['crps'];
        $ee_drfp += $r['drfp'];
        $ee_crfp += $r['crfp'];
        $html .= '
            <tr>
                <td style="width: 10%;" class="cent">'.$r['reference'].'</td>
                <td style="width: 40%;">'.$r['initials'].'</td>
                <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                <td style="width: 10%;" class="cent">'.$r['yesno'].'</td>
            </tr>
        ';
        }
$html .= '
        <tr>
            <td colspan="6" style="width: 90%;"><b>DISCLOSURE ERRORS</b></td>
            <td style="width: 10%;"><b>Adjust?</b></td>
        </tr>
';
        $de_drps = 0;
        $de_crps = 0;
        $de_drfp = 0;
        $de_crfp = 0; 
        foreach($de as $r){
        $de_drps += $r['drps'];
        $de_crps += $r['crps'];
        $de_drfp += $r['drfp'];
        $de_crfp += $r['crfp'];
        $html .= '
            <tr>
                <td style="width: 10%;" class="cent">'.$r['reference'].'</td>
                <td style="width: 40%;">'.$r['initials'].'</td>
                <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                <td style="width: 10%;" class="cent">'.$r['yesno'].'</td>
            </tr>
        ';
        }
$html .= '
        <tr>
            <td colspan="6" style="width: 50%;"><b>Total Effect of Unadjusted Errors</b></td>
            <td style="width: 10%;" class="cent">'.$aef_drps + $aej_drps + $ee_drps + $de_drps.'</td>
            <td style="width: 10%;" class="cent">'.$aef_crps + $aej_crps + $ee_crps + $de_crps.'</td>
            <td style="width: 10%;" class="cent">'.$aef_drfp + $aej_drfp + $ee_drfp + $de_drfp.'</td>
            <td style="width: 10%;" class="cent">'.$aef_crfp + $aej_crfp + $ee_crfp + $de_crfp.'</td>
        </tr>
';
$html .= '
</tbody>
</table>
';
$html .= '
<p><b>Conclusion (only include errors which remain uncorrected):</b></p>
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
            <th style="width: 40%;"><b>Details</b></th>
            <th style="width: 10%;" class="cent"><b>Dr</b></th>
            <th style="width: 10%;" class="cent"><b>Cr</b></th>
            <th style="width: 10%;" class="cent"><b>Dr</b></th>
            <th style="width: 10%;" class="cent"><b>Cr</b></th>
        </tr>
    </thead>
    <tbody>
        <tbody>
            <tr>
                <td style="width: 10%;">B DIV</td>
                <td style="width: 40%;">Intangibles and goodwill</td>
                <td style="width: 10%;">'.$con['bdr1'].'</td>
                <td style="width: 10%;">'.$con['bcr1'].'</td>
                <td style="width: 10%;">'.$con['bdr2'].'</td>
                <td style="width: 10%;">'.$con['bcr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">C DIV</td>
                <td style="width: 40%;">Property, plant and equipment</td>
                <td style="width: 10%;">'.$con['cdr1'].'</td>
                <td style="width: 10%;">'.$con['ccr1'].'</td>
                <td style="width: 10%;">'.$con['cdr2'].'</td>
                <td style="width: 10%;">'.$con['ccr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">D/G DIV</td>
                <td style="width: 40%;">Investments</td>
                <td style="width: 10%;">'.$con['ddr1'].'</td>
                <td style="width: 10%;">'.$con['dcr1'].'</td>
                <td style="width: 10%;">'.$con['ddr2'].'</td>
                <td style="width: 10%;">'.$con['dcr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">E DIV</td>
                <td style="width: 40%;">Inventories</td>
                <td style="width: 10%;">'.$con['edr1'].'</td>
                <td style="width: 10%;">'.$con['ecr1'].'</td>
                <td style="width: 10%;">'.$con['edr2'].'</td>
                <td style="width: 10%;">'.$con['ecr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">F DIV</td>
                <td style="width: 40%;">Receivables</td>
                <td style="width: 10%;">'.$con['fdr1'].'</td>
                <td style="width: 10%;">'.$con['fcr1'].'</td>
                <td style="width: 10%;">'.$con['fdr2'].'</td>
                <td style="width: 10%;">'.$con['fcr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">H DIV</td>
                <td style="width: 40%;">Cash at bank and in hand</td>
                <td style="width: 10%;">'.$con['hdr1'].'</td>
                <td style="width: 10%;">'.$con['hcr1'].'</td>
                <td style="width: 10%;">'.$con['hdr2'].'</td>
                <td style="width: 10%;">'.$con['hcr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">I DIV</td>
                <td style="width: 40%;">Payables</td>
                <td style="width: 10%;">'.$con['idr1'].'</td>
                <td style="width: 10%;">'.$con['icr1'].'</td>
                <td style="width: 10%;">'.$con['idr2'].'</td>
                <td style="width: 10%;">'.$con['icr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">J DIV</td>
                <td style="width: 40%;">Taxation</td>
                <td style="width: 10%;">'.$con['jdr1'].'</td>
                <td style="width: 10%;">'.$con['jcr1'].'</td>
                <td style="width: 10%;">'.$con['jdr2'].'</td>
                <td style="width: 10%;">'.$con['jcr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">L DIV</td>
                <td style="width: 40%;">Provisions</td>
                <td style="width: 10%;">'.$con['ldr1'].'</td>
                <td style="width: 10%;">'.$con['lcr1'].'</td>
                <td style="width: 10%;">'.$con['ldr2'].'</td>
                <td style="width: 10%;">'.$con['lcr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">M DIV</td>
                <td style="width: 40%;">Equity</td>
                <td style="width: 10%;">'.$con['mdr1'].'</td>
                <td style="width: 10%;">'.$con['mcr1'].'</td>
                <td style="width: 10%;">'.$con['mdr2'].'</td>
                <td style="width: 10%;">'.$con['mcr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">O DIV</td>
                <td style="width: 40%;">Revenue</td>
                <td style="width: 10%;">'.$con['odr1'].'</td>
                <td style="width: 10%;">'.$con['ocr1'].'</td>
                <td style="width: 10%;">'.$con['odr2'].'</td>
                <td style="width: 10%;">'.$con['ocr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">P DIV</td>
                <td style="width: 40%;">Direct costs</td>
                <td style="width: 10%;">'.$con['pdr1'].'</td>
                <td style="width: 10%;">'.$con['pcr1'].'</td>
                <td style="width: 10%;">'.$con['pdr2'].'</td>
                <td style="width: 10%;">'.$con['pcr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">Q DIV</td>
                <td style="width: 40%;">Other income and gains</td>
                <td style="width: 10%;">'.$con['qdr1'].'</td>
                <td style="width: 10%;">'.$con['qcr1'].'</td>
                <td style="width: 10%;">'.$con['qdr2'].'</td>
                <td style="width: 10%;">'.$con['qcr2'].'</td>
            </tr>
            <tr>
                <td style="width: 10%;">R DIV</td>
                <td style="width: 40%;">Other expenditure and losses</td>
                <td style="width: 10%;">'.$con['rdr1'].'</td>
                <td style="width: 10%;">'.$con['rcr1'].'</td>
                <td style="width: 10%;">'.$con['rdr2'].'</td>
                <td style="width: 10%;">'.$con['rcr2'].'</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Total Effect of Unadjusted Errors</td>
                <td>'.$con['bdr1'] + $con['cdr1'] + $con['ddr1'] + $con['edr1'] + $con['fdr1'] + $con['hdr1'] + $con['idr1'] + $con['jdr1'] + $con['ldr1'] + $con['mdr1'] + $con['odr1'] + $con['pdr1'] + $con['qdr1']  + $con['rdr1']  .'</td>
                <td>'.$con['bcr1'] + $con['ccr1'] + $con['dcr1'] + $con['ecr1'] + $con['fcr1'] + $con['hcr1'] + $con['icr1'] + $con['jcr1'] + $con['lcr1'] + $con['mcr1'] + $con['ocr1'] + $con['pcr1'] + $con['qcr1']  + $con['rcr1']  .'</td>
                <td>'.$con['bdr2'] + $con['cdr2'] + $con['ddr2'] + $con['edr2'] + $con['fdr2'] + $con['hdr2'] + $con['idr2'] + $con['jdr2'] + $con['ldr2'] + $con['mdr2'] + $con['odr2'] + $con['pdr2'] + $con['qdr2']  + $con['rdr2']  .'</td>
                <td>'.$con['bcr2'] + $con['ccr2'] + $con['dcr2'] + $con['ecr2'] + $con['fcr2'] + $con['hcr2'] + $con['icr2'] + $con['jcr2'] + $con['lcr2'] + $con['mcr2'] + $con['ocr2'] + $con['pcr2'] + $con['qcr2']  + $con['rcr2']  .'</td>
            </tr>
        </tfoot>
    </tbody>
</table>
';
$html .= '
<p>The errors in total are clearly trivial (as defined by the planning letter) and have not been communicated to the directors.*</p>
<p>The errors in total are not trivial and the directors have confirmed verbally that they do not want to adjust them and this will be confirmed in the letter of representation.*</p>
<p>I am satisfied that the combined effect of the above errors is below performance materiality for the financial statements as a whole**, and therefore does not warrant correction.*</p>
<p>The errors in total exceed performance materiality for the financial statements as a whole**, and given the risk of unidentified items, the financial statements are deemed to be materially incorrect, and the audit opinion will be modified (Aa1, page 7)</p>
<table>
    <tr>
        <td style="width: 50%;">Signed:___________ (A.E.P.)</td>
        <td style="width: 50%;">Dated:_____________</td>
    </tr>
</table>
<br><br>
<p>*  Delete as appropriate</p>
<p>** Does not turn a profit into a loss (or vice versa) or a net asset position into a net liability position (or vice versa), adjustments, misstatements for an individual area being greater than the performance materiality level, or is greater than any of the specific measures of performance materiality noted at Ac13 (for example, related party transactions, directors\' emoluments, etc.).  Also, where the client has artificially ‘cherry picked’ potential adjustments to achieve a particular presentation of its financial position, financial performance or cash flows (for example, all items that reduce profit have been corrected but all adjustments that increase it have not) then this would also be considered to be a material error in the financial statements.</p>
<p><b>Notes: </b><br>"Clearly trivial"  errors do not need to be accumulated.  These items are clearly inconsequential, whether taken individually or in aggregate, whether judged by size, nature or circumstances.  It is suggested that 1% of audit materiality is used to determine a level at which items are deemed to be clearly trivial, but a different percentage can be used if deemed to be more appropriate and is adequately justified.  </p>
<p>However, misstatements relating to amounts may not be clearly trivial when judged on criteria of nature or circumstance. If this is the case, the misstatements should be accumulated as unadjusted errors.</p>
<p>Misstatements in disclosures may also be clearly trivial whether taken individually or in aggregate, and whether judged by any criteria of size, nature or circumstances. Misstatements in disclosures that are not clearly trivial are also accumulated to assist the auditor in evaluating the effect of such misstatements on the relevant disclosures and the financial statements as a whole. Paragraph A13a of ISA 450 provides examples of where misstatements in qualitative disclosures may be material.</p>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();