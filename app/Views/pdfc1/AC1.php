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
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 20%" class="cent bo">'.$r['yesno'].'</td>
                <td style="width: 20%" class="cent bo">'.$r['comment'].'</td>
            </tr>
        ';
    }

$html .= '   
    </tbody>
</table>';


$html .= '
    <p>Name of A.P., not connected with this assignment, to whom staff may bring any grievances related to this engagement:<u>'. $eqr['nameap'] .'</u></p>
    <p><b>Those Charged With Governance and Management:</b></p>
    <p>PSA 260 / 265 requires different matters to be communicated separately to those charged with governance and to management.  Where those charged with governance and management are the same individuals (for example, all matters are dealt with solely by the directors of the company), it is not necessary for these matters to be communicated twice.</p>
    <p>[EITHER]</p>
    <p>The Directors are actively involved in the day-to-day operations of the entity and are therefore considered to be both management and those charged with governance. </p>
    <p>Name of Informed Management: ……………………………… </p>
    <p>The Directors are not actively involved in the day-to-day operations of the entity and are therefore considered to be those charged with governance. </p>
    <p>…………………………………………………………………………………………………………</p>
    <p>…………………………………………………………………………………………………………</p>
    <p>Informed management is a “Member of management (or senior employee) of the entity relevant to the engagement who has the authority and capability to make independent management judgments and decisions in relation to non-audit / additional services on the basis of information provided by the firm”</p>
    <p>Our primary contact (if different from Informed Management) for the audit will be: </p>
    <p>…………………………………………………………………………………………………………</p>
    <p>[OR]</p>
    <p>The Directors are not actively involved in the day-to-day operations of the entity and are therefore considered to be those charged with governance. </p>
    <p>Management of the entity has been delegated to ………………………………………….</p>
    <p>Our primary contact of those charged with governance will be……………………………………….</p>
    <p>Our primary contact within the management team will be……………………………………………</p>
    <p>Name of Informed Management: ……………………………… </p>
    <p>Justification of why they can be considered Informed Management:</p>
    <p>…………………………………………………………………………………………………………</p>
    <p>…………………………………………………………………………………………………………</p>
    <p>Communication of certain matters will be required with both those charged with governance AND management. The following documents will evidence this dual communication:</p>
    <ul>
        <li>Letter of engagement</li>
        <li>Preliminary planning procedures</li>
        <li>Planning letter</li>
        <li>Letter of representation</li>
        <li>Management letter</li>
    </ul>
    <p><b>ENGAGEMENT QUALITY REVIEW:</b></p>
    <p>An EQR needs to be undertaken on all audits where:</p>
    <ul>
        <li>The firm’s criteria for a review has been met;</li>
        <li>The A.E.P. deems it necessary for a review to be undertaken; or</li>
        <li>It is required as a safeguard against threats which have been identified to the firm’s objectivity and independence.  It should be considered on all assignments where non-audit services have been provided.</li>
    </ul>
    <p><i>Note that it is necessary for the EQR to be appointed.  The A.E.P. should avoid excessive consultation with the EQR during the assignment, as this may lead to the reviewer’s ability to perform an objective review being impaired.  Where excessive consultation has taken place, the EQR will need to be replaced.</i></p>
    <table>
        <tbody>
            <tr>
                <td style="width: 50%;"><p>*No EQR needs to be performed.</p> <br></td>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <td style="width: 50%;">*It is necessary for an EQR to be performed and this will be performed by <br></td>
                <td style="width: 50%;" class="cent">'.$eqr['eqr1'].'</td>
            </tr>
            <tr>
                <td style="width: 50%;">*Where the EQR is undertaken by an external reviewer the name of the organisation which they work for <br></td>
                <td style="width: 50%;" class="cent">'.$eqr['eqr2'].'</td>
            </tr>
        </tbody>
    </table>
    <table border="1">
        <tr>
            <td><p><b>REASON FOR EQR</b> (If an EQR review was performed in the previous period, but is not being performed in the current period, this decision must also be justified.)  </p>
                '.$eqr['eqrr'].'
            </td>
        </tr>
        <tr> 
            <td><p><b>SCOPE OF EQR</b> (PSA 220.20):</p>
                <ul>
                    <li>Discussion of significant matters with the A.E.P.;</li>
                    <li>Review of the financial statements and the proposed auditor’s report;</li>
                    <li>Review of selected audit documentation relating to the significant judgments the engagement team made and the conclusions it reached; and </li>
                    <li>Evaluation of the conclusions reached in formulating the auditor’s report and consideration of whether the proposed report is appropriate.</li>
                </ul>
            </td>
        </tr>
    </table>
    <p><b>Authority to accept appointment:</b></p>
    <p>Having completed the checklist I *do / *do not consider that there are any perceived threats to our independence, integrity and objectivity, and believe that we *can accept / *can accept with the stated safeguards / *cannot accept this appointment.</p>
    <p>Where necessary, adequate consultation has been undertaken and documented at_______________.</p>
    <table>
        <tbody>
            <tr>
                <td style="width: 50%;"><p>Signature: </p></td>
                <td style="width: 50%;">(A.E.P.)</td>
            </tr>
            <tr>
                <td style="width: 50%;"><p>Date:</p><br></td>
                <td style="width: 50%;" class="cent"></td>
            </tr>
            <tr>
                <td style="width: 50%;"><p><i>If appropriate:</i></p><br></td>
                <td style="width: 50%;" class="cent"></td>
            </tr>
            <tr>
                <td style="width: 50%;"><p>Signature: </p></td>
                <td style="width: 50%;">(EQR) </td>
            </tr>
            <tr>
                <td style="width: 50%;"><p>Date:</p></td>
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