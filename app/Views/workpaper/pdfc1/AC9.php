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
$pdf->SetMargins(25,15,15);  
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
$html .= '
<table border="1">
    <tbody>
        <tr>
            <td><b><p>CONSIDERATION OF SPECIFIC SKILLS REQUIRED FOR THIS ASSIGNMENT</p>
                <p>(SHOULD COVER ALL MEMBERS OF THE TEAM OTHER THAN JUNIORS, INCLUDING THE EQR)</p></b>
                <br>
                <br>
                <br>
                <br>
                <p>'.$ac9['coss'].'</p>
                <br>
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </tbody>
</table>
<h3>APPROVAL OF PLANNING</h3>
<p>The following have all been reviewed prior to the team discussions being held and the detailed audit fieldwork commencing, and this has been documented by myself as A.E.P.:</p>
<ul>
    <li>Acceptance or Continuance;</li>
    <li>Consideration of Non-Audit Services (where applicable);</li>
    <li>Assessment of Overall Inherent Risk and the Control Environment;</li>
    <li>Assessment of Risk in Individual Audit Areas; and</li>
    <li>Determination of Materiality and Performance Materiality levels.</li>
</ul>
<p>Additionally, audit programmes of the working papers file have been reviewed, and I am satisfied that tailoring of these audit programmes is appropriate for the purpose of this audit.</p>
<table>
    <tr>
        <td>Planning approved by:</td>
        <td>(A.E.P.) on </td>
    </tr>
</table>
<h3>APPROVAL OF PLANNING BY INTERNAL EQR (IF APPLICABLE)</h3>
<p>I have reviewed, and this has been documented by myself as E.Q.R., the Acceptance or Continuance Form.  I have also reviewed the remaining documents set out in the bullet points above, along with this Assignment Plan, and additionally, the following:</p>
<ul>
    <li>'.$ac9['aop1'].'</li>
    <li>'.$ac9['aop2'].'</li>
</ul>
<p>I am satisfied that the proposed audit approach is appropriate for the purpose of this audit.</p>
<table>
    <tr>
        <td>Planning approved by:</td>
        <td>(A.E.P.) on </td>
    </tr>
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
<table border="1">
    <tbody>
        <tr>
            <td><p><b>BACKGROUND INFORMATION</b></p>
                <p>Detailed background information is included in the permanent file, the below information is just a short executive summary.</p>
                <p>The entity is a company [other: insert details].</p>
                <p>The principal activities of the entity are ['.$ac9['bipa'].'].  </p>
                <p>The business objectives and strategies of the entity are ['.$ac9['bibo'].'].</p>
                <br>
                <br>
                <br>
                <br>
                <br>
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
            <td><p><b>SIGNIFICANT FACTORS FROM PREVIOUS AUDIT AND IMPACT ON THIS PERIOD’S AUDIT</b></p>
                <ul>
                    <li>Last period’s financial statements have been compared to this period’s, as part of the preliminary analytical procedures;</li>
                    <li>If applicable, the findings of recent cold file reviews have been addressed by the planning documentation; and</li>
                    <li>If applicable, last period’s management letter points have been reviewed and any points have been considered during this period’s risk assessment and audit approach.</li>
                </ul>
                <br>
                <br>
                <br>
                '.$ac9['sffpa'].'
                <br>
                <br>
                <br>
                <br>
                <br>
                
            </td>
        </tr>
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
<table border="1">
    <tbody>
        <tr>
            <td><p><b>SUMMARY OF SIGNIFICANT DEVELOPMENTS DURING THE PERIOD (consideration should be given to any changes in the financial reporting framework used, as well as client specific developments.  The findings from the review of the previous audit file, PAF and other internal files such as the correspondence file, management accounts files, payroll files etc. should all be summarised)</b></p>
                <p><i>This should not repeat information included elsewhere.</i></p>
                <br>
                <br>
                <br>
                '.$ac9['sosdd'].'
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td><p><b>KEY LAW AND REGULATIONS</b></p>
                <p><i>This should be an “Executive Summary”</i></p>
                <br>
                <br>
                <br>
                '.$ac9['klar'].'
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td><p><b>RELATED PARTY ISSUES (Consideration should be given to any new related parties which have been identified, significant related party transactions and transfer pricing issues)</b></p>
                <p><i>This should be an “Executive Summary”</i></p>
                <br>
                <br>
                <br>
                '.$ac9['rpi'].'
                <br>
                <br>
                <br>
                <br>
               
            </td>
        </tr>
        <tr>
            <td><p><b>SERVICE ORGANISATION AND EXPERTS (Consideration should be given to whether any of the figures in the financial statements are derived from the records of a service organisation or from an expert (such as a valuation service).  Where this is a case, document the audit team’s approach to these areas)</b></p>
                <br>
                <br>
                <br>
                '.$ac9['soae'].'
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
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
<table border="1">
    <tbody>
        <tr>
            <td><p><b>AUDIT APPROACH</b></p>
                <p>This section should fully document the approach to be undertaken based on preliminary analytical procedures, client discussions and the risk and control environment assessments.  </p>
                <p>Adequate consideration has been given to experts and service organisations.</p>
                <p>The audit programmes to be used and key points arising during the planning are summarised below, as are the responsibilities of each team member regarding which work they are going to undertake.</p>
                <br>
                <br>
                <br>
                '.$ac9['aa1'].'
                <br>
                <br>
                <br>
                <br>
                <p>Have the points raised above (and the risks identified in the risk assessment) been duly considered and the audit programmes sufficiently tailored to reflect these issues?</p>
                <br>
                <br>
                <br>
                <br>
                '.$ac9['aa2'].'
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
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
<table border="1">
    <thead>
        <tr>
            <th style="width: 80%;"><b>IS THE FINANCIAL REPORTING FRAMEWORK APPROPRIATE FOR THE ENTITY, BASED ON IT’S CIRCUMSTANCES</b></th>
            <th class="cent" style="width: 20%;"><b>YES / NO</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="1" style="width: 100%;">
                <p>If “no”, or the entity has changed its financial reporting framework, explain why the entity will be preparing financial statements on the basis indicated above:</p>
                <br><br><br>
                '.$ac9['frfa'].'
                <br><br><br>
            </td>
        </tr>
    </tbody>
</table>
<table border="1">
    <thead>
        <tr>
            <th style="width: 80%;"><b>ARE THERE ANY OTHER REPORTING REQUIREMENTS (SUCH AS TO A PARENT AUDITOR OR REGULATOR)</b></th>
            <th class="cent" style="width: 20%;"><b>YES / NO</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="1" style="width: 100%;">
                <p>If “yes”, explain what these are, and the impact this will have on the scope / timing of audit work on the statutory financial statements:</p>
                <br><br><br>
                '.$ac9['orr'].'
                <br><br><br>
            </td>
        </tr>
    </tbody>
</table>
<br><br>
<table border="1">
    <thead>
        <tr>
            <th><b>TAX SCHEDULES REQUIRED (THESE SHOULD ONLY BE PREPARED WHERE IT HAS BEEN AGREED THAT A NON-AUDIT SERVICE IS BEING PROVIDED)</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <br><br><br>
                '.$ac9['tsr'].'
                <br><br><br>
            </td>
        </tr>
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
<table border="1">
    <thead>
        <tr>
            <th style="width: 70%;"><b>ASSIGNMENT TIMETABLE</b></th>
            <th class="cent" style="width: 30%;"><b>DATES</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 70%;">Client Pre-Planning Meeting</td>
            <td class="cent" style="width: 30%;">'.date('F d, Y', strtotime($ac9['cppm'])).'</td>
        </tr>
        <tr>
            <td style="width: 70%;">Inventory Count (irrespective of whether undertaken by client or 3rd party professional)</td>
            <td class="cent" style="width: 30%;">'.date('F d, Y', strtotime($ac9['ic'])).'</td>
        </tr>
        <tr>
            <td style="width: 70%;">Audit Fieldwork</td>
            <td class="cent" style="width: 30%;">'.date('F d, Y', strtotime($ac9['af'])).'</td>
        </tr>
        <tr>
            <td style="width: 70%;">Client Closing Meeting</td>
            <td class="cent" style="width: 30%;">'.date('F d, Y', strtotime($ac9['ccm'])).'</td>
        </tr>
        <tr>
            <td style="width: 70%;">Annual General Meeting / Date of Distribution of Financial Statements to Members</td>
            <td class="cent" style="width: 30%;">'.date('F d, Y', strtotime($ac9['agm'])).'</td>
        </tr>
    </tbody>
</table>
<br><br>
<table border="1">
    <thead>
        <tr>
            <th style="width: 60%;"><b>THIRD PARTY AND COUNTER PARTY CONFIRMATIONS</b></th>
            <th class="cent" style="width: 20%;"><b>REQUIRED</b></th>
            <th class="cent" style="width: 20%;"><b>DATE REQUESTED</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 60%;">Bank Confirmation Letter</td>
            <td class="cent" style="width: 20%;">'.$ac9['bcl1'].'</td>
            <td class="cent" style="width: 20%;">'.date('F d, Y', strtotime($ac9['bcl2'])).'</td>
        </tr>
        <tr>
            <td style="width: 60%;">Independent Inventory Counter’s Report</td>
            <td class="cent" style="width: 20%;">'.$ac9['iic1'].'</td>
            <td class="cent" style="width: 20%;">'.date('F d, Y', strtotime($ac9['iic2'])).'</td>
        </tr>
        <tr>
            <td style="width: 60%;">Receivables’ Circularisation</td>
            <td class="cent" style="width: 20%;">'.$ac9['rc1'].'</td>
            <td class="cent" style="width: 20%;">'.date('F d, Y', strtotime($ac9['rc2'])).'</td>
        </tr>
        <tr>
            <td style="width: 60%;">Type 2 Report</td>
            <td class="cent" style="width: 20%;">'.$ac9['t2r1'].'</td>
            <td class="cent" style="width: 20%;">'.date('F d, Y', strtotime($ac9['t2r2'])).'</td>
        </tr>
        <tr>
            <td style="width: 60%;">Property Valuations</td>
            <td class="cent" style="width: 20%;">'.$ac9['pv1'].'</td>
            <td class="cent" style="width: 20%;">'.date('F d, Y', strtotime($ac9['pv2'])).'</td>
        </tr>
        <tr>
            <td style="width: 60%;">Valuations of Financial Instruments</td>
            <td class="cent" style="width: 20%;">'.$ac9['vfi1'].'</td>
            <td class="cent" style="width: 20%;">'.date('F d, Y', strtotime($ac9['vfi2'])).'</td>
        </tr>
        <tr>
            <td style="width: 60%;">Actuarial Valuations</td>
            <td class="cent" style="width: 20%;">'.$ac9['av1'].'</td>
            <td class="cent" style="width: 20%;">'.date('F d, Y', strtotime($ac9['av2'])).'</td>
        </tr>
        <tr>
            <td style="width: 60%;">Legal Opinions</td>
            <td class="cent" style="width: 20%;">'.$ac9['lo1'].'</td>
            <td class="cent" style="width: 20%;">'.date('F d, Y', strtotime($ac9['lo2'])).'</td>
        </tr>
    </tbody>
</table>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();