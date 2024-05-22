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
$pdf->setPrintHeader(false);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(25,15,15);   
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-60, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderMargin(0);   
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);

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
<h3>PROVISION OF NON-AUDIT SERVICES</h3>
<p><b>Aim:</b></p>
<p>To give adequate consideration of the acceptability of providing non-audit services to entities which are not listed (or affiliates of such an entity).</p>
<p><b>The form must be completed prior to the commencement of each type of non-audit work (including the preparation of statutory financial statements) undertaken either by the firm, or by any network firm, and approved by the A.E.P. (or, in the A.E.P.’s absence, another A.E.P. within the firm).  </b></p>
<p>For new audit clients, this should extend to non-audit services provided prior to appointment, but relating to a period that the firm will audit. In subsequent years, consideration should be given before any work is undertaken on the audit.</p>  
<p>This checklist only provides general guidance and reference should be made to IESBA’s <i> Section 290: Independence ~ Audit and Review Engagements </i> where any doubts exist. In particular, this form does not consider:</p>
<ul>
    <li>Internal Audit Services;</li>
    <li>IT Services;</li>
    <li>Recruiting Services; and</li>
    <li>Corporate Finance Services.</li>
</ul>
<p>If any of the above is to be undertaken, this should be separately considered, with reference to the IESBA Code of Ethics.</p>
<p><b><i>NB: If the client does not have ‘informed management’ the provision of both audit and non-audit services is not permitted.</i></b></p>
<p><b>Section 1 – Consideration of Prohibited Services</b></p>
';


$image_file = base_url('img/ac2/ac2-f1.jpg');
$pdf->Image($image_file, $x = 20, $y = 190, $w = 180, $h = 180, $type = '', $link = '', $align = '', $resize = true, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = true, $hidden = false, $fitonpage = false, $alt = '');
$pdf->writeHTML($html, true, false,false, false, '');


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
        th{
            font-style: bold;
        }
    </style>
";

$html .= '
    <p><b>Section 2 – Consideration of the Type of Non-Audit Services Provided and Safeguards in Place </b></p>
    <p><i>N.B. Complete multiple sheets if more than four different types of non-audit service are provided<br>N.B. Audit related non-audit services (for example, a separate report to a regulator, (e.g. that on client money handled by a solicitor)) should still be treated as a non-audit service, but it is not necessary for safeguards to be put in place, as threats to independence are insignificant</i></p>
    <table border="1">
    <thead>
        <tr>
            <th style="width: 45%;"><b>Non-audit service to be provided:</b></th>
            <th style="width: 10%;" class="cent"><b>Corporation tax</b></th>
            <th style="width: 10%;" class="cent"><b>Statutory Services</b></th>
            <th style="width: 10%;" class="cent"><b>Accountancy(including preparation of financial statements)</b></th>
            <th style="width: 10%;" class="cent"><b>Other (specify)</b></th>
            <th style="width: 10%;" class="cent"><b>Total CU</b></th>
        </tr>
    </thead>
    <tbody>
    ';

foreach ($ac2 as $r){
    $html .= '
        <tr>
            <td style="width: 45%;">'.$r['question'].'</td>
            <td style="width: 10%;" class="cent">'.$r['corptax'].'</td>
            <td style="width: 10%;" class="cent">'.$r['statutory'].'</td>
            <td style="width: 10%;" class="cent">'.$r['accountancy'].' </td>
            <td style="width: 10%;" class="cent">'.$r['other'].'</td>
            <td style="width: 10%;" class="cent">'.$r['totalcu'].'</td>
        </tr>
    ';
}

$html .= '    
    </tbody>
</table>';


$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage('P');

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
    </style>
";

$html .= '<p><b>Section 2 – Consideration of the Type of Non-Audit Services Provided and Safeguards in Place </b></p>';
$image_file = base_url('img/ac2/ac2-f2.jpg');
$pdf->Image($image_file, $x = 20, $y = 30, $w = 180, $h = 180, $type = '', $link = '', $align = '', $resize = true, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = true, $hidden = false, $fitonpage = false, $alt = '');
$pdf->writeHTML($html, true, false,false, false, '');

$pdf->SetXY(50, 205); // Set the position to (50, 160) pixels
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
    </style>
";
$html .= '
<p><i>* “Substantial” should be considered both in terms of the audit firm and the audit client.1 A self interest threat arises where substantial non-audit fees are ‘regularly’ generated. If it considered that the substantial fee is not ‘regular’ the reason for this should be documented at *** below.</i></p>
<table border="1">
    <tr>
        <td><p><b>***(Where appropriate): Documentation by the A.E.P. of how the self interest threat has been reduced to an acceptable level / details of communication with the Ethics Partner / Details of which services (audit or non-audit) will not be provided:</b> </p>
            '.$aep['question'].'
        </td>
    </tr>
</table>
';


$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage('P');
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
        .st{
            font-size: 11px;
        }
    </style>
";

$html .= '
    <h3>Conclusion</h3>
    <ol>
        <li>The client has informed management.  I consider that there are no threats arising from fee income from the non-audit services provided / to be provided to the client and that the services can be provided.*</li>
        <li>The client has informed management. I consider that the threats imposed by the non-audit services provided / to be provided to the client and the resulting level of fee income have been reduced to an acceptable level as documented above.*</li>
        <li>We will not provide other services as it is not possible to put sufficient safeguards in place and we wish to remain as auditor.*</li>
        <li>We will provide other services but because it is not possible to put sufficient safeguards in place, we will resign as auditor.*</li>
    </ol>
    <table>
        <tbody>
            <tr>
                <td style="width: 50%;"><p>Signature:</p></td>
                <td style="width: 50%;">(A.E.P.)</td>
            </tr>
            <tr>
                <td style="width: 50%;"><p>Date:</p></td>
                <td style="width: 50%;" class="cent"></td>
            </tr>
        </tbody>
    </table>
    <p><i>* Delete as appropriate</i></p>
    <p><b>Notes:</b></p>
    <ol>
        <i><li>The audit firm can set their own criteria, but non-audit fees greater than three times the audit fee are likely to create a self-interest threat, which needs to be mitigated.</li></i>
        <i><li>Although the audit firm can set its own criteria, in circumstances where the audit fee is more significant to the firm, non-audit fees which represent a lower multiple of the audit fee are likely to be considered ‘substantial’.</li></i>
    </ol>
    <p><b>Definitions:</b></p>
    <table class="st" border="1">
        <tbody>
            <tr>
                <td style="width: 30%;"><p><b>Audit related non-audit services:</b></p></td>
                <td style="width: 70%;"><p>The following are generally treated as being audit related non-audit services:</p>
                    <ul>
                        <li>Reporting required by law or regulation to be provided by the auditor;</li>
                        <li>Reviews of interim financial information;</li>
                        <li>Reporting on regulatory returns;</li>
                        <li>Reporting to a regulator on client assets;</li>
                        <li>Reporting on government grants;</li>
                        <li>Reporting on internal financial controls when required by law or regulation; and</li>
                        <li>Extended audit work that is authorized by those charged with governance performed on financial information and / or financial controls where this work is integrated with the audit work and is performed on the same principal terms and conditions.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="width: 30%;"><p><b>“Informed management”:</b></p></td>
                <td style="width: 70%;"><p>Member of management (or senior employee), of the audited entity who has the authority and capability to make independent management judgments and decisions in relation to non-audit services on the basis of information provided by the audit firm.</p></td>
            </tr>
            <tr>
                <td style="width: 30%;"><p><b>Safeguards:</b></p></td>
                <td style="width: 70%;"><p>Safeguards include:</p>
                    <ul>
                        <li>Non-audit services provided by the firm are performed by partners and staff who have no involvement in the external audit of the financial statements; or</li>
                        <li>The non-audit services are reviewed by a partner or other senior staff member with appropriate expertise who is not a member of the audit team; or</li>
                        <li>An engagement quality control review is performed.</li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');




//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->Output('stocktransfer.pdf','I');
exit();