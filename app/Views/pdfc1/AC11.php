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
                <tr><td class="bb">Client:</td></tr>
                <tr><td></td></tr>
                <tr><td class="bb">Period:</td></tr>
            </table>
        </td>
    </tr>
</table>
';
$space = $pdf->Ln(10);
$html .= '<h3>TEAM DISCUSSIONS AND BRIEFING MEETING</h3>';
$html .= '
    <p> <b>Objective:</b> <br>To document a team discussion covering fraud and risk as required by PSA 240, 315 and 550 and to demonstrate that an adequate staff briefing has occurred.</p>
    <table>
        <tr>
            <td style="width: 20%;">
                <b>Date of meeting:</b>
            </td>
            <td class="bo" style="width: 80%;">
                '.date('F d, Y', strtotime($ac11['datem'])).'
            </td>
        </tr>
    </table>
    <p><b>Details of the assignment team:</b></p>
    <table border="1">
        <thead>
            <tr>
                <th>Grade:</th>
                <th>Name:</th>
                <th>Initial to Confirm Attendance:</th>
                <th>Initial to Confirm Understanding of Planning:*</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><br>A.E.P.<br></td>
                <td><br>'.$ac11['ape1'].'<br></td>
                <td><br>'.$ac11['ape2'].'<br></td>
                <td><br>'.$ac11['ape3'].'<br></td>
            </tr>
            <tr>
                <td><br>Internal EQR<br></td>
                <td><br>'.$ac11['ieqr1'].'<br></td>
                <td><br>'.$ac11['ieqr2'].'<br></td>
                <td><br>'.$ac11['ieqr3'].'<br></td>
            </tr>
            <tr>
                <td><br>Manager<br></td>
                <td><br>'.$ac11['mngr1'].'<br></td>
                <td><br>'.$ac11['mngr2'].'<br></td>
                <td><br>'.$ac11['mngr3'].'<br></td>
            </tr>
            <tr>
                <td><br>Supervisor<br></td>
                <td><br>'.$ac11['sup1'].'<br></td>
                <td><br>'.$ac11['sup2'].'<br></td>
                <td><br>'.$ac11['sup3'].'<br></td>
            </tr>
            <tr>
                <td><br>Senior<br></td>
                <td><br>'.$ac11['sr1'].'<br></td>
                <td><br>'.$ac11['sr2'].'<br></td>
                <td><br>'.$ac11['sr3'].'<br></td>
            </tr>
            <tr>
                <td><br>Junior<br></td>
                <td><br>'.$ac11['jra1'].'<br></td>
                <td><br>'.$ac11['jra2'].'<br></td>
                <td><br>'.$ac11['jra3'].'<br></td>
            </tr>
            <tr>
                <td><br>Junior<br></td>
                <td><br>'.$ac11['jrb1'].'<br></td>
                <td><br>'.$ac11['jrb2'].'<br></td>
                <td><br>'.$ac11['jrb3'].'<br></td>
            </tr>
        </tbody>
    </table>
    <p><i>* Prior to initialling this column all staff should review the assignment plan, assessment of materiality & risk and systems notes.</i></p>
    <p><i>The team discussions on fraud, risk and related party transactions should be chaired by the A.E.P. (although the general briefing can be performed by another team member, i.e. the manager) and it should be undertaken ensuring that, when considering fraud, professional scepticism is applied. <u><b>Team members should set aside the belief that the client is honest and acts with integrity.</b></u></i></p>
    <p><i>Where junior staff are briefed separately, this should be clearly documented.</i></p>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 15px;
        }
        h3{
            font-size: 12px;
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
        <th colspan="2"><b>Detailed consideration of fraud, risk and related party transactions</b></th>
    </tr>
</thead>
    <tbody>
        <tr>
            <td colspan="2">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
        </tr>
        <tr>
            <td style="width: 50%;">1.	The areas within the accounting system where error or fraud are most likely to occur (consideration must specifically be given to earnings management);</td>
            <td>'.$ac11['dcfrrt1'].'</td>
        </tr>
        <tr>
            <td>2.	How a fraud could be carried out by either management or employees (special consideration should be given to accounting estimates);</td>
            <td>'.$ac11['dcfrrt2'].'</td>
        </tr>
        <tr>
            <td>3.	How a fraud could be carried out by, or in conjunction with the entity’s related parties (including where transactions are not undertaken on an arm’s length basis);</td>
            <td>'.$ac11['dcfrrt3'].'</td>
        </tr>
        <tr>
            <td>4.	How a fraud could be carried out by customers or suppliers;</td>
            <td>'.$ac11['dcfrrt4'].'</td>
        </tr>
        <tr>
            <td>5.	What risk factors may be seen during the audit which could indicate fraudulent activity, including:
                <ul>
                    <li>Pressure on management performance (e.g. targets set by holding companies, incentive schemes or banking covenants);</li>
                    <li>Change in lifestyle or behaviour of management or employees</li>
                    <li>Related party transactions which appear to have minimal commercial substance;</li>
                    <li>Suppliers / customers with PO box addresses etc.;</li>
                    <li>Allegations of fraud within the entity; or</li>
                    <li>Management overriding key controls.</li>
                </ul>
            </td>
            <td>'.$ac11['dcfrrt5'].'</td>
        </tr>
        <tr>
            <td colspan="2">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
        </tr>
        <tr>
            <td>6.	What controls are in place in relation to cash (or assets that can be easily converted to cash) and the employees involved in this area;</td>
            <td>'.$ac11['dcfrrt6'].'</td>
        </tr>
        <tr>
            <td>7.	Where consolidated financial statements are prepared the risk of fraud in subsidiaries, associates, joint ventures and during the consolidation process;</td>
            <td>'.$ac11['dcfrrt7'].'</td>
        </tr>
        <tr>
            <td>8.	How any changes in senior management or shareholders during, or since the end of the period could cause a potential risk factor which needs to be approached with “professional scepticism”.</td>
            <td>'.$ac11['dcfrrt8'].'</td>
        </tr>
        <tr>
            <td>9.	Which audit procedures will be used to respond to the susceptibility of the entity’s financial statements to material misstatement due to fraud? This may involve changing the nature, timing and extent of the audit procedures to be carried out.
                <ul>
                    <li>Performing substantive procedures on selected account balances and assertions not otherwise tested due to their materiality or risk;</li>
                    <li>Adjusting the timing of audit procedures from that otherwise expected;</li>
                    <li>Using different sampling methods;</li>
                    <li>Altering the audit approach compared to the prior year;</li>
                    <li>Use of data analytics to test for anomalies in a dataset;</li>
                    <li>Performing audit procedures at different locations or at locations on an unannounced basis.</li>
                </ul>
            </td>
            <td>'.$ac11['dcfrrt9'].'</td>
        </tr>
    </tbody>
</table>
<br><br><br>
<table border="1">
    <thead>
        <tr>
            <th colspan="2">Specific areas to be covered by the briefing:</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
            <td>Covered in discussion? (Yes/No)</td>
        </tr>
        <tr>
            <td>1.	All staff are aware of: </td>
        </tr>
        <tr>
            <td>- The need to report suspicions of money laundering internally, where required by legislation;</td>
            <td>'.$ac11['sacb1'].'</td>
        </tr>
        <tr>
            <td>- That any issues (actual or possible), including matters relating to independence which, had they been known earlier, would have caused the firm to decline the appointment should be notified to the A.E.P. immediately;</td>
            <td>'.$ac11['sacb2'].'</td>
        </tr>
        <tr>
            <td>- The main indicators for this client that the going concern assumption could be in doubt and if such issues are identified, these should be highlighted to the A.E.P. promptly;</td>
            <td>'.$ac11['sacb3'].'</td>
        </tr>
        <tr>
            <td>- That if new related parties are identified, these must be communicated immediately to all members of the audit team;</td>
            <td>'.$ac11['sacb4'].'</td>
        </tr>
        <tr>
            <td>2.	The responsibilities of team members have been clarified and documented at Ac14;</td>
            <td>'.$ac11['sacb5'].'</td>
        </tr>
        <tr>
            <td>3.	A detailed briefing regarding the client (including; objectives, structure and activities);</td>
            <td>'.$ac11['sacb6'].'</td>
        </tr>
        <tr>
            <td>4.	The risk areas as identified from the risk assessment and how additional work on these areas are incorporated into the audit approach;</td>
            <td>'.$ac11['sacb7'].'</td>
        </tr>
        <tr>
            <td>5.	How can unpredictability be incorporated into the audit approach to maximise the chance of fraudulent transactions being identified (e.g. which procedure will involve random / haphazard testing etc.);</td>
            <td>'.$ac11['sacb8'].'</td>
        </tr>
        <tr>
            <td>6.	Timing of review procedures have been discussed and it has been documented who has responsibility to review which areas.</td>
            <td>'.$ac11['sacb9'].'</td>
        </tr>
    </tbody>
</table>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();