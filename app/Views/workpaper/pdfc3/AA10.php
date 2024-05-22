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
$pdf->AddPage('P');
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
        .ind{
            text-indent: 20px;
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
    <h3>FINAL ANALYTICAL PROCEDURES</h3>
    <p><b>Objective:</b> <br> To carry out a review of the financial statements such that the results obtained, together with the conclusions drawn from other audit tests, give a basis for the opinion on the financial statements.</p>
    <p><b>Recording:</b> <br> Review key ratios of most significance to the entity. Any large or unexpected movements in these ratios should be explained. This section should also contain details of significant or unexpected changes in major Statement of Financial Position and Performance Statement items.</p>
    <p><b>Comparisons should be made of current period figures with prior period and / or budgeted figures.  Explanations obtained for significant or unexpected changes in key business ratios and items in the financial statements must be corroborated by other evidence. A conclusion should then be reached. </b></p>
    <p><b><i>Undertaking analytical procedures at finalisation is mandatory; however, the use of this form is optional.</i></b></p>
';
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
$pdf->AddPage();
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
$pdf->AddPage();
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
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();