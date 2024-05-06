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
$html .= '<h3>AUDIT CONTROL RECORD</h3>';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 6%;"></th>
            <th style="width: 60%;"><b>Planning</b></th>
            <th class="cent bo" style="width: 18%;"><b>Yes/No /N/A</b></th>
            <th class="cent bo" style="width: 18%;"><b>WP Ref / Comment</b></th>
        </tr>
    </thead>
    <tbody>';
    $count = 0;
    foreach($datapl as $r){
        $count ++;
        $html .= '
        <tr>
            <td style="width: 6%;">'.$count.'.<br></td>
            <td style="width: 60%;">'.$r['question'].'<br></td>
            <td class="cent bo" style="width: 18%;">'.$r['extent'].'</td>
            <td class="cent bo" style="width: 18%;">'.$r['reference'].'</td>
        </tr>
        ';
    }
$html .= '
    </tbody>
</table>
';
$html .= '
<p><b>1.  Completion by most senior person completing the fieldwork</b></p>
<p>I have completed my work as summarised above, and consider that the working papers adequately support our proposed opinion, except for the outstanding points listed on ...........................................</p>
<table>
    <tr>
        <td style="width: 50%;">Signed:	</td>
        <td style="width: 50%;">Date:	</td>
    </tr>
</table>
<p><b>2.  Review completion by manager</b></p>
<p>I have completed my review of the working papers and consider that they support the opinion proposed except for the matters noted on .......................................</p>
<table>
    <tr>
        <td style="width: 50%;">Signed:	</td>
        <td style="width: 50%;">Date:	</td>
    </tr>
</table>
<p><b>3.  Review completion by Audit Engagement Partner</b></p>
<p>I have completed my review of:</p>
<ul>
    <li>the audit working papers, including:
        <ul>
            <li>critical areas of judgment, especially those relating to difficult or contentious matters identified during the course of the engagement;</li>
            <li>significant risks; and</li>
            <li>points raised for my attention at Aa7</li>
        </ul>
    </li>
    <li>the financial statements / set of financial statements sent to the directors</li>
</ul>
<p>and consider that they support the proposed opinion to be given except for the matters noted on ............................. and the audit has been carried out in accordance with International Standards on Auditing.</p>
<p>Where it is proposed to provide an unmodified opinion, I can confirm that:</p>
<ul>
    <li>adequate accounting records have been kept, and we have received returns adequate for our audit from branches not visited by us;</li>
    <li>the financial statements are in agreement with the accounting records and returns;</li>
    <li>we have received all the information and explanations we require for our audit;</li>
    <li>the financial statements have been properly prepared in accordance with *National GAAP / *IFRS, and any disclosure exemptions have been properly applied;</li>
    <li>there are no material inconsistencies between the financial statements and other information presented with them;</li>
    <li>there are no doubts regarding the reliability of representations we have received / are seeking to obtain in the letter of representation;</li>
    <li>there are no matters which have been noted on the ISA Compliance Critical Issues Memorandum (Aa7) which would warrant the audit report to be modified;</li>
    <li>items which have been recorded as unadjusted audit errors (Aa11), when considered individually and in aggregate, do not result in the financial statements being materially incorrect;</li>
    <li>there have been no limitations in the scope of our work; and</li>
    <li>there are no matters which we wish to include in our audit report to provide additional explanations to the users of the financial statements.</li>
</ul>
<p>Where the above cannot be confirmed, it is proposed that the audit opinion will be modified* / an Emphasis of matter paragraph* / Other matter paragraph* will be included for the reasons noted on …………………..(* - Delete as applicable)</p>
<table>
    <tr>
        <td style="width: 50%;">Signed:	</td>
        <td style="width: 50%;">Date:	</td>
    </tr>
</table>
<p><i>The Audit Engagement Partner should also ensure that their relevant declarations have been completed on the front page of each of Aa3b Going Concern Checklist, and Aa7 ISA Compliance Critical Issues Memorandum.</i></p>
<p><b>Matters that must be cleared before the financial statements are signed:</b></p>
<p>Details: 
    <br>
    <br>
</p>
<p>Date required by client: </p>
<p>Number of copies required:</p>
<p><b>4.	Pre-sign off completion by Audit Engagement Partner</b></p>
';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 6%;"></th>
            <th style="width: 60%;"><b>Audit finalisation</b></th>
            <th class="cent bo" style="width: 18%;"><b>Yes/No /N/A</b></th>
            <th class="cent bo" style="width: 18%;"><b>WP Ref / Comment</b></th>
        </tr>
    </thead>
    <tbody>';
    $count = 0;
    foreach($dataaf as $r){
        $count ++;
        $html .= '
        <tr>
            <td style="width: 6%;">'.$count.'.<br></td>
            <td style="width: 60%;">'.$r['question'].'<br></td>
            <td class="cent bo" style="width: 18%;">'.$r['extent'].'</td>
            <td class="cent bo" style="width: 18%;">'.$r['reference'].'</td>
        </tr>
        ';
    }
$html .= '
    </tbody>
</table>
';
$html .= '
    <p><b>5.  Signed Financial Statements and Audit Opinion</b></p>
    <p>Have all outstanding matters noted above, including confirming that the financial statements do not contain material errors or misstatements, been cleared to the satisfaction of the originator (and crossed through to demonstrate this)?………………..........</p>
    <p>Has a letter of representation, dated on, or immediately prior to the date of the audit report, been obtained, or has an appropriate modification been given?……………………..</p>
    <p>I confirm that consideration has been given to subsequent events arising since the reporting date, to the date of the approval of the financial statements.  If matters have arisen, these have been disclosed in the financial statements in note ………………..........</p>
    <p>I confirm that the going concern basis *is / *is not appropriate, and that relevant disclosures have been made in the financial statements.</p>                       
    <p>In considering the audit opinion, I have considered whether:</p>
    <ul>
        <li>Sufficient appropriate audit evidence has been obtained as to whether the financial statements as a whole are free from material misstatement, whether due to fraud or error;</li>
        <li>Uncorrected misstatements, individually and in aggregate are immaterial;</li>
        <li>The financial statements give a true and fair view; and</li>
        <li>The financial statements have been correctly prepared in accordance with *National GAAP / *IFRS, including all relevant legal requirements.</li>
    </ul>
    <p>I approve the signing of an *unmodified / *modified audit opinion.</p>
    <p>*The opinion is modified for the reasons noted on………………………</p>
    <p>*The audit report includes an *emphasis of matter paragraph / *other matter paragraph for the reasons noted on .............................</p>
    <p>*As the audit opinion has been modified an additional paragraph has been included regarding the impact of the modification on the company’s ability to pay future dividends.</p>
    <table>
        <tr>
            <td style="width: 50%;">Signed:___________(A.E.P)</td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
    </table>
    <p><b>6.  Completion by EQCR:</b></p>
    <p>I have carried out a hot review, the scope of which is documented on………...</p>
    <p>*I am satisfied that all points raised in my review on ........................ have been cleared.</p>
    <p>*I have reviewed the proposed modification / emphasis of matter paragraph and consider it appropriate.</p>
    <p>*I confirm that the conclusion in 5 above is appropriate.</p>    
    <table>
        <tr>
            <td style="width: 50%;">Signed:___________(EQCR)</td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
    </table>
    <p><b>7	Acceptance of Re-Appointment (to be completed by the A.E.P.)</b></p>
    <p><b>This section is to be completed by the A.E.P. prior to re-appointment.</b></p>
    <p>Whilst answering these questions the following matters should be fully considered for the audit firm and any network firm: independence, integrity, conflicts of interest with other clients, economic dependence, trusts, matters arising with regulatory authorities, ability to service the client, other services provided to the client and hospitality. Additional guidance is available in legislation and the Code of Ethics issued by the International Ethics Standards Board for Accountants.</p>
    <p><b>Any YES answers should be fully explained along with the safeguards, which will enable us to accept the re-appointment.</b></p>
    <p><b>Significant issues must be discussed with the Ethics Partner and details of the discussion should be documented on file.</b></p>
    <table>
        <thead>
            <tr>
                <th style="width: 60%;"></th>
                <th style="width: 20%;">Yes/No</th>
                <th style="width: 20%;">Comment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 60%;">Are there any matters which would alter any of the Ethical Considerations set out on the Regulation of Auditor’s Checklist (Ac2), Provision of Non-Audit Services to Audit Clients (Ac3), and Part 4 of the Audit Control Record?</td>
                <td class="bo" style="width: 20%;">'.$s3['a1'].'</td>
                <td class="bo" style="width: 20%;">'.$s3['a2'].'</td>
            </tr>
            <tr>
                <td class="bo" style="width: 60%;">
                    Are there any matters which would alter any of the Ethical Considerations set out on the Regulation of Auditor’s Checklist (Ac2), Provision of Non-Audit Services to Audit Clients (Ac3), and Part 4 of the Audit Control Record?
                    <br><br><br>
                    '.$s3['a3'].'
                    <br><br><br>
                    Does any of the above affect our service as auditors of this client?
                </td>
                <td class="bo" style="width: 20%;">'.$s3['a4'].'</td>
                <td class="bo" style="width: 20%;">'.$s3['a5'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">Do we know of any other factors that could affect independence or otherwise indicate that we should not accept re-appointment?</td>
                <td class="bo" style="width: 20%;">'.$s3['a6'].'</td>
                <td class="bo" style="width: 20%;">'.$s3['a7'].'</td>
            </tr>
        </tbody>
    </table>
    <p><b>Authority to accept re-appointment:</b></p>
    <p>I have considered the above, and do not consider that there are any perceived threats to our independence, integrity and objectivity and believe that we *can accept / *can accept with the stated safeguards /* cannot accept this re-appointment. </p>
    <p>Where necessary adequate consultation has been undertaken and documented with the Ethics Partner.</p>
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
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();