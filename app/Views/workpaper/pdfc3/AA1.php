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
        <td style="width: 55%;">
            <table>
                <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                <tr><td></td></tr>
                <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
            </table>
        </td>
    </tr>
</table>
';
$html .= '<h3>AUDIT CONTROL RECORDs</h3>';
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
            <td style="width: 60%;">'.$r['field1'].'<br></td>
            <td class="cent bo" style="width: 18%;">'.$r['field2'].'</td>
            <td class="cent bo" style="width: 18%;">'.$r['field3'].'</td>
        </tr>
        ';
    }
$html .= '
    </tbody>
</table>
';
$html .= '
<p><b>1.  Completion by most senior person completing the fieldwork</b></p>
<p>I have completed my work as summarised above, and consider that the working papers adequately support our proposed opinion, except for the outstanding points listed on </p>
<p>-'.$rc['awp4'].'</p>
<table>
    <tr>
        <td style="width: 50%;">Signed:	</td>
        <td style="width: 50%;">Date:	</td>
    </tr>
</table>
<p><b>2.  Review completion by manager</b></p>
<p>I have completed my review of the working papers and consider that they support the opinion proposed except for the matters noted on </p>
<p>-'.$rc['awp5'].'</p>
<table>
    <tr>
        <td style="width: 50%;">Signed:	</td>
        <td style="width: 50%;">Date:	</td>
    </tr>
</table>
<p><b>3.  Review completion by Audit Engagement Partner</b></p>
<p>I have completed my review of:</p>
<p>-'.$rc['awp6'].'</p>
<ul>
    <li>the audit working papers, including:
        <ul>';
            if($rc['awp1'] != ''){
                $html .= '<li>'.$rc['awp1'].'</li>';
            }
            if($rc['awp2'] != ''){
                $html .= '<li>'.$rc['awp2'].'</li>';
            }
            if($rc['awp3'] != ''){
                $html .= '<li>'.$rc['awp3'].'</li>';
            }
$html .= '
        </ul>
    </li>
    <li>the financial statements / set of financial statements sent to the directors and consider that they support the proposed opinion to be given except for the matters noted on '.$rc['awp7'].' and the audit has been carried out in accordance with International Standards on Auditing.</li>
</ul>
<p>Where it is proposed to provide an unmodified opinion, I can confirm that:</p>
<ul>';
    if($rc['rceap1'] != ''){
        $html .= '<li>'.$rc['rceap1'].'</li>';
    }
    if($rc['rceap2'] != ''){
        $html .= '<li>'.$rc['rceap2'].'</li>';
    }
    if($rc['rceap3'] != ''){
        $html .= '<li>'.$rc['rceap3'].'</li>';
    }
    if($rc['rceap4'] != ''){
        $html .= '<li>'.$rc['rceap4'].'</li>';
    }
    if($rc['rceap5'] != ''){
        $html .= '<li>'.$rc['rceap5'].'</li>';
    }
    if($rc['rceap6'] != ''){
        $html .= '<li>'.$rc['rceap6'].'</li>';
    }
    if($rc['rceap7'] != ''){
        $html .= '<li>'.$rc['rceap7'].'</li>';
    }
    if($rc['rceap8'] != ''){
        $html .= '<li>'.$rc['rceap8'].'</li>';
    }
    if($rc['rceap9'] != ''){
        $html .= '<li>'.$rc['rceap9'].'</li>';
    }
    if($rc['rceap10'] != ''){
        $html .= '<li>'.$rc['rceap10'].'</li>';
    }
$html .= '
</ul>

<table>
    <tr>
        <td style="width: 50%;">Signed:	</td>
        <td style="width: 50%;">Date:	</td>
    </tr>
</table>
<p><i>The Audit Engagement Partner should also ensure that their relevant declarations have been completed on the front page of each of Aa3b Going Concern Checklist, and Aa7 ISA Compliance Critical Issues Memorandum.</i></p>
<p><b>Matters that must be cleared before the financial statements are signed:</b></p>
<p>Details: '.$rc['details'].'</p>
<p>Date required by client: '.date('F d, Y', strtotime($rc['datereq'])) .'</p>
<p>Number of copies required: '.$rc['numcop'].'</p>
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
            <td style="width: 60%;">'.$r['field1'].'<br></td>
            <td class="cent bo" style="width: 18%;">'.$r['field2'].'</td>
            <td class="cent bo" style="width: 18%;">'.$r['field3'].'</td>
        </tr>
        ';
    }
$html .= '
    </tbody>
</table>
';
$html .= '
    <p><b>5.  Signed Financial Statements and Audit Opinion</b></p>
    <p>Have all outstanding matters noted above, including confirming that the financial statements do not contain material errors or misstatements, been cleared to the satisfaction of the originator (and crossed through to demonstrate this)?</p>
    <p>-'.$s3['a1'].'</p>
    <p>Has a letter of representation, dated on, or immediately prior to the date of the audit report, been obtained, or has an appropriate modification been given?</p>
    <p>-'.$s3['a2'].'</p>
    <p>I confirm that consideration has been given to subsequent events arising since the reporting date, to the date of the approval of the financial statements.  If matters have arisen, these have been disclosed in the financial statements in note</p>
    <p>-'.$s3['a3'].'</p>
    <p>I confirm that the going concern basis '.$s3['a4'].' appropriate, and that relevant disclosures have been made in the financial statements.</p>                       
    <p>In considering the audit opinion, I have considered whether:</p>
    <ul>';
        if($s3['a5'] != ''){
            $html .= '<li>'.$s3['a5'].'</li>';
        }
        if($s3['a6'] != ''){
            $html .= '<li>'.$s3['a6'].'</li>';
        }
        if($s3['a7'] != ''){
            $html .= '<li>'.$s3['a7'].'</li>';
        }
        if($s3['a8'] != ''){
            $html .= '<li>'.$s3['a8'].'</li>';
        }
$html .= '
    </ul>
    <p>I approve the signing of an '.$s3['a9'].' audit opinion.</p>';

    if($s3['a10'] != ''){
        $html .= '<p>'.$s3['a10'].'</p>';
        $html .= '<p>-'.$s3['a10d'].'</p>';
    }
    if($s3['a11'] != ''){
        $html .= '<p>'.$s3['a11'].'</p>';
        $html .= '<p>-'.$s3['a11d'].'</p>';
    }
    if($s3['a12'] != ''){
        $html .= '<p>'.$s3['a12'].'</p>';
    }

$html .= '
    <table>
        <tr>
            <td style="width: 50%;">Signed:___________(A.E.P)</td>
            <td style="width: 50%;">Date:_____________</td>
        </tr>
    </table>
    <p><b>6.  Completion by EQCR:</b></p>
    <p>I have carried out a hot review, the scope of which is documented on</p>
    <p>- '.$s3['a13'].'</p>';
    if($s3['a14'] != ''){
        $html .= '<p>'.$s3['a14'].'</p>';
        $html .= '<p>'.$s3['a14d'].'have been cleared.</p>';
    }
    if($s3['a15'] != ''){
        $html .= '<p>'.$s3['a15'].'</p>';
    }
    if($s3['a16'] != ''){
        $html .= '<p>'.$s3['a16'].'</p>';
    }

$html .='
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
                <td class="bo" style="width: 20%;">'.$s3['a17'].'</td>
                <td class="bo" style="width: 20%;">'.$s3['a18'].'</td>
            </tr>
            <tr>
                <td class="bo" style="width: 60%;">
                    Are there any matters which would alter any of the Ethical Considerations set out on the Regulation of Auditor’s Checklist (Ac2), Provision of Non-Audit Services to Audit Clients (Ac3), and Part 4 of the Audit Control Record?
                    <br><br><br>
                    '.$s3['a19'].'
                    <br><br><br>
                    Does any of the above affect our service as auditors of this client?
                </td>
                <td class="bo" style="width: 20%;">'.$s3['a20'].'</td>
                <td class="bo" style="width: 20%;">'.$s3['a21'].'</td>
            </tr>
            <tr>
                <td style="width: 60%;">Do we know of any other factors that could affect independence or otherwise indicate that we should not accept re-appointment?</td>
                <td class="bo" style="width: 20%;">'.$s3['a22'].'</td>
                <td class="bo" style="width: 20%;">'.$s3['a23'].'</td>
            </tr>
        </tbody>
    </table>
    <p><b>Authority to accept re-appointment:</b></p>
    <p>I have considered the above, and do not consider that there are any perceived threats to our independence, integrity and objectivity and believe that we '.$s3['a24'].' this re-appointment. </p>
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
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();