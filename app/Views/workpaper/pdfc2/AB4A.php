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
$space = $pdf->Ln(10);

$html .= '<h3>PRELIMINARY ANALYTICAL PROCEDURES</h3>';

$html .= '
<table >
    <thead>
        <tr>
            <th colspan="2">Section A - Permanent</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>General matters</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Documents and correspondence of a permanent nature</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Statutory matters</td>
        </tr>
    </tbody>
</table>
<table >
    <thead>
        <tr>
            <th colspan="2">Section B - Systems</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>The accounting system - overall description</td>
        </tr>
        <tr>
            <td>2-5</td>
            <td>Individual accounting systems - detail</td>
        </tr>
    </tbody>
</table>
<h3 style="text-align: center;">REVIEW DETAILS</h3>
';

$html .= '
    <table border="1">
        <thead>
            <tr>
                <th>Year to</th>
                <th>Prepared by</th>
                <th>Date</th>
                <th>Reviewed by</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
';
        foreach($rd as $r){
            $html .= '
                <tr>
                    <td>'.$r['field1'].'</td>
                    <td>'.$r['field2'].'</td>
                    <td>'.$r['field3'].'</td>
                    <td>'.$r['field4'].'</td>
                    <td>'.$r['field5'].'</td>
                </tr>
            ';
        }
$html .= '</tbody>
    </table>
';
    
    






//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();