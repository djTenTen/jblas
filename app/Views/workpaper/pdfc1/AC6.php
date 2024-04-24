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


$html .= '<h3>RISK SUMMARY</h3>';
$html .= '<p><b>This form should be completed when a narrative approach to inherent business risk assessment is undertaken. </b> If more than one risk level applies, add additional lines as appropriate.</p>';

$html .= '
    <table>
    <thead >
        <tr>
            <th></th>
            <th  colspan="2" class="cent">Risk Assessment</th>
            <th class="cent">Reference</th>

        </tr>
        <tr>
            <th class="cent" style="width: 50%;">Question</th>
            <th class="cent" style="width: 16%;">Planning</th>
            <th class="cent" style="width: 16%;">Finalization</th>
            <th style="width: 16%;"></th>
        </tr>
    </thead>
    <tbody>
';
    $trig = 0;
    foreach($ac6 as $r){
        $html .= '
        <tr>
            <td style="width: 50%;">'.$r['question'].'</td>
            <td class="bo" style="width: 16%;">'.$r['planning'].'</td>
            <td class="bo" style="width: 16%;">'.$r['finalization'].'</td>
            <td class="bo" style="width: 16%;">'.$r['reference'].'</td>
        </tr>
        ';

        if($r['question'] == 'Control environment'){
            $html .= '
            <tr>
                <td colspan="3"><b>Inherent risk assessment of specific areas</b></td>
            </tr>
            ';
        }elseif($r['question'] == 'Payroll' and $trig == 0){
            $html .= '
            <tr>
                <td colspan="3"><b>Control risk assessment of specific areas</b></td>
            </tr>
            ';
            $trig = 1;
        }
    }
$html .= '
        </tbody>
    </table>';
$pdf->writeHTML($html, true, false,'J', false, '');

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
<h3>NARRATIVE RISK ASSESSMENTINHERENT BUSINESS RISK AND CONTROL ENVIRONMENT ASSESSMENT</h3>
<p>The risk forms should not be completed until –</p>
<ul>
    <li>Appropriate enquiries have been made of management;</li>
    <li>Points forward from last year have been considered;</li>
    <li>The permanent audit file has been reviewed; and</li>
    <li>Preliminary analytical procedures have been carried out.</li>
</ul>
<p>Notes on completion of this document –</p>
<ul>
    <li>Where significant risks have been identified, the entity \'s controls relevant to those risks should be understood;</li>
    <li>Items marked * should be appropriately tailored.</li>
</ul>
<p>It should be ensured that appropriate consideration should be given to –</p>
<ul>
    <li>Events and conditions that cast significant doubt on the entity’s ability to continue as a Going Concern;</li>
    <li>The client’s use of Service Organisations and Experts;</li>
    <li>The impact of litigation, claims and areas of non-compliance with law and regulations on the financial statements;</li>
    <li>The extent to which transactions with related parties are incorporated into the financial statements;</li>
    <li>The extent to which there are material figures in the financial statements which are derived from Accounting Estimates.</li>
</ul>
';
$pdf->writeHTML($html, true, false,'J', false, '');

$pdf->AddPage('L');

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
<p><b>Objective:</b> This form is designed to determine the inherent risk of the business as a whole.  PSA 315 implies that all businesses should be high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
<h3>Section 1 – INHERENT BUSINESS RISK</h3>
<table border="1">
    <tbody>
        <tr>
            <td><p>The inherent business risk of the client is deemed to be low / medium / high* for the following reasons:</p>
                <br>
                <br>
                <br>
                <br>
                <p>'.$s['s1'].'</p>
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
<p>Comprehensive consideration should be given to all clients even those deemed to be low risk. As part of this review consideration must be given to the Company’s going concern status and I.T. risk.</p>
';
$pdf->writeHTML($html, true, false,'J', false, '');

$pdf->AddPage('L');

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
$html .= '<p><b>Objective:</b> This form is designed to assess the adequacy of the entity’s control environment as a whole to determine whether a control based audit approach is appropriate. Section 3 looks at internal controls specific to the audit. To comply with PSA 315, both sections must be completed regardless of whether you intend to test, and if successful, place reliance on the entity’s controls.</p>
<p>In addition, this form should document the considerations of the risks related to management override of controls.</p>
<h3>Section 2a – CONSIDERATION OF THE RISK OF MANAGEMENT OVERRIDE OF CONTROLS </h3>
<table border="1">
    <tbody>
        <tr>
            <td><p>The risk of management override is present in <b>ALL</b> entities. However, the level of that risk will vary from entity to entity. Where management can override key controls, document here the considerations relating to the level of risk posed by management override and the audit procedures planned to address this risk:</p>
                <br>
                <br>
                <br>
                <br>
                <p>'.$s['s2a'].'</p>
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
<h3>Section 2b – CONSIDERATION OF THE CONTROL ENVIRONMENT </h3>
<table border="1">
    <tbody>
        <tr>
            <td><p>The control environment of the client deemed to be effective / ineffective* for the following reasons: </p>
                <br>
                <br>
                <br>
                <br>
                <p>'.$s['s2b'].'</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p>Based on the above assessment control testing is / is not * going to be undertaken </p>
            </td>
        </tr>
    </tbody>
</table>
';
$pdf->writeHTML($html, true, false,'J', false, '');

$pdf->AddPage('L');

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
    <h3>Section 3 - UNDERSTANDING THE DESIGN AND IMPLEMENTATION OF INTERNAL CONTROLS</h3>
    <p><b>Objective:</b><br>The auditor is required to “obtain an understanding of internal control relevant to the audit. Although most controls relevant to the audit are likely to relate to financial reporting, not all controls that relate to financial reporting are relevant to the audit.” (paragraph 12 of PSA 315).</p>
    <p>The auditor is required to evaluate the design of these controls and determine whether they have been appropriately implemented.  Per paragraph A74 of PSA 315:</p>
    <ul>
        <li><b><u>Evaluating</u></b> the design of a control involves “considering whether the control, individually or in combination with other controls, is capable of effectively preventing, or detecting and correcting, material misstatements;</li>
        <li><b><u>Implementation</u></b> of a control means that the control exists, and the entity is using it”.</li>
    </ul>
    <p><b>Requirement:</b><br>Summarise below the internal controls that are <b><u>relevant to the audit</u></b> and evaluate whether those controls are effective. If the controls are considered effective, test that the controls are being used by the entity.   </p>
    <p>As per paragraph A75 of PSA 315, the following procedures may be carried out to obtain evidence about the design and implementation of controls: </p>
    <ul>
        <li>Inquiry of entity personnel;</li>
        <li>Observing the application of specific controls;</li>
        <li>Inspecting documents and reports;</li>
        <li>Tracing transactions through the information system relevant to financial reporting.</li>
    </ul>
    <p>NB: this requirement exists irrespective of whether the overall control environment has been deemed to be ineffective in section 2b above. </p>
';

$pdf->writeHTML($html, true, false,'J', false, '');

$pdf->AddPage('L');

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
                <th><b>Financial Statement Area</b></th>
                <th><b>Description of the control </b></th>
                <th><b>Is the control effective?</b></th>
                <th><b>Has the control been implemented effectively?</b></th>
                <th><b>How has this been assessed?</b></th>
                <th><b>Cross reference to testing </b></th>
                <th><b>Reliance to be placed on control? (*)</b></th>
            </tr>
        </thead>
        <tbody id="tbody1" class="tbody">
            <tr>
                <td>e.g. <br> Trade Debtors</td>
                <td>e.g.<br> All new customers are subject to credit checks and credit limits restricted to £50k.</td>
                <td>e.g.<br> Yes</td>
                <td>e.g.<br> Yes</td>
                <td>e.g.<br> The risk of bad debts has been reduced. Inquired with the sales ledger team about the process and seen evidence of this by performing a walkthrough of a new customer set up.</td>
                <td>e.g.<br> T4</td>
                <td>e.g.<br> No</td>
            </tr>
            <tr>
                <td>e.g.<br>Creditors and Stock</td>
                <td>e.g.<br>All goods received are matched to purchase orders before being booked into stock.</td>
                <td>e.g.<br>Yes</td>
                <td>e.g.<br>No</td>
                <td>e.g.<br>Despite this being noted as a control in the client’s systems notes, the warehouse team often do not evidence that the check has taken place. </td>
                <td>e.g.<br>T6</td>
                <td>e.g.<br>No</td>
            </tr>';
             foreach($s3 as $r1){
                $html .= '
                <tr>
                    <td>'.$r1['finstate'].'</td>
                    <td>'.$r1['desc'].'</td>
                    <td>'.$r1['controleffect'].'</td>
                    <td>'.$r1['implemented'].'</td>
                    <td>'.$r1['assessed'].'</td>
                    <td>'.$r1['reference'].'</td>
                    <td>'.$r1['reliance'].'</td>
                </tr>
                ';
            }
$html .='
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,'J', false, '');

$pdf->AddPage('L');

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
<p><b>Notes Regarding Assessment of Controls:	</b></p>
<ol>
    <li>The audit approach section of the assignment plan should include details of how the risk and control environment assessment have influenced the design of the audit programmes and have identified key items and key audit issues. <br></li>
    <li>Where it is unlikely that sufficient, appropriate audit evidence can be obtained solely from substantive procedures, it is necessary to obtain an understanding of the controls over risks which may arise.  In such circumstances, it is necessary for controls testing to be performed (for example, a company which sells goods and services over the internet, where the process is highly automated, and relies on little or no human input).  In such cases, the entity\'s controls over such risks are relevant to the audit.  (PSA 315.30, PSA 315.A140-142). <br></li>
    <li>Where significant risks have been identified, the entity\'s controls relevant to those risks should be understood. <br></li>
    <li>Paragraph 31 of PSA 240 states "Management is in a unique position to perpetrate fraud because of management’s ability to manipulate accounting records and prepare fraudulent financial statements by overriding controls that otherwise appear to be operating effectively. Although the level of risk of management override of controls will vary from entity to entity, the risk is nevertheless present in all entities. Due to the unpredictable way in which such override could occur, it is a risk of material misstatement due to fraud and thus a significant risk". <br></li>
</ol>
';




























//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();