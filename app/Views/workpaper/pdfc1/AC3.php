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
<h3>PERMANENT FILE CHECKLIST</h3>
<p>Objective: This form is to be used to ensure the permanent file contains sufficient background information about the client.</p>
<p>This is a mandatory form.  Any “no” answers indicate a deficiency on the permanent file and a comment should be made as to how this will be addressed.</p>
<p>Per PSA 315, para A128c, “Disclosures in the financial statements of smaller entities may be less detailed or less complex (e.g., some financial reporting frameworks allow smaller entities to provide fewer disclosures in the financial statements). However, this does not relieve the auditor of the responsibility to obtain an understanding of the entity and its environment, including internal control, as it relates to disclosures.”</p>
';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 5%"></th>
            <th style="width: 60%"><b>General Matters</b></th>
            <th style="width: 17%" class="cent bo"><b>YES/NO</b></th>
            <th style="width: 17%" class="cent bo"><b>COMMENTS</b></th>
        </tr>
    </thead>
    <tbody>';
    $c = 0;
    foreach($ac3genmat as $r){
        $c ++;
        $html .='
            <tr>
                <td style="width: 5%">'.$c.'</td>
                <td style="width: 60%;">'.$r['question'].'</td>
                <td style="width: 17%" class="cent bo">'.$r['yesno'].'</td>
                <td style="width: 17%" class="cent bo">'.$r['comment'].'</td>
            </tr>
        ';
    }
$html .= '   
    </tbody>
</table>';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 5%"></th>
            <th style="width: 60%"><b>Documents and Correspondence of a Permanent Nature</b></th>
            <th style="width: 17%" class="cent bo"><b>YES/NO</b></th>
            <th style="width: 17%" class="cent bo"><b>COMMENTS</b></th>
        </tr>
    </thead>
    <tbody>';
    foreach($ac3doccors as $r){
        $c ++;
        $html .='
            <tr>
                <td style="width: 5%">'.$c.'</td>
                <td style="width: 60%;">'.$r['question'].'</td>
                <td style="width: 17%" class="cent bo">'.$r['yesno'].'</td>
                <td style="width: 17%" class="cent bo">'.$r['comment'].'</td>
            </tr>
        ';
    }
$html .= '   
    </tbody>
</table>';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 5%"></th>
            <th style="width: 60%"><b>Statutory Matters</b></th>
            <th style="width: 17%" class="cent bo"><b>YES/NO</b></th>
            <th style="width: 17%" class="cent bo"><b>COMMENTS</b></th>
        </tr>
    </thead>
    <tbody>';
    foreach($ac3statutory as $r){
        $c ++;
        $html .='
            <tr>
                <td style="width: 5%">'.$c.'</td>
                <td style="width: 60%;">'.$r['question'].'</td>
                <td style="width: 17%" class="cent bo">'.$r['yesno'].'</td>
                <td style="width: 17%" class="cent bo">'.$r['comment'].'</td>
            </tr>
        ';
    }
$html .= '   
    </tbody>
</table>';
$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 5%"></th>
            <th style="width: 60%"><b>The Accounting System</b></th>
            <th style="width: 17%" class="cent bo"><b>YES/NO</b></th>
            <th style="width: 17%" class="cent bo"><b>COMMENTS</b></th>
        </tr>
    </thead>
    <tbody>';
    foreach($ac3accsys as $r){
        $c ++;
        $html .='
            <tr>
                <td style="width: 5%">'.$c.'</td>
                <td style="width: 60%;">'.$r['question'].'</td>
                <td style="width: 17%" class="cent bo">'.$r['yesno'].'</td>
                <td style="width: 17%" class="cent bo">'.$r['comment'].'</td>
            </tr>
        ';
    }
$html .= '   
    </tbody>
    </table>
    <p><b>I have reviewed / updated the permanent file and consider that it is adequate.</b></p>
    <table>
        <tbody>
            <tr>
                <td style="width: 50%;"><b>Signed: </b></td>
                <td style="width: 50%;"><b>Date:</b></td>
            </tr>
        </tbody>
    </table>
    <p><b>I have reviewed the permanent file and consider that it is adequate.</b></p>
    <table>
        <tbody>
            <tr>
                <td style="width: 50%;"><b>Signed: </b></td>
                <td style="width: 50%;"><b>Date:</b></td>
            </tr>
        </tbody>
    </table>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();