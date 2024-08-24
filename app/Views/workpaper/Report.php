<?php
use \App\Models\ReportModel;
use setasign\Fpdi\Tcpdf\Fpdi;
$rp = new ReportModel;
// create new PDF document
$pageLayout = array(21, 29.7);

$pdf = new Fpdi('P', 'mm', 'A4');

// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->setPrintFooter(false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ApplAud');
$pdf->SetTitle('Report');
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
$pdf->AddPage('P');
//$pdf->SetPageSize('A4');
$style2 =  "
    <style>
        *{
            font-family: 'dejavusans';
            font-size: 12px;
        }
        h2{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
        }
    </style>
";
$style =  "
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
$html = '';
    /**
        ----------------------------------------------------------
        FRONT PAGE
        ---------------------------------------------------------- 
    */
    $html .= '
        <hr style="color:blue;"> <br><br><br><br><br><br>
        <h1 style="color:navy; text-align:center;">(Logo)</h1>
        <h1 style="color:navy; text-align:center;">(Firm)</h1>
        <br><br><br>
        <h1 style="color:navy;text-align:center;">'.$client.'</h1>
        <h3 style="text-align:center;">Workpaper - FY'.$fy.'</h3>
        
        <table style="margin-top: 50px;">
            <tbody>
                <tr>
                    <td style="width: 20%;">Prepared by:</td>
                    <td><b>'.$aud.'</b></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Reviewed by:</td>
                    <td><b>'.$sup.'</b></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Manager:</td>
                    <td><b>'.$audm.'</b></td>
                </tr>
            </tbody>
        </table>
    ';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';

    /**
        ----------------------------------------------------------
        WORKPAPER PDF GENERATOR
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Work Paper',0,0);

    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:navy;text-align:center;">WORK PAPER</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';
    foreach($fi as $f){
        switch ($f['section']) {

            case '-':

                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2>';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'FSTR':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                $html .= '
                    <br> 
                    <table>
                        <tr>
                            <td>
                                <br>
                                <ul><b>1st Quarter</b>
                                    <li>EWT: <b>'.$q1e.'</b></li>
                                    <li>VAT: <b>'.$q1v.'</b></li>
                                    <li>1601C: <b>'.$q16.'</b></li>
                                    <li>1701/2: <b>'.$q17.'</b></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <ul><b>2nd Quarter</b>
                                    <li>EWT: <b>'.$q2e.'</b></li>
                                    <li>VAT: <b>'.$q2v.'</b></li>
                                    <li>1601C: <b>'.$q26.'</b></li>
                                    <li>1701/2: <b>'.$q27.'</b></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <ul><b>3rd Quarter</b>
                                    <li>EWT: <b>'.$q3e.'</b></li>
                                    <li>VAT: <b>'.$q3v.'</b></li>
                                    <li>1601C: <b>'.$q36.'</b></li>
                                    <li>1701/2: <b>'.$q37.'</b></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <ul><b>4th Quarter</b>
                                    <li>EWT: <b>'.$q4e.'</b></li>
                                    <li>VAT: <b>'.$q4v.'</b></li>
                                    <li>1601C: <b>'.$q46.'</b></li>
                                    <li>1701/2: <b>'.$q47.'</b></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'B':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,6);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }
                
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'C':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';

                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,7);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'DG':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,8);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
            case 'E':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,9);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'F':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,10);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'H':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,11);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'I':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,12);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'J':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,13);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'K':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,14);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'L':
                
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,15);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'M':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,16);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'N':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,17);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'O':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,18);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'P':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,19);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'Q':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,20);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'R':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,21);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'S':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr style="background-color: navy; color:white;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $b = 0;
                            $va = 0;
                            $sv = 0;
                            $ind = $rp->gettbindex($cID,$wpID,22);
                            foreach($ind as $r){
                                $b += ($r['debit'] - $r['credit']);
                                $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                $sv += $r['supp_bal'];
                                $html .= '  
                                    <tr>
                                        <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                        <td style="width: 20%;">₱ '.number_format($r['debit'] - $r['credit'], 2).'</td>
                                        <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                        <td style="width: 20%;">₱ '.number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2).'</td>
                                        <td style="width: 10%;">%'.round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100).'</td>
                                    </tr>
                                ';
                            }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';

                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:navy">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'T':

                
            break;
            case 'U':

                
            break;
            case 'V':
                
                
            break;
        }
    }

    /**
        ----------------------------------------------------------
        CHAPTER 1 PDF GENERATOR
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Chapter 1 : Planning',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:navy;text-align:center;">CHAPTER 1: PLANNING</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';

    foreach($c1 as $c){
        switch ($c['code']) {
            case 'AC1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Client Acceptance or Continuance Form',1,1);
                $html .= $style;
                $html .= $c['code'];
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
                        $ac1 = $rp->getac1($c['code'],$c['c1tID'],$cID,$wpID);
                        $cnt = 0;
                        foreach($ac1 as $r){
                            $cnt ++;
                            $html .='
                                <tr>
                                    <td style="width: 10%">'.$cnt.'</td>
                                    <td style="width: 50%;">'.$r['question'].'</td>
                                    <td style="width: 20%" class="cent bo">'.$r['yesno'].'</td>
                                    <td style="width: 20%" class="cent bo">'.$r['comment'].'</td>
                                </tr>
                            ';
                        }
                $html .= '   
                        </tbody>
                    </table>';

                $rdata  = $rp->getac1eqr($c['code'],$c['c1tID'],$cID,$wpID);
                $eqr    = json_decode($rdata['question'], true);

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
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PROVISION OF NON-AUDIT SERVICES',1,1);
                $html .= $style;
                $html .= $c['code'];
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
                $html = '';
                $pdf->AddPage('L');
                
                $html .= $style;

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
                $ac2 = $rp->getac2($c['code'],$c['c1tID'],$cID,$wpID);
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
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '<p><b>Section 2 – Consideration of the Type of Non-Audit Services Provided and Safeguards in Place </b></p>';
                $image_file = base_url('img/ac2/ac2-f2.jpg');
                $pdf->Image($image_file, $x = 20, $y = 30, $w = 180, $h = 180, $type = '', $link = '', $align = '', $resize = true, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = true, $hidden = false, $fitonpage = false, $alt = '');
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->SetXY(50, 205); // Set the position to (50, 160) pixels
                $html .= $style;

                $aep = $rp->getac2aep($c['code'],$c['c1tID'],$cID,$wpID);

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
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <h3>Conclusion</h3>
                    <p>'.$aep['name'].'</p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 50%;"><p>Signature:</p> <b>'.$cl['aud'].'</b> <img src="'.base_url('uploads/signature/'.$cl['audsign']).'" alt="" srcset="" style="width: 100px; align-self: center;"></td>
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
                $html = '';
            break;

            case 'AC3':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PERMANENT FILE CHECKLIST',1,1);
                $html .= $style;
                $html .= $c['code'];
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
                        $ac3genmat = $rp->getac3('genmat',$c['code'],$c['c1tID'],$cID,$wpID);
                        $cnt = 0;
                        foreach($ac3genmat as $r){
                            $cnt ++;
                            $html .='
                                <tr>
                                    <td style="width: 5%">'.$cnt.'</td>
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
                        $ac3doccors = $rp->getac3('doccors',$c['code'],$c['c1tID'],$cID,$wpID);
                        foreach($ac3doccors as $r){
                            $cnt ++;
                            $html .='
                                <tr>
                                    <td style="width: 5%">'.$cnt.'</td>
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
                        $statutory = $rp->getac3('statutory',$c['code'],$c['c1tID'],$cID,$wpID);
                        foreach($statutory as $r){
                            $cnt ++;
                            $html .='
                                <tr>
                                    <td style="width: 5%">'.$cnt.'</td>
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
                        $ac3accsys = $rp->getac3('accsys',$c['code'],$c['c1tID'],$cID,$wpID);
                        foreach($ac3accsys as $r){
                            $cnt ++;
                            $html .='
                                <tr>
                                    <td style="width: 5%">'.$cnt.'</td>
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

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC4':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PRELIMINARY PLANNING PROCEDURES – CLIENT INVOLVEMENT IN THE PLANNING PROCESS',1,1);
                $html .= $style;
                $html .= $c['code'];
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

                $rdata  = $rp->getac4ppr($c['code'],$c['c1tID'],$cID,$wpID);
                $ppr    = json_decode($rdata['question'], true);
                $html .= '
                    <h3>PRELIMINARY PLANNING PROCEDURES – CLIENT INVOLVEMENT IN THE PLANNING PROCESS</h3>
                    <p><b>NB: The key issues noted from this document must be recorded in the relevant areas of the audit file or the PAF and should feed through into the risk assessment, audit approach and fieldwork.</b></p>
                    <table border="1"\>
                        <tr>
                            <td><p><b>Which members of the client staff and the audit team have been involved in the preplanning process and what are their roles?</b></p>
                            '.$ppr['ppr1'].'
                            </td>
                        </tr>
                        <tr>
                            <td><p><b>How was the communication undertaken and on what date?</b></p>
                            '.$ppr['ppr2'].'
                            </td>
                        </tr>
                    </table>
                    <p><i>In respect of a new audit assignment, where the discussion points below request “changes” to be noted, full information should be documented, as the working papers will not document “existing” issues affecting the client.</i></p>
                ';
                $html .= '
                    <p class="bo"><b>Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted:</b></p>
                    <table border="1">
                        <tbody>
                ';

                $ac4 = $rp->getac4($c['code'],$c['c1tID'],$cID,$wpID);
                foreach($ac4 as $r){
                    $html .= '
                        <tr>
                            <td>'.$r['question'].'<br></td>
                            <td>'.$r['comment'].'</td>
                        </tr>
                    ';
                }
                $html .= '</tbody>
                </table>';
                

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC5':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PRELIMINARY ANALYTICAL PROCEDURES',1,1);
                $html .= $style;
                $html .= $c['code'];
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
                $space = $pdf->Ln(10);
                $html .= '<h3>PRELIMINARY ANALYTICAL PROCEDURES</h3>';
                $rdata = $rp->getac5($c['code'],$c['c1tID'],$cID,$wpID);
                $rc    = json_decode($rdata['question'], true);
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b><p><u>Summary of results and preliminary analytical procedures</u></p>
                                    <p>Objectives:</p><ul>
                                        <li>To highlight the impact on this period’s audit, including consideration of any unexpected ratios or variances which could be indicative of fraud.</li>
                                        <li>To ensure that risks identified are transferred to the risk assessment and into the audit approach / work programmes as required and are cross referenced to indicate this.</li>
                                        <li>Where a parent company produces consolidated financial statements, consideration must be given to the parent company figures and the consolidated figures.</li>
                                    </ul></b>
                                    <br><br><br><br>
                                    <p><b>Result:</b></p>
                                    <p>'.$rc['res'].'</p>
                                    <br><br><br><br>
                                    <p><b>Conclusion:</b></p>
                                    <p>'.$rc['con'].'</p>
                                    <br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC6':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : RISK SUMMARY',1,1);
                $html .= $style;
                $html .= $c['code'];
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
                $ac6 = $rp->getac6('ac6ra',$c['code'],$c['c1tID'],$cID,$wpID);
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

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
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
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $rdata = $rp->gets12($c['code'],$c['c1tID'],$cID,$wpID);
                $s = json_decode($rdata['question'], true);
                $html .= '
                    <p><b>Objective:</b> This form is designed to determine the inherent risk of the business as a whole.  PSA 315 implies that all businesses should be high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
                    <h3>Section 1 – INHERENT BUSINESS RISK</h3>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><p>The inherent business risk of the client is deemed to be low / medium / high* for the following reasons:</p>
                                    <br><br><br><br>
                                    <p>'.$s['s1'].'</p>
                                    <br><br><br><br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Comprehensive consideration should be given to all clients even those deemed to be low risk. As part of this review consideration must be given to the Company’s going concern status and I.T. risk.</p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <p><b>Objective:</b> This form is designed to assess the adequacy of the entity’s control environment as a whole to determine whether a control based audit approach is appropriate. Section 3 looks at internal controls specific to the audit. To comply with PSA 315, both sections must be completed regardless of whether you intend to test, and if successful, place reliance on the entity’s controls.</p>
                    <p>In addition, this form should document the considerations of the risks related to management override of controls.</p>
                    <h3>Section 2a – CONSIDERATION OF THE RISK OF MANAGEMENT OVERRIDE OF CONTROLS </h3>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><p>The risk of management override is present in <b>ALL</b> entities. However, the level of that risk will vary from entity to entity. Where management can override key controls, document here the considerations relating to the level of risk posed by management override and the audit procedures planned to address this risk:</p>
                                    <br><br><br><br>
                                    <p>'.$s['s2a'].'</p>
                                    <br><br><br><br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>Section 2b – CONSIDERATION OF THE CONTROL ENVIRONMENT </h3>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><p>The control environment of the client deemed to be effective / ineffective* for the following reasons: </p>
                                    <br><br><br><br>
                                    <p>'.$s['s2b'].'</p>
                                    <br><br><br><br><br><br><br><br>
                                    <p>Based on the above assessment control testing is / is not * going to be undertaken </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
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
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
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
                            $s3 = $rp->getac6('ac6s3',$c['code'],$c['c1tID'],$cID,$wpID);
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
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <p><b>Notes Regarding Assessment of Controls:	</b></p>
                    <ol>
                        <li>The audit approach section of the assignment plan should include details of how the risk and control environment assessment have influenced the design of the audit programmes and have identified key items and key audit issues. <br></li>
                        <li>Where it is unlikely that sufficient, appropriate audit evidence can be obtained solely from substantive procedures, it is necessary to obtain an understanding of the controls over risks which may arise.  In such circumstances, it is necessary for controls testing to be performed (for example, a company which sells goods and services over the internet, where the process is highly automated, and relies on little or no human input).  In such cases, the entity\'s controls over such risks are relevant to the audit.  (PSA 315.30, PSA 315.A140-142). <br></li>
                        <li>Where significant risks have been identified, the entity\'s controls relevant to those risks should be understood. <br></li>
                        <li>Paragraph 31 of PSA 240 states "Management is in a unique position to perpetrate fraud because of management’s ability to manipulate accounting records and prepare fraudulent financial statements by overriding controls that otherwise appear to be operating effectively. Although the level of risk of management override of controls will vary from entity to entity, the risk is nevertheless present in all entities. Due to the unpredictable way in which such override could occur, it is a risk of material misstatement due to fraud and thus a significant risk". <br></li>
                    </ol>
                ';


                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
            
            case 'AC7':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SPECIFIC AREA NARRATIVE INHERENT RISK ASSESSMENT',1,1);
                $html .= $style;
                $html .= $c['code'];

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

                $html .= '<h3>SPECIFIC AREA NARRATIVE INHERENT RISK ASSESSMENT</h3>';
                $html .= '
                    <p><b>Objective:</b> This form is designed to assess the risk for each audit assertion relevant to each audit area.  PSA 315 implies that all areas and all assertions are high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
                    <p>The risk forms should not be completed until –</p>
                    <ul>
                        <li>Appropriate enquiries have been made of management;</li>
                        <li>Points forward from last year have been considered;</li>
                        <li>The permanent audit file has been reviewed; and</li>
                        <li>Preliminary analytical procedures have been carried out.</li>
                    </ul>
                    <p>Notes on completion of this document –</p>
                    <ul>
                        <li>A list of possible risk factors has been collated (Appendix 1.14.1) can be used as an aide memoire;</li>
                        <li>An answer of “Yes” to one of the preliminary questions on each audit area will mean that there are potential risks associated with that area, and therefore a full commentary for that audit area will be required; and</li>
                        <li>Sections which are less than expected performance materiality or are not applicable should be deleted.</li>
                    </ul>
                    <p><b>Specific Considerations relating to Revenue</b></p>
                    <p>Per PSA 240, paragraph 26 <i>“the auditor shall, based on a presumption that there are risks of fraud in revenue recognition, evaluate which types of revenue, revenue transactions or assertions give rise to such risks”.  Paragraph 47 states “if the auditor has concluded that the presumption that there is a risk of material misstatement due to fraud related to revenue recognition is not applicable in the circumstances of the engagement, the auditor shall include in the audit documentation the reasons for that conclusion”. </i></p>
                    <p>It is therefore expected that the risk attributed to Revenue will be high unless there is sufficient justification given to rebut the presumption of high risk. Paragraphs A28 to A30 of the Application and Other Explanatory Material of PSA 240 should be referred to for additional guidance.</p>
                    <p>If the risk of fraud in revenue recognition cannot be rebutted, it is a significant risk (see below).</p>
                    <p><b>Significant risks: </b><br> All risks which are deemed to be significant should be specifically highlighted.  A significant risk is one which would be a “blockbuster”.  A risk may be deemed to be significant for the following reasons:</p>
                    <ul>
                        <li>The risk is a risk of fraud;</li>
                        <li>The risk is related to significant economic, accounting or other developments, and therefore, requiring specific attention;</li>
                        <li>The complexity of transactions;</li>
                        <li>Whether the risk involves significant transactions with related parties;</li>
                        <li>The degree of subjectivity in the measurement of the financial information related to the risk; </li>
                        <li>Whether the risk involves significant transactions (including those with related parties) that are outside the normal course of business; and</li>
                    </ul>
                    <p>Where significant risks have been identified:</p>
                    <ul>
                        <li>At the assertion level, substantive procedures specific to that risk need to be performed;</li>
                        <li>The entity\'s controls relevant to those risks should be understood; </li>
                        <li>They will automatically be deemed to be “high risk”, and other risks will be deemed to be “low risk”.  The “default” risk can (and should) be over-ridden if it is deemed to be appropriate.  Reasons should be fully documented;</li>
                        <li>They will be communicated to the client at the planning stage in the Planning Letter; and</li>
                        <li>How the risk has been addressed during the assignment should be summarized on the PSA Compliance Critical Issues Memorandum.</li>
                    </ul>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                
                $rdata = $rp->getac7($c['code'],$c['c1tID'],'bacdata',$cID,$wpID);
                $bacdata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$bacdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$bacdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$bacdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$bacdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$bacdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$bacdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$bacdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$bacdata['e1'].'</td>
                                <td>'.$bacdata['e2'].'</td>
                                <td>'.$bacdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$bacdata['ro1'].'</td>
                                <td>'.$bacdata['ro2'].'</td>
                                <td>'.$bacdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$bacdata['c1'].'</td>
                                <td>'.$bacdata['c2'].'</td>
                                <td>'.$bacdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$bacdata['va1'].'</td>
                                <td>'.$bacdata['va2'].'</td>
                                <td>'.$bacdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$bacdata['pd1'].'</td>
                                <td>'.$bacdata['pd2'].'</td>
                                <td>'.$bacdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;


                $rdata = $rp->getac7($c['code'],$c['c1tID'],'trdata',$cID,$wpID);
                $trdata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$trdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$trdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$trdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$trdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$trdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$trdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$trdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$trdata['e1'].'</td>
                                <td>'.$trdata['e2'].'</td>
                                <td>'.$trdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$trdata['ro1'].'</td>
                                <td>'.$trdata['ro2'].'</td>
                                <td>'.$trdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$trdata['c1'].'</td>
                                <td>'.$trdata['c2'].'</td>
                                <td>'.$trdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$trdata['va1'].'</td>
                                <td>'.$trdata['va2'].'</td>
                                <td>'.$trdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$trdata['pd1'].'</td>
                                <td>'.$trdata['pd2'].'</td>
                                <td>'.$trdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'ordata',$cID,$wpID);
                $ordata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$ordata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$ordata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$ordata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$ordata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$ordata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$ordata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$ordata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$ordata['e1'].'</td>
                                <td>'.$ordata['e2'].'</td>
                                <td>'.$ordata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$ordata['ro1'].'</td>
                                <td>'.$ordata['ro2'].'</td>
                                <td>'.$ordata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$ordata['c1'].'</td>
                                <td>'.$ordata['c2'].'</td>
                                <td>'.$ordata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$ordata['va1'].'</td>
                                <td>'.$ordata['va2'].'</td>
                                <td>'.$ordata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$ordata['pd1'].'</td>
                                <td>'.$ordata['pd2'].'</td>
                                <td>'.$ordata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'invtrdata',$cID,$wpID);
                $invtrdata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$invtrdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$invtrdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$invtrdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$invtrdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$invtrdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$invtrdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$invtrdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$invtrdata['e1'].'</td>
                                <td>'.$invtrdata['e2'].'</td>
                                <td>'.$invtrdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$invtrdata['ro1'].'</td>
                                <td>'.$invtrdata['ro2'].'</td>
                                <td>'.$invtrdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$invtrdata['c1'].'</td>
                                <td>'.$invtrdata['c2'].'</td>
                                <td>'.$invtrdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$invtrdata['va1'].'</td>
                                <td>'.$invtrdata['va2'].'</td>
                                <td>'.$invtrdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$invtrdata['pd1'].'</td>
                                <td>'.$invtrdata['pd2'].'</td>
                                <td>'.$invtrdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'invmtdata',$cID,$wpID);
                $invmtdata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$invmtdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$invmtdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$invmtdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$invmtdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$invmtdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$invmtdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$invmtdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$invmtdata['e1'].'</td>
                                <td>'.$invmtdata['e2'].'</td>
                                <td>'.$invmtdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$invmtdata['ro1'].'</td>
                                <td>'.$invmtdata['ro2'].'</td>
                                <td>'.$invmtdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$invmtdata['c1'].'</td>
                                <td>'.$invmtdata['c2'].'</td>
                                <td>'.$invmtdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$invmtdata['va1'].'</td>
                                <td>'.$invmtdata['va2'].'</td>
                                <td>'.$invmtdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$invmtdata['pd1'].'</td>
                                <td>'.$invmtdata['pd2'].'</td>
                                <td>'.$invmtdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'ppedata',$cID,$wpID);
                $ppedata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$ppedata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$ppedata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$ppedata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$ppedata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$ppedata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$ppedata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$ppedata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$ppedata['e1'].'</td>
                                <td>'.$ppedata['e2'].'</td>
                                <td>'.$ppedata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$ppedata['ro1'].'</td>
                                <td>'.$ppedata['ro2'].'</td>
                                <td>'.$ppedata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$ppedata['c1'].'</td>
                                <td>'.$ppedata['c2'].'</td>
                                <td>'.$ppedata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$ppedata['va1'].'</td>
                                <td>'.$ppedata['va2'].'</td>
                                <td>'.$ppedata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$ppedata['pd1'].'</td>
                                <td>'.$ppedata['pd2'].'</td>
                                <td>'.$ppedata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'incadata',$cID,$wpID);
                $incadata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$incadata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$incadata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$incadata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$incadata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$incadata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$incadata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$incadata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$incadata['e1'].'</td>
                                <td>'.$incadata['e2'].'</td>
                                <td>'.$incadata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$incadata['ro1'].'</td>
                                <td>'.$incadata['ro2'].'</td>
                                <td>'.$incadata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$incadata['c1'].'</td>
                                <td>'.$incadata['c2'].'</td>
                                <td>'.$incadata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$incadata['va1'].'</td>
                                <td>'.$incadata['va2'].'</td>
                                <td>'.$incadata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$incadata['pd1'].'</td>
                                <td>'.$incadata['pd2'].'</td>
                                <td>'.$incadata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'tpdata',$cID,$wpID);
                $tpdata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$tpdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$tpdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$tpdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$tpdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$tpdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$tpdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$tpdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$tpdata['e1'].'</td>
                                <td>'.$tpdata['e2'].'</td>
                                <td>'.$tpdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$tpdata['ro1'].'</td>
                                <td>'.$tpdata['ro2'].'</td>
                                <td>'.$tpdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$tpdata['c1'].'</td>
                                <td>'.$tpdata['c2'].'</td>
                                <td>'.$tpdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$tpdata['va1'].'</td>
                                <td>'.$tpdata['va2'].'</td>
                                <td>'.$tpdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$tpdata['pd1'].'</td>
                                <td>'.$tpdata['pd2'].'</td>
                                <td>'.$tpdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'opdata',$cID,$wpID);
                $opdata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$opdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$opdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$opdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$opdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$opdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$opdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$opdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$opdata['e1'].'</td>
                                <td>'.$opdata['e2'].'</td>
                                <td>'.$opdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$opdata['ro1'].'</td>
                                <td>'.$opdata['ro2'].'</td>
                                <td>'.$opdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$opdata['c1'].'</td>
                                <td>'.$opdata['c2'].'</td>
                                <td>'.$opdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$opdata['va1'].'</td>
                                <td>'.$opdata['va2'].'</td>
                                <td>'.$opdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$opdata['pd1'].'</td>
                                <td>'.$opdata['pd2'].'</td>
                                <td>'.$opdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'taxdata',$cID,$wpID);
                $taxdata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$taxdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$taxdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$taxdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$taxdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$taxdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$taxdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$taxdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$taxdata['e1'].'</td>
                                <td>'.$taxdata['e2'].'</td>
                                <td>'.$taxdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$taxdata['ro1'].'</td>
                                <td>'.$taxdata['ro2'].'</td>
                                <td>'.$taxdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$taxdata['c1'].'</td>
                                <td>'.$taxdata['c2'].'</td>
                                <td>'.$taxdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$taxdata['va1'].'</td>
                                <td>'.$taxdata['va2'].'</td>
                                <td>'.$taxdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$taxdata['pd1'].'</td>
                                <td>'.$taxdata['pd2'].'</td>
                                <td>'.$taxdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'provdata',$cID,$wpID);
                $provdata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$provdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$provdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$provdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$provdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$provdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$provdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$provdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$provdata['e1'].'</td>
                                <td>'.$provdata['e2'].'</td>
                                <td>'.$provdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$provdata['ro1'].'</td>
                                <td>'.$provdata['ro2'].'</td>
                                <td>'.$provdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$provdata['c1'].'</td>
                                <td>'.$provdata['c2'].'</td>
                                <td>'.$provdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$provdata['va1'].'</td>
                                <td>'.$provdata['va2'].'</td>
                                <td>'.$provdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$provdata['pd1'].'</td>
                                <td>'.$provdata['pd2'].'</td>
                                <td>'.$provdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'roidata',$cID,$wpID);
                $roidata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$roidata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$roidata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$roidata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$roidata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$roidata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$roidata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$roidata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$roidata['e1'].'</td>
                                <td>'.$roidata['e2'].'</td>
                                <td>'.$roidata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$roidata['ro1'].'</td>
                                <td>'.$roidata['ro2'].'</td>
                                <td>'.$roidata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$roidata['c1'].'</td>
                                <td>'.$roidata['c2'].'</td>
                                <td>'.$roidata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$roidata['va1'].'</td>
                                <td>'.$roidata['va2'].'</td>
                                <td>'.$roidata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$roidata['pd1'].'</td>
                                <td>'.$roidata['pd2'].'</td>
                                <td>'.$roidata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'dcodata',$cID,$wpID);
                $dcodata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$dcodata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$dcodata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$dcodata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$dcodata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$dcodata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$dcodata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$dcodata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$dcodata['e1'].'</td>
                                <td>'.$dcodata['e2'].'</td>
                                <td>'.$dcodata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$dcodata['ro1'].'</td>
                                <td>'.$dcodata['ro2'].'</td>
                                <td>'.$dcodata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$dcodata['c1'].'</td>
                                <td>'.$dcodata['c2'].'</td>
                                <td>'.$dcodata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$dcodata['va1'].'</td>
                                <td>'.$dcodata['va2'].'</td>
                                <td>'.$dcodata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$dcodata['pd1'].'</td>
                                <td>'.$dcodata['pd2'].'</td>
                                <td>'.$dcodata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'prdata',$cID,$wpID);
                $prdata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$prdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$prdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$prdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$prdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$prdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$prdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$prdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$prdata['e1'].'</td>
                                <td>'.$prdata['e2'].'</td>
                                <td>'.$prdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$prdata['ro1'].'</td>
                                <td>'.$prdata['ro2'].'</td>
                                <td>'.$prdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$prdata['c1'].'</td>
                                <td>'.$prdata['c2'].'</td>
                                <td>'.$prdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$prdata['va1'].'</td>
                                <td>'.$prdata['va2'].'</td>
                                <td>'.$prdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$prdata['pd1'].'</td>
                                <td>'.$prdata['pd2'].'</td>
                                <td>'.$prdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $rdata = $rp->getac7($c['code'],$c['c1tID'],'oadata',$cID,$wpID);
                $oadata = json_decode($rdata['question'], true);
                $html .= '<h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>';
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$oadata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$oadata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$oadata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$oadata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$oadata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$oadata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$oadata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$oadata['e1'].'</td>
                                <td>'.$oadata['e2'].'</td>
                                <td>'.$oadata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$oadata['ro1'].'</td>
                                <td>'.$oadata['ro2'].'</td>
                                <td>'.$oadata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$oadata['c1'].'</td>
                                <td>'.$oadata['c2'].'</td>
                                <td>'.$oadata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$oadata['va1'].'</td>
                                <td>'.$oadata['va2'].'</td>
                                <td>'.$oadata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$oadata['pd1'].'</td>
                                <td>'.$oadata['pd2'].'</td>
                                <td>'.$oadata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC8':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : ASSESSMENT OF MATERIALITY',1,1);
                $html .= $style;
                $html .= $c['code'];
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 60%;">
                                <table>
                                    <tr><td></td></tr>
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
                                        <td>A.E.P. Approval: <br></td>
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
                
                $space = $pdf->Ln(10);
                $html .= '<h3>ASSESSMENT OF MATERIALITY (INCLUDING PERFORMANCE MATERIALITY)</h3>';
                $html .= '
                    <p><b>OBJECTIVE: </b> To assess materiality for the financial statements as a whole, performance materiality and other quantitative benchmarks based on materiality, which will reduce the risk of material misstatements in the financial statements to an acceptable level.</p> 
                    <p><b>OVERALL MATERIALITY</b></p>
                ';

                $rowdata = [
                    'revp','revf','prop','prof','grop','grof','revpr','revfr','propr','profr','gropr','grofr','pcu','fcu','adjap','adjbp','adjcp','adjaf','adjbf','adjcf',
                    'aomp','aomf','justn45','pcur','fcur','mlpinfo','conplst','confnst','oirp','oirf','pmpp','pmpf','apmp','apmf','conplst2','confnst2',
                    'rsp','confnst','ctp','ctf','aest','aestp','aestf','rptp','rptf',
                    'itbd1','itbd1p','itbd1f','itbd2','itbd2p','itbd2f','itbd3','itbd3p','itbd3f','adja','adjb','adjc','itbdae1','itbdae2','itbdae3'
                ];
                foreach($rowdata as $row){
                    $data[$row] = $rp->getac8($c['code'],$c['c1tID'],$row,$cID,$wpID);
                }
                switch ($data['pcu']['question']) {
                    case 'r'    :   $pcupp = 'Revenue';break;
                    case 'pbt'  :   $pcupp = 'Profit Before Tax';break;
                    case 'ga'   :   $pcupp = 'Gross Assets';break;
                    case 'se'   :   $pcupp = 'Something Else';break;
                    default     :   $pcupp = 'Select from Planning';break;
                }
                switch ($data['fcu']['question']) {
                    case 'r'    :   $fcuff = 'Revenue';break;
                    case 'pbt'  :   $fcuff = 'Profit Before Tax';break;
                    case 'ga'   :   $fcuff = 'Gross Assets';break;
                    case 'se'   :   $fcuff = 'Something Else';break;
                    default     :   $fcuff = 'Select from Planning';break;
                }
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th class="cent" style="width: 25%;"><b>Benchmarks</b></th>
                                <th class="cent"><b>Planning CU</b></th>
                                <th class="cent"><b>Finalisation CU</b></th>
                                <th class="cent" style="width: 8%;"><b>%</b></th>
                                <th class="bo cent"><b>Planning CU</b></th>
                                <th class="bo cent"><b>Finalisation CU</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Revenue</td>
                                <td class="bo cent">'.$data['revp']['question'].'</td>
                                <td class="bo cent">'.$data['revf']['question'].'</td>
                                <td class="cent" style="width: 8%;">1%</td>
                                <td class="bo cent">'.$data['revpr']['question'].'</td>
                                <td class="bo cent">'.$data['revfr']['question'].'</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Profit Before Tax 2</td>
                                <td class="bo cent">'.$data['prop']['question'].'</td>
                                <td class="bo cent">'.$data['prof']['question'].'</td>
                                <td class="cent" style="width: 8%;">10%</td>
                                <td class="bo cent">'.$data['propr']['question'].'</td>
                                <td class="bo cent">'.$data['profr']['question'].'</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Gross Assets</td>
                                <td class="bo cent">'.$data['grop']['question'].'</td>
                                <td class="bo cent">'.$data['grof']['question'].'</td>
                                <td class="cent" style="width: 8%;">2%</td>
                                <td class="bo cent">'.$data['gropr']['question'].'</td>
                                <td class="bo cent">'.$data['grofr']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Select the most appropriate benchmark for this entity</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$pcupp.'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$fcuff.'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>JUSTIFY THE USE OF THE BENCHMARK SELECTED ABOVE (Notes 4 and 5) </b></p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$data['justn45']['question'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Initial suggested Materiality Level:</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="cent" style="width: 16.75%;">'.$data['pcur']['question'].'</td>
                                <td class="cent" style="width: 16.75%;">'.$data['fcur']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td colspan="3"><p>If any adjustments are required to initial materiality level, detail these here (Note 6) :</p></td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">a) '.$data['adja']['question'].'</td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['adjap']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['adjaf']['question'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">b) '.$data['adjb']['question'].'</td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['adjbp']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['adjbf']['question'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">c) '.$data['adjc']['question'].'</td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['adjcp']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['adjcf']['question'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"><p><i>NB: adjustments need to be mutiplied by the appropriate benchmark percentage</i></p></td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Assessed Overall Materiality</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['aomp']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['aomf']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p>Materiality Level for previous period (for information only):</p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 33.5%;">'.$data['mlpinfo']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Conclusion at planning stage</b> <br>The overall materiality level calculated above is deemed to be appropriate because:</p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$data['conplst']['question'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Conclusion at finalisation stage</b><br>Document reasons for any revision to the materiality assessed at planning stage and the impact on the audit procedures undertaken:</p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$data['confnst']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>PERFORMANCE MATERIALITY</b></p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Select Overall Inherent Risk (Low / Medium / High):</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['oirp']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['oirf']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;">Performance Materiality Percentage (Note 7):</td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['pmpp']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['pmpf']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>   
                    <p><i>NB: If a percentage has been applied which differs from that suggested by the methodology, document the reasons for this in the conclusion box below.</i></p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Assessed Performance Materiality</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['apmp']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['apmf']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>  
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Conclusion at planning stage</b><br>The performance materiality level calculated above is deemed to be appropriate because:</p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$data['conplst2']['question'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Conclusion at finalisation stage</b><br>Document reasons for any revision to the perfomance materiality assessed at planning stage and the impact on the audit procedures undertaken:</p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$data['confnst2']['question'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>CLEARLY TRIVIAL</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 58.5%;"></th>
                                <th style="width: 8%;"><b>%</b></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;">Level at which errors are considered trivial (Note 8)</td>
                                <td style="width: 8%;">1%</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['ctp']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['ctf']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Document reasons for any revision to the suggested percentage</b></p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$data['rsp']['question'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>

                    <p><b>SPECIFIC PERFORMANCE MATERIALITY LEVELS FOR CLASSES OF TRANSACTIONS, ACCOUNT BALANCES OR DISCLOSURES (Notes 9 and 10):</b></p>
                    <p>Factors that may indicate the existence of one or more particular classes of transactions, account balances or disclosures for which a lower level of materiality should be applied include the following:</p>
                    <ol type="a">
                        <li>Related party transactions and compensation of key management personnel;</li>
                        <li>Key disclosures in relation to the industry in which the entity operates;</li>
                        <li>Particular focus on specific disclosures (such as business combinations);</li>
                        <li>Accounting estimates.</li>
                    </ol>        
                    <p>Document below the materiality levels to be applied to the relevant classes of transactions, account balances or disclosures. <br>The auditor may find it useful to get the views and expectations of the client here. <br><b>Other levels of performance materiality to be applied:</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 58.5%;"></th>
                                <th style="width: 8%;">%</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;">Related party transactions and Remuneration of key management</td>
                                <td style="width: 8%;">5%</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['rptp']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['rptf']['question'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">Accounting estimates</td>
                                <td style="width: 8%;">'.$data['aest']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['aestp']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['aestf']['question'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">'.$data['itbdae1']['question'].'</td>
                                <td style="width: 8%;">'.$data['itbd1']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['itbd1p']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['itbd1f']['question'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">'.$data['itbdae2']['question'].'</td>
                                <td style="width: 8%;">'.$data['itbd2']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['itbd2p']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['itbd2f']['question'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">'.$data['itbdae3']['question'].'</td>
                                <td style="width: 8%;">'.$data['itbd3']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['itbd3p']['question'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$data['itbd3f']['question'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Definition per PSA 320.9:</b><br>Performance materiality - For the purposes of the ISAs, performance materiality means the amount or amounts set by the auditor at less than materiality for the financial statements as a whole to reduce to an acceptably low level the probability that the aggregate of uncorrected and undetected misstatements exceeds materiality for the financial statements as a whole.  If applicable, performance materiality also refers to the amount or amounts set by the auditor at less than the materiality level or levels for particular classes of transactions, account balances or disclosures.</p>
                    <p><b>Guidance and Notes:</b></p>
                    <ol>
                        <li>Blue cells require user input</li>
                        <li>Use absolute figures (i.e. if there is a loss before tax, use this as a positive figure)</li>
                        <li>At the planning stage use management accounts, flexed budgets or last period\'s figures if current figures are not available.</li>
                        <li>The auditor must document the factors considered in the determination of materiality as a whole, performance materiality and, if applicable, the materiality level(s) for particular classes of transactions, account balances or disclosures. The determining of materiality involves the use of professional judgement, therefore the auditor must be able to justify the chosen benchmark used as a starting point in determining materiality. See PSA 320.A3 for guidance. 
                            <br>For example: for a trading company where the Directors are focused on profit, profit before tax may be the most relevant benchmark to use. For an investment property company, it is likely that the gross assets figure would be the most appropriate benchmark. For service companies, cost-plus entities or not-for-profit entities, it is likely that revenue will be the most appropriate benchmark. 
                            <br>If the most relevant benchmark for an entity is volatile year on year, such that using that benchmark would result in incomparable materiality figures year on year, other benchmarks may be considered to be more appropriate.
                        </li>
                        <li>The percentages applied to a chosen benchmark are also a matter of professional judgement. If the suggested percentages noted above are inappropriate, amend them as necessary.</li>
                        <li>Adjust for any anomalies that may affect materiality.  For example, for an owner-managed business where the owner takes much of the profit before tax in the form of remuneration, "adding back" the owner\'s remuneration to the profit before taxation figure would provide a more relevant benchmark to be used in the materiality calculation.</li>
                        <li>It is recommended that a level of 75% of audit materiality is used to determine performance materiality when overall inherent risk is low, 62.5% when overall inherent risk is medium and 50% when overall inherent risk is high (see definition above).  Percentages </li>
                        <li>"Clearly trivial"  errors do not need to be accumulated.  These items are clearly inconsequential, whether taken individually or in aggregate, whether judged by size, nature or circumstances.  It is suggested that 1% of audit materiality is used to determine a level at which items are deemed to be clearly trivial, but a different percentage can be used if deemed to be more appropriate and is adequately justified. 
                            <br>However, misstatements relating to amounts may not be clearly trivial when judged on criteria of nature or circumstance. If this is the case, the misstatements should be accumulated as unadjusted errors.
                        </li>
                        <li>For "sensitive" disclosures, such as those relating to share capital, directors\' remuneration and related party transactions, amounts which are disclosed in the financial statements should be correct.  It is recommended that that "allowable misstatements" relating to any related party matter are set at 5% of audit materiality.  It is permissible for different thresholds may be set, but these should be appropriate in the context.  Additional thresholds may also be set for other classes of transactions, account balances or disclosures, which should be fully documented, but may not exceed the level of performance materiality.  In each case, the percentage of audit materiality applied should be stated.</li>
                        <li>The accuracy of accounting estimates needs to be established.  Estimates are "soft" figures in financial statements, and as such, have a level of risk attached to them.  The level of estimation uncertainty for accounting estimates should be documented and should be set at a level lower than performance materiality.</li>
                        <li>Document reasons for not using a materiality level based on the amounts calculated, reasons for setting different levels for individual items in the financial statements and reasons why the final materiality level differs from the planning materiality level.</li>
                    </ol>
                    ';


                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC9':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : APPROVAL OF PLANNING',1,1);
                $html .= $style;
                $html .= $c['code'];
                
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

                $rdata = $rp->getac9data($c['code'],$c['c1tID'],$cID,$wpID);
                $ac9= json_decode($rdata['question'], true);
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <b><p>CONSIDERATION OF SPECIFIC SKILLS REQUIRED FOR THIS ASSIGNMENT</p>
                                    <p>(SHOULD COVER ALL MEMBERS OF THE TEAM OTHER THAN JUNIORS, INCLUDING THE EQR)</p></b>
                                    <br><br><br><br>
                                    <p>'.$ac9['coss'].'</p>
                                    <br><br><br><br><br>
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
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <p><b>BACKGROUND INFORMATION</b></p>
                                    <p>Detailed background information is included in the permanent file, the below information is just a short executive summary.</p>
                                    <p>The entity is a company [other: insert details].</p>
                                    <p>The principal activities of the entity are ['.$ac9['bipa'].'].  </p>
                                    <p>The business objectives and strategies of the entity are ['.$ac9['bibo'].'].</p>
                                    <br><br><br><br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <p><b>SIGNIFICANT FACTORS FROM PREVIOUS AUDIT AND IMPACT ON THIS PERIOD’S AUDIT</b></p>
                                    <ul>
                                        <li>Last period’s financial statements have been compared to this period’s, as part of the preliminary analytical procedures;</li>
                                        <li>If applicable, the findings of recent cold file reviews have been addressed by the planning documentation; and</li>
                                        <li>If applicable, last period’s management letter points have been reviewed and any points have been considered during this period’s risk assessment and audit approach.</li>
                                    </ul>
                                    <br><br><br>
                                    '.$ac9['sffpa'].'
                                    <br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <p><b>SUMMARY OF SIGNIFICANT DEVELOPMENTS DURING THE PERIOD (consideration should be given to any changes in the financial reporting framework used, as well as client specific developments.  The findings from the review of the previous audit file, PAF and other internal files such as the correspondence file, management accounts files, payroll files etc. should all be summarised)</b></p>
                                    <p><i>This should not repeat information included elsewhere.</i></p>
                                    <br><br><br>
                                    '.$ac9['sosdd'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td><p><b>KEY LAW AND REGULATIONS</b></p>
                                    <p><i>This should be an “Executive Summary”</i></p>
                                    <br><br><br>
                                    '.$ac9['klar'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td><p><b>RELATED PARTY ISSUES (Consideration should be given to any new related parties which have been identified, significant related party transactions and transfer pricing issues)</b></p>
                                    <p><i>This should be an “Executive Summary”</i></p>
                                    <br><br><br>
                                    '.$ac9['rpi'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td><p><b>SERVICE ORGANISATION AND EXPERTS (Consideration should be given to whether any of the figures in the financial statements are derived from the records of a service organisation or from an expert (such as a valuation service).  Where this is a case, document the audit team’s approach to these areas)</b></p>
                                    <br><br><br>
                                    '.$ac9['soae'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <p><b>AUDIT APPROACH</b></p>
                                    <p>This section should fully document the approach to be undertaken based on preliminary analytical procedures, client discussions and the risk and control environment assessments.  </p>
                                    <p>Adequate consideration has been given to experts and service organisations.</p>
                                    <p>The audit programmes to be used and key points arising during the planning are summarised below, as are the responsibilities of each team member regarding which work they are going to undertake.</p>
                                    <br><br><br>
                                    '.$ac9['aa1'].'
                                    <br><br><br><br>
                                    <p>Have the points raised above (and the risks identified in the risk assessment) been duly considered and the audit programmes sufficiently tailored to reflect these issues?</p>
                                    <br><br><br><br>
                                    '.$ac9['aa2'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
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
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
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


                
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC10':
                $pdf->AddPage('L');
                $pdf->Bookmark($c['code'].' : AUDIT APPROACH AND SAMPLE SIZE CALCULATION',1,1);
                $html .= $style;
                $html .= $c['code'];
                
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

                $html .= '<p><b>AUDIT APPROACH AND SAMPLE SIZE CALCULATION</b></p>';
                $html .= ' <p><i>To complete the table below enter the risk level as per Ac6 and the materiality level as documented at Ac8. Where a different risk level is relevant for different assertions the table can be expanded as indicated on the lefthand margin. The audit approach should be selected by entering \'Y\' or \'N\' as appropriate. Where sampling is not required under the approach selected the remainder of the row will be greyed out. 
                    <br>Where substantive testing is to be undertaken document whether this will be supported by controls testing or supportive analytical procedures. For each area, enter the population and any large or key items on the appropriate supporting schedule. The residual sample size will then be automatically calculated by dividing the residual population (after large and key items) by materiality and multiplying this by the risk factor which is determined by the audit approach as documented on the reference table below.
                    <br>Where transaction testing is to be undertaken select the approximate number of transactions from the drop down. This together with the risk level entered will calculate the appropriate sample size, again based on the information on the reference table below.
                </i></p> ';
                $html .= '
                <table border="1">
                    <thead>
                        <tr class="cent">
                            <th colspan="3" style="width: 27%;"></th>
                            <th colspan="5" style="width: 25%;">A</th>
                            <th style="width: 5%;">B</th>
                            <th style="width: 5%;">C</th>
                            <th style="width: 35%;" colspan="5"></th>
                        </tr>
                        <tr class="cent">
                            <th colspan="8" style="width: 52%;">General</th>
                            <th colspan="7" style="width: 35%;">Substantive</th>
                            <th colspan="2" style="width: 10%;">Transaction</th>
                        </tr>
                        <tr>
                            <th style="width: 10%;">Audit Area</th>
                            <th style="width: 10%;">Audit Assertion (1) (Expand if different risks apply to different assertions)</th>
                            <th style="width: 7%;" class="cent">Risk per Ac10</th>
                            <th style="width: 5%;" class="cent">I</th>
                            <th style="width: 5%;" class="cent">P</th>
                            <th style="width: 5%;" class="cent">%</th>
                            <th style="width: 5%;" class="cent">S</th>
                            <th style="width: 5%;" class="cent">T</th>
                            <th style="width: 5%;">Tests of control  # (2) @</th>
                            <th style="width: 5%;">Supportive analytical procedures #</th>
                            <th style="width: 5%;">Risk factor (as below)</th>
                            <th style="width: 5%;">Value of population after large and key items</th>
                            <th style="width: 5%;">Section Ref</th>
                            <th style="width: 5%;">Residual sample size</th>
                            <th style="width: 5%;">No of material / key items to be tested </th>
                            <th style="width: 5%;">Approximate number of transactions</th>
                            <th style="width: 5%;">Transaction sample size from table B</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                ';

                $nmk_tgb    = $rp->getdatacount($c['c1tID'],'Tangibles',$cID,$wpID);
                $nmk_ppe    = $rp->getdatacount($c['c1tID'],'PPE',$cID,$wpID);
                $nmk_invmt  = $rp->getdatacount($c['c1tID'],'Investments',$cID,$wpID);
                $nmk_invtr  = $rp->getdatacount($c['c1tID'],'Inventory',$cID,$wpID);
                $nmk_tr     = $rp->getdatacount($c['c1tID'],'Trade Receivables',$cID,$wpID);
                $nmk_or     = $rp->getdatacount($c['c1tID'],'Other Receivables',$cID,$wpID);
                $nmk_bac    = $rp->getdatacount($c['c1tID'],'Bank and Cash',$cID,$wpID);
                $nmk_tp     = $rp->getdatacount($c['c1tID'],'Trade Payables',$cID,$wpID);
                $nmk_op     = $rp->getdatacount($c['c1tID'],'Other Payables',$cID,$wpID);
                $nmk_prov   = $rp->getdatacount($c['c1tID'],'Provisions',$cID,$wpID);
                $nmk_rev    = $rp->getdatacount($c['c1tID'],'Revenue',$cID,$wpID);
                $nmk_cst    = $rp->getdatacount($c['c1tID'],'Costs',$cID,$wpID);
                $nmk_pr     = $rp->getdatacount($c['c1tID'],'Payroll',$cID,$wpID);
                $vop_tgb    = $rp->getsumation($c['c1tID'],'Tangibles',$cID,$wpID);
                $vop_ppe    = $rp->getsumation($c['c1tID'],'PPE',$cID,$wpID);
                $vop_invmt  = $rp->getsumation($c['c1tID'],'Investments',$cID,$wpID);
                $vop_invtr  = $rp->getsumation($c['c1tID'],'Inventory',$cID,$wpID);
                $vop_tr     = $rp->getsumation($c['c1tID'],'Trade Receivables',$cID,$wpID);
                $vop_or     = $rp->getsumation($c['c1tID'],'Other Receivables',$cID,$wpID);
                $vop_bac    = $rp->getsumation($c['c1tID'],'Bank and Cash',$cID,$wpID);
                $vop_tp     = $rp->getsumation($c['c1tID'],'Trade Payables',$cID,$wpID);
                $vop_op     = $rp->getsumation($c['c1tID'],'Other Payables',$cID,$wpID);
                $vop_prov   = $rp->getsumation($c['c1tID'],'Provisions',$cID,$wpID);
                $vop_rev    = $rp->getsumation($c['c1tID'],'Revenue',$cID,$wpID);
                $vop_cst    = $rp->getsumation($c['c1tID'],'Costs',$cID,$wpID);
                $vop_pr     = $rp->getsumation($c['c1tID'],'Payroll',$cID,$wpID);
                $mat        = $rp->getsummarydata($c['c1tID'],'material',$cID,$wpID);
                $rowdata            = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];
                foreach($rowdata as $row){
                    $rdata          = $rp->getsummarydata($c['c1tID'], $row,$cID,$wpID);
                    $data[$row]     = json_decode($rdata['question'], true);
                }

                $html .='
                        <tr>
                            <td style="width: 10%;">Intangible Assets</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['tgb']['tgb_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_i'].'</td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_p'].'</td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_s'].'</td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['tgb']['tgb_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['tgb']['tgb_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_rf'].'</td>
                            <td style="width: 5%;">'.$vop_tgb.'</td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_secref'].'</td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_tgb.'</td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_ant'].'</td>
                            <td style="width: 5%;">'.$data['tgb']['tgb_tss'].'</td>
                        </tr>';
                $html .='
                        <tr>
                            <td style="width: 10%;">PPE</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['ppe']['ppe_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_i'].'</td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_p'].'</td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_s'].'</td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['ppe']['ppe_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['ppe']['ppe_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_rf'].'</td>
                            <td style="width: 5%;">'.$vop_ppe.'</td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_secref'].'</td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_ppe.'</td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_ant'].'</td>
                            <td style="width: 5%;">'.$data['ppe']['ppe_tss'].'</td>
                        </tr>';
                        $html .='
                        <tr>
                            <td style="width: 10%;">Investments</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['invmt']['invmt_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_i'].'</td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_p'].'</td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_s'].'</td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['invmt']['invmt_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['invmt']['invmt_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_rf'].'</td>
                            <td style="width: 5%;">'.$vop_invmt.'</td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_secref'].'</td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_invmt.'</td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_ant'].'</td>
                            <td style="width: 5%;">'.$data['invmt']['invmt_tss'].'</td>
                        </tr>';
                        $html .='
                        <tr>
                            <td style="width: 10%;">Inventories</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['invtr']['invtr_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_i'].'</td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_p'].'</td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_s'].'</td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['invtr']['invtr_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['invtr']['invtr_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_rf'].'</td>
                            <td style="width: 5%;">'.$vop_invtr.'</td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_secref'].'</td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_invtr.'</td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_ant'].'</td>
                            <td style="width: 5%;">'.$data['invtr']['invtr_tss'].'</td>
                        </tr>';
                        $html .='
                        <tr>
                            <td style="width: 10%;">Trade Receivables</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['tr']['tr_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['tr']['tr_i'].'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_p'].'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_s'].'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['tr']['tr_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['tr']['tr_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['tr']['tr_rf'].'</td>
                            <td style="width: 5%;">'.$vop_tr.'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_secref'].'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_tr.'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_ant'].'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_tss'].'</td>
                        </tr>';
                        $html .='
                        <tr>
                            <td style="width: 10%;">All Other Receivables</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['or']['or_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['or']['or_i'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_p'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_s'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['or']['or_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['or']['or_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['or']['or_rf'].'</td>
                            <td style="width: 5%;">'.$vop_or.'</td>
                            <td style="width: 5%;">'.$data['or']['or_secref'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_or.'</td>
                            <td style="width: 5%;">'.$data['or']['or_ant'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_tss'].'</td>
                        </tr>';
                        $html .='
                        <tr>
                            <td style="width: 10%;">Bank and Cash</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['bac']['bac_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['bac']['bac_i'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_p'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_s'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['bac']['bac_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['bac']['bac_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['bac']['bac_rf'].'</td>
                            <td style="width: 5%;">'.$vop_bac.'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_secref'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_bac.'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_ant'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_tss'].'</td>
                        </tr>';
                        $html .='
                        <tr>
                            <td style="width: 10%;">Trade Payables</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['tp']['tp_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['tp']['tp_i'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_p'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_s'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['tp']['tp_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['tp']['tp_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['tp']['tp_rf'].'</td>
                            <td style="width: 5%;">'.$vop_tp.'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_secref'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_tp.'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_ant'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_tss'].'</td>
                        </tr>';
                        $html .='
                        <tr>
                            <td style="width: 10%;">All Other Payables</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['op']['op_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['op']['op_i'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_p'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_s'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['op']['op_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['op']['op_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['op']['op_rf'].'</td>
                            <td style="width: 5%;">'.$vop_op.'</td>
                            <td style="width: 5%;">'.$data['op']['op_secref'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_op.'</td>
                            <td style="width: 5%;">'.$data['op']['op_ant'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_tss'].'</td>
                        </tr>';
                $html .='
                        <tr>
                            <td style="width: 10%;">Provisions</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['prov']['prov_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['prov']['prov_i'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_p'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_s'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['prov']['prov_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['prov']['prov_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['prov']['prov_rf'].'</td>
                            <td style="width: 5%;">'.$vop_prov.'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_secref'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_prov.'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_ant'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_tss'].'</td>
                        </tr>';
                $html .= '<tr>
                            <td colspan="17"></td>
                    </tr>';
                $html .='
                        <tr>
                            <td style="width: 10%;">Revenue</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['rev']['rev_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['rev']['rev_i'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_p'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_s'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['rev']['rev_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['rev']['rev_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['rev']['rev_rf'].'</td>
                            <td style="width: 5%;">'.$vop_rev.'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_secref'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_rev.'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_ant'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_tss'].'</td>
                        </tr>';
                        $html .='
                        <tr>
                            <td style="width: 10%;">Costs</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['cst']['cst_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['cst']['cst_i'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_p'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_s'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['cst']['cst_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['cst']['cst_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['cst']['cst_rf'].'</td>
                            <td style="width: 5%;">'.$vop_cst.'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_secref'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_cst.'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_ant'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_tss'].'</td>
                        </tr>';
                $html .='
                        <tr>
                            <td style="width: 10%;">Payroll</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['pr']['pr_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['pr']['pr_i'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_p'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_s'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['pr']['pr_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">';
                                switch ($data['pr']['pr_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                $html .='   </td>
                            <td style="width: 5%;">'.$data['pr']['pr_rf'].'</td>
                            <td style="width: 5%;">'.$vop_pr.'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_secref'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_pr.'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_ant'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_tss'].'</td>
                        </tr>';
                $html .='
                    </tbody>   
                </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <ol>
                        <li>Risk must be assessed for each area at assertion level.  If for an area, all assertions have the same risk use the "all" line. However, if there are different levels of risks then the various assertion rows should be expanded in each area as relevant. At the testing stage the key assertions are occurrence, completeness, accuracy, cut off and classification for transactions and existence, rights and obligations, completeness, valuation and allocation and disclosure for balances.</li>
                        <li>If testing controls then the operating effectiveness of the non critical controls must be tested at least every three years to ensure that they are effective, all critical controls should still be tested annually.  Walkthrough tests should be carried out every year to ensure that controls have not changed.</li>
                        <li>It will usually only be appropriate to test controls where they are expected to be effective therefore a low risk sample size should be used.</li>
                    </ol>
                    <p><b>Reference Table</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th rowspan="4">Reference Table</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Balance Sheet</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Profit or Loss</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Audit Approach</th>
                                <th></th>
                                <th></th>
                                <th>Risk Level</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Risk Level</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>H</th>
                                <th>M</th>
                                <th>L</th>
                                <th>Population</th>
                                <th>H</th>
                                <th>M</th>
                                <th>L</th>
                            </tr>
                            <tr>
                                <th>Approach</th>
                                <th>Control</th>
                                <th>AR</th>
                                <th>Risk Factor</th>
                                <th></th>
                                <th></th>
                                <th>Size</th>
                                <th>Risk Factor</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="11">Method of obtaining audit evidence</td>
                                <td>I,P,%</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td></td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                            </tr>
                            <tr>
                                <td>S**</td>
                                <td>No</td>
                                <td>No</td>
                                <td>2.5</td>
                                <td>1.8</td>
                                <td>1.2</td>
                                <td></td>
                                <td>1.2</td>
                                <td>0.9</td>
                                <td>0.6</td>
                            </tr>
                            <tr>
                                <td>S**</td>
                                <td>Yes</td>
                                <td>No</td>
                                <td>1.3</td>
                                <td>0.9</td>
                                <td>0.4</td>
                                <td></td>
                                <td>0.4</td>
                                <td>0.3</td>
                                <td>0.2</td>
                            </tr>
                            <tr>
                                <td>S**</td>
                                <td>No</td>
                                <td>Yes</td>
                                <td>1.7</td>
                                <td>1.2</td>
                                <td>0.8</td>
                                <td></td>
                                <td>0.8</td>
                                <td>0.6</td>
                                <td>0.4</td>
                            </tr>
                            <tr>
                                <td>S**</td>
                                <td>Yes</td>
                                <td>Yes</td>
                                <td>0.9</td>
                                <td>0.6</td>
                                <td>0.4</td>
                                <td></td>
                                <td>0.4</td>
                                <td>0.3</td>
                                <td>0.2</td>
                            </tr>
                            <tr>
                                <td colspan="10">Sample Sizes**</td>
                            </tr>
                            <tr>
                                <td>T / C</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>> 401</td>
                                <td>60+</td>
                                <td>40</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>T / C</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>226-400</td>
                                <td>48+</td>
                                <td>32</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>T / C</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>101-225</td>
                                <td>36+</td>
                                <td>24</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>T / C</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>26-100</td>
                                <td>24+</td>
                                <td>16</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>T / C</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>1-25</td>
                                <td>12+</td>
                                <td>8</td>
                                <td>5</td>
                            </tr>
                        </tbody>
                </table>
                    <p><b>Key</b></p>
                    <p>
                        I - Less than performance materiality <br>
                        P - Proof in total (extensive analytical procedures) <br>
                        % - 100% testing <br>
                        S - Substantive sampling <br>
                        T - Transaction testing <br>
                        # - If a yes is recorded in either column B or C then suitable testing must be undertaken and the validity of this response must be reviewed at the end of the fieldwork and it must be cross referenced to supporting working papers <br>
                        @ - It is only possible to record a yes in this column if controls have been tested, and they are effective.  If the controls are ineffective, a no must be recorded in this column.  This column may be completed with a yes at the planning stage if it is intended to test controls. <br>
                        C - Tests of control <br>
                        ** - When performing substantive procedures, the number of items selected from the residual population (after testing all "large" / "key" items) may be capped at the levels noted for transaction / control testing.
                    </p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC11':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : TEAM DISCUSSIONS AND BRIEFING MEETING',1,1);
                $html .= $style;
                $html .= $c['code'];
                
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
                        </tr>
                    </table>
                ';
                $rdata = $rp->getac11data($c['code'],$c['c1tID'],$cID,$wpID);
                $ac11 = json_decode($rdata['question'], true);
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

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
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

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

        }
        
    }

    /**
        ----------------------------------------------------------
        CHAPTER 2 PDF GENERATOR
        ---------------------------------------------------------- 
    */

    $pdf->AddPage('P');
    $pdf->Bookmark('Chapter 2 : Detailed Procedure',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:navy;text-align:center;">CHAPTER 2: DETAILED PROCEDURE</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';
    foreach($c2 as $c){
        switch ($c['code']) {
            case '2.1 B2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : INTANGIBLE NON-CURRENT ASSETS AND GOODWILL',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';

                $html .= '<h3>INTANGIBLE NON-CURRENT ASSETS AND GOODWILL</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.2.1 C2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PROPERTY, PLANT AND EQUIPMENT',1,1);
                $html .= $style;
                $html .= $c['code'];
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>PROPERTY, PLANT AND EQUIPMENT</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
               
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.2.2 C2-1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PROPERTY, PLANT AND EQUIPMENT – TOP UP PROGRAMME',1,1);
                $html .= $style;
                $html .= $c['code'];
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>PROPERTY, PLANT AND EQUIPMENT – TOP UP PROGRAMME</h3>';
                $html .= '
                        <p>This programme includes “top up” tests to be completed when the entity has the following:</i></p>
                        <ul>
                            <li><i>Leased assets</i></li>
                            <li><i>Assets financed by capital grants</i></li>
                        </ul>
                    <p><b>SPECIFIC AREA 1 – LEASED ASSETS </b></p>
                    <p><i>IFRS 16 ‘Leases’ is a brand-new Standard and is mandatory for accounting periods commencing on/after 1 January 2019. </i></p>
                    <p><i>IFRS 16 fundamentally affects the way in which <u><b>lessees</b></u> account for leases; all leases (except those which are short term (i.e. 12 months or less) or those for which the underlying asset is of low value) now result in the recognition of a “right of use” asset and a corresponding lease liability. </i></p>
                    <p><i>There are a couple of specific areas where lessors are affected by IFRS 16; sale and leaseback transactions and where the lessor is an intermediate lessor. </i></p>
                    <p><i>First time adoption of IFRS 16 requires transition adjustments. The entity has a choice over the transition method adopted:</i></p>
                    <ul>
                        <li>full retrospective restatement (i.e. restate comparatives in line with the IFRS 16 requirements), subject to some practical expedients; or</li>
                        <li>a “cumulative catch up”, where opening retained earnings are adjusted to account for the IFRS 16 impact, but the comparatives are unaffected.</li>
                    </ul>
                    <p><i>Audit work will be required on the transition adjustments made. </i></p>
                    <p><i>Auditors must read IFRS 16, the accompanying application guidance (Appendix B of IFRS 16) and the transition requirements (Appendix C of IFRS 16) to gain a full understanding of the accounting requirements. </i></p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    ';
               
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.3 D2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : INVESTMENTS',1,1);
                $html .= $style;
                $html .= $c['code'];
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>INVESTMENTS</h3>';
                $html .= '
                    <p><i>This programme <b><u>does not</u></b>  include tests relating to investment properties. These tests are included on the C audit programme.</i></p>
                    <p><i>Tests on this programme relate solely to listed and non-listed equity instruments.  Where investments are debt instruments the appropriate tests on the F audit programme should be completed. If an entity has physical investments, such as wine, works of art or commodities such as precious metals, it would seem appropriate that these are carried at fair value. Tests 16 and 18 to 23 could be completed when auditing such investments</i></p>
                    <p><i>This programme does not cover complex financial instruments: interest rates swaps are addressed on the I audit programme and forward exchange contracts are addressed on the L audit programme. If the entity has other types of complex financial instrument then additional tests must be added to an appropriate audit programme.</i></p>
                    ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
                
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.4.1 E2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : INVENTORIES',1,1);
                $html .= $style;
                $html .= $c['code'];
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>INVENTORIES</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.4.2 E2-1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : INVENTORY APPENDIX 1 – INVENTORY COUNT PLANNING',1,1);
                $html .= $style;
                $html .= $c['code'];
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    ';
                $html .= '<h3>INVENTORY APPENDIX 1 – INVENTORY COUNT PLANNING</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Tests – Attendance at Inventory Count – Planning Procedures Prior to Attending </b></th>
                                <th class="cent bo" style="width: 36%;"><b>Comments/Reference</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $aicpppa = $rp->getquestionsaicpppa($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($aicpppa as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 36%;">'.$r['reference'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <center><p><b>Review of client’s inventory count procedures</b></p></center>
                    <p>This review should be completed before attending the client’s inventory count in conjunction with a copy of the client’s inventory count instructions.  Section 1 deals with overall controls, and sections 2 to 4 with inventory count instructions and procedures, section 5 covers inventory counts performed by independent inventory counters and section 6 covers clients that operate a cyclical inventory count system.</p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 66%;"><b>Do the inventory count procedures cover:</b></th>
                                <th class="cent bo" style="width: 18%;"><b>Yes/No/N/A</b></th>
                                <th class="cent bo" style="width: 18%;"><b>Comments/<br>Reference</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $rcicp = $rp->getquestionsrcicp($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($rcicp as $r){
                            $html .= '
                            <tr>
                                <td style="width: 66%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 18%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 18%;">'.$r['reference'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.4.3 E2-2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : INVENTORY APPENDIX 2 – TESTS AT INVENTORY COUNT',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>INVENTORY APPENDIX 2 – TESTS AT INVENTORY COUNT</h3>';
                $html .= '<p><b>N.B. If inventory count is solely undertaken by a 3rd party, this does not negate the need to carry out audit procedures identical to that carried out if the client had undertaken the procedures.  Consideration should be given as to the integrity and independence of the 3rd party.</b></p>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Existence/Completeness</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Yes/No/<br>N/A</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Ref.</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Completed by</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.4.4 E2-3':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : INVENTORY APPENDIX 3 – ALTERNATIVE PROCEDURES',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>INVENTORY APPENDIX 3 – ALTERNATIVE PROCEDURES</h3>';
                $html .= '
                    <p>Alternative procedures will be required if no inventory count has taken place at the period-end.  If an inventory count has taken place but was not attended, the file should indicate why, and assess the possible impact on the audit report.</p>
                    <p><b>Note that ISA 501 states that the auditor shall attend the inventory count if inventory is material.</b></p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Existence</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Completed by</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.4.5 E2-4':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : INVENTORY TOP UP PROGRAMME: CONSTRUCTION CONTRACTS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>INVENTORY TOP UP PROGRAMME: CONSTRUCTION CONTRACTS</h3>
                    <p><b>Complete this programme when the audited entity has Construction Contracts (or other contracts accounted for on a Percentage Completion basis). </b></p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Yes/No/<br>N/A</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
 
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.5 F2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : RECEIVABLES',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>RECEIVABLES</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests ~ General </b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
 
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.6 H2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : BANK AND CASH',1,1);
                $html .= $style;
                $html .= $c['code'];
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>BANK AND CASH</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
                    
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.7 I2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PAYABLES',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>PAYABLES</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
       
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.8 J2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : TAXATION ~ INCLUDING DEFERRED TAXATION',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>TAXATION ~ INCLUDING DEFERRED TAXATION</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
      
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.9 K2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : TRANSACTIONS WITH RELATED PARTIES',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>TRANSACTIONS WITH RELATED PARTIES</h3>
                    <p>NB: Tests covering directors’ remuneration, key management* compensation (KMC) and the identification of key management are noted on the R2 audit programme.</p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
         
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.10 L2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PROVISIONS, CONTINGENCIES AND FINANCIAL COMMITMENTS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>PROVISIONS, CONTINGENCIES AND FINANCIAL COMMITMENTS</h3>
                    <p><i>Audit work on deferred taxation is included in the J audit programme. It should also be noted that deferred tax provisions cannot be discounted.</i></p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.11 M2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : EQUITY AND STATUTORY INFORMATION',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>EQUITY AND STATUTORY INFORMATION</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit Test</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.12 N2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : OTHER AUDIT AREAS INCLUDING',1,1);
                $html .= $style;
                $html .= $c['code'];
                
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>OTHER AUDIT AREAS INCLUDING:</h3>
                    <p><i>Audit work on deferred taxation is included in the J audit programme. It should also be noted that deferred tax provisions cannot be discounted.</i></p>
                    <ul>
                        <li><b>ACCOUNTING ESTIMATES</b></li>
                        <li><b>LAW AND REGULATION</b></li>
                        <li><b>FRAUD AND ERROR</b></li>
                        <li><b>SERVICE ORGANISATION</b></li>
                        <li><b>AUDIT EXPERTS</b></li>
                        <li><b>RELIANCE ON OTHER AUDITORS AND INTERNAL AUDITORS</b></li>
                    </ul>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>ACCOUNTING ESTIMATES</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.13.1 O2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : REVENUE',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>REVENUE</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
      
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.13.2 O2-1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : IFRS 15 CONSIDERATIONS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>IFRS 15 CONSIDERATIONS</h3>
                    <p><i>IFRS 15 ‘Revenue from Contracts with Customers’ became mandatory for accounting periods commencing on/after 1 January 2018. </i></p>
                    <p><i>The core principle of IFRS 15 is that “an entity shall recognise revenue to depict the transfer of promised goods or services to customers in an amount that reflects the consideration to which the entity expects to be entitled in exchange for those goods or services”. </i></p>
                    <p><i>The 5-step approach to recognising revenue is as follows:<br>
                    Step 1: Identify the contract(s) with a customer.<br>
                    Step 2: Identify the performance obligations in the contract.<br>
                    Step 3: Determine the transaction price.<br>
                    Step 4: Allocate the transaction price to the performance obligations in the contract.<br>
                    Step 5: Recognise revenue when (or as) the entity satisfies a performance obligation.</i></p>
                    <p><i>Auditors must read IFRS 15, the accompanying application guidance (Appendix B of IFRS 15) and the transition requirements (Appendix C of IFRS 15) to gain a full understanding of the accounting requirements. </i></p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.14 P2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : DIRECT COSTS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>DIRECT COSTS</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
  
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '2.15 Q2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : OTHER INCOME AND GAINS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>OTHER INCOME AND GAINS</h3>
                    <p>This audit programme should only cover items recognised in profit or loss, items recognised in other comprehensive income should be addressed by the S Audit Programme.</p>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
     
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  

            case '2.16 R2-1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : OTHER EXPENDITURE AND LOSSES',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    ';
                    $html .= '<h3>OTHER EXPENDITURE AND LOSSES</h3>';
                    $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
         
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  

            case '2.17 R2-2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PAYROLL COSTS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>PAYROLL COSTS</h3>
                    <p>Where the entity operates a defined benefit pension scheme ensure the S2/2 audit programme is completed and where employees receive share-based payments ensure the S2/3 audit programme is completed.</p>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  

            case '2.18.1 S2-1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : DISCLOSURE AUDIT PROGRAMME ~ Covering the Directors’ Report and Financial Statements',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>DISCLOSURE AUDIT PROGRAMME ~ Covering the Directors’ Report and Financial Statements</h3>
                    <p><i>Additional audit programmes will be needed where the entity operates a defined benefit pension, has share-based payments or hedge accounts. Complete Appendices 2.18.2, 2.18.3 and 2.18.4 as necessary.</i></p>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  

            case '2.18.2 S2-2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : DEFINED BENEFIT PENSION SCHEMES',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>DEFINED BENEFIT PENSION SCHEMES</h3>
                    <p><i>Multi-employer schemes contributed to by a number of related or group entities must be split at entity level and it is not possible just to account for these schemes on consolidation.</i></p>
                    <p><i>NB: The valuation of an actuarial liability cannot be undertaken by the auditor. It is unlikely that most audit firms could demonstrate competency in this area and unless the actuarial liability was immaterial it would also be a breach of the IESBA’s Code of Ethics. </i></p>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests – planning and permanent file procedures prior to fieldwork</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';
 
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case '2.18.3 S2-3':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SHARE-BASED PAYMENTS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>SHARE-BASED PAYMENTS</h3>
                    <p><i>This work programme should be used when an entity has share-based payment transactions that fall within the scope of IFRS 2.  Typically share-based payments are offered to employees as an incentive to remain with the entity, but they can be offered to third parties in return for the provision of goods and services.  The corresponding disclosure requirements of IFRS 2 are set out in a Supplementary Checklist to the full Corporate Disclosure Checklist, see Appendix 3.15.3.</i></p>
                    <p><i>NB: The valuation of share-based payments cannot be undertaken by the auditor. It is unlikely that most audit firms could demonstrate competency in this area and unless the fair value was immaterial it would also be a breach of the IESBA’s Code of Ethics. </i></p>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests – Background information</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';
        
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  

            case '2.18.4 S2-4':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : HEDGE ACCOUNTING',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>HEDGE ACCOUNTING</h3>
                    <p><i>See Chapter 6 of IFRS 9 for detail. </i></p>
                    <p><i>On first time application, IFRS 9 permits an entity to choose as its accounting policy either to apply the hedge accounting requirements of IFRS 9 or to continue to apply the IAS 39 requirements.</i></p>
                    <p><i>This programme is to be used when the entity has entered into hedge relationships and is applying <b>hedge accounting</b>. The application of hedge accounting is <b>optional</b> – many clients take out financial instruments to “hedge” risks (such as forward foreign currency contracts to mitigate the risks arising from exposure to fluctuating exchange rates), but this does not necessitate the application of hedge accounting. Hedge accounting is a choice, and can only be applied when certain criteria have been met.</i></p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit tests – Background information</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';
       
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case '2.19.1 U2-1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : NOMINAL LEDGER',1,1);
                $html .= $style;
                $html .= $c['code'];
                

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>NOMINAL LEDGER</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>GENERAL</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;   

            case '2.19.2 U2-2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : NEW CLIENT – PRIOR PERIOD AUDITED',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>NEW CLIENT – PRIOR PERIOD AUDITED</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b></b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';
    
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case '2.19.3 U2-3':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PRIOR PERIOD UNAUDITED ~ NEW OR EXISTING CLIENT',1,1);
                $html .= $style;
                $html .= $c['code'];

                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 50%;">
                                <table border="1">
                                    <tr>
                                        <td>Programme prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'. date('F d,Y', strtotime($fl['prepared_on'])) .'</b></td>
                                    </tr>
                                    <tr>
                                        <td>A.E.P. review at completion: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'.date('F d,Y', strtotime($fl['reviewed_on'])).'</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $html .= '<h3>PRIOR PERIOD UNAUDITED ~ NEW OR EXISTING CLIENT</h3>';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b></b></th>
                                <th class="cent bo" style="width: 12%;"><b>Extent</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Reference</b></th>
                                <th class="cent bo" style="width: 12%;"><b>Initals/<br>Date</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $qdata = $rp->getquestionsdata($c['code'],$c['c2tID'],$cID,$wpID);
                        foreach($qdata as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 12%;">'.$r['extent'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['reference'].'</td>
                                <td class="cent bo" style="width: 12%;">'.$r['initials'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Assertion key:</b><br>
                    E = Existence;<br>
                    R&O = Rights and Obligations;<br>
                    C = Completeness;<br>
                    V = Accuracy, Valuation and Allocation;<br>
                    P = Presentation;<br>
                    O = Occurrence;<br>
                    A = Accuracy;<br>
                    CO = Cut-off;<br>
                    CL = Classification.<br>
                    </p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 
        }
    }

    /**
        ----------------------------------------------------------
        CHAPTER 3 PDF GENERATOR
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Chapter 3 : Conclusion',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:navy;text-align:center;">CHAPTER 3: CONCLUSION</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';
    foreach($c3 as $c){
        switch($c['code']){
            case '3.1 Aa1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : AUDIT CONTROL RECORD',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                        $datapl     = $rp->getaa1('planning',$c['code'],$c['c3tID'],$cID,$wpID);
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
                    $dataaf     = $rp->getaa1('audit finalisation',$c['code'],$c['c3tID'],$cID,$wpID);
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
                $rdata      = $rp->getaa1s3($c['code'],$c['c3tID'],$cID,$wpID);
                $s3         = json_decode($rdata['question'], true);
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

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '3.2 Aa2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : POINTS FORWARD',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                $html .= '<h3>POINTS FORWARD</h3>
                    <p><b>Objective: </b> <br>
                        To provide a summary of the key points arising from the audit, where it is possible for improvements to the efficiency of the audit to be made, and should include both financial and non-financial matters. <br><i>The use of this form is optional.</i></p>
                    <p><b>Recording:</b> <br>This form should be completed during the audit, and should cover key matters which are of relevance to next year’s assignment.</p>
                    <p>If information has been included elsewhere on the audit file (for example, Subsequent Events Review, or the ISA Compliance Critical Issues Memorandum), it does not need to be repeated.  Where appropriate, details of suggested improvements should be outlined.</p>
                ';
                $rdata  = $rp->getaa2data($c['code'],$c['c3tID'],$cID,$wpID);
                $aa2    = json_decode($rdata['question'], true);
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Problems encountered during the audit (regarding audit tests):</b>
                                    <br><p>'.$aa2['rat'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Problems encountered during the audit (regarding the client, and their accessibility etc.):</b>
                                    <br><p>'.$aa2['rcae'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Audit tests which can be removed / reduced without impairing audit quality:</b>
                                    <br><p>'.$aa2['atriaq'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Known changes to, or new accounting policies and estimation techniques in the forthcoming period:</b>
                                    <br><p>'.$aa2['kcapet'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Future developments (nature of business, locations, acquisitions and disposals):</b>
                                    <br><p>'.$aa2['fd'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Future structure of the audit team:</b>
                                    <br><p>'.$aa2['fs'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Other issues:</b>
                                    <br><p>'.$aa2['oi'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '3.3 Aa3a':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUBSEQUENT EVENTS REVIEW',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                        </tr>
                    </table>
                ';
                $html .= '<h3>SUBSEQUENT EVENTS REVIEW</h3>
                    <p><b>Objective: </b> <br>
                    To determine whether any material adjustment or disclosure is required to the financial statements as a result of events occurring between the end of the accounting period and the date of signing the audit report and to ensure the requirements of ISA 560 regarding subsequent events are met.</p>
                    <p class="bo"><b>NB: An adjusting event is an event that provides evidence of a condition that existed at the reporting date.  A non-adjusting event is an event that arose solely after the reporting date, however, its disclosure is necessary to give a true and fair view.</b></p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 47%;"><b>Review of Clients Records</b></th>
                                <th class="cent bo" style="width: 47%;"><b>Working Paper Reference or Comment</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $cr     = $rp->getaa3('cr',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($cr as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 47%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 47%;">'.$r['reference'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 47%;"><b>Discussion with Client</b></th>
                                <th class="cent bo" style="width: 47%;"><b>Working Paper Reference or Comment</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $dc     = $rp->getaa3('dc',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($dc as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 47%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 47%;">'.$r['reference'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';
                $html .= '
                    <p><b>Finalisation of the Audit File</b></p>
                    <p>This section should also detail any other work done on subsequent events not covered by the questions below.</p>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b></b></th>
                                <th class="cent bo" style="width: 18%;"><b>Initial & Date</b></th>
                                <th class="cent bo" style="width: 18%;"><b>WP Ref / Comment</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $faf    = $rp->getaa3('faf',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($faf as $r){
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
                    
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $ir     = $rp->getaa3air($c['code'],$c['c3tID'],$cID,$wpID);
                $html .= '
                    <h3>Initial Conclusion:</h3>
                    <p>* Delete as applicable </p>
                    <p>Having completed the above procedures:</p>
                    <p>There were no significant events. *</p>
                    <p>Subsequent events identified above have* / have not* been adequately reflected in the financial statements.</p>
                    <p>Significant events highlighted by this review, including any disagreements with the client have been brought to the A.E.P.\'s attention and are noted on schedule ___________ *</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Prepared by:___________</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Reviewed by:___________</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <h3>Final Conclusion:</h3>
                    <p><i>If there is a significant delay* between the initial subsequent event review and the signing of the audit report:</i></p>
                    <ul>
                        <li><i>then a detailed subsequent event review will need to be reperformed to this date;</i></li>
                        <li><i>consideration should be given to the reason for the delay, as this may be indicative of potential going concern problems; and</i></li>
                        <li><i>if there is no justifiable reason for the delay, revisit and update the going concern review.</i></li>
                    </ul>
                    <p><i>* - “Significant delay” is not defined, but a delay in excess of three months is likely to mean that the subsequent events review will need to be reperformed.</i></p>
                    <p>The initial review was conducted sufficiently close to the proposed date of the audit report not to require the work to be revised.*</p>
                    <p>The initial review has been updated to _____________ (insert date). The work performed is outlined below:*</p>
                    <table>
                        <tbody>
                            <tr>
                                <td class="bo">
                                    <br><br><br>
                                    '.$ir['question'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Having reviewed the above procedures:</p>
                    <p>I am satisfied that no further significant events have occurred between the initial review as documented by the conclusion above and _____________ (date of the final review) * <br> Significant events that have occurred are explained above, have been communicated to the A.E.P., and adequately accounted for / disclosed in the financial statements. *</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Prepared by:___________</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Reviewed by:___________</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <p><i>N.B. If a matter is discovered after the financial statements are approved which may have changed the opinion given, consider the following (ISA 560.10):</i></p>
                    <ul>
                        <li><i>Discuss the issue with management;</i></li>
                        <li><i>Revising the financial statements;</i></li>
                        <li><i>Taking appropriate action.</i></li>
                    </ul>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
            case '3.4 Aa3b':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : GOING CONCERN CHECKLIST',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                $html .= '<h3>GOING CONCERN CHECKLIST</h3>
                    <p><b>Objective: </b> <br>
                    To ensure that the fundamental concept of going concern is fully considered and that the requirements of ISA 570 are met.</p>
                    <p class="bo"><b>Overview:  Under the going concern assumption, an entity is viewed as continuing in business for the foreseeable future.  Financial statements are prepared on a going concern basis, unless management either intends to liquidate the entity or to cease to operate, or has no realistic alternative to do so (in these circumstances the financial statements are prepared on a break-up basis).</b></p>
                ';
                $html .= '
                    <br><br><br>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 65%;"><b>Part 1 – Discussion with the Client Regarding Going Concern:</b></th>
                                <th class="cent" style="width: 29%;"><b></b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $bp1    = $rp->getaa3b('p1',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($bp1 as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 65%;">'.$r['question'].'</td>
                                <td class="cent bo" style="width: 29%;">'.$r['reference'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';
                $html .= '
                    <br><br>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 65%;"><b>Part 2 – The Auditor’s Assessment ~ General Considerations:</b></th>
                                <th class="cent bo" style="width: 29%;"><b>Comments / Ref</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $bp2    = $rp->getaa3b('p2',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($bp2 as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 65%;">'.$r['question'].'</td>
                                <td class="cent bo" style="width: 29%;">'.$r['reference'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $html .= '
                    <br><br>
                    <p><b>Part 3a – The Auditor’s Assessment ~ Specific Concerns: <br><i>Completion of this section is optional unless potential issues regarding the going concern presumption have been identified in Parts 1 or 2 above. </i></b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 65%;"><b></b></th>
                                <th class="cent bo" style="width: 29%;"><b>Comments / Ref</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $bp3a   = $rp->getaa3b('p3a',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($bp3a as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 65%;">'.$r['question'].'</td>
                                <td class="cent bo" style="width: 29%;">'.$r['reference'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $html .= '
                    <br><br>
                    <p><b>Part 3b – The Auditor’s Assessment ~ Disclosure considerations:</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 65%;"><b></b></th>
                                <th class="cent bo" style="width: 29%;"><b>Comments / Ref</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        $bp3b   = $rp->getaa3b('p3b',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($bp3b as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 65%;">'.$r['question'].'</td>
                                <td class="cent bo" style="width: 29%;">'.$r['reference'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $rdata  = $rp->getaa3bp4($c['code'],$c['c3tID'],$cID,$wpID);
                $bp4    = json_decode($rdata['question'], true);
                $html .= '
                    <p><b>Part 4 – Conclusion:</b></p>
                    <p>Where potential problems with the going concern presumption have been identified, summarise the issue and resolution:</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th class="cent"><b>Going Concern Problem</b></th>
                                <th class="cent"><b>Audit Evidence Gained / Schedule Reference</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$bp4['p41'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$bp4['p42'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>On the basis of the work recorded above, I consider that:</p>
                    <ul>
                        <li>The financial statements have been correctly prepared on the break-up basis.*</li>
                        <li>The going concern concept is* / is not* correctly applied to this client.</li>
                        <li>There is no concern* / concern* / significant concern* regarding the going concern concept for this client.</li>
                        <li>The notes to the financial statements require* / do not require* additional information regarding the going concern concept.</li>
                        <li>The audit report should be unmodified* / unmodified with a “Material uncertainty related to going concern” paragraph* / qualified with respect to going concern.*</li>
                        <li><i>(If qualification or ”Material uncertainty” paragraph) Consideration has been given as to whether a report to a regulatory authority is required.(* Delete as applicable)</i></li>
                    </ul>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________[A.E.P.]</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <p><i>There is more guidance on the impact on the financial statements and audit report of going concern issues in Chapter 3, paragraph 5.4 of the Manual, as well as in ISA 570.</i></p>
                ';
                
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '3.5 Aa4':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUGGESTED LETTER OF REPRESENTATION',1,1);
                $html .= $style;
                $rdata  = $rp->getaa4($c['code'],$c['c3tID'],$cID,$wpID);
                $aa4    = json_decode($rdata['question'], true);
                $html .= $c['code'];
                $html .= '
                    <p class="cent"><b>SUGGESTED LETTER OF REPRESENTATION</b> <br><br><br></p>
                    <table>
                        <tr>
                            <td>'.$cl['aud'].'</td>
                        </tr>
                        <tr>
                            <td>'.$cl['sup'].'</td>
                        </tr>
                        <tr>
                            <td>'.$cl['audm'].'</td>
                        </tr>
                        <tr>
                            <td>'.$firm.'</td>
                        </tr>
                    </table>
                    <p>Dear Sirs</p>
                    <p class="ind"><b>LETTER OF REPRESENTATION FOR THE '.strtoupper($cl['financial_year']).' ENDED '.strtoupper(date('F d', strtotime($cl['financial_year'].'-'.$cl['end_financial_year'])) ).'</b></p>
                    <p>We confirm that the following representations are made on the basis of enquiries of management and staff with relevant knowledge and experience and where appropriate, of inspection of supporting documentation, sufficient to satisfy ourselves that we can properly make each of the following representations to you in connection with your audit of the company\'s financial statements for the year ended '.date('F d, Y', strtotime($cl['financial_year'].'-'.$cl['end_financial_year'])).'.</p>
                    <p>We acknowledge our legal responsibilities regarding disclosure of information to you as auditors and confirm that so far as we are aware, there is no relevant audit information needed by you in connection with preparing your audit report of which you are unaware.  Each director has taken all the steps that they ought to have taken as a director in order to make themselves aware of any relevant audit information and to establish that you are aware of that information.</p>
                    <p><b>Financial Statements:</b></p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 7%;">1.</td>
                                <td style="width: 93%;"><b>We acknowledge, and have fulfilled, as directors, our collective responsibility under '.$aa4['leg1'].' for presenting financial statements (in accordance with '.$aa4['leg2'].' and International Financial Reporting Standards), which give a true and fair view of the financial position of the company at the reporting date, and of its result for the period then ended, and for making accurate representations to you.  We confirm that we have approved the financial statements for the year ended [date].</b> <br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">2.</td>
                                <td style="width: 93%;"><b>We confirm that the accounting policies and estimation techniques '.$aa4['isa'].' adopted for the preparation of the financial statements are the most appropriate to the circumstances in which the company operates.</b> <br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">3.</td>
                                <td style="width: 93%;"><b>Other than as disclosed in the financial statements, the company has not entered into any transactions involving directors, officers or other related parties, which require disclosure under '.$aa4['leg3'].' or International Financial Reporting Standards.  Appropriate disclosure has been made of the control of the company.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">4.</td>
                                <td style="width: 93%;"><b>We have disclosed all known or possible litigation and claims whose effects should be considered when preparing the financial statements and these have been disclosed in accordance with the requirements of accounting standards.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">5.</td>
                                <td style="width: 93%;"><b>The financial statements of the company have been prepared on the going concern basis as we believe that adequate cash resources will be available to cover the company’s requirements for working capital and capital expenditure for at least the next twelve months.  We are not aware of any other factors which could put into jeopardy the company’s going concern status during or beyond this period.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">6.</td>
                                <td style="width: 93%;"><b>There have been no events since the reporting date which necessitate revision of the figures included in the financial statements or inclusion of a note thereto.  Should further material events occur, which may necessitate revision of the figures included in the financial statements or inclusion of a note thereto, we will advise you accordingly.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">7.</td>
                                <td style="width: 93%;"><b>'.$aa4['num7'].'</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">8.</td>
                                <td style="width: 93%;">We confirm that we have agreed the adjustments appended to this letter which have been made to the performance statement(s), and statement of financial position which we presented to you for audit.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">9.</td>
                                <td style="width: 93%;">We confirm we have no plans or intentions that may materially affect the carrying value or classification of any assets and liabilities reflected in the financial statements. <br></td>
                            </tr>';

                            if($aa4['num10yes'] != ''){
                                $html .= '
                                <tr>
                                    <td style="width: 7%;">10.</td>
                                    <td style="width: 93%;">
                                    
                                    With regard to the defined benefit pension plan, we are satisfied that:
                                        <ul>
                                            <li>the actuarial assumptions underlying the valuation are consistent with our knowledge of the business;</li>
                                            <li>all significant retirement benefits have been identified and properly accounted for; and</li>
                                            <li>all settlements and curtailments have been identified and properly accounted for.</li>
                                        </ul>
                                        <br>
                                    </td>
                                </tr>';
                            }
                            if($aa4['num11yes'] != ''){
                                $html .= '
                                <tr>
                                    <td style="width: 7%;">11.</td>
                                    <td style="width: 93%;">'.$aa4['num11'].'<br></td>
                                </tr>';
                            }

                            if($aa4['num12yes'] != ''){
                                $html .= '
                                <tr>
                                    <td style="width: 7%;">12.</td>
                                    <td style="width: 93%;">'.$aa4['num12'].'<br></td>
                                </tr>';
                            }
                            $html .= '
                            <tr>
                                <td style="width: 7%;">13.</td>
                                <td style="width: 93%;"><b>All the accounting records have been made available to you for the purpose of your audit and all the transactions undertaken by the company have been properly reflected and recorded in the accounting records.  We have provided to you all other information requested and given unrestricted access to persons within the entity from whom you have deemed it necessary to speak to.  All other records and relevant information, including minutes of all management and shareholders\' meetings, have been made available to you.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">14.</td>
                                <td style="width: 93%;"><b>Other than those disclosed in the financial statements we are not aware of any material liabilities, provisions, contingent liabilities, contingent assets or contracted for capital commitments, that need to be provided for or disclosed in the financial statements.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">15.</td>
                                <td style="width: 93%;">The company has satisfactory title to all assets and there are no liens or encumbrances on the company’s assets '.$aa4['num15'].'.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">16.</td>
                                <td style="width: 93%;">We confirm that the functional currency of the company is '.$aa4['num16'].'.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">17.</td>
                                <td style="width: 93%;">Where investment properties are carried at cost in a portfolio which is valued on a fair value basis or there are unlisted investments (other than investments in subsidiaries, associates and joint ventures) that have been carried at historic cost, we confirm that a reliable estimate of fair value cannot be established for the following reasons '.$aa4['num17'].'.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">18.</td>
                                <td style="width: 93%;">We confirm that we have reviewed all material items of property, plant and equipment and intangible fixed assets and we have assessed the reasonableness of their useful economic lives and residual values.  We have also reviewed all material items of property, plant and equipment, intangible fixed assets and investments (other than those carried at fair value) and consider that '.$aa4['imp'].'.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">19.</td>
                                <td style="width: 93%;"><b>We confirm that we have notified you of all related party relationships, and transactions that the company has entered into with those related parties during the year of which we are aware.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">20.</td>
                                <td style="width: 93%;"><b>We acknowledge our responsibility for the design and implementation of internal controls to prevent and detect errors or fraud, and have disclosed to you the results of our assessment of the risk that the financial statements may be materially misstated as a result of fraud.  We are unaware of any irregularities, including fraud and suspected fraud, involving management, employees or others who have significant roles in internal control, or those employed by the company where the fraud could have a material effect on the financial statements.  No allegations of such irregularities or breaches have come to our notice.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">21.</td>
                                <td style="width: 93%;"><b>We are unaware of any breaches or possible breaches of statute, regulations, contracts,</b> agreements or the company\'s constitution <b>which might result in the company suffering significant penalties or other loss.</b>  No allegations of such irregularities or breaches have come to our notice.<br></td>
                            </tr>';

                            if($aa4['num22yes1'] != ''){
                                $html .= '
                                <tr>
                                    <td style="width: 7%;">22.</td>
                                    <td style="width: 93%;"><b>We confirm that we have been notified by you that there are no matters which you are required to raise with us to comply with your profession’s ethical guidance which are in addition to the matters included in your planning letter to us dated '.date('F d, Y', strtotime($aa4['num221'])).'.</b> <br></td>
                                </tr>
                                ';
                            }

                            if($aa4['num22yes2'] != ''){
                                if($aa4['num222'] != ''){$a = $aa4['num222'];}else{$a = '';}
                                if($aa4['num223'] != ''){$b = $aa4['num223'];}else{$b = '';}
                                if($aa4['num224'] != ''){$c = $aa4['num224'];}else{$c = '';}
                                $html .= '
                                <tr>
                                    <td style="width: 7%;">22.</td>
                                    <td style="width: 93%;"><b>We confirm that you have notified to us the following matters, which are additional to the matters raised in your planning letter which you are required to raise with us to comply with your profession’s ethical guidance:</b>
                                        <ul>
                                            <li><b>'.$a.'</b></li>
                                            <li><b>'.$b.'; and</b></li>
                                            <li><b>'.$c.'.</b></li>
                                        </ul><br>
                                    </td>
                                </tr>
                                ';
                            }

                            if($aa4['num23yes1'] != ''){
                                $html .= '
                                <tr>
                                    <td style="width: 7%;">23.</td>
                                    <td style="width: 93%;"><b>We confirm receipt of your planning letter dated '.date('F d, Y', strtotime($aa4['num23d1'])).' and </b> we confirm receipt of your management letter dated '.date('F d, Y', strtotime($aa4['num23d2'])).'.<br></td>
                                </tr>';
                            }
                            if($aa4['num23yes2'] != ''){
                                $html .= '
                                <tr>
                                    <td style="width: 7%;">23.</td>
                                    <td style="width: 93%;"><b>We confirm receipt of your planning letter dated '.date('F d, Y', strtotime($aa4['num23d'])).' and</b> we confirm that we have been notified by you that there are no matters of governance interest (which include deficiencies in internal control, comments regarding accounting policies, estimation techniques and financial statement disclosure, and details of significant difficulties during the audit fieldwork) which you wish to draw to our attention.<br></td>
                                </tr>';
                            }

                            $html .='
                        </tbody>
                    </table>
                    <p>Yours faithfully <br><br></p>
                    <p>[Name] <br> Signed on behalf of the Board of Directors (those charged with governance)</p>
                    <p><i>The following signature is only required where management differ from those charged with governance, as were identified on the Regulation of Auditor’s Checklist.  (Separate letters may be considered appropriate if there are representations which those charged with governance wish to remain confidential from management):</i> <br><br></p>
                    <p>[Name] <br>Signed on behalf of management</p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '3.6.1 Aa5a':
                
            break;

            case '3.6.2 Aa5b':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : MANAGEMENT LETTER WORKSHEET',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <h3>MANAGEMENT LETTER WORKSHEET [INTERIM / FINAL AUDIT]</h3>
                    <table border="1" class="cent">
                        <thead>
                            <tr >
                                <th style="width: 7%;">SchRef.</th>
                                <th style="width: 18.6%;">Issues Identified </th>
                                <th style="width: 18.6%;">Client’s Comments</th>
                                <th style="width: 18.6%;">Recommendations</th>
                                <th style="width: 18.6%;">To be Included in Management Letter YES / NO</th>
                                <th style="width: 18.6%;">Results of Follow up at Next Audit Visit</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
                        $aa5b = $rp->getaa5b($c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($aa5b as $r){
                            $html .= '
                            <tr>
                                <td style="width: 7%;"><br><br>'.$r['reference'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['issue'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['comment'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['recommendation'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['yesno'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['result'].'<br></td>
                            </tr>';
                        }
                $html .='
                        </tbody>
                    </table>
                    <p>This should cover weaknesses in the accounting system and control environment plus comments on the qualitative aspects of the financial statements and the appropriateness of the accounting policies and estimation techniques adopted by the client.</p>
                    <p>All significant issues should be included in the management letter.  For other issues verbal communication is adequate.  If there are no significant issues then this can be confirmed in a “voluntary” management letter or alternatively, the letter of representation can note that a management letter is not necessary ~ note, however, that this is likely to be a rare occurrence when applying IFRS.</p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '3.7 Aa7':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : ISA COMPLIANCE CRITICAL ISSUES MEMORANDUM',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                $aepapp = $rp->getaa7aep('aepapp',$c['code'],$c['c3tID'],$cID,$wpID);
                $html .= '
                    <h3>ISA COMPLIANCE CRITICAL ISSUES MEMORANDUM</h3>
                    <p><b>Objective:</b></p>
                    <p>To ensure compliance with ISA by providing a summary of critical audit issues and how these have been resolved. When read in conjunction with final analytical procedures, completion of this memorandum should provide the Audit Engagement Partner with an executive summary of the key points arising from the assignment.</p>
                    <p><b>Recording:</b></p>
                    <p>This form must be completed and include any changes made to the original planning documentation, how significant risks have been addressed during the audit and certain other issues specifically required by ISA. <i>The first 3 pages of this form are mandatory</i>.</p>
                    <p>If the A.E.P. wishes, this form can be fully completed thus providing a comprehensive executive summary which (when read in conjunction with final analytical procedures) provides a critical review of financial and non-financial matters, notes outstanding work; key issues where the A.E.P.’s input is needed and key issues that require further client involvement.</p>
                    <p>This form should not be used to record routine review points or administrative points for the A.E.P.’s attention or to record outstanding work at interim stages of the assignment.</p>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Summary and Impact of Changes Made to Audit Planning After the Date of the A.E.P’s Approval:</b>
                                    <br><br><br>
                                    '.$aepapp['question'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>I approve the above changes to the planning, and consider that these changes have been adequately integrated into the audit approach.</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Changes approved by:___________(A.E.P.) </td>
                            <td style="width: 50%;">on_____________</td>
                        </tr>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $html .= '
                    <p><b>I have considered the requirements of ISA 315 and specifically, the definition of a significant risk being, “an identified and assessed risk of material misstatement that, in the auditor’s judgment, requires special audit consideration”.</b></p>
                    <p><b>A summary of significant risks identified, the outcome from audit tests performed on those risks, and the conclusions reached (mandatory section):</b> <br> <i>(Insert additional rows as required)</i></p>
                ';
                $html .= '
                    <h3>MANAGEMENT LETTER WORKSHEET [INTERIM / FINAL AUDIT]</h3>
                    <table border="1" class="cent">
                        <thead>
                            <tr >
                                <th style="width: 15%;"><b>Area / Assertion</b></th>
                                <th style="width: 30%;"><b>Significant risk identified</b></th>
                                <th style="width: 10%;"><b>Audit test reference</b></th>
                                <th style="width: 20%;"><b>Results of audit tests</b></th>
                                <th style="width: 20%;"><b>Conclusions</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $aa7    = $rp->getaa7('isa315',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($aa7 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 15%;"><br><br>'.$r['reference'].'<br></td>
                                <td style="width: 30%;"><br><br>'.$r['issue'].'<br></td>
                                <td style="width: 10%;"><br><br>'.$r['comment'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
                            </tr>';
                    }
                $html .='
                        </tbody>
                    </table>';
                $html .= '
                    <p>I consider that significant risks have been identified and adequately addressed by this assignment, and have been appropriately communicated to the client in the Planning Letter (or, for significant risks identified at a later stage of the assignment, via alternative, appropriate documentation).</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signature:___________(A.E.P.) </td>
                            <td style="width: 50%;">on_____________</td>
                        </tr>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $html .= '
                    <table border="1" >
                        <thead>
                            <tr>
                                <th style="width: 20%;"><b>Issue(s):</b></th>
                                <th style="width: 20%;"><b>Comments and conclusion of the audit team:</b></th>
                                <th style="width: 20%;"><b>(If applicable) <br> Further information needed from the client and a summary of information subsequently received:</b></th>
                                <th style="width: 20%;"><b>(If applicable) <br> A.E.P. input required:</b></th>
                                <th style="width: 20%;"><b>A.E.P. Conclusion(s):</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5"><b>Areas where consultation has been undertaken (mandatory section):</b></td>
                            </tr>';
                    $cons   = $rp->getaa7('consultation',$c['code'],$c['c3tID'],$cID,$wpID);
                    foreach($cons as $r){
                        $html .= '
                        <tr>
                            <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
                        </tr>';
                    }
                $html .= '
                    <tr>
                        <td colspan="5"><b>Inconsistencies noted between information provided by the client and other findings of the audit team (mandatory section):</b></td>
                    </tr>';
                    $inc    = $rp->getaa7('inconsistencies',$c['code'],$c['c3tID'],$cID,$wpID);
                    foreach($inc as $r){
                        $html .= '
                        <tr>
                            <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
                        </tr>';
                    }
                $html .= '
                    <tr>
                        <td colspan="5"><b>Areas where management refusal to allow the audit team to send a confirmation request has led to alternative procedures being performed (mandatory section):</b></td>
                    </tr>
                ';
                    $ref    = $rp->getaa7('refusal',$c['code'],$c['c3tID'],$cID,$wpID);
                    foreach($ref as $r){
                        $html .= '
                        <tr>
                            <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
                        </tr>';
                    }
                $html .= '
                    <tr>
                        <td colspan="5"><b>Departures from requirements of ISA, reasons for the departure and alternative audit procedures performed (mandatory section):</b></td>
                    </tr>
                ';
                    $dep    = $rp->getaa7('departures',$c['code'],$c['c3tID'],$cID,$wpID);
                    foreach($dep as $r){
                        $html .= '
                        <tr>
                            <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
                            <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
                        </tr>';
                    }
                $html .='
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $html .= '<p><b>Other Issues (including any key outstanding audit matters):</b></p>';

                $html .= '
                    <table border="1" >
                        <thead>
                            <tr>
                                <th style="width: 20%;"><b>Issue(s):</b></th>
                                <th style="width: 20%;"><b>Comments and conclusion of the audit team:</b></th>
                                <th style="width: 20%;"><b>(If applicable) <br> Further information needed from the client and a summary of information subsequently received:</b></th>
                                <th style="width: 20%;"><b>(If applicable) <br> A.E.P. input required:</b></th>
                                <th style="width: 20%;"><b>A.E.P. Conclusion(s):</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
                        $oth    = $rp->getaa7('other',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($oth as $r){
                            $html .= '
                            <tr>
                                <td style="width: 20%;"><br><br>'.$r['reference'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['issue'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['comment'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['recommendation'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['result'].'<br></td>
                            </tr>';
                        }
                $html .='
                        </tbody>
                    </table>
                ';

                $rdata  = $rp->getaa7aep('aep',$c['code'],$c['c3tID'],$cID,$wpID);
                $aep    = json_decode($rdata['question'], true);
                $html .= '
                    <p><b>Changes to, or new accounting policies and estimation techniques in the period:</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>Points to A.E.P.:</b></th>
                                <th><b>A.E.P. Comments:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$aep['ch1'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$aep['ch2'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Developments during the period:</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>Points to A.E.P.:</b></th>
                                <th><b>A.E.P. Comments:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$aep['dev1'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$aep['dev2'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Future developments:</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>Points to A.E.P.:</b></th>
                                <th><b>A.E.P. Comments:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$aep['fut1'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$aep['fut2'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Costs to date, including an explanation of deviation from budget, and timetable for completion:</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>Points to A.E.P.:</b></th>
                                <th><b>A.E.P. Comments:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$aep['cst1'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$aep['cst2'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                                
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '3.8 Aa10':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : FINAL ANALYTICAL PROCEDURES',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <h3>FINAL ANALYTICAL PROCEDURES</h3>
                    <p><b>Objective:</b> <br> To carry out a review of the financial statements such that the results obtained, together with the conclusions drawn from other audit tests, give a basis for the opinion on the financial statements.</p>
                    <p><b>Recording:</b> <br> Review key ratios of most significance to the entity. Any large or unexpected movements in these ratios should be explained. This section should also contain details of significant or unexpected changes in major Statement of Financial Position and Performance Statement items.</p>
                    <p><b>Comparisons should be made of current period figures with prior period and / or budgeted figures.  Explanations obtained for significant or unexpected changes in key business ratios and items in the financial statements must be corroborated by other evidence. A conclusion should then be reached. </b></p>
                    <p><b><i>Undertaking analytical procedures at finalisation is mandatory; however, the use of this form is optional.</i></b></p>
                ';

                $rdata = $rp->getaa10($c['code'],$c['c3tID'],$cID,$wpID);
                $aa10 = json_decode($rdata['question'], true);

                $html .='
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    Summary of key ratios which may be calculated or printed from a relevant software package (add others which are specifically relevant to the entity):
                                    <ul>
                                        <li><i>(Gross Profit / Revenue) x 100</i></li>
                                        <li><i>(Profit before Tax / Revenue) x 100</i></li>
                                        <li><i>Direct expenses / Inventory</i></li>
                                        <li><i>(Trade Receivables / Credit Sales) x 365</i></li>
                                        <li><i>(Trade Payables / Credit Purchases) x 365</i></li>
                                        <li><i>Current Assets / Current Liabilities</i></li>
                                        <li><i>Current Assets – Inventory / Current Liabilities</i></li>
                                        <li><i>Total Liabilities / Equity</i></li>
                                        <br><br><br><br><br>
                                        '.$aa10['sum'].'
                                        <br><br><br><br><br>
                                        To give an accurate figure an adjustment for sales taxes will have to be made.
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $html .='
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Comparison of key figures</b> (or summarise where this work is filed) <br>
                                    <i>For example:</i> <br>
                                    <i>Compare current year’s figures, at intervals appropriate with the availability of management information, against a sample of the following, as appropriate:</i>
                                    <ul>
                                        <li><i>Prior year’s figures;</i></li>
                                        <li><i>Budgeted figures;</i></li>
                                        <li><i>Industry and other external statistics;</i></li>
                                        <li><i>Non-financial information (specify which information); or</i></li>
                                        <li><i>Any other relevant information.</i></li>
                                    </ul>
                                    <p><i>Ensure that a summary is prepared of all variances (both absolute and percentage) to justify the analysis performed.</i></p>
                                    <p><i>Compare results of final analytical procedures with those of preliminary analytical procedures.</i></p>
                                    <br><br><br><br><br>
                                    '.$aa10['comp'].'
                                    <br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;

                $html .='
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Explanations of unusual variations</b> (or summarise where this work is filed) <br>
                                    <i>For example:</i> <br>
                                    <i>Investigate normal and abnormal fluctuations, and record explanations.</i> <br>
                                    <i>Record details of the evidence obtained to substantiate and corroborate the explanations received.</i> <br>
                                    <i>Consider whether any of the points raised need to be included in either:</i>
                                    <ul>
                                        <li><i>The management letter, as a result of a weakness highlighted in the accounting system; or</i></li>
                                        <li><i>The letter of representation, as a result of an explanation for which only verbal evidence is available.</i></li>
                                    </ul>
                                    <p><i>Consider whether any of the unusual variances identified indicate a previously unrecognised risk of material misstatements due to fraud.</i></p>
                                    <br><br><br><br><br>
                                    '.$aa10['exp'].'
                                    <br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Conclusion:</b></p>
                    <p>I have carried out both overall and detailed analytical procedures on the financial statements and I am satisfied that:</p>
                    <ul>
                        <li>there are no large or unusual variations in the figures which cannot be adequately explained;</li>
                        <li>no indicators of fraud have been identified; and</li>
                        <li>no indicators of fraud have been identified; and</li>
                    </ul>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signature:___________</td>
                            <td style="width: 50%;">Dated:_____________</td>
                        </tr>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '3.9':
                echo view('workpaper/pdfc3/39', $data);
            break;

            case '3.10 Aa11-un':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUMMARY OF UNADJUSTED ERRORS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $s      = explode('-', $code);
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
                $rdata          = $rp->getaa11p('aa11ue',$s[0],$c['c3tID'],$cID,$wpID);
                $ue     = json_decode($rdata['question'], true);
                $html .= '
                    <p><b>SUMMARY OF UNADJUSTED ERRORS</b></p>
                    <p>If, during the assignment, either the aggregate of accumulated misstatements approaches performance materiality, or the nature of identified misstatements indicate that other misstatements may exist which would lead to accumulated misstatements exceeding performance materiality, it shall be determined whether the overall audit strategy and audit plan need to be revised.</p>
                    <p><b>Objective:</b> <br>This summary of errors is to determine whether any errors, including disclosure errors, which have not yet been corrected (including uncorrected misstatements relating to prior periods), are individually or in total, sufficiently material to warrant correction in the financial statements and to ensure, if appropriate, that they are communicated to the client.  Where applicable, the effect of taxation should also be documented.</p>
                    <p><b>Scope:</b> <br>Either all errors should be recorded on this form or just those over a de minimis level which can be set by the A.E.P. (this should normally be less than or equal to the clearly trivial threshold).</p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 60%;"><b>Clearly Trivial per Ac13</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['cta'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 60%;"><b>Final Performance Materiality per Ac13</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['fpm'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 60%;"><b>Final Materiality per Ac13</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['fma'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br> 
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th style="width: 40%;"></th>
                                <th colspan="4" style="width: 40%;"><b>Potential Effect on the Financial Statements</b></th>
                                <th style="width: 10%;"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th colspan="2" style="width: 20%;"><b>Performance Statements</b></th>
                                <th colspan="2" style="width: 20%;"><b>S\'ment of Fin. Position</b></th>
                                <th style="width: 10%;"><b>Adjust?</b></th>
                            </tr>
                            <tr>
                                <th style="width: 10%;"><b>WP Ref.</b></th>
                                <th style="width: 40%;"><b>Account and Description of Error</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                                <th style="width: 10%;" class="cent"><b>Yes/No</b></th>
                            </tr>
                            <tr>
                                <th colspan="7"><b>ACTUAL ERRORS - FACTUAL</b></th>
                            </tr>
                        </thead>
                        <tbody> ';
                            $aef_drps = 0;
                            $aef_crps = 0;
                            $aef_drfp = 0;
                            $aef_crfp = 0;
                            $aef    = $rp->getaa11p2('aef',$s[0],$c['c3tID'],$cID,$wpID);
                            foreach($aef as $r){
                            $aef_drps += $r['drps'];
                            $aef_crps += $r['crps'];
                            $aef_drfp += $r['drfp'];
                            $aef_crfp += $r['crfp'];
                            $html .= '
                                <tr>
                                    <td style="width: 10%;" class="cent">'.$r['reference'].'</td>
                                    <td style="width: 40%;">'.$r['initials'].'</td>
                                    <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                                    <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                                    <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                                    <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                                    <td style="width: 10%;" class="cent">'.$r['yesno'].'</td>
                                </tr>
                            ';
                            }
                $html .= '
                        <tr>
                            <td colspan="6" style="width: 90%;"><b>ACTUAL ERRORS - JUDGMENTAL</b></td>
                            <td style="width: 10%;"><b>Adjust?</b></td>
                        </tr>
                ';
                        $aej_drps = 0;
                        $aej_crps = 0;
                        $aej_drfp = 0;
                        $aej_crfp = 0;
                        $aej    = $rp->getaa11p2('aej',$s[0],$c['c3tID'],$cID,$wpID);
                        foreach($aej as $r){
                        $aej_drps += $r['drps'];
                        $aej_crps += $r['crps'];
                        $aej_drfp += $r['drfp'];
                        $aej_crfp += $r['crfp'];     
                        $html .= '
                            <tr>
                                <td style="width: 10%;" class="cent">'.$r['reference'].'</td>
                                <td style="width: 40%;">'.$r['initials'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['yesno'].'</td>
                            </tr>
                        ';
                        }
                $html .= '
                        <tr>
                            <td colspan="6" style="width: 90%;"><b>EXTRAPOLATED ERRORS</b></td>
                            <td style="width: 10%;"><b>Adjust?</b></td>
                        </tr>
                ';
                        $ee_drps = 0;
                        $ee_crps = 0;
                        $ee_drfp = 0;
                        $ee_crfp = 0;
                        $ee     = $rp->getaa11p2('ee',$s[0],$c['c3tID'],$cID,$wpID);
                        foreach($ee as $r){
                        $ee_drps += $r['drps'];
                        $ee_crps += $r['crps'];
                        $ee_drfp += $r['drfp'];
                        $ee_crfp += $r['crfp'];
                        $html .= '
                            <tr>
                                <td style="width: 10%;" class="cent">'.$r['reference'].'</td>
                                <td style="width: 40%;">'.$r['initials'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['yesno'].'</td>
                            </tr>
                        ';
                        }
                $html .= '
                        <tr>
                            <td colspan="6" style="width: 90%;"><b>DISCLOSURE ERRORS</b></td>
                            <td style="width: 10%;"><b>Adjust?</b></td>
                        </tr>
                ';
                        $de_drps = 0;
                        $de_crps = 0;
                        $de_drfp = 0;
                        $de_crfp = 0;
                        $de     = $rp->getaa11p2('de',$s[0],$c['c3tID'],$cID,$wpID);
                        foreach($de as $r){
                        $de_drps += $r['drps'];
                        $de_crps += $r['crps'];
                        $de_drfp += $r['drfp'];
                        $de_crfp += $r['crfp'];
                        $html .= '
                            <tr>
                                <td style="width: 10%;" class="cent">'.$r['reference'].'</td>
                                <td style="width: 40%;">'.$r['initials'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['yesno'].'</td>
                            </tr>
                        ';
                        }
                $html .= '
                        <tr>
                            <td colspan="6" style="width: 50%;"><b>Total Effect of Unadjusted Errors</b></td>
                            <td style="width: 10%;" class="cent">'.$aef_drps + $aej_drps + $ee_drps + $de_drps.'</td>
                            <td style="width: 10%;" class="cent">'.$aef_crps + $aej_crps + $ee_crps + $de_crps.'</td>
                            <td style="width: 10%;" class="cent">'.$aef_drfp + $aej_drfp + $ee_drfp + $de_drfp.'</td>
                            <td style="width: 10%;" class="cent">'.$aef_crfp + $aej_crfp + $ee_crfp + $de_crfp.'</td>
                        </tr>
                ';
                $html .= '
                    </tbody>
                    </table>
                    ';
                $rdata2         = $rp->getaa11con('con',$s[0],$c['c3tID'],$cID,$wpID);
                $con    = json_decode($rdata2['question'], true);
                $html .= '
                    <p><b>Conclusion (only include errors which remain uncorrected):</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th style="width: 40%;"></th>
                                <th colspan="4" style="width: 40%;"><b>Potential Effect on the Financial Statements</b></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th colspan="2" style="width: 20%;"><b>Performance Statements</b></th>
                                <th colspan="2" style="width: 20%;"><b>S\'ment of Fin. Position</b></th>

                            </tr>
                            <tr>
                                <th style="width: 10%;"><b>WP Ref.</b></th>
                                <th style="width: 40%;"><b>Details</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                <tr>
                                    <td style="width: 10%;">B DIV</td>
                                    <td style="width: 40%;">Intangibles and goodwill</td>
                                    <td style="width: 10%;">'.$con['bdr1'].'</td>
                                    <td style="width: 10%;">'.$con['bcr1'].'</td>
                                    <td style="width: 10%;">'.$con['bdr2'].'</td>
                                    <td style="width: 10%;">'.$con['bcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">C DIV</td>
                                    <td style="width: 40%;">Property, plant and equipment</td>
                                    <td style="width: 10%;">'.$con['cdr1'].'</td>
                                    <td style="width: 10%;">'.$con['ccr1'].'</td>
                                    <td style="width: 10%;">'.$con['cdr2'].'</td>
                                    <td style="width: 10%;">'.$con['ccr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">D/G DIV</td>
                                    <td style="width: 40%;">Investments</td>
                                    <td style="width: 10%;">'.$con['ddr1'].'</td>
                                    <td style="width: 10%;">'.$con['dcr1'].'</td>
                                    <td style="width: 10%;">'.$con['ddr2'].'</td>
                                    <td style="width: 10%;">'.$con['dcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">E DIV</td>
                                    <td style="width: 40%;">Inventories</td>
                                    <td style="width: 10%;">'.$con['edr1'].'</td>
                                    <td style="width: 10%;">'.$con['ecr1'].'</td>
                                    <td style="width: 10%;">'.$con['edr2'].'</td>
                                    <td style="width: 10%;">'.$con['ecr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">F DIV</td>
                                    <td style="width: 40%;">Receivables</td>
                                    <td style="width: 10%;">'.$con['fdr1'].'</td>
                                    <td style="width: 10%;">'.$con['fcr1'].'</td>
                                    <td style="width: 10%;">'.$con['fdr2'].'</td>
                                    <td style="width: 10%;">'.$con['fcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">H DIV</td>
                                    <td style="width: 40%;">Cash at bank and in hand</td>
                                    <td style="width: 10%;">'.$con['hdr1'].'</td>
                                    <td style="width: 10%;">'.$con['hcr1'].'</td>
                                    <td style="width: 10%;">'.$con['hdr2'].'</td>
                                    <td style="width: 10%;">'.$con['hcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">I DIV</td>
                                    <td style="width: 40%;">Payables</td>
                                    <td style="width: 10%;">'.$con['idr1'].'</td>
                                    <td style="width: 10%;">'.$con['icr1'].'</td>
                                    <td style="width: 10%;">'.$con['idr2'].'</td>
                                    <td style="width: 10%;">'.$con['icr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">J DIV</td>
                                    <td style="width: 40%;">Taxation</td>
                                    <td style="width: 10%;">'.$con['jdr1'].'</td>
                                    <td style="width: 10%;">'.$con['jcr1'].'</td>
                                    <td style="width: 10%;">'.$con['jdr2'].'</td>
                                    <td style="width: 10%;">'.$con['jcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">L DIV</td>
                                    <td style="width: 40%;">Provisions</td>
                                    <td style="width: 10%;">'.$con['ldr1'].'</td>
                                    <td style="width: 10%;">'.$con['lcr1'].'</td>
                                    <td style="width: 10%;">'.$con['ldr2'].'</td>
                                    <td style="width: 10%;">'.$con['lcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">M DIV</td>
                                    <td style="width: 40%;">Equity</td>
                                    <td style="width: 10%;">'.$con['mdr1'].'</td>
                                    <td style="width: 10%;">'.$con['mcr1'].'</td>
                                    <td style="width: 10%;">'.$con['mdr2'].'</td>
                                    <td style="width: 10%;">'.$con['mcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">O DIV</td>
                                    <td style="width: 40%;">Revenue</td>
                                    <td style="width: 10%;">'.$con['odr1'].'</td>
                                    <td style="width: 10%;">'.$con['ocr1'].'</td>
                                    <td style="width: 10%;">'.$con['odr2'].'</td>
                                    <td style="width: 10%;">'.$con['ocr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">P DIV</td>
                                    <td style="width: 40%;">Direct costs</td>
                                    <td style="width: 10%;">'.$con['pdr1'].'</td>
                                    <td style="width: 10%;">'.$con['pcr1'].'</td>
                                    <td style="width: 10%;">'.$con['pdr2'].'</td>
                                    <td style="width: 10%;">'.$con['pcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">Q DIV</td>
                                    <td style="width: 40%;">Other income and gains</td>
                                    <td style="width: 10%;">'.$con['qdr1'].'</td>
                                    <td style="width: 10%;">'.$con['qcr1'].'</td>
                                    <td style="width: 10%;">'.$con['qdr2'].'</td>
                                    <td style="width: 10%;">'.$con['qcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">R DIV</td>
                                    <td style="width: 40%;">Other expenditure and losses</td>
                                    <td style="width: 10%;">'.$con['rdr1'].'</td>
                                    <td style="width: 10%;">'.$con['rcr1'].'</td>
                                    <td style="width: 10%;">'.$con['rdr2'].'</td>
                                    <td style="width: 10%;">'.$con['rcr2'].'</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Total Effect of Unadjusted Errors</td>
                                    <td>'.$con['bdr1'] + $con['cdr1'] + $con['ddr1'] + $con['edr1'] + $con['fdr1'] + $con['hdr1'] + $con['idr1'] + $con['jdr1'] + $con['ldr1'] + $con['mdr1'] + $con['odr1'] + $con['pdr1'] + $con['qdr1']  + $con['rdr1']  .'</td>
                                    <td>'.$con['bcr1'] + $con['ccr1'] + $con['dcr1'] + $con['ecr1'] + $con['fcr1'] + $con['hcr1'] + $con['icr1'] + $con['jcr1'] + $con['lcr1'] + $con['mcr1'] + $con['ocr1'] + $con['pcr1'] + $con['qcr1']  + $con['rcr1']  .'</td>
                                    <td>'.$con['bdr2'] + $con['cdr2'] + $con['ddr2'] + $con['edr2'] + $con['fdr2'] + $con['hdr2'] + $con['idr2'] + $con['jdr2'] + $con['ldr2'] + $con['mdr2'] + $con['odr2'] + $con['pdr2'] + $con['qdr2']  + $con['rdr2']  .'</td>
                                    <td>'.$con['bcr2'] + $con['ccr2'] + $con['dcr2'] + $con['ecr2'] + $con['fcr2'] + $con['hcr2'] + $con['icr2'] + $con['jcr2'] + $con['lcr2'] + $con['mcr2'] + $con['ocr2'] + $con['pcr2'] + $con['qcr2']  + $con['rcr2']  .'</td>
                                </tr>
                            </tfoot>
                        </tbody>
                    </table>
                    ';
                $html .= '
                    <p>The errors in total are clearly trivial (as defined by the planning letter) and have not been communicated to the directors.*</p>
                    <p>The errors in total are not trivial and the directors have confirmed verbally that they do not want to adjust them and this will be confirmed in the letter of representation.*</p>
                    <p>I am satisfied that the combined effect of the above errors is below performance materiality for the financial statements as a whole**, and therefore does not warrant correction.*</p>
                    <p>The errors in total exceed performance materiality for the financial statements as a whole**, and given the risk of unidentified items, the financial statements are deemed to be materially incorrect, and the audit opinion will be modified (Aa1, page 7)</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________ (A.E.P.)</td>
                            <td style="width: 50%;">Dated:_____________</td>
                        </tr>
                    </table>
                    <br><br>
                    <p>*  Delete as appropriate</p>
                    <p>** Does not turn a profit into a loss (or vice versa) or a net asset position into a net liability position (or vice versa), adjustments, misstatements for an individual area being greater than the performance materiality level, or is greater than any of the specific measures of performance materiality noted at Ac13 (for example, related party transactions, directors\' emoluments, etc.).  Also, where the client has artificially ‘cherry picked’ potential adjustments to achieve a particular presentation of its financial position, financial performance or cash flows (for example, all items that reduce profit have been corrected but all adjustments that increase it have not) then this would also be considered to be a material error in the financial statements.</p>
                    <p><b>Notes: </b><br>"Clearly trivial"  errors do not need to be accumulated.  These items are clearly inconsequential, whether taken individually or in aggregate, whether judged by size, nature or circumstances.  It is suggested that 1% of audit materiality is used to determine a level at which items are deemed to be clearly trivial, but a different percentage can be used if deemed to be more appropriate and is adequately justified.  </p>
                    <p>However, misstatements relating to amounts may not be clearly trivial when judged on criteria of nature or circumstance. If this is the case, the misstatements should be accumulated as unadjusted errors.</p>
                    <p>Misstatements in disclosures may also be clearly trivial whether taken individually or in aggregate, and whether judged by any criteria of size, nature or circumstances. Misstatements in disclosures that are not clearly trivial are also accumulated to assist the auditor in evaluating the effect of such misstatements on the relevant disclosures and the financial statements as a whole. Paragraph A13a of ISA 450 provides examples of where misstatements in qualitative disclosures may be material.</p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case '3.10 Aa11-ad':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT\'S FINANCIAL STATEMENTS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $s = explode('-', $code);

                $html .= '
                    <p><b>SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT\'S FINANCIAL STATEMENTS</b></p>
                    <p><b>Objective:</b> <br> To carry out a review of the financial statements such that the results obtained, together with the conclusions drawn from other audit tests, give a basis for the opinion on the financial statements.</p>
                    <p><b>Recording:</b> <br> Review key ratios of most significance to the entity. Any large or unexpected movements in these ratios should be explained. This section should also contain details of significant or unexpected changes in major Statement of Financial Position and Performance Statement items.</p>
                    <p><b>Comparisons should be made of current period figures with prior period and / or budgeted figures.  Explanations obtained for significant or unexpected changes in key business ratios and items in the financial statements must be corroborated by other evidence. A conclusion should then be reached. </b></p>
                    <p><b><i>Undertaking analytical procedures at finalisation is mandatory; however, the use of this form is optional.</i></b></p>
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th style="width: 40%;"></th>
                                <th colspan="4" style="width: 40%;"><b>Potential Effect on the Financial Statements</b></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th colspan="2" style="width: 20%;"><b>Performance Statements</b></th>
                                <th colspan="2" style="width: 20%;"><b>S\'ment of Fin. Position</b></th>
                        
                            </tr>
                            <tr>
                                <th style="width: 10%;"><b>WP Ref.</b></th>
                                <th style="width: 40%;"><b>Account and Description of Adjustment</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                            </tr>
                            <tr>
                                <th colspan="6"><b>ADJUSTMENTS MADE BY AUDITORS</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                            $drps = 0;
                            $crps = 0;
                            $drfp = 0;
                            $crfp = 0;
                            $ad = $rp->getaa11p2('ad',$s[0],$c['c3tID'],$cID,$wpID);
                            foreach($ad as $r){
                                $drps += $r['drps'];
                                $crps += $r['crps'];
                                $drfp += $r['drfp'];
                                $crfp += $r['crfp'];

                                $html .= '
                                <tr>
                                    <td style="width: 10%;">'.$r['reference'].'</td>
                                    <td style="width: 40%;">'.$r['initials'].'</td>
                                    <td style="width: 10%;" class="cent">'.$r['drps'].'</td>
                                    <td style="width: 10%;" class="cent">'.$r['crps'].'</td>
                                    <td style="width: 10%;" class="cent">'.$r['drfp'].'</td>
                                    <td style="width: 10%;" class="cent">'.$r['crfp'].'</td>
                                </tr>
                            ';
                    }
                $html .= '
                        <tr>
                            <td colspan="6" style="width: 50%;"><b>Total Effect of Unadjusted Errors</b></td>
                            <td style="width: 10%;" class="cent">'.$drps.'</td>
                            <td style="width: 10%;" class="cent">'.$crps.'</td>
                            <td style="width: 10%;" class="cent">'.$drfp.'</td>
                            <td style="width: 10%;" class="cent">'.$crfp.'</td>
                        </tr>
                ';
                $html .= '
                        </tbody>
                    </table>
                    <br><br>
                ';
                $rdata = $rp->getaa11p('aa11uead',$s[0],$c['c3tID'],$cID,$wpID);
                $ue = json_decode($rdata['question'], true);   
                $html .= '
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 65%;"><b>Profit (Loss) for the Period per Draft Financial Statements</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['pl'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 65%;"><b>Net Adjustments Made by Auditors to Client\'s Draft Figures</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['na'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 65%;"><b>Profit (Loss)  for the Period per Final Financial Statements</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['pl2'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>No adjustments have been made to the client\'s draft financial statements.*</p>
                    <p>The above adjustments have been identified, the directors ("informed management") have confirmed verbally that they wish to adjust them and this will be confirmed in the letter of representation.*</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________ (A.E.P.)</td>
                            <td style="width: 50%;">Dated:_____________</td>
                        </tr>
                    </table>
                    <p>* Delete as appropriate</p>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case '3.11':
                
            break;   
            case '3.12':
                
            break;  

            case '3.13 Ab1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : CRITICAL REVIEW OF THE FINANCIAL STATEMENTS',1,1);
                $html .= $style;
                $html .= $c['code'];

                $ab1 = $rp->getab1($c['code'],$c['c3tID'],$cID,$wpID);

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
                        </tr>
                    </table>
                ';
                $html .= '
                    <h3>CRITICAL REVIEW OF THE FINANCIAL STATEMENTS</h3>
                ';
                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b></b></th>
                                <th class="cent bo" style="width: 18%;"><b>Yes / No / N/A</b></th>
                                <th class="cent bo" style="width: 18%;"><b>WP Ref. / Comment</b></th>

                            </tr>
                        </thead>
                        <tbody>';
                        $count = 0;
                        foreach($ab1 as $r){
                            $count ++;
                            $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['question'].'<br></td>
                                <td class="cent bo" style="width: 18%;">'.$r['yesno'].'</td>
                                <td class="cent bo" style="width: 18%;">'.$r['comment'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                    <p>The tests above were undertaken on draft financial statements sent to the client.</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________ </td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <p>The tests above were undertaken on final financial statements sent to the client.  The financial statements are correctly prepared, and other information included within the Annual Report is consistent with the financial statements.</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________ (Manager)</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; ;   
            
            case '3.14 Ab3':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : FINANCIAL STATEMENTS DISCLOSURE AND COMPLIANCE ANNUAL REVIEW CHECKLIST',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                $rdata = $rp->getab3($c['code'],$c['c3tID'],$cID,$wpID);
                $ab3 = json_decode($rdata['question'], true);
                $html .= '
                    <h3>FINANCIAL STATEMENTS DISCLOSURE AND COMPLIANCE ANNUAL REVIEW CHECKLIST</h3>
                    <p>This checklist should be used to evidence the checking of disclosure and compliance matters for \'uncomplex companies\' where the appropriate (i.e. IFRS) disclosure checklist has been completed within the last three years and the size and complexity of the company means that the firm does not consider that a full disclosure checklist needs to be completed every year.</p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 7%;"><b>1.</b></td>
                                <td style="width: 93%;"><b>Use of Disclosure Checklists</b>
                                    <p>The appropriate disclosure checklist must be completed in the following circumstances:</p>
                                    <ul>
                                        <li>First year of engagement;</li>
                                        <li>Every three years;</li>
                                        <li>Where the financial statements are not prepared via a computerised accounts production package;</li>
                                        <li>Where there have been significant changes in the client\'s business or accounting policies;</li>
                                        <li>Where there have been significant changes in financial reporting standards (including First Time Adoption of / Amendments to IFRS) or legislative requirements;</li>
                                        <li>Where there has been a significant transaction which would require additional disclosure in the financial statements (for example, a change to Equity (other than the profit for the year), the introduction of a new type of asset or liability, or acquiring a new source of income or expenditure).</li>
                                    </ul>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 7%;"><b>2.</b></td>
                                <td style="width: 93%;"><b>Common Changes</b>
                                    <p>Have any of the following points arisen during the period, resulting in disclosure or compliance changes:</p>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="width: 80%;"></th>
                                                <th class="bo cent" style="width: 20%;"><b>Yes/No</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>•  Are disclosure exemptions available in legislation / IFRS now being taken / lost?</td>
                                                <td class="bo cent">'.$ab3['aby1'].'</td>
                                            </tr>
                                            <tr>
                                                <td>•  Was the company required to produce consolidated financial statements in the previous period but not in this period?</td>
                                                <td class="bo cent">'.$ab3['aby2'].'</td>
                                            </tr>
                                            <tr>
                                                <td>•  Is the company required to prepare consolidated financial statements this period (but has not in the previous period)?</td>
                                                <td class="bo cent">'.$ab3['aby3'].'</td>
                                            </tr>
                                            <tr>
                                                <td>•  Is the company adopting a new accounting framework for the first time?</td>
                                                <td class="bo cent">'.$ab3['aby4'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p>If the answer to any of the above is yes, a full disclosure checklist needs to be completed.</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 7%;"><b>3.</b></td>
                                <td style="width: 93%;"><b>New Financial Reporting Standards </b>
                                    <p>The most recently completed disclosure checklist was for the period ending_________________</p>
                                    <p>Since then, no further* / the following* Accounting / Financial Reporting Standards or amendments (IFRS*) have become mandatory, with a commentary of the effect on disclosure in the financial statements being shown <i>(or included on a separate, cross-referenced schedule)(*delete as applicable):</i></p>
                                    <table border="1">
                                        <thead>
                                            <tr>
                                                <th class="cent"><b>Financial Reporting Standard </b></th>
                                                <th class="cent"><b>Effect on disclosures</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="cent">
                                                <td>'.$ab3['frs1'].'</td>
                                                <td>'.$ab3['ed1'].'</td>
                                            </tr>
                                            <tr class="cent">
                                                <td>'.$ab3['frs2'].'</td>
                                                <td>'.$ab3['ed2'].'</td>
                                            </tr>
                                            <tr class="cent">
                                                <td>'.$ab3['frs3'].'</td>
                                                <td>'.$ab3['ed3'].'</td>
                                            </tr>
                                            <tr class="cent">
                                                <td>'.$ab3['frs4'].'</td>
                                                <td>'.$ab3['ed4'].'</td>
                                            </tr>
                                            <tr class="cent">
                                                <td>'.$ab3['frs5'].'</td>
                                                <td>'.$ab3['ed5'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 7%;"><b>4.</b></td>
                                <td style="width: 93%;"><b>Conclusion</b>
                                    <p>It is unnecessary to complete the relevant disclosure checklist for the current period.</p>
                                    <p>The financial statements have been reviewed with reference to the previously completed disclosure checklist and the requirements of any new financial reporting standards or amendments, and disclosures are considered to be adequate.</p>
                                    <br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case '3.15 Ab4':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : CORPORATE DISCLOSURE CHECKLIST (IFRS)',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <p><b>CORPORATE DISCLOSURE CHECKLIST (IFRS)</b></p>
                    <p><b><u>Scope</u></b></p>
                    <p>This checklist should be completed for every corporate entity where International Financial Reporting Standards (IFRS) are being followed and it is not appropriate to complete Appendix 3.14 – Financial Statements Disclosure and Compliance Annual Review Checklist.</p>
                    <p>This checklist can be used for any entity that adopts IFRS, and includes a number of “best practice” disclosures which are commonly included within financial statements as a result of local legislative requirements.  If such best practice disclosures are not required, or are prohibited by legislation, it would be necessary to disregard these, and where relevant, to replace these disclosures with those disclosures required by the relevant legislation.</p>
                    <p>The requirements of IFRS only apply to material items.  Immaterial balances can be aggregated into other account headings and immaterial notes and accounting policies can be, and should ideally be, removed [IAS 1 paragraphs 29-31].</p>
                    <p>IFRS 15 <i>Revenue from Contracts with Customers</i> and IFRS 9 <i>Financial Instruments</i> became mandatory for accounting periods commencing on or after 1 January 2018. These resulted in significant additional disclosure requirements compared to the superseded standards dealing with these areas. </p>
                    <p>IFRS 16 Leases is mandatory for accounting periods commencing on or after 1 January 2019. This fundamentally alters the accounting treatment for lessees, with consequential disclosure amendments.</p>
                    <p><b>NB: To ensure that the Checklist is as efficient as possible, areas which are more specialised have been addressed by supplementary disclosure checklists.  <u>These supplementary disclosure checklists should only be completed if the area is relevant.</u></b></p>
                    <p>NB: The checklist does not cover the additional disclosures required by companies which enter into insurance contracts, where these are relevant considerations, then the disclosure requirements of IFRS 4 should be given.  It also does not cover the requirements of IAS 26, which are only relevant to clients who are themselves pension schemes, or IFRIC 2 which is relevant to cooperative entities.  The checklist also does not cover the disclosure requirements of companies with listed equity or debt.</p>
                ';
                $rdata = $rp->getab4checklist('checklist',$c['code'],$c['c3tID'],$cID,$wpID);
                $sec    = json_decode($rdata['question'], true);
                $html .= '
                    <table border="1">
                        <thead>
                            <tr class="cent">
                                <th style="width: 55%;"><b>Specialist Area ~ Additional Disclosures Relating to:-</b></th>
                                <th style="width: 15%;"><b>Reference in this Manual</b></th>
                                <th style="width: 15%;"><b>Is this Area Relevant?(Y/N)</b></th>
                                <th style="width: 15%;"><b>Supplementary Checklist Completed?(Y/N/NA)</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="cent">
                                <td style="width: 55%;">Exploration for and Evaluation of Mineral Resources</td>
                                <td style="width: 15%;">App. 3.15.1</td>
                                <td style="width: 15%;">'.$sec['y1'].'</td>
                                <td style="width: 15%;">'.$sec['y2'].'</td>
                            </tr>
                            <tr class="cent">
                                <td style="width: 55%;">Defined Benefit Pension Plans</td>
                                <td style="width: 15%;">App. 3.15.2</td>
                                <td style="width: 15%;">'.$sec['y3'].'</td>
                                <td style="width: 15%;">'.$sec['y4'].'</td>
                            </tr>
                            <tr class="cent">
                                <td style="width: 55%;">Share-Based Payments</td>
                                <td style="width: 15%;">App. 3.15.3</td>
                                <td style="width: 15%;">'.$sec['y5'].'</td>
                                <td style="width: 15%;">'.$sec['y6'].'</td>
                            </tr>
                            <tr class="cent">
                                <td style="width: 55%;">Agricultural Activitiess</td>
                                <td style="width: 15%;">App. 3.15.4</td>
                                <td style="width: 15%;">'.$sec['y7'].'</td>
                                <td style="width: 15%;">'.$sec['y8'].'</td>
                            </tr>
                            <tr class="cent">
                                <td style="width: 55%;">First Time Adoption of IFRS</td>
                                <td style="width: 15%;">App. 3.15.5</td>
                                <td style="width: 15%;">'.$sec['y9'].'</td>
                                <td style="width: 15%;">'.$sec['y10'].'</td>
                            </tr>
                            <tr class="cent">
                                <td style="width: 55%;">Parent where Consolidated Financial Statements are not Prepared</td>
                                <td style="width: 15%;">App. 3.15.6</td>
                                <td style="width: 15%;">'.$sec['y11'].'</td>
                                <td style="width: 15%;">'.$sec['y12'].'</td>
                            </tr>
                            <tr class="cent">
                                <td style="width: 55%;">First Time Adoption of IFRS 15 / 9</td>
                                <td style="width: 15%;">App. 3.15.7</td>
                                <td style="width: 15%;">'.$sec['y13'].'</td>
                                <td style="width: 15%;">'.$sec['y14'].'</td>
                            </tr>
                            <tr class="cent">
                                <td style="width: 55%;">First Time Adoption of IFRS 16</td>
                                <td style="width: 15%;">App. 3.15.8</td>
                                <td style="width: 15%;">'.$sec['y15'].'</td>
                                <td style="width: 15%;">'.$sec['y16'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <p>For areas which are relevant, “Supplementary Checklist Completed” should be marked ‘Yes’, ‘No’ or ‘Not Applicable’ as appropriate.  Any ‘No’ answers must be fully explained.</p>
                    <p><b>Contents</b></p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 15%;"><b>Section 1</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Format of the Annual Report and Generic Information</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 2</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Directors Report (Review of the Business) ~ Best Practice Disclosures</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 3</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Directors Report ~ Best Practice Disclosures</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 4</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Statement of Comprehensive Income (SCI) and Related Notes</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 5</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Statement of Changes in Equity</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 6</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Statement of Financial Position and Related Notes</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 7</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Statement of Cash Flows</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 8</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Accounting Policies and Estimation Techniques</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 9</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Notes and Other Disclosures</b><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Key to abbreviations used in the “Reference” column:</b></p>
                    <table style="width: 50%;">
                        <tbody>
                            <tr>
                                <td>IAS 1.82</td>
                                <td>Paragraph 82 of IAS 1</td>
                            </tr>
                            <tr>
                                <td>IFRS 15.110</td>
                                <td>Paragraph 110 of IFRS 15</td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 1 – Format of the Annual Report and Generic Information</b></th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $sec1   = $rp->getab4('section1',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($sec1 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 2– Directors’ Report (Review of the Business) ~ Best Practice Disclosures</b></th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $sec2   = $rp->getab4('section2',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($sec2 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 3 – Directors’ Report (Other) ~ Best Practice Disclosures</b></th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $sec3   = $rp->getab4('section3',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($sec3 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 4 – Statement of Comprehensive Income (SCI) and Related Notes</b></th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5">IAS 1 paragraph 81A allows the SCI to be presented as either one or two statements (a profit and loss account and a SCI (which is a combination of the profit for the year plus items of other comprehensive income (OCI))).</td>
                            </tr>
                            ';
                        $sec4   = $rp->getab4('section4',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($sec4 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 5 – Statement of Changes in Equity</b>
                                <p>NB1: This must be presented as a primary statement and not as a note to the financial statements.</p>
                                <p>NB2: Per IAS 21 paragraph 52(a) there should be a column for foreign exchange differences that pass through OCI and accumulate in equity.</p>
                            </th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $sec5   = $rp->getab4('section5',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($sec5 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 6 – Statement of Financial Position and Related Notes</b>
                            </th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $sec6   = $rp->getab4('section6',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($sec6 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 7 – Statement of Cash Flows</b>
                            </th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $sec7   = $rp->getab4('section7',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($sec7 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 8 – Accounting Policies and Estimation Techniques</b>
                                <p>The following disclosures can be show as part of the notes to the financial statements or as a specific section in the financial statements [IAS 1.116].</p>
                            </th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $sec8   = $rp->getab4('section8',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($sec8 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 9– Notes and Other Disclosures </b>
                            </th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $sec9   = $rp->getab4('section9',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($sec9 as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case '3.15.1 Ab4a':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS) ~ Additional Disclosures for an Entity Involved in Exploration for and Evaluation of Mineral Resources',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <p><b>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS) <br>
                        ~ Additional Disclosures for an Entity Involved in Exploration for and Evaluation of Mineral Resources
                    </b></p>
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>IFRS  Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $ab4a = $rp->getab4a('ab4a',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($ab4a as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case '3.15.2 Ab4b':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <p><b>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)<br>
                    ~ Additional Disclosures for an Entity with a Defined Benefit Pension Plan(s) (including those Accounted for on a Defined Contribution Basis)
                    </b></p>
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>IFRS  Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $ab4b = $rp->getab4a('ab4b',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($ab4b as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  

            case '3.15.3 Ab4c':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <p><b>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)<br>
                    ~ Additional Disclosures for an Entity with Share-Based Payments
                    </b></p>
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>IFRS  Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $ab4c = $rp->getab4a('ab4c',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($ab4c as $r){
                            $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['reference'].'</td>
                                <td style="width: 7%;">'.$r['extent'].'</td>
                                <td style="width: 50%;">'.$r['question'].'</td>
                                <td style="width: 15%;">'.$r['yesno'].'</td>
                                <td style="width: 15%;">'.$r['comment'].'</td>
                            </tr>
                            ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  

            case '3.15.4 Ab4d':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS) ~ Additional Disclosures for an Entity with Agricultural Activities',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <p><b>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)<br>
                    ~ Additional Disclosures for an Entity with Agricultural Activities
                    </b></p>
                    <p><b><u>Scope</u></b> <br>This checklist should be completed where the entity is engaged in agricultural activities.</p>
                    <p><b>Agricultural Activities </b>are defined as ‘The management by an entity of the biological transformation and harvest of biological assets for sale or for conversion into agricultural produce or into additional biological assets’.</p>
                    <p><b>Agricultural Produce </b> is defined as ‘The harvested product of the entity’s biological assets’.</p>
                    <p><b>Biological Assets </b> are defined as ‘A living animal or plant’.</p>
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>IFRS  Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $ab4d = $rp->getab4a('ab4d',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($ab4d as $r){
                $html .= '
                    <tr>
                        <td style="width: 13%;">'.$r['reference'].'</td>
                        <td style="width: 7%;">'.$r['extent'].'</td>
                        <td style="width: 50%;">'.$r['question'].'</td>
                        <td style="width: 15%;">'.$r['yesno'].'</td>
                        <td style="width: 15%;">'.$r['comment'].'</td>
                    </tr>';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  

            case '3.15.5 Ab4e':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS) ~ Additional Disclosures for First Time Adopters of IFRS',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <p><b>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)<br>
                    ~ Additional Disclosures for First Time Adopters of IFRS
                    </b></p>
                    <p><b><u>Scope</u></b> <br>This checklist should be completed for all entities that are adopting IFRS for the first time.</p>
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>IFRS  Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $ab4e = $rp->getab4a('ab4e',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($ab4e as $r){
                $html .= '
                    <tr>
                        <td style="width: 13%;">'.$r['reference'].'</td>
                        <td style="width: 7%;">'.$r['extent'].'</td>
                        <td style="width: 50%;">'.$r['question'].'</td>
                        <td style="width: 15%;">'.$r['yesno'].'</td>
                        <td style="width: 15%;">'.$r['comment'].'</td>
                    </tr>
                ';
                        }
                $html .= '
                        </tbody>
                    </table>
                ';
                
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  

            case '3.15.6 Ab4f':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS) ~ Additional Disclosure for Parent Undertakings that are Not Consolidating',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <p><b>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS)<br>
                    ~ Additional Disclosure for Parent Undertakings that are Not Consolidating
                    </b></p>
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>IFRS  Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $ab4f = $rp->getab4a('ab4f',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($ab4f as $r){
                $html .= '
                    <tr>
                        <td style="width: 13%;">'.$r['reference'].'</td>
                        <td style="width: 7%;">'.$r['extent'].'</td>
                        <td style="width: 50%;">'.$r['question'].'</td>
                        <td style="width: 15%;">'.$r['yesno'].'</td>
                        <td style="width: 15%;">'.$r['comment'].'</td>
                    </tr>
                ';
                }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case '3.15.7 Ab4g':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS) ~ Additional Disclosures on transition to IFRS 15 and IFRS 9',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <p><b>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS AND FRS 101)<br>
                    ~ Additional Disclosures on transition to IFRS 15 and IFRS 9
                    </b></p>
                    <p><b><u>Scope:</u></b> <br>This checklist should be completed for all entities that are applying IFRS 15 <i>Revenue from Contracts with Customers</i> and IFRS 9 <i>Financial Instruments</i> for the first time. Both Standards are mandatory for accounting periods commencing on/after 1 January 2018.</p>
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>IFRS  Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $ab4g = $rp->getab4a('ab4g',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($ab4g as $r){
                $html .= '
                    <tr>
                        <td style="width: 13%;">'.$r['reference'].'</td>
                        <td style="width: 7%;">'.$r['extent'].'</td>
                        <td style="width: 50%;">'.$r['question'].'</td>
                        <td style="width: 15%;">'.$r['yesno'].'</td>
                        <td style="width: 15%;">'.$r['comment'].'</td>
                    </tr>
                ';
                }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case '3.15.8 Ab4h':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS) ~ Additional Disclosures on transition to IFRS 16',1,1);
                $html .= $style;
                $html .= $c['code'];

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
                    <p><b>SUPPLEMENTARY CORPORATE DISCLOSURE CHECKLIST (IFRS AND FRS 101)<br>
                    ~ Additional Disclosures on transition to IFRS 16
                    </b></p>
                    <p><b><u>Scope:</u></b> <br>This checklist should be completed for all entities that are applying IFRS 16 Leases for the first time, which is mandatory for accounting periods commencing on/after 1 January 2019.</p>
                ';
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>IFRS  Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $ab4h = $rp->getab4a('ab4h',$c['code'],$c['c3tID'],$cID,$wpID);
                        foreach($ab4h as $r){
                $html .= '
                    <tr>
                        <td style="width: 13%;">'.$r['reference'].'</td>
                        <td style="width: 7%;">'.$r['extent'].'</td>
                        <td style="width: 50%;">'.$r['question'].'</td>
                        <td style="width: 15%;">'.$r['yesno'].'</td>
                        <td style="width: 15%;">'.$r['comment'].'</td>
                    </tr>
                ';
                }
                $html .= '
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;  
        }
    }


    /**
        ----------------------------------------------------------
        DOCUMENT ATTACHMENTS
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Document Attachments',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:navy;text-align:center;">DOCUMENT ATTACHMENTS</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';

    foreach($fi as $f){
        switch ($f['section']) {

            case '-':

                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2>';
                
                if($f['file'] != ''){
                    // Set the source PDF file 
                    $pageCount = $pdf->setSourceFile(ROOTPATH.'public/uploads/pdf/wp/'.$fID.'/'.$wpID.'/'.$f['file']);
                    // Iterate through all pages and import them
                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                        $templateId = $pdf->importPage($pageNo);
                        $size = $pdf->getTemplateSize($templateId);
                        // Create a new page in TCPDF with the same size as the imported page
                        $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
                        // Use the imported page as a template
                        $html .= '<b style="color:navy;">'.$f['file'].'</b><br><br>';
                        $pdf->writeHTMLCell(0, 0, 10, 10, $html, 0, 1, 0, true, '', true);
                        $pdf->useTemplate($templateId, 0, 20);
                        $html = '';
                    }
                }
                
            break;

            case 'FSTR':

                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2>';

                foreach($fst as $r){

                    if($r['file'] != ''){
                        // Set the source PDF file 
                        $pageCount = $pdf->setSourceFile(ROOTPATH.'public/uploads/pdf/wp/'.$fID.'/'.$wpID.'/'.$r['file']);
                        // Iterate through all pages and import them
                        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                            $templateId = $pdf->importPage($pageNo);
                            $size = $pdf->getTemplateSize($templateId);
                            // Create a new page in TCPDF with the same size as the imported page
                            $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
                            // Use the imported page as a template
                            $html .= '<b style="color:navy;">Quarter: '.$r['quarter'].'</b><br>';
                            $html .= '<b style="color:navy;">File: '.$r['type'].'</b><br>';
                            $html .= '<b style="color:navy;">File Name: '.$r['file'].'</b><br>';
                            $pdf->writeHTMLCell(0, 0, 10, 10, $html, 0, 1, 0, true, '', true);
                            $pdf->useTemplate($templateId, 0, 20);
                            $html = '';
                        }
    
                    }
                    
                }

            break;

            case 'B':
            case 'C':
            case 'DG':
            case 'E':
            case 'F':
            case 'H':
            case 'I':
            case 'J':
            case 'K':
            case 'L':
            case 'M':
            case 'N':
            case 'O':
            case 'P':
            case 'Q':
            case 'R':
            case 'S':

                if($f['file'] != ''){

                    $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                    $html .= $style2;
                    $html .= '<hr style="color:blue;">';
                    $html .= '<h2 style="color:navy;">'.$f['section'].': '.$f['desc'].'</h2>';
                    // Set the source PDF file 
                    $pageCount = $pdf->setSourceFile(ROOTPATH.'public/uploads/pdf/wp/'.$fID.'/'.$wpID.'/'.$f['file']);
                    // Iterate through all pages and import them
                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                        $templateId = $pdf->importPage($pageNo);
                        $size = $pdf->getTemplateSize($templateId);
                        // Create a new page in TCPDF with the same size as the imported page
                        $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
                        // Use the imported page as a template
                        $html .= '<b style="color:navy;">'.$f['file'].'</b><br><br>';
                        $pdf->writeHTMLCell(0, 0, 10, 10, $html, 0, 1, 0, true, '', true);
                        $pdf->useTemplate($templateId, 0, 30);
                        $html = '';
                    }
                }
               
            break;

        }

    }

    

    $pdf->addTOCPage('P');
    $toc = '
        <hr style="color:blue;">
        <h1 style="color:navy; text-align:center;">TABLE OF CONTENTS</h1>
        <hr style="color:blue;">
    ';
    $pdf->writeHTML($toc, true, false,false, false, '');
    $pdf->addTOC(2, '', '-', 'Table of Contents', 'B', array(128,0,0));
    $pdf->endTOCPage();

//$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('workpaper-'.$client.'.pdf','I');
exit();