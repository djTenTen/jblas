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
            <td class="bo cent">'.$ac6['revp'].'</td>
            <td class="bo cent">'.$ac6['revf'].'</td>
            <td class="cent" style="width: 8%;">1%</td>
            <td class="bo cent">'.$ac6['revpr'].'</td>
            <td class="bo cent">'.$ac6['revfr'].'</td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td style="width: 25%;">Profit Before Tax 2</td>
            <td class="bo cent">'.$ac6['prop'].'</td>
            <td class="bo cent">'.$ac6['prof'].'</td>
            <td class="cent" style="width: 8%;">10%</td>
            <td class="bo cent">'.$ac6['propr'].'</td>
            <td class="bo cent">'.$ac6['profr'].'</td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td style="width: 25%;">Gross Assets</td>
            <td class="bo cent">'.$ac6['grop'].'</td>
            <td class="bo cent">'.$ac6['grof'].'</td>
            <td class="cent" style="width: 8%;">2%</td>
            <td class="bo cent">'.$ac6['gropr'].'</td>
            <td class="bo cent">'.$ac6['grofr'].'</td>
        </tr>
    </tbody>
</table>
<br><br>
<table>
    <tbody>
        <tr>
            <td style="width: 58.5%;"><p><b>Select the most appropriate benchmark for this entity</b></p></td>
            <td style="width: 8%;"></td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['pcu'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['fcu'].'</td>
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
            <td class="bo"><br><br> '.$ac6['justn45'].' <br><br></td>
        </tr>
    </tbody>
</table>
<br><br>
<table>
    <tbody>
        <tr>
            <td style="width: 58.5%;"><p><b>Initial suggested Materiality Level:</b></p></td>
            <td style="width: 8%;"></td>
            <td class="cent" style="width: 16.75%;">'.$ac6['pcur'].'</td>
            <td class="cent" style="width: 16.75%;">'.$ac6['fcur'].'</td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td colspan="3"><p>If any adjustments are required to initial materiality level, detail these here (Note 6) :</p></td>
        </tr>
        <tr>
            <td style="width: 58.5%;">a) '.$ac6['adja'].'</td>
            <td style="width: 8%;"></td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['adjap'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['adjaf'].'</td>
        </tr>
        <tr>
            <td style="width: 58.5%;">b) '.$ac6['adjb'].'</td>
            <td style="width: 8%;"></td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['adjbp'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['adjbf'].'</td>
        </tr>
        <tr>
            <td style="width: 58.5%;">c) '.$ac6['adjc'].'</td>
            <td style="width: 8%;"></td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['adjcp'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['adjcf'].'</td>
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
            <td class="bo cent" style="width: 16.75%;">'.$ac6['aomp'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['aomf'].'</td>
        </tr>
    </tbody>
</table>
<br><br>
<table>
    <tbody>
        <tr>
            <td style="width: 58.5%;"><p>Materiality Level for previous period (for information only):</p></td>
            <td style="width: 8%;"></td>
            <td class="bo cent" style="width: 33.5%;">'.$ac6['mlpinfo'].'</td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td><p><b>Conclusion at planning stage</b> <br>The overall materiality level calculated above is deemed to be appropriate because:</p></td>
        </tr>
        <tr>
            <td class="bo"><br><br> '.$ac6['conplst'].' <br><br></td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td><p><b>Conclusion at finalisation stage</b><br>Document reasons for any revision to the materiality assessed at planning stage and the impact on the audit procedures undertaken:</p></td>
        </tr>
        <tr>
            <td class="bo"><br><br> '.$ac6['confnst'].'</td>
        </tr>
    </tbody>
</table>
<p><b>PERFORMANCE MATERIALITY</b></p>
<table>
    <tbody>
        <tr>
            <td style="width: 58.5%;"><p><b>Select Overall Inherent Risk (Low / Medium / High):</b></p></td>
            <td style="width: 8%;"></td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['oirp'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['oirf'].'</td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td style="width: 58.5%;">Performance Materiality Percentage (Note 7):</td>
            <td style="width: 8%;"></td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['pmpp'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['pmpf'].'</td>
        </tr>
    </tbody>
</table>   
<p><i>NB: If a percentage has been applied which differs from that suggested by the methodology, document the reasons for this in the conclusion box below.</i></p>
<table>
    <tbody>
        <tr>
            <td style="width: 58.5%;"><p><b>Assessed Performance Materiality</b></p></td>
            <td style="width: 8%;"></td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['apmp'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['apmf'].'</td>
        </tr>
    </tbody>
</table>  
<table>
    <tbody>
        <tr>
            <td><p><b>Conclusion at planning stage</b><br>The performance materiality level calculated above is deemed to be appropriate because:</p></td>
        </tr>
        <tr>
            <td class="bo"><br><br> '.$ac6['conplst2'].' <br><br></td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td><p><b>Conclusion at finalisation stage</b><br>Document reasons for any revision to the perfomance materiality assessed at planning stage and the impact on the audit procedures undertaken:</p></td>
        </tr>
        <tr>
            <td class="bo"><br><br> '.$ac6['confnst2'].' <br><br></td>
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
            <td class="bo cent" style="width: 16.75%;">'.$ac6['ctp'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['ctf'].'</td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td><p><b>Document reasons for any revision to the suggested percentage</b></p></td>
        </tr>
        <tr>
            <td class="bo"><br><br> '.$ac6['rsp'].' <br><br></td>
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
            <td class="bo cent" style="width: 16.75%;">'.$ac6['rptp'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['rptf'].'</td>
        </tr>
        <tr>
            <td style="width: 58.5%;">Accounting estimates</td>
            <td style="width: 8%;">'.$ac6['aest'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['aestp'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['aestf'].'</td>
        </tr>
        <tr>
            <td style="width: 58.5%;">'.$ac6['itbdae1'].'</td>
            <td style="width: 8%;">'.$ac6['itbd1'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd1p'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd1f'].'</td>
        </tr>
        <tr>
            <td style="width: 58.5%;">'.$ac6['itbdae2'].'</td>
            <td style="width: 8%;">'.$ac6['itbd2'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd2p'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd2f'].'</td>
        </tr>
        <tr>
            <td style="width: 58.5%;">'.$ac6['itbdae3'].'</td>
            <td style="width: 8%;">'.$ac6['itbd3'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd3p'].'</td>
            <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd3f'].'</td>
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
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();