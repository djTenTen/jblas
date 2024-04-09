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
            font-size: 14px;
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


$html .= ' <p><b>'.$sheet.'</b></p>';


$html .= '
<table>
    <thead>
        <tr>
            <th style="width: 70%;"></th>
            <th style="width: 30%;" class="cent"><b>CU</b></th>
        </tr>
        <tr>
            <th style="width: 70%;"></th>
            <th style="width: 30%;" class="cent"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 70%;">Value Per Financial Statements</td>
            <td style="width: 30%;" class="bo cent">'.$cu['question'].'</td>
        </tr>
    </tbody>
</table> 
';

$html .= '
<table>
    <thead> 
        <tr>
            <th style="width: 13%;">Less</th>
            <th  colspan="4"><b>Large Items (to include all items greater than performance materiality)</b></th>
        </tr>
        <tr>
            <th style="width: 13%;"></th>
            <th colspan="2" style="width: 60%;"><u>Name</u></th>
            <th colspan="2" class="cent"><u>Balance</u></th>
        </tr>
    </thead>
    <tbody>';
    
        $ototal = 0;
        $bal1 = 0;
        foreach($ac10s1 as $r){
            $bal1 += $r['balance'];
            $html .= '
                <tr>
                    <td style="width: 13%;">'.$r['less'].'</td>
                    <td colspan="2" style="width: 60%;">'.$r['name'].'</td>
                    <td colspan="2"  class="cent">'.$r['balance'].'</td>
                </tr>
            ';
        }
           
$html .='
    </tbody>   
</table>
<br>
<br>
<br>
';

$html .= '
<table>
    <thead> 
        <tr>
            <th style="width: 13%;">Less</th>
            <th  colspan="4"><b>Large Items (to include all items greater than performance materiality)</b></th>
        </tr>
        <tr>
            <th style="width: 13%;"></th>
            <th colspan="2" style="width: 60%;"><u>Name</u></th>
            <th colspan="2" class="cent"><u>Balance</u></th>
        </tr>
    </thead>
    <tbody>';
    
        $ototal = 0;
        $bal2 = 0;
        foreach($ac10s2 as $r){
            $bal2 += $r['balance'];
            $html .= '
                <tr>
                    <td style="width: 13%;">'.$r['less'].'</td>
                    <td colspan="2" style="width: 60%;">'.$r['name'].'</td>
                    <td colspan="2"  class="cent">'.$r['balance'].'</td>
                </tr>
            ';
        }
           
$html .='
    </tbody>
    <br>
    <br>
    <tfoot>
        ';
            $ototal = $bal1 + $bal2;
            $ptota = 0;
            if($cu['question'] > $ototal ){
                $ptota = $cu['question'] - $ototal;
            }
$html .= '
        <tr>
            <td style="width: 60%;">Total Large and Key Items</td>
            <td style="width: 13%;"></td>
            <td  class="cent bo">'.$ototal.'</td>
        </tr>
        <tr>
            <td style="width: 60%;">Population after Large and Key Items</td>
            <td style="width: 13%;"></td>
            <td  class="cent bo">'.$ptota.'</td>
        </tr>
    </tfoot>
</table>
';





//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();